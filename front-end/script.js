$(document).ready(function() {
    selesai();
});
 
function selesai() {
	setTimeout(function() {
		update();
		selesai();
	}, 200);
}
 
function update() {
	$.getJSON("../back-end/tampil_session.php", function(data) {
		$("ul").empty();
		$.each(data.result, function() {
			$("ul").append("<li>Haloo : "+this['nama_lengkap']+"</li><br />");
		});
	});
}