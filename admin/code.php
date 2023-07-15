
<?php

include('security.php');
$connection = mysqli_connect('localhost', 'root', '', 'adminkvm');
//session_start();

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];

    if($password === $cpassword)
    {

        $query = "INSERT INTO register (username,email,password,usertype) VALUES ('$username','$email','$password','$usertype')";
        $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        //echo "Saved";
        $_SESSION['success'] = "Admin PRofile Added";
        header('Location: register.php');
    }

    else
    {
        $_SESSION['status'] = "Admin PRofile not Added";
        header('Location: register.php');
    }
}
else{
    $_SESSION['status'] = "password and confirm password does not match";
    header('Location: register.php');
}

}

//edit

if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email= $_POST['edit_email'];
    $password= $_POST['edit_password'];
    $usertypeupdate = $_POST['update_usertype'];

    $query = "UPDATE register SET username='$username' , email='$email' , password='$password' , usertype='$usertypeupdate' WHERE id='$id'";
    $query_run= mysqli_query($connection,$query);

    if($query_run)
    {
        $_SESSION['success'] = "Your data is Updated";
        header('Location: register.php');

    }
    else{
        $_SESSION['status'] = "Your data NOT is Updated";
        header('Location: register.php');


    }
}



//delete button

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "Your Data is DELETED";
      header('Location: register.php');
    }
    else{
        $_SESSION['status'] = "Your Data is NOT DELETED";
        header('Location: register.php');
    }
}



//login

if(isset($_POST['login_btn']))
{
$email_login =$_POST['email'];
$password_login =$_POST['password'];


$query ="SELECT * FROM register WHERE email='$email_login' AND password='$password_login'";
$query_run= mysqli_query($connection,$query);
$usertype = mysqli_fetch_array($query_run);
}


if($usertype['usertype'] == "admin")
{
 $_SESSION['username'] = $email_login;
 header('Location: index.php');
}
else if($usertype['usertype'] == "user")
{
    $_SESSION['username'] = $email_login;
    header('Location: ../index.php');
}
else{
    $_SESSION['status'] = 'Email id / Password is Invalid';
    header('Location: login.php');
}



//add faculty

if(isset($_POST['save_faculty']))
{
    $name = $_POST['faculty_name'];
    $design = $_POST['faculty_designation'];
    $description = $_POST['faculty_description'];
    $images = $_FILES["faculty_image"]["name"];
    // $dst="./upload/".$images;
    // $dst_db="upload/".$images;
    // move_uploaded_file($_FILES['faculty_image']['name'], $dst);

    // $query = "INSERT INTO faculty ('name','design','descrip','images') 
    //         VALUES ('$name','$design','$description','$dst_db')";
    // $query_run = mysqli_query($connection,$query);

    // $validate_img_extension = $_FILES["faculty_image"]['type']=="image/jpg" ||
    // $_FILES["faculty_image"]['type']=="image/png" ||
    // $_FILES["faculty_image"]['type']=="image/jpeg" ;

    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {

    if(file_exists("upload/" . $_FILES["faculty_image"]["name"]))
   {
      $store = $_FILES["faculty_image"]["name"];
      $_SESSION['status'] = "Image Already Exixsts. '.$store.'";
      header('Location: faculty.php');
    }
   else
    {

        $query = "INSERT INTO faculty (name,design,descrip,images) VALUES ('$name','$design','$description','$images')";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success'] = "Faculty Added";
        header('Location: faculty.php');
        }
        else{
            $_SESSION['status'] = "Faculty Not Added";
        header('Location: faculty.php');
        }
   }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed";
    header('Location: faculty.php');
}
}




