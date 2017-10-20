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
                 console.log(newProj);
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
            success: function(php_script_response){
               // console.log(php_script_response);
                $('#name').val(null);
                $('#playerPhoto').val(null);
            }
        });

    });

});

