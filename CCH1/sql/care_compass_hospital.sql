-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 25, 2025 at 07:54 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `care_compass_hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `appointment_id` int NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(100) NOT NULL,
  `patient_contact` varchar(20) DEFAULT NULL,
  `doctor_id` int NOT NULL,
  `appointment_time` time NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_status` enum('Pending','Approved','Cancelled') DEFAULT 'Pending',
  `patient_email` varchar(100) NOT NULL,
  `booking_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`appointment_id`),
  UNIQUE KEY `booking_id` (`booking_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `patient_name`, `patient_contact`, `doctor_id`, `appointment_time`, `appointment_date`, `appointment_status`, `patient_email`, `booking_id`) VALUES
(8, 'George DC', '+94 785-364-225', 70, '04:00:00', '2025-03-08', 'Approved', 'dcdcgec@gmail.com', '2025-02-24-170050'),
(7, 'Merliah Waves', '+94 123-637-939', 57, '02:30:00', '2025-02-27', 'Approved', 'queenofthewaves@gmail.com', '2025-02-23-180617');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_limit`
--

DROP TABLE IF EXISTS `appointment_limit`;
CREATE TABLE IF NOT EXISTS `appointment_limit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doctor_id` int NOT NULL,
  `max_appointments` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointment_limit`
--

INSERT INTO `appointment_limit` (`id`, `doctor_id`, `max_appointments`) VALUES
(13, 68, 2),
(11, 57, 3),
(10, 81, 2),
(12, 41, 19),
(14, 70, 4),
(15, 40, 8),
(16, 43, 0);

-- --------------------------------------------------------

--
-- Table structure for table `medical_staff`
--

DROP TABLE IF EXISTS `medical_staff`;
CREATE TABLE IF NOT EXISTS `medical_staff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `role` enum('Doctor','Nurse','Physician','Pharmacist','Technician','Receptionist','Other') NOT NULL,
  `department` varchar(100) NOT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `qualifications` text NOT NULL,
  `shift_schedule` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medical_staff`
--

