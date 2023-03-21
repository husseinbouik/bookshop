const addform = document.querySelector('.addform');
const addfileUpload = document.querySelector('.addfileUpload');
const addtitle = document.querySelector('.addtitle');
const addauthorname = document.querySelector('.addauthorname');
const addtype = document.querySelector('.addtype');
const addpages = document.querySelector('.addpages');
const addduration = document.querySelector('.addduration');
const addeditiondate = document.querySelector('.addeditiondate');
const addbuydate = document.querySelector('.addbuydate');
const addstate = document.querySelector('.addstate');
const addprimaryUpload = document.querySelector(`.addfileUpload`);
const addprimaryPreview1 = document.querySelector(`.addpreviewImage1`);
const addprimaryIcon1 = document.querySelector(`.addicon1`);
// const editform = document.querySelector('.editform');
// const edittitle = document.querySelector('.edittitle');
// const editauthorname = document.querySelector('.editauthorname');
// const edittype = document.querySelector('.edittype');
// const editpages = document.querySelector('.editpages');
// const editduration = document.querySelector('.editduration');
// const editeditiondate = document.querySelector('.editeditiondate');
// const editbuydate = document.querySelector('.editbuydate');
// const editstate = document.querySelector('.editstate');
// const editfileUpload = document.querySelector(`.editfileUpload`);





const editforms = document.querySelectorAll('.editform');

editforms.forEach(form => {
  const edittitle = form.querySelector('.edittitle');
  const editauthorname = form.querySelector('.editauthorname');
  const edittype = form.querySelector('.edittype');
  const editpages = form.querySelector('.editpages');
  const editduration = form.querySelector('.editduration');
  const editeditiondate = form.querySelector('.editeditiondate');
  const editbuydate = form.querySelector('.editbuydate');
  const editstate = form.querySelector('.editstate');
  const editfileUpload = form.querySelector('.editfileUpload');
  form.addEventListener("submit", (e) => {
  e.preventDefault();
  validateInput1();
}); 
function validateInput1() {
  const editfileUploadValue = editfileUpload.value;
  const edittitleValue = edittitle.value.trim();
  const editauthornameValue = editauthorname.value.trim();
  const edittypeValue = edittype.value.trim();
  const editpagesValue = editpages.value.trim();
  const editdurationValue = editduration.value.trim(); 
  const now = new Date();
  const editstateValue = editstate.value;
  let arr = [];
  if(editfileUploadValue === '') {
    setError(editfileUpload, 'empty input !');
  }else {
    setSuccess(editfileUpload);
    arr.push(true);
  }
  if(edittitleValue === '') {
    setError(edittitle, 'Title cannot be blank');
  } else {
    setSuccess(edittitle);
    arr.push(true);
  }
  if(editauthornameValue === '') {
    setError(editauthorname, 'editauthorname cannot be blank');
  }else {
    setSuccess(editauthorname);
    arr.push(true);
  }
  if (edittypeValue == "Book" || edittypeValue == "Novel" || edittypeValue == "Research paper/thesis" || edittypeValue == "Magazine") {
    if(editpagesValue === '') {
      setError(editpages, 'Pages  cannot be blank');
    } else {
      setSuccess(editpages);
      arr.push(true);
    }} else if (edittypeValue == "DVD" ) {
      if(editdurationValue === '') {
        setError(editduration, 'Address cannot be blank');
      } else {
        setSuccess(editduration);
        arr.push(true);
      }
  }
if (editeditiondate.value === '' || new Date(editeditiondate.value) >= now) {
  setError(editeditiondate, 'Please enter a valid past date');
} else {
  setSuccess(editeditiondate);
  arr.push(true);
}

if (editbuydate.value === '' || new Date(editbuydate.value) >= now) {
  setError(editbuydate, 'Please enter a valid past date');
} else {
  setSuccess(editbuydate);
  arr.push(true);
}

  if(edittypeValue === 'Type') {
    setError(edittype, 'Please select your edittype');
  } else {
    setSuccess(edittype);
    arr.push(true);
  }
  if(editstateValue === 'Choose') {
    setError(editstate, 'Please choose a editstate');
  } else {
    setSuccess(editstate);
    arr.push(true);
  }
  if(arr.length === 9) {
    // all fields are filled
    // submit the form or redirect to another page
    form.submit(); // submit the form
  }
}
// Primary image upload
const primaryUpload = form.querySelector(".editfileUpload");
const primaryPreview = form.querySelector(".editpreviewImage1");
const primaryIcon = form.querySelector(".editicon1");
primaryUpload.addEventListener("change", function() {
  const file = this.files[0];
  if (file) {
      const reader = new FileReader();
      reader.addEventListener("load", function() {
          primaryPreview.style.display = "block";
          primaryPreview.setAttribute("src", this.result);
          primaryIcon.style.display = "none";
      });
      reader.readAsDataURL(file);
  } else {
      primaryPreview.style.display = "none";
      primaryPreview.setAttribute("src", "#");
      primaryIcon.style.display = "block";
  }
});
})



