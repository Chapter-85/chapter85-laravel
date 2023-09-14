$(document).ready(function () {
    var route = $("#ajaxRoute").val();
    console.log(route);
    $("#customers-data-table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        scrollX: true,
        order: [6, 'desc'],
        // scrollY: "300px",
        scrollCollapse: true,
        language: {
            search: "",
            searchPlaceholder: "Search...",
        },
        fixedColumns: {
            right: 1,
        },
        ajax: route,
        columns: [
            {
                data: "full_name",
                name: "full_name",
            },
            // {
            //     data: "user.email",
            //     name: "user.email",
            // },
            {
                data: "phone_number",
                name: "phone_number",
                width: "15%",
            },
            {
                data: "user_type",
                name: "user_type",
                width: "15%",
            },
            {
                data: "is_verified",
                name: "is_verified",
                width: "15%",
            },
            {
                data: "email_verified",
                name: "email_verified",
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

    $(document).on("click", "#shareholders", function (e) {
        const customer_id = $(this).val();
        var target = $(this).data("target");
        var url = $(this).data("url");
        $.ajax({
            url: url,
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            type: "GET",
            data: {
                customer_id: customer_id,
            },
            cache: false,
            success: function (data) {
                $("#modal-div").html(data);
                $(target).modal("show");
            },
            error: function () { },
        });
    });

    $(document).on("click", "#trading", function (e) {
        const customer_id = $(this).val();
        var target = $(this).data("target");
        var url = $(this).data("url");
        $.ajax({
            url: url,
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            type: "GET",
            data: {
                customer_id: customer_id,
            },
            cache: false,
            success: function (data) {
                $("#modal-div").html(data);
                $(target).modal("show");
            },
            error: function () { },
        });
    });

    $(document).on("click", "#unverified", function (e) {
        const user_id = $(this).val();
        var url = $(this).data("url");
        $.ajax({
            url: url,
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            type: "GET",
            data: {
                user_id: user_id,
            },
            cache: false,
            success: function (data) {
                // alert(data);
                // $("#customers-data-table").DataTable().ajax.reload();
                location.reload(true);
            },
            error: function () { },
        });
    });

    $(document).on("click", "#verified", function (e) {
        const user_id = $(this).val();
        var url = $(this).data("url");
        $.ajax({
            url: url,
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            type: "GET",
            data: {
                user_id: user_id,
            },
            cache: false,
            success: function (data) {
                // alert(data);
                // $("#customers-data-table").DataTable().ajax.reload();
                location.reload(true);
            },
            error: function () { },
        });
    });

    $(document).on("click", "#hide", function (e) {
        const user_id = $(this).val();
        var url = $(this).data("url");
        $.ajax({
            url: url,
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            type: "GET",
            data: {
                user_id: user_id,
            },
            cache: false,
            success: function (data) {
                // alert(data);
                // $("#customers-data-table").DataTable().ajax.reload();
                location.reload(true);
            },
            error: function () { },
        });
    });

    $(document).on("click", "#show", function (e) {
        const user_id = $(this).val();
        var url = $(this).data("url");
        $.ajax({
            url: url,
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            type: "GET",
            data: {
                user_id: user_id,
            },
            cache: false,
            success: function (data) {
                // alert(data);
                // $("#customers-data-table").DataTable().ajax.reload();
                location.reload(true);
            },
            error: function () { },
        });
    });

    $(document).on("click", "#verify_email", function (e) {
        const user_id = $(this).val();

        var url = $(this).data("url");
        $.ajax({
            url: url,
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            type: "GET",
            data: {
                user_id: user_id,
            },
            cache: false,
            success: function (data) {
                location.reload(true);
            },
            error: function () { },
        });
    });

    $(document).on("click", "#save_changes_shareholder", function (e) {
        e.preventDefault();
        var url = $("#shareholderForm").attr("action");
        var data = $("#shareholderForm").serializeArray();
        var customer_id = $("#customer_id").val();
        var target = $(this).data("target");
        var url_again = $(this).data("url");
        console.log(url, data, customer_id);
        $.ajax({
            url: url,
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            type: "POST",
            data: data,
            cache: false,
            success: function (data) {
                // alert(data);
                if (data) {
                    $.ajax({
                        url: url_again,
                        headers: {
                            "X-CSRF-Token": "{{ csrf_token() }}",
                        },
                        type: "GET",
                        data: {
                            customer_id: customer_id,
                        },
                        cache: false,
                        success: function (data) {
                            $(target).modal("hide");
                            $("#modal-div").html(data);
                            $(target).modal("show");
                        },
                        error: function () { },
                    });
                }
            },
            error: function () { },
        });
    });

    $(document).on("click", "#save_changes_trading", function (e) {
        e.preventDefault();
        var url = $("#tradingForm").attr("action");
        var data = $("#tradingForm").serializeArray();
        var customer_id = $("#customer_id").val();
        var target = $(this).data("target");
        var url_again = $(this).data("url");
        console.log(url, data, customer_id);
        $.ajax({
            url: url,
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            type: "POST",
            data: data,
            cache: false,
            success: function (data) {
                // alert(data);
                if (data) {
                    $.ajax({
                        url: url_again,
                        headers: {
                            "X-CSRF-Token": "{{ csrf_token() }}",
                        },
                        type: "GET",
                        data: {
                            customer_id: customer_id,
                        },
                        cache: false,
                        success: function (data) {
                            $(target).modal("hide");
                            $("#modal-div").html(data);
                            $(target).modal("show");
                        },
                        error: function () { },
                    });
                }
            },
            error: function () { },
        });
    });
});