//update faculty
if(isset($_POST['faculty_update']))
{
    $id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_desgination= $_POST['edit_designation'];
    $edit_description= $_POST['edit_description'];
    $edit_faculty_image = $_FILES['faculty_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {
    $faculty_query = "SELECT * FROM faculty WHERE id='$id' ";
    $faculty_query_run= mysqli_query($connection,$faculty_query);
    foreach($faculty_query_run as $fa_row)
    {
        //echo $fa_row['images'];
        if($edit_faculty_image == NULL)
        {
            $image_data = $fa_row['images'];
        }
        else{
            // update with new image and delete with old image
            if($img_path = "upload/".$fa_row['images'])
            {
                unlink($img_path);
                $image_data = $edit_faculty_image;
            }

        }
    }

    $query="UPDATE faculty SET name='$edit_name',design='$edit_desgination',descrip='$edit_description',images='$image_data' WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
        if($edit_faculty_image == NULL)
        {
           // $image_data = $fa_row['images'];
        $_SESSION['success'] = "Faculty Updated";
        header('Location: faculty.php');
        }
        else{
            // update with new image and delete with old image
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success'] = "Faculty Updated";
        header('Location: faculty.php');
        }
        
    }
    else{
        $_SESSION['status'] = "Faculty Not Updated";
        header('Location: faculty.php');
    }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed . Try update again";
    header('Location: faculty.php');
}
}



//delete faculty
if(isset($_POST['faculty_delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM faculty WHERE id='$id' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "Faculty data is DELETED";
      header('Location: faculty.php');
    }
    else{
        $_SESSION['status'] = "Faculty Data is NOT DELETED";
        header('Location: faculty.php');
    }
}




//add faculty2

if(isset($_POST['save_faculty2']))
{
    $name = $_POST['faculty_name'];
    $design = $_POST['faculty_designation'];
    $description = $_POST['faculty_description'];
    $images = $_FILES["faculty_image"]["name"];

    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {

    if(file_exists("upload2/" . $_FILES["faculty_image"]["name"]))
   {
      $store = $_FILES["faculty_image"]["name"];
      $_SESSION['status'] = "Image Already Exixsts. '.$store.'";
      header('Location: faculty2.php');
    }
   else
    {

        $query = "INSERT INTO faculty2 (name,design,descrip,images) VALUES ('$name','$design','$description','$images')";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload2/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success'] = "Faculty Added";
        header('Location: faculty2.php');
        }
        else{
            $_SESSION['status'] = "Faculty Not Added";
        header('Location: faculty2.php');
        }
   }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed";
    header('Location: faculty2.php');
}
}




//update faculty
if(isset($_POST['faculty2_update']))
{
    $id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_desgination= $_POST['edit_designation'];
    $edit_description= $_POST['edit_description'];
    $edit_faculty_image = $_FILES['faculty_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {
    $faculty_query = "SELECT * FROM faculty2 WHERE id='$id' ";
    $faculty_query_run= mysqli_query($connection,$faculty_query);
    foreach($faculty_query_run as $fa_row)
    {
        //echo $fa_row['images'];
        if($edit_faculty_image == NULL)
        {
            $image_data = $fa_row['images'];
        }
        else{
            // update with new image and delete with old image
            if($img_path = "upload2/".$fa_row['images'])
            {
                unlink($img_path);
                $image_data = $edit_faculty_image;
            }

        }
    }

    $query="UPDATE faculty2 SET name='$edit_name',design='$edit_desgination',descrip='$edit_description',images='$image_data' WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
        if($edit_faculty_image == NULL)
        {
           // $image_data = $fa_row['images'];
        $_SESSION['success'] = "Faculty Updated";
        header('Location: faculty2.php');
        }
        else{
            // update with new image and delete with old image
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload2/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success'] = "Faculty Updated";
        header('Location: faculty2.php');
        }
        
    }
    else{
        $_SESSION['status'] = "Faculty Not Updated";
        header('Location: faculty2.php');
    }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed . Try update again";
    header('Location: faculty2.php');
}
}



//delete faculty
if(isset($_POST['faculty2_delete_btn']))
{
    $id = $_POST['delete_id2'];

    $query = "DELETE FROM faculty2 WHERE id='$id' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "Faculty data is DELETED";
      header('Location: faculty2.php');
    }
    else{
        $_SESSION['status'] = "Faculty Data is NOT DELETED";
        header('Location: faculty2.php');
    }
}


//add faculty3

if(isset($_POST['save_faculty3']))
{
    $name = $_POST['faculty_name'];
    $design = $_POST['faculty_designation'];
    $description = $_POST['faculty_description'];
    $images = $_FILES["faculty_image"]["name"];

    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {

    if(file_exists("upload3/" . $_FILES["faculty_image"]["name"]))
   {
      $store = $_FILES["faculty_image"]["name"];
      $_SESSION['status'] = "Image Already Exixsts. '.$store.'";
      header('Location: faculty3.php');
    }
   else
    {

        $query = "INSERT INTO faculty3 (name,design,descrip,images) VALUES ('$name','$design','$description','$images')";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload3/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success'] = "Faculty Added";
        header('Location: faculty3.php');
        }
        else{
            $_SESSION['status'] = "Faculty Not Added";
        header('Location: faculty3.php');
        }
   }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed";
    header('Location: faculty3.php');
}
}




