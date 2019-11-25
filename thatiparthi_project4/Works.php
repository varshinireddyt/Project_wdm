<?php include 'server.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
  echo "<script type=\"text/javascript\">alert('Please login');";
  echo "window.location.href = 'HomePage.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <link rel="stylesheet" type="text/css" href="portfolio.css">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" media="screen and (min-width: 900px)" type="text/css" href="portfolio.css">
        <link rel="stylesheet" media='screen and (max-width: 600px)' href="css/phone.css"/>
        <title>WORKS</title>
        <style>
                @import url('https://fonts.googleapis.com/css?family=Rajdhani&display=swap');
        </style>
         
    </head>
  
        <header>
            <div class="topnav">
               <div class="logo"> <img src="proyecto2/logo2.png"> </div>
                <a href="UserHome.php">HOME</a>
                <a href="Myskills.php">MY SKILLS</a>
                <a href="Recommendations.php">RECOMMENDATIONS</a>
                <a class="active" href="Works.php">WORKS</a>
                <a href="http://varshinithatiparthi.uta.cloud/blog">BLOG</a>
                <a href="HireMe.php">HIRE ME</a>
                 
                                <a href="Logout.php">LOGOUT</a>
                             
            </div>
        </header>
 <body class="mySkills">
        <div class=wrapper>
                
            <div class="work-heading1">
                <h1>MY LATEST WORK</h1> </div>
                <p class="workheading-p">I'm looking to expand my portfolio while I'm on top and while I'm young Luis M Alvarez <br> brings your context to 
                    life in stunning daily</p>
           
            <div class="workbutton">
            <button class="showall">SHOW ALL</button>
            <button class="website">WEBSITES</button>
            <button class="apps">APPS</button>
            <button class="design">DESIGN</button>
            <button class="photography">PHOTOGRAPHY</button>
            </div>
          
             <?php
                $query = "SELECT * FROM work";
                $result = mysqli_query($db, $query);
            ?>
          
          

                 <?php while($row = $result->fetch_assoc()) {
                
        
               echo ' <div class="imgrow">
                 <div class="img-col-1">
                    <img src = "uploads/'.$row['image'].' "alt="" width = 150 height ="200", '.$row[2].'>
                    <div class="imgborder"></div>
                    <h4>'.$row['input1'].'</h4>
                    <h6>'.$row['input2'].'</h6>
                     </div>
                    </div>';
            }?>
            
        <footer>
           
                    <div class="bottomnav">
                         
                             <a href="UserHome.php">HOME</a>
                             <a href="Myskills.php">MY SKILLS</a>
                             <a href="Recommendations.php">RECOMMENDATIONS</a>
                             <a class="active" href="Works.php">WORKS</a>
                             <a href="http://varshinithatiparthi.uta.cloud/blog/">BLOG</a>
                             <a href="HireMe.php">HIRE ME</a>
                              <a href="ContactForm.php">CONTACT</a>
                            
                                <a href="Logout.php">LOGOUT</a>
                           
                             
                         </div>
             </footer>  
    </body>
</html>
