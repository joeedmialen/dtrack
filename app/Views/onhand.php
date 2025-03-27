<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<?php helper(['my_helper']); ?>



<link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas  fa-hand-holding"></i> OnHand</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item active">OnHand</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content pt-5 mobile-absolute-full">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            <a class="btn btn-default rounded-circle" href="<?= base_url(); ?>"><i class="fas fa-arrow-left"></i> </a> Documents OnHand
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dt-buttons btn-group flex-wrap d-none"> <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Copy</span></button> <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>CSV</span></button> <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Excel</span></button> <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>PDF</span></button> <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button"><span>Print</span></button>
                                                <div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true"><span>Column visibility</span><span class="dt-down-arrow"></span></button></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="example1_filter" class="dataTables_filter d-none"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php
                                        $counter = 1;
                                        $timezone = new DateTimeZone('Asia/Manila');
                                        $dateNow = new DateTime('now', $timezone);
                                        // print_r($user);
                                        ?>
                                        <?php if (count($user_pending_docs) === 0) : ?>
                                            <div class="col-sm-12 d-flex flex-column justify-content-center align-items-center text-center">
                                                <span class="text-secondary mb-5 text-lg">You're all caught up!</span>
                                                <i class="fas fa-check-circle fa-5x text-green"></i>
                                            </div>


                                        <?php else : ?>
                                            <div class="col-sm-12">
                                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed" aria-describedby="example1_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tracking Code</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="">Owner</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">Duration</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="display: none;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php if (count($user_pending_docs) === 0) : ?>
                                                            <?= "Nothing to see here."; ?>

                                                        <?php else : ?>
                                                            <?php foreach ($user_pending_docs as $key => $value) : ?>
                                                                <?php $date = new DateTime($value['receivelog_timestamp'], $timezone); ?>

                                                                <tr class="odd">
                                                                    <td class="dtr-control sorting_1" tabindex="0"><?= $value['document_name']; ?></td>
                                                                    <td><?= $value['document_code']; ?></td>
                                                                    <td><?= $value['user_username']; ?></td>

                                                                    <td class=""><?= convertPhpElapsedTime($date->diff($dateNow)->format('%yy, %dd, %hhr, %imin, %ssec')); ?></td>
                                                                    <td><span onclick="onclick_release(event)"
                                                                            data-doc_id="<?= $value['document_id']; ?>"

                                                                            data-doc_code="<?= $value['document_code']; ?>"
                                                                            data-doc_name="<?= $value['document_name']; ?>" class="btn btn-primary border  text-light"><i class="fas  fa-paper-plane"></i></i> Release</span>

                                                                        <?php if ($value['document_delete_allowed'] != 1): ?>
                                                                            <!-- show delete button -->
                                                                            <span onclick="onclick_delete(event)"
                                                                                data-doc_id="<?= $value['document_id']; ?>"

                                                                                data-doc_code="<?= $value['document_code']; ?>"
                                                                                data-doc_name="<?= $value['document_name']; ?>" class="btn btn-danger border  text-light"><i class="fas  fa-times"></i></i> Delete</span>
                                                                        <?php endif; ?>



                                                                    </td>



                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>


                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tracking Code</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="">Owner</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">Duration</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="display: none;">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>




        <!-- /.row -->
    </div><!-- /.container-fluid -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>


    <script src="<?= base_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>

    <script src="<?= base_url('plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>

    <script src="<?= base_url('plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>

    <script src="<?= base_url('plugins/jszip/jszip.min.js') ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/vfs_fonts.js') ?>"></script>

    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>









    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "pageLength": 10,
                "lengthChange": true,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                // "buttons": ["copy-", "csv", "excel", "pdf", "print", "colvis-"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>

    <script>
        function onclick_release(e) {
            e.stopPropagation(); // stop the propagation of events to parents
            var doc_code = e.currentTarget.dataset.doc_code;
            var url = "<?= base_url('submit_delete_doc'); ?>";

            // Highlight the row
            var rowElement = e.currentTarget.parentNode.parentNode;
            if (rowElement) {
                rowElement.classList.add('bg-warning');
            }
            var doc_code = e.target.dataset.doc_code;
            var doc_name = e.target.dataset.doc_name;
            var doc_id = e.target.dataset.doc_id;
            var doc_detail = `
            <table class="table">
                <tr>
                    <td>
                        Name:
                    <td>
                    <td>
                       <b> ` + doc_name + `</b>
                    <td>
                </tr>

                <tr>
                    <td>
                        Tracking Code:
                    <td>
                    <td>
                    <b> ` + doc_code + `</b>
                    <td>
                </tr>



            </table>
            
            `;


            Swal.fire({
                title: 'Release?',
                html: 'Are you sure you want to release this document?' + doc_detail,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'

            }).then((result) => {
                if (result.isConfirmed) {
                    async function sendoutDoc() {
                        const {
                            value: myinputdata
                        } = await Swal.fire({
                            html: '<div class="border p-2"> <b>' + doc_name + '</b><hr><b>' + doc_code + '</b></div>',
                            title: 'Release Document',
                            input: 'text',
                            inputLabel: 'Remarks/Details',
                            allowOutsideClick: false,
                            inputAttributes: {
                                required: 'required', // Add 'required' attribute to the input element
                            },
                            inputPlaceholder: '...',
                            confirmButtonText: 'Finish',
                            showCancelButton: true,
                            confirmButtonColor: '#00913a',
                            showLoaderOnConfirm: true
                        })
                        if (myinputdata) {
                            //return data as myinputdata
                            var url = "<?= base_url('add_releaselog'); ?>";

                            $.ajax({
                                type: "post",
                                url: url,
                                data: {
                                    doc_id: doc_id,
                                    remark: myinputdata,
                                    track_type: "release"

                                },
                                success: function(response) {
                                    var data = JSON.parse(response);
                                    Swal.fire(
                                        'Officially released!',
                                        data.message,
                                        'success'
                                    ).then((result) => {
                                        if (result.isConfirmed) {
                                            // window.location.reload();
                                            if (rowElement) {
                                                setTimeout(() => {
                                                    rowElement.classList.add('disappearing-element-scale-down'); //animate dissapperance in the row
                                                }, 500);
                                            }
                                        }
                                    });
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire(
                                        'Error',
                                        error,
                                        'error'
                                    )

                                }
                            });
                        }
                    }
                    sendoutDoc();
                } else {
                    // Remove the highlight consistently
                    if (rowElement) {
                        rowElement.classList.remove('bg-warning');
                    }
                }
            })

        }


        function onclick_delete(e) {
            e.stopPropagation(); // stop the propagation of events to parents
            var doc_code = e.currentTarget.dataset.doc_code;
            var url = "<?= base_url('submit_delete_doc'); ?>";

            // Highlight the row
            var rowElement = e.currentTarget.parentNode.parentNode;
            if (rowElement) {
                rowElement.classList.add('bg-warning');
            }

            Swal.fire({
                title: 'Remove document tracking?',
                text: 'This action will remove the tracking information for this document. Do you want to proceed?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            code: doc_code,
                        },
                        success: function(response) {
                            var res_data = JSON.parse(response);
                            if (res_data.is_success !== true) {
                                Swal.fire('Error', res_data.message, 'error');
                            } else {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Document tracking tag successfully removed.',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok',
                                }).then(() => {
                                    if (rowElement) {
                                        setTimeout(() => {
                                            rowElement.classList.add('disappearing-element-scale-down');
                                        }, 500);
                                    }

                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error', error, 'error');
                        },
                    });
                } else {
                    // Remove the highlight consistently
                    if (rowElement) {
                        rowElement.classList.remove('bg-warning');
                    }
                }
            });
        }
    </script>




</div>

<!-- /.content -->


<?= $this->endSection(); ?>