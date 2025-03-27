<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Confirm</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item ">Release Document</li>
                    <li class="breadcrumb-item ">Enter Tracking Code</li>
                    <li class="breadcrumb-item active">Confirm</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->



<!-- Main content -->
<div class="content pt-5">

    <div class="container">



        <div class="">

            <?php if ($is_doc_null) : ?>
                <script>
                    Swal.fire({
                        title: 'No record found!',
                        html: ' Data did not match any record. Please, try again.',
                        icon: 'error',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "<?= base_url('release_doc_by_qrcode') ?>";
                        } else {

                        }
                    });
                </script>
            <?php elseif ($is_me_last_receive === false && $is_last_user_released === false) : ?>

                <!--if document exists check this conditions -->

                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'The document is still pending!',
                        html: `<?= $lastuser_data['user_username']; ?> has received the document, but  has yet to confirmed its release. <a href="<?= base_url('timeline_view/' . $code); ?>">See timeline.</a>`,
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "<?= base_url('release_doc') ?>";
                        } else {

                        }
                    });
                </script>

            <?php elseif ($is_me_last_receive === true && $is_last_user_released === true) : ?>
                <script>
                    var docHtml = ` <table class="table-bordered mt-3 " style="width:100%;text-align:left">
                                                <tr>
                                                    <td class="text-gray">Document Name:</td>
                                                    <td><?= $document['document_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray">Track No:</td>
                                                    <td><?= $document['document_code']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray">Owner:</td>
                                                    <td><?= $document_owner; ?></td>
                                                </tr>
                                            </table>`;
                    Swal.fire({
                        title: 'Document already released!',
                        html: 'Document already released. You attempted to post the release of the document you have already released.<br>' + docHtml,
                        icon: 'warning',
                        allowOutsideClick: false,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#ff5f35',
                        confirmButtonText: 'Receive document instead.',
                        cancelButtonText: 'It was a mistake.'

                    }).then((result) => {
                        if (result.isConfirmed) {
                            var docHtml = "";
                            Swal.fire({
                                title: 'Receive?',
                                html: 'Are you sure you want to receive the document named  <b><u><?= $document['document_name']; ?></u></b> with tracking no.  <b><u> <?= $document['document_code']; ?></u> </b>?',
                                icon: 'question',
                                allowOutsideClick: false,
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    var url = "<?= base_url('add_receivelog'); ?>";
                                    $.ajax({
                                        type: "post",
                                        url: url,
                                        data: {
                                            doc_id: "<?= $document['document_id']; ?>",
                                            remark: "",

                                        },
                                        success: function(response) {
                                            var data = JSON.parse(response);
                                            Swal.fire(
                                                'Officially received!',
                                                'Note: Ensure to scan the QR code to officially release this document before you hand over it to next personnel.',
                                                'success'
                                            ).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = "<?= base_url(''); ?>"
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
                                } else {
                                    window.location.href = "<?= base_url(''); ?>";
                                }
                            });
                        } else {
                            window.location.href = "<?= base_url('release_doc_by_tracking_code') ?>";
                        }
                    });
                </script>
            <?php elseif ($is_me_last_receive === true && $is_last_user_released === false) : ?>

                <script>
                    var docHtml = "";
                    Swal.fire({
                        title: 'Release?',
                        html: 'Are you sure you want to release the document named  <b><u><?= $document['document_name']; ?></u></b> with tracking no.  <b><u> <?= $document['document_code']; ?></u> </b>?',
                        icon: 'question',
                        allowOutsideClick: false,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            async function sendoutDoc() {
                                const {
                                    value: myinputdata
                                } = await Swal.fire({
                                    html: docHtml,
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
                                            doc_id: "<?= $document['document_id']; ?>",
                                            user_id: "<?= $user_data['user_id']; ?>",
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
                                                    window.location.href = "<?= base_url(''); ?>"
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
                            window.location.href = "<?= base_url(''); ?>";
                        }
                    });
                </script>

            <?php elseif ($is_me_last_receive === false && $is_last_user_released === true) : ?>

                <!--if document exists check this conditions -->

                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Not allowed!',
                        html: `You need to receive the document before you can release it. <a href="<?= base_url('timeline_view/' . $code); ?>">See timeline.</a>`,
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "<?= base_url('receive_doc_by_tracking_code') ?>";
                        } else {

                        }
                    });
                </script>



            <?php endif; ?>


        </div>










        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- /.content -->

<?= $this->endSection(); ?>