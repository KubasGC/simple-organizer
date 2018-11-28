<h1>Dodawanie miesiąca</h1>
<br/>
<h3>Czy wiesz, że...</h3>
możesz dodać miejscowość uzupełniając poniższy formularz?
<br/><br/>
<div style="text-align: center;">
    <?php
    //error_reporting(E_ALL);
    if (isset($_POST['submit'])) {
        $chooseDate = htmlspecialchars($MySQL->real_escape_string($_POST['chooseDate']));
        if (empty($chooseDate)) {
            echo "<strong style='color: red;'>Musisz ustawić nazwę miesiąca.</strong>";
        } else {
            $chooseDate = explode("-", $chooseDate);
            $month = intval($chooseDate[1]);
            $year = intval($chooseDate[2]);

            $query = $MySQL->query(sprintf("SELECT `uid` FROM `ministrant_months` WHERE `month` = '%d' AND `year` = '%d'", $month, $year));
            if ($query->num_rows > 0) {
                echo "<strong style='color: red;'>Ten miesiąc jest już dodany.</strong>";
            } else {
                $MySQL->query(sprintf("INSERT INTO `ministrant_months` SET `month` = '%d', `year` = '%d'", $month, $year));
                echo "<strong style='color: green;'>Miesiąc został dodany pomyślnie.</strong>";
                //header("Location: index.php?page=monthList");
            }

        }
    }
    ?>

    <br/><br/>

    <form method='POST'>
        <div class="input-control text" data-role="datepicker"
             data-effect='fade'
             data-format="dd-mm-yyyy"
             data-date="2014-01-01"
             data-locale='en'
             data-week-start='1'
             data-other-days='1'>
            <input type="text" name="chooseDate">
            <button class="btn-date"></button>
        </div>
        <br/><br/>
        <button class='large primary' type='submit' name='submit' value='ok'>Dodaj parafię</button>
    </form>
</div>