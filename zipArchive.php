<?php

if(isset($_POST['createpdf']))
{
    $post = $_POST;
    $error = "";
    $file_folder = "files/"; // папка с файлами
    if(extension_loaded('zip'))
    {
        if(isset($post['files']) and count($post['files']) > 0)
        {
            // проверяем выбранные файлы
            $zip = new ZipArchive(); // подгружаем библиотеку zip
            $zip_name = time().".zip"; // имя файла
            if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)
            {
                $error .= "* Sorry ZIP creation failed at this time";
            }
            foreach($post['files'] as $file)
            {
                $zip->addFile($file_folder.$file); // добавляем файлы в zip архив
            }
            $zip->close();
            if(file_exists($zip_name))
            {
                // отдаём файл на скачивание
                header('Content-type: application/zip');
                header('Content-Disposition: attachment; filename="'.$zip_name.'"');
                readfile($zip_name);

                // удаляем zip файл если он существует
               unlink($zip_name);
            }
        }
        else
            $error .= "* Please select file to zip ";

    }
    else
        $error .= "* You dont have ZIP extension";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<form name="zips" method="post">
    <input type="checkbox" name="files[]" value="flowers.jpg" />

    <img src="files/image.png" />

    flowers.jpg

    <input type="checkbox" name="files[]" value="fun.jpg" />

    <img src="files/image.png" />

    fun.jpg

    <input type="checkbox" name="files[]" value="lessons.docx" />

    <img src="files/doc.png"   />
    lessons.docx

    <input type="submit" name="createpdf" value="Download as ZIP" />

    <input type="reset" name="reset"  value="Reset" />
</form>


</body>
</html>


