/**
 * Created by gusis on 4/2/2016.
 * Last modified: 4/5/2016
 */
$(document).ready(function() {
    //initialise base url for ajax request
    var baseUrl = window.location.protocol + "//" + window.location.host + "/Ajax/";
    //var baseUrl = "http://localhost/index.php/Ajax/";

    //variable to check whether it is in distance mode or activity mode
    var displayMode = $('#display_mode').val();

    //variables to store forest data
    var forestData = [];
    var forestDataTable = [];

    //variables to store sites data
    var siteData = [];
    var siteDataTable = [];

    //variables initialisation to create map and marker(s)
    var map = null;
    var markers = [];
    var infoWindow = new google.maps.InfoWindow();

    //array for activities
    var actArray = [];

    //initialitation for slider
    initRangeSlider(0);

    //detect user current location
    window.detectLocation = function(){
        getLocation();
    }

    //get estimated current location using HTML5 geolocoation
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(autogeoSetup, errorInfo);
        } else {
            html = '<div class="alert alert-danger">Geolocation is not supported by this browser. Please Specify your location manually.</div>';
            $('#input_info').html(html);
            $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");
        }
    }

    //initial setup for the page using html5 geolocation
    function autogeoSetup(position)
    {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        //initiate estimate address and show it in the page
        estimateAddress(latitude,longitude);

        //store data inside hidden input tag
        $("#latitude").val(latitude);
        $("#longitude").val(longitude);

        //set the button and initialise map
        setupButton(latitude,longitude);
    }

    function errorInfo(error){
        switch(error.code)
        {
            case error.PERMISSION_DENIED:
                html = '<div class="alert alert-danger">User denied the request for Geolocation. Please Specify your location manually.</div>';
                $('#input_info').html(html);
                $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");
                break;
            case error.POSITION_UNAVAILABLE:
                html = '<div class="alert alert-danger">Location information is unavailable. Please Specify your location manually.</div>';
                $('#input_info').html(html);
                $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");
                break;
            case error.TIMEOUT:
                html = '<div class="alert alert-danger">The request to get user location timed out. Please Specify your location manually.</div>';
                $('#input_info').html(html);
                $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");
                break;
            case error.UNKNOWN_ERROR:
                html = '<div class="alert alert-danger">An unknown error occurred. Please Specify your location manually.</div>';
                $('#input_info').html(html);
                $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");
                break;
        }
    }

    //ajax function to set button for distance(slider) or activity(activity buttons)
    function setupButton(latitude,longitude){
        var selectedUnit = $("select#unit option:selected").val();

        if (displayMode == 'distance')
        {
            //initialise slider
            $.ajax({
                type: "POST",
                url: baseUrl +"get_max_distances",
                dataType: 'text',
                data: {latitude: latitude, longitude: longitude,
                    unit: selectedUnit
                },
                success: function (data) {
                    if (data) {
                        //update slider button
                        updateRangeSlider(data);

                        //show map and table data
                        displayDataDistance(data);

                        //initiate max distance hidden input tag
                        $("#max_distance").val(data);
                    }
                    else {
                        updateRangeSlider(0);
                        displayDataDistance(0);
                        $("#max_distance").val(0);
                    }
                }
            });
        }
        else if (displayMode == 'activity')
        {
            //initalise activity buttons
            //initialise map
            addMap(latitude,longitude);

            //add position marker
            addMarker(latitude,longitude,'<b>You are here!</b>');
            $('#activity_button_list').html('');
            $.ajax({
                type: "POST",
                url: baseUrl +"get_activities",
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        $.each(data, function (index, oneRecord){
                            var innerHtml = '<div class="col-sm-1">' +
                                '<img src="../../assets/img/buttons/' +oneRecord.activity_id +'.png" alt="'
                                + oneRecord.activity_name + '" onclick="displayDataActivity(this)"' +
                                'class="img-responsive" id="' + oneRecord.activity_id + '" />' +
                                '<br />' + oneRecord.activity_name + '</div>';
                            $('#activity_button_list').append(innerHtml);
                        });
                        $('#f_table_container').html('<table id="f_table" class="table table-striped"' +
                            'cellspacing="0" width="100%"></table>');
                        $("#f_table").html('<tr><td colspan="4"><div class="notif-background">' +
                            'No activities selected.</div></td></tr>');
                    }
                    else {
                        $('#activity_button_list').innerHTML = "Button icons cannot be displayed!";
                    }
                }
            });
        }
    }

    //function to add map with event listener
    function addMap(latitude, longitude)
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

    //function to respond to user click
    window.mapLocate = function (i) {
        google.maps.event.trigger(markers[i], 'click');
        //map.setZoom(12);
        map.setCenter(markers[i].getPosition());
    };

    //initialise slider
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
        //$r[0].value = maxValue;
        $r.attr({"max": maxValue});
        $r.rangeslider('update', true);
        $r.val(maxValue).change();
    }

    //respond to change unit
    $("select#unit").change(function () {
        var latitude = $("#latitude").val();
        var longitude = $("#longitude").val();

        setupButton(latitude,longitude);
    });

    //respond to side bar
    function displayDataDistance(distance)
    {
        var unit = $("select#unit option:selected").val();
        var unitText = $("select#unit option:selected").text();
        var latitude = $("input#latitude").val();
        var longitude = $("input#longitude").val();

        //initialise map
        addMap(latitude,longitude);

        //add position marker
        addMarker(latitude,longitude,'<b>You are here!</b>');

        //get the data from controller
        $.ajax({
            type: "POST",
            url: baseUrl +"get_forests/distance",
            dataType: 'json',
            data: {distance: distance, unit: unit, latitude: latitude, longitude: longitude},
            success: function (data) {
                if (data) {
                    forestData= [];
                    forestDataTable = [];
                    markers = [];

                    //create circle marker
                    var $r = $('input[type=range]');
                    var boundary = 0;
                    var maxBoundary = 0;
                    if (unit == 'K')
                    {
                        boundary = 1000 * $r[0].value; //convert to meter
                        maxBoundary = 1000 * $r.attr('max'); //convert to meter
                    }
                    if (unit == 'M')
                    {
                        boundary = 1.60934 * 1000 * $r[0].value; //convert to meter
                        maxBoundary = 1.60934 * 1000 * $r.attr('max'); //convert to meter
                    }
                    var setRadius = 0;
                    if (boundary > maxBoundary) {
                        setRadius = maxBoundary;
                    }
                    else {
                        setRadius = boundary;
                    }
                    setRadius = parseInt(setRadius);
                    var theRadius = new google.maps.Circle({
                        center: new google.maps.LatLng(latitude, longitude),
                        radius: setRadius,
                        strokeOpacity: 0.8,
                        strokeWeight: 1,
                        fillOpacity: 0.1
                    });
                    theRadius.setMap(map);

                    //initialise map boundary
                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(new google.maps.LatLng(latitude, longitude));

                    //store the data and add marker
                    var count = 0;
                    var forestInfo = '';
                    $.each(data, function (index, oneRecord) {
                        bounds.extend(new google.maps.LatLng(oneRecord.latitude, oneRecord.longitude));

                        forestInfo = '<p><b>' + oneRecord.name + '</b></p>' +
                            '<p>' + oneRecord.description + '</p>';

                        for(var i = 0; i < oneRecord.activities.length; i++)
                        {
                            forestInfo += '<img src="../../assets/img/buttons/' + oneRecord.activities[i].activity_id +
                                '.png" height="25px" width="25px" />&nbsp;';
                        }

                        var marker = addMarker(oneRecord.latitude, oneRecord.longitude,
                            forestInfo,'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' +
                            (count + 1) + '|7CC37C|000000');

                        markers.push(marker);

                        map.fitBounds(bounds);

                        forestInfo = '<p><b>' + oneRecord.name + '</b></p>' +
                            '<p><a href="javascript:getSites(' + (markers.length - 1) + ')">Recreation sites</a>&nbsp;&nbsp;' +
                            '|&nbsp;&nbsp;Locate Me:&nbsp;<a onclick="javascript:mapLocate(' + (markers.length - 1) + ')" href="#map">' +
                            '<img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' +
                            (count + 1) + '|7CC37C|000000" /></a></p>';

                        for(var i = 0; i < oneRecord.activities.length; i++)
                        {
                            forestInfo += '<img src="../../assets/img/buttons/' + oneRecord.activities[i].activity_id +
                                '.png" height="25px" width="25px" />&nbsp;';
                        }


                        forestDataTable.push([forestInfo, oneRecord.distance]);
                        forestData.push({id: oneRecord.id, name: oneRecord.name,
                            latitude: oneRecord.latitude, longitude: oneRecord.longitude, description: oneRecord.description,
                            distance: oneRecord.distance});
                        count++;
                    });

                    //show forests data in table
                    $('#f_table').DataTable({
                        destroy: true,
                        data: forestDataTable,
                        columns: [
                            {title: '<div class="green-font">Forest Name</div>'},
                            {title: '<div class="green-font">Distance (' + unitText + ')</div>'}
                        ],
                        "pagingType": "simple",
                        "lengthMenu": [3, 5],
                        "dom": "<'row'<'col-sm-12'l>><'row'<'col-sm-12'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>"
                    });
                }
                else {
                    $('#f_table_container').html('<table id="f_table" class="table table-striped"' +
                        'cellspacing="0" width="100%"></table>');
                    $("#f_table").html('<tr><td colspan="4"><div class="notif-background">No forest within ' +
                        distance + ' ' + $("select#unit option:selected").text() + '</div></td></tr>');
                }
            }
        });
    }

    //accepting forest ID to get sites
    window.getSites = function (i) {
        //re-center the map and show info window for the forest
        google.maps.event.trigger(markers[i], 'click');
        map.setZoom(12);
        map.setCenter(markers[i].getPosition());

        //console.log("index: " + i);
        var unit = '';
        var unitText = '';
        if(displayMode == 'distance')
        {
            //disable slider
            var $r = $('input[type=range]');
            $r.prop('disabled', true);
            $r.rangeslider('update',true);

            //disable unit dropdown (km or mile)
            $('#unit').prop('disabled', true);
        }

        if(displayMode == 'activity')
        {
            //disable activity buttons
            $('#activity_button_list').css('pointer-events','none');
            $('#activity_button_list').css('color','grey');

        }

        unit = $("select#unit option:selected").val();
        unitText = $("select#unit option:selected").text();

        var htmlContent = '<h6><b>' + forestData[i].name + '</b>&nbsp;(distance: ' + forestData[i].distance + ' ' + unitText + ')</h6>' +
            '<p>' + forestData[i].description + '</p>' +
            '<p><button class="btn btn-success" onclick="backToForest()">Go Back to forests location</button></p>';

        $('#aforest_container').html(htmlContent);
        $('#aforest_container').show();
        $('#f_table_container').hide('slow');

        //re-initiate the map
        markers = [];
        siteData = [];
        siteDataTable = [];

        var latitude = forestData[i].latitude;
        var longitude = forestData[i].longitude;

        addMap(latitude,longitude);

        var marker = addMarker(latitude,longitude,forestData[i].name,
            'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' +
            (i + 1) + '|7CC37C|000000');
        markers.push(marker);

        //
        $.ajax({
            type: "POST",
            url: baseUrl + "get_sites",
            dataType: 'json',
            data: {
                forest_id: forestData[i].id,
                unit: unit,
                latitude: $("input#latitude").val(),
                longitude: $("input#longitude").val()
            },
            success: function (data) {
                if (data) {
                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(new google.maps.LatLng(latitude, longitude));
                    var count = 0;
                    var siteInfo = '';
                    $.each(data, function (index, oneRecord) {
                        bounds.extend(new google.maps.LatLng(oneRecord.latitude, oneRecord.longitude));
                        siteInfo = '<p><b>' + oneRecord.site_name + '</b></p>' +
                            '<p>' + oneRecord.description + '</p>' +
                            '<p><a href="http://maps.google.com/maps?saddr=-37.9361409,145.12104109999999&daddr=' +
                            oneRecord.latitude + ',' + oneRecord.longitude + '" target="_blank" >Get direction</a></p>';

                        var marker = addMarker(oneRecord.latitude, oneRecord.longitude,
                            siteInfo,'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' +
                            (count + 1) + '|FFDE00|000000');

                        markers.push(marker);

                        map.fitBounds(bounds);

                        siteInfo = '<p><b>' + oneRecord.site_name + '</b></p>' +
                            '<p>Locate Me:&nbsp;<a onclick="javascript:mapLocate(' + (markers.length - 1) + ')" href="#map">' +
                            '<img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' +
                            (count + 1) + '|FFDE00|000000" /></a></p>' +
                            '<p><a href="http://maps.google.com/maps?saddr=-37.9361409,145.12104109999999&daddr=' +
                            oneRecord.latitude + ',' + oneRecord.longitude + '" target="_blank" >Get direction</a></p>';
                        siteDataTable.push([siteInfo, oneRecord.distance]);

                        siteData.push({id: oneRecord.site_id, name: oneRecord.site_name,
                            latitude: oneRecord.latitude, longitude: oneRecord.longitude,
                            description: oneRecord.description, distance: oneRecord.distance});
                        count++;
                    });
                    //show sites data in table
                    $('#s_table').DataTable({
                        destroy: true,
                        data: siteDataTable,
                        columns: [
                            {title: '<div class="green-font">Site Name</div>'},
                            {title: '<div class="green-font">Distance (' + unitText + ')</div>'}
                        ],
                        "pagingType": "simple",
                        "lengthMenu": [3, 5],
                        "dom": "<'row'<'col-sm-12'l>><'row'<'col-sm-12'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>"
                    });
                    $('#s_table_container').show('slow');
                }
                else {
                    $("#s_table").html('<tr><td colspan="4"><div class="notif-background">No sites available for ' +
                        forestData[i].name + '</div></td></tr>');
                    $('#s_table_container').show('slow');
                }
            }
        });
    }

    //go back to forest when in site mode
    window.backToForest = function () {
        //alert("Go back to forest");
        if (displayMode == 'distance')
        {
            //enable slider
            var $r = $('input[type=range]');
            $r.prop('disabled', false);
            $r.rangeslider('update',true);

            //enable unit dropdown (km or mile)
            $('#unit').prop('disabled', false);
        }

        if (displayMode == 'activity')
        {
            //enable button
            $('#activity_button_list').css('pointer-events','auto');
            $('#activity_button_list').css('color','');
        }

        unit = $("select#unit option:selected").val();
        unitText = $("select#unit option:selected").text();

        $('#aforest_container').hide('slow');
        $('#s_table_container').hide('slow');
        $('#f_table_container').show('slow');

        var latitude = $("input#latitude").val();
        var longitude = $("input#longitude").val();
        markers = [];

        //intialise map
        addMap(latitude,longitude);

        if (displayMode == 'distance')
        {
            //create circle marker
            var $r = $('input[type=range]');
            var boundary = 0;
            var maxBoundary = 0;
            if (unit == 'K')
            {
                boundary = 1000 * $r[0].value; //convert to meter
                maxBoundary = 1000 * $r.attr('max'); //convert to meter
            }
            if (unit == 'M')
            {
                boundary = 1.60934 * 1000 * $r[0].value; //convert to meter
                maxBoundary = 1.60934 * 1000 * $r.attr('max'); //convert to meter
            }
            var setRadius = 0;
            if (boundary > maxBoundary) {
                setRadius = maxBoundary;
            }
            else {
                setRadius = boundary;
            }
            setRadius = parseInt(setRadius);
            var theRadius = new google.maps.Circle({
                center: new google.maps.LatLng(latitude, longitude),
                radius: setRadius,
                strokeOpacity: 0.8,
                strokeWeight: 1,
                fillOpacity: 0.1
            });
            theRadius.setMap(map);
        }
        //add position marker
        addMarker(latitude,longitude,'<b>You are here!</b>');

        var bounds = new google.maps.LatLngBounds();
        bounds.extend(new google.maps.LatLng(latitude, longitude));

        //add marker to the map
        for (var i = 0; i < forestData.length; i++)
        {
            bounds.extend(new google.maps.LatLng(forestData[i].latitude, forestData[i].longitude));
            var marker = addMarker(forestData[i].latitude, forestData[i].longitude,
                forestData[i].name,'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' +
                (i + 1) + '|7CC37C|000000');
            markers.push(marker);
            map.fitBounds(bounds);
        }
    }

    //respond to activity button click
    window.displayDataActivity = function(el)
    {
        //alert(el.alt);
        if(el.src.match('_active'))
        {
            el.src = '../../assets/img/buttons/' + el.id + '.png';
            var i = actArray.indexOf(el.id);
            if(i != -1) {
                actArray.splice(i, 1);
            }
            //alert(actArray.toString());
        } else
        {
            el.src = '../../assets/img/buttons/' + el.id + '_active.png';
            actArray.push(el.id);
            //alert(actArray.toString());
        }
        if(actArray.length > 0)
        {
            respondActivity(actArray);
        }
        if(actArray.length <= 0)
        {
            addMap($("input#latitude").val(), $("input#longitude").val());
            addMarker($("input#latitude").val(), $("input#longitude").val(),'<b>You are here!</b>');
            $('#f_table_container').html('<table id="f_table" class="table table-striped"' +
                'cellspacing="0" width="100%"></table>');
            $("#f_table").html('<tr><td colspan="4"><div class="notif-background">No forest for selected activities' +
                '</div></td></tr>');
        }
    }

    //respond to activity button
    function respondActivity(activities)
    {
        //var unit = 'K';
        //var unitText = 'Km';
        unit = $("select#unit option:selected").val();
        unitText = $("select#unit option:selected").text();
        var latitude = $("input#latitude").val();
        var longitude = $("input#longitude").val();
        //get the data from controller
        $.ajax({
            type: "POST",
            url: baseUrl +"get_forests/activity",
            dataType: 'json',
            data: {unit: unit, latitude: latitude, longitude: longitude, activities: activities},
            success: function (data) {
                if (data) {
                    forestData= [];
                    forestDataTable = [];
                    markers = [];

                    //intialise map
                    addMap(latitude,longitude);

                    //add position marker
                    addMarker(latitude,longitude,'<b>You are here!</b>');

                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(new google.maps.LatLng(latitude, longitude));

                    //store the data and add marker
                    var count = 0;
                    var forestInfo = '';
                    $.each(data, function (index, oneRecord) {
                        bounds.extend(new google.maps.LatLng(oneRecord.latitude, oneRecord.longitude));

                        forestInfo = '<p><b>' + oneRecord.name + '</b></p>' +
                            '<p>' + oneRecord.description + '</p>';

                        for(var i = 0; i < oneRecord.activities.length; i++)
                        {
                            forestInfo += '<img src="../../assets/img/buttons/' + oneRecord.activities[i].activity_id +
                                '.png" height="25px" width="25px" />&nbsp;';
                        }

                        var marker = addMarker(oneRecord.latitude, oneRecord.longitude,
                            forestInfo,'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' +
                            (count + 1) + '|7CC37C|000000');

                        markers.push(marker);

                        map.fitBounds(bounds);

                        forestInfo = '<p><b>' + oneRecord.name + '</b></p>' +
                            '<p><a href="javascript:getSites(' + (markers.length - 1) + ')">Recreation sites</a>&nbsp;&nbsp;' +
                            '|&nbsp;&nbsp;Locate Me:&nbsp;<a onclick="javascript:mapLocate(' + (markers.length - 1) + ')" href="#map">' +
                            '<img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' +
                            (count + 1) + '|7CC37C|000000" /></a></p>';

                        for(var i = 0; i < oneRecord.activities.length; i++)
                        {
                            forestInfo += '<img src="../../assets/img/buttons/' + oneRecord.activities[i].activity_id +
                                '.png" height="25px" width="25px" />&nbsp;';
                        }

                        forestDataTable.push([forestInfo, oneRecord.distance]);

                        forestData.push({id: oneRecord.id, name: oneRecord.name,
                            latitude: oneRecord.latitude, longitude: oneRecord.longitude, description: oneRecord.description,
                            distance: oneRecord.distance});
                        count++;
                    });

                    //show forests data in table
                    $('#f_table').DataTable({
                        destroy: true,
                        data: forestDataTable,
                        columns: [
                            {title: '<div class="green-font">Forest Name</div>'},
                            {title: '<div class="green-font">Distance (' + unitText + ')</div>'}
                        ],
                        "pagingType": "simple",
                        "lengthMenu": [3, 5],
                        "dom": "<'row'<'col-sm-12'l>><'row'<'col-sm-12'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>"
                    });
                }
                else {
                    //initialise map
                    addMap(latitude,longitude);

                    //add position marker
                    addMarker(latitude,longitude,'<b>You are here!</b>');

                    $('#f_table_container').html('<table id="f_table" class="table table-striped"' +
                        'cellspacing="0" width="100%"></table>');
                    $("#f_table").html('<tr><td colspan="4"><div class="notif-background">No forest for selected activities' +
                        '</div></td></tr>');
                }
            }
        });
        //alert("end of response");
    }

    /*
     $('#activity_button_list').on('mouseenter','.activity_button',function (e) {
     if(!e.target.src.match('_active'))
     {
     e.target.src = '../../assets/img/buttons/' + e.target.id + '_active.png';
     }
     })
     $('#activity_button_list').on('mouseleave','.activity_button',function (e) {
     if(e.target.src.match('_active'))
     {
     e.target.src = '../../assets/img/buttons/' + e.target.id + '_active.png';
     }
     });*/
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
            html = '<div class="alert alert-danger">Location can\'t be found. Please select from the list.</div>';
            $('#input_info').html(html);
            $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");
        }
        if(place.address_components)
        {
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (addressType == 'administrative_area_level_1') {
                    var val = place.address_components[i][componentForm[addressType]];
                    if(val == 'VIC')
                    {
                        //Selected adress is inside Victoria
                        html = '<div class="alert alert-success"> Your selected location:<br /><strong> ' + place.formatted_address + '<strong></div>';
                        $('#input_info').html(html);
                        $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");

                        //get the latitude and longitude data of location
                        $("#latitude").val(place.geometry.location.lat());
                        $("#longitude").val(place.geometry.location.lng());

                        var latitude = $("#latitude").val();
                        var longitude = $("#longitude").val();

                        //set the button and initialise map and table
                        setupButton(latitude,longitude);

                        return;
                    }
                    else if(val != 'VIC'|| !val)
                    {
                        //Selected adress outside Victoria
                        html = '<div class="alert alert-warning">Currently, doesn\'t support area outside Victoria.<br /> Please select address inside Victoria.</div>';
                        $('#input_info').html(html);
                        $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");

                        return;
                    }
                }
            }
        }
    }

    function estimateAddress(latitude,longitude){
        $.ajax({
            type: "GET",
            url: "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + latitude + "," + longitude,
            dataType: 'json',
            success: function (data) {
                if (data) {
                    html = '<div class="alert alert-success"> Your estimated current location:<br /><strong>' +
                        data.results[1].formatted_address + '</strong></div>';
                    $('#input_info').html(html);
                    $('#input_info').show().animate({opacity: '0.5'},"fast").animate({opacity: '1'},"fast");
                }
            }
        });
    }
    if (displayMode == "distance" || displayMode == "activity"){
        initAutocomplete();
        //getLocation();
        $("#input_loc").addClear();
    }
});