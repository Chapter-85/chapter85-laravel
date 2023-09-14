$(document).ready(function () {
    var route = $("#ajaxRoute").val();
    console.log(route);
    $("#products-commission-data-table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        searching: false,
        lengthChange: false,
        scrollX: true,
        "order": [[0, "desc"]],
        ajax: {
            url: route,
            data: function (d) {
                d.user_id = $('#user_id').val();
                d.date_range = $('#date_range').val();
            }
        },
        columns: [
            {
                data: "customer.full_name",
                name: "customer.full_name",
            },
            {
                data: "tier_type",
                name: "tier_type",
            },
            {
                data: "tier.name",
                name: "tier.name",
                defaultContent: '<span>Admin</span>'
            },
            {
                data: "product.sku",
                name: "product.sku",
            },
            {
                data: "product.name",
                name: "product.name",
            },
            {
                data: "product_price",
                name: "product_price",
            },
            {
                data: "product_mark_up",
                name: "product_mark_up",
            },
            {
                data: "tier_commission_percentage",
                name: "tier_commission_percentage",
            },
            {
                data: "tier_commission",
                name: "tier_commission",
            },
            {
                data: "created_at",
                name: "created_at",
                width: "15%",
            },
        ],
    });

    $('#date_range').flatpickr({
        mode: "range"
    });
});

$(document).on('change', '.filter', function () {
    $('#products-commission-data-table').DataTable().ajax.reload(null, false);
});
