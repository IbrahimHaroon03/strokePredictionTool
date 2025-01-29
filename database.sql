CREATE DATABASE strokeData;

CREATE TABLE patientData (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    gender VARCHAR(10),
    hypertension BOOLEAN,
    heart_disease BOOLEAN,
    ever_married BOOLEAN,
    work_type VARCHAR(20),
    residence_type VARCHAR(10),
    avg_glucose_level DECIMAL(5,2),
    bmi DECIMAL(3,1),
    smoking_status VARCHAR(20)
)