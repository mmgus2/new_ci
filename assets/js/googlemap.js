/**
 * Created by gusis on 4/3/2016.
 */
$(document).ready(function () {
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(intializeMap);
    }
    else
    {
        alert("Geolocation API not supported.");
    }

    function intializeMap(position)
    {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        map = new GMaps({
            div: '#map',
            lat: latitude,
            lng: longitude
        });
        map.addMarker({
            lat: latitude,
            lng: longitude,
            infoWindow: {
                content: '<b>You are here!</b><br /><img src="#" alt="test" />'
            }
        });
        map.addControl({
            position: 'top_right',
            content: 'Locate Me',
            style: {
                margin: '5px',
                padding: '1px 6px',
                border: 'solid 1px #717B87',
                background: '#fff'
            },
            events: {
                click: function(){
                    map.setCenter(latitude, longitude);
                    map.setZoom(15);
                }
            }
        });
    }
});