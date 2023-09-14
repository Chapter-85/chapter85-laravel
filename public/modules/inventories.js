$(document).ready(function () {
    var route = $("#ajaxRoute").val();
    console.log(route);
    $("#inventories-data-table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,

        scrollX: true,
        language: {
            search: "",
            searchPlaceholder: "Search...",
        },
        ajax: route,
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
            },
            {
                data: "sku",
                name: "sku",
            },
            // {
            //     data: "id",
            //     name: "id",
            // },
            {
                data: "product_name",
                name: "product_name",
            },
            // {
            //     data: "order_id",
            //     name: "order_id",
            //     width: "15%",
            // },
            {
                data: "units",
                name: "units",
                width: "15%",
            },
            {
                data: "min_quantity",
                name: "min_quantity",
                width: "15%",
            },
            // {
            //     data: "created_at",
            //     name: "created_at",
            //     width: "15%",
            // },
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

    $(document).on("click", "#single_product_logs", function (e) {
        const product_id = $(this).val();
        var url = $(this).data("url");

        $.ajax({
            url: url,
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            type: "GET",
            data: {
                product_id: product_id,
            },
            cache: false,
            success: function (data) {
                console.log(data)
            },
            error: function () {},
        });
    });
});
