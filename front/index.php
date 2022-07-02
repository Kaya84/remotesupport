<?php
global $DB, $CFG_GLPI;

define('GLPI_ROOT', '../../..');
include (GLPI_ROOT . "/inc/includes.php");
Html::header("Wiki", $_SERVER['PHP_SELF'], 'Tools', 'PluginRemotesupportMenu');




$config = new PluginRemotesupportConfig();

		$config->showForm();



	Html::footer();
?>
