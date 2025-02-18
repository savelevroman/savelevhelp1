<?php
include 'temp/head.php';
include 'temp/database.php';
include 'temp/navadmin.php';
session_start();
$sql = "SELECT * FROM category";
$resultc=$mysqli->query($sql);
    if(!empty($_POST)){
        $name_category = $_POST['name_category'];
        $sql = "INSERT INTO category (name_category) VALUES ('$name_category')";
        $result=$mysqli->query($sql);
        header("location: adminpanel.php");
    }
?>
<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <form action="addcategory.php" method="POST">
                <div class="mb-3">
                    <label for="name_category" class="form-label">Название категории</label>
                    <input type="text" class="form-control" name="name_category" id="name_category">
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Добавить</button><br>
            </form>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Категории</th>
    </tr>
  </thead>
  <tbody>
                    <?
    foreach($resultc as $row){
    echo'<tr>
      <td>'.$row['name_category'].'</td>
      <td><a href="delcategory.php?id_category='.$row['id_category'].'">Удалить</a></td>
    </tr>';
    }
                    ?>
  </tbody>
</table>
        </div></div></div>