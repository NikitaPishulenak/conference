<?php
if(isset($_POST['btnDownload']))
{
    $error = "";
    $file_folder = "DATA/"; // папка с файлами
    if(extension_loaded('zip'))
    {
        if(isset($_POST['files']) and count($_POST['files']) > 0)
        {
            // проверяем выбранные файлы
            $zip = new ZipArchive(); // подгружаем библиотеку zip
            $zip_name = time().".zip"; // имя файла
            if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)
            {
                $error .= "* Sorry ZIP creation failed at this time";
            }
            foreach($_POST['files'] as $file)
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

    //echo $error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конференция</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="conteiner">
    <form name="zips" method="post">
        <h1>Выберите файлы для скачивания <br> Select files to download</h1>

            <?php
            $path="DATA/";

            $files = scandir($path);
            echo '<ol>';
            foreach ($files as $value)
            {
                if ($value !='.' and $value !='..' )
                {
                    echo '<b>'.$value.'</b><br>';
                    $attachedFile=scandir($path.$value);
                    echo '<ul>';
                    foreach ($attachedFile as $attachedValue)
                    {
                        if($attachedValue !='.' and $attachedValue != '..')
                        {
                            echo '<input type="checkbox" name="files[]" value="'.$value.'/'.$attachedValue.'" /><i>'.$attachedValue.'</i><br><br>';
                        }
                    }
                    echo '</ul>';
                }
            }
            echo '</ol>';
            ?>

        <div id="panelDownload">

                <script>
                function checkChoice(f) {
                    for (i = 0; i < f.length-1; i++)
                        f[i].checked = true;
                }
                </script>

            <input type="checkbox" name="sel_all" title="выбрать все" onclick="checkChoice(this.form)">Выбрать все / Select All<br>
            <input type="reset" class="manageButton" name="reset"  value="Отменить выбор/Cansel select"/><br><br>
            <button name="btnDownload" id="download"><b>Скачать ZIP архивом/  Download as ZIP</b></button>
        </div>

    </form>
</div>

</body>
</html>