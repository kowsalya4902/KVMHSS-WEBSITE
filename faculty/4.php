<!DOCTYPE html>
    <!-- Coding by CodingLab | www.codinglabweb.com -->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KVMHSS FACULTIES</title>

        <!-- Swiper CSS -->
        <link rel="stylesheet" href="css/swiper-bundle.min.css">

        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">



      
   
        

    <!-- End Bootstrap CSS -->

    
                                        
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

      
          <br>
        <marquee><b><h1 style="color: rgb(15, 122, 151); font-family: 'Poppins', sans-serif;">PHYSICS DEPARTMENT</h1></b></marquee>  

  <div class="slide-container swiper">
    <div class="slide-content">
        <div class="card-wrapper swiper-wrapper">
        <?php
          
          $connection = mysqli_connect('localhost', 'root', '', 'adminkvm');

          $query="SELECT * FROM faculty4";
          $query_run = mysqli_query($connection,$query);
          $check_faculty  = mysqli_num_rows($query_run) >0;
          if($check_faculty)
          {
            while($row = mysqli_fetch_array($query_run))
            {
              ?>
              <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>

                            <div class="card-image">
                                <img src="../admin/upload4/<?php echo $row['images']; ?>" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name"><?php echo $row['name']; ?></h2>
                            <h6 class="name"><?php echo $row['design']; ?></h6>
                            <p class="description"><?php echo $row['descrip']; ?></p>

                        </div>
                    </div>



              <?php
            }

          }
          else{
            echo "No Faculty ";

          }

        ?>
        </div>
        </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>

   
   
    <footer class="text-center text-lg-start bg-primary py-3 text-white" style="background-color: yellowgreen; margin-top: 50px;">
      
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

    <!-- Swiper JS -->
    <script src="js/swiper-bundle.min.js"></script>

    <!-- JavaScript -->
    <script src="js/script.js"></script>

</html>