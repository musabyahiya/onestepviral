 <?php 
 header("Content-Type: application/json", true);
 require 'database_connections.php';


 if($_GET['action']=='CreateNewUsers')
 {

 	$Email  = $_POST['Email'];
 	$FirstName  = $_POST['FirstName'];
 	$LastName  = $_POST['LastName'];
 	$Password  = $_POST['Password'];
 	$Phone  = $_POST['Phone'];
 	$BankName  = $_POST['BankName'];
 	$AccountTitle  = $_POST['AccountTitle'];
 	$AccountNumber  = $_POST['AccountNumber'];
 	$PayEmail  = $_POST['PayEmail'];
 	$UTM  = $_POST['UTM'];
 	$SocialUTM  = $_POST['SocialUTM'];
 	$Pages  = $_POST['Pages'];
 	$RoleId = 2;
 	$UserStatus = 2;

 	$CreatedBy  = $_SESSION['UserId'];

 	$query = "INSERT INTO users( FirstName, LastName, Password, Email, Phone, BankName, AccountTitle, 
 	AccountNumber,PayEmail, UTM, Pages, CreatedBy, CreatedDate, RoleId , UserStatus ) VALUES 
 	( ?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,?,?)";
 	$result = $con->prepare($query);
 	$var = $result->execute(array($FirstName,$LastName,$Password,$Email,$Phone,$BankName,$AccountTitle,$AccountNumber,$PayEmail,$UTM,$SocialUTM,$Pages,$CreatedBy,$RoleId,$UserStatus));
 	

 	echo json_encode($var);
 	
 }

 if($_GET['action']=='DeleteUsers')
 {

 	$UserId  = $_POST['UserId'];
 	$ModifiedBy  = $_SESSION['UserId'];

 	$query = "UPDATE users set IsActive = 0, ModifiedBy = :ModifiedBy, ModifiedDate = Now()  
 	WHERE UserId = :UserId";
 	$statement = $con->prepare($query);
 	
 	$statement->bindValue(':ModifiedBy', $ModifiedBy);

 	
 	$statement->bindValue(':UserId', $UserId);
 	$statement->execute();

 	echo json_encode($statement->execute());
 	
 }
 if($_GET['action']=='CreateNewUsersSignup')
 {

 	$Email  = $_POST['Email'];
 	$FirstName  = $_POST['FirstName'];
 	$LastName  = $_POST['LastName'];
 	$Password  = $_POST['Password'];
 	$Phone  = $_POST['Phone'];
 	$CountryId  = $_POST['CountryId'];
 	$CityId  = $_POST['CityId'];
 	$FbURL  = $_POST['FbURL'];
 	$Pages  = $_POST['Pages'];
 	$UserStatus  = 2;
 	$CreatedBy  = -1;
 	$RoleId = 2;


 	$query = "INSERT INTO users(Email, FirstName, LastName, Password, Phone,CountryId, CityId,FbURL,Pages, CreatedBy, CreatedDate, RoleId,UserStatus) VALUES (?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,?,?)";

 	$result = $con->prepare($query);
 	$var = $result->execute(array($Email,$FirstName,$LastName,$Password,$Phone,$CountryId,$CityId,$FbURL,$Pages,$CreatedBy,$RoleId,$UserStatus));

 	echo json_encode($var);
 	
 }

 if($_GET['action']=='GetAllUsers')

 {
 	$query = '';
 	$UserId = $_SESSION['UserId'];
 	$RoleId = $_SESSION['RoleId'];
 	if($RoleId==1)
 	{
 		$query = "Select *  , CountryId as 'Country', CityId as 'City',REPLACE(Pages, '|', '<br>') as 'PagesBind' from users U
 		where  U.IsActive =1 and RoleId !=1 order by U.UserId desc";
 	}
 	else
 	{
 		$query = "Select *,REPLACE(Pages, '|', '<br>') as 'PagesBind' from users where  IsActive =1 and RoleId !=1
 		and UserId = :UserId order by UserId desc";
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

 if($_GET['action']=='GetUserInfo')

 {
 	$UserId =  $_SESSION['UserId'];
 	$query = "Select * from users 
 	where UserId= :UserId";
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



 if($_GET['action']=='GetAllMenus')

 {
 	$RoleId =  $_SESSION['RoleId'];
 	$query = "Select M.MenuItemName,M.Icon, M.MenuItemURL from menuitems M
 	inner join rolemenumapping RM on RM.MenuItemId = M.MenuItemId
 	where RM.RoleId= :RoleId and M.IsActive = 1 order by M.MenuOrder";
 	$statement = $con->prepare($query);
 	$statement->bindValue(':RoleId', $RoleId); 
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


 if($_GET['action']=='GetAllCountry')

 {
 	$query = "Select CountryId as 'Id',Country  as 'Value' from country where  IsActive =1  order by Country ";
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

 if($_GET['action']=='GetAllCity')

 {
 	$query = "Select CityId as 'Id',City  as 'Value' , CountryId from city where  IsActive =1  order by City ";
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
 if($_GET['action']=='UpdateUsers')

 {
 	$UserId  = $_POST['UserId'];
 	$Email  = $_POST['Email'];
 	$FirstName  = $_POST['FirstName'];
 	$LastName  = $_POST['LastName'];
 	$Password  = $_POST['Password'];
 	$Phone  = $_POST['Phone'];
 	$BankName  = $_POST['BankName'];
 	$AccountTitle  = $_POST['AccountTitle'];
 	$AccountNumber  = $_POST['AccountNumber'];
 	$PayEmail  = $_POST['PayEmail'];
 	$UTM  = $_POST['UTM'];
 	$SocialUTM  = $_POST['SocialUTM'];
 	$Pages  = $_POST['Pages'];
 	$ModifiedBy  = $_SESSION['UserId'];

 	$query = "UPDATE users SET Email=:Email,FirstName= :FirstName,LastName= :LastName,Password= :Password,
 	Phone= :Phone,BankName= :BankName,AccountTitle= :AccountTitle,AccountNumber=:AccountNumber,PayEmail= :PayEmail,
 	UTM= :UTM,SocialUTM=:SocialUTM,Pages= :Pages,ModifiedBy= :ModifiedBy,ModifiedDate= Now()
 	WHERE 
 	UserId =  :UserId and IsActive =  1";

 	$statement = $con->prepare($query);

 	$statement->bindValue(':UserId', $UserId);
 	$statement->bindValue(':Email', $Email);
 	$statement->bindValue(':FirstName', $FirstName);
 	$statement->bindValue(':LastName', $LastName);
 	$statement->bindValue(':Password', $Password);
 	$statement->bindValue(':Phone', $Phone);
 	$statement->bindValue(':BankName', $BankName);
 	$statement->bindValue(':AccountTitle', $AccountTitle);
 	$statement->bindValue(':AccountNumber', $AccountNumber);
 	$statement->bindValue(':PayEmail', $PayEmail);
 	$statement->bindValue(':UTM', $UTM);
 	$statement->bindValue(':SocialUTM', $SocialUTM);
 	$statement->bindValue(':Pages', $Pages);
 	$statement->bindValue(':ModifiedBy', $ModifiedBy);
 	$statement->execute();

 	echo json_encode($statement->execute());
 }


 if($_GET['action']=='UpdateProfileUsers')

 {
 	$UserId  = $_SESSION['UserId'];

 	$FirstName  = $_POST['FirstName'];
 	$LastName  = $_POST['LastName'];
 	$Password  = $_POST['Password'];
 	$Phone  = $_POST['Phone'];
 	$BankName  = $_POST['BankName'];
 	$AccountTitle  = $_POST['AccountTitle'];
 	$AccountNumber  = $_POST['AccountNumber'];
 	$PayEmail  = $_POST['PayEmail'];
 	$PayPalEmail  = $_POST['PayPalEmail'];
 	$CountryId  = $_POST['CountryId'];
 	$CityId  = $_POST['CityId'];
 	$FbURL  = $_POST['FbURL'];
 	$Pages  = $_POST['Pages'];
 	$ModifiedBy  = $_SESSION['UserId'];

 	$query = "UPDATE users SET FirstName= :FirstName,LastName= :LastName,Password= :Password,
 	Phone= :Phone,BankName= :BankName,AccountTitle= :AccountTitle,AccountNumber=:AccountNumber,PayEmail= :PayEmail,PayPalEmail= :PayPalEmail,
 	CountryId= :CountryId,CityId= :CityId,FbURL=:FbURL,Pages=:Pages,ModifiedBy= :ModifiedBy,ModifiedDate= Now()
 	WHERE 
 	UserId =  :UserId and IsActive =  1";

 	$statement = $con->prepare($query);

 	$statement->bindValue(':UserId', $UserId);

 	$statement->bindValue(':FirstName', $FirstName);
 	$statement->bindValue(':LastName', $LastName);
 	$statement->bindValue(':Password', $Password);
 	$statement->bindValue(':Phone', $Phone);
 	$statement->bindValue(':BankName', $BankName);
 	$statement->bindValue(':AccountTitle', $AccountTitle);
 	$statement->bindValue(':AccountNumber', $AccountNumber);
 	$statement->bindValue(':PayEmail', $PayEmail);
 	$statement->bindValue(':PayPalEmail', $PayPalEmail);
 	$statement->bindValue(':CountryId', $CountryId);
 	$statement->bindValue(':CityId', $CityId);
 	$statement->bindValue(':FbURL', $FbURL);
 	$statement->bindValue(':Pages', $Pages);
 	$statement->bindValue(':ModifiedBy', $ModifiedBy);
 	$statement->execute();

 	echo json_encode($statement->execute());
 }



 if($_GET['action']=='CheckUserEmail')

 {
 	$Email  = $_POST['Email'];
 	$query = "Select * from users where Email = '$Email'";

 	$statement = $con->prepare($query);
 	$statement->execute();
 	$result = $statement->fetchAll();

 	if($statement->rowCount() != 0)
 	{
 		foreach($result as $row) {
 			echo $json_info = json_encode(1);
 		}
 	}
 	else{

 		echo $json_info = json_encode(0);
 	}

 	
 }

 if($_GET['action']=='EditStatus')

 {
 	$UserId  = $_POST['UserId'];
 	$UserStatus  = $_POST['UserStatus'];
 	$ModifiedBy  = $_SESSION['UserId'];

 	if($UserStatus==1)
 	{
 		$UserStatus=2;
 	}
 	else
 	{
 		$UserStatus=1;
 	}

 	$query = "UPDATE users SET UserStatus=:UserStatus,ModifiedBy=:ModifiedBy,ModifiedDate=Now()
 	WHERE 
 	UserId = :UserId and IsActive = 1";
 	$statement = $con->prepare($query);
 	$statement->bindValue(':UserStatus', $UserStatus);
 	$statement->bindValue(':ModifiedBy', $ModifiedBy);
 	$statement->bindValue(':UserId', $UserId);
 	$statement->execute();

 	echo json_encode($statement->execute());
 }

 ?>
