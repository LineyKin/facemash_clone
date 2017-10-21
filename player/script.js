google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

var player_name = $("title").html();

function drawChart() {

    var player_id = $("#rating_graph").data("player_code");

    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
            rating_graph: true,
            player_id: player_id
        },
        success: function (ratingDynamicsJSON) {
            var ratingDynamics = JSON.parse(ratingDynamicsJSON);


            var graph_array = [
                ['Time', 'Rating']
            ];

            for (var key in ratingDynamics) {

                var arStep = [];
                var step = ratingDynamics[key];

                arStep[0] = step.time;
                arStep[1] = Number(step.rating);

                graph_array.push(arStep);
            }


            var data = google.visualization.arrayToDataTable(graph_array);

            var options = {
                title: 'Динамика рейтинга игрока '+player_name,
                curveType: 'function',
                legend: { position: 'none' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('rating_graph'));

            chart.draw(data, options);
        }
    });

}