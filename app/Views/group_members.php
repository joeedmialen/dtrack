<?php helper(['my_helper']);


?>


<link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">



<!-- Main content -->


<div id="group_members" class="card border-0 mobile-fixed-full rounded-0 p-0">
    <div class=" bg-light rounded-0 elevation-1 rounded-0 p-1">
        <!-- <span class="info-box-icon bg-info"><i class="fa fa-folder"></i></span> -->
        <div class=" rounded-0 p-1">
            <div class=" rounded-0 p-0">
                <span class="d-inline-block d-md-none">
                    <a class="btn btn-default rounded-circle" onclick="document.getElementById('group-main-navigation-container').classList.add('d-none')"><i class="fas fa-arrow-left"></i></a>
                    <span class="group-profile-head"></span>
                </span>
                <?php if ($logged_user_enrolledgroup_role == 'admin') : ?>
                    <button onclick="load_group_add_member()" type="button" class="btn btn-primary btn-sm float-right"><i class="nav-icon fa fa-user-plus"></i> Add </button>
                <?php endif; ?>

                <span class=""><i class="fa fa fa-users"></i> Members</span>
            </div>
        </div>
        <!-- /.info-box-content -->
    </div>
    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 pt-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="dt-buttons btn-group flex-wrap d-none"> <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Copy</span></button> <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>CSV</span></button> <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Excel</span></button> <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>PDF</span></button> <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button"><span>Print</span></button>
                    <div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true"><span>Column visibility</span><span class="dt-down-arrow"></span></button></div>
                </div>
            </div>
            <div class="col-sm-12">
                <div id="example1_filter" class="dataTables_filter d-none"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div>
            </div>
        </div>
        <div class="row p-1 p-md-3">
            <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed" aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Role</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">Documents</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="display: none;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // print_r(count($members));
                        ?>
                        <?php if (!count($members) == 0) : ?>
                            <?php foreach ($members as $key => $value) : ?>
                                <tr class="odd">
                                    <td id="username-cell-<?= $value['enrolledgroup_id']; ?>" class="dtr-control sorting_1 text-uppercase position-relative" tabindex="0">
                                        <div class="d-flex" data-user_id="<?= $value['user_id']; ?>">
                                            <div class="image">
                                                <?php if ($value['user_id'] == session()->get('userData')['user_id']) : ?>
                                                    <span class="badge badge-info text-lowercase float-left position-absolute" style="left:55px;top:5px"> you</span>
                                                <?php endif; ?>
                                                <?php if ($value['user_pic_filename'] !== "") : ?>
                                                    <img style="object-fit: cover; height: 40px; width:40px; overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="img-circle" alt="">
                                                <?php else : ?>
                                                    <span class="bg-dark overflow-hidden font-weight-bold d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle" style="height:40px;width:40px;"><?= substr($value['user_firstname'], 0, 1); ?><?= substr($value['user_lastname'], 0, 1); ?></span>
                                                <?php endif; ?>

                                            </div>
                                            <span class="info pt-2 pl-2">
                                                <?= $value['user_firstname']; ?> <?= $value['user_lastname']; ?>
                                            </span>
                                        </div>


                                    </td>
                                    <td id="role-cell-<?= $value['enrolledgroup_id']; ?>">
                                        <?php if ($value['enrolledgroup_role'] == 'admin') : ?>
                                            <span class="badge badge-danger">
                                                <i class="fa fa-user-shield"></i>
                                                <?= $value['enrolledgroup_role']; ?>
                                            </span>

                                        <?php else : ?>
                                            <span class="badge badge-secondary">
                                                <?= $value['enrolledgroup_role']; ?>
                                            </span>

                                        <?php endif; ?>



                                        <?php if ($value['enrolledgroup_as_doc_verifier'] == '1') : ?>

                                            <span class="badge badge-warning">
                                                <i class="fa fa-clipboard-check"></i> <i class="fa fa-user"></i>
                                                Doc Verifier
                                            </span>

                                        <?php endif; ?>




                                    </td>
                                    <td>
                                        <span onclick="onclickMemberDocuments(event)" data-userid="<?= $value['user_id']; ?>" class="text-primary btn"><i class="fa fa-folder"></i> Document</span>
                                        </i>
                                    </td>
                                    <td>
                                        <?php if ($value['user_id'] !== session()->get('userData')['user_id']) : ?>
                                            <button <?= $logged_user_enrolledgroup_role == 'admin' ? '' : 'disabled'; ?> <?= $logged_user_enrolledgroup_role == 'admin' ? 'onclick="onclickRemoveMember(event)"' : ''; ?> data-enrol_id="<?= $value['enrolledgroup_id']; ?>" class="btn btn-sm btn-danger" type="button" title="Remove user"><i class="fa fa-times"></i> <i class="fa fa-user"></i></button>
                                        <?php endif; ?>

                                        <?php if ($value['enrolledgroup_role'] !== 'admin') : ?>
                                            <button <?= $logged_user_enrolledgroup_role == 'admin' ? '' : 'disabled'; ?> <?= $logged_user_enrolledgroup_role == 'admin' ? 'onclick="onclickSetAdmin(event)"' : ''; ?> data-enrol_id="<?= $value['enrolledgroup_id']; ?>" class="btn btn-sm btn-success" type="button" title="Set as admin"> <i class="fa fa-check"></i><i class="fa fa-user-shield"></i></button>

                                            <?php if ($value['enrolledgroup_as_doc_verifier'] !== '1') : ?>
                                                <button <?= $logged_user_enrolledgroup_role == 'admin' ? '' : 'disabled'; ?> <?= $logged_user_enrolledgroup_role == 'admin' ? 'onclick="onclickSetDocVerifier(event)"' : ''; ?> data-enrol_id="<?= $value['enrolledgroup_id']; ?>" class="btn btn-sm btn-warning" type="button" title="Set as MOOE document verifier"><i class="fa fa-clipboard-check"></i> <i class="fa fa-user"></i></button>
                                            <?php endif; ?>
                                        <?php endif; ?>
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

