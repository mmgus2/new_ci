<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>
<script>
    $(document).ready(function() {
        var variable = 0;
        $.ajax({
            type: "POST",
            url: "http://xploreforest-development.azurewebsites.net/Ajax/get_max_distances",
            dataType: 'text',
            data: {latitude: -37.9167, longitude: 145.2, unit: 'K'},
            success: function (data) {
                if (data) {
                    variable = data;
                    alert(data);
                }
            }
        });
        alert(variable);
    });
</script>
</body>
</html>