$(document).ready(function () {

    $("#aboutAuthor").click(function () {
        $("div#aboutAuthor").slideToggle(500);
    });
    $("#aboutAuthor2").click(function () {
        $("div#aboutAuthor2").slideToggle(500);
    });

    $("#secondAuthorLabel").click(function () {
        $("div#secondAuthor").slideToggle(500);
    });

    $("#firstSupervisorLabel").click(function () {
        $("div#firstSupervisor").slideToggle(500);
    });

    $("#secondSupervisorLabel").click(function () {
        $("div#secondSupervisor").slideToggle(500);
    });

    $("#otherInformationLabel").click(function () {
        $("div#otherInformation").slideToggle(500);
    });

    var top_show = 1500; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
    var delay = 800; // Задержка прокрутки
    $(document).ready(function() {
        $(window).scroll(function () { // При прокрутке попадаем в эту функцию
            /* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" */
            if ($(this).scrollTop() > top_show) $('#top').fadeIn();
            else $('#top').fadeOut();
        });
        $('#top').click(function () { // При клике по кнопке "Наверх" попадаем в эту функцию
            /* Плавная прокрутка наверх */
            $('body, html').animate({
                scrollTop: 0
            }, delay);
        });
    });

    var bottom_show = 4800; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
    var delay = 800; // Задержка прокрутки
    $(document).ready(function() {
        $(window).scroll(function () { // При прокрутке попадаем в эту функцию
            /* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" */
            if ($(this).scrollTop() < bottom_show) $('#bottom').fadeIn();
            else $('#bottom').fadeOut();
        });
        $('#bottom').click(function () { // При клике по кнопке "Наверх" попадаем в эту функцию
            /* Плавная прокрутка наверх */
            $('body, html').animate({
                scrollTop: $("#conteiner").height()
            }, delay);
        });
    });


});

function CheckFile(file) {
    var good_ext = false;// Флаг для валидации расширения файла
    var good_size = false;// Флаг для валидации размера файла
    var maxsize = 3145728;
    var iSize = 0;// Для хранения размера загружаемого файла

    iSize = $(file)[0].files[0].size;

    if (maxsize > iSize) {
        good_size = true;
    }

    if ($(file)[0].files[0].type == "application/pdf") {
        good_ext = true;
    }
    var error = '';// Для хранения ошибки

    if (!good_ext) {            // Если расширение не совпадает с фильтром
        error += "Внимание! Разрешено прикреплять только .pdf файлы! Повторите операцию!";
    }
    // Если у нас уже есть ошибка - ставим переход на новую строку
    if (error != '') {
        error += "\r\n";
    }

    if (!good_size) {// Если не прошли валидацию по размеру файла
        error += "Внимание! Ваш файл превышает допустимый размер 3 Mb! Выберите другой файл!";
    }
    // Если есть ошибки
    if (error != '') {
        // очищаем значение input file
        $(file).val("");
        alert(error);
    }
    return false;
}