//update faculty
if(isset($_POST['faculty3_update']))
{
    $id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_desgination= $_POST['edit_designation'];
    $edit_description= $_POST['edit_description'];
    $edit_faculty_image = $_FILES['faculty_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {
    $faculty_query = "SELECT * FROM faculty3 WHERE id='$id' ";
    $faculty_query_run= mysqli_query($connection,$faculty_query);
    foreach($faculty_query_run as $fa_row)
    {
        //echo $fa_row['images'];
        if($edit_faculty_image == NULL)
        {
            $image_data = $fa_row['images'];
        }
        else{
            // update with new image and delete with old image
            if($img_path = "upload3/".$fa_row['images'])
            {
                unlink($img_path);
                $image_data = $edit_faculty_image;
            }

        }
    }

    $query="UPDATE faculty3 SET name='$edit_name',design='$edit_desgination',descrip='$edit_description',images='$image_data' WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
        if($edit_faculty_image == NULL)
        {
           // $image_data = $fa_row['images'];
        $_SESSION['success'] = "Faculty Updated";
        header('Location: faculty3.php');
        }
        else{
            // update with new image and delete with old image
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload3/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success'] = "Faculty Updated";
        header('Location: faculty3.php');
        }
        
    }
    else{
        $_SESSION['status'] = "Faculty Not Updated";
        header('Location: faculty3.php');
    }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed . Try update again";
    header('Location: faculty3.php');
}
}



//delete faculty
if(isset($_POST['faculty3_delete_btn']))
{
    $id = $_POST['delete_id3'];

    $query = "DELETE FROM faculty3 WHERE id='$id' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "Faculty data is DELETED";
      header('Location: faculty3.php');
    }
    else{
        $_SESSION['status'] = "Faculty Data is NOT DELETED";
        header('Location: faculty3.php');
    }
}



//add faculty4

if(isset($_POST['save_faculty4']))
{
    $name = $_POST['faculty_name'];
    $design = $_POST['faculty_designation'];
    $description = $_POST['faculty_description'];
    $images = $_FILES["faculty_image"]["name"];

    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {

    if(file_exists("upload4/" . $_FILES["faculty_image"]["name"]))
   {
      $store = $_FILES["faculty_image"]["name"];
      $_SESSION['status'] = "Image Already Exixsts. '.$store.'";
      header('Location: faculty4.php');
    }
   else
    {

        $query = "INSERT INTO faculty4 (name,design,descrip,images) VALUES ('$name','$design','$description','$images')";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload4/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success'] = "Faculty Added";
        header('Location: faculty4.php');
        }
        else{
            $_SESSION['status'] = "Faculty Not Added";
        header('Location: faculty4.php');
        }
   }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed";
    header('Location: faculty4.php');
}
}




//update faculty
if(isset($_POST['faculty4_update']))
{
    $id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_desgination= $_POST['edit_designation'];
    $edit_description= $_POST['edit_description'];
    $edit_faculty_image = $_FILES['faculty_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {
    $faculty_query = "SELECT * FROM faculty4 WHERE id='$id' ";
    $faculty_query_run= mysqli_query($connection,$faculty_query);
    foreach($faculty_query_run as $fa_row)
    {
        //echo $fa_row['images'];
        if($edit_faculty_image == NULL)
        {
            $image_data = $fa_row['images'];
        }
        else{
            // update with new image and delete with old image
            if($img_path = "upload4/".$fa_row['images'])
            {
                unlink($img_path);
                $image_data = $edit_faculty_image;
            }

        }
    }

    $query="UPDATE faculty4 SET name='$edit_name',design='$edit_desgination',descrip='$edit_description',images='$image_data' WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
        if($edit_faculty_image == NULL)
        {
           // $image_data = $fa_row['images'];
        $_SESSION['success'] = "Faculty Updated";
        header('Location: faculty4.php');
        }
        else{
            // update with new image and delete with old image
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload4/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success'] = "Faculty Updated";
        header('Location: faculty4.php');
        }
        
    }
    else{
        $_SESSION['status'] = "Faculty Not Updated";
        header('Location: faculty4.php');
    }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed . Try update again";
    header('Location: faculty4.php');
}
}



