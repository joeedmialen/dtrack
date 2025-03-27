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
                    <li class="breadcrumb-item">Release Document</li>
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
                    title: 'Release Document',
                    allowOutsideClick: false,
                    input: 'text',
                    inputAttributes: {
                        required: 'required' // Add 'required' attribute to the input element
                    },
                    inputLabel: 'Enter tracking code of document to release.',
                    inputPlaceholder: '...',
                    showCancelButton: true,
                    confirmButtonText: 'Next',
                    showLoaderOnConfirm: true,
                    preConfirm: (value) => {
                        if (!value) {
                            Swal.showValidationMessage('Tracking code cannot be empty');
                        }
                        return value;
                    }
                });
                if (myinputdata) {
                    if(!containsOnlyNumbersAndHyphens(myinputdata)){
                        Swal.fire({
                          title: 'Invalid',
                          text: 'Input contains disallowed characters.',
                          icon: 'error',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Try again'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            window.location.href="<?= base_url('release_doc_by_tracking_code'); ?>";
                          }
                        });
                    }else{
                        window.location.href = "<?= base_url('confirm_release_tracking_code_data'); ?>/" + myinputdata;
                    }
                }
            }
            enterTrackCode();
        </script>




    </div><!-- /.container-fluid -->
</div>

<!-- /.content -->
<script>
    function containsOnlyNumbersAndHyphens(str) {
        // Regular expression to match numbers and hyphens
        const regex = /^[0-9\-]+$/;
        // Test if the string matches the regular expression
        return regex.test(str);
    }
</script>


<?= $this->endSection(); ?>