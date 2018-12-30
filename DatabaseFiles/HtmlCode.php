<?php
header("Content-Type: application/json", true);
require_once 'database_connections.php';





/* if($_GET['action']=='UpdateCode')
 {
 	$HtmlCode  = $_POST['HtmlCode'];
 	$myfile = fopen("../Pages/Iframe.php", "w") or die("Unable to open file!");
    $txt = $HtmlCode;
    fwrite($myfile, $txt);
    fclose($myfile);
 

 	echo json_encode(true);
 	
 }
 */
 
 if($_GET['action']=='UpdateCode')
 {
     $HtmlCode  = $_POST['HtmlCode'];
 	$query = "Update HtmlCode set HtmlCode= :HtmlCode ";

 	$statement = $con->prepare($query);
 	$statement->bindValue(':HtmlCode', $HtmlCode);
 	$statement->execute();

 	echo json_encode($statement->execute());
 }
 
 if($_GET['action']=='GetAllHtmlCode')

 {
 	$query = "Select * from HtmlCode";
 	$statement = $con->prepare($query);
 	$statement->execute();
 	$result = $statement->fetchAll();

 	$arr = array();
 	if($statement->rowCount() != 0) {
 		foreach($result as $row) {
 			$arr[] = $row;
 		}
 	}

 	echo $json_info = json_encode($arr);
 }
 
?>

