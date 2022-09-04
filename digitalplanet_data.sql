-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2022 at 09:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digitalplanet_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `username` varchar(80) DEFAULT NULL,
  `ip` varbinary(16) DEFAULT NULL,
  `failed` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `failed_last` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `type` varchar(20) DEFAULT NULL,
  `message` varchar(150) DEFAULT NULL,
  `importance` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1 yes, 0 =no',
  `created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `user_id`, `username`, `ip`, `failed`, `failed_last`, `type`, `message`, `importance`, `created`) VALUES
(1, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>מוצר לבדיקה</b> added successfully.', 0, '2022-08-26 06:34:42'),
(2, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>מוצר לבדיקה</b> Updated Successfully.', 0, '2022-08-26 06:35:12'),
(3, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>Welcome to our site</b> updated successfully.', 0, '2022-08-26 07:27:30'),
(4, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>מוצר לבדיקה</b> Updated Successfully.', 0, '2022-08-26 07:30:48'),
(5, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>מוצר לבדיקה</b> Updated Successfully.', 0, '2022-08-26 07:33:30'),
(6, 1, 'Web Master', 0x3130332e3139372e3135342e313735, 0, 0, 'content', 'הדף <b>ברוכים הבאים לאתר שלנו</b> עודכן בהצלחה.', 0, '2022-08-29 10:17:12'),
(7, 1, 'Web Master', 0x3130332e3139372e3135342e313735, 0, 0, 'content', 'Page <b>Welcome to our site</b> updated successfully.', 0, '2022-08-29 10:17:46'),
(8, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>NameCheap - חברת האחסון והדומיינים מהמומלצות בעולם</b> added successfully.', 0, '2022-08-29 12:58:22'),
(9, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>NameCheap - חברת האחסון והדומיינים מהמומלצות בעולם</b> Updated Successfully.', 0, '2022-08-29 12:59:14'),
(10, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>NameCheap - חברת האחסון והדומיינים מהמומלצות בעולם</b> Updated Successfully.', 0, '2022-08-29 13:01:36'),
(11, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Hostiso - שרתי אחסון אתרים בדגש על מהירות</b> added successfully.', 0, '2022-08-29 13:08:48'),
(12, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Sitechecker.pro - כלי מצויין ופשוט לשימוש לבדיקת קידום האתר שלכם</b> added successfully.', 0, '2022-08-29 13:15:04'),
(13, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Custom Field <b>קופון</b> Added Successfully.', 0, '2022-08-29 13:15:54'),
(14, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Sitechecker.pro - כלי מצויין ופשוט לשימוש לבדיקת קידום האתר שלכם</b> Updated Successfully.', 0, '2022-08-29 13:18:02'),
(15, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Sitechecker.pro - כלי מצויין ופשוט לשימוש לבדיקת קידום האתר שלכם</b> Updated Successfully.', 0, '2022-08-29 13:22:09'),
(16, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Sitechecker.pro - כלי מצויין ופשוט לשימוש לבדיקת קידום האתר שלכם</b> Updated Successfully.', 0, '2022-08-29 13:24:12'),
(17, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Squirrly SEO - תוסף בינה מלאכותית לקידום אתרי וורדפרס [קופון 30% בפנים]</b> added successfully.', 0, '2022-08-29 14:04:50'),
(18, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>WP Rocket - תוסף המטמון הנמכר בעולם לאתרי וורדפרס</b> added successfully.', 0, '2022-08-29 19:34:57'),
(19, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'המוצר <b>WP Rocket - תוסף המטמון הנמכר בעולם לאתרי וורדפרס</b> עודכן בהצלחה.', 0, '2022-08-29 19:57:43'),
(20, 1, 'Web Master', 0x3131382e3137392e3137352e313933, 0, 0, 'content', 'Page <b>Welcome to our site</b> updated successfully.', 0, '2022-08-30 11:19:07'),
(21, 1, 'Web Master', 0x3131382e3137392e3137352e313933, 0, 0, 'content', 'Page <b>ברוכים הבאים לאתר שלנו</b> updated successfully.', 0, '2022-08-30 11:22:23'),
(22, 1, 'Web Master', 0x3131382e3137392e3137352e313933, 0, 0, 'content', 'Page <b>גישת VIP</b> updated successfully.', 0, '2022-08-30 11:23:44'),
(23, 1, 'Web Master', 0x3131382e3137392e3137352e313933, 0, 0, 'content', 'Page <b>עלינו</b> updated successfully.', 0, '2022-08-30 11:27:46'),
(24, 1, 'Web Master', 0x3131382e3137392e3137352e313933, 0, 0, 'content', 'Page <b>שאלות נפוצות</b> updated successfully.', 0, '2022-08-30 11:29:08'),
(25, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>ברוכים הבאים לאתר שלנו</b> updated successfully.', 0, '2022-08-30 13:04:46'),
(26, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>ברוכים הבאים לאתר שלנו</b> updated successfully.', 0, '2022-08-30 13:05:35'),
(27, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'הדף <b>ברוכים הבאים לדיגיטל פלאנט </b> עודכן בהצלחה.', 0, '2022-08-30 18:57:33'),
(28, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'הדף <b>ברוכים הבאים לדיגיטל פלאנט </b> עודכן בהצלחה.', 0, '2022-08-30 19:05:58'),
(29, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'המוצר <b>WP Rocket - תוסף המטמון הנמכר בעולם לאתרי וורדפרס</b> עודכן בהצלחה.', 0, '2022-08-30 19:10:51'),
(30, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'המוצר <b>WP Rocket - תוסף המטמון הנמכר בעולם לאתרי וורדפרס</b> עודכן בהצלחה.', 0, '2022-08-30 19:13:46'),
(31, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'המוצר <b>WP Rocket - תוסף המטמון הנמכר בעולם לאתרי וורדפרס</b> עודכן בהצלחה.', 0, '2022-08-30 19:17:49'),
(32, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'המוצר <b>Squirrly SEO - תוסף בינה מלאכותית לקידום אתרי וורדפרס [קופון 30% בפנים]</b> עודכן בהצלחה.', 0, '2022-08-30 19:20:30'),
(33, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'המוצר <b>אחסון אתרי וורדפרס מנוהל בביצועים גבוהים של WP Engine</b> נוסף בהצלחה.', 0, '2022-08-30 19:33:54'),
(34, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>אלמנטור - בונה האתרים מספר 1 עבור וורדפרס</b> added successfully.', 0, '2022-08-31 11:37:27'),
(35, 1, 'Web Master', 0x3130332e3130362e3234332e313738, 0, 0, 'content', 'Product <b>Anyword - כלי קופירייטינג AI עם תוצאות צפויות [קופון בלעדי של 20% מצורף]</b> added successfully.', 0, '2022-08-31 18:45:05'),
(36, 1, 'Web Master', 0x3130332e3130362e3234332e313738, 0, 0, 'content', 'Product <b>Anyword - כלי קופירייטינג AI עם תוצאות צפויות [קופון בלעדי של 20% מצורף]</b> Updated Successfully.', 0, '2022-08-31 18:47:00'),
(37, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>עלינו</b> updated successfully.', 0, '2022-09-01 03:52:46'),
(38, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>About Us</b> Updated successfully.', 0, '2022-09-01 03:53:16'),
(39, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>About Us</b> Updated successfully.', 0, '2022-09-01 03:53:18'),
(40, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>About Us</b> Updated successfully.', 0, '2022-09-01 03:53:20'),
(41, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>About Us</b> Updated successfully.', 0, '2022-09-01 03:53:52'),
(42, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>עלינו</b> updated successfully.', 0, '2022-09-01 03:54:02'),
(43, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>עלינו</b> updated successfully.', 0, '2022-09-01 03:54:24'),
(44, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>אודותינו</b> added successfully.', 0, '2022-09-01 03:55:06'),
(45, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>אודותינו</b> Updated successfully.', 0, '2022-09-01 03:56:25'),
(46, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>ברוכים הבאים לדיגיטל פלאנט </b> updated successfully.', 0, '2022-09-01 04:00:26'),
(47, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>ברוכים הבאים לדיגיטל פלאנט </b> updated successfully.', 0, '2022-09-01 04:01:49'),
(48, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>הכירו את DigitalPlanet.co.il</b> updated successfully.', 0, '2022-09-01 04:05:26'),
(49, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>הכירו את DigitalPlanet.co.il</b> updated successfully.', 0, '2022-09-01 04:06:32'),
(50, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>הכירו את DigitalPlanet.co.il</b> updated successfully.', 0, '2022-09-01 04:08:23'),
(51, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>הכירו את DigitalPlanet.co.il</b> updated successfully.', 0, '2022-09-01 04:11:28'),
(52, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>עמוד הבית</b> Updated successfully.', 0, '2022-09-01 04:13:30'),
(53, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>שאלות ותשובות</b> Updated successfully.', 0, '2022-09-01 04:13:36'),
(54, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>בלוג</b> Updated successfully.', 0, '2022-09-01 04:13:46'),
(55, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>צרו איתנו קשר</b> Updated successfully.', 0, '2022-09-01 04:13:51'),
(56, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>תקנון ותנאי שימוש</b> Updated successfully.', 0, '2022-09-01 04:13:57'),
(57, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>VIP מועדון</b> Updated successfully.', 0, '2022-09-01 04:14:07'),
(58, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>חדשות אתר</b> Updated successfully.', 0, '2022-09-01 04:14:11'),
(59, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Menu <b>מה חדש?</b> Updated successfully.', 0, '2022-09-01 04:14:16'),
(60, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>תקנון ותנאי שימוש</b> updated successfully.', 0, '2022-09-01 04:19:27'),
(61, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Anyword - כלי קופירייטינג AI עם תוצאות צפויות [קופון בלעדי של 20% מצורף]</b> Updated Successfully.', 0, '2022-09-01 04:20:22'),
(62, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>ArticleFroge - The ultimate AI Content Writer with a single click</b> נוסף בהצלחה.', 0, '2022-09-01 09:19:32'),
(63, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>Contentbot - The world&#39;s most advanced AI Writer to create amazing articles</b> נוסף בהצלחה.', 0, '2022-09-01 10:05:49'),
(64, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>Contentbot - כותב הבינה המלאכותית המתקדם בעולם ליצירת מאמרים ארוכים</b> עודכן בהצלחה.', 0, '2022-09-01 10:06:26'),
(65, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>ArticleFroge - כותב תוכן AI האולטימטיבי בלחיצה אחת</b> עודכן בהצלחה.', 0, '2022-09-01 10:06:42'),
(66, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>Headlime - בוט קופירייטינג הכי פרודוקטיבי וחזק</b> נוסף בהצלחה.', 0, '2022-09-01 11:50:03'),
(67, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>Headlime - בוט קופירייטינג הכי פרודוקטיבי וחזק</b> עודכן בהצלחה.', 0, '2022-09-01 11:59:07'),
(68, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'המוצר <b>Headlime - בוט קופירייטינג הכי פרודוקטיבי וחזק</b> עודכן בהצלחה.', 0, '2022-09-01 12:00:14'),
(69, 1, 'Web Master', 0x3131392e33302e33392e3435, 0, 0, 'content', 'המוצר <b>Jasper - כלי כתיבת תוכן יצירתי מבוסס בינה מלאכותית לבלוגים, מדיה חברתית, אתרים ועוד</b> נוסף בהצלחה.', 0, '2022-09-01 13:28:17'),
(70, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>שאלות ותשובות</b> updated successfully.', 0, '2022-09-01 14:19:32'),
(71, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>צרו איתנו קשר</b> updated successfully.', 0, '2022-09-01 14:21:04'),
(72, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Page <b>גישת VIP</b> updated successfully.', 0, '2022-09-01 14:21:49'),
(73, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'הדף <b>הכירו את DigitalPlanet.co.il</b> עודכן בהצלחה.', 0, '2022-09-01 14:27:47'),
(74, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'הדף <b>הכירו את DigitalPlanet.co.il</b> עודכן בהצלחה.', 0, '2022-09-01 14:31:28'),
(75, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'הדף <b>הכירו את DigitalPlanet.co.il</b> עודכן בהצלחה.', 0, '2022-09-01 14:36:18'),
(76, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'הדף <b>הכירו את DigitalPlanet.co.il</b> עודכן בהצלחה.', 0, '2022-09-01 14:36:43'),
(77, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>Fathom - ניתוח אתרים ממוקד פרטיות ללא פשרות לגוגל אנליטיקס אלטרנטיבי</b> נוסף בהצלחה.', 0, '2022-09-01 15:42:32'),
(78, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>SeRanking הטוב ביותר בכלי ניתוח SEO ושיווק הכל באחד שאתה צריך על הסיפון</b> נוסף בהצלחה.', 0, '2022-09-01 18:04:54'),
(79, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>Serpstat - כלי הפריצה לצמיחה לקידום אתרים, PPC, שיווק תוכן וניתוח מילות מפתח</b> נוסף בהצלחה.', 0, '2022-09-01 18:57:00'),
(80, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Serpstat - כלי פורץ הדרך לקידום אתרים, PPC, שיווק תוכן וניתוח מילות מפתח</b> Updated Successfully.', 0, '2022-09-01 19:35:42'),
(81, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Serpstat - כלי פורץ הדרך לקידום אתרים, PPC, שיווק תוכן וניתוח מילות מפתח</b> Updated Successfully.', 0, '2022-09-01 19:37:35'),
(82, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>SeRanking הטוב ביותר בכלי ניתוח SEO ושיווק הכל באחד שאתה צריך על הסיפון</b> Updated Successfully.', 0, '2022-09-01 19:48:24'),
(83, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Fathom - ניתוח אתרים ממוקד פרטיות ללא פשרות (אלטרנטיבה לאנליטיקס)</b> Updated Successfully.', 0, '2022-09-01 19:49:07'),
(84, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Jasper - כלי כתיבת תוכן יצירתי מבוסס בינה מלאכותית לבלוגים, מדיה חברתית, אתרים ועוד</b> Updated Successfully.', 0, '2022-09-01 19:49:28'),
(85, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>SimilarWeb - כלי ניתוח האתרים התחרותי הטוב ביותר לניטור וניתוח המתחרים שלך</b> נוסף בהצלחה.', 0, '2022-09-01 19:50:03'),
(86, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Headlime - בוט קופירייטינג הכי פרודוקטיבי ועוצמתי (מומלץ מאוד)</b> Updated Successfully.', 0, '2022-09-01 19:50:11'),
(87, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Headlime - בוט קופירייטינג הכי פרודוקטיבי ועוצמתי (מומלץ מאוד)</b> Updated Successfully.', 0, '2022-09-01 19:50:24'),
(88, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>Serpstat - כלי פורץ הדרך לקידום אתרים, PPC, שיווק תוכן וניתוח מילות מפתח</b> עודכן בהצלחה.', 0, '2022-09-01 19:50:30'),
(89, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>SimilarWeb - כלי ניתוח האתרים התחרותי הטוב ביותר לניטור וניתוח המתחרים שלך</b> Updated Successfully.', 0, '2022-09-01 19:50:36'),
(90, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>SeRanking הטוב ביותר בכלי ניתוח SEO ושיווק הכל באחד שאתה צריך על הסיפון</b> עודכן בהצלחה.', 0, '2022-09-01 19:50:41'),
(91, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Serpstat - כלי פורץ הדרך לקידום אתרים, PPC, שיווק תוכן וניתוח מילות מפתח</b> Updated Successfully.', 0, '2022-09-01 19:50:43'),
(92, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>Fathom - ניתוח אתרים ממוקד פרטיות ללא פשרות (אלטרנטיבה לאנליטיקס)</b> עודכן בהצלחה.', 0, '2022-09-01 19:50:48'),
(93, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>SeRanking הטוב ביותר בכלי ניתוח SEO ושיווק הכל באחד שאתה צריך על הסיפון</b> Updated Successfully.', 0, '2022-09-01 19:50:52'),
(94, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Fathom - ניתוח אתרים ממוקד פרטיות ללא פשרות (אלטרנטיבה לאנליטיקס)</b> Updated Successfully.', 0, '2022-09-01 19:51:06'),
(95, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>Jasper - כלי כתיבת תוכן יצירתי מבוסס בינה מלאכותית לבלוגים, מדיה חברתית, אתרים ועוד</b> Updated Successfully.', 0, '2022-09-01 19:51:19'),
(96, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>Serpstat - כלי פורץ הדרך לקידום אתרים, PPC, שיווק תוכן וניתוח מילות מפתח</b> עודכן בהצלחה.', 0, '2022-09-01 19:51:50'),
(97, 1, 'Web Master', 0x38342e3232382e3130322e313130, 0, 0, 'content', 'Product <b>ArticleFroge - כותב תוכן AI האולטימטיבי בלחיצה אחת</b> Updated Successfully.', 0, '2022-09-01 19:52:11'),
(98, 1, 'Web Master', 0x3130332e3130362e3234332e313739, 0, 0, 'content', 'המוצר <b>SeRanking הטוב ביותר בכלי ניתוח SEO ושיווק הכל באחד שאתה צריך על הסיפון</b> עודכן בהצלחה.', 0, '2022-09-01 19:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hits` int(6) UNSIGNED DEFAULT 0,
  `show_sharing` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `show_created` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `keywords` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `category_id`, `user_id`, `title`, `slug`, `body`, `thumb`, `hits`, `show_sharing`, `show_created`, `keywords`, `description`, `created`, `active`) VALUES
(1, 1, 1, '10 חברות האחסון המומלצות ביותר לאתרי וורדפרס בשנת 2022', '10bestwordpresshosting', '<h1>10 חברות האחסון המומלצות ביותר לאתרי וורדפרס בשנת 2022</h1>\r\n<p>כשזה מגיע לבחירת חברת אחסון לאתר וורדפרס שלך, יש הרבה גורמים שיש לקחת בחשבון. במאמר זה, נדון ב-10 חברות האחסון המומלצות ביותר עבור אתרי וורדפרס בשנת 2022. על ידי קריאת רשימה זו, אתה אמור להיות מסוגל למצוא ספק אירוח מכובד העונה על הצרכים שלך.</p>\r\n<h2>10 חברות האחסון המומלצות ביותר לאתרי וורדפרס בשנת 2022</h2>\r\n<p>אם אתה מחפש פתרון אירוח אמין, זול וניתן להרחבה לאתר וורדפרס שלך, אז אתה בהחלט צריך לשקול להשתמש באחת מ-10 חברות האחסון המומלצות ביותר לוורדפרס בשנת 2022.</p>\r\n<p>חברות אלו מציעות שירותי אירוח וורדפרס ברמה עולמית, וכולן מסוגלות לטפל אפילו באתרי וורדפרס התובעניים ביותר.</p>\r\n<p>אם אתה מחפש לעבור לחברת אחסון חדשה, אז אתה בהחלט צריך לבדוק את 10 חברות האחסון המומלצות ביותר עבור וורדפרס בשנת 2022. אתה לא תצטער על זה!</p>\r\n<h2><strong>מנוע WP</strong></h2>\r\n<p>WP Engine היא חברת האחסון המומלצת ביותר עבור אתרי וורדפרס.</p>\r\n<p>WP Engine היא חברת האחסון המומלצת ביותר עבור אתרי וורדפרס. יש להם מגוון רחב של תוכניות ואפשרויות שיתאימו לכל צורך. הם מציעים גם מגוון רחב של תכונות, כגון: אחסון בלתי מוגבל, רוחב פס בלתי מוגבל ועוד. ל-WP Engine יש גם צוות תמיכה נרחב שזמין 24/7. הם גם אמינים מאוד ויש להם רקורד נהדר. אם אתם מחפשים חברת אחסון שתטפל באתר שלכם, אז WP Engine היא האופציה המושלמת.</p>\r\n<h2><strong>עננים</strong></h2>\r\n<p>Cloudways היא חברת האחסון המומלצת ביותר עבור אתרי וורדפרס.</p>\r\n<p>Cloudways היא חברת האחסון המומלצת ביותר עבור אתרי וורדפרס. הסיבה לכך היא שהם מספקים שירות לקוחות מעולה, תמיכה 24/7 ושרתים אמינים. הם מציעים גם מגוון רחב של תכונות, כולל רישום שמות דומיין בחינם ושרתים פרטיים.</p>\r\n<p>לא רק שהשרתים של Cloudways אמינים, אלא שגם שירות הלקוחות שלהם יוצא דופן. הצוות שלהם זמין 24/7 כדי לעזור לך בכל בעיה שתהיה לך באתר שלך. בנוסף, הם מציעים הבטחת שביעות רצון להחזר כספי אם אתה לא מרוצה מהשירותים שלהם.</p>\r\n<p>אם אתה מחפש מארח אמין לאתר וורדפרס שלך, Cloudways צריכה להיות הבחירה הראשונה שלך.</p>\r\n<h2><strong>דחוף</strong></h2>\r\n<p>Upress היא אחת מחברות האחסון המומלצות ביותר לאתרי וורדפרס.</p>\r\n<p>Upress היא חברת אחסון המציעה פתרונות אירוח משותפים ומותאמים אישית עבור אתרי וורדפרס. יש להם מגוון רחב של תוכניות ואפשרויות לבחירה, מה שמקל על מציאת פתרון האירוח המתאים לאתר שלך.</p>\r\n<p>אחת הסיבות לכך ש-Upress היא חברת אחסון כל כך פופולרית עבור אתרי וורדפרס היא שירות הלקוחות שלהם. הצוות שלהם זמין 24/7 כדי לעזור לך בכל בעיה או שאלה שיש לך. הם גם מציעים מגוון תוספות ושירותים כדי להקל על חייך כבעלים של אתר וורדפרס.</p>\r\n<p>בסך הכל, Upress היא אחת מחברות האחסון המומלצות ביותר לאתרי וורדפרס. שירות הלקוחות שלהם הוא מהשורה הראשונה, ויש להם מגוון רחב של תוכניות ואפשרויות לבחירה. אם אתם מחפשים פתרון אירוח אמין לאתר וורדפרס שלכם, אל תחפשו רחוק יותר מ-Upress!</p>\r\n<h2><strong>HostGator</strong></h2>\r\n<p>HostGator היא אחת מחברות האחסון המומלצות ביותר לאתרי וורדפרס. הם מציעים מגוון רחב של תוכניות אירוח, מרמות מתחילים ועד מומחים. שירות הלקוחות שלהם הוא מהשורה הראשונה, ויש להם צוות של מומחים מסור שיכול לעזור לך בכל בעיה שתהיה לך.</p>\r\n<p>אחת התכונות הייחודיות של HostGator היא אופטימיזציה של מנוע אירוח (HEO). שירות זה עוזר לייעל את האתר שלך לביצועים טובים יותר. הוא כולל גם שורה של תכונות אחרות, כגון CDN גלובלי וסריקת אבטחה.</p>\r\n<p>אם אתה מחפש חברת אחסון בעלת מוניטין שיכולה לעזור לך להצמיח את אתר הוורדפרס שלך, HostGator היא האפשרות המושלמת.</p>\r\n<h2><strong>Bluehost</strong></h2>\r\n<p>Bluehost היא חברת האחסון המומלצת ביותר עבור אתרי וורדפרס.</p>\r\n<p>אחת מחברות האחסון הפופולריות ביותר עבור אתרי וורדפרס היא Bluehost. יש להם פלטפורמה מאוד ידידותית למשתמש ומגוון רחב של תכונות שהופכות אותם למושלמים עבור בלוגרים ועסקים קטנים.</p>\r\n<p>Bluehost מציעה הבטחת שביעות רצון של 100%, מה שאומר שאתה תמיד יכול לסמוך עליהם שיספקו שירות איכותי. הם גם מציעים מגוון תוספות וכלים שיעזרו לך לבצע אופטימיזציה של האתר שלך לדירוג מנוע חיפוש (SERP). בנוסף, ל- Bluehost צוות מומחים זמין 24/7 כדי לעזור לך להקים ולנהל את האתר שלך.</p>\r\n<p>בסך הכל, Bluehost היא חברת האחסון המומלצת ביותר עבור אתרי וורדפרס. הפלטפורמה הידידותית למשתמש שלהם ומגוון רחב של תכונות הופכים אותם למושלמים עבור בלוגרים ועסקים קטנים.</p>\r\n<h2><strong>SiteGround</strong></h2>\r\n<p>SiteGround היא חברות האחסון המומלצות ביותר עבור אתרי וורדפרס.</p>\r\n<p>SiteGround היא אחת מחברות האחסון המומלצות ביותר לאתרי וורדפרס. יש להם צוות שירות לקוחות מעולה ומציעים מגוון רחב של תוכניות אירוח המושלמות לעסקים בכל הגדלים. השרתים שלהם מופעלים על ידי לינוקס, מה שאומר שהם אמינים מאוד ויכולים להתמודד עם עומסי אתרים גדולים בקלות. בנוסף, האתר שלהם קל לשימוש ויש לו המון משאבים מועילים. אם אתה מחפש מארח מצוין לאתר הוורדפרס שלך, SiteGround היא בהחלט החברה שתבחר.</p>\r\n<h2><strong>DreamHost</strong></h2>\r\n<p>DreamHost היא אחת מחברות האחסון הפופולריות ביותר עבור אתרי וורדפרס. הם מציעים מגוון רחב של תוכניות אירוח, כולל תוכנית חינמית שמתאימה להתחלה. יש להם גם מגוון תוספות ושירותים שמקלים על ניהול האתר שלך.</p>\r\n<p>אחת התכונות הטובות ביותר של DreamHost היא צוות התמיכה שלהם. הם זמינים 24/7 כדי לעזור לך בכל שאלה או בעיה שיש לך. יש להם גם מערכת תמיכה ידידותית מאוד שמקלה למצוא את המידע שאתה צריך.</p>\r\n<p>בסך הכל, DreamHost היא אחת מחברות האחסון המומלצות ביותר עבור אתרי וורדפרס. התוכניות הזולות שלהם, שירות הלקוחות הנהדר והמגוון הרחב של אפשרויות אירוח הופכות אותם לבחירה מצוינת עבור כל מי שמחפש חברת אחסון לאתר וורדפרס שלו.</p>\r\n<h2><strong>קדימה אבא</strong></h2>\r\n<p>אם אתה מחפש חברת אירוח שמציעה תמורה נהדרת לכספך, אז GoDaddy היא האפשרות המושלמת. הם מציעים תוכניות אירוח אישיות ועסקיות כאחד, ושירות הלקוחות שלהם הוא מהשורה הראשונה. יש להם גם מגוון רחב של כלים ומשאבים זמינים כדי לעזור לך לנהל את האתר שלך.</p>\r\n<h2><strong>HostMonster</strong></h2>\r\n<p>כשזה מגיע לאירוח אתרי וורדפרס, יש הרבה אפשרויות נהדרות בחוץ. עם זאת, אחת מחברות האחסון המומלצות ביותר לאתרי וורדפרס היא HostMonster.</p>\r\n<p>HostMonster היא חברת אחסון ידועה המספקת שירותי אחסון אתרים כבר למעלה מ-15 שנה. יש להם היסטוריה נהדרת של מתן שירותים באיכות גבוהה והם ידועים בשירות הלקוחות שלהם. תוכניות האירוח שלהם גם זולות מאוד, מה שהופך אותן לאופציה מצוינת לעסקים קטנים ובלוגרים.</p>\r\n<p>אם אתה מחפש מארח אמין שיכול לספק שירותי אירוח וורדפרס איכותיים, HostMonster היא הבחירה המושלמת.</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>כשזה מגיע לבחירת חברת אחסון לאתר וורדפרס שלך, זה יכול להיות ממש קשה להחליט איזו מהן היא הטובה ביותר עבורך. עם זאת, על ידי התייעצות ברשימת 10 חברות האחסון המומלצות ביותר לוורדפרס בשנת 2022, לא אמורה להיות לך בעיה למצוא ספק מכובד ואמין שיכול לעזור לך להעצים את האתר שלך. אז למה אתה מחכה? התחל עוד היום וראה כמה קל יותר עיצוב ופיתוח אתרים יכולים להיות!</p>', 'yYooqQTxdSQa.jpg', 3, 1, 1, '10 חברות האחסון המומלצות ביותר לאתרי וורדפרס בשנת 2022', 'כשזה מגיע לבחירת חברת אחסון לאתר וורדפרס שלך, יש הרבה גורמים שיש לקחת בחשבון. במאמר זה, נדון ב-10 חברות האחסון המומלצות ביותר עבור אתרי וורדפרס בשנת 2022. על ידי קריאת רשימה זו, אתה אמור להיות מסוגל למצוא ספק אירוח מכובד העונה על הצרכים שלך.', '2022-08-26 08:23:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(6) UNSIGNED NOT NULL,
  `parent_id` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `perpage` tinyint(3) UNSIGNED NOT NULL DEFAULT 10,
  `keywords` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sorting` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `parent_id`, `name`, `slug`, `icon`, `perpage`, `keywords`, `description`, `sorting`, `active`) VALUES
(1, 0, 'בלוג', 'blog', NULL, 20, '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` varchar(48) NOT NULL DEFAULT '0',
  `user_m_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `product_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `membership_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `tax` decimal(13,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `totaltax` decimal(13,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `coupon` decimal(13,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `total` decimal(13,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `originalprice` decimal(13,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `totalprice` decimal(13,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `cart_id` varchar(100) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `slug` varchar(100) NOT NULL,
  `body` varchar(100) DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `sorting` tinyint(11) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `slug`, `body`, `keywords`, `description`, `sorting`, `active`) VALUES
(10, 'כלים לכותבי תוכן', 0, 'copywriting', '', '', '', 5, 1),
(2, 'תוכנות לגרפיקה ואנימציה', 0, 'graphics', '', '', '', 2, 1),
(3, 'תוספים וכלים לבוני אתרים', 0, 'webtools', '', '', '', 3, 1),
(4, 'אחסון ודומיינים', 0, 'hostingdomain', '', '', '', 4, 1),
(8, 'כלים למשווקי דיגיטל', 0, 'digitaltools', '', 'כלים למשווקי דיגיטל ', '', 1, 1),
(9, 'איזור VIP', 0, 'vip-access', '', '', '', 7, 1),
(11, 'SEO', 0, 'seo', '', '', '', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories_related`
--

CREATE TABLE `categories_related` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories_related`
--

INSERT INTO `categories_related` (`id`, `product_id`, `category_id`) VALUES
(88, 3, 4),
(46, 3, 5),
(45, 3, 1),
(100, 7, 4),
(99, 5, 11),
(98, 6, 3),
(51, 7, 1),
(52, 7, 3),
(80, 8, 5),
(79, 8, 1),
(123, 12, 10),
(131, 13, 10),
(130, 14, 11),
(139, 15, 11),
(125, 17, 11),
(84, 1, 8),
(87, 2, 4),
(92, 4, 11),
(101, 8, 3),
(104, 9, 10),
(133, 10, 10),
(107, 11, 10),
(132, 16, 11),
(137, 18, 2),
(138, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cdkeys`
--

CREATE TABLE `cdkeys` (
  `product_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `cdkey` varchar(60) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `product_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `username` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `www` varchar(220) DEFAULT NULL,
  `vote_up` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `vote_down` int(11) NOT NULL DEFAULT 0,
  `rating` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `ip` varchar(16) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `parent_id`, `product_id`, `username`, `user_id`, `email`, `body`, `www`, `vote_up`, `vote_down`, `rating`, `ip`, `created`, `active`) VALUES
(1, 0, 16, 'משה מלול', 0, NULL, 'אחלה של כלי אני עובד איתו כבר מעל שנה מרוצה מאוד נותן לי את הנתונים שאני צריך!', '84.228.102.110', 0, 0, 5, NULL, '2022-09-02 09:33:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `abbr` varchar(2) NOT NULL,
  `name` varchar(70) NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `home` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `vat` decimal(13,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `sorting` smallint(6) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `abbr`, `name`, `active`, `home`, `vat`, `sorting`) VALUES
(1, 'AF', 'Afghanistan', 1, 0, '0.00', 0),
(2, 'AL', 'Albania', 1, 0, '0.00', 0),
(3, 'DZ', 'Algeria', 1, 0, '0.00', 0),
(4, 'AS', 'American Samoa', 1, 0, '0.00', 0),
(5, 'AD', 'Andorra', 1, 0, '0.00', 0),
(6, 'AO', 'Angola', 1, 0, '0.00', 0),
(7, 'AI', 'Anguilla', 1, 0, '0.00', 0),
(8, 'AQ', 'Antarctica', 1, 0, '0.00', 0),
(9, 'AG', 'Antigua and Barbuda', 1, 0, '0.00', 0),
(10, 'AR', 'Argentina', 1, 0, '0.00', 0),
(11, 'AM', 'Armenia', 1, 0, '0.00', 0),
(12, 'AW', 'Aruba', 1, 0, '0.00', 0),
(13, 'AU', 'Australia', 1, 0, '0.00', 0),
(14, 'AT', 'Austria', 1, 0, '0.00', 0),
(15, 'AZ', 'Azerbaijan', 1, 0, '0.00', 0),
(16, 'BS', 'Bahamas', 1, 0, '0.00', 0),
(17, 'BH', 'Bahrain', 1, 0, '0.00', 0),
(18, 'BD', 'Bangladesh', 1, 0, '0.00', 0),
(19, 'BB', 'Barbados', 1, 0, '0.00', 0),
(20, 'BY', 'Belarus', 1, 0, '0.00', 0),
(21, 'BE', 'Belgium', 1, 0, '0.00', 0),
(22, 'BZ', 'Belize', 1, 0, '0.00', 0),
(23, 'BJ', 'Benin', 1, 0, '0.00', 0),
(24, 'BM', 'Bermuda', 1, 0, '0.00', 0),
(25, 'BT', 'Bhutan', 1, 0, '0.00', 0),
(26, 'BO', 'Bolivia', 1, 0, '0.00', 0),
(27, 'BA', 'Bosnia and Herzegowina', 1, 0, '0.00', 0),
(28, 'BW', 'Botswana', 1, 0, '0.00', 0),
(29, 'BV', 'Bouvet Island', 1, 0, '0.00', 0),
(30, 'BR', 'Brazil', 1, 0, '0.00', 0),
(31, 'IO', 'British Indian Ocean Territory', 1, 0, '0.00', 0),
(32, 'VG', 'British Virgin Islands', 1, 0, '0.00', 0),
(33, 'BN', 'Brunei Darussalam', 1, 0, '0.00', 0),
(34, 'BG', 'Bulgaria', 1, 0, '0.00', 0),
(35, 'BF', 'Burkina Faso', 1, 0, '0.00', 0),
(36, 'BI', 'Burundi', 1, 0, '0.00', 0),
(37, 'KH', 'Cambodia', 1, 0, '0.00', 0),
(38, 'CM', 'Cameroon', 1, 0, '0.00', 0),
(39, 'CA', 'Canada', 1, 1, '13.00', 1000),
(40, 'CV', 'Cape Verde', 1, 0, '0.00', 0),
(41, 'KY', 'Cayman Islands', 1, 0, '0.00', 0),
(42, 'CF', 'Central African Republic', 1, 0, '0.00', 0),
(43, 'TD', 'Chad', 1, 0, '0.00', 0),
(44, 'CL', 'Chile', 1, 0, '0.00', 0),
(45, 'CN', 'China', 1, 0, '0.00', 0),
(46, 'CX', 'Christmas Island', 1, 0, '0.00', 0),
(47, 'CC', 'Cocos (Keeling) Islands', 1, 0, '0.00', 0),
(48, 'CO', 'Colombia', 1, 0, '0.00', 0),
(49, 'KM', 'Comoros', 1, 0, '0.00', 0),
(50, 'CG', 'Congo', 1, 0, '0.00', 0),
(51, 'CK', 'Cook Islands', 1, 0, '0.00', 0),
(52, 'CR', 'Costa Rica', 1, 0, '0.00', 0),
(53, 'CI', 'Cote D\'ivoire', 1, 0, '0.00', 0),
(54, 'HR', 'Croatia', 1, 0, '0.00', 0),
(55, 'CU', 'Cuba', 1, 0, '0.00', 0),
(56, 'CY', 'Cyprus', 1, 0, '0.00', 0),
(57, 'CZ', 'Czech Republic', 1, 0, '0.00', 0),
(58, 'DK', 'Denmark', 1, 0, '0.00', 0),
(59, 'DJ', 'Djibouti', 1, 0, '0.00', 0),
(60, 'DM', 'Dominica', 1, 0, '0.00', 0),
(61, 'DO', 'Dominican Republic', 1, 0, '0.00', 0),
(62, 'TP', 'East Timor', 1, 0, '0.00', 0),
(63, 'EC', 'Ecuador', 1, 0, '0.00', 0),
(64, 'EG', 'Egypt', 1, 0, '0.00', 0),
(65, 'SV', 'El Salvador', 1, 0, '0.00', 0),
(66, 'GQ', 'Equatorial Guinea', 1, 0, '0.00', 0),
(67, 'ER', 'Eritrea', 1, 0, '0.00', 0),
(68, 'EE', 'Estonia', 1, 0, '0.00', 0),
(69, 'ET', 'Ethiopia', 1, 0, '0.00', 0),
(70, 'FK', 'Falkland Islands (Malvinas)', 1, 0, '0.00', 0),
(71, 'FO', 'Faroe Islands', 1, 0, '0.00', 0),
(72, 'FJ', 'Fiji', 1, 0, '0.00', 0),
(73, 'FI', 'Finland', 1, 0, '0.00', 0),
(74, 'FR', 'France', 1, 0, '0.00', 0),
(75, 'GF', 'French Guiana', 1, 0, '0.00', 0),
(76, 'PF', 'French Polynesia', 1, 0, '0.00', 0),
(77, 'TF', 'French Southern Territories', 1, 0, '0.00', 0),
(78, 'GA', 'Gabon', 1, 0, '0.00', 0),
(79, 'GM', 'Gambia', 1, 0, '0.00', 0),
(80, 'GE', 'Georgia', 1, 0, '0.00', 0),
(81, 'DE', 'Germany', 1, 0, '0.00', 0),
(82, 'GH', 'Ghana', 1, 0, '0.00', 0),
(83, 'GI', 'Gibraltar', 1, 0, '0.00', 0),
(84, 'GR', 'Greece', 1, 0, '0.00', 0),
(85, 'GL', 'Greenland', 1, 0, '0.00', 0),
(86, 'GD', 'Grenada', 1, 0, '0.00', 0),
(87, 'GP', 'Guadeloupe', 1, 0, '0.00', 0),
(88, 'GU', 'Guam', 1, 0, '0.00', 0),
(89, 'GT', 'Guatemala', 1, 0, '0.00', 0),
(90, 'GN', 'Guinea', 1, 0, '0.00', 0),
(91, 'GW', 'Guinea-Bissau', 1, 0, '0.00', 0),
(92, 'GY', 'Guyana', 1, 0, '0.00', 0),
(93, 'HT', 'Haiti', 1, 0, '0.00', 0),
(94, 'HM', 'Heard and McDonald Islands', 1, 0, '0.00', 0),
(95, 'HN', 'Honduras', 1, 0, '0.00', 0),
(96, 'HK', 'Hong Kong', 1, 0, '0.00', 0),
(97, 'HU', 'Hungary', 1, 0, '0.00', 0),
(98, 'IS', 'Iceland', 1, 0, '0.00', 0),
(99, 'IN', 'India', 1, 0, '0.00', 0),
(100, 'ID', 'Indonesia', 1, 0, '0.00', 0),
(101, 'IQ', 'Iraq', 1, 0, '0.00', 0),
(102, 'IE', 'Ireland', 1, 0, '0.00', 0),
(103, 'IR', 'Islamic Republic of Iran', 1, 0, '0.00', 0),
(104, 'IL', 'Israel', 1, 0, '0.00', 0),
(105, 'IT', 'Italy', 1, 0, '0.00', 0),
(106, 'JM', 'Jamaica', 1, 0, '0.00', 0),
(107, 'JP', 'Japan', 1, 0, '0.00', 0),
(108, 'JO', 'Jordan', 1, 0, '0.00', 0),
(109, 'KZ', 'Kazakhstan', 1, 0, '0.00', 0),
(110, 'KE', 'Kenya', 1, 0, '0.00', 0),
(111, 'KI', 'Kiribati', 1, 0, '0.00', 0),
(112, 'KP', 'Korea, Dem. Peoples Rep of', 1, 0, '0.00', 0),
(113, 'KR', 'Korea, Republic of', 1, 0, '0.00', 0),
(114, 'KW', 'Kuwait', 1, 0, '0.00', 0),
(115, 'KG', 'Kyrgyzstan', 1, 0, '0.00', 0),
(116, 'LA', 'Laos', 1, 0, '0.00', 0),
(117, 'LV', 'Latvia', 1, 0, '0.00', 0),
(118, 'LB', 'Lebanon', 1, 0, '0.00', 0),
(119, 'LS', 'Lesotho', 1, 0, '0.00', 0),
(120, 'LR', 'Liberia', 1, 0, '0.00', 0),
(121, 'LY', 'Libyan Arab Jamahiriya', 1, 0, '0.00', 0),
(122, 'LI', 'Liechtenstein', 1, 0, '0.00', 0),
(123, 'LT', 'Lithuania', 1, 0, '0.00', 0),
(124, 'LU', 'Luxembourg', 1, 0, '0.00', 0),
(125, 'MO', 'Macau', 1, 0, '0.00', 0),
(126, 'MK', 'Macedonia', 1, 0, '0.00', 0),
(127, 'MG', 'Madagascar', 1, 0, '0.00', 0),
(128, 'MW', 'Malawi', 1, 0, '0.00', 0),
(129, 'MY', 'Malaysia', 1, 0, '0.00', 0),
(130, 'MV', 'Maldives', 1, 0, '0.00', 0),
(131, 'ML', 'Mali', 1, 0, '0.00', 0),
(132, 'MT', 'Malta', 1, 0, '0.00', 0),
(133, 'MH', 'Marshall Islands', 1, 0, '0.00', 0),
(134, 'MQ', 'Martinique', 1, 0, '0.00', 0),
(135, 'MR', 'Mauritania', 1, 0, '0.00', 0),
(136, 'MU', 'Mauritius', 1, 0, '0.00', 0),
(137, 'YT', 'Mayotte', 1, 0, '0.00', 0),
(138, 'MX', 'Mexico', 1, 0, '0.00', 0),
(139, 'FM', 'Micronesia', 1, 0, '0.00', 0),
(140, 'MD', 'Moldova, Republic of', 1, 0, '0.00', 0),
(141, 'MC', 'Monaco', 1, 0, '0.00', 0),
(142, 'MN', 'Mongolia', 1, 0, '0.00', 0),
(143, 'MS', 'Montserrat', 1, 0, '0.00', 0),
(144, 'MA', 'Morocco', 1, 0, '0.00', 0),
(145, 'MZ', 'Mozambique', 1, 0, '0.00', 0),
(146, 'MM', 'Myanmar', 1, 0, '0.00', 0),
(147, 'NA', 'Namibia', 1, 0, '0.00', 0),
(148, 'NR', 'Nauru', 1, 0, '0.00', 0),
(149, 'NP', 'Nepal', 1, 0, '0.00', 0),
(150, 'NL', 'Netherlands', 1, 0, '0.00', 0),
(151, 'AN', 'Netherlands Antilles', 1, 0, '0.00', 0),
(152, 'NC', 'New Caledonia', 1, 0, '0.00', 0),
(153, 'NZ', 'New Zealand', 1, 0, '0.00', 0),
(154, 'NI', 'Nicaragua', 1, 0, '0.00', 0),
(155, 'NE', 'Niger', 1, 0, '0.00', 0),
(156, 'NG', 'Nigeria', 1, 0, '0.00', 0),
(157, 'NU', 'Niue', 1, 0, '0.00', 0),
(158, 'NF', 'Norfolk Island', 1, 0, '0.00', 0),
(159, 'MP', 'Northern Mariana Islands', 1, 0, '0.00', 0),
(160, 'NO', 'Norway', 1, 0, '0.00', 0),
(161, 'OM', 'Oman', 1, 0, '0.00', 0),
(162, 'PK', 'Pakistan', 1, 0, '0.00', 0),
(163, 'PW', 'Palau', 1, 0, '0.00', 0),
(164, 'PA', 'Panama', 1, 0, '0.00', 0),
(165, 'PG', 'Papua New Guinea', 1, 0, '0.00', 0),
(166, 'PY', 'Paraguay', 1, 0, '0.00', 0),
(167, 'PE', 'Peru', 1, 0, '0.00', 0),
(168, 'PH', 'Philippines', 1, 0, '0.00', 0),
(169, 'PN', 'Pitcairn', 1, 0, '0.00', 0),
(170, 'PL', 'Poland', 1, 0, '0.00', 0),
(171, 'PT', 'Portugal', 1, 0, '0.00', 0),
(172, 'PR', 'Puerto Rico', 1, 0, '0.00', 0),
(173, 'QA', 'Qatar', 1, 0, '0.00', 0),
(174, 'RE', 'Reunion', 1, 0, '0.00', 0),
(175, 'RO', 'Romania', 1, 0, '0.00', 0),
(176, 'RU', 'Russian Federation', 1, 0, '0.00', 0),
(177, 'RW', 'Rwanda', 1, 0, '0.00', 0),
(178, 'LC', 'Saint Lucia', 1, 0, '0.00', 0),
(179, 'WS', 'Samoa', 1, 0, '0.00', 0),
(180, 'SM', 'San Marino', 1, 0, '0.00', 0),
(181, 'ST', 'Sao Tome and Principe', 1, 0, '0.00', 0),
(182, 'SA', 'Saudi Arabia', 1, 0, '0.00', 0),
(183, 'SN', 'Senegal', 1, 0, '0.00', 0),
(184, 'RS', 'Serbia', 1, 0, '0.00', 0),
(185, 'SC', 'Seychelles', 1, 0, '0.00', 0),
(186, 'SL', 'Sierra Leone', 1, 0, '0.00', 0),
(187, 'SG', 'Singapore', 1, 0, '0.00', 0),
(188, 'SK', 'Slovakia', 1, 0, '0.00', 0),
(189, 'SI', 'Slovenia', 1, 0, '0.00', 0),
(190, 'SB', 'Solomon Islands', 1, 0, '0.00', 0),
(191, 'SO', 'Somalia', 1, 0, '0.00', 0),
(192, 'ZA', 'South Africa', 1, 0, '0.00', 0),
(193, 'ES', 'Spain', 1, 0, '0.00', 0),
(194, 'LK', 'Sri Lanka', 1, 0, '0.00', 0),
(195, 'SH', 'St. Helena', 1, 0, '0.00', 0),
(196, 'KN', 'St. Kitts and Nevis', 1, 0, '0.00', 0),
(197, 'PM', 'St. Pierre and Miquelon', 1, 0, '0.00', 0),
(198, 'VC', 'St. Vincent and the Grenadines', 1, 0, '0.00', 0),
(199, 'SD', 'Sudan', 1, 0, '0.00', 0),
(200, 'SR', 'Suriname', 1, 0, '0.00', 0),
(201, 'SJ', 'Svalbard and Jan Mayen Islands', 1, 0, '0.00', 0),
(202, 'SZ', 'Swaziland', 1, 0, '0.00', 0),
(203, 'SE', 'Sweden', 1, 0, '0.00', 0),
(204, 'CH', 'Switzerland', 1, 0, '0.00', 0),
(205, 'SY', 'Syrian Arab Republic', 1, 0, '0.00', 0),
(206, 'TW', 'Taiwan', 1, 0, '0.00', 0),
(207, 'TJ', 'Tajikistan', 1, 0, '0.00', 0),
(208, 'TZ', 'Tanzania, United Republic of', 1, 0, '0.00', 0),
(209, 'TH', 'Thailand', 1, 0, '0.00', 0),
(210, 'TG', 'Togo', 1, 0, '0.00', 0),
(211, 'TK', 'Tokelau', 1, 0, '0.00', 0),
(212, 'TO', 'Tonga', 1, 0, '0.00', 0),
(213, 'TT', 'Trinidad and Tobago', 1, 0, '0.00', 0),
(214, 'TN', 'Tunisia', 1, 0, '0.00', 0),
(215, 'TR', 'Turkey', 1, 0, '0.00', 0),
(216, 'TM', 'Turkmenistan', 1, 0, '0.00', 0),
(217, 'TC', 'Turks and Caicos Islands', 1, 0, '0.00', 0),
(218, 'TV', 'Tuvalu', 1, 0, '0.00', 0),
(219, 'UG', 'Uganda', 1, 0, '0.00', 0),
(220, 'UA', 'Ukraine', 1, 0, '0.00', 0),
(221, 'AE', 'United Arab Emirates', 1, 0, '0.00', 0),
(222, 'GB', 'United Kingdom (GB)', 1, 0, '23.50', 999),
(224, 'US', 'United States', 1, 0, '7.50', 998),
(225, 'VI', 'United States Virgin Islands', 1, 0, '0.00', 0),
(226, 'UY', 'Uruguay', 1, 0, '0.00', 0),
(227, 'UZ', 'Uzbekistan', 1, 0, '0.00', 0),
(228, 'VU', 'Vanuatu', 1, 0, '0.00', 0),
(229, 'VA', 'Vatican City State', 1, 0, '0.00', 0),
(230, 'VE', 'Venezuela', 1, 0, '0.00', 0),
(231, 'VN', 'Vietnam', 1, 0, '0.00', 0),
(232, 'WF', 'Wallis And Futuna Islands', 1, 0, '0.00', 0),
(233, 'EH', 'Western Sahara', 1, 0, '0.00', 0),
(234, 'YE', 'Yemen', 1, 0, '0.00', 0),
(235, 'ZR', 'Zaire', 1, 0, '0.00', 0),
(236, 'ZM', 'Zambia', 1, 0, '0.00', 0),
(237, 'ZW', 'Zimbabwe', 1, 0, '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(1) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `code` varchar(30) NOT NULL,
  `discount` smallint(2) UNSIGNED NOT NULL DEFAULT 0,
  `type` varchar(1) NOT NULL DEFAULT 'p',
  `minval` decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `validuntil` date DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cronjobs`
--

CREATE TABLE `cronjobs` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `membership_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `stripe_customer` varchar(60) NOT NULL,
  `stripe_pm` varchar(80) NOT NULL,
  `amount` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `renewal` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(60) NOT NULL,
  `tooltip` varchar(100) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `required` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `section` varchar(30) DEFAULT NULL,
  `sorting` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `title`, `tooltip`, `name`, `required`, `section`, `sorting`, `active`) VALUES
(1, 'קופון', 'כאן יוצג הקוד קופון', 'Djwlrl', 0, 'product', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields_data`
--

CREATE TABLE `custom_fields_data` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `product_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `field_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `field_name` varchar(40) DEFAULT NULL,
  `field_value` varchar(100) DEFAULT NULL,
  `section` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `custom_fields_data`
--

INSERT INTO `custom_fields_data` (`id`, `user_id`, `product_id`, `field_id`, `field_name`, `field_value`, `section`) VALUES
(5, 0, 5, 1, 'Djwlrl', '2022SquirrlyEntrepreneurStore1', 'product'),
(2, 0, 2, 1, 'Djwlrl', NULL, 'product'),
(3, 0, 3, 1, 'Djwlrl', NULL, 'product'),
(4, 0, 4, 1, 'Djwlrl', '20% הנחה אין צורך בקוד רק ללחוץ על הכפתור של הרכישה', 'product'),
(6, 0, 6, 1, 'Djwlrl', '', 'product'),
(7, 0, 7, 1, 'Djwlrl', NULL, 'product'),
(8, 0, 8, 1, 'Djwlrl', NULL, 'product'),
(9, 0, 9, 1, 'Djwlrl', 'Anyword20', 'product'),
(10, 0, 10, 1, 'Djwlrl', '', 'product'),
(11, 0, 11, 1, 'Djwlrl', '', 'product'),
(12, 0, 12, 1, 'Djwlrl', '', 'product'),
(13, 0, 13, 1, 'Djwlrl', '', 'product'),
(14, 0, 14, 1, 'Djwlrl', '', 'product'),
(15, 0, 15, 1, 'Djwlrl', '', 'product'),
(16, 0, 16, 1, 'Djwlrl', '', 'product'),
(17, 0, 17, 1, 'Djwlrl', '', 'product'),
(18, 0, 18, 1, 'Djwlrl', '', 'product'),
(19, 0, 19, 1, 'Djwlrl', '', 'product');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `help` tinytext DEFAULT NULL,
  `body` text NOT NULL,
  `type` enum('news','mailer') DEFAULT 'mailer',
  `typeid` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `help`, `body`, `type`, `typeid`) VALUES
(1, 'Registration Email', 'Please verify your email', 'This template is used to send Registration Verification Email, when Configuration->Registration Verification is set to YES', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"4ws2jmjhco30\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">You have been registered!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME], You\'re now a member of [COMPANY].</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\">To activate your account, please visit the link below.</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> Here are your login credentials. Please keep them in a safe place.</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Username</strong>: [USERNAME] or [EMAIL]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Password</strong>: [PASSWORD]</p>\r\n      <div style=\"padding:30px 0px 0px 0px\">\r\n        <a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Activate your account </a>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"glmglszu0m75\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"vpt5954wdqrm\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"k0iryp03abht\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n [LOGO]\r\n  </div>\r\n</div></div>', 'mailer', 'regMail'),
(2, 'Welcome Mail From Admin', 'You have been registered', 'This template is used to send welcome email, when user is added by administrator', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"4bftzn9mnp34\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">You have been registered!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME], You\'re now a member of [COMPANY].</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> Here are your login credentials. Please keep them in a safe place.</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Username</strong>: [USERNAME] or [EMAIL]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Password</strong>: [PASSWORD]</p>\r\n      <div style=\"padding:30px 0px 0px 0px\">\r\n        <a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Go to login page</a>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"azz221guzon1\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"4947irbnlc0j\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"c05tnaicg7qs\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n  [LOGO]\r\n  </div>\r\n</div>', 'mailer', 'regMailAdmin'),
(3, 'Default Newsletter', 'Newsletter', 'This is a default newsletter template', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"iaajdgn0nyxj\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">[COMPANY] Newsletter!</h1>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> Hello [NAME].</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\">[ATTACHMENT]</p>\r\n      <div style=\"padding:30px 0px 0px 0px\">\r\n         Newsletter content goes here...\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"kbtwgr9h1cul\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"cbgghd7q1h3y\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"dekk8aasm70h\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div></div>', 'mailer', 'newsletter'),
(4, 'Single Email', 'Single User Email', 'This template is used to email single user', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"dsf4kzl1zt12\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">Hello [NAME]</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\">[ATTACHMENT]</p>\r\n      <div style=\"padding:30px 0px 0px 0px\">\r\n         Message content goes here...\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"6i0get0q13au\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"lu4vgbozinta\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"v6g5sjcvykad\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'singleMail'),
(5, 'Forgot Password Admin', 'Password Reset', 'This template is used for retrieving lost admin password', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"vtgsf4i5g20q\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">New Password Request!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME], it seems that you or someone requested a new password for you.</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> We have generated a new password, as requested.</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>New Password</strong>: [PASSWORD]</p>\r\n      <div style=\"padding:30px 0px 0px 0px\">\r\n        <a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Go to login </a>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"g713ar64ps8l\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"rpgxlcqjnum1\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"p6u9gn6j2zqq\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'adminPassReset'),
(6, 'Forgot Password User', 'Password Reset', 'This template is used for retrieving lost user password', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 16px 24px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"kmbm1za7efwc\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">New Password Request!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME], it seems that you or someone requested a new password for you.</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> We have generated a new password, as requested.</p>\r\n      <div style=\"padding:30px 0px 0px 0px\">\r\n        <a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Go to password reset page </a>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"wiuvuko2oe7j\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"m7oek6betzkw\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"ruu0t8hc3al7\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n      [LOGO]\r\n  </div>\r\n</div>', 'mailer', 'userPassReset'),
(7, 'Welcome Email', 'Welcome', 'This template is used to welcome newly registered user when Configuration->Registration Verification and Configuration->Auto Registration are both set to YES', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"tfc4plbhxc04\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">You have been registered!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME], You\'re now a member of [COMPANY].</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> Here are your login credentials. Please keep them in a safe place.</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Username</strong>: [USERNAME] or [EMAIL]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Password</strong>: [PASSWORD]</p>\r\n      <div style=\"padding:30px 0px 0px 0px\">\r\n        <a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Go to login page </a>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"45dsf9l5s1o8\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"717tgkrr84wf\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"hndccxdpm7g5\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'welcomeEmail'),
(8, 'Registration Pending', 'Registration Verification Pending', 'This template is used to send Registration Verification Email, when Configuration->Auto Registration is set to NO', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"v7fbzkxjukaz\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">You have been registered!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME], You\'re now a member of [COMPANY].</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\">Your account is currently pending verification process, and you will be notified once your account is acivated.</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> Here are your login credentials. Please keep them in a safe place.</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Username</strong>: [USERNAME] or [EMAIL]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Password</strong>: [PASSWORD]</p>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"9ognfuhnpnjj\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"ruc9u398zqlj\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"wy8nz9wa5b4c\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'regMailPending'),
(9, 'Notify Admin', 'New User Registration', 'This template is used to notify admin of new registration when Configuration->Registration Notification is set to YES', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"n8t1g2w8q9rl\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">Hello Admin!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> You have a new user registration.</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> You can login into your admin panel to view details.</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Email</strong>: [EMAIL]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Name</strong>: [NAME]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>IP</strong>: [IP]</p>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"bnp3fsaqz5yy\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"h3s7j4bo1ir1\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"m9vhe9pdm1on\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'notifyAdmin'),
(10, 'Contact Request', 'Contact Inquiry', 'This template is used to send default Contact Request Form', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"f3nrplhidmj6\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">Hello Admin!</h1>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> You have a new contact request.</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>From</strong>: [NAME]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>IP</strong>: [IP]</p>\r\n      <div style=\"padding:30px 0px 0px 0px\">\r\n         [MESSAGE]\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"yger06rak0lt\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"xmt8va2osh4t\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"7n5kkad0gqfq\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'contact'),
(11, 'Transaction Completed Admin', 'Payment Completed', 'This template is used to notify administrator on successful payment transaction', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"8q1qgpxputhq\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">Hello Admin!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> You have received new payment.</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> Here are the details:</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>[TYPE]</strong>: [ITEMNAME]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>CD Key</strong>: [CDKEY]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Price</strong>: [PRICE]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Status</strong>: [STATUS]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Processor</strong>: [PP]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>IP</strong>: [IP]</p>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"d195y11yw5bz\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"03c0n3ni0oqs\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"7jbc9xd8lpfo\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'payComplete'),
(12, 'Transaction Completed User', 'Payment Completed', 'This template is used to notify user on successful payment transaction', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"97gejypupmc4\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">Hello [NAME]!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> Your payment has been completed successfuly.</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> Here are the details:</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>[TYPE]</strong>: [ITEMNAME]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>[CDKEY]</strong></p><strong>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Vat/Tax</strong>: [TAX]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Price</strong>: [PRICE]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Processor</strong>: [PP]</p>\r\n    </strong></div><strong>\r\n  </strong></div><strong>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"eor4ccx95ok5\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"xl0ehkxitieq\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"vxpr51jwfh8p\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'payCompleteUser'),
(13, 'Membership Expired', 'Membership Has Expired', 'This template is used to notify user when membership is about to expire a day before. ', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"wrmsfqaf1h3i\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">Hello [NAME]!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> Your membership access will soon expiere .</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> Here are the details:</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Membership</strong>: [ITEMNAME]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Expiry Date</strong>: [EXPIRE]</p>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"05cp8na4kk8f\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"uog7tnr3i71s\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"we8ef4w07oaf\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'memExpired'),
(14, 'New Comment', 'New Comment Added', 'This template is used to notify admin when comment has been submitted.', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"grtntoenatkm\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">Hello Admin!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> You have a new comment post.</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> If comments are not auto approved, you will need to manually approve them from admin panel.</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>From</strong>: [NAME]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Page</strong>: [PAGEURL]</p>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>IP</strong>: [IP]</p>\r\n      <div style=\"padding:30px 0px 0px 0px\">\r\n        [MESSAGE]\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"v3fzub7gxrcc\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"12ob20069g7v\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"064ggb0xj13r\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'newComment'),
(15, 'Notify User Transaction', 'Your product is ready for download', 'This template is used to notify user when manual transaction has been processed.', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"jeetgfnionkq\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n      <h1 style=\"font-weight:100;margin-bottom:32px\">Hello [NAME]!</h1>\r\n      <p style=\"margin:0;padding:3px;color:#7B7B7B\"> Your product <strong>[ITEMNAME]</strong> is ready for download.</p>\r\n      <p style=\"margin:0;padding:5px;color:#7B7B7B\"> Login into your dashboard to view this transaction.</p>\r\n      <div style=\"padding:30px 0px 0px 0px\">\r\n        <a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Dashboard </a>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"88v0vcu2r5tq\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"hhu0q3s1dpm9\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"r3unqdt9l65z\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n      <p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n      <p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n        . All rights reserved.</p>\r\n    </div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'notifyUser');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `question` varchar(150) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `sorting` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `alias` varchar(80) DEFAULT NULL,
  `filesize` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `extension` varchar(4) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `alias`, `filesize`, `extension`, `type`, `token`, `created`, `active`) VALUES
(1, 'File_O87J6yNc9ryT4eVhf3VEyeBc.txt', 'test_2.txt', 37, 'txt', 'text', '4wZQrWXafFaWqfIiqMzGiKD9AlvlmLu1', '2022-09-04 18:30:03', 1),
(2, 'File_BXFYs6YL1yH5rJ5SLH5lx2eC.jpg', 'test_1.jpg', 2121, 'jpg', 'image', 'dIReuXATDNocA2gxqB1NoFwbVsJYj4lP', '2022-09-04 18:55:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` int(4) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `displayname` varchar(50) NOT NULL,
  `dir` varchar(30) NOT NULL,
  `live` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `extra_txt` varchar(120) DEFAULT NULL,
  `extra_txt2` varchar(120) DEFAULT NULL,
  `extra_txt3` varchar(120) DEFAULT NULL,
  `extra` varchar(120) NOT NULL,
  `extra2` varchar(120) DEFAULT NULL,
  `extra3` varchar(120) DEFAULT NULL,
  `is_recurring` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `name`, `displayname`, `dir`, `live`, `extra_txt`, `extra_txt2`, `extra_txt3`, `extra`, `extra2`, `extra3`, `is_recurring`, `active`) VALUES
(1, 'paypal', 'PayPal', 'paypal', 1, 'Paypal Email Address', 'Currency Code', 'Not in Use', 'webmaster@domain.com', 'ILS', '', 1, 1),
(2, 'skrill', 'Skrill', 'skrill', 1, 'Skrill Email Address', 'Currency Code', 'Secret Passphrase', 'skrill@address.com', 'EUR', 'mypassphrase', 1, 1),
(3, 'stripe', 'Stripe', 'stripe', 1, 'Stripe Secret Key', 'Currency Code', 'Publishable Key', '', 'CAD', '', 1, 1),
(4, 'payfast', 'PayFast', 'payfast', 1, 'Merchant ID', 'Merchant Key', 'PassPhrase', '', '', '', 1, 1),
(5, 'ideal', 'iDeal', 'ideal', 1, 'API Key', 'Currency Code', 'Not in Use', '', 'EUR', NULL, 0, 1),
(6, 'anet', 'Authorize.net', 'anet', 1, 'API Login Id', 'MD5 Hash Key', 'Transaction Key', '', 'Simon', '', 0, 1),
(7, 'offline', 'תשלום בביט', 'offline', 1, 'Currency Code', 'Not in Use', 'Not in Use', 'ILS', '', 'נא לבצע תשלום בביט לטלפון 0545667994 ולאחר מכן לשלוח צילום מסך לטלפון 0549088009 שבוצעה העברה', 0, 1),
(8, 'razorpay', 'RazorPay', 'razorpay', 1, 'Api Key', 'Currency Code', 'Secret Key', '', 'INR', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(60) DEFAULT NULL,
  `sorting` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `parent_id`, `name`, `sorting`) VALUES
(1, 1, 'IMG_ULxdefDyuaGz.jpg', 0),
(2, 4, 'IMG_nAjgHcs8bMZd.png', 0),
(3, 4, 'IMG_T9s5QJ4NUSTy.png', 0),
(4, 5, 'IMG_Zv6bkvPwl4xZ.png', 0),
(5, 6, 'IMG_UFBvi4kw4kMc.jpg', 0),
(6, 8, 'IMG_WcBezH4PfaZQ.jpg', 0),
(7, 8, 'IMG_GGBvh6o5VATZ.jpg', 0),
(8, 9, 'IMG_BzBgCjStFZfR.png', 2),
(10, 9, 'IMG_9ZGjJwU0KX4Z.jpg', 3),
(11, 961804, 'IMG_vxqm6QiIGuMS.png', 0),
(12, 961804, 'IMG_CIdcI17iE8v0.jpg', 0),
(13, 328998, 'IMG_35r73Q6l7zri.jpg', 2),
(14, 328998, 'IMG_KeFoCtjiH6o7.png', 1),
(15, 10, 'IMG_bzBuWXzaojs6.jpg', 2),
(16, 10, 'IMG_FsN2ebRmsgB5.png', 1),
(17, 11, 'IMG_y3aqIG5ee4Pd.png', 2),
(18, 11, 'IMG_NK0TuNCO5DbQ.png', 1),
(22, 13, 'IMG_eLNiLlBbNeu3.jpg', 1),
(20, 12, 'IMG_6nBP18Ipqyuy.jpg', 0),
(21, 12, 'IMG_U0UMkpo9ZdpX.jpg', 0),
(23, 13, 'IMG_7gPnJidCOMur.png', 2),
(24, 14, 'IMG_wgVtQeZbzSjL.jpg', 0),
(25, 14, 'IMG_FcBSZIgNytJP.jpg', 0),
(27, 15, 'IMG_aBrw4OOQ4EQM.jpg', 0),
(28, 15, 'IMG_43IJ7Y19F1ep.jpg', 0),
(29, 16, 'IMG_XMXpXldRWkA8.png', 0),
(30, 16, 'IMG_9D6CA2Fb3xwz.jpg', 0),
(31, 17, 'IMG_viQy9khlMac8.jpg', 0),
(32, 17, 'IMG_psycKqsaRoKn.jpg', 0),
(33, 18, 'IMG_c1GWgHQSUECY.jpg', 0),
(34, 18, 'IMG_fMk6enHWI2Qe.jpg', 0),
(35, 19, 'IMG_b9PzkhSjk4Gq.jpg', 0),
(36, 19, 'IMG_oUre8QE1Ljl7.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) UNSIGNED NOT NULL,
  `invoice_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `transaction_id` varchar(32) NOT NULL DEFAULT '0',
  `items` blob DEFAULT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `tax` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `coupon` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `subtotal` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `grand` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `currency` varchar(6) DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `days` smallint(2) UNSIGNED NOT NULL DEFAULT 0,
  `period` varchar(1) NOT NULL DEFAULT 'D',
  `recurring` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `thumb` varchar(40) DEFAULT NULL,
  `private` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `title`, `description`, `price`, `days`, `period`, `recurring`, `thumb`, `private`, `active`) VALUES
(1, 'VIP בסיסי לחודש אחד', 'מנוי בסיסי לחודש אחד להורדה של תכני VIP.', '29.99', 1, 'M', 0, 'bronze.svg', 0, 1),
(3, 'VIP פרימיום ל12 חודשים', 'מנוי פרימיום לשנה שלמה הורדה של תכני VIP.', '149.99', 1, 'Y', 1, 'platinum.svg', 1, 1),
(4, 'VIP מתקדם ל3 חודשים', 'מנוי מתקדם ל3 חודשים להורדה של תכני VIP.', '49.99', 3, 'M', 0, 'silver.svg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `membership_history`
--

CREATE TABLE `membership_history` (
  `id` int(11) UNSIGNED NOT NULL,
  `transaction_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `membership_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `activated` timestamp NULL DEFAULT current_timestamp(),
  `expire` timestamp NULL DEFAULT NULL,
  `recurring` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 = expired, 1 = active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(4) UNSIGNED NOT NULL,
  `page_id` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(100) NOT NULL,
  `content_type` varchar(20) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `target` varchar(8) DEFAULT '_blank',
  `sorting` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `page_id`, `name`, `content_type`, `link`, `target`, `sorting`, `active`) VALUES
(1, 4, 'צרו איתנו קשר', 'page', '', '', 5, 1),
(2, 1, 'עמוד הבית', 'page', '', '', 1, 0),
(3, 7, 'אודותינו', 'page', '#', '', 4, 1),
(4, 3, 'שאלות ותשובות', 'page', '', '', 2, 1),
(5, 0, 'Ext Link', 'web', 'http://www.google.com', '_blank', 6, 0),
(6, 5, 'תקנון ותנאי שימוש', 'page', '', '_self', 7, 1),
(7, 6, 'VIP מועדון', 'page', '', '', 8, 1),
(8, 0, 'מה חדש?', 'web', '[SITEURL]/news/', '_self', 9, 1),
(9, 0, 'בלוג', 'web', '[SITEURL]/blog/', '_self', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `author` varchar(55) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `body` longtext DEFAULT NULL,
  `page_type` enum('membership','faq','contact','home','normal') DEFAULT 'normal',
  `address` tinytext DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `body`, `page_type`, `address`, `keywords`, `description`, `created`, `active`) VALUES
(1, 'הכירו את DigitalPlanet.co.il', 'welcome-to-our-site', '<div class=\"centercontent\">\r\n<div class=\"centertexthome\" dir=\"rtl\" id=\"centertexthome\">\r\n<h1 dir=\"RTL\" style=\"text-align: center;\"><a name=\"_rqr8ilkhzh6j\"></a>האתר החדש לכלי שיווק דיגיטלי, כלי קידום אתרים, כלי פיתוח אתרים ותוכנה למעצבים דיגיטליים</h1>\r\n\r\n<p dir=\"RTL\" style=\"text-align: center;\">DigitalPlanet.co.il הוא אתר חדש לגמרי המציע מגוון רחב של כלי שיווק דיגיטלי, SEO, פיתוח אתרים ועיצוב הכל במקום אחד. בין אם אתה מקצוען ותיק או רק בתחילת הדרך בעולם הדיגיטלי, באתר זה יש משהו לכולם. עיין ברשימה המקיפה שלנו של תכונות למטה!</p>\r\n\r\n<h2 dir=\"RTL\" style=\"text-align: center;\"><a name=\"_nrbb3ich3ays\"></a>אתר ראשון מסוגו בישראל עם כל הכלים הדיגיטליים לאנשים דיגיטליים</h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align: center;\">ברוכים הבאים לאתר החדש לכלי שיווק דיגיטליים, כלי SEO, כלי פיתוח אתרים ותוכנות למעצבים דיגיטליים – DigitalPlanet.co.il!</p>\r\n\r\n<p dir=\"RTL\" style=\"text-align: center;\">באתר שלנו תמצאו את כל מה שאתם צריכים כדי להפוך את העבודה שלכם בעולם הדיגיטלי לקלה ויעילה יותר. אספנו את כל הכלים והתוכנות הטובות ביותר במקום אחד, כך שלא תצטרכו לבזבז זמן בחיפוש אחריהם באתרים שונים. במדור הבלוג שלנו תמצאו טיפים וטריקים כיצד להשתמש בכלים השונים, וכן מאמרים על מגמות עדכניות בעולם הדיגיטלי. הישאר מעודכן בחדשות וההתפתחויות האחרונות בתחום, ולמד כיצד להשתמש בהן לטובתך.<br>אנו מקווים שתיהנו מהאתר שלנו ותמצאו בו שימושי. אם יש לך שאלות או הצעות, אנא אל תהסס לפנות אלינו.</p>\r\n\r\n\r\n\r\n\r\n\r\n<h2 dir=\"RTL\" style=\"text-align: center;\"><a name=\"_s1txd5i7zqk2\"></a>מגוון עצום של כלים ותוכנות שיעזרו לכם להגיע לתוצאות נוספות באינטרנט</h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align: center;\">Digitalplanet.co.il הוא אתר חדש המציע כלי שיווק דיגיטליים, כלי SEO, כלי פיתוח אתרים ותוכנות למעצבים דיגיטליים. אתר זה מספק למשתמשים מגוון עצום של כלים ותוכנות שיעזרו להם להשיג יותר תוצאות באינטרנט.</p>\r\n\r\n<h2 dir=\"RTL\" style=\"text-align: center;\"><a name=\"_1x1ljpu165q0\"></a>רק ב-DigitalPlanet.co.il תוכלו ליהנות מהנחות בלעדיות על כל התוכנות והכלים לשיווק דיגיטלי</h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align: center;\">מחפשים הנחות בלעדיות על תוכנות וכלים לשיווק דיגיטלי? אל תחפש רחוק יותר מ-DigitalPlanet.co.il. האתר החדש שלנו מציע הנחות על מגוון רחב של מוצרים, מכלי SEO ועד תוכנות לפיתוח אתרים. בנוסף, אנו מציעים מגוון שירותים אחרים שבטוח ימשכו מעצבים דיגיטליים. בין אם אתה מחפש חנות אחת לכל הצרכים הדיגיטליים שלך או סתם רוצה לנצל את המבצעים הנהדרים שלנו, אנחנו מכוסים אותך. אז למה אתה מחכה? בדוק אותנו היום!</p>\r\n\r\n<h2 dir=\"RTL\" style=\"text-align: center;\"><a name=\"_kwq3wyc8j5fb\"></a>האתר מתעדכן על בסיס יומי</h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align: center;\">אנו נרגשים להציג את האתר החדש שלנו, DigitalPlanet.co.il, שעמוס בטונות של משאבים נהדרים עבור משווקים דיגיטליים, מפתחי אתרים ומעצבי תוכנה.<br>האתר מתעדכן על בסיס יומי, אז הקפד לבדוק שוב לעתים קרובות לקבלת הכלים והטיפים העדכניים והטובים ביותר!</p>\r\n\r\n\r\n\r\n<h2 dir=\"RTL\" style=\"text-align: center;\"><a name=\"_gu5hgmbb51e9\"></a>מתחם VIP עם כלים בלעדיים רק לחברי המועדון שלנו</h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align: center;\">אנו נרגשים להציג את האתר החדש שלנו, DigitalPlanet.co.il! זוהי התחנה האחת לכלי שיווק דיגיטליים, כלי SEO, כלי פיתוח אתרים ותוכנות למעצבים דיגיטליים.<br>יש לנו אזור VIP באתר שלנו עמוס בכלים בלעדיים שזמינים רק לחברי המועדון שלנו. אז אם אתה מחפש יתרון על המתחרים שלך, הקפד להירשם לחברות עוד היום!</p>\r\n\r\n\r\n\r\n<h2 dir=\"RTL\" style=\"text-align: center;\"><a name=\"_al527pd1ji3h\"></a>רוצה לפרסם את הכלים או התוכנה שלך באתר האינטרנט שלנו? צור קשר</h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align: center;\">DigitalPlanet.co.il הוא האתר החדש לכלי שיווק דיגיטליים, כלי SEO, כלי פיתוח אתרים ותוכנות למעצבים דיגיטליים. אנו מציעים מגוון רחב של כלים ותוכנות שיעזרו לך עם צרכי השיווק הדיגיטלי שלך, קידום אתרים ופיתוח אתרים. אם יש לך כלי או תוכנה שלדעתך יהיו מועילים עבור המשתמשים שלנו, אנא צור איתנו קשר ונשמח לשקול אותם להכללה באתר האינטרנט שלנו.</p>\r\n</div>\r\n\r\n<p> </p>\r\n</div>\r\n<div class=\"wojo-grid\" bis_skin_checked=\"1\">\r\n  <div class=\"row gutters\" bis_skin_checked=\"1\">\r\n    <div class=\"columns screen-25 mobile-50 phone-100\" bis_skin_checked=\"1\">\r\n      <div class=\"wojo card center aligned\" bis_skin_checked=\"1\">\r\n        <div class=\"content\" bis_skin_checked=\"1\">\r\n          <img src=\"[SITEURL]/uploads/images/vip.png\" class=\"wojo normal inline image\" data-image=\"a521m5u6mt3j\">\r\n          <div class=\"wojo big space divider\" bis_skin_checked=\"1\"></div>\r\n          <h3>מועדון הוי איי פי<br></h3>\r\n          <p class=\"wojo small text\">רוצים לקבל גישה לכלים ותוכנות אקסלוסיביים? הצטרפו כעת למועדון הVIP של אתר דיגיטל פלאנט</p>\r\n        </div>\r\n      </div>\r\n    </div>\r\n    <div class=\"columns screen-25 mobile-50 phone-100\" bis_skin_checked=\"1\">\r\n      <div class=\"wojo card center aligned\" bis_skin_checked=\"1\">\r\n        <div class=\"content\" bis_skin_checked=\"1\">\r\n          <img src=\"[SITEURL]/uploads/images/information(1).png\" class=\"wojo normal inline image\" data-image=\"mgaq0xu7h1g4\">\r\n          <div class=\"wojo big space divider\" bis_skin_checked=\"1\"></div>\r\n          <h3>מידע לאנשי דיגיטל</h3>\r\n          <p class=\"wojo small text\">כל מה שאיש דיגיטל צריך לדעת נמצא באתר שלנו, כולל: תוכנות, כלים, אפליקציות ותוכן למינוף ומקסום הביצועים שלכם בדיגיטל<br></p><p></p>\r\n        </div>\r\n      </div>\r\n    </div>\r\n    <div class=\"columns screen-25 mobile-50 phone-100\" bis_skin_checked=\"1\">\r\n      <div class=\"wojo card center aligned\" bis_skin_checked=\"1\">\r\n        <div class=\"content\" bis_skin_checked=\"1\">\r\n          <img src=\"[SITEURL]/uploads/images/download(1).png\" class=\"wojo normal inline image\" data-image=\"ea05bktxu5n1\">\r\n          <div class=\"wojo big space divider\" bis_skin_checked=\"1\"></div>\r\n          <h3>גישה לכלים חינמיים</h3>\r\n          <p class=\"wojo small text\">רק אצלנו תוכלו גם להוריד ולקבל כלים ותוכנות שהם לגמרי בחינם! פשוט בקרו באיזור החינמי המופיע בתפריט<br></p><p></p>\r\n        </div>\r\n      </div>\r\n    </div>\r\n    <div class=\"columns screen-25 mobile-50 phone-100\" bis_skin_checked=\"1\">\r\n      <div class=\"wojo card center aligned\" bis_skin_checked=\"1\">\r\n        <div class=\"content\" bis_skin_checked=\"1\">\r\n          <img src=\"[SITEURL]/uploads/images/coupon(1).png\" class=\"wojo normal inline image\" data-image=\"r61kyhsl1r90\">\r\n          <div class=\"wojo big space divider\" bis_skin_checked=\"1\"></div>\r\n          <h3>קופונים בלעדיים</h3>\r\n          <p>בדיגיטל פלאנט תוכלו לקבל קופונים בלעדיים לתוכנות ולכלים המובילות בעולם! תציצו בעמודי המוצר בלשונית \"קופונים\"</p><p></p>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"wojo segment homebanner\" bis_skin_checked=\"1\">\r\n  <div class=\"center aligned\" bis_skin_checked=\"1\">\r\n    <div class=\"wojo-grid\" bis_skin_checked=\"1\">\r\n      <p class=\"wojo white big thin text\">הצטרפו למועדון הוי איי פי שלנו וקבלו גישה לתכנים, כלים ותוכנות אקסלוסיביים שיקחו אתכם לשלב הבא בדיגיטל!<br>מאגר הVIP שלנו מתעדכן אחת לשבוע לכן כדי להשאיר מנויים על בסיס קבוע :)<br><br>המחירים הינם החל מ29.99 ש\"ח לחודש ללא הגבלת הורדות.</p>\r\n      <a href=\"[SITEURL]/content/vip/\" class=\"wojo transparent button\">\r\n      הצטרף למועדון הVIP שלנו</a></div>\r\n  </div>\r\n</div>', 'home', NULL, 'כלי שיווק, תוכנות לאנשי דיגיטל, כלים לשיווק בדיגיטל, כלים למקדמי אתרים, חברות אחסון ודומיינים', 'דיגיטל פלאנט הינו האתר של אנשי הדיגיטל בישראל, באתר תוכלו למצוא את כל הכלים, התוכנות והתכנים הטובים ביותר לשדרוג מערך השיווק שלכם.', '2017-05-31 02:02:47', 1),
(7, 'אודותינו', 'about-us', '<h1><strong>הכירו את DigitalPlanet.co.il, האתר החדש לכלי שיווק דיגיטלי, כלי קידום אתרים, כלי פיתוח אתרים ותוכנה למעצבים דיגיטליים</strong></h1>\r\n<p>DigitalPlanet.co.il הוא אתר חדש לגמרי המציע מגוון רחב של כלי שיווק דיגיטלי, SEO, פיתוח אתרים ועיצוב הכל במקום אחד. בין אם אתה מקצוען ותיק או רק בתחילת הדרך בעולם הדיגיטלי, באתר זה יש משהו לכולם. עיין ברשימה המקיפה שלנו של תכונות למטה!</p>\r\n<h2><strong>אתר ראשון מסוגו בישראל עם כל הכלים הדיגיטליים לאנשים דיגיטליים</strong></h2>\r\n<p>ברוכים הבאים לאתר החדש לכלי שיווק דיגיטליים, כלי SEO, כלי פיתוח אתרים ותוכנות למעצבים דיגיטליים – DigitalPlanet.co.il!</p>\r\n<p>באתר שלנו תמצאו את כל מה שאתם צריכים כדי להפוך את העבודה שלכם בעולם הדיגיטלי לקלה ויעילה יותר. אספנו את כל הכלים והתוכנות הטובות ביותר במקום אחד, כך שלא תצטרכו לבזבז זמן בחיפוש אחריהם באתרים שונים.</p>\r\n<p>במדור הבלוג שלנו תמצאו טיפים וטריקים כיצד להשתמש בכלים השונים, וכן מאמרים על מגמות עדכניות בעולם הדיגיטלי. הישאר מעודכן בחדשות וההתפתחויות האחרונות בתחום, ולמד כיצד להשתמש בהן לטובתך.</p>\r\n<p>אנו מקווים שתיהנו מהאתר שלנו ותמצאו בו שימושי. אם יש לך שאלות או הצעות, אנא אל תהסס לפנות אלינו.</p>\r\n<h2><strong>מגוון עצום של כלים ותוכנות שיעזרו לכם להגיע לתוצאות נוספות באינטרנט</strong></h2>\r\n<p>Digitalplanet.co.il הוא אתר חדש המציע כלי שיווק דיגיטליים, כלי SEO, כלי פיתוח אתרים ותוכנות למעצבים דיגיטליים. אתר זה מספק למשתמשים מגוון עצום של כלים ותוכנות שיעזרו להם להשיג יותר תוצאות באינטרנט.</p>\r\n<h2><strong>רק ב-DigitalPlanet.co.il תוכלו ליהנות מהנחות בלעדיות על כל התוכנות והכלים לשיווק דיגיטלי</strong></h2>\r\n<p>מחפשים הנחות בלעדיות על תוכנות וכלים לשיווק דיגיטלי? אל תחפש רחוק יותר מ-DigitalPlanet.co.il. האתר החדש שלנו מציע הנחות על מגוון רחב של מוצרים, מכלי SEO ועד תוכנות לפיתוח אתרים. בנוסף, אנו מציעים מגוון שירותים אחרים שבטוח ימשכו מעצבים דיגיטליים. בין אם אתה מחפש חנות אחת לכל הצרכים הדיגיטליים שלך או סתם רוצה לנצל את המבצעים הנהדרים שלנו, אנחנו מכוסים אותך. אז למה אתה מחכה? בדוק אותנו היום!</p>\r\n<h2><strong>האתר מתעדכן על בסיס יומי</strong></h2>\r\n<p>שלום!</p>\r\n<p>אנו נרגשים להציג את האתר החדש שלנו, DigitalPlanet.co.il, שעמוס בטונות של משאבים נהדרים עבור משווקים דיגיטליים, מפתחי אתרים ומעצבי תוכנה.</p>\r\n<p>האתר מתעדכן על בסיס יומי, אז הקפד לבדוק שוב לעתים קרובות לקבלת הכלים והטיפים העדכניים והטובים ביותר!</p>\r\n<h2><strong>מתחם VIP עם כלים בלעדיים רק לחברי המועדון שלנו</strong></h2>\r\n<p>שלום!</p>\r\n<p>אנו נרגשים להציג את האתר החדש שלנו, DigitalPlanet.co.il! זוהי התחנה האחת לכלי שיווק דיגיטליים, כלי SEO, כלי פיתוח אתרים ותוכנות למעצבים דיגיטליים.</p>\r\n<p>יש לנו אזור VIP באתר שלנו עמוס בכלים בלעדיים שזמינים רק לחברי המועדון שלנו. אז אם אתה מחפש יתרון על המתחרים שלך, הקפד להירשם לחברות עוד היום!</p>\r\n<h2><strong>רוצה לפרסם את הכלים או התוכנה שלך באתר האינטרנט שלנו? צור קשר</strong></h2>\r\n<p>DigitalPlanet.co.il הוא האתר החדש לכלי שיווק דיגיטליים, כלי SEO, כלי פיתוח אתרים ותוכנות למעצבים דיגיטליים. אנו מציעים מגוון רחב של כלים ותוכנות שיעזרו לך עם צרכי השיווק הדיגיטלי שלך, קידום אתרים ופיתוח אתרים. אם יש לך כלי או תוכנה שלדעתך יהיו מועילים עבור המשתמשים שלנו, אנא צור איתנו קשר ונשמח לשקול אותם להכללה באתר האינטרנט שלנו.</p>', 'normal', NULL, '', '', '2022-09-01 03:55:06', 1),
(3, 'שאלות ותשובות', 'faq', '<p style=\"direction: rtl;\"><strong>- על מה האתר שלכם מדבר ומה אני יכול למצוא כאן?</strong><br>+ אתר דיגיטל פלאנט נוצר על מנת לספק לאנשי דיגיטל כגון: קמפיינרים, מנהלי סוכנויות שיווק דיגיטלים, מקדמי אתרים, אנשי עיצוב וכדומה לקבל מידע על כל הכלים והתוכנות הכי מתקדמות ופופולאריות למקסום ביצועים ויעילות בפרויקטים שלהם. <strong><br><br>- האם אני מקבל הנחה על הכלים והתוכנות שאתם מפרסמים?</strong><br>+ בוודאי רוב השירותים שלנו כוללים הנחות וקופונים בלעדיים<strong><br><br>- ראיתי שיש לכם איזור VIP מזה בדיוק אומר?</strong><br>+ איזור הוי איי פי שלנו נועד לפרסום של תוכנות וכלים אקסלוסיביים והם זמינים ב3 רמות: וי איי פי בסיסי, וי איי פי מתקדם, וי איי פי פרימיום. כל רמה מאפשרת לגולשים להוריד סוג אחר של תוכנות וכלים.<br>המחירים עבור המנוי הם בעלות חודשית.<strong><br><br>- יש לי כלי או תוכנה שאשמח לפרסם באתר שלכם! איך אפשר לעשות זאת?</strong><br>+ בשמחה! אם זה מתאים אנחנו נוכל לפרסם את המוצר או השירות שלך אצלנו באתר.. ניתן לפנות אלינו במייל support@digitalplanet.co.il לפרטים נוספים<strong><br><br>- אני איש שיווק דיגיטלי מתחיל אשמח להתייעץ איתכם במטרה להבין איזה כלים הכי מתאים עבורי האם זה אפשרי?</strong><br>+ כמובן אנחנו מספקים ייעוץ מקצועי (בעלות שעתית) למגוון רחב של סוכנויות ומשרדי פרסום דיגיטלים. צרו איתנו קשר במייל support@digitalplanet.co.il ונשמח לעזור :)<strong><br><br>- האם אפשר לקנות אצלכם מאמר אורח עם קישור לאתר שלי?</strong><br>+ כן! להצעת מחיר עבור זה צרו איתנו קשר במייל שמופיע בתשובה כאן למעלה ונשמח לעזור.</p>', 'faq', NULL, 'שאלות ותשובות', 'בעמוד זה תוכלו למצוא שאלות ותשובות של גולשים בהקשר לאתר דיגיטל פלאנט', '2017-05-11 02:02:54', 1),
(4, 'צרו איתנו קשר', 'contact-us', '<p class=\"center aligned\">ניתן ליצור איתנו קשר ישיר באמצעות אחת מהדרכים הבאות</p>\r\n<div class=\"row grid phone-1 mobile-2 tablet-2 screen-2 big gutters\">\r\n  <div class=\"columns\">\r\n    <i class=\"icon primary large map marker\"></i>\r\n    <div class=\"wojo big space divider\"></div>\r\n    <h4>כתובתנו</h4>\r\n    <div class=\"wojo big space divider\"></div>\r\n    <p>דיזינגוף 1, תל אביב<br>\r\n      ישראל</p>\r\n  </div>\r\n  <div class=\"columns\">\r\n    <i class=\"icon primary large phone\"></i>\r\n    <div class=\"wojo big space divider\"></div>\r\n    <h4>טלפון</h4>\r\n    <div class=\"wojo big space divider\"></div>\r\n    <p> +972549088009<br></p>\r\n  </div>\r\n  <div class=\"columns\">\r\n    <i class=\"icon primary large email\"></i>\r\n    <div class=\"wojo big space divider\"></div>\r\n    <h4>כתובת מייל</h4>\r\n    <div class=\"wojo big space divider\"></div>\r\n    <p>support@digitalplanet.co.il<br><br></p>\r\n  </div>\r\n  <div class=\"columns\">\r\n    <i class=\"icon primary large clock\"></i>\r\n    <div class=\"wojo big space divider\"></div>\r\n    <h4>שעות פעילות</h4>\r\n    <div class=\"wojo big space divider\"></div>\r\n    <p>ימי א\' עד ה\' בין השעות:<br>9:00 - 17:30</p>\r\n  </div>\r\n</div>', 'contact', NULL, '', '', '2017-05-20 02:02:58', 1),
(5, 'תקנון ותנאי שימוש', 'privacy-policy', '<h1>תקנון ותנאי שימוש באתר</h1>\r\n<h5>ברוכים הבאים לאתר דיגיטל פלאנט אשר כתובתו <a href=\"https://bot.getboost.co.il/\"></a><a href=\"[SITEURL]/\">[SITEURL]/</a> (להלן: \"האתר\"), האתר מופעל על ידי גט בוסט   GET BOOST ע.מ 301377628</h5>\r\n<h6>תנאי שימוש אלה (להלן : \"התנאים ו/או תנאי השימוש\") מגדירים את הזכויות והחובות בעת השימוש באתר, נא קראו תנאים אלה בקפידה, מפני שהם מהווים הסכם מחייב בינך לבין מפעיל האתר.</h6>\r\n<h6>השימוש באתר מעיד על הסכמתך לתנאים אלה. התנאים מנוסחים בלשון זכר מטעמי נוחות בלבד והן מתייחסים כמובן גם לנשים.</h6>\r\n<h6>תנאים אלה חלים על השימוש באתר ובשירותים הכלולים בו באמצעות כל מכשיר תקשורת (כדוגמת טלפון סלולארי, מחשב כף יד וכו\'). כמו כן הם חלים על השימוש באתר, בין באמצעות רשת האינטרנט ובין באמצעות כל רשת או אמצעי תקשורת אחרים.</h6>\r\n<p></p>\r\n<h3>כללי</h3>\r\n<ul>\r\n<li> בכפוף לתנאי השימוש, המונח \"משתמש\" משמעו כל אדם אשר עושה שימוש באתר זו בכל דרך וצורה שהיא (להלן: \"המשתמש\").</li>\r\n<li> ככל ואינך מסכים לתנאי מתנאי השימוש, הנך מתבקש לא לעשות כל שימוש באתר.</li>\r\n<li> הוראות תנאי השימוש גוברות על כל האמור באתר.</li>\r\n<li> תקנון זה יהא מחייב ויפעל לטובת הצדדים, נציגיהם, יורשיהם וכל נציג מורשה אחר שלהם.</li>\r\n<li> מפעיל האתר זוקף לזכותו את הזכות לשנות את תנאי השימוש באתר ללא כל הודעה מוקדמת למשתמשים בו ולא יהיה בכך בכדי לגרוע מתוקפו של תנאי השימוש ותחולתם.</li>\r\n<li> כותרות הפרקים מובאות לשם נוחות והתמצאות בלבד ולא ישמשו בפרשנות תנאי השימוש.</li>\r\n<li> האתר מציע למשתמשיו שירותים כגון ולרבות קניית עוקבים ברשתות חברתיות, קניית לייקים, תגובות וצפיות(להלן : \"השירותים/הקורס\").</li>\r\n</ul>\r\n<h3>התכנים באתר</h3>\r\n<ul>\r\n<li> התכנים מוצעים למשתמש הם לשימוש אישי ושאינו מסחרי ובהיקף המותר על-פי כללי השימוש ההוגן לפי דין.</li>\r\n<li> התכנים מוצעים למשתמש צפייה בהשאלה בלבד, לשימוש אישי ושאינו מסחרי.</li>\r\n</ul>\r\n<h3>הגבלת אחריות מצד מפעיל האתר</h3>\r\n<ul>\r\n<li> מפעיל האתר לא יהיה אחראי לאמיתות ודיוקם של התכנים אשר מוצגים באתר, בין בתכנים אשר שייכים למפעיל האתר ו/או תכנים אשר שייכים לצד ג\'.</li>\r\n<li> מפעיל האתר לא יהיה אחראי לכל נזק מכל סוג שלא יהיה אשר נגרם ו/או ייגרם למשתמש ו/או לצד ג\' בגין התכנים המוצגים באתר.</li>\r\n<li> על המשתמש ו/או צד ג\' כלשהו אשר סבור כי תוכן מסוים גורם או עלול לגרום לו נזק, יש לפנות למפעיל האתר ולהתריע בפניו על כך, לאחר מכן מפעיל האתר יבדוק את הנושא וייתכן כי יסיר את התוכן במידה ויראה לנכון לעשות כן, אין באמור בכדי להשית אחריות על מפעיל האתר ויודגש כי מפעיל האתר איננו אחראי ולא יהיה אחראי לכל סכסוך ו/או נזק אשר יוצר בגין שימוש באתר ובתכניו.</li>\r\n<li> מפעיל האתר לא יהיה אחראי להתקשרות המשתמש עם מפרסמים באתר.</li>\r\n<li> האתר וכל המוצג בו ניתנים לשימוש ללא אחריות מכל סוג שהיא, מפורשת או משתמעת.</li>\r\n<li> האתר מוצע לציבור \"כמות שהוא\" (\"As Is\").</li>\r\n<li> מפעיל האתר לא יישא באחריות להתאמת האתר לצורכי המשתמש, וכן לאי יכולת להשתמש בשירותים באמצעות האתר, כמפורט לעיל.</li>\r\n<li> המשתמש מצהיר כי הוא משחרר בזאת את מפעיל האתר מכל אחריות, במישרין או בעקיפין, לכל מקרה שבו ביצוע עסקה ו/או גלישה באתר לא יבוצעו, בחלקן ו/או במלואן, מכל סיבה שהיא ומאחריות לכל בעיה טכנית ו/או אחרת הפוגמת ביכולת השימוש באתר.</li>\r\n<li> מפעיל האתר בודק את התכנים שהוא מעלה לאתר, ועושה את מירב המאמצים על מנת להקפיד על איכותם ועל איכות התוכן המופיע בהם, עם זאת, מפעיל האתר אינו יכול להתחייב כי כלל התכנים יתאימו במלואם או יספקו במלואם את ציפיות המשתמש, ואו כי לא תהיה בהם טעות כלשהי (בין טכנית ובין באשר לתוכן המוצג), ואו כי יתאימו באופן מוחלט לערכיו של כל משתמש, משכך, מפעיל האתר ואו מי מטעמו לא יהיו אחראים, ולא יישאו, במישרין או בעקיפין, בכל נזק, ישיר, עקיף, תוצאתי או מיוחד, כספי או אחר, שנגרם למשתמשרוכש או לצד שלישי כלשהו עקב או כתוצאה מצפייה ואו הסתמכות על תכנים שמופיעים באתר, לרבות פגיעה ברגשות, עוגמת נפש, הפסד הכנסה ואו מניעת רווח שייגרמו מכל סיבה שהיא.</li>\r\n<li> מפעיל האתר אינו מתחייב שהשירות הניתן באתר לא יופרע, יינתן כסדרו ללא הפסקות והפרעות ואו יהא חסין מפני גישה לא חוקית למחשבי האתר, נזקים, קלקולים, תקלות, כשלים בחומרה, תוכנה או בקווי התקשורת אצל האתר או מי מספקיו או ייפגע מכל סיבה אחרת, ולא תהיה אחראית לכל נזק ישיר או עקיף, עגמת נפש וכיוצא בכך שייגרמו למשתמש או לרכושו עקב כך.</li>\r\n<li> מבלי לפגוע בכל האמור לעיל, לא יישא מפעיל האתר בסכום נזק העולה על מחיר השירותים אשר הוזמנו ושולמו עד אותה עת על-ידי המשתמש.</li>\r\n</ul>\r\n<h3>הצהרת המשתמש וזכות השימוש באתר</h3>\r\n<ul>\r\n<li> המשתמש מתחייב לעשות שימוש באתר בכפוף לתנאי השימוש ומצהיר כי הוא יודע שהאתר וכל המובא בו אינו מהווה תחליף לייעוץ משפטי ו/או תחליף לייעוץ מכל סוג שהוא.</li>\r\n<li> מפעיל האתר עושה מאמצים רבים לרכז ולעבד את התכנים בדיוק המרבי, אך יתכן שבתהליך קליטתם, עיבודם ופרסומם יהיו טעויות, אם ברצון המשתמש להשתמש בתכנים אלה, עליו לבדוק אותם ולאמתם, אין בפרסומם משום המלצה או חוות דעת ולכן כל החלטה בדבר השימוש בתכנים שתמצא באתר תעשה על אחריות המשתמש בלבד.</li>\r\n<li> התקנון מהווה חוזה מחייב בין המשתמש לבין מפעיל האתר והינו הבסיס להתדיינות המשפטית ככל שתהיה בנוגע לשימוש באתר.</li>\r\n<li> על-מנת ליהנות מהשירותים המוצעים באתר, באחרית הלקוח לדאוג לחיבור רציף ומהיר של מכשיר הצפייה לרשת האינטרנט.</li>\r\n</ul>\r\n<h3>הזנת פרטים בעת רכישת שירותים באתר</h3>\r\n<ul>\r\n<li> כל משתמש אשר ירכוש שירותים באתר יחויב להזין את שם המשתמש שלו ברשת החברתית ו/או להזין קישור לפרופיל שלו, פרטי אשראי, שם מלא ות.ז.</li>\r\n<li> עליך למסור רק פרטים נכונים, מדויקים ומלאים ואתה מאשר בזאת את נכונות הפרטים שמסרת. הנתונים שמסרת יישמרו על ידי מפעיל האתר.</li>\r\n<li> פרטים שגויים ו/או אי מסירת מלוא הפרטים הנדרשים עלולים למנוע ממך את האפשרות להשתמש בשירותי הרכישה באתר.</li>\r\n</ul>\r\n<h3>תנאי סף לביצוע עסקה ו/או רכישה באתר</h3>\r\n<ul>\r\n<li> מערכת האתר מאפשרת למשתמשיה רכישה נוחה, קלה ובטוחה של השירותים המוצעים על ידי האתר באמצעות האינטרנט.</li>\r\n<li> כל משתמש רשאי להשתתף בהליך רכישה של השירותים ולהפוך ללקוח במערכת בכפוף למילוי התנאים המצטברים המפורטים להלן:</li>\r\n<li> המשתמש הנו בעל כרטיס האשראי ו/או אמצעי התשלום והינו מעל גיל 16.</li>\r\n<li> במידה והנך מתחת לגיל 16 או אינך זכאי לבצע פעולות משפטיות ללא אישור אפוטרופוס, יראו את שימושך באתר כאילו קיבלת את אישור האפוטרופוס לביצוע העסקה.</li>\r\n<li> המשתמש הנו בעל תעודת זהות ישראלית תקפה או תאגיד המאוגד והרשום כדין בישראל.</li>\r\n<li> המשתמש הנו בעל כרטיס אשראי ישראלי או בינלאומי תקף.</li>\r\n<li> המשתמש הוא בעל תא דואר אלקטרוני ברשת האינטרנט.</li>\r\n<li> הרכישה באתר הינה באמצעות כרטיס אשראי ו/או חשבון PAY PAL בלבד והעסקה תתבצע לאחר אישורה ע\"י חברת האשראי.</li>\r\n<li> יודגש כי בעת מסירת פרטי האשראי, תועבר לאתר של חברת הסליקה אשר עמה יעבוד מפעיל האתר (להלן: \"חברת הסליקה\").</li>\r\n<li> ייתכן כי לצורך תהליך השלמת הרכישה לאחר הזנת פרטי כרטיס האשראי למערכת של חברת הסליקה, תידרש לאמת את זהותך ע\"י קוד שיישלח אליך בהודעת SMS או במייל חוזר או בדרכים נוספות אותן רשאית חברת הסליקה לשנות מעת לעת.</li>\r\n<li> יודגש כי פרטי כרטיס האשראי יהיו מצויים ו/או יישמרו ו/או ינוהלו ע\"י חברת הסליקה בלבד ובאחריותה בלבד, מפעיל האתר אינו שומר ו/או מנהל פרטים אלו עם זאת, כאשר מידע ותכנים מוזנים באמצעות האתר, קיים חשש לחשיפה של תכני המשתמש לצפייה ולשימוש על-ידי אחרים ברשת, מפעיל האתר אינו אחראי לאבטחתם ואו לכל נזק ואו אובדן ואו הפסד ואו הוצאה שייגרמו למשתמש ואו לצד שלישי כלשהו כתוצאה מכך ולמפעיל האתר אין ולא תהיה כל אחריות בנוגע לדליפת נתונים ו/או פריצה לנתונים ו/או לאבטחת מידע של נתונים אלו.</li>\r\n<li> על אף האמור לעיל, מפעיל האתר שומר לעצמו את הזכות לקבוע הסדרי תשלומים ו/או אמצעי תשלום אחרים ככל שיבחר לפי שיקול דעתו הבלעדי, לרבות הסדרים לתשלום באמצעים שונים מכרטיס אשראי.</li>\r\n<li> מפעיל האתר שומר לעצמו את הזכות להפסיק ו/או לשנות את דרך התשלומים באתר לפי שיקול דעתו הבלעדי ובכל עת כפי שיראה לו.</li>\r\n<li> המשתמש מצהיר בזאת שהפרטים האישיים שהוא מוסר לאתר או עושה בהם שימוש במסגרת האתר הינם פרטים נכונים, מדויקים, עדכניים ומלאים לגבי זהותו האישית.</li>\r\n<li> חל איסור מוחלט לעשות שימוש בפרטים אישיים של אדם אחר ו/או להתחזות לאחר.</li>\r\n</ul>\r\n<h3>השירותים הניתנים באתר , תנאי ותהליך רכישתם</h3>\r\n<ul>\r\n<li> רכישת השירותים באתר כפופה לכל רשת חברתית ו/או כל רשת אחרת אשר תוצג באתר למדיניות ולתנאים של אותה רשת, כגון: אינסטגרם, פייסבוק, יו טיוב וכו\'.</li>\r\n<li>רכישת עוקבים \"איכותיים\" באתר גט בוסט ישראל כלולה באחריות למשך Lifetime.</li>\r\n<li>רכישות מסוג עוקבים אינם כלולים באחריות החברה כאשר הלקוח משנה את שם המשתמש שלו. החברה לא תהיה אחראית במצב שהועקבים ירדו לאחר אספקה לשם המשתמש שמצויין בהזמנה בלבד.</li>\r\n<li> ברכישת השירותים, הפרופילים של המשתמש באינסטגרם, פייסבוק, יו טיוב וכו\' חייבים להיות ציבוריים ולא פרטיים, אחרת לא ניתן יהיה לבצע את מתן השירותים, האחריות הינה על המשתמש בלבד.</li>\r\n<li> על המשתמש לעיין בתנאי השימוש של אותה רשת, להלן קישורים לתנאי השימוש של צדדי ג\':</li>\r\n<li> אינסטגרם: https://help.instagram.com/581066165581870</li>\r\n<li>https://www.paypal.com/il/webapps/mpp/ua/useragreement-full?locale.x=he_IL</li>\r\n</ul>\r\n<h5>תנאי רכישת \"בוט\" או \"רובוט\" לאינסטגרם</h5>\r\n<ul>\r\n<li> רכישת בוט לאינסטגרם אוו רובוט לאינסטגרם כשמו כן הוא, מאפשרת לנו לשלוט על פעולות וסוגי פעולות שונים מפרופיל האינסטגרם האישי של הלקוח.</li>\r\n<li> הרכישה הינה רכישה על בסיס מנוי חודשי ללא התחייבות מצד הלקוח אך יש לציין שחידוש החבילה מתבצע באופן אוטומטי.</li>\r\n<li> במידה והלקוח ידרוש לביטול שירותי ה\"בוט לאינסטגרם\" יש לשלוח אלינו בקשה מסודרת עם סיבת הביטול למייל support@digitalplanet.co.il</li>\r\n<li> הספק אינו אחראי לגרימת נזקים, חסימת חשבון האינסטגרם וכל פעולה אחרת שמתבצעת ע\"י הלקוח בשל עבודת ופעילות הבוט.</li>\r\n<li>במידה והלקוח מעוניין לדרוש שינויים ברמת הטרגוט והפילוח יש לשלוח מייל מסודר אל הכתובת support@digitalplanet.co.il</li>\r\n<li>זמן הקמה לבוט לאינסטגרם הינו עד 2 ימי עסקים ממועד ביצוע ההזמנה</li>\r\n<li>הספק רשאי לבטל את שירות הבוט ללקוח בהתאם לשיקוליו האישיים (פרופילים עם כתבי שנאה, פרופילים שאינם הולמים ברמת התוכן, תוכן פורנוגרפי, תוכן שקשור להימורים וכד\')</li>\r\n<li>לאחר רכישת הבוט יש לשלוח סיסמה לחשבון האינסטגרם למייל support@digitalplanet.co.il ואו החברה תפנה ללקוח על מנת לדרוש זאת.</li>\r\n<li>המידע האישי אותו ימסור הלקוח לאחר ביצוע ההזמנה ישאר דיסקרטי ומאובטח בשרתי החברה למטרת שימוש השירות בלבד.</li>\r\n</ul>\r\n<h5>תנאי רכישה כלליים לכל השירותים</h5>\r\n<ul>\r\n<li> מחירי השירותים הקובעים הינם המחירים אשר מוצגים ליד כל שירות.</li>\r\n<li>המחירים המצויינים באתר הם ללא מע\"מ מכיוון שהמוצר הוא מוצר בינלאומי</li>\r\n<li> מובהר בזאת, כי מפעיל האתר, יהא רשאי לעדכן את מחירי השירותים באתר מפעם לפעם ולפי שיקול דעתו הבלעדי.</li>\r\n<li> מובהר בזאת, כי במידה ועודכנו מחירי השירותים לפני תום הליך בחירת השירות על ידי המשתמש, תחויב לפי המחירים המעודכנים.</li>\r\n<li> מפעיל האתר רשאי לבטל עסקה במידה ונפלה באתר טעות קולמוס באשר לתיאור פריט תוכן ואו מחירו, או אם התברר כי הפעולה לוותה בפעילות בלתי חוקית, או פעילות המנוגדת לתקנון זה, מצד המשתמש ואו צד ג\'.</li>\r\n<li> מפעיל האתר שומר לעצמו את הזכות לבטל ואו שלא לתת לאדם כלשהו את הזכות לרכוש קורס ואו לבצע רכישות באתר בשל שימוש שלא כדין בשירותיו, הפרת תקנון זה ואו בגין אי תשלום עבור תכנים וקורסים שנרכשו.</li>\r\n</ul>\r\n<h3>ביטול עסקה</h3>\r\n<ul>\r\n<li> השירותים המוצעים באתר מהווים \"מידע\" כהגדרתו בחוק המחשבים, תשנ\"ה – 1995.</li>\r\n<li> בהתאם להוראות סעיף 14ג(ד) לחוק הגנת הצרכן, תשמ\"א – 1981 לרוכש לא עומדת הזכות לבטל עסקה ביחס ל\"מידע\" כהגדרתו הנ\"ל, לכן ברכישת השירותים באתר לא תהיה אפשרות לבטל את העסקה ולקבל החזר כספי.</li>\r\n<li> למרות האמור לעיל, מפעיל האתר שומר לעצמו את הזכות לבטל את העסקה במידה והשירותים טרם ניתנו אך הוא אינו מתחייב לכך והדבר נתון לשיקול דעתו הבלעדי.<br>במידה ומפעיל האתר יאשר את פעולת הזיכוי או הביטול העסקה, תהיינה כרוכה פעולה זו בדמי ביטול בסך של 20% מהסך הכולל של העסקה.</li>\r\n<li> המשתמש מצהיר כי לא תהיה לו כל טענהו/או דרישה בנימוק של אי התאמה של השירותים באתר וידוע לו כי על פי חוק, לא תתבצע החזרה או החלפה של שירותים הנחשבים למידע ו/או הניתנים להקלטה, שעתוק או שכפול, קרי לא יבוצע החזר כספי במקרה הנדון.</li>\r\n<li> מפעיל האתר רשאי להפסיק את השירותים המסופקים לרוכש באופן מוחלט או זמני, או להגבילם, בין היתר בכל מקרה בו המשתמש לא שילם במועד תשלום שהוא חב בו או אם ראה מפעיל האתר כי קיים חשש סביר שהרוכש לא יעמוד בתשלומים בעד השירותים ואו במקרה בו המשתמש הפר את תנאי ההתקשרות עמו לרבות הוראות תקנון זה.</li>\r\n</ul>\r\n<h3>קניין רוחני</h3>\r\n<ul>\r\n<li> כל זכויות הקניין הרוחני בתכנים המופיעים באתר, לרבות זכויות היוצרים, זכויות ההפצה, סודות מסחריים, סימני המסחר וכל הקניין הרוחני מכל סוג שהוא, אשר כוללים בין היתר את עיצוב האתר, תמונות, קבצים גרפיים, יישומים, קוד מחשב, טקסט ו/או עיצובו הגרפי של האתר, בסיסי הנתונים בו (לרבות רשימות המוצרים, תיאור המוצרים וכד\'), קוד המחשב של האתר וכל פרט אחר הקשור בהפעלתו ו/או כל חומר אחר, שייכות ל - דיגיטל פלאנט או לצד שלישי שהתיר לאתר לעשות בו שימוש.</li>\r\n<li> כמו כן אין להעתיק ו/או לבצע שימוש שלא כדין בשם \"גט בוסט\" בעברית ו-\"דיגיטל פלאנט\" באנגלית, וכן כל שילוב הדומה להם ו/או המכיל אחד מהם במלואו ו/או חלק מהם, וכמו כן בשם המתחם (domain name) של האתר, בסימני המסחר של דיגיטל פלאנט, בין אם רשומים ובין אם לא.</li>\r\n<li> אין בעצם הכניסה לאתר או ברכישה של תכנים בו כדי להעניק רישיון ואו זכות כלשהם בתכולת האתר ואו בחלק ממנו ואו בקוד האתר ואו בתכנים.</li>\r\n<li> אין להעתיק ו/או לשכפל באופן מלא או חלקי, להציג בפומבי, להפיץ, לבצע בפומבי, להעביר לרשות הציבור, לשנות, לעבד או ליצור יצירות נגזרות, למכור או להשכיר כל חלק מהתכנים הנ\"ל, בכל אמצעי ומדיה שהיא, ואו לפרסם ואו לשדר ואו להקרין פומבית ואו להשמיע פומבית ואו ליצור עבודות נגזרות, ואו להקצות ואו למסור כרישיון ואו לעשות כל שימוש מסחרי בחלק כלשהו באתר ואו בתכנים, במישרין או בעקיפין, לרבות בדרך של חיבור לציוד קליטה אחר (פיזי, אלחוטי, או בדרך אחרת), ובין בכל דרך אחרת בלי הסכמה בכתב ומראש מצד מפעיל האתר, חל איסור על כל שימוש בתכנים הנ\"ל ובסימני מסחר המופיעים באתר ו/או לוגו האתר ללא הרשאה ממפעיל האתר מראש ובכתב.</li>\r\n<li> האתר הינו לשימוש אישי ואין לעשות בו שימוש מסחרי, לרבות כל שימוש מסחרי בנתונים המתפרסמים באתר, בבסיס הנתונים, ברשימות המוצרים המופיעים בו ו/או בפרטים אחרים המתפרסמים באתר בלא קבלת הסכמתו של מפעיל האתר מראש ובכתב.</li>\r\n<li> אין להשתמש בנתונים כלשהם המתפרסמים באתר לצורך הצגתם באתר אינטרנט ו/או בשירות אחר כלשהו, בלא לקבל את הסכמתו של מפעיל האתר מראש ובכתב ובכפוף לתנאי אותה הסכמה, במידה ותינתן.</li>\r\n<li> אין להציג את האתר בתוך מסגרת (Frame) גלויה ו/או סמויה.</li>\r\n<li> אין להציג את האתר בעיצוב ו/או ממשק גרפי שונים מאלה שעיצב מפעיל האתר, אלא בכפוף לקבלת הסכמתו לכך מראש ובכתב.</li>\r\n<li> ככל שיש באתר חומרי קניין רוחני , לרבות סימני מסחר ומידע, תמונות, שרטוטים וכו\', שנמסרו לפרסום על ידי מפרסמים באתר ו/או כל צד ג\', מידע זה הוא רכושן של אותן צדדי ג\' ואין להשתמש בסימני מסחר ומידע זה בלא הסכמתן מראש ובכתב.</li>\r\n<li> המשתמש מתחייב שלא לפגוע בשום דרך בזכויות היוצרים של הנהלת האתר, בין אם באופן ישיר ובין אם באופן עקיף, בין בתמורה ובין שלא בתמורה.</li>\r\n<li> המשתמש מתחייב שלא לעשות כל פעולה, בין במישרין ובין בעקיפין, העלולה לפגוע בזכויות הקניין.</li>\r\n<li> כל שימוש הפוגע בזכויות היוצרים ו/או בקניין רוחני כמפורט לעיל, ישמש עילה לסגירת חשבון המשתמש ללא כל הודעה מוקדמת, והמשתמש יישא בכל ההוצאות אשר יגרמו למפעיל האתר ו/או ללקוחות האתר ו/או למשתמש עצמו בגין שימוש זה, ו/או בגין סגירת חשבון המשתמש, וזאת, מבלי לגרוע מכל סעד אחר המגיע למפעיל האתר מכוח הסכם ו/או מכוח הדין. חדירה למערכת המחשב של האתר מהווה עבירה פלילית על פי הדין החל בישראל.</li>\r\n<li> כמו כן יובהר ישנם תכנים אשר אינם שייכים בהכרח למפעיל האתר אלא ניתן למפעיל האתר רשות לבצע שימוש מסחרי בדרך של רישיון כדין.</li>\r\n<li> כל ס\' בהקשר של קניין רוחני כפי שהובא לעיל יחול ויהיה תקף אף לגבי תכנים אלו.</li>\r\n</ul>\r\n<h3>פרסומות של צדדים שלישיים, קישורים והפניות באתר</h3>\r\n<ul>\r\n<li> מפעיל האתר או מי מטעמו לא יישא באחריות לכל תוכן פרסומי או מידע מסחרי אחר שיפורסם באתר. הפרסום באתר אינו משום המלצה ו/או חוות דעת או הבעת דעה או עידוד או שידול, מצד מפעיל האתר ולמעשה כל החלטה בדבר השימוש בתכנים הכלכליים שימצא המשתמש באתר, תיעשה באחריותו הבלעדית של המשתמש בלבד.</li>\r\n<li> ייתכן כי באתר יופיעו קישורים ו/או הפניות לאתרי אינטרנט אחרים ו/או מקורות מידע ו/או לגופים ו/ או לארגונים ו/או לחברות אחרים (להלן: \"קישורים\").</li>\r\n<li> אין מפעיל האתר מתחייב כי כל הקישורים שימצאו באתר יהיו תקינים ויובילו לאתר אינטרנט פעיל.</li>\r\n<li> קישור מסוים באתר אינו מלמד כי תוכן האתר המקושר הינו מהימן, מלא או עדכני, ומפעיל האתר לא יישא בכל אחריות בקשר לכך.</li>\r\n<li> מפעיל האתר לא יהיה אחראי לתכנים, לנתונים או לאלמנטים ויזואליים שאליהם מוליכים הקישורים ואינו אחראי לכל תוצאה שתיגרם מהשימוש בהם או מהסתמכות עליהם.</li>\r\n<li> כל התקשרות בין המשתמש לבין צדדים שלישיים אליהם הקישורים מוליכים תעשה מול אותם צדדים שלישיים בלבד, באחריותו ו/או באחריותם בלבד, ולמפעיל האתר לא תהא כל אחריות ו/או מחויבות בקשר עם התקשרות כאמור.</li>\r\n<li> מפעיל האתר יהיה רשאי להסיר מהאתר קישורים שנכללו בו בעבר, או להימנע מהוספת קישורים חדשים - הכול, לפי שיקול דעתו המוחלט.</li>\r\n<li> אנו ממליצים למשתמש לקרוא בעיון את תנאי השימוש ומדיניות הפרטיות של אותם קישורים.</li>\r\n<li> מבלי לגרוע מן האמור, מפעיל האתר אינו אחראי לכל נזק - עקיף או ישיר - שייגרם למשתמש או לרכושו כתוצאה משימוש או הסתמכות על המידע והתכנים המופיעים באתרים שאליהם יגיע באמצעות או דרך שימוש או קישור הקיימים באתר ו/או בגין שימוש או הסתמכות על מידע ותכנים המתפרסמים באתר על ידי צדדים שלישיים.</li>\r\n</ul>\r\n<h3>הפסקת שימוש ושיפוי</h3>\r\n<ul>\r\n<li> מפעיל האתר רשאי, לפי שיקול דעתו, להפסיק פעילותו של כל משתמש בשירותי האתר, לרבות על ידי חסימת מספר IP וזאת אם לא יעמוד בתנאי מתנאי הסכם זה.</li>\r\n<li> במידה וחלה הפרה מצד המשתמש בנוגע לתנאי שימוש אלה, יהא מפעיל האתר, לפי שיקול דעתו, זכאית לחשוף את שמו והפרטים הידועים לו אודותיו בכל הליך משפטי, אף אם לא יינתן צו שיפוטי המורה על כך.</li>\r\n<li> המשתמש ישפה את מפעיל האתר, בגין כל טענה, תביעה ו/או דרישה ו/או נזק ו/או הפסד, אובדן רווח, תשלום או הוצאה, לרבות תשלומי ריבית ותשלום שכר טרחה סביר לעורכי דין והוצאות משפט , אשר ייגרמו למפעיל האתר ו/או למי מטעמו על ידי המשתמש כתוצאה מכך שהמשתמש לא יקיים הוראות תקנון זה ו/או יפר הוראות דין כלשהן ו/או זכויות צד ג\' כלשהן, ו/או כתוצאה מפרטים, מידע או קבצים שהמשתמש מסר לפרסום, ו/או כתוצאה ממחדליו של המשתמש, כפי שבאו לידי ביטוי באופן ישיר ו/או באופן עקיף.</li>\r\n<li> מפעיל האתר אינו מתחייב כי האתר לא ייסגר ו/או כי הפעילות בו לא תופסק באופן זמני או קבוע ושומר לעצמו את הזכות לסגור את האתר ו/או את פעילותו בכל עת על פי שיקול דעתו הבלעדי.</li>\r\n<li> מבלי לגרוע מהאמור לעיל, במידה וגורמים ו/או אירועים שאינם בשליטת מפעיל האתר, לרבות תקלות תקשורת ומחשוב ואירועי כוח עליון יעכבו ו/או ימנעו את קיום העסקה באופן מלא או באופן חלקי, ובדרך כלשהיא, ו/או את אספקת השירות נשוא העסקה במועדים שנקבעו, רשאי מפעיל האתר להודיע על ביטול הרכישה, כולה או חלקה ובמקרים כאמור לא יחויב כרטיס האשראי של המשתמש בגין העסקה ו/אם חויב – יוחזר לו כספו, בכפוף להוראות כל דין, וזאת כסעד בלעדי שלו בקשר עם מקרים כאמור.</li>\r\n</ul>\r\n<h3>המחאת זכויות וחובות</h3>\r\n<ul>\r\n<li> 12. המחאת זכויות וחובות מבלי לפגוע באמור לעיל מוסכם בזה, מפעיל האתר רשאי להמחאות את התחייבויותיו ולהסב זכויותיו, בכל עת לפי תנאי שימוש אלה, לצד שלישי, עפ\"י שיקול דעתו הבלעדי, לרבות העברת כל/רוב נכסיו, באמצעות מכירה, מיזוג, ו/או בכל דרך אחרת, וכן הנהלת האתר רשאית בעת העברת הזכות לגבות חובות מהמשתמש, ובלבד שזכויות המשתמש, לפי הסכם זה, לא ייפגעו מעצם העברת הבעלות.</li>\r\n<li> במקרה כנ\"ל יועברו פרטי המשתמש שבידי הנהלת האתר לצד השלישי, שיקבל את הזכויות באתר, והמשתמש מסכים לכך מראש.</li>\r\n</ul>\r\n<h3>שימושים אסורים</h3>\r\n<ul>\r\n<li> המשתמש מסכים שלא לעשות באתר כל שימוש שאינו חוקי וכן כל שימוש בניגוד לתנאים שלהלן, ובכלל זאת שימוש שעלול להביא לפגיעה או השבתה של האתר או לפגיעה בחוויית המשתמש של משתמשים אחרים באתר.</li>\r\n<li> המשתמש מסכים שלא להשיג או לנסות להשיג מידע או חומר הכלול באתר בכל אמצעי אחר מלבד האמצעים שמספק האתר למשתמשיו, וכן שלא לאסוף כל מידע על משתמשים אחרים ללא הסכמתם.</li>\r\n<li> המשתמש אינו רשאי להמחאות, להעניק ברישיון משנה או להעביר בדרך אחרת או בכל אופן שהוא, זכות כלשהי מזכויותיו או מהתחייבויותיו על פי הסכם זה ביוזמתו, אלא באישור מראש ובכתב של מפעיל האתר. מפעיל האתר מודיע בזאת כי מדיניותו היא להתנגד להמחאת זכויות וחובות של המשתמשים, ביוזמת המשתמשים, ועל כן קרוב לוודאי שלא יאשר בקשת לקוחות לעשות כך.</li>\r\n<li> המשתמש אינו רשאי לפגוע בשמו הטוב של מפעיל האתר ו/או במוניטין האתר ובשירותיו, חל איסור להפיץ דברי דיבה, לשון הרע ו/או להשמיץ בפומבי את מפעיל האת ו/או את האתר ו/או את שירותי האתר.</li>\r\n</ul>\r\n<h3>תנאים נוספים</h3>\r\n<ul>\r\n<li> המחירים המוצגים בשירותים, תנאי השימוש, מספר התשלומים וכל נתון נוסף ואחר הינם לשיקול דעתו הבלעדי של מפעיל האתר, אשר יהא רשאי לשנותם מעת לעת, ללא הודעה מוקדמת, לפי שיקול דעתו הבלעדי.</li>\r\n<li> השירות פועל ברשת האינטרנט ועל כן מטבע הדברים תלוי בגורמים שונים כגון ספקי תשתית, ספקי תקשורת, תקינות שרתים, אחסון וכיוצא באלו, אשר עשויים להינזק, להפסיק לפעול ולהיפגע עקב גורמים שונים. מפעיל האתר אינו נותן כל מצג או התחייבות לגבי תקינות פעילות האתר ו/או פעולתו ללא הפרעות ו/או תקלות ו/או יהיה חסין מפני גישה לא חוקית למחשבי השירות, נזקים, קלקולים, תקלות, כשלים בחומרה, תוכנה או בקווי התקשורת אצל השירות או מי מספקיה או ייפגע מכל סיבה אחרת, והשירות לא יהיה אחראי לכל נזק, ישיר או עקיף, עגמת נפש וכיו\"ב שייגרמו לך או לרכושך עקב כך.</li>\r\n<li> רישומי המחשב של האתר בדבר הפעולות המתבצעות דרך האתר יהוו ראיה לכאורה לנכונות הפעולות.</li>\r\n</ul>\r\n<h3>שירות לקוחות ויצירת קשר</h3>\r\n<ul>\r\n<li> שירות הלקוחות של האתר פעיל 24/7.</li>\r\n<li> פנייה לשירות הלקוחות תיעשה בצ\'אט באתר ו/או בדואר אלקטרוני לכתובת הנ\"ל: support@digitalplanet.co.il.</li>\r\n<li> הפנייה תיעשה תוך ציון הפרטים המלאים, והנהלת האתר מבטיחה לטפל בפניותיכם בזריזות וביעילות.</li>\r\n</ul>\r\n<h2>מדיניות פרטיות</h2>\r\n<h3>הזנת פרטים בעת רכישת השירותים</h3>\r\n<ul>\r\n<li> כל משתמש אשר ירכוש שירותים באתר יחויב להזין את שם המשתמש שלו ברשת החברתית, פרטי אשראי, שם מלא ות.ז.</li>\r\n<li> עליך למסור רק פרטים נכונים, מדויקים ומלאים ואתה מאשר בזאת את נכונות הפרטים שמסרת. הנתונים שמסרת יישמרו על ידי מפעיל האתר.</li>\r\n<li> פרטים שגויים ו/או אי מסירת מלוא הפרטים הנדרשים עלולים למנוע ממך את האפשרות להשתמש בשירותי הרכישה באתר.</li>\r\n</ul>\r\n<h3>אבטחת מידע באתר</h3>\r\n<ul>\r\n<li> מפעיל האתר דואג לכבד את פרטיות המשתמשים ומפעיל מערכות אבטחה לשם אבטחת המידע שנמסר על-ידיהם.</li>\r\n<li> על אף מאמצי אבטחת המידע לא קיימת ודאות מוחלטת כי המידע לא ייחשף במקרה של פריצה למערכות או שרתי האתר.</li>\r\n<li> המשתמש מסכים כי מפעיל האתר לא יישא בשום אחריות לחשיפת המידע בכל מקרה של פריצה למערכות האתר או לשרתיו ו/או במקרה של העתקת ו/או הורדת הקורסים ע\"י צדדי ג\' , המשתמש מוותר על כל דרישה, תביעה או טענה נגד מפעיל האתר בשל כך.</li>\r\n</ul>\r\n<h3>מאגרי מידע ושימוש במידע ע\"י מפעיל האתר</h3>\r\n<ul>\r\n<li> מפעיל האתר רשאי לשמור במאגריו מידע שנמסר באמצעות המשתמש.</li>\r\n<li> הנתונים שייאספו יישמרו במאגר המידע של מפעיל האתר ובאחריותו.</li>\r\n<li> מפעיל האתר יהא רשאי לעשות שימוש במידע בכפוף למדיניות פרטיות זו או על פי הוראות כל דין.</li>\r\n<li> השימוש במידע שנאסף ייעשה לצורך מתן השירותים המבוקשים על ידי המשתמש, לרבות ועל מנת: לאפשר להשתמש בשירותים שונים באתר ,לשפר ולהעשיר את השירותים והתכנים המוצעים בו, לשנות או לבטל שירותים ותכנים קיימים, לצורך רכישת מוצרים ושירותים באתרים - לרבות פרסום מידע ותכנים וכדי להתאים את המודעות שיוצגו בעת הביקור באתר לתחומי ההתעניינות של המשתמש ולצורך ניתוח ומסירת מידע סטטיסטי לצדדים שלישיים, לרבות מפרסמים.</li>\r\n<li> אנו עשויים לקבל חלק מהמידע האישי שלך על מנת לספק את השירותים שלנו. המידע שאנו אוספים נחוץ כדי לספק את השירותים שלנו, ולא נאסוף כל מידע שאינו נדרש על פי אופי השירותים שלנו. אנו רשאים לאסוף חלק מהמידע האישי הבא: כתובת דוא\"ל, שם משתמש באינסטגרם וכתובת IP.</li>\r\n<li> נאסוף את שם המשתמש שלך ב- Instagram כדי לספק את השירותים שלנו ולבצע את החובה החוזית שלנו. כאשר אתה בוחר להירשם לשירותים שלנו אנו אוספים את שם המשתמש שלך ב- Instagram.</li>\r\n<li> כתובת ה- IP : אנו משתמשים בכתובת ה- IP שלך על בסיס של אינטרס לגיטימי גם כדי לספק חשבונית עבור השירותים שלנו.</li>\r\n<li> חלק מהשירותים לא יהיו זמינים עבורך אם לא תספק את המידע המבוקש.</li>\r\n<li> איננו מוכרים או משכירים מידע אישי לכל צד שלישי. אנו משתמשים במידע שנאסף למטרותינו הפנימיות והשיווקיות, לפי הצורך על פי אופי השירותים, ורק בהתאם למדיניות פרטיות זו. במקרים מסוימים, אנו מחויבים לציית לצווי בית המשפט ולבקשות הממשלה ולמסור מידע או חלקים ממנו לגורמים המוסמכים.</li>\r\n<li> מפעיל האתר רשאי לשלוח למשתמש מדי פעם באמצעי התקשורת העומדים לרשותו, ובכלל זה בדואר אלקטרוני ו/או בהודעת מסר קצר (SMS) ו/או באמצעות הודעות מתפרצות (notifications) מידע בדבר שירותיו, וכן מידע שיווקי ופרסומי - הן מידע שהוא עצמו יפרסם והן מידע שיישלח מטעם מפרסמים אחרים, בין אם יישלח על-ידי מפעיל האתר ובין אם יישלח על-ידי מפרסמים אחרים. מידע כזה ישלח למשתמש, בהתאם לחוק, אם נתן הסכמה מפורשת לכך, ובכל עת יוכל לבטל את הסכמתו ולחדול מקבלתו בפנייה לשירות הלקוחות של החברה ו/או בפנייה לדואר האלקטרוני של החברה support@digitalplanet.co.il.</li>\r\n<li> המשתמש מסכים בזאת ומאשר כי לא תהיה לו כל תביעה או טענה כלפי מפעיל האתר בגין שימוש בפרטיו בהתאם לאמור לעיל.</li>\r\n</ul>\r\n<h3>מסירת מידע לצד ג</h3>\r\n<ul>\r\n<li> מפעיל האתר יהא רשאי להתיר את הגישה למידע במאגרי המידע ו/או להעביר את המידע לצד שלישי כלשהו בהתאם לסוג השירותים ו/או ההזמנות כאמור וכן לצורך תפעול, פיתוח ושיפור האתר והשירותים בו.</li>\r\n<li> מפעיל האתר מצהיר ומודיע כי לצורך מתן השירותים מידע אשר ייאסף על ידו יועבר לצדדי ג\' כגון: גוגל, פייסבוק,Clickcease, טראק JS , אלסטיק, סמארט לוק.</li>\r\n<li> מפעיל האתר יהא רשאי לפנות למשתמש בעצמו ו/או באמצעות מי מטעמו וכן להעביר את המידע לצדדים שלישיים כלשהם על מנת שיוכלו לפנות למשתמש ולהציע לו שירותים ו/או מוצרים נוספים כאמור.</li>\r\n<li> על-פי חוק הגנת הפרטיות, התשמ\"א - 1981, כל אדם זכאי לעיין במידע שעליו המוחזק במאגר מידע. אדם שעיין במידע שעליו ומצא כי אינו נכון, שלם, ברור או מעודכן, רשאי לפנות לבעל מאגר המידע בבקשה לתקן את המידע או ולמחוק במידת הצורך.</li>\r\n<li> מעבר לאמור לעיל, מפעיל האתר לא יעביר לצדדים שלישיים את פרטיך האישיים והמידע שנאסף על פעילותך באתר אלא במקרים המפורטים להלן</li>\r\n<li> אם תרכוש מוצרים ושירותים מצדדים שלישיים המציעים אותם למכירה באמצעות האתר, יועבר לצדדים שלישיים אלה המידע הדרוש להם לשם השלמת תהליך הרכישה.</li>\r\n<li> במקרה של הפרת תנאי השימוש באתר.</li>\r\n<li> אם תבצע באתרים, פעולות שבניגוד לחוק ולכל דין.</li>\r\n<li> אם יתקבל צו שיפוטי המורה למסור את פרטיך או המידע אודותיך לצד שלישי.</li>\r\n<li> במידה ומפעיל האתר ימכור או יעביר בכל צורה שהיא את פעילות האתרים לתאגיד כלשהו - וכן במקרה שיתמזג עם גוף אחר או ימזג את פעילות האתרים עם פעילותו של צד שלישי, ובלבד שתאגיד זה יקבל על עצמו כלפיך את הוראות מדיניות פרטיות זו.</li>\r\n</ul>\r\n<h3>איסוף ושימוש במידע מאתרי ו/או משירותי ו/או מעוגיות צד ג</h3>\r\n<ul>\r\n<li> כאשר הנך נכנס לאתר יותר מפעם אחת הנך נותן למפעיל האתר גישה לזיכרון זה, לצורך ההמחשה, על מנת לרכוש באתר שירותי אינסטגרם עליך לחפש את שם המשתמש שלך באינסטגרם. לאחר שאתה מוצא אותו מפעיל האתר שומר בזיכרון הדפדפן את השם המשתמש ותמונת הפרופיל שכאשר תיכנס בפעם השנייה לא תצטרך לחפש אותו שוב.</li>\r\n<li> המידע אותו אוסף ושומר מפעיל האתר בזיכרון זה הינו:</li>\r\n<li> זהות השירות הנרכש, הכמות אשר נרכשה, לינק או שם משתמש שבנוגע אליו נקנה השירות, זמן מדויק של הקניה, סכום הקנייה, תצורת תשלום(פייפל או אשראי), ארבע ספרות אחרונות של כרטיס האשראי , מזהה עסקה בפייפל, כתובת אימייל ומספר טלפון אם נמסר ע\"י המשתמש בעת הרכישה.</li>\r\n<li> השימוש בזיכרון זה הינו לצורך תפעולו השוטף והתקין, ובכלל זה כדי לאסוף נתונים סטטיסטיים אודות השימוש בו, לאימות פרטים, כדי להתאים את האתר להעדפותיו האישיות ולצורכי אבטחת מידע.</li>\r\n<li> כמו כן מפעיל האתר משתמש במשוואות רשת, אלו קבצים גראפיים זעירים בעלי מזהה ייחודי המשובצים בדפי אינטרנט, המסייעים באיסוף מידע אודות הצפייה והשימוש וכן נתוני קהל (כגון גיל, מין ותחומי עניין) המופקים מפרסום מבוסס עניין של Google או מפרסמים אחרים , לרבות אך לא רק באמצעות קוד Google Analytics, פיקסל פייסבוק, מודד של גוגל מודעות ,טארק JS , Clickcease וסמארט לוק.</li>\r\n<li> Google Analytics משמש לניטור, ניתוח ומעקב אחר התנהגות המשתמש. מאפיין אנונימיזציה בנוגע ל – IP מופעל ב- Google Analytics מטעמי פרטיות. כל הנתונים שנאספו ישמשו בהתאם למדיניות הפרטיות של מפעיל האתר ולמדיניות הפרטיות של Google. מידע נוסף על האופן שבו משתמשים יכולים לבטל את הצטרפותם לשימוש של Google Analytics בקובצי cookie ניתן למצוא בדף ביטול ההסכמה של Google Analytics.</li>\r\n<li> מפעיל האתר משתמש בקוד של \"רימרקטינג\" של Google AdWords אשר יאפשר למפעיל האתר לספק פרסום ממוקד בעתיד.</li>\r\n<li> כמו כן מפעיל האתר עושה שימוש באתרי צד ג\' נוספים על מנת לאסוף מידע, כגון: אינסטגרם, גוגל, פייסבוק, יו טיוב, Clickcease, טראק JS , אלסטיק, סמארט לוק.</li>\r\n<li> בעת רכישת השירותים ומסירת פרטי המשתמש, המשתמש נותן בזאת את הסכמתו החופשית למפעיל האתר לאיסוף מידע והרשאות גישה למידע באינסטגרם, גוגל, פייסבוק, יו טיוב, Clickcease, טראק JS , אלסטיק, סמארט לוק.</li>\r\n<li> יודגש כי מפעיל האתר יהיה רשאי לעשות שימוש במידע זה רק לצורך השירותים הניתנים על ידו.</li>\r\n</ul>\r\n<h3>איסוף מידע ע\"י צד ג\'</h3>\r\n<ul>\r\n<li> בעת השימוש באתר מפעיל האתר יהא רשאי לעשות שימוש בתוכנות צד ג׳ על מנת לספק תכנים, שירותים ו/או במסגרת פונקציות נוספות.</li>\r\n<li> בעת השימוש באתר המשתמש מאשר כי תוכנות צד ג\' אלו יהיו רשאיות לאסוף את המידע כאמור.</li>\r\n<li> מפעיל האתר יהיה רשאי להעביר כל מידע לא מזהה אישית אודות המשתמש שנאסף על ידיו לשותפיו העסקיים (לרבות מפרסמים באתר), על מנת שאלו יתאימו עבור המשתמש מודעות ותכנים שיוצגו לו בעת הביקור באתרי אינטרנט ואפליקציות שונים לתחומי ההתעניינות שלו ו/או לקבוצת מין או גיל ו/או למקום מגוריו.</li>\r\n<li> כמו כן, המשתמש מצהיר כי הוא מסכים בזאת ששותפיו העסקיים של מפעיל האתר (לרבות מפרסמים) יהיו רשאים לאסוף מידע לא מזהה כאמור אודותיו באופן עצמאי.</li>\r\n</ul>\r\n<h3>כפיפות למדיניות פרטיות של צדדי ג</h3>\r\n<ul>\r\n<li> השירותים המוצעים באתר יהיו כפופים למדיניות הפרטיות של צדדי ג\', כולם ו/או חלקם בהתאם לשירות המבוקש.</li>\r\n<li> על המשתמש חלה האחריות לעיין בתנאי מדיניות פרטיות של צדדים אלו מכיוון שמפעיל האתר הינו כפוף למדיניותם ובעת מתן השירותים על ידו הנך מסכים למדיניות הפרטיות של אותם צדדים שלישיים.</li>\r\n<li> למשתמש לא תהיה כל טענה ו/או דרישה ו/או תביעה בנוגע למדיניות הפרטיות של אותם צדדים שלישיים.</li>\r\n<li> להלן יפורטו צדדי ג\' אשר בהם משתמש מפעיל האתר לצורך איסוף המידע ושמירתו:</li>\r\n<li> Google Analytics, Google AdWords, אינסטגרם, גוגל, פייסבוק, יו טיוב, Clickcease, טראק JS , אלסטיק, סמארט לוק, PAY PAL.</li>\r\n<li> להלן יוצגו הקישורים למדיניות הפרטיות, לרבות מדיניות ה-ה Cookies של הצדדים השלישיים אשר עמם עובד האתר ו/או עשוי לעבוד:</li>\r\n<li> https://www.facebook.com/help/instagram/155833707900388</li>\r\n<li> <a href=\"https://www.facebook.com/privacy/explanation\" rel=\"nofollow\">https://www.facebook.com/privacy/explanation</a></li>\r\n<li> <a href=\"https://www.youtube.com/intl/iw/yt/about/policies/#community-guidelines\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">https://www.youtube.com/intl/iw/yt/about/policies/#community-guidelines</a></li>\r\n<li> <a href=\"https://policies.google.com/privacy?hl=iw\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">https://policies.google.com/privacy?hl=iw</a></li>\r\n<li> <a href=\"https://soundcloud.com/pages/privacy\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">https://soundcloud.com/pages/privacy</a></li>\r\n<li> <a href=\"https://www.clickcease.com/privacy.html\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">https://www.clickcease.com/privacy.html</a></li>\r\n<li> <a href=\"https://trackjs.com/privacy/\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">https://trackjs.com/privacy/</a></li>\r\n<li> <a href=\"https://trackjs.com/privacy/\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">https://trackjs.com/privacy/</a></li>\r\n<li> <a href=\"https://www.elastic.co/legal/privacy-statement\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">https://www.elastic.co/legal/privacy-statement</a></li>\r\n<li> <a href=\"https://www.paypal.com/il/webapps/mpp/ua/privacy-full?locale.x=he_IL\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">https://www.paypal.com/il/webapps/mpp/ua/privacy-full?locale.x=he_IL</a></li>\r\n</ul>\r\n<h3>שינויים במדיניות הפרטיות</h3>\r\n<ul>\r\n<li> מפעיל האתר שומר על זכותו לשנות את תנאי זכות השימוש ואת מדיניות הפרטיות מזמן לזמן מבלי צורך למסור על כך הודעה מלבד פרסום נוסח עדכני באתר.</li>\r\n</ul>\r\n<h3>יצירת קשר</h3>\r\n<ul>\r\n<li> שירות הלקוחות של האתר פעיל 24/7.</li>\r\n<li> <a href=\"https://getboost.co.il/contact/\">פנייה לשירות הלקוחות</a> תיעשה בצ\'אט באתר ו/או בדואר אלקטרוני לכתובת הנ\"ל: support@digitalplanet.co.il.</li>\r\n<li> הפנייה תיעשה תוך ציון הפרטים המלאים, והנהלת האתר מבטיחה לטפל בפניותיכם בזריזות וביעילות.</li>\r\n</ul>', 'normal', NULL, '', '', '2017-05-29 02:03:02', 1),
(6, 'גישת VIP', 'vip', '<p><strong>רוצים גישה לתוכנות והכלים הVIP שלנו? בחרו כעת את החבילה המועדפת עליכם וקבלו גישה בלעדית לתוכנות וכלים אקסלוסביים לחברי המועדון שלנו.</strong></p>', 'membership', NULL, '', '', '2017-11-13 00:24:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) UNSIGNED NOT NULL,
  `txn_id` varchar(30) DEFAULT NULL,
  `product_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `membership_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `downloads` smallint(4) UNSIGNED NOT NULL DEFAULT 0,
  `file_date` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `ip` varbinary(16) DEFAULT NULL,
  `qty` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `amount` decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `tax` decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `coupon` decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `total` decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `currency` varchar(4) DEFAULT NULL,
  `cdkey` varchar(60) DEFAULT NULL,
  `pp` varchar(16) DEFAULT NULL,
  `memo` varchar(150) DEFAULT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(60) DEFAULT NULL,
  `mode` varchar(8) NOT NULL,
  `type` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `code`, `name`, `description`, `mode`, `type`) VALUES
(1, 'manage_users', 'Manage Users', 'Permission to add/edit/delete users', 'manage', 'Users'),
(2, 'manage_files', 'Manage Files', 'Permission to add/edit files', 'manage', 'Files'),
(3, 'manage_pages', 'Manage Pages', 'Permission to add/edit/delete pages', 'manage', 'Pages'),
(4, 'manage_backup', 'Manage Backups', 'Permission to create and restore backups', 'manage', 'Backup'),
(5, 'manage_language', 'Manage Language', 'Permission to translate languages', 'manage', 'Language'),
(6, 'manage_email', 'Manage Email Templates', 'Permission to manage email tempates', 'manage', 'Emails'),
(7, 'manage_countries', 'Manage Countries', 'Permission to manage countries', 'manage', 'Countries'),
(8, 'manage_coupons', 'Manage Coupons', 'Permission to add/edit/delete coupons', 'manage', 'Coupons'),
(9, 'manage_fields', 'Manage Custom Fields', 'Permission to add/edit/delete custom fields', 'manage', 'Fields'),
(10, 'manage_newsletter', 'Manage Newstellers', 'Permission to manage newsletter', 'manage', 'Newsletter'),
(11, 'manage_news', 'Manage News', 'Permission to add/edit/delete news', 'manage', 'News'),
(12, 'manage_categories', 'Manage Categories', 'Permission to add/edit and delete categories', 'manage', 'Categories'),
(13, 'manage_menus', 'Manage Menus', 'Permission to add/edit and delete menus', 'manage', 'Menus'),
(14, 'manage_products', 'Manage Products', 'Permission to add/edit and delete products', 'manage', 'Products'),
(15, 'manage_faq', 'Manage F.A.Q.', 'Permission to add/edit and delete f.a.q.', 'manage', 'Faq'),
(16, 'manage_memberships', 'Manage Memberships', 'Permission to add/edit and delete memberships', 'manage', 'Membership'),
(17, 'manage_blog', 'Manage Blog', 'Permission to add/edit/delete blog', 'manage', 'Blog');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `price` decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `sprice` decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `is_sale` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `categories` varchar(60) NOT NULL DEFAULT '0',
  `membership_id` varchar(20) NOT NULL DEFAULT '0',
  `files` varchar(60) NOT NULL DEFAULT '0',
  `body` text DEFAULT NULL,
  `pbody` text DEFAULT NULL,
  `thumb` varchar(50) DEFAULT NULL,
  `tags` varchar(150) DEFAULT NULL,
  `audio` varchar(50) DEFAULT NULL,
  `images` blob DEFAULT NULL,
  `youtube` varchar(200) DEFAULT NULL,
  `affiliate` varchar(150) DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'normal',
  `expiry` int(1) NOT NULL DEFAULT 0,
  `expiry_type` varchar(10) DEFAULT 'downs',
  `hits` mediumint(6) NOT NULL DEFAULT 0,
  `likes` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `ratings` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `token` varchar(32) NOT NULL DEFAULT '0',
  `keywords` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `title`, `slug`, `price`, `sprice`, `is_sale`, `categories`, `membership_id`, `files`, `body`, `pbody`, `thumb`, `tags`, `audio`, `images`, `youtube`, `affiliate`, `type`, `expiry`, `expiry_type`, `hits`, `likes`, `ratings`, `token`, `keywords`, `description`, `active`, `created`) VALUES
(5, 11, 'Squirrly SEO - תוסף בינה מלאכותית לקידום אתרי וורדפרס [קופון 30% בפנים]', 'squirrlyseo', '235.00', '164.00', 1, '11', '0', '0', '<h1><strong>Squirrly SEO - דרג את אתר הוורדפרס שלך עם יעדי קידום אתרים מונחי נתונים של יועץ בינה מלאכות </strong></h1>\r\n<h2><strong>מה זה Squirrly SEO?</strong></h2>\r\n<p>עם הפופולריות האחרונה של וורדפרס, אין זה מפתיע שיש אנשים רבים המחפשים לנצל את הפוטנציאל שלה להצלחה באינטרנט. עם זאת, ללא קידום אתרים מתאים (אופטימיזציה למנועי חיפוש), האתר שלך עלול ליפול קורבן לתחרות. זה המקום שבו Squirrly SEO נכנס לתמונה - כלי מופעל בינה מלאכותית שיכול לעזור לך להשיג יעדי SEO ספציפיים על סמך נתונים שנאספו מהאתר שלך. אז למה לחכות? נסה את Squirrly עוד היום וראה איך זה יכול לעזור לך לדרג גבוה יותר בגוגל!</p>\r\n<h2>מה זה Squirrly SEO</h2>\r\n<p>Squirrly SEO היא גישה מונעת נתונים לקידום אתרים המשתמשת בבינה מלאכותית (AI) כדי לעזור לך לדרג גבוה יותר במנועי החיפוש. Squirrly יכולה לעזור לך להשיג את יעדי ה-SEO שלך על ידי ניתוח נתוני האתר שלך וזיהוי היכן תוכל לבצע שיפורים.</p>\r\n<p>איך Squirrly עובד?</p>\r\n<p>Squirrly פועלת באמצעות AI כדי לנתח את נתוני האתר שלך ולזהות היכן אתה יכול לבצע שיפורים. לאחר מכן, Squirrly מספקת המלצות שיעזרו לך לדרג גבוה יותר במנועי החיפוש.</p>\r\n<p>מהם היתרונות של השימוש ב-Squirrly?</p>\r\n<p>היתרונות של השימוש ב-Squirrly כוללים:</p>\r\n<p>-גישה מונעת נתונים המשתמשת בבינה מלאכותית כדי לעזור לך לדרג גבוה יותר במנועי החיפוש</p>\r\n<p>-המלצות שיעזרו לך לשפר את דירוג האתר שלך</p>\r\n<p>- תאימות לרוב אתרי וורדפרס</p>\r\n<h2>השתמש בכלי אחד למחקר מילות מפתח, אופטימיזציה של תוכן, SEO טכני, ביקורת אתרים, מעקב אחר דירוג ועוד</h2>\r\n<p>כאשר אתה מנסה לדרג את אתר הוורדפרס שלך, זה יכול להיות קשה לעקוב אחר כל ההיבטים השונים של SEO. זה המקום שבו Squirrly SEO נכנס לתמונה! Squirrly הוא כלי מבוסס נתונים שעוזר לך להשיג את יעדי ה-SEO שלך על ידי מתן מחקר מילות מפתח, אופטימיזציה של תוכן, SEO טכני, ביקורת אתרים, מעקב אחר דירוג ועוד. בין אם אתה רק מתחיל או שאתה צריך עזרה בשמירה על הדירוג שלך, Squirrly יכולה לעזור לך להגיע לשם. אז למה לא לנסות היום?</p>\r\n<h2>קבל מטלות מותאמות אישית מיועץ קידום אתרים בינה מלאכותית לדירוג טוב יותר, בתוספת הדרכה שלב אחר שלב לגבי יישום</h2>\r\n<p>אם אתה רוצה לדרג גבוה יותר בדפי התוצאות של מנועי החיפוש (SERPs), עליך להתמקד ב-SEO מבוסס נתונים. Squirrly SEO יכול לעזור לך להשיג מטרה זו על ידי מתן מטלות מותאמות אישית והדרכה שלב אחר שלב כיצד ליישם אותן.</p>\r\n<p>פלטפורמת Squirrly AI משתמשת באלגוריתמים של עיבוד שפה טבעית (NLP) ולמידת מכונה כדי לנתח את נתוני האתר שלך ולספק תובנות לגבי השינויים שיכולים לשפר את דירוג האתר שלך. זה אומר שאתה יכול לסמוך על הפלטפורמה שתספק המלצות שהן גם יעילות וגם מותאמות לצרכים הספציפיים שלך.</p>\r\n<p>הפלטפורמה מציעה מגוון שירותים, כולל:</p>\r\n<p>1) ניתוח אתרים - הצעד הראשון הוא לנתח את נתוני האתר שלך כדי ש-Squirrly תוכל לזהות אזורים שבהם אופטימיזציה יכולה להועיל.</p>\r\n<p>2) ייעוץ SEO – לאחר סיום ניתוח הנתונים, Squirrly תספק לכם המלצות מותאמות לשיפור דירוג האתר שלכם במנועי החיפוש. זה כולל הכל משיפור איכות התוכן שלך ועד ליישום סימון נתונים מובנה.</p>\r\n<p>3) אופטימיזציה מתמשכת - אם אתה רוצה לשמור על דירוג האתר שלך טוב, אז אתה צריך ליישם באופן קבוע את ההמלצות שמספק Squ</p>\r\n<h2>מספק משוב SEO בזמן אמת על התוכן שלך תוך כדי הקלדה בעורך וורדפרס</h2>\r\n<p>Squirrly SEO הוא הכלי המושלם למטרות SEO מונעות נתונים. עם אלגוריתם מותאם אישית וסקירה חודשית, Squirrly תעזור לך לדרג את אתר הוורדפרס שלך גבוה יותר במנועי החיפוש. בין אם אתה צריך לשפר את התנועה האורגנית של האתר שלך או לדרג את האתר שלך עבור מילות מפתח ספציפיות, Squirrly יכולה לעזור.</p>\r\n<h2>לגלות רעיונות למילות מפתח שטרם נוצלו ולנתח את הפוטנציאל שלהן</h2>\r\n<p>האם אתה מחפש לדרג את אתר הוורדפרס שלך עם יעדי SEO מונחי נתונים? אם כן, יש לך מזל! כיועץ בינה מלאכותית, אני יכול לעזור לך למצוא רעיונות למילות מפתח שטרם נוצלו ולנתח את הפוטנציאל שלהן לדירוג האתר שלך.</p>\r\n<p>כדי להתחיל, פשוט מלא את הטופס באתר שלי כדי לשלוח את נתוני האתר שלך. משם, אשתמש באלגוריתמים מתקדמים כדי ליצור רעיונות למילות מפתח המותאמים לאתר שלך.</p>\r\n<p>אני מאמין שקידום אתרים מבוסס נתונים הוא המפתח להצלחה באינטרנט. בעזרתי תוכלו לנצל את המגמה הזו ולדרג גבוה יותר במנועי החיפוש.</p>\r\n<h2>קבל יעדים ניתנים לפעולה בעדיפות גבוהה שרלוונטיים ב-100% לאתר שלך</h2>\r\n<p>Squirrly SEO הוא ייעוץ קידום אתרים מונע נתונים שצומח במהירות הגבוהה ביותר בעולם. אנו עוזרים לאתרי וורדפרס לדרג גבוה יותר עם יעדים שהם % רלוונטיים לאתר שלך.</p>\r\n<p>צוות המומחים שלנו משתמש במגוון מקורות נתונים כדי ליצור יעדים ניתנים לפעולה שיעזרו לך לדרג גבוה יותר בגוגל, יאהו ובינג. אנו מציעים גם דוחות חודשיים שנותנים לך סקירה מפורטת של ביצועי האתר שלך.</p>\r\n<p>צור איתנו קשר עוד היום כדי ללמוד עוד על שירותי קידום אתרים מונחה נתונים שלנו או הירשם לניסיון חינם! </p>\r\n<h2>סיכום</h2>\r\n<p>Squirrly SEO היא גישה מונעת נתונים לדירוג אתר וורדפרס שלך המשתמשת ב-AI כדי לעזור לך להגדיר יעדים ולהשיג אותם. על ידי שימוש ב-Squirrly, אתה יכול להתמקד בדברים החשובים ביותר לדירוג מנועי החיפוש (ולהמיר יותר מבקרים) מבלי להקדיש שעות לשינוי הגדרות או לערוך מחקר ידני. אם אתה מחפש יתרון בעולם הדיגיטלי, נסה את Squirrly SEO!</p>', '', 'UZ6t9ZworiLd.jpg', 'squirrly seo, כלי לקידום אתרי וורדפרס, כלי לקידום seo', NULL, 0x5b7b226e616d65223a22494d475f5a7636626b7650776c34785a2e706e67227d5d, 'https://www.youtube.com/watch?v=zt9fIkPmC6Q', 'https://www.shareasale.com/u.cfm?d=934180&m=106388&u=3370952', 'affiliate', 0, 'downs', 0, 0, 0, 'eQRWm4WwyaQxioSnPoqhayGwgRTIFdQu', 'Squirrly SEO, כלי לקידום אתרי וורדפרס, כלי לקידום SEO', '', 1, '2022-08-29 14:04:50'),
(2, 4, 'NameCheap - חברת האחסון והדומיינים מהמומלצות בעולם', 'namecheap', '20.00', '1.00', 1, '4', '0', '0', '<h1><strong>NameCheap - חברת האחסון ושמות הדומיין המומלצת ביותר בעולם</strong></h1>\r\n<p>חברות אירוח ושמות דומיין הן פרוטה תריסר, אבל NameCheap היא חברת האחסון ושמות הדומיין המומלצת ביותר בעולם. במאמר זה, נספר לכם מדוע אנו חושבים שהם כל כך מעולים ומדוע כדאי לכם לשקול אותם לצרכי האירוח או שם הדומיין הבא שלכם.</p>\r\n<h2><strong>מה זה NameCheap?</strong></h2>\r\n<p>NameCheap היא חברת האחסון ושמות הדומיין המומלצת ביותר בעולם. הם מציעים תוכניות אירוח זולות, רישום שם דומיין ושירות לקוחות שאין שני לו.</p>\r\n<p>אם אתם מחפשים מארח אמין עם שירות לקוחות מעולה, NameCheap היא הבחירה המושלמת.</p>\r\n<h2><strong>איך NameCheap עובד?</strong></h2>\r\n<p>NameCheap היא חברת שמות מתחם שבסיסה בסן פרנסיסקו, קליפורניה. הוא מציע שירותי אירוח ושמות דומיין כאחד. החברה נוסדה בשנת 2001 על ידי פול אינגליש ואשתו לינדה. אינגליש הוא המנכ\"ל הנוכחי של NameCheap.</p>\r\n<p>NameCheap מציעה מספר תכונות הייחודיות לחברה. תכונה אחת היא שהיא מאפשרת ללקוחות לרכוש דומיינים ואירוח דרך חשבון אחד. זה מבטל את הצורך ביצירת חשבונות מרובים, דבר שעלול להיות זמן רב ומבלבל. בנוסף, NameCheap מציעה מספר הנחות לקידום מכירות הזמינות רק ללקוחותיה. הנחות אלו כוללות רישום דומיין בחינם ואירוח חינם לשנה הראשונה. NameCheap מציעה גם הבטחת שביעות רצון להחזר כספי על כל המוצרים.</p>\r\n<p>רוב הלקוחות של NameCheap הם עסקים קטנים ויזמים בודדים שרוצים להקים או להרחיב את העסק שלהם באינטרנט. ל-NameCheap יש גם בסיס לקוחות גדול של חובבי טכנולוגיה שמשתמשים בשירותיה כדי לארח אתרים לשימושם האישי או לעסקים שלהם.</p>\r\n<h2><strong>כיצד לקנות שמות מתחם מ-NameCheap</strong></h2>\r\n<p>אם אתם מחפשים לקנות שם דומיין, NameCheap היא חברת האירוח ושמות הדומיין המומלצים ביותר בעולם. הנה איך לקנות מהם:</p>\r\n<p>1. היכנס לחשבון NameCheap שלך.</p>\r\n<p>2. לחץ על הקישור Domains בסרגל הניווט.</p>\r\n<p>3. בדף Domains, לחץ על כפתור Add a Domain.</p>\r\n<p>4. הזן את שם הדומיין שברצונך לרכוש בתיבה שם דומיין.</p>\r\n<p>5. לחץ על כפתור קנה עכשיו.</p>\r\n<p>6. תתבקש לספק את פרטי כרטיס האשראי שלך. לאחר שהזנת את פרטי כרטיס האשראי שלך, לחץ על הלחצן אישור עסקה.</p>\r\n<p>7. תקבל הודעת דוא\"ל לאחר השלמת הרכישה. מזל טוב!</p>\r\n<h2><strong>כיצד להשתמש בכלים ובשירותים של NameCheap</strong></h2>\r\n<p>NameCheap היא חברת שמות הדומיין הפופולרית ביותר בעולם, עם למעלה מ-2 מיליון לקוחות. הם מציעים מגוון רחב של כלים ושירותים לשימוש אישי ועסקי כאחד. במאמר זה נראה לך כיצד להשתמש בכלים ובשירותים של NameCheap כדי להתחיל ברישום שמות דומיין ואירוח.</p>\r\n<p>כדי להתחיל להשתמש ב-NameCheap, תחילה עליך ליצור חשבון. לחץ על כפתור \"היכנס\" בראש העמוד והזן את כתובת הדוא\"ל והסיסמה שלך. לאחר מכן תועבר לדף שבו תוכל לבחור איזה סוג חשבון ברצונך ליצור: חשבון אישי או עסקי. אם אתה חדש ברישום שם דומיין או אירוח, אנו ממליצים ליצור חשבון אישי. זה יאפשר לך לרשום יותר דומיינים ומארחים מאשר חשבון עסקי, וזה בחינם ליצור אחד.</p>\r\n<p>לאחר שיצרת חשבון, תצטרך להגדיר את פרטי ההתחברות שלך. לשם כך, לחץ על הכרטיסייה \"חשבון\" בעמוד הראשי, ובחר \"החשבון שלי\". בדף זה, תמצא את פרטי ההתחברות שלך בקטע \"פרופיל\": כתובת הדוא\"ל, הסיסמה ושם המשתמש שלך. אתה יכול גם לשנות את הפרטים האלה אם הם</p>\r\n<h2><strong>מהם היתרונות בשימוש ב-NameCheap?</strong></h2>\r\n<p>NameCheap היא חברת האחסון ושמות הדומיין המומלצת ביותר בעולם. הם מציעים מגוון רחב של שירותים במחירים נוחים, והם מקור מהימן לאבטחה מקוונת.</p>\r\n<p>הנה כמה מהיתרונות של השימוש ב-NameCheap:</p>\r\n<p>- תמחור סביר: NameCheap מציעה מגוון רחב של שירותים במחירים נוחים, מה שהופך אותה לאופציה מצוינת לעסקים קטנים ולאנשים פרטיים כאחד.</p>\r\n<p>- מקור מהימן לאבטחה מקוונת: NameCheap הוא מקור מהימן לאבטחה מקוונת, המציע הגנה מפני האקרים ואיומים אחרים.</p>\r\n<p>- מגוון רחב של שירותים: NameCheap מציעה מגוון רחב של שירותים, לרבות רישום שמות מתחם, אירוח ועוד.</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>NameCheap מעולם לא אכזבה את לקוחותיה, ואני יכול להעיד על כך. חברה זו מציעה מגוון רחב של תוכניות אירוח, שמות דומיין ועוד. בין אם אתה מחפש אפשרות בעלות נמוכה או משהו חזק יותר, NameCheap סיפק אותך. בנוסף, שירות הלקוחות שלהם מצוין - אם אי פעם משהו לא בסדר בחשבון או ברכישה שלך, הם יטפלו בזה במהירות וביעילות.</p>', '', 'HA0SKEfjt8X9.jpg', 'namecheap,אחסון אתרים,דומיינים', NULL, 0x5b5d, '', 'https://shareasale.com/r.cfm?b=518810&u=3370952&m=46483&urllink=&afftrack=', 'affiliate', 0, 'downs', 0, 0, 0, 'gbMAXWdfKxt4v86ShCQxpcJ4zLb9W7Wu', '', '', 1, '2022-08-29 12:58:22'),
(3, 4, 'Hostiso - שרתי אחסון אתרים בדגש על מהירות', 'hostiso', '39.99', '19.99', 1, '4', '0', '0', '<h1><strong>חברת האחסון hostiso.com מציעה שרתים סופר מהירים במחירים נוחים</strong></h1>\r\n<p>מחפשים חברת אחסון טובה? אל תחפש רחוק יותר מאשר hostiso.com! השרתים שלנו מהירים להפליא, ואנו מציעים תעריפים נוחים שאי אפשר לנצח. בין אם אתה מחפש תוכנית אירוח בסיסית או משהו מיוחד יותר, אנחנו מכוסים אותך. אז למה אתה מחכה? הירשמו היום!</p>\r\n<h2><strong>מה זה Hostiso.com?</strong></h2>\r\n<p>Hostiso.com היא חברת אחסון עם שרתים סופר מהירים במחירים נוחים. השרתים שלהם ממוקמים בארצות הברית והם מציעים מגוון תוכניות אירוח החל מ-$5 לחודש. הם גם מציעים מספר שירותי רישום שמות מתחם שונים.</p>\r\n<p>אם אתם מחפשים חברת אחסון זולה, מהירה ואמינה אז Hostiso.com בהחלט שווה בדיקה!</p>\r\n<h2><strong>איך Hostiso.com עובד</strong></h2>\r\n<p>Hostiso.com היא חברת אחסון המציעה שרתים סופר מהירים במחירים נוחים. כל השרתים שלהם ממוקמים בארצות הברית, מה שהופך אותם לבחירה מצוינת עבור אנשים שרוצים לארח את האתרים שלהם בארה\"ב. הם מציעים מגוון רחב של תוכניות אירוח, כך שתוכל למצוא את האחת המתאימה ביותר לצרכים שלך. השרתים שלהם תמיד פועלים, אז אתה יכול להיות סמוך ובטוח שהאתרים שלך יהיו נגישים גם בתקופות של תעבורה גבוהה.</p>\r\n<h2><strong>מהם היתרונות בשימוש ב- Hostiso.com?</strong></h2>\r\n<p>אם אתם מחפשים חברת אחסון המציעה שרתים מהירים במיוחד במחירים נוחים, אז Hostiso.com היא האפשרות המושלמת עבורכם! עם Hostiso.com, תוכל ליהנות ממהירויות בזק שבטוח יספקו את הצרכים שלך. בנוסף, החברה מציעה מגוון רחב של שרתים שיכולים להתאים לכל צורך או דרישה. אז בין אם אתם מחפשים שרת לעסקים קטנים או שרת בעל עוצמה גבוהה, Hostiso.com מטפל בכם! ואם המחיר הוא בעיה, אל דאגה - החברה מציעה גם ניסיון חינם כדי שתוכל לבדוק את השירותים לפני התחייבות. אז למה לחכות? הירשמו עוד היום ותתחילו ליהנות מהיתרונות של השימוש ב- Hostiso.com!</p>\r\n<h2><strong>אילו מיקומי שרת מציעים את המהירויות המהירות ביותר?</strong></h2>\r\n<p>Hostiso.com היא חברת אחסון המתמחה באספקת שרתים סופר מהירים במחירים נוחים. מיקומי השרת שלהם ממוקמים בכל רחבי העולם, כך שאתה יכול להיות בטוח שתמצא אחד שמציע את המהירויות המהירות ביותר.</p>\r\n<p>כמה מהמיקומים הפופולריים ביותר עבור שרתי Hostiso.com הם בריסל, סינגפור, אמסטרדם ולונדון. מיקומים אלה מציעים מהירויות גדולות מכיוון שהם ממוקמים בסמיכות לערים מרכזיות.</p>\r\n<p>מיקומי שרתים אחרים המוצעים על ידי Hostiso.com כוללים את שיקגו, דאלאס ומיאמי. מיקומים אלה מציעים מהירויות מהירות יותר מכיוון שהם ממוקמים ליד אזורי מטרופולין גדולים.</p>\r\n<p>לא משנה באיזה מיקום שרת תבחר, אתה יכול להיות בטוח שתקבל את המהירויות המהירות ביותר הזמינות. עם Hostiso.com, אתה יכול לסמוך על כך שאתה מקבל שירות איכותי במחיר שלא ישבור לך את הבנק.</p>\r\n<h2><strong>התוכניות השונות שמציעה Hostiso.com</strong></h2>\r\n<p>אם אתה זקוק לחברת אחסון המציעה שרתים מהירים במחיר סביר, אל תחפש רחוק יותר מאשר Hostiso.com. התוכניות השונות שלהם מציעות בדיוק את מה שאתה צריך, מאירוח משותף בסיסי ועד אפשרויות פרימיום כמו אחסון SSD ורוחב פס בלתי מוגבל. בנוסף, שירות הלקוחות שלהם הוא מהשורה הראשונה, כך שאתה יכול להיות סמוך ובטוח בידיעה שכל בעיה תיפתר במהירות.</p>\r\n<h2><strong>יתרונות וחסרונות של שימוש ב- Hostiso.com</strong></h2>\r\n<p>כשזה מגיע למציאת חברת אירוח מצוינת, מעטים יכולים להשוות ל- Hostiso.com. ספק זה מציע שרתים מהירים בזק במחירים נוחים, מה שהופך אותו לבחירה המובילה עבור כל מי שמחפש שירותי אירוח באיכות גבוהה. עם זאת, ישנם כמה חסרונות פוטנציאליים לשימוש ב- Hostiso.com. בראש ובראשונה, חברה זו חדשה יחסית וייתכן שאין לה את אותה רמת תמיכת לקוחות כמו חלק מהספקים המבוססים יותר. בנוסף, מיקומי השרת של Hostiso.com מוגבלים, כך שאם אתה צריך שטח שרת מחוץ לרשת הראשית שלהם, ייתכן שלא תוכל למצוא אותו.</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>אם אתה מחפש חברת אחסון מצוינת המציעה שרתים מהירים במחירים נוחים, אז אתה בהחלט צריך לבדוק את hostiso.com! לא רק שיש להם כמה מהשרתים המהירים ביותר בסביבה, אלא שהתמחור שלהם גם תחרותי מאוד. בנוסף, הם מציעים מגוון רחב של תכונות וכלים כדי להפוך את חוויית אירוח האינטרנט שלך לטובה עוד יותר. אז אם אתה זקוק למארח אינטרנט חדש, הקפד לנסות את hostiso.com!</p>', '', 'Y2XjLRtavuMd.jpg', 'hostiso,אחסון אתרים', NULL, NULL, '', 'https://shareasale.com/r.cfm?b=1953276&u=3370952&m=121258&urllink=&afftrack=', 'affiliate', 0, 'downs', 0, 0, 0, 't7ZX8Z4R0wbhd6HCKprYwS3OkWCEVKQU', 'Hostiso, Hostiso קופון, Hostiso המלצות', '', 1, '2022-08-29 13:08:48'),
(4, 11, 'Sitechecker.pro - כלי מצויין ופשוט לשימוש לבדיקת קידום האתר שלכם', 'sitechecker', '10.00', '5.00', 1, '11', '0', '0', '<h1><strong>Sitechecker.pro - כלי מצוין וקל לשימוש לבדיקת ה-SEO של האתר שלך<</strong></h1>\r\n<p>מבין הדברים הרבים שאתה צריך לדאוג אליהם בכל הנוגע לאתר שלך, אחד החשובים ביותר הוא לוודא שהוא מותאם לנראות במנועי חיפוש. למרבה המזל, ישנם מספר כלים זמינים שיכולים לעזור לך במשימה זו. במאמר זה, נסקור את Sitechecker.pro, כלי מצוין וקל לשימוש לבדיקת ה-SEO של האתר שלך.</p>\r\n<h2><strong>מה זה Sitechecker.pro?</strong></h2>\r\n<p>Sitechecker.pro הוא כלי קל לשימוש שניתן להשתמש בו כדי לבדוק את ה-SEO של האתר שלך. זה מושלם לבדיקת המצב הנוכחי של קידום האתרים שלך ולביצוע כל השינויים או השיפורים הדרושים.</p>\r\n<p>Sitechecker.pro הוא חינמי לשימוש וניתן להורדה מהאתר.</p>\r\n<h2><strong>כיצד פועל Sitechecker.pro?</strong></h2>\r\n<p>Sitechecker.pro הוא כלי מקוון חינמי המאפשר לך לבדוק את ה-SEO של האתר שלך תוך דקות ספורות. הכלי משתמש במגוון אלגוריתמים שונים כדי לנתח את התוכן, המבנה ומילות המפתח של האתר שלך ולתת לך ציון כללי.</p>\r\n<p>אתה יכול גם להשתמש ב-Sitechecker.pro כדי למצוא ולתקן בעיות ב-SEO של האתר שלך. הכלי כולל מגוון תכונות שיעזרו לך לשפר את קידום האתרים שלך, כולל כלי מחקר מילות מפתח וכלי איות מתוקן.</p>\r\n<p>Sitechecker.pro היא דרך מצוינת לבדוק את ה-SEO של האתר שלך ולוודא שהוא ממוקם בעמוד הטוב ביותר במנועי החיפוש.</p>\r\n<h2><strong>מה יכול Sitechecker.pro לבדוק עבורי?</strong></h2>\r\n<p>Sitechecker.pro יכול לבדוק עבורך את הדברים הבאים: - תג הכותרת והמטא תיאור של האתר שלך נכונים - כל הקישורים באתר שלך פועלים - הקוד של האתר שלך מעוצב כהלכה וללא שגיאות Sitechecker.pro הוא כלי מצוין לבדיקת SEO של האתר שלך, מכיוון שהוא יכול לעזור לך לזהות בעיות פוטנציאליות עם התוכן, הקישורים והקוד שלך. באמצעות Sitechecker.pro, אתה יכול להבטיח שהאתר שלך מותאם למנועי חיפוש ויראה מקצועי ויעיל.</p>\r\n<h2><strong>מהם היתרונות של SEO?</strong></h2>\r\n<p>קידום אתרים הוא תהליך של אופטימיזציה של אתר לנראות במנועי חיפוש. ניתן לסכם את היתרונות של קידום אתרים לעסקים באופן הבא:</p>\r\n<p>1. תנועה מוגברת - קידום אתרים יכול לעזור להוביל יותר תנועה לאתר על ידי שיפור הנראות שלו במנועי החיפוש. זה יכול להוביל לעלייה בהכנסות עקב עלייה בשיעורי ההמרה של מבקרים.</p>\r\n<p>2. דירוגים גבוהים יותר – כאשר אתר האינטרנט של העסק מדורג גבוה יותר במנועי החיפוש, הדבר יכול להוביל להגברת הנראות של המותג ולשיפור המרות הלקוחות. המשמעות יכולה להיות שלמתחרים של העסק יהיה קל יותר למשוך ושימור לקוחות.</p>\r\n<p>3. שיפור תדמית המותג – על ידי שיפור הדירוג של אתר האינטרנט של העסק, הוא יכול גם לשפר את תדמית המותג שלו. תמונה זו יכולה להיות מושפעת מגורמים כמו התדירות שבה לקוחות מבקרים באתר, באילו מילות מפתח משתמשים באתר ואיכות התוכן.</p>\r\n<p>4. עלויות מופחתות - קידום אתרים יכול גם להוזיל עלויות לעסקים על ידי סיוע בהנעת תנועה לאתרים שלהם והגדלת המכירות באמצעות שיעורי המרה מוגברים.</p>\r\n<h2><strong>איך Sitechecker.pro יכול לעזור לי עם פרויקט ה-SEO שלי?</strong></h2>\r\n<p>Sitechecker.pro הוא כלי מצוין וקל לשימוש לבדיקת SEO של האתר שלך. הוא מספק ניתוח מפורט של מצב ה-SEO הנוכחי של האתר שלך, מדגיש בעיות פוטנציאליות ונותן המלצות כיצד לטפל בהן.</p>\r\n<p>אם אתה מחפש דרך מהירה וקלה לשפר את SEO של האתר שלך, Sitechecker.pro הוא הכלי המושלם עבורך!</p>\r\n<h2><strong>כיצד אוכל להשתמש ב-Sitechecker.pro?</strong></h2>\r\n<p>Sitechecker.pro הוא כלי שימושי וקל לשימוש שיכול לעזור לך לבדוק את ה-SEO של האתר שלך. כל שעליך לעשות הוא להזין את שם הדומיין שלך ולחץ על כפתור \"בדוק כעת\", ו-Sitechecker יספק לך דוח מפורט של מצב ה-SEO הנוכחי של האתר שלך.</p>\r\n<p>אם אתה מודאג לגבי ה-SEO של האתר שלך, Sitechecker הוא דרך מצוינת לקבל סקירה מהירה של המצב הנוכחי של האתר שלך. זה בחינם לשימוש, אז אין סיבה לא לנסות את זה!</p>\r\n<h2><strong>סיכום< </strong></h2>\r\n<p>Sitechecker.pro הוא כלי מצוין וקל לשימוש לבדיקת SEO של האתר שלך. האתר מספק ניתוח מפורט של סטטוס ה-SEO הנוכחי של האתר שלך, תוך הדגשת כל התחומים הטעונים שיפור. בנוסף, האתר מציע סט כלים שיעזרו לך לשפר את ציון ה-SEO של האתר שלך. אני ממליץ בחום על Sitechecker.pro לכל מי שמחפש לבצע אופטימיזציה של האתר שלו לחשיפה טובה יותר במנועי החיפוש.</p>\r\n<h2><strong>סיכום< </strong></h2>\r\n<p>Sitechecker.pro הוא כלי מצוין לבדיקת SEO של האתר שלך. זה קל לשימוש ומספק לך מידע מפורט על ביצועי האתר שלך בהתאם להנחיות של Google. אם אינך בטוח אם האתר שלך זקוק לשיפור או לא, Sitechecker.pro הוא מקום מצוין להתחיל בו.</p>', '', '5oFqCOYiWOS1.png', 'sitechecker.pro, כלי לבדיקת seo, כלי לבדיקת קידום האתרים', NULL, 0x5b7b226e616d65223a22494d475f6e416a6748637338624d5a642e706e67227d2c7b226e616d65223a22494d475f54397335514a344e555354792e706e67227d5d, 'https://www.youtube.com/watch?v=iQWrmE-J-yU', 'https://shareasale.com/u.cfm?d=782295&m=95321&u=3370952&afftrack=', 'affiliate', 0, 'downs', 0, 0, 0, 'ndo8MUlB6RTkL0L4NUyf2k6mNa3gc2Tb', 'Sitechecker.pro, כלי לבדיקת SEO, כלי לבדיקת קידום האתרים', '', 1, '2022-08-29 13:15:04'),
(6, 3, 'WP Rocket - תוסף המטמון הנמכר בעולם לאתרי וורדפרס', 'wprocket', '199.99', '159.99', 1, '3', '0', '0', '<p><strong><a href=\"https://shareasale.com/r.cfm?b=1075949&u=3370952&m=74778&urllink=&afftrack=\">WP Rocket</a> הוא תוסף מטמון לוורדפרס הידוע בנוחות השימוש והביצועים שלו. במאמר זה נסקור מה זה WP Rocket, איך זה עובד ומדוע הוא אחד התוספים הטובים ביותר לאתרי וורדפרס.</strong></p>\r\n<h2><strong>כיצד WP Rocket יכול לשפר משמעותית את מהירות טעינת האתר שלך</strong></h2>\r\n<p>WP Rocket הוא תוסף מטמון רב עוצמה שיכול לעזור לשפר את מהירות טעינת האתר שלך באופן משמעותי. על ידי שמירה במטמון של הדפים והפוסטים שלך, WP Rocket יכולה לעזור להפחית את משך הזמן שלוקח לטעינת הדפים שלך, מה שיכול לשפר את הביצועים הכוללים של האתר שלך. בנוסף, WP Rocket יכול גם לעזור לייעל את מסד הנתונים שלך ולסייע בהקטנת ודחיסת הקבצים שלך כדי לשפר עוד יותר את מהירויות הטעינה.</p>\r\n<h2><strong>למעלה מ-100,000 אתרי וורדפרס עובדים עם WP ROCKET</strong></h2>\r\n<p>יותר מ, אתרי וורדפרס משתמשים ב-WP ROCKET כדי להאיץ את האתר שלהם. WP ROCKET הוא תוסף המטמון הפופולרי ביותר בעולם.</p>\r\n<p>WP ROCKET מאיץ את האתר שלך על ידי שמירה במטמון של הדפים והקבצים שלך. המשמעות היא שהדפים שלך ייטענו מהר יותר עבור המבקרים שלך. WP ROCKET מצמצם גם את קובצי ה-HTML, CSS ו-JavaScript. זה עוזר להקטין את גודל הדפים שלך, מה שגם מזרז את זמני הטעינה.</p>\r\n<p>WP ROCKET קל לשימוש והוא עובד עם כל ערכות הנושא והתוספים של וורדפרס. אתה יכול להתקין את WP ROCKET באתר הוורדפרס שלך תוך דקות ספורות.</p>\r\n<p>אם אתה מחפש דרך להאיץ את אתר הוורדפרס שלך, אז WP ROCKET הוא הפתרון המושלם.</p>\r\n<h2><strong>השוואה בין WP ROCKET לתוספי מטמון אחרים</strong></h2>\r\n<p>כשמדובר בתוספי שמירה במטמון, WP ROCKET נחשב לרוב לטוב שבטובים ביותר. הנה השוואה של WP ROCKET לכמה מתוספי מטמון פופולריים אחרים כדי לעזור לך לקבל החלטה מושכלת לגבי איזה מהם מתאים לך ולאתר שלך.</p>\r\n<p>WP ROCKET הוא תוסף בתשלום, אבל הוא שווה כל אגורה - במיוחד כאשר אתה משווה אותו לכמה מהתוספים האחרים בחוץ שהם בחינם או בעלות נמוכה בהרבה. עם WP ROCKET, אתה מקבל גישה לתכונות פרימיום ותמיכה שפשוט אי אפשר לנצח.</p>\r\n<p>להלן השוואה מהירה של WP ROCKET מול כמה מתוספי המטמון המובילים האחרים:</p>\r\n<p>תוסף | עלות | תכונות | קלות שימוש</p>\r\n<p>-------|------|---------|------------</p>\r\n<p>WP Rocket| $49 לשנה | טעינה עצלנית, מזעור, דחיסת GZIP, שמירה במטמון של דפדפן, אופטימיזציה של מסדי נתונים, תמיכה ב-CDN ועוד | קל לשימוש עם הגדרות אוטומטיות ואופטימיזציות בלחיצה אחת</p>\r\n<p>W3 Total Cache| חינם/$99+ לשנה | הקטנה, דחיסת GZIP, שמירה במטמון של דפדפן, אחסון במטמון של מסד נתונים, אחסון אובייקטים במטמון ועוד | קצת יותר מורכב</p>\r\n<h2><strong>כיצד להשתמש ב-WP ROCKET עבור אתר וורדפרס</strong></h2>\r\n<p>אם יש לך אתר וורדפרס, אולי אתה תוהה כיצד להשתמש ב-WP ROCKET. WP ROCKET הוא תוסף מטמון המשמש לשיפור הביצועים של אתרי וורדפרס. זהו תוסף המטמון הפופולרי ביותר בעולם, ומשמש מיליוני משתמשי וורדפרס. להלן כמה טיפים כיצד להשתמש ב- WP ROCKET:</p>\r\n<p>1. התקן את WP ROCKET</p>\r\n<p>הצעד הראשון הוא התקנת WP ROCKET באתר הוורדפרס שלך. אתה יכול לעשות זאת על ידי כניסה לאתר WP ROCKET ולחיצה על כפתור \"הורד\".</p>\r\n<p>2. הפעל את WP ROCKET</p>\r\n<p>לאחר שהתקנת את WP ROCKET, עליך להפעיל אותו. אתה יכול לעשות זאת על ידי מעבר לקטע \"תוספים\" של לוח המחוונים של וורדפרס ולחיצה על כפתור \"הפעל\" עבור WP ROCKET.</p>\r\n<p>3. הגדר את הגדרות WP ROCKET</p>\r\n<p>לאחר שהפעלת את WP ROCKET, תצטרך להגדיר את ההגדרות שלו. אתה יכול לעשות זאת על ידי מעבר לקטע \"הגדרות\" של לוח המחוונים של וורדפרס ובחירה ב\"WP ROCKET.\" בדף ההגדרות של WP ROCKET, תצטרך לבחור את האפשרויות שברצונך להפעיל ולהשבית. אנו ממליצים להפעיל את הכל</p>\r\n<h2>5 טיפים נוספים שיעזרו לכם להגיע לתוצאות מקסימליות עם WP ROCKET</h2>\r\n<p>1. השתמש ב-CDN - רשת להעברת תוכן (CDN) יכולה לעזור לשפר את זמני הטעינה של האתר שלך על ידי שמירה במטמון של הקבצים הסטטיים שלך והגשתם ממספר מיקומים ברחבי העולם. WP Rocket משתלב עם CDNs פופולריים כמו CloudFlare, StackPath ו- MaxCDN, מה שמקל על תחילת העבודה.</p>\r\n<p>2. בצע אופטימיזציה של התמונות שלך - תמונות גדולות יכולות להיות לרוב אחד המקורות הגדולים ביותר לזמני טעינה איטיים באתר. למרבה המזל, ישנן מספר דרכים לייעל את התמונות שלך כדי לגרום להן להיטען מהר יותר. ל-WP Rocket יש תכונת עצלות תמונה שיכולה לעזור, או שאתה יכול להשתמש בתוסף כמו WP Smush כדי לדחוס את התמונות שלך.</p>\r\n<p>3. השתמש בתוסף מטמון - Caching היא אחת הדרכים היעילות ביותר לזרז אתר וורדפרס. WP Rocket הוא תוסף מטמון רב עוצמה שיכול לשפר באופן דרמטי את זמני הטעינה של האתר שלך. עם זאת, חשוב גם לוודא שאתה משתמש גם בטכניקות אחרות לאופטימיזציה של ביצועים, כגון אופטימיזציה של התמונות שלך ושימוש ברשת אספקת תוכן (CDN).</p>\r\n<p>4. השבת תכונות שאינן בשימוש - אם אינך משתמש בתכונות מסוימות של WP Rocket, כגון תכונות הקטנה או ניקוי מסד הנתונים, אתה</p>\r\n<h2><strong>האם WP ROCKET שווה את התמורה למחיר</strong></h2>\r\n<p>לדעתנו, WP ROCKET בהחלט שווה את התמורה למחיר. זהו אחד מתוספי המטמון הפופולריים ביותר עבור וורדפרס ויש לו הרבה תכונות שהופכות אותו לשווה את המחיר.</p>\r\n<h2><strong>האם WP ROCKET נחשב לתוסף ה-Caching הטוב ביותר עבור אתרי וורדפרס כיום?</strong></h2>\r\n<p>כן, WP ROCKET נחשב לתוסף ה-Caching הטוב ביותר עבור אתרי וורדפרס כיום. הסיבה לכך היא שזהו תוסף המטמון הפופולרי ביותר בשוק והורדה למעלה ממיליון פעמים. בנוסף, WP ROCKET מדורג גבוה על ידי משתמשים עם דירוג ממוצע של 4.9 מתוך 5 כוכבים.</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>WP Rocket הוא תוסף מטמון המשמש לשיפור הביצועים של אתרי וורדפרס. זהו אחד התוספים הפופולריים ביותר בשוק ויש לו למעלה ממיליון התקנות פעילות. WP Rocket זמין גם בגרסת חינמית וגם בגרסת פרימיום. גרסת הפרימיום כוללת תכונות נוספות כגון טעינה עצלנית, כללי שמירה במטמון מתקדמים ואפשרויות תווית לבנה. WP Rocket תואם לרוב ערכות הנושא והתוספים של וורדפרס.</p>', '', 'Mxy2xzDuQEur.jpg', 'wp rocket, תוסף מטמון לוורדפרס, תוסף מהירות לוורדפרס', NULL, 0x5b7b226e616d65223a22494d475f5546427669346b77346b4d632e6a7067227d5d, 'https://www.youtube.com/watch?v=aU65X9nltZ8', 'https://shareasale.com/r.cfm?b=1075949&u=3370952&m=74778&urllink=&afftrack=', 'affiliate', 0, 'downs', 0, 0, 0, 'bNzjxxHBmX8ZX3twI9sPI2piOx7YU4Wm', 'WP Rocket, תוסף מטמון לוורדפרס, תוסף מהירות לוורדפרס', '', 1, '2022-08-29 19:34:57'),
(7, 4, 'אחסון אתרי וורדפרס מנוהל בביצועים גבוהים של WP Engine', 'wpengine', '99.99', '65.99', 1, '4', '0', '0', '<p><strong>WP Engine היא חברת אחסון אתרי וורדפרס מנוהלת בביצועים גבוהים. המשימה שלהם היא להקל על מפרסמי וורדפרס ליצור ולנהל את אתרי האינטרנט שלהם, במטרה סופית לעזור להם להצמיח את העסקים שלהם. WP Engine מספק את כל מה שאתה צריך כדי להתחיל, כולל מגוון רחב של תכונות ושירותים המקלים על השימוש וניהול האתר שלך.</strong></p>\r\n<p><strong>בין אם אתה פותח אתר חדש או מתקן אתר קיים, ל-WP Engine יש את המשאבים והתמיכה הדרושים לך כדי להפעיל את האתר שלך במהירות ובקלות. הירשם עוד היום וראה כיצד הם יכולים לעזור לך לקחת את העסק שלך לשלב הבא!</strong></p>\r\n<h2><strong>מהם היתרונות הבולטים של שרתי WP Engine?</strong></h2>\r\n<p>WP Engine הוא אחד מספקי האירוח הידועים ביותר של וורדפרס בשוק. יש לו מגוון רחב של תכונות ויתרונות שמבדילים אותו מספקים אחרים.</p>\r\n<p>WP Engine מציעה פלטפורמה מנוהלת עם ביצועים גבוהים שגורמת לאתר שלך לפעול בצורה חלקה. הפלטפורמה בנויה על טכנולוגיות חזקות, מה שמבטיח שהאתר שלך פועל בצורה חלקה ויעילה.</p>\r\n<p>להלן כמה מהיתרונות הבולטים של שימוש בשרתי WP Engine:</p>\r\n<p>- שרתי WP Engine אמינים ומהירים. הם מציעים אירוח אתרים מהיר ומאובטח לאתר הוורדפרס שלך.</p>\r\n<p>- הפלטפורמה ניתנת להרחבה מאוד, מה שאומר שאתה יכול להגדיל את האתר שלך מבלי להיתקל בבעיות ביצועים.</p>\r\n<p>- שרתי WP Engine מגיעים עם תמיכה 24/7, מה שמבטיח שתמיד תהיה לך גישה לעזרה ותמיכה כשתזדקק לה.</p>\r\n<p>- שרתי WP Engine מגובים על ידי צוות מהנדסים מנוסים, המוקדשים לספק שירותי אירוח איכותיים לאתרי וורדפרס.</p>\r\n<h2><strong>האם WP Engine הוא האירוח המומלץ ביותר לאתרי וורדפרס?</strong></h2>\r\n<p>WP Engine הוא שירות אירוח וורדפרס מנוהל שמומלץ לרוב כאפשרות הטובה ביותר עבור אתרי וורדפרס. החברה מציעה מגוון תכונות ושירותים שהופכים אותה לבחירה אופטימלית עבור אתרי וורדפרס קטנים וגדולים כאחד. ל-WP Engine יש גם מגוון רחב של אפשרויות לתמחור, מה שהופך אותה לאופציה משתלמת לכל התקציבים.</p>\r\n<p>חלק מהתכונות שמבדילות את WP Engine ממארחי וורדפרס אחרים כוללים את היכולת שלו לנהל ביצועים, אבטחה וגיבויים. הפלטפורמה כוללת גם ערכת כלים מובנית לקידום אתרים ועוד מספר כלים שיעזרו לבעלי אתרים להפיק את המרב מתכני הוורדפרס שלהם. בנוסף לשירות האירוח המנוהל שלה, WP Engine מציעה גם מגוון רחב של שירותים נוספים כגון תוספים להורדה, תמיכת לקוחות ופיתוח מותאם אישית.</p>\r\n<p>אם אתה מחפש שירות אירוח מנוהל של וורדפרס המציע את כל התכונות שאתה צריך ועוד, WP Engine היא אופציה מצוינת.</p>\r\n<h2><strong>מהו טווח המחירים לאירוח ב-WP Engine?</strong></h2>\r\n<p>WP Engine מציעה שלוש תוכניות אירוח: Basic, Standard ו- Ultimate. התמחור עבור כל תוכנית נע בין $5 לחודש עד $25 לחודש. מהם היתרונות של אירוח WP Engine?</p>\r\n<p>WP Engine מציע מספר פיצ\'רים שמקלים על ניהול אתר וורדפרס. ראשית, WP Engine מארח את האתר שלך באמצעות שרתים משלו. המשמעות היא שהאתר שלך יהיה מהיר ויציב יותר מאשר אם הוא היה מתארח בשרת של צד שלישי. שנית, WP Engine מספק מספר כלים מובנים לניהול האתר שלך. אלה כוללים מנהל תוספים וורדפרס, מערכת ניהול תוכן ופתרון אבטחה. לבסוף, WP Engine מספקת תמיכת לקוחות 24/7. איך WP Engine בהשוואה לספקי אירוח אחרים של וורדפרס מנוהלים?</p>\r\n<p>WP Engine הוא אחד הספקים הבודדים שמציע גם אירוח וורדפרס מנוהל וגם ניטור ביצועים בחינם. בנוסף, WP Engine דורגה באופן עקבי כאחד מספקי האירוח הטובים ביותר של וורדפרס המנוהלים בביקורות עצמאיות. בעוד שיש ספקים אחרים המציעים תכונות דומות, מעטים יכולים להשתוות לשילוב של WP Engine של שירותי אירוח ותמיכה איכותיים.</p>\r\n<h2><strong>איך שירות לקוחות ותמיכה של WP Engine?</strong></h2>\r\n<p>WP Engine מספקת שירות לקוחות ומערכת תמיכה מצוינת הזמינה 24/7. אם אתה צריך עזרה בכל מה שקשור לאתר וורדפרס שלך, WP Engine ישמח לעזור. צוות התמיכה של WP Engine מנוסה בכל ההיבטים של וורדפרס, והם תמיד שמחים לספק סיוע. בנוסף, אם יש לך אי פעם שאלות לגבי השימוש בשירותי האירוח של WP Engine או לגבי וורדפרס עצמה, הקפד לבקר בבלוג של WP Engine לקבלת טיפים והדרכות מועילות.</p>\r\n<p>אם יש לך אי פעם שאלות לגבי השימוש בשירותי האירוח של WP Engine או לגבי וורדפרס עצמה, הקפד לבקר בבלוג של WP Engine לקבלת טיפים והדרכות מועילות.</p>\r\n<h2><strong>WP Engine בהשוואה לחברות אחסון אתרים אחרות</strong></h2>\r\n<p>WP Engine היא חברת אחסון אתרי וורדפרס מנוהלת בביצועים גבוהים. הוא דורג ב-4.6 מתוך 5 כוכבים ב-TrustPilot עם למעלה מ-1800 ביקורות. WP Engine מציעה אחסון וורדפרס מנוהל, מה שאומר שתוכלו לטפל באתר שלכם ללא כל עבודה נוספת או כאבי ראש. בנוסף, WP Engine מציעה מגוון תכונות אחרות, כמו היצע ה-Cloud Hosting שלה, המאפשר לך לאחסן את קבצי האתר שלך בענן כך שהם תמיד נגישים.</p>\r\n<p>בסך הכל, WP Engine הוא אופציה מצוינת לאירוח אתרי וורדפרס. הוא מציע אירוח מנוהל עם ביצועים גבוהים ומגוון רחב של תכונות אחרות, מה שהופך אותו לבחירה אידיאלית עבור כל מי שמחפש מארח וורדפרס מנוהל איכותי.</p>\r\n<h2><strong>בשורה התחתונה, האם שווה לי להעביר את האתר שלי ל-WP Engine</strong></h2>\r\n<p>WP Engine היא חברת אחסון וורדפרס מנוהלת בביצועים גבוהים. הם מציעים מספר תכונות שהופכות אותו למושך עבור חלק מבעלי העסקים, אך חשוב לשקול את היתרונות והחסרונות לפני ביצוע המעבר.</p>\r\n<p>יתרונות:</p>\r\n<p>-זמני טעינת אתר מהירים מאוד</p>\r\n<p>-מגוון רחב של תוכניות זמינות - תומך במספר שפות - גישה למשאבי תמיכה נרחבים - העברות חינם לאתרים גדולים</p>\r\n<p>-יכול להיות יקר אם אתה לא צריך את כל התכונות שלהם חסרונות:</p>\r\n<p>-אין שליטה על משאבי השרת</p>\r\n<p>-לא כל כך הרבה ערכות נושא ותוספים זמינים כמו כמה ספקי אירוח אחרים</p>\r\n<p>- דורש תשלום חודשי</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>WP Engine היא חברת אחסון אתרי וורדפרס מנוהלת בביצועים גבוהים שמתגאה במתן תכונות חדשניות וממשק קל לשימוש. הם מציעים הכל משטח אחסון בלתי מוגבל ועד לתמיכת לקוחות 24/7, מה שהופך אותם לבחירה המושלמת עבור כל מי שמחפש פתרון אירוח וורדפרס אמין ובמחיר סביר.</p>', '', 'otOlFzliqmGt.jpg', '', NULL, NULL, '', 'https://shareasale.com/r.cfm?b=394686&u=3370952&m=41388&urllink=&afftrack=', 'affiliate', 0, 'downs', 0, 0, 0, 'Xfd04aWPSbwHL5fM5eTaqSdDRuJIXZ05', '', '', 1, '2022-08-30 19:33:54'),
(8, 3, 'אלמנטור - בונה האתרים מספר 1 עבור וורדפרס', 'elementor', '299.00', '199.00', 1, '3', '0', '0', '<p style=\"direction: rtl; \">אם אתה מחפש ליצור אתר אינטרנט, יש הרבה אפשרויות בחוץ. אבל איזה מהם הוא הטוב ביותר? במאמר זה, נסקור את Elementor, בונה האתרים מספר 1 עבור וורדפרס. עם אלמנטור תוכלו ליצור אתרים יפים ופונקציונליים תוך דקות, ללא צורך בקידוד! אז אם אתם מחפשים בונה אתרים ידידותי למשתמש וקל לשימוש, אל תחפשו רחוק יותר מ- Elementor!</p>\r\n<h2 style=\"direction: rtl; \"><strong>אלמנטור - בונה האתרים מספר 1 עבור וורדפרס</strong></h2>\r\n<p style=\"direction: rtl; \">אם אתם מחפשים בונה אתרים שיוכל לעזור לכם ליצור אתרים יפים ורספונסיביים במהירות ובקלות, אל תחפשו רחוק יותר מ-Elementor. אלמנטור היא בונה האתרים מספר אחת עבור וורדפרס, וקל להבין מדוע.</p>\r\n<p style=\"direction: rtl; \">עם אלמנטור, אתה יכול ליצור אתרים יפים, רספונסיביים במהירות ובקלות. אתה יכול גם להתאים אישית את האתרים שלך עם תכונות חזקות כמו גרירה ושחרור Builder, ערכות נושא מדהימות ועוד. בין אם אתה מחפש ליצור אתר פשוט או אתר מסחר אלקטרוני מורכב, ל- Elementor יש את כל מה שאתה צריך.</p>\r\n<p style=\"direction: rtl; \">אז אם אתם מחפשים בונה אתרים קל לשימוש וידידותי למשתמש, אל תחפשו רחוק יותר מ-Elementor!</p>\r\n<h2 style=\"direction: rtl; \"><strong>מדוע אלמנטור הוא תוסף וורדפרס הנמכר ביותר בעולם?</strong></h2>\r\n<p style=\"direction: rtl; \">אלמנטור הוא תוסף וורדפרס הנמכר ביותר בעולם מסיבה כלשהי - הוא פשוט לשימוש ועמוס בתכונות.</p>\r\n<p style=\"direction: rtl; \">ראשית, אלמנטור אינטואיטיבי לחלוטין. אתה יכול ליצור אתרים תוך דקות מבלי שתצטרך לקרוא תיעוד אינסופי. שנית, ל- Elementor יש המון תכונות שהופכות את בניית האתרים לקלה ומהנה. לדוגמה, אתה יכול להוסיף תפריטים ווידג\'טים מותאמים אישית, ליצור דפים ופוסטים רבי עוצמה ועוד הרבה יותר.</p>\r\n<p style=\"direction: rtl; \">לבסוף, אלמנטור במחיר סביר. זה בחינם להורדה ולשימוש, ואין עמלות נסתרות או דמי מנוי. אז בין אם אתה משתמש וורדפרס ותיק או רק מתחיל, Elementor הוא התוסף המושלם לצרכים שלך.</p>\r\n<h2 style=\"direction: rtl; \"><strong>מהם היתרונות הבולטים של אלמנטור?</strong></h2>\r\n<p style=\"direction: rtl; \">ישנם מספר יתרונות לשימוש באלמנטור בעת בניית אתר אינטרנט. העיקרית ביניהם היא העובדה ש-Elementor היא פלטפורמה חינמית לחלוטין. המשמעות היא שאין עלויות נסתרות הקשורות לשימוש ב- Elementor, מה שיכול להיות מועיל בעת תכנון התקציב של הפרויקט שלך.</p>\r\n<p style=\"direction: rtl; \">יתרון נוסף של אלמנטור הוא הממשק הידידותי למשתמש. אלמנטים בתוך הפלטפורמה קלים לאיתור ולשימוש, מה שהופך את יצירת האתר לפשוטה. לבסוף, אלמנטור היא אחת מהפלטפורמות הפופולריות ביותר לבניית אתרים בשוק, מה שאומר שיש סיכוי טוב שהיא תענה על הצרכים והציפיות שלכם.</p>\r\n<h2 style=\"direction: rtl; \"><strong>מה המחיר של אלמנטור לוורדפרס?</strong></h2>\r\n<p style=\"direction: rtl; \">המחיר של אלמנטור לוורדפרס הוא 69 דולר לחודש. מחיר זה כולל מנוי חינם לבלוג Elementor, המציע עדכונים שבועיים על הפיצ\'רים והשינויים העדכניים ביותר בתוכנה. זה כולל גם גישה לפורום התמיכה ומגוון שלם של משאבים, כולל הדרכות וידאו.</p>\r\n<p style=\"direction: rtl; \">מהם כמה מהחסרונות הפוטנציאליים של השימוש ב- Elementor?</p>\r\n<p style=\"direction: rtl; \">ישנם כמה חסרונות פוטנציאליים לשימוש באלמנטור בעת בניית אתר אינטרנט. ראשית, אלמנטור אינה מקיפה כמו אפשרויות פלטפורמה יקרות יותר. המשמעות היא שייתכן שתצטרך לקבל כמה החלטות לגבי התכונות שברצונך לכלול באתר האינטרנט שלך והאם תכונות אלו נחוצות עבור הפרויקט שלך.</p>\r\n<p style=\"direction: rtl; \">שנית, אלמנטור לא מציעה אפשרויות עיצוב רבות כמו אפשרויות פלטפורמה יקרות יותר. זה יכול להיות חיסרון אם אתה רוצה ליצור אתר אינטרנט שנראה ייחודי ומקצועי. לבסוף, Elementor היא פלטפורמה חדשה יחסית, כך שייתכן שיש כמה קינקים שצריך לפתור עדיין.</p>\r\n<h2 style=\"direction: rtl; \"><strong>מדוע רוב המתכנתים בעולם מעדיפים לעבוד עם אלמנטור?</strong></h2>\r\n<p style=\"direction: rtl; \">ישנן סיבות רבות לכך שרוב המתכנתים מעדיפים לעבוד עם אלמנטור בעת יצירת אתרים. כמה מהסיבות החשובות ביותר הן העיצוב הידידותי למשתמש שלו, מגוון התכונות הרחב שלו והעובדה שהוא חופשי לשימוש.</p>\r\n<p style=\"direction: rtl; \">אלמנטור הוא בונה אתרים ידידותי למשתמש המושלם למתחילים. יש לו ממשק גרירה ושחרור קל לשימוש, כך שתוכל ליצור אתרים יפים ללא כל ידע בקידוד. ל- Elementor יש גם מגוון רחב של תכונות, כולל תבניות, ערכות נושא ווידג\'טים. זה אומר שאתה יכול ליצור אתר בדיוק כמו שאתה רוצה שהוא ייראה.</p>\r\n<p style=\"direction: rtl; \">אלמנטור היא חופשית לשימוש, מה שהופך אותה לאחד מבוני האתרים הפופולריים ביותר בשוק. זה גם אמין ומהיר, כלומר אתה יכול ליצור את האתר שלך במהירות ובקלות.</p>\r\n<p style=\"direction: rtl; \">בסך הכל, אלמנטור הוא בונה אתרים מצוין המושלם למתחילים ולמתכנתים מנוסים כאחד. יש לו עיצוב ידידותי למשתמש, מגוון רחב של תכונות, והוא חופשי לשימוש.</p>\r\n<h2 style=\"direction: rtl; \"><strong>אלמנטור בהשוואה לתוספי וורדפרס אחרים</strong></h2>\r\n<p style=\"direction: rtl; \">ישנם כמה תוספים שונים שאנשים משתמשים בהם כדי לבנות את האתרים שלהם, אבל אלמנטור הוא אחד הפופולריים ביותר. אלמנטור הוא תוסף שנוצר במיוחד לבניית אתרים עם וורדפרס. יש לו הרבה תכונות שאין לתוספי וורדפרס אחרים, והוא גם קל יחסית לשימוש.</p>\r\n<p style=\"direction: rtl; \">אחד ההבדלים הגדולים ביותר בין אלמנטור לתוספים אחרים הוא שאלמנטור מנצל את הכוח של וורדפרס. זה אומר שאתה יכול ליצור אתרים עם אלמנטור שנראים ומרגישים כמו אתרים מסורתיים. אתה יכול גם להשתמש ב-Elementor כדי ליצור דפי נחיתה, טפסי אינטרנט ועוד.</p>\r\n<p style=\"direction: rtl; \">אם אתה חדש בבניית אתרים, או אם אתה רוצה ליצור אתרים מורכבים יותר עם וורדפרס, אז אתה בהחלט צריך לשקול להשתמש באלמנטור. זהו אחד התוספים המגוונים ביותר שקיימים, והוא גם קל מאוד לשימוש.</p>', '', 'tEfwkAJxJORz.png', 'elementor, elementor pro', NULL, 0x5b7b226e616d65223a22494d475f576342657a48345066615a512e6a7067227d2c7b226e616d65223a22494d475f4747427668366f355641545a2e6a7067227d5d, 'https://www.youtube.com/watch?v=701pwm78Q90', 'https://shareasale.com/r.cfm?b=1748750&u=3370952&m=108888&urllink=&afftrack=', 'affiliate', 0, 'downs', 0, 0, 0, 'hdQznu41xgHaqvABnsmte6AIs0mWdwAu', 'Elementor, Elementor Pro', 'אם אתה מחפש ליצור אתר אינטרנט, יש הרבה אפשרויות בחוץ. אבל איזה מהם הוא הטוב ביותר? במאמר זה, נסקור את Elementor, בונה האתרים מספר 1 עבור וורדפרס.', 1, '2022-08-31 11:37:27'),
(9, 10, 'Anyword - כלי קופירייטינג AI עם תוצאות צפויות [קופון בלעדי של 20% מצורף]', 'anyword', '79.99', '49.99', 1, '10', '0', '0', '<p><strong>בעולם בקצב מהיר, חשוב להיות יעיל בכל מה שאתה עושה - במיוחד בכל מה שקשור לקריירה שלך. בעזרת כלי קופירייטינג המופעלים על ידי בינה מלאכותית כמו Anyword, אתה יכול לבצע את העבודה שלך במהירות וביעילות, עם תוצאות צפויות שאתה יכול לסמוך עליהן.</strong></p>\r\n<h2><strong>Anyword AI הוא אחד הכלים האוטומטיים המובילים בעולם לכתיבת תוכן על ידי בינה מלאכותית</strong></h2>\r\n<p>Anyword הוא כלי חזק וקל לשימוש קופירייטינג AI שיכול לעזור לך להשיג תוצאות צפויות. עם Anyword, אתה יכול לקבל תוכן מקורי באיכות גבוהה שנכתב אוטומטית לאתר או לבלוג שלך. כל מה שאתה צריך לעשות הוא להזין את מילת המפתח או הביטוי שאליו ברצונך למקד, ו-Anyword תעשה את השאר.</p>\r\n<h2><strong>מהם היתרונות העיקריים של Anyword AI ומדוע כותבי תוכן רבים משתמשים בו</strong></h2>\r\n<p>Anyword הוא כלי קופירייטינג מבוסס בינה מלאכותית שמציע תוצאות צפויות. הוא נועד לעזור לכותבי תוכן לייצר תוכן איכותי בצורה יעילה יותר. Anyword יכולה לעזור לכותבי תוכן לשפר את מהירות הכתיבה והדיוק שלהם, והיא גם יכולה לעזור בסיעור מוחות והמצאת רעיונות חדשים.</p>\r\n<p>כמה מהיתרונות העיקריים של שימוש ב- Anyword AI כוללים:</p>\r\n<p>1. מהירות ודיוק כתיבה מוגברים</p>\r\n<p>2. תוכן איכותי יותר</p>\r\n<p>3. עוד רעיונות ויצירתיות</p>\r\n<p>4. פחות זמן מושקע בעריכה והגהה</p>\r\n<p>5. הגברת היעילות והפרודוקטיביות</p>\r\n<h2><strong>העולם עובר לכתיבת תוכן מבוסס AI</strong></h2>\r\n<p>כולנו יודעים שהעולם מתקדם לעבר בינה מלאכותית (AI). גם בתחום כתיבת התוכן, AI לאט אבל בטוח עושה את נוכחותו. ואין להכחיש שלכלי כתיבת תוכן מבוססי בינה מלאכותית יש כמה יתרונות על פני כלים מסורתיים.</p>\r\n<p>ראשית, הם יכולים להיות מדויקים יותר ולהניב תוצאות צפויות יותר. הסיבה לכך היא שהם מסתמכים על אלגוריתמים כדי לייצר את הפלט שלהם, בניגוד לכותבים אנושיים שלעיתים עשויים לטעות או לייצר תוכן משנה.</p>\r\n<p>יתרון נוסף של כלי כתיבת תוכן מבוססי AI הוא שהם יכולים לחסוך לך הרבה זמן ומאמץ. לדוגמה, אם אתה צריך ליצור מספר גדול של מאמרים או קטעי תוכן אחרים, כלי בינה מלאכותית יכול לעשות זאת הרבה יותר מהר ממה שכותב אנושי יכול לעשות.</p>\r\n<p>אז אם אתם מחפשים כלי לכתיבת תוכן שיכול לתת לכם תוצאות מדויקות וצפויות יותר, Anyword בהחלט שווה לשקול.</p>\r\n<h2><strong>חסוך זמן יקר ועבוד עם כותב תוכן אוטומטי שיעשה עבורך את כל העבודה</strong></h2>\r\n<p>אם אתה כמו רוב האנשים, אתה מבין כמה חשוב שיהיה תוכן איכותי באתר שלך. אבל יצירת תוכן זה עשויה להיות גוזלת זמן ויקרה. לכן Anyword היא כלי כה רב ערך. זהו כלי קופירייטינג מבוסס בינה מלאכותית שיכול לעזור לך ליצור תוכן במהירות ובקלות, מבלי שתצטרך לשכור כותב מקצועי.</p>\r\n<p>Anyword דואגת עבורך לכל המשימות הכבדות, כך שתוכל להתמקד בהיבטים אחרים של העסק שלך. ומכיוון שהוא מופעל על ידי AI, אתה יכול להיות בטוח שהתוצאות יהיו באיכות גבוהה. אז אם אתם מחפשים דרך לחסוך זמן וכסף ביצירת תוכן, Anyword בהחלט שווה בדיקה.</p>\r\n<h2><strong>כלי זה יכול ליצור עותק שיווקי בעל ביצועים גבוהים עבור כל ערוץ ופורמט</strong></h2>\r\n<p>אם אתה מחפש כלי שיעזור לך ליצור עותק שיווקי בעל ביצועים גבוהים, אל תחפש יותר מאשר Anyword. כלי AI רב עוצמה זה יכול ליצור עותק עבור כל ערוץ ופורמט, מה שמקל על השגת התוצאות הדרושות לך. עם Anyword, אתה יכול להיות בטוח שהקמפיינים השיווקיים שלך יהיו מוצלחים - לא משנה באיזה תעשייה אתה עוסק.</p>\r\n<h2><strong>Anyword AI יכול לכתוב לך תוכן עבור דפי נחיתה, אתרים, מיילים וכל מה שאי פעם רצית</strong></h2>\r\n<p>אם אתה מחפש כלי לכתיבת תוכן שיכול לעזור לך ליצור דפי נחיתה, תוכן בדוא\"ל או כל דבר אחר שתצטרך, Anyword AI הוא הכלי המושלם עבורך. כלי AI רב עוצמה זה יכול לעזור לך להשיג תוצאות צפויות עם התוכן שלך, מה שיקל עליך ליצור תוכן באיכות גבוהה עבור הקוראים שלך.</p>\r\n<p>Anyword AI קל לשימוש וניתן לגשת אליו מכל מקום. כל מה שאתה צריך זה חיבור לאינטרנט. כלי זה יכול לעזור לך ליצור תוכן לאתר, לבלוג או לרשימת הדוא\"ל שלך בתוך דקות.</p>\r\n<p>הנה מה Anyword AI יכול לעשות עבורך:</p>\r\n<p>1. כתבו תוכן איכותי לאתר שלכם</p>\r\n<p>אם אתה רוצה ליצור תוכן לאתר שלך איכותי ומרתק, Anyword AI יכול לעזור לך. כלי רב עוצמה זה יכול לעזור לך ליצור דפי נחיתה, פוסטים בבלוג, תיאורי מוצרים ועוד.</p>\r\n<p>2. קבל יותר מנויים באימייל</p>\r\n<p>Anyword AI יכול גם לעזור לך להשיג יותר מנויים באימייל. כלי זה יכול לעזור לך לכתוב תוכן דוא\"ל יעיל ומרתק. עם Anyword AI, אתה יכול בקלות להגדיל את רשימת הדוא\"ל שלך ולקבל יותר לידים.</p>\r\n<p>3. הגדל את המכירות וההמרות שלך</p>\r\n<p>Anyword AI יכול גם לעזור לך להגדיל את המכירות וההמרות שלך. כלי זה יכול לעזור לך לכתוב דפי נחיתה ותיאורי מוצרים יעילים ומשכנעים. עם Anyword AI, אתה יכול בקלות להגדיל את שיעור ההמרה שלך ולהשיג יותר מכירות.</p>\r\n<h2><strong>מה המחיר של Anyword AI וכיצד רוכשים?</strong></h2>\r\n<p>הכלי Anyword AI זמין לרכישה באתר תמורת $197. אתה יכול גם להירשם לגרסת ניסיון בחינם כדי לבדוק את תכונות הכלי.</p>\r\n<h2><strong>Anyword AI בהשוואה לכותבי תוכן אחרים מבוססי AI</strong></h2>\r\n<p>אם אתה מחפש כלי לכתיבת תוכן שיכול לעזור לך להפיק תוצאות טובות יותר, אז אתה בהחלט צריך לבדוק את Anyword. זהו כלי מבוסס AI שמבטיח לספק תוצאות צפויות יותר מכלים דומים אחרים בשוק.</p>\r\n<p>עד כה, התרשמתי מאוד ממה ש-Anyword הצליחה לעשות. זה עזר לי לשפר את כישורי הכתיבה שלי וגם הקל עליי להעלות רעיונות למאמרים חדשים. בסך הכל, אני בהחלט ממליץ על Anyword לכל מי שמחפש כלי לכתיבת תוכן שיכול לעזור לו להפיק תוצאות טובות יותר.</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>לסיכום, Anyword הוא כלי נהדר לקופירייטינג מכיוון שהוא מספק תוצאות צפויות. אתה יודע בדיוק מה אתה הולך לקבל כשאתה משתמש ב- Anyword, מה שהופך אותה למשאב בעל ערך עבור עסקים ואנשים פרטיים כאחד. אם אתה מחפש כלי שיכול לעזור לך לכתוב עותק טוב יותר, אז Anyword בהחלט שווה בדיקה.</p>\r\n<p></p>', '', '9kImcoCzdsgL.png', 'anyword, anyword ai, ai copywriter', NULL, 0x5b7b226e616d65223a22494d475f427a4267436a5374465a66522e706e67227d2c7b226e616d65223a22494d475f395a476a4a7755304b58345a2e6a7067227d5d, 'https://www.youtube.com/watch?v=BcnAATROVf0', 'https://anyword.com/data-driven-basic/?fpr=ran72', 'affiliate', 0, 'downs', 0, 0, 0, 'OYgYra5G1WdNywAh054cIiAU0Y9pZ2et', 'Anyword, Anyword ai, ai copywriter', 'Anyword הוא כלי חזק וקל לשימוש קופירייטינג AI שיכול לעזור לך להשיג תוצאות צפויות. עם Anyword, אתה יכול לקבל תוכן מקורי באיכות גבוהה שנכתב אוטומטית לאתר או לבלוג שלך.', 1, '2022-08-31 18:45:05'),
(10, 10, 'ArticleFroge - כותב תוכן AI האולטימטיבי בלחיצה אחת', 'articlefroge', '67.99', '43.99', 1, '10', '0', '0', '<p>ArticleFroge הוא כלי כתיבת תוכן בינה מלאכותית המבטיח להפוך את חייך כיוצרי תוכן להרבה יותר קלים. בלחיצה אחת בלבד, זה יכול לעזור לך ליצור תוכן באיכות גבוהה עבור הבלוג או האתר שלך. מה שמייחד את ArticleFroge מכלי כתיבת תוכן אחרים בינה מלאכותית היא היכולת שלו להבין את סגנון הכתיבה והקול הייחודיים שלך. משמעות הדבר היא שהוא יכול לעזור לך ליצור תוכן שנשמע כאילו הוא נכתב על ידך, מה שיגדיל את הסיכוי שיעסיק את הקוראים שלך וימיר אותם.</p>\r\n\r\n<p>ל-ArtikelFroge יש גם מגוון תכונות המקלות על השימוש, כגון בודק דקדוק מובנה ותזאורוס. זה אומר שאתה יכול להיות בטוח שהתוכן שלך נטול שגיאות ונשמע טבעי.</p>\r\n<p>אם אתה מחפש כלי לכתיבת תוכן שיכול לעזור לך לחסוך זמן וליצור תוכן באיכות גבוהה, אז ArticleFroge בהחלט שווה לשקול.</p>\r\n<p><strong>ArticleFroge יוצר תוכן שמותאם אוטומטית ל-SEO בתוך 60 שניות</strong></p>\r\n<p>אם אתה מחפש כלי לכתיבת תוכן שיכול לעזור לך ליצור מאמרים המותאמים אוטומטית לקידום אתרים, אז ArticleFroge הוא הפתרון המושלם. בלחיצה אחת, ArticleFroge יעזור לך ליצור תוכן עשיר במילות מפתח ותואם את כל תקני SEO העדכניים ביותר.</p>\r\n<p>לא רק ArticleFroge חוסך לך זמן על ידי יצירת מאמרים עבורך, אלא הוא גם מבטיח שהתוכן שלך יהיה באיכות הגבוהה ביותר. ArticleFroge משתמש בבינה מלאכותית כדי לנתח את קהל היעד שלך ולהבין איזה סוג של תוכן הם מחפשים. לאחר מכן הוא כותב מאמרים שמובטח לעניין ולהמיר את הקוראים שלך.</p>\r\n<p>אז אם אתם מחפשים כלי שיכול לעזור לכם ליצור תוכן ידידותי ל-SEO בתוך שניות, אז ArticleFroge הוא הפתרון המושלם.</p>\r\n<p><strong>כותב תוכן AI אוטומטי לחלוטין עבור הדור הבא הוא ArticleFroge</strong></p>\r\n<p>אם אתה מחפש כותב תוכן בינה מלאכותית אוטומטית לחלוטין, אל תחפש רחוק יותר מ-ArtikelFroge. בלחיצה אחת, ArticleFroge יכול ליצור מאמרים באיכות גבוהה בכל נושא, מה שהופך אותו לכלי המושלם עבור משווקי תוכן ובלוגרים.</p>\r\n<p><strong>כיצד ליצור מאמרים ידידותיים לקידום אתרים עבור האתר שלך עם ArticleFroge</strong></p>\r\n<p>אם אתה מנהל אתר אינטרנט, אתה יודע כמה חשוב שיהיו מאמרים כתובים היטב וידידותיים לקידום אתרים. אבל יצירת תוכן כזה עשויה להיות גוזלת זמן ויקרה. זה המקום שבו ArticleFroge נכנס לתמונה.</p>\r\n<p>ArticleFroge הוא כותב תוכן בינה מלאכותית שיכול ליצור עבורך מאמרים בלחיצה אחת. פשוט הזן את הנושא וכמה מילות מפתח, ו-ArtikelFroge יפיק מאמר מותאם לצרכים שלך.</p>\r\n<p>בנוסף, מכיוון ש-ArtikelFroge משתמש בבינה מלאכותית, הוא יכול לשפר כל הזמן את איכות הכתיבה שלו, כלומר המאמרים שלך רק ישתפרו עם הזמן. אז למה לא לנסות?</p>\r\n<p><strong>ה-AI של ArticleFroge יכול לייצר מאמרים שלמים באותה רמת איכות כמו אדם</strong></p>\r\n<p>ArticleFroge הוא כותב תוכן AI האולטימטיבי שיכול לייצר מאמרים שלמים באותה רמת איכות כמו אדם. בלחיצה אחת בלבד, ArticleFroge יכול לעזור לך ליצור תוכן ייחודי ומשכנע עבור הבלוג או האתר שלך. </p>\r\n<p><strong>יתרונות מרכזיים בשימוש ב-ArtikelForge והסיבות לכך שמפיקי תוכן משתמשים בו כדי לייצר מאמרים</strong></p>\r\n<p>אם אתה מחפש כלי שיעזור לך לייצר מאמרים באיכות גבוהה, אז אתה בהחלט צריך לבדוק את ArticleForge. עם יכולות הבינה המלאכותית שלו, ArticleForge יכול לעזור לך לכתוב מאמרים הרבה יותר מהר מאשר אם היית עושה זאת בעצמך. להלן כמה יתרונות מרכזיים בשימוש ב-ArtikelForge:</p>\r\n<p>1. ArticleForge יכול לעזור לך לחסוך הרבה זמן.</p>\r\n<p>אם אתה מישהו שמייצר הרבה תוכן, אז אתה יודע שתהליך הכתיבה יכול להיות די גוזל זמן. עם ArticleForge, אתה יכול לכתוב את המאמרים שלך בשבריר מהזמן.</p>\r\n<p>2. ArticleForge מייצרת תוכן באיכות גבוהה.</p>\r\n<p>מכיוון ש-ArtikelForge משתמשת בבינה מלאכותית לכתיבת מאמרים, אתם יכולים להיות בטוחים שאיכות המאמרים תהיה גבוהה מאוד. למעשה, יצרני תוכן רבים שמשתמשים ב-ArtikelForge אומרים שאיכות המאמרים שהם מייצרים טובה יותר ממה שהם יכלו לייצר בעצמם.</p>\r\n<p>3. ArticleForge קל מאוד לשימוש.</p>\r\n<p>יתרון גדול נוסף של השימוש ב-ArtikelForge הוא שהוא קל מאוד לשימוש. אתה לא צריך שום כישורים או ידע מיוחדים כדי להשתמש בו - פשוט הזן את נושא המאמר שלך ולחץ על \"הפק\". זה כל מה שצריך</p>\r\n<p><strong>יוצר תוכן בינה מלאכותית החזק ביותר שיכול ליצור תוכן מותאם SEO עבור האתר שלך</strong></p>\r\n<p>אם אתה מחפש את יוצר תוכן הבינה המלאכותית החזק ביותר, אתה בהחלט צריך לבדוק את ArticleFroge. הכלי המדהים הזה יכול לעזור לך ליצור תוכן מותאם SEO לאתר שלך בלחיצה אחת בלבד. לא רק זה, אלא שהוא גם יכול לעזור לך לשפר את דירוג האתר שלך במנועי החיפוש.</p>\r\n<p><strong>כמה עולה ArticleForge ואיך קונים אותו?</strong></p>\r\n<p>ArticleForge זמין לרכישה דרך האתר שלנו. העלות היא 63.99₪ לחודש, וניתן לבטל בכל עת. יש גם ניסיון חינם ל-7 ימים. כדי להירשם, פשוט צור חשבון והזן את פרטי התשלום שלך.</p>\r\n<p><strong>השוואת כותב המאמר ArticleForge לכותבי תוכן אחרים מבוססי AI</strong></p>\r\n<p>כשמדובר בכותבי תוכן מבוססי בינה מלאכותית, אין ספק ש-ArtikelForge היא הטובה ביותר בעסק. בלחיצה אחת, אתה יכול ליצור מאמרים ייחודיים באיכות גבוהה המושלמות לבלוג או לאתר שלך. עם זאת, מה מייחד את ArticleForge מהמתחרים?</p>\r\n<p>ראשית, ArticleForge משתמשת בטכנולוגיה חדשנית כדי ליצור את המאמרים שלה. כותבי תוכן אחרים המבוססים על בינה מלאכותית עשויים להשתמש בשיטות דומות, אך אף אחת מהן לא יכולה להשתוות למהירות או לדיוק של ArticleForge. הסיבה לכך היא ש-ArtikelForge תוכנן במיוחד ליצירת תוכן. כתוצאה מכך, הוא יכול לייצר מאמרים הרבה יותר מהר מאשר כותבי תוכן אחרים מבוססי AI.</p>\r\n<p>בנוסף, ArticleForge מייצרת מאמרים שהם הרבה יותר מדויקים מאלה שמיוצרים על ידי כותבי תוכן אחרים מבוססי AI. הסיבה לכך היא ש-ArtikelForge לוקחת בחשבון מגוון רחב של גורמים בעת יצירת המאמרים שלה. לדוגמה, הוא מסתכל על נושא המאמר, קהל היעד, סגנון הכתיבה ואפילו הטון הכללי של היצירה. כתוצאה מכך, ArticleForge יכול ליצור מאמרים המותאמים במיוחד לצרכים שלך.</p>\r\n<p>לבסוף, ArticleFroge מציע מגוון רחב של אפשרויות התאמה אישית. עם כותבי תוכן אחרים מבוססי בינה מלאכותית, לעתים קרובות אתה מוגבל ל-a</p>\r\n<p><strong>סיכום</strong></p>\r\n<p>אם אתם מחפשים כלי לכתיבת תוכן שיעזור לכם לחסוך זמן ולייצר מאמרים באיכות גבוהה, אז ArticleFroge בהחלט שווה בדיקה. עם טכנולוגיית הבינה המלאכותית שלה, ArticleFroge יכולה לכתוב במהירות מאמרים על כל נושא שאתה נותן לו, מה שהופך אותו לכלי המושלם עבור עסקים או אנשים שזקוקים לתוכן אבל אין להם זמן לכתוב אותו בעצמם.</p>\r\n<p></p>', '', '7ZM0qLGzmtjA.png', 'article forge, ai content writer', NULL, 0x5b7b226e616d65223a22494d475f627a427557587a616f6a73362e6a7067227d2c7b226e616d65223a22494d475f46734e326562526d736742352e706e67227d5d, 'https://youtu.be/GOcSAaDy2hA', 'https://www.articleforge.com/?ref=b7aae0', 'affiliate', 0, 'downs', 0, 0, 0, 'SwMZDnbCZQ8OYuyBpDEUyonkjDIUAtm6', 'articleforge', '﻿ArticleFroge הוא כלי כתיבת תוכן בינה מלאכותית המבטיח להפוך את חייך כיוצרי תוכן להרבה יותר קלים. בלחיצה אחת בלבד,', 1, '2022-09-01 09:19:32');
INSERT INTO `products` (`id`, `category_id`, `title`, `slug`, `price`, `sprice`, `is_sale`, `categories`, `membership_id`, `files`, `body`, `pbody`, `thumb`, `tags`, `audio`, `images`, `youtube`, `affiliate`, `type`, `expiry`, `expiry_type`, `hits`, `likes`, `ratings`, `token`, `keywords`, `description`, `active`, `created`) VALUES
(11, 10, 'Contentbot - כותב הבינה המלאכותית המתקדם בעולם ליצירת מאמרים ארוכים', 'contentbotai', '130.99', '97.99', 1, '10', '0', '0', '<h1><strong>Contentbot - כותב הבינה המלאכותית המתקדם בעולם ליצירת מאמרים ארוכים</strong></h1>\r\n<p>Contentbot הוא כלי ליצירת תוכן המופעל על ידי AI שיכול לעזור לך ליצור מאמרים עבור הבלוג או האתר שלך בתוך דקות. עם Contentbot, כל מה שאתה צריך לעשות הוא להזין נושא והתוכנה תעשה את השאר, מביצוע מחקר ועד מבנה המאמר שלך והוספת תמונות.Contentbot הוא AI לכתיבת בלוג שיעצב את המאמרים שלך ויעשה את כל המחקר עבור אתה. כל מה שאתה צריך לעשות הוא להזין נושא, והתוכנית תעלה מאמר של 800-1500 מילים ותערוך לשגיאות דקדוק.</p>\r\n<h2><strong>כלי Contentbot AI מאפשר לך ליצור במהירות עותק בלוג וקווי מתאר מדהימים</strong></h2>\r\n<p>אם אתה מחפש דרך מהירה וקלה ליצור עותק מדהים של בלוג, אל תחפש יותר מאשר Contentbot. כלי AI רב עוצמה זה יכול לעזור לך ליצור במהירות תוכן באיכות גבוהה עבור הבלוג שלך, כולל קווי מתאר והעתקה. כל שעליך לעשות הוא להזין מספר מילות מפתח הקשורות לנושא שלך, ו-Contentbot יתחיל לעבוד ביצירת תוכן ייחודי ומעניין עבורך.</p>\r\n<h2><strong>Contentbot נותן לך 35+ כלי AI מכוונים בקצות אצבעותיך כדי ליצור מאמרים מגניבים</strong></h2>\r\n<p>אם אתה מחפש כלי שיעזור לך לכתוב מאמרים טובים יותר, עליך לבדוק את Contentbot. זה עוזר כתיבה בינה מלאכותית שיכול לעזור לך ליצור מאמרים מדהימים בקלות.</p>\r\n<p>ל-Contentbot יש מספר תכונות שגורמות לו לבלוט על פני עוזרי כתיבה אחרים של AI. ראשית, הוא משתמש בטכניקות מתקדמות של עיבוד שפה טבעית (NLP) כדי להבין את סגנון הכתיבה שלך ולשכפל אותו במאמרים שלו. זה מבטיח שהמאמרים שאתה יוצר עם Contentbot הם באיכות גבוהה כמו הכתבים שלך.</p>\r\n<p>תכונה נהדרת נוספת של Contentbot היא היכולת שלו לבצע מחקר עבורך. בכמה לחיצות בלבד, Contentbot יכול לאסוף נתונים ומידע ממגוון מקורות ולרכז אותם למאמר חקר היטב. זה חוסך לך הרבה זמן ומאמץ שאחרת היית משקיע בביצוע מחקר ידני.</p>\r\n<p>לבסוף, Contentbot לומד ומשפר כל הזמן את היכולות שלו. עם כל מאמר חדש שהוא כותב, Contentbot נעשה חכם יותר וטוב יותר בשכפול של סגנון הכתיבה שלך ולבצע עבורך מחקר.</p>\r\n<p>אם אתה מחפש עוזר כתיבה AI חזק שיעזור לך ליצור מאמרים מדהימים, אל תחפש יותר מאשר Contentbot.</p>\r\n<h2><strong>Contentbot AI כותב מאמרים ידידותיים לקידום אתרים של יותר מ-2000 מילים תוך דקות כדי לקבל יותר תנועה</strong></h2>\r\n<p>אם אתה מחפש דרך להשיג יותר תנועה לאתר שלך, אחד הדברים הטובים ביותר שאתה יכול לעשות הוא להתחיל לכתוב מאמרים ידידותיים לקידום אתרים. ואם אין לך את הזמן או הכישורים לכתוב את המאמרים האלה בעצמך, אז אתה צריך Contentbot.</p>\r\n<p>Contentbot הוא כותב הבינה המלאכותית המתקדם בעולם. זה יכול ליצור מאמרים מדהימים בתוך דקות, וכל המאמרים האלה הם ידידותיים לקידום אתרים. זה אומר שהם יעזרו לך לדרג גבוה יותר במנועי החיפוש ולקבל יותר תנועה לאתר שלך.</p>\r\n<p>Contentbot קל לשימוש. כל שעליך לעשות הוא להזין את נושא המאמר שלך ולציין כמה מילים אתה רוצה שזה יהיה. לאחר מכן, Contentbot יתחיל לעבוד וייצור עבורך מאמר מהמם תוך דקות.</p>\r\n<p>לאחר מכן תוכל לפרסם מאמר זה באתר או בבלוג שלך ולהתחיל לקבל יותר תנועה מיד. אז אם אתה מחפש דרך מהירה וקלה להשיג יותר תנועה, נסה את Contentbot עוד היום.</p>\r\n<h2><strong>מהם היתרונות העיקריים של Contentbot AI ומדוע כותבי תוכן צריכים להשתמש בו?</strong></h2>\r\n<p>ישנם יתרונות רבים בשימוש ב- Contentbot AI לכתיבת תוכן. להלן כמה מהיתרונות העיקריים:</p>\r\n<p>1. Contentbot AI יכול לעזור לך ליצור מאמרים מדהימים במהירות ובקלות. זה גם יכול לעזור לך לשפר את איכות המאמרים שלך.</p>\r\n<p>2. Contentbot AI יכול לעזור לך לחסוך זמן על ידי יצירה אוטומטית של מאמרים עבורך.</p>\r\n<p>3. Contentbot AI יכול לעזור לך להגביר את הפרודוקטיביות שלך על ידי יצירת מאמרים מהר יותר ממה שאתה יכול לכתוב אותם בעצמך.</p>\r\n<p>4. Contentbot AI יכול לעזור לך לקבל יותר תנועה לאתר או לבלוג שלך על ידי יצירת תוכן באיכות גבוהה שאנשים ירצו לקרוא ולשתף.</p>\r\n<p>5. Contentbot AI מאוד סביר, מה שהופך אותו לאופציה מצוינת עבור כותבי תוכן בתקציב.</p>\r\n<h2><strong>Contentbot העתיד של כתיבת בינה מלאכותית נלחם נגד הדף הריק!</strong></h2>\r\n<p>אם אתה משהו כמוני, אז המחשבה לבהות בדף ריק מספיקה כדי להכניס אותך לפאניקה. החדשות הטובות הן שעכשיו יש פתרון לבעיה הזו בצורה של Contentbot.</p>\r\n<p>Contentbot הוא כותב הבינה המלאכותית המתקדם בעולם והוא תוכנן כדי לעזור לך ליצור מאמרים מדהימים בקלות. כל מה שאתה צריך לעשות הוא להזין את הנושא שלך ו-Contentbot יעשה את השאר, ויספק לך מאמר כתוב היטב ואינפורמטיבי תוך דקות.</p>\r\n<p>אז למה לחכות? נסה את Contentbot עוד היום וראה עד כמה כתיבת בינה מלאכותית יכולה להיות קלה ויעילה!</p>\r\n<h2><strong>כמה זה עולה של ContentBot AI ואיך לקנות?</strong></h2>\r\n<p>אם אתם מחפשים כלי כתיבה AI חזק ובמחיר סביר, אל תחפשו רחוק יותר מ-Contentbot. תמורת 130.99₪ בלבד לחודש, אתה יכול לקבל גישה לכותב הבינה המלאכותית המתקדמת בעולם ליצירת מאמרים מדהימים. בנוסף, יש ניסיון חינם של 7 ימים, כך שתוכל לנסות אותה לפני הקנייה.</p>\r\n<h2><strong>ContentBot AI בהשוואה לכותבי תוכן אחרים מבוססי AI</strong></h2>\r\n<p>יש הרבה כותבי תוכן מבוססי בינה מלאכותית בשוק בימים אלה. אז איך ContentBot משווה? הנה כמה דרכים מרכזיות שבהן ContentBot בולט:</p>\r\n<p>1. ContentBot הוא כותב הבינה המלאכותית המתקדם בעולם. הוא משתמש בטכנולוגיה חדשנית כדי ליצור תוכן באיכות גבוהה שהוא גם כמו אנושי וגם אינפורמטיבי.</p>\r\n<p>2. כותבי AI אחרים מייצרים לעתים קרובות תוכן משעמם מדי או טכני מדי. ContentBot יוצר את האיזון המושלם, ומייצר תוכן מעניין וקל להבנה.</p>\r\n<p>3.ContentBot כל הזמן לומד ומתפתח. הוא מעדכן כל הזמן את התוכנה שלו כדי להבטיח שהיא תפיק את התוצאות הטובות ביותר האפשריות.</p>\r\n<p>4.ContentBot מציע מגוון רחב של תכונות ואפשרויות, מה שהופך אותו לכותב AI המגוון ביותר בשוק.</p>\r\n<p>5.ContentBot הוא זול ביותר, מה שהופך אותו לפתרון המושלם עבור עסקים בכל הגדלים.</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>Contentbot הוא כלי מדהים לכל מי שרוצה ליצור מאמרים איכותיים וכתובים היטב. החלק הטוב ביותר הוא שהוא מופעל על ידי בינה מלאכותית, כך שהוא משתפר יותר ויותר ככל שאתה משתמש בו יותר. אני ממליץ בחום על Contentbot לכל מי שרוצה לקחת את יצירת התוכן שלו לשלב הבא.</p>\r\n<p></p>', '', '7fTYyp2SzhRX.jpeg', 'contentbot ai, ai content writer, bot writer', NULL, 0x5b7b226e616d65223a22494d475f7933617149473565653450642e706e67227d2c7b226e616d65223a22494d475f4e4b3054754e434f354462512e706e67227d5d, 'https://youtu.be/3A7x4cWp-aA', 'https://contentbot.ai?fpr=ran74', 'affiliate', 0, 'downs', 0, 0, 0, 'cxdBF5swNaui4tpfuws5b4fKe9QKblvz', '', '', 1, '2022-09-01 10:05:49'),
(12, 10, 'Headlime - בוט קופירייטינג הכי פרודוקטיבי ועוצמתי (מומלץ מאוד)', 'headlime', '297.99', '197.99', 1, '10', '0', '0', '<p><strong>קופירייטינג הוא מיומנות קריטית לכל מי שרוצה ליצור תוכן משכנע. אבל זו גם משימה שגוזלת זמן שיכולה להיות קשה להשתלב בלוחות זמנים עמוסים ממילא.</strong></p>\r\n<p><strong>היכנסו ל-Headlime, בוט הקופירייטינג הכי פרודוקטיבי בעולם. עם Headlime, אתה יכול ליצור במהירות ובקלות תוכן באיכות גבוהה מבלי להקריב את הזמן היקר שלך.</strong></p>\r\n<h2><strong>הפק עותקים שיווקיים יעילים יותר באופן אוטומטי עם Headlime</strong></h2>\r\n<p>הבלוג Headlime הוא המקום הטוב ביותר ללמוד על ההתקדמות האחרונה באוטומציה של קופירייטינג. צוות המומחים שלנו בוחן כל הזמן דרכים חדשות להפוך את קופירייטינג ליעילה ואפקטיבית יותר. בבלוג שלנו, תמצא טיפים וטריקים כיצד להשתמש ב-Headlime כדי להפיק את המרב מהקופירייטינג שלך. אנו גם נשתף מקרי מקרה וסיפורי הצלחה מעסקים שהשתמשו ב-Headlime כדי ליצור עותק שיווקי טוב יותר. אם אתה מחפש לשפר את פרודוקטיביות הקופירייטינג שלך, הבלוג Headlime הוא ספר חובה.</p>\r\n<h2><strong>Headlime מציעה לך טונות של תבניות העתקה מקצועיות שתוכל להשתמש בהן באופן מיידי</strong></h2>\r\n<p>אם אתה מחפש להיות פרודוקטיבי יותר עם הקופירייטינג שלך, Headlime הוא הבוט בשבילך. עם גישה לספרייה של תבניות העתקה מקצועיות, אתה יכול לבצע את הכתיבה שלך תוך זמן קצר. התחל עם כמה מהתבניות הפופולריות הבאות:</p>\r\n<p>-מכתב מכירות</p>\r\n<p>-ידיעה לתקשורת</p>\r\n<p>- עותק שיווקי באימייל</p>\r\n<p>-עותק דף נחיתה</p>\r\n<p>-מודעות בפייסבוק</p>\r\n<h2><strong>חסוך זמן על ידי יצירת מסמכים באמצעות תבניות מחולל מסמכים ב-Headlime</strong></h2>\r\n<p>אם אתה כמו רוב האנשים, אתה תמיד מחפש דרכים להיות פרודוקטיביים יותר. לכן אנחנו נרגשים להציג את Headlime, בוט הקופירייטינג הכי פרודוקטיבי בעולם.</p>\r\n<p>עם Headlime, אתה יכול ליצור מסמכים במהירות ובקלות באמצעות תבניות מובנות מראש. בין אם אתה זקוק להצעת מכירה, הודעה לעיתונות או ניוזלטר בדוא\"ל, ל-Headlime יש תבנית עבורה. ומכיוון שהכל אוטומטי, אתה יכול ליצור מסמכים בשבריר מהזמן שייקח לעשות זאת באופן ידני.</p>\r\n<p>אז אם אתה מחפש דרך להיות יותר פרודוקטיבית, פנה אל Headlime ונסה אותה. אנו חושבים שתתרשם מכמה זמן תחסוך.</p>\r\n<h2><strong>Headlime יעזור לך לקבל גישה לאלפי דוגמאות עותקים מקצועיות מהחיים האמיתיים</strong></h2>\r\n<p>מחפש לקחת את כישורי הקופירייטינג שלך לשלב הבא? Headlime, בוט הקופירייטינג הכי פרודוקטיבי בעולם, יכול לעזור. עם גישה לאלפי דוגמאות מקצועיות מהחיים האמיתיים, Headlime יכולה להראות לך מה עובד ולעזור לך לשפר את הכתיבה שלך. בין אם אתה רק מתחיל או מקצוען ותיק, Headlime יכול לעזור לך להפיק את המרב מהכתיבה שלך. </p>\r\n<h2><strong>מדוע Headlime הוא הבינה המלאכותית הקופירייטרית הגדולה ביותר ומדוע צריכים קופירייטרים להשתמש בה?</strong></h2>\r\n<p>קופירייטינג היא משימה מורכבת וקשה הדורשת גם יצירתיות וגם מיומנות טכנית. אפילו הקופירייטרים המנוסים והמצליחים ביותר יכולים למצוא את עצמם מתקשים להעלות רעיונות חדשים ומקוריים, או פשוט להסתבך בתהליך העריכה. כאן נכנס Headlime לתמונה.</p>\r\n<p>Headlime הוא בוט הקופירייטינג הכי פרודוקטיבי בעולם, שנועד לעזור לקופירייטרים לחסוך זמן ולמקסם את היצירתיות שלהם. באמצעות אינטליגנציה מלאכותית, Headlime מנתחת עבודה קודמת של קופירייטר ומספקת משוב מפורט, הצעות ואפילו רעיונות חדשים. והכי חשוב, זה יכול לעשות את כל זה בזמן אמת, כלומר קופירייטרים יכולים לקבל עזרה ומשוב מיידי כשהם הכי צריכים את זה.</p>\r\n<p>ישנן סיבות רבות לכך שה-Headlime הוא ה-Copywriter AI הגדול ביותר שקיים, אבל הנה רק כמה:</p>\r\n<p>1. זה חוסך זמן: מכיוון שה-Headlime מנתח את עבודתו של קופירייטר ומספק משוב באופן אוטומטי, הוא יכול לחסוך לו שעות של זמן שאחרת היה מושקע בעריכה ובסיעור מוחות.</p>\r\n<p>2. זה ממקסם את היצירתיות: על ידי מתן משוב והצעות מפורטים, Headlime עוזר לקופירייטרים לדחוף את היצירתיות שלהם למקסימום. הם יוכלו להמציא רעיונות חדשים שלעולם לא יהיו להם</p>\r\n<h2><strong>מה המחיר ואיך תוכלו להשיג את המחיר הטוב ביותר?</strong></h2>\r\n<p>אם אתם מחפשים את בוט הקופירייטינג הכי פרודוקטיבי בעולם, אל תחפשו רחוק יותר מ-Headlime. כלי רב עוצמה זה יכול לעזור לך לכתוב טוב יותר, מהיר יותר ויעיל יותר מאי פעם. והכי טוב, זה זמין במחיר סביר מאוד.</p>\r\n<p>אז מה המחיר הטוב ביותר עבור Headlime? ובכן, זה תלוי איך אתה מתכנן להשתמש בו. אם אתה רק רוצה להשתמש בו לשימוש אישי, אז תג המחיר של 297.99₪ לחודש כנראה בסדר גמור. עם זאת, אם אתה מתכנן להשתמש ב-Headlime למטרות מסחריות, תצטרך לרכוש רישיון מסחרי. החדשות הטובות הן שאפילו הרישיון המסחרי סביר מאוד.</p>\r\n<p>לא משנה איך אתה מתכנן להשתמש ב- Headlime, קל לרכוש אותו. פשוט עברו לאתר הרשמי ובחרו את החבילה המתאימה לכם. לאחר מכן עקוב אחר ההוראות להשלמת הרכישה. זה באמת כל כך פשוט!</p>\r\n<h2><strong>קופירייטר Headlime בהשוואה לכלי קופירייטינג אחרים מבוססי AI</strong></h2>\r\n<p>אם אתה קופירייטר, יש סיכוי טוב שלפחות שמעתם על Headlime. זהו אחד מכלי הקופירייטינג מבוססי AI הפופולריים ביותר בשוק. ומסיבה טובה - זה יעיל להפליא וקל לשימוש.</p>\r\n<p>אבל מה מייחד את Headlime מכלי קופירייטינג אחרים מבוססי AI? להלן מספר תכונות עיקריות:</p>\r\n<p>1. Headlime תוכנן במיוחד עבור קופירייטרים.</p>\r\n<p>זה אולי נראה כמו דבר קטן, אבל זה בעצם עניין גדול. רוב כלי הקופירייטינג המבוססים על בינה מלאכותית הם כלים לשימוש כללי שניתן להשתמש בהם לכל סוג של כתיבה. אבל Headlime תוכנן במיוחד עבור קופירייטרים. זה אומר שהוא מבין את הצרכים הספציפיים של קופירייטרים ומספק תכונות המותאמות להם.</p>\r\n<p>2. Headlime לומד כל הזמן.</p>\r\n<p>רוב כלי הקופירייטינג מבוססי הבינה המלאכותית מסתמכים על מודלים סטטיים שאינם משתפרים עם הזמן. אבל Headlime משתמש בגישה דינאמית מבוססת רשת עצבית המאפשרת לו ללמוד כל הזמן ולשפר את התוצאות שלה.</p>\r\n<p>3. Headlime מציע פיקוח אנושי.</p>\r\n<p>בעוד Headlime הוא בעיקר כלי אוטומטי, הוא מציע גם אפשרות לפיקוח אנושי. המשמעות היא שאם אי פעם אינך בטוח לגבי שינוי ש-Headlime ביצע, תמיד תוכל לבקש מאדם לסקור אותו לפני ביצוע השינוי.</p>\r\n<p>4. Headlime משתלב עם זרימת העבודה הקיימת שלך.</p>\r\n<p>Headlime משתלב עם עורכי טקסט פופולריים כמו Microsoft Word ו-Google Docs, מה שהופך אותו</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>אם אתם מחפשים בוט קופירייטינג שיכול לעזור לכם לחסוך זמן ולהיות פרודוקטיבי יותר, Headlime בהחלט שווה בדיקה. עם התכונות החזקות והממשק הידידותי שלו, Headlime מקל על יצירת תוכן איכותי במהירות וביעילות. בנוסף, עם תוכניות התמחור הזולות שלה, Headlime היא אופציה נהדרת לעסקים בכל הגדלים. אז למה לא לנסות? אתה יכול פשוט לגלות שזהו בוט הקופירייטינג הטוב ביותר שאי פעם השתמשת בו!</p>\r\n<p></p>', '', 'Rt1lfjJp4Tav.png', 'headlime, ai copywriter, copywriting bot', NULL, 0x5b7b226e616d65223a22494d475f366e425031384970717975792e6a7067227d2c7b226e616d65223a22494d475f5530554d6b706f395a6470582e6a7067227d5d, 'https://youtu.be/s9U1e8oKtj8', 'https://headlime.com/?invite=HDCYm8lVPYYCv2t5CO3sDWRNwwL2', 'affiliate', 0, 'downs', 0, 0, 0, 'khWuCfqaPuN60uePMqMB5U5KKUbZidmv', 'headlime', 'הבלוג Headlime הוא המקום הטוב ביותר ללמוד על ההתקדמות האחרונה באוטומציה של קופירייטינג. צוות המומחים שלנו בוחן כל הזמן דרכים חדשות להפוך את קופירייטינג ליעילה ואפקטיבית יותר. בבלוג שלנו, תמצא טיפים וטריקים כיצד להשתמש ב-Headlime כדי להפיק את המרב מהקופירייטינג שלך. אנו גם נשתף מקרי מקרה וסיפורי הצלחה מעסקים שהשתמשו ב-Headlime כדי ליצור עותק שיווקי טוב יותר. אם אתה מחפש לשפר את פרודוקטיביות הקופירייטינג שלך, הבלוג Headlime הוא ספר חובה.', 1, '2022-09-01 11:50:03'),
(13, 10, 'Jasper - כלי כתיבת תוכן יצירתי מבוסס בינה מלאכותית לבלוגים, מדיה חברתית, אתרים ועוד', 'jasper', '147.99', '97.99', 1, '10', '0', '0', '<p><strong>בעולם בקצב מהיר, קשה לעמוד בקצב של דרישות התוכן. בין העבודה, החיים וכל מה שביניהם, למי יש זמן לשבת ולכתוב פוסט מחושב בבלוג או עדכון במדיה החברתית? כאן נכנס לתמונה ג\'ספר - כלי כתיבת תוכן מבוסס בינה מלאכותית שדואג עבורכם למשימות הכבדות!</strong></p>\r\n<h2><strong>כלי הכתיבה הטוב ביותר של AI ליצירת תוכן ייחודי למתחילים עד למקצוענים</strong></h2>\r\n<p>ג\'ספר הוא כלי כתיבת תוכן יצירתי מבוסס בינה מלאכותית שיכול לעזור לך לכתוב בלוגים ייחודיים ומרתקים, פוסטים במדיה חברתית ותוכן באתר. זהו כלי נהדר למתחילים ולמקצוענים כאחד, מכיוון שהוא יכול לעזור לך להעלות רעיונות טריים ולשפר את כישורי הכתיבה שלך.</p>\r\n<h2><strong>עבור לכותבים המונעים בינה מלאכותית כמו ג\'ספר כדי לחסוך זמן וליצור בקלות תוכן לצרכים שלך</strong></h2>\r\n<p>אם אתה בלוגר, רוב הסיכויים שאתה תמיד מחפש דרכים לחסוך זמן. אחרי הכל, יש רק כל כך הרבה שעות ביום, ולעתים קרובות, בלוגים יכולים להרגיש כמו משימה בלתי נגמרת. אם זה נשמע מוכר, אולי כדאי שתשקול להשתמש בכלי כתיבה המופעל על ידי AI כמו Jasper.</p>\r\n<p>ג\'ספר הוא כלי כתיבת תוכן שמשתמש בבינה מלאכותית כדי לעזור לך לכתוב טוב יותר ומהיר יותר. עם ג\'ספר, אתה יכול ליצור תוכן באיכות גבוהה עבור הבלוג או האתר שלך בשבריר מהזמן שזה ייקח בדרך כלל. ומכיוון שג\'ספר מופעל על ידי AI, זה גם יכול לעזור לך להמציא רעיונות ונושאים חדשים לפוסטים בבלוג שלך.</p>\r\n<p>אם אתה מחפש דרך לחסוך זמן במשימות הבלוג שלך, נסה את ג\'ספר. אתה עשוי להיות מופתע כמה קל ומהיר יותר הכתיבה שלך הופכת.</p>\r\n<h2><strong>ג\'ספר מייצרת תוכן מקורי שמדורג לקידום אתרים ומאיץ את צמיחת התנועה</strong></h2>\r\n<p>אם אתם מחפשים כלי לכתיבת תוכן שיעזור לכם לייצר תוכן מקורי וידידותי לקידום אתרים, אז ג\'ספר הוא הכלי המושלם עבורכם. עם ג\'ספר, אתה יכול ליצור במהירות ובקלות פוסטים בבלוג, עדכוני מדיה חברתית ותוכן אתר שיעזור להאיץ את צמיחת התנועה.</p>\r\n<h2><strong>ג\'ספר AI יכול לכתוב באופן אוטומטי פוסטים יצירתיים בבלוג פי 5 מהר יותר באמצעות Boss Mode</strong></h2>\r\n<p>אם אתה בלוגר, אתה יודע כמה חשוב שיהיה תוכן חדש ויצירתי באתר שלך. אבל להעלות רעיונות חדשים וכתיבת פוסטים מקוריים בבלוג יכולים להיות גוזלים זמן.</p>\r\n<p>היכנסו לג\'ספר, כלי כתיבת תוכן המופעל על ידי בינה מלאכותית שיכול לעזור לכם לכתוב פוסטים יצירתיים בבלוג X מהר יותר באמצעות Boss Mode.</p>\r\n<p>ג\'ספר נועד לעזור לך לחשוב על רעיונות, להמציא כותרות קליטות ולכתוב עותק מרתק. זה כמו שיש צוות קופירייטרים בהישג ידך 24/7.</p>\r\n<p>בנוסף, ג\'ספר כל הזמן לומד ומשתפר. ככל שאתה משתמש בו יותר, כך הוא משתפר בהבנת הסגנון שלך ועונה על הצרכים שלך.</p>\r\n<p>אם אתה מחפש דרך להגביר את הפרודוקטיביות שלך ולקבל יותר תוכן יצירתי באתר שלך, ג\'ספר הוא הפתרון המושלם.</p>\r\n<h2><strong>כתוב עותק שיווקי יצירתי ביותר מ-25 שפות עם ג\'ספר</strong></h2>\r\n<p>Jasper הוא כלי כתיבת תוכן מבוסס בינה מלאכותית שעוזר לך לכתוב עותק שיווקי יצירתי ביותר מ-20 שפות. עם Jasper, אתה יכול ליצור בלוגים, פוסטים במדיה חברתית ותוכן אתר במהירות ובקלות.</p>\r\n<p>ג\'ספר מספקת מגוון רחב של תבניות וכלים שיעזרו לך לכתוב תוכן יצירתי. לדוגמה, אתה יכול להשתמש בכלי \"רעיונות לבלוג\" כדי ליצור רעיונות לפוסטים בבלוג, או בכלי \"פוסטים במדיה חברתית\" כדי ליצור פוסטים במדיה חברתית.</p>\r\n<p>ג\'ספר מציעה גם שירות תרגום כדי שתוכל לכתוב את התוכן שלך בשפה אחת ולתרגם אותו לשפה אחרת. זה שימושי במיוחד אם אתה מכוון לקהל עולמי.</p>\r\n<p>בסך הכל, ג\'ספר הוא כלי נהדר לכתיבת עותק שיווקי יצירתי. אם אתם מחפשים דרך ליצור במהירות תוכן באיכות גבוהה, ג\'ספר בהחלט שווה בדיקה.</p>\r\n<h2><strong>ג\'ספר כותב עבורך תיאור מוצר, תסריטי וידאו, דואר אלקטרוני למכירות, בלוגים, מודעות פייסבוק</strong></h2>\r\n<p>אם אתה מחפש כלי לכתיבת תוכן שיכול לעזור לך בכל ההיבטים של הבלוג, המדיה החברתית ותוכן האתר שלך, ג\'ספר הוא הפתרון המושלם. כלי זה מבוסס בינה מלאכותית יכול לעזור לך לכתוב בקלות תיאורי מוצרים, סקריפטים של וידאו, דואר אלקטרוני למכירה, בלוגים ומודעות פייסבוק. עם Jasper, אתה יכול ליצור תוכן באיכות גבוהה מבלי לבזבז שעות בעצמך.</p>\r\n<p>ג\'ספר הוא כלי כתיבת תוכן מבוסס בינה מלאכותית שיכול לעזור לך בכל ההיבטים של הבלוג, המדיה החברתית ותוכן האתר שלך. עם Jasper, אתה יכול ליצור תוכן באיכות גבוהה מבלי לבזבז שעות בעצמך.</p>\r\n<p></p>\r\n<h2><strong>מה העלות של ג\'ספר AI וכיצד משיגים אותה?</strong></h2>\r\n<p>Jasper AI הוא כלי חדש ליוצרי תוכן שמשתמש בבינה מלאכותית כדי לעזור בתהליך הכתיבה. עלות ג\'ספר AI היא 147.99 ₪ לחודש. אתה יכול לקבל את ג\'ספר AI על ידי הרשמה לגרסת ניסיון בחינם באתר האינטרנט שלהם.</p>\r\n<h2><strong>התכונות הנוספות של ג\'ספר והשוואה לכותבי תוכן אחרים מבוססי בינה מלאכותית</strong></h2>\r\n<p>בהנחה שתרצה בלוג שידון בתכונותיו של ג\'ספר בהשוואה לכותבי תוכן אחרים מבוססי בינה מלאכותית:</p>\r\n<p>כבעל עסק, אתה תמיד מחפש דרכים לייעל את היעילות שלך ולהפיק את המרב מהצוות שלך. אז כשזה מגיע לכתיבת תוכן, אתה רוצה למצוא את הכלי הטוב ביותר שיעזור לך לבצע את העבודה במהירות ובקלות.</p>\r\n<p>ישנם הרבה כלים שונים לכתיבת תוכן בשוק כיום, אך לא כולם נוצרו שווים. ג\'ספר הוא כלי כתיבת תוכן מבוסס בינה מלאכותית שתוכנן במיוחד עבור בלוגים, מדיה חברתית ואתרי אינטרנט.</p>\r\n<p>לג\'ספר יש מספר יתרונות על פני כותבי תוכן אחרים מבוססי בינה מלאכותית. ראשית, ג\'ספר תוכנן במיוחד עבור בלוגים וכתיבת תוכן באתר. המשמעות היא שיש לו את כל התכונות שאתה צריך כדי לבצע את העבודה במהירות ובקלות.</p>\r\n<p>שנית, ג\'ספר קל מאוד לשימוש. אתה יכול פשוט להזין את סוג התוכן שאתה צריך ולתת לג\'ספר לעשות את השאר. זאת בניגוד לכותבי תוכן אחרים המבוססים על בינה מלאכותית שיכולים להיות קשים לשימוש ולעיתים דורשים הרבה קלט מהמשתמש.</p>\r\n<p>לבסוף, ג\'ספר משתלם במיוחד. אם אתם מחפשים כתיבת תוכן</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>אם אתה מחפש כלי יצירתי לכתיבת תוכן שיכול לעזור לך עם הבלוגים, המדיה החברתית או האתר שלך, אז ג\'ספר עשוי להיות אופציה טובה עבורך. עם היכולות המבוססות על בינה מלאכותית, ג\'ספר יכולה לעזור לך לכתוב תוכן טוב ומרתק יותר. בנוסף, זה בחינם לשימוש, אז למה לא לנסות?</p>\r\n<p></p>', '', 'HGMW9O7JGiFM.jpg', 'jasper, jasper ai, ai contet writer', NULL, 0x5b7b226e616d65223a22494d475f654c4e694c6c42624e6575332e6a7067227d2c7b226e616d65223a22494d475f3767506e4a6964434f4d75722e706e67227d5d, 'https://youtu.be/Revmi_J-2Gw', 'https://jasper.ai?fpr=ran11', 'affiliate', 0, 'downs', 0, 0, 0, 'oJRtmuMtTbEvPLerkpd4J7Wptinz1iMT', 'jasper ai', 'ג&#39;ספר הוא כלי כתיבת תוכן יצירתי מבוסס בינה מלאכותית שיכול לעזור לך לכתוב בלוגים ייחודיים ומרתקים, פוסטים במדיה חברתית ותוכן באתר. זהו כלי נהדר למתחילים ולמקצוענים כאחד, מכיוון שהוא יכול לעזור לך להעלות רעיונות טריים ולשפר את כישורי הכתיבה שלך.', 1, '2022-09-01 13:28:17'),
(17, 11, 'SimilarWeb - כלי ניתוח האתרים התחרותי הטוב ביותר לניטור וניתוח המתחרים שלך', 'similarweb', '999.99', '667.99', 1, '11', '0', '0', '<p>אם אתה מחפש כלי מקיף לניתוח אתרים שיכול לעזור לך לעקוב אחר המתחרים שלך, עליך לבדוק את SimilarWeb. במאמר זה, נראה לך מדוע SimilarWeb הוא הכלי הטוב ביותר לתפקיד וכיצד הוא יכול לעזור לך לעקוב אחר התקדמות המתחרים שלך.</p>\r\n<h2><strong>מהו SimilarWeb וכיצד הוא יכול לעזור לך עם קידום אתרים ושיווק תחרותיים?</strong></h2>\r\n<p>אם אתה רציני לגבי SEO ושיווק האתר שלך, אתה צריך להשתמש ב-SimilarWeb. SimilarWeb הוא כלי הניתוח התחרותי המוביל לניטור תעבורה ומעורבות באתר. עם SimilarWeb, אתה יכול לעקוב אחר האסטרטגיות של המתחרים שלך ולראות איך הם מתפקדים בזמן אמת. מידע זה חיוני לפיתוח אסטרטגיית SEO ואסטרטגיית שיווק יעילה משלך.</p>\r\n<h2><strong>היתרונות של ניתוח אתרים תחרותי באמצעות פלטפורמת SimilarWeb</strong></h2>\r\n<p>אם אתה מחפש פלטפורמה מקיפה וקלה לשימוש לניתוח אתרים תחרותיים, אתה לא יכול לטעות עם SimilarWeb. הנה רק כמה מהיתרונות שהמשתמשים שלנו נהנים מהם:</p>\r\n<p>1. השג תובנות לגבי אתרי האינטרנט ואסטרטגיות השיווק הדיגיטלי של המתחרים שלך.</p>\r\n<p>2. הבן כיצד המתחרים שלך מובילים תנועה לאתרים שלהם ולאילו מילות מפתח הם ממקדים.</p>\r\n<p>3. ראה אילו ערוצים הם היעילים ביותר עבור המתחרים שלך ולמד מהצלחותיהם.</p>\r\n<p>4. סמן את הביצועים של האתר שלך מול המתחרים שלך וקבל החלטות מושכלות לגבי היכן למקד את המאמצים שלך.</p>\r\n<p>5. לעקוב אחר שינויים בתנועה של המתחרים שלך לאורך זמן ולזהות הזדמנויות חדשות כשהן צצות.</p>\r\n<p>בין אם אתה רק התחלת בשיווק מקוון או שהיית במשחק במשך זמן מה, SimilarWeb הוא הכלי המושלם לניתוח אתרים תחרותי. הירשם עוד היום וראה כיצד נוכל לעזור לך לקחת את העסק שלך לשלב הבא!</p>\r\n<h2><strong>כיצד להבין ביעילות סקירת תנועה באמצעות פלטפורמת SimilarWeb</strong></h2>\r\n<p>בכל הנוגע לניתוח אתרים, ישנם כלים רבים זמינים בשוק. עם זאת, פלטפורמה אחת הבולטת היא SimilarWeb. בפוסט זה בבלוג, נראה לך כיצד להשתמש ביעילות בסקירת התעבורה של SimilarWeb כדי להבין את המתחרים ולקבל החלטות טובות יותר עבור העסק שלך.</p>\r\n<p>ראשית, בואו נסתכל איזה מידע מספקת סקירת התעבורה של SimilarWeb. הפלטפורמה נותנת לך סקירה כללית של התנועה באתר, כולל מספר המבקרים, מספר הצפיות בדף, שיעור היציאה מדף הכניסה והזמן הממוצע באתר. נתונים אלה זמינים עבור תעבורה למחשבים שולחניים וגם לנייד.</p>\r\n<p>לאחר מכן, בואו נסתכל כיצד לפרש את הנתונים הללו. מספר המבקרים הוא מדד טוב למעקב מכיוון שהוא מראה לך כמה אנשים מגיעים לאתר שלך. עם זאת, חשוב לזכור שלא כל המבקרים הללו הולכים להיות לקוחות פוטנציאליים. מספר הצפיות בדף הוא גם מדד טוב למעקב מכיוון שהוא מראה לך עד כמה המשתמשים מעורבים באתר שלך. אם משתמשים קופצים מהאתר שלך במהירות, זה יכול להיות אינדיקציה שהם לא מוצאים את מה שהם מחפשים. לבסוף, הזמן הממוצע באתר יכול לתת לך מושג כמה זמן משתמשים</p>\r\n<h2><strong>מחקר של מתחרים ודורג גבוה במנועי חיפוש באמצעות SimilarWeb</strong></h2>\r\n<p>SimilarWeb הוא כלי לניתוח אתרים שיכול לעזור לך לחקור את המתחרים שלך ולהבין מה הם עושים כדי לדרג גבוה במנועי החיפוש. אתה יכול להשתמש ב- SimilarWeb כדי לגלות כמה תנועה מקבלים המתחרים שלך, לאילו מילות מפתח הם מכוונים, ובאילו קישורים נכנסים הם משתמשים. מידע זה יכול לעזור לך להתאים את אסטרטגיית ה-SEO שלך ולשפר את הסיכויים שלך לדירוג גבוה יותר במנועי החיפוש.</p>\r\n<h2><strong>SimilarWeb יכולה לעזור לך למצוא את האתרים הטובים ביותר להצגת הפרסומות שלך</strong></h2>\r\n<p>כבעל אתר, אתה תמיד מחפש דרכים לשפר את התנועה שלך ולהביא יותר מבקרים לאתר שלך. אחת הדרכים לעשות זאת היא באמצעות הצגת פרסומות באתרים אחרים. עם זאת, אתה רוצה לוודא שאתה מציג את המודעות שלך רק באתרים הטובים ביותר שייצרו עבורך את מירב התנועה. זה המקום שבו SimilarWeb יכול לעזור לך.</p>\r\n<p>SimilarWeb הוא כלי לניתוח אתרים שיכול לעזור לך למצוא את האתרים הפופולריים ביותר בנישה שלך. מידע זה חשוב מכיוון שהוא יכול לעזור לך לקבוע היכן למקד את מאמצי הפרסום שלך. על ידי מעקב אחר תעבורת האתר של המתחרים שלך, תוכל לראות אילו אתרים מייצרים עבורם את התנועה הגדולה ביותר. לאחר מכן תוכל להשתמש במידע זה כדי להחליט באילו אתרים יהיה הכי טוב עבורך לפרסם.</p>\r\n<p>בנוסף לעזור לך למצוא את האתרים הטובים ביותר לפרסום, SimilarWeb יכול גם לספק תובנות לגבי האופן שבו המתחרים שלך מקבלים את התנועה שלהם. מידע זה יכול לעזור לך להתאים את אסטרטגיות השיווק שלך כדי להיות אפקטיביות יותר. בסך הכל, SimilarWeb הוא כלי חיוני לכל בעל אתר שרוצה להקדים את המתחרים ולהביא יותר מבקרים לאתר שלו.</p>\r\n<h2><strong>מדוע כדאי לבחור ב-SimilarWeb כדי לקחת את העסק שלך לשלב הבא?</strong></h2>\r\n<p>אם אתה מחפש את הכלי המקיף ביותר לניתוח אתרים תחרותי שקיים, SimilarWeb הוא ההימור הטוב ביותר שלך. לא רק שהוא מספק תובנות מפורטות לגבי תעבורת האתר של המתחרים שלך, אלא הוא גם מאפשר לך להשוות את האתר שלך מולם. כך תוכלו לראות היכן עליכם להשתפר כדי להתחרות טוב יותר בענף שלכם.</p>\r\n<p>בנוסף, הבלוג של SimilarWeb הוא משאב מצוין לטיפים וטריקים כיצד להפיק את המרב מהפלטפורמה. בין אם אתה רק מתחיל או משתמש ותיק, תמיד יש משהו חדש ללמוד. אז אם אתה רציני לגבי לקחת את העסק שלך לשלב הבא, הקפד לבדוק את SimilarWeb עוד היום!</p>\r\n<h2><strong>מהי העלות החודשית של SimilarWeb Pro, והיכן אוכל להשיג אותה?</strong></h2>\r\n<p>SimilarWeb הוא כלי לניתוח אתרים המאפשר למשתמשים לעקוב אחר הפעילות המקוונת של המתחרים שלהם. העלות החודשית של SimilarWeb היא 999.99₪, וניתן להשיגה מאתר SimilarWeb.</p>\r\n<h2><strong>SimilarWeb תכונות בהשוואה למתחרותיה</strong></h2>\r\n<p>SimilarWeb הוא כלי ניתוח אתרים תחרותי המוביל לניטור. הוא מציע חבילת תכונות שהמתחרים שלה לא, מה שהופך אותו לכלי המושלם עבור בעלי אתרים ומשווקים מקוונים. הנה כמה מהדרכים שבהן SimilarWeb בולט מהקהל:</p>\r\n<p>- נתונים מקיפים: SimilarWeb מספקת נתונים מפורטים על תעבורת האתר, כולל מבקרים ייחודיים, צפיות בדף, שיעור יציאה מדף כניסה, זמן באתר ועוד. שפע המידע הזה מאפשר לבעלי אתרים לקבל תמונה ברורה של ביצועי האתר שלהם ולקבל החלטות מושכלות לגבי היכן למקד את מאמציהם.</p>\r\n<p>- ניתוח מתחרים: כלי ניתוח מתחרים של SimilarWeb מאפשרים לבעלי אתרים לעקוב אחר ההתקדמות של יריביהם ולראות כיצד הם מתפקדים ביחס לאתר שלהם. זוהי דרך שלא יסולא בפז להקדים את המתחרים ולוודא שהאתר שלך תמיד מציג את הביצועים הטובים ביותר.</p>\r\n<p>- דיווח הניתן להתאמה אישית: ניתן להתאים את הדוחות של SimilarWeb כך שיתאימו לצרכים הספציפיים שלך, כלומר תמיד תוכל לקבל את המידע שאתה צריך, מתי שאתה צריך אותו.</p>\r\n<p>- תמיכה 24/7: צוות המומחים של SimilarWeb עומד לרשותך 24/7 כדי לענות על כל שאלה שיש לך לגבי הכלי או ביצועי האתר שלך. זה אומר שאתה תמיד יכול לקבל את</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>בסך הכל, SimilarWeb הוא כלי שימושי ביותר לניתוח אתרים שיכול לעזור לך לא רק להבין את התנועה באתר שלך אלא גם את זו של המתחרים שלך. אם אתם מחפשים דרך לשפר את הנראות המקוונת שלכם ולהקדים את המתחרים, SimilarWeb בהחלט שווה בדיקה.</p>\r\n<p></p>', '', 'KM58RLl7GKTj.png', 'similarweb, web analytics tool, seo tool', NULL, 0x5b7b226e616d65223a22494d475f76695179396b686c4d6163382e6a7067227d2c7b226e616d65223a22494d475f707379634b717361526f4b6e2e6a7067227d5d, 'https://youtu.be/US6E9AQifa4', 'https://shareasale.com/r.cfm?b=1869923&u=3370952&m=116762&urllink=&afftrack=', 'affiliate', 0, 'downs', 0, 0, 0, 'AzpfQkKvHeNXmOlyA851GREfEmrHfvm7', 'similarweb', 'אם אתה מחפש כלי מקיף לניתוח אתרים שיכול לעזור לך לעקוב אחר המתחרים שלך, עליך לבדוק את SimilarWeb. במאמר זה, נראה לך מדוע SimilarWeb הוא הכלי הטוב ביותר לתפקיד וכיצד הוא יכול לעזור לך לעקוב אחר התקדמות המתחרים שלך.', 1, '2022-09-01 19:50:03'),
(14, 11, 'Fathom - ניתוח אתרים ממוקד פרטיות ללא פשרות (אלטרנטיבה לאנליטיקס)', 'fathom', '70.99', '46.99', 1, '11', '0', '0', '<p><strong>Fathom היא תוכנה חדשה לניתוח אתרים המתמקדת בפרטיות. בניגוד ל-Google Analytics, העוקב אחר משתמשים בודדים, Fathom משתמש בנתונים מצטברים כדי להראות לבעלי אתרים מה קורה באתר שלהם מבלי לפגוע בפרטיות המשתמשים שלהם.</strong></p>\r\n<p><strong>Fathom מתוכנן להיות פשוט וקל לשימוש, תוך שהוא מספק את כל התכונות שבעלי אתרים צריכים כדי לעקוב אחר ביצועי האתר שלהם. Fathom גם במחיר סביר, עם תוכנית חינמית המאפשרת לבעלי אתרים לעקוב אחר עד 500 צפיות בדפים בחודש.</strong></p>\r\n<p><strong>אם אתם מחפשים אלטרנטיבה ממוקדת פרטיות ל-Google Analytics, Fathom היא אפשרות מצוינת.</strong></p>\r\n<h2><strong>כיצד להשתמש ב-Fathom Analytics והגדרת Fathom Analytics בזרימת האינטרנט</strong></h2>\r\n<p>אם אתה מחפש אלטרנטיבה ממוקדת פרטיות ל-Google Analytics, Fathom Analytics היא אפשרות מצוינת. הנה איך להשתמש בו באתר האינטרנט שלך.</p>\r\n<p>ראשית, צור חשבון בחינם ב-Fathom Analytics. לאחר מכן, צור קוד מעקב עבור האתר שלך והוסף אותו לקטע של ה-HTML של האתר שלך.</p>\r\n<p>לאחר שתעשה זאת, Fathom יתחיל לעקוב אחר המבקרים באתר שלך. אתה יכול לראות את סטטיסטיקת התנועה של האתר שלך על ידי כניסה לחשבון Fathom שלך.</p>\r\n<p>Fathom מספק מידע מפורט על התנועה באתר שלך, כולל צפיות בדף, מבקרים ייחודיים, שיעור יציאה מדף כניסה וזמן ממוצע באתר. אתה יכול להשתמש במידע זה כדי לשפר את האתר שלך ולהפוך אותו לידידותי יותר למשתמש.</p>\r\n<p>אם אתה מודאג מפרטיות, היה סמוך ובטוח ש-Fathom תואם לחלוטין ל-GDPR. תוכל לקרוא עוד על מדיניות הפרטיות שלנו כאן.</p>\r\n<h2><strong>הניתוח המהיר והאמין ביותר הממוקד בפרטיות וללא עוגיות</strong></h2>\r\n<p>אם אתה מחפש אלטרנטיבה ממוקדת פרטיות ונטולת עוגיות ל-Google Analytics, Fathom היא האפשרות הטובה ביותר שיש. זה מהיר ואמין, והוא לא מתפשר על תכונות או פונקציונליות. בנוסף, זה בחינם לשימוש!</p>\r\n<h2><strong>הצג את כל נתוני הניתוח, גם אם אנשים משתמשים בחוסמי פרסומות, ושמור נתוני ניתוח לצמיתות</strong></h2>\r\n<p>Fathom הוא כלי לניתוח אתרים ממוקד פרטיות המציע חלופה ל-Google Analytics. Fathom אינו משתמש בקובצי Cookie או עוקב אחר נתונים אישיים, כך שזו אופציה מצוינת למי שמודאג מפרטיות. Fathom מציעה גם את היכולת להציג את כל נתוני הניתוח, גם אם אנשים משתמשים בחוסמי פרסומות. זה אומר שאתה עדיין יכול לקבל נתונים מדויקים על התנועה באתר שלך. בנוסף, עם Fathom אתה יכול לשמור את נתוני הניתוח שלך לצמיתות, כך שאתה לא צריך לדאוג לאבד אותם.</p>\r\n<h2><strong>הצג את כל נתוני הניתוח, גם אם אנשים משתמשים בחוסמי פרסומות, תוכל לשמור נתוני ניתוח לצמיתות</strong></h2>\r\n<p>הצג את כל נתוני הניתוח, גם אם אנשים משתמשים בחוסמי פרסומות. Fathom היא האלטרנטיבה הטובה ביותר של Google Analytics מכיוון שהיא לא מתפשרת על פרטיות. אתה יכול לשמור את נתוני הניתוח שלך לצמיתות עם Fathom.</p>\r\n<h2><strong>השתמש ב-Fathom עם שורת קוד אחת התואמת לכל CMS, אפליקציה או מסגרת</strong></h2>\r\n<p>Fathom היא אלטרנטיבה לניתוח אתרים ממוקד פרטיות ל-Google Analytics שאינה מתפשרת על תכונות או קלות השימוש. שורת הקוד הבודדת של Fathom תואמת לכל CMS, אפליקציה או מסגרת, מה שמאפשר להתחיל במהירות ובקלות עם מעקב אחר התנועה באתר שלך. בנוסף, הממשק הנקי והפשוט של Fathom הופך אותו לתענוג לשימוש, אפילו למשתמשים ראשונים. אז אם אתה מחפש אלטרנטיבה של Google Analytics ששמה את הפרטיות במקום הראשון, הקפד לנסות את Fathom!</p>\r\n<h2><strong>Fathom Analytics יכול לבצע ביצועים טובים יותר עבור קידום אתרים ומהירות הדף שלך מאשר Google Analytics</strong></h2>\r\n<p>אם אתה מחפש אלטרנטיבה של Google Analytics ששמה את הפרטיות במקום הראשון, אז שווה לבדוק את Fathom. לא רק ש-Fathom מבטיח לא למכור את הנתונים שלך או לשתף אותם עם צדדים שלישיים, אלא שהוא גם טוען שהוא יעיל יותר עבור קידום אתרים ומהירות הדף שלך.</p>\r\n<p>Fathom הוא חלופה פשוטה, קלת משקל וממוקדת פרטיות ל-Google Analytics. היא אינה משתמשת בעוגיות או אוספת מידע אישי מזהה. במקום זאת, הוא משתמש במעקב בצד השרת כדי לתת לך נתונים מדויקים ומהימנים לגבי התנועה באתר שלך.</p>\r\n<p>Fathom קל להגדרה ולשימוש, והוא משתלב עם כל פלטפורמות האתרים הגדולות. בנוסף, זה בחינם לשימוש!</p>\r\n<h2><strong>היתרונות של ניתוח Fathom ומדוע כל כך הרבה חברות בוחרות ב-Fathom</strong></h2>\r\n<p>אם אתה מחפש אלטרנטיבה ממוקדת פרטיות ל-Google Analytics, Fathom Analytics היא אפשרות מצוינת. הנה כמה מהיתרונות של השימוש ב-Fathom:</p>\r\n<p>1. Fathom אינו משתמש בקובצי Cookie, כך שהפרטיות של המבקרים שלך מוגנת.</p>\r\n<p>2. Fathom מציע דוחות מפורטים שנותנים לך תובנות לגבי התנועה באתר שלך.</p>\r\n<p>3. אתה יכול בקלות להתקין את Fathom באתר האינטרנט שלך מבלי לבצע שינויים כלשהם בקוד הקיים שלך.</p>\r\n<p>4. התמחור של Fathom שקוף ובמחיר סביר, החל מ-$14 לחודש בלבד.</p>\r\n<p>5. Fathom משתלב עם כלים פופולריים כמו WordPress ו-Shopify, מה שמקל על תחילת העבודה עם מעקב אחר נתוני האתר שלך.</p>\r\n<h2><strong>מה העלות של Fathom Analytics וכיצד משיגים אותה?</strong></h2>\r\n<p>Fathom analytics הוא כלי חדש לניתוח אתרים המציע תכונות ממוקדות פרטיות מבלי להתפשר על איכות או דיוק הנתונים. העלות של Fathom Analytics היא 70.99₪ לחודש, ותוכלו להירשם לניסיון חינם כדי לנסות זאת.</p>\r\n<h2><strong>תכונות של Fathom Analytics והשוואה ל-Google Analytics</strong></h2>\r\n<p>Fathom הוא ניתוח אתר ממוקד פרטיות ללא פשרות אלטרנטיבי של Google Analytics. הוא מציע מגוון תכונות שהופכות אותו לבחירה מצוינת עבור אלה שמודאגים לגבי הפרטיות המקוונת שלהם. הנה כמה מהדגשים:</p>\r\n<p>- Fathom אינו אוסף או מאחסן מידע אישי מזהה (PII). המשמעות היא שפרטיות המבקרים שלך מוגנת ואתה לא צריך לדאוג לגבי עמידה בתקנות הגנת מידע.</p>\r\n<p>- Fathom משתמש בקוד מעקב פשוט, פשוט וקל משקל שלא יאט את האתר שלך.</p>\r\n<p>- Fathom מספק תובנות מפורטות ומעשיות לגבי תעבורת האתר שלך, מבלי לפגוע בפרטיות המבקרים שלך. אתה יכול לראות דברים כמו צפיות בדף, מבקרים ייחודיים, שיעור יציאה מדף כניסה, שיעור המרות ועוד.</p>\r\n<p>- Fathom משתלב עם כלים ושירותים פופולריים כמו WordPress, Shopify, Slack ו-Zapier. זה מקל על תחילת העבודה עם Fathom ולהפיק את המרב מהתכונות שלו.</p>\r\n<p>- ל-Fathom יש 14 יום ניסיון חינם, כך שתוכל לנסות אותה לפני שתתחייב לתוכנית בתשלום.</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>Fathom Analytics הוא אלטרנטיבה מצוינת לגוגל אנליטיקס מכיוון שהוא מתמקד בפרטיות ואינו מתפשר על תכונות או נתונים. זה קל להתקנה ולשימוש, והוא מספק נתוני אתר מדויקים שניתן להשתמש בהם כדי לשפר את האתר שלך. אם אתם מחפשים כלי ניתוח שיכבד את הפרטיות שלכם, Fathom Analytics היא אפשרות מצוינת.</p>\r\n<p></p>', '', 'cH8jToROpnGe.png', 'fathom, fathom analytics, analytics tool, seo tool', NULL, 0x5b7b226e616d65223a22494d475f7767567451655a627a536a4c2e6a7067227d2c7b226e616d65223a22494d475f466342535a49674e79744a502e6a7067227d5d, 'https://youtu.be/RN1BUVVgAi8', 'https://usefathom.com/ref/SNCAIZ', 'affiliate', 0, 'downs', 0, 0, 0, 'zFcp4MMRcI3bnmYBBqGBIZAdJC3kepb4', 'fathom', 'Fathom היא תוכנה חדשה לניתוח אתרים המתמקדת בפרטיות. בניגוד ל-Google Analytics, העוקב אחר משתמשים בודדים, Fathom משתמש בנתונים מצטברים כדי להראות לבעלי אתרים מה קורה באתר שלהם מבלי לפגוע בפרטיות המשתמשים שלהם.', 1, '2022-09-01 15:42:32'),
(15, 11, 'SeRanking - מערכת בקרה מלאה 360 לקידום אתרים מהמומלצות בתחום', 'seranking', '154.99', '104.99', 1, '11', '0', '0', '<p><strong>קידום אתרים הוא תחום מורכב ומשתנה ללא הרף, מה שמקשה על מעקב אחר הטרנדים והשיטות הטובות ביותר. אבל אם אתה רוצה שהאתר שלך ידורג טוב במנועי החיפוש, אתה צריך להתאמץ. למרבה המזל, ישנם כלים כמו SeRanking שיכולים לעזור לך בכל ההיבטים של SEO, ממחקר מילות מפתח לבניית קישורים ועד ניתוח מתחרים. במאמר זה, נסקור מקרוב את מה שיש ל-SeRanking להציע וכיצד הוא יכול לעזור לך לשפר את קידום האתרים שלך.</strong></p>\r\n<h2><strong>SeRanking הטוב ביותר בכלי ניתוח SEO ושיווק הכל באחד שאתה צריך על הסיפון</strong></h2>\r\n<p>האם אתה מחפש כלי SEO מקיף שיכול לעזור לך לדרג גבוה יותר במנועי החיפוש ולשפר את השיווק הכולל שלך? אם כן, אז אתה צריך לבדוק את SeRanking.</p>\r\n<p>SeRanking הוא כלי ניתוח ושיווק SEO הכל-באחד שיכול לעזור לך בכל דבר, החל ממחקר מילות מפתח ועד בניית קישורים ועד אופטימיזציה בדף. והחלק הטוב ביותר הוא שהוא זול וקל לשימוש, אפילו למתחילים.</p>\r\n<p>אז אם אתה רציני לגבי שיפור ה-SEO שלך והנראות הכללית שלך באינטרנט, אז SeRanking הוא הכלי שאתה צריך על הסיפון.</p>\r\n<h2><strong>כיצד פועל כלי SeRanking כדי להשיג דירוג גבוה בכל תוצאות מנועי החיפוש</strong></h2>\r\n<p>האם אתה מחפש כלי ניתוח ושיווק הכל ב-SEO שיכול לעזור לשפר את דירוג האתר שלך? אם כן, אז אתה צריך לבדוק את SeRanking. SeRanking הוא כלי רב עוצמה שיכול לעזור לשפר את דירוג האתר שלך בכל מנועי החיפוש הגדולים, כולל גוגל, יאהו ובינג. החלק הטוב ביותר בשימוש ב-SeRanking הוא שהוא קל מאוד לשימוש והוא אינו דורש שום ידע טכני. כל מה שאתה צריך לעשות הוא להירשם לחשבון ולהתחיל להשתמש בכלי.</p>\r\n<p>לאחר שנרשמת לחשבון, תוכל לגשת לכל התכונות שיש ל-SeRanking להציע. אחת התכונות השימושיות ביותר היא כלי מחקר מילות המפתח. בעזרת כלי זה, תוכל לגלות אילו מילות מפתח הן הפופולריות ביותר בנישה שלך ולאחר מכן להשתמש במילות מפתח אלו כדי לשפר את דירוג האתר שלך. תכונה נהדרת נוספת היא הכלי לבניית קישורים. בעזרת הכלי הזה, תוכל לבנות קישורים נכנסים באיכות גבוהה לאתר שלך, מה שיעזור גם לשפר את דירוג האתר שלך.</p>\r\n<p>אם אתה רציני לגבי שיפור דירוג האתר שלך, אז אתה צריך להירשם לחשבון SeRanking עוד היום. עם הכלים החזקים והקלים שלו</p>\r\n<h2><strong>SeRanking הכל ב-SEO אחד מציע לך כלים אולטימטיביים לשלוט בדירוג SEO של מילות מפתח</strong></h2>\r\n<p>מחפש פלטפורמה אחת שתוכל לעזור לך בכל צרכי ה-SEO שלך? SeRanking הוא הפתרון בשבילך! כלי SEO הכל-באחד הזה מציע למשתמשים דירוג מילות מפתח, ניתוח וכלי שיווק שיעזרו לך להגביר את הנראות המקוונת שלך.</p>\r\n<p>עם SeRanking, אתה יכול לעקוב אחר דירוג מילות המפתח שלך במנועי החיפוש הגדולים, לקבל ניתוח מפורט של בריאות ה-SEO של האתר שלך, ולמצוא הזדמנויות חדשות לשיווק וקידום. SeRanking מקל על השמירה על משחק ה-SEO שלך ולהבטיח שהאתר שלך מתפקד במיטבו.</p>\r\n<p>אז למה אתה מחכה? הצטרף ל-SeRanking עוד היום!</p>\r\n<h2><strong>מיקומי דירוג בזמן אמת של מילות המפתח של האתר שלך 100% מעקב דירוג מילות מפתח מדויק</strong></h2>\r\n<p>אם אתה מחפש כלי ניתוח ושיווק SEO הכל-באחד, עליך לבדוק את SERanking. כלי רב עוצמה זה מספק מעקב מדויק אחר דירוג מילות מפתח בזמן אמת, כך שתוכל לראות את ביצועי האתר שלך במנועי החיפוש.</p>\r\n<p>SERanking גם מאפשר לך לעקוב אחר הדירוגים של המתחרים שלך, כך שתוכל לראות איך אתה מתמודד מולם. אתה יכול גם להשתמש ב-SERanking כדי לרגל אחר הקישורים הנכנסים שלהם ולמצוא הזדמנויות חדשות לבניית קישורים.</p>\r\n<p>SERanking מציעה גרסת ניסיון בחינם, כך שתוכל לנסות אותה לפני שתתחייב לתוכנית בתשלום. ואם תירשם לתוכנית בתשלום, תקבל גישה ליותר תכונות, כגון מחקר וניתוח מילות מפתח מפורטים, דוחות ביקורת אתרים ועוד.</p>\r\n<p>אז למה לחכות? הירשם ל-SERanking עוד היום וקח את משחק ה-SEO שלך לשלב הבא!</p>\r\n<h2><strong>הסיבות המובילות להשתמש ב-SeRanking ככלי SEO המקוון שלך עבור כל סוג של אתר אינטרנט</strong></h2>\r\n<p>כבעל עסק או מנהל אתר, אתה תמיד מחפש דרכים לשפר את הנוכחות שלך באינטרנט ולהקדים את המתחרים. אופטימיזציה למנועי חיפוש היא תחום מורכב ומשתנה ללא הרף, אך למרבה המזל ישנם כלים כמו SeRanking שיכולים לעזור לכם להישאר בעניינים. הנה רק כמה מהסיבות לכך ש-SeRanking הוא הכלי הטוב ביותר לניתוח ושיווק SEO הכל-באחד שאתה צריך על הסיפון:</p>\r\n<p>1. מחקר מילות מפתח מקיף. תכונות מחקר מילות המפתח של SeRanking הן שאין שני לה, ומאפשרות לך למצוא במהירות ובקלות את מילות המפתח הנכונות למיקוד עבור האתר שלך.</p>\r\n<p>2. ניתוח מתחרים רב עוצמה. עקוב אחר מה שהמתחרים שלך עושים עם כלי ניתוח המתחרים של SeRanking, כך שאתה תמיד יכול להישאר צעד אחד קדימה.</p>\r\n<p>3. ניתוח אתר מעמיק. תכונות ניתוח האתר של SeRanking נותנות לך תובנות לגבי ביצועי האתר שלך ואילו תחומים ניתן לשפר.</p>\r\n<p>4. דוחות מפורטים. SeRanking מספק דוחות מפורטים על כל ההיבטים של מסע הפרסום שלך לקידום אתרים, כך שתוכל לעקוב אחר ההתקדמות שלך ולזהות אזורים לשיפור.</p>\r\n<p>5. ניהול ללא טרחה. עם SeRanking, אתה יכול לנהל בקלות את כל ההיבטים שלך</p>\r\n<h2><strong>כמה עולה SeRanking ואיך אפשר להשיג אותו?</strong></h2>\r\n<p>SeRanking הוא כלי רב עוצמה לניתוח SEO ושיווק הכל-באחד שיכול לעזור לקחת את העסק שלך לשלב הבא. הוא מציע מגוון רחב של תכונות והטבות, והתמחור שלו נוח מאוד. אתה יכול להתחיל עם SeRanking במחיר נמוך של $9 לחודש.</p>\r\n<h2><strong>SeRanking לעומת כלי ניתוח וקידום אתרים אחרים</strong></h2>\r\n<p>כעת, לאחר שדיברנו על מה זה SeRanking וכיצד הוא יכול לעזור לעסק שלך, בואו נשווה אותו לכמה כלי שיווק פופולריים אחרים.</p>\r\n<p>ראשית, בואו נסתכל על Hootsuite. Hootsuite נהדר לניהול חשבונות המדיה החברתית שלך ותזמון פוסטים. עם זאת, זה לא מציע הרבה בניתוח SEO.</p>\r\n<p>לאחר מכן, בואו נסתכל על Moz. Moz הוא שם מוכר בעולם ה-SEO, ולא בכדי. הם מציעים מגוון כלים שיעזרו לך במאמצי SEO שלך. עם זאת, הכלים שלהם יכולים להיות יקרים, והם לא מציעים פתרון הכל-באחד כמו ש-SeRanking עושה.</p>\r\n<p>לבסוף, בואו נשווה את SeRanking ל- BuzzSumo. BuzzSumo הוא כלי פופולרי נוסף לניתוח התוכן שלך ומציאת משפיענים. עם זאת, הוא אינו מציע את אותו עומק ניתוח כפי שעושה SeRanking. בנוסף, SeRanking מציע יותר תכונות ממה שמציע BuzzSumo, מה שהופך אותה לבחירה טובה יותר עבור עסקים שרוצים פתרון הכל-באחד.</p>\r\n<p>לסיכום, SeRanking היא הבחירה הטובה ביותר לעסקים שרוצים פתרון הכל באחד</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>SeRanking הוא כלי נהדר לניתוח ושיווק SEO של הכל באחד. זה עזר לי לשפר את דירוג האתר שלי ולקבל יותר תנועה. החלק הכי טוב הוא שזה בחינם! אם אתם מחפשים פתרון SEO קל לשימוש, הכל-באחד, אני ממליץ על SeRanking.</p>\r\n<p></p>', '', 'xKigyI2iDH0k.jpg', 'se ranking, best seo tool', NULL, 0x5b7b226e616d65223a22494d475f61427277344f4f513445514d2e6a7067227d2c7b226e616d65223a22494d475f3433494a37593139463165702e6a7067227d5d, 'https://youtu.be/iHCGgpG3Kk8', 'https://seranking.com/?ga=1994597&source=link', 'affiliate', 0, 'downs', 0, 0, 0, 'o1KhOli6mC25gFMIyssofVvRrRw2L818', '', 'האם אתה מחפש כלי SEO מקיף שיכול לעזור לך לדרג גבוה יותר במנועי החיפוש ולשפר את השיווק הכולל שלך? אם כן, אז אתה צריך לבדוק את SeRanking.', 1, '2022-09-01 18:04:54'),
(16, 11, 'Serpstat - כלי פורץ הדרך לקידום אתרים, PPC, שיווק תוכן וניתוח מילות מפתח', 'serpstat', '284.99', '184.99', 1, '11', '0', '0', '<p>Serpstat הוא כלי שיכול לעזור לך עם SEO, PPC ושיווק תוכן. הוא מספק נתונים מפורטים על התנועה באתר שלך, מילות מפתח ועוד. במאמר זה, נסקור מקרוב מה Serpstat יכול לעשות וכיצד זה יכול לעזור לך להצמיח את העסק שלך.</p>\r\n<p>1. Serpstat יכול לעזור לך במאמצי SEO שלך על ידי מתן נתונים מפורטים על התנועה באתר שלך, מילות מפתח ועוד.</p>\r\n<p>2. Serpstat יכול גם לעזור לך עם מסעות הפרסום שלך ל-PPC על ידי מתן נתונים מפורטים על התנועה באתר ומילות המפתח שלך.</p>\r\n<p>3. לבסוף, Serpstat יכול לעזור לך עם שיווק התוכן שלך על ידי מתן נתונים מפורטים על התנועה באתר ומילות המפתח שלך.</p>\r\n<p></p>\r\n<h2><strong>אחת מפלטפורמות ה-All-in-One SEO הגדולות בשוק למקצוענים עם תכונות מדהימות</strong></h2>\r\n<p>אם אתה מחפש פלטפורמת קידום אתרים הכל-באחד שיש בה את כל מה שאתה צריך כדי להצליח בקמפיינים של SEO, PPC ושיווק תוכן, אז Serpstat הוא הכלי בשבילך. עם תכונות מדהימות כמו ביקורת אתרים, ניתוח מתחרים, מחקר מילות מפתח ועוד, Serpstat הוא הכלי המושלם עבור כל מקצוען שיווק. </p>\r\n<p>Serpstat היא פלטפורמת קידום אתרים הכל-באחד שיש בה את כל מה שאתה צריך כדי להצליח בקמפיינים של SEO, PPC ושיווק תוכן. עם תכונות מדהימות כמו ביקורת אתרים, ניתוח מתחרים, מחקר מילות מפתח ועוד, Serpstat הוא הכלי המושלם עבור כל מקצוען שיווק.</p>\r\n<p></p>\r\n<h2><strong>יש לו 30 כלים לקידום אתרים, למקצועני PPC, מומחי שיווק וסוכנויות דיגיטליות</strong></h2>\r\n<p>Serpstat הוא כלי פריצה רב עוצמה לצמיחה שיכול לעזור לך לשפר את מסעות הפרסום שלך לקידום אתרים, PPC ושיווק תוכן.</p>\r\n<p>לכלי יש מספר תכונות שיכולות להועיל מאוד לאנשי שיווק, כולל:</p>\r\n<p>- מחקר מילות מפתח: Serpstat עוזר לך למצוא את מילות המפתח הנכונות למיקוד עבור מסעות הפרסום שלך לקידום אתרים ו-PPC.</p>\r\n<p>- ניתוח תחרותי: Serpstat מאפשר לך לראות כיצד המתחרים שלך מדרגים עבור אותן מילות מפתח כמוך. מידע זה יכול לעזור לך להתאים את מסעות הפרסום שלך כדי להיות יעילים יותר.</p>\r\n<p>- ביקורת אתרים: כלי ביקורת האתר של Serpstat עוזר לך למצוא ולתקן שגיאות באתר שלך שעלולות להשפיע על SEO שלך.</p>\r\n<p>- ניתוח קישורים נכנסים: Serpstat מראה לך את הקישורים הנכנסים שיש למתחרים שלך כדי שתוכל לבנות קישורים דומים כדי לשפר את ה-SEO שלך.</p>\r\n<p>בסך הכל, Serpstat הוא כלי שימושי באמת לאנשי שיווק שרוצים לשפר את קמפיינים לקידום אתרים, PPC ותוכן שיווקי.</p>\r\n<h2><strong>Serpstat מנתח אתרים, מנתח מתחרים, מפעיל ביקורת, אשכולות, מעקב אחר דירוג וכו\'</strong></h2>\r\n<p>.Serpstat היא פלטפורמת SEO רבת עוצמה ומגוונת המכסה את כל ההיבטים של אופטימיזציה באתר ומחוצה לו. היתרונות העיקריים של Serpstat הם הפונקציונליות המקיפה שלו, המחיר הסביר וקלות השימוש.</p>\r\n<p>זהו כלי טוב לביקורת אתר משלך כמו גם לניתוח מתחרים. יש לו תכונות רבות, כולל מעקב אחר דירוג וניתוח מתחרים.</p>\r\n<p>Serpstat הוא כלי פריצת צמיחה רב עוצמה עבור SEO, PPC ושיווק תוכן. זה עוזר לך לנתח אתרים, לעקוב אחר דירוג מתחרים, לבקר את האתר שלך ועוד. </p>\r\n<p></p>\r\n<h2><strong>מאגר מילות המפתח הגדול ביותר של Serpstat עוזר באיסוף סמנטיקה עבור אתר</strong></h2>\r\n<p>מאגר מילות המפתח של Serpstat הוא הגדול ביותר בשוק. מאגר מילות המפתח עוזר מאוד לאיסוף נתונים על המתחרים. זה עוזר לך להבין לאילו מילות מפתח הם ממקדים וכיצד הם מדורגים עבור מילות מפתח אלו. מידע זה בעל ערך רב עבור מאמצי ה-SEO וה-PPC שלך. </p>\r\n<p></p>\r\n<h2><strong>Serpstat הוא הכלי הראשון בשוק להשגת רשימה של שאילתות חיפוש מגמתיות</strong></h2>\r\n<p>אם אתה רוצה להישאר בקדמת העקומה בקידום אתרים, PPC ושיווק תוכן, עליך להתחיל להשתמש ב-Serpstat. Serpstat הוא הכלי הראשון בשוק המספק למשתמשים רשימה של שאילתות חיפוש מגמתיות. מידע זה חשוב לאין ערוך עבור כל משווק מקוון שרוצה להקדים את המתחרים.</p>\r\n<p>על ידי שימוש ב-Serpstat, תוכל לראות אילו מילות מפתח אתה מחפש הכי הרבה ולאחר מכן להתאים את מסעות הפרסום שלך בהתאם. אתה יכול גם להשתמש ב-Serpstat כדי לרגל אחרי המתחרים שלך ולראות לאילו מילות מפתח הם מכוונים. בדרך זו, תוכל להתאים את מסעות הפרסום שלך כדי להיות יעילים יותר.</p>\r\n<p>אם אתה רציני לגבי שיווק מקוון, אתה צריך להתחיל להשתמש ב-Serpstat. זה הכלי היחיד שייתן לך את המידע שאתה צריך כדי להישאר לפני המתחרים.</p>\r\n<h2><strong>כדי להרחיב את העסק שלך, עליך להשתמש בפלטפורמת SEO All-in-One של serpstat</strong></h2>\r\n<p>Serpstat היא פלטפורמת הכל באחד לקידום אתרים, PPC ושיווק תוכן. הוא מציע מגוון רחב של תכונות שיכולות לעזור לך להצמיח את העסק שלך. עם Serpstat, אתה יכול לעקוב אחר הדירוג שלך, למצוא מילות מפתח חדשות ולחקור את המתחרים שלך. אתה יכול גם להשתמש ב-Serpstat כדי ליצור ולעקוב אחר מסעות הפרסום שלך ב-PPC. ועם תכונות שיווק התוכן שלו, אתה יכול ליצור תוכן באיכות גבוהה שיעזור לך למשוך יותר מבקרים לאתר שלך.</p>\r\n<h2><strong>כמה עולה Serpstat לחודש ואיפה אני יכול להשיג אותו?</strong></h2>\r\n<p>Serpstat הוא כלי לניתוח ומעקב אחר דירוג אתרים שמתחיל ב-284.99₪ לחודש. </p>\r\n<h2><strong>כלי SEO אחרים המובילים בשוק בהשוואה לכלי SEO All In One של Serpstat</strong></h2>\r\n<p>כפי שהשם מרמז, Serpstat הוא כלי SEO הכל-באחד המציע מגוון רחב של תכונות עבור SEO ו-PPC כאחד. מה שמייחד אותו מכלי SEO אחרים המובילים בשוק הוא ההתמקדות שלו בפריצה לצמיחה. עם Serpstat, אתה לא רק יכול לעקוב אחר ההתקדמות והביצועים שלך, אלא גם למצוא הזדמנויות חדשות לצמיחה.</p>\r\n<p>מבחינת תכונות, Serpstat מציעה את כל היסודות שהייתם מצפים מכלי SEO מוביל, כולל מחקר מילות מפתח, ביקורת אתרים, מעקב אחר דירוג וניתוח מתחרים. עם זאת, יש לו גם כמה תכונות ייחודיות המיועדות לפריצת צמיחה. לדוגמה, התכונה \"רעיונות לצמיחה\" עוזרת לך למצוא רעיונות חדשים להגדלת התנועה והמעורבות שלך.</p>\r\n<p>אם אתה מחפש כלי SEO שיעזור לך לפרוץ את הצמיחה שלך, אז Serpstat בהחלט שווה לשקול.</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>Serpstat הוא כלי שיווק הכל-באחד שיעזור לך עם SEO, PPC ושיווק תוכן. עם Serpstat, אתה יכול להצמיח את העסק שלך על ידי קבלת תנועה רבה יותר לאתר שלך ושיפור הדירוג שלך בדפי תוצאות של מנועי החיפוש. אתה יכול גם להשתמש ב-Serpstat כדי לרגל אחרי המתחרים שלך ולראות מה הם עושים כדי להתקדם. אם אתה רציני לגבי שיווק העסק שלך באינטרנט, אז Serpstat הוא כלי שאתה צריך בארסנל שלך.</p>\r\n<p></p>', '', '8m9agLSGGDKU.png', 'serpstat, seo tool, all in one seo tool', NULL, 0x5b7b226e616d65223a22494d475f584d5870586c6452576b41382e706e67227d2c7b226e616d65223a22494d475f39443643413246623378777a2e6a7067227d5d, 'https://youtu.be/rjIfKdIWk7M', 'https://serpstat.com/?ref=1533089', 'affiliate', 0, 'downs', 0, 5, 1, 'QmOdRhj3XEOoYVwx9uBuqPKHHZvElYBh', 'Serpstat', 'Serpstat הוא כלי שיכול לעזור לך עם SEO, PPC ושיווק תוכן. הוא מספק נתונים מפורטים על התנועה באתר שלך, מילות מפתח ועוד. במאמר זה, נסקור מקרוב מה Serpstat יכול לעשות וכיצד זה יכול לעזור לך להצמיח את העסק שלך.', 1, '2022-09-01 18:57:00');
INSERT INTO `products` (`id`, `category_id`, `title`, `slug`, `price`, `sprice`, `is_sale`, `categories`, `membership_id`, `files`, `body`, `pbody`, `thumb`, `tags`, `audio`, `images`, `youtube`, `affiliate`, `type`, `expiry`, `expiry_type`, `hits`, `likes`, `ratings`, `token`, `keywords`, `description`, `active`, `created`) VALUES
(18, 2, 'Canva - כלי לעיצוב גרפי מבוסס ענן מהמתקדמים בעולם (פשוט וקל לשימוש)', 'canva', '31.99', '21.99', 1, '2', '0', '0', '<p>Canva הוא כלי מקוון לעיצוב ופרסום גרפי, פשוט לשימוש וחזק מאוד. הוא מבוסס ענן, כך שניתן לגשת אליו מכל מקום, ויש לו מגוון רחב של תכונות שהופכות אותו למתאים לכל דבר, החל מיצירת פליירים פשוטים ועד לעיצוב חומרי שיווק מורכבים. כל שעליך לעשות הוא ליצור חשבון ולהתחיל להשתמש במגוון הרחב של תבניות, כלים ומשאבים הזמינים. ל-Canva יש גם ספרייה ענקית של תמונות מלאי, איורים ואייקונים שניתן להשתמש בהם בעיצובים שלך.</p>\r\n<p></p>\r\n<h2><strong>צור פוסטר, מצגת, עלון, קורות חיים, תעודה, אינפוגרפיקה ומדיה אחרת עם Canva</strong></h2>\r\n<p>בהנחה שתרצו טיפים לבלוג Canva:</p>\r\n<p>1. צור כותרת קליטה המשקפת במדויק את תוכן הפוסט שלך.</p>\r\n<p>2. כתבו בסגנון ברור, תמציתי וקל לקריאה.</p>\r\n<p>3. עניין את הקוראים שלך באמצעות טכניקות סיפור חזקות.</p>\r\n<p>4. השתמש בתמונות, אינפוגרפיקות וסרטונים כדי לפצל את הטקסט שלך ולהוסיף עניין ויזואלי.</p>\r\n<p>5. נצל את הספרייה הנרחבת של תבניות, כלים ומשאבים של Canva כדי לגרום לפוסט שלך להיראות מקצועי ומצוחצח.</p>\r\n<p>6. השתמש במדיה חברתית כדי לקדם את הפוסט בבלוג שלך ולהגיע לקהל גדול יותר.</p>\r\n<h2><strong>הכלים והתבניות השימושיים של Canva יכולים לעזור לך לקחת את כישורי העיצוב שלך לשלב הבא</strong></h2>\r\n<p>אם אתה מחפש לשפר את כישורי העיצוב שלך, Canva הוא משאב נהדר. עם הכלים והתבניות שלו, אתה יכול ליצור בקלות עיצובים בעלי מראה מקצועי. בנוסף, הפלטפורמה מבוססת הענן שלה מקלה על גישה לעיצובים שלך מכל מקום.</p>\r\n<h2><strong>תוכנת עיצוב גרפי מבוססת ענן אולטימטיבית עבור סטודנטים או ארגונים כדי לחסוך זמן וכסף</strong></h2>\r\n<p>בהנחה שתרצו טיפים לבלוג Canva:</p>\r\n<p>1) כסטודנט, זמן יקר. יש עצות כיצד להשתמש ב-Canva בצורה יעילה יותר?</p>\r\n<p>2) עבור ארגונים, יעילות היא המפתח. כיצד יכולות קבוצות להפיק את המרב מיכולות העיצוב של Canva?</p>\r\n<p>3) מהן כמה דרכים יצירתיות להשתמש בכלים של Canva?</p>\r\n<h2><strong>המגמה היא לעיצוב מבוסס ענן Canva היא הדור הבא של תוכנות עיצוב גרפי</strong></h2>\r\n<p>אין ספק שעיצוב מבוסס ענן נמצא במגמת עלייה. Canva מובילה את המשימה עם תוכנת העיצוב הגרפי החדשנית והידידותית שלה.</p>\r\n<p>Canva הוא הכלי המושלם לכל מי שרוצה ליצור עיצובים יפים ללא כל ניסיון קודם או ידע עיצובי. התוכנה קלה להפליא לשימוש, ויש מיליוני תבניות ומשאבים זמינים כדי לעזור לך להתחיל.</p>\r\n<p>מה שעוד יותר מרשים הוא שניתן להשתמש ב-Canva למגוון רחב של פרויקטים עיצוביים, החל מיצירת פליירים ופוסטרים פשוטים ועד לעיצוב לוגואים במראה מקצועי וחומרי שיווק.</p>\r\n<p>אם אתם מחפשים כלי עיצוב חזק ורב-תכליתי מבוסס ענן, Canva היא האפשרות המושלמת.</p>\r\n<h2><strong>עיצוב גרפי הופך להיות חובה עבור כל העסק כדי להשיג נראות ומכירות גבוהות</strong></h2>\r\n<p>כבעל עסק, אתה יודע שנראות גבוהה חיונית להצלחה. אתה גם יודע שעיצוב גרפי הוא מרכיב מרכזי בהשגת הנראות הזו. למרבה הצער, ייתכן שאין לך את הזמן או את הכישורים הדרושים כדי ליצור עיצובים יפים בעצמך. זה המקום שבו Canva נכנס לתמונה.</p>\r\n<p>Canva הוא כלי עיצוב גרפי ופרסום מבוסס ענן שכל אחד יכול להשתמש בו כדי ליצור עיצובים מדהימים. עם Canva, אין צורך לשכור מעצב יקר או להיות מומחה עיצוב בעצמך. פשוט בחר מתוך אחת מאלפי התבניות הזמינות, ולאחר מכן התאם אותה לטעמך בכמה קליקים בלבד.</p>\r\n<p>בין אם אתה צריך פלייר מושך את העין למכירה הבאה שלך או לוגו בעל מראה מקצועי לאתר האינטרנט שלך, Canva דאג לך. והכי חשוב, מכיוון שהכל נעשה באינטרנט, אתה יכול בקלות לשתף את העיצובים שלך עם כל אחד אחר בצוות שלך מבלי לדאוג לגבי קבצים מצורפים לדוא\"ל או פורמטים של קבצים.</p>\r\n<p>אם אתה מחפש דרך קלה ובמחיר סביר לשפר את הנראות של העסק שלך, Canva הוא הפתרון המושלם.</p>\r\n<h2><strong>היתרונות של בחירת Canva ככלי העיצוב הגרפי האולטימטיבי והקל שלך</strong></h2>\r\n<p>בכל הנוגע לעיצוב גרפי ופרסום, Canva הוא בהחלט אחד הכלים החזקים ביותר שקיימים בענן. לא רק שהוא קל לשימוש, אלא שהוא גם מציע מגוון רחב של תכונות שהופכות אותו לאידיאלי עבור כולם, החל ממתחילים ועד למקצוענים. הנה רק חלק מהיתרונות של בחירת Canva ככלי הבחירה שלך:</p>\r\n<p>1. Canva ידידותית במיוחד למשתמש. גם אם מעולם לא השתמשת בכלי עיצוב גרפי לפני כן, תוכל להבין את Canva במהירות ולהתחיל ליצור עיצובים יפים.</p>\r\n<p>2. Canva מציעה ספרייה ענקית של תבניות ונכסים. בין אם אתה צריך פוסט במדיה חברתית או כותרת דוא\"ל, תוכל למצוא תבנית שמתאימה באופן מושלם לצרכים שלך. ואם אינך מוצא את מה שאתה מחפש, אתה תמיד יכול ליצור תבנית משלך מאפס.</p>\r\n<p>3. ממשק הגרירה והשחרור של Canva הופך את העיצוב לקל ומהנה. בכמה לחיצות בלבד, תוכל להוסיף תמונות, טקסט ואלמנטים אחרים לעיצוב שלך. ואם אתה רוצה להיות יצירתי באמת, אתה יכול אפילו ליצור צורות ואיורים משלך.</p>\r\n<p>4. יכול</p>\r\n<h2><strong>כמה עולה Canva Pro וכיצד ניתן לרכוש אותו?</strong></h2>\r\n<p>אם אתם מחפשים כלי עיצוב גרפי ופרסום רב עוצמה מבוסס ענן, Canva בהחלט שווה בדיקה. ואם אתם תוהים כמה עולה לשדרג ל-Canva Pro, יש לנו את כל הפרטים בשבילכם.</p>\r\n<p>Canva Pro זמין עבור 31.99₪ לחודש. אתה יכול גם להירשם לניסיון חינם של 14 יום כדי לבדוק את כל התכונות ולראות אם זה מתאים לך.</p>\r\n<p>כדי להירשם ל-Canva Pro, פשוט עבור אל דף התמחור באתר Canva ובחר את התוכנית שלך. לאחר שתזין את פרטי התשלום שלך, תוכל לגשת לכל תכונות הפרימיום ולהתחיל ליצור עיצובים יפים.</p>\r\n<h2><strong>תכונות נוספות של Canvas והשוואה לכלי עיצוב אחרים מבוססי ענן</strong></h2>\r\n<p>Canvas הוא כלי עיצוב גרפי ופרסום מבוסס ענן, פשוט לשימוש וחזק מאוד. עם Canvas, אתה יכול ליצור עיצובים יפים לאתר, לבלוג או לפרופיל המדיה החברתית שלך בתוך דקות. אתה לא צריך שום ניסיון או ידע קודם בעיצוב כדי להשתמש ב-Canvas - זה מתאים לכולם.</p>\r\n<p>ל-Canvas יש מגוון רחב של תכונות שהופכות אותו לכלי העיצוב מבוסס הענן החזק ביותר שקיים. עם Canvas, אתה יכול ליצור עיצובים מותאמים אישית מאפס או לערוך תבניות קיימות כדי שיתאימו לצרכים שלך. אתה יכול גם להעלות תמונות ואיורים משלך לשימוש בעיצובים שלך.</p>\r\n<p>קנבס קל לשימוש ואינטואיטיבי מאוד. גם אם מעולם לא השתמשת בכלי עיצוב גרפי לפני כן, תוכל ליצור עיצובים מדהימים עם Canvas. ממשק המשתמש נקי ופשוט, ויש הרבה מדריכים ותמיכה זמינים אם אתה צריך עזרה להתחיל.</p>\r\n<p>Canvas גם זול הרבה יותר מכלי עיצוב גרפי מבוססי ענן אחרים בשוק. תמורת תשלום חודשי בודד, אתה מקבל גישה לכל התכונות של Canvas - אין עלויות נסתרות או תוספות. זה הופך את Canvas לאופציה החסכונית ביותר עבור עסקים קטנים או אנשים שרוצים ליצור מקצועי-</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>Canva הוא כלי רב עוצמה לעיצוב ופרסום גרפי מבוסס ענן המושלם לכולם, ממתחילים ועד למקצוענים. עם ממשק קל לשימוש ומגוון רחב של תבניות וכלים, Canva מקל על יצירת עיצובים מדהימים לכל אירוע. בין אם אתה צריך פלייר פשוט לאירוע הבא שלך או חבילת מיתוג מלאה לעסק שלך, ל-Canva יש את כל מה שאתה צריך כדי לבצע את העבודה. אז למה לא לנסות את זה היום? אתה עשוי להיות מופתע עד כמה עיצוב יכול להיות קל ומהנה!</p>\r\n<p></p>', '', 'lSFMK7hcddDJ.jpg', 'canva, canva pro, graphic design', NULL, 0x5b7b226e616d65223a22494d475f6331475767485153554543592e6a7067227d2c7b226e616d65223a22494d475f664d6b36656e4857493251652e6a7067227d5d, 'https://youtu.be/WcHEKpSJje4', 'https://partner.canva.com/ZdWmW0', 'affiliate', 0, 'downs', 0, 0, 0, 'H8on25HN9Ql4uz9uQjk3isJ6OIzSbQlE', 'canva pro', '', 1, '2022-09-02 10:11:42'),
(19, 2, 'Stencil - עצב תוכן ויזואלי מדהים מהר ופשוט יותר ממה שאי פעם חשבת שאפשר', 'stencil', '44.99', '30.99', 1, '2', '0', '0', '<p>אם אתה מישהו שמתקשה ליצור תוכן ויזואלי, בין אם זה עבור מדיה חברתית או אתר האינטרנט שלך, אז אתה צריך לבדוק את סטנסיל. עם סטנסיל, אתה יכול ליצור תמונות מדהימות בשבריר מהזמן ובהרבה פחות מאמץ ממה שאי פעם חשבת שאפשר.</p>\r\n<p>Stencil היא פלטפורמה מקוונת שנותנת לך גישה למיליוני תמונות, איורים וגופנים באיכות גבוהה. אתה יכול גם להשתמש בכלים המובנים שלהם כדי לערוך ולהתאים אישית את הוויזואליה שלך בקלות.</p>\r\n<p>והכי חשוב, סטנסיל חופשי לשימוש! אז אם אתה מחפש דרך ליצור בקלות ויזואליה מרהיבה, הקפד לבדוק את סטנסיל.</p>\r\n<h2><strong>כלי עיצוב רב עוצמה ליצירת תמונות מדיה חברתית, פרסומות מושכות עין וגרפיקה תוססת</strong></h2>\r\n<p>אם אתה מחפש דרך קלה ועוצמתית ליצור תוכן ויזואלי מדהים, אז תרצה לבדוק את סטנסיל. עם סטנסיל, תוכל ליצור במהירות ובקלות תמונות מדהימות של מדיה חברתית, מודעות מושכות עין וגרפיקה תוססת - והכל ללא ניסיון קודם בעיצוב.</p>\r\n<p>מה שמעולה בסטנסיל הוא שהיא מציעה מגוון רחב של תבניות וכלים שהופכים את זה לסופר פשוט ליצור חזותיים באיכות גבוהה. ואם אי פעם נתקעת, יש גם מרכז עזרה מובנה עם הדרכות שלב אחר שלב שידריכו אותך בתהליך העיצוב.</p>\r\n<p>אז אם אתה מחפש דרך מהירה וקלה לעלות את הרמה החזותית שלך, הקפד לנסות את Stencil.</p>\r\n<h2><strong>לסטנסיל יש אלפי תבניות מעוצבות מראש שניתן להשתמש בהן מיד</strong></h2>\r\n<p>אם אתם מחפשים דרך לעצב תוכן ויזואלי מדהים במהירות ובקלות, סטנסיל הוא הכלי המושלם עבורכם. עם אלפי תבניות מעוצבות מראש, כל מה שאתה צריך לעשות הוא לבחור את התבניות המתאימה ביותר לצרכים שלך, להוסיף טקסט ותמונות משלך, ואתה מוכן ללכת. בנוסף, Stencil מציעה מגוון רחב של אפשרויות התאמה אישית כדי שתוכלו באמת לבלוט את הוויזואליה שלכם. אז למה לחכות? התחל עם Stencil עוד היום וראה כמה קל ומהנה יצירת תוכן ויזואלי יכולה להיות!</p>\r\n<h2><strong>תכונות ייחודיות של Stencil עוזרות לך לחסוך זמן וכסף בעת עיצוב תוכן גרפי</strong></h2>\r\n<p>סטנסיל הוא כלי עיצוב חזק וקל לשימוש שעוזר לך ליצור תוכן ויזואלי מדהים מהר ופשוט יותר ממה שאי פעם חשבת שאפשר. הנה כמה מהתכונות הייחודיות שהופכות את הסטנסיל לכל כך מיוחד:</p>\r\n<p>1. תבניות: עם Stencil, אתה יכול לגשת לספרייה של תבניות מעוצבות מראש כדי לעזור לך להתחיל במהירות ובקלות. זה חוסך לך זמן וכסף בכך שהוא מאפשר לך ליצור תוכן באיכות גבוהה מבלי להתחיל מאפס.</p>\r\n<p>2. גרור ושחרר: ממשק הגרירה והשחרור של סטנסיל מקל על הוספת תמונות וטקסט משלך ליצירת עיצובים מותאמים אישית. זהו חיסכון עצום בזמן בהשוואה לכלי עיצוב אחרים הדורשים ממך לדעת שפות קידוד מורכבות.</p>\r\n<p>3. שיתוף: לאחר שתסיים ליצור את יצירת המופת שלך, סטנסיל מקל על שיתוף העבודה שלך עם העולם. אתה יכול לייצא את העיצובים שלך כקובצי JPEG, PNG או PDF, או לשתף אותם ישירות במדיה החברתית.</p>\r\n<h2><strong>סטנסיל מספק אוסף ענק של 8,100,000+ תמונות מדהימות ללא תמלוגים לשימוש</strong></h2>\r\n<p>אם אתם מחפשים תמונות מלאי באיכות גבוהה ללא תמלוגים לשימוש בפרויקט הבא שלכם, אל תחפשו רחוק יותר מ-Stencil. עם אוסף עצום של תמונות מדהימות, סטנסיל מקל על מציאת התמונה המושלמת לפרויקט שלך.</p>\r\n<p>והכי טוב, השימוש בסטנסיל מהיר ופשוט. פשוט בחר את התמונה שבה ברצונך להשתמש, הורד אותה ולאחר מכן העלה אותה לפרויקט שלך. זה כזה קל!</p>\r\n<p>אז למה לחכות? התחל היום וראה כמה קל ליצור תוכן ויזואלי מדהים עם Stencil.</p>\r\n<h2><strong>הפוך ליותר פרודוקטיבי עם כלי זה לעיצוב גרפי מבוסס אינטרנט שימושי עבור העסק שלך</strong></h2>\r\n<p>אם אתה בעניין של יצירת תוכן ויזואלי, אז אתה יודע כמה זמן וקשה זה יכול להיות. יש כל כך הרבה תוכנות שונות בחוץ שזה יכול להיות קשה למצוא את התוכנה המתאימה לצרכים שלך. אבל מה אם הייתה תוכנית פשוטה לשימוש ועזרה לך ליצור חזותיים מדהימים מהר יותר ממה שאי פעם חשבת שאפשר? שם נכנסת הסטנסיל לתמונה.</p>\r\n<p>עם סטנסיל, אתה יכול ליצור במהירות ובקלות חזותיים מרהיבים עבור פוסטים בבלוג שלך, פוסטים במדיה חברתית ואפילו מודעות. והחלק הטוב ביותר הוא ש-Stencil מבוססת אינטרנט, כך שתוכל לגשת אליה מכל מקום. אז בין אם אתה בבית או בעבודה, אתה תמיד יכול לעצב ויזואליה מדהימה.</p>\r\n<p>אז אם אתה מחפש דרך להפוך ליותר פרודוקטיבית עם יצירת התוכן החזותי שלך, בדוק את סטנסיל. זה פשוט יכול להיות הפתרון שחיפשת.</p>\r\n<h2><strong>תכונות סטנסיל והשוואה לכלי עיצוב גרפי מובילים אחרים מבוססי ענן</strong></h2>\r\n<p>אם אתה כמו רוב האנשים, אתה בוודאי חושב על עיצוב גרפי כעל משהו שקשה מדי או לוקח זמן רב מדי להתמודד איתו לבד. אבל מה אם היינו אומרים לך שיש כלי שיכול להפוך את התהליך כולו לקל ומהיר יותר ממה שאי פעם חשבת שאפשר?</p>\r\n<p>הזן סטנסיל.</p>\r\n<p>סטנסיל הוא כלי עיצוב גרפי מבוסס ענן שמקל על יצירת ויזואליות מדהימות עבור הבלוג, המדיה החברתית שלך, או אפילו סתם בשביל הכיף. עם סטנסיל, אתה לא צריך להיות מעצב מקצועי או להיות בעל ניסיון קודם - כל מה שאתה צריך הוא נכונות ליצור משהו יפה.</p>\r\n<p>אז מה עושה סטנסיל כל כך מיוחד? בתור התחלה, זה קל להפליא לשימוש. עם ממשק הגרירה והשחרור הפשוט שלו, כל אחד יכול ליצור עיצובים מדהימים תוך דקות ספורות. ואם אתה לא ממש בטוח מאיפה להתחיל, אל תדאג - סטנסיל מגיע עם ספרייה של תבניות ותמונות מובנות כדי להתחיל.</p>\r\n<p>אבל אולי החלק הכי טוב בסטנסיל הוא שזה במחיר סביר. עם תוכניות שמתחילות ב-$9 בלבד לחודש, זה חלק מהעלות של כלי עיצוב גרפי מובילים אחרים. בנוסף, אין</p>\r\n<h2><strong>מה המחיר של Stencil Pro ואיך קונים אותו?</strong></h2>\r\n<p>מחיר סטנסיל פרו הוא 44.99₪ לחודש, וניתן לרכוש אותו בכניסה לאתר ולחיצה על כפתור \"קנה עכשיו\".</p>\r\n<h2><strong>סיכום</strong></h2>\r\n<p>סטנסיל הוא כלי מדהים שיכול לעזור לך ליצור תוכן ויזואלי מהר ופשוט יותר ממה שאי פעם חשבת שאפשר. עם הממשק הקל לשימוש ומגוון רחב של תבניות, אתה יכול בקלות ליצור חזותיים מרהיבים שיעזרו לעסק שלך להתבלט מהקהל. אז למה לחכות? נסה את Stencil היום וראה כיצד היא יכולה לשנות את העסק שלך.</p>\r\n<p></p>', '', 'PU0LIUQmGeKS.jpg', 'stencil, stencil pro, getstencil', NULL, 0x5b7b226e616d65223a22494d475f6239507a6b68536a6b3447712e6a7067227d2c7b226e616d65223a22494d475f6f557265385145314c6a6c372e6a7067227d5d, 'https://youtu.be/KDof_i2GjVA', 'https://getstencil.com?tap_a=9103-1801f8&tap_s=3104704-6a87d6', 'affiliate', 0, 'downs', 0, 0, 0, 'WVJkdJvhYy6qC5jVAFfwtJDfoZAWz5pP', 'stencil pro', '', 1, '2022-09-02 11:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` smallint(4) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `code`, `icon`, `name`, `description`) VALUES
(1, 'owner', 'badge', 'Site Owner', 'Site Owner is the owner of the site, has all privileges and could not be removed.'),
(2, 'staff', 'trophy', 'Staff Member', 'The &#34;Staff&#34; members  is required to assist the Owner, has different privileges and may be created by Site Owner.'),
(3, 'editor', 'note', 'Editor', 'The &#34;Editor&#34; is required to assist the Staff Members, has different privileges and may be created by Site Owner.');

-- --------------------------------------------------------

--
-- Table structure for table `role_privileges`
--

CREATE TABLE `role_privileges` (
  `id` int(11) UNSIGNED NOT NULL,
  `rid` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `pid` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_privileges`
--

INSERT INTO `role_privileges` (`id`, `rid`, `pid`, `active`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 0),
(4, 1, 2, 1),
(5, 2, 2, 1),
(6, 3, 2, 0),
(7, 1, 3, 1),
(8, 2, 3, 1),
(9, 3, 3, 1),
(10, 1, 4, 1),
(11, 2, 4, 1),
(12, 3, 4, 0),
(13, 1, 5, 1),
(14, 2, 5, 1),
(15, 3, 5, 1),
(16, 1, 6, 1),
(17, 2, 6, 1),
(18, 3, 6, 1),
(19, 1, 7, 1),
(20, 2, 7, 1),
(21, 3, 7, 0),
(22, 1, 8, 1),
(23, 2, 8, 1),
(24, 3, 8, 0),
(25, 1, 9, 1),
(26, 2, 9, 1),
(27, 3, 9, 1),
(28, 1, 10, 1),
(29, 2, 10, 0),
(30, 3, 10, 0),
(31, 1, 11, 1),
(32, 2, 11, 1),
(33, 3, 11, 1),
(34, 1, 12, 1),
(35, 2, 12, 1),
(36, 3, 12, 1),
(37, 1, 13, 1),
(38, 2, 13, 1),
(39, 3, 13, 1),
(40, 1, 14, 1),
(41, 2, 14, 1),
(42, 3, 14, 0),
(43, 1, 15, 1),
(44, 2, 15, 1),
(45, 3, 15, 1),
(46, 1, 16, 1),
(47, 2, 16, 1),
(48, 3, 16, 1),
(49, 1, 17, 1),
(50, 2, 17, 1),
(51, 3, 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` tinyint(1) UNSIGNED NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `site_dir` varchar(50) DEFAULT NULL,
  `site_email` varchar(50) NOT NULL,
  `color` varchar(16) DEFAULT NULL,
  `theme` varchar(32) NOT NULL,
  `perpage` tinyint(2) UNSIGNED NOT NULL,
  `featured` tinyint(1) UNSIGNED NOT NULL DEFAULT 16,
  `cperpage` tinyint(1) UNSIGNED NOT NULL DEFAULT 16,
  `home_layout` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 = grid, 1 = list',
  `backup` varchar(64) NOT NULL,
  `thumb_w` smallint(3) UNSIGNED NOT NULL,
  `thumb_h` smallint(3) UNSIGNED NOT NULL,
  `avatar_w` smallint(2) UNSIGNED NOT NULL,
  `avatar_h` smallint(2) UNSIGNED NOT NULL,
  `short_date` varchar(20) NOT NULL,
  `long_date` varchar(30) NOT NULL,
  `time_format` varchar(10) DEFAULT NULL,
  `dtz` varchar(120) DEFAULT NULL,
  `locale` varchar(200) DEFAULT NULL,
  `weekstart` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  `lang_list` blob NOT NULL,
  `allow_free` varchar(3) NOT NULL DEFAULT 'yes',
  `enable_comments` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `ploader` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `eucookie` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `offline` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `offline_msg` text DEFAULT NULL,
  `offline_d` date DEFAULT NULL,
  `offline_t` time DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `plogo` varchar(50) DEFAULT NULL,
  `currency` varchar(4) DEFAULT NULL,
  `enable_tax` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `file_dir` varchar(150) DEFAULT NULL,
  `reg_verify` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `auto_verify` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `notify_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `flood` int(3) UNSIGNED NOT NULL DEFAULT 3600,
  `attempt` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `logging` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `analytics` text DEFAULT NULL,
  `mailer` enum('SMTP','SMAIL') DEFAULT NULL,
  `sendmail` varchar(60) DEFAULT NULL,
  `smtp_host` varchar(150) DEFAULT NULL,
  `smtp_user` varchar(50) DEFAULT NULL,
  `smtp_pass` varchar(50) DEFAULT NULL,
  `smtp_port` varchar(3) DEFAULT NULL,
  `is_ssl` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `inv_info` text DEFAULT NULL,
  `inv_note` text DEFAULT NULL,
  `social_media` blob DEFAULT NULL,
  `mapapi` varchar(120) DEFAULT NULL,
  `wojon` decimal(4,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `wojov` decimal(4,2) UNSIGNED NOT NULL DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `company`, `site_dir`, `site_email`, `color`, `theme`, `perpage`, `featured`, `cperpage`, `home_layout`, `backup`, `thumb_w`, `thumb_h`, `avatar_w`, `avatar_h`, `short_date`, `long_date`, `time_format`, `dtz`, `locale`, `weekstart`, `lang`, `lang_list`, `allow_free`, `enable_comments`, `ploader`, `eucookie`, `offline`, `offline_msg`, `offline_d`, `offline_t`, `logo`, `plogo`, `currency`, `enable_tax`, `file_dir`, `reg_verify`, `auto_verify`, `notify_admin`, `flood`, `attempt`, `logging`, `analytics`, `mailer`, `sendmail`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `is_ssl`, `inv_info`, `inv_note`, `social_media`, `mapapi`, `wojon`, `wojov`) VALUES
(1, 'דיגיטל פלאנט', 'דיגיטל פלאנט', '', 'support@digitalplanet.co.il', '_default.css', 'modern', 12, 20, 40, 1, '11-Oct-2017_23-52-35.sql', 300, 300, 250, 250, 'dd MMM yyyy', 'MMMM dd, yyyy hh:mm a', 'HH:mm', 'Asia/Jerusalem', 'iw_IL', 0, 'he', 0x5b7b226964223a312c226e616d65223a22456e676c697368222c2261626272223a22656e222c226c616e67646972223a226c7472222c22636f6c6f72223a2223374143423935222c22617574686f72223a22687474703a5c2f5c2f7777772e776f6a6f736372697074732e636f6d222c22686f6d65223a317d2c7b226964223a342c226e616d65223a224672656e6368222c2261626272223a226672222c226c616e67646972223a226c7472222c22636f6c6f72223a2223303062636434222c22617574686f72223a22687474703a5c2f5c2f7777772e776f6a6f736372697074732e636f6d222c22686f6d65223a307d5d, 'yes', 1, 0, 0, 0, '<p>Our website is under construction, we are working very hard to give you the best experience on our new web site.</p>', '2018-06-30', '17:19:00', 'print_logo.png', 'print_logo.png', 'ILS', 1, '/replace_with_your_own/', 1, 0, 1, 300, 2, 0, 'UA-239742790-1', 'SMTP', '/usr/sbin/sendmail -t -i', 'email-smtp.us-east-2.amazonaws.com', 'AKIAWN3TI47CPLAG4TRE', 'BMWscWO7Ha02d2wAMshU6NoASFb0IZxPBx/5LWFUJG/l', '25', 0, '<p><strong>ABC Company Pty Ltd</strong><br>123 Burke Street, Toronto ON, CANADA<br>Tel : (416) 1234-5678, Fax : (416) 1234-5679<br>Email : sales@abc-company.com</p>', '<p>TERMS & CONDITIONS<br>1. Interest may be levied on overdue accounts. <br>2. Goods sold are not returnable or refundable</p>', 0x7b2266616365626f6f6b223a2266616365626f6f6b5f70616765222c2274776974746572223a22747769747465725f70616765227d, '', '1.50', '5.01');

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE `trash` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent` varchar(15) DEFAULT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `type` varchar(15) DEFAULT NULL,
  `dataset` blob DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trash`
--

INSERT INTO `trash` (`id`, `parent`, `parent_id`, `type`, `dataset`, `created`) VALUES
(1, NULL, 1, 'category', 0x7b226964223a312c226e616d65223a22536f667477617265222c22706172656e745f6964223a302c22736c7567223a22736f667477617265222c22626f6479223a224c6f6f6b696e6720666f72206c6963656e73656420736f66747761726520666f7220796f757220636f6d7075746572206f72206e6574776f726b3f20222c226b6579776f726473223a22222c226465736372697074696f6e223a22222c22736f7274696e67223a322c22616374697665223a317d, '2022-08-26 07:37:59'),
(2, 'category', 1, 'subcategory', 0x7b226964223a352c226e616d65223a22416e7469766972757320616e64205365637572697479222c22706172656e745f6964223a312c22736c7567223a22616e746976697275732d616e642d7365637572697479222c22626f6479223a6e756c6c2c226b6579776f726473223a22222c226465736372697074696f6e223a22222c22736f7274696e67223a332c22616374697665223a317d, '2022-08-26 07:37:59'),
(3, 'category', 1, 'subcategory', 0x7b226964223a362c226e616d65223a2242757373696e657320616e64204163636f756e74696e67222c22706172656e745f6964223a312c22736c7567223a2262757373696e65732d616e642d6163636f756e74696e67222c22626f6479223a6e756c6c2c226b6579776f726473223a22222c226465736372697074696f6e223a22222c22736f7274696e67223a342c22616374697665223a317d, '2022-08-26 07:37:59'),
(4, 'category', 1, 'subcategory', 0x7b226964223a372c226e616d65223a22437573746f6d657220537570706f7274222c22706172656e745f6964223a312c22736c7567223a22637573746f6d65722d737570706f7274222c22626f6479223a6e756c6c2c226b6579776f726473223a6e756c6c2c226465736372697074696f6e223a6e756c6c2c22736f7274696e67223a352c22616374697665223a317d, '2022-08-26 07:37:59'),
(5, NULL, 2, 'page', 0x7b226964223a322c227469746c65223a225c75303565325c75303564635c75303564395c75303565305c7530356435222c22736c7567223a2261626f7574222c22626f6479223a223c68313e3c7374726f6e673e5c75303564345c75303564625c75303564395c75303565385c7530356435205c75303564305c7530356561204469676974616c506c616e65742e636f2e696c2c205c75303564345c75303564305c75303565615c7530356538205c75303564345c75303564375c75303564335c7530356539205c75303564635c75303564625c75303564635c7530356439205c75303565395c75303564395c75303564355c75303564355c7530356537205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564392c205c75303564625c75303564635c7530356439205c75303565375c75303564395c75303564335c75303564355c7530356464205c75303564305c75303565615c75303565385c75303564395c75303564642c205c75303564625c75303564635c7530356439205c75303565345c75303564395c75303565615c75303564355c7530356437205c75303564305c75303565615c75303565385c75303564395c7530356464205c75303564355c75303565615c75303564355c75303564625c75303565305c7530356434205c75303564635c75303564655c75303565325c75303565365c75303564315c75303564395c7530356464205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c75303564643c5c2f7374726f6e673e3c5c2f68313e5c725c6e3c703e4469676974616c506c616e65742e636f2e696c205c75303564345c75303564355c7530356430205c75303564305c75303565615c7530356538205c75303564375c75303564335c7530356539205c75303564635c75303564325c75303564655c75303565385c7530356439205c75303564345c75303564655c75303565365c75303564395c7530356532205c75303564655c75303564325c75303564355c75303564355c7530356466205c75303565385c75303564375c7530356431205c75303565395c7530356463205c75303564625c75303564635c7530356439205c75303565395c75303564395c75303564355c75303564355c7530356537205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564392c2053454f2c205c75303565345c75303564395c75303565615c75303564355c7530356437205c75303564305c75303565615c75303565385c75303564395c7530356464205c75303564355c75303565325c75303564395c75303565365c75303564355c7530356431205c75303564345c75303564625c7530356463205c75303564315c75303564655c75303565375c75303564355c7530356464205c75303564305c75303564375c75303564332e205c75303564315c75303564395c7530356466205c75303564305c7530356464205c75303564305c75303565615c7530356434205c75303564655c75303565375c75303565365c75303564355c75303565325c7530356466205c75303564355c75303565615c75303564395c7530356537205c75303564305c7530356435205c75303565385c7530356537205c75303564315c75303565615c75303564375c75303564395c75303564635c7530356561205c75303564345c75303564335c75303565385c7530356461205c75303564315c75303565325c75303564355c75303564635c7530356464205c75303564345c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564392c205c75303564315c75303564305c75303565615c7530356538205c75303564365c7530356434205c75303564395c7530356539205c75303564655c75303565395c75303564345c7530356435205c75303564635c75303564625c75303564355c75303564635c75303564642e205c75303565325c75303564395c75303564395c7530356466205c75303564315c75303565385c75303565395c75303564395c75303564655c7530356434205c75303564345c75303564655c75303565375c75303564395c75303565345c7530356434205c75303565395c75303564635c75303565305c7530356435205c75303565395c7530356463205c75303565615c75303564625c75303564355c75303565305c75303564355c7530356561205c75303564635c75303564655c75303564385c7530356434213c5c2f703e5c725c6e3c68323e3c7374726f6e673e5c75303564305c75303565615c7530356538205c75303565385c75303564305c75303565395c75303564355c7530356466205c75303564655c75303565315c75303564355c75303564325c7530356435205c75303564315c75303564395c75303565395c75303565385c75303564305c7530356463205c75303565325c7530356464205c75303564625c7530356463205c75303564345c75303564625c75303564635c75303564395c7530356464205c75303564345c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c7530356464205c75303564635c75303564305c75303565305c75303565395c75303564395c7530356464205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c75303564643c5c2f7374726f6e673e3c5c2f68323e5c725c6e3c703e5c75303564315c75303565385c75303564355c75303564625c75303564395c7530356464205c75303564345c75303564315c75303564305c75303564395c7530356464205c75303564635c75303564305c75303565615c7530356538205c75303564345c75303564375c75303564335c7530356539205c75303564635c75303564625c75303564635c7530356439205c75303565395c75303564395c75303564355c75303564355c7530356537205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c75303564642c205c75303564625c75303564635c75303564392053454f2c205c75303564625c75303564635c7530356439205c75303565345c75303564395c75303565615c75303564355c7530356437205c75303564305c75303565615c75303565385c75303564395c7530356464205c75303564355c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303564635c75303564655c75303565325c75303565365c75303564315c75303564395c7530356464205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c7530356464205c7532303133204469676974616c506c616e65742e636f2e696c213c5c2f703e5c725c6e3c703e5c75303564315c75303564305c75303565615c7530356538205c75303565395c75303564635c75303565305c7530356435205c75303565615c75303564655c75303565365c75303564305c7530356435205c75303564305c7530356561205c75303564625c7530356463205c75303564655c7530356434205c75303565395c75303564305c75303565615c7530356464205c75303565365c75303565385c75303564395c75303564625c75303564395c7530356464205c75303564625c75303564335c7530356439205c75303564635c75303564345c75303565345c75303564355c7530356461205c75303564305c7530356561205c75303564345c75303565325c75303564315c75303564355c75303564335c7530356434205c75303565395c75303564635c75303564625c7530356464205c75303564315c75303565325c75303564355c75303564635c7530356464205c75303564345c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c7530356439205c75303564635c75303565375c75303564635c7530356434205c75303564355c75303564395c75303565325c75303564395c75303564635c7530356434205c75303564395c75303564355c75303565615c75303565382e205c75303564305c75303565315c75303565345c75303565305c7530356435205c75303564305c7530356561205c75303564625c7530356463205c75303564345c75303564625c75303564635c75303564395c7530356464205c75303564355c75303564345c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303564345c75303564385c75303564355c75303564315c75303564355c7530356561205c75303564315c75303564395c75303564355c75303565615c7530356538205c75303564315c75303564655c75303565375c75303564355c7530356464205c75303564305c75303564375c75303564332c205c75303564625c7530356461205c75303565395c75303564635c7530356430205c75303565615c75303565365c75303564385c75303565385c75303564625c7530356435205c75303564635c75303564315c75303564365c75303564315c7530356436205c75303564365c75303564655c7530356466205c75303564315c75303564375c75303564395c75303565345c75303564355c7530356539205c75303564305c75303564375c75303565385c75303564395c75303564345c7530356464205c75303564315c75303564305c75303565615c75303565385c75303564395c7530356464205c75303565395c75303564355c75303565305c75303564395c75303564642e3c5c2f703e5c725c6e3c703e5c75303564315c75303564655c75303564335c75303564355c7530356538205c75303564345c75303564315c75303564635c75303564355c7530356432205c75303565395c75303564635c75303565305c7530356435205c75303565615c75303564655c75303565365c75303564305c7530356435205c75303564385c75303564395c75303565345c75303564395c7530356464205c75303564355c75303564385c75303565385c75303564395c75303565375c75303564395c7530356464205c75303564625c75303564395c75303565365c7530356433205c75303564635c75303564345c75303565395c75303565615c75303564655c7530356539205c75303564315c75303564625c75303564635c75303564395c7530356464205c75303564345c75303565395c75303564355c75303565305c75303564395c75303564642c205c75303564355c75303564625c7530356466205c75303564655c75303564305c75303564655c75303565385c75303564395c7530356464205c75303565325c7530356463205c75303564655c75303564325c75303564655c75303564355c7530356561205c75303565325c75303564335c75303564625c75303565305c75303564395c75303564355c7530356561205c75303564315c75303565325c75303564355c75303564635c7530356464205c75303564345c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564392e205c75303564345c75303564395c75303565395c75303564305c7530356538205c75303564655c75303565325c75303564355c75303564335c75303564625c7530356466205c75303564315c75303564375c75303564335c75303565395c75303564355c7530356561205c75303564355c75303564345c75303564345c75303565615c75303565345c75303565615c75303564375c75303564355c75303564395c75303564355c7530356561205c75303564345c75303564305c75303564375c75303565385c75303564355c75303565305c75303564355c7530356561205c75303564315c75303565615c75303564375c75303564355c75303564642c205c75303564355c75303564635c75303564655c7530356433205c75303564625c75303564395c75303565365c7530356433205c75303564635c75303564345c75303565395c75303565615c75303564655c7530356539205c75303564315c75303564345c7530356466205c75303564635c75303564385c75303564355c75303564315c75303565615c75303564612e3c5c2f703e5c725c6e3c703e5c75303564305c75303565305c7530356435205c75303564655c75303565375c75303564355c75303564355c75303564395c7530356464205c75303565395c75303565615c75303564395c75303564345c75303565305c7530356435205c75303564655c75303564345c75303564305c75303565615c7530356538205c75303565395c75303564635c75303565305c7530356435205c75303564355c75303565615c75303564655c75303565365c75303564305c7530356435205c75303564315c7530356435205c75303565395c75303564395c75303564655c75303564355c75303565395c75303564392e205c75303564305c7530356464205c75303564395c7530356539205c75303564635c7530356461205c75303565395c75303564305c75303564635c75303564355c7530356561205c75303564305c7530356435205c75303564345c75303565365c75303565325c75303564355c75303565612c205c75303564305c75303565305c7530356430205c75303564305c7530356463205c75303565615c75303564345c75303565315c7530356531205c75303564635c75303565345c75303565305c75303564355c7530356561205c75303564305c75303564635c75303564395c75303565305c75303564352e3c5c2f703e5c725c6e3c68323e3c7374726f6e673e5c75303564655c75303564325c75303564355c75303564355c7530356466205c75303565325c75303565365c75303564355c7530356464205c75303565395c7530356463205c75303564625c75303564635c75303564395c7530356464205c75303564355c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303565395c75303564395c75303565325c75303564365c75303565385c7530356435205c75303564635c75303564625c7530356464205c75303564635c75303564345c75303564325c75303564395c7530356532205c75303564635c75303565615c75303564355c75303565365c75303564305c75303564355c7530356561205c75303565305c75303564355c75303565315c75303565345c75303564355c7530356561205c75303564315c75303564305c75303564395c75303565305c75303564385c75303565385c75303565305c75303564383c5c2f7374726f6e673e3c5c2f68323e5c725c6e3c703e4469676974616c706c616e65742e636f2e696c205c75303564345c75303564355c7530356430205c75303564305c75303565615c7530356538205c75303564375c75303564335c7530356539205c75303564345c75303564655c75303565365c75303564395c7530356532205c75303564625c75303564635c7530356439205c75303565395c75303564395c75303564355c75303564355c7530356537205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c75303564642c205c75303564625c75303564635c75303564392053454f2c205c75303564625c75303564635c7530356439205c75303565345c75303564395c75303565615c75303564355c7530356437205c75303564305c75303565615c75303565385c75303564395c7530356464205c75303564355c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303564635c75303564655c75303565325c75303565365c75303564315c75303564395c7530356464205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c75303564642e205c75303564305c75303565615c7530356538205c75303564365c7530356434205c75303564655c75303565315c75303565345c7530356537205c75303564635c75303564655c75303565395c75303565615c75303564655c75303565395c75303564395c7530356464205c75303564655c75303564325c75303564355c75303564355c7530356466205c75303565325c75303565365c75303564355c7530356464205c75303565395c7530356463205c75303564625c75303564635c75303564395c7530356464205c75303564355c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303565395c75303564395c75303565325c75303564365c75303565385c7530356435205c75303564635c75303564345c7530356464205c75303564635c75303564345c75303565395c75303564395c7530356432205c75303564395c75303564355c75303565615c7530356538205c75303565615c75303564355c75303565365c75303564305c75303564355c7530356561205c75303564315c75303564305c75303564395c75303565305c75303564385c75303565385c75303565305c75303564382e3c5c2f703e5c725c6e3c68323e3c7374726f6e673e5c75303565385c7530356537205c75303564312d4469676974616c506c616e65742e636f2e696c205c75303565615c75303564355c75303564625c75303564635c7530356435205c75303564635c75303564395c75303564345c75303565305c75303564355c7530356561205c75303564655c75303564345c75303565305c75303564375c75303564355c7530356561205c75303564315c75303564635c75303565325c75303564335c75303564395c75303564355c7530356561205c75303565325c7530356463205c75303564625c7530356463205c75303564345c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303564355c75303564345c75303564625c75303564635c75303564395c7530356464205c75303564635c75303565395c75303564395c75303564355c75303564355c7530356537205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564393c5c2f7374726f6e673e3c5c2f68323e5c725c6e3c703e5c75303564655c75303564375c75303565345c75303565395c75303564395c7530356464205c75303564345c75303565305c75303564375c75303564355c7530356561205c75303564315c75303564635c75303565325c75303564335c75303564395c75303564355c7530356561205c75303565325c7530356463205c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303564355c75303564625c75303564635c75303564395c7530356464205c75303564635c75303565395c75303564395c75303564355c75303564355c7530356537205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564393f205c75303564305c7530356463205c75303565615c75303564375c75303565345c7530356539205c75303565385c75303564375c75303564355c7530356537205c75303564395c75303564355c75303565615c7530356538205c75303564652d4469676974616c506c616e65742e636f2e696c2e205c75303564345c75303564305c75303565615c7530356538205c75303564345c75303564375c75303564335c7530356539205c75303565395c75303564635c75303565305c7530356435205c75303564655c75303565365c75303564395c7530356532205c75303564345c75303565305c75303564375c75303564355c7530356561205c75303565325c7530356463205c75303564655c75303564325c75303564355c75303564355c7530356466205c75303565385c75303564375c7530356431205c75303565395c7530356463205c75303564655c75303564355c75303565365c75303565385c75303564395c75303564642c205c75303564655c75303564625c75303564635c75303564392053454f205c75303564355c75303565325c7530356433205c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303564635c75303565345c75303564395c75303565615c75303564355c7530356437205c75303564305c75303565615c75303565385c75303564395c75303564642e205c75303564315c75303565305c75303564355c75303565315c75303565332c205c75303564305c75303565305c7530356435205c75303564655c75303565365c75303564395c75303565325c75303564395c7530356464205c75303564655c75303564325c75303564355c75303564355c7530356466205c75303565395c75303564395c75303565385c75303564355c75303565615c75303564395c7530356464205c75303564305c75303564375c75303565385c75303564395c7530356464205c75303565395c75303564315c75303564385c75303564355c7530356437205c75303564395c75303564655c75303565395c75303564625c7530356435205c75303564655c75303565325c75303565365c75303564315c75303564395c7530356464205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c75303564642e205c75303564315c75303564395c7530356466205c75303564305c7530356464205c75303564305c75303565615c7530356434205c75303564655c75303564375c75303565345c7530356539205c75303564375c75303565305c75303564355c7530356561205c75303564305c75303564375c7530356561205c75303564635c75303564625c7530356463205c75303564345c75303565365c75303565385c75303564625c75303564395c7530356464205c75303564345c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c7530356464205c75303565395c75303564635c7530356461205c75303564305c7530356435205c75303565315c75303565615c7530356464205c75303565385c75303564355c75303565365c7530356434205c75303564635c75303565305c75303565365c7530356463205c75303564305c7530356561205c75303564345c75303564655c75303564315c75303565365c75303565325c75303564395c7530356464205c75303564345c75303565305c75303564345c75303564335c75303565385c75303564395c7530356464205c75303565395c75303564635c75303565305c75303564352c205c75303564305c75303565305c75303564375c75303565305c7530356435205c75303564655c75303564625c75303564355c75303565315c75303564395c7530356464205c75303564305c75303564355c75303565615c75303564612e205c75303564305c7530356436205c75303564635c75303564655c7530356434205c75303564305c75303565615c7530356434205c75303564655c75303564375c75303564625c75303564343f205c75303564315c75303564335c75303564355c7530356537205c75303564305c75303564355c75303565615c75303565305c7530356435205c75303564345c75303564395c75303564355c7530356464213c5c2f703e5c725c6e3c68323e3c7374726f6e673e5c75303564345c75303564305c75303565615c7530356538205c75303564655c75303565615c75303565325c75303564335c75303564625c7530356466205c75303565325c7530356463205c75303564315c75303565315c75303564395c7530356531205c75303564395c75303564355c75303564655c75303564393c5c2f7374726f6e673e3c5c2f68323e5c725c6e3c703e5c75303565395c75303564635c75303564355c7530356464213c5c2f703e5c725c6e3c703e5c75303564305c75303565305c7530356435205c75303565305c75303565385c75303564325c75303565395c75303564395c7530356464205c75303564635c75303564345c75303565365c75303564395c7530356432205c75303564305c7530356561205c75303564345c75303564305c75303565615c7530356538205c75303564345c75303564375c75303564335c7530356539205c75303565395c75303564635c75303565305c75303564352c204469676974616c506c616e65742e636f2e696c2c205c75303565395c75303565325c75303564655c75303564355c7530356531205c75303564315c75303564385c75303564355c75303565305c75303564355c7530356561205c75303565395c7530356463205c75303564655c75303565395c75303564305c75303564315c75303564395c7530356464205c75303565305c75303564345c75303564335c75303565385c75303564395c7530356464205c75303565325c75303564315c75303564355c7530356538205c75303564655c75303565395c75303564355c75303564355c75303565375c75303564395c7530356464205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c75303564642c205c75303564655c75303565345c75303565615c75303564375c7530356439205c75303564305c75303565615c75303565385c75303564395c7530356464205c75303564355c75303564655c75303565325c75303565365c75303564315c7530356439205c75303565615c75303564355c75303564625c75303565305c75303564342e3c5c2f703e5c725c6e3c703e5c75303564345c75303564305c75303565615c7530356538205c75303564655c75303565615c75303565325c75303564335c75303564625c7530356466205c75303565325c7530356463205c75303564315c75303565315c75303564395c7530356531205c75303564395c75303564355c75303564655c75303564392c205c75303564305c7530356436205c75303564345c75303565375c75303565345c7530356433205c75303564635c75303564315c75303564335c75303564355c7530356537205c75303565395c75303564355c7530356431205c75303564635c75303565325c75303565615c75303564395c7530356464205c75303565375c75303565385c75303564355c75303564315c75303564355c7530356561205c75303564635c75303565375c75303564315c75303564635c7530356561205c75303564345c75303564625c75303564635c75303564395c7530356464205c75303564355c75303564345c75303564385c75303564395c75303565345c75303564395c7530356464205c75303564345c75303565325c75303564335c75303564625c75303565305c75303564395c75303564395c7530356464205c75303564355c75303564345c75303564385c75303564355c75303564315c75303564395c7530356464205c75303564315c75303564395c75303564355c75303565615c7530356538213c5c2f703e5c725c6e3c68323e3c7374726f6e673e5c75303564655c75303565615c75303564375c753035646420564950205c75303565325c7530356464205c75303564625c75303564635c75303564395c7530356464205c75303564315c75303564635c75303565325c75303564335c75303564395c75303564395c7530356464205c75303565385c7530356537205c75303564635c75303564375c75303564315c75303565385c7530356439205c75303564345c75303564655c75303564355c75303565325c75303564335c75303564355c7530356466205c75303565395c75303564635c75303565305c75303564353c5c2f7374726f6e673e3c5c2f68323e5c725c6e3c703e5c75303565395c75303564635c75303564355c7530356464213c5c2f703e5c725c6e3c703e5c75303564305c75303565305c7530356435205c75303565305c75303565385c75303564325c75303565395c75303564395c7530356464205c75303564635c75303564345c75303565365c75303564395c7530356432205c75303564305c7530356561205c75303564345c75303564305c75303565615c7530356538205c75303564345c75303564375c75303564335c7530356539205c75303565395c75303564635c75303565305c75303564352c204469676974616c506c616e65742e636f2e696c21205c75303564365c75303564355c75303564345c7530356439205c75303564345c75303565615c75303564375c75303565305c7530356434205c75303564345c75303564305c75303564375c7530356561205c75303564635c75303564625c75303564635c7530356439205c75303565395c75303564395c75303564355c75303564355c7530356537205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c75303564642c205c75303564625c75303564635c75303564392053454f2c205c75303564625c75303564635c7530356439205c75303565345c75303564395c75303565615c75303564355c7530356437205c75303564305c75303565615c75303565385c75303564395c7530356464205c75303564355c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303564635c75303564655c75303565325c75303565365c75303564315c75303564395c7530356464205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c75303564642e3c5c2f703e5c725c6e3c703e5c75303564395c7530356539205c75303564635c75303565305c7530356435205c75303564305c75303564365c75303564355c753035653820564950205c75303564315c75303564305c75303565615c7530356538205c75303565395c75303564635c75303565305c7530356435205c75303565325c75303564655c75303564355c7530356531205c75303564315c75303564625c75303564635c75303564395c7530356464205c75303564315c75303564635c75303565325c75303564335c75303564395c75303564395c7530356464205c75303565395c75303564365c75303564655c75303564395c75303565305c75303564395c7530356464205c75303565385c7530356537205c75303564635c75303564375c75303564315c75303565385c7530356439205c75303564345c75303564655c75303564355c75303565325c75303564335c75303564355c7530356466205c75303565395c75303564635c75303565305c75303564352e205c75303564305c7530356436205c75303564305c7530356464205c75303564305c75303565615c7530356434205c75303564655c75303564375c75303565345c7530356539205c75303564395c75303565615c75303565385c75303564355c7530356466205c75303565325c7530356463205c75303564345c75303564655c75303565615c75303564375c75303565385c75303564395c7530356464205c75303565395c75303564635c75303564612c205c75303564345c75303565375c75303565345c7530356433205c75303564635c75303564345c75303564395c75303565385c75303565395c7530356464205c75303564635c75303564375c75303564315c75303565385c75303564355c7530356561205c75303565325c75303564355c7530356433205c75303564345c75303564395c75303564355c7530356464213c5c2f703e5c725c6e3c68323e3c7374726f6e673e5c75303565385c75303564355c75303565365c7530356434205c75303564635c75303565345c75303565385c75303565315c7530356464205c75303564305c7530356561205c75303564345c75303564625c75303564635c75303564395c7530356464205c75303564305c7530356435205c75303564345c75303565615c75303564355c75303564625c75303565305c7530356434205c75303565395c75303564635c7530356461205c75303564315c75303564305c75303565615c7530356538205c75303564345c75303564305c75303564395c75303565305c75303564385c75303565385c75303565305c7530356438205c75303565395c75303564635c75303565305c75303564353f205c75303565365c75303564355c7530356538205c75303565375c75303565395c75303565383c5c2f7374726f6e673e3c5c2f68323e5c725c6e3c703e4469676974616c506c616e65742e636f2e696c205c75303564345c75303564355c7530356430205c75303564345c75303564305c75303565615c7530356538205c75303564345c75303564375c75303564335c7530356539205c75303564635c75303564625c75303564635c7530356439205c75303565395c75303564395c75303564355c75303564355c7530356537205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c75303564642c205c75303564625c75303564635c75303564392053454f2c205c75303564625c75303564635c7530356439205c75303565345c75303564395c75303565615c75303564355c7530356437205c75303564305c75303565615c75303565385c75303564395c7530356464205c75303564355c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303564635c75303564655c75303565325c75303565365c75303564315c75303564395c7530356464205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c75303564395c75303564395c75303564642e205c75303564305c75303565305c7530356435205c75303564655c75303565365c75303564395c75303565325c75303564395c7530356464205c75303564655c75303564325c75303564355c75303564355c7530356466205c75303565385c75303564375c7530356431205c75303565395c7530356463205c75303564625c75303564635c75303564395c7530356464205c75303564355c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303565395c75303564395c75303565325c75303564365c75303565385c7530356435205c75303564635c7530356461205c75303565325c7530356464205c75303565365c75303565385c75303564625c7530356439205c75303564345c75303565395c75303564395c75303564355c75303564355c7530356537205c75303564345c75303564335c75303564395c75303564325c75303564395c75303564385c75303564635c7530356439205c75303565395c75303564635c75303564612c205c75303565375c75303564395c75303564335c75303564355c7530356464205c75303564305c75303565615c75303565385c75303564395c7530356464205c75303564355c75303565345c75303564395c75303565615c75303564355c7530356437205c75303564305c75303565615c75303565385c75303564395c75303564642e205c75303564305c7530356464205c75303564395c7530356539205c75303564635c7530356461205c75303564625c75303564635c7530356439205c75303564305c7530356435205c75303565615c75303564355c75303564625c75303565305c7530356434205c75303565395c75303564635c75303564335c75303565325c75303565615c7530356461205c75303564395c75303564345c75303564395c7530356435205c75303564655c75303564355c75303565325c75303564395c75303564635c75303564395c7530356464205c75303565325c75303564315c75303564355c7530356538205c75303564345c75303564655c75303565395c75303565615c75303564655c75303565395c75303564395c7530356464205c75303565395c75303564635c75303565305c75303564352c205c75303564305c75303565305c7530356430205c75303565365c75303564355c7530356538205c75303564305c75303564395c75303565615c75303565305c7530356435205c75303565375c75303565395c7530356538205c75303564355c75303565305c75303565395c75303564655c7530356437205c75303564635c75303565395c75303565375c75303564355c7530356463205c75303564305c75303564355c75303565615c7530356464205c75303564635c75303564345c75303564625c75303564635c75303564635c7530356434205c75303564315c75303564305c75303565615c7530356538205c75303564345c75303564305c75303564395c75303565305c75303564385c75303565385c75303565305c7530356438205c75303565395c75303564635c75303565305c75303564352e3c5c2f703e222c22706167655f74797065223a226e6f726d616c222c2261646472657373223a6e756c6c2c226b6579776f726473223a225c75303564625c75303564635c75303564395c7530356464205c75303564635c75303565395c75303564395c75303564355c75303564355c7530356537205c75303564335c75303564395c75303564325c75303564395c75303564385c75303564632c205c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303564635c75303565395c75303564395c75303564355c75303564355c7530356537205c75303564315c75303564335c75303564395c75303564325c75303564395c75303564385c75303564632c205c75303564625c75303564635c75303564395c7530356464205c75303564635c75303564655c75303565375c75303564335c75303564655c7530356439205c75303564305c75303565615c75303565385c75303564395c75303564642c205c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303564635c75303564655c75303565375c75303564335c75303564655c7530356439205c75303564305c75303565615c75303565385c75303564395c75303564642c205c75303565615c75303564355c75303564625c75303565305c75303564355c7530356561205c75303564635c75303565325c75303564395c75303565365c75303564355c7530356431205c75303564325c75303565385c75303565345c75303564392c205c75303564375c75303564315c75303565385c75303564355c7530356561205c75303564305c75303564375c75303565315c75303564355c7530356466205c75303564355c75303564335c75303564355c75303564655c75303564395c75303564395c75303565305c7530356435222c226465736372697074696f6e223a22222c2263726561746564223a22323031372d30352d30322030353a30323a3530222c22616374697665223a317d, '2022-09-01 03:54:52'),
(6, NULL, 2, 'membership', 0x7b226964223a322c227469746c65223a22476f6c64222c226465736372697074696f6e223a22546869732069732039302064617973206261736963206d656d62657273686970222c227072696365223a22362e3939222c2264617973223a39302c22706572696f64223a2244222c22726563757272696e67223a302c227468756d62223a22676f6c642e737667222c2270726976617465223a302c22616374697665223a317d, '2022-09-01 14:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(64) NOT NULL,
  `lname` varchar(64) NOT NULL,
  `membership_id` smallint(3) UNSIGNED NOT NULL DEFAULT 0,
  `mem_expire` datetime DEFAULT '1970-01-01 00:00:00',
  `email` varchar(60) NOT NULL,
  `salt` varchar(25) NOT NULL,
  `hash` varchar(70) NOT NULL,
  `token` varchar(40) NOT NULL DEFAULT '0',
  `userlevel` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `type` varchar(10) NOT NULL DEFAULT 'member',
  `lastlogin` datetime DEFAULT NULL,
  `lastip` varbinary(16) DEFAULT '000.000.000.000',
  `avatar` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `country` varchar(4) DEFAULT NULL,
  `notify` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `access` text DEFAULT NULL,
  `notes` tinytext DEFAULT NULL,
  `info` tinytext DEFAULT NULL,
  `newsletter` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `stripe_cus` varchar(80) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` enum('y','n','t','b') NOT NULL DEFAULT 'n'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `lname`, `membership_id`, `mem_expire`, `email`, `salt`, `hash`, `token`, `userlevel`, `type`, `lastlogin`, `lastip`, `avatar`, `address`, `city`, `state`, `zip`, `country`, `notify`, `access`, `notes`, `info`, `newsletter`, `stripe_cus`, `created`, `active`) VALUES
(1, 'admin', 'Web', 'Master', 0, '1970-01-01 00:00:00', 'site@mail.com', 'S7bnl4b3CgzYvv716Efc8', '$2a$10$S7bnl4b3CgzYvv716Efc8.T/si.HgajDVNR5.amkaRE0O5egHROL.', '0', 9, 'owner', '2022-09-04 16:13:14', 0x3132372e302e302e31, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, '2022-08-26 06:30:26', 'y'),
(2, 'BsbJ27FH', 'remina', 'adar', 0, '1970-01-01 00:00:00', 'reminalove@gmail.com', 'o3ONcDFOil2T780hzKccR', '$2a$10$o3ONcDFOil2T780hzKccR.PKaQQjNDDK4N73DY6VBomDWrM0XDxla', '4701009', 1, 'member', '2022-09-01 23:42:22', 0x3130392e3235332e3137352e323131, NULL, 'sadmkasdm mkm', 'KIRYAT MOTZKIN', 'israel', '2906654', 'IL', 0, NULL, NULL, NULL, 1, NULL, '2022-09-01 20:42:22', 'y'),
(3, 'ekidXtnQ', 'SADASD', 'SADASD', 0, '1970-01-01 00:00:00', 'wesenders1@gmail.com', '2AdrqOZGcgoPFJ2E74eTP', '$2a$10$2AdrqOZGcgoPFJ2E74eTP.KPtgVYaE63yVvyIC/o7QgVB5HawGln.', '9395527', 1, 'member', '2022-09-01 23:43:47', 0x38342e3232382e3130322e313130, NULL, 'MSAKMAKS', 'MKASDM', 'MKSMAD', '2123', 'CA', 0, NULL, NULL, NULL, 1, NULL, '2022-09-01 20:43:47', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `product_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_catid` (`category_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_num` (`sorting`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_membership` (`membership_id`),
  ADD KEY `idx_product` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_parent` (`parent_id`);

--
-- Indexes for table `categories_related`
--
ALTER TABLE `categories_related`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product` (`product_id`),
  ADD KEY `idx_category` (`category_id`);

--
-- Indexes for table `cdkeys`
--
ALTER TABLE `cdkeys`
  ADD PRIMARY KEY (`cdkey`),
  ADD KEY `idx_product` (`product_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `abbrv` (`abbr`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cronjobs`
--
ALTER TABLE `cronjobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_membership_id` (`membership_id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_fields_data`
--
ALTER TABLE `custom_fields_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_field` (`field_id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_parent_id` (`parent_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_history`
--
ALTER TABLE `membership_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_transaction` (`transaction_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_membership` (`membership_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`active`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_prouct` (`product_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_membership` (`membership_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category` (`category_id`),
  ADD KEY `idx_file` (`files`);
ALTER TABLE `products` ADD FULLTEXT KEY `idx_body` (`body`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `role_privileges`
--
ALTER TABLE `role_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx` (`rid`,`pid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trash`
--
ALTER TABLE `trash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_product` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories_related`
--
ALTER TABLE `categories_related`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cronjobs`
--
ALTER TABLE `cronjobs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `custom_fields_data`
--
ALTER TABLE `custom_fields_data`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `membership_history`
--
ALTER TABLE `membership_history`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_privileges`
--
ALTER TABLE `role_privileges`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trash`
--
ALTER TABLE `trash`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
