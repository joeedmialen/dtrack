<link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">
<!--  -->
<div id="my-modal" class="modal" style="min-height: 500px;z-index:2000 !important;" tabindex="-2" role="dialog" aria-labelledby="my-modal-title" aria-hidden="false">
    <div class="modal-dialog  modal-lg " role="document">
        <div id="modal-content" class="modal-content overflow-auto ">

            <div class="modal-header">
                <span onclick="toggleFormViewExpansion(event,'modal-content')" class="btn btn-default m-1" title="Toggle expansion view"><i class="fa fa-expand"></i></span>

                <h5 class="modal-title" id="my-modal-title">
                    <!-- Title -->
                </h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body" class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <!-- Footer -->
            </div>
        </div>
    </div>
</div>

<!-- /.modal -->


<!-- Main content -->


<div id="group_documents" class="card h-100 col-12 m-0 p-0 pb-5 bt-2 elevation-0">

    <div class=" mb-2 p-1 sticky-top  bg-light rounded-0 elevation-1">
        <!-- <span class="info-box-icon bg-info"><i class="fa fa-folder"></i></span> -->
        <div class="">
            <div>
                <span class="d-inline-block d-md-none">
                    <a class="btn btn-default rounded-circle" onclick="document.getElementById('group-main-navigation-container').classList.add('d-none')"><i class="fas fa-arrow-left"></i></a>
                    <span class="group-profile-head"></span>
                </span>
                <button onclick="loadGroupDocuments()" type="button" class="btn btn-secondary btn-sm float-right"><i class="nav-icon fa fa-retweet"></i> Refresh </button>
                <span class=""><i class="fa fa-folder"></i> Documents</span>
            </div>
        </div>

        <!-- /.info-box-content -->
    </div>
    <div id="document-alert-container">
        <!-- <div class="alert alert-warning" role="alert">
            <i class="fa fa-exclamation-triangle"></i>
        </div> -->
    </div>


    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 p-2">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="dt-buttons btn-group flex-wrap">

                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div id="example1_filter" class="dataTables_filter d-none"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed small" aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name/Particulars</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Office</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Owner</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Remarks</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Actions</th>




                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // print_r($documents);
                        ?>
                        <?php if (count($documents) === 0) : ?>

                        <?php else : ?>
                            <?php foreach ($documents as $key => $value) : ?>
                                <tr class="odd">
                                    <td class="dtr-control sorting_1 position-relative" tabindex="0">
                                        <span class="text-uppercase"><?= $value['document_name']; ?></span>
                                    </td>

                                    <td><?= $value['document_office_name']; ?></td>
                                    <td>
                                        <?php if ($value['user_pic_filename'] !== "") : ?>
                                            <img title="<?= $value['user_firstname']; ?> <?= $value['user_lastname']; ?>" style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="img-circle" alt="">
                                        <?php else : ?>
                                            <span title="<?= $value['user_firstname']; ?> <?= $value['user_lastname']; ?>" class="bg-dark overflow-hidden small d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle direct-chat-img" style=" height: 30px; width:30px;">
                                                <?= substr($value['user_firstname'], 0, 1); ?><?= substr($value['user_lastname'], 0, 1); ?>
                                            </span>
                                        <?php endif; ?>
                                        <span class="small text-muted d-sm-none d-md-inline"><?= $value['user_firstname']; ?> <?= $value['user_lastname']; ?></span>
                                    </td>
                                    <td>

                                        <?php if ($value['document_type'] == 'MOOE') : ?>
                                            <div class="input-group p-1 d-flex flex-column">
                                                <!-- <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input data-input_for="ca" onmouseenter="applyInputMask(event)" onkeyup="onkeyupInputCaDate(event)" <?= $logged_user_enrolledgroup_as_doc_verifier ? '1' : 'disabled'; ?> type="text" class="form-control datemask" value="<?= $value['document_date_ca']; ?>" data-saved_value="<?= $value['document_date_ca']; ?>" data-doc_id="<?= $value['document_id']; ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" inputmode="numeric">
                                                </div> -->
                                                <div class="small">
                                                    <?php if ($value['document_date_ca'] == '') : ?>
                                                        <div class="badge badge-danger small p-1 m-1"> <i class="fa fa-exclamation-triangle"></i> CA date required!</div>
                                                    <?php endif; ?>

                                                    <?php if ($value['document_date_ada'] == '') : ?>
                                                        <div class="badge badge-danger small p-1 m-1"> <i class="fa fa-exclamation-triangle"></i> ADA date required!</div>
                                                    <?php endif; ?>

                                                    <?php if ($value['document_date_liquidation'] == '') : ?>
                                                        <div class="badge badge-danger small p-1 m-1"> <i class="fa fa-exclamation-triangle"></i> Liquidation date required!</div>
                                                    <?php endif; ?>
                                                </div>

                                            <?php endif; ?>


                                    </td>

                                    <td>
                                        <div class="d-flex flex-row">
                                            <div type="button" data-toggle="modal" data-target="#my-modal" onclick="onclick_timeline(event)" data-doc_code="<?= $value['document_code']; ?>" class="btn btn-primary btn-xs "><i class="fas  fa-clock"></i> <span class="d-sm-none d-md-inline"> Timeline</span> </div> &nbsp;
                                            <div type="button" data-toggle="modal" data-target="#my-modal" onclick="onclick_details(event)" data-doc_code="<?= $value['document_code']; ?>" class="btn btn-primary btn-xs "><i class="fas  fa-file-alt"></i> <span class="d-sm-none d-md-inline"> Details</span></div>
                                        </div>
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>


                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.card-body -->






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


<!-- inputmask requred plugins -->
<script src="<?= base_url('plugins/moment/moment.min.js'); ?>"></script>
<script src="<?= base_url('plugins/inputmask/jquery.inputmask.min.js'); ?>"></script>



<script>
    $(document).ready(function() {
        var ele = document.querySelectorAll('.datemask');
        ele.forEach(element => {
            inputMask(element);
        });
    });
</script>

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
            // "buttons": ["copy-", "csv-", "excel-", "pdf-", "print-", "colvis"]
            "buttons": ["colvis"]

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>

<script>
    function onclick_timeline(e) {

        var doc_code = e.currentTarget.dataset.doc_code;
        var url = "<?= base_url('timeline'); ?>"
        $('#modal-body').html('');
        var spinner = new Spinner('modal-body', 'loading...');

        $.ajax({
            type: "post",
            url: url,
            data: {
                code: doc_code,
            },
            success: function(response) {
                var res_html = `<div class="small smaller-font">` + response + `<div>`;
                $('#modal-body').html(res_html);
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

    function onclick_details(e) {

        var doc_code = e.currentTarget.dataset.doc_code;
        var url = "<?= base_url('document_details'); ?>"
        $('#modal-body').html('');
        var spinner = new Spinner('modal-body', 'loading...');

            $.ajax({
                type: "post",
                url: url,
                data: {
                    code: doc_code,
                    _active_group_id: _active_group_id
                },
                success: function(response) {
                    var res_html = `<div class="small smaller-font">` + response + `<div>`;
                    $('#modal-body').html(res_html);

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
</script>




</div>

<!-- /.content -->