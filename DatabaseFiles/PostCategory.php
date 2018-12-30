 <?php 
 header("Content-: application/json", true);
 require_once 'database_connections.php';


 if($_GET['action']=='CreateNewPostCategory')
 {

 
 	$PostCategory  = $_POST['PostCategory'];
 	$CreatedBy  = $_SESSION['UserId'];


 	$query = "INSERT INTO postcategory (PostCategory,CreatedBy, CreatedDate ) VALUES 
    ( ?,?,CURRENT_TIMESTAMP)";

    $result = $con->prepare($query);
    $var = $result->execute(array($PostCategory,$CreatedBy));
    

    echo json_encode($var);
 	
 }

 if($_GET['action']=='UpdatePostCategory')
 {

 	$PostCategoryId  = $_POST['PostCategoryId'];

 	$PostCategory  = $_POST['PostCategory'];
 	$ModifiedBy  = $_SESSION['UserId'];

 	$query = "Update postcategory set  PostCategory = :PostCategory
 	, ModifiedBy = :ModifiedBy , ModifiedDate = Now()
 	where PostCategoryId = :PostCategoryId ";

 	$statement = $con->prepare($query);

 	$statement->bindValue(':PostCategory', $PostCategory);

 	$statement->bindValue(':ModifiedBy', $ModifiedBy);
 	$statement->bindValue(':PostCategoryId', $PostCategoryId);
 	$statement->execute();

 	echo json_encode($statement->execute());
 	
 }


 if($_GET['action']=='DeletePostCategory')
 {

 	$PostCategoryId  = $_POST['PostCategoryId'];
 	$ModifiedBy  = $_SESSION['UserId'];

 	$query = "Update postcategory set IsActive = 0 ,ModifiedBy = :ModifiedBy , ModifiedDate = Now() where PostCategoryId = :PostCategoryId ";
 	$statement = $con->prepare($query);
 	
 	$statement->bindValue(':ModifiedBy', $ModifiedBy);

 	
 	$statement->bindValue(':PostCategoryId', $PostCategoryId);
 	$statement->execute();

 	echo json_encode($statement->execute());
 	
 }


 if($_GET['action']=='GetAllPostCategory')

 {
 	$query = "SELECT * from postcategory  where  IsActive =1";
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
