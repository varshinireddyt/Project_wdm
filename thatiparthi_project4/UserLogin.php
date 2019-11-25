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
                             <a class="active" href="Login.html">LOG IN</a>
                             <a href="Signup.html">SIGN UP</a>
                         </div>
            </header>
        <div class="wrapper">
                		
		    <form method="post" action="UserLogin.php">
            <?php include('errors.php'); ?>
                    <div class="container-log">
                           
                            <label for="username"><b><span style="color:white">Username</span></b></label>
                            <input type="text" placeholder="Enter Username" name="username" required pattern="[a-zA-Z]{3,}" title="Enter valid username">
                        
                            <label for="password"><b><span style="color:white">Password</span></b></label>
                            <input type="password" placeholder="Enter Password" name="password" required pattern="[a-zA-Z]{3,}" title="Enter valid Password">
                        
                            <button class="log" type="submit" name="login_user" id="login_user" onclick="validateLogin()">Login</button>
                            <label>
                              <input type="checkbox" checked="checked" name="remember"><span style="color:white">Remember Me </span>
                            </label>
                        </form>
                          </div>
            
           
            </div>
            <footer>
           
                <div class="bottomnav">
                     
                         <a  href="HomePage.php">HOME</a>
                         <a href="MySkills.php">MY SKILLS</a>
                         <a href="Recommendations.php">RECOMMENDATIONS</a>
                         <a href="Works.php">WORKS</a>
                         <a href="http://varshinithatiparthi.uta.cloud/blog/">BLOG</a>
                         <a href="HireMe.php">HIRE ME</a>
                         <a href="ContactForm.php">CONTACT</a>
                         <a class="active" href="Login.html">LOG IN</a>
                         <a href="Signup.html">SIGN UP</a>
                     </div>
         </footer>  
          
           
    </body>
   
    </html>