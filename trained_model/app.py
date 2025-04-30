import mysql.connector
import pandas as pd
import joblib
from flask import Flask, request

app = Flask(__name__)

@app.route('/predict', methods=['POST'])
def predict(): 

    # Load model, imputer, scaler
    model = joblib.load("KNearest_Neighbours_Model.pkl")
    imputer = joblib.load("imputer.pkl")
    scaler = joblib.load("scaler.pkl")

    # Connect to MySQL
    conn = mysql.connector.connect(
        host="phpmyadmin.ecs.westminster.ac.uk",
        user="w1947892",
        password="CTKqM5YRZiC0",
        database="w1947892_0"
    )

    cursor = conn.cursor(dictionary=True)

    # Fetch patient data by ID
    data = request.json
    patient_id = data.get('patient_id')  # grab the ID sent from PHP   
    query = "SELECT * FROM patientMedicalInfo WHERE id = %s"
    cursor.execute(query, (patient_id,))
    patient = cursor.fetchone()

    if not patient:
        print("No patient found!")
        exit()

    # Convert to DataFrame
    patient_df = pd.DataFrame([patient])

    # Drop ID and stroke columns (since stroke is the label, you just want features)
    patient_df = patient_df.drop(columns=['id', 'stroke'])

    # Map categorical columns to match one-hot expected features

    # Gender
    patient_df['gender_Female'] = 1 if patient['gender'] == 'Female' else 0
    patient_df['gender_Male'] = 1 if patient['gender'] == 'Male' else 0
    patient_df['gender_Other'] = 0  # Not present in your DB enum, so always 0

    # Work type
    patient_df['work_type_Govt_job'] = 1 if patient['work_type'] == 'govt_job' else 0
    patient_df['work_type_Never_worked'] = 1 if patient['work_type'] == 'never_worked' else 0
    patient_df['work_type_Private'] = 1 if patient['work_type'] == 'private' else 0
    patient_df['work_type_Self-employed'] = 1 if patient['work_type'] == 'self-employed' else 0
    patient_df['work_type_children'] = 1 if patient['work_type'] == 'children' else 0

    # Residence type
    patient_df['Residence_type'] = 1 if patient['residence_type'] == 'Urban' else 0

    # Smoking status
    patient_df['smoking_status_Unknown'] = 1 if patient['smoking_status'] == 'unknown' else 0
    patient_df['smoking_status_formerly smoked'] = 1 if patient['smoking_status'] == 'formerly_smoked' else 0
    patient_df['smoking_status_never smoked'] = 1 if patient['smoking_status'] == 'never_smoked' else 0
    patient_df['smoking_status_smokes'] = 1 if patient['smoking_status'] == 'smokes' else 0

    # ever_married: convert 'Yes' to 1, 'No' to 0
    patient_df['ever_married'] = 1 if patient['ever_married'] == 'Yes' else 0

    # Keep only required columns
    input_features = [
        'age', 'hypertension', 'heart_disease', 'ever_married', 'Residence_type',
        'avg_glucose_level', 'bmi',
        'gender_Female', 'gender_Male', 'gender_Other',
        'work_type_Govt_job', 'work_type_Never_worked', 'work_type_Private',
        'work_type_Self-employed', 'work_type_children',
        'smoking_status_Unknown', 'smoking_status_formerly smoked',
        'smoking_status_never smoked', 'smoking_status_smokes'
    ]

    patient_ready = patient_df[input_features]

    # Impute missing values
    patient_imputed = imputer.transform(patient_ready)
    patient_imputed = pd.DataFrame(patient_imputed, columns=patient_ready.columns)

    # Scale the data
    patient_scaled = scaler.transform(patient_imputed)
    patient_scaled = pd.DataFrame(patient_scaled, columns=patient_ready.columns)

    # Predict stroke probability
    probability = model.predict_proba(patient_scaled)[0][1]  # Probability of class '1'

    # Convert to percentage
    percent = probability * 100

    # Now UPDATE the database
    update_cursor = conn.cursor()
    update_query = "UPDATE patientMedicalInfo SET stroke = %s WHERE id = %s"
    update_cursor.execute(update_query, (percent, patient_id))
    conn.commit()

    # Close connections
    update_cursor.close()
    conn.close()

    return {"status": "success", "message": "Prediction completed."}, 200

if __name__ == '__main__':
    app.run()
