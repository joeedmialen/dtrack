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
                    <li class="breadcrumb-item ">Receive Document</li>
                    <li class="breadcrumb-item ">Scan QR Code</li>
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
        <?php
        // echo var_dump($is_me_last_receive);
        // echo "<br>";
        // echo var_dump($is_last_user_released);


        ?>


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
                            window.location.href = "<?= base_url('receive_doc_by_qrcode') ?>";
                        } else {

                        }
                    });
                </script>


            <?php elseif ($is_me_last_receive === false ) : ?>

                <script>
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
                </script>
            <?php endif; ?>


        </div>










        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<script>
    function containsOnlyNumbersAndHyphens(str) {
        // Regular expression to match numbers and hyphens
        const regex = /^[0-9\-]+$/;
        // Test if the string matches the regular expression
        return regex.test(str);
    }
</script>
<!-- /.content -->

<?= $this->endSection(); ?>