<h1>Dodawanie stopni</h1>
<br/>
<h3>Czy wiesz, że...</h3>
możesz dodać stopień uzupełniając poniższy formularz?
<br/><br/>
<div style="text-align: center;">
    <?php
    if (isset($_POST['submit'])) {
        $rankName = htmlspecialchars($MySQL->real_escape_string($_POST['rankName']));
        if (empty($rankName)) {
            echo "<strong style='color: red;'>Musisz ustawić nazwę stopnia.</strong>";
        } else {
            $query = $MySQL->query(sprintf("SELECT `uid` FROM `ministrant_rankinfo` WHERE `name` = '%s'", $rankName));
            if ($query->num_rows > 0) {
                echo "<strong style='color: red;'>Taka ranga już istnieje.</strong>";
            } else {
                $MySQL->query(sprintf("INSERT INTO `ministrant_rankinfo` SET `name` = '%s'", $rankName));
                header("Location: index.php?page=rList");
            }
        }
    }
    ?>

    <br/><br/>

    <form method='POST'>
        <div class="input-control text" style='width: 30%;'>
            <input type="text" name='rankName' placeholder="Nazwa stopnia"/>
            <button class="btn-clear"></button>
        </div>
        <br/><br/>
        <button class='large primary' type='submit' name='submit' value='ok'>Dodaj stopień</button>
    </form>
</div>