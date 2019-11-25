<?php include 'server.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <link rel="stylesheet" type="text/css" href="portfolio.css">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" media="screen and (min-width: 900px)" type="text/css" href="portfolio.css">
        <link rel="stylesheet" media='screen and (max-width: 600px)' href="Phone.css"/>
          <link rel="stylesheet" media="screen and (min-width: 900px)" type="text/css" href="form.css">
          <script type="text/javascript" src="validation.js"></script>
        <title>Contact</title>
        <style>
                @import url('https://fonts.googleapis.com/css?family=Rajdhani&display=swap');
        </style>
    </head>
    <body class="mySkills">
   
            <header>
                    <div class="topnav">
                            <div class="logo"> <img src="proyecto2/logo2.png"> </div>
                             <a href="UserHome.php">HOME</a>
                             <a href="Myskills.php">MY SKILLS</a>
                             <a href="Recommendations.php">RECOMMENDATIONS</a>
                             <a href="Works.php">WORKS</a>
                             <a href="http://varshinithatiparthi.uta.cloud/blog/">BLOG</a>
                             <a href="HireMe.php">HIRE ME</a>
                              
                      <a href="Logout.php">LOGOUT</a>
                   
                            
                         </div>
            </header>
        <div class="wrapper">
             <form method="post" action="ContactForm.php"> 
                    <div class="container">
                            <h1><span style="color:white">Have a project you would like to discuss?</span></h1>
                            <hr>
                            <label for="name"><b><span style="color:white">Name</span></b></label>
                            <input type="text" placeholder="Enter Username" name="name" requied pattern= "[a-zA-Z]{3,}">
                            <label for="email"><b><span style="color:white">Email</span></b></label>
                            <input type="text" placeholder="Enter Email" name="email"  title="Enter valid email" required pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                        
                            <label for="message"><b><span style="color:white">Message</span></b></label>
                            <textarea name="msg"></textarea>

                        
                            <div class="clearfix"></div>
                              <button class="log" type="submit" name="send_message_btn" onclick="validateContact()">SEND</button>
                            </div>      
                        </div>
            </form>
        </div>
       
        <footer>
           
            <div class="bottomnav">
                 
                     <a href="UserHome.php">HOME</a>
                     <a href="MySkills.php">MY SKILLS</a>
                     <a href="Recommendations.php">RECOMMENDATIONS</a>
                     <a href="Works.php">WORKS</a>
                     <a href="http://varshinithatiparthi.uta.cloud/blog/">BLOG</a>
                     <a href="HireMe.php">HIRE ME</a>
                     <a class="active" href="ContactForm.php">CONTACT</a>
                      
                      <a href="Logout.php">LOGOUT</a>
                   
          
                 </div>
     </footer>  
     <?php ?>
    </body>
</html>