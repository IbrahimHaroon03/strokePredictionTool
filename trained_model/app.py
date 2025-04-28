import pandas as pd
import joblib
from flask import Flask, request, jsonify

app = Flask(__name__)

# Load the trained model, imputer, and scaler
model = joblib.load("trained_model/KNearest_Neighbours_Model.pkl")
imputer = joblib.load("trained_model/imputer.pkl")
scaler = joblib.load("trained_model/scaler.pkl")

@app.route('/predict', methods=['POST'])
def predict():
    # Get the data from the POST request
    data = request.json
    df = pd.DataFrame([data])

    # Impute missing values
    new_df = imputer.transform(df)

    # Convert back to DataFrame to retain column names
    new_df = pd.DataFrame(new_df, columns=df.columns)

    # Scale the data
    new_df = scaler.transform(new_df)

    # Also keep it as a DataFrame
    new_df= pd.DataFrame(new_df, columns=df.columns)

    # Predict probability
    probability = model.predict_proba(new_df)[0][1]  # Probability of class '1' (stroke)

    # Convert to percentage
    percent = probability * 100

    # Return the prediction as a JSON response
    return jsonify({'prediction': percent})


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
