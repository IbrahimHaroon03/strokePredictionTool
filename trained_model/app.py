import joblib
import pandas as pd
from flask import Flask, request

app = Flask(__name__)

# Load model and preprocessing tools
model = joblib.load("KNearest_Neighbours_Model.pkl")
imputer = joblib.load("imputer.pkl")
scaler = joblib.load("scaler.pkl")

@app.route('/predict', methods=['POST'])
def predict():
    data = request.json
    features = data.get("features")

    # Define column order (must match training)
    columns = [
        'age', 'hypertension', 'heart_disease', 'ever_married', 'Residence_type',
        'avg_glucose_level', 'bmi',
        'gender_Female', 'gender_Male', 'gender_Other',
        'work_type_Govt_job', 'work_type_Never_worked', 'work_type_Private',
        'work_type_Self-employed', 'work_type_children',
        'smoking_status_Unknown', 'smoking_status_formerly smoked',
        'smoking_status_never smoked', 'smoking_status_smokes'
    ]

    # Turn into DataFrame for processing
    df = pd.DataFrame([features], columns=columns)

    # Apply imputation for missing values
    df_imputed = imputer.transform(df)
    df_imputed = pd.DataFrame(df_imputed, columns=columns)

    # Apply scaling (standardization)
    df_scaled = scaler.transform(df_imputed)
    df_scaled = pd.DataFrame(df_scaled, columns=columns)

    # Make prediction (probability of class 1 = stroke)
    probability = model.predict_proba(df_scaled)[0][1]
    percent = probability * 100

    return {"stroke_probability": percent}, 200

if __name__ == '__main__':
    app.run()
