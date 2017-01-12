<?php
include_once 'PHPWord.php';
include_once 'selectResults.php';
echo"Hello";
$word=new PHPWord();

$word->setDefaultFontName('Times New Roman');
$word->setDefaultFontSize(20);

$title="Вариантная анатомия переднего и заднего решетчатых отверстий человека  ";
$intro="Изучение переднего и заднего решетчатых отверстий актуально при операциях, травмах медиальной стенки глазницы и разработке хирургического доступа. Данные о форме, размерах, количестве решетчатых отверстий, расположении у лиц различного пола и конституции противоречивы. В диагностике этих отверстий используется эндоскопический метод, но его возможности ограничены из-за отсутствия точных анатомических данных.";
$aim="Установить закономерности строения переднего и заднего решетчатых отверстий человека у лиц различного пола и конституции.";
$materials="Мацерированные черепа человека из краниологической коллекции музея кафедры нормальной анатомии БГМУ изучены с помощью анатомического, морфометрического и статистического методов. ";
$results="В результате исследования определены размеры, количество, форма решетчатых отверстий. Установлены расстояния между отверстиями и костными ориентирами медиальной стенки глазницы (зрительным каналом, передним слезным гребнем, лобно-решетчатым швом) в зависимости от пола и конституционального типа черепа и глазницы. Выявлены типы черепа и формы глазницы. Определены анатомические предпосылки для безопасного хирургического доступа к медиальной стенке глазницы, которыми являются: отсутствие множественных добавочных решетчатых отверстий; увеличение расстояния между передним слезным гребнем и решетчатыми отверстиями у мужчин; преобладание дистанции между отверстиями и зрительным каналом у женщин. ";
$conclusions="1. Строение и взаимоотношение переднего и заднего решетчатых отверстий человека имеют конституциональные и половые особенности. 2. Существуют определенные закономерности строения, расположения решетчатых отверстий и расстояний между ними и костными ориентирами глазницы.";


$template = $word->loadTemplate('template.docx'); //Загружаем шаблон
$template->setValue('title', $title); //Производим замену метки на значение
$template->setValue('secondnameFA', 'Pishulenak'); //И еще одну метку
$template->setValue('firstnameFA', 'Mikita'); //И еще одну метку
$template->setValue('midlenameFA', 'Aleksandrovich'); //И еще одну метку

$template->setValue('secondnameSA', 'Motorikin'); //И еще одну метку
$template->setValue('firstnameSA', 'Aleksandr'); //И еще одну метку
$template->setValue('midlenameSA', 'Olegovich'); //И еще одну метку

$template->setValue('univer', 'BSUIR'); //И еще одну метку
$template->setValue('city', 'Minsk'); //И еще одну метку
$template->setValue('1', 'kandidat'); //И еще одну метку
$template->setValue('2', 'docent'); //И еще одну метку

$template->setValue('secondnameS', 'Guseva'); //И еще одну метку
$template->setValue('firstnameS', 'Ulija'); //И еще одну метку
$template->setValue('midlenameS', 'Stepanovna'); //И еще одну метку
$template->setValue('secondnameSS', 'Guseva'); //И еще одну метку
$template->setValue('firstnameSS', 'Ulija'); //И еще одну метку
$template->setValue('midlenameSS', 'Stepanovna'); //И еще одну метку
$template->setValue('univerS', 'BGMU');
$template->setValue('cityS', 'Mogilev');

$template->setValue('intro', $intro); //И еще одну метку
$template->setValue('aim', $aim); //И еще одну метку
$template->setValue('material', $materials); //И еще одну метку
$template->setValue('results', $results);
$template->setValue('conclusion', $conclusions);

//$template->save('ConferenceData/$/document.docx'); //Сохраняем результат в файл
?>
