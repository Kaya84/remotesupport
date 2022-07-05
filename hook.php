<?php
/*
 -------------------------------------------------------------------------
 Remote Spport (VNC)
 Copyright (C) 2021 by Alessandro Carloni
 https://github.com/Kaya84/RemoteSupport

 -------------------------------------------------------------------------
 LICENSE
 This file is part of Remote support plugin.
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
	   global $DB;

	   $config = new Config();
   if (!$DB->tableExists("glpi_plugin_remotesupport")) {
      $query = "CREATE TABLE `glpi_plugin_remotesupport` (
                  `password` varchar(255) default NULL,
                  `url` varchar(255) NOT NULL,
                  `enableNoVnc` int  NOT NULL,
                  `enableVnc` int  NOT NULL
               ) ENGINE=InnoDB";

      $DB->query($query) or die("error creating glpi_plugin_remotesupport ". $DB->error());

      $query = "INSERT INTO `glpi_plugin_remotesupport`
                       (`password`, `url`)
                VALUES ('password', 'https://url.to.vnc')";
      $DB->query($query) or die("error populate glpi_plugin_remotesupport ". $DB->error());
   }
	
	return true;
}

function plugin_remotesupport_uninstall(){
	return true;
}

function plugin_remotesupport_postinit() {
   global $CFG_GLPI, $DB;
	//Estraggo i parametri che mi interessano	
	$res = $DB->request(['FROM' => 'glpi_plugin_remotesupport']);

	foreach ($res as $param){
		define("URL", $param['url']);
		define("PASSWORD", $param['password']);
		define("FULL_URL", URL . "vnc.html?path=vnc%2F");
		break;
	}

	//show this if u are inside ticket detail page
	if(isset($_GET['id']) && $_GET['id'] != 0 && isset($_GET['_itemtype']) && $_GET['_itemtype'] == "Ticket"){
		$id  = $_GET['id'];

		//mysql> select * from glpi_tickets_users where tickets_id = 2 and type = 1;
		$req = $DB->request(['FROM' => 'glpi_tickets_users', 'WHERE' => ['tickets_id' => $id, 'type' => 1]]);
		//NB: Estraggo unicamente il primo richiedente
      
        //TODO: sistemare ma non capisco perchè il next() non funzioni
		foreach ($req as $row){
			//var_dump($row);
			break;
		}
		
		$requester = $row['users_id'];
	
		if ($row['users_id'] != 0) {
            $req2 = $DB->request(['FROM' => 'glpi_computers', 'WHERE' => ['users_id' => $requester, 'is_deleted' => 0]]);
            $url = "";
			$url2= "";
				foreach ($req2 as $row2){
				if ($row2['name'] !== ""){
	
					$length = 200;
					$url .= "<li class=\"document\" onclick=\"window.open('" . URL  . $row2['name'] ."&eeee=". substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length) . "&autoconnect=true&resize=scale&reconnect=true&show_dot=true&password=". PASSWORD ."', '_blank')\" ><i class=\"fa fa-laptop-medical\"></i>" . $row2['name'] . "</li>";
				
					$url2 .= "<li class=\"document\" onclick=\"location.href='vnc://" . $row2['name'] ."'\"><i class=\"fa fa-headphones\"></i>" . $row2['name'] . "</li>";
				}
				
				
			}
			if ($url != ""){
				echo "<div><ul class=\"timeline_choices\"><h2>Remote support WEB: </h2>";
				echo $url;
				echo "</ul></div>";
				
			}
			if ($url2 != ""){
				echo "<div><ul class=\"timeline_choices\"><h2>Remote support VNC: </h2>";
				echo $url2;
				echo "</ul></div>";		
				
			}
        }
	}
}

function plugin_remotesupport_preitem() {
   global $CFG_GLPI, $DB;
            $url = "";
            $url2= "";
 
	//show this only if inside computer detail page
	if(isset($_GET['id']) && $_GET['id'] != 0 && strpos($_SERVER['REQUEST_URI'], "computer.form")){
		$id  = $_GET['id'];
		//search for the pc
		$req = $DB->request(['FROM' => 'glpi_computers', 'WHERE' => ['id' => $id]]);
	foreach ($req as $row){

			//check if computer has a name. 
			if ($row['name'] !== ""){ //echo "ENTRO=?";
				
				$length = 200;
				$url .= "<li class=\"document\" onclick=\"window.open('". URL  . $row['name'] ."&eeee=". substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length) . "&autoconnect=true&resize=scale&reconnect=true&show_dot=true&password=" . PASSWORD . "', '_blank')\" ><i class=\"fa fa-laptop-medical\"></i>" . $row['name'] . "</li>";
				
				$url2 .= "<li class=\"document\" onclick=\"location.href='vnc://" . $row['name'] ."'\"><i class=\"fa fa-headphones\"></i>" . $row['name'] . "</li>";
			
			}
				
		}

        if ($url != ""){
            echo "<div><ul class=\"timeline_choices\"><h2>Remote support WEB: </h2>";
            echo $url;
            echo "</ul></div>";	
			
        }
		if ($url2 != ""){
            echo "<div><ul class=\"timeline_choices\"><h2>Remote support VNC: </h2>";
            echo $url2;
            echo "</ul></div>";		
			
        }
    
	}
}
?>
