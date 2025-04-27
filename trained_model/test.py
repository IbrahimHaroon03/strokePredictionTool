import joblib
import pandas as pd

# Load the trained model, imputer, and scaler
model = joblib.load("trained_model/KNearest_Neighbours_Model.pkl")
imputer = joblib.load("trained_model/imputer.pkl")
scaler = joblib.load("trained_model/scaler.pkl")

# Example: one new patient data row
new_data = pd.DataFrame([{
    'age': 28,
    'hypertension': 0,
    'heart_disease': 0,
    'ever_married': 1,
    'Residence_type': 1,
    'avg_glucose_level': 171.23,
    'bmi': 34,
    'gender_Female': 1,
    'gender_Male': 0,
    'gender_Other': 0,
    'work_type_Govt_job': 0,
    'work_type_Never_worked': 0,
    'work_type_Private': 1,
    'work_type_Self-employed': 0,
    'work_type_children': 0,
    'smoking_status_Unknown': 0,
    'smoking_status_formerly smoked': 0,
    'smoking_status_never smoked': 0,
    'smoking_status_smokes': 1
}])

# Impute missing values
new_data_imputed = imputer.transform(new_data)

# Convert back to DataFrame to retain column names
new_data_imputed = pd.DataFrame(new_data_imputed, columns=new_data.columns)

# Scale the data
new_data_scaled = scaler.transform(new_data_imputed)

# Also keep it as a DataFrame
new_data_scaled = pd.DataFrame(new_data_scaled, columns=new_data.columns)

# Predict probability
probability = model.predict_proba(new_data_scaled)[0][1]  # Probability of class '1' (stroke)

# Convert to percentage
percent = probability * 100
print(f"Predicted Stroke Risk: {percent:.2f}%")
