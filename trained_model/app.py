from flask import Flask, request, jsonify
import mysql.connector
import pandas as pd
import joblib

app = Flask(__name__)

# Load model, imputer, scaler
model = joblib.load("/home/student/892/w1947892/public_html/stroke_prediction_tool/trained_model/KNearest_Neighbours_Model.pkl")
imputer = joblib.load("/home/student/892/w1947892/public_html/stroke_prediction_tool/trained_model/mputer.pkl")
scaler = joblib.load("/home/student/892/w1947892/public_html/stroke_prediction_tool/trained_model/scaler.pkl")

@app.route('/predict', methods=['POST'])
def predict():
    data = request.json
    patient_id = data.get("patient_id")

    if not patient_id:
        return jsonify({"error": "Missing patient_id"}), 400

    # DB connection
    conn = mysql.connector.connect(
        host="phpmyadmin.ecs.westminster.ac.uk",
        user="w1947892",
        password="CTKqM5YRZiC0",
        database="w1947892_0"
    )
    cursor = conn.cursor(dictionary=True)

    # Fetch patient
    cursor.execute("SELECT * FROM patientMedicalInfo WHERE id = %s", (patient_id,))
    patient = cursor.fetchone()
    if not patient:
        return jsonify({"error": "Patient not found"}), 404

    # [Insert your same processing & prediction logic here]

    # Final stroke % result
    percent = 83.25  # for example

    # Update DB (optional, or return to frontend)
    update = conn.cursor()
    update.execute("UPDATE patientMedicalInfo SET stroke = %s WHERE id = %s", (percent, patient_id))
    conn.commit()

    return jsonify({"success": True, "stroke_probability": percent})

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=8000)