//delete faculty
if(isset($_POST['faculty4_delete_btn']))
{
    $id = $_POST['delete_id4'];

    $query = "DELETE FROM faculty4 WHERE id='$id' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "Faculty data is DELETED";
      header('Location: faculty4.php');
    }
    else{
        $_SESSION['status'] = "Faculty Data is NOT DELETED";
        header('Location: faculty4.php');
    }
}



//add faculty5

if(isset($_POST['save_faculty5']))
{
    $name = $_POST['faculty_name'];
    $design = $_POST['faculty_designation'];
    $description = $_POST['faculty_description'];
    $images = $_FILES["faculty_image"]["name"];

    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {

    if(file_exists("upload5/" . $_FILES["faculty_image"]["name"]))
   {
      $store = $_FILES["faculty_image"]["name"];
      $_SESSION['status'] = "Image Already Exixsts. '.$store.'";
      header('Location: faculty5.php');
    }
   else
    {

        $query = "INSERT INTO faculty5 (name,design,descrip,images) VALUES ('$name','$design','$description','$images')";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload5/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success'] = "Faculty Added";
        header('Location: faculty5.php');
        }
        else{
            $_SESSION['status'] = "Faculty Not Added";
        header('Location: faculty5.php');
        }
   }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed";
    header('Location: faculty5.php');
}
}




//update faculty
if(isset($_POST['faculty5_update']))
{
    $id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_desgination= $_POST['edit_designation'];
    $edit_description= $_POST['edit_description'];
    $edit_faculty_image = $_FILES['faculty_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {
    $faculty_query = "SELECT * FROM faculty5 WHERE id='$id' ";
    $faculty_query_run= mysqli_query($connection,$faculty_query);
    foreach($faculty_query_run as $fa_row)
    {
        //echo $fa_row['images'];
        if($edit_faculty_image == NULL)
        {
            $image_data = $fa_row['images'];
        }
        else{
            // update with new image and delete with old image
            if($img_path = "upload5/".$fa_row['images'])
            {
                unlink($img_path);
                $image_data = $edit_faculty_image;
            }

        }
    }

    $query="UPDATE faculty5 SET name='$edit_name',design='$edit_desgination',descrip='$edit_description',images='$image_data' WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
        if($edit_faculty_image == NULL)
        {
           // $image_data = $fa_row['images'];
        $_SESSION['success'] = "Faculty Updated";
        header('Location: faculty5.php');
        }
        else{
            // update with new image and delete with old image
        move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload5/".$_FILES["faculty_image"]["name"]);
        $_SESSION['success'] = "Faculty Updated";
        header('Location: faculty5.php');
        }
        
    }
    else{
        $_SESSION['status'] = "Faculty Not Updated";
        header('Location: faculty5.php');
    }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed . Try update again";
    header('Location: faculty5.php');
}
}



//delete faculty
if(isset($_POST['faculty5_delete_btn']))
{
    $id = $_POST['delete_id5'];

    $query = "DELETE FROM faculty5 WHERE id='$id' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "Faculty data is DELETED";
      header('Location: faculty5.php');
    }
    else{
        $_SESSION['status'] = "Faculty Data is NOT DELETED";
        header('Location: faculty5.php');
    }
}



//add Acadamic acheivements

if(isset($_POST['save_student']))
{
    $name = $_POST['s_name'];
    $year = $_POST['a_year'];
    $class = $_POST['class'];
    $total = $_POST['t_mark'];
    $position = $_POST['position'];
    $images = $_FILES["s_image"]["name"];

    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["s_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {

    if(file_exists("academic/" . $_FILES["s_image"]["name"]))
   {
      $store = $_FILES["s_image"]["name"];
      $_SESSION['status'] = "Image Already Exixsts. '.$store.'";
      header('Location: acadamic.php');
    }
   else
    {

        $query = "INSERT INTO academic (name,a_year,class,t_mark,position,images) VALUES ('$name','$year','$class','$total','$position','$images')";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
        move_uploaded_file($_FILES["s_image"]["tmp_name"], "academic/".$_FILES["s_image"]["name"]);
        $_SESSION['success'] = "Student Added";
        header('Location: acadamic.php');
        }
        else{
            $_SESSION['status'] = "Student Not Added";
        header('Location: acadamic.php');
        }
   }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed";
    header('Location: acadamic.php');
}
}




