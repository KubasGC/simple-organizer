<?php
//error_reporting(E_ALL);

if ($connectionSuccess) {

    if ($loggedIn) {
        switch ($_GET['page']) {
            default:
                echo "<h1>Strona główna</h1>";
                echo "<div style='text-align: center;'>Wybierz kategorię u góry!</div>";
                //echo sprintf("Tutaj jest '%s' ten userHash", $userHash);
                break;

            // Ministranci

            case 'minAdd':
                require("includes/ministranci/add.php");
                break;

            case 'minList':
                require("includes/ministranci/list.php");
                break;

            case 'minEdit':
                require("includes/ministranci/edit.php");
                break;

            case 'minRemove':
                require("includes/ministranci/remove.php");
                break;

            // Rangi

            case 'rAdd':
                require("includes/rangi/add.php");
                break;

            case 'rList':
                require("includes/rangi/list.php");
                break;

            // Miejscowości

            case 'mAdd':
                require("includes/miejscowosci/add.php");
                break;

            case 'mList':
                require("includes/miejscowosci/list.php");
                break;

            // Miesiące
            case 'monthAdd':
                require("includes/miesiace/add.php");
                break;

            case 'monthList':
                require("includes/miesiace/list.php");
                break;

            case 'monthRemove':
                require("includes/miesiace/remove.php");
                break;

            case 'logout':
                setcookie("userHash", null, -1);
                header("Location: index.php");
                break;
        }
    } else {
        require("includes/core/login.php");
    }
} else {
    echo "<h1>MySQL ERROR</h1>";
    echo "<div style='text-align: center;'>";
    echo "Wystąpił błąd podczas łączenia z bazą danych. Szczegółowy opis błędu:<br /><br />";
    echo sprintf("(Numer błędu: <strong>%d</strong>)<br /> %s", $MySQL->connect_errno, $MySQL->connect_error);
    echo "</div>";
}
?>