
$(document).on('ready', function() {

//commento di check se carica
	if ($(location).attr('href').includes('computer') ){
		name = $(".navigationheader").find("span").first().text().trim();
		u = "<span><a href='vnc://" + name +"'> Collegati con VNC</a><br><a href='rdp://" + name +"'> Collegati con RDP</a></span>";
		$(".navigationheader").find("span").first().after(u);
	}

});