from flask import Flask, request, jsonify
import mysql.connector
import pickle
import numpy as np
import pandas as pd

# Database connection
def get_db_connection():
    connection = mysql.connector.connect(
        host='phpmyadmin.ecs.westminster.ac.uk',        # E.g., "w1947892.users.ecs.westminster.ac.uk"
        user='w1947892_0', # Your DB username
        password='w1947892', # Your DB password
        database='CTKqM5YRZiC0' # Your database name
    )
    return connection

# Load the ML model, scaler, and imputer
with open('model.pkl', 'rb') as f:
    model = pickle.load(f)

with open('scaler.pkl', 'rb') as f:
    scaler = pickle.load(f)

app = Flask(__name__)

# A simple route
@app.route('/')
def home():
    return "✅ Server is working!"

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
