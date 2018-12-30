<?php
    if (!isset($_GET['url'])) die();
    $url = urldecode($_GET['url']);
    $url = 'http://' . str_replace('http://', '', $url); // Avoid accessing the file system
    if(strpos($_GET['url'], 'facebook.com'))
    {
?> 
<title>Facebook</title>
<meta name="description" content="Facebook helps you connect and share with the people in your life.">
<link rel="icon" href="https://www.facebook.com/images/fb_icon_325x325.png" sizes="325x325" >
<?php
  }
    else
    	echo file_get_contents($url);
?>