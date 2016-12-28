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
<div>
    <!---->
    <!--<h1> Выбери категорию</h1>-->
    <!---->
    <!---->
    <!--    --><?php
    //    if(isset($_POST['butOK']))
    //    {
    //        $selCount=$_POST['counter'];
    //        echo $selCount;
    //    }
    //
    //
    //
    //    $dbc=mysqli_connect('localhost', 'root','', 'example')
    //        or die(" Не удалось соединиться с БД");
    //    $query="SELECT * FROM tesisName";
    //    $result=mysqli_query($dbc, $query)
    //        or die(" Не удалось выполнить запрос");
    //    ?>
    <!--    <form method="post" action="--><?php //echo $_SERVER['PHP_SELF']; ?><!--">-->
    <!---->
    <!--        <select name="counter">-->
    <!--            --><?php
    //            while($row=mysqli_fetch_array($result))
    //            {
    //                echo"<option name='val ' >".$row['name_tesis']."</option>";
    //            }
    //            ?>
    <!--        </select><br>-->
    <!---->
    <!--       <button type="submit" name="butOK" value="butOK">OK</button>-->
    <!--        <input type="submit" name="subOK" value="Отправить">-->
    <!--    </form>-->
    <!---->
    <!---->
    <!---->
    <!---->
    <?php
    //    mysqli_close($dbc);
    //    ?>
    <!---->
</div>

<div class="header">
    <h1> Регистрация участников LXXI</h1>
    <h1>АПСМиФ 2017</h1>
    <h3>Registration</h3>
    <hr>
</div>

<div id="conteiner">
    <div id="lang">
        <b>Рабочий язык конференции (Language of the conference):</b><br>
        <em class="hint">Дальнейшее заполнение формы - СТРОГО на выбранном языке (Further form filling - ONLI in selected language)!!!</em><br>

        <?php
        include_once 'connect.php';
        $dbc=mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
        or die("Не удалось подключиться к БД");
        $query="SELECT * FROM language";
        $result=mysqli_query($dbc, $query)
        or die ("Не удалось выполнить запрос");

        echo'<select name="chooseLanguage" required>';
        while($row=mysqli_fetch_array($result))
        {
            echo '<option>'.$row['name_language'].'</option>';
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



    
</div>




</body>
</html>