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
                scrollTop: 6000
            }, delay);
        });
    });

});