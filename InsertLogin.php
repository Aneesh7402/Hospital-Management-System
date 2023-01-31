<?php
    session_start();
    $conn=mysqli_connect('localhost','root','','appointment');

    $username=$_POST['username'];
    $email=mysqli_real_escape_string($conn,$username);
    $_SESSION['username'] = $_POST['username'];

    $pass=$_POST['psw'];
    $pass=mysqli_real_escape_string($conn,$pass);

    $query= "SELECT username,password from patient where username='".$username."' and password= '".$pass."'";

    $result=mysqli_query($conn,$query) or die($mysqli_error($conn));

    $num=mysqli_num_rows($result);

    if($num == 0)
    {
        header("Location:Header.php");
    }

    else
    {
        $row=mysqli_fetch_array($result);
        $_SESSION['username'] = $row['username'];
        
        header("Location:Login.php");   
    }
?>