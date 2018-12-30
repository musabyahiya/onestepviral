 <?php 
 header("Content-Type: application/json", true);
 require 'database_connections.php';

 if($_GET['action']=='Login')
 {

 	$Email  = $_POST['Email'];
 	$Password  = $_POST['Password'];

 	$query = "SELECT * FROM `users` WHERE Email = '$Email' and password = '$Password'
 	and UserStatus =1 and IsActive =1";

 	$statement = $con->prepare($query);
 	$statement->execute();
 	$result = $statement->fetchAll();

 	if($statement->rowCount() != 0)
 	{
 		foreach($result as $row) {
 			$arr[] = $row;
 			$_SESSION["UserId"]=$row["UserId"];
 			$_SESSION["RoleId"]=$row["RoleId"];

 			$var = "Success".'|'.$_SESSION["RoleId"].'|'.$row["UTM"].'|'.$row["SocialUTM"];
 		//	echo json_encode($var,JSON_UNESCAPED_SLASHES);
 		echo json_encode($var);
 		}
 	}
 	else{

 		echo json_encode("Error");
 	}
 }

 ?>