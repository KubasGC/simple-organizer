<h1>Dodawanie ministranta</h1>
<br/>
<h3>Czy wiesz, że...</h3>
możesz dodać ministranta uzupełniając poniższy formularz?
<br/><br/>

<div style="text-align: center;">

    <?php

    if (isset($_POST['submit'])) {
        $imie = htmlspecialchars($MySQL->real_escape_string($_POST['imie']));
        $nazwisko = htmlspecialchars($MySQL->real_escape_string($_POST['nazwisko']));
        $wiek = intval($_POST['wiek']);

        $miejscowosc = intval($_POST['miejscowosc']);
        $ranga = intval($_POST['ranga']);

        if (empty($imie) || empty($nazwisko) || $wiek == 0 || $miejscowosc == 0 || $ranga == 0) {
            echo "<strong style='color: red;'>Uzupełnij wszystkie pola.</strong>";
        } else {
            $fullName = sprintf("%s %s", $imie, $nazwisko);
            $query = $MySQL->query(sprintf("SELECT `uid` FROM `ministrant_users` WHERE `fullName` = '%s'", $fullName));
            if ($query->num_rows > 0) {
                echo "<strong style='color: red;'>Ministrant z takim imieniem i nazwiskiem już istnieje.</strong>";
            } else {
                $MySQL->query(sprintf("INSERT INTO `ministrant_users` SET `fullName` = '%s', `age` = '%d', `rank` = '%d', `spot` = '%d'", $fullName, $wiek, $ranga, $miejscowosc));
                header("Location: index.php?page=minList");
            }
        }
    }

    ?>

    <br/><br/>

    <form method='POST'>
        <div class="input-control text" style='width: 30%;'>
            <input type="text" name='imie' placeholder="Imię ministranta"/>
            <button class="btn-clear"></button>
        </div>
        <br/>

        <div class="input-control text" style='width: 30%;'>
            <input type="text" name='nazwisko' placeholder="Nazwisko ministranta"/>
            <button class="btn-clear"></button>
        </div>
        <br/>

        <div class="input-control text" style='width: 30%;'>
            <input type="text" name='wiek' placeholder="Wiek ministranta"/>
            <button class="btn-clear"></button>
        </div>
        <br/>

        <div class="input-control select" style='width: 30%;'>
            <select name='miejscowosc'>
                <option value="0">Parafia ministranta</option>
                <?php
                $query = $MySQL->query("SELECT * FROM `ministrant_spots`");
                if ($query->num_rows > 0) {
                    while ($r = $query->fetch_array()) {
                        echo "<option value='" . $r['uid'] . "'>" . $r['name'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <br/>

        <div class="input-control select" style='width: 30%;'>
            <select name='ranga'>
                <option value="0">Stopień ministranta</option>
                <?php
                $query = $MySQL->query("SELECT * FROM `ministrant_rankinfo`");
                if ($query->num_rows > 0) {
                    while ($r = $query->fetch_array()) {
                        echo "<option value='" . $r['uid'] . "'>" . $r['name'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>

        <br/><br/>
        <button class='large primary' type='submit' name='submit' value='ok'>Dodaj ministranta</button>
    </form>
</div>