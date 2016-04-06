/**
 * Created by gusis on 4/2/2016.
 */
$(document).ready(function() {
    //detect user current location
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(setPosition);
    }
    else
    {
        alert("Geolocation API not supported.");
    }

    function setPosition(position)
    {
        document.getElementById("latitude").value = position.coords.latitude;
        latitude = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;
        longitude = position.coords.longitude;
    }

    //variables initialisation to create map and marker(s)
    var map = null;
    var markers = [];
    var html_placeholder = [];
    var infoWindow = new google.maps.InfoWindow();

    //function to respond to user click
    window.forestLocate = function (i){
        google.maps.event.trigger(markers[i],'click');
        map.setZoom(15);
        map.setCenter(markers[i].getPosition());
    };

    //function to add marker on the map and also add html menu
    function addMarker(latitude,longitude,markerTitle,menuTitle, distance, forestID){
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude,longitude),
            icon: 'http://maps.google.com/mapfiles/ms/icons/green.png'
        });
        marker.setMap(map);
        google.maps.event.addListener(marker,'click',function(){
            infoWindow.setContent('<b>' + markerTitle + '</b>');
            infoWindow.open(map,marker);
        });
        markers.push(marker);
        html_placeholder.push('<tr><td>' + menuTitle + '</td>' +
            '<td>' + parseInt(distance) + '</td><td><a href="javascript:getSites(\'' + forestID + '\')">detail</td>' +
            '<td><a href="javascript:forestLocate(' + (markers.length - 1) + ')">' +
            '<img src="http://maps.google.com/mapfiles/ms/icons/green.png" /></a></td></tr>');

        //document.getElementById("forest_list").innerHTML = html_placeholder;
    }

    //function to initialise the map
    function initialise(){
        var mapInit = {
            zoom: 15,
            center: new google.maps.LatLng(latitude,longitude)
        };
        map = new google.maps.Map(document.getElementById("map"), mapInit);

        google.maps.event.addListener(map, 'click', function () {
           infoWindow.close();
        });
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude,longitude)
            //icon: 'http://maps.google.com/mapfiles/ms/icons/green.png'
        });
        marker.setMap(map);
        google.maps.event.addListener(marker,'click',function(){
            infoWindow.setContent('<b>You are here!</b>');
            infoWindow.open(map,marker);
        });
        //html_placeholder.push('<tr class="warning"><td colspan="4">No forest within 0 km</div></td></tr>');
        document.getElementById("forest_list").innerHTML = '<tr class="warning"><td colspan="4">No forest within 0 km</div></td></tr>';
    }

    //function to load map on the page
    google.maps.event.addDomListener(window, 'load', initialise);

    //function to get max distance from database (in km)
    /*function getMaxDistance() {
        jQuery.ajax({
            type: "POST",
            //url: "http://xploreforest.azurewebsites.net/Ajax/get_sites",
            url: "http://localhost/new_ci/index.php/Ajax/get_max_distance",
            dataType: 'json',
            data: {distance: distance, unit: unit, latitude: latitude, longitude: longitude},
            success: function (data) {
                if (data) {
                    //TO BE DEFINED
                }
            }
        })
    }*/

    //gain max distance of all records
    //var maxDistance = getMaxDistance();

    //array divider function for pagination
    function divideArray(array,dataPerSet)
    {
        var multiArray = [];
        for(var i = 0; i < array.length; i += dataPerSet)
        {
            multiArray.push(array.slice(i,i+dataPerSet));
        }
        return multiArray;
    }


    //respond when user click apply button
    $("button#apply").click(function (event) {
        event.preventDefault();

        //get the data from the form post
        var distance = $("input#distance").val();
        var unit = $("select#unit option:selected").val();
        var latitude = $("input#latitude").val();
        var longitude = $("input#longitude").val();

        //get the data from controller
        jQuery.ajax({
            type: "POST",
            url: "http://xploreforest.azurewebsites.net/Ajax/get_forests",
            //url: "http://localhost/new_ci/index.php/Ajax/get_forests",
            dataType: 'json',
            data: {distance: distance, unit: unit, latitude: latitude, longitude: longitude},
            success: function (data) {
                if (data) {
                    markers = [];
                    html_placeholder = [];
                    document.getElementById("forest_list").innerHTML = '';
                    var mapInit = {
                        zoom: 15,
                        center: new google.maps.LatLng(latitude, longitude)
                    };
                    map = new google.maps.Map(document.getElementById("map"), mapInit);

                    google.maps.event.addListener(map, 'click', function () {
                        infoWindow.close();
                    });
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(latitude,longitude)
                        //icon: 'http://maps.google.com/mapfiles/ms/icons/green.png'
                    });
                    marker.setMap(map);
                    google.maps.event.addListener(marker,'click',function(){
                        infoWindow.setContent('<b>You are here!</b>');
                        infoWindow.open(map,marker);
                    });
                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(new google.maps.LatLng(latitude, longitude));
                    //record max distance
                    $.each(data, function (index, oneRecord) {
                        bounds.extend(new google.maps.LatLng(oneRecord.latitude, oneRecord.longitude));
                        addMarker(oneRecord.latitude, oneRecord.longitude,
                            oneRecord.forest_name, oneRecord.forest_name, oneRecord.distance, oneRecord.forest_id);
                        map.fitBounds(bounds);
                    });
                    //array for forest list pagination (5 items per page)
                    forest_page = divideArray(html_placeholder,5);
                    //initialise first page
                    document.getElementById("f_current_page").value = 0;
                    //display the first 5 items
                    document.getElementById("forest_list").innerHTML = "";
                    for (var i = 0; i < forest_page[0].length; i++){
                        document.getElementById("forest_list").innerHTML += forest_page[0][i];
                    }
                    //add page link
                    document.getElementById("f_pagination").innerHTML = '<button = "btn btn-default" onclick="f_prev();">PREV</button>' +
                            ' 1 of ' + forest_page.length + ' <button ="btn btn-default" onclick="f_next();">NEXT</button>';
                }
                else {
                    //html_placeholder = [];
                    var mapInit = {
                        zoom: 15,
                        center: new google.maps.LatLng(latitude,longitude)
                    };
                    map = new google.maps.Map(document.getElementById("map"), mapInit);

                    google.maps.event.addListener(map, 'click', function () {
                        infoWindow.close();
                    });
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(latitude,longitude)
                        //icon: 'http://maps.google.com/mapfiles/ms/icons/green.png'
                    });
                    marker.setMap(map);
                    google.maps.event.addListener(marker,'click',function(){
                        infoWindow.setContent('<b>You are here!</b>');
                        infoWindow.open(map,marker);
                    });
                    //html_placeholder += '<tr class="warning"><td colspan="4">No forest within ' + distance +' km</div></td></tr>';
                    document.getElementById("forest_list").innerHTML =
                        '<tr class="warning"><td colspan="4">No forest within ' + distance +' km</div></td></tr>';
                }
            }
        });
    });
    window.f_prev = function()
    {
        var current_page = parseInt(document.getElementById("f_current_page").value);
        if(current_page > 0)
        {
            document.getElementById("forest_list").innerHTML = "";
            current_page--;
            //initialise new page
            document.getElementById("f_current_page").value = current_page;
            //display the new 5 item
            for (var i = 0; i < forest_page[current_page].length; i++){
                document.getElementById("forest_list").innerHTML += forest_page[current_page][i];
            }
            //add page link
            document.getElementById("f_pagination").innerHTML = '<button = "btn btn-default" onclick="f_prev();">PREV</button>' +
                (current_page + 1) + ' of ' + forest_page.length + ' <button ="btn btn-default" onclick="f_next();">NEXT</button>';
        }
    }
    window.f_next = function()
    {
        var current_page = parseInt(document.getElementById("f_current_page").value);
        if(current_page < forest_page.length - 1)
        {
            document.getElementById("forest_list").innerHTML = "";
            current_page++;
            //initialise new page
            document.getElementById("f_current_page").value = current_page;
            //display the new 5 item
            for (var i = 0; i < forest_page[current_page].length; i++){
                document.getElementById("forest_list").innerHTML += forest_page[current_page][i];
            }
            //add page link
            document.getElementById("f_pagination").innerHTML = '<button = "btn btn-default" onclick="f_prev();">PREV</button>' +
                (current_page + 1) + ' of ' + forest_page.length + ' <button ="btn btn-default" onclick="f_next();">NEXT</button>';
        }
    }
});