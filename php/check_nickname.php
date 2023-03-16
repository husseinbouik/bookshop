<?php
require('connect.php');

// check if nickname already exists in the database
if (isset($_POST['nickname'])) {
    $nickname = $_POST['nickname'];
    try {
        $sql = "SELECT * FROM Members WHERE Nickname = :nickname";
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':nickname' => $nickname));
        if($stmt->rowCount() > 0) {
            echo 'exists';
        } else {
            echo 'not exists';
        }
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
$db = null;
?>
