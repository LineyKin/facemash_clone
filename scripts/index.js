var ring = document.getElementById('ring');
var center = document.getElementById('center');

window.onload = function() {
	var w = ring.offsetWidth;
	var h = ring.offsetHeight;
	center.style.width = w+'px';
	ring.style.marginTop = -(h/2)+'px';
};


$("#ring img").on("click", function() {

	var winner_id = $(this).attr("playerID");
	var r_img = $("#r_img");
	var l_img = $("#l_img");
	var looser_id = this.id == "l_img" ? r_img.attr("playerID") : l_img.attr("playerID");

	$("#ring").hide();
	$.ajax({
		type: "POST",
		url: "ajax/facemash.php",
		data: {
			winner_id: winner_id,
			looser_id: looser_id
		},
		success: function(data) {
			var new_pair = JSON.parse(data);

			l_img.attr("src", new_pair.left.src_img);
			r_img.attr("src", new_pair.right.src_img);

			l_img.attr("playerID", new_pair.left.id);
			r_img.attr("playerID", new_pair.right.id);

			$("#l_name").html(new_pair.left.name);
			$("#r_name").html(new_pair.right.name);

			$("#ring").fadeIn(500);
		}
	})
});