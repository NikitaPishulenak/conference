<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конференция</title>
    <link rel="stylesheet" href="style.css">
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
    mysqli_query($dbc,"SET NAMES 'UTF8'");

    $date= date("j-M-G-i-s");
    $nameFolder="$date.csv";

    $folder="C:\\OpenServer\\domains\\localhost\\conference\\ConferenceData";
    $folderE="C://OpenServer/domains/localhost/conference/ConferenceData";

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
        $curDir=$folder.'\\'.$row3['name_sectionName'];
        if (is_dir($curDir))
        {
                dirDel($curDir);
                echo "Папка ".$curDir." уничтожена <br>";
        }
        mkdir($curDir,0777, true);
        echo "создана папка $curDir <br>";
    }

    while($row2=mysqli_fetch_array($result2))
    {
        $section=$row2['id_section'];
    }

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

                    INTO OUTFILE '$folderE/$titleFolders[$i]/$nameFolder'
                    FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"'
                    LINES TERMINATED BY '' TERMINATED BY '\r\n'

                    FROM languages AS L
                    INNER JOIN conference AS C on (C.id_languages=L.id_language)
                    INNER JOIN users AS U ON (C.id_user1=U.id_user)
                    INNER JOIN reports AS R ON (R.id_report=C.id_report)
                    LEFT JOIN statuses AS S ON (S.id_status=U.id_status)
                    LEFT JOIN courses ON (courses.id_course=U.id_course)

                    LEFT JOIN users AS U2 ON (U2.id_user=C.id_user2)
                    LEFT JOIN statuses AS S2 ON (S2.id_status=U2.id_status)
                    LEFT JOIN courses AS cours ON (cours.id_course=U2.id_course)

                    LEFT JOIN boss AS B ON (B.id_boss=C.id_boss1)
                    LEFT JOIN scientificDegree AS SD ON (SD.id_scientificDegree=B.id_scientificDegree)
                    LEFT JOIN academicRanks AS AR ON (AR.id_academicRanks=B.id_academicRanks)
                    LEFT JOIN positionSupervisor AS PS ON (PS.id_positionSupervisor=B.id_positionSupervisor)

                    LEFT JOIN boss AS B2 ON (B2.id_boss=C.id_boss2)
                    LEFT JOIN scientificDegree AS SD2 ON (SD2.id_scientificDegree=B2.id_scientificDegree)
                    LEFT JOIN academicRanks AS AR2 ON (AR2.id_academicRanks=B2.id_academicRanks)
                    LEFT JOIN positionSupervisor AS PS2 ON (PS2.id_positionSupervisor=B2.id_positionSupervisor)

                    LEFT JOIN sections AS SEC ON (SEC.id_section=R.id_sections)
                    LEFT JOIN formParticipation ON (formParticipation.id_formParticipation=R.id_formParticipation)
                    LEFT JOIN contentsReport ON (contentsReport.id_contentsReport=R.id_contentReport)

                    WHERE SEC.id_section='$i'
                    )";

        $result=mysqli_query($dbc, $query);

        $queryCountInSection="SELECT reports.id_report, reports.title_report
                                From reports
                                WHERE reports.id_sections='$i'";
        $resultCountInSection=mysqli_query($dbc, $queryCountInSection)
            or die("Папки doc не извлечены");

        while($str=mysqli_fetch_array($resultCountInSection))
        {
            include_once 'PHPWord.php';
            $word=new PHPWord();

            $word->setDefaultFontName('Times New Roman');

            $queryData="SELECT reports.title_report, U1.secondnameUser AS secondnameFA, U1.firstnameUser AS firstnameFA, U1.midlenameUser AS midlenameFA,
                          U2.secondnameUser AS secondnameSA, U2.firstnameUser AS firstnameSA, U2.midlenameUser AS midlenameSA,
                          U1.fullNameInstitute, U1.city, SD1.name_scientificDegree AS scientificDegreeFB, AR1.name_academicRanks AS academicRanksFB,
                          SD2.name_scientificDegree AS scientificDegreeSB, AR2.name_academicRanks AS academicRanksSB, B1.fullNameInstitute AS univerFB,
                          B1.city AS cityFB, reports.introduction, reports.aim, reports.materialsAndMethods, reports.results, reports.conclusions, B1.firstnameBoss AS firstnameFB,
                          B1.secondnameBoss AS secondnameFB, B1.midlnameBoss AS midlenameFB, B2.firstnameBoss AS firstnameSB, B2.secondnameBoss AS secondnameSB,
                          B2.midlnameBoss AS midlenameSB
                        FROM reports
                        INNER JOIN conference ON (conference.id_report=reports.id_report)
                        INNER JOIN users AS U1 ON (conference.id_user1=U1.id_user)
                        INNER JOIN users AS U2 ON (conference.id_user2=U2.id_user)
                        INNER JOIN boss AS B1 ON (conference.id_boss1=B1.id_boss)
                        INNER JOIN scientificDegree AS SD1 ON (B1.id_scientificDegree=SD1.id_scientificDegree)
                        INNER JOIN academicRanks AS AR1 ON (B1.id_academicRanks=AR1.id_academicRanks)

                        INNER JOIN boss AS B2 ON (conference.id_boss2=B2.id_boss)
                        INNER JOIN scientificDegree AS SD2 ON (B2.id_scientificDegree=SD2.id_scientificDegree)
                        INNER JOIN academicRanks AS AR2 ON (B2.id_academicRanks=AR2.id_academicRanks)
                        WHERE reports.id_report='".$str['id_report']."'";
            $resultData=mysqli_query($dbc, $queryData)
                or die("Запрос по извлечению содержимого не выполнен");
            while($data=mysqli_fetch_array($resultData))
            {
                $title=$data['title_report'];
                $intro=$data['introduction'];
                $aim=$data['aim'];
                $materials=$data['materialsAndMethods'];
                $results=$data['results'];
                $conclusions=$data['conclusions'];

                $secondnameFA=$data['secondnameFA'];
                $firstnameFA=$data['firstnameFA'];
                $midlenameFA=$data['midlenameFA'];

                $secondnameSA=$data['secondnameSA'];
                $firstnameSA=$data['firstnameSA'];
                $midlenameSA=$data['midlenameSA'];

                $univerA=$data['fullNameInstitute'];
                $cityA=$data['city'];

                $scientificDegree=$data['scientificDegreeFB'];
                $rank=$data['academicRanksFB'];
                $scientificDegree2=$data['scientificDegreeSB'];
                $rank2=$data['academicRanksSB'];
                $univerFB=$data['univerFB'];
                $cityFB=$data['cityFB'];

                $secondnameFB=$data['secondnameFB'];
                $firstnameFB=$data['firstnameFB'];
                $midlenameFB=$data['midlenameFB'];
                $secondnameSB=$data['secondnameSB'];
                $firstnameSB=$data['firstnameSB'];
                $midlenameSB=$data['midlenameSB'];

                $template = $word->loadTemplate('template.docx'); //Загружаем шаблон
                $template->setValue('title', $title); //Производим замену метки на значение
                $template->setValue('secondnameFA', $secondnameFA); //И еще одну метку
                $template->setValue('firstnameFA', $firstnameFA); //И еще одну метку
                $template->setValue('midlenameFA', $midlenameFA); //И еще одну метку

                $template->setValue('secondnameSA', $secondnameSA); //И еще одну метку
                $template->setValue('firstnameSA', $firstnameSA); //И еще одну метку
                $template->setValue('midlenameSA', $midlenameSA); //И еще одну метку

                $template->setValue('univer', $univerA); //И еще одну метку
                $template->setValue('city', $cityA); //И еще одну метку
                $template->setValue('degree', $scientificDegree); //И еще одну метку
                $template->setValue('rank', $rank); //И еще одну метку
                $template->setValue('degree2', $scientificDegree2); //И еще одну метку
                $template->setValue('rank2', $rank2); //И еще одну метку

                $template->setValue('secondnameS', $secondnameFB); //И еще одну метку
                $template->setValue('firstnameS', $firstnameFB); //И еще одну метку
                $template->setValue('midlenameS', $midlenameFB); //И еще одну метку
                $template->setValue('secondnameSS', $secondnameSB); //И еще одну метку
                $template->setValue('firstnameSS', $firstnameSB); //И еще одну метку
                $template->setValue('midlenameSS', $midlenameSB); //И еще одну метку
                $template->setValue('univerS', $univerFB);
                $template->setValue('cityS', $cityFB);

                $template->setValue('intro', $intro); //И еще одну метку
                $template->setValue('aim', $aim); //И еще одну метку
                $template->setValue('material', $materials); //И еще одну метку
                $template->setValue('results', $results);
                $template->setValue('conclusion', $conclusions);

                $template->save('ConferenceData/'.$titleFolders[$i].'/'.$str['id_report'].'.docx'); //Сохраняем результат в файл
            }

        }

    }

    mysqli_close($dbc);

    echo "работа с данными окончена";
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