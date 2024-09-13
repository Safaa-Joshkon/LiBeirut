-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2024 at 12:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libeirut`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventId` int(11) NOT NULL,
  `Poster` varchar(250) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(600) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventId`, `Poster`, `Title`, `Description`, `Location`, `Date`, `Time`) VALUES
(1, 'we search.jpg', 'We Search', 'Discover “We Search” at Abroyan Factory in Bourj Hammoud.\r\nMay 23-26, 2023 from 10:00 AM till 9:00 PM\r\nBased on our three pillars, We Design Beirut will be hosting 3 main exhibitions at our We Sites. Under We Sustain, we will hold a collective exhibition titled “We Search” showcasing sustainability projects by student designers from ALBA, AUB, LAU, USEK, and USJ under the advisory of three internationally renowned design experts, Federica Sala, Anne-France Berthelon, and Francois le Blanc Di Cicilia.\r\n', 'Abroyan Factory, Bourj Hammoud', '2024-05-23', '10:00:00'),
(2, 'past echoes.jpg', 'Past Echoes', 'Based on our three pillars, We Design Beirut will be hosting 3 main exhibitions at our We Sites. Under “We Preserve” we will host “Past Echoes: A Journey Through Middle Eastern Product Design”, a product design exhibition curated by by Babylon -The Agency founded by Joy Mardini and William Wehbe, the collective exhibition of over 33 product designers from the region gracefully transitions its celebration of Middle Eastern design to the historic Villa Audi, embracing a new chapter in its narrative.', 'Villa Audi, Sursock Street.', '2024-05-23', '10:00:00'),
(3, 'Metiers d’Art.jpg', 'Metiers d’Art', 'Discover “Metiers d’Art” at PSLab in Mar Mikhael.\r\nMay 23-26, 2023 from 10:00 AM till 9:00 PM\r\n\r\nBased on our three pillars of empowerment, preservation and sustainability, the Metiers d’Art exhibition at our Empowerment site will serve to provide talented craftsmen and artisans in the fields of wood, copper, and rattan with an opportunity to showcase their crafts live to an international audience and to collaborate with fellow designers, architects and platforms.', 'PSLab, Mar Mikhael', '2024-05-23', '10:00:00'),
(4, 'Storytelling Hour.webp', 'Storytelling Hour', 'Join us for our weekly storytelling hour at Assabil, the Beirut municipal public library located in Monnot. Bring your kids and immerse yourselves in enchanting tales that will captivate their imaginations. It\'s a wonderful opportunity to spend quality time together and foster a love for reading from a young age. Don\'t miss out on this engaging and educational experience!', 'Beirut Municipal Public Libraries, Monnot', '2024-07-05', '04:30:00'),
(5, 'Storytelling Hour-Geitawi.webp', 'Storytelling Hour in Geitawi', 'Experience the magic of storytelling with a twist at our Storytelling in Geitawi event! Join us at the Geitawi Municipal Public Library for an engaging session filled with enchanting tales, exciting activities, and delightful handcrafts. Let your imagination soar as you and your children participate in interactive storytelling, creative activities, and fun handcrafts. This is an event not to be missed, where learning meets fun in a vibrant and welcoming environment. Join us for a day of creativity, imagination, and endless fun!', 'Beirut Municipal Public Libraries, Geitawi', '2024-06-29', '11:00:00'),
(6, 'meeting.jpg', 'العدوان على غزة', 'ندعوكم للقاء حول \"العدوان على غزة والقانون الإنساني الدولي\" مع الوزير السابق د.طارق متري، وذلك يوم الخميس 23 تشرين الثاني على الساعة السادسة والنصف في المكتبة العامة لبلدية بيروت، مونو.\r\nالدكتور طارق متري، رئيس جامعة القديس جاورجيوس في بيروت، والممثّل الخاص السابق للأمين العام للأمم المتحدة في ليبيا. تولىّ أربع مناصب وزارية في الحكومات اللّبنانيّة المتعاقبة: الإعلام والبيئة والتنمية الإداريّة والثقافة، وكان وزيرًا للخارجيّة بالنيابة. وهو أيضًا عضو في المجلس الاستراتيجي لجامعة القدّيس يوسف في لبنان ورئيس مجلس أمناء معهد الدراسات الفلسطينيّة وعضو مجلس إدارة المركز العربي للأبحاث ودراسة السياسات.', 'المكتبة العامة لبلدية بيروت، مونو', '2023-11-23', '18:30:00'),
(7, 'lebreaders.jpeg', 'أغنيات للعتمة', 'يسرنا دعوتكم لحضور نشاطنا القادم لمناقشة اخر اصدارات الروائيةإيمان حميدان \"اغنيات للعتمة\" بحضورها، يوم الخميس، 22 فبراير، انضموا إلينا وتعرفوا على العالم رحلتها الكتابية وشاركوا في مناقشات غنية.\r\nتدير النقاش الصحافية جودي الأسمر.\r\nنتطلع إلى لقائكم !', 'Barzakh, Hamra', '2024-02-22', '18:30:00'),
(8, 'BassmaEvent.jpg', 'Welcome Summer', 'Are you ready for an outstanding evening? \r\nA Welcome Summer fundraiser at Bar du Port, Jal El Dib\r\nDate: Sunday, the 2nd of June, 8:30pm.\r\nBeautiful program awaits you (Band, DJ & Dancing shows); Delicious dinner and Open Premium Bar.\r\nBook your tables now! \r\nContact us directly or through Virgin Ticketing. \r\n●Regular tickets for tables & Bar are priced at $110.\r\n●Special tickets for Lounges & Deck zone at $140.\r\n●For groups of 10 & more, 1 ticket will be offered! \r\nYour presence matters\r\nand your participation will make a difference in so many families\' lives! ', 'Jal El Dib', '2024-06-02', '20:30:00'),
(13, 'creative writing.jpeg', 'Creative Writing', 'اللقاء الشهري في محترف الكتابة باللّغة العربية يتجدّد يوم السبت 21 كانون الثاني في المكتبة العامة لبلدية بيروت، الباشورة بإدارة علي صبّاغ حول الصور الفوتوغرافية.\r\nالتسجيل ضروري على 01667701 أو عبر واتساب 81905628', 'Bachoura Public Library', '2023-01-21', '11:00:00'),
(18, 'BookReviews.jpg', 'Call For Reviews', 'Here comes our Call for Reviews!!\r\nJoin us in our November Multiple Book Review event (MBR) Nov 29th!\r\n\r\nWhether you\'re a reader or just curious in other readings you\'re more than welcome to attend our discussions.\r\nWe LOVE to have new reviewers every time!', 'Barzakh, Hamra', '2024-11-29', '16:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `eventvolunteer`
--

CREATE TABLE `eventvolunteer` (
  `EVolId` int(11) NOT NULL,
  `VolunteerId` int(11) NOT NULL,
  `EventId` int(11) NOT NULL,
  `Response` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventvolunteer`
