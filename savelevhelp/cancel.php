<?php
include 'temp/head.php';
include 'temp/database.php';
include 'temp/navadmin.php';
        $id_zayavki = $_GET['id_zayavki'];
        if(!empty($_POST)){
                $reason = $_POST['reason'];
                $id_zayavki = $_POST['id_zayavki'];
        $sql = "UPDATE zayavki SET status='Отклонена', reason='$reason' WHERE id_zayavki='$id_zayavki'";
        $result=$mysqli->query($sql);
        var_dump($sql);
        header("location: lk.php");
        }
?>
<br>
<br>
<div class="container">
        <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
                
            <form action="cancel.php" method="POST">
                <div class="mb-3">
                    <label for="reason" class="form-label">Причина отказа</label>
                    <input type="text" class="form-control" name="reason" id="reason" required>
                    <input type="text" class="form-control" name="id_zayavki" value="<? echo $id_zayavki;?>">
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Войти</button><br>

</form>
        </div>
        <div class="col-3"></div></div>
</div>