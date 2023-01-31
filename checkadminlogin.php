<?php
function signin()
{
    session_start();
    $conn = mysqli_connect('localhost','root','','appointment');    
    $username= $_POST['uname'];
    $password=$_POST['pwd'];
    $_SESSION['username'] = $_POST['uname'];   
    $query= "SELECT username,password from admintable where username='".$username."' and password= '".$password."'";

    $result=mysqli_query($conn,$query) or die($mysqli_error($conn));

    $num=mysqli_num_rows($result);

    if($num == 0)
    {
        header("Location:AdminPage.php");
  
    }

    else
    {
        $row=mysqli_fetch_array($result);
        $_SESSION['username'] = $row['username'];
        
        echo "<script>
    swal({ 
        title: 'Successful!!',
        text: 'Welcome!',
        type: 'success' 
        },
        function(){
            window.location.href = 'AdminPage.php';
            });
            </script>";   
    }}
    if(isset($_POST['submit'])) 
    { 
     signin(); 
 }    
 ?>