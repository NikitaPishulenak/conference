<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конференция</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="conteiner">
    <?php

    ini_set('display_errors', 'On'); // сообщения с ошибками будут показываться
    error_reporting(E_ALL); // E_ALL - отображаем ВСЕ ошибки
    if(isset($_POST['selectResults']))
    {
        include 'excel.php';

        echo "<b>Данные успешно извлечены / Data successfully extracted </b><br>";
        echo "<h3><a href='imageFile.php'>Для скачивания кликните сюда / Click here, to download</a></h3>";
        echo"<img src='images/linkToDownload.jpg' alt='Link to download'>";

        exit();
    }

    ?>

    <form method="post" action="">
        <div>
            <h1> Для извлечения информации из базы данных, нажмите на кнопку "Извлечь данные"<br><br>To select information from the database, click on the "Extract Data" button</h1>
            <hr>
        </div>
        <button type="submit" name="selectResults">Извлечь данные / Extract Data</button><br><br>
    </form>
</div>


</body>
</html>