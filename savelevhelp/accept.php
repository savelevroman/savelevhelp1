
<?php
include 'temp/head.php';
include 'temp/database.php';
include 'temp/NAVADMIN.php';
                $id_zayavki = $_GET['id_zayavki'];
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
                if(!empty($_POST)){
                        $id_zayavki = $_POST['id_zayavki'];
                $sql = "UPDATE zayavki SET status='Решена', img2='$uniqueName' WHERE id_zayavki='$id_zayavki'";
                $result=$mysqli->query($sql);
                var_dump($sql);
                header("location: adminpanel.php");
                }
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
    <label for="image">Выберите изображение для загрузки:</label>
    <input type="file" name="image" id="image">
    </div>                    <input type="text" class="form-control" name="id_zayavki" value="<? echo $id_zayavki;?>">

                    <button type="submit" class="btn btn-primary mb-3">Принять</button><br>
</form>

    </div>
    <div class="col-3"></div>
</div></div>