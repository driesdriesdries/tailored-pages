document.addEventListener('DOMContentLoaded', function() {
    // Validate form on submit
    document.getElementById('landing-page-form').addEventListener('submit', function(event) {
        // Clear previous error messages
        var errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(function(message) {
            message.remove();
        });

        // Get form field values
        var firstName = document.getElementById('first-name').value.trim();
        var lastName = document.getElementById('last-name').value.trim();
        var emailAddress = document.getElementById('email-address').value.trim();
        
        var isValid = true;

        // Validate First Name
        if (firstName === '') {
            isValid = false;
            var firstNameError = document.createElement('span');
            firstNameError.className = 'error-message';
            firstNameError.style.color = 'red';
            firstNameError.textContent = 'First Name is required.';
            document.getElementById('first-name').after(firstNameError);
        }

        // Validate Last Name
        if (lastName === '') {
            isValid = false;
            var lastNameError = document.createElement('span');
            lastNameError.className = 'error-message';
            lastNameError.style.color = 'red';
            lastNameError.textContent = 'Last Name is required.';
            document.getElementById('last-name').after(lastNameError);
        }

        // Validate Email Address
        if (emailAddress === '') {
            isValid = false;
            var emailError = document.createElement('span');
            emailError.className = 'error-message';
            emailError.style.color = 'red';
            emailError.textContent = 'Email Address is required.';
            document.getElementById('email-address').after(emailError);
        } else if (!isValidEmail(emailAddress)) {
            isValid = false;
            var emailFormatError = document.createElement('span');
            emailFormatError.className = 'error-message';
            emailFormatError.style.color = 'red';
            emailFormatError.textContent = 'Enter a valid Email Address.';
            document.getElementById('email-address').after(emailFormatError);
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });

    // Function to validate email address format
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
