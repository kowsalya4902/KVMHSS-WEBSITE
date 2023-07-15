<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Academics Achievements</title>
    <link rel="stylesheet" href="academic.css">
</head>
<body>
    <div class="navbar">
 
        <!-- Navbar logo -->
        <!-- <div class="nav-header">
          <div class="nav-logo">
            <a href="#">
              <img src="logo1.jpg" width="100px" alt="logo">
            </a>
          </div>
        </div>
      -->
         <!-- <h4 style="color: var(--bs-orange);">KVM</h4> -->
         <img style="height: 40px;width: 50px;margin-bottom: 10px;" src="logo1.jpg" alt="">
        <!-- responsive navbar toggle button -->
        <input type="checkbox" id="nav-check">
        <div class="nav-btn">
          <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
          </label>
        </div>
     
        <!-- Navbar items -->
    <div class="nav-links">
		  <a style="color: white;" href="http://localhost/kvm/home/index.php">Home</a>
		  <a style="color: white;"  href="http://localhost/kvm/infrastructure/architecture.html">Infrastructure</a>
		  <a style="color: white;"  href="http://localhost/kvm/extra_sports/extra.html">Extra curricular</a>
		  <a style="color: white;"  href="http://localhost/kvm/extra_sports/sports.html">Sports</a>
		  <a style="color: white;"  href="http://localhost/kvm/Acadamic/academic_f.php">Academic Achievements</a>
	 
		 
		  <div class="dropdown">
			<a style="color: white;"  class="dropBtn" href="#">General Details 
			  <i class="fa fa-angle-down"></i>
			</a>
			<div class="drop-content">
			  <a href="http://localhost/kvm/admin/calender.html">School Calendar</a>
			  <a href="http://localhost/kvm/Sports_achieve/sports.php">Sports Achievements</a>
			  <!-- <a href="#">Annual Report</a>
			  <a href="#">Book details</a> -->

	 
			 
			  <div class="dropdown2">
				<a  class="dropBtn2" href="#">Faculties
				  <i class="fa fa-angle-right"></i>
				</a>
				<div class="drop-content2">
				  <a href="http://localhost/kvm/faculty/1.php">Tamil</a>
				  <a href="http://localhost/kvm/faculty/2.php">English</a>
				  <a href="http://localhost/kvm/faculty/3.php">Maths</a>
				  <a href="http://localhost/kvm/faculty/5.php">Computer Science</a>
				  <a href="http://localhost/kvm/faculty/4.php">Physics</a>

				</div>
			  </div>
			</div>
		  </div>
	 
		  <!-- <a style="color: white;"  href="#">Alumni</a> -->
		  <a style="color: white;"  href="http://localhost/kvm/Alumini/Alumini.php">Alumni</a>
		  <a style="color: white;"  href="http://localhost/kvm/contact/contact.html">Contacts</a>
		  <a style="color: white;" href="http://localhost/kvm/admission_form/admission.php">Admission Form</a>
		</div>
      </div>
     </header>
    
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

<div class="wrapper">
  <marquee><b><h1 style="color: rgb(15, 122, 151); font-family: 'Poppins', sans-serif;">100% PASS PERCENTAGE</h1></b></marquee> 
  <h1>Acadamic Award Winners</h1> 
  <div class="our_team">
  
  <?php
          
          $connection = mysqli_connect('localhost', 'root', '', 'adminkvm');

          $query="SELECT * FROM academic";
          $query_run = mysqli_query($connection,$query);
          $check_academic  = mysqli_num_rows($query_run) >0;
          if($check_academic)
          {
            while($row = mysqli_fetch_array($query_run))
            {
              ?>
    
    
    
    <div class="team_member">
          <div class="member_img">
          <img src="../admin/academic/<?php echo $row['images']; ?>" >
          </div>
                      <h3>NAME:<?php echo $row['name']; ?></h3>
                      <h6>ACADEMIC YEAR:<?php echo $row['a_year']; ?></h6>
                      <h6>CLASS:<?php echo $row['class']; ?></h6>
                      <h6>MARKS:<?php echo $row['t_mark']; ?></h6>
                      <h6>POSITION:<?php echo $row['position']; ?></h6>
       
                      </div>

         <?php
            }

          }
          else{
            echo "No Students ";

          }

  ?>
   
   </div>
      </div>
       
     <footer class="text-center text-lg-start bg-primary py-3 text-white" style="background-color: #4070F4; margin-top: 50px;">
      
        <section class="">
            <div class="container text-center text-md-start mt-5">
                
                <div class="row mt-3">
                   
                    <!-- <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4"> -->
                        
                        <p>
                          Kongu Vellalar Matriculation Higher Secondary School  
                        </p>
                        <p>
                            Perundurai , 638 052,Erode District
                        </p>
                        <p>
                            Ph:(04294) Prinicipal:220650 Office:220090 
                          </p>
                          <p>
                           E-mail:kvmhsspri@gmail.com
                          </p>
                </div>
              </section>
              </footer>
    
    
</body>
</html>