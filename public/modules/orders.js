$(document).ready(function () {
    var route = $("#ajaxRoute").val();
    console.log(route);
    $("#customer-orders-data-table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "order": [[7, "desc"]],
        scrollX: true,
        scrollCollapse: true,
        // fixedColumns: {
        //     right: 1,
        // },
        language: {
            search: "",
            searchPlaceholder: "Search...",
        },
        ajax: route,
        columns: [
            {
                data: 'id',
                name: 'id',
                orderable: false,
                searchable: false,
                width: "5%",
                sClass: "text-center",
            },
            {
                data: "customer.full_name",
                name: "customer.full_name",
                defaultContent: '<span>N / A</span>'
            },
            {
                data: "customer.user.customer_type",
                name: "customer.user.customer_type",
                defaultContent: '<span>N / A</span>'
            },
            {
                data: "delivery_method.delivery_method",
                name: "delivery_method.delivery_method",
                defaultContent: '<span>N / A</span>'
            },
            {
                data: "payment_method.payment_method",
                name: "payment_method.payment_method",
                defaultContent: '<span>N / A</span>'
            },
            {
                data: "total_price",
                name: "total_price",
                defaultContent: '<span>N / A</span>'
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
