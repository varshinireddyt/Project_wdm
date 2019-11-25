<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <link rel="stylesheet" type="text/css" href="portfolio.css">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" media="screen and (min-width: 900px)" type="text/css" href="portfolio.css">
        <link rel="stylesheet" media='screen and (max-width: 600px)' href="Phone.css"/>
        <link rel="stylesheet" media="screen and (min-width: 900px)" type="text/css" href="form.css">
          
    	<script type="text/javascript" src="validation.js"></script>
        <title>LOGIN</title>
        <style>
                @import url('https://fonts.googleapis.com/css?family=Rajdhani&display=swap');
        </style>
    </head>
    <body class="mySkills">
   
            <header>
                    <div class="topnav">
                            <div class="logo"> <img src="proyecto2/logo2.png"> </div>
                             <a href="HomePage.php">HOME</a>
                             <a href="Myskills.php">MY SKILLS</a>
                             <a href="Recommendations.php">RECOMMENDATIONS</a>
                             <a href="Works.php">WORKS</a>
                             <a href="http://varshinithatiparthi.uta.cloud/blog/">BLOG</a>
                             <a href="HireMe.php">HIRE ME</a>
                             <a href="Login.html">LOG IN</a>
                             <a class="active" href="Signup.html">SIGN UP</a>
                         </div>
            </header>
        <div class="wrapper">
            <form method="post" action="UserSignup.php">
         <?php include('errors.php'); ?>
                    <div class="container">
                            <h1><span style="color:white">Sign Up</span></h1>
                            <p><span style="color:white">Please fill in this form to create an account.</span></p>
                            <hr>
                            <label for="username"><b><span style="color:white">Username</span></b></label>
                            <input type="text" placeholder="Enter Username" name="username" required pattern="[a-zA-Z]{3,}" value="<?php echo $username; ?>">
                            <label for="email"><b><span style="color:white">Email</span></b></label>
                            <input type="text" placeholder="Enter Email" name="email"  title="Enter valid email" required pattern= "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $email; ?>">
                        
                            <label for="psw"><b><span style="color:white">Password</span></b></label>
                            <input type="password" placeholder="Enter Password" name="password" required pattern="[a-zA-Z]{3,}">
                        
                            <label for="psw-repeat"><b><span style="color:white">Confirm Password</span></b></label>
                            <input type="password" placeholder="Confirm Password" name="passwordrepeat"  title="Enter valid password" required pattern="[a-zA-Z]{3,}">
                        
                            <label>
                              <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"><span style="color:white"> Remember me </span>
                            </label>
                        
                            <p>By creating an account you agree to our <a href="#" style="color:dodgerblue"><span style="color:white">Terms & Privacy</span></a>.</p>
                        
                            <div class="clearfix">
                              <button class="log" type="button" class="cancelbtn">Cancel</button>
                              <button class="log" type="submit" name="submit" value= "submit" class="signupbtn" onclick="validateSignup()">Sign Up</button>
                            </div>
                            <p>
  		                        Already a member? <a href="UserLogin.php">Sign in</a>
  	                        </p>
                        </div>
            </form>
        </div>
        <!-- <footer>
                <!-- <p class="footer-p">Copyright &copy; 2019 All rights reserved!
                </p>
        </footer> -->
        <footer>
           
            <div class="bottomnav">
                 
                     <a href="HomePage.php">HOME</a>
                     <a href="Myskills.php">MY SKILLS</a>
                     <a href="Recommendations.php">RECOMMENDATIONS</a>
                     <a href="Works.php">WORKS</a>
                     <a href="http://varshinithatiparthi.uta.cloud/blog/">BLOG</a>
                     <a href="HireMe.php">HIRE ME</a>
                     <a href="ContactForm.php">CONTACT</a>
                     <a href="Login.html">LOG IN</a>
                     <a class="active" href="Signup.html">SIGN UP</a>
                 </div>
     </footer>  
     <?php ?>
    </body>
</html>