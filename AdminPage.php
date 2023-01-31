<html>
    <head>
        <link rel="stylesheet" href="adminmain.css">
    </head>
    <body style="background-image: url(Images/hand3.jpg);">
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
                        <a href="showbranch.php" style="font-family: cursive;">Show Branch</a>
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
                    <form method="POST" action="adminlogin.php">
                        <button type="submit" class="cancelbtn" name="logout" style="float: left;font-size: 20px;font-family: cursive;">LOGOUT</button>
                    </form>
                </li>
            </h2>
        </ul>
        
        <h1 style="font-family: cursive;font-size: 40px;color: black;">WELCOME ADMIN</h1>
    </body>
</html>