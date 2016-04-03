/**
 * Created by gusis on 4/2/2016.
 */
$(document).ready(function() {
    //var html_placeholder = "";
    var latitude = null;
    var longitude = null;
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
    var map = null;
    var markers = [];
    var infoWindow = new google.maps.InfoWindow();
    //var sites = null;

    window.respond_click = function (i){
        google.maps.event.trigger(markers[i],'click');
        map.setZoom(15);
        map.setCenter(markers[i].getPosition());
    };
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
        });
        marker.setMap(map);
        google.maps.event.addListener(marker,'click',function(){
            infoWindow.setContent("<b>You are here!</b>");
            infoWindow.open(map,marker);
        });
        markers.push(marker);
        var html_placeholder = "";
        html_placeholder += '<li><a href="javascript:respond_click(' + (markers.length - 1) + ')">' + 'Your location  <\/a></li>';

        document.getElementById("controls").innerHTML = html_placeholder;
    }

    google.maps.event.addDomListener(window, 'load', initialise);

    $("button#apply").click(function (event) {
        event.preventDefault();
        var distance = $("input#distance").val();
        var unit = $("select#unit option:selected").val();
        var latitude = $("input#latitude").val();
        var longitude = $("input#longitude").val();
        jQuery.ajax({
            type: "POST",
            url: "http://xploreforest.azurewebsites.net/Ajax/get_sites",
            //url: "http://localhost/new_ci/index.php/Ajax/get_sites",
            dataType: 'json',
            data: {distance: distance, unit: unit, latitude: latitude, longitude: longitude},
            success: function (data) {
                //alert("Success!");
                if (data) {
                    //alert("distance:" + distance+",unit: "+ unit+", latitude:"+
                      //  latitude+"longitude: "+longitude+ ","+  "connecting to data success!");
                    markers = [];
                    var html_placeholder = "";
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
                    });
                    marker.setMap(map);
                    google.maps.event.addListener(marker,'click',function(){
                        infoWindow.setContent("<b>You are here!</b>");
                        infoWindow.open(map,marker);
                    });
                    markers.push(marker);
                    html_placeholder += '<li><a href="javascript:respond_click(' + (markers.length - 1) + ')">' +
                        'Your location <\/a></li>';
                    var bounds = new google.maps.LatLngBounds();
                    bounds.extend(new google.maps.LatLng(latitude,longitude));
                    $.each(data, function (index, oneRecord) {
                        bounds.extend(new google.maps.LatLng(oneRecord.latitude,oneRecord.longitude));
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(oneRecord.latitude,oneRecord.longitude)
                        });
                        marker.setMap(map);
                        google.maps.event.addListener(marker,'click',function(){
                            infoWindow.setContent('<b>' + oneRecord.site_name +'</b>');
                            infoWindow.open(map,marker);
                        });
                        markers.push(marker);
                        html_placeholder += '<li><a href="javascript:respond_click(' + (markers.length - 1) + ')" >' +
                            oneRecord.site_name + '<\/a></li>';

                        document.getElementById("controls").innerHTML = html_placeholder;
                    });
                    map.fitBounds(bounds);
                }
                else {
                    markers = [];
                    var html_placeholder = "";
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
                    });
                    marker.setMap(map);
                    google.maps.event.addListener(marker,'click',function(){
                        infoWindow.setContent("<b>You are here!</b>");
                        infoWindow.open(map,marker);
                    });
                    markers.push(marker);
                    html_placeholder += '<li><a href="javascript:respond_click(' + (markers.length - 1) + ')">' +
                        'Your location <\/a></li>';

                    document.getElementById("controls").innerHTML = html_placeholder;
                }
            }
        });
    });
    $("#controls").on('ready',pagination);
    function pagination() {
        $('#controls').easyPaginate({
            paginateElement: 'li',
            elementsPerPage: 10,
            effect: 'climb'
        });
    }
});