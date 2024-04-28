<?php
include ("../config/database.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    try {
        $sql = "DELETE FROM receipt_details where id = '$id'";
        $query = mysqli_query($db, $sql);

        if ($query) {
            header('Location: add.php?success=delete_sukses');
        } else {
            header('Location: add.php?status=gagal');
        }
    } catch (Exception $exception) {
        header('Location: add.php?error=' . $error = $exception->getMessage());
    }
} else {
    die("Akses dilarang...");
}
?>