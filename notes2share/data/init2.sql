CREATE DATABASE upload;
use upload;
CREATE TABLE `details` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `filename` varchar(50)NOT NULL,
  `uploader` varchar(100) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `rating` float(2,1) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;