<!-- import popperjs -->
<!-- <script src="https://unpkg.com/@popperjs/core@2"></script> -->
<!-- <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script> -->
<script src="https://unpkg.com/@popperjs/core@2"></script>

<script>
    $(document).ready(function() {
        var users_ele = document.querySelectorAll('.tooltipable_user');
        users_ele.forEach((element) => {
            var tooltip = document.querySelector('#tooltip-' + element.dataset.user_id);
            var tooltipable = element;
            Popper.createPopper(button, tooltip, {
                placement: 'right',
            });

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
            //"buttons": ["copy-", "csv", "excel", "pdf", "print", "colvis-"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>

<script>
    function onclick_timeline(e) {

        var doc_code = e.target.dataset.doc_code;
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
<script>
    function load_group_add_member(e) {
        var url = "<?= base_url('group/group_add_member'); ?>"
        $.ajax({
            type: "post",
            url: url,
            data: {
                groupid: _active_group_id,
            },
            success: function(response) {
                $('#group-main-navigation-container').html(response);
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

<script>
    function onclickMemberDocuments(e) {
        var url = "<?= base_url('group/group_member_documents'); ?>"
        var userid = e.currentTarget.dataset.userid;
        $.ajax({
            type: "post",
            url: url,
            data: {
                userid: userid,
            },
            success: function(response) {
                $('#group-main-navigation-container').html(response);
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

    function onclickRemoveMember(e) {
        var url = "<?= base_url('group/group_member_remove'); ?>"
        var enrol_id = e.currentTarget.dataset.enrol_id;
        var currentRowEle = e.currentTarget.parentNode.parentNode;
        var confrimMsg = "Are you sure you want to remove this user from the list? <br><br> <span class='text-bold border border-1 d-flex justify-content-center p-3 m-1 rounded text-uppercase'>" + $('#username-cell-' + enrol_id).html() + "</span> <br><br> ";
        Swal.fire({
            title: 'Remove?',
            html: confrimMsg,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        enrol_id: enrol_id,
                    },
                    success: function(response) {
                        currentRowEle.remove();
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 5500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: 'Removed successfully!'
                        })


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
        })

    }

    function onclickSetAdmin(e) {
        var url = "<?= base_url('group/group_member_set_admin'); ?>"
        var enrol_id = e.currentTarget.dataset.enrol_id;
        var currentRowEle = e.currentTarget.parentNode.parentNode;
        var currentTagetElement = e.currentTarget;
        var confrimMsg = "Are you sure you want to set this user as the group admin? <br><br> <span class='text-bold border border-1 d-flex justify-content-center p-3 m-1 rounded text-uppercase'>" + $('#username-cell-' + enrol_id).html() + "</span> <br><br> ";
        Swal.fire({
            title: 'Set admin?',
            html: confrimMsg,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        enrol_id: enrol_id,
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.status = true) {
                            currentTagetElement.remove();
                            $('#role-cell-' + enrol_id).append(`<span class="badge badge-danger"><i class="fa fa-user-shield"></i> admin</span>`);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 5500,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Success!'
                            });
                        } else {
                            alert('Failed!');
                        }



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
        })

    }

    function onclickSetDocVerifier(e) {
        var url = "<?= base_url('group/group_member_set_doc_verifier'); ?>"
        var enrol_id = e.currentTarget.dataset.enrol_id;
        var currentRowEle = e.currentTarget.parentNode.parentNode;
        var currentTagetElement = e.currentTarget;
        var confrimMsg = "Are you sure you want to set this user as a Document Verifier of the group? <br><br> <span class='text-bold border d-flex justify-content-center border-1 p-3 m-1 rounded text-uppercase'>" + $('#username-cell-' + enrol_id).html() + "</span> <br><br> ";
        Swal.fire({
            title: 'Set Verifier?',
            html: confrimMsg,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        enrol_id: enrol_id,
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.status = true) {
                            currentTagetElement.remove();
                            $('#role-cell-' + enrol_id).append(`<span class="badge badge-warning"> <i class="fa fa-clipboard-check"></i> <i class="fa fa-user"></i>Doc Verifier</span>`);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 5500,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Success!'
                            });
                        } else {
                            alert('Failed!');
                        }



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
        })

    }
</script>


</div>

<!-- /.content -->