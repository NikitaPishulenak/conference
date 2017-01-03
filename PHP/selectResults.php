<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конференция</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<?php

function dirDel ($dir)
{
    $d=opendir($dir);
    while(($entry=readdir($d))!==false)
    {
        if ($entry != "." && $entry != "..")
        {
            if (is_dir($dir."/".$entry))
            {
                dirDel($dir."/".$entry);
            }
            else
            {
                unlink ($dir."/".$entry);
            }
        }
    }
    closedir($d);
    rmdir ($dir);
}


if(isset($_POST['selectResults']))
{
    include_once 'connect.php';
    $dbc=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
        or die ("Соединение не установлено");

    $date= date("j-M-G-i-s");
    $nameFolder="$date.csv";
    $folder="C://OpenServer/domains/localhost/conference/PHP/ConferenceData";
    $fol="ConferenceData";

    $query2="SELECT id_section FROM sections LIMIT 75";
    $result2=mysqli_query($dbc, $query2)
        or die ("Не удалось извлечь id папок");

    $query3="SELECT name_sectionName FROM sectionsName LIMIT 75";
    $result3=mysqli_query($dbc, $query3)
    or die ("Не удалось извлечь название папок");

    $titleFolders=array();
    $titleFolders[0]="example";

    while($row3=mysqli_fetch_assoc($result3))
    {
        $titleFolders[]=$row3['name_sectionName'];
        if (is_dir($fol.$row3['name_sectionName'])){
                //dirDel($fol.$row3['name_sectionName']);
                //echo ' Папка '.$fol.$row3['name_sectionName'].' уничтожена';
        }
        else
        {
            mkdir('ConferenceData/'.$row3['name_sectionName'].'',0777, true);
        }

    }

    //echo "<br>.Смотри.<br>";
    //print_r($titleFolders);

    while($row2=mysqli_fetch_array($result2))
    {
        $section=$row2['id_section'];
    }
//    echo '<br>'.$section.ob_get_length();

    for ($i=1; $i<=$section.ob_get_length(); $i++)
    {
        $query="SELECT 'Рабочий язык конференции (Language of the conference):', 'Название работы (Title of Paper)' , 'Фамилия автора (Author`s Surname):' , 'Имя автора (Author`s Name):' , 'Отчество автора (Author`s Second name):' , 'Дата рождения автора(birthdate):' , 'Город автора (City):' , 'Страна автора (Country):' , 'Полное название учебного заведения/организации автора (Full name of the institution which the Author represent):' , 'Сокращённое название учебного заведения/организации автора (Abbreviation of the institution, which the Author represent):' ,
                    'Статус автора (Status of the author):' , 'Факультет автора (faculty of the Author):' , 'Курс автора (Course):' , 'E-mail автора:' , 'Телефон автора (Telephone №):' , 'Фамилия соавтора (Surname of the Second Author):' , 'Имя соавтора (Name of the Second Author):' , 'Отчество соавтора (Second name of the Second Author):', 'Дата рождения соавтора (birtdate):' , 'Город соавтора (City):' , 'Страна соавтора (Country):' , 'Полное название учебного заведения/организации соавтора (Full name of the institution, which the Second author represent):' , 'Сокращённое название учебного заведения/организации соавтора (Abbreviation of the institution, which the Second author represent):' ,
                    'Статус соавтора (Status of the Second author):' , 'Факультет соавтора (faculty of the Second author):' , 'Курс соавтора (Course):' , 'E-mail соавтора:' , 'Телефон соавтора (Telephone №):' ,
                    'Фамилия 1-го научного руководителя (Surname of the 1st Supervisor):' , 'Имя 1-го научного руководителя (Name of the 1st Supervisor):' , 'Отчество 1-го научного руководителя (Second name of the 1st Supervisor):', 'Учёная степень 1-го научного руководителя (Scientific degree of the 1st Supervisor):' , 'Учёное звание 1-го научного руководителя (Academic rank of the 1st Supervisor)' ,  'Должность 1-го научного руководителя (Position of the 1st Supervisor):' , 'Полное название учебного заведения/организации 1-го научного руководителя (Full name of the 1st Supervisor institution):' , 'Название кафедры / структурного подразделения 1-го научного руководителя (Department):' , 'Город 1-го научного руководителя (City):' , 'E-mail 1-го научного руководителя (E-mail  of the 1st Supervisor):' , 'Телефон 1-го научного руководителя (Telephone № of the 1st Supervisor):' ,
                    'Фамилия 2-го научного руководителя (Surname of the 2nd Supervisor):' , 'Имя 2-го научного руководителя (Name of the 2nd Supervisor):' , 'Отчество 2-го научного руководителя (Second name of the 2nd Supervisor):' , 'Учёная степень 2-го научного руководителя (Scientific degree of the 2nd Supervisor):' , 'Учёное звание 2-го научного руководителя (Academic rank of the 2nd Supervisor)' , 'Должность 2-го научного руководителя (Position of the 2nd Supervisor):' , 'Полное название учебного заведения/организации 2-го научного руководителя (Full name of the 2nd Supervisor institution):' , 'Название кафедры / структурного подразделения 2-го научного руководителя (Department):' , 'Город 2-го научного руководителя (City):' , 'E-mail 2-го научного руководителя (E-mail  of the 2nd Supervisor):' , 'Телефон 2-го научного руководителя (Telephone № of the 2nd Supervisor):' ,
                    'Секция (Section):' , 'Форма участия (The form of participation):' , 'Cодержание доклада (Content report):'
            UNION
            (SELECT L.name_language, R.title_report, U.secondnameUser, U.firstnameUser, U.midlenameUser, U.birthdate, U.city, U.country, U.fullNameInstitute, U.abbreviationInstitute, S.name_status, U.nameFaculti, courses.name_course, U.email, U.telephone,

                    U2.secondnameUser, U2.firstnameUser, U2.midlenameUser, U2.birthdate, U2.city, U2.country, U2.fullNameInstitute, U2.abbreviationInstitute, S2.name_status, U2.nameFaculti, cours.name_course, U2.email, U2.telephone,

                    B.secondnameBoss, B.firstnameBoss, B.midlnameBoss, SD.name_scientificDegree,AR.name_academicRanks,PS.name_positionSupervisor, B.fullNameInstitute, B.name_department,B.city, B.email, B.telephone,

                    B2.secondnameBoss, B2.firstnameBoss, B2.midlnameBoss, SD2.name_scientificDegree,AR2.name_academicRanks,PS2.name_positionSupervisor, B2.fullNameInstitute, B2.name_department,B2.city, B2.email, B2.telephone,

                    SEC.name_section, formParticipation.name_formParticipation, contentsReport.name_contentsReport

                    INTO OUTFILE '$folder/$titleFolders[$i]/$nameFolder'
                    FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"'
                    LINES TERMINATED BY '' TERMINATED BY '\r\n'

                    FROM languages AS L
                    INNER JOIN conference AS C on (C.id_languages=L.id_language)
                    INNER JOIN users AS U ON (C.id_user1=U.id_user)
                    INNER JOIN reports AS R ON (R.id_report=C.id_report)
                    INNER JOIN statuses AS S ON (S.id_status=U.id_status)
                    INNER JOIN courses ON (courses.id_course=U.id_course)

                    INNER JOIN users AS U2 ON (U2.id_user=C.id_user2)
                    INNER JOIN statuses AS S2 ON (S2.id_status=U2.id_status)
                    INNER JOIN courses AS cours ON (cours.id_course=U2.id_course)

                    INNER JOIN boss AS B ON (B.id_boss=C.id_boss1)
                    INNER JOIN scientificDegree AS SD ON (SD.id_scientificDegree=B.id_scientificDegree)
                    INNER JOIN academicRanks AS AR ON (AR.id_academicRanks=B.id_academicRanks)
                    INNER JOIN positionSupervisor AS PS ON (PS.id_positionSupervisor=B.id_positionSupervisor)

                    INNER JOIN boss AS B2 ON (B2.id_boss=C.id_boss2)
                    INNER JOIN scientificDegree AS SD2 ON (SD2.id_scientificDegree=B2.id_scientificDegree)
                    INNER JOIN academicRanks AS AR2 ON (AR2.id_academicRanks=B2.id_academicRanks)
                    INNER JOIN positionSupervisor AS PS2 ON (PS2.id_positionSupervisor=B2.id_positionSupervisor)

                    INNER JOIN sections AS SEC ON (SEC.id_section=R.id_sections)
                    INNER JOIN formParticipation ON (formParticipation.id_formParticipation=R.id_formParticipation)
                    INNER JOIN contentsReport ON (contentsReport.id_contentsReport=R.id_contentReport)
                    
                    WHERE SEC.id_section='$i'
                    
                    )";

        $result=mysqli_query($dbc, $query);
        if(!isset($result))
        {
            echo "Запрос не выполнен $folder/$titleFolders[$i]/$nameFolder <br>";
        }
       else
       {
           echo" Создана директория $folder/$titleFolders[$i]/$nameFolder <br>";
       }
    }



    mysqli_close($dbc);

    echo "данные успешно извлечены ";
    exit();
}

?>

<div id="conteiner">
    <form method="post" action="">
        <input type="submit" name="selectResults" value="Извлечь данные">
    </form>
</div>


</body>
</html>