$(document).ready(function () {
    var route = $("#ajaxRoute").val();
    console.log(route);
    $("#products-data-table").DataTable({
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
                data: "sku",
                name: "sku",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "category.name",
                name: "category.name",
                defaultContent: "<span>N/A</span>",
            },
            {
                data: "status_prd",
                name: "status_prd",
                defaultContent: "<span>N/A</span>",
            },
            {
                data: "validity",
                name: "validity",
                defaultContent: "<span>N/A</span>",
            },
            {
                data: "updated_at",
                name: "updated_at",
                defaultContent: "<span>N/A</span>",
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
    quill_snow_des = new Quill("#snow-editor", {
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
});
