$(document).ready(function () {
    $("#aboutAuthor").click(function () {
        $("div#aboutAuthor").slideToggle(500);
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
});