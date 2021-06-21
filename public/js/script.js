
const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const confirmedPassword = form.querySelector('input[name="confirmedPassword"]');

function isEmailCorrect(email) {
    return /\S+@\S+.\S+/.test(email);
}
function arePasswordSame(password, confirmedPassword) {
    return password === confirmedPassword;
}
function markValidation(element, condition){
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateEmail(){
    setTimeout(function (){
        markValidation(emailInput, isEmailCorrect(emailInput.value));
    }, 1000)
}

function validateSamePassword(){
    setTimeout(function (){
        const condition = arePasswordSame(
            confirmedPassword.previousElementSibling.value,
            confirmedPassword.value

        );
        markValidation(confirmedPassword, condition);
    }, 1000)
}

emailInput.addEventListener('keyup', validateEmail);
confirmedPassword.addEventListener('keyup', validateSamePassword);