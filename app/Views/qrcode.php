<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header d-none">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">QRcode Scan Confirm</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item ">Receive Document</li>
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
                <h1  class="text-center"><i class="fas fa-qrcode"></i></h1>

                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-info-circle"></i> Scanninng the QRcode returned:<b> Document not found!</b>
                </div>
            <?php else : ?>
                <!--  -->
                    <?php if ($is_me_last_receive === true): ?>
                        <script>
                            Swal.fire({
                                title: '',
                                html: 'This document is in your Onhand list.',
                                icon: 'question',
                                allowOutsideClick: false,
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Go to Home',
                               cancelButtonText: 'See Document History'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= base_url('timeline_view') ?>/<?= $document['document_code']; ?>";
                                } else {
                                    window.location.href = "<?= base_url('/') ?>";
                                }
                            });
                        </script>
                    <?php else  : ?>
                        <script>
                            Swal.fire({
                                title: '',
                                html: 'What would like like to do?',
                                icon: 'question',
                                allowOutsideClick: false,
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Receive Document',
                               cancelButtonText: 'See Document History'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= base_url('confirm_release_qrcode_data') ?>/<?= $document['document_code']; ?>";
                                } else {
                                    window.location.href = "<?= base_url('timeline_view') ?>/<?= $document['document_code']; ?>";
                                }
                            });
                        </script>


                    <?php endif; ?>

                
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