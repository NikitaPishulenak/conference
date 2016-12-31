<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конференция</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="../JS/jquery-3.0.0.min.js"></script>
    <script src="../JS/scriptStyle.js"></script>
</head>
<body>

<div class="header">
    <h1> Регистрация участников LXXI</h1>
    <h1>АПСМиФ 2017</h1>
    <h3>Registration</h3>
    <hr>
</div>

<?php
if(isset($_POST['btnSend']))
{

    //О статье
    $language=$_POST['chooseLanguage'];
    $titleOfPaper=$_POST['titleOfPaper'];
    $introduction=$_POST['introduction'];
    $aim=$_POST['aim'];
    $materialsAndMethods=$_POST['materialsAndMethods'];
    $results=$_POST['results'];
    $conclusions=$_POST['conclusions'];

    //О авторе
    $authorSecondname=$_POST['secondname'];
    $authorFirstname=$_POST['firstname'];
    $authorMidlname=$_POST['midlname'];
    $authorBirthdate=$_POST['birthdate'];
    $authorCity=$_POST['city'];
    $authorCountry=$_POST['country'];
    $authorUniversityName=$_POST['universityName'];
    if($authorUniversityName=='другое')
    {
        $authorUniversityName=$_POST['nameOtherUniversity'];
    }
    $authorAbbreviatureUniver=$_POST['abbreviatureUniver'];
    $authorStatusAuthor=$_POST['statusAuthor'];
    $authorFacultyName=$_POST['facultyName'];
    if($authorFacultyName=='Другое')
    {
        $authorFacultyName=$_POST['nameOtherFaculty'];
    }
    $authorCourse=$_POST['courseAuthor'];
    $authorEmail=$_POST['emailAuthor'];
    $authorTelephone=$_POST['telAuthor'];


    //О соавторе
    $secondnameSupervisor=$_POST['secondnameSupervisor'];
    $firstnameSupervisor=$_POST['firstnameSupervisor'];
    $midlenameSupervisor=$_POST['midlnameSupervisor'];
    $supervisorScientificDegree=$_POST['scientificDegree'];
    $supervisorAcademicRanks=$_POST['academicRanks'];
    $supervisorPosition=$_POST['positionSupervisor'];
    $supervisorUniversityName=$_POST['universityNameSupervisor'];
    if($supervisorUniversityName=='другое')
    {
        $supervisorUniversityName=$_POST['nameOtherUniversitySupervisor'];
    }
    $supervisorDepartment=$_POST['department'];
    $supervisorCity=$_POST['citySupervisor'];
    $supervisorEmail=$_POST['emailSupervisor'];
    $supervisorTelephone=$_POST['telSupervisor'];

    //О соавторе2
    $secondnameSupervisor2=$_POST['secondnameSupervisor2'];
    $firstnameSupervisor2=$_POST['firstnameSupervisor2'];
    $midlenameSupervisor2=$_POST['midlnameSupervisor2'];
    $supervisorScientificDegree2=$_POST['scientificDegree2'];
    $supervisorAcademicRanks2=$_POST['academicRanks2'];
    $supervisorPosition2=$_POST['positionSupervisor2'];
    $supervisorUniversityName2=$_POST['universityNameSupervisor2'];
    if($supervisorUniversityName2=='другое')
    {
        $supervisorUniversityName2=$_POST['nameOtherUniversitySupervisor2'];
    }
    $supervisorDepartment2=$_POST['department2'];
    $supervisorCity2=$_POST['citySupervisor2'];
    $supervisorEmail2=$_POST['emailSupervisor2'];
    $supervisorTelephone2=$_POST['telSupervisor2'];


    //Прочие данные
    $section=$_POST['section'];
    $formParticipation=$_POST['formParticipation'];
    $contentsReport=$_POST['contentsReport'];

    include_once 'connect.php';
    $dbc=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
    or die("Не удалось подключиться к БД");

    $query="INSERT INTO reports (id_report, title_report, introduction, aim, materialsAndMethods,
                                results, conclusions, id_contentReport, id_formParticipation,
                                id_sections, id_language)
            VALUES ('', '$titleOfPaper', '$introduction','$aim','$materialsAndMethods','$results','$conclusions','$contentsReport','$formParticipation','$section','$language');";

    $query .= "INSERT INTO boss (id_boss, firstnameBoss, secondnameBoss, midlnameBoss, id_scientificDegree, id_academicRanks, id_positionSupervisor,
                                fullNameInstitute, name_department, city, email, telephone)
                VALUES ('','$firstnameSupervisor','$secondnameSupervisor','$midlenameSupervisor','$supervisorScientificDegree','$supervisorAcademicRanks',
                        '$supervisorPosition','$supervisorUniversityName','$supervisorDepartment','$supervisorCity','$supervisorEmail','$supervisorTelephone');";

    $query .= "INSERT INTO boss (id_boss, firstnameBoss, secondnameBoss, midlnameBoss, id_scientificDegree, id_academicRanks, id_positionSupervisor,
                                fullNameInstitute, name_department, city, email, telephone)
                VALUES ('','$firstnameSupervisor2','$secondnameSupervisor2','$midlenameSupervisor2','$supervisorScientificDegree2','$supervisorAcademicRanks2',
                        '$supervisorPosition2','$supervisorUniversityName2','$supervisorDepartment2','$supervisorCity2','$supervisorEmail2','$supervisorTelephone2')";

    $result=mysqli_multi_query($dbc, $query)
        or die("Не удалось выполнить запрос");
    mysqli_close($dbc);

    // Нахожу последние индексы report, boss1, boss2

    $dbc=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
    or die("Не удалось подключиться к БД");
    $queryRep="SELECT id_report FROM reports ORDER BY id_report DESC LIMIT 1";
    $res=mysqli_query($dbc, $queryRep)
        or die(" Не удалось извлечь ид report");
    while($row=mysqli_fetch_array($res))
    {
        $last_id_report=$row['id_report'];
    }


    $query="SELECT id_boss FROM boss ORDER BY id_boss DESC LIMIT 1";
    $res=mysqli_query($dbc, $query)
    or die(" Не удалось извлечь ид boss");
    while($row=mysqli_fetch_array($res))
    {
        $last_id_boss2=$row['id_boss'];
    }
    $last_id_boss1=($last_id_boss2-1);


    //Вставляю данные о авторе статьи на основании выше ид

    $query="INSERT INTO users (id_user, firstnameUser, secondnameUser, midlenameUser, birthdate, city, country, fullNameInstitute, abbreviationInstitute, 
                              id_status, nameFaculti, id_course, email, telephone, id_firstBoss, id_secondBoss, id_report) 
            VALUES ('','$authorFirstname','$authorSecondname','$authorMidlname','$authorBirthdate', '$authorCity', '$authorCountry', '$authorUniversityName',
                    '$authorAbbreviatureUniver','$authorStatusAuthor', '$authorFacultyName', '$authorCourse','$authorEmail','$authorTelephone',
                    '$last_id_boss1','$last_id_boss2', '$last_id_report')";
    $result=mysqli_query($dbc, $query)
    or die("Не удалось выполнить запрос по добавлению автора");



}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <div id="conteiner">
        <div id="lang">
            <b>Рабочий язык конференции (Language of the conference):</b><br>
            <em class="hint">Дальнейшее заполнение формы - СТРОГО на выбранном языке (Further form filling - ONLI in selected language)!!!</em><br>

            <?php
            include_once 'connect.php';
            $dbc=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
            or die("Не удалось подключиться к БД");
            $query="SELECT * FROM languages";
            $result=mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            echo'<select name="chooseLanguage" required>';
            while($row=mysqli_fetch_array($result))
            {
                echo '<option value="'.$row['id_language'].'">'.$row['name_language'].'</option>';
            }
            echo'</select>';
            ?>
        </div>

        <div id="abstracts">
            <h3 class="hint">Сумма символов во всех строках тезисов не должна превышать 2700</h3>
            <b> Название работы (Title of Paper)</b><br>
            <em class="hint"> Пример (example): Особенности центральной гемодинамики у пациентов с метаболическим синдромом</em><br>
            <input type="text" name="titleOfPaper" id="titleOfPaper" required pattern="^[A-ZА-Я]{1}.*$"><br>

        </div>
        <br><br>

        <div id="introduction">
            <b> Введение (Introduction)</b><br>
            <textarea rows="10" cols="80" name="introduction" required></textarea>
        </div>
        <br><br>

        <div id="aim">
            <b> Цель исследования (Aim)</b><br>
            <textarea rows="10" cols="80" name="aim" required></textarea>
        </div>
        <br><br>

        <div id="materialsAndMethods">
            <b> Материалы и методы (Materials and methods)</b><br>
            <textarea rows="10" cols="80" name="materialsAndMethods" required></textarea>
        </div>
        <br><br>

        <div id="results">
            <b> Результаты (Results)</b><br>
            <textarea rows="10" cols="80" name="results" required></textarea>
        </div>
        <br><br>

        <div id="conclusions">
            <b> Выводы (Conclusions)</b><br>
            <textarea rows="10" cols="80" name="conclusions" required></textarea>
        </div>
        <br><br>


        <h1 id="aboutAuthor"> Информация об авторе (Information about the Author)</h1><hr><br>
        <div id="aboutAuthor">

            <b> Фамилия автора (Author`s Surname):</b><br>
            <input type="text" name="secondname" required pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" placeholder="Соколов"><br><br>

            <b> Имя автора (Author`s Name):</b><br>
            <input type="text" name="firstname" required pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" placeholder="Александр"><br><br>

            <b> Отчество автора (Author`s Second name):</b><br>
            <input type="text" name="midlname" required pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" placeholder="Александрович"><br><br>

            <b> Дата рождения автора (Date of Birth):</b><br>
            <input type="date" name="birthdate" max="2007-01-01" min="1920-01-01" required title="Введите в формате: ГГГГ-ММ-ДД" placeholder="ГГГГ-ММ-ДД"><br><br>

            <b> Город автора (City):</b><br>
            <input type="text" name="city"required placeholder="Минск" pattern="^[А-Я]{1}[а-яА-Я\-\s]{2,40}|[A-Z]{1}[a-zA-Z\-\s]{2,40}$"><br><br>

            <b> Страна автора (Country):</b><br>
            <input type="text" name="country"required placeholder="Республика Беларусь" pattern="^[А-Я]{1}[а-яА-Я\-\s]{2,40}|[A-Z]{1}[a-zA-Z\-\s]{2,40}$"><br><br>

            <b> Полное название учебного заведения/организации автора (Full name of the institution which the Author represent):</b><br>
            <em class="hint">Пример (example): Белорусский государственный медицинский университет</em><br>
            <input type="radio" name="universityName" value="Белорусский государственный медицинский университет" checked><em class="radioNameUniver"> Белорусский государственный медицинский университет</em><br>
            <input type="radio" name="universityName" value="другое" id="otherUniver1"><em class="radioNameUniver"> Другое:</em>
            <input type="text" name="nameOtherUniversity" pattern="^[А-Я]{1}[а-яА-Я\-\s]{5,300}|[A-Z]{1}[a-zA-Z\-\s]{5,300}$" id="otherUniver"> <br><br>

            <b> Сокращенное название учебного заведения/организации автора (Abbreviation of the institution, which the Author represent):</b><br>
            <input type="text" name="abbreviatureUniver"required placeholder="БГМУ" pattern="^[А-Я]{2,30}|[A-Z]{2,30}$"><br><br>

            <b> Статус автора (Status of the author):</b><br>
            <em class="hint"> На момент участия в Конференции</em><br>

            <?php
            $query="SELECT * FROM statuses";
            $result=mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            echo'<select name="statusAuthor" required>';
            while($row=mysqli_fetch_array($result))
            {
                echo '<option value="'.$row['id_status'].'">'.$row['name_status'].'</option>';
            }
            echo'</select>';
            ?><br><br>

            <b> Факультет автора (faculty of the Author):</b><br>
            <em class="hint">Если Вы не являетесь студентом, выберите вариант ответа "Нет" (If you are not a student, select "No")</em><br>

            <?php
            $query="SELECT * FROM faculties";
            $result=mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            while($row=mysqli_fetch_array($result))
            {
                echo'<br>';
                echo'<input type="radio" name="facultyName" value="'.$row['name_faculti'].'"><em class="radioNameUniver"> '.$row['name_faculti'].' </em>';
            }
            ?>

            <input type="text" name="nameOtherFaculty" pattern="^[А-Я]{1}[а-яА-Я\-\s]{3,150}|[A-Z]{1}[a-zA-Z\-\s]{3,150}$" id="otherUniver" placeholder="Нейронные сети"> <br><br>


            <b> Курс автора (Course):</b><br>
            <?php
            $query="SELECT * FROM courses";
            $result=mysqli_query($dbc, $query)
            or die ("Не удалось выполнить запрос");

            echo'<select name="courseAuthor" required>';
            while($row=mysqli_fetch_array($result))
            {
                echo '<option value="'.$row['id_course'].'">'.$row['name_course'].'</option>';
            }
            echo'</select>';
            ?><br><br>

            <b> E-mail автора:</b><br>
            <em class="hint">Ввнимание! Указанный Вами e-mail будет использован Оргкомитетом Конференции для обратной связи
                (Attention! Your e-mail will be used by the Organizing Commitee of the Conference for feedback)</em><br>
            <input type="email" name="emailAuthor" placeholder="example@exam.ru" required pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"><br><br>

            <b> Телефон автора (Telephone №):</b><br>
            <em class="hint">+375*********</em><br>
            <input type="text" name="telAuthor" required pattern="^[0-9()\-+ ]{12,19}" title="Введите в формате +375-(33)-111-22-33"><br><br>
        </div>



        <h1 id="secondAuthorLabel">Сведения о Соавторе<br>
            Information about the Second Author </h1>
        <div id="secondAuthor">

            <h3 id="firstSupervisorLabel" >Сведения о 1-ом научном руководителе<br>
                Information about the first Supervisor
            </h3><hr>

            <div id="firstSupervisor">


                <b> Фамилия 1-го научного руководителя (Surname of the 1st Supervisor):</b><br>
                <input type="text" name="secondnameSupervisor" required pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" placeholder="Петрова"><br><br>

                <b> Имя 1-го научного руководителя (Name of the 1st Supervisor):</b><br>
                <input type="text" name="firstnameSupervisor" required pattern="^[А-Я]{1}[а-яА-Я\-\s]{2,50}|[A-Z]{1}[a-zA-Z\-\s]{2,50}$" placeholder="Маргорита"><br><br>

                <b> Отчество 1-го научного руководителя (Second name of the 1st Supervisor):</b><br>
                <input type="text" name="midlnameSupervisor" pattern="^[А-Я]{1}[а-яА-Я]{2,30}|[A-Z]{1}[a-zA-Z]{2,30}$" placeholder="Александровна"><br><br>

                <b>Учёная степень 1-го научного руководителя (Scientific degree of the 1st Supervisor)</b><br>

                <?php
                $query="SELECT * FROM scientificDegree";
                $result=mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo'<select name="scientificDegree" required>';
                while($row=mysqli_fetch_array($result))
                {
                    echo '<option value="'.$row['id_scientificDegree'].'">'.$row['name_scientificDegree'].'</option>';
                }
                echo'</select>';
                ?><br><br>

                <b>Учёное звание 1-го научного руководителя (Academic rank of the 1st Supervisor)</b><br>

                <?php
                $query="SELECT * FROM academicRanks";
                $result=mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo'<select name="academicRanks" required>';
                while($row=mysqli_fetch_array($result))
                {
                    echo '<option value="'.$row['id_academicRanks'].'">'.$row['name_academicRanks'].'</option>';
                }
                echo'</select>';
                ?><br><br>


                <b>Должность 1-го научного руководителя (Position of the 1st Supervisor)</b><br>

                <?php
                $query="SELECT * FROM positionSupervisor";
                $result=mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo'<select name="positionSupervisor" required>';
                while($row=mysqli_fetch_array($result))
                {
                    echo '<option value="'.$row['id_positionSupervisor'].'">'.$row['name_positionSupervisor'].'</option>';
                }
                echo'</select>';
                ?><br><br>


                <b> Полное название учебного заведения/организации 1-го научного руководителя (Full name of the 1st Supervisor institution):</b><br>
                <input type="radio" name="universityNameSupervisor" value="Белорусский государственный медицинский университет" checked><em class="radioNameUniver"> Белорусский государственный медицинский университет</em><br>
                <input type="radio" name="universityNameSupervisor" value="другое"><em class="radioNameUniver"> Другое:</em>
                <input type="text" name="nameOtherUniversitySupervisor" pattern="^[А-Я]{1}[а-яА-Я\-\s]{5,300}|[A-Z]{1}[a-zA-Z\-\s]{5,300}$" id="otherUniver" title="Название должно начинаться с заглавной буквы"> <br><br>


                <b>Название кафедры/структурного подразделения 1-го научного руководителя (Department)</b><br>
                <em class="hint"> Пример (example): Акушерства и гинекологии</em><br>
                <input type="text" name="department"required pattern="^[А-Я]{1}[а-яА-Я\-\s]{3,150}|[A-Z]{1}[a-zA-Z\-\s]{3,150}$"><br><br>

                <b> Город 1-го научного руководителя (City):</b><br>
                <input type="text" name="citySupervisor"required placeholder="Минск" pattern="^[А-Я]{1}[а-яА-Я\-\s]{3,30}|[A-Z]{1}[a-zA-Z\-\s]{3,30}$"><br><br>

                <b> E-mail  1-го научного руководителя (E-mail of the 1st Supervisor):</b><br>
                <input type="email" name="emailSupervisor" placeholder="example@exam.ru" pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"><br><br>

                <b> Телефон 1-го научного руководителя (Telephone № of the 1st Supervisor):</b><br>
                <input type="tel" name="telSupervisor" pattern="^[0-9()\-+ ]{12,19}" title="Введите в формате +375-(33)-111-22-33""><br><br>

            </div>


            <h3 id="secondSupervisorLabel">Сведения о 2-ом научном руководителе<br>
                Information about the second Supervisor
            </h3><hr>

            <div id="secondSupervisor">

                <b> Фамилия 2-го научного руководителя (Surname of the 2st Supervisor):</b><br>
                <input type="text" name="secondnameSupervisor2"  pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" placeholder="Петрова"><br><br>

                <b> Имя 2-го научного руководителя (Name of the 2st Supervisor):</b><br>
                <input type="text" name="firstnameSupervisor2"  pattern="^[А-Я]{1}[а-яА-Я\-]{2,30}|[A-Z]{1}[a-zA-Z\-]{2,30}$" placeholder="Маргорита"><br><br>

                <b> Отчество 2-го научного руководителя (Second name of the 2st Supervisor):</b><br>
                <input type="text" name="midlnameSupervisor2" pattern="^[А-Я]{1}[а-яА-Я]{2,30}|[A-Z]{1}[a-zA-Z]{2,30}$" placeholder="Александровна"><br><br>

                <b>Учёная степень 2-го научного руководителя (Scientific degree of the 2st Supervisor)</b><br>

                <?php
                $query="SELECT * FROM scientificDegree";
                $result=mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo'<select name="scientificDegree2" >';
                while($row=mysqli_fetch_array($result))
                {
                    echo '<option value="'.$row['id_scientificDegree'].'">'.$row['name_scientificDegree'].'</option>';
                }
                echo'</select>';
                ?><br><br>

                <b>Учёное звание 2-го научного руководителя (Academic rank of the 2st Supervisor)</b><br>

                <?php
                $query="SELECT * FROM academicRanks";
                $result=mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo'<select name="academicRanks2" >';
                while($row=mysqli_fetch_array($result))
                {
                    echo '<option value="'.$row['id_academicRanks'].'">'.$row['name_academicRanks'].'</option>';
                }
                echo'</select>';
                ?><br><br>


                <b>Должность 2-го научного руководителя (Position of the 2st Supervisor)</b><br>

                <?php
                $query="SELECT * FROM positionSupervisor";
                $result=mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo'<select name="positionSupervisor2" >';
                while($row=mysqli_fetch_array($result))
                {
                    echo '<option value="'.$row['id_positionSupervisor'].'">'.$row['name_positionSupervisor'].'</option>';
                }
                echo'</select>';
                ?><br><br>


                <b> Полное название учебного заведения/организации 2-го научного руководителя (Full name of the 2st Supervisor institution):</b><br>
                <input type="radio" name="universityNameSupervisor2" value="Белорусский государственный медицинский университет" ><em class="radioNameUniver"> Белорусский государственный медицинский университет</em><br>
                <input type="radio" name="universityNameSupervisor2" value="другое"><em class="radioNameUniver"> Другое:</em>
                <input type="text" name="nameOtherUniversitySupervisor2" pattern="^[А-Я]{1}[а-яА-Я\-\s]{5,300}|[A-Z]{1}[a-zA-Z\-\s]{5,300}$" id="otherUniver" title="Название должно начинаться с заглавной буквы"> <br><br>


                <b>Название кафедры/структурного подразделения 2-го научного руководителя (Department)</b><br>
                <em class="hint"> Пример (example): Акушерства и гинекологии</em><br>
                <input type="text" name="department2" pattern="^[А-Я]{1}[а-яА-Я\-\s]{3,150}|[A-Z]{1}[a-zA-Z\-\s]{3,150}$"><br><br>

                <b> Город 2-го научного руководителя (City):</b><br>
                <input type="text" name="citySupervisor2" placeholder="Минск" pattern="^[А-Я]{1}[а-яА-Я\-\s]{3,30}|[A-Z]{1}[a-zA-Z\-\s]{3,30}$"><br><br>

                <b> E-mail  2-го научного руководителя (E-mail of the 1st Supervisor):</b><br>
                <input type="email" name="emailSupervisor2" placeholder="example@exam.ru" pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"><br><br>

                <b> Телефон 2-го научного руководителя (Telephone № of the 1st Supervisor):</b><br>
                <input type="tel" name="telSupervisor2" pattern="^[0-9()\-+ ]{12,19}" title="Введите в формате +375-(33)-111-22-33""><br><br>

            </div>
        </div>



            <h1 id="otherInformationLabel"> Прочие сведения  <h3>Other information</h3></h1><hr>
            <div id="otherInformation">
                <b>Секция (Section):</b><br>
                <em class="hint">Выберите научное направление Конференции, в котором хотите принять участие
                    (Select Conference themes, which you would like participate):</em><br>
                <?php
                $query="SELECT * FROM sections";
                $result=mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo'<select name="section" required>';
                while($row=mysqli_fetch_array($result))
                {
                    echo '<option value="'.$row['id_section'].'">'.$row['name_section'].'</option>';
                }
                echo'</select>';
                ?><br><br>

                <b>Форма участия (The form of participation):</b><br>
                <?php
                $query="SELECT * FROM formParticipation";
                $result=mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo'<select name="formParticipation" required>';
                while($row=mysqli_fetch_array($result))
                {
                    echo '<option value="'.$row['id_formParticipation'].'">'.$row['name_formParticipation'].'</option>';
                }
                echo'</select>';
                ?><br><br>


                <b>Содержание доклада(Contents of the report):</b><br>
                <?php
                $query="SELECT * FROM contentsReport";
                $result=mysqli_query($dbc, $query)
                or die ("Не удалось выполнить запрос");

                echo'<select name="contentsReport" required>';

                while($row=mysqli_fetch_array($result))
                {
                    echo '<option value="'.$row['id_contentsReport'].'">'.$row['name_contentsReport'].'</option>';
                }
                echo'</select>';
                mysqli_close($dbc);
                ?><br><br>

            </div>



        <button  type="submit" name="btnSend" ><a href="info.html">Отправить</a></button><br><br>

        </div>
</form>

<footer>
    <h3> &copy Центр развития информационных технологий БГМУ 2017 </h3>
</footer>

</body>
</html>