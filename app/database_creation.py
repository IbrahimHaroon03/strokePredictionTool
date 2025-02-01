import sqlite3

# Connect to the SQLite database (or create it if it doesn't exist)
conn = sqlite3.connect('database.db')
cursor = conn.cursor()

# Create the 'users' table
cursor.execute('''
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    role CHAR(30) NOT NULL DEFAULT 'User'
)
''')

# Insert a user into the 'users' table
cursor.execute('''
INSERT INTO users (username, password, role)
VALUES ('Ibrahim', '123', 'Admin')
''')

# Create the 'patientData' table
cursor.execute('''
CREATE TABLE IF NOT EXISTS patientData (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    gender CHAR(30) NOT NULL,
    age INTEGER NOT NULL,
    hypertension BOOLEAN NOT NULL,
    heart_disease BOOLEAN NOT NULL,
    ever_married BOOLEAN NOT NULL,
    work_type CHAR(30) NOT NULL,
    residence_type CHAR(30) NOT NULL,
    avg_glucose_level DECIMAL(5,2) NOT NULL,
    bmi DECIMAL(3,1) NOT NULL,
    smoking_status CHAR(30) NOT NULL
)
''')

# Commit the changes to the database
conn.commit()

# Query the 'users' table
# cursor.execute("SELECT * FROM users")
# users = cursor.fetchall()
# print("Users:")
# for user in users:
#     print(user)

# # Query the 'patientData' table
# cursor.execute("SELECT * FROM patientData")
# patients = cursor.fetchall()
# print("\nPatient Data:")
# for patient in patients:
#     print(patient)

# Close the connection
conn.close()