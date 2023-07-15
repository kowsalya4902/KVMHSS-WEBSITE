<?php
include('security.php');
$connection = mysqli_connect('localhost', 'root', '', 'adminkvm');

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Contact form data
    </h6>
  </div>

  <div class="card-body">
  <?php
 if(isset($_SESSION['success']) && $_SESSION['success'] !='' )
 {
  echo '<h2 class="bg-primary text-white">'.$_SESSION['success'].'</h2>';
  unset($_SESSION['success']);
 }

 if(isset($_SESSION['status']) && $_SESSION['status'] !='' )
 {
  echo '<h2 class="bg-danger text-white">'.$_SESSION['status'].'</h2>';
  unset($_SESSION['status']);
 }
 
    ?> 

    <div class="table-responsive">

    <?php
    $query = "SELECT * FROM contact";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) > 0)
    {
      
      ?>
      <form action="" method="POST" enctype="multipart/form-data">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <!-- <th> ID</th> -->
            <th> Name</th>
            <th>Phone number</th>
            <th>Email</th>
            <th>Message</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while($row = mysqli_fetch_assoc($query_run))
          {
    ?>
            <tr>
              <!-- <td><?php echo $row['id']?></td> -->
              <td><?php echo $row['name']?></td>
              <td><?php echo $row['phno']?></td>
              <td><?php echo $row['email']?></td>
              <td><?php echo $row['message']?></td>
           </tr>
    <?php
          }
          ?>
           
    </table>
        </form>
    <?php
    }

    else{
      echo "NO record found";
    }
    ?>
            
                  
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>