<!DOCTYPE html>
<html>

<head>
  <title>Admission form</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="admission.css">
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
    $age = $conn->real_escape_string($_POST['age']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $phno = $conn->real_escape_string($_POST['phno']);
    $email = $conn->real_escape_string($_POST['email']);
    $birth = $conn->real_escape_string($_POST['birth']);
    $conduct = $conn->real_escape_string($_POST['conduct']);
    $transfer = $conn->real_escape_string($_POST['transfer']);

    // Insert form data into database
    $sql = "INSERT INTO adm (name,age,dob,gender,phno,email,birth,conduct,certificate) VALUES ('$name', '$age', '$dob', '$gender', '$phno', '$email', '$birth', '$conduct', '$transfer')";

    if (mysqli_query($conn, $sql)) {
      //echo "Form data successfully saved to database.";
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
        <h2>Register here</h2>
      </div>
      <div class="info">
        <input class="fname" type="text" name="name" placeholder="Full name">

        <input type="number" name="age" placeholder="Age">
        <input type="text" name="dob" placeholder="DOB">

        <select name="gender">
          <option value="course-type" name="gender" id="gender" selected>Gender</option>
          <option value="female">Female</option>
          <option value="male">Male</option>
          <option value="other">Other</option>
        </select>

        <input type="text" name="phno" placeholder="Phone number">

        <input type="text" name="email" placeholder="Email">

        <!-- <label for="name">Birth Certificate</label>
        <input type="file" name="birth" placeholder="Birth Certificate">

        <label for="name">Conduct Certificate</label>
        <input type="file" name="conduct" placeholder="Conduct Certificate">

        <label for="name">Transfer Certificate</label>
        <input type="file" name="transfer" placeholder="Transfer Certificate"> -->

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