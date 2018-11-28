<?php
echo "<h1>Lista miejscowości</h1>";

echo "<br /><br />";

echo "<div style='text-align: center;'>";
echo "<table class='table striped' id='tabelka'>";
echo "<thead>";
echo "<tr>";
echo "<th class='text-center' width='5%'>UID</th>";
echo "<th class='text-left' width='90%'>Nazwa miejscowości</th>";
echo "<th class='text-center' width='5%'></th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";

$query = $MySQL->query("SELECT * FROM `ministrant_spots`");
if ($query->num_rows <= 0) {
    echo "<tr>";
    echo "<td colspan='2'><i>Nie dodano żadnych miejscowości...</i></td>";
    echo "</tr>";
} else {
    while ($r = $query->fetch_array()) {
        echo "<tr>";
        echo "<td>" . $r['uid'] . "</td>";
        echo "<td class='text-left'>" . $r['name'] . "</td>";
        echo "<td class='text-center'><a class='button primary' href='index.php?page=mEdit&uid=" . $r['uid'] . "'>Edytuj</a></td>";
        echo "</tr>";
    }
}
echo "</tbody>";
echo "</table>";
echo "</div>";
echo "<br /><br />";
?>
<script type='text/javascript'>
    $(document).ready(function () {
        $('#tabelka').DataTable();
    });
</script>