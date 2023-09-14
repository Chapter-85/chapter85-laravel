$(document).ready(function () {
    var route = $("#ajaxRoute").val();
    console.log(route);
    $("#exchange-rate-data-table").DataTable({
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
            // {
            //     data: "id",
            //     name: "id",
            // },
            {
                data: "from_currency",
                name: "from_currency",
            },
            {
                data: "to_currency",
                name: "to_currency",
            },
            {
                data: "effective_date",
                name: "effective_date",
            },
            {
                data: "rate",
                name: "rate",
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
});
