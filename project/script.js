
var loc = window.location;
var arLoc = loc.search.split('=');
var projectCode = arLoc[1];


var ring = $("#ring");


$("#ring img").on("click", function() {
    var winner_id = $(this).attr("playerID");

    if (winner_id < 0) {
        alert("playerid должен быть положительным числом");
        return false;
    }

    var r_img = $("#r_img");
    var l_img = $("#l_img");
    var looser_id = this.id == "l_img" ? r_img.attr("playerID") : l_img.attr("playerID");
    var l_name = $("#l_name a");
    var r_name = $("#r_name a");

    ring.hide();
    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
            winner_id: winner_id,
            looser_id: looser_id,
            projectCode: projectCode
        },
        success: function(data) {
            var new_pair = JSON.parse(data);
            var l_src = new_pair.left;
            var r_src = new_pair.right;

            l_img.attr("src", l_src.src_img);
            r_img.attr("src", r_src.src_img);

            l_img.attr("playerID", l_src.id);
            r_img.attr("playerID", r_src.id);

            l_name.html(l_src.name);
            r_name.html(r_src.name);

            l_name.attr("href", "../player/?code="+l_src.id);
            r_name.attr("href", "../player/?code="+r_src.id);

            ring.fadeIn(500);
        }
    })
});