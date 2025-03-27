<link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">



<!-- Main content -->
<div class="d-block sticky-top bg-light elevation-1 p-1">
    <span>
        <a class="btn btn-default rounded-circle" onclick="loadMembers()"><i class="fas fa-arrow-left"></i></a>
        <span class="group-profile-head"></span>
    </span>
</div>
<div class="card-header">
    <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-primary">
            <h3 class="widget-user-username"><?= $user_data['user_firstname']; ?> <?= $user_data['user_lastname']; ?></h3>
            <h5 class="widget-user-desc"><?= $user_data['user_position']; ?></h5>
        </div>
        <div class="widget-user-image">
            <!-- <img class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar"> -->
            <?php if ($user_data['user_pic_filename'] !== "") : ?>
                <img style="object-fit: cover; height: 100px; width:100px; overflow:hidden" src="<?= base_url('uploads/'); ?><?= $user_data['user_pic_filename']; ?>" class="img-circle" alt="">
            <?php else : ?>
                <img style="object-fit: cover; height: 100px; width:100px; overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="img-circle" alt="">
            <?php endif; ?>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-4 border-right">
                    <div class="description-block">


                        <h5 class="description-header"><?= $user_docs_count; ?></h5>
                        <span class="description-text">Documents</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header"><?= $user_release_count; ?></h5>
                        <span class="description-text">Releases</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header"><?= $user_pending_docs_count; ?></h5>
                        <span class="description-text">Pending</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>


</div>
<!-- /.card-header -->
<div class="card-body">




    <div class="info-box elevation-0">
        <span class="info-box-icon"><i class="fa fa-folder"></i></span>
        <div class="info-box-content">
            <div>
                <button onclick="loadMembers()" type="button" class="btn btn-primary btn-sm float-right "><i class="nav-icon fa fa-chevron-left"></i> Back </button>
                <span class="text-muted h3">Documents</span>
            </div>
        </div>
        <!-- /.info-box-content -->
    </div>


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
            <div class="col-sm-12">

                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed" aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Type</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tracking Code</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">Date Registered</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="display: none;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // print_r($user);
                        ?>
                        <?php if (count($user_docs) === 0) : ?>


                        <?php else : ?>
                            <?php foreach ($user_docs as $key => $value) : ?>
                                <tr class="odd">
                                    <td class="dtr-control sorting_1" tabindex="0">

                                        <?= $value['document_name']; ?>
                                    </td>
                                    <td><?= $value['document_type']; ?></td>
                                    <td><?= $value['document_code']; ?></td>
                                    <td><?= $value['document_date']; ?></td>
                                    <td>
                                        <span type="button" data-toggle="modal" data-target="#my-modal" onclick="onclick_timeline(event)" data-doc_code="<?= $value['document_code']; ?>" class="btn btn-secondary btn-xs "><i class="fas  fa-clock"></i> Timeline</span>

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


<!--  -->
<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="false">
    <div class="modal-dialog  modal-lg" role="document">
        <div id="modal-content" class="modal-content overflow-auto">

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
            "pageLength": 3,
            "lengthChange": true,
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            //"buttons": ["copy-", "csv", "excel", "pdf", "print", "colvis-"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>

<script>
    function onclick_timeline(e) {

        var doc_code = e.currentTarget.dataset.doc_code;
        var url = "<?= base_url('timeline'); ?>"
        $('#modal-body').html('');
        var spinner = new Spinner('modal-body', 'loading...');
        setTimeout(function() {
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
        }, 2000);
    }
</script>




</div>

<!-- /.content -->