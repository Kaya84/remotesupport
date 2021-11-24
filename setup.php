<?php
/*
 -------------------------------------------------------------------------
 Remote Spport (VNC)
 Copyright (C) 2021 by Alessandro Carloni
 https://github.com/Kaya84/RemoteSupport

 -------------------------------------------------------------------------
 LICENSE
 This file is part of Camera Input.
 Camera Input is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.
 Camera Input is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.
 You should have received a copy of the GNU General Public License
 along with Camera Input. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
*/

define('PLUGIN_REMOTESUPPORT_VERSION', '0.0.1');
define('PLUGIN_REMOTESUPPORT_MIN_GLPI', '9.5.0');
define('PLUGIN_REMOTESUPPORT_MAX_GLPI', '9.6.0');

function plugin_init_remotesupport()
{
	global $PLUGIN_HOOKS;
	$PLUGIN_HOOKS['csrf_compliant']['remotesupport'] = true;

	if (Plugin::isPluginActive('remotesupport')) {
		
		
      //$PLUGIN_HOOKS['add_javascript']['remotesupport'][] = 'js/support.js';
      // Add Config Page
      Plugin::registerClass('PluginRemotesupportConfig', ['addtabon' => 'Config']);


	  
		$PLUGIN_HOOKS["menu_toadd"]['remotesupport'] = ['tools'  => 'PluginRemotesupportMenu'];
		$PLUGIN_HOOKS['config_page']['remotesupport'] = 'front/index.php';
		$PLUGIN_HOOKS['menu']['remotesupport']                     = true;
		$PLUGIN_HOOKS['post_init']['remotesupport'] =   'plugin_remotesupport_postinit';

	  
   }
}

function plugin_version_remotesupport()
{
	return [
	   'name'         => __('Remote Support Input', 'remotesupport'),
	   'version'      => PLUGIN_REMOTESUPPORT_VERSION,
	   'author'       => 'Alessandro Carloni',
	   'license'      => 'GPLv2',
	   'homepage'     =>'https://github.com/Kaya84/',
	   'requirements' => [
	      'glpi'   => [
	         'min' => PLUGIN_REMOTESUPPORT_MIN_GLPI,
	         'max' => PLUGIN_REMOTESUPPORT_MAX_GLPI
	      ]
	   ]
	];
}

