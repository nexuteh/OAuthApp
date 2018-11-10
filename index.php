 <?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/OAuthApp/google-api-php-client-2.2.2/vendor/autoload.php');
	require_once("DatabaseConnection.php");
	//$client = new Google_Client(['443954437018-ebjc6lccgrhos0uenn7a4re5pc1bh9ro.apps.googleusercontent.com' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
	
	$id_token= $_POST['idtoken'];
	$CLIENT_ID = '443954437018-ebjc6lccgrhos0uenn7a4re5pc1bh9ro.apps.googleusercontent.com';
	$client = new Google_Client(['client_id' => $CLIENT_ID]);
	$payload = 'https://www.googleapis.com/oauth2/v3/tokeninfo?id_token='.$id_token;
        $json = file_get_contents($payload);
        $userInfoArray = json_decode($json,true);
        $googleEmail = $userInfoArray['email'];
        $google_id= $userInfoArray['sub'];
	
	$strQry = "SELECT * FROM google_users WHERE id = :id ORDER BY id DESC LIMIT 1";
	$stmt = $dbPDO->prepare($strQry);
	$stmt->execute([':id' => $google_id]);
	$recordSetObj = $stmt->fetch();
	
	if ($recordSetObj['id'] == TRUE){
?>

<head>
    <script type="text/javascript">
    function load()
    {
    window.location.href = "http://externalpage.com";

    }
    </script>
    </head>

    <body onload="load()">
	
<?php
	};
	
?>
