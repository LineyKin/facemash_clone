function delete_player() {
    $(".delete_button").on("click", function () {
        var player_id = $(this).data("id");
        var row = $(this).closest("tr");
        row.hide();
        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data : {
                player_id: player_id,
                delete_player: true
            },
            success: function (result) {
                console.log(result);
                if (result == 1) {
                    row.remove();
                }
                else {
                    row.show();
                    console.log("ошибка удаления");
                }
            }
        });
    });
}




$(document).ready(function () {

    $('#add_project_button').on('click', function () {
        var project = $('#project');
        var projectName = project.val();
        if (projectName != null && projectName != "") { // впихнуть потом регулярку
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data : {
                    project_name: projectName
                },
                success: function (data) {
                    var newProj = JSON.parse(data);
                    $("<option data-code="+newProj.code+">"+newProj.name+"</option>").appendTo($("#project_list"));
                }
            });
        }
        project.val(null);
    });


    $('#add_player_button').on('click', function () {

        var code = $('select option:selected').data('code');
        var name = $('#name').val();
        var file_data = $('#playerPhoto').prop('files')[0];

        var form_data = new FormData();

        form_data.append('playerPhoto', file_data);
        form_data.append('code', code);
        form_data.append('name', name);

        $.ajax({
            url: 'ajax.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(){
                $('#name').val(null);
                $('#playerPhoto').val(null);
            }
        });

    });


    $("#project_list").on("change", function () {
        var code = $('select option:selected').data('code');
        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data : {
                project_code: code,
                get_list: true
            },
            success: function (data) {
                var list = JSON.parse(data);
                var list_table = $("#list");
                list_table.empty();
                for( var key in list) {

                    var row = list[key];
                    var img_src = "../_images/"+row.project+"/"+row.code+".jpg";
                    var name = row.name.toString();
                    var player_id = row.id;

                    $(
                        '<tr>' +
                            '<td>' +
                                '<div class="img_wrapper"><img src='+img_src+' alt='+name+'></div>' +
                            '</td>' +
                            '<td>' +
                                '<input type="text" readonly>' +
                            '</td>' +
                            '<td>' +
                            '<button class="delete_button" data-id='+player_id+'>удалить</button>' +
                            '</td>' +
                        '</tr>'
                    ).appendTo(list_table);
                    $("#list tr:last input[type=text]").val(name);

                }

                delete_player();

            }
        });

    });

    delete_player();

});

