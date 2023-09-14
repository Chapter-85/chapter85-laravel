$(document).ready(function () {
    var route = $("#ajaxRoute").val();
    console.log(route);
    $("#payment-methods-data-table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
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
                width: "5%",
            },
            {
                data: "payment_method",
                name: "payment_method"
            },
            // {
            //     data: "description",
            //     name: "description",
            //     width: "15%",
            // },
            {
                data: "created_at",
                name: "created_at"
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

    var quill_snow_email;
    var quill_snow_des;
    var quill_snow_des_s_ch;
    var quill_snow_des_ch;
    quill_snow_des = new Quill("#snow-editor-des", {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ["bold", "italic", "underline", "strike"],
                [{ list: "ordered" }, { list: "bullet" }],
            ],
        },
        theme: "snow",
    });
    quill_snow_des.on("text-change", function (delta, oldDelta, source) {
        $("#description").val(quill_snow_des.root.innerHTML);
    });

    quill_snow_des_s_ch = new Quill("#snow-editor-des-s-ch", {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ["bold", "italic", "underline", "strike"],
                [{ list: "ordered" }, { list: "bullet" }],
            ],
        },
        theme: "snow",
    });
    quill_snow_des_s_ch.on("text-change", function (delta, oldDelta, source) {
        $("#description_s_ch").val(quill_snow_des_s_ch.root.innerHTML);
    });

    quill_snow_des_ch = new Quill("#snow-editor-des-ch", {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ["bold", "italic", "underline", "strike"],
                [{ list: "ordered" }, { list: "bullet" }],
            ],
        },
        theme: "snow",
    });
    quill_snow_des_ch.on("text-change", function (delta, oldDelta, source) {
        $("#description_ch").val(quill_snow_des_ch.root.innerHTML);
    });

    quill_snow_email = new Quill("#snow-editor-email", {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ["bold", "italic", "underline", "strike"],
                [{ list: "ordered" }, { list: "bullet" }],
            ],
        },
        theme: "snow",
    });
    quill_snow_email.on("text-change", function (delta, oldDelta, source) {
        $("#email_instructions").val(quill_snow_email.root.innerHTML);
    });
});
