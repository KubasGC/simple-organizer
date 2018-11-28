<?php
echo "<h1>Edycja parafii</h1>";

echo "<br /><br />";

$uid = intval($_GET['uid']);

if ($uid == 0 || empty($uid)) {
    echo "<strong style='color: red;'>Wystąpił błąd z parsowaniem danych. Zrobiłeś coś nie tak.</strong>";
} else {
    $query = $MySQL->query(sprintf("SELECT * FROM `ministrant_spots` WHERE `uid` = '%d'", $uid));
    if ($query->num_rows <= 0) {
        echo "<strong style='color: red;'>Nie znaleziono parafii z podanym UID.</strong>";
    } else {
        $query = $query->fetch_array();
        echo "<div style='text-align: center;'>";
        echo sprintf("<i>Edytujesz parafię <strong>%s</strong></i>.<br /><br />", $query['name']);

        if (isset($_POST['submit'])) {
            $name = htmlspecialchars($MySQL->real_escape_string($_POST['fullName']));
            if (empty($name)) {
                echo "<strong style='color: red;'>Parafia musi mieć jakąś nazwę.</strong>";
            } else {
                $MySQL->query(sprintf("UPDATE `ministrant_spots` SET `name` = '%s' WHERE `uid` = '%d'", $name, $uid));
                header("Location: index.php?page=mList");
            }
        }
        echo "<br /><br />";


        echo "<form method='POST'>";

        echo "<div class='input-control text' style='width: 30%;'>";
        echo "<input type='text' name='fullName' value='" . $query['name'] . "' placeholder='Nazwa parafii' />";
        echo "<button class='btn-clear'></button>";
        echo "</div>";
        echo "<br />";
        echo "<br />";

        echo "<button class='large primary' type='submit' name='submit' value='ok'>Edytuj parafię</button>";
        echo "&nbsp;<a href='index.php?page=mRemove&uid=" . $query['uid'] . "' class='button large danger'>Usuń parafię</a>";

        echo "</form>";

        echo "</div>";
    }
}

?>