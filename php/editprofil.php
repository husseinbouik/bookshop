<?php
require('connect.php');



// Retrieve user ID from the hidden field in the form
$Nickname = $_POST['Nickname'];

// Retrieve user data from the database
$stmt = $db->prepare("SELECT * FROM Members WHERE Nickname = :Nickname");
$stmt->bindParam(':Nickname', $Nickname);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Retrieve values from the form submission
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

// Unhash the current password before checking if it matches the one in the database
if (password_verify($currentPassword, $row['Password'])) {
  // Check if the new password and confirmation password fields are the same
  if ($newPassword === $confirmPassword) {

    // Update the user data in the database
    $stmt = $db->prepare("UPDATE Members SET Firstname = :firstName, Lastname = :lastName, PhoneNumber = :phoneNumber, Email = :email, Password = :password WHERE Nickname = :Nickname");
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':phoneNumber', $phoneNumber);
    $stmt->bindParam(':email', $email);

    // Hash the new password before updating it in the database
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashedPassword);

    $stmt->bindParam(':Nickname', $Nickname);
    $stmt->execute();

    echo "User data updated successfully.";
    header("Location: profil.php");
    exit;

  } else {

    echo "New password and confirmation password fields do not match.";

  }

} else {

  echo "Current password is incorrect.";

}

?>
