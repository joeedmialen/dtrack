<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">My Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <?php if (session()->get('user_pic') !== "") : ?>
                                <img class="logged-user-profile-pic-img profile-user-img img-fluid img-circle" style="object-fit: cover; height: 110px; width:110px" src="<?= base_url('uploads/' . session()->get('user_pic')); ?>" alt="">

                            <?php else : ?>
                                <img style="object-fit: cover; height: 110px; width:110px; overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="logged-user-profile-pic-img img-circle elevation-2" alt="">
                            <?php endif; ?>
                        </div>

                        <h3 class="profile-username text-center"><?= $user['user_username']; ?></h3>

                        <p class="text-muted text-center"><?= $user['user_position']; ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Documents</b> <a class="float-right"><?= $doc_count; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Releases</b> <a class="float-right"><?= $user_release_count; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Pending</b> <a class="float-right"><?= $user_pending_docs_count; ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                            <?= $user['user_education']; ?>
                            <!-- B.S. in Computer Science from the University of Tennessee at Knoxville -->
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Station</strong>

                        <p class="text-muted"><?= $user['user_office']; ?></p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted"><?= $user['user_notes']; ?></p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link d-none " href="#activity" data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link d-none" href="#timeline" data-toggle="tab">Timeline</a></li>
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#picture" data-toggle="tab">Picture</a></li>

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane " id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                                        <span class="username">
                                            <a href="#">Sarah Ross</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <form class="form-horizontal">
                                        <div class="input-group input-group-sm mb-0">
                                            <input class="form-control form-control-sm" placeholder="Response">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-danger">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                                        <span class="username">
                                            <a href="#">Adam Jones</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Posted 5 photos - 5 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                                                    <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                                                    <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-danger">
                                            10 Feb. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-envelope bg-primary"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-info"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-comments bg-warning"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-success">
                                            3 Jan. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-camera bg-purple"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                            <div class="timeline-body">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane active" id="settings">
                                <form id="settings-form" class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputFirstname" class="col-sm-2 col-form-label">Firstname</label>
                                        <div class="col-sm-10">
                                            <input required name="firstname" value="<?= $user['user_firstname']; ?>" type="text" class="form-control" id="inputFirstname" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputLastname" class="col-sm-2 col-form-label">Lastname</label>
                                        <div class="col-sm-10">
                                            <input required name="lastname" value="<?= $user['user_lastname']; ?>" type="text" class="form-control" id="inputLastname" placeholder="Lastname">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputLastname" class="col-sm-2 col-form-label">Position</label>
                                        <div class="col-sm-10">
                                            <input required name="position" value="<?= $user['user_position']; ?>" type="text" class="form-control" id="inputLastname" placeholder="Position">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Office</label>
                                        <div class="col-sm-10">
                                            <input required name="office" value="<?= $user['user_office']; ?>" type="text" class="form-control" id="inputSkills" placeholder="School or Office">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button id="submitSettingBtn" type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                    <!--  -->
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="picture">
                                <!-- <form disabled="" class="smaller smaller-font p-0" action="" method="post" enctype="multipart/form-data"> -->
                                <div class="row">
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
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<!-- /.content -->


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

            // Perform AJAX request to handle form submission
            $.ajax({
                url: '<?= base_url('upload_profile_pic') ?>',
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
                            $('.logged-user-profile-pic-img').attr('src', img_src);

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



<script>
    $(document).ready(function() {
        $('#submitSettingBtn').click(function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();



            var formdata = $('#settings-form').serialize();
            var formData = new FormData();
            formData.append('firstname', $('input[name=firstname]'));
            formData.append('lastname', $('input[name=lastname]'));
            formData.append('position', $('input[name=position]'));
            formData.append('office', $('input[name=office]'));


            // Perform AJAX request to handle form submission
            $.ajax({
                url: '<?= base_url('submit_profile_settings') ?>',
                type: 'POST',
                data: formdata,
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
                    if (obj.result == true) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Successfully updated',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#157347',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {}


                            // update all profilr pic of the logged user


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
        });
    });
</script>


<?= $this->endSection(); ?>