/**
 * Created by gusis on 4/2/2016.
 */
$(document).ready(function() {
    var latitude = document.getElementById("latitude");
    var longitude = document.getElementById("longitude");
    //var html_placeholder = "";

    var map = null;
    var markers = [];
    var infoWindow = new google.maps.InfoWindow();
    //var sites = null;
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(setPosition);
        } else {
            //Geolocation is not supported by this browser
            alert("Geolocation is not supported by this browser");
        }
    }
    function setPosition(position) {
        latitude.value = position.coords.latitude;
        longitude.value = position.coords.longitude;
    }
    getLocation();

    window.respond_click = function (i){
        google.maps.event.trigger(markers[i],'click');
    };
    var bounds = new google.maps.LatLngBounds();
    bounds.extend(new google.maps.LatLng(latitude,longitude));
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
        html_placeholder += '<a href="javascript:respond_click(' + (markers.length - 1) + ')">' + 'Your location  <\/a><br>';

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
            dataType: 'json',
            data: {distance: distance, unit: unit, latitude: latitude, longitude: longitude},
            success: function (data) {
                //alert("Success!");
                if (data) {
                    //alert("distance:" + distance+",unit: "+ unit+", latitude:"+
                      //  latitude+"longitude: "+longitude+ ","+  "connecting to data success!");
                    markers = [];
                    var html_placeholder = "";
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(latitude,longitude)
                    });
                    marker.setMap(map);
                    google.maps.event.addListener(marker,'click',function(){
                        infoWindow.setContent("<b>You are here!</b>");
                        infoWindow.open(map,marker);
                    });
                    markers.push(marker);
                    html_placeholder += '<a href="javascript:respond_click(' + (markers.length - 1) + ')">' +
                        'Your location <\/a><br>';
                    $.each(data, function (index, oneRecord) {
                        bounds.extend(new google.maps.LatLng(oneRecord.latitude,oneRecord.longitude));
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(oneRecord.latitude,oneRecord.longitude)
                        });
                        marker.setMap(map);
                        google.maps.event.addListener(marker,'click',function(){
                            infoWindow.setContent("<b>oneRecord.site_name</b>");
                            infoWindow.open(map,marker);
                        });
                        markers.push(marker);
                        html_placeholder += '<a href="javascript:respond_click(' + (markers.length - 1) + ')">' +
                            oneRecord.site_name + '<\/a><br>';

                        document.getElementById("controls").innerHTML = html_placeholder;
                    });
                    map.fitBounds(bounds);
                }
                else {
                    markers = [];
                    var html_placeholder = "";
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(latitude,longitude)
                    });
                    marker.setMap(map);
                    google.maps.event.addListener(marker,'click',function(){
                        infoWindow.setContent("<b>You are here!</b>");
                        infoWindow.open(map,marker);
                    });
                    markers.push(marker);
                    html_placeholder += '<a href="javascript:respond_click(' + (markers.length - 1) + ')">' +
                        'Your location <\/a><br>';

                    document.getElementById("controls").innerHTML = html_placeholder;
                }
            }
        });
    });
});