// Get the select element
  var select = document.querySelector(".edittype");

  // Get the input fields
  var pagesField = document.querySelector(".editpagesField");
  var durationField = document.querySelector(".editdurationField");

  // Show the appropriate input field based on the selected option
  if (select.value === "DVD") {
    pagesField.style.display = "none";
    durationField.style.display = "block";
  } else {
    pagesField.style.display = "block";
    durationField.style.display = "none";
  }

  // Listen for changes to the select element
  select.addEventListener("change", function() {
    if (select.value === "DVD") {
      pagesField.style.display = "none";
      durationField.style.display = "block";
    } else {
      pagesField.style.display = "block";
      durationField.style.display = "none";
    }
  });
addprimaryUpload.addEventListener("change", function() {
  const file = this.files[0];
  if (file) {
      const reader = new FileReader();
      reader.addEventListener("load", function() {
          addprimaryPreview1.style.display = "block";
          addprimaryPreview1.setAttribute("src", this.result);
          addprimaryIcon1.style.display = "none";
      });
      reader.readAsDataURL(file);
  } else {
      addprimaryPreview1.style.display = "none";
      addprimaryPreview1.setAttribute("src", "#");
      addprimaryIcon1.style.display = "block";
  }
});
function showTypeFields(){
var addtype = document.querySelector(".addtype").value;
var addpagesField = document.querySelector(".addpagesField");
var adddurationField = document.querySelector(".adddurationField");

// hide all fields by default
addpagesField.style.display = "none";
adddurationField.style.display = "none";

// show fields based on selected addtype
if (addtype == "Book" || addtype == "Novel" || addtype == "Research paper/thesis" || addtype == "Magazine") {
  addpagesField.style.display = "block";
} else if (addtype == "DVD" ) {
  adddurationField.style.display = "block";
}
}

addform.addEventListener("submit", (e) => {
e.preventDefault();
validateInput();
});  
function validateInput() {
const addfileUploadValue = addfileUpload.value.trim();
const addtitleValue = addtitle.value.trim();
const addauthornameValue = addauthorname.value.trim();
const addtypeValue = addtype.value.trim();
const addpagesValue = addpages.value.trim();
const adddurationValue = addduration.value.trim(); 
const now = new Date();
const addstateValue = addstate.value;
let arr = [];
if(addfileUploadValue === '') {
  setError(addfileUpload, 'empty input !');
}else {
  setSuccess(addfileUpload);
  arr.push(true);
}
if(addtitleValue === '') {
  setError(addtitle, 'Title cannot be blank');
} else {
  setSuccess(addtitle);
  arr.push(true);
}
if(addauthornameValue === '') {
  setError(addauthorname, 'addauthorname cannot be blank');
}else {
  setSuccess(addauthorname);
  arr.push(true);
}
if (addtypeValue == "Book" || addtypeValue == "Novel" || addtypeValue == "Research paper/thesis" || addtypeValue == "Magazine") {
  if(addpagesValue === '') {
    setError(addpages, 'Pages  cannot be blank');
  } else {
    setSuccess(addpages);
    arr.push(true);
  }} else if (addtypeValue == "DVD" ) {
    if(adddurationValue === '') {
      setError(addduration, 'Address cannot be blank');
    } else {
      setSuccess(addduration);
      arr.push(true);
    }
}
if (addeditiondate.value === '' || new Date(addeditiondate.value) >= now) {
setError(addeditiondate, 'Please enter a valid past date');
} else {
setSuccess(addeditiondate);
arr.push(true);
}

if (addbuydate.value === '' || new Date(addbuydate.value) >= now) {
setError(addbuydate, 'Please enter a valid past date');
} else {
setSuccess(addbuydate);
arr.push(true);
}

if(addtypeValue === 'Type') {
  setError(addtype, 'Please select your addtype');
} else {
  setSuccess(addtype);
  arr.push(true);
}
if(addstateValue === 'Choose') {
  setError(addstate, 'Please choose a addstate');
} else {
  setSuccess(addstate);
  arr.push(true);
}
if(arr.length === 8) {
  // all fields are filled
  // submit the form or redirect to another page
  addform.submit(); // submit the form
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


