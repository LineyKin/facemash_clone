$(document).ready(function () {

    $('#add_project_button').on('click', function () {
        var project = $('#project');
        var projectName = project.val();
        if (projectName != null) {
            $.ajax({
                type: 'POST',
                url: 'ajax/admin.php',
                data : {
                    project_name: projectName
                },
                success: function (data) {
                 var newProj = JSON.parse(data);
                 $("#project_list").append("<option>"+newProj.name+"</option>");
                 console.log(newProj);
                 }
            });
        }
        project.val(null);
    })
});

