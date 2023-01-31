<html>
<head>
    <link rel="stylesheet" href="adminmain.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body style="background-image: url(Images/aneesh1.jpg);">
    <ul>
        <li class="dropdown"><p style="font-family: cursive;font-size: 40px;color: white;">ADMIN MODE</p></li>
        <br>
        <h2>
            <li class="dropdown">
                <br><br>
                <a class="dropbtn" style="font-family: cursive;">DOCTOR</a>
                <div class="dropdown-content">
                    <a href="NewDoctor.php" style="font-family: cursive;">Add new Doctor</a>
                    <a href="DeleteDoctor.php" style="font-family: cursive;">Delete Doctor</a>
                    <a href="DoctorSchedule.php" style="font-family: cursive;">Doctor Schedules</a>
                    <a href="ShowDoctor.php" style="font-family: cursive;">Show all Doctors</a>
                </div>
            </li>
            <li class="dropdown">
                <br><br>
                <a class="dropbtn" style="font-family: cursive;">Branch</a>
                <div class="dropdown-content">
                    <a href="NewBranch.php" style="font-family: cursive;">Add new Branch</a>
                    <a href="DeleteBranch.php" style="font-family: cursive;">Delete Branch</a>
                    <a href="AddDoctorToBranch.php" style="font-family: cursive;">Assign Doctor to a Branch</a>
                    <a href="DeleteDoctorFromBranch.php" style="font-family: cursive;">Delete Doctor from a Branch</a>
                    <a href="ShowBranch.php" style="font-family: cursive;">Show the Branchs</a>
                </div>
            </li>

            <li>
                <br><br>
                <form method="POST" action="AdminLogin.php">
                    <button type="submit" class="cancelbtn" name="logout" style="float: left;font-size: 20px;font-family: cursive;">LOGOUT</button>
                </form>
            </li>
        </h2>
    </ul>
    <center>
        <div class="w3-container">
            <h1 style="font-family: cursive; font-size: 30px;">ADD Branch</h1>
            <div class="w3-panel w3-card" style="background-color: white;width: 60%;height: 50%;">
                <form method="POST">
                    <p style="font-family: cursive; font-size: 20px;position: absolute;left: 22%;top: 42%;">CID:</p> <input type="number" name="cid" style="width: 10%; position: absolute;left: 26%;top: 42%;" required>
                    
                    <p style="font-family: cursive; font-size: 20px;position: absolute;left: 37%;top: 42%;">Name:</p> <input type="text" style="width: 15%; position: absolute;left: 42%;top: 42%;" name="name" required>

                    <p style="font-family: cursive; font-size: 20px;position: absolute;left: 58%;top: 42%;">Contact:</p> <input type="number" name="contact" style="width: 15%; position: absolute;left: 64%;top: 42%;" maxlength="10" minlength="10" required>

                    <p style="font-family: cursive; font-size: 20px;position: absolute;left: 22%;top: 57%;">Address:</p> <input type="text" name="address" style="width: 15%; position: absolute;left: 29%;top: 57%;" required>

                    <p style="font-family: cursive; font-size: 20px;position: absolute;left: 62%;top: 57%;">City:</p> <input type="text" name="city" style="width: 13%; position: absolute;left: 66%;top: 57%;" required>


                    <br><br><br><br><br><br><br><br><br><br>
                    <button type="submit" name="submit" style="position: absolute;left: 45%;top: 70%;">REGISTER</button>
                </form>
            </div>
        </div>

   </center>

   <?php
   // session_start();
   require_once("includes.html");
   function newBranch()
   {
    include "DBconnect.php";
    $cid=$_POST['cid'];
    $name=$_POST['name'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $contact=$_POST['contact'];
    $sql= "INSERT INTO Branch(CID,name,address,city,contact) VALUES ('$cid','$name','$address','$city','$contact')";

    if(mysqli_query($conn,$sql))
    {
        // echo "<h2> Branch ADDED SUCCESSFULLY!!</h2>";
        echo "<script>
        swal({ 
          title: 'Successful!',
          text: 'Branch ADDED SUCCESSFULLY!!',
          type: 'success' 
          },
          function(){
            window.location.href = 'NewBranch.php';
            });
            </script>";
        // header("Refresh:3;url=NewBranch.php");
        }
        else
        {   
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    function checkcid()
    {
        include "DBconnect.php";
        $cid=$_POST['cid'];
        $sql1="SELECT *FROM Branch WHERE CID='$cid'";
        $result=mysqli_query($conn,$sql1);
        if(mysqli_num_rows($result)!=0)
        {
            // echo "<b><br>CID ALREADY EXISTS</b>";
            echo "<script>
        swal({ 
          title: 'CID ALREADY EXISTS!',
          text: 'TRY WITH A DIFFERENT CID!!',
          type: 'error' 
          },
          function(){
            window.location.href = 'NewBranch.php';
            });
            </script>";
        }
        else
        {  
            if(isset($_POST['submit']))
            { 
              newBranch();
          }
      }
  }
  if(isset($_POST['submit']))
  {
    checkcid();
}
?>
</body>
</html>