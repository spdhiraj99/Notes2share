<?php
  session_start();
  if(isset($_GET['logout'])){
    $_SESSION=array();
    session_destroy();
    header('location: index.php');
  }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <title>Notes2Share</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="css\bootstrap.min.css" rel="stylesheet">
   <style type="text/css">
       .wrapper{
           width: 650px;
           margin: 0 auto;
       }
       .page-header h2{
           margin-top: 0;
       }
       table tr td:last-child a{
           margin-right: 15px;
       }
   </style>
 <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
 </head>
 <body>
   <!-- navigation bar -->
   <nav class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Notes2Share</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
        <?php if(isset($_SESSION['username'])) : ?>
          <li class="navbar-brand">Welcome <strong><?php echo $_SESSION['username']; ?></strong></li>
          <li><a href="index.php?logout='1'">logout</a></li>
        </div>
      <?php endif ?>
      <?php if(isset($_SESSION['username'])) : ?>
        <a href = "upload.php"><strong>Upload Notes</strong</a>
      <?php else : ?>
        <a href = "register.php"><strong>Sign up</strong></a>
          &nbsp;
        <a href = "login.php"><strong>Login</strong></a>
      <?php endif ?>
			</ul>
		</div>
	</div>
</nav>
<!-- navigation ends -->

     <?php if(isset($_SESSION['success'])) : ?>
       <div>
           <?php
              echo $_SESSION['success'];
              unset($_SESSION['success']);
            ?>
        </div>
      </div>
      <?php endif ?>
      <!-- main body starts -->
      <div class="wrapper">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">
                      <div class="page-header clearfix">
                          <h2 class="pull-left">Uploaded Notes</h2>
                      </div>
                      <?php
                      // Include config file
                      require_once 'config.php';

                      // Attempt select query execution
                      $sql = "SELECT filename,uploader,subject FROM details";
                      if($result = $pdo->query($sql)){
                          if($result->rowCount() > 0){
                              echo "<table class='table table-bordered table-striped'>";
                                  echo "<thead>";
                                      echo "<tr>";
                                          echo "<th>filename</th>";
                                          echo "<th>uploader</th>";
                                          echo "<th>subject</th>";
                                          echo "<th>Action</th>";
                                      echo "</tr>";
                                  echo "</thead>";
                                  echo "<tbody>";
                                  while($row = $result->fetch()){
                                      echo "<tr>";
                                          echo "<td>" . $row['filename'] . "</td>";
                                          echo "<td>" . $row['uploader'] . "</td>";
                                          echo "<td>" . $row['subject'] . "</td>";
                                          echo "<td>";
                                              ?><?php echo "<a href=\"download.php?file=$row[filename] \">download</a>";?>
											  <?php
                                              if(isset($_SESSION['username'])){
                                                if($row['uploader']==$_SESSION['username']){
												?><?php echo "<a href=\"download.php?delete={$row['filename']}&file={$row['filename']}\">Delete this file</a>";?>
												  <?php
                                                }
                                              }
                                          echo "</td>";
                                      echo "</tr>";
                                  }
                                  echo "</tbody>";
                              echo "</table>";
                              // Free result set
                              unset($result);
                          } else{
                              echo "<p class='lead'><em>No records were found.</em></p>";
                          }
                      } else{
                          echo "ERROR: Not able to execute $sql. " . $mysqli->error;
                      }

                      // Close connection
                      unset($pdo);
                      ?>
                  </div>
              </div>
          </div>
      </div>
      <!-- main body ends -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js\bootstrap.min.js"></script>
  </body>
  </html>
