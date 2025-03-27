<div id="group-settings-panel" class="card mobile-fixed-full">

    <?php if ($logged_user_enrolledgroup_role !== 'admin') : ?>
        <div class="alert alert-info m-2 small zoomOut">
            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
            <h5><i class="icon fas fa-ban"></i> Notice!</h5>
            Your account do not have privilege to upate the group settings.
        </div>
    <?php endif; ?>
    <div class="p-1   d-md-none  bg-light rounded-0 elevation-1 rounded-0">
        <span class="d-inline-block d-md-none">
            <a class="btn btn-default rounded-circle" onclick="document.getElementById('group-main-navigation-container').classList.add('d-none')"><i class="fas fa-arrow-left"></i></a>
            Group Settings
            <span class="group-profile-head"></span>
        </span>
    </div>

    <div class="card m-2 mt-2 mb-3 mt-3">
        <div class="card-header">

            <span class="card-title h3">
                Update Group Name
            </span>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Current</label>
                <div class="col-sm-10 disabled">
                    <span disabled type="text" class="form-control border-0" id="groupname-from" placeholder="Group name"> </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">New</label>
                <div class="col-sm-10">
                    <input maxlength="15" type="text" class="form-control" id="input_groupname" placeholder="New Group name">
                </div>
            </div>
            <div class="container p-0">
                <button onclick="save_group_name()" class="btn btn-success float-right">Save</button>
            </div>
        </div>
    </div>

    <div class="card m-2 mt-2 mb-5">
        <div class="card-header">
            <h3 class="card-title">
                Update Group Picture
            </h3>
        </div>
        <div class="card-body p-1">
            <div class="p-1" id="picture">

                <!-- <form disabled="" class="smaller smaller-font p-0" action="" method="post" enctype="multipart/form-data"> -->
                <div class="row px-2">
                    <div class="col-4 text-center border p-2 ">
                        <div class="text-muted">Preview</div>
                        <img id="previewImage" class="profile-user-img img-fluid img-circle" src="" alt="" style="object-fit: cover; height: 110px; width:110px">
                    </div>
                    <div class="col-8 justify-content-center align-content-center ">
                        <input class="btn smaller smaller-font form-control" type="file" id="userfile" name="userfile" accept=".jpg, .jpeg, .png">
                        <hr>
                        <div class="progress progress-xxs">
                            <div id="upload-progress" class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                <!-- <span class="sr-only">60% Complete (warning)</span> -->
                            </div>
                        </div>
                        <br>
                        <input id="uploadButton" class="btn-sm btn-success float-right" type="submit" value="Upload">
                    </div>
                    <div class="row">

                    </div>
                </div>

                <!-- </form> -->

            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('#groupname-from').text($('#active-group-profile-name').text())
    });
</script>

<?php if ($logged_user_enrolledgroup_role == 'admin') : ?>

    <script>
        function save_group_name() {
            var new_groupname = $("#input_groupname").val();
            var group_id = _active_group_id;

            if (String(new_groupname).length == 0) {
                $('#input_groupname').addClass(['border border-danger']);
                return;
            } else {
                $('#input_groupname').remove(['border border-danger']);

            }

            $.ajax({
                url: '<?= base_url('group/group_update_groupname') ?>',
                type: 'POST',
                data: {
                    new_groupname: new_groupname,
                    group_id: group_id
                },
                success: function(responseText) {
                    // Handle success response
                    var obj = JSON.parse(responseText);
                    if (obj.status == true) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Successfully saved',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#157347',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {}
                            $('#active-group-profile-name').text(new_groupname);
                            $('#groupname-from').text(new_groupname);
                            // loadUserGroupList();
                            loadGroupProfileSection(group_id);

                            // update all profilr pic of the logged user


                        })

                    } else {
                        Swal.fire({
                            title: 'Error',
                            html: obj.errors.userfile,
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
    </script>


    <script>
        $(document).ready(function() {
            $('#userfile').change(function() {
                // Get the selected file
                var file = this.files[0];

                // Check if a file is selected and it is an image
                if (file && file.type.startsWith('image/')) {
                    // Create a FileReader object to read the file
                    var reader = new FileReader();

                    // Set the image source when the file is loaded
                    reader.onload = function(event) {
                        $('#previewImage').attr('src', event.target.result);
                        $('#previewImage').show(); // Show the preview image
                    };

                    // Read the selected file as a data URL
                    reader.readAsDataURL(file);
                } else {
                    // Clear the preview if no valid image file is selected
                    $('#previewImage').attr('src', '#');
                    $('#previewImage').hide(); // Hide the preview image
                }
            });

            $('#uploadButton').click(function(event) {
                // Prevent the default form submission behavior
                event.preventDefault();
                var fileInput = $('#userfile')[0];

                // Check if a file is selected
                if (fileInput.files.length === 0) {
                    alert('Please select a file');
                    return;
                }
                $('#uploadButton').attr('disabled', true);
                $('#upload-progress').css('width', 0);
                // Get the file input element


                // Create a FormData object to store the file data
                var formData = new FormData();
                formData.append('userfile', fileInput.files[0]);
                formData.append('group_id', _active_group_id);
                formData.append('current_group_pic', _active_group_profile_pic);



                // Perform AJAX request to handle form submission
                $.ajax({
                    url: '<?= base_url('upload_group_profile_pic') ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        // Track upload progress
                        xhr.upload.addEventListener('progress', function(event) {
                            if (event.lengthComputable) {
                                var percentComplete = Math.round((event.loaded / event.total) * 100);
                                var percentComplete = percentComplete; // Example value

                                // Calculate the new width based on the percentage
                                var newWidth = percentComplete + '%';

                                // Update the style attribute of the progress bar's inner div
                                $('#upload-progress').css('width', newWidth);
                                $('#upload-progress').attr('aria-valuenow', percentComplete);
                                // $('#upload-progress').text(percentComplete + "%");

                                // Update progress bar or display progress percentage here
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(responseText) {
                        // Handle success response
                        var obj = JSON.parse(responseText);
                        if (obj.status == true) {
                            Swal.fire({
                                title: 'Success',
                                text: 'Successfully uploaded',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#157347',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {}
                                $('#uploadButton').attr('disabled', false);

                                // update all profilr pic of the logged user
                                var img_src = "<?= base_url('uploads/'); ?>" + obj.new_filename;
                                $('#active-group-profile-picture').attr('src', img_src);

                            })

                        } else {
                            Swal.fire({
                                title: 'Error',
                                html: obj.errors.userfile,
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
            });
        });
    </script>
<?php else : ?>
    <script>
        $(document).ready(function() {
            $('#group-settings-panel input').attr('disabled', true);
            $('#group-settings-panel button').attr('disabled', true);




        });
    </script>

<?php endif; ?>