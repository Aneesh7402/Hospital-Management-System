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
            <li class="dropdown">
                    <br><br>
                    <a class="dropbtn" style="font-family: cursive;">Admin_deletes</a>
                    <div class="dropdown-content">
                        <a href="deldocs.php" style="font-family: cursive;">Deleted_doctors</a>
                        <a href="delappoints.php" style="font-family: cursive;">cancelled appointments due to doctor deletion</a>
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
    <style>
    table{
        width:80%;
        border-collapse:separate;
        border: 5px black;
        padding: 2px;
        font-size: 30px;
        font-family: cursive;
    }
    th{
        border: 2px black;
        background-color:peru ;
        color: white;
        text-align: left;
    }
    tr,td{
        border: 2px black;
        background-color: whitesmoke;
        color:black;
    }
    </style>
    <?php include "DBconnect.php"; ?>
    <body style="background-color: whitesmoke;">
            <center>
            <?php
            include 'DBconnect.php';
            session_start();
        	$username=$_SESSION['username'];
	        $sql1 = "Select * from cancelled_by_admin";
			$result1=mysqli_query($conn, $sql1);  
			echo "<table>
					<tr>
					<th>Appointment-Date</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Doc_name</th>
					<th>Clinic_name</th>
					<th>Booked-On</th>
					</tr>";
			while($row1 = mysqli_fetch_array($result1))
			{
				$sql2="SELECT * from deleted_doctors where DID='".$row1['DID']."'";
				$result2= mysqli_query($conn,$sql2);
				while($row2= mysqli_fetch_array($result2))
				{
					$sql3="SELECT * from branch where branch.CID='".$row1['CenterID']."'";
						$result3= mysqli_query($conn,$sql3);
						while($row3= mysqli_fetch_array($result3))
						{
								echo "<tr>";
								echo "<td>" . $row1['DOV'] . "</td>";
								echo "<td>" . $row1['Fname'] . "</td>";
								echo "<td>" . $row1['gender']. "</td>";
								echo "<td>" . $row3['name'] . "</td>";
								echo "<td>" . $row2['name'] . "</td>";
								echo "<td>" . $row1['DateOfBooking'] . "</td>";
								echo "</tr>";
						}
				}
				
			}
	?>
</center>
</body>
</html>