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
    <h6 class="m-0 font-weight-bold text-primary">Alumni edit
    </h6>
  </div>

  <div class="card-body">

<?php
 if(isset($_POST['alu_edit_data_btn']))
 {
    $id = $_POST['alu_edit_id'];

    $query = "SELECT * FROM alumini WHERE id ='$id' ";
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
                    <label>Batch</label>
                    <input type="text" name="edit_batch"  class="form-control" value="<?php echo $row['batch']?>" placeholder="Enter Designation" >
                </div>
                <div class="form-group">
                    <label>Acheiement</label>
                    <input type="text" name="edit_acheivement" class="form-control" value="<?php echo $row['acheive']?>" placeholder="Enter Description" >
                </div>
                <div class="form-group">
                    <label>Upload image</label>
                    <input type="file"  name="alumini_image" id="alumini_image" class="form-control" value="<?php echo $row['images']?>" placeholder="enter image">
                </div>

            </div>
            <div class="modal-footer">
            <a href="alumini.php" class="btn btn-danger" >Cancel</a>
                <button type="submit" name="alumini_update" class="btn btn-primary">Update</button>
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