<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Timeline</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Timeline</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="">

    <div class="container-fluid mobile-fixed-full container-md container-lg" style="background-color:inherit !important">
        <div class="card-header mobile-sticky-header p-0 bg-dark" >
            <span class="btn  btn-danger m-1 rounded-circle" onclick="goBackOrDefault()"><i class="fas fa-arrow-left"></i></span>
            Document Timeline
        </div>
        <div class="row m-0">
            <div id="timeline_result" class="container-md container-fluid m-0 p-0">

            </div>

        </div>

    </div>
</div>
<script>
    $(document).ready(function() {


        var target = document.getElementById('timeline_result');
        $('#timeline_result').empty(); // Clear previous result


        var query = String($('#searchQuery').val()).trim();
        if (String(query).length <= 2) {
            Swal.fire(
                'Error',
                'Search keyword must have atleast 3 characters.',
                'error'
            )
        } else {
            var spinner = new Spinner('timeline_result', 'loading...');


            $.ajax({
                url: '<?= base_url('timeline') ?>',
                type: 'post',
                data: {
                    code: '<?= $code; ?>'
                },
                success: function(response) {
                    $('#timeline_result').html(response);
                    Swal.hideLoading();
                    Swal.close();





                },
                error: function(xhr, status, error) {
                    console.error('Error fetching search results:', error);
                    spinner.destroy();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        background: '#ffa851',
                        color: '#1e1e1e',
                        timer: '5000',
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'error',
                        title: error
                    })

                    $('#timeline_result').html('<i class="text-danger">' + error + '</i>');


                }
            });



        }



    });
</script>
<!-- /.content -->

<?= $this->endSection(); ?>