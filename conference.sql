-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 28 2017 г., 16:56
-- Версия сервера: 5.5.54-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `conference`
--

-- --------------------------------------------------------

--
-- Структура таблицы `academicRanks`
--

CREATE TABLE IF NOT EXISTS `academicRanks` (
  `id_academicRanks` int(10) NOT NULL AUTO_INCREMENT,
  `name_academicRanks` varchar(100) NOT NULL,
  PRIMARY KEY (`id_academicRanks`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

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
  `id_boss` int(10) NOT NULL AUTO_INCREMENT,
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
  `telephone` varchar(50) NOT NULL,
  PRIMARY KEY (`id_boss`),
  KEY `id_scientificDegree` (`id_scientificDegree`),
  KEY `id_academicRanks` (`id_academicRanks`),
  KEY `id_positionSupervisor` (`id_positionSupervisor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `conference`
--

CREATE TABLE IF NOT EXISTS `conference` (
  `id_conference` int(10) NOT NULL AUTO_INCREMENT,
  `id_languages` int(10) NOT NULL,
  `id_report` int(10) NOT NULL,
  `id_user1` int(10) NOT NULL,
  `id_user2` int(10) NOT NULL,
  `id_boss1` int(10) NOT NULL,
  `id_boss2` int(10) NOT NULL,
  PRIMARY KEY (`id_conference`),
  KEY `id_languages` (`id_languages`),
  KEY `id_report` (`id_report`),
  KEY `id_user1` (`id_user1`),
  KEY `id_user2` (`id_user2`),
  KEY `id_boss1` (`id_boss1`),
  KEY `id_boss2` (`id_boss2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `contentsReport`
--

CREATE TABLE IF NOT EXISTS `contentsReport` (
  `id_contentsReport` int(10) NOT NULL AUTO_INCREMENT,
  `name_contentsReport` varchar(55) NOT NULL,
  PRIMARY KEY (`id_contentsReport`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `id_course` int(10) NOT NULL AUTO_INCREMENT,
  `name_course` varchar(50) NOT NULL,
  PRIMARY KEY (`id_course`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

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
  `id_faculti` int(10) NOT NULL AUTO_INCREMENT,
  `name_faculti` varchar(100) NOT NULL,
  PRIMARY KEY (`id_faculti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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
  `id_formParticipation` int(10) NOT NULL AUTO_INCREMENT,
  `name_formParticipation` varchar(100) NOT NULL,
  PRIMARY KEY (`id_formParticipation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
  `id_language` int(5) NOT NULL AUTO_INCREMENT,
  `name_language` varchar(20) NOT NULL,
  PRIMARY KEY (`id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `id_positionSupervisor` int(10) NOT NULL AUTO_INCREMENT,
  `name_positionSupervisor` varchar(100) NOT NULL,
  PRIMARY KEY (`id_positionSupervisor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

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
  `id_report` int(10) NOT NULL AUTO_INCREMENT,
  `title_report` text NOT NULL,
  `introduction` text NOT NULL,
  `aim` text NOT NULL,
  `materialsAndMethods` text NOT NULL,
  `results` text NOT NULL,
  `conclusions` text NOT NULL,
  `id_contentReport` int(10) NOT NULL,
  `id_formParticipation` int(10) NOT NULL,
  `id_sections` int(10) NOT NULL,
  PRIMARY KEY (`id_report`),
  KEY `id_contentReport` (`id_contentReport`),
  KEY `id_formParticipation` (`id_formParticipation`),
  KEY `id_sections` (`id_sections`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `scientificDegree`
--

CREATE TABLE IF NOT EXISTS `scientificDegree` (
  `id_scientificDegree` int(10) NOT NULL AUTO_INCREMENT,
  `name_scientificDegree` varchar(100) NOT NULL,
  PRIMARY KEY (`id_scientificDegree`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

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
  `id_section` int(10) NOT NULL AUTO_INCREMENT,
  `name_section` varchar(150) NOT NULL,
  PRIMARY KEY (`id_section`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Дамп данных таблицы `sections`
--

INSERT INTO `sections` (`id_section`, `name_section`) VALUES
(1, 'Акушерство и гинекология(Obstetrics and Gynecology)'),
(2, 'Анатомия человека(Human anatomy)'),
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
-- Структура таблицы `sectionsName`
--

CREATE TABLE IF NOT EXISTS `sectionsName` (
  `id_sectionName` int(10) NOT NULL AUTO_INCREMENT,
  `name_sectionName` varchar(100) NOT NULL,
  PRIMARY KEY (`id_sectionName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Дамп данных таблицы `sectionsName`
--

INSERT INTO `sectionsName` (`id_sectionName`, `name_sectionName`) VALUES
(1, 'Obstetrics and Gynecology'),
(2, 'Human anatomy'),
(3, 'Anesthesiology and Reanimatology  '),
(4, 'Biological Chemistry'),
(5, 'Bioorganic Chemistry'),
(6, 'Biotechnology'),
(7, 'Otorhinolaryngology'),
(8, 'Internal Diseases'),
(9, 'Military Epidemiology and military hygiene'),
(10, 'Military field therapy'),
(11, 'Military surgery'),
(12, 'Hematology'),
(13, 'Health of children and teenagers'),
(14, 'Occupational health'),
(15, 'Histology, Cytology and Embryology'),
(16, 'Ophthalmology'),
(17, 'Dermatology'),
(18, 'Pediatric Surgery'),
(19, 'Childrens infectious diseases'),
(20, 'Foreign languages'),
(21, 'Infectious diseases'),
(22, 'History of Medicine'),
(23, 'Cardiology'),
(24, 'Clinical immunology'),
(25, 'Clinical pharmacology'),
(26, 'Communal dentistry'),
(27, 'Latin'),
(28, 'Radiation diagnostics and radiotherapy'),
(29, 'Medical Biology and General Genetics'),
(30, 'Medical and Biological Physics'),
(31, 'Medical rehabilitation and physiotherapy'),
(32, 'Microbiology, Virology and Immunology'),
(33, 'Human Morphology'),
(34, 'Nanobiology'),
(35, 'Neurology and Neurosurgery'),
(36, 'Normal Physiology'),
(37, 'General hygiene'),
(38, 'General Dentistry'),
(39, 'General chemistry and computational biology'),
(40, 'General Surgery'),
(41, 'Public Health and Health Care'),
(42, 'Oncology'),
(43, 'Organisation of medical support and  extreme medicine'),
(44, 'Operative surgery and topographic anatomy'),
(45, 'Organization of Pharmacy'),
(46, 'Orthodontics'),
(47, 'Orthopedic dentistry'),
(48, 'Pathoanatomy'),
(49, 'Pathological physiology'),
(50, 'Pediatrics'),
(51, 'Outpatient therapy'),
(52, 'Propaedeutics of Internal Diseases'),
(53, 'Propaedeutics of childhood diseases'),
(54, 'Psychiatry and Medical  Psychology'),
(55, 'Radiation Medicine and Ecology'),
(56, 'Cardiovascular Surgery'),
(57, 'Sports medicine'),
(58, 'Steam Cells'),
(59, 'Pediatric dentistry'),
(60, 'Forensic Medicine'),
(61, 'Therapeutic Dentistry'),
(62, 'Traumatology and Orthopedics'),
(63, 'Transplantation'),
(64, 'Urology'),
(65, 'Pharmacology'),
(66, 'Pharmaceutical botany'),
(67, 'Pharmaceutical Technology and Chemistry'),
(68, 'Philology'),
(69, 'Philosophy, political science, sociology, bioethics and history of Belarus'),
(70, 'Phtisiopneumology'),
(71, 'Surgical dentistry'),
(72, 'Surgery'),
(73, 'Maxillofacial Surgery'),
(74, 'Endocrinology'),
(75, 'Epidemiology');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id_status` int(10) NOT NULL AUTO_INCREMENT,
  `name_status` varchar(55) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

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
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `firstnameUser` varchar(55) NOT NULL,
  `secondnameUser` varchar(55) NOT NULL,
  `midlenameUser` varchar(55) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `fullNameInstitute` text NOT NULL,
  `abbreviationInstitute` varchar(50) NOT NULL,
  `id_status` int(10) NOT NULL,
  `nameFaculti` text NOT NULL,
  `id_course` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_status` (`id_status`),
  KEY `id_course` (`id_course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `boss`
--
ALTER TABLE `boss`
  ADD CONSTRAINT `boss_ibfk_1` FOREIGN KEY (`id_academicRanks`) REFERENCES `academicRanks` (`id_academicRanks`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
