
$(document).on('ready', function() {

//commento di check se carica
	if ($(location).attr('href').includes('computer') ){
		name =  $(".navigationheader").find("span").first().text().split(" ")[0].trim();
		u = "<span><a href='vnc://" + name +"'>VNC Connection</a><br><a href='rdp://" + name +"'>RDP Connection</a></span>";
		$(".navigationheader").find("span").first().after(u);
	}

});
