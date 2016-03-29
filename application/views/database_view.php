<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 3/29/2016
 * Time: 1:19 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<table>
<tr>
    <th>Serial Number</th>
    <th>Location Name</th>
    <th>Longitude</th>
    <th>Latitude</th>
</tr>
<?php
foreach ($data as $rowData)
{
    ?>
    <tr>
        <td><?php echo $rowData["serial_no"]; ?></td>
        <td><?php echo $rowData["name"]; ?></td>
        <td><?php echo $rowData["latitude"] ?></td>
        <td><?php echo $rowData["longitude"] ?></td>
    </tr>
    <?php
}
?>
</table>
</body>
</html>
