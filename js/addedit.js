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
const primaryUpload = document.getElementById(`fileUpload`);
const primaryPreview1 = document.getElementById(`previewImage1`);
const primaryIcon1 = document.getElementById(`icon1`);

primaryUpload.addEventListener("change", function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.addEventListener("load", function() {
            primaryPreview1.style.display = "block";
            primaryPreview1.setAttribute("src", this.result);
            primaryIcon1.style.display = "none";
        });
        reader.readAsDataURL(file);
    } else {
        primaryPreview1.style.display = "none";
        primaryPreview1.setAttribute("src", "#");
        primaryIcon1.style.display = "block";
    }
});
function showTypeFields() {
  var type = document.getElementById("type").value;
  var pagesField = document.getElementById("pagesField");
  var durationField = document.getElementById("durationField");

  // hide all fields by default
  pagesField.style.display = "none";
  durationField.style.display = "none";

  // show fields based on selected type
  if (type == "Book") {
    pagesField.style.display = "block";
  } else if (type == "DVD") {
    durationField.style.display = "block";
  }
}
form.addEventListener("submit", (e) => {
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
  }else {
    setSuccess(nickname);
    arr.push(true);
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
  if(arr.length === 11) {
    // all fields are filled
    // submit the form or redirect to another page
    window.location.href = 'index.html'; // redirect to success page
    // form.submit(); // submit the form
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





