<?php
session_start();
if(!isset($_SESSION['username'])){
  header('location: index.php');
}
if  (!isset($_POST['submit']))  { ?>
  <div style="  width: auto;
    color: black;
    background: #5F9EA0;
    color:#F1FF5;
    text-align: center;
    padding: 4px;">
    <h2 >Notes2Share</h2><br><h3 style="color:#56fd87;"> Upload your notes</h3>
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<label for="subject"> <strong>Subject: </strong> </label>
<input type="text" class="input-group" name="subject" ><br><br>

<input type="hidden" name="MAX_FILE_SIZE" value="8000000" /> <strong>Select file to upload:</strong>

<input type="file" name="data" class="input-group" /><br><br>

<input type="submit" style=" text-align:justify;"name="submit" value="Upload  File"class="btn" /></form>
</div>
<div style="background-color:cyan;color: cyan;padding:10px;margin:auto;text-align:right;">
  <a href="index.php"><strong>home</strong></a>
  &nbsp;
  <a href="login.php?logout=1"><strong>logout</strong></a>
</div>
<?php
}  else  {
if  ($_FILES['data']['size']  ==  0)  {
die("ERROR:  Zero  byte  file  upload");
}
//$allowedFileTypes  =  array("image/gif",  "image/jpeg",  "image/pjpeg", "");
//if  (!in_array($_FILES['data']['type'],  $allowedFileTypes)) {
//die("ERROR:  File  type  not  permitted");
//}
if  (!is_uploaded_file($_FILES['data']['tmp_name']))   {
die("ERROR:  Not  a  valid  file  upload"); }
$uploadDir  =  "C:xampp/htdocs/mini/uploads/";
if(move_uploaded_file($_FILES['data']['tmp_name'],  $uploadDir  .  $_FILES['data']['name'])){
    $db=mysqli_connect("localhost","root","root","upload");
    $fname= mysqli_real_escape_string($db,$_FILES['data']['name']);
    $uploader=mysqli_real_escape_string($db,$_SESSION['username']);
    $subject=mysqli_real_escape_string($db,$_POST['subject']);
    $sql="Insert INTO details (filename, uploader, subject) VALUES('$fname', '$uploader', '$subject')";
    mysqli_query($db,$sql);
	header('location:index.php');

} else{
die("Cannot  copy  uploaded  file");
}
} ?>
