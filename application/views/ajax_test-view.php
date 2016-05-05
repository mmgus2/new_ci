<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>
<script>
    $(document).ready(function() {
        var Forest = function (){
            this.name = '';
            this.description = '';
            this.site = [];
            this.activity = [];
        }

        var Site = function () {
            this.name = '';
            this.description = '';
            this.activity = [];
        }

        var forestData = [];
        $.ajax({
            type: "POST",
            url: "http://xploreforest-development.azurewebsites.net/Ajax/get_forests/distance",
            dataType: 'json',
            data: {latitude: -37.9167, longitude: 145.2, unit: 'K', distance: 100},
            success: function (data) {
                if (data) {
                    $.each(data, function (index, record) {
                        var forest = new Forest();
                        forest.name = record.name;
                        forest.description = record.description;
                        for (var i = 0; i < record.activities.length; i++){
                            forest.activity.push(record.activities[i]);
                        }
                        for (var i = 0; i < record.sites.length; i++){
                            var site = new Site();
                            site.name = record.sites[i].site_name;
                            site.description = record.sites[i].site_description;
                            for(var j = 0; j < record.sites[i].activities.length; j++){
                                site.activity.push(record.sites[i].activities[j].activity_name);
                            }
                            forest.site.push(site);
                        }
                        forestData.push(forest);
                    });
                }
            },
            complete: function(jqXHR, status){
                if(status == 'success'){
                    displayData();
                }
            }
        });
        function displayData(){
            for(var i = 0; i < forestData.length; i++){
                console.log("Forest:");
                console.log(forestData[i].name + " , " + forestData[i].description);

                console.log("Sites:");
                for (var j = 0; j < forestData[i].site.length; j++){
                    console.log(i + " " + forestData[i].site[j].name + " , " + forestData[i].site[j].description);
                    console.log("Activities:");
                    for(var k = 0; k < forestData[i].site[j].activity.length; k++){
                        console.log(forestData[i].site[j].activity[k]);
                    }
                }

                console.log("Forest Activities:")
                for (var i = 0; i < forestData[i].activity.length; i++){
                    console.log(forestData[i].activity[i]);
                }
            }
        }
    });
</script>
</body>
</html>