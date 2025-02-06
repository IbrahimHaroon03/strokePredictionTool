USE w1947892_0;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'patient', 'doctor') NOT NULL DEFAULT 'patient' 
);

CREATE TABLE patientMedicalInfo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gender ENUM('Male', 'Female') NOT NULL,
    age INT CHECK (age >= 0), 
    hypertension TINYINT(1) CHECK (hypertension IN (0, 1)), 
    heart_disease TINYINT(1) CHECK (heart_disease IN (0, 1)), 
    ever_married ENUM('No', 'Yes') NOT NULL,
    work_type ENUM('children', 'govt_job', 'never_worked', 'private', 'self-employed') NOT NULL,
    Residence_type ENUM('Rural', 'Urban') NOT NULL,
    avg_glucose_level DECIMAL(5,2) CHECK (avg_glucose_level >= 0), 
    bmi DECIMAL(5,2) CHECK (bmi >= 0), 
    smoking_status ENUM('formerly_smoked', 'never_smoked', 'smokes', 'unknown') NOT NULL,
    stroke TINYINT(1) CHECK (stroke IN (0, 1))
)