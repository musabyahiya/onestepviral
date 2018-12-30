 <?php 
 header("Content-Type: application/json", true);
 require_once 'database_connections.php';



 if($_GET['action']=='FileUpload')
 {
 	move_uploaded_file($_FILES['file']['tmp_name'], '../upload/'.$_FILES['file']['name']);
 	//$name = $_FILES['file']['tmp_name'];
 	$name = $_FILES['file']['name'];
 	//echo $name;
 	echo json_encode($name);
 }





 function fileUpload($fieldName, $path)
 {
 	for($i=0;$i<sizeof($_FILES[$fieldName]['name']);$i++)
 	{

 		if(file_exists("../".$path."/" . $_FILES[$fieldName]["name"][$i])){
 			echo $_FILES[$fieldName]["name"][$i] . " is already exists.";
 		} else{
 			move_uploaded_file($_FILES[$fieldName]["tmp_name"][$i], "../".$path."/" . $_FILES[$fieldName]["name"][$i]);
              //  echo "Your file was uploaded successfully.";
 		} 


 	}
 }


 ?>
