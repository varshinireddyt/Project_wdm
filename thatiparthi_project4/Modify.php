<?php include('server.php');
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
  echo "<script type=\"text/javascript\">alert('Please login');";
  echo "window.location.href = 'HomePage.php';</script>";
}?>
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
<h2>MODIFY HIRE-ME PAGE</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">INSERT</button>
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">UPDATE</button>
<button onclick="document.getElementById('id03').style.display='block'" style="width:auto;">DELETE</button>
</center>
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="Modify.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <h2> Please Enter inputs to add cart </h2>

    <div class="container">
      <input type="file" name="foto"><br>
      <label for="uname"><b>Rate</b></label>
      <input type="text" placeholder="Enter Rate" name="rate" required>

      <label for="text"><b>Input-1</b></label>
      <input type="text" placeholder="Enter Input-1" name="input1" required>

      <label for="text"><b>Input-2</b></label>
      <input type="text" placeholder="Enter Input-2" name="input2" required>

      <label for="text"><b>Input-3</b></label>
      <input type="text" placeholder="Enter Input-3" name="input3" required>

      <label for="text"><b>Input-4</b></label>
      <input type="text" placeholder="Enter Input-4" name="input4" required>
        
      <button type="submit" name="insert">Insert</button>
      
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
  
  <form class="modal-content animate" action="Modify.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <center><h2> Update the cart values </h2> </center>

    <div class="container">
      <label for="uname"><b>Enter Cart number</b></label>
      <input type="text" placeholder="Enter cart number" name="cartnumber" required pattern="[0-9]{1}">

      <label for="uname"><b>Select Input</b></label>
      <input type="text" name="input" list="cityname" required>
          <datalist id="cityname">
              <option value="rate">
              <option value="input1">
              <option value="input2">
              <option value="input3">
              <option value="input4"> 
          </datalist>
       <label for="uname"><b> Enter New Value</b></label>
      <input type="text" placeholder="Type New Value" name="newvalue" required>         

      <button type="submit" name="update">Update</button>
      
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
  
  <form class="modal-content animate" action="Modify.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <center><h2> Delete the cart</h2> </center>

    <div class="container">
      <label for="uname"><b>Enter Cart number to delete</b></label>
      <input type="text" placeholder="Enter cart number" name="cartnumber" required pattern="[0-9]{1}">


      <button type="submit" name="delete">Delete</button>
      
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

        <a href="AdminHire.php"><button type="submit" value="submit" class="showall">Back</button></a>
</body>
</html>

