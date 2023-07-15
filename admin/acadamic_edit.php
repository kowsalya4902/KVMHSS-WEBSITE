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
    <h6 class="m-0 font-weight-bold text-primary">Academic edit
    </h6>
  </div>

  <div class="card-body">

<?php
 if(isset($_POST['aca_edit_data_btn']))
 {
    $id = $_POST['aca_edit_id'];

    $query = "SELECT * FROM academic WHERE id ='$id' ";
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
                    <label>Acadamic Year</label>
                    <input type="text" name="edit_a_year"  class="form-control" value="<?php echo $row['a_year']?>" placeholder="Enter Academic year" >
                </div>
                <div class="form-group">
                    <label>Standard</label>
                    <input type="text" name="edit_class" class="form-control" value="<?php echo $row['class']?>" placeholder="Enter Standard" >
                </div>
                <div class="form-group">
                    <label>Total Mark</label>
                    <input type="text" name="edit_t_mark" class="form-control" value="<?php echo $row['t_mark']?>" placeholder="Enter Total Mark" >
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" name="edit_position" class="form-control" value="<?php echo $row['position']?>" placeholder="Enter Position" >
                </div>
                <div class="form-group">
                    <label>Upload image</label>
                    <input type="file"  name="s_image" id="s_image" class="form-control" value="<?php echo $row['images']?>" placeholder="enter image">
                </div>

            </div>
            <div class="modal-footer">
            <a href="acadamic.php" class="btn btn-danger" >Cancel</a>
                <button type="submit" name="aca_update" class="btn btn-primary">Update</button>
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