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

function plugin_remotesupport_install(){
	return true;
}

function plugin_remotesupport_uninstall(){
	return true;
}

function plugin_remotesupport_postinit() {
   global $CFG_GLPI, $DB;

	if(isset($_GET['id']) && $_GET['id'] != 0 && isset($_GET['_itemtype']) && $_GET['_itemtype'] == "Ticket"){
		$id  = $_GET['id'];
		
		//mysql> select * from glpi_tickets_users where tickets_id = 2 and type = 1;
	
		$req = $DB->request(['FROM' => 'glpi_tickets_users', 'WHERE' => ['tickets_id' => $id, 'type' => 1]]);
		//NB: Estraggo unicamente il primo richiedente
		$row = $req->next();
		$requester = $row['users_id'];
		// select  id, name, users_id from glpi_computers where users_id = 178;
		
		if ($row['users_id'] != 0) {
                        $req2 = $DB->request(['FROM' => 'glpi_computers', 'WHERE' => ['users_id' => $requester]]);
                        $url = "";

                        while ($row2 = $req2->next()){
                                $url .= "<li class=\"document\" onclick=\"location.href='vnc://" . $row2['name'] ."'\"$                        }

                        if ($url != ""){
                                echo "<div><ul class=\"timeline_choices\"><h2>Remote support : </h2>";
                                echo $url;
                                echo "</ul></div>";
                        }
                }
	}
}
?>
