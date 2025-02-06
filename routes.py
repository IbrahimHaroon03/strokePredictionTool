from Flask import Flask, render_template

app = Flask(__name__)

@app.route('/templates/all/index.html')
def home():
    return render_template('index.html')

@app.route('/templates/all/login.html')
def login():
    return render_template('login.html')

@app.route('/templates/all/signup.html')
def signup():
    return render_template('signup.html')

@app.route('/templates/doctor/doctor_dashboard.html')
def doctor_dashboard():
    return render_template('doctor_dasboard.html')

@app.route('/templates/doctor/add_patient.html')
def add_new_patient():
    return render_template('add_patient.html')

@app.route('/templates/admin/admin_dashboard.html')
def add_new_patient():
    return render_template('admin_dashboard.html')

@app.route('/templates/patient/patient_dashboard.html')
def patient_dashboard():
    return render_template('patient_dasboard.html')

@app.route('/SQL_PHP/submit_form.php')
def patient_dashboard():
    return render_template('submit_form.php')



if __name__ == '__main__':
    app.run(debug=True)
