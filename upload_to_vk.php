<?php 
if (
		$_SERVER['REQUEST_METHOD'] == 'POST' && 
		isset($_POST['url']) && $_POST['url']!='' && 
		isset($_POST['photo']) && $_POST['photo']!=''
	)
{

	$post=array('photo'=>'@'.getcwd().$_POST['photo']);
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $_POST['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$body = curl_exec($ch);
	header('Content-type: application/json');
	echo $body; 
	die;
}

?>