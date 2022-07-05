<?php
global $DB, $CFG_GLPI;

include ("../../../inc/includes.php");
Html::header("Remote support", $_SERVER['PHP_SELF'], 'Tools', 'PluginRemotesupportMenu');




$config = new PluginRemotesupportConfig();


if (!empty($_POST)){
	$DB->update(
		'glpi_plugin_remotesupport', [
			'url'      => $_POST['url'],
			'password'      => $_POST['password']
		], 
		[1=>1]
	);
	
	
	
}
$config->showConfigForm();



Html::footer();
?>
