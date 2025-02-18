<?php
include 'temp/head.php';
include 'temp/database.php';
if (!empty($_SESSION['id_user'])) {
    include 'temp/navclient.php';
}
else {
    include 'temp/nav.php';
}

session_start();
//$id_user = $_SESSION['id_user'];
$sql = "SELECT * FROM zayavki";
$result=$mysqli->query($sql);
$row = mysqli_fetch_assoc($result);
?>
<div class="container">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="text-center">
                <br><br>
                <h1>Приветствуем!</h1>
                <p>Приветствуем вас на городском портале «Сделаем лучше вместе!» по приему заявок на устранение проблем в городе: ямочный ремонт дорог, ремонт детских площадок, зданий сооружений и т.д. </p>
                <p>Вы можете оставить заявку о проблеме и мы постараемся решить ее в кратчайшие сроки</p>
            </div><br>
        <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?
                    if (!empty($result)) {
                      # code...
    foreach($result as $row){
      if($row['status'] == 'Решена'){
         echo'  
    <div class="col">
    <div class="card">
      <img src="img/'.$row['img2'].'" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">'.$row['name'].'</h5>
        <p class="card-text">'.$row['description'].'</p>
        <p class="card-text">Статус: '.$row['status'].'</p>
        <p class="card-text">Категория: '.$row['id_category'].'</p>
      </div>
    </div>
  </div>';
}
}
      }
      ?>
        </div>
        <div class="col-1"></div>
    </div>
</div>