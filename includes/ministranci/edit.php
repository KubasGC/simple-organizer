<?php

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

echo "<h1>Edycja ministranta</h1>";

echo "<br /><br />";

$uid = intval($_GET['uid']);

if ($uid == 0 || empty($uid)) {
    echo "<strong style='color: red;'>Wystąpił błąd z parsowaniem danych. Zrobiłeś coś nie tak.</strong>";
} else {
    $query = $MySQL->query(sprintf("SELECT `u`.*, `m`.`name` AS `spotName`, `r`.`name` AS `rankName` FROM `ministrant_users` u LEFT JOIN `ministrant_spots` m ON (`u`.`spot` = `m`.`uid`) LEFT JOIN `ministrant_rankinfo` r ON (`u`.`rank` = `r`.`uid`) WHERE `u`.`uid` = '%d'", $uid));
    if ($query->num_rows <= 0) {
        echo "<strong style='color: red;'>Nie znaleziono ministranta z podanym UID.</strong>";
    } else {
        $query = $query->fetch_array();
        echo "<div style='text-align: center;'>";
        echo sprintf("<i>Edytujesz ministranta <strong>%s</strong></i>.<br /><br />", $query['fullName']);

        if (isset($_POST['submit'])) {
            $name = htmlspecialchars($MySQL->real_escape_string($_POST['fullName']));
            $age = intval($_POST['age']);
            $miejscowosc = intval($_POST['miejscowosc']);
            $ranga = intval($_POST['ranga']);
            if (empty($name) || empty($age) || $age == 0 || empty($miejscowosc) || $miejscowosc == 0 || empty($ranga) || $ranga == 0) {
                echo "<strong style='color: red;'>Wprowadź wszystkie dane POPRAWNIE.</strong>";
            } else {
                $MySQL->query(sprintf("UPDATE `ministrant_users` SET `fullName` = '%s', `age` = '%d', `spot` = '%d', `rank` = '%d' WHERE `uid` = '%d'", $name, $age, $miejscowosc, $ranga, $uid));
                header("Location: index.php?page=minList");
            }

        }
        echo "<br /><br />";
        echo "<form method='POST'>";

        echo "<div class='input-control text' style='width: 30%;'>";
        echo "<input type='text' name='fullName' value='" . $query['fullName'] . "' placeholder='Imię i nazwisko ministranta' />";
        echo "<button class='btn-clear'></button>";
        echo "</div>";
        echo "<br />";

        echo "<div class='input-control text' style='width: 30%;'>";
        echo "<input type='text' name='age' value='" . $query['age'] . "' placeholder='Wiek ministranta' />";
        echo "<button class='btn-clear'></button>";
        echo "</div>";
        echo "<br />";

        echo "<div class='input-control select' style='width: 30%;'>";
        echo "<select name='miejscowosc'>";
        echo "<option value='0' selected>--</option>";
        $query2 = $MySQL->query("SELECT * FROM `ministrant_spots`");
        if ($query2->num_rows > 0) {
            while ($r = $query2->fetch_array()) {
                $selected = "";
                if (intval($r['uid']) == intval($query['spot'])) $selected = "selected='selected'";
                echo sprintf("<option value='%d' %s>%s</option>", $r['uid'], $selected, $r['name']);
            }
        }
        echo "</select>";
        echo "</div>";
        echo "<br />";

        echo "<div class='input-control select' style='width: 30%;'>";
        echo "<select name='ranga'>";
        echo "<option value='0' selected>--</option>";
        $query2 = $MySQL->query("SELECT * FROM `ministrant_rankinfo`");
        if ($query2->num_rows > 0) {
            while ($r = $query2->fetch_array()) {
                $selected = "";
                if (intval($r['uid']) == intval($query['rank'])) $selected = "selected='selected'";
                echo sprintf("<option value='%d' %s>%s</option>", $r['uid'], $selected, $r['name']);
            }
        }
        echo "</select>";
        echo "</div>";
        echo "<br />";

        echo "<button class='large primary' type='submit' name='submit' value='ok'>Edytuj ministranta</button>";
        echo "&nbsp;<a href='index.php?page=minRemove&uid=" . $query['uid'] . "' class='button large danger'>Usuń ministranta</a>";

        echo "</form>";
        echo "<br /><br />";
        echo "<h2 style='text-align: center;'>Punkty za poszczególne miesiące</h2>";
        echo "<br /><br />";

        echo "<form method='POST'>";
        echo "<center><table class='table striped' style='width: 50%'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th width='70%' class='text-left'>Miesiąc</th>";
                    echo "<th width='30%'>Punkty</th>";
                echo "</tr>";
              //  $query5 = $MySQL->query(sprintf("SELECT md.*, m.* FROM `ministrant_months` m LEFT JOIN `ministrant.monthsdata` md ON (m.uid = md.monthID) WHERE `userID` = '%d'", $uid));
                $query = $MySQL->query(sprintf("SELECT m.uid AS muid, m.month, m.year, md.* FROM `ministrant_months` m LEFT JOIN `ministrant_monthsdata` md ON (m.uid = md.monthID) ORDER BY m.year ASC", $uid));
                while($r = $query->fetch_array())
                {
                    echo "<tr>";
                        echo sprintf("<td>%s</td>", getMonthName($r['month'], $r['year']));
                        if(!intval($r['pkts']))
                        {
                            $r['pkts'] = 0;
                        }
                        echo sprintf("<td><input type='text' name='pkts_%d' value='%d'></td>", $r['muid'], $r['pkts']);
                    echo "</tr>";

                    if(isset($_POST['saveMonths']))
                    {
                        $number = intval($_POST['pkts_'.$r['muid']]);
                        $firstCheck = $MySQL->query("SELECT `uid` FROM `ministrant_monthsdata` WHERE `userID` = '$uid' AND `monthID` = '".$r['muid']."' LIMIT 1");
                        if($firstCheck->num_rows > 0)
                        {
                            $firstCheck = $firstCheck->fetch_array();
                            $MySQL->query(sprintf("UPDATE `ministrant_monthsdata` SET `pkts` = '%d' WHERE `userID` = '%d' AND `monthID` = '%d'", $number, $uid, $r['muid']));
                        }
                        else
                        {
                            $MySQL->query(sprintf("INSERT INTO `ministrant_monthsdata` SET `userID` = '%d', `monthID` = '%d', `pkts` = '%d'", $uid, $r['muid'], $number));
                        }
                    }
                }
                if(isset($_POST['saveMonths'])) header("Location: index.php?page=minEdit&uid=".$uid);
        echo "</thead>";
        echo "</table>";
        echo "<button class='large primary' type='submit' name='saveMonths' value='ok'>Zapisz dane miesięcy</button>";
        echo "</form>";
        echo "</center><br /><br />";

        echo "</div>";
    }
}

?>