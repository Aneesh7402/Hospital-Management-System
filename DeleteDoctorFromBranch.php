<html>
<head>
<script src="jquerypart.js" type="text/javascript"></script>
<link rel="stylesheet" href="adminmain.css"> 
<script>
function getState(val)
{
	$.ajax
    ({
	    type: "POST",
	    url: "getBranch.php",
	    data:'city='+val,
	    success: function(data)
        {
	    	$("#Branch-list").html(data);
	    }
	});
}
function getDoctorday(val) 
{
	$.ajax
    ({
	    type: "POST",
	    url: "getdoctorday.php",
	    data:'cid='+val,
	    success: function(data)
        {
		    $("#doctor-list").html(data);
    	}
	});
}
</script>
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
                            <a href="ShowDoctor.php" style="font-family: cursive;">Show all Doctors</a>
                            <a href="DoctorSchedule" style="font-family: cursive;">Doctor Schedules</a>
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
            <center><h1 style="font-family: cursive">REMOVE DOCTOR FROM A Branch</h1><hr>
                <form method="post" action=""> 
                <label style="font-size:20px" style="font-family: cursive">City:</label>
		    <select name="city" id="city-list" class="demoInputBox"  onChange="getState(this.value);">
		    <option value="" style="font-family: cursive">Select City</option>
		    <?php
		        include 'DBconnect.php';
		        $sql1="SELECT distinct city FROM Branch";
                $results=$conn->query($sql1); 
                while($rs=$results->fetch_assoc()) 
                { 
		    ?>
		    <option value="<?php echo $rs["city"]; ?>"><?php echo $rs["city"]; ?></option>
		    <?php
		        }
		    ?>
		    </select>

            <label style="font-size:20px" style="font-family: cursive">Branch:</label>
		    <select id="Branch-list" name="Branch" onchange="getDoctorday(this.value);" >
            <option value="" style="font-family: cursive">Select Branch</option>
		    </select>
		
		    <label style="font-size:20px" style="font-family: cursive">Doctor & Time:</label>
		    <select name="doctor" id="doctor-list" >
            <option value="" style="font-family: cursive">Select Day & Time</option>
		    </select>
		
		
		    <button name="submit" type="submit">Submit</button>
	    </form>
        <?php
        session_start();
        require_once("includes.html");
        include 'DBconnect.php';
        if(isset($_POST['submit']))
        {
	        $cid=$_POST['Branch'];
	        $rest=$_POST['doctor'];
	        $sql = "DELETE FROM doctor_available WHERE CID= $cid AND DID= $rest";

	        if (mysqli_query($conn, $sql))
		    {
	        	// echo "Record deleted successfully!!";
	        	// header( "Refresh:2; url=DeleteDoctorFromBranch.php");
                echo "<script>
                        swal({ 
                            title: 'Record deleted successfully!!',
                            text: '',
                            type: 'success' 
                            },
                            function(){
                              window.location.href = 'DeleteDoctorFromBranch.php';
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