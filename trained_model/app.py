import pickle
import numpy as np
import pandas as pd
from flask import Flask, request, jsonify

app = Flask(__name__)

# Load the model, scaler, and imputer (if applicable)
with open('model.pkl', 'rb') as f:
    model = pickle.load(f)

with open('scaler.pkl', 'rb') as f:
    scaler = pickle.load(f)

@app.route('/predict', methods=['POST'])
def predict():
    # Get the data from the POST request
    data = request.json
    df = pd.DataFrame([data])

    # Apply the scaler to the data
    df_scaled = scaler.transform(df)

    # Make the prediction
    prediction = model.predict_proba(df_scaled)[:, 1][0]  # Probability of stroke

    # Return the prediction as a JSON response
    return jsonify({'prediction': prediction})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