//update acadamics
if(isset($_POST['aca_update']))
{
    $id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_a_year= $_POST['edit_a_year'];
    $edit_class= $_POST['edit_class'];
    $edit_t_mark= $_POST['edit_t_mark'];
    $edit_position= $_POST['edit_position'];
    $edit_aca_image = $_FILES['s_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["s_image"]["type"] ,$img_types);

    if($validate_img_extension)
    {
    $aca_query = "SELECT * FROM academic WHERE id='$id' ";
    $aca_query_run= mysqli_query($connection,$aca_query);
    foreach($aca_query_run as $fa_row)
    {
        //echo $fa_row['images'];
        if($edit_aca_image == NULL)
        {
            $image_data = $fa_row['images'];
        }
        else{
            // update with new image and delete with old image
            if($img_path = "academic/".$fa_row['images'])
            {
                unlink($img_path);
                $image_data = $edit_aca_image;
            }

        }
    }

    $query="UPDATE academic SET name='$edit_name', a_year='$edit_a_year' , class='$edit_class' , t_mark='$edit_t_mark' , position='$edit_position' , images='$image_data' WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
        if($edit_aca_image == NULL)
        {
           // $image_data = $fa_row['images'];
        $_SESSION['success'] = "Data Updated";
        header('Location: acadamic.php');
        }
        else{
            // update with new image and delete with old image
        move_uploaded_file($_FILES["s_image"]["tmp_name"], "academic/".$_FILES["s_image"]["name"]);
        $_SESSION['success'] = "Data Updated";
        header('Location: acadamic.php');
        }
        
    }
    else{
        $_SESSION['status'] = "Data Not Updated";
        header('Location: acadamic.php');
    }
    }
else{
    $_SESSION['status'] = "only png,jpeg and jpg images are allowed . Try update again";
    header('Location: acadamic.php');
}
}



//delete acadamics
if(isset($_POST['aca_delete_btn']))
{
    $id = $_POST['aca_delete_id'];

    $query = "DELETE FROM academic WHERE id='$id' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "Data is DELETED";
      header('Location: acadamic.php');
    }
    else{
        $_SESSION['status'] = "Data is NOT DELETED";
        header('Location: acadamic.php');
    }
}


//add Home image

if(isset($_POST['save_image']))
{
    
    $images = $_FILES["h_image"]["name"];

    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["h_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {

    if(file_exists("home_image/" . $_FILES["h_image"]["name"]))
   {
      $store = $_FILES["h_image"]["name"];
      $_SESSION['status'] = "Image Already Exixsts. '.$store.'";
      header('Location: home.php');
    }
   else
    {

        $query = "INSERT INTO h_image (images) VALUES ('$images')";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
        move_uploaded_file($_FILES["h_image"]["tmp_name"], "home_image/".$_FILES["h_image"]["name"]);
        $_SESSION['success'] = "Image Added";
        header('Location: home.php');
        }
        else{
            $_SESSION['status'] = "Imaget Not Added";
        header('Location: home.php');
        }
   }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed";
    header('Location: home.php');
}
}




//update Home image
if(isset($_POST['h_update']))
{
    $id = $_POST['edit_id'];
    $edit_h_image = $_FILES['h_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["h_image"]["type"] ,$img_types);

    if($validate_img_extension)
    {
    $h_query = "SELECT * FROM h_image WHERE id='$id' ";
    $h_query_run= mysqli_query($connection,$aca_query);
    foreach($h_query_run as $fa_row)
    {
        //echo $fa_row['images'];
        if($edit_h_image == NULL)
        {
            $image_data = $fa_row['images'];
        }
        else{
            // update with new image and delete with old image
            if($img_path = "home_image/".$fa_row['images'])
            {
                unlink($img_path);
                $image_data = $edit_h_image;
            }

        }
    }

    $query="UPDATE h_image SET images='$image_data' WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
        if($edit_h_image == NULL)
        {
           // $image_data = $fa_row['images'];
        $_SESSION['success'] = "Data Updated";
        header('Location: home.php');
        }
        else{
            // update with new image and delete with old image
        move_uploaded_file($_FILES["h_image"]["tmp_name"], "home_image/".$_FILES["h_image"]["name"]);
        $_SESSION['success'] = "Data Updated";
        header('Location: home.php');
        }
        
    }
    else{
        $_SESSION['status'] = "Data Not Updated";
        header('Location: home.php');
    }
    }
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed . Try update again";
    header('Location: home.php');
}
}



