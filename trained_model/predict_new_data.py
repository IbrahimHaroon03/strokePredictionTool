import sys
import json
import joblib
import pandas as pd

# Load model and preprocessing tools
model = joblib.load("KNearest_Neighbours_Model.pkl")
imputer = joblib.load("imputer.pkl")
scaler = joblib.load("scaler.pkl")

# Read input JSON from command-line
raw_json = sys.argv[1]
data_dict = json.loads(raw_json)
new_data = pd.DataFrame([data_dict])

# Preprocess input
imputed = imputer.transform(new_data)
scaled = scaler.transform(imputed)

# Predict
prob = model.predict_proba(scaled)[0][1]
percent = round(prob * 100, 2)