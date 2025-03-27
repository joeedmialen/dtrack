<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="nav-icon fas fa-users"></i> Create</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Group</li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content ">
    <div class="container ">

        <div class="row">
            <div class="col-12 ">
                <div class="card mobile-absolute-full">
                    <div class="card-body">
                        <form id="create_group_form">
                            <div class="form-group ">
                                <label for="inputFirstname" class="col-sm-12 col-form-label">Group Name</label>
                                <div class="col-sm-12">
                                    <input required maxlength="15" name="group_name" value="" type="text" class="form-control" id="inputGroupName" placeholder="Group name">
                                </div>
                            </div>


                            <!--  -->
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="form-group ">
                            <div class="col-sm-12">
                                <button id="submitCreateGroupBtn" type="submit" class="btn btn-primary float-left">Save</button>
                                <span onclick="goBackOrDefault()" class="btn btn-danger float-right">Back</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- /.content -->
<script src="<?= base_url('plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
<script src="<?= base_url('plugins/jquery-validation/additional-methods.min.js'); ?>"></script>


<script>
    function showValidatedForm() {
        $('#create_group_form').validate({
            rules: {
                group_name: {
                    required: true,
                }
            },
            messages: {
                group_name: {
                    required: "Please enter a group name.",
                },

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    }
</script>


<script>
    $(document).ready(function() {


        $('#submitCreateGroupBtn').click(function(event) {


            var fileInput = $('#inputGroupName').val();

            if (String(fileInput).length == 0) {
                // if the input is empty run validation function
                showValidatedForm();
                return;
            } else {
                // Prevent the default form submission behavior
                event.preventDefault();
                // Create a FormData object to store the file data



                // Perform AJAX request to handle form submission
                $.ajax({
                    url: '<?= base_url('group/add_group') ?>',
                    type: 'post',
                    data: {
                        group_name: fileInput
                    },
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        // Track upload progress
                        xhr.upload.addEventListener('progress', function(event) {
                            if (event.lengthComputable) {
                                var percentComplete = Math.round((event.loaded / event.total) * 100);
                                var percentComplete = percentComplete; // Example value

                                // Calculate the new width based on the percentage
                                var newWidth = percentComplete + '%';

                            }
                        }, false);
                        return xhr;
                    },
                    success: function(responseText) {
                        // Handle success response
                        var obj = JSON.parse(responseText);
                        if (obj.status == true) {
                            Swal.fire({
                                title: 'Saved',
                                text: '',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#157347',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {}
                                window.location.href = "<?= base_url('group'); ?>";
                            })

                        } else {
                            Swal.fire({
                                title: 'Error',
                                html: '',
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#157347',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                $('#upload-progress').css('width', 0);
                            });
                            $('#uploadButton').attr('disabled', false);

                        }
                        // You can update the UI or perform other actions here
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(error);
                        // You can display an error message or perform other actions here
                        Swal.fire(
                            error,
                            "Please reload the page. If error persists, please report to admin.",
                            'error'
                        )
                    }
                });
            }


        });
    });
</script>


<?= $this->endSection(); ?>