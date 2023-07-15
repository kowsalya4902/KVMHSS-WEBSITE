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
    <h6 class="m-0 font-weight-bold text-primary">Home edit
    </h6>
  </div>

  <div class="card-body">

<?php
 if(isset($_POST['h_edit_data_btn']))
 {
    $id = $_POST['h_edit_id'];

    $query = "SELECT * FROM h_image WHERE id ='$id' ";
    $query_run = mysqli_query($connection,$query);

    foreach($query_run as $row)
    {
?>

            <form action="code.php" method="POST" enctype="multipart/form-data">

            <div class="modal-body">
             <input type="hidden" name="edit_id" value="<?php echo $row['id']?>">
                
                <div class="form-group">
                    <label>Upload image</label>
                    <input type="file"  name="h_image" id="h_image" class="form-control" value="<?php echo $row['images']?>" placeholder="enter image">
                </div>

            </div>
            <div class="modal-footer">
            <a href="home.php" class="btn btn-danger" >Cancel</a>
                <button type="submit" name="h_update" class="btn btn-primary">Update</button>
            </div>
            </form>
<?php
    }
 }
?>


</div>



<!-- Recent news -->

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Home edit
    </h6>
  </div>

  <div class="card-body">

<?php
 if(isset($_POST['n_edit_data_btn']))
 {
    $id = $_POST['n_edit_id'];

    $query = "SELECT * FROM h_news WHERE id ='$id' ";
    $query_run = mysqli_query($connection,$query);

    foreach($query_run as $row)
    {
?>

            <form action="code.php" method="POST" enctype="multipart/form-data">

            <div class="modal-body">
             <input type="hidden" name="edit_id" value="<?php echo $row['id']?>">
                
             <div class="form-group">
                    <label>Enter Recent News</label>
                    <input type="text" name="edit_news" class="form-control" value="<?php echo $row['news']?>" placeholder="Enter news" >
                </div>

            </div>
            <div class="modal-footer">
            <a href="home.php" class="btn btn-danger" >Cancel</a>
                <button type="submit" name="n_update" class="btn btn-primary">Update</button>
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