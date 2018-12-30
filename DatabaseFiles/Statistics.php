 <?php 
 header("Content-Type: application/json", true);
 require 'database_connections.php';


 if($_GET['action']=='CreateNewStatistics')
 {

 	$UserId  = $_POST['UserId'];
 	$PageViews  = $_POST['PageViews'];
 	$RPM  = $_POST['RPM'];
 	$Revenue  = $_POST['Revenue'];
 	$StatsDate  = $_POST['StatsDate'];
 	$CreatedBy  = $_SESSION['UserId'];

 	$query = "INSERT INTO stats( UserId, PageViews, RPM, Revenue, StatsDate,CreatedBy, CreatedDate ) VALUES (?,?,?,?,?,?,CURRENT_TIMESTAMP )";

 	

 	$result = $con->prepare($query);
 	$var = $result->execute(array($UserId,$PageViews,$RPM,$Revenue,$StatsDate,$CreatedBy));

 	echo json_encode($var);
 }

 if($_GET['action']=='UpdateStatistics')
 {

 	$StatsId  = $_POST['StatsId'];
 	$UserId  = $_POST['UserId'];
 	$PageViews  = $_POST['PageViews'];
 	$RPM  = $_POST['RPM'];
 	$Revenue  = $_POST['Revenue'];
 	$StatsDate  = $_POST['StatsDate'];
 	$ModifiedBy  = $_SESSION['UserId'];

 	$query = "Update stats set   UserId = :UserId, PageViews = :PageViews, RPM = :RPM
 	,Revenue = :Revenue, StatsDate = :StatsDate, ModifiedBy = :ModifiedBy , ModifiedDate = NOW()
 	where StatsId = :StatsId ";

 	$statement = $con->prepare($query);
 	$statement->bindValue(':StatsId', $StatsId);
 	$statement->bindValue(':UserId', $UserId);
 	$statement->bindValue(':PageViews', $PageViews);
 	$statement->bindValue(':RPM', $RPM);
 	$statement->bindValue(':Revenue', $Revenue);
 	$statement->bindValue(':StatsDate', $StatsDate);
 	$statement->bindValue(':ModifiedBy', $ModifiedBy);
 	$statement->execute();

 	echo json_encode($statement->execute());
 	
 }


 if($_GET['action']=='DeleteStatistics')
 {

 	$StatsId  = $_POST['StatsId'];
 	$ModifiedBy  = $_SESSION['UserId'];


 	$query = "Update stats set IsActive = 0 ,ModifiedBy = :ModifiedBy , ModifiedDate = Now() where StatsId = :StatsId and IsActive = 1";
 	$statement = $con->prepare($query);
 	$statement->bindValue(':StatsId', $StatsId);
 	$statement->bindValue(':ModifiedBy', $ModifiedBy);
 	$statement->execute();

 	echo json_encode($statement->execute());
 	
 }


 if($_GET['action']=='GetAllUsers')

 {
 	$query = "Select UserId as 'Id',CONCAT(Email, ' - ', IFNULL(SocialUTM,'EMPTY Social UTM'))  as 'Value' from users where  IsActive =1 and RoleId !=1 order by UserId desc";
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

 if($_GET['action']=='GetAllStatistics')

 {
 	$query = '';
 	$UserId = $_SESSION['UserId'];
 	$RoleId = $_SESSION['RoleId'];
 	if($RoleId==1)
 	{
 		$query = "Select S.StatsId, S.UserId,CONCAT(Email, ' - ', SocialUTM) as 'Email',u.FirstName, u.LastName, S.PageViews, S.RPM, S.Revenue, S.StatsDate,  Month(StatsDate) as 'Month' ,Year (StatsDate) as 'Year' from stats S inner join users u on u.UserId = S.UserId where S.IsActive = 1   order by S.Createddate Desc";
 	}
 	else
 	{
        $query = "Select S.StatsId, S.UserId,CONCAT(Email, ' - ', SocialUTM) as 'Email',u.FirstName, u.LastName, S.PageViews, S.RPM, S.Revenue, S.StatsDate, Month(StatsDate) as 'Month' ,Year (StatsDate) as 'Year' from stats S inner join users u on u.UserId = S.UserId where S.IsActive = 1 and u.UserId = :UserId   order by S.Createddate Desc";	}
 	
 	$statement = $con->prepare($query);
 	$statement->bindValue(':UserId', $UserId);
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
