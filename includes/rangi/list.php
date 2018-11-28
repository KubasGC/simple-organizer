<?php
echo "<h1>Lista stopni</h1>";

echo "<br /><br />";

echo "<div style='text-align: center;'>";
echo "<table class='table striped' id='tabelka'>";
echo "<thead>";
echo "<tr>";
echo "<th class='text-center' width='5%'>UID</th>";
echo "<th class='text-left' width='95%'>Nazwa stopnia</th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";

$query = $MySQL->query("SELECT * FROM `ministrant_rankinfo`");
if ($query->num_rows <= 0) {
    echo "<tr>";
    echo "<td colspan='2'><i>Nie dodano żadnych stopni...</i></td>";
    echo "</tr>";
} else {
    while ($r = $query->fetch_array()) {
        echo "<tr>";
        echo "<td>" . $r['uid'] . "</td>";
        echo "<td class='text-left'>" . $r['name'] . "</td>";
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