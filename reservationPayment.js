
let popup = document.getElementById('popup');

function openPopup() {
    popup.classList.add("open-popup");
}

function closePopup() {
    popup.classList.remove("open-popup");
}

function handleSubmit(event) {
    event.preventDefault(); // Prevent the form from submitting
    openPopup(); // Show the popup
    return false; // Ensure the form doesn't submit
}

function validateForm() {
    let name = document.getElementById('name').value;
    let cardNumber = document.getElementById('cardNumber').value;
    let expMonth = document.getElementById('expMonth').value;
    let cvv = document.getElementById('cvv').value;
    
    let submitBtn = document.getElementById('submitBtn');
    
    if (name && cardNumber && expMonth && cvv) {
        submitBtn.disabled = false;
    } else {
        submitBtn.disabled = true;
    }
}


