const form = document.getElementById('form');
const firstname = document.getElementById('firstname');
const lastname = document.getElementById('lastname');
const nickname = document.getElementById('nickname');
const email = document.getElementById('email');
const phonenumber = document.getElementById('phonenumber');
const address = document.getElementById('address');
const cin = document.getElementById('cin');
const birthdate = document.getElementById('birthdate');
const type = document.getElementById('type');
const password = document.getElementById('password');
const confirmpassword = document.getElementById('confirmpassword');
const submitBtn = document.getElementById('submit-btn');
submitBtn.addEventListener('click', (e) => {
  e.preventDefault();
  validateInput();
}); 
function validateInput() {
  const firstnameValue = firstname.value.trim();
  const lastnameValue = lastname.value.trim();
  const nicknameValue = nickname.value.trim();
  const emailValue = email.value.trim();
  const phonenumberValue = phonenumber.value.trim();
  const cinValue = cin.value.trim(); 
  const addressValue = address.value.trim(); 
  const birthdateValue = new Date(birthdate.value);
  const typeValue = type.value;
  const passwordValue = password.value.trim();
  const confirmpasswordValue = confirmpassword.value.trim();
  let arr = [];
  if(firstnameValue === '') {
    setError(firstname, 'First name cannot be blank');
  }else if(!isValidName(firstnameValue)) {
    setError(firstname, 'First name is not valid');
  }else {
    setSuccess(firstname);
    arr.push(true);
  }
  if(lastnameValue === '') {
    setError(lastname, 'Last name cannot be blank');
  }else if(!isValidName(lastnameValue)) {
    setError(lastname, 'Last name is not valid');
  } else {
    setSuccess(lastname);
    arr.push(true);
  }
  if(nicknameValue === '') {
    setError(nickname, 'Nickname cannot be blank');
  } else if(!isValidNickname(nicknameValue)) {
    setError(nickname, 'Nickname is not valid');
  } else {
    // check if nickname already exists in database
    $.ajax({
      url: '../php/check_nickname.php',
      type: 'POST',
      data: {nickname: nicknameValue},
      success: function(response) {
        if(response === 'exists') {
          setError(nickname, 'Nickname already exists');
        } else {
          setSuccess(nickname);
          arr.push(true);
        }
      }
    });
  }
  if(emailValue === '') {
    setError(email, 'Email cannot be blank');
  } else if(!isValidEmail(emailValue)) {
    setError(email, 'Email is not valid');
  } else {
    setSuccess(email);
    arr.push(true);
  }
  if(phonenumberValue === '') {
    setError(phonenumber, 'Phone number cannot be blank');
  } else if(!isValidPhone(phonenumberValue)) {
    setError(phonenumber, 'Phone number is not valid');
  } else {
    setSuccess(phonenumber);
    arr.push(true);
  }
  if(addressValue === '') {
    setError(address, 'Address cannot be blank');
  } else {
    setSuccess(address);
    arr.push(true);
  }
  if(cinValue === '') {
    setError(cin, 'CIN cannot be blank');
  } else {
    setSuccess(cin);
    arr.push(true);
  }
  if(birthdate.value === '' || birthdateValue > new Date() || birthdateValue > new Date().setFullYear(new Date().getFullYear() - 6)) {
    setError(birthdate, 'Date of birth is invalid');
  } else {
    setSuccess(birthdate);
    arr.push(true)
  }
  if(typeValue === 'Type') {
    setError(type, 'Please select your type');
  } else {
    setSuccess(type);
    arr.push(true);
  }
  if(passwordValue === '') {
    setError(password, 'Password cannot be blank');
  } else if(passwordValue.length < 8) {
    setError(password, 'Password must be at least 8 characters');
  } else {
    setSuccess(password);
    arr.push(true);
  }
  if(confirmpasswordValue === '') {
    setError(confirmpassword, 'Confirm password cannot be blank');
  } else if(passwordValue !== confirmpasswordValue) {
    setError(confirmpassword, 'Passwords do not match');
  } else {
    setSuccess(confirmpassword);
    arr.push(true);
  }
  if (arr.length === 11) {
    form.submit();
  }
}
function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}
function isValidPhone(phone){
  return /^((\+212)?[ -])?(06|05|07)(\d{1})[ -]?(\d{3})[ -]?(\d{4})+$/.test(phone)
}
function isValidName(name){
  return /^[A-Za-z]+([- ][A-Za-z]+)*$/.test(name)
}
function isValidNickname(nickname){
  return /^[a-zA-Z0-9_]+[a-zA-Z0-9_.-]*$/.test(nickname)
}

function setError(input, message) {
  const formControl = input.parentElement;
  const small = formControl.querySelector('small');
  formControl.classList.remove('success');
  formControl.classList.add('error');
  small.innerText = message;
}
function setSuccess(input) {
  const formControl = input.parentElement;
  const small = formControl.querySelector('small');
  formControl.classList.remove('error');
  formControl.classList.add('success');
  small.innerText = '';
}
