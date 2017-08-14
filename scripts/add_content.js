$(document).ready(function () {

    $('#add_project_button').on('click', function () {
        var proj = $('#project').val();
        if (proj != null) {
            $.ajax({
                type: 'POST',
                url: 'ajax/add_content.php',
                data : {
                    project_name: proj
                },
                success: function (data) {
                    var new_pair = JSON.parse(data);
                    console.log(new_pair);
                }
            });
        }
    })
});

