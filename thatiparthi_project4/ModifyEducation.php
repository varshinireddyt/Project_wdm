<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button{
background-size: 200% auto;
    padding: 0px 35px;
    color: #222222;
    background: linear-gradient(to right,#3fcaff 0%,#a4ffb0 51%,#3fcaff)
}
button:hover {
    color: #222222;
}
/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}
/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>

<body>
<center>
<h2>MODIFY Education</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">INSERT</button>
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">UPDATE</button>
<button onclick="document.getElementById('id03').style.display='block'" style="width:auto;">DELETE</button>
</center>
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="ModifyEducation.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <h2> Please Enter inputs to add education </h2>

    <div class="container">
      <label for="uname"><b>Start Month</b></label>
      <input type="text" placeholder="Enter start month" name="monthone" required>

      <label for="text"><b>End Month</b></label>
      <input type="text" placeholder="Enter end month" name="monthtwo" required>

      <label for="text"><b>Year</b></label>
      <input type="text" placeholder="Enter Year" name="year" required>

      <label for="text"><b>Qualification</b></label>
      <input type="text" placeholder="Enter Qualification" name="qualification" required>

      <label for="text"><b>Qualification heading</b></label>
      <input type="text" placeholder="Enter heading" name="heading" required>
      
      <label for="text"><b>University</b></label>
      <input type="text" placeholder="enter university" name="university" required>
        
      <button type="submit" name="inserteducation">Insert</button>
      
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<div id="id02" class="modal">
  
  <form class="modal-content animate" action="ModifyEducation.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <center><h2> Update Education </h2> </center>

    <div class="container">
      <label for="uname"><b>Enter Education Number</b></label>
      <input type="text" placeholder="Enter education number" name="educationenumber" required pattern="[0-9]{1}">

      <label for="uname"><b>Select Input</b></label>
      <input type="text" name="inputeducation" list="cityname" required>
          <datalist id="cityname">
              <option value="monthone">
              <option value="monthtwo">
              <option value="year">
              <option value="qualification">
              <option value="heading"> 
              <option value="university">
          </datalist>
       <label for="uname"><b> Enter New Value</b></label>
      <input type="text" placeholder="Type New Value" name="newinputedu" required>         

      <button type="submit" name="updateexperience">Update</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<div id="id03" class="modal">
  
  <form class="modal-content animate" action="ModifyEducation.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <center><h2> Delete Education</h2> </center>

    <div class="container">
      <label for="uname"><b>Enter Education number to delete</b></label>
      <input type="text" placeholder="Enter education number" name="educationnumber" required pattern="[0-9]{1}">


      <button type="submit" name="deleteeducation">Delete</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id03');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

        <a href="AdminSkills.php"><button type="submit" value="submit" class="showall">Back</button></a>
</body>
</html>

