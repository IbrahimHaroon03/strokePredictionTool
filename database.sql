CREATE DATABASE strokeData;

CREATE TABLE patientData (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    hypertension BOOLEAN NOT NULL,
    heart_disease BOOLEAN NOT NULL,
    ever_married BOOLEAN NOT NULL,
    work_type ENUM('Children', 'Gov_job', 'Never_worked', 'Private', 'Self-employed') NOT NULL,
    residence_type ENUM('Urban', 'Rural') NOT NULL,
    avg_glucose_level DECIMAL(5,2) NOT NULL,
    bmi DECIMAL(3,1) NOT NULL,
    smoking_status ENUM('never smoked', 'formerly smoked', 'smoked', 'unknown') NOT NULL
);