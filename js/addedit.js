const addform = document.getElementById('addform');
const addfileUpload = document.getElementById('addfileUpload');
const addtitle = document.getElementById('addtitle');
const addauthorname = document.getElementById('addauthorname');
const addtype = document.getElementById('addtype');
const addpages = document.getElementById('addpages');
const addduration = document.getElementById('addduration');
const addeditiondate = document.getElementById('addeditiondate');
const addbuydate = document.getElementById('addbuydate');
const addstate = document.getElementById('addstate');
const addprimaryUpload = document.getElementById(`addfileUpload`);
const addprimaryPreview1 = document.getElementById(`addpreviewImage1`);
const addprimaryIcon1 = document.getElementById(`addicon1`);
const editform = document.getElementById('editform');
const editfileUpload = document.getElementById('editfileUpload');
const edittitle = document.getElementById('edittitle');
const editauthorname = document.getElementById('editauthorname');
const edittype = document.getElementById('edittype');
const editpages = document.getElementById('editpages');
const editduration = document.getElementById('editduration');
const editeditiondate = document.getElementById('editeditiondate');
const editbuydate = document.getElementById('editbuydate');
const editstate = document.getElementById('editstate');
const editprimaryUpload = document.getElementById(`editfileUpload`);
const editprimaryPreview1 = document.getElementById(`editpreviewImage1`);
const editprimaryIcon1 = document.getElementById(`editicon1`);

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
function showTypeFields() {
var addtype = document.getElementById("addtype").value;
var addpagesField = document.getElementById("addpagesField");
var adddurationField = document.getElementById("adddurationField");

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
editform.addEventListener("submit", (e) => {
  e.preventDefault();
  validateInput1();
}); 
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
editprimaryUpload.addEventListener("change", function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.addEventListener("load", function() {
            editprimaryPreview1.style.display = "block";
            editprimaryPreview1.setAttribute("src", this.result);
            editprimaryIcon1.style.display = "none";
        });
        reader.readAsDataURL(file);
    } else {
        editprimaryPreview1.style.display = "none";
        editprimaryPreview1.setAttribute("src", "#");
        editprimaryIcon1.style.display = "block";
    }
});
function showTypeFields1() {
  var edittype = document.getElementById("edittype").value;
  var editpagesField = document.getElementById("editpagesField");
  var editdurationField = document.getElementById("editdurationField");

  // hide all fields by default
  editpagesField.style.display = "none";
  editdurationField.style.display = "none";

  // show fields based on selected edittype
  if (edittype == "Book" || edittype == "Novel" || edittype == "Research paper/thesis" || edittype == "Magazine") {
    editpagesField.style.display = "block";
  } else if (edittype == "DVD" ) {
    editdurationField.style.display = "block";
  }
}
 
function validateInput1() {
  const editfileUploadValue = editfileUpload.value.trim();
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
  if(arr.length === 8) {
    // all fields are filled
    // submit the form or redirect to another page
    editform.submit(); // submit the form
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


