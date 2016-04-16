/**
 * Created by gusis on 4/2/2016.
 */
$(document).ready(function() {
    //initialise base url for ajax request
    //var url = window.location.protocol + "//" + window.location.host + "/Ajax/";
    var url = "http://localhost/index.php/Ajax/";

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

    //detect user current location
    window.detectLocation = function(){
        $.geolocation.get({
                success: initialSetup,
                error: askForPosition
        })
    }

    //initial setup for the page
    function initialSetup(position)
    {
        $("#latitude").val(position.coords.latitude);
        $("#longitude").val(position.coords.longitude);
        initialise(position.coords.latitude, position.coords.longitude);
        $.ajax({
            type: "POST",
            url: url + "get_max_distances",
            dataType: 'text',
            data: {latitude: position.coords.latitude, longitude: position.coords.longitude,
                unit: $("select#unit option:selected").val()},
            success: function (data) {
                if (data) {
                    initRangeSlider(data);
                }
                else {
                    return initRangeSlider(0);
                }
            }
        });
    }

    //function to initialise map with event listener
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
                position: new google.maps.LatLng(latitude, longitude),
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


    //function to initialise the map
    function initialise(initLat, initLong) {
        addMap(initLat, initLong);

        addMarker(initLat,initLong,'<b>You are here!</b>');

        $('#f_table_container').html('<table id="f_table" class="table table-striped table-bordered"' +
            'cellspacing="0" width="100%"></table>');
        $("#f_table").html('<tr><td colspan="4"><div class="alert-warning">No forest within 0 ' +
            $("select#unit option:selected").text() + '</div></td></tr>');
    }

    //function to respond to user click
    window.mapLocate = function (i) {
        google.maps.event.trigger(markers[i], 'click');
        map.setZoom(12);
        map.setCenter(markers[i].getPosition());
    };

    //initialise range slider
    function initRangeSlider(maxValue)
    {
        var $r = $('input[type=range]');
        var $handle;
        $r.attr({"max": maxValue});
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
                displayData(this.value);
            }
        });
    }

    function updateHandle(el, val){
        el.textContent = val;
    }

    function askForPosition(error)
    {
        alert("Couldn't detect the position");
    }

    $("select#unit").change(function () {
        markers = [];
        forestDataTable = [];
        var latitude = $("#latitude").val();
        var longitude = $("#longitude").val();
        initialise(latitude, longitude);
        $.ajax({
            type: "POST",
            url: url + "get_max_distances",
            dataType: 'text',
            data: {latitude: latitude, longitude: longitude,
                unit: $("select#unit option:selected").val()},
            success: function (data) {
                if (data) {
                    updateRangeSlider(data);
                }
                else {
                    return updateRangeSlider(0);
                }
            }
        });
    });

    function updateRangeSlider(maxValue) {
        var $r = $('input[type=range]');
        $r[0].value = 0;
        $r.attr({"max": maxValue});

        $r.rangeslider('update', true);
    }


    //respond to side bar
    function displayData(distance)
    {
        var unit = $("select#unit option:selected").val();
        var unitText = $("select#unit option:selected").text();
        var latitude = $("input#latitude").val();
        var longitude = $("input#longitude").val();
        //get the data from controller
        $.ajax({
            type: "POST",
            url: url + "get_forests",
            dataType: 'json',
            data: {distance: distance, unit: unit, latitude: latitude, longitude: longitude},
            success: function (data) {
                if (data) {
                    forestData= [];
                    forestDataTable = [];
                    markers = [];

                    //intialise map
                    addMap(latitude,longitude);

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

                    //add position marker
                    addMarker(latitude,longitude,'<b>You are here!</b>');

                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(new google.maps.LatLng(latitude, longitude));

                    //store the data and add marker
                    $.each(data, function (index, oneRecord) {
                        bounds.extend(new google.maps.LatLng(oneRecord.latitude, oneRecord.longitude));

                        var marker = addMarker(oneRecord.latitude, oneRecord.longitude,
                            oneRecord.forest_name,'http://maps.google.com/mapfiles/ms/icons/green.png');

                        markers.push(marker);

                        map.fitBounds(bounds);

                        forestDataTable.push([oneRecord.forest_name, oneRecord.distance, '<a href="javascript:getSites(' +
                        (markers.length - 1) + ')">details</a>','<a onclick="javascript:mapLocate(' +
                        (markers.length - 1) + ')" href="Distance#map">' +
                            '<img src="http://maps.google.com/mapfiles/ms/icons/green.png" /></a>']);

                        forestData.push({id: oneRecord.forest_id, name: oneRecord.forest_name,
                            latitude: oneRecord.latitude, longitude: oneRecord.longitude,
                            distance: oneRecord.distance});
                    });

                    //show forests data in table
                    $('#f_table').DataTable({
                        destroy: true,
                        data: forestDataTable,
                        columns: [
                            {title: "Forest Name"},
                            {title: 'Distance (' + unitText + ')'},
                            {title: "Recreation sites"},
                            {title: "Map"}
                        ],
                        "columnDefs": [
                            { "orderable": false, "targets": 2 },
                            { "orderable": false, "targets": 3 }
                        ],
                        "pagingType": "simple",
                        "lengthMenu": [5, 10]
                    });
                }
                else {
                    //initialise map
                    addMap(latitude,longitude);

                    //add position marker
                    addMarker(latitude,longitude,'<b>You are here!</b>');

                    $('#f_table_container').html('<table id="f_table" class="table table-striped table-bordered"' +
                    'cellspacing="0" width="100%"></table>');
                    $("#f_table").html('<tr><td colspan="4"><div class="alert-warning">No forest within ' +
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
        //disable slider
        var $r = $('input[type=range]');
        $r.prop('disabled', true);
        $r.rangeslider('update',true);

        //disable unit dropdown (km or mile)
        $('#unit').prop('disabled', true);

        var unit = $("select#unit option:selected").text();
        var htmlContent = '<h6><b>' + forestData[i].name + '</b>' +
                '<i>&nbsp;(distance: ' + forestData[i].distance + ' ' + unit + ')</i></h6>' +
                '<p><i>Put here for description</i></p>' +
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
            'http://maps.google.com/mapfiles/ms/icons/green.png');
        markers.push(marker);

        //
        $.ajax({
            type: "POST",
            url: url + "get_sites",
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

                    $.each(data, function (index, oneRecord) {
                        bounds.extend(new google.maps.LatLng(oneRecord.latitude, oneRecord.longitude));

                        var marker = addMarker(oneRecord.latitude, oneRecord.longitude,
                            oneRecord.site_name,'http://maps.google.com/mapfiles/ms/icons/blue.png');

                        markers.push(marker);

                        map.fitBounds(bounds);

                        siteDataTable.push([oneRecord.site_name, oneRecord.description, oneRecord.distance,
                            '<a onclick="javascript:mapLocate(' +
                        (markers.length - 1) + ')" href="Distance#map">' +
                        '<img src="http://maps.google.com/mapfiles/ms/icons/blue.png" /></a>']);

                        siteData.push({id: oneRecord.site_id, name: oneRecord.site_name,
                            latitude: oneRecord.latitude, longitude: oneRecord.longitude,
                            description: oneRecord.description, distance: oneRecord.distance});
                    });
                    //show sites data in table
                    $('#s_table').DataTable({
                        destroy: true,
                        data: siteDataTable,
                        columns: [
                            {title: "Site Name"},
                            {title: "Site Description"},
                            {title: 'Distance (' + unit + ')'},
                            {title: "Map"}
                        ],
                        "columnDefs": [
                            { "orderable": false, "targets": 2 },
                            { "orderable": false, "targets": 3 }
                        ],
                        "pagingType": "simple",
                        "lengthMenu": [5, 10]
                    });
                    $('#s_table_container').show('slow');
                }
                else {
                    $("#s_table").html('<tr><td colspan="4"><div class="alert-warning">No sites available for ' +
                        forestData[i].name + '</div></td></tr>');
                    $('#s_table_container').show('slow');
                }
            }
        });
    }
    window.backToForest = function () {
        //alert("Go back to forest");

        //enable slider
        var $r = $('input[type=range]');
        $r.prop('disabled', false);
        $r.rangeslider('update',true);

        //enable unit dropdown (km or mile)
        $('#unit').prop('disabled', false);

        $('#aforest_container').hide('slow');
        $('#s_table_container').hide('slow');
        $('#f_table_container').show('slow');

        var unit = $("select#unit option:selected").val();
        var unitText = $("select#unit option:selected").text();
        var latitude = $("input#latitude").val();
        var longitude = $("input#longitude").val();
        markers = [];

        //intialise map
        addMap(latitude,longitude);

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

        //add position marker
        addMarker(latitude,longitude,'<b>You are here!</b>');

        var bounds = new google.maps.LatLngBounds();
        bounds.extend(new google.maps.LatLng(latitude, longitude));

        //add marker to the map
        for (var i = 0; i < forestData.length; i++)
        {
            bounds.extend(new google.maps.LatLng(forestData[i].latitude, forestData[i].longitude));

            var marker = addMarker(forestData[i].latitude, forestData[i].longitude,
                forestData[i].name,'http://maps.google.com/mapfiles/ms/icons/green.png');

            markers.push(marker);

            map.fitBounds(bounds);
        }
    }
});