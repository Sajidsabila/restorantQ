<?php
include ("../config/database.php");
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);


    $sql = "select id, name from users where username = '$username' and password='$password'";
    $result = mysqli_query($db, $sql);

    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        header('Location: ../dashboard');

    } else {
        header("Location: index.php?status=login_error");

    }
}
?>