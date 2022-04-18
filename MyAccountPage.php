<?php 
session_start();

  include("connection.php");
  include("functions.php");
  // require_once 'dbConfig.php';

  $user_data = check_login($con);
?>

<?php
    // If file upload form is submitted 
    $statusMsg = ''; 
    $uploadOk = 1;
    $id = $user_data['user_id'];
    if(isset($_POST["pic_submit"])){ 
        $status = 'error'; 
        if(!empty($_FILES["image"]["name"])) { 
            // Get file info 
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // check file size
            if ($_FILES["image"]["size"] > 8000000) {
              // echo "Sorry, your file is too large.";
              $statusMsg = "Sorry, your file is too large.";
              $uploadOk = 0;
            }

            if ($uploadOk == 0){
              $statusMsg = "Sorry, your file is too large.";
            }
             
            // Allow certain file formats 
            $allowTypes = array('jpg','jpeg');
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image));
             
                // Insert image content into database 
                $insert = $conn->query("UPDATE `registration` SET user_pic = '$imgContent' WHERE user_id = $id");
                 
                if($insert){ 
                    $status = 'success'; 
                    $statusMsg = "File uploaded successfully."; 
                }else{
                    echo ("Error : " . $conn -> error);
                    $statusMsg = "File upload failed, please try again."; 
                }  
            }else{ 
                $statusMsg = 'Sorry, only JPG & JPEG files are allowed to upload.';
            } 
        }else{ 
            $statusMsg = 'Please select an image file to upload.'; 
        } 
    } 
    
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Amatic+SC&family=Fredoka:wght@300&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Fredoka&display=swap');

    .topnav{
        overflow: hidden;
        background-color: #333;
    }
    .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 25px 16px;
        text-decoration: none;
        font-size: 17px;
    }
    .topnav a:hover {
        background-color: #e0a1ad;
        color: black;
    }

    .topnav a.active {
        background-color: #B77682;
        color: white;
    }

    .topnav-right {
        float: right;
    }
    .amaticFont{
      font-family: 'Amatic SC', cursive;
    }

    .fredokaFont{
      font-family: 'Fredoka', sans-serif;
    }
    </style>
</head>
<body>

  <div class="topnav">
      <img src="img/logowobg.png" style="width:100px;height:75px;" >
        <div class="topnav-right">
          <a href="./">Home</a>
          <a href="../store/store.php">Flat Finder</a>
          <a href="../flatmate-finder/rommate_finder.php">Flat Share</a>
          <a href="../about-us/aboutUs.php">About</a>
          <a class="active" href="./MyAccountPage.php"><span class="glyphicon glyphicon-log-in"></span> Account</a>
        </div>
  </div>
