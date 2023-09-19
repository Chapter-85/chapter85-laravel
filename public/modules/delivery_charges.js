$(document).ready(function () {
    var route = $("#ajaxRoute").val();
    console.log(route);
    $("#delivery-charges-data-table").DataTable({
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
                data: "delivery_method",
                name: "delivery_method",
            },
            {
                data: "category.name",
                name: "category.name",
                defaultContent: "<span>N / A</span>",
            },

            {
                data: "amount",
                name: "amount",
                width: "15%",
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
