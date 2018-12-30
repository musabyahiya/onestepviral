 <?php 
 header("Content-Type: application/json", true);
 require_once 'database_connections.php';


 if($_GET['action']=='CreateNewPayout')
 {
 	$UserId  = $_POST['UserId'];
 	$PaymentStatusId  = $_POST['PaymentStatusId'];
 	$Duration  = $_POST['Duration'];
 	$Amount  = $_POST['Amount'];
 	$Comments  = $_POST['Comments'];
 	$ConversionRate  = $_POST['ConversionRate'];
 	$Revenue  = $_POST['Revenue'];
 	$FilePath  = str_replace('"', "", $_POST['FilePath']);
 	$CreatedBy  = $_SESSION['UserId'];


 	$query = "INSERT INTO payout(UserId,PaymentStatusId , Duration,Amount,Comments, ConversionRate,Revenue,FilePath, CreatedBy, CreatedDate ) VALUES 
 	( ?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP)";

 	$result = $con->prepare($query);
 	$var = $result->execute(array($UserId,$PaymentStatusId,$Duration,$Amount,$Comments,$ConversionRate,$Revenue,$FilePath,$CreatedBy));
 	

 	echo json_encode($var);
 	
 }

 
 if($_GET['action']=='GetAllUsers')

 {
     $query = "Select UserId as 'Id',CONCAT(Email, ' - ', UTM)  as 'Value' from users where  IsActive =1 and RoleId !=1 
     UNION ALL 
     Select UserId as 'Id',CONCAT(Email, ' - ', SocialUTM)  as 'Value' from users where  IsActive =1 and RoleId !=1";
 	//$query = "Select UserId as 'Id',CONCAT(Email, ' - ', UTM)  as 'Value' from users where  IsActive =1 and RoleId !=1 order by UserId desc";
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

 if($_GET['action']=='UpdatePayout')
 {
 
 	$UserId  = $_POST['UserId'];
 	$PayoutId  = $_POST['PayoutId'];
 	$PaymentStatusId  = $_POST['PaymentStatusId'];
 	$Duration  = $_POST['Duration'];
 	$Amount  = $_POST['Amount'];
 	$Comments  = $_POST['Comments'];
 	$ConversionRate  = $_POST['ConversionRate'];
 	$Revenue  = $_POST['Revenue'];
 	$FilePath  = str_replace('"', "", $_POST['FilePath']);
 	$ModifiedBy  = $_SESSION['UserId'];

 	$query = "Update payout set UserId= :UserId,  PaymentStatusId = :PaymentStatusId, Duration = :Duration, Amount = :Amount,Comments=:Comments,ConversionRate = :ConversionRate,Revenue=:Revenue, FilePath = :FilePath,ModifiedBy = :ModifiedBy , ModifiedDate = Now()
 	where PayoutId = :PayoutId ";

 	$statement = $con->prepare($query);
 	$statement->bindValue(':UserId', $UserId);
 	$statement->bindValue(':PayoutId', $PayoutId);
 	$statement->bindValue(':PaymentStatusId', $PaymentStatusId);
 	$statement->bindValue(':Duration', $Duration);
 	$statement->bindValue(':Amount', $Amount);
 	$statement->bindValue(':Comments', $Comments);
 	$statement->bindValue(':ConversionRate', $ConversionRate);
 	$statement->bindValue(':Revenue', $Revenue);
 	$statement->bindValue(':FilePath', $FilePath);
 	$statement->bindValue(':ModifiedBy', $ModifiedBy);
 	
 	$statement->execute();

 	echo json_encode($statement->execute());
 	
 }


 if($_GET['action']=='DeletePayout')
 {

 	$PayoutId  = $_POST['PayoutId'];
 	$ModifiedBy  = $_SESSION['UserId'];

 	$query = "Update payout set IsActive = 0 ,ModifiedBy = :ModifiedBy , ModifiedDate = Now() where PayoutId = :PayoutId ";
 	$statement = $con->prepare($query);
 	
 	$statement->bindValue(':ModifiedBy', $ModifiedBy);

 	
 	$statement->bindValue(':PayoutId', $PayoutId);
 	$statement->execute();

 	echo json_encode($statement->execute());
 	
 }


 if($_GET['action']=='GetAllPaymentStatus')

 {
 	$query = "SELECT PaymentStatusId as 'Id', Name as 'Value' from paymentstatus  where  IsActive =1";
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

 if($_GET['action']=='GetAllPayout')

 {
 	$query = '';
 	$UserId = $_SESSION['UserId'];
 	$RoleId = $_SESSION['RoleId'];
 	if($RoleId==1)
 	{
 		$query = "select P.PayoutId,PS.Name as 'PaymentStatus' ,u.UserId, CONCAT(Email, ' - ', UTM) as 'Email',u.FirstName, u.LastName, P.PaymentStatusId, P.Amount,P.Comments,P.Duration,P.Revenue, P.ConversionRate,P.FilePath,P.CreatedDate, Month(P.CreatedDate) as 'Month' ,Year (P.CreatedDate) as 'Year' from payout P inner join paymentstatus PS on PS.PaymentStatusId = P.PaymentStatusId inner join users u on u.UserId = P.UserId where P.IsActive = 1 order by P.CreatedDate desc";
 	}
 	else

 	{
 		$query = "select P.PayoutId,PS.Name as 'PaymentStatus' ,u.UserId,
 	CONCAT(Email, ' - ', UTM) as 'Email',u.FirstName, u.LastName,
 	P.PaymentStatusId, P.Amount,P.Comments,P.Duration,P.Revenue, P.ConversionRate,P.FilePath,P.CreatedDate, Month(P.CreatedDate) as 'Month' ,Year (P.CreatedDate) as 'Year' from payout P inner join paymentstatus PS on PS.PaymentStatusId = P.PaymentStatusId
 	inner join users u on u.UserId = P.UserId
 	where P.IsActive = 1 and u.UserId = :UserId order by P.CreatedDate desc";
 	}
 	
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
 





 ?>
