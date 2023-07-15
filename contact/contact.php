<!DOCTYPE html>
<html>

<head>
  <title>Contact form</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./contact.css">
</head>

<body>
  <?php
  // Define database connection variables
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "adminkvm";

  // Create database connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check database connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Handle form submission
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $conn->real_escape_string($_POST['name']);
    $phno = $conn->real_escape_string($_POST['phno']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert form data into database
    $sql = "INSERT INTO contact (name,phno,email,message) VALUES ('$name', '$phno', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
      echo "Form data successfully saved to database.";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  ?>


  <div class="navbar">
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
		  <a  style="color: white;"  href="../infrastructure/architecture.html">Infrastructure</a>
		  <a style="color: white;"  href="../extra_sports/extra.html">Extra curricular</a>
		  <a style="color: white;"  href="../extra_sports/sports.html">Sports</a>
		  <a style="color: white;"  href="http://localhost/kvm/Acadamic/academic_f.php">Acadamic Acheivements</a>
	 
		 
		  <div class="dropdown">
			<a style="color: white;"  class="dropBtn" href="#">General Details 
			  <i class="fa fa-angle-down"></i>
			</a>
			<div class="drop-content">
			  <a href="http://localhost/kvm/admin/calender.html">School Calender</a>
			  <a href="http://localhost/kvm/Sports_achieve/sports.php">Sports Acheivements</a>
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
		  <a style="color: white;"  href="http://localhost/kvm/contact/contact.php">Contacts</a>
		  <a style="color: white;" href="http://localhost/kvm/admission_form/admission.php">Admission Form</a>
		</div>

  </div>
  <br><br><br><br><br><br><br>




  <div class="main-block">
    <div class="left-part">
      <i class="fas fa-graduation-cap"></i>
      <h1>Kongu Vellalar Matric Higher Secondary School</h1>
      <p>To provide high quality modern education for rural children through excellent and innovative teaching and learning</p>

    </div>
    <form method="POST">
      <div class="title">
        <i class="fas fa-pencil-alt"></i>
        <h2>Contact here</h2>
      </div>
      <div class="info">
        <input class="fname" type="text" name="name" placeholder="Full name">

        <input type="text" name="phno" placeholder="Phone number">

        <input type="email" name="email" placeholder="Email">

        <input type="text" name="message" placeholder="Message">


      </div>
      <!-- <div class="checkbox">
          <input type="checkbox" name="checkbox"><span>I agree to the <a href="https://www.w3docs.com/privacy-policy">Privacy Poalicy for W3Docs.</a></span>
        </div> -->
      <button type="submit" name="submit">Submit</button>
    </form>
  </div>


  <br><br><br><br><br>
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

</html>