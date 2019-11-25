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
        <title>HIRE ME</title>
        <style>
                @import url('https://fonts.googleapis.com/css?family=Rajdhani&display=swap');
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
            <header>
                <div class="topnav">
                   <div class="logo"> <img src="proyecto2/logo2.png"> </div>
                    <a href="AdminHome.php">HOME</a>
                    <a href="AdminSkills.php">MY SKILLS</a>
                    <a href="Recommendations.php">RECOMMENDATIONS</a>
                    <a href="AdminWorks.php">WORKS</a>
                    <a href="http://varshinithatiparthi.uta.cloud/blog/">BLOG</a>
                    <a class="active" href="AdminHire.php">HIRE ME</a>
                     
                                <a href="Logout.php">LOGOUT</a>
                         
                   
                </div>
            </header>
    <body class = "mySkills">
        <div class="wrapper">
           <div class="hireme-heading"> <h1>HIRE ME</h1></div>
           <p class=hireme-p>I'm looking to expand my portfolio while I'm on top and while I'm young Luis M Alvarez <br> brings your context to 
            life in stunning daily</p>
            <?php
                $query = "SELECT * FROM hire";
                $result = mysqli_query($db, $query);
            ?>
            <?php while($row = $result->fetch_assoc()) {
            echo '<div class="hireme-row">
                <div class="hireme-col">
                    <img src="uploads/'.$row['name'].'" alt="" width="300" height="250" class="img-responsive">
                </div>
                <div class=hireme-col-2>
                    <h4>'.$row['rate'].'</h4>
                    <h5>'.$row['input1'].'</h5>
                    <p class="hireme-col-2-p"> &#10003 '.$row['input2'].' <br> &#10003 '.$row['input3'].'<br> &#10003 '.$row['input4'].'</p>
                    <h3>'.$row['input5'].'</h3>
                </div>
                <hr>
            </div>';

            }
        ?>
        <a href="Modify.php"><button type="submit" value="submit" class="showall">Modify</button></a>
        <div class="heading-2">
            <h1>SKIILS & EXPERTISE</h1>
            <p class="heading-2-p">I'm looking to expand my portfolio while I'm on top and while I'm young Luis M Alvarez <br> brings your context to 
                life in stunning daily</p>
        </div>
        <div class="row-skill">
            <div class="col-skill-1">
                <h3>SOFTWARE</h3>
                <p>HTML <br> <meter min="0" max="100" value="80"></meter></p>
                <p>CSS <br> <meter min="0" max="100" value="73"></meter></p>
                <p>Bootstrap <br> <meter min="0" max="100" value="79"></meter></p>
                <p>Blender <br> <meter min="0" max="100" value="57"></meter></p>
                <p>Photoshop <br> <meter min="0" max="100" value="63"></meter></p>

            </div>
            <div class="col-skill-2">
                <H3>RECOGNITION</H3>
                <h4>INTERNATIONAL DESIGN AWARDS 2014</h4>
                <p>15 March 2014/New York State University <br>Place 3
                </p>
                <h4>LOGO DESIGN CONTEST CICAGO 2013</h4>
                <p>12 October 2013/ Chicago House of Art <br>Place 2</p>
                <h4>WEB DESIGN CONTEST NEW York 2013</h4>
                <p>12 October 2013/ New York Technology <br> Place 2</p>
            </div>
        </div>
        <div class="row-skill">
            <div class="col-skill-1">
                <h3>LANGUAGE SKILLS</h3>
                <p>Spanish <br> <meter min="0" max="100" value="40"></meter></p>
                <p>English <br> <meter min="0" max="100" value="80"></meter></p>
                <p>Italian Basic <br> <meter min="0" max="100" value="60"></meter></p>
                <h3>HOBBIES & INTERESTS</h3>
                <ul>
               <li>Sports</li>
               <li>Photography</li>
               <li>Marketing</li>
               <li>Movies</li>
               <li>Travel</li>
               </ul>

            </div>
            <div class="col-skill-2">
                <h3>KNOWLEDGE</h3>
                <p>&#10003 Google Analytics</p>
                <p>&#10003 3D Modeling</p>
                <p>&#10003 Web Usability</p>
                <p>&#10003 Grid Layout</p>
                <p>&#10003 Photo manipulation</p>

            </div>
        </div>
     
    </div>
     <footer>
           
                    <div class="bottomnav">
                         
                             <a href="AdminHome.php">HOME</a>
                             <a href="AdminSkills.php">MY SKILLS</a>
                             <a href="Recommendations.php">RECOMMENDATIONS</a>
                             <a href="AdminWorks.php">WORKS</a>
                             <a href="http://varshinithatiparthi.uta.cloud/blog/">BLOG</a>
                             <a class="active" href="AdminHire.php">HIRE ME</a>
                              
                           
                                <a href="Logout.php">LOGOUT</a>
                            
                         </div>
             </footer>  
</body>
</html>
