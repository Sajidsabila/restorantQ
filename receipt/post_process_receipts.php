<?php
session_start();
include ("../config/database.php");
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $user_id = $_SESSION['user_id'];

    try {
        if ($id) {
            $sql = "UPDATE receipts SET 
                    user_id = '$user_id',
                    customer_name='$name', 
                    status='$status',
                    receipt_date = Now()
                    WHERE id='$id'";

        } else {
            $sql = "INSERT INTO receipts (user_id, customer_name, status, receipt_date)
     VALUES ('$user_id', '$name', '$status', Now())";

        }

        $result = mysqli_query($db, $sql);
        if (!$id) {
            $id = mysqli_insert_id($db);
        }
        if ($result) {

            header("Location: add.php?success=eksekusi suksess&recipt_id= " . "&id=$id");
        } else {
            header("Location: add.php?error=error_add" . "&id=$id");

        }
    } catch (Exception $exception) {
        header('Location: add.php?error=' . $error = $exception->getMessage());
    }
}
?>