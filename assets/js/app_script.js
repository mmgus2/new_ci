/**
 * Created by gusis on 5/6/2016.
 */
$(document).ready(function() {
    //initialise base url for ajax request
    var baseUrl = window.location.protocol + "//" + window.location.host + "/Ajax/";
    //var baseUrl = "http://localhost/index.php/Ajax/";

    //define forest class
    function Forest (){
        this.id = 0;
        this.name = '';
        this.latitude = 0;
        this.longitude = 0;
        this.description = '';
        this.distance = 0;
        this.activity = [];
    }

    Forest.prototype.setId = function (id) {
        this.id = id;
        return this;
    }

    Forest.prototype.setName = function (name) {
        this.name = name;
        return this;
    }

    Forest.prototype.setLatitude = function (latitude) {
        this.latitude = latitude;
        return this;
    }

    Forest.prototype.setLongitude = function (longitude) {
        this.longitude = longitude;
        return this;
    }

    Forest.prototype.setDescription = function (description) {
        this.description = description;
        return this;
    }

    Forest.prototype.setDistance = function (distance){
        this.distance = distance;
        return this;
    }

    Forest.prototype.addActivity = function (activity) {
        this.activity.push(activity);
        return this;
    }

    //define site class
    function Site (){
        this.id = 0;
        this.name = '';
        this.latitude = 0;
        this.longitude = 0;
        this.description = '';
        this.descLink = '';
        this.distance = 0;
        this.activity = [];
    }

    Site.prototype.setId = function (id) {
        this.id = id;
        return this;
    }

    Site.prototype.setName = function (name) {
        this.name = name;
        return this;
    }

    Site.prototype.setLatitude = function (latitude) {
        this.latitude = latitude;
        return this;
    }

    Site.prototype.setLongitude = function (longitude) {
        this.longitude = longitude;
        return this;
    }

    Site.prototype.setDescription = function (description) {
        this.description = description;
        return this;
    }

    Site.prototype.setDescLink = function (descLink) {
        this.descLink = descLink;
        return this;
    }

    Site.prototype.setDistance = function (distance){
        this.distance = distance;
        return this;
    }

    Site.prototype.addActivity = function (activity) {
        this.activity.push(activity);
        return this;
    }

    //array to store forest object list
    var forestData = [];

    //variables to store site object list
    var siteData = [];

    //variables initialisation to create map and marker(s)
    var map = null;
    var markers = [];
    var infoWindow = new google.maps.InfoWindow();

    //array for selected activity
    var selectedActivity = [];

    //initialitation for slider
    initRangeSlider(0);

    //autocomplete field initiation
    initAutocomplete();

    //detect user current location
    window.detectLocation = function(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(autogeoSetup, errorInfo);
        } else {
            alertLocation("Geolocation is not supported by this browser. " +
                "Please Specify your location manually.");
        }
    }

    //------ autocomplete field functions-------------------------------------------------
    function initAutocomplete() {
        //set the bias boundary for Victoria, Australia
        var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(-39.224731, 140.962477),
            new google.maps.LatLng(-33.981051, 149.976488 )
        );
        var options = {
            bounds: defaultBounds,
            types: ['address'],
            componentRestrictions: {country:'au'}
        };

        //get the html input element for the autocomplete search box
        var input = document.getElementById('input_loc');
        //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        //create autocomplete object
        autocomplete = new google.maps.places.Autocomplete(input, options);

        autocomplete.addListener('place_changed', initSetup);
    }

    var componentForm = {
        /*street_number: 'short_name',
         route: 'long_name',
         locality: 'long_name',*/
        administrative_area_level_1: 'short_name'
        /*country: 'long_name',
         postal_code: 'short_name'*/
    };

    function initSetup()
    {
        var place = autocomplete.getPlace();
        if(!place.address_components)
        {
            alertLocation("Location can't be found. Please select from the list.");
        }
        if(place.address_components)
        {
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (addressType == 'administrative_area_level_1') {
                    var val = place.address_components[i][componentForm[addressType]];
                    if(val == 'VIC')
                    {
                        //store data inside hidden input tag
                        $("#latitude").val(place.geometry.location.lat());
                        $("#longitude").val(place.geometry.location.lng());

                        //variable initialisation
                        var latitude = $("#latitude").val();
                        var longitude = $("#longitude").val();


                        //initiate selected address and show it in the page
                        informLocation("Your selected location:&nbsp;",place.formatted_address);

                        //set the controller (update slider)
                        setupController(latitude,longitude);

                        //initialise map with user estimated location and add marker
                        setMap(latitude,longitude);
                        addMarker(latitude,longitude,'<b>You select this location!</b>');

                        return;
                    }
                    else if(val != 'VIC'|| !val)
                    {
                        //Selected adress outside Victoria
                        alertLocation("Currently, doesn't support area outside Victoria. " +
                            "Please select address inside Victoria.");

                        return;
                    }
                }
            }
        }
    }
    //------ end of autocomplete field functions-------------------------------------------------

    //initial setup for the page using html5 geolocation
    function autogeoSetup(position)
    {
        //variable initialisation
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        //store data inside hidden input tag
        $("#latitude").val(latitude);
        $("#longitude").val(longitude);

        //initiate estimate address and show it in the page
        estimateAddress(latitude,longitude);

        //set the controller (update slider)
        setupController(latitude,longitude);

        //initialise map with user estimated location and add marker
        setMap(latitude,longitude);
        addMarker(latitude,longitude,'<b>Your estimated location!</b>');
    }

    //display address estimation to the page
    function estimateAddress(latitude,longitude){
        $.ajax({
            type: "GET",
            url: "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + latitude + "," + longitude,
            dataType: 'json',
            success: function (data) {
                if (data) {
                    informLocation('Your estimated current location:&nbsp;',
                        data.results[1].formatted_address);
                }
            }
        });
    }

    //inform of user current location
    function informLocation(message,address){
        $('#input_info').addClass("alert alert-success");
        html = message + '<strong>' + address + '</strong>';
        $('#input_info').html(html);
        $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");
    }

    //set the controller (update slider)
    function setupController(latitude,longitude){
        var selectedUnit = $("select#unit option:selected").val();
        //initialise slider
        $.ajax({
            type: "POST",
            url: baseUrl +"get_max_distance",
            dataType: 'text',
            data: {latitude: latitude,longitude: longitude,unit: selectedUnit},
            success: function (data) {
                if (data) {
                    //update slider button
                    updateRangeSlider(data);

                    //store max distance in hidden input tag
                    $("#max_distance").val(data);
                }
            }
        });
    }

    //function to set map with event listener
    function setMap(latitude, longitude)
    {
        var mapInit = {
            zoom: 15,
            center: new google.maps.LatLng(latitude, longitude)
        };
        map = new google.maps.Map(document.getElementById("map"), mapInit);

        google.maps.event.addListener(map, 'click', function () {
            infoWindow.close();
        });
    }

    //function to add marker with event listener
    function addMarker(latitude, longitude, markerContent, icon)
    {
        if (arguments.length == 3)
        {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(latitude, longitude)
            });
            marker.setMap(map);
            marker.addListener('click', function () {
                infoWindow.setContent(markerContent);
                infoWindow.open(map, marker);
            });
            return marker;
        }
        else //all 4 arguments is used
        {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(latitude, longitude),
                icon: icon
            });
            marker.setMap(map);
            marker.addListener('click', function () {
                infoWindow.setContent(markerContent);
                infoWindow.open(map, marker);
            });
            return marker;
        }
    }

    //----------------Slider function using rangeslider.js-------------
    function initRangeSlider(maxValue)
    {
        var $r = $('input[type=range]');
        var $handle;
        $r.attr({"max": maxValue, "value": maxValue});
        $r.rangeslider({
            polyfill: false,
            onInit: function () {
                $handle = $('.rangeslider__handle', this.$range);
                updateHandle($handle[0], this.value)
            },
            onSlide: function(){
                updateHandle($handle[0], this.value);
            },
            onSlideEnd: function(){
                displayDataDistance(this.value);
            }
        });
    }

    function updateHandle(el, val){
        el.textContent = val;
    }

    //update slider
    function updateRangeSlider(maxValue) {
        var $r = $('input[type=range]');
        $r.attr({"max": maxValue});
        $r.rangeslider('update', true);
        $r.val(maxValue).change();
    }
    //----------------End of slider function using rangeslider.js-------------

    //inform the error status of geolocation to the page
    function errorInfo(error){
        switch(error.code)
        {
            case error.PERMISSION_DENIED:
                alertLocation("Autodetect location is disabled. " +
                    "Please Specify your location manually.");
                break;
            case error.POSITION_UNAVAILABLE:
                alertLocation("Location information is unavailable. " +
                    "Please Specify your location manually");
                break;
            case error.TIMEOUT:
                alertLocation("The request to get user location timed out. " +
                    "Please Specify your location manually.");
                break;
            case error.UNKNOWN_ERROR:
                alertLocation("An unknown error occurred. Please Specify your location manually.");
                break;
        }
    }

    //alert if geolocation is failed
    function alertLocation(message){
        $('#input_info').addClass("alert alert-danger");
        $('#input_info').text(message);
        $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");
    }

})