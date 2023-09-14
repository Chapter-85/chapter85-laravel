$(document).ready(function () {
    var route = $("#ajaxRoute").val();
    console.log(route);
    $("#categories-data-table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,

        scrollX: true,
        language: {
            search: "",
            searchPlaceholder: "Search...",
        },
        ajax: route,
        columns: [
            {
                data: "id",
                name: "id",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "abbreviation",
                name: "abbreviation",
            },
            {
                data: "created_at",
                name: "created_at",
                width: "15%",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
                width: "5%",
                sClass: "text-center",
            },
        ],
    });
    $(document).ready(function () {
        $("#surcharge_at_category").change(function () {
            var selected_option = $("#surcharge_at_category").val();
            if (selected_option == "yes") {
                $("#markup_type").attr("disabled", false);
                $("#mark_up").attr("disabled", false);
            }
            if (selected_option == "no") {
                $("#markup_type").attr("disabled", true);
                $("#mark_up").attr("disabled", true);
            }
        });
    });
});
