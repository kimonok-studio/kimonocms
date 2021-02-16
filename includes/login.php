<?php
include "db.php";
?>

<?php
session_start(); // Turns on the sessions.
?>

<?php
$errorMessageLogin = "";
?>

<?php
if (isset($_POST['login'])) {
    
    // CHECK IF ISSET
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        header("Location: ../index.php?error=1");
        exit;
    }
    
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);   
    
    // FORM VALIDATIE
    if(empty($username) || empty($password)) {
        header("Location: ../index.php?error=1");
        exit;
    }

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    
    if (!$select_user_query) {
        die("Query failed" . mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_assoc($select_user_query)) { //array.
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }
    
    // AUTHENTICATIE CHECK.
    if ($username === $db_username && password_verify($password, $db_user_password) && $db_user_role == "admin") {
        $_SESSION['username'] = $db_username;
        $_SESSION['password'] = $password;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        header("Location: ../admin");
        exit;
        
    } else {
        header("Location: ../index.php?error=2");
        exit;
    }
}
?>