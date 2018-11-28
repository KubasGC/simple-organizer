<?php
echo "<h1>Logowanie</h1>";
echo "Aby używać strony musisz być zalogowany - zrób to teraz!<br /><br />";

echo "<div style='text-align: center;'>";

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "<strong style='color: red;'>Uzupełnij wszystkie pola.</strong>";
    } else {
        $username = htmlspecialchars($MySQL->real_escape_string($_POST['username']));
        $password = $_POST['password'];

        $query = $MySQL->query(sprintf("SELECT * FROM `ministrant_admins` WHERE `name` = '%s' AND `password` = '%s' LIMIT 1", $username, md5($password)));
        if ($query->num_rows <= 0) {
            echo "<strong style='color: red;'>Nie znaleziono konta o podanej kombinacji. Spróbuj jeszcze raz.</strong>";
        } else {
            $result = $query->fetch_array();
            setcookie("userHash", $result['userHash'], time() + 3600 * 12);
            header("Location: index.php");
        }
    }
}

echo "<br /><br />";
echo "<form method='POST'>";

echo "<div class='input-control text' style='width: 30%;'>";
echo "<input type='text' name='username' placeholder='Nazwa użytkownika' />";
echo " <button class='btn-clear'></button>";
echo "</div>";

echo "<br />";

echo "<div class='input-control password' style='width: 30%;'>";
echo "<input type='password' name='password' value='' placeholder='Hasło' />";
echo " <button class='btn-reveal'></button>";
echo "</div>";

echo "<br />";

echo "<button class='large primary' type='submit' name='submit' value='ok'>Zaloguj się</button>";

echo "</form>";
echo "</div>";

?>