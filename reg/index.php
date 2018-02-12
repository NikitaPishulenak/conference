<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конференция</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<?php
include_once 'connect.php';
ini_set('display_errors', '1');
$dbc = mysqli_connect(HOST, USER_NAME, USER_PWD, DB_NAME)
or die("Не удалось подключиться к БД");
mysqli_query($dbc, 'SET NAMES utf8');

if (isset($_GET['sendReg'])) {
    $fio = $_GET['fio'];
    $univer = $_GET['univer'];
    $email = $_GET['email'];
    $fio = trim($fio);
    $univer = trim($univer);
    $email = trim($email);
    $d = date('Y-m-d H:i:s');
    $msg = 'Прошу выдать мне логин и пароль для входа на snoform.bsmu.by';
    if (!empty($fio) && !empty($univer) && !empty($email)) {
        if (mysqli_query($dbc, "INSERT INTO reg (id, fio, univer, email, date_reg) VALUES ('', '$fio', '$univer', '$email', '$d')")) {
            echo "<div class='wrapper'>Вы успешно прошли регистрацию. В течении суток, на указанный вами электронный ящик, придет сообщение с вашими авторизационными данными!</div>";
            mysqli_close($dbc);

            $message_for_user = '';
            session_start();

            if ($message_for_user != 'field') {

                function read_smtp_answer($socket)
                {
                    $read = socket_read($socket, 1024);
                    if ($read{0} != '2' && $read{0} != '3') {
                        if (!empty($read)) {
                            throw new Exception('SMTP failed: ' . $read . "\n");
                        } else {
                            throw new Exception('Unknown error' . "\n");
                        }
                    }
                }

                if (!preg_match("/^(([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9\-]+)\.[a-zA-Z0-9\-.]+$)/", $email)) {
                    $message_for_user = 'field';
                } else {
                    // Функция для отправки запроса серверу
                    function write_smtp_response($socket, $msg)
                    {
                        $msg = $msg . "\r\n";
                        socket_write($socket, $msg, strlen($msg));
                    }

                    //------------------------------------------- //

                    $address = 'mail.bsmu.by';
                    $port = 25;
                    $login = 'sno2018';
                    $pwd = 'xsWMIZpZf#Wko|q';
                    $from = 'sno2018@bsmu.by';
                    $to = 'snobsmuform@mail.ru';
                    //------------------------------------------- //
                    try {
                        // Создание сокета
                        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
                        if ($socket < 0) {
                            throw new Exception('socket_create() failed: ' . socket_strerror(socket_last_error()) . "\n");
                        }
                        // Соединение сокета к серверу
                        $result = socket_connect($socket, $address, $port);
                        if ($result === false) {
                            throw new Exception('socket_connect() failed: ' . socket_strerror(socket_last_error()) . "\n");
                        }
                        // Чтение информацию о сервере
                        read_smtp_answer($socket);
                        // Обращение к серверу
                        write_smtp_response($socket, 'EHLO ' . $login);
                        read_smtp_answer($socket); // ответ сервера
                        // Запрос авторизации
                        write_smtp_response($socket, 'AUTH LOGIN');
                        read_smtp_answer($socket); // ответ сервера
                        // Отравка логина
                        write_smtp_response($socket, base64_encode($login));
                        read_smtp_answer($socket); // ответ сервера
                        // Отравка пароль
                        write_smtp_response($socket, base64_encode($pwd));
                        // Адрес отправителя
                        write_smtp_response($socket, 'MAIL FROM:<' . $from . '>');
                        read_smtp_answer($socket); // ответ сервера
                        // Задаем адрес получателя
                        write_smtp_response($socket, 'RCPT TO:<' . $to . '>');
                        read_smtp_answer($socket); // ответ сервера
                        // Подготовка сервера к приему данных
                        write_smtp_response($socket, 'DATA');
                        read_smtp_answer($socket); // ответ сервера
                        $message = "Content-type: text/html; charset=\"UTF-8\"\r\n To: $to\r\n\r\n Запрос на регистрастрацию учетной записи!\r\n\r\n";
                        $message .= "<br><br><strong>Имя заявителя: </strong> " . $fio . "<br/> ";
                        $message .= "<strong>ВУЗ: </strong> " . $univer . "<br/> ";
                        $message .= "<strong>Почтовый ящик: </strong>" . $email . "<br/> ";
                        $message .= "<strong>Зарегистрировался: </strong>" . $d . "<br/> ";
                        $message .= "<strong>Сообщение: </strong>" . $msg . "<br/> ";
                        write_smtp_response($socket, $message . "\r\n.");
                        read_smtp_answer($socket); // ответ сервера
                        // Отсоединяемся от сервера
                        write_smtp_response($socket, 'QUIT');
                        read_smtp_answer($socket); // ответ сервера
                    } catch (Exception $e) {
                        $message_for_user = "\nError: " . $e->getMessage();
                    }
                    if (isset($socket)) {
                        socket_close($socket);
                    }
                }
            }
            echo $message_for_user;


            exit();
        } else {
            echo "<div class='wrapper'>Не удалось провести авторизацию! Повторите попытку позже!</div>";
        }
    } else {
        echo "<div class='wrapper'>Вы не заполнили обязательные поля!</div>";
    }
}

?>

<div class="wrapper">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <h2>Регистрация учетной записи!</h2>

        <label>ФИО</label><span class="req">*</span><br>
        <input type="text" id="fio" name="fio" required placeholder="Иванов Семён Степанович"
               pattern="^[А-Я]{1}[а-яА-Я\-\s]{5,80}|[A-Z]{1}[a-zA-Z\-\s]{5,80}$"
               title="Размер ФИО должен находиться в пределах 5-80 символов. Начинаться с прописной буквы."><br><br>

        <label>Название университета</label><span class="req">*</span><br>
        <input type="text" id="univer" name="univer" required
               placeholder='УО Белорусский государственный медицинский университет'
               pattern="^[А-Я]{1}[а-яА-Я\-\s]{5,150}|[A-Z]{1}[a-zA-Z\-\s]{5,150}$"
               title="Размер поля должен находиться в пределах 5-150 символов. Начинаться с прописной буквы. Не используйте спец. символы. (только буквы)"><br><br>

        <label>email</label><span class="req">*</span><br>
        <input type="text" id="email" name="email" required placeholder="example@gmail.com"
               pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"
               title="Неверный email"><br><br>

        <br>
        <input type="submit" value="Отправить" name="sendReg" id="sendReg">

    </form>
</div>


</body>
</html>