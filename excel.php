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

include 'connect.php';
$dbc=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
or die ("no connect");
mysqli_query($dbc, 'SET NAMES UTF8');

$folderDATA='DATA/';
$titleFolders=array();
$titleFolders[0]="example";

$query3="SELECT name_sectionName FROM sectionsName LIMIT 75";
$result3=mysqli_query($dbc, $query3)
or die ("Не удалось извлечь название папок");

while($row3=mysqli_fetch_assoc($result3))
{
    $titleFolders[]=$row3['name_sectionName'];
    $curDir='DATA/'.$row3['name_sectionName'];
   if (is_dir($curDir))
    {
        dirDel($curDir);
        //echo "Папка ".$curDir." уничтожена <br>";
    }
    mkdir($curDir,0777, true);
    //echo "создана папка $curDir <br>";

}

require_once 'Classes/PHPExcel.php';
for ($k=1; $k<76;$k++)
{
    $pExcel=new PHPExcel();

    $pExcel->setActiveSheetIndex(0);
    $aSheet = $pExcel->getActiveSheet();

// Ориентация страницы и  размер листа
    $aSheet->getPageSetup()
        ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
    $aSheet->getPageSetup()
        ->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
// Поля документа
    $aSheet->getPageMargins()->setTop(1);
    $aSheet->getPageMargins()->setRight(0.75);
    $aSheet->getPageMargins()->setLeft(0.75);
    $aSheet->getPageMargins()->setBottom(1);
// Название листа
    $aSheet->setTitle('Список участников секции');

    $pExcel->getDefaultStyle()->getFont()->setName('Arial');
    $pExcel->getDefaultStyle()->getFont()->setSize(10);


// Создаем шапку таблички данных
    $aSheet->setCellValue('A1','Рабочий язык конференции (Language of the conference):');
    $aSheet->setCellValue('B1','Название работы (Title of Paper):');
    $aSheet->setCellValue('C1','Фамилия автора (Author`s Surname):');
    $aSheet->setCellValue('D1','Имя автора (Author`s Name):');
    $aSheet->setCellValue('E1','Отчество автора (Author`s Second name):');
    $aSheet->setCellValue('F1','Дата рождения автора (birthdate):');
    $aSheet->setCellValue('G1','Город автора (City):');
    $aSheet->setCellValue('H1','Страна автора (Country):');
    $aSheet->setCellValue('I1','Полное название учебного заведения/организации автора (Full name of the institution which the Author represent):');
    $aSheet->setCellValue('J1','Сокращённое название учебного заведения/организации автора (Abbreviation of the institution, which the Author represent):');
    $aSheet->setCellValue('K1','Статус автора (Status of the author):');
    $aSheet->setCellValue('L1','Факультет автора (faculty of the Author):');
    $aSheet->setCellValue('M1','Курс автора (Course):');
    $aSheet->setCellValue('N1','E-mail автора:');
    $aSheet->setCellValue('O1','Телефон автора (Telephone №):');


    $aSheet->setCellValue('P1','Фамилия соавтора (Surname of the Second Author):');
    $aSheet->setCellValue('Q1','Имя соавтора (Name of the Second Author):');
    $aSheet->setCellValue('R1','Отчество соавтора (Second name of the Second Author):');
    $aSheet->setCellValue('S1','Дата рождения соавтора (birthdate):');
    $aSheet->setCellValue('T1','Город соавтора (City):');
    $aSheet->setCellValue('U1','Страна соавтора (Country):');
    $aSheet->setCellValue('V1','Полное название учебного заведения/организации соавтора (Full name of the institution, which the Second author represent):');
    $aSheet->setCellValue('W1','Сокращённое название учебного заведения/организации соавтора (Abbreviation of the institution, which the Second author represent):');
    $aSheet->setCellValue('X1','Статус соавтора (Status of the Second author):');
    $aSheet->setCellValue('Y1','Факультет соавтора (faculty of the Second author):');
    $aSheet->setCellValue('Z1','Курс соавтора (Course):');
    $aSheet->setCellValue('AA1','E-mail соавтора:');
    $aSheet->setCellValue('AB1','Телефон соавтора (Telephone №):');


    $aSheet->setCellValue('AC1','Фамилия 1-го научного руководителя (Surname of the 1st Supervisor):');
    $aSheet->setCellValue('AD1','Имя 1-го научного руководителя (Name of the 1st Supervisor):');
    $aSheet->setCellValue('AE1','Отчество 1-го научного руководителя (Second name of the 1st Supervisor):');
    $aSheet->setCellValue('AF1','Учёная степень 1-го научного руководителя (Scientific degree of the 1st Supervisor):');
    $aSheet->setCellValue('AG1','Учёное звание 1-го научного руководителя (Academic rank of the 1nd Supervisor):');
    $aSheet->setCellValue('AH1','Должность 1-го научного руководителя (Position of the 1st Supervisor):');
    $aSheet->setCellValue('AI1','Полное название учебного заведения/организации 1-го научного руководителя (Full name of the 1st Supervisor institution):');
    $aSheet->setCellValue('AJ1','Название кафедры / структурного подразделения 1-го научного руководителя (Department):');
    $aSheet->setCellValue('AK1','Город 1-го научного руководителя (City):');
    $aSheet->setCellValue('AL1','E-mail 1-го научного руководителя (E-mail  of the 1st Supervisor):');
    $aSheet->setCellValue('AM1','Телефон 1-го научного руководителя (Telephone № of the 1st Supervisor):');


    $aSheet->setCellValue('AN1','Фамилия 2-го научного руководителя (Surname of the 2nd Supervisor):');
    $aSheet->setCellValue('AO1','Имя 2-го научного руководителя (Name of the 2nd Supervisor):');
    $aSheet->setCellValue('AP1','Отчество 2-го научного руководителя (Second name of the 2nd Supervisor):');
    $aSheet->setCellValue('AQ1','Учёная степень 2-го научного руководителя (Scientific degree of the 2nd Supervisor):');
    $aSheet->setCellValue('AR1','Учёное звание 2-го научного руководителя (Academic rank of the 2nd Supervisor):');
    $aSheet->setCellValue('AS1','Должность 2-го научного руководителя (Position of the 2nd Supervisor):');
    $aSheet->setCellValue('AT1','Полное название учебного заведения/организации 2-го научного руководителя (Full name of the 2nd Supervisor institution):');
    $aSheet->setCellValue('AU1','Название кафедры / структурного подразделения 2-го научного руководителя (Department):');
    $aSheet->setCellValue('AV1','Город 2-го научного руководителя (City):');
    $aSheet->setCellValue('AW1','E-mail 2-го научного руководителя (E-mail  of the 2nd Supervisor):');
    $aSheet->setCellValue('AX1','Телефон 2-го научного руководителя (Telephone № of the 2nd Supervisor):');


    $aSheet->setCellValue('AY1','Секция (Section):');
    $aSheet->setCellValue('AZ1','Форма участия (The form of participation):');
    $aSheet->setCellValue('BA1','Содержание доклада (Content report):');


    $query="SELECT L.name_language, R.title_report, U.secondnameUser, U.firstnameUser, U.midlenameUser, U.birthdate, U.city, U.country, U.fullNameInstitute,
                        U.abbreviationInstitute, S.name_status, U.nameFaculti, courses.name_course, U.email, U.telephone,

                        U2.secondnameUser AS secondnameUser2, U2.firstnameUser AS firstnameUser2, U2.midlenameUser AS midlenameUser2, U2.birthdate
                        AS birthdate2, U2.city AS city2, U2.country AS country2, U2.fullNameInstitute AS fullNameInstitute2, U2.abbreviationInstitute AS
                        abbreviationInstitute2, S2.name_status AS name_status2, U2.nameFaculti AS nameFaculti2, cours.name_course AS name_course2,
                        U2.email AS email2, U2.telephone AS telephone2,

                        B.secondnameBoss, B.firstnameBoss, B.midlnameBoss, SD.name_scientificDegree,AR.name_academicRanks, PS.name_positionSupervisor,
                        B.fullNameInstitute AS fullNameInstituteB1 , B.name_department, B.city AS cityB, B.email AS emailB, B.telephone AS telephoneB,

                        B2.secondnameBoss AS secondnameBoss2, B2.firstnameBoss AS firstnameBoss2, B2.midlnameBoss AS midlnameBoss2,
                        SD2.name_scientificDegree AS name_scientificDegree2, AR2.name_academicRanks AS name_academicRanks2, PS2.name_positionSupervisor AS
                        name_positionSupervisor2, B2.fullNameInstitute AS fullNameInstituteB2, B2.name_department AS name_department2, B2.city AS cityB2,
                        B2.email AS emailB2, B2.telephone AS telephoneB2,

                        SEC.name_section, formParticipation.name_formParticipation, contentsReport.name_contentsReport


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

                        WHERE SEC.id_section='$k' ";

    $res = mysqli_query($dbc,$query)
    or die ("no query");

    $i = 1;
    while( $prd = mysqli_fetch_assoc($res) )
    {
        $aSheet->setCellValue('A'.($i+2), $prd['name_language']);
        $aSheet->setCellValue('B'.($i+2), $prd['title_report']);
        $aSheet->setCellValue('C'.($i+2), $prd['secondnameUser']);
        $aSheet->setCellValue('D'.($i+2), $prd['firstnameUser']);
        $aSheet->setCellValue('E'.($i+2), $prd['midlenameUser']);
        $aSheet->setCellValue('F'.($i+2), $prd['birthdate']);
        $aSheet->setCellValue('G'.($i+2), $prd['city']);
        $aSheet->setCellValue('H'.($i+2), $prd['country']);
        $aSheet->setCellValue('I'.($i+2), $prd['fullNameInstitute']);
        $aSheet->setCellValue('J'.($i+2), $prd['abbreviationInstitute']);
        $aSheet->setCellValue('K'.($i+2), $prd['name_status']);
        $aSheet->setCellValue('L'.($i+2), $prd['nameFaculti']);
        $aSheet->setCellValue('M'.($i+2), $prd['name_course']);
        $aSheet->setCellValue('N'.($i+2), $prd['email']);
        $aSheet->setCellValue('O'.($i+2), $prd['telephone']);


        $aSheet->setCellValue('P'.($i+2), $prd['secondnameUser2']);
        $aSheet->setCellValue('Q'.($i+2), $prd['firstnameUser2']);
        $aSheet->setCellValue('R'.($i+2), $prd['midlenameUser2']);
        $aSheet->setCellValue('S'.($i+2), $prd['birthdate2']);
        $aSheet->setCellValue('T'.($i+2), $prd['city2']);
        $aSheet->setCellValue('U'.($i+2), $prd['country2']);
        $aSheet->setCellValue('V'.($i+2), $prd['fullNameInstitute2']);
        $aSheet->setCellValue('W'.($i+2), $prd['abbreviationInstitute2']);
        $aSheet->setCellValue('X'.($i+2), $prd['name_status2']);
        $aSheet->setCellValue('Y'.($i+2), $prd['nameFaculti2']);
        $aSheet->setCellValue('Z'.($i+2), $prd['name_course2']);
        $aSheet->setCellValue('AA'.($i+2), $prd['email2']);
        $aSheet->setCellValue('AB'.($i+2), $prd['telephone2']);


        $aSheet->setCellValue('AC'.($i+2), $prd['secondnameBoss']);
        $aSheet->setCellValue('AD'.($i+2), $prd['firstnameBoss']);
        $aSheet->setCellValue('AE'.($i+2), $prd['midlnameBoss']);
        $aSheet->setCellValue('AF'.($i+2), $prd['name_scientificDegree']);
        $aSheet->setCellValue('AG'.($i+2), $prd['name_academicRanks']);
        $aSheet->setCellValue('AH'.($i+2), $prd['name_positionSupervisor']);
        $aSheet->setCellValue('AI'.($i+2), $prd['fullNameInstituteB1']);
        $aSheet->setCellValue('AJ'.($i+2), $prd['name_department']);
        $aSheet->setCellValue('AK'.($i+2), $prd['cityB']);
        $aSheet->setCellValue('AL'.($i+2), $prd['emailB']);
        $aSheet->setCellValue('AM'.($i+2), $prd['telephoneB']);


        $aSheet->setCellValue('AN'.($i+2), $prd['secondnameBoss2']);
        $aSheet->setCellValue('AO'.($i+2), $prd['firstnameBoss2']);
        $aSheet->setCellValue('AP'.($i+2), $prd['midlnameBoss2']);
        $aSheet->setCellValue('AQ'.($i+2), $prd['name_scientificDegree2']);
        $aSheet->setCellValue('AR'.($i+2), $prd['name_academicRanks2']);
        $aSheet->setCellValue('AS'.($i+2), $prd['name_positionSupervisor2']);
        $aSheet->setCellValue('AT'.($i+2), $prd['fullNameInstituteB2']);
        $aSheet->setCellValue('AU'.($i+2), $prd['name_department2']);
        $aSheet->setCellValue('AV'.($i+2), $prd['cityB2']);
        $aSheet->setCellValue('AW'.($i+2), $prd['emailB2']);
        $aSheet->setCellValue('AX'.($i+2), $prd['telephoneB2']);

        $aSheet->setCellValue('AY'.($i+2), $prd['name_section']);
        $aSheet->setCellValue('AZ'.($i+2), $prd['name_formParticipation']);
        $aSheet->setCellValue('BA'.($i+2), $prd['name_contentsReport']);

        $i++;
    }

    $objWriter = PHPExcel_IOFactory::createWriter($pExcel, 'Excel2007');
    $objWriter->save(''.$folderDATA.$titleFolders[$k].'/'.$titleFolders[$k].'.xlsx');

    $queryCountInSection="SELECT id_report, title_report
                                    From reports
                                    WHERE id_sections='$k'";
    $resultCountInSection=mysqli_query($dbc, $queryCountInSection)
    or die("Папки doc не извлечены");

    while($str=mysqli_fetch_array($resultCountInSection))
    {
        include_once 'PHPWord.php';
        $word=new PHPWord();

        $word->setDefaultFontName('Times New Roman');

        $queryData="SELECT reports.title_report, reports.file_report, U1.secondnameUser AS secondnameFA, U1.firstnameUser AS firstnameFA, U1.midlenameUser AS midlenameFA,
                              U2.secondnameUser AS secondnameSA, U2.firstnameUser AS firstnameSA, U2.midlenameUser AS midlenameSA,
                              U1.fullNameInstitute, U1.city, SD1.name_scientificDegree AS scientificDegreeFB, AR1.name_academicRanks AS academicRanksFB,
                              B1.fullNameInstitute AS univerFB,
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

                            WHERE reports.id_report='".$str['id_report']."'";
        $resultData=mysqli_query($dbc, $queryData)
        or die("Запрос по извлечению содержимого не выполнен");
        while($data=mysqli_fetch_array($resultData))
        {

            $title=$data['title_report'];
            $fileReport=$data['file_report'];
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
//            $scientificDegree2=$data['scientificDegreeSB'];
//            $rank2=$data['academicRanksSB'];
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
            $template->setValue('secondnameFA', $secondnameFA);
            $template->setValue('firstnameFA', $firstnameFA);
            $template->setValue('midlenameFA', $midlenameFA);

            $template->setValue('secondnameSA', $secondnameSA);
            $template->setValue('firstnameSA', $firstnameSA);
            $template->setValue('midlenameSA', $midlenameSA);

            $template->setValue('univer', $univerA);
            $template->setValue('city', $cityA);
            $template->setValue('degree', $scientificDegree);
            $template->setValue('rank', $rank);
//            $template->setValue('degree2', $scientificDegree2);
//            $template->setValue('rank2', $rank2);

            $template->setValue('secondnameS', $secondnameFB);
            $template->setValue('firstnameS', $firstnameFB);
            $template->setValue('midlenameS', $midlenameFB);
            $template->setValue('secondnameSS', $secondnameSB);
            $template->setValue('firstnameSS', $firstnameSB);
            $template->setValue('midlenameSS', $midlenameSB);
            $template->setValue('univerS', $univerFB);
            $template->setValue('cityS', $cityFB);

            $template->setValue('intro', $intro);
            $template->setValue('aim', $aim);
            $template->setValue('material', $materials);
            $template->setValue('results', $results);
            $template->setValue('conclusion', $conclusions);

            $template->save(''.$folderDATA.$titleFolders[$k].'/'.$str['id_report'].'.docx'); //Сохраняем результат в файл
            if(($fileReport!="") &&(file_exists('reports/'.$titleFolders[$k].'/'.$fileReport.''))){
                if(!copy('reports/'.$titleFolders[$k].'/'.$fileReport.'', ''.$folderDATA.$titleFolders[$k].'/'.$fileReport.'')){
                    echo "<script>alert(\"Не удалось перенести .pdf!\")</script>";
                }
            }

        }
    }

}

?>