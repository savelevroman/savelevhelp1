
<?php
include 'temp/head.php';
include 'temp/database.php';
include 'temp/navclient.php';
session_start();
        $id_user = $_SESSION['id_user'];
        $sql = "SELECT * FROM category";
        $resultc=$mysqli->query($sql);
$uploadDirectory = "img/"; // Папка для загрузки
$maxFileSize = 2097152; // 2MB (в байтах)
$allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif']; // Разрешенные типы файлов

$uploadErrors = [
    UPLOAD_ERR_OK => 'Файл успешно загружен.',
    UPLOAD_ERR_INI_SIZE => 'Размер файла превышает допустимый размер, указанный в php.ini.',
    UPLOAD_ERR_FORM_SIZE => 'Размер файла превышает допустимый размер, указанный в HTML-форме.',
    UPLOAD_ERR_PARTIAL => 'Файл был загружен только частично.',
    UPLOAD_ERR_NO_FILE => 'Файл не был загружен.',
    UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
    UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
    UPLOAD_ERR_EXTENSION => 'Загрузка файла прервана расширением PHP.',
];

$uploadMessage = "";
$uploadStatus = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {

        $fileTmpName = $_FILES["image"]["tmp_name"];
        $fileName = basename($_FILES["image"]["name"]);
        $fileSize = $_FILES["image"]["size"];
        $fileType = $_FILES["image"]["type"];

        // Валидация типа файла
        if (!in_array($fileType, $allowedFileTypes)) {
            $uploadMessage = "Ошибка: Разрешены только файлы JPEG, PNG и GIF.";
            $uploadStatus = "error";
        }
        // Валидация размера файла
        elseif ($fileSize > $maxFileSize) {
            $uploadMessage = "Ошибка: Размер файла превышает 2MB.";
            $uploadStatus = "error";
        }
        else {
            // Generate a unique filename
            $uniqueName = uniqid() . "_" . $fileName;
            $destination = $uploadDirectory . $uniqueName;

            if (move_uploaded_file($fileTmpName, $destination)) {
                $uploadMessage = "Файл успешно загружен. <br>Имя файла: " . htmlspecialchars($uniqueName) . "<br>Путь: " . htmlspecialchars($destination);
                $uploadStatus = "success";
                $name = $_POST['name'];
                $description = $_POST['description'];
                $id_category = $_POST['id_category'];
                $sql = "INSERT INTO zayavki( id_user, name, description, img1, id_category) VALUES ('$id_user', '$name', '$description', '$uniqueName', '$id_category')";
                $result=$mysqli->query($sql);
            } else {
                $uploadMessage = "Ошибка при перемещении файла.";
                $uploadStatus = "error";
            }
        }
    } else {
        if (isset($_FILES["image"])) {
            $errorCode = $_FILES["image"]["error"];
            $uploadMessage = "Ошибка загрузки: " . (isset($uploadErrors[$errorCode]) ? $uploadErrors[$errorCode] : "Неизвестная ошибка");
            $uploadStatus = "error";
        } else {
            $uploadMessage = "Пожалуйста, выберите файл для загрузки.";
            $uploadStatus = "error";
        }

    }
}

?>

<?php if ($uploadMessage): ?>
    <p class="<?php echo $uploadStatus; ?>"><?php echo $uploadMessage; ?></p>
<?php endif; ?>
<div class="container">
    <div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="mb-3">
  <label for="description" class="form-label">Описание</label>
  <textarea class="form-control" id="description" name="description" rows="3"></textarea>
</div>
<div class="mb-3">
    <label for="image">Выберите изображение для загрузки:</label>
    <input type="file" name="image" id="image">
    </div>
                <div class="mb-3">
                <select class="form-select" name="id_category" id="id_category">
                    <?
    foreach($resultc as $row){
        echo'<option value="'.$row['id_category'].'">'.$row['name_category'].'</option>';
    }
                    ?>
</select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Создать заявку</button><br>
</form>

    </div>
    <div class="col-3"></div>
</div></div>