document.addEventListener('DOMContentLoaded', function() {
    var biodataForm = document.getElementById('biodataForm');
    biodataForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah pengiriman form
        validateForm();
    });
    
    var inputElements = document.querySelectorAll('input, select, textarea');
    inputElements.forEach(function(inputElement) {
        inputElement.addEventListener('input', function() {
            resetValidation(inputElement);
        });
    });
    
    function validateForm() {
        var isValid = true;
        inputElements.forEach(function(inputElement) {
            if (!inputElement.checkValidity()) {
                isValid = false;
                displayValidationError(inputElement);
            }
        });
        if (isValid) {
            // Mengirim formulir secara otomatis jika validasi berhasil
            biodataForm.submit();
        }
    }
    
    function displayValidationError(inputElement) {
        var errorDiv = inputElement.nextElementSibling;
        errorDiv.textContent = inputElement.validationMessage;
        errorDiv.style.display = 'block';
    }
    
    function resetValidation(inputElement) {
        var errorDiv = inputElement.nextElementSibling;
        errorDiv.textContent = '';
        errorDiv.style.display = 'none';
    }
});

