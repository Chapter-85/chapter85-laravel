<!-- JAVASCRIPT -->
<script src="{{ asset('theme/dist/default/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
{{--<script src="{{ asset('theme/dist/default/assets/js/plugins.js') }}"></script>--}}

<!-- aos js -->
<script src="{{ asset('theme/dist/default/assets/libs/aos/aos.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/js/pages/form-validation.init.js') }}"></script>

<!-- animation init -->
<script src="{{ asset('theme/dist/default/assets/js/pages/animation-aos.init.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script src="{{ asset('theme/dist/default/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
{{-- <script src="{{asset('theme/dist/default/assets/js/pages/sweetalerts.init.js')}}"></script> --}}
<script src="{{ asset('theme/dist/default/assets/libs/fullcalendar/main.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('theme/dist/default/assets/js/app.js') }}"></script>

<!-- form masks init -->
<script src="{{ asset('theme/dist/default/assets/libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/js/blockui.js') }}"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">
    //var dark_2 = $('body');

    function hideLoading(div) {
        $(div).unblock();
    }

    function showLoading(div) {
        $(div).block({
            message: '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
            overlayCSS: {
                backgroundColor: '#1B2024',
                opacity: 0.85,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none',
                color: '#fff'
            }
        });
    }

    function setInputErrors(form, errorsArr) {
        var objKeys = Object.keys(errorsArr)

        objKeys.forEach(element => {
            var input = $(`[name="${element}"]`);
            input.addClass('is-invalid');
            input.siblings('.invalid-tooltip').text(errorsArr[element][0]);
        });
    }

    $(document).on('click', '.accordion-button', function(e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });

    $(document).ready(function() {

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            console.log('on tab change');
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        })

        $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function(e) {
            ;
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        })

        $('button[data-bs-toggle="collapse"]').on('shown.bs.tab', function(e) {
            console.log('ok');
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        })



        $.extend($.fn.dataTableExt.oStdClasses, {
            "sFilterInput": "form-control",
            "sLengthSelect": "form-control"
        });

        if ($("#CNIC").length) {
            var cleaveCNIC = new Cleave('#CNIC', {
                numericOnly: true,
                delimiter: '-',
                blocks: [5, 7, 1],
            });
        }

        if ($("#NTN").length) {
            var cleaveNTN = new Cleave('#NTN', {
                numericOnly: true,
                delimiter: '-',
                blocks: [7, 1],
            });
        }

        if ($("#STRN").length) {
            var cleaveSTRN = new Cleave('#STRN', {
                numericOnly: true,
                delimiter: '-',
                blocks: [7, 1],
            });
        }
    });

    $(document).on('click', '.delete-record', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        var table = $(this).data('table');

        Swal.fire({
            html: '<div class="mt-3">' +
                '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>' +
                '<div class="mt-4 pt-2 fs-15 mx-5">' +
                '<h4>Are you sure?</h4>' +
                '<p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Record ?</p>' +
                '</div>' +
                '</div>',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
            confirmButtonText: 'Yes, Delete It!',
            cancelButtonClass: 'btn btn-danger w-xs mb-1',
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {

            if (result.isConfirmed) {

                $.ajax({

                    url: url,
                    type: "DELETE",
                    // data : filters,
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    cache: false,
                    success: function(data) {
                        $('#' + table).DataTable().ajax.reload(null, false);
                    },
                    error: function() {

                    },
                    beforeSend: function() {

                    },
                    complete: function() {

                    }
                });
            }
        });
    });

    $(document).on('click', '.delete-record-post-method', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        var table = $(this).data('table');
        var rowID = $(this).data('rowid');

        Swal.fire({
            html: '<div class="mt-3">' +
                '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>' +
                '<div class="mt-4 pt-2 fs-15 mx-5">' +
                '<h4>Are you sure?</h4>' +
                '<p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Record ?</p>' +
                '</div>' +
                '</div>',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
            confirmButtonText: 'Yes, Delete It!',
            cancelButtonClass: 'btn btn-danger w-xs mb-1',
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {

            if (result.isConfirmed) {

                $.ajax({

                    url: url,
                    type: "POST",
                    data: {
                        'id': rowID
                    },
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    cache: false,
                    success: function(data) {
                        $('#' + table).DataTable().ajax.reload(null, false);
                    },
                    error: function() {

                    },
                    beforeSend: function() {

                    },
                    complete: function() {

                    }
                });
            }
        });
    });

    $(document).on('change', '.load-select', function(e) {

        var target = $(this).data('target');
        var url = $(this).data('url');
        var target_name = target?.split('_')[0];

        if (target_name == 'branch') {
            target_name = 'br';
        }

        console.log(target, url, target_name);

        $.ajax({

            url: url + '?id=' + $(this).val(),
            type: "GET",
            cache: false,
            success: function(data) {

                var options = `<option value="">Please select a ${target_name}</option>`;

                if (data) {
                    console.log(data)
                    $.each(data, function(index, value) {
                        if (value.section_id) options += '<option value="' + value
                            .section_id + '">' + value.sections.section_name + '</option>';
                        else options += '<option value="' + value.id + '">' + value[
                            `name`] + '</option>';
                    });
                }

                console.log(options);

                $('select[name="' + target + '"]').html(options).attr('disabled', false);
            },
            error: function() {

            },
            beforeSend: function() {
                showLoading();
            },
            complete: function() {
                hideLoading();
            }
        });
    });

    $(document).on('click', '.show-modal', function(e) {

        var target = $(this).data('target');
        var url = $(this).data('url');
        console.log('show modal', target, url);

        $.ajax({

            url: url,
            type: "GET",
            // dataType: 'html',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            cache: false,
            success: function(data) {
                $('#modal-div').html(data);
                $(target).modal('show');
            },
            error: function() {

            },
            beforeSend: function() {

            },
            complete: function() {

            }
        });
    });
</script>
