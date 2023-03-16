const form = document.getElementById('form');
const nickname = document.getElementById('nickname');
const password = document.getElementById('password');
const submitBtn = document.getElementById('submit-btn');
submitBtn.addEventListener('click', (e) => {
  e.preventDefault();
  validateInput();
}); 
  function validateInput() {
    const nicknameValue = nickname.value.trim();
    const passwordValue = password.value.trim();
  
    let arr = [];
    if(nicknameValue === '') {
        setError(nickname, 'Nickname cannot be blank');
      } else {
        setSuccess(nickname);
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
      if(arr.length === 2) {
        form.submit(); // submit the form
      }
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
          