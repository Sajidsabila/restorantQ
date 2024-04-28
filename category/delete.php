<?php
include ("../config/database.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    try {
        $sql = "DELETE FROM categories where id = '$id'";
        $query = mysqli_query($db, $sql);

        if ($query) {
            header('Location: index.php?success=delete_sukses');
        } else {
            header('Location: index.php?status=gagal');
        }
    } catch (Exception $exception) {
        header('Location: index.php?error=' . $error = $exception->getMessage());
    }
} else {
    die("Akses dilarang...");
}
?>