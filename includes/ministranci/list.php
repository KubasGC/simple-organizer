<?php
echo "<h1>Lista ministrantów</h1>";

echo "<br /><br />";

echo "<div style='text-align: center;'>";
echo "<table class='table striped' id='tabelka'>";
echo "<thead>";
echo "<tr>";
echo "<th class='text-center' width='5%'>UID</th>";
echo "<th class='text-center' width='5%'>Wiek</th>";
echo "<th class='text-left' width='23%'>Imię i nazwisko</th>";
echo "<th class='text-center' width='23%'>Miejscowość</th>";
echo "<th class='text-right' width='23%'>Stopień</th>";
echo "<th class='text-center' width='10%'></th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";

$query = $MySQL->query("SELECT `u`.*, `m`.`name` AS `spotName`, `r`.`name` AS `rankName` FROM `ministrant_users` u LEFT JOIN `ministrant_spots` m ON (`u`.`spot` = `m`.`uid`) LEFT JOIN `ministrant_rankinfo` r ON (`u`.`rank` = `r`.`uid`)");
if ($query->num_rows <= 0) {
    echo "<tr>";
    echo "<td colspan='6'><i>Nie dodano żadnych ministrantów...</i></td>";
    echo "</tr>";
} else {
    while ($r = $query->fetch_array()) {
        echo "<tr>";
        echo "<td class='text-center'>" . $r['uid'] . "</td>";
        echo "<td class='text-center'>" . $r['age'] . "</td>";
        echo "<td class='text-left'>" . $r['fullName'] . "</td>";
        echo "<td class='text-center'>" . $r['spotName'] . "</td>";
        echo "<td class='text-right'>" . $r['rankName'] . "</td>";
        echo "<td class='text-center'><a class='button primary' href='index.php?page=minEdit&uid=" . $r['uid'] . "'>Edytuj</a></td>";
        echo "</tr>";
    }
}
echo "</tbody>";
echo "</table>";
echo "</div>";
echo "<br /><br /><br />";
?>
<script type='text/javascript'>
    $(document).ready(function () {
        $('#tabelka').DataTable();
    });
</script>