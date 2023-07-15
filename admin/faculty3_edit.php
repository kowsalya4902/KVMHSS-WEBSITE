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
    <h6 class="m-0 font-weight-bold text-primary">facultiy edit
    </h6>
  </div>

  <div class="card-body">

<?php
 if(isset($_POST['edit_data_btn']))
 {
    $id = $_POST['edit_id'];

    $query = "SELECT * FROM faculty3 WHERE id ='$id' ";
    $query_run = mysqli_query($connection,$query);

    foreach($query_run as $row)
    {
?>

            <form action="code.php" method="POST" enctype="multipart/form-data">

            <div class="modal-body">
             <input type="hidden" name="edit_id" value="<?php echo $row['id']?>">
                <div class="form-group">
                    <label> Name </label>
                    <input type="text" name="edit_name" class="form-control" value="<?php echo $row['name']?>" placeholder="Enter name" >
                </div>
                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" name="edit_designation"  class="form-control" value="<?php echo $row['design']?>" placeholder="Enter Designation" >
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="edit_description" class="form-control" value="<?php echo $row['descrip']?>" placeholder="Enter Description" >
                </div>
                <div class="form-group">
                    <label>Upload image</label>
                    <input type="file"  name="faculty_image" id="faculty_image" class="form-control" value="<?php echo $row['images']?>" placeholder="enter image">
                </div>

            </div>
            <div class="modal-footer">
            <a href="faculty3.php" class="btn btn-danger" >Cancel</a>
                <button type="submit" name="faculty3_update" class="btn btn-primary">Update</button>
            </div>
            </form>
<?php
    }
 }
?>


 
</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>