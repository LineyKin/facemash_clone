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



$("#filter input").on("input", function () {
    var str = $(this).val();

    var reg = new RegExp(str, "ig");

    $(".name_cell a").each(function () {

        var name = $(this).html();

        if (!reg.test(name)) {
           $(this).closest("table").hide()
        }
        else {
            $(this).closest("table").show()
        }

    });

})