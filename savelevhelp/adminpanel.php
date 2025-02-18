<?php
include 'temp/head.php';
include 'temp/database.php';
include 'temp/navadmin.php';
session_start();
$sql = "SELECT * FROM zayavki";
$resultc=$mysqli->query($sql);
?>
<div class="container">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
        <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?
                    if (!empty($resultc)) {
                      # code...
    foreach($resultc as $row){
      if($row['status'] == 'Новая'){
         echo'  
    <div class="col">
    <div class="card">
      <img src="img/'.$row['img1'].'" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">'.$row['name'].'</h5>
        <p class="card-text">'.$row['description'].'</p>
        <p class="card-text">Статус: '.$row['status'].'</p>
        <p class="card-text">Категория: '.$row['id_category'].'</p>
<a href="accept.php?id_zayavki='.$row['id_zayavki'].'"><button type="submit" class="btn btn-success">Принять</button></a>
<a href="cancel.php?id_zayavki='.$row['id_zayavki'].'"><button type="submit" class="btn btn-danger">Отклонить</button></a>
      </div>
    </div>
  </div>';
      }
       else{
        echo'  
          <div class="col">
          <div class="card">
            <img src="img/'.$row['img1'].'" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">'.$row['name'].'</h5>
              <p class="card-text">'.$row['description'].'</p>
        <p class="card-text">Статус: '.$row['status'].'</p>
            </div>
          </div>
        </div>';
       }
    }
                    }
                    else{
                      echo'<h3>Заявок нет</h3>';
                    }
                    ?>

</div>
        </div>
        <div class="col-1"></div>
    </div>
</div>