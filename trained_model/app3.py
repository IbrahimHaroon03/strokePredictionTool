import joblib
import pandas as pd
from flask import Flask, request

app = Flask(__name__)

model = joblib.load("KNearest_Neighbours_Model.pkl")

@app.route('/predict', methods=['POST'])
def predict():
    data = request.json
    features = data.get("features")

    df = pd.DataFrame([features], columns=[
        'age', 'hypertension', 'heart_disease', 'ever_married', 'Residence_type',
        'avg_glucose_level', 'bmi',
        'gender_Female', 'gender_Male', 'gender_Other',
        'work_type_Govt_job', 'work_type_Never_worked', 'work_type_Private',
        'work_type_Self-employed', 'work_type_children',
        'smoking_status_Unknown', 'smoking_status_formerly smoked',
        'smoking_status_never smoked', 'smoking_status_smokes'
    ])

    probability = model.predict_proba(df)[0][1]
    return {"stroke_probability": probability * 100}, 200

if __name__ == '__main__':
    app.run()

