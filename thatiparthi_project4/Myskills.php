<?php include 'server.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '')
{
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
        <title>MY SKILLS</title>
        <style>
                @import url('https://fonts.googleapis.com/css?family=Rajdhani&display=swap');
        </style>
         <title>
            My Skills - Varshini Thatiparthi
        </title>
    </head>
    <body class="mySkills">
        <header>
            <div class="topnav">
               <div class="logo"> <img src="proyecto2/logo2.png"> </div>
                <a href="UserHome.php">HOME</a>
                <a class="active" href="Myskills.php">MY SKILLS</a>
                <a href="Recommendations.php">RECOMMENDATIONS</a>
                <a href="Works.php">WORKS</a>
                <a href="http://varshinithatiparthi.uta.cloud/blog/">BLOG</a>
                <a href="HireMe.php">HIRE ME</a>
                      <a href="Logout.php">LOGOUT</a>
                    
                
            </div>
        </header>

        <div class="wrapper">
            <div class="row">
                    <div class="column-01">
                            <h1>SKILLS & <br>EXPERTISE</h1>
                            <p class=col-01-p>
                                Visual Designer,Front-end Developer,3D Designer
                            </p>
                            <div class="col-01-img">
                                <img src= "proyecto2/profile1.png" alt="Profile Image" width= "450" height="450">
                            </div>
                    </div>
                    <div class="column-02">
                        <h4>Branding</h4>
                        <p class=col-02-p>
                            Creating logos and posters for your company.
                        </p>
                        <h4>Desing</h4>
                        <p class=col-02-p>
                            maintaing the quality and productivity in the works to please my clients.
                        </p>
                        <div class=row-2>
                            <h4>Smart Digital Solutions <span style = "color: #777777">A Front-End Devloper</span></h4>
                            <img src="proyecto2/device01.png" alter="device one">
                            <div class=device-2>
                            <img src="proyecto2/device02.png" alter="device two">
                            </div>
                            <div class=device-3>
                                <img src="proyecto2/device03.png" alter="device three">
                            </div>
                        </div>
                    </div>
                    <div class=column-03>
                        <h4>Marketing</h4>
                        <p class=col-03-p>
                            Trend designs for a better experience of both images,logos and website.
                        </p>
                        <h4>
                            Programming
                        </h4>
                        <p class=col-03-p>
                            Developing applications and systems that meet the needs and streamlinethe work and experience of users.
                        </p>
                    </div>
            </div>
            <div class="heading-2">
                <h1>WORK EXPERIENCE</h1>
                <p class=heading-2-p>I'm looking to expand my portfolio while I'm on top and while I'm young Luis M Alvarez <br> brings your context to 
                life in stunning daily</p>
            </div>
          <?php
                $query = "SELECT * FROM experience";
                $result = mysqli_query($db, $query);
            ?>
             <?php while($row = $result->fetch_assoc()) {
            echo '<div class="expreience-row">
            
                <div class="column1">
                    <h5>'.$row['month'].'</h5>
                    <h2><span style = "color: 	#00FFFF">'.$row['year'].'</span></h2>

                    <h4> '.$row['company'].'</h4>
                    <p class="column1-p">'.$row['role'].'</p>
                </div>
                <div class="column2">
                    <h2>'.$row['retyperole'].'</h2>
                    <p class=column2-p>
                    '.$row['description'].'
                    </p>
                </div>
                <hr>
            </div>';
             }
             ?>
           
            <div class="heading-2">
                    <h1>EDUCATION</h1>
                    <p class=heading-2-p>I'm looking to expand my portfolio while I'm on top and while I'm young Luis M Alvarez <br> brings your context to 
                    life in stunning daily</p>
            </div>
            <?php
                $query = "SELECT * FROM education";
                $result = mysqli_query($db, $query);
            ?>
             <?php while($row = $result->fetch_assoc()) {
            echo '<div class="expreience-row">
                <div class="column1">
                        <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['monthone'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$row['monthtwo'].'</h5>
                        
                       <div class="column1-h2">
                            <h2> <span style="color: #00FFFF">'.$row['year'].'</span></h2>
                        </div>
                        <div class="column1-r1-h4">
                           <h4>'.$row['qualification'].'</h4>
                        </div>
                </div>
                <div class="column2">
                    <h2>'.$row['heading'].'</h2>
                    <p class=column2-p>
                      '.$row['university'].'
                    </p>
                </div>
                <hr>

            </div>';
             }
             ?>
         <footer>
           
                    <div class="bottomnav">
                         
                             <a  href="UserHome.php">HOME</a>
                             <a class="active" href="Myskills.php">MY SKILLS</a>
                             <a href="Recommendations.php">RECOMMENDATIONS</a>
                             <a href="Works.php">WORKS</a>
                             <a href="http://varshinithatiparthi.uta.cloud/blog/">BLOG</a>
                             <a href="HireMe.php">HIRE ME</a>
                              <a href="ContactForm.php">CONTACT</a>
                             
                                <a href="Logout.php">LOGOUT</a>
                             
                         </div>
             </footer>    
    </body>
</html>
     