<?php
	function postData($service_url, $curl_post_data){ 
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) { 
			$info = curl_getinfo($curl);
			curl_close($curl);
			die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($curl);
		return $curl_response;
	} 

	function decodeData($curl_response){
		$decoded = json_decode($curl_response); 
		if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') { 
			die('error occured: ' . $decoded->response->errormessage);
		} 
		return $decoded;
	}
	
	//Get URL Inputs
	$url = $_SERVER['REQUEST_URI']; 
	$inputs = explode("/",$url);
	
	//Information For specific Web Page
	$page_title = "";
	$page_keywords = "";
	$page_description = "";
	
	$page_template = "home";
	//Switch to Read URL Code
	if(isset($inputs[2]) && "" != $inputs[2]){
		switch($inputs[2]){
			case "page":
			break;
			default:
				//default page not found. Also known as 404 Error.
				header("Location: /");
		}
	}
?>
<!DOCTYPE html>
   <head>
   <meta charset="UTF-8">
      	<?php
			/*
			Page Titling information
			SEO Meta Tags For search
			*/
	   	?>
        <title><?php echo $page_description; ?></title>
        <meta name="description" content="<?php echo $page_description; ?>">
        <meta name="keywords" content="<?php echo $page_keywords; ?>">
        <meta author="Web Author">
   </head>
   <body>
      <?php
		switch($page_template){
			
			
			case "template":
				//include("_our_work.php"); 
			break;
			default:
				//include("_home.php");
		}
	  
	   ?>
	</body>
</html>