<div class="container">
    <div class="main-body">

          <a class="btn btn-info fredokaFont" style="float: right;" href="logout.php">Logout</a><br><br>
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <?php 
                    // Include the database configuration file  
                    require_once 'dbConfig.php'; 
                     
                    // Get image data from database 
                    $result = $conn->query("SELECT user_pic FROM registration WHERE user_id = $id"); 
                    ?>

                    <?php if($result->num_rows > 0){ ?> 
                        <div class="gallery"> 
                            <?php while($row = $result->fetch_assoc()){ ?> 
                                <img class="rounded-circle" width="150" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['user_pic']); ?>" /> 
                            <?php } ?> 
                        </div> 
                    <?php }else{ ?> 
                        <p class="status error">Image(s) not found...</p> 
                        <!-- <p class="status error"><?php echo ($statusMsg); ?></p>  -->
                    <?php } ?>
                    <!-- <img src="./img/default_pic.jpg" class="rounded-circle" width="150"> -->
                    <div class="mt-3">
                        <form method="post" enctype="multipart/form-data">
                            <label>Select Image File:</label>
                            <input style = "padding-left: 35%;" type="file" name="image">
                            <input type="submit" name="pic_submit" value="Upload">
                        </form>
                        <p><?php echo ($statusMsg); ?></p>
                      <h4><?php echo $user_data['first_name']; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card mt-3">
                <br>
                  <div class="col">
                      <h6 class="mb-0 fredokaFont">Full Name</h6><hr>
                      <p style="float: right;"><?php echo $user_data['first_name']; ?> <?php echo $user_data['last_name']; ?>
                  </div>
                  <div class="col">
                      <h6 class="mb-0 fredokaFont">Email Address</h6><hr>
                      <p style="float: right;"><?php echo $user_data['email']; ?></p>
                  </div>
              </div>
            
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <?php
                      echo "<h6 class='mb-0 fredokaFont'>Posts <a class='btn btn-info' style='float: right;' href='post_creat.php?id=" . $user_data['user_id'] . "'>+</a></h6><hr>";
                      ?>
                      <table class="postta">
                      <tbody>
                       <?php
                        // connect to database

                        $user_id = $user_data['user_id'];
                        // $conn = mysqli_connect($database_host, $database_user, $database_pass, $database_name);
                        
                        // Check connection
                        if (!$conn) {
                            die("fail: " . mysqli_connect_error());
                        };
                        
                        $sql = "SELECT * FROM Post WHERE user_id=$user_id";
                        $result = mysqli_query($conn, $sql);

                        // $DeleteQuery =  "DELETE FROM posts WHERE numOfPost='$_POST[numOfPost]'";

                        if(isset($_POST['Delete'])){
                          $DeleteQuery =  "DELETE FROM Post WHERE id=$_POST[hidden]";
                          // $DeleteQuery_Pic = "DELETE FROM PicOfPost WHERE post_id=$_POST[hidden]";
                          mysqli_query($conn, $DeleteQuery) or die ("Fail to Delete" . $conn -> error);
                          // mysqli_query($conn, $DeleteQuery_Pic) or die ("Fail to Delete" . $conn -> error);         

                          echo "<meta http-equiv='refresh' content='0'>";
                        }

                        // if ($conn->query($DeleteQuery) === TRUE) {
                        //   echo "Deleted";
                        // } else {
                        //   echo "failed:" . $conn->error;
                        // }

                        if (mysqli_num_rows($result) > 0) {
                        for ($a=1; $a<=mysqli_num_rows($result);$a++){
                          // while($row = mysqli_fetch_assoc($result)) {
                              $row = mysqli_fetch_assoc($result);
                              echo "<form action='MyAccountPage.php' method=post>";
                              echo "<tbody>";
                              echo  "<tr>";
                              echo    "<td style='width:60%;'><a href='post.php?id=" . $row["id"] . "'>" . "Post " . $a . "</a></td>";
                              echo    "<td><input type=hidden name=hidden value=" . $row["id"] . "></td>";
                              echo    "<td style='width: 5%;'>" . "<a href='post_edit.php?id=" . $row["id"] . "'><button class='fredokaFont' type='button'>Edit</button>" . "</a></td>";
                              echo    "<td style='width: 5%;'>" . "<input class='fredokaFont' type='submit' name='Delete' value='Delete'>" . "</td>";
                              echo  "</tr>";
                              echo"</tbody>";

                              echo"<tbody>";
                              echo  "<tr>";
                              echo    "<td style='width:100%'><div class='fredokaFont' style='height;30px;background-color: white;font-size: 20px;border-width: 2px;border-color: #f1f1f1;'>" . $row["NameOfP"] . "</div</td>";
                              echo  "</tr>";
                              echo"</tbody>";
                              echo"</form>";
                              // }
                        }
                        } else {
                            echo "<a class= 'fredokaFont'>You currently do not have any posts</a>";
                          }

                        mysqli_close($conn);
                      ?>

                      </table>
                  </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
    </div>

<style>
body{
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}

.topnav{
      overflow: hidden;
      background-color: #333;
}
.topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 25px 16px;
    text-decoration: none;
    font-size: 17px;
}
.topnav a:hover {
    background-color: #e0a1ad;
    color: black;
}

.topnav a.active {
    background-color: #B77682;
    color: white;
}

.topnav-right {
    float: right;
}


</style>

<script type="text/javascript">

</script>

</body></html>