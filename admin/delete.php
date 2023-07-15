<?php
include("database_connection.php");
if(isset($_POST['event_id']))
{
    $event_id = $POST['event_id'];
    $delete_query = mysqli_query($con,"DELETE FROM calendar_event_master WHERE event_id='$event_id'");
}
?>