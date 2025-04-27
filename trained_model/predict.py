import sys
import json
import pickle
import numpy as np
import pandas as pd

def predict():
    # Get JSON data from PHP
    json_data = sys.argv[1]
    data = json.loads(json_data)
    
    # Convert to DataFrame with proper column order
    df = pd.DataFrame([data])
    
    # Load the imputer, scaler, and model
    with open('imputer.pkl', 'rb') as f:
        imputer = pickle.load(f)
    
    with open('scaler.pkl', 'rb') as f:
        scaler = pickle.load(f)
    
    with open('KNearest_Neighbours_model.pkl', 'rb') as f:
        model = pickle.load(f)
    
    # Apply imputer if needed
    # df_imputed = imputer.transform(df)
    
    # Apply scaler
    df_scaled = scaler.transform(df)
    
    # Make prediction
    prediction = model.predict_proba(df_scaled)[:, 1][0]  # Get probability of positive class
    
    # Output the prediction (PHP will capture this)
    print(prediction)

if __name__ == "__main__":
    predict()