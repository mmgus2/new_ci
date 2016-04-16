/**
 * Created by gusis on 4/2/2016.
 */
$(document).ready(function() {
    //initialise base url for ajax request
    //var url = "http://xploreforest.azurewebsites.net/Ajax/";
    var url = window.location.protocol + "//" + window.location.host + "/Ajax/";
    //var url = "http://localhost/new_ci/index.php/Ajax/";

    //variables to store data
    var forestData = [];

    //variables initialisation to create map and marker(s)
    var map = null;
    var site_map = null;
    
    var markers = [];
    var site_markers = [];
    
    var forestTableData = [];
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
    //function to initialise the map
    function initialise(initLat, initLong) {
        var mapInit = {
            zoom: 15,
            center: new google.maps.LatLng(initLat, initLong)
        };
        map = new google.maps.Map(document.getElementById("map"), mapInit);

        google.maps.event.addListener(map, 'click', function () {
            infoWindow.close();
        });
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(initLat, initLong)
            //icon: 'http://maps.google.com/mapfiles/ms/icons/green.png'
        });
        marker.setMap(map);
        marker.addListener('click', function () {
            infoWindow.setContent('<b>You are here!</b>');
            infoWindow.open(map, marker);
        });
        /*
        google.maps.event.addListener(marker, 'click', function () {
            infoWindow.setContent('<b>You are here!</b>');
            infoWindow.open(map, marker);
        });
        */
        $('#f_table_container').html('<table id="f_table" class="table table-striped table-bordered"' +
            'cellspacing="0" width="100%"></table>');
        $("#f_table").html('<tr><td colspan="4"><div class="alert-warning">No forest within 0 ' +
            $("select#unit option:selected").text() + '</div></td></tr>');
    }

    //function to respond to user click
    window.forestLocate = function (i) {
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

    //function to add marker on the map and also add html menu
    function addMarker(latitude, longitude, markerTitle, menuTitle, distance, forestID) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude, longitude),
            icon: 'http://maps.google.com/mapfiles/ms/icons/green.png'
        });
        marker.setMap(map);
        marker.addListener('click', function () {
            infoWindow.setContent('<b>' + markerTitle + '</b>');
            infoWindow.open(map, marker);
        });
        /*
        google.maps.event.addListener(marker, 'click', function () {
            infoWindow.setContent('<b>' + markerTitle + '</b>');
            infoWindow.open(map, marker);
        });*/
        markers.push(marker);
        forestTableData.push([menuTitle, distance, '<a href="javascript:getSites(' + forestID + ',' + (markers.length - 1) + ')">details</a>',
            '<a onclick="javascript:forestLocate(' + (markers.length - 1) + ')" href="Distance#map">' +
            '<img src="http://maps.google.com/mapfiles/ms/icons/green.png" /></a>']);

        //document.getElementById("forest_list").innerHTML = html_placeholder;
    }
    $("select#unit").change(function () {
        markers = [];
        forestTableData = [];
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
        jQuery.ajax({
            type: "POST",
            url: url + "get_forests",
            dataType: 'json',
            data: {distance: distance, unit: unit, latitude: latitude, longitude: longitude},
            success: function (data) {
                if (data) {
                    markers = [];
                    forestTableData = [];
                    //document.getElementById("forest_list").innerHTML = '';
                    var mapInit = {
                        zoom: 15,
                        center: new google.maps.LatLng(latitude, longitude)
                    };
                    map = new google.maps.Map(document.getElementById("map"), mapInit);

                    google.maps.event.addListener(map, 'click', function () {
                        infoWindow.close();
                    });
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

                    //alert('boundary: ' + boundary + " ; maxBoundary: " + maxBoundary);
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
                        fillOpacity: 0.4
                    });
                    theRadius.setMap(map);

                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(latitude, longitude)
                        //icon: 'http://maps.google.com/mapfiles/ms/icons/green.png'
                    });
                    marker.setMap(map);
                    google.maps.event.addListener(marker, 'click', function () {
                        infoWindow.setContent('<b>You are here!</b>');
                        infoWindow.open(map, marker);
                    });
                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(new google.maps.LatLng(latitude, longitude));
                    //record max distance
                    $.each(data, function (index, oneRecord) {
                        bounds.extend(new google.maps.LatLng(oneRecord.latitude, oneRecord.longitude));
                        addMarker(oneRecord.latitude, oneRecord.longitude,
                            oneRecord.forest_name, oneRecord.forest_name, oneRecord.distance, oneRecord.forest_id);
                        forestData.push([oneRecord.forest_id, oneRecord.forest_name,
                                         oneRecord.latitude, oneRecord.longitude, oneRecord.distance]);
                        map.fitBounds(bounds);
                    });
                    $('#f_table').DataTable({
                        destroy: true,
                        data: forestTableData,
                        columns: [
                            {title: "Forest Name"},
                            {title: 'Distance (' + unitText + ')'},
                            {title: "Recreation sites"},
                            {title: "Map"}
                        ],
                        "columnDefs": [
                            { "orderable": false, "targets": 2 },
                            { "orderable": false, "targets": 3 },
                        ],
                        "pagingType": "simple",
                        "lengthMenu": [5, 10]
                    });
                }
                else {
                    //html_placeholder = [];
                    var mapInit = {
                        zoom: 15,
                        center: new google.maps.LatLng(latitude, longitude)
                    };
                    map = new google.maps.Map(document.getElementById("map"), mapInit);

                    google.maps.event.addListener(map, 'click', function () {
                        infoWindow.close();
                    });
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(latitude, longitude)
                        //icon: 'http://maps.google.com/mapfiles/ms/icons/green.png'
                    });
                    marker.setMap(map);
                    google.maps.event.addListener(marker, 'click', function () {
                        infoWindow.setContent('<b>You are here!</b>');
                        infoWindow.open(map, marker);
                    });
                    $('#f_table_container').html('<table id="f_table" class="table table-striped table-bordered"' +
                    'cellspacing="0" width="100%"></table>');
                    $("#f_table").html('<tr><td colspan="4"><div class="alert-warning">No forest within ' +
                        distance + ' ' + $("select#unit option:selected").text() + '</div></td></tr>');
                }
            }
        });
    }

    function addSiteMarker(latitude, longitude, markerTitle, menuTitle) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude, longitude),
            icon: 'http://maps.google.com/mapfiles/ms/icons/green.png'
        });
        marker.setMap(map);
        google.maps.event.addListener(marker, 'click', function () {
            infoWindow.setContent('<b>' + markerTitle + '</b>');
            infoWindow.open(map, marker);
        });
        site_markers.push(marker);
        html_placeholder.push('<tr><td>' + menuTitle + '</td>' +
            '<td><a href="javascript:siteLocate(' + (site_markers.length - 1) + ')">' +
            '<img src="http://maps.google.com/mapfiles/ms/icons/blue.png" /></a></td></tr>');

        //document.getElementById("forest_list").innerHTML = html_placeholder;
    }
    //accepting forest ID to get sites
    window.getSites = function (forestID,i) {
        //alert("getSites() function is called")
        /*jQuery.ajax({
            type: "POST",
            url: url + "get_sites",
            dataType: 'json',
            data: {forest_id: forestID},
            success: function (data) {
                if (data) {
                    alert("sukses");
                    $('#site_div').hidden = false; //open the html elemen for site
                    site_markers = [];
                    html_placeholder = [];
                    var bounds = new google.maps.LatLngBounds();
                    $.each(data, function (index, oneSite) {
                        bounds.extend(new google.maps.LatLng(oneSite.latitude, oneSite.longitude));
                        addSiteMarker(oneSite.latitude, oneSite.longitude,
                            oneSite.site_name, oneSite.site_name);
                        map.fitBounds(bounds);
                    });
                    //array for forest list pagination (5 items per page)
                    site_page = divideArray(html_placeholder, 5);
                    //initialise first page
                    document.getElementById("s_current_page").value = 0;
                    //display the first 5 items
                    document.getElementById("site_list").innerHTML = "";
                    for (var i = 0; i < site_page[0].length; i++) {
                        document.getElementById("site_list").innerHTML += site_page[0][i];
                    }
                    //add page link
                    document.getElementById("s_pagination").innerHTML = '<button = "btn btn-default" onclick="s_prev();">PREV&nbsp;</button>' +
                        ' 1 of ' + site_page.length + ' <button ="btn btn-default" onclick="s_next();">&nbsp;NEXT</button>';
                }
                else {
                    $('#site_div').innerHTML ='<div class="warning">No sites available.</div>';
                }
            }
        });*/
    }
});