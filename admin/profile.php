<?php
include "includes/admin_header.php";
?>
                    
<?php
// Globale variabelen
$message = "";
?>
                     
<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_profile_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_array($select_user_profile_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}
?>
      
<?php
if (isset($_POST['edit_user'])) {
    
    $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
    $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
    $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
    
    if (!preg_match("/^[a-zA-Z0-9]*$/", $user_firstname) || !preg_match("/^[a-zA-Z0-9]*$/", $user_lastname) || !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $message = "U moet de juiste voornaam, achternaam of gebruikersnaam intikken die mag alleen grote of kleine letters of nummers van 0-9 bevatten";
        
    } else if (empty($user_firstname) || empty($user_lastname) || empty($user_role) || empty($username) || 
               empty($user_email) || empty($user_password)) {
        $message = "Zorg dat u alle velden ingevuld hebt."; 

    } else {
        $query  = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$user_password}' ";
        $query .= "WHERE user_id = '{$user_id}' "; // You need the id from hidden form field.

        $edit_user_query = mysqli_query($connection, $query);
        $_SESSION['username'] = $username; // The new post is also in the session now.
        confirmQuery($edit_user_query);
        header("Location: users.php"); // Redirect to users.php
    }
    
//    $user_firstname = $_POST['user_firstname'];
//    $user_lastname = $_POST['user_lastname'];
//    $user_role = $_POST['user_role'];
    
//    $post_image = $_FILES['image']['name']; // Is needed for images, name, the actual img.
//    $post_image_temp = $_FILES['image']['tmp_name']; // Temporary location.
    
  
    
//    $username = $_POST['username']; // Modification Lesson 162.
//    $user_email = $_POST['user_email'];
//    $user_password = $_POST['user_password'];
    
//    $post_date = date('d-m-y');
    
//    move_uploaded_file($post_image_temp, "../images/$post_image " ); // Temp to real img loc.
}
?>
       
        <div id="wrapper">

        <!-- Navigation -->
        <?php
        include "includes/admin_navigation.php";
        ?>
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                         <h1 class="page-header">
                             Welcome to admin
                            <small>Author</small>
                        </h1>
                        
                        <form action="" method="post" enctype="multipart/form-data">
                        
                            <span><?= $message; ?></span>
                        
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $user_id;?>" class="form-control" name="user_id">
                            </div>
    
                            <div class="form-group">
                                <label for="title">Firstname</label>
                                <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
                            </div>

                             <div class="form-group">
                                <label for="post_status">Lastname</label>
                                <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
                            </div>

                            <div class="form-group">
                                <select name="user_role" id="">

                                    <option value="subscriber"><?php echo $user_role; ?></option>

                                    <?php
                                    if ($user_role == 'admin') {
                                        echo "<option value='subscriber'>subscriber</option>";
                                    } else {
                                        echo "<option value='admin'>admin</option>";
                                    }
                                    ?>

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
                                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                            </div>

                            <div class="form-group">
                                <label for="post_content">Email</label>
                                <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
                            </div>

                            <div class="form-group">
                                <label for="post_content">Password</label>
                                <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        
<?php 
include "includes/admin_footer.php";
?>