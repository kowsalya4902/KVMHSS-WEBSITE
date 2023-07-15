<?php
include('security.php');
$connection = mysqli_connect('localhost', 'root', '', 'adminkvm');

include('includes/header.php'); 
include('includes/navbar.php'); 
?>



<!-- Add recent updates -->

<div class="modal fade" id="addnews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add news</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
          
        <div class="form-group">
                <label> Enter Recent Acheivement </label>
                <input type="text" name="news" class="form-control" placeholder="Enter Acheivement" >
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="save_news" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>




<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Home 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addnews">
              Add news to home page
            </button>
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
    $query = "SELECT * FROM h_news";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) > 0)
    {
      
      ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <!-- <th> ID</th> -->
            <th>News</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
          <?php
          while($row = mysqli_fetch_assoc($query_run))
          {
    ?>
            <tr>
              <!-- <td><?php echo $row['id']?></td> -->
              <td><?php echo $row['news']?></td>
              
            <td>
              <form action="home_edit.php" method="POST">
              <input type="hidden" name="n_edit_id" value="<?php echo $row['id']?>">
              <button type="submit" name="n_edit_data_btn" class="btn btn-success">EDIT</button>
          </form>
          </td>
            <td>
            <form action="code.php" method="POST">
              <input type="hidden" name="n_delete_id" value="<?php echo $row['id']?>">
              <button type="submit" name="n_delete_btn" class="btn btn-danger">DELETE</button>
          </form>
            </td>
           </tr>
    <?php
          }
          ?>
           
    </table>
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