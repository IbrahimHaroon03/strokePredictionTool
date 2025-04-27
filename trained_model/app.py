from flask import Flask, request, jsonify

app = Flask(__name__)

# A simple route
@app.route('/')
def home():
    return "✅ Server is working!"

# A fake prediction route (like your model will do later)
@app.route('/predict', methods=['POST'])
def predict():
    data = request.get_json()

    # Just pretend we always return 0.8 probability for now
    prediction = 0.8

    return jsonify({'prediction': prediction})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