--

INSERT INTO `eventvolunteer` (`EVolId`, `VolunteerId`, `EventId`, `Response`) VALUES
(11, 23, 18, 'accept'),
(13, 19, 1, 'accept'),
(14, 21, 4, 'Pending'),
(19, 23, 2, 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `mediaimage`
--

CREATE TABLE `mediaimage` (
  `MediaId` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `SId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mediaimage`
--

INSERT INTO `mediaimage` (`MediaId`, `image`, `SId`) VALUES
(1, 'Raouché.png', 1),
(2, 'Hamra.png', 2),
(3, 'St. Nicholas Stairs- Gemmayzeh.png', 3),
(4, 'Mar Mikhael (3).png', 4),
(5, 'Saifi (1).png', 5),
(6, 'Clemenceau (1).png', 6),
(7, 'Foch-Allenby District.jpg', 8),
(8, 'Saifi Village.jpg', 9),
(9, 'Nejmeh Square.jpg', 10),
(10, 'Martyrs\' Square.jpg', 11),
(11, 'Sanayeh.jpg', 12),
(12, 'Gebran Khalil Gebran Park.jpg', 13),
(13, 'Horsh Beirut.jpg', 14),
(14, 'st.Nicolas Garden.jpg', 15),
(15, 'Leila Osseiran.jpg', 16),
(16, 'Sioufi Garden.jpg', 17),
(17, 'Mufti Hassan Khaled Garden.png', 18),
(18, 'Abdul Rahman Al Hout Garden.jpg', 19),
(19, 'Jesuits Garden.jpg', 20),
(20, 'assabil working hours.jpg', 21),
(21, 'National Museum of Beirut.jpg', 22),
(22, 'Nicolas Sursock Museum.jpg', 23),
(23, 'Beit Beirut.jpg', 24),
(24, 'Mim Museum.jpg', 25),
(25, 'Banque Du Liban Museum.png', 26),
(26, 'Audi Mosaic Museum.jpg', 27),
(27, 'default.jpg', 28),
(29, 'Municipal Park.jpg', 29);

-- --------------------------------------------------------

--
-- Table structure for table `ngo`
--

CREATE TABLE `ngo` (
  `NGOId` int(11) NOT NULL,
  `Name` varchar(65) NOT NULL,
  `Logo` varchar(250) NOT NULL,
  `About` varchar(550) NOT NULL,
  `Email` varchar(65) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `SocialMediaLinks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ngo`
--

INSERT INTO `ngo` (`NGOId`, `Name`, `Logo`, `About`, `Email`, `Address`, `PhoneNumber`, `SocialMediaLinks`) VALUES
(1, 'Assabil', 'Assabil.png', 'ASSABIL is a non-governmental organization founded in 1997 to promote reading and free access to culture, by creating public libraries as non-sectarian and open spaces for cultural exchange and providing access to information and reading.', 'info@assabil.com', 'Mohammad el-Hout Street. Beirut , Beirut. Lebanon.', '01664647', 'Facebook:https://www.facebook.com/assabilngo\r\nInstagram:https://www.instagram.com/assabilngo\r\nWebsite: https://assabil.com/'),
(21, 'Bassma', 'bassma.png', 'BASSMA, a non-profit association for Social Development, founded in 2002 by a group of dynamic volunteers. They had two things in common: their love for their country and their desire to change the very unstable socioeconomic situation of the most deprived. They decided to fight poverty and work for a better society by creating a humanitarian organization that rallies citizens for the social Lebanese cause. BASSMA was officially born.', 'info@bassma.org', 'Badaro, main street, Bldg. next to Brax gas station, 2nd floor, Beirut, Lebanon.', '03068519', 'Facebook: https://www.facebook.com/bassmalb\r\nInstagram: https://www.instagram.com/bassmalb/?hl=en \r\nWebsite: https://www.bassma.org/'),
(22, 'Lebanon Readers Society', 'Lebanon readers society.jpeg', 'We are a group of passionate readers who seek to share their love of reading in the Lebanese community.', 'lebreaders@gmail.com', 'Not Set', 'Not Set', 'Facebook: https://www.facebook.com/lebreaders/\r\nInstagram: https://www.instagram.com/lebreaders/'),
(23, 'We Design Beirut', 'WeDesignBeirut.jpg', 'Lebanon annual design event We Design Beirut hosts workshops, showrooms, installations and talks that aim to showcase themes of empowerment, preservation and sustainability. The four-day event features well-known and up-and-coming designers, craftsmen, experts and educators from all around the world, creating opportunities to engage with an international design community.', 'hello@wedesignbeirut.com', 'Not Set', 'Not Set', 'Facebook: https://www.facebook.com/profile.php?id=100091063723643&paipv=0&eav=AfajR7UjIxr-VLkiXCYx-8-4FN_BP3i694Qcc7qyIAO1pslVHti-McKS38yWDuvJmn0\r\nInstagram:https://www.instagram.com/wedesignbeirut/ \r\nWebsite: https://www.wedesignbeirut.com/');

-- --------------------------------------------------------

--
-- Table structure for table `ngovolunteer`
--

CREATE TABLE `ngovolunteer` (
  `NGOVolId` int(11) NOT NULL,
  `VolunteerId` int(11) NOT NULL,
  `NGOId` int(11) NOT NULL,
  `Response` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ngovolunteer`
--

INSERT INTO `ngovolunteer` (`NGOVolId`, `VolunteerId`, `NGOId`, `Response`) VALUES
(3, 9, 1, 'accept'),
(18, 19, 21, 'accept'),
(20, 21, 21, 'Pending'),
(25, 19, 1, 'Pending'),
(28, 23, 1, 'accept'),
(29, 19, 22, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `organizeevent`
--

CREATE TABLE `organizeevent` (
  `OrgId` int(11) NOT NULL,
  `NGOId` int(11) NOT NULL,
  `EventId` int(11) NOT NULL,
  `SId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizeevent`
--

INSERT INTO `organizeevent` (`OrgId`, `NGOId`, `EventId`, `SId`) VALUES
(1, 1, 6, 21),
(3, 1, 4, 21),
(4, 1, 5, 21),
(10, 1, 13, 21),
(19, 23, 1, 28),
(20, 23, 2, 23),
(21, 23, 3, 28),
(22, 21, 8, 28),
(23, 22, 7, 28),
(25, 22, 18, 28);

-- --------------------------------------------------------

--
-- Table structure for table `spaces`
--

CREATE TABLE `spaces` (
  `spaceId` int(11) NOT NULL,
  `Name` varchar(65) NOT NULL,
  `Location` varchar(65) NOT NULL,
  `Description` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spaces`
--

INSERT INTO `spaces` (`spaceId`, `Name`, `Location`, `Description`) VALUES
(1, 'Raouché Rock', 'Raouché', 'Nestled along the breathtaking coast of Raouche in Beirut, Lebanon, stands a remarkable natural wonder – the 60-meter-high Pigeon Rocks, also affectionately known as \"The Rock of Raouche.\" These iconic limestone formations have captured the imaginations of locals and visitors alike, with their timeless beauty and unique character.'),
(2, 'Heart Of Hamra', 'Hamra', 'Hamra Street is one of the oldest streets in Lebanon, and one of the most famous and most active streets in the Lebanese capital, Beirut. It is also the beating heart of the capital day and night, and one of the streets that has great symbolic and commercial importance, and it is considered one of the most beautiful tourist places in Beirut and all of Lebanon.'),
(3, 'St. Nicolas Stairs', 'Gemmayze', 'L\'Escalier de L\'Art, also known as the L\'Escalier de Saint-Nicolas is a public stairway in Beirut, Lebanon. It is located in the Rmeil district, providing a pedestrian link between Rue Gouraud and Rue Sursock uphill. Its proximity to the Sursock Museum and the Greek Orthodox Archbishopric of Beirut on Rue Sursock, make the 125 steps and 500 meters span staircase, believed to be the longest in the region, a very popular destination for tourists visiting Beirut.'),
(4, 'TrainStation Mar Mikhael', 'Mar Mikhael', 'The Beirut Railway Station is a former passenger railway station, located in the Mar Mikhaël district of Beirut, Lebanon. Situated along two railway lines, it opened in 1895 and operated until it was closed in 1975 due to the Lebanese Civil War.'),
(5, 'Saifi Village', 'Saifi', 'Saifi Village, in the heart of downtown Beirut, is set to become one of the region’s hottest art destinations with galleries, antique shops, design studios and specialist boutiques dotting its picturesque streets. Saifi Village’s Quartier Des Arts is fast developing into a meeting place for an eager public and artists from around the world.'),
(6, 'Clemenceau', 'Clemenceau', 'Nestled between the glitzy Wadi Abou Jmil neighborhood and the more authentic area of Wardieh, Clemenceau is serenely quiet, historically charged and bursting with hidden treasures.'),
(8, 'Foch-Allenby District', 'Downtown', 'The Foch-Allenby district is the former harbor district of Beirut, accommodating port-related activities.\r\nNamed Foch and Allenby in 1919, the two main north–south avenues were perceived as gateways to the city for visitors arriving by sea.\r\nAlong with Weygand street, they formed the new business district of Beirut.'),
(9, 'Saifi Village', 'Downtown', 'Saifi Village is an upscale residential neighbourhood in Beirut, Lebanon.\r\nIt is located at the southeastern periphery of Centre Ville.\r\nThe village is bordered by Rue Charles Debbas to the south, Rue George Haddad to the east, Rue Gouraud to the north and Rue Ariss & Kanaani to the west.'),
(10, 'Nejmeh Square', 'Downtown', 'Nejmeh Square or Place de l\'Étoile is the central square in the Downtown area of Beirut, Lebanon.\r\nIt is home to the Lebanese Parliament and its complementary buildings, two cathedrals, a museum, and several cafes and restaurants.'),
(11, 'Martyrs\' Square', 'Downtown', 'Martyrs\' Square, historically known as \"Al Burj\" or \"Place des Cannons\", is the historical central public square of Beirut, Lebanon.\r\nLike the Martyr\'s Square in Damascus, it is named after the 6 May 1916 executions ordered by Djemal Pasha during World War I.'),
(12, 'Sanayeh Park', 'Sanayeh district', NULL),
(13, 'Gebran Khalil Gebran Park', 'The Centre Ville area of Beirut', NULL),
(14, 'Horsh Beirut', 'Horsh', NULL),
(15, 'St.Nicolas Garden', 'Avenue Charles Malek in the Tabaris neighborhood of the Achrafieh', NULL),
(16, 'Leila Osseiran', 'Capucins Street', NULL),
(17, 'Sioufi Garden', 'Achrafieh District', NULL),
(18, 'Mufti Hassan Khaled Garden', 'Ayche Bakkar Area', NULL),
(19, 'Abdul Rahman Al Hout Garden', 'Zokak El Blatt', NULL),
(20, 'Jesuits Garden', 'Remeil District', 'The Jesuit Garden, also known as Geitawi Garden and sometimes also as Jesuits\' Garden, is a public park in the Remeil District of Beirut, Lebanon. It is located in the Moscow Street, covering around 44,000 square meters. The garden was given to the city in the 1960s by the Society of Jesus. '),
(21, 'Beirut Municipal Public Libraries', 'Bachoura, Monnot and Geitawi', 'Bachoura Municipal Library. Monday through Friday 9:00 a.m. – 6:00 p.m. Saturday 9:00 a.m. – 5:00 p.m.\r\nGeitawi Municipal Library. Monday through Saturday 9:00 a.m. – 5:00 p.m.\r\nMonnot Municipal Library. Monday through Friday 9:00 a.m. – 6:00 p.m. Saturday 9:00 a.m. – 1:00 p.m.'),
(22, 'National Museum of Beirut', 'Mathaf', 'The National Museum of Beirut is the principal museum of archaeology in Lebanon. The collection begun after World War I, and the museum was officially opened in 1942. The museum has collections totaling about 100,000 objects, most of which are antiquities and medieval finds from excavations undertaken by the Directorate General of Antiquities. About 1300 artifacts are exhibited, ranging in date from prehistoric times to the medieval Mamluk period. During the 1975 Lebanese Civil War, the museum stood on the front line that separated the warring factions. The museum’s Egyptian Revival building and its collection suffered extensive damage in the war, but most of the artifacts were saved by last-minute preemptive measures.'),
(23, 'Nicolas Sursock Museum', 'Greek Orthodox Archbishopric Street', 'Nicolas Sursock was a well-known member of the aristocratic Sursock family and an avid art collector. Following his death in 1952, his mansion became what is now the famous Nicolas Ibrahim Sursock Museum – a contemporary and modern art museum located in Achrafiyeh, Beirut. Much needed at the time, Nicolas’ motive was to endorse, support and promote Lebanese and International artists by exhibiting and showcasing their work in the space provided. The Sursock Museum first opened in 1961 with the Salon d’Automne Exhibition showcasing new art the time. In 2008, however, the museum was further developed and expanded with a five-year-long renovation project intended to establish it as a state-of-the-art cultural institution. Four underground floors were added beneath the garden which increased the museum’s surface area from 1,500 square meters to 8,500 square meters. The renovation project added additional spaces for the Sursock Museum’s permanent collection and temporary exhibitions, a large auditorium, a detailed research library, a restoration workshop to revive old works, as well as, a store and restaurant.'),
(24, 'Beit Beirut', 'Sodeco and Damascus Road', 'Built in 1924 by the Lebanese architect Youssef Afandi Aftimos and then raised by two further floors by the architect Fouad Kozah in 1932, the neo-ottoman style building known as the “Yellow House” or the “Barakat Building” stands on the crossroad of Damascus street and Independence street. The name of the Yellow House comes from the ochre-coloured sandstone used for its construction. Located on the former “green line”, the Yellow House was a forward control post and sniper base during the civil war. In addition to its strategic location, the airy architecture of the Yellow House, with its transparency and varied shooting angles, was used for military purposes to control the surrounding area, known as the “Sodeco Crossroads”.'),
(25, 'Mim Museum - Mineral Museum', 'USJ', 'Mim is a private museum which exhibits more than 1400 minerals representing around 300 different species from over 60 countries. Mr. Salim Edde has built up this collection since 1997. It features pieces originating from a number of renowned collections –both old and more recent– as well as from the major mining discoveries of our era.This collection is now considered one of the world’s paramount private collections for the variety and quality of its minerals.'),
(26, 'Banque Du Liban Museum', 'Banque Du Liban Museum.png', 'The Banque du Liban Museum opened to the public in November 2013 and offers free guided tours to the general public and students’ groups. BDL Museum, which is the first money museum in Lebanon, displays oldest local currencies that have existed in Lebanon’s history, including ottoman banknotes, Lebanese bank notes dating since 1919 in addition to a selection of coins dating back since 5th century BC and covering different historical periods. The museum’s collection includes as well a selection of international banknotes from all over the world. A selection of interactive simulation games and hands- on activities is also available to make the visit of the museum about much more than money… shedding the light on the role of the Central bank and its different functions as well. In addition, visitors to the BDL Museum can view a 10-minute documentary exploring the history and evolution of the currency in Lebanon.'),
(27, 'Audi Mosaic Museum', 'Audi Mosaic Museum.jpg', 'The Audi Mosaic Museum is a museum located in the Byblos area of Beirut, known for its collection of ancient mosaics. It features a variety of mosaic artworks from different periods, showcasing the region\'s rich cultural heritage.'),
(28, 'Private Location', '', NULL),
(29, 'Municipal Park', 'Hussein Al-Ahdab Street, Beirut, Lebanon  ', 'Municipal Park');

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `Id` int(11) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`Id`, `Role`) VALUES
(1, 'Admin'),
(2, 'NGO'),
(3, 'Volunteer'),
(5, 'Public User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(65) NOT NULL,
  `Password` varchar(65) NOT NULL,
  `Salt` int(3) NOT NULL,
  `RoleId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Password`, `Salt`, `RoleId`) VALUES
(5, 'Safaa', '$2y$10$MGaF/SiWgmtbafJ4nh4PfuRE5DXwHKUVR1mQtGRZEYU9XdGQgPE6a', 663114, 1),
(6, 'User', '$2y$10$3KDEytJ2mtYqxLYqSIBvteB7ajomdV73rhlPqOZzscROrSw4xUx/6', 2147483647, 3),
(21, 'Assabil', '$2y$12$SCbqsowgwsLc2V9AyadEzOJZQCYT40Yo2UuSwY2Suv7hbHzw3wZQG', 0, 2),
(23, 'Admin', '$2y$12$U.h/0skJBgKCK9byYmag1OYL/vKD/kFjbechqyI.IOXSUTUQCYRSa', 0, 1),
(78, 'Bassma', '$2y$10$ub5WK1LG/vH..xPpaJvmbOCmtaVrLI5b4Kmxqce04IC91xcRR74.C', 0, 2),
(79, 'Lebanon Readers Society', '$2y$10$kf8JjsEiAChuikhF/1gsRey2Tb9Vbf2Of2Vu3VcnO3tJg9ni7xxIG', 0, 2),
(80, 'We Design Beirut', '$2y$10$MARM/CT9g2w673e.kvXMGOwUonZbgcxc1OWMalrzxe5bc7Y1.mOO6', 0, 2),
(91, 'Bana Madi', '$2y$10$7by.o5.XvHMJZn/iddtObOwam5qj/SdJdvip42sldLkZ/y6xO5jr6', 0, 3),
(93, 'Yasser Joshkon', '$2y$10$oh5Q2a32TMe.veFWsafYQOgxxoYHwx5zQgtvg3pJBSePHHienRXTO', 0, 3),
(96, 'Afaf Itani', '$2y$10$.tG0qTEhyOk574YsEmyQR.8E4m.ASXO3DWsM7ZCxikacMFs/ZJKeq', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `VolunteerId` int(11) NOT NULL,
  `Name` varchar(65) NOT NULL,
  `Profile` varchar(500) NOT NULL,
  `Email` varchar(65) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`VolunteerId`, `Name`, `Profile`, `Email`, `Gender`, `Address`, `PhoneNumber`) VALUES
(9, 'Safaa Joshkon', 'Safaa\'s profile.png', 'safaajoshkon@gmail.com', 'Female', 'Zoqaq Al Balat, Beirut', '76038805'),
(19, 'Bana Madi', '', 'Bana@gmail.com', 'Female', 'Beirut, Lebanon', 'Not Set'),
(21, 'Yasser Joshkon', '', 'yasserjoshkon@gmail.com', 'Male', 'Not Set', 'Not Set'),
(23, 'Afaf Itani', '', 'afafitani@gmail.com', 'Female', 'Hamra, Beirut', 'Not Set');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventId`);

--
-- Indexes for table `eventvolunteer`
--
ALTER TABLE `eventvolunteer`
  ADD PRIMARY KEY (`EVolId`),
  ADD KEY `VolunteerId` (`VolunteerId`),
  ADD KEY `EventId` (`EventId`);

--
-- Indexes for table `mediaimage`
--
ALTER TABLE `mediaimage`
  ADD PRIMARY KEY (`MediaId`),
  ADD KEY `SId` (`SId`);

--
-- Indexes for table `ngo`
--
ALTER TABLE `ngo`
  ADD PRIMARY KEY (`NGOId`);

--
-- Indexes for table `ngovolunteer`
--
ALTER TABLE `ngovolunteer`
  ADD PRIMARY KEY (`NGOVolId`),
  ADD KEY `VolunteerId` (`VolunteerId`,`NGOId`),
  ADD KEY `NGOId` (`NGOId`);

--
-- Indexes for table `organizeevent`
--
ALTER TABLE `organizeevent`
  ADD PRIMARY KEY (`OrgId`),
  ADD KEY `NGOId` (`NGOId`,`EventId`),
  ADD KEY `EventId` (`EventId`),
  ADD KEY `SId` (`SId`);

--
-- Indexes for table `spaces`
--
ALTER TABLE `spaces`
  ADD PRIMARY KEY (`spaceId`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `RoleId` (`RoleId`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`VolunteerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `eventvolunteer`
--
ALTER TABLE `eventvolunteer`
  MODIFY `EVolId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `mediaimage`
--
ALTER TABLE `mediaimage`
  MODIFY `MediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ngo`
--
ALTER TABLE `ngo`
  MODIFY `NGOId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ngovolunteer`
--
ALTER TABLE `ngovolunteer`
  MODIFY `NGOVolId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `organizeevent`
--
ALTER TABLE `organizeevent`
  MODIFY `OrgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `spaces`
--
ALTER TABLE `spaces`
  MODIFY `spaceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `userrole`
--
ALTER TABLE `userrole`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `VolunteerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventvolunteer`
--
ALTER TABLE `eventvolunteer`
  ADD CONSTRAINT `eventvolunteer_ibfk_1` FOREIGN KEY (`VolunteerId`) REFERENCES `volunteer` (`VolunteerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventvolunteer_ibfk_2` FOREIGN KEY (`EventId`) REFERENCES `events` (`EventId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mediaimage`
--
ALTER TABLE `mediaimage`
  ADD CONSTRAINT `mediaimage_ibfk_1` FOREIGN KEY (`SId`) REFERENCES `spaces` (`spaceId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ngovolunteer`
--
ALTER TABLE `ngovolunteer`
  ADD CONSTRAINT `ngovolunteer_ibfk_1` FOREIGN KEY (`VolunteerId`) REFERENCES `volunteer` (`VolunteerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ngovolunteer_ibfk_2` FOREIGN KEY (`NGOId`) REFERENCES `ngo` (`NGOId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organizeevent`
--
ALTER TABLE `organizeevent`
  ADD CONSTRAINT `organizeevent_ibfk_1` FOREIGN KEY (`NGOId`) REFERENCES `ngo` (`NGOId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organizeevent_ibfk_2` FOREIGN KEY (`EventId`) REFERENCES `events` (`EventId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organizeevent_ibfk_3` FOREIGN KEY (`SId`) REFERENCES `spaces` (`spaceId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleId`) REFERENCES `userrole` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
