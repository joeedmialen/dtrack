<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Enter Tracking Code</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item">Receive Document</li>
                    <li class="breadcrumb-item active">Enter Tracking Code</li>

                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content pt-5">

    <div class="container">
        <script>
            async function enterTrackCode() {
                const {
                    value: myinputdata
                } = await Swal.fire({
                    title: 'Receive Document',
                    input: 'text',
                    inputAttributes: {
                        required: 'required' // Add 'required' attribute to the input element
                    },
                    inputLabel: 'Enter Tracking Code',
                    inputPlaceholder: '...',
                    showCancelButton: true,
                    confirmButtonText: 'Next',
                    showLoaderOnConfirm: true,

                    allowOutsideClick: () => !Swal.isLoading() // Disallow outside click when loading
                });

                if (!myinputdata) {
                    window.location.href = "<?= base_url('receive_doc') ?>";
                    return; // Exit function early
                }

                if (!containsOnlyNumbersAndHyphens(myinputdata)) {
                    const result = await Swal.fire({
                        title: 'Error',
                        html: 'Invalid tracking code.',
                        icon: 'error',
                        confirmButtonText: 'Try again',
                        allowOutsideClick: false
                    });

                    if (result.isConfirmed) {
                        window.location.href = "<?= base_url('receive_doc_by_tracking_code') ?>";
                    }
                } else {
                    window.location.href = "<?= base_url('confirm_receive_tracking_code_data'); ?>/" + myinputdata;
                }
            }

            enterTrackCode();
        </script>



    </div><!-- /.container-fluid -->
</div>

<!-- /.content -->



<?= $this->endSection(); ?>