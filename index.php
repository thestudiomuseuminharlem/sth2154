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
	$page_title = "Home | Studio Museum";
	$page_keywords = "";
	$page_description = "";
	
	$page_template = "home";
	//Switch to Read URL Code
	if(isset($inputs[1]) && "" != $inputs[1]){
		switch($inputs[1]){
			case "calendar":
			$page_title = "Calendar | Studio Museum";
			break;
			case "on":
			$page_title = "What's On | Studio Museum";
			break;
			case "visit":
			$page_title = "Visit | Studio Museum";
			break;
			case "education":
			$page_title = "Education | Studio Museum";
			break;
			case "collections":
			$page_title = "Collections | Studio Museum";
			break;
			case "support":
			$page_title = "Join & Support Us | Studio Museum";
			break;
			case "search":
			$page_title = "Search | Studio Museum";
			break;
			case "shop":
			$page_title = "Shop at Studio | Studio Museum";
			break;
			case "magazine":
			$page_title = "Studio Magazine | Studio Museum";
			break;
			case "contact":
			$page_title = "About & Contact | Studio Museum";
			break;
			case "404":
			$page_title = "Not Found | Studio Museum";
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
        <title><?php echo $page_title; ?></title>
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
