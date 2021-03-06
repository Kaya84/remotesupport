<?php
/*
 * @version $Id: HEADER 14684 2011-06-11 06:32:40Z remi $
 LICENSE

 This file is part of the datainjection plugin.

 Datainjection plugin is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Datainjection plugin is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with datainjection. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 @package   datainjection
 @author    the datainjection plugin team
 @copyright Copyright (c) 2010-2017 Datainjection plugin team
 @license   GPLv2+
            http://www.gnu.org/licenses/gpl.txt
 @link      https://github.com/pluginsGLPI/datainjection
 @link      http://www.glpi-project.org/
 @since     2009
 ---------------------------------------------------------------------- */

	   
class PluginRemotesupportMenu extends CommonGLPI
{

   static $rightname = 'Plugin_Remotesupport_Menu';

   static function getMenuName() {

      // return __('Data injection', 'datainjection');
      return "Remote Support";
   }

   static function getMenuContent() {

      global $CFG_GLPI;

      $injectionFormUrl = '/plugins/remotesupport/front/index.php';

      $menu = [
         'title' => self::getMenuName(),
         'page'  => $injectionFormUrl,
         'icon'  => 'fas fa-file-import',
      ];

      

      return $menu;
   }


}
