<?php
include 'temp/head.php';
include 'temp/database.php';
include 'temp/nav.php';
$message = '';
    if(!empty($_POST)){
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $fio = $_POST['fio'];
        $email = $_POST['email'];
        if($password == $password2){
        $sql = "INSERT INTO users(login, password, fio, email) VALUES ('$login', '$password', '$fio', '$email')";
        $result=$mysqli->query($sql);
        $message = 'Вы успешно зарегистрированы';
        header("location: login.php");
        }
        else {
            $message = 'Пароли не совпадают';
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
                <h1>Регистрация</h1>
            </div>
            
            <form action="registration.php" method="POST">
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" class="form-control" name="login" id="login" required>
                    </div>
                <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Повторите пароль</label>
                    <input type="password" class="form-control" name="password2" id="password2" required>
                    </div>
                <div class="mb-3">
                    <label for="fio" class="form-label">ФИО</label>
                    <input type="text" class="form-control" name="fio" id="fio" required>
                    </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Электронная почта</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Зарегистрироваться</button>
                    <br>
                    <?php echo $message; ?>
            </form>
        </div>
        <div class="col-3"></div>
    </div>
</div>