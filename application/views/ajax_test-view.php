<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>
<script>
    $(document).ready(function() {
        var forestData = [];
        $.ajax({
            type: "POST",
            url: "http://xploreforest-development.azurewebsites.net/Ajax/get_forests/distance",
            dataType: 'text',
            data: {latitude: -37.9167, longitude: 145.2, unit: 'K', distance: 400},
            success: function (data) {
                if (data) {
                    $.each(data, function (index, oneRecord) {
                        forestData.push({name: oneRecord.name, description: oneRecord.description});
                    });
                }
            },
            complete: function(jqXHR, status){
                if(status == 'success'){
                    for(var i = 0; i < forestData.length; i++){
                        console.log(forestData[i].name + ',' + forestData[i].description);
                    }
                }
            }
        });
    });
</script>
</body>
</html>