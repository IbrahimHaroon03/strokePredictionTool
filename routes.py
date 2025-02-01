from flask import Flask, render_template

app = Flask(__name__)

@app.route('/')
def home():
    return "Hello, Flask!"

@app.route('/loginPage')
def login_page():
    return render_template('login_page.html')

@app.route('/adminDashboard')
def home_page():
    return render_template('admin_dashboard.html')

@app.route('/viewPatientDatabase')
def view_patient_database():
    return render_template('view_patient_database.html')

@app.route('/addNewPatient')
def add_new_patient():
    return render_template('.html')


if __name__ == '__main__':
    app.run(debug=True)