//delete Home image
if(isset($_POST['h_delete_btn']))
{
    $id = $_POST['h_delete_id'];

    $query = "DELETE FROM h_image WHERE id='$id' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "Data is DELETED";
      header('Location: home.php');
    }
    else{
        $_SESSION['status'] = "Data is NOT DELETED";
        header('Location: home.php');
    }
}




//add sports acheivements

if(isset($_POST['save_acheive']))
{
    $name = $_POST['title'];
    $a_descrip = $_POST['a_description'];
    $images = $_FILES["sa_image"]["name"];

    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["sa_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {

    if(file_exists("sports_acheive/" . $_FILES["sa_image"]["name"]))
   {
      $store = $_FILES["sa_image"]["name"];
      $_SESSION['status'] = "Image Already Exixsts. '.$store.'";
      header('Location: sports_acheive.php');
    }
   else
    {

        $query = "INSERT INTO sports_acheive (title,a_description,images) VALUES ('$name','$a_descrip','$images')";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
        move_uploaded_file($_FILES["sa_image"]["tmp_name"], "sports_acheive/".$_FILES["sa_image"]["name"]);
        $_SESSION['success'] = "Image Added";
        header('Location: sports_acheive.php');
        }
        else{
            $_SESSION['status'] = "Imaget Not Added";
        header('Location: sports_acheive.php');
        }
   }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed";
    header('Location: sports_acheive.php');
}
}




//update sports acheivements
if(isset($_POST['sa_update']))
{
    
    $id = $_POST['edit_id'];
    $edit_title = $_POST['edit_title'];
    $edit_sa_descrip= $_POST['edit_acheive'];
    $edit_sa_image = $_FILES['sa_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["sa_image"]["type"] ,$img_types);

    if($validate_img_extension)
    {
    $sa_query = "SELECT * FROM sports_acheive WHERE id='$id' ";
    $sa_query_run= mysqli_query($connection,$sa_query);
    foreach($sa_query_run as $fa_row)
    {
        //echo $fa_row['images'];
        if($edit_sa_image == NULL)
        {
            $image_data = $fa_row['images'];
        }
        else{
            // update with new image and delete with old image
            if($img_path = "sports_acheive/".$fa_row['images'])
            {
                unlink($img_path);
                $image_data = $edit_sa_image;
            }

        }
    }

    $query="UPDATE sports_acheive SET title='$edit_title',a_description=' $edit_sa_descrip', images='$image_data' WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
        if($edit_sa_image == NULL)
        {
           // $image_data = $fa_row['images'];
        $_SESSION['success'] = "Data Updated";
        header('Location: sports_acheive.php');
        }
        else{
            // update with new image and delete with old image
        move_uploaded_file($_FILES["sa_image"]["tmp_name"], "sports_acheive/".$_FILES["sa_image"]["name"]);
        $_SESSION['success'] = "Data Updated";
        header('Location: sports_acheive.php');
        }
        
    }
    else{
        $_SESSION['status'] = "Data Not Updated";
        header('Location: sports_acheive.php');
    }
    }
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed . Try update again";
    header('Location: sports_acheive.php');
}
}



//delete sports acheivements
if(isset($_POST['s_delete_btn']))
{
    $id = $_POST['s_delete_id'];

    $query = "DELETE FROM sports_acheive WHERE id='$id' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "Data is DELETED";
      header('Location: sports_acheive.php');
    }
    else{
        $_SESSION['status'] = "Data is NOT DELETED";
        header('Location: sports_acheive.php');
    }
}



//add recent news

