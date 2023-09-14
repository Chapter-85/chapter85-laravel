$(document).ready(function () {
    var route = $("#ajaxRoute").val();
    console.log(route);
    $("#setup-data-table").DataTable({
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
            //     width: "5%",
            // },
            {
                data: "delivery_method",
                name: "delivery_method",
            },
            // {
            //     data: "description",
            //     name: "description",
            //     width: "20%"
            // },
            {
                data: "created_at",
                name: "created_at",
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

    var quill_snow_des;
    var quill_snow_des_s_ch;
    var quill_snow_des_ch;
    quill_snow_des = new Quill("#snow-editor-des", {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ["bold", "italic", "underline", "strike"],
                ["code-block"],
                ["link"],
                [{ script: "sub" }, { script: "super" }],
                [{ list: "ordered" }, { list: "bullet" }],
                ["clean"],
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
                ["code-block"],
                ["link"],
                [{ script: "sub" }, { script: "super" }],
                [{ list: "ordered" }, { list: "bullet" }],
                ["clean"],
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
                ["code-block"],
                ["link"],
                [{ script: "sub" }, { script: "super" }],
                [{ list: "ordered" }, { list: "bullet" }],
                ["clean"],
            ],
        },
        theme: "snow",
    });
    quill_snow_des_ch.on("text-change", function (delta, oldDelta, source) {
        $("#description_ch").val(quill_snow_des_ch.root.innerHTML);
    });
});
