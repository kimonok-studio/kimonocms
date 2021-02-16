<?php

function confirmQuery($result) {
    
    global $connection;
    
    if (!$result) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}

function insert_categories() {
    
    global $connection;
    
    if (isset($_POST['submit'])) {
        
    // SQL-injectie beveiliging d.m.v. mysqli_real_escape_string.    
    $cat_title = mysqli_real_escape_string($connection, $_POST['cat_title']);

    // Validation.
    if ($cat_title == "" || empty($cat_title)) {
        echo "This field should not be empty";

    // All fields filled in? - CREATE
    } else {
        $query = "INSERT INTO categories(cat_title) ";
        $query .= "VALUES('{$cat_title}') ";

        $create_category_query = mysqli_query($connection, $query);

        if (!$create_category_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        }
    }
}
}

function findAllCategories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>". htmlentities($cat_id) . "</td>"; // CMGT REFACTOR.
        echo "<td>". htmlentities($cat_title) ."</td>"; // CMGT REFACTOR.
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>"; // CMGT REFACTOR.
    }    
}

function deleteCategories() {
    global $connection;
    // Is the ?delete=x set? - DELETE
    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php"); // Refreshes the page.
    }    
}

?>