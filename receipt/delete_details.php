<?php
include ("../config/database.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $receipt_id = $_POST['receipt_id'];
    try {
        $sql = "DELETE FROM receipt_details where id = '$id'";
        $query = mysqli_query($db, $sql);

        if ($query) {
            header('Location: add.php?success=delete_sukses' . "&id=$receipt_id");
        } else {
            header('Location: add.php?status=gagal' . "&id=$receipt_id");
        }
    } catch (Exception $exception) {
        header('Location: add.php?error=' . $error = $exception->getMessage() . "id=$receipt_id");
    }
} else {
    die("Akses dilarang...");
}
?>