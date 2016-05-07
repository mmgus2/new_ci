/**
 * Created by gusis on 5/6/2016.
 */
$(document).ready(function() {
    //initialise base url for ajax request
    var baseUrl = window.location.protocol + "//" + window.location.host + "/";
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
    var theRadius = null;

    //array for selected activity
    var selectedActivity = [];

    //variable to store distance value (current and max distance)
    var distance = 0;
    var maxDistance = 0;

    //variable to store user current position
    var userLatitude = 0;
    var userLongitude = 0;

    //initialise object for forest image list (using list.js library)
    initialiseForestList();




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
    window.initAutocomplete = function () {
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
                        //store user location
                        userLatitude = place.geometry.location.lat();
                        userLongitude = place.geometry.location.lng();

                        //initiate selected address and show it in the page
                        informLocation("Your selected location:&nbsp;",place.formatted_address);

                        //set max distance data
                        setMaxDistance(userLatitude,userLongitude);

                        //set initial distance value to 0
                        distance = 0;

                        //update slider max value
                        updateRangeSlider(maxDistance);

                        //set slider value to 0
                        setRangeSliderVal(0);

                        //clear activity and reset activity button - LATER


                        //initialise map with user estimated location and add marker
                        createMap(userLatitude,userLongitude);
                        addMarker(userLatitude,userLongitude,'<b>You select this location!</b>');

                        enableMenu();
                        scrollToMap();

                        return;
                    }
                    else if(val != 'VIC'|| !val)
                    {
                        //Selected adress outside Victoria
                        alertLocation("Currently, the site doesn't support area outside Victoria. " +
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

        //store user location data
        userLatitude = latitude;
        userLongitude = longitude;

        //initiate estimate address and show it in the page
        estimateAddress(latitude,longitude);

        //set max distance data
        setMaxDistance(latitude,longitude);

        //initialise map with user estimated location and add marker
        createMap(latitude,longitude);
        addMarker(latitude,longitude,'<b>Your estimated location!</b>');

        enableMenu();
        scrollToMap();
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
        $('#input_info').removeClass();
        $('#input_info').addClass("alert alert-success");
        html = message + '<strong>' + address + '</strong>';
        $('#input_info').html(html);
        $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");
    }

    //set max distance data
    function setMaxDistance(latitude,longitude){
        var selectedUnit = $("select#unit option:selected").val();
        //initialise slider
        $.ajax({
            type: "POST",
            url: baseUrl +"Ajax_response/get_max_distance",
            dataType: 'text',
            data: {latitude: latitude,longitude: longitude,unit: selectedUnit},
            success: function (data) {
                if (data) {
                    //store max distance data
                    maxDistance = data;

                    //update range slider max value
                    updateRangeSlider(data);
                }
            }
        });
    }

    //function to set map with event listener
    function createMap(latitude, longitude)
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
    window.initRangeSlider = function (maxValue)
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
                displayForest(this.value);
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
        //$r.val(maxValue).change();
    }

    function setRangeSliderVal(value){
        var $r = $('input[type=range]');
        $r.val(value).change();
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
        $('#input_info').removeClass();
        $('#input_info').addClass("alert alert-danger");
        $('#input_info').text(message);
        $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");
    }

    //function that respond to activity button
    window.acceptActivity = function(el)
    {
        if(distance == 0){
            setRangeSliderVal(maxDistance);
            distance = maxDistance;
        } else {
            setRangeSliderVal(distance);
        }

        //alert(el.alt);
        if(el.src.match('_active')){
            el.src = '../../assets/img/buttons/' + el.id + '.png';
            var i = selectedActivity.indexOf(el.id);
            if(i != -1) {
                selectedActivity.splice(i, 1);
            }
        } else {
            el.src = '../../assets/img/buttons/' + el.id + '_active.png';
            selectedActivity.push(el.id);
        }
        if(selectedActivity.length > 0)
        {
            displayForest(selectedActivity);
        }
        if(selectedActivity.length <= 0)
        {
            displayForest(distance);
        }
    }

    //display forest marker on the map and on the image list
    function displayForest(variable){
        //get the selected unit
        var unit = $("select#unit option:selected").val();

        //data for ajax request
        var data = null;

        if (!isArray(variable)) {//if the variable is distance (number)
            //store the distance data
            distance = variable;
        }

        if(selectedActivity.length > 0){
            data = {distance: distance, unit: unit, latitude: userLatitude,
                longitude: userLongitude, activity: selectedActivity}
        }

        if(selectedActivity.length <= 0){
            data = {distance: distance, unit: unit, latitude: userLatitude, longitude: userLongitude}
        }

        $.ajax({
            type: "POST",
            url: baseUrl + "Ajax_response/get_forest",
            dataType: 'json',
            data: data,
            success: function (data) {
                forestData = [];
                $.each(data, function (index, record) {
                    var forest = new Forest();
                    forest.setId(record.id).setName(record.name).setLatitude(record.latitude)
                        .setLongitude(record.longitude).setDescription(record.description)
                        .setDistance(record.distance);
                    for(var i = 0; i < record.activity.length; i++){
                        forest.addActivity(record.activity[i]);
                    }
                    forestData.push(forest);
                })
            },
            complete: function(jqXHR, status){
                if(status == 'success'){
                    //draw on map
                    drawMapMarker(forestData,"forest",null);
                    scrollToMap();

                    //show forest image list
                    showForestImage();

                }
            }
        })
    }

    //function to check wether the variable is array
    function isArray(x) {
        return x.constructor.toString().indexOf("Array") > -1;
    }

    function drawMapMarker(data,type,aMarker){
        //get the selected unit
        var unit = $("select#unit option:selected").val();
        var unitText = $("select#unit option:selected").text();

        //initialise center map
        var latitude = 0;
        var longitude = 0;

        //remove previous marker(s) (if any)
        for(var i = 0; i < markers.length; i++){
            markers[i].setMap(null);
        }

        //remove polyline (if any)
        if(theRadius){
            theRadius.setMap(null);
        }

        //clean the markers array
        markers = [];

        if (type == "forest"){
            latitude = userLatitude;
            longitude = userLongitude;
            //create circle marker
            var boundary = 0;
            var maxBoundary = 0;
            if (unit == 'K')
            {
                boundary = 1000 * distance; //convert to meter
                maxBoundary = 1000 * maxDistance; //convert to meter
            }
            if (unit == 'M')
            {
                boundary = 1.60934 * 1000 * distance; //convert to meter
                maxBoundary = 1.60934 * 1000 * maxDistance; //convert to meter
            }
            var setRadius = 0;
            if (boundary > maxBoundary) {
                setRadius = maxBoundary;
            }
            else {
                setRadius = boundary;
            }
            setRadius = parseInt(setRadius);
            theRadius = new google.maps.Circle({
                center: new google.maps.LatLng(latitude,longitude),
                radius: setRadius,
                strokeOpacity: 0.8,
                strokeWeight: 1,
                fillOpacity: 0.1
            });
            theRadius.setMap(map);
        }

        if(type == "site"){
            latitude = aMarker.latitude;
            longitude = aMarker.longitude;
        }
        //initialise map boundary
        var bounds = new google.maps.LatLngBounds();
        bounds.extend(new google.maps.LatLng(latitude,longitude));
        for(var i = 0; i < data.length; i++){
            bounds.extend(new google.maps.LatLng(data[i].latitude, data[i].longitude));

            popupInfo = '<p><strong>' + data[i].name + '</strong></p>' +
                '<p>' + data[i].description + '</p>';

            popupInfo += '<p>';
            for(var j = 0; j < data[i].activity.length; j++)
            {
                popupInfo += '<img src="../../assets/img/buttons/' + data[i].activity[j].activity_id + '.png" ' +
                                  'height="25px" width="25px" />&nbsp;';
            }
            popupInfo += '</p>';

            if (type == 'forest'){
                popupInfo += '<p><div class="btn-group btn-group-justified">';
                popupInfo += '<a href="javascript:getSites(' + i + ')" class="btn btn-success">Recreation Site</a>';
                popupInfo += '<a href="' + baseUrl  + 'review/' + data[i].id + '" class="btn btn-success">Review</a>';
                popupInfo += '</div></p>';
            }

            if (type == 'site'){
                /*popupInfo += '<p><a href="http://maps.google.com/maps?saddr=' + userLatitude + ',' + userLongitude +
                    '&daddr=' +  data[i].latitude + ',' +  data[i].longitude +
                    '" target="_blank" class="btn btn-success">Get direction</a></p>'*/
                popupInfo += '<p><button class="btn btn-success" ' +
                    'onclick="getDirection(' + userLatitude + ',' + userLongitude + ',' +
                                            data[i].latitude + ',' +  data[i].longitude +')">' +
                    'Get Direction</button></p>';
            }

            var marker_link = '';
            if(type == 'forest'){
                marker_link = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + (i + 1) +
                    '|7CC37C|000000';
            }

            if(type == 'site'){
                marker_link = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + (i + 1) +
                    '|FFDE00|000000';
            }

            var marker = addMarker(data[i].latitude, data[i].longitude,
                popupInfo,marker_link);

            markers.push(marker);

            map.fitBounds(bounds);
        }
    }

    //function to store get direction in iframe
    window.getDirection = function(srcLat,srcLng,destLat,destLng){
        $('#iframe').attr("src",'http://maps.google.com/maps?saddr=' + srcLat + ',' + srcLng +
        '&daddr=' +  destLat + ',' +  destLng);
        $('#iframe_container').show('slow');
    }

    //triggered when unit is changed
    $("select#unit").change(function () {

        //set max distance data
        setMaxDistance(userLatitude,userLongitude);

        //update slider max value
        updateRangeSlider(maxDistance);

        //set initial distance value to 0
        distance = 0;

        //set slider value to 0
        setRangeSliderVal(0);

        //clear activity and reset activity button - LATER

        //remove previous marker(s) (if any)
        for(var i = 0; i < markers.length; i++){
            markers[i].setMap(null);
        }

        //remove polyline (if any)
        if(theRadius){
            theRadius.setMap(null);
        }

        //clean / randomise the image list ?? -- IMPLEMENT LATER
    });

    //get site from specific forest
    window.getSites = function (i) {
        //re-center the map and show info window for the forest
        google.maps.event.trigger(markers[i], 'click');
        map.setZoom(12);
        map.setCenter(markers[i].getPosition());

        var unit = $("select#unit option:selected").val();
        var unitText = $("select#unit option:selected").text();

        //disable the menu
        disableMenu();

        //hide the menu
        $('#menu_container').hide('slow');

        //show the return to forest button
        $('#return_forest').show('slow');

        addMarker(forestData[i].latitude,forestData[i].longitude,forestData[i].name,
            'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' +
            (i + 1) + '|7CC37C|000000');

        $.ajax({
            type: "POST",
            url: baseUrl + "Ajax_response/get_site",
            dataType: 'json',
            data: {
                forest_id: forestData[i].id,
                unit: unit,
                latitude: userLatitude,
                longitude: userLongitude
            },
            success: function (data) {
                if (data) {
                    $.each(data, function (index, record) {
                        var site = new Site();
                        site.setId(record.id).setName(record.name).setLatitude(record.latitude)
                            .setLongitude(record.longitude).setDescription(record.description)
                            .setDistance(record.distance).setDescLink(record.desc_link);
                        for(var i = 0; i < record.activity.length; i++){
                            site.addActivity(record.activity[i]);
                        }
                        siteData.push(site);
                    })
                }
            },
            complete: function(jqXHR, status){
                if(status == 'success'){
                    //draw on map
                    drawMapMarker(siteData,"site",forestData[i]);
                    scrollToMap();
                    //populate the list

                }
            }
        })
    }

    window.backToForest = function () {
        enableMenu();
        $('#return_forest').hide('slow');
        $('#menu_container').show('slow');
        drawMapMarker(forestData,'forest',null);
        scrollToMap();
    }

    function enableMenu(){
        //enable autocomplete
        $('#input_loc').attr('disabled',false);

        //enable slider
        var $r = $('input[type=range]');
        $r.prop('disabled', false);
        $r.rangeslider('update',true);

        //enable select unit dropdown
        $("select#unit").attr("disabled",false);

        //enable activity button list
        $('#activity_button_list').css('pointer-events','auto');
        $('#activity_button_list').css('color','');
    }

    function disableMenu(){
        //disable autocomplete
        $('#input_loc').attr('disabled',true);

        //disable slider
        var $r = $('input[type=range]');
        $r.prop('disabled', true);
        $r.rangeslider('update', true);

        //disable unit dropdown (km or mile)
        $('#unit').prop('disabled', true);

        //disable activity buttons
        $('#activity_button_list').css('pointer-events', 'none');
        $('#activity_button_list').css('color', 'grey');
    }

    //scroll to map section
    function scrollToMap(){
        $('html, body').animate({
            scrollTop: $("#map").offset().top
        }, "slow");
    }

    //show forest image list
    function showForestImage(){
        for(var i = 0; i < forestData.length; i++){
            forestList.add({forest_image:'../../assets/img/forest_images/' + forestData[i].id,
                            forest_alt: forestData[i].name,
                            forest_name: forestData[i].name,
                            forest_id: forestData[i].id
                            });
        }
    }

    //-----------List object initialisation----
    function initialiseForestList(){
        var paginationOptions = {
            name: "pagination",
            paginationClass: "pagination",
            innerWindow: 3,
            left: 2,
            right: 4
        };

        var item = '<div class="col-md-4 col-sm-6 portfolio-item">';
            item +=     '<a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">';
            item +=         '<div class="portfolio-hover">';
            item +=             '<div class="portfolio-hover-content">';
            item +=                 '<i class="fa fa-tree"></i>';
            item +=             '</div>';
            item +=         '</div>';
            item +=         '<img class="img-responsive forest_image forest_alt" src="" alt="">';
            item +=     '</a>';
            item +=     '<div class="portfolio-caption">';
            item +=         '<h4 class="forest_name"></h4>';
            //item +=         '<p class="text-muted">Explore the Activities for the Forest</p>';
            item +=     '</div>';
            item += '</div>';
            item += '<input class="forest_id" type="hidden" value="">';

        var listOptions = {
            valueNames: [ {attr:'src',name:'forest_image'},
                          {attr:'alt',name:'forest_alt'},
                          'forest_name',
                          {attr:'value',name:'forest_id'}
                        ],
            item: item,
            page: 6,
            plugins: [
                ListPagination(paginationOptions)
            ]
        };

        //global initalisation
        forestList = new List('test-list', listOptions);
    }

})