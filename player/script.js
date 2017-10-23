google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var player_id = $("#rating_graph").data("player_code");

    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
            rating_graph: true,
            player_id: player_id
        },
        success: function (dynamicsJSON) {

            var dynamics = JSON.parse(dynamicsJSON);

            console.log(dynamics);

            var rating_array = [
                ['Time', 'Рейтинг']
            ];

            var winner_index_array = [
                ['Time', 'Индекс победителя']
            ];

            for (var key in dynamics) {

                var step = dynamics[key];

                var rating_step = [];
                rating_step[0] = step.time;
                rating_step[1] = Number(step.rating);
                rating_array.push(rating_step);

                var winner_index_step = [];
                winner_index_step[0] = step.time;
                winner_index_step[1] = Number(step.winner_index);
                winner_index_array.push(winner_index_step);
            }

            if (rating_array.length > 2) {

                var rating_data = google.visualization.arrayToDataTable(rating_array);
                var rating_options = {
                    title: 'Динамика рейтинга',
                    curveType: 'function',
                    legend: { position: 'none' }
                };
                var rating_chart = new google.visualization.LineChart(document.getElementById('rating_graph'));
                rating_chart.draw(rating_data, rating_options);



                var winner_index_data = google.visualization.arrayToDataTable(winner_index_array);
                var winner_index_options = {
                    title: 'Динамика индекса победителя (%)',
                    curveType: 'function',
                    legend: { position: 'none' }
                }
                var winner_index_chart = new google.visualization.LineChart(document.getElementById('winner_index_graph'));
                winner_index_chart.draw(winner_index_data, winner_index_options);

            }
            else {
                $("#rating_graph").closest('.block').hide();
                $("#winner_index_graph").closest('.block').hide();
            }

        }
    });

}