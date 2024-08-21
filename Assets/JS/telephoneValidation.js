function validateForm() {
    const telephone = document.getElementById('telephone').value;
    const telephonePattern = /^\d{10}$/;

    if (!telephonePattern.test(telephone)) {
        document.getElementById('telephone-error').innerText = "Please enter a valid 10-digit telephone number.";
        return false;
    }

    return true;
}

function validateTelephoneInput(event) {
    const input = event.target.value;
    const errorElement = document.getElementById('telephone-error');

    if (!/^\d*$/.test(input)) {
        errorElement.innerText = "Invalid character. Only digits are allowed.";
    } else if (input.length > 10) {
        errorElement.innerText = "Telephone number cannot exceed 10 digits.";
    } else {
        errorElement.innerText = ""; // Clear the error message
    }

    // Prevent entering more than 10 digits
    if (input.length > 10) {
        event.target.value = input.slice(0, 10);
    }
}