<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Заполнение рандомом</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

//Добавление в табл reports
if (isset($_POST['insertReports']))
{
    include_once 'connect.php';
    $dbc=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
    or die ("Соединение не установлено");
    for ($i=1; $i<101; $i++)
    {
        $id_section=floor(rand(1,75));
        $id_contentRep=floor(rand(1,2));
        $id_formPart=floor(rand(1,3));

        $query="INSERT INTO reports (id_report, title_report, introduction, aim, materialsAndMethods, results, conclusions, id_contentReport, id_formParticipation, id_sections)
           VALUES ('','Название','Введение','Цели', 'Материалы', 'Результаты', 'Выводы', '$id_contentRep','$id_formPart','$id_section')";
        mysqli_query($dbc, $query);
    }
    mysqli_close($dbc);
    echo "добавление выполнено";

}


//Добавление в табл users
if (isset($_POST['insertUser']))
{
    include_once 'connect.php';
    $dbc=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
    or die ("Соединение не установлено");
    for ($i=0; $i<100; $i++)
    {
        $id_status=floor(rand(1,16));
        $id_course=floor(rand(1,7));

        $query="INSERT INTO users (id_user, firstnameUser, secondnameUser, midlenameUser, birthdate, city, country, fullNameInstitute, abbreviationInstitute, 
                                  id_status, nameFaculti, id_course, email, telephone) 
                VALUES ('','Имя','Фамилия','Отчество','1990-10-02','Гомель','Республика Беларусь','Бел Гос Универ','БГУ','$id_status','Прикладжного программирования',
                        '$id_course','ex@mail.ru','375331112233')";
        mysqli_query($dbc, $query);
    }
    mysqli_close($dbc);
    echo "добавление выполнено";

}

//Добавление в табл boss
if (isset($_POST['insertBoss']))
{
    include_once 'connect.php';
    $dbc=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
    or die ("Соединение не установлено");
    for ($i=0; $i<100; $i++)
    {
        $id_scienDegree=floor(rand(1,38));
        $id_acadRanks=floor(rand(1,18));
        $id_positSuper=floor(rand(1,24));

        $query="INSERT INTO boss (id_boss, firstnameBoss, secondnameBoss, midlnameBoss, id_scientificDegree, id_academicRanks, id_positionSupervisor, 
                                fullNameInstitute, name_department, city, email, telephone) 
                VALUES ('','ИмяРуководителя','ФамилияРуководителя','ОтчествоРуководителя','$id_scienDegree','$id_acadRanks','$id_positSuper',
                      'Бел Гос Универ Инф и Радиоэл','Прогр обесп инф техн','Минск','boss@mail.ru','')";
        mysqli_query($dbc, $query);
    }
    mysqli_close($dbc);
    echo "добавление выполнено";

}


//Добавление в табл conference
if (isset($_POST['insertConf']))
{
    include_once 'connect.php';
    $dbc=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
    or die ("Соединение не установлено");
    for ($i=0; $i<50; $i++)
    {
        $id_lang=floor(rand(1,2));
        $id_report=floor(rand(1,104));
        $id_user1=floor(rand(1,108));
        $id_user2=floor(rand(1,108));
        $id_boss1=floor(rand(1,107));
        $id_boss2=floor(rand(1,107));

        $query="INSERT INTO conference (id_conference, id_languages, id_report, id_user1, id_user2, id_boss1, id_boss2) 
                VALUES ('','$id_lang','$id_report','$id_user1','$id_user2','$id_boss1','$id_boss2')";
        mysqli_query($dbc, $query);
    }
    mysqli_close($dbc);
    echo "добавление выполнено";

}

 ?>

<div id="conteiner">
    <form method="post" action="">
        <input type="submit" name="insertReports" value="Добавить доклады">
        <input type="submit" name="insertUser" value="Добавить пользователя">
        <input type="submit" name="insertBoss" value="Добавить руководителя">
        <input type="submit" name="insertConf" value="Добавить выступление">

    </form>
</div>

</body>
</html>