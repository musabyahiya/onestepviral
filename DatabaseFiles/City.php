 <?php 
 header("Content-Type: application/json", true);
 require_once 'database_connections.php';


 if($_GET['action']=='CreateNewCity')
 {

 	$CountryId  = $_POST['CountryId'];
 	$City  = $_POST['City'];
 	$query = "INSERT INTO city( City, CountryId, IsActive ) VALUES (?,?,1)";

 	$result = $con->prepare($query);
 	$var = $result->execute(array($City,$CountryId));

 	echo json_encode($var);
 }

 if($_GET['action']=='GetAllCity')
     {

 	$query = "SELECT C.CountryId , C.City , CC.Country as 'Country'
 	from city C inner join country CC on CC.CountryId = C.CountryId
 	  where  C.IsActive =1";
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