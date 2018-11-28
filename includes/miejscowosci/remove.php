<?php
echo "<h1>Usuwanie ministranta</h1><br /><br />";

echo "<div style='text-align: center;'>";

$uid = intval($_GET['uid']);
if (!$uid || $uid == 0 || empty($uid)) {
    echo "<strong style='color: red;'>Wystąpił błąd z parsowaniem danych. Zrobiłeś coś nie tak.</strong>";
} else {

    if (isset($_POST['submit'])) {
        $MySQL->query(sprintf("DELETE FROM `ministrant_spots` WHERE `uid` = '%d'", $uid));
        header("Location: index.php?page=mList");
    }

    $query = $MySQL->query(sprintf("SELECT `name` FROM `ministrant_spots` WHERE `uid` = '%d'", $uid));
    if ($query->num_rows <= 0) {
        echo "<strong style='color: red;'>Wystąpił błąd z parsowaniem danych. Zrobiłeś coś nie tak.</strong>";
    } else {
        $query = $query->fetch_array();
        echo sprintf("Czy rzeczywiście chcesz usunąć parafię <strong style='color: red;'>%s</strong> z bazy danych?", $query['name']);
        echo "<br /><br />";
        echo "<form method='POST'>";
        echo "<button class='large danger' type='submit' name='submit' value='ok'>Usuń</button>";
        echo "</form>";
    }
}
echo "</div>";

?>