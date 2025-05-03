USE w1947892_0;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'patient', 'doctor') NOT NULL,
    date_approved TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE pending_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'doctor', 'patient') NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE patientMedicalInfo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gender ENUM('Male', 'Female') NOT NULL,
    age INT CHECK (age >= 0), 
    hypertension TINYINT(1) CHECK (hypertension IN (0, 1)), 
    heart_disease TINYINT(1) CHECK (heart_disease IN (0, 1)), 
    ever_married ENUM('No', 'Yes') NOT NULL,
    work_type ENUM('children', 'govt_job', 'never_worked', 'private', 'self-employed') NOT NULL,
    residence_type ENUM('Rural', 'Urban') NOT NULL,
    avg_glucose_level INT CHECK (avg_glucose_level >= 0), 
    bmi INT CHECK (bmi >= 0), 
    smoking_status ENUM('formerly_smoked', 'never_smoked', 'smokes', 'unknown') NOT NULL,
    stroke INT
)

CREATE TABLE externalPatientRecords (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gender ENUM('Male', 'Female') NOT NULL,
    age INT CHECK (age >= 0), 
    hypertension TINYINT(1) CHECK (hypertension IN (0, 1)), 
    heart_disease TINYINT(1) CHECK (heart_disease IN (0, 1)), 
    ever_married ENUM('No', 'Yes') NOT NULL,
    work_type ENUM('children', 'govt_job', 'never_worked', 'private', 'self-employed') NOT NULL,
    residence_type ENUM('Rural', 'Urban') NOT NULL,
    avg_glucose_level INT CHECK (avg_glucose_level >= 0), 
    bmi INT CHECK (bmi >= 0), 
    smoking_status ENUM('formerly_smoked', 'never_smoked', 'smokes', 'unknown') NOT NULL,
    stroke INT
)