<?php
// Global variables
$message = "";

if (isset($_POST['create_user'])) {
    
    $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
    $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
    $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
    
  
//    $post_image = $_FILES['image']['name']; // Is needed for images, name, the actual img.
//    $post_image_temp = $_FILES['image']['tmp_name']; // Temporary location.
        
//    $post_date = date('d-m-y');
    
//    move_uploaded_file($post_image_temp, "../images/$post_image " ); // Temp to real img loc.
    
    // Hashing
    $user_password = password_hash($user_password, PASSWORD_DEFAULT);
    
    // Eventueel deze check weghalen.
    if (!empty($user_firstname) && !empty($user_lastname) && !empty($user_role) 
       && !empty($username) && preg_match("/^[a-zA-Z0-9]*$/", $username)
       && !empty($user_email) && !empty($user_password)) {
            $query = "INSERT INTO users( 
                        user_firstname, 
                        user_lastname, 
                        user_role,
                        username, 
                        user_email, 
                        user_password 
                     ) ";

            $query .= "VALUES(
                        '{$user_firstname}',
                        '{$user_lastname}',
                        '{$user_role}',
                        '{$username}',
                        '{$user_email}',
                        '{$user_password}'
            ) "; 
    
            $create_user_query = mysqli_query($connection, $query);
            confirmQuery($create_user_query);
    
            echo "User Created: <a href='users.php'>View Users</a>";
        
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $message = "U moet de juiste gebruikers intikken die mag alleen grote of kleine letters of nummers van 0-9 bevatten";
        
    } else if (empty($user_firstname) || empty($user_lastname) || empty($user_role) || empty($username) || 
               empty($user_email) || empty($user_password)) {
        $message = "Zorg dat u alle velden ingevuld hebt."; 

    } else {
        echo "Unexpected error has occured!";
    } 
}
?>

<form action="" method="post" enctype="multipart/form-data">
    
    <span><?= $message; ?></span>
    
    <!-- XSS beveiliging: <script> is onbruikbaar door preg_match -->
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    
     <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
     
<!--
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
-->
    
    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    
    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    
    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
    
</form>