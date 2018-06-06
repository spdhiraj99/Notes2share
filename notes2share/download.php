<?php
$file = basename($_GET['file']);
$path = 'uploads/'.$file;

if(!$path){ // file does not exist
    die('file not found');
} else if(!isset($_GET['delete'])){
    echo "<a href='uploads/".$file."'>click here to view/download</a>";
}
if(isset($_GET['delete'])){
  session_start();
  $username="";
  $email="";
  $errors=array();
    echo $file;
  $db = mysqli_connect('localhost','root','root','upload');
  $query="DELETE FROM `details` WHERE filename= \"$file\"";
  if(unlink($path)){
    echo "successfully deleted";
  }
  else{
    echo "failed to delete";
  }
  mysqli_query($db,$query);
}
?>
