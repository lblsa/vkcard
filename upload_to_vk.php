<?php 
if (
		$_SERVER['REQUEST_METHOD'] == 'POST' && 
		isset($_POST['url']) && $_POST['url']!='' && 
		isset($_POST['photo']) && $_POST['photo']!=''
	)
{

	$post=array('photo'=>'@'.getcwd().$_POST['photo']);

var_dump($_POST);
var_dump($post);
die;

	$this->ch=curl_init();
	curl_setopt($this->ch, CURLOPT_URL, $_POST['url']);
	curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($this->ch, CURLOPT_POST, 1);
	curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);
	$body = curl_exec($this->ch);
	echo $body; // << on Windows empty result
	die;
/*
	$curlPost = array('fileupload' => '@'.$_FILES['theFile'] ['tmp_name']);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://24.18.65.72:8008/upload_file.php');
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
	$data = curl_exec();
	curl_close($ch);


	$local_directory=dirname(__FILE__).'/local_files/';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_URL, 'http://localhost/curl_image/uploader.php' );
	//most importent curl assues @filed as file field
	$post_array = array(
	  "my_file"=>"@".$local_directory.'shreya.jpg',
	  "upload"=>"Upload"
	);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
	$response = curl_exec($ch);
	echo $response;
	*/
}

?>