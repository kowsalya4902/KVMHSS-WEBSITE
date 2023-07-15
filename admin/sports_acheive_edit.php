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
    <h6 class="m-0 font-weight-bold text-primary">Sports edit
    </h6>
  </div>

  <div class="card-body">

<?php
 if(isset($_POST['s_edit_data_btn']))
 {
    $id = $_POST['s_edit_id'];

    $query = "SELECT * FROM sports_acheive WHERE id ='$id' ";
    $query_run = mysqli_query($connection,$query);

    foreach($query_run as $row)
    {
?>

            <form action="code.php" method="POST" enctype="multipart/form-data">

            <div class="modal-body">
             <input type="hidden" name="edit_id" value="<?php echo $row['id']?>">
                <div class="form-group">
                    <label> Title </label>
                    <input type="text" name="edit_title" class="form-control" value="<?php echo $row['title']?>" placeholder="Enter Title" >
                </div>
                <div class="form-group">
                    <label>Acheivement Description</label>
                    <input type="text" name="edit_acheive"  class="form-control" value="<?php echo $row['a_description']?>" placeholder="Enter Description" >
                </div>
                <div class="form-group">
                    <label>Upload image</label>
                    <input type="file"  name="sa_image" id="sa_image" class="form-control" value="<?php echo $row['images']?>" placeholder="enter image">
                </div>

            </div>
            <div class="modal-footer">
            <a href="sports_acheive.php" class="btn btn-danger" >Cancel</a>
                <button type="submit" name="sa_update" class="btn btn-primary">Update</button>
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