<?php
include('security.php');
$connection = mysqli_connect('localhost', 'root', '', 'adminkvm');

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="modal fade" id="addfaculty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Acheivements</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
          
            <div class="form-group">
                <label> Title </label>
                <input type="text" name="title" class="form-control" placeholder="Enter Title" >
            </div>
            <div class="form-group">
                <label>Acheivements Description</label>
                <input type="text" name="a_description"  class="form-control" placeholder="Enter Description" >
            </div>
            <div class="form-group">
                <label>Upload image</label>
                <input type="file"  name="sa_image" id="sa_image" class="form-control" placeholder="enter image" >
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="save_acheive" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>




<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Acheivements 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addfaculty">
              Add 
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
    $query = "SELECT * FROM sports_acheive";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) > 0)
    {
      
      ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <!-- <th> ID</th> -->
            <th>Title</th>
            <th>Description</th>
            <th>Images</th>
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
              <td><?php echo $row['title']?></td>
              <td><?php echo $row['a_description']?></td>
              <td> <?php echo '<img src="sports_acheive/'.$row['images'].'"width="100px;" height="100px;" alt="Images">'?> </td>
            <td>
              <form action="sports_acheive_edit.php" method="POST">
              <input type="hidden" name="s_edit_id" value="<?php echo $row['id']?>">
              <button type="submit" name="s_edit_data_btn" class="btn btn-success">EDIT</button>
          </form>
          </td>
            <td>
            <form action="code.php" method="POST">
              <input type="hidden" name="s_delete_id" value="<?php echo $row['id']?>">
              <button type="submit" name="s_delete_btn" class="btn btn-danger">DELETE</button>
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