from flask import Flask, render_template

app = Flask(__name__)

@app.route('/')
def home():
    return "Hello, Flask!"

@app.route('/homePage')
def home_page():
    return render_template('homePage.html')

@app.route('/loginPage')
def login_page():
    return render_template('loginPage.html')

if __name__ == '__main__':
    app.run(debug=True)
