<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="alumini.css">
  <link rel="stylesheet" href="../home/CSS/style.css">
  <link rel="stylesheet" href="../home/CSS/architecture.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
    <!--Google Fonts-->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>
<body>
  <header>
    <header>
      <!-- <section id="topbar" class="mb-2 mb-lg-0 mb-sm-0 d-none d-lg-flex align-items-center pt-2 pb-2 bg-primary text-white topbar-transparent">
     <div class="container">
       <div class="row">
         <div class="col-lg-6   text-start">
          <span class="px-3"><i class="bi bi-phone "></i> (04294) 220650 </span>
       <i class="bi bi-clock"></i> Mon-Sat: 09:00 AM - 05:00 PM
         </div>
         <div class="col-md-6 text-end">
             <a href="" class="me-4 text-reset">
                 <i class="bi bi-facebook"></i>
             </a>
             <a href="" class="me-4 text-reset">
                 <i class="bi bi-twitter"></i>
             </a>
             <a href="" class="me-4 text-reset">
                 <i class="bi bi-google"></i>
             </a>
             <a href="" class="me-4 text-reset">
                 <i class="bi bi-instagram"></i>
             </a>
             <a href="" class="me-4 text-reset">
                 <i class="bi bi-linkedin"></i>
             </a>
             <a href="" class="me-4 text-reset">
                 <i class="bi bi-github"></i>
             </a>
         </div>
       </div>
     </div>
   </section> -->
  
   <div class="navbar">
 
	
    <img style="height: 40px;width: 50px;margin-bottom: 10px;" src="logo1.jpg" alt="">
   
   <input type="checkbox" id="nav-check">
   <div class="nav-btn">
     <label for="nav-check">
       <span></span>
       <span></span>
       <span></span>
     </label>
   </div>

   
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
  
  <main>
    <h1 style="font-size: 500%;text-align: center; margin-bottom: 5%; font-style: oblique;">Our Alumnis</h1>
    <section class="alumni"></section>
      <div class="alumni-container">


        <?php
          
          $connection = mysqli_connect('localhost', 'root', '', 'adminkvm');

          $query="SELECT * FROM alumini";
          $query_run = mysqli_query($connection,$query);
          $check_alumini  = mysqli_num_rows($query_run) >0;
          if($check_alumini)
          {
            while($row = mysqli_fetch_array($query_run))
            {
              ?>
              <div class="alumni-card">
              <img src="../admin/alumini/<?php echo $row['images']; ?>" alt="alumini image">
              <h3 class="name"><?php echo $row['name']; ?></h3>
              <h6 class="batch"><?php echo $row['batch']; ?></h6>
              <p class="Acheive"><?php echo $row['acheive']; ?></p>
              </div>  
              <?php
            }

          }
          else{
            echo "No Alumini ";

          }

        ?>
          
      </div>
    </section>
  </main>
  
  <footer class="text-center text-lg-start bg-primary py-3 text-white">
          
           
    <section class="">
        <div class="container text-center text-md-start mt-5" style="font-size: 19px;">
            
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
                <!-- </div> -->
               
                <!-- <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                  
                    <h6 class="text-uppercase fw-bold mb-4">
                        Products
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">Angular</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">React</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Vue</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Laravel</a>
                    </p>
                </div>
               
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                   
                    <h6 class="text-uppercase fw-bold mb-4">
                        Useful links
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">Pricing</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Settings</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Orders</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Help</a>
                    </p>
                </div>
                
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    
                    <h6 class="text-uppercase fw-bold mb-4">
                        Contact
                    </h6>
                    <p><i class="bi bi-location me-3"></i> New York, NY 10012, US</p>
                    <p>
                        <i class="bi bi-envelope me-3"></i>
                        info@example.com
                    </p>
                    <p><i class="bi bi-phone me-3"></i> + 01 234 567 88</p>
                    <p><i class="bi bi-print me-3"></i> + 01 234 567 89</p>
                </div>
              
            </div> -->
            
        </div>
    </section>
    
    <!-- <div class="text-center py-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2021 Copyright:
        <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div> -->
   
</footer>
</body>
</html>