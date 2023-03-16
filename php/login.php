<?php
require('connect.php');

// check if the Nickname and Password fields are not empty
if (!empty($_POST['nickname']) && !empty($_POST['password'])) {

    // prepare the SQL query to select the member with the given Nickname
    $stmt = $db->prepare("SELECT * FROM Members WHERE Nickname = :nickname");
    $stmt->bindParam(':nickname', $_POST['nickname']);
    $stmt->execute();

    // fetch the member's data from the database
    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    // check if the member exists and the password is correct
    if ($member && password_verify($_POST['password'], $member['Password'])) {
        // the password is correct, so set the session variables and redirect to the appropriate interface
        session_start();
        $_SESSION['nickname'] = $member['Nickname'];
        $_SESSION['firstname'] = $member['Firstname'];
        
        if (strpos($_SESSION['nickname'], 'admin') === 0) {
            header("Location:backoffice.php");
        } else {
            header("Location:collection.php");
        }
    } else {
        // the member does not exist or the password is incorrect, so display an error message
        echo 'Invalid Nickname or Password';
    }

} else {
    // either the Nickname or Password field is empty, so display an error message
    echo 'Please enter your Nickname and Password';
}

?>