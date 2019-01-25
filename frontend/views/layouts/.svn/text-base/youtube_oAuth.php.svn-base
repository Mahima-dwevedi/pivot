<?php 
global $client_id;
global $client_secret;
global $demo_redirect_uri;
global $response_type;
global $access_type;

$client_id = '946074942813-aka052b5h4hla81tk8lgtt0sfnjk1qqj.apps.googleusercontent.com';
$client_secret = 'bdV5GQIwA2nykos7TijuYYhu';
$demo_redirect_uri = 'http://localhost/uturn/site/signup';
//$demo_scope = 'https://gdata.youtube.com/feeds/api/users/default?v=2';
$demo_scope = 'https://gdata.youtube.com';
//$demo_scope = 'https://www.googleapis.com/auth/youtube.force-ssl';
$response_type = 'code';
$access_type = 'offline';

//Oauth 2.0: exchange token for session token so multiple calls can be made to api
if(isset($_REQUEST['code'])){
	$_SESSION['accessToken'] = get_oauth2_token($_REQUEST['code']);
}
//echo $_REQUEST['code'];
//returns session token for calls to API using oauth 2.0
function get_oauth2_token($code) {
	global $client_id;
	global $client_secret;
	global $demo_redirect_uri;
	
	$oauth2token_url = "https://accounts.google.com/o/oauth2/token";
	$clienttoken_post = array(
	"code" => $code,
	"client_id" => $client_id,
	"client_secret" => $client_secret,
	"redirect_uri" => $demo_redirect_uri,
	"grant_type" => "authorization_code"
	);
	
	$curl = curl_init($oauth2token_url);
        
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	$json_response = curl_exec($curl);
	curl_close($curl);

	$authObj = json_decode($json_response);
	
	//echo '<pre>';print_r($authObj); die;
	$accessToken = $authObj->access_token;
       // call_api($accessToken,$oauth2token_url);
            if (isset($authObj->refresh_token)){    
		global $refreshToken;
		$refreshToken = $authObj->refresh_token;
		
		$oauth2token_url = "https://accounts.google.com/o/oauth2/token";
		$clienttoken_post = array(
		"client_id" => $client_id,
		"client_secret" => $client_secret,
		"refresh_token" => $refreshToken,
		"grant_type" => "refresh_token"
		);
		
		$curl = curl_init($oauth2token_url);

		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	
		$json_response = curl_exec($curl);
		curl_close($curl);
	
		$authObj = json_decode($json_response);
			//echo '<pre>';print_r($authObj); die;
		}
		
		//echo '<pre>';print_r($accessToken); die;
                call_api($accessToken);
	return $accessToken;
}
//calls api and gets the data
function call_api($accessToken){
	$url = 'https://www.googleapis.com/youtube/v3/channels?part=id&mine=true&access_token=' ;
	$curl = curl_init($url);
	
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);	
	$curlheader[0] = "Authorization: Bearer " . $accessToken;
	curl_setopt($curl, CURLOPT_HTTPHEADER, $curlheader);

	$json_response = curl_exec($curl);
        //echo '<pre>';print_r($json_response); die;
	curl_close($curl);
        //return $json_response;
	//var_dump($json_response);die;
	$responseObj = json_decode($json_response);
        //echo '<pre>';print_r($responseObj); die;
	return $responseObj;	
        
}
$loginUrl = sprintf("https://accounts.google.com/o/oauth2/auth?client_id=%s&redirect_uri=%s&scope=%s&response_type=code&access_type=%s&approval_prompt=force",$client_id,$demo_redirect_uri,$demo_scope,$access_type);
//$loginUrl = sprintf("https://accounts.google.com/o/oauth2/auth?scope=%s&redirect_uri=%s&response_type=code&client_id=%s",$demo_scope,$demo_redirect_uri,$client_id);
?>