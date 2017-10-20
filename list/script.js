var list = $("#list");

function  getList() {
    list.empty();
    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
            code: list.data("project")
        },
        success: function (data) {
            list.html(data);
        }
    });
}

//setInterval(getList, 10000);