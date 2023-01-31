<html>
<head>
    <link rel="stylesheet" href="main.css">
</head>
<body style="background-image: url(Images/4.jpg);">
<div class="header">
    <ul>
        <li style="float: left; border-right: none;"> <a href="Home.php" class="logo"> <img src="Images/Pic2.png" width="70px" height="60px"> <strong> Apollo </strong> Online Apppointment System </a> </li>
        <li> <a href="Home.php"><strong> HOME </strong></a></li>
    </ul>
</div>
<form action="GetQuery.php" method="POST">
    <div class="sucontainer">
        <label style="color: black"><b>Enter Query:</b> </label>
        <input type="text" placeholder="Enter Query here" name="query" required><br>
        
            <button type="button" style="float: right;" onclick="window.location.href='Home.php'"class="cancelbtn">Cancel</button>
            <button type="submit" name="confirm" style="float:left">Confirm</button>
        </div>
    </div>
</form>
</body>
</html>