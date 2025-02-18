<?php
include 'temp/head.php';
include 'temp/database.php';
include 'temp/nav.php';
$message = '';
    if(!empty($_POST)){
        $login = $_POST['login'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE login = '$login' AND password ='$password'";
        $result=$mysqli->query($sql);
        $user=mysqli_fetch_assoc($result);
            
        if (!empty($user)) {
        session_start();
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['fio'] = $user['fio'];
        $_SESSION['role'] = $user['role'];
        if($_SESSION["role"] =='1'){
         header("location: lk.php");
        }
        if($_SESSION["role"] =='2'){
         header("location: adminpanel.php");
        }
        } 
        else {
            $message = 'Логин или пароль введены неверно, пожалуйста повторите попытку';
        } 
    }
?>
<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <br>
            <br>
            <div class="text-center">
                <h1>Авторизация</h1>
            </div>
            
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" class="form-control" name="login" id="login">
                    </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Логин</label>
                    <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Войти</button><br>
                    <?php echo $message; ?>
            </form>
        </div>
        <div class="col-3"></div>
    </div>
</div>