<?php
include ("../config/database.php");
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $note = $_POST['note'];
    try {
        if ($id) {
            $sql = "UPDATE categories SET 
                    name='$name', 
                    note='$note'
                    WHERE id='$id'";

        } else {
            $sql = "INSERT INTO categories(name, note)
     VALUES ('$name', '$note')";

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