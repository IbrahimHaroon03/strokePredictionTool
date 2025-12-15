# Stroke Prediction Tool

### Functions
The program had seperate frunctions for the manager and customer.

<i>Admin functions:</i>
1. Add a new user
2. View users
3. Update users
4. Delete users
5. View Sign up requests & Approve or deny

<i>Doctor Functions:</i>
1. Add patients
2. View patients
3. Delete patients
4. Update patients
5. Predict stroke likelihood
6. Patient notes

<i>Patient Functions:</i>
1. Add medical info
2. Update medical info
3. View medical info
4. View stroke prediction
5. View visual indicators

### Concepts I Learnt & How They Were Used
1. <i>Machine Learning Fundamentals:</i>
- Learned core machine learning concepts including data preprocessing (one-hot encoding, binary encoding, imputation, and under sampling) and model training using scikit-learn.
- These techniques were applied to prepare data and build an effective predictive model.

### Model Evaluation & Persistence:
- Learned how to evaluate machine learning models using metrics like F1 score.
- Used joblib to save and load trained models and preprocessing objects for production use.

### Machine Learning Deployment:
- Developed the ability to deploy trained machine learning models using Flask.
- Exposed the model through an API to integrate it with the web application for real-time predictions.

### Session Management:
- Learned and applied session-based authentication in PHP.
- Implemented secure login and logout functionality with role-based access control.

### Database-Driven Front-End Integration:
- Developed logic to connect HTML tables to a MySQL database.
- Ensured CRUD operations updated the interface dynamically without manual page refreshes.

### Multi-Role Application Structure:
- Learned how to design applications with multiple user roles.
- Implemented user-specific dashboards, CRUD permissions, and conditional navigation rendering.
