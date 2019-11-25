<?php
session_start();

 
           $servername = "localhost:3306";
           $database = "varshini_Project4";
           $username = "varshini_user";
           $password = "varshinithatiparthi";
           $errors = array();
    
			// Create connection
			$db = mysqli_connect($servername, $username, $password, $database);
		
			// Check connection
			if (!$db) {
			    die("Connection failed: " . mysqli_connect_error());
			}

//Download file
if (isset($_POST['download'])) {
    // $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM files ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($db, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $file['name']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $id = $file['id'];
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id ";
        mysqli_query($db, $updateQuery);
        exit;
    }

}

// REGISTER USER
if (isset($_POST['submit'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $passwordrepeat = mysqli_real_escape_string($db, $_POST['passwordrepeat']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if ($password != $passwordrepeat) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($username) { // if user exists
    if ($username['username'] === $user) {
      array_push($errors, "Username already exists");
    }

    if ($username['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	 header('location: UserLogin.php');
  }
}
// //Register user for users
if (isset($_POST['adminsubmit'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password= mysqli_real_escape_string($db, $_POST['password']);
  $passwordrepeat = mysqli_real_escape_string($db, $_POST['passwordrepeat']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if ($password!= $passwordrepeat) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM admin WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($username) { // if user exists
    if ($username['username'] === $user) {
      array_push($errors, "Username already exists");
    }

    if ($username['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO admin (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	 header('location: Adminlogin.php');
  }
}
//Login admin

    if (isset($_POST['loginadmin'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: AdminHome.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}



//Login user

    if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: UserHome.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
//upload
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO files (name, size, downloads) VALUES ('$filename', $size, 0)";
            if (mysqli_query($db, $sql)) {
                echo "File uploaded successfully";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}
//Contact form
if (isset($_POST['send_message_btn'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
//   $subject = $_POST['subject'];
  $msg = $_POST['msg'];
  // Content-Type helps email client to parse file as HTML 
  // therefore retaining styles
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $message = "<html>
  <head>
  	<title>New message from website contact form</title>
  </head>
  <body>
  	<h1>" . $name . "</h1>
  	<h4>" . $email . "</h4>
  	<p>".$msg."</p>
  </body>
  </html>";
  if (mail('varshini.thatiparthi@mavs.uta.edu', $subject, $message, $headers)) {
   echo "Email sent";
  }else{
   echo "Failed to send email. Please try again later";
  }
}
if (isset($_POST['insert'])) { // if insert button on the form is clicked
    // name of the uploaded file
    $file_get = $_FILES['foto']['name'];
    $temp = $_FILES['foto']['tmp_name'];
    $rate = mysqli_real_escape_string($db, $_POST['rate']);
    $input1 = mysqli_real_escape_string($db, $_POST['input1']);
    $input2 = mysqli_real_escape_string($db, $_POST['input2']);
    $input3= mysqli_real_escape_string($db, $_POST['input3']);
    $input4 = mysqli_real_escape_string($db, $_POST['input4']);
    $file_to_saved = "uploads/".$file_get;
    move_uploaded_file($temp, $file_to_saved);
    $query = "INSERT INTO hire (name, rate, input1, input2, input3, input4) 
          VALUES('$file_get', '$rate','$input1', '$input2', '$input3', '$input4')";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Inserted Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Insertion failed, try again');</script>";
            }
}
if (isset($_POST['update'])) { // if update button on the form is clicked
    // receiving inputs from the form
    $cartnumber = mysqli_real_escape_string($db, $_POST['cartnumber']);
    $input = mysqli_real_escape_string($db, $_POST['input']);
    $newvalue = mysqli_real_escape_string($db, $_POST['newvalue']);
    $query = "UPDATE hire SET $input = '$newvalue' WHERE id = $cartnumber";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Updated Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Updation failed, try again');</script>";
            }
}
if (isset($_POST['delete'])) { // if delete button on the form is clicked
    // receiving inputs from the form
    $cartnumber = mysqli_real_escape_string($db, $_POST['cartnumber']);
    $query = "DELETE FROM hire WHERE id = $cartnumber";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Deleted Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Deletion failed, try again');</script>";
            }
}

if (isset($_POST['insertexperience'])) { // if insert button on the form is clicked
    $month = mysqli_real_escape_string($db, $_POST['month']);
    $year = mysqli_real_escape_string($db, $_POST['year']);
    $company = mysqli_real_escape_string($db, $_POST['company']);
    $role= mysqli_real_escape_string($db, $_POST['role']);
    $retyperole = mysqli_real_escape_string($db, $_POST['retyperole']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $query = "INSERT INTO experience (month, year, company, role, retyperole, description) 
          VALUES('$month', '$year','$company', '$role', '$retyperole', '$description')";
          echo "inserted";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Inserted Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Insertion failed, try again');</script>";
            }
}
if (isset($_POST['updateexperience'])) { // if update button on the form is clicked
    // receiving inputs from the form
    $experiencenumber = mysqli_real_escape_string($db, $_POST['experiencenumber']);
    $input = mysqli_real_escape_string($db, $_POST['inputexp']);
    $newvalue = mysqli_real_escape_string($db, $_POST['newinput']);
    $query = "UPDATE experience SET $input = '$newvalue' WHERE id = $experiencenumber";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Updated Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Updation failed, try again');</script>";
            }
}
if (isset($_POST['deleteexperience'])) { // if delete button on the form is clicked
    // receiving inputs from the form
    $experiencenumber = mysqli_real_escape_string($db, $_POST['experiencenumber']);
    $query = "DELETE FROM experience WHERE id = $experiencenumber";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Deleted Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Deletion failed, try again');</script>";
            }
}

//Education 
if (isset($_POST['inserteducation'])) { // if insert button on the form is clicked
    $monthone = mysqli_real_escape_string($db, $_POST['monthone']);
    $monthtwo = mysqli_real_escape_string($db, $_POST['monthtwo']);
    $year = mysqli_real_escape_string($db, $_POST['year']);
    $qualification = mysqli_real_escape_string($db, $_POST['qualification']);
    $heading= mysqli_real_escape_string($db, $_POST['heading']);
    $university = mysqli_real_escape_string($db, $_POST['university']);
    $query = "INSERT INTO education (monthone, monthtwo, year, qualification, heading, university) 
          VALUES('$monthone', '$monthtwo', '$year','$qualification', '$heading', '$university')";
          echo "inserted";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Inserted Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Insertion failed, try again');</script>";
            }
}
if (isset($_POST['updateeducation'])) { // if update button on the form is clicked
    // receiving inputs from the form
    $educationnumber = mysqli_real_escape_string($db, $_POST['educationnumber']);
    $input = mysqli_real_escape_string($db, $_POST['inputeducation']);
    $newvalue = mysqli_real_escape_string($db, $_POST['newinputedu']);
    $query = "UPDATE education SET $input = '$newvalue' WHERE id = $educationnumber";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Updated Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Updation failed, try again');</script>";
            }
}
if (isset($_POST['deleteeducation'])) { // if delete button on the form is clicked
    // receiving inputs from the form
    $educationnumber = mysqli_real_escape_string($db, $_POST['experiencenumber']);
    $query = "DELETE FROM education WHERE id = $educationnumber";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Deleted Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Deletion failed, try again');</script>";
            }
}
// Modify Work
if (isset($_POST['insertwork'])) { // if insert button on the form is clicked
    // name of the uploaded file
    $file_get = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];
    $input1 = mysqli_real_escape_string($db, $_POST['input1']);
    $input2 = mysqli_real_escape_string($db, $_POST['input2']);
    $file_to_saved = "uploads/".$file_get;
    move_uploaded_file($temp, $file_to_saved);
    $query = "INSERT INTO work (image, input1, input2) 
          VALUES('$file_get','$input1', '$input2')";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Inserted Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Insertion failed, try again');</script>";
            }
}
if (isset($_POST['updatework'])) { // if update button on the form is clicked
    // receiving inputs from the form
    $worknumber = mysqli_real_escape_string($db, $_POST['worknumber']);
    $inputwork = mysqli_real_escape_string($db, $_POST['inputwork']);
    $newinputwork = mysqli_real_escape_string($db, $_POST['newinputwork']);
    $query = "UPDATE work SET $inputwork = '$newinputwork' WHERE id = $worknumber";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Updated Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Updation failed, try again');</script>";
            }
}
if (isset($_POST['deletework'])) { // if delete button on the form is clicked
    // receiving inputs from the form
    $worknumber = mysqli_real_escape_string($db, $_POST['worknumber']);
    $query = "DELETE FROM work WHERE id = $worknumber";
    
    if (mysqli_query($db, $query)) {
                echo "<script type=\"text/javascript\">alert('Deleted Successfully!');</script>";
            }
            else{
                echo"<script type=\"text/javascript\">alert('Deletion failed, try again');</script>";
            }
}

if(isset($_POST['showall']) ){
   
    $query = "SELECT * FROM work";
    $result = mysqli_query($db, $query);
    echo'show';
while($row = $result->fetch_assoc()) {
    

   echo ' <div class="imgrow">
     <div class="img-col-1">
        <img src = "uploads/'.$row['image'].' "alt="" width = 150 height ="200", '.$row[2].'>
        <div class="imgborder"></div>
        <h4>'.$row['input1'].'</h4>
        <h6>'.$row['input2'].'</h6>
         </div>
        </div>';
}
}
if(isset($_POST['website'])) {
    $query = "SELECT * FROM work WHERE input2 = 'Websites'";
    $result = mysqli_query($db, $query);

while($row = $result->fetch_assoc()) {
    

   echo ' <div class="imgrow">
     <div class="img-col-1">
        <img src = "uploads/'.$row['image'].' "alt="" width = 150 height ="200", '.$row[2].'>
        <div class="imgborder"></div>
        <h4>'.$row['input1'].'</h4>
        <h6>'.$row['input2'].'</h6>
         </div>
        </div>';
}
}
if(isset($_POST['apps'])) {
    $query = "SELECT * FROM work WHERE input2 = 'Apps'";
    $result = mysqli_query($db, $query);

while($row = $result->fetch_assoc()) {
    

   echo ' <div class="imgrow">
     <div class="img-col-1">
        <img src = "uploads/'.$row['image'].' "alt="" width = 150 height ="200", '.$row[2].'>
        <div class="imgborder"></div>
        <h4>'.$row['input1'].'</h4>
        <h6>'.$row['input2'].'</h6>
         </div>
        </div>';
}
}
if(isset($_POST['blender'])) {
    $query = "SELECT * FROM work WHERE input2 = 'Blender'";
    $result = mysqli_query($db, $query);

while($row = $result->fetch_assoc()) {
    

   echo ' <div class="imgrow">
     <div class="img-col-1">
        <img src = "uploads/'.$row['image'].' "alt="" width = 150 height ="200", '.$row[2].'>
        <div class="imgborder"></div>
        <h4>'.$row['input1'].'</h4>
        <h6>'.$row['input2'].'</h6>
         </div>
        </div>';
}
}
if(isset($_POST['photography'])) {
    $query = "SELECT * FROM work WHERE input2 = 'Photography'";
    $result = mysqli_query($db, $query);

while($row = $result->fetch_assoc()) {
    

   echo ' <div class="imgrow">
     <div class="img-col-1">
        <img src = "uploads/'.$row['image'].' "alt="" width = 150 height ="200", '.$row[2].'>
        <div class="imgborder"></div>
        <h4>'.$row['input1'].'</h4>
        <h6>'.$row['input2'].'</h6>
         </div>
        </div>';
}
}
if(isset($_POST['design'])) {
    $query = "SELECT * FROM work WHERE input2 = 'Design'";
    $result = mysqli_query($db, $query);

while($row = $result->fetch_assoc()) {
    

   echo ' <div class="imgrow">
     <div class="img-col-1">
        <img src = "uploads/'.$row['image'].' "alt="" width = 150 height ="200", '.$row[2].'>
        <div class="imgborder"></div>
        <h4>'.$row['input1'].'</h4>
        <h6>'.$row['input2'].'</h6>
         </div>
        </div>';
}
}
?>





