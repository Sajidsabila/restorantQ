<?php
include ("../config/database.php");
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $note = $_POST['note'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    try {
        if ($id) {
            $sql = "UPDATE menus SET 
            name='$name', 
            category_id ='$category',
            note='$note',
            price = '$price'
            WHERE 
            id='$id'";

        } else {
            $sql = "INSERT INTO menus(name, category_id, note, price, status)
     VALUES ('$name', '$category', '$note', '$price', '$status')";

        }
        $result = mysqli_query($db, $sql);
        if ($result) {
            header("Location: index.php?success=eksekusi suksess");

        } else {
            header("Location: index.php?error=error_add");

        }
    } catch (Exception $exception) {
        header('Location: index.php?error=' . $error = $exception->getMessage());
    }
}
?>