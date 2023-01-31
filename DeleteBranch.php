<html>
<head>
    <link rel="stylesheet" href="adminmain.css">
</head>
<body style="background-image: url(Images/Pic10.jpg);">
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
    <center><h1 style="font-family: cursive">DELETE Branch</h1><hr>
        <form method="post" action="">  
            <p style="font-family: cursive">Enter CID:<center><input type="number" name="cid"></center>
             <button type="submit" name="submit1" style="font-family: cursive">Delete by CID</button>
             <br><p style="font-family: cursive">---------OR---------<br>
                <p style="font-family: cursive">Select Name:<br>
                    <?php
                    require_once("includes.html");
                    require_once('DBconnect.php');
                    $Branch_result = $conn->query('select * from Branch order by city,CID ASC');
                    ?>
                    <center>
                        <select name="Branchname">
                            <option value="" style="font-family: cursive">---Select Name---</option>
                            <?php
                            if ($Branch_result->num_rows > 0) 
                            {
                                while($row = $Branch_result->fetch_assoc()) 
                                {
                                    ?>
                                    <option value="<?php echo $row["CID"]; ?>"><?php echo $row["name"].", ".$row["city"].",(".$row["address"].")"."(CID=".$row["CID"].")"; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select></center>	
                        <button type="submit" name="submit2">Delete by Name</button>
                    </form>			
                    <?php
                    include 'DBconnect.php';
                    if(isset($_POST['submit1']))
                    {
                       $cid=$_POST['cid'];
                       $sql = "DELETE FROM Branch WHERE CID= $cid ";

                       if (mysqli_query($conn, $sql))
                       {
		            // echo "Record deleted successfully.Refreshing....";
		            // header( "Refresh:2; url=deleteBranch.php");
                        echo "<script>
                        swal({ 
                            title: 'Record deleted successfully!!',
                            text: '',
                            type: 'success' 
                            },
                            function(){
                              window.location.href = 'deleteBranch.php';
                              });
                              </script>";
                          }
                          else
                          {
                             echo "Error deleting record: " . mysqli_error($conn);
                         }
                     }
                     if(isset($_POST['submit2']))
                     {
                       $cid=$_POST['Branchname'];
                       $sql = "DELETE FROM Branch WHERE cid = $cid ";

                       if (mysqli_query($conn, $sql))
                       {
		            // echo "Record deleted successfully.Refreshing....";
		            // header( "Refresh:2; url=deleteBranch.php");
                        echo "<script>
                        swal({ 
                            title: 'Record deleted successfully!!',
                            text: '',
                            type: 'success' 
                            },
                            function(){
                              window.location.href = 'deleteBranch.php';
                              });
                              </script>";
                          }
                          else
                          {
                             echo "Error deleting record: " . mysqli_error($conn);
                         }
                     }	
                     ?>			
                 </body>
                 </html>