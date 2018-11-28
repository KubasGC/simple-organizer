<h1>Dodawanie miejscowości</h1>
<br/>
<h3>Czy wiesz, że...</h3>
możesz dodać miejscowość uzupełniając poniższy formularz?
<br/><br/>
<div style="text-align: center;">
    <?php
    if (isset($_POST['submit'])) {
        $spotName = htmlspecialchars($MySQL->real_escape_string($_POST['spotName']));
        if (empty($spotName)) {
            echo "<strong style='color: red;'>Musisz ustawić nazwę miejscowości.</strong>";
        } else {
            $query = $MySQL->query(sprintf("SELECT `uid` FROM `ministrant_spots` WHERE `name` = '%s'", $spotName));
            if ($query->num_rows > 0) {
                echo "<strong style='color: red;'>Taka parafia już istnieje.</strong>";
            } else {
                $MySQL->query(sprintf("INSERT INTO `ministrant_spots` SET `name` = '%s'", $spotName));
                header("Location: index.php?page=mList");
            }
        }
    }
    ?>

    <br/><br/>

    <form method='POST'>
        <div class="input-control text" style='width: 30%;'>
            <input type="text" name='spotName' placeholder="Nazwa miejscowości"/>
            <button class="btn-clear"></button>
        </div>
        <br/><br/>
        <button class='large primary' type='submit' name='submit' value='ok'>Dodaj parafię</button>
    </form>
</div>