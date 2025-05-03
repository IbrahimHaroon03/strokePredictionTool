document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);

    if (params.get('error') === 'username_taken') {
        alert('Username already exists. Please choose another.');
    } 
    
    if (params.get('error') === 'email_taken') {
        alert('Email already in use. Please use another.');
    }

    if (params.get('status') === 'success') {
        alert('Registration successful! Please wait for Admin approval.');
    }
});
