<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type="text/javascript">//alert("sdfsd");</script>
<body>
<?php
require_once("DBconnect.php");
	$query ="SELECT * FROM Branch WHERE City = '" . $_POST["city"] . "'";
	$results = $conn->query($query);
?>
	<option value="">Select Branch</option>
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option value="<?php echo $rs["CID"]; ?>"><?php echo $rs["name"]."-"."(CID-".$rs["CID"].")"; ?></option>
<?php

}
?>
</body>
</html>