INSERT INTO `medical_staff` (`staff_id`, `name`, `email`, `contact_number`, `role`, `department`, `specialty`, `qualifications`, `shift_schedule`, `created_at`) VALUES
(56, 'Alysia Windrider', 'alysia.windrider@gmail.com', '+94 71-1234583', 'Doctor', 'Pulmonology', 'Pulmonology', 'MBBS, MD Pulmonology', '9:00 AM - 5:00 PM', '2025-02-14 15:30:21'),
(82, 'Sarah Ferguson', 'iamsarah@gmail.com', '+94 123-839-839', 'Nurse', 'General Ward', 'Cardiology', 'PHD in Nursing', '07:00 AM - 04:00 PM', '2025-02-22 18:50:28'),
(55, 'Idris Flameheart', 'idris.flameheart@gmail.com', '+94 76-1234582', 'Technician', 'Lab Services', 'Microbiology', 'Diploma in Medical Laboratory Technology', '1:00 PM - 9:00 PM', '2025-02-14 15:30:21'),
(81, 'James Charles', 'jach3arles@gmail.com', '+94 127-888-022', 'Doctor', 'Cardiology', 'Heart Surgery', 'PHD in Cardio', '9:00 AM - 5:00 PM', '2025-02-20 09:51:08'),
(52, 'Orion Darkwater', 'orion.darkwater@gmail.com', '+94 75-1234579', 'Physician', 'Cardiology', 'Cardiology', 'MBBS, MD Cardiology', '8:00 AM - 4:00 PM', '2025-02-14 15:30:21'),
(51, 'Elysia Nightbreeze', 'elysia.nightbreeze@gmail.com', '+94 71-1234578', 'Doctor', 'Neurology', 'Neurology', 'MBBS, MD Neurology', '9:00 AM - 5:00 PM', '2025-02-14 15:30:21'),
(50, 'Thalion Stormrider', 'thalion.stormrider@gmail.com', '+94 77-1234577', 'Pharmacist', 'Pharmacy', 'Pharmacy', 'Bachelor of Pharmacy', '9:00 AM - 5:00 PM', '2025-02-14 15:30:21'),
(49, 'Lysandra Shadowflame', 'lysandra.shadowflame@gmail.com', '+94 78-1234576', 'Nurse', 'Surgical Ward', 'Surgery', 'Diploma in Nursing', '10:00 AM - 8:00 PM', '2025-02-14 15:30:21'),
(48, 'Darian Darkthorn', 'darian.darkthorn@gmail.com', '+94 75-1234575', 'Technician', 'Radiology', 'Radiology', 'Diploma in Radiology', '9:00 AM - 5:00 PM', '2025-02-14 15:30:21'),
(47, 'Elowen Frostveil', 'elowen.frostveil@gmail.com', '+94 71-1234574', 'Pharmacist', 'Pharmacy', 'Pharmacy', 'Bachelor of Pharmacy', '9:00 PM - 5:00 AM', '2025-02-14 15:30:21'),
(46, 'Galadriel Sunshard', 'galadriel.sunshard@gmail.com', '+94 77-1234573', 'Receptionist', 'Administration', 'General', 'High School Diploma', '9:00 AM - 9:00 PM', '2025-02-14 15:30:21'),
(45, 'Selene Starfire', 'selene.starfire@gmail.com', '+94 76-1234572', 'Nurse', 'ICU', 'Critical Care', 'Diploma in Nursing', '7:00 AM - 4:00 PM', '2025-02-14 15:30:21'),
(84, 'Adriana Adam', 'a@gmail.com', '+00000', 'Nurse', 'General Ward', 'Pathology', 'Diploma in Pathens', '09:00 AM - 06:00 PM', '2025-02-24 19:33:05'),
(83, 'Jennie Kim', 'jenzen@gmail.com', '+94 123-456-789', 'Doctor', 'Cardiology', 'Heart study', 'MBs in Cardiology', '10:00 PM - 04:00 AM', '2025-02-24 17:55:44'),
(43, 'Kaelen Nightshade', 'kaelen.nightshade@gmail.com', '+94 78-1234570', 'Physician', 'Nephrology', 'Nephrology', 'MBBS, MD Nephrology', '9:00 AM - 5:00 PM', '2025-02-14 15:30:21'),
(41, 'Isolde Firebloom', 'isolde.firebloom@gmail.com', '+94 77-1234568', 'Doctor', 'Radiology', 'Radiology', 'MBBS, DMRD', '9:00 AM - 5:00 PM', '2025-02-14 15:30:21'),
(40, 'Vaelen Emberstorm', 'vaelen.emberstorm@gmail.com', '+94 71-1234567', 'Doctor', 'Rheumatology', 'Rheumatology', 'MBBS, MD Rheumatology', '9:00 PM - 8:00 AM', '2025-02-14 15:30:21'),
(57, 'Nyx Moonwhisper', 'nyx.moonwhisper@gmail.com', '+94 77-1234584', 'Doctor', 'Orthopedics', 'Orthopedics', 'MBBS, MS Orthopedics', '10:00 PM - 5:00 AM', '2025-02-14 15:30:21'),
(58, 'Lorian Silverleaf', 'lorian.silverleaf@gmail.com', '+94 75-1234585', 'Technician', 'X-Ray', 'Imaging', 'Diploma in Radiology', '9:00 AM - 5:00 PM', '2025-02-14 15:30:21'),
(59, 'Valeria Shadowgale', 'valeria.shadowgale@gmail.com', '+94 71-1234586', 'Nurse', 'Emergency Room', 'Emergency Care', 'Diploma in Nursing', '9:00 AM - 5:00 PM', '2025-02-14 15:30:21'),
(60, 'Arion Orpheus', 'arionorpheus@gmail.com', '+94 77 123 4567', 'Doctor', 'General Medicine', 'Internal Medicine', 'MBBS, MD', '9:00 AM - 5:00 PM', '2025-02-14 15:33:32'),
(61, 'Lyra Amethyst', 'lyraamethyst@gmail.com', '+94 71 234 5678', 'Nurse', 'Surgical', 'Pre-Op Care', 'BSc in Nursing', '8:00 AM - 4:00 PM', '2025-02-14 15:33:32'),
(62, 'Elara Duvessa', 'elaraduvessa@gmail.com', '+94 75 345 6789', 'Technician', 'Radiology', 'MRI Scanning', 'Diploma in Medical Technology', '9:00 AM - 5:00 PM', '2025-02-14 15:33:32'),
(63, 'Orion Lunas', 'orionlunas@gmail.com', '+94 72 456 7890', 'Pharmacist', 'Pharmacy', 'Pharmacology', 'BPharm', '9:00 AM - 5:00 PM', '2025-02-14 15:33:32'),
(64, 'Caelan Dorian', 'caelandorian@gmail.com', '+94 74 567 8901', 'Doctor', 'Pediatrics', 'Childcare Medicine', 'MBBS, Pediatrics Specialist', '8:00 AM - 4:00 PM', '2025-02-14 15:33:32'),
(65, 'Solara Vixen', 'solaravixen@gmail.com', '+94 73 678 9012', 'Nurse', 'Emergency', 'Trauma Care', 'BSc in Emergency Nursing', '12:00 AM - 6:00 AM', '2025-02-14 15:33:32'),
(66, 'Thorne Vale', 'thornevale@gmail.com', '+94 77 789 0123', 'Receptionist', 'Administration', 'Customer Service', 'Diploma in Office Management', '8:00 AM - 4:00 PM', '2025-02-14 15:33:32'),
(67, 'Cassian Ravenswood', 'cassianravenswood@gmail.com', '+94 71 890 1234', 'Technician', 'Pathology', 'Blood Testing', 'Diploma in Medical Lab Technology', '9:00 AM - 5:00 PM', '2025-02-14 15:33:32'),
(68, 'Althea Wilder', 'altheawilder@gmail.com', '+94 75 901 2345', 'Doctor', 'Cardiology', 'Heart Surgery', 'MBBS, Cardiology', '9:00 AM - 5:00 PM', '2025-02-14 15:33:32'),
(69, 'Elysia Frost', 'elysiafrost@gmail.com', '+94 76 012 3456', 'Pharmacist', 'Pharmacy', 'Herbal Remedies', 'MPharm, Herbal Medicine', '9:00 AM - 5:00 PM', '2025-02-14 15:33:32'),
(70, 'Zane Ashford', 'zaneashford@gmail.com', '+94 74 123 4567', 'Doctor', 'Orthopedics', 'Bone Surgery', 'MBBS, Orthopedics', '8:00 AM - 4:00 PM', '2025-02-14 15:33:32'),
(71, 'Liora Vance', 'lioravance@gmail.com', '+94 73 234 5678', 'Technician', 'Neurology', 'Electroencephalography', 'Diploma in Neurotech', '9:00 AM - 5:00 PM', '2025-02-14 15:33:32'),
(72, 'Talon Windrider', 'talonwindrider@gmail.com', '+94 72 345 6789', 'Nurse', 'Maternity', 'Labor and Delivery', 'BSc in Midwifery', '10:00 AM - 6:00 PM', '2025-02-14 15:33:32'),
(73, 'Valeria Starling', 'valeriastarlings@gmail.com', '+94 71 456 7890', 'Receptionist', 'Patient Coordination', 'Patient Relations', 'Diploma in Healthcare Administration', '8:00 AM - 4:00 PM', '2025-02-14 15:33:32'),
(74, 'Darius Thorne', 'dariusthorne@gmail.com', '+94 77 567 8901', 'Doctor', 'Dermatology', 'Skin Treatments', 'MBBS, Dermatology', '9:00 AM - 5:00 PM', '2025-02-14 15:33:32'),
(75, 'Iris Nightshade', 'irisnightshade@gmail.com', '+94 74 678 9012', 'Technician', 'Ophthalmology', 'Eye Tests', 'Diploma in Ophthalmic Technology', '8:00 AM - 4:00 PM', '2025-02-14 15:33:32'),
(76, 'Elowen Moon', 'elowenmoon@gmail.com', '+94 76 789 0123', 'Pharmacist', 'Pharmacy', 'Medication Therapy', 'PharmD', '9:00 AM - 5:00 PM', '2025-02-14 15:33:32'),
(77, 'Soren Firestone', 'sorenfirestone@gmail.com', '+94 78 890 1234', 'Doctor', 'Surgery', 'General Surgery', 'MBBS, General Surgery', '9:00 AM - 5:00 PM', '2025-02-14 15:33:32'),
(78, 'Vesper Tempest', 'vespertempest@gmail.com', '+94 75 901 2345', 'Receptionist', 'Front Desk', 'Scheduling', 'Diploma in Customer Service', '8:00 AM - 4:00 PM', '2025-02-14 15:33:32'),
(79, 'Thalia Evermore', 'thaliaevermore@gmail.com', '+94 79 012 3456', 'Nurse', 'ICU', 'Critical Care', 'BSc in Nursing', '10:00 AM - 6:00 PM', '2025-02-14 15:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `online_payments`
--

DROP TABLE IF EXISTS `online_payments`;
CREATE TABLE IF NOT EXISTS `online_payments` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `registration_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `card_type` enum('american)express','visa','mastercard') NOT NULL,
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`),
  KEY `registration_id` (`registration_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `online_payments`
--

INSERT INTO `online_payments` (`payment_id`, `registration_id`, `amount`, `card_type`, `payment_date`) VALUES
(4, 7, 13450.00, 'visa', '2025-02-23 11:27:07'),
(3, 7, 13450.00, 'visa', '2025-02-22 14:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `patient_feedback`
--

DROP TABLE IF EXISTS `patient_feedback`;
CREATE TABLE IF NOT EXISTS `patient_feedback` (
  `feedback_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `satisfaction` varchar(3) NOT NULL,
  `consultant_doctor` varchar(100) NOT NULL,
  `doctor_rating` int NOT NULL,
  `pharmacy_rating` int NOT NULL,
  `meds_rating` int NOT NULL,
  `appointment_rating` int NOT NULL,
  `online_registration_rating` int NOT NULL,
  `suggestion` text NOT NULL,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `review` text NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `patient_feedback`
--

INSERT INTO `patient_feedback` (`feedback_id`, `name`, `email`, `contact_number`, `satisfaction`, `consultant_doctor`, `doctor_rating`, `pharmacy_rating`, `meds_rating`, `appointment_rating`, `online_registration_rating`, `suggestion`, `submitted_at`, `review`) VALUES
(3, 'Salma Shah', 'salma@gmail.com', '+94 123446372', 'yes', 'Moon Luna', 4, 5, 4, 5, 5, 'The only thing I would say could improve was the cafeteria food.            ', '2025-02-10 10:52:57', 'I had a pleasant stay at the hospital, for a surgery to remove a cyst in my back. Rooms were clean and well maintained.'),
(10, 'Salma Shah', 'salma@gmail.com', '+94 123333333', 'yes', 'Soren Firestone', 5, 5, 5, 5, 5, 'Please be faster.', '2025-02-24 14:40:15', 'Thank you so much.');

-- --------------------------------------------------------

--
-- Table structure for table `patient_query`
--

DROP TABLE IF EXISTS `patient_query`;
CREATE TABLE IF NOT EXISTS `patient_query` (
  `query_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `inquiry` text NOT NULL,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`query_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `patient_query`
--

INSERT INTO `patient_query` (`query_id`, `first_name`, `last_name`, `email`, `contact_number`, `inquiry`, `submitted_at`) VALUES
(1, 'Salma', 'Shah', 'salma@gmail.com', '+94 728-838-920', 'Do you offer services for OCD?', '2025-02-08 17:15:08'),
(4, 'Darling', 'Drake', 'd98!d@gmail.com', '+94128829011', 'Do you offer face lifts and facial reconstruction after a burn incident?', '2025-02-13 17:47:16'),
(7, 'Rose', 'Jack', 'rosesunk@gmail.com', '+94 123456940', 'Do you have any physiotherapy services? ', '2025-02-24 14:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
CREATE TABLE IF NOT EXISTS `registrations` (
  `registration_id` int NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(255) NOT NULL,
  `patient_contact` varchar(20) NOT NULL,
  `patient_email` varchar(255) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `test_id` int NOT NULL,
  `registration_date` date NOT NULL,
  `status` enum('Pending','Registered','Cancelled') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`registration_id`),
  KEY `test_id` (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`registration_id`, `patient_name`, `patient_contact`, `patient_email`, `total_cost`, `test_id`, `registration_date`, `status`) VALUES
(5, 'Salma Shah', '+94 123-748-8393', 'salmashah0192@gmail.com', 18450.00, 13, '2025-03-06', 'Registered'),
(9, 'George DC', '+94 123738930', 'dcdcgec@gmail.com', 75450.00, 3, '2025-02-26', 'Registered'),
(6, 'Salma Shah', '+94 127-930-8392', 'salma1234@gmail.com', 75450.00, 3, '2025-03-06', 'Registered');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `page_url` varchar(255) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `keywords`, `page_url`) VALUES
(1, 'Accident and Emergency', 'emergency, accident, trauma, urgent care', 'accident_and_emergency.php'),
(3, 'Outpatient Care (OPD)', 'medicine, drugs, prescription, pharmacy', 'pharmacy.php'),
(4, 'Clinical Laboratory', 'vaccine, immunization, covid shot', 'vaccination.php'),
(5, 'Accident and Emergency', 'emergency, ambulance, accident, trauma, urgent care, ER', 'accident_and_emergency.php'),
(6, 'Accommodation Facilities', 'hospital rooms, patient stay, inpatient, accommodation, ward, rooms, grand room, deluxe room, room, shared room, standard room, facilities, facility, general, cafeteria', 'facilities.php'),
(7, 'Outpatient Care (OPD)', 'outpatient, OPD, walk-in, clinic, consultation, floorplan', 'outpatient_care.php'),
(8, 'Clinical Laboratory Services', 'lab, tests, test, biochemistry test, hormone test, liver test, microbiology, prenatal testing, prenatal, urine analysis, blood test, diagnostics, pathology, urine test, medical tests', 'clinicals.php'),
(9, 'Intensive and Critical Care Units', 'ICU, critical care, life support, ventilator, intensive care', 'icu.php'),
(10, 'Operating Theatre', 'surgery, operation, surgical theatre, surgeon, anesthesia, eye surgery', 'operating_theatre.php'),
(11, 'Pharmacy', 'medicine, drugs, prescription, pharmacist, medication, pills, tablets, pharmacy, panadol, digin, neurobin', 'pharmacy.php'),
(12, 'Women\'s Wellness Center', 'women health, maternity, pregnancy, baby, gynecology, prenatal, postnatal, mammogram, breast cancer, women', 'women_wellness.php'),
(13, 'Doctor Channeling', 'appointment, doctor, channeling, e-channeling, chanelling, e-chanelling, cardiologist, surgery doctor', 'doctor_channeling.php'),
(14, 'Vaccination', 'vaccine, MMR, measles, mumps, rubella, immunization, covid shot, covid-19, polio, hepatatis, hepatatis B, tdap, tetanus, diphtheria, pertussis, HPV, baby vaccine, flu shot, booster, injection', 'vaccination.php'),
(15, 'X-ray & Radiology', 'x-ray, radiology, scan, imaging, ultrasound, CT scan, MRI', 'radiology_and_xray.php'),
(16, 'Registration', 'register, services, online services, registration, online registration', 'registration.php');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `test_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `duration` time DEFAULT NULL,
  `max_registrations` int NOT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `name`, `description`, `price`, `duration`, `max_registrations`) VALUES
(1, 'Blood Test', 'General blood analysis.', 15000.00, '00:00:01', 50),
(2, 'X-Ray', 'X-Ray for various body parts.', 30000.00, '00:00:30', 30),
(3, 'MRI Scan', 'Detailed imaging of soft tissues.', 75000.00, '00:00:02', 1),
(4, 'Urinalysis', 'Analysis of urine samples.', 5000.00, '00:00:01', 40),
(5, 'Cholesterol Test', 'Test for cholesterol levels.', 10000.00, '00:00:01', 35),
(6, 'Pregnancy Test', 'Test for pregnancy detection.', 5000.00, '00:00:30', 80),
(7, 'CT Scan', 'Detailed imaging using CT.', 60000.00, '00:00:01', 0),
(8, 'Glucose Test', 'Test for blood glucose levels.', 7500.00, '00:00:30', 45),
(9, 'ECG', 'Heart electrical activity test.', 12000.00, '00:00:30', 25),
(10, 'Liver Function Test', 'Assesses liver health.', 15000.00, '00:00:01', 20),
(11, 'Kidney Function Test', 'Assess kidney performance.', 13000.00, '00:00:01', 22),
(12, 'HIV Test', 'Test for HIV detection.', 20000.00, '00:00:45', 18),
(13, 'Dengue Test', 'Detection of dengue virus.', 18000.00, '00:00:01', 15),
(14, 'Typhoid Test', 'Diagnosis of typhoid fever.', 14000.00, '00:00:45', 12),
(15, 'Thyroid Test', 'Checks thyroid hormone levels.', 12000.00, '00:00:01', 25),
(16, 'Covid-19 PCR Test', 'Detects Covid-19 virus.', 25000.00, '00:00:06', 30),
(17, 'Covid-19 Antigen Test', 'Rapid Covid-19 detection.', 10000.00, '00:00:30', 40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('Receptionist','Administrator','Doctor') NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user`, `email`, `role`, `password`) VALUES
(2, 'JK', 'jk@gmail.com', 'Receptionist', 'c775e7b757ede630cd0aa1113bd102661ab38829ca52a6422ab782862f268646'),
(3, 'Rose Park', 'rose@gmail.com', 'Doctor', '47646b415ee1d05aed9a9c74718cce5554db2e3dc89be8ecd57f7e82c419b256'),
(7, 'Salma Shah', 'salma@gmail.com', 'Administrator', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
