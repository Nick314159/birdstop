<link rel='stylesheet' type='text/css' href='../stylesheet.css'/>
<?php
include "../config.php";
$result = mysqli_query($db, "SELECT name FROM brewery ORDER BY name");
$tableHTML = '<div style="float:left; width:25%; height: 25%"><table align="center" cellpadding="0" cellspacing="0" class="db-table"><th>Name</th></tr>';
while ($row = $result->fetch_assoc()) {
    $tableHTML .= '<td>' . $row['name'] . '</td></tr>';
}
$tableHTML .= '</table></div><div style="float:left; width:75%">';
$result = mysqli_query($db, "SELECT id, name FROM brewery");
$deleteTypeHTML = "<select name='brewery_id'>";
        while ($row = $result->fetch_assoc()) {
        unset($id, $name);
        $id = $row['id'];
        $name = $row['name'];
            $deleteTypeHTML .="<option value='" . $id . "'";
    if (!$newBeer && $id == $beerRow['brewery_id']) {
        $deleteTypeHTML .=  " selected ";
    }
            $deleteTypeHTML .=  ">" . $name . "</option>";

    }
$deleteTypeHTML .= "</select>";

echo $tableHTML;
echo $deleteTypeHTML;
?>

