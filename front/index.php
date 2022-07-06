<?php
global $DB, $CFG_GLPI;

include ("../../../inc/includes.php");
Html::header("Remote support", $_SERVER['PHP_SELF'], 'Tools', 'PluginRemotesupportMenu');




$config = new PluginRemotesupportConfig();


if (!empty($_POST)){
	
	//controllo che ci sia uno slash finale nella url
	$url = $_POST['url'];
	if (substr($url, -1) !== "/"){
		$url .= "/";
	}
	$DB->update(
		'glpi_plugin_remotesupport', [
			'url'      => $url,
			'password'      => $_POST['password'],
			'enableNoVnc'      => $_POST['enableNoVnc'],
			'enableVnc'      => $_POST['enableVnc']
			
		], 
		[1=>1]
	);
	
	
	
}
$config->showConfigForm();



Html::footer();
?>
