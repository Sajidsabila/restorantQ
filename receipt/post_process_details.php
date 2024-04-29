<?php
session_start();
include ("../config/database.php");
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $id_receipts = $_POST['id_receipts'];
    $menus = $_POST['nameMenus'];
    $array = explode(",", $menus);
    $id_menus = $array[0];
    $price = $array[1];
    $amount = $_POST['amount'];
    $note = $_POST['note'];

    try {
        if ($id) {
            $sql = "UPDATE receipt_details SET 
                    receipt_id = '$id_receipts',
                    menu_id='$id_menus', 
                    amount='$amount',
                    price = '$price',
                    note = '$note'
                    WHERE
                     id='$id'";

        } else {
            $sql = "INSERT INTO receipt_details (receipt_id, menu_id, amount, price, note)
     VALUES ('$id_receipts', '$id_menus', '$amount', '$price', '$note')";

        }
        $result = mysqli_query($db, $sql);

        if ($result) {
            header("Location: add.php?success=eksekusi suksess" . "&id=$id_receipts");
        } else {
            header("Location: add.php?error=error_add" . "&id=$id_receipts");

        }
    } catch (Exception $exception) {
        header('Location: add.php?error=' . $error = $exception->getMessage());
    }
}
?>