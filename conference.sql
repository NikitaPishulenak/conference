-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 29 2016 г., 12:08
-- Версия сервера: 5.5.50
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `conference`
--

-- --------------------------------------------------------

--
-- Структура таблицы `academicRanks`
--

CREATE TABLE IF NOT EXISTS `academicRanks` (
  `id_academicRanks` int(10) NOT NULL,
  `name_academicRanks` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `academicRanks`
--

INSERT INTO `academicRanks` (`id_academicRanks`, `name_academicRanks`) VALUES
(1, 'Академик'),
(2, 'Член-корреспондент'),
(3, 'Профессор'),
(4, 'Доцент'),
(5, 'Главный научный сотрудник'),
(6, 'Ведущий научный сотрудник'),
(7, 'Старший научный сотрудник'),
(8, 'Научный сотрудник'),
(9, 'Младший научный сотрудник'),
(10, 'Academician'),
(11, 'Corresponding member'),
(12, 'Professor'),
(13, 'Associate Professor'),
(14, 'Chief Researcher'),
(15, 'Leading Researcher'),
(16, 'Senior Researcher'),
(17, 'Researcher'),
(18, 'Junior Researcher');

-- --------------------------------------------------------

--
-- Структура таблицы `boss`
--

CREATE TABLE IF NOT EXISTS `boss` (
  `id_boss` int(10) NOT NULL,
  `firstnameBoss` varchar(55) NOT NULL,
  `secondnameBoss` varchar(55) NOT NULL,
  `midlnameBoss` varchar(55) DEFAULT NULL,
  `id_scientificDegree` int(11) NOT NULL,
  `id_academicRanks` int(11) NOT NULL,
  `id_positionSupervisor` int(11) NOT NULL,
  `fullNameInstitute` text NOT NULL,
  `name_department` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `contentsReport`
--

CREATE TABLE IF NOT EXISTS `contentsReport` (
  `id_contentsReport` int(10) NOT NULL,
  `name_contentsReport` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contentsReport`
--

INSERT INTO `contentsReport` (`id_contentsReport`, `name_contentsReport`) VALUES
(1, 'Содержит собственные результаты исследования'),
(2, 'Реферативный доклад');

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id_course` int(10) NOT NULL,
  `name_course` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id_course`, `name_course`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, 'Не студент (Not Student)');

-- --------------------------------------------------------

--
-- Структура таблицы `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `id_faculti` int(10) NOT NULL,
  `name_faculti` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `faculties`
--

INSERT INTO `faculties` (`id_faculti`, `name_faculti`) VALUES
(1, 'Лечебный (General Medicine)'),
(2, 'Педиатрический (Pediatrics)'),
(3, 'Стоматологический (Dentisty)'),
(4, 'Медико-профилактический (Preventive Medicine)'),
(5, 'Военно-медицинский (Military Medicine)'),
(6, 'Фармацевтический (Pharmacy)'),
(7, 'Медицинский факультет иностранных учащихся (Medical Faculty for International Students)'),
(8, '-Нет/No-');

-- --------------------------------------------------------

--
-- Структура таблицы `formParticipation`
--

CREATE TABLE IF NOT EXISTS `formParticipation` (
  `id_formParticipation` int(10) NOT NULL,
  `name_formParticipation` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `formParticipation`
--

INSERT INTO `formParticipation` (`id_formParticipation`, `name_formParticipation`) VALUES
(1, 'Устный доклад + публикация тезисов'),
(2, 'Мультимедия  + публикация тезисов'),
(3, 'Публикация тезисов');

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id_language` int(5) NOT NULL,
  `name_language` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id_language`, `name_language`) VALUES
(1, 'русский'),
(2, 'English');

-- --------------------------------------------------------

--
-- Структура таблицы `positionSupervisor`
--

CREATE TABLE IF NOT EXISTS `positionSupervisor` (
  `id_positionSupervisor` int(10) NOT NULL,
  `name_positionSupervisor` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `positionSupervisor`
--

INSERT INTO `positionSupervisor` (`id_positionSupervisor`, `name_positionSupervisor`) VALUES
(1, 'Заведующий кафедрой'),
(2, 'Профессор'),
(3, 'Доцент'),
(4, 'Старший преподаватель'),
(5, 'Преподаватель'),
(6, 'Ассистент'),
(7, 'Аспирант'),
(8, 'Главный научный сотрудник'),
(9, 'Ведущий научный сотрудник'),
(10, 'Старший научный сотрудник'),
(11, 'Научный сотрудник'),
(12, 'Младший научный сотрудник'),
(13, 'Врач'),
(14, 'Главный врач'),
(15, 'Заведующий отделением'),
(16, 'Заведующий лабораторией'),
(17, 'Заведующий отделом'),
(18, 'Ректор'),
(19, 'Проректор'),
(20, 'Заведующий НИЛ'),
(21, 'Директор'),
(22, 'Декан'),
(23, 'Заместитель директора'),
(24, 'Ведущий специалист');

-- --------------------------------------------------------

--
-- Структура таблицы `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id_report` int(10) NOT NULL,
  `title_report` text NOT NULL,
  `introduction` text NOT NULL,
  `aim` text NOT NULL,
  `materialsAndMethods` text NOT NULL,
  `results` text NOT NULL,
  `conclusions` text NOT NULL,
  `id_contentReport` int(11) NOT NULL,
  `id_formParticipation` int(11) NOT NULL,
  `id_sections` int(11) NOT NULL,
  `id_language` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `scientificDegree`
--

CREATE TABLE IF NOT EXISTS `scientificDegree` (
  `id_scientificDegree` int(10) NOT NULL,
  `name_scientificDegree` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `scientificDegree`
--

INSERT INTO `scientificDegree` (`id_scientificDegree`, `name_scientificDegree`) VALUES
(1, 'Кандидат медицинских наук'),
(2, 'PhD'),
(3, 'Доктор медицинских наук'),
(4, 'MD'),
(5, 'Кандидат биологических наук'),
(6, 'Доктор биологических наук'),
(7, 'Кандидат химических наук'),
(8, 'Доктор химических наук'),
(9, 'Кандидат фармацевтических наук'),
(10, 'Доктор фармацевтических наук'),
(11, 'Кандидат технических наук'),
(12, 'Доктор технических наук'),
(13, 'Кандидат филологических наук'),
(14, 'Доктор филологических наук'),
(15, 'Кандидат физико-математических наук'),
(16, 'Доктор физико-математических наук'),
(17, 'Кандидат педагогических наук'),
(18, 'Доктор педагогических наук'),
(19, 'Кандидат исторических наук'),
(20, 'Доктор исторических наук'),
(21, 'Кандидат политических наук'),
(22, 'Доктор политических наук'),
(23, 'Кандидат социологических наук'),
(24, 'Доктор социологических наук'),
(25, 'Кандидат ветеринарных наук'),
(26, 'Доктор ветеринарных наук'),
(27, 'Кандидат философских наук'),
(28, 'Доктор философских наук'),
(29, 'Кандидат юридических наук'),
(30, 'Доктор юридических наук'),
(31, 'Кандидат экономических наук'),
(32, 'Доктор экономических наук'),
(33, 'Кандидат сельскохозяйственных наук'),
(34, 'Доктор сельскохозяйственных наук'),
(35, 'Кандидат военных наук'),
(36, 'Доктор военных наук'),
(37, 'Кандидат психологических наук'),
(38, 'Доктор психологических наук');

-- --------------------------------------------------------

--
-- Структура таблицы `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id_section` int(10) NOT NULL,
  `name_section` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sections`
--

INSERT INTO `sections` (`id_section`, `name_section`) VALUES
(1, 'Акушерство и гинекология/Obstetrics and Gynecology'),
(2, 'Анатомия человека/Human anatomy'),
(3, 'Анестезиология и реаниматология/Anesthesiology and Reanimatology  '),
(4, 'Биологическая химия/Biological Chemistry'),
(5, 'Биоорганическая химия/Bioorganic Chemistry'),
(6, 'Биотехнологии/Biotechnology'),
(7, 'Болезни уха, горла, носа/Otorhinolaryngology'),
(8, 'Внутренние болезни/Internal Diseases'),
(9, 'Военная эпидемиология и военная гигиена/Military Epidemiology and military hygiene'),
(10, 'Военно-полевая терапия/Military field therapy'),
(11, 'Военно-полевая хирургия/Military surgery'),
(12, 'Гематология/Hematology'),
(13, 'Гигиена детей и подростков/Health of children and teenagers'),
(14, 'Гигиена труда/Occupational health'),
(15, 'Гистология, цитология, эмбриология/Histology, Cytology and Embryology'),
(16, 'Глазные болезни/Ophthalmology'),
(17, 'Дерматовенерология/Dermatology'),
(18, 'Детская хирургия/Pediatric Surgery'),
(19, 'Детские инфекционные болезни/Children’s infectious diseases'),
(20, 'Иностранные языки/Foreign languages'),
(21, 'Инфекционные болезни/Infectious diseases'),
(22, 'История медицины/History of Medicine'),
(23, 'Кардиология/Cardiology'),
(24, 'Клиническая иммунология/Clinical immunology'),
(25, 'Клиническая фармакология/Clinical pharmacology'),
(26, 'Коммунальная стоматология/Communal dentistry'),
(27, 'Латинский язык/Latin'),
(28, 'Лучевая диагностика и лучевая терапия/Radiation diagnostics and radiotherapy'),
(29, 'Медицинская биология и общая генетика/Medical Biology and General Genetics'),
(30, 'Медицинская и биологическая физика/Medical and Biological Physics'),
(31, 'Медицинская реабилитация и физиотерапия/Medical rehabilitation and physiotherapy'),
(32, 'Микробиология, вирусология и иммунология/Microbiology, Virology and Immunology'),
(33, 'Морфология человека/Human Morphology'),
(34, 'Нанобиология/Nanobiology'),
(35, 'Неврология и нейрохирургия/Neurology and Neurosurgery'),
(36, 'Нормальная физиология/Normal Physiology'),
(37, 'Общая гигиена/General hygiene'),
(38, 'Общая стоматология/General Dentistry'),
(39, 'Общая химия и вычислительная биология/General chemistry and computational '),
(40, 'Общая хирургия/General Surgery'),
(41, 'Общественное здоровье и здравоохранение/Public Health and Health Care'),
(42, 'Онкология/Oncology'),
(43, 'Организация медицинского обеспечения войск и экстремальная медицина/Organisation of medical support and  extreme medicine'),
(44, 'Оперативная хирургия и топографическая анатомия/Operative surgery and topographic anatomy'),
(45, 'Организация фармации/Organization of Pharmacy'),
(46, 'Ортодонтия/Orthodontics'),
(47, 'Ортопедическая стоматология/Orthopedic dentistry'),
(48, 'Патологическая анатомия/Pathoanatomy'),
(49, 'Патологическая физиология/Pathological physiology'),
(50, 'Педиатрия/Pediatrics'),
(51, 'Поликлиническая терапия/Outpatient therapy'),
(52, 'Пропедевтика внутренних болезней/Propaedeutics of Internal Diseases'),
(53, 'Пропедевтика детских болезней/Propaedeutics of childhood diseases'),
(54, 'Психиатрия и медицинская психология/Psychiatry and Medical  Psychology'),
(55, 'Радиационная медицина и экология/Radiation Medicine and Ecology'),
(56, 'Сердечно-сосудистая хирургия/Cardiovascular Surgery'),
(57, 'Спортивная медицина/Sports medicine'),
(58, 'Стволовые клетки/Steam Cells'),
(59, 'Стоматология детского возраста/ Pediatric dentistry'),
(60, 'Судебная медицина/Forensic Medicine'),
(61, 'Терапевтическая стоматология/Therapeutic Dentistry'),
(62, 'Травматология и ортопедия/Traumatology and Orthopedics'),
(63, 'Трансплантология/Transplantation'),
(64, 'Урология/Urology'),
(65, 'Фармакология/Pharmacology'),
(66, 'Фармацевтическая ботаника/Pharmaceutical botany'),
(67, 'Фармацевтическая технология и химия/Pharmaceutical Technology and Chemistry'),
(68, 'Филология/Philology'),
(69, 'Философия, политология, социология, биоэтика и история Беларуси/Philosophy, political science, sociology, bioethics and history of Belarus'),
(70, 'Фтизиопульмонология/Phtisiopneumology'),
(71, 'Хирургическая стоматология/Surgical dentistry'),
(72, 'Хирургические болезни/Surgery'),
(73, 'Челюстно-лицевая хирургия/Maxillofacial Surgery'),
(74, 'Эндокринология/Endocrinology'),
(75, 'Эпидемиология/Epidemiology');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id_status` int(10) NOT NULL,
  `name_status` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id_status`, `name_status`) VALUES
(1, 'Студент (Student)'),
(2, 'Интерн (Intern)'),
(3, 'Клинический ординатор (Clinical resident)'),
(4, 'Магистрант (Masster)'),
(5, 'Аспирант (Postgraduate)'),
(6, 'Докторант (Doctoral Student)'),
(7, 'Ассистент (Assistant)'),
(8, 'Младший научный сотрудник (Junior Researcher)'),
(9, 'Научный сотрудник (Researcher)'),
(10, 'Старший научный сотрудник (Senior Researcher)'),
(11, 'Ведущий научный сотрудник (Leading Researcher)'),
(12, 'Главный научный сотрудник (Chief Researcher)'),
(13, 'Доцент (PhD)'),
(14, 'Профессор (Professor)'),
(15, 'Старший преподаватель (Senior Lecturer)'),
(16, 'Преподаватель (Lecturer)');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) NOT NULL,
  `firstnameUser` varchar(55) NOT NULL,
  `secondnameUser` varchar(55) NOT NULL,
  `midlenameUser` varchar(55) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `fullNameInstitute` text NOT NULL,
  `abbreviationInstitute` varchar(50) NOT NULL,
  `id_status` int(10) NOT NULL,
  `id_faculti` int(10) NOT NULL,
  `id_course` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `id_firstBoss` int(11) NOT NULL,
  `id_secondBoss` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `academicRanks`
--
ALTER TABLE `academicRanks`
  ADD PRIMARY KEY (`id_academicRanks`);

--
-- Индексы таблицы `boss`
--
ALTER TABLE `boss`
  ADD PRIMARY KEY (`id_boss`),
  ADD KEY `id_scientificDegree` (`id_scientificDegree`),
  ADD KEY `id_academicRanks` (`id_academicRanks`),
  ADD KEY `id_positionSupervisor` (`id_positionSupervisor`);

--
-- Индексы таблицы `contentsReport`
--
ALTER TABLE `contentsReport`
  ADD PRIMARY KEY (`id_contentsReport`);

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_course`);

--
-- Индексы таблицы `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id_faculti`);

--
-- Индексы таблицы `formParticipation`
--
ALTER TABLE `formParticipation`
  ADD PRIMARY KEY (`id_formParticipation`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id_language`);

--
-- Индексы таблицы `positionSupervisor`
--
ALTER TABLE `positionSupervisor`
  ADD PRIMARY KEY (`id_positionSupervisor`);

--
-- Индексы таблицы `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id_report`),
  ADD UNIQUE KEY `id_contentReport` (`id_contentReport`),
  ADD UNIQUE KEY `id_formParticipation` (`id_formParticipation`),
  ADD UNIQUE KEY `id_sections` (`id_sections`),
  ADD KEY `id_report` (`id_report`),
  ADD KEY `id_language` (`id_language`);

--
-- Индексы таблицы `scientificDegree`
--
ALTER TABLE `scientificDegree`
  ADD PRIMARY KEY (`id_scientificDegree`);

--
-- Индексы таблицы `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id_section`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id_status`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_faculti` (`id_faculti`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_firstBoss` (`id_firstBoss`),
  ADD KEY `id_secondBoss` (`id_secondBoss`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `academicRanks`
--
ALTER TABLE `academicRanks`
  MODIFY `id_academicRanks` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `boss`
--
ALTER TABLE `boss`
  MODIFY `id_boss` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `contentsReport`
--
ALTER TABLE `contentsReport`
  MODIFY `id_contentsReport` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id_course` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id_faculti` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `formParticipation`
--
ALTER TABLE `formParticipation`
  MODIFY `id_formParticipation` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id_language` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `positionSupervisor`
--
ALTER TABLE `positionSupervisor`
  MODIFY `id_positionSupervisor` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `reports`
--
ALTER TABLE `reports`
  MODIFY `id_report` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `scientificDegree`
--
ALTER TABLE `scientificDegree`
  MODIFY `id_scientificDegree` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT для таблицы `sections`
--
ALTER TABLE `sections`
  MODIFY `id_section` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id_status` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
