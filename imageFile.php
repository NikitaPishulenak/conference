<?php
if(isset($_POST['createpdf']))
{
    $post = $_POST;
    $error = "";
    $file_folder = "ConferenceData/"; // папка с файлами
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

    echo $error;
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

            <?php
            $path="ConferenceData\\";

            $files = scandir($path);
            echo '<ol>';
            foreach ($files as $value)
            {
                if ($value !='.' and $value !='..' )
                {
                    echo '<b>'.$value.'</b><br>';
                    $filVlo=scandir($path.$value);
                    echo '<ul>';
                    foreach ($filVlo as $val)
                    {
                        if($val !='.' and $val != '..')
                        {
                            echo '<input type="checkbox" name="files[]" value="'.$value.'/'.$val.'" /><i>'.$val.'</i><br><br>';
                        }
                    }
                    echo '</ul>';
                }
                else{}
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

            <input type="checkbox" name="sel_all" title="выбрать все" onclick="checkChoice(this.form)">выбрать все<br>
            <button name="createpdf" id="download"><b>Скачать ZIP архивом/  Download as ZIP</b></button>
            <input type="reset" name="reset"  value="Reset" />
        </div>

    </form>
</div>

</body>
</html>