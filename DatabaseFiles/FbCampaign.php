 <?php 
 header("Content-Type: application/json", true);
 require_once 'database_connections.php';


 if($_GET['action']=='CreateNewCampaign')
 {
    $PostCategoryId  = $_POST['PostCategoryId'];
    $CampaignTypeId  = $_POST['CampaignTypeId'];
    $Title  = $_POST['Title'];
    $TitleImagePath  = $_POST['TitleImagePath'];
    $URL  = $_POST['URL'];
    $CreatedBy  = $_SESSION['UserId'];


    $query = "INSERT INTO fbcampaign (PostCategoryId ,CampaignTypeId , Title, URL,TitleImagePath, CreatedBy, CreatedDate ) VALUES 
    ( ?,?,?,?,?,?,CURRENT_TIMESTAMP)";

    $result = $con->prepare($query);
    $var = $result->execute(array($PostCategoryId,$CampaignTypeId,$Title,$URL,$TitleImagePath,$CreatedBy));
    

    echo json_encode($var);
    
 }
 
 if($_GET['action']=='DeleteSelectedCampaign')
 {

    $Ids  = $_POST['Ids'];
    $ModifiedBy  = $_SESSION['UserId'];

    $statement = $con->query("Update fbcampaign set IsActive = 0,ModifiedBy = $ModifiedBy, ModifiedDate = Now()  where CampaignId in ( $Ids)");
    /*$query = "Update fbcampaign set IsActive = 0 ,ModifiedBy = :ModifiedBy , ModifiedDate = Now() where CampaignId in ( '$Ids')";*/
   // $statement = $con->prepare($query);
    
    $statement->execute();

    echo json_encode($statement->execute());
   // echo $query;
 }

 if($_GET['action']=='UpdateCampaign')
 {

    $PostCategoryId  = $_POST['PostCategoryId'];
    $CampaignId  = $_POST['CampaignId'];
    $CampaignTypeId  = $_POST['CampaignTypeId'];
    $Title  = $_POST['Title'];
    $TitleImagePath  = $_POST['TitleImagePath'];
    $URL  = $_POST['URL'];
    $ModifiedBy  = $_SESSION['UserId'];

    $query = "Update fbcampaign set  PostCategoryId=:PostCategoryId, CampaignTypeId = :CampaignTypeId, Title = :Title, URL = :URL
    ,TitleImagePath= :TitleImagePath, ModifiedBy = :ModifiedBy , ModifiedDate = Now()
    where CampaignId = :CampaignId ";

    $statement = $con->prepare($query);
    $statement->bindValue(':PostCategoryId', $PostCategoryId);
    $statement->bindValue(':CampaignTypeId', $CampaignTypeId);
    $statement->bindValue(':Title', $Title);
    $statement->bindValue(':URL', $URL);
    $statement->bindValue(':TitleImagePath', $TitleImagePath);
    $statement->bindValue(':ModifiedBy', $ModifiedBy);
    $statement->bindValue(':CampaignId', $CampaignId);
    $statement->execute();

    echo json_encode($statement->execute());
    
 }


 if($_GET['action']=='DeleteCampaign')
 {

    $CampaignId  = $_POST['CampaignId'];
    $ModifiedBy  = $_SESSION['UserId'];

    $query = "Update fbcampaign set IsActive = 0 ,ModifiedBy = :ModifiedBy , ModifiedDate = Now() where CampaignId = :CampaignId ";
    $statement = $con->prepare($query);
    
    $statement->bindValue(':ModifiedBy', $ModifiedBy);

    
    $statement->bindValue(':CampaignId', $CampaignId);
    $statement->execute();

    echo json_encode($statement->execute());
    
 }

 if($_GET['action']=='GetAllPostCategory')

 {
    $query = "SELECT PostCategoryId as 'Id', PostCategory as 'Value' from postcategory  where  IsActive =1";
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

 if($_GET['action']=='GetAllCampaignType')

 {
    $query = "SELECT CampaignTypeId as 'Id', Name as 'Value' from campaigntype  where  IsActive =1";
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
 if($_GET['action']=='GetAllSearchResult')

 {
     $Search  = $_POST['Search'];
  $query = "SELECT   C.CampaignTypeId,C.TitleImagePath, C.CampaignId, CT.Name as 'CampaignType', C.Title, C.URL, PC.PostCategory, C.PostCategoryId
    FROM fbcampaign C
    INNER JOIN campaigntype CT ON CT.CampaignTypeId = C.CampaignTypeId
    INNER JOIN postcategory PC on PC.PostCategoryId = C.PostCategoryId
    WHERE C.IsActive = 
    TRUE and (CT.Name like '%$Search%' or C.Title like '%$Search%'  or C.URL like '%$Search%') 
    ORDER BY C.CreatedDate DESC";
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
 if($_GET['action']=='GetAllCampaign')

 {
    $query = "SELECT   C.CampaignTypeId,C.TitleImagePath, C.CampaignId, CT.Name as 'CampaignType', C.Title, C.URL, PC.PostCategory, C.PostCategoryId
    FROM fbcampaign C
    INNER JOIN campaigntype CT ON CT.CampaignTypeId = C.CampaignTypeId
    INNER JOIN postcategory PC on PC.PostCategoryId = C.PostCategoryId
    WHERE C.IsActive = 
    TRUE 
    ORDER BY C.CreatedDate DESC";
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


/* if($_GET['action']=='GetAllCampaign')

 {
    $query = "SELECT C.CampaignTypeId, C.CampaignId, CT.Name as 'CampaignType', C.Title, C.URL
    FROM fbcampaign C
    INNER JOIN campaigntype CT ON CT.CampaignTypeId = C.CampaignTypeId
    WHERE C.IsActive = 
    TRUE 
    ORDER BY C.CreatedDate DESC";
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
*/



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
