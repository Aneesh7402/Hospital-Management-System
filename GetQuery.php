<html>
<head>
    <link rel="stylesheet" href="main.css">
</head>
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
<body style="background-image: url(Images/4.jpg);">
<div class="header">
    <ul>
        <li style="float: left; border-right: none;"> <a href="Home.php" class="logo"> <img src="Images/Pic2.png" width="70px" height="60px"> <strong> Apollo </strong> Online Apppointment System </a> </li>
        <li> <a href="Home.php"><strong> HOME </strong></a></li>
    </ul>
</div>
</body>
</html>
<?php
require_once("includes.html");
$conn=mysqli_connect('localhost','root','','appointment');

if(isset($_POST['confirm'])){
    $query=$_POST['query'];
    
}

$data=mysqli_query($conn,$query);
$num=mysqli_num_rows($data);
$i=0;

if((!($data))){
    echo "<script>
    swal({ 
        title: 'No such Entry',
        text: 'No such rows exist in the database please try again!',
        type: 'error' 
        },
        function(){
            window.location.href = 'ManualQ.php';
            });
            </script>";
        }
        else{
            echo "<script>
                swal({ 
                    title: 'Sign Up Successful!',
                    text: 'Welcome!',
                    type: 'success' 
                    },
                        </script>";
                echo "<table>
                        <tr>";
                        $finfo = $data->fetch_fields();

                        foreach ($finfo as $val) {
                        echo "<th>".$val->name."</th>";
                        }
                        
                    echo "</tr>";
                        while ($row = mysqli_fetch_array($data)) {
                            echo "<tr>";
                            $length=mysqli_num_fields($data);
                            for($i=0;$i<$length;$i++){
                                echo "<td>". ($row[$i])."</td>";
                            }
                            echo "</tr>";
                        }  
             
        }
                ?>