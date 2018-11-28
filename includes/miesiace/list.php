<?php
echo "<h1>Lista miesięcy</h1>";

echo "<br /><br />";

echo "<div style='text-align: center;'>";
echo "<table class='table striped' id='tabelka'>";
echo "<thead>";
echo "<tr>";
echo "<th class='text-center' width='5%'>UID</th>";
echo "<th class='text-left' width='90%'>Miesiąc</th>";
echo "<th class='text-center' width='5%'></th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";

$query = $MySQL->query('SELECT * FROM `ministrant_months`');
if ($query->num_rows <= 0) {
    echo "<tr>";
    echo "<td colspan='2'><i>Nie dodano żadnych miesięcy...</i></td>";
    echo "<td colspan='0'></td>";
    echo "</tr>";
} else {
    while ($r = $query->fetch_array()) {
        echo "<tr>";
        echo "<td>" . $r['uid'] . "</td>";
        echo "<td class='text-left'>" . getMonthName($r['month'], $r['year']). "</td>";
        echo "<td class='text-center'><a class='button danger' href='index.php?page=monthRemove&uid=" . $r['uid'] . "'>Usuń</a></td>";
        echo '</tr>';
    }
}
echo "</tbody>";
echo "</table>";
echo "</div>";
echo "<br /><br />";

function getMonthName($month, $year)
{

    switch($month)
    {
        case 1: $month = "styczeń"; break;
        case 2: $month = "luty"; break;
        case 3: $month = "marzec"; break;
        case 4: $month = "kwiecień"; break;
        case 5: $month = "maj"; break;
        case 6: $month = "czerwiec"; break;
        case 7: $month = "lipiec"; break;
        case 8: $month = "sierpień"; break;
        case 9: $month = "wrzesień"; break;
        case 10: $month = "październik"; break;
        case 11: $month = "listopad"; break;
        case 12: $month = "grudzień"; break;
    }

    return sprintf("%s %dr.", $month, $year);
}

?>
<script type='text/javascript'>
    $(document).ready(function () {
        $('#tabelka').DataTable();
    });
</script>