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

    function validateSize(fileInput) {
        var fileObj, size;
        if ( typeof ActiveXObject == "function" ) { // IE
            fileObj = (new ActiveXObject("Scripting.FileSystemObject")).getFile(fileInput.value);
        }else {
            fileObj = fileInput.files[0];
        }

        size = fileObj.size; // Size returned in bytes.
        alert(size);
        if(size > 4 * 1024 * 1024){//50Mb
            alert('To big file for uploading (4Mb - max)');
            //Очищаем поле ввода файла
            fileInput.parentNode.innerHTML = fileInput.parentNode.innerHTML;
        }
    }
    $('#uploadFile').change(function () {
        alert("22");
        alert($('#uploadFile').fileSizes());
        validateSize(this);
    });

});