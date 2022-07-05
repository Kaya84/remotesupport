<?php

class PluginRemotesupportConfig extends CommonDBTM
{
   static protected $notable = true;

   public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0)
   {
      if (!$withtemplate && $item->getType() === 'Config') {
         return __('Remote Support', 'remotesupport');
      }
      return '';
   }


	/**
	* Summary of showConfigForm
	*/
	static function showConfigForm() {
		global $CFG_GLPI, $DB;

		$res = $DB->request(['FROM' => 'glpi_plugin_remotesupport']);
		foreach ($res as $r){
			//$target = Toolbox::getItemTypeFormUrl(__CLASS__);

			echo "<form name='form_remote_config' method='post' action=\"\">";

			echo "<tr class='tab_bg_1'>";
			echo "<td >".__("Define url to VNC web ", "remote")."</td><td >";
			echo Html::input("url", ['value' => $r['url']]);
			echo "</td></tr>\n";

			echo "<tr class='tab_bg_1'>";
			echo "<td >".__("Define vnc password", "remote")."</td><td >";
			echo Html::input("password", ['value' => $r['password']]);

			echo "</td></tr>\n";
			
			echo "<tr class='tab_bg_1'>";
			echo "<td >".__("Enable NoVnc web link", "remote")."</td><td > ";
			Dropdown::showYesNo("enableNoVnc", "1");

			echo "</td></tr>\n";
			
			echo "<tr class='tab_bg_1'>";
			echo "<td >".__("Enable Vnc App link", "remote")."</td><td > ";
			Dropdown::showYesNo("enableVnc", "1");

			echo "</td></tr>\n";

			echo "<input type='submit' name='update_fields' value=\"" . _sx('button', 'Save') . "\" class='submit'>";

			Html::closeForm();
			break;
		}
	}
   


   public static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0)
   {
      if ($item->getType() === 'Config') {
         $config = new self();
         $config->showForm(0); //TODO: FIX nella parte di general che non lo fa vedere...
      }
   }

   public static function undiscloseConfigValue($fields)
   {
      $to_hide = [];
      foreach ($to_hide as $f) {
         if (in_array($f, $fields, true)) {
            unset($fields[$f]);
         }
      }
      return $fields;
   }

   public static function getConfig(bool $force_all = false) : array
   {
      static $config = null;
      if ($config === null) {
         $config = Config::getConfigurationValues('plugin:remotesupport');
      }
      if (!$force_all) {
         return self::undiscloseConfigValue($config);
      }

      return $config;
   }

}
