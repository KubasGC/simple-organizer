<?php
$loggedIn = true;
$userHash = $_COOKIE['userHash'];
if (!$userHash) {
    $loggedIn = false;
} else {
    $userInfo = $MySQL->query(sprintf("SELECT * FROM `ministrant_admins` WHERE `userHash` = '%s' LIMIT 1", htmlspecialchars($userHash)));
    if ($userInfo->num_rows <= 0) {
        $loggedIn = false;
    } else {
        $userInfo = $userInfo->fetch_array();
    }
}
?>