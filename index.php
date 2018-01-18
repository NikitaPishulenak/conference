<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конференция</title>
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.2.1.min.js"></script>
    <script src="scriptStyle.js" type="text/javascript"></script>

</head>
<body>

<div id="top"><img src="images/top.png" class="manageArrow" alt="Top"></div>
<div id="bottom"><img src="images/bottom.png" class="manageArrow" alt="Bottom"></div>

<div class="header">
    <table>
        <tr>
            <td width="100%">
                <h1> Регистрация участников LXXI</h1>
                <h1>АПСМиФ 2017</h1>
                <h3>Registration</h3>
            </td>
            <td>
                <a href="selectResults.php"><img alt="ссылка на страницу скачивания" src="images/book.gif"></a>
            </td>
        </tr>
    </table>

    <hr>
</div>


<?php
include_once 'connect.php';
ini_set('display_errors', '1');
$dbc = mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
or die("Не удалось подключиться к БД");
mysqli_query($dbc, 'SET NAMES utf8');

if (isset($_POST['btnSend'])) {

    //О статье
    $language = $_POST['chooseLanguage'];
    $titleOfPaper = $_POST['titleOfPaper'];
    $introduction = $_POST['introduction'];
    $aim = $_POST['aim'];
    $materialsAndMethods = $_POST['materialsAndMethods'];
    $results = $_POST['results'];
    $conclusions = $_POST['conclusions'];
    $file_name = "";

    //О авторе
    $authorSecondname = $_POST['secondname'];
    $authorFirstname = $_POST['firstname'];
    $authorMidlname = $_POST['midlname'];
    $authorBirthdate = $_POST['birthdate'];
    $authorCity = $_POST['city'];
    $authorCountry = $_POST['country'];
    $authorUniversityName = $_POST['universityName'];
    if ($authorUniversityName == '0') {
        $authorUniversityName = $_POST['nameOtherUniversity'];
    }
    $authorAbbreviatureUniver = $_POST['abbreviatureUniver'];
    $authorStatusAuthor = $_POST['statusAuthor'];
    $authorFacultyName = (isset($_POST['facultyName'])) ? $_POST['facultyName'] : "";
    if ($authorFacultyName == '0') {
        $authorFacultyName = $_POST['nameOtherFaculty'];
    }
    $authorCourse = $_POST['courseAuthor'];
    $authorEmail = $_POST['emailAuthor'];
    $authorTelephone = $_POST['telAuthor'];

    //О соавторе
    $authorSecondname2 = $_POST['secondname2'];
    $authorFirstname2 = $_POST['firstname2'];
    $authorMidlname2 = $_POST['midlname2'];
    $authorBirthdate2 = $_POST['birthdate2'];
    $authorCity2 = $_POST['city2'];
    $authorCountry2 = $_POST['country2'];
    $authorUniversityName2 = (isset($_POST['universityName2'])) ? $_POST['universityName2'] : "";
    if ($authorUniversityName2 == '0') {
        $authorUniversityName2 = $_POST['nameOtherUniversity2'];
    }
    $authorAbbreviatureUniver2 = $_POST['abbreviatureUniver2'];
    $authorStatusAuthor2 = $_POST['statusAuthor2'];
    $authorFacultyName2 = (isset($_POST['facultyName2'])) ? $_POST['facultyName2'] : "";
    if ($authorFacultyName2 == '0') {
        $authorFacultyName2 = $_POST['nameOtherFaculty2'];
    }
    $authorCourse2 = $_POST['courseAuthor2'];
    $authorEmail2 = $_POST['emailAuthor2'];
    $authorTelephone2 = $_POST['telAuthor2'];


    //О 1 научном руководителе
    $secondnameSupervisor = $_POST['secondnameSupervisor'];
    $firstnameSupervisor = $_POST['firstnameSupervisor'];
    $midlenameSupervisor = $_POST['midlnameSupervisor'];
    $supervisorScientificDegree = $_POST['scientificDegree'];
    $supervisorAcademicRanks = $_POST['academicRanks'];
    $supervisorPosition = $_POST['positionSupervisor'];
    $supervisorUniversityName = $_POST['universityNameSupervisor'];
    if ($supervisorUniversityName == '0') {
        $supervisorUniversityName = $_POST['nameOtherUniversitySupervisor'];
    }
    $supervisorDepartment = $_POST['department'];
    $supervisorCity = $_POST['citySupervisor'];
    $supervisorEmail = $_POST['emailSupervisor'];
    $supervisorTelephone = $_POST['telSupervisor'];

    //О О 2 научном руководителе
    $secondnameSupervisor2 = $_POST['secondnameSupervisor2'];
    $firstnameSupervisor2 = $_POST['firstnameSupervisor2'];
    $midlenameSupervisor2 = $_POST['midlnameSupervisor2'];
    $supervisorScientificDegree2 = $_POST['scientificDegree2'];
    $supervisorAcademicRanks2 = $_POST['academicRanks2'];
    $supervisorPosition2 = $_POST['positionSupervisor2'];
    $supervisorUniversityName2 = (isset($_POST['universityNameSupervisor2'])) ? $_POST['universityNameSupervisor2'] : "";
    if ($supervisorUniversityName2 == '0') {
        $supervisorUniversityName2 = $_POST['nameOtherUniversitySupervisor2'];
    }
    $supervisorDepartment2 = $_POST['department2'];
    $supervisorCity2 = $_POST['citySupervisor2'];
    $supervisorEmail2 = $_POST['emailSupervisor2'];
    $supervisorTelephone2 = $_POST['telSupervisor2'];

//Прочие данные
    $section = $_POST['section'];
    $formParticipation = $_POST['formParticipation'];
    $contentsReport = $_POST['contentsReport'];

    $all_field_OK=false;
    $file_OK=false;

    $requiered_field=array($titleOfPaper, $introduction, $aim, $materialsAndMethods, $results, $conclusions,$authorSecondname,$authorFirstname,$authorMidlname,$authorBirthdate,$authorCity,$authorCountry, $authorUniversityName, $authorEmail,
        $authorTelephone, $secondnameSupervisor, $firstnameSupervisor,$midlenameSupervisor,$supervisorDepartment,$supervisorCity, $language, $authorStatusAuthor, $authorCourse, $supervisorScientificDegree, $supervisorAcademicRanks, $supervisorPosition, $section, $formParticipation, $contentsReport);

    foreach ($requiered_field as $c_field){
        if(!empty($c_field) && isset($c_field)){
            $all_field_OK=true;
        }
        else{
            $all_field_OK=false;
        }
    }
    if (($all_field_OK) && (is_uploaded_file($_FILES['reportFile']['tmp_name'])) ){
        //прикрепить файл
        if (is_uploaded_file($_FILES['reportFile']['tmp_name'])) {
            if ($_FILES['reportFile']['size'] <= 3145728) {
                $file_name = date("YmdGis") . ".pdf";
                $resultFolder = mysqli_query($dbc, "SELECT name_sectionName FROM sectionsName WHERE id_sectionName='$section'")
                or die ("Не удалось извлечь имя папки");
                $folder = mysqli_fetch_row($resultFolder);
                $_FILES['reportFile']['name'] = $file_name;
                if (move_uploaded_file($_FILES['reportFile']['tmp_name'], "reports/".$folder[0]."/" . $_FILES['reportFile']['name'])) {
                    $file_OK=true;
                }

            } else {
                echo "<script>alert(\"Размер файла превышает 3 МБ! Загрузка на сервер не возможна!\")</script>";
                exit;
            }

        } else {
            $file_OK=false;
            echo "<script>alert(\"Ошибка загрузки .pdf!\")</script>";
        }


        $q1 = "INSERT INTO reports (id_report, title_report, introduction, aim, materialsAndMethods,results, conclusions, id_contentReport, id_formParticipation, id_sections, file_report)
            VALUES ('', '$titleOfPaper', '$introduction','$aim','$materialsAndMethods','$results','$conclusions','$contentsReport','$formParticipation','$section', '$file_name')";
        mysqli_query($dbc, $q1)
        or die ("Не удалось вставить reports");

        $q2 = "INSERT INTO users (id_user, firstnameUser, secondnameUser, midlenameUser, birthdate, city, country, fullNameInstitute, abbreviationInstitute, id_status, nameFaculti, id_course, email, telephone)
            VALUES ('','$authorFirstname','$authorSecondname','$authorMidlname','$authorBirthdate', '$authorCity', '$authorCountry', '$authorUniversityName',
                    '$authorAbbreviatureUniver','$authorStatusAuthor', '$authorFacultyName', '$authorCourse','$authorEmail','$authorTelephone')";
        mysqli_query($dbc, $q2)
        or die ("Не удалось вставить user1");

        $q3 = "INSERT INTO users (id_user, firstnameUser, secondnameUser, midlenameUser, birthdate, city, country, fullNameInstitute, abbreviationInstitute, id_status, nameFaculti, id_course, email, telephone)
            VALUES ('','$authorFirstname2','$authorSecondname2','$authorMidlname2','$authorBirthdate2', '$authorCity2', '$authorCountry2', '$authorUniversityName2',
                    '$authorAbbreviatureUniver2','$authorStatusAuthor2', '$authorFacultyName2', '$authorCourse2','$authorEmail2','$authorTelephone2')";
        mysqli_query($dbc, $q3)
        or die ("Не удалось вставить user2");

        $q4 = "INSERT INTO boss (id_boss, firstnameBoss, secondnameBoss, midlnameBoss, id_scientificDegree, id_academicRanks, id_positionSupervisor, fullNameInstitute, name_department, city, email, telephone)
                VALUES ('','$firstnameSupervisor','$secondnameSupervisor','$midlenameSupervisor','$supervisorScientificDegree','$supervisorAcademicRanks',
                        '$supervisorPosition','$supervisorUniversityName','$supervisorDepartment','$supervisorCity','$supervisorEmail','$supervisorTelephone')";
        mysqli_query($dbc, $q4)
        or die ("Не удалось вставить boss1");

        $q5 = "INSERT INTO boss (id_boss, firstnameBoss, secondnameBoss, midlnameBoss, id_scientificDegree, id_academicRanks, id_positionSupervisor, fullNameInstitute, name_department, city, email, telephone)
                VALUES ('','$firstnameSupervisor2','$secondnameSupervisor2','$midlenameSupervisor2','$supervisorScientificDegree2','$supervisorAcademicRanks2',
                        '$supervisorPosition2','$supervisorUniversityName2','$supervisorDepartment2','$supervisorCity2','$supervisorEmail2','$supervisorTelephone2')";
        mysqli_query($dbc, $q5)
        or die ("Не удалось вставить boss2");


        // Нахожу последние индексы report, boss1, boss2
        $queryRep = "SELECT id_report FROM reports ORDER BY id_report DESC LIMIT 1";
        $res = mysqli_query($dbc, $queryRep)
        or die("Не удалось извлечь id report");
        $row = mysqli_fetch_row($res);

        $last_id_report = $row[0];

        $query = "SELECT id_boss FROM boss ORDER BY id_boss DESC LIMIT 1";
        $res = mysqli_query($dbc, $query)
        or die(" Не удалось извлечь id boss");
        $row = mysqli_fetch_array($res);

        $last_id_boss2 = $row[0];
        $last_id_boss1 = ($last_id_boss2 - 1);

        $query = "SELECT id_user FROM users ORDER BY id_user DESC LIMIT 1";
        $res = mysqli_query($dbc, $query)
        or die(" Не удалось извлечь id user");
        $row = mysqli_fetch_array($res);

        $last_id_user2 = $row[0];
        $last_id_user1 = ($last_id_user2 - 1);


        //Вставляю итоговые данные в промежуточную таблицу на основании выше id
        $query = "INSERT INTO conference (id_conference, id_languages, id_report, id_user1, id_user2, id_boss1, id_boss2)
            VALUES ('', '$language', '$last_id_report','$last_id_user1','$last_id_user2','$last_id_boss1','$last_id_boss2')";
        $result = mysqli_query($dbc, $query)
        or die("Не удалось выполнить запрос по добавлению данных в итоговую таблицу");

        include_once 'sendMail.php';
        include_once 'info.php';
        exit();
    } else {
        echo "<script>alert(\"Заполните ВСЕ обязательные поля (помечены *)!\");</script>";
    }

}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <div id="conteiner">
        <div id="lang">
            <b>Рабочий язык конференции (Language of the conference):</b><span class="req">*</span><br>
            <em class="hint">Дальнейшее заполнение формы - СТРОГО на выбранном языке (Further form filling - ONLI in
                selected language)!!!</em><br>

            <?php
            $query = "SELECT * FROM languages";
            $result = mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            echo '<select name="chooseLanguage" required id="lang">';
            echo '<option value=""> не выбрано/not chosen</option>';
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="'.$row['id_language'].'">' . $row['name_language'] . '</option>';
            }
            echo '</select>';
            ?>
        </div>

        <div id="abstracts">
            <h3 class="hint">Сумма символов во всех строках тезисов не должна превышать 2700</h3>
            <b> Название работы (Title of Paper)</b><span class="req">*</span><br>
            <em class="hint"> Пример (example): Особенности центральной гемодинамики у пациентов с метаболическим
                синдромом</em><br>
            <input type="text" name="titleOfPaper" id="titleOfPaper" required pattern="^[A-ZА-Я]{1}.*$"
                   value="<?php if (isset($titleOfPaper)) echo $titleOfPaper; ?>"><br>
        </div>
        <br><br>

        <div id="introduction">
            <b> Введение (Introduction)</b><span class="req">*</span><br>
            <textarea rows="10" cols="80" name="introduction" required><?php if (isset($introduction)) echo $introduction; ?></textarea>

        </div>
        <br><br>

        <div id="aim">
            <b> Цель исследования (Aim)</b><span class="req">*</span><br>
            <textarea rows="10" cols="80" name="aim" required><?php if (isset($aim)) echo $aim; ?></textarea>
        </div>
        <br><br>

        <div id="materialsAndMethods">
            <b> Материалы и методы (Materials and methods)</b><span class="req">*</span><br>
            <textarea rows="10" cols="80" name="materialsAndMethods" required><?php if (isset($materialsAndMethods)) echo $materialsAndMethods; ?></textarea>
        </div>
        <br><br>

        <div id="results">
            <b> Результаты (Results)</b><span class="req">*</span><br>
            <textarea rows="10" cols="80" name="results" required><?php if (isset($results)) echo $results; ?></textarea>
        </div>
        <br><br>

        <div id="conclusions">
            <b> Выводы (Conclusions)</b><span class="req">*</span><br>
            <textarea rows="10" cols="80" name="conclusions" required><?php if (isset($conclusions)) echo $conclusions; ?></textarea>
        </div>
        <br><br>

        <div id="uploadFile">

            <strong>Прикрепите .pdf файл вашего доклада</strong><span class="req">*</span><br>
            <span style="color: #8c0000; font-size: 0.9em"><i>Размер файла не должен превышать 3Mb</i></span><br>
            <input type="file" name="reportFile" id="uploadFile" onchange="CheckFile(this)" accept="application/pdf"
                   required>
        </div>


        <h1 id="aboutAuthor"><abbr title="Для того, чтобы свернуть блок кликните мышью!))">Информация об авторе
                (Information about the Author)</abbr></h1>
        <hr>
        <br>
        <div id="aboutAuthor">

            <b> Фамилия автора (Author`s Surname):</b><span class="req">*</span><br>
            <input type="text" name="secondname" required pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$"
                   placeholder="Соколов" value="<?php if (isset($authorSecondname)) echo $authorSecondname; ?>"><br><br>

            <b> Имя автора (Author`s Name):</b><span class="req">*</span><br>
            <input type="text" name="firstname" required pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$"
                   placeholder="Александр" value="<?php if (isset($authorFirstname)) echo $authorFirstname; ?>"><br><br>

            <b> Отчество автора (Author`s Second name):</b><span class="req">*</span><br>
            <input type="text" name="midlname" required pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$"
                   placeholder="Александрович" value="<?php if (isset($authorMidlname)) echo $authorMidlname; ?>"><br><br>

            <b> Дата рождения автора (Date of Birth):</b><span class="req">*</span><br>
            <input type="date" name="birthdate" max="2008-01-01" min="1950-01-01" required
                   title="Введите в формате: ГГГГ-ММ-ДД" placeholder="ГГГГ-ММ-ДД" value="<?php if (isset($authorBirthdate)) echo $authorBirthdate; ?>"><br><br>

            <b> Город автора (City):</b><span class="req">*</span><br>
            <input type="text" name="city" required placeholder="Минск" value="<?php if (isset($authorCity)) echo $authorCity; ?>"
                   pattern="^[А-Я]{1}[а-яА-Я\-\s]{2,40}|[A-Z]{1}[a-zA-Z\-\s]{2,40}$"><br><br>

            <b> Страна автора (Country):</b><span class="req">*</span><br>
            <input type="text" name="country" required placeholder="Республика Беларусь" value="<?php if (isset($authorCountry)) echo $authorCountry; ?>"
                   pattern="^[А-Я]{1}[а-яА-Я\-\s]{2,40}|[A-Z]{1}[a-zA-Z\-\s]{2,40}$"><br><br>

            <b> Полное название учебного заведения/организации автора (Full name of the institution which the Author
                represent):</b><span class="req">*</span><br>
            <em class="hint">Пример (example): Белорусский государственный медицинский университет</em><br>
            <label><input type="radio" name="universityName" value="Белорусский государственный медицинский университет"
                          checked><em class="radioNameUniver"> Белорусский государственный медицинский университет</em></label><br>
            <label><input type="radio" name="universityName" value="0" id="rbUniver1"><em class="radioNameUniver">
                    Другое:</em></label>
            <input type="text" name="nameOtherUniversity" value="<?php if (isset($_POST['nameOtherUniversity'])) echo $_POST['nameOtherUniversity'];?>"
                   pattern="^[А-Я]{1}[а-яА-Я\-\s]{5,300}|[A-Z]{1}[a-zA-Z\-\s]{5,300}$" id="fullNameUniver1"> <br><br>

            <script type="text/javascript">
                $(document).ready(function () {
                    $('input[type=text]#fullNameUniver1').click(function () {
                        $('#rbUniver1').attr('checked', true);
                    });
                });
            </script>

            <b> Сокращенное название учебного заведения/организации автора (Abbreviation of the institution, which the
                Author represent):</b><span class="req">*</span><br>
            <input type="text" name="abbreviatureUniver" required placeholder="БГМУ" value="<?php if (isset($authorAbbreviatureUniver)) echo $authorAbbreviatureUniver; ?>"
                   pattern="^[А-Я]{2,30}|[A-Z]{2,30}$"><br><br>

            <b> Статус автора (Status of the author):</b><span class="req">*</span><br>
            <em class="hint"> На момент участия в Конференции</em><br>

            <?php
            $query = "SELECT * FROM statuses";
            $result = mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            echo '<select name="statusAuthor" required >';
            echo '<option value=""> не выбрано/not chosen</option>';
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id_status'] . '">' . $row['name_status'] . '</option>';
            }
            echo '</select>';
            ?><br><br>

            <b> Факультет автора (faculty of the Author):</b><br>
            <em class="hint">Если Вы не являетесь студентом, выберите вариант ответа "Нет" (If you are not a student,
                select "No")</em><br>

            <?php
            $query = "SELECT * FROM faculties";
            $result = mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            while ($row = mysqli_fetch_array($result)) {
                echo '<label><input type="radio" name="facultyName" value="' . $row['name_faculti'] . '"><em class="radioNameUniver"> ' . $row['name_faculti'] . ' </em></label>';
                echo '<br>';
            }

            ?>

            <label><input type="radio" name="facultyName" value="0" id="rbFac1"><em
                        class="radioNameUniver">Другое/Other</em></label>
            <input type="text" name="nameOtherFaculty" value="<?php if (isset($_POST['nameOtherFaculty'])) echo $_POST['nameOtherFaculty'];?>"
                   pattern="^[А-Я]{1}[а-яА-Я\-\s]{3,150}|[A-Z]{1}[a-zA-Z\-\s]{3,150}$" id="otherFac1"
                   placeholder="Нейронные сети"> <br><br>

            <script type="text/javascript">
                $(document).ready(function () {
                    $('input[type=text]#otherFac1').click(function () {
                        $('#rbFac1').attr('checked', true);
                    });
                });
            </script>

            <b> Курс автора (Course):</b><span class="req">*</span><br>
            <?php
            $query = "SELECT * FROM courses";
            $result = mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            echo '<select name="courseAuthor" required >';
            echo '<option value=""> не выбрано/not chosen</option>';
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id_course'] . '">' . $row['name_course'] . '</option>';
            }
            echo '</select>';
            ?><br><br>

            <b> E-mail автора:</b><span class="req">*</span><br>
            <em class="hint">Внимание! Указанный Вами e-mail будет использован Оргкомитетом Конференции для обратной
                связи
                (Attention! Your e-mail will be used by the Organizing Commitee of the Conference for feedback)</em><br>
            <input type="email" name="emailAuthor" placeholder="example@exam.ru" required value="<?php if (isset($authorEmail)) echo $authorEmail; ?>"
                   pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"><br><br>

            <b> Телефон автора (Telephone №):</b><span class="req">*</span><br>
            <em class="hint">+375*********</em><br>
            <input type="text" name="telAuthor" required pattern="^[0-9()\-+ ]{12,19}" value="<?php if (isset($authorTelephone)) echo $authorTelephone; ?>"
                   title="Введите в формате +375-(33)-111-22-33"><br><br>
        </div>

        <!-- Информация о соавторе-->
        <h1 id="aboutAuthor2"><abbr title="Для того, чтобы свернуть блок кликните мышью!))"> Информация об соавторе
                (Information about the second Author)</abbr></h1>
        <hr>
        <br>
        <div id="aboutAuthor2">

            <b> Фамилия автора (Author`s Surname):</b><br>
            <input type="text" name="secondname2" pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" value="<?php if (isset($authorSecondname2)) echo $authorSecondname2; ?>"
                   placeholder="Соколов"><br><br>

            <b> Имя автора (Author`s Name):</b><br>
            <input type="text" name="firstname2" pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" value="<?php if (isset($authorFirstname2)) echo $authorFirstname2; ?>"
                   placeholder="Александр"><br><br>

            <b> Отчество автора (Author`s Second name):</b><br>
            <input type="text" name="midlname2" pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" value="<?php if (isset($authorMidlname2)) echo $authorMidlname2; ?>"
                   placeholder="Александрович"><br><br>

            <b> Дата рождения автора (Date of Birth):</b><br>
            <input type="date" name="birthdate2" max="2007-01-01" min="1920-01-01" title="Введите в формате: ГГГГ-ММ-ДД" value="<?php if (isset($authorBirthdate2)) echo $authorBirthdate2; ?>"
                   placeholder="ГГГГ-ММ-ДД"><br><br>

            <b> Город автора (City):</b><br>
            <input type="text" name="city2" placeholder="Минск" value="<?php if (isset($authorCity2)) echo $authorCity2; ?>"
                   pattern="^[А-Я]{1}[а-яА-Я\-\s]{2,40}|[A-Z]{1}[a-zA-Z\-\s]{2,40}$"><br><br>

            <b> Страна автора (Country):</b><br>
            <input type="text" name="country2" placeholder="Республика Беларусь" value="<?php if (isset($authorCountry2)) echo $authorCountry2; ?>"
                   pattern="^[А-Я]{1}[а-яА-Я\-\s]{2,40}|[A-Z]{1}[a-zA-Z\-\s]{2,40}$"><br><br>

            <b> Полное название учебного заведения/организации автора (Full name of the institution which the Author
                represent):</b><br>
            <em class="hint">Пример (example): Белорусский государственный медицинский университет</em><br>
            <label><input type="radio" name="universityName2"
                          value="Белорусский государственный медицинский университет"><em
                        class="radioNameUniver"> Белорусский государственный медицинский университет</em></label><br>
            <label><input type="radio" name="universityName2" value="0" id="rbUniver2"><em class="radioNameUniver">
                    Другое:</em></label>
            <input type="text" name="nameOtherUniversity2" value="<?php if (isset($_POST['nameOtherUniversity2'])) echo $_POST['nameOtherUniversity2'];?>"
                   pattern="^[А-Я]{1}[а-яА-Я\-\s]{5,300}|[A-Z]{1}[a-zA-Z\-\s]{5,300}$" id="fullNameUniver2"> <br><br>

            <script type="text/javascript">
                $(document).ready(function () {
                    $('input[type=text]#fullNameUniver2').click(function () {
                        $('#rbUniver2').attr('checked', true);
                    });
                });
            </script>

            <b> Сокращенное название учебного заведения/организации автора (Abbreviation of the institution, which the
                Author represent):</b><br>
            <input type="text" name="abbreviatureUniver2" placeholder="БГМУ" value="<?php if (isset($authorAbbreviatureUniver2)) echo $authorAbbreviatureUniver2; ?>"
                   pattern="^[А-Я]{2,30}|[A-Z]{2,30}$"><br><br>

            <b> Статус автора (Status of the author):</b><br>
            <em class="hint"> На момент участия в Конференции</em><br>

            <?php
            $query = "SELECT * FROM statuses";
            $result = mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            echo '<select name="statusAuthor2" >';
            echo '<option value=""> не выбрано/not chosen</option>';
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id_status'] . '">' . $row['name_status'] . '</option>';
            }
            echo '</select>';
            ?><br><br>

            <b> Факультет автора (faculty of the Author):</b><br>
            <em class="hint">Если Вы не являетесь студентом, выберите вариант ответа "Нет" (If you are not a student,
                select "No")</em><br>

            <?php
            $query = "SELECT * FROM faculties";
            $result = mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            while ($row = mysqli_fetch_array($result)) {
                echo '<label><input type="radio" name="facultyName2" value="' . $row['name_faculti'] . '"><em class="radioNameUniver"> ' . $row['name_faculti'] . ' </em></label>';
                echo '<br>';
            }
            ?>

            <label><input type="radio" name="facultyName2" value="0" id="rbFac2"><em class="radioNameUniver">Другое/Other</em></label>
            <input type="text" name="nameOtherFaculty2" value="<?php if (isset($_POST['nameOtherFaculty2'])) echo $_POST['nameOtherFaculty2'];?>"
                   pattern="^[А-Я]{1}[а-яА-Я\-\s]{3,150}|[A-Z]{1}[a-zA-Z\-\s]{3,150}$" id="otherFac2"
                   placeholder="Нейронные сети"> <br><br>

            <script type="text/javascript">
                $(document).ready(function () {
                    $('input[type=text]#otherFac2').click(function () {
                        $('#rbFac2').attr('checked', true);
                    });
                });
            </script>

            <b> Курс автора (Course):</b><br>
            <?php
            $query = "SELECT * FROM courses";
            $result = mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            echo '<select name="courseAuthor2" >';
            echo '<option value=""> не выбрано/not chosen</option>';
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id_course'] . '">' . $row['name_course'] . '</option>';
            }
            echo '</select>';
            ?><br><br>

            <b> E-mail автора:</b><br>
            <em class="hint">Ввнимание! Указанный Вами e-mail будет использован Оргкомитетом Конференции для обратной
                связи
                (Attention! Your e-mail will be used by the Organizing Commitee of the Conference for feedback)</em><br>
            <input type="email" name="emailAuthor2" placeholder="example@exam.ru" value="<?php if (isset($authorEmail2)) echo $authorEmail2; ?>"
                   pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"><br><br>

            <b> Телефон автора (Telephone №):</b><br>
            <em class="hint">+375*********</em><br>
            <input type="text" name="telAuthor2" pattern="^[0-9()\-+ ]{12,19}" value="<?php if (isset($authorTelephone2)) echo $authorTelephone2; ?>"
                   title="Введите в формате +375-(33)-111-22-33"><br><br>
        </div>


        <h1 id="secondAuthorLabel"><abbr title="Для того, чтобы свернуть блок кликните мышью!))">Сведения о научном
                руководителе <br>
                Information about the Second Author </abbr></h1>
        <div id="secondAuthor">

            <h3 id="firstSupervisorLabel"><abbr title="Для того, чтобы свернуть блок кликните мышью!))">Сведения о 1-ом
                    научном руководителе<br>
                    Information about the first Supervisor
                </abbr></h3>
            <hr>

            <div id="firstSupervisor">

                <b> Фамилия 1-го научного руководителя (Surname of the 1st Supervisor):</b><span
                        class="req">*</span><br>
                <input type="text" name="secondnameSupervisor" required value="<?php if (isset($secondnameSupervisor)) echo $secondnameSupervisor; ?>"
                       pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" placeholder="Петрова"><br><br>

                <b> Имя 1-го научного руководителя (Name of the 1st Supervisor):</b><span class="req">*</span><br>
                <input type="text" name="firstnameSupervisor" required value="<?php if (isset($firstnameSupervisor)) echo $firstnameSupervisor; ?>"
                       pattern="^[А-Я]{1}[а-яА-Я\-\s]{2,50}|[A-Z]{1}[a-zA-Z\-\s]{2,50}$"
                       placeholder="Маргорита"><br><br>

                <b> Отчество 1-го научного руководителя (Second name of the 1st Supervisor):</b><br>
                <input type="text" name="midlnameSupervisor" pattern="^[А-Я]{1}[а-яА-Я]{2,30}|[A-Z]{1}[a-zA-Z]{2,30}$" value="<?php if (isset($midlenameSupervisor)) echo $midlenameSupervisor; ?>"
                       placeholder="Александровна"><br><br>

                <b>Учёная степень 1-го научного руководителя (Scientific degree of the 1st Supervisor)</b><span
                        class="req">*</span><br>

                <?php
                $query = "SELECT * FROM scientificDegree";
                $result = mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo '<select name="scientificDegree" required >';
                echo '<option value=""> не выбрано/not chosen</option>';
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['id_scientificDegree'] . '">' . $row['name_scientificDegree'] . '</option>';
                }
                echo '</select>';
                ?><br><br>

                <b>Учёное звание 1-го научного руководителя (Academic rank of the 1st Supervisor)</b><span
                        class="req">*</span><br>

                <?php
                $query = "SELECT * FROM academicRanks";
                $result = mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo '<select name="academicRanks" required >';
                echo '<option value=""> не выбрано/not chosen</option>';
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['id_academicRanks'] . '">' . $row['name_academicRanks'] . '</option>';
                }
                echo '</select>';
                ?><br><br>

                <b>Должность 1-го научного руководителя (Position of the 1st Supervisor)</b><span
                        class="req">*</span><br>

                <?php
                $query = "SELECT * FROM positionSupervisor";
                $result = mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo '<select name="positionSupervisor" required >';
                echo '<option value=""> не выбрано/not chosen</option>';
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['id_positionSupervisor'] . '">' . $row['name_positionSupervisor'] . '</option>';
                }
                echo '</select>';
                ?><br><br>

                <b> Полное название учебного заведения/организации 1-го научного руководителя (Full name of the 1st
                    Supervisor institution):</b><br>
                <label><input type="radio" name="universityNameSupervisor"
                              value="Белорусский государственный медицинский университет" checked><em
                            class="radioNameUniver">
                        Белорусский государственный медицинский университет</em></label><br>
                <label><input type="radio" name="universityNameSupervisor" value="0" id="rbUniverBoss1"><em
                            class="radioNameUniver"> Другое:</em></label>
                <input type="text" name="nameOtherUniversitySupervisor" value="<?php if (isset($_POST['nameOtherUniversitySupervisor'])) echo $_POST['nameOtherUniversitySupervisor'];?>"
                       pattern="^[А-Я]{1}[а-яА-Я\-\s]{5,300}|[A-Z]{1}[a-zA-Z\-\s]{5,300}$" id="UniverBoss1"
                       title="Название должно начинаться с заглавной буквы"> <br><br>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $('input[type=text]#UniverBoss1').click(function () {
                            $('#rbUniverBoss1').attr('checked', true);
                        });
                    });
                </script>

                <b>Название кафедры/структурного подразделения 1-го научного руководителя (Department)</b><span
                        class="req">*</span><br>
                <em class="hint"> Пример (example): Акушерства и гинекологии</em><br>
                <input type="text" name="department" required value="<?php if (isset($supervisorDepartment)) echo $supervisorDepartment; ?>"
                       pattern="^[А-Я]{1}[а-яА-Я\-\s]{3,150}|[A-Z]{1}[a-zA-Z\-\s]{3,150}$"><br><br>

                <b> Город 1-го научного руководителя (City):</b><span class="req">*</span><br>
                <input type="text" name="citySupervisor" required placeholder="Минск" value="<?php if (isset($supervisorCity)) echo $supervisorCity; ?>"
                       pattern="^[А-Я]{1}[а-яА-Я\-\s]{3,30}|[A-Z]{1}[a-zA-Z\-\s]{3,30}$"><br><br>

                <b> E-mail 1-го научного руководителя (E-mail of the 1st Supervisor):</b><br>
                <input type="email" name="emailSupervisor" placeholder="example@exam.ru" value="<?php if (isset($supervisorEmail)) echo $supervisorEmail; ?>"
                       pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"><br><br>

                <b> Телефон 1-го научного руководителя (Telephone № of the 1st Supervisor):</b><br>
                <input type="tel" name="telSupervisor" pattern="^[0-9()\-+ ]{12,19}" value="<?php if (isset($supervisorTelephone)) echo $supervisorTelephone; ?>"
                       title="Введите в формате +375-(33)-111-22-33""><br><br>
            </div>


            <h3 id="secondSupervisorLabel"><abbr title="Для того, чтобы свернуть блок кликните мышью!))">Сведения о 2-ом
                    научном руководителе<br>
                    Information about the second Supervisor
                </abbr></h3>
            <hr>

            <div id="secondSupervisor">
                <b> Фамилия 2-го научного руководителя (Surname of the 2st Supervisor):</b><br>
                <input type="text" name="secondnameSupervisor2" value="<?php if (isset($secondnameSupervisor2)) echo $secondnameSupervisor2; ?>"
                       pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" placeholder="Петрова"><br><br>

                <b> Имя 2-го научного руководителя (Name of the 2st Supervisor):</b><br>
                <input type="text" name="firstnameSupervisor2" value="<?php if (isset($firstnameSupervisor2)) echo $firstnameSupervisor2; ?>"
                       pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" placeholder="Маргорита"><br><br>

                <b> Отчество 2-го научного руководителя (Second name of the 2st Supervisor):</b><br>
                <input type="text" name="midlnameSupervisor2" pattern="^[А-Я]{1}[а-яА-Я]{2,30}|[A-Z]{1}[a-zA-Z]{2,30}$" value="<?php if (isset($midlenameSupervisor2)) echo $midlenameSupervisor2; ?>"
                       placeholder="Александровна"><br><br>

                <b>Учёная степень 2-го научного руководителя (Scientific degree of the 2st Supervisor)</b><br>

                <?php
                $query = "SELECT * FROM scientificDegree";
                $result = mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo '<select name="scientificDegree2" >';
                echo '<option value=""> не выбрано/not chosen</option>';
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['id_scientificDegree'] . '">' . $row['name_scientificDegree'] . '</option>';
                }
                echo '</select>';
                ?><br><br>

                <b>Учёное звание 2-го научного руководителя (Academic rank of the 2st Supervisor)</b><br>

                <?php
                $query = "SELECT * FROM academicRanks";
                $result = mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo '<select name="academicRanks2" >';
                //echo '<option value=""> не выбрано/not chosen</option>';
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['id_academicRanks'] . '">' . $row['name_academicRanks'] . '</option>';
                }
                echo '</select>';
                ?><br><br>

                <b>Должность 2-го научного руководителя (Position of the 2st Supervisor)</b><br>

                <?php
                $query = "SELECT * FROM positionSupervisor";
                $result = mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo '<select name="positionSupervisor2" >';
                echo '<option value=""> не выбрано/not chosen</option>';
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['id_positionSupervisor'] . '">' . $row['name_positionSupervisor'] . '</option>';
                }
                echo '</select>';
                ?><br><br>

                <b> Полное название учебного заведения/организации 2-го научного руководителя (Full name of the 2st
                    Supervisor institution):</b><br>
                <label><input type="radio" name="universityNameSupervisor2"
                              value="Белорусский государственный медицинский университет"><em class="radioNameUniver">
                        Белорусский государственный медицинский университет</em></label><br>
                <label><input type="radio" name="universityNameSupervisor2" value="0" id="rbUniverBoss2"><em
                            class="radioNameUniver"> Другое:</em></label>
                <input type="text" name="nameOtherUniversitySupervisor2" value="<?php if (isset($_POST['nameOtherUniversitySupervisor2'])) echo $_POST['nameOtherUniversitySupervisor2'];?>"
                       pattern="^[А-Я]{1}[а-яА-Я\-\s]{5,300}|[A-Z]{1}[a-zA-Z\-\s]{5,300}$" id="UniverBoss2"
                       title="Название должно начинаться с заглавной буквы"> <br><br>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $('input[type=text]#UniverBoss2').click(function () {
                            $('#rbUniverBoss2').attr('checked', true);
                        });
                    });
                </script>

                <b>Название кафедры/структурного подразделения 2-го научного руководителя (Department)</b><br>
                <em class="hint"> Пример (example): Акушерства и гинекологии</em><br>
                <input type="text" name="department2" value="<?php if (isset($supervisorDepartment2)) echo $supervisorDepartment2; ?>"
                       pattern="^[А-Я]{1}[а-яА-Я\-\s]{3,150}|[A-Z]{1}[a-zA-Z\-\s]{3,150}$"><br><br>

                <b> Город 2-го научного руководителя (City):</b><br>
                <input type="text" name="citySupervisor2" placeholder="Минск" value="<?php if (isset($supervisorCity2)) echo $supervisorCity2; ?>"
                       pattern="^[А-Я]{1}[а-яА-Я\-\s]{3,30}|[A-Z]{1}[a-zA-Z\-\s]{3,30}$"><br><br>

                <b> E-mail 2-го научного руководителя (E-mail of the 1st Supervisor):</b><br>
                <input type="email" name="emailSupervisor2" placeholder="example@exam.ru" value="<?php if (isset($supervisorEmail2)) echo $supervisorEmail2; ?>"
                       pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"><br><br>

                <b> Телефон 2-го научного руководителя (Telephone № of the 1st Supervisor):</b><br>
                <input type="tel" name="telSupervisor2" pattern="^[0-9()\-+ ]{12,19}" value="<?php if (isset($supervisorTelephone2)) echo $supervisorTelephone2; ?>"
                       title="Введите в формате +375-(33)-111-22-33""><br><br>

            </div>
        </div>


        <h1 id="otherInformationLabel"><abbr title="Для того, чтобы свернуть блок кликните мышью!))"> Прочие сведения
                <br> Other information </abbr></h1>
        <hr>
        <div id="otherInformation">
            <b>Секция (Section):</b><span class="req">*</span><br>
            <em class="hint">Выберите научное направление Конференции, в котором хотите принять участие
                (Select Conference themes, which you would like participate):</em><br>
            <?php
            $query = "SELECT * FROM sections";
            $result = mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            echo '<select name="section" required >';
            echo '<option value=""> не выбрано/not chosen</option>';
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id_section'] . '">' . $row['name_section'] . '</option>';
            }
            echo '</select>';
            ?><br><br>

            <b>Форма участия (The form of participation):</b><span class="req">*</span><br>
            <?php
            $query = "SELECT * FROM formParticipation";
            $result = mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            echo '<select name="formParticipation" required >';
            echo '<option value=""> не выбрано/not chosen</option>';
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id_formParticipation'] . '">' . $row['name_formParticipation'] . '</option>';
            }
            echo '</select>';
            ?><br><br>

            <b>Содержание доклада(Contents of the report):</b><span class="req">*</span><br>
            <?php
            $query = "SELECT * FROM contentsReport";
            $result = mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            echo '<select name="contentsReport" required >';
            echo '<option value=""> не выбрано/not chosen</option>';
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id_contentsReport'] . '">' . $row['name_contentsReport'] . '</option>';
            }
            echo '</select>';
            mysqli_close($dbc);
            ?><br><br>
        </div>

        <button type="submit" name="btnSend">Отправить</button>
        <br><br>
    </div>
</form>

<footer>
    <h3> &copy Центр развития информационных технологий БГМУ <?php echo date('Y'); ?></h3>
</footer>

</body>
</html>