if(isset($_POST['save_news']))
{
    $news = $_POST['news'];

        $query = "INSERT INTO h_news (news) VALUES ('$news')";
        $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "News Added";
      header('Location: home.php');
    }
    else{
        $_SESSION['status'] = "News not Added";
        header('Location: home.php');
    }
}

//update recent news
if(isset($_POST['n_update']))
{
    
    $id = $_POST['edit_id'];
    $edit_news = $_POST['edit_news'];

    $query="UPDATE h_news SET news='$edit_news' WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "News updated";
      header('Location: home.php');
    }
    else{
        $_SESSION['status'] = "News not updated";
        header('Location: home.php');
    }

}




//delete recent news
if(isset($_POST['n_delete_btn']))
{
    $id = $_POST['n_delete_id'];

    $query = "DELETE FROM h_news WHERE id='$id' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "News is DELETED";
      header('Location: home.php');
    }
    else{
        $_SESSION['status'] = "News is NOT DELETED";
        header('Location: home.php');
    }
}




//add Alumini

if(isset($_POST['save_alumini']))
{
    $name = $_POST['alumini_name'];
    $batch = $_POST['alumini_batch'];
    $acheive = $_POST['alumini_acheive'];
    $images = $_FILES["alumini_image"]["name"];

    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["alumini_image"]['type'] ,$img_types);

    if($validate_img_extension)
    {

    if(file_exists("alumini/" . $_FILES["alumini_image"]["name"]))
   {
      $store = $_FILES["alumini_image"]["name"];
      $_SESSION['status'] = "Image Already Exixsts. '.$store.'";
      header('Location: alumini.php');
    }
   else
    {

        $query = "INSERT INTO alumini (name,batch,acheive,images) VALUES ('$name','$batch','$acheive','$images')";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
        move_uploaded_file($_FILES["alumini_image"]["tmp_name"], "alumini/".$_FILES["alumini_image"]["name"]);
        $_SESSION['success'] = "Image Added";
        header('Location: alumini.php');
        }
        else{
            $_SESSION['status'] = "Imaget Not Added";
        header('Location: alumini.php');
        }
   }
}
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed";
    header('Location: alumini.php');
}
}




//update sports acheivements
if(isset($_POST['alumini_update']))
{
    
    $id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_batch= $_POST['edit_batch'];
    $edit_acheive= $_POST['edit_acheivement'];
    $edit_alumini_image = $_FILES['alumini_image']['name'];


    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["alumini_image"]["type"] ,$img_types);

    if($validate_img_extension)
    {
    $alu_query = "SELECT * FROM alumini WHERE id='$id' ";
    $alu_query_run= mysqli_query($connection,$alu_query);
    foreach($alu_query_run as $fa_row)
    {
        //echo $fa_row['images'];
        if($edit_alumini_image == NULL)
        {
            $image_data = $fa_row['images'];
        }
        else{
            // update with new image and delete with old image
            if($img_path = "alumini/".$fa_row['images'])
            {
                unlink($img_path);
                $image_data = $edit_alumini_image;
            }

        }
    }

    $query="UPDATE alumini SET name='$edit_name',batch=' $edit_batch',acheive=' $edit_acheive', images='$image_data' WHERE id='$id' ";
    $query_run=mysqli_query($connection,$query);

    if($query_run)
    {
        if($edit_alumini_image == NULL)
        {
           // $image_data = $fa_row['images'];
        $_SESSION['success'] = "Data Updated";
        header('Location: alumini.php');
        }
        else{
            // update with new image and delete with old image
        move_uploaded_file($_FILES["alumini_image"]["tmp_name"], "alumini/".$_FILES["alumini_image"]["name"]);
        $_SESSION['success'] = "Data Updated";
        header('Location: alumini.php');
        }
        
    }
    else{
        $_SESSION['status'] = "Data Not Updated";
        header('Location: alumini.php');
    }
    }
else{
    $_SESSION['status'] = "only png,jpeg and jpeg images are allowed . Try update again";
    header('Location: alumini.php');
}
}



//delete sports acheivements
if(isset($_POST['alumini_delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM alumini WHERE id='$id' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
      $_SESSION['success'] = "Data is DELETED";
      header('Location: alumini.php');
    }
    else{
        $_SESSION['status'] = "Data is NOT DELETED";
        header('Location: alumini.php');
    }
}

?>