<?php
helper(['my_helper']);


?>


<div id="chatroom-sticky" >
    <div class="rounded-0 elevation-0 h-100 card direct-chat direct-chat-info m-0">
        <div class="card-header pt-1 pb-1  bg-light rounded-0 elevation-1">
            <span class="d-inline-block d-md-none">
                <a class="btn btn-default rounded-circle" onclick="document.getElementById('group-main-navigation-container').classList.add('d-none')"><i class="fas fa-arrow-left"></i></a>
                <span class="group-profile-head"></span>
            </span>
            <span class="">
                <span class=""><i class="fas fa-comments"></i> Chatroom</span>
                
            </span>
           
            <div class="card-tools">
            <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                <span class="text-muted text-primary h4"><i class="text-primary  fas fa-list-alt"></i></span>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <!-- Conversations are loaded here -->
        <div id="direct-chat-messages-container" class="direct-chat-messages bg-gradient" style="min-height: 50vh;height: 83vh; overflow-x:hidden;overflow-y:auto;">
            <!-- load chat item messages here -->
            <div id="chat-no-msg-notice-yet-notice" class="alert text-center text-muted">
                <br>
                <h5 class="text-secondary">No message yet.</h5>
                <div id="chat-loader" class="alert text-center text-muted">
                    <div class="spinner-grow text-primary" role="status"></div> <span class="mb-1"></span>
                </div>

            </div>


            <!-- /.direct-chat-msg -->
        </div>
        <!--/.direct-chat-messages-->

        <!-- Contacts are loaded here -->
        <div class="direct-chat-contacts">
            <ul class="contacts-list">
                <?php foreach ($group_members as $key => $value) : ?>
                    <li>
                        <a href="#">
                            <?php if ($value['user_pic_filename'] !== "") : ?>
                                <img style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="contacts-list-img" alt="">
                            <?php else : ?>
                                <span class="bg-dark overflow-hidden font-weight-bold d-flex justify-content-center  align-items-center contacts-list-img" style="height:30px;width:30px;"><?= strtoupper(substr($value['user_firstname'], 0, 1)); ?><?= strtoupper(substr($value['user_lastname'], 0, 1)); ?></span>
                            <?php endif; ?>
                            <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                    <?= $value['user_firstname']; ?> <?= $value['user_lastname']; ?>

                                    <small class="contacts-list-date float-right text-muted">

                                        <?= timeStampDateFormat($value['enrolledgroup_timestamp']); ?>

                                    </small>
                                </span>
                                <span class="contacts-list-msg"><?= $value['enrolledgroup_role']; ?></span>
                            </div>
                            <!-- /.contacts-list-info -->
                        </a>
                    </li>
                <?php endforeach; ?>

                <!-- End Contact Item -->
            </ul>
            <!-- /.contatcts-list -->
        </div>
        <!-- /.direct-chat-pane -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer" style="position:sticky; bottom:0px; z-index:20;background-color:inherit;">
        <form>
            <div class="input-group">
                <input id="msg-input" type="text" name="message" placeholder="Type Message ..." class="form-control">
                <span class="input-group-append">
                    <button id="send-msg-btn" type="" class="btn btn-info">Send</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /.card-footer-->
</div>

</div>



<style>
    .element {
        padding: 10px;
        transition: transform 0.3s ease;
    }

    .zoom {
        transform: scale(1.4);
    }
</style>

<script>
    // 
    var chat_loader = `<div id="chat-loader" class="alert text-center text-muted"><div class="spinner-grow text-primary" role="status"></div> <span class="mb-1"></span></div>`;
    var send_loader = `<div id="send-loader" class="alert text-center text-muted"><div class="spinner-grow text-primary" role="status"></div> <span class="mb-1"></span></div>`;
</script>


<script>
    $(document).ready(function() {
        // onclick send button
        $("#send-msg-btn").click(function(e) {
            e.preventDefault();
            $("#direct-chat-messages-container").append(send_loader);

            var url = "<?= base_url('group/group_send_msg'); ?>";
            var msg = $('#msg-input').val();
            if (String(msg).length == 0) {
                return
            }
            $.ajax({
                type: "post",
                url: url,
                data: {
                    groupid: _active_group_id,
                    msg: msg
                },
                success: function(response) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        // background: '#ffa851',
                        // color: '#1e1e1e',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Message sent!'
                    });
                    $("#send-loader").remove();
                    $('#msg-input').val('');
                },
                error: function(xhr, status, error) {
                    $("#send_loader").remove();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        background: '#ffa851',
                        color: '#1e1e1e',
                        // timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong!'
                    });

                }
            });


        });
    });
</script>

<script>
    var query_last_chatroom_id = 0;
    var last_older_chatroom_id = 0;
    var callCounter = 0;
    var is_no_msg_notice_deleted = false;


    // load latest messages
    function loadNewerMsgs(last_chat_id) {

        var url = "<?= base_url('group/get_chatroom_newest_msg'); ?>";
        var msg = $('#msg-input').val();

        $.ajax({
            type: "post",
            url: url,
            data: {
                groupid: _active_group_id,
                query_last_chatroom_id: query_last_chatroom_id
            },
            success: function(response) {
                var data = JSON.parse(response);


                if ($("#chat-loader") !== undefined) {
                    $("#chat-loader").remove();
                }




                if ((data.query_last_chatroom_id * 1) > (query_last_chatroom_id * 1)) {
                    if (is_no_msg_notice_deleted === false) {
                        $("#chat-no-msg-notice-yet-notice").remove();
                        $("#chat-loader").remove();

                    }

                    $("#direct-chat-messages-container").append(data.messages);
                    query_last_chatroom_id = data.query_last_chatroom_id;

                    if ((last_older_chatroom_id * 1) == 0) {
                        last_older_chatroom_id = data.last_older_chatroom_id;
                    }

                    // scroll to ast element
                    const scrollableDiv = document.getElementById('direct-chat-messages-container');
                    const lastElement = scrollableDiv.lastElementChild;
                    // lastElement.scrollIntoView({
                    //     behavior: 'smooth'
                    // });
                    const container = document.getElementById('direct-chat-messages-container');
                    container.scrollTop = container.scrollHeight;



                    // add zoom effect to last element or message
                    setTimeout(() => {
                        lastElement.classList.add('zoom');
                        // Remove zoom effect after a delay
                        setTimeout(() => {
                            lastElement.classList.remove('zoom');
                        }, 300); // Match this duration with the CSS transition duration
                    }, 300); // Delay to ensure scroll is complete before zooming

                }



            },
            error: function(xhr, status, error) {
                // const Toast = Swal.mixin({
                //     toast: true,
                //     position: 'top',
                //     showConfirmButton: false,
                //     // timer: 3000,
                //     timerProgressBar: true,
                //     didOpen: (toast) => {
                //         toast.addEventListener('mouseenter', Swal.stopTimer)
                //         toast.addEventListener('mouseleave', Swal.resumeTimer)
                //     }
                // })
                // Toast.fire({
                //     icon: 'error',
                //     title: error
                // });
                if ($("#chat-loader") !== undefined) {
                    $("#chat-loader").remove();
                }
                $("#send-loader").remove();
                $('#msg-input').val('');

            }
        });


    }

    // load latest previus messages
    function loadOlderMsgs(last_chat_id) {
        var url = "<?= base_url('group/get_chatroom_older_msg'); ?>";
        var msg = $('#msg-input').val();
        $('#direct-chat-messages-container').prepend(chat_loader);


        $.ajax({
            type: "post",
            url: url,
            data: {
                groupid: _active_group_id,
                last_older_chatroom_id: last_older_chatroom_id,
                offset: 'OLDER'
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#chat-loader').remove(); //remove loader
                if ((data.last_older_chatroom_id * 1) < (last_older_chatroom_id * 1)) {
                    $("#direct-chat-messages-container").prepend(data.messages);
                    last_older_chatroom_id = data.last_older_chatroom_id;

                    // scroll to ast element
                    const scrollableDiv = document.getElementById('direct-chat-messages-container');
                    const firstElement = scrollableDiv.firstElementChild;
                    // firstElement.scrollIntoView({
                    //     behavior: 'smooth'
                    // });

                    const container = document.getElementById('direct-chat-messages-container');
                    container.scrollTop = 100;
                    // add zoom effect to last element or message
                    setTimeout(() => {
                        firstElement.classList.add('zoom');
                        // Remove zoom effect after a delay
                        setTimeout(() => {
                            firstElement.classList.remove('zoom');
                        }, 300); // Match this duration with the CSS transition duration
                    }, 300); // Delay to ensure scroll is complete before zooming

                }



            },
            error: function(xhr, status, error) {
                if ($("#chat-loader") !== undefined) {
                    $("#chat-loader").remove();
                }
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    background: '#ffa851',
                    color: '#1e1e1e',
                    // timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong!'
                });

            }
        });


    }

    var _current_offset_msg_load_mode = "NEWEST";

    function startIntervalLoadNewestMsg() {

        // var spinner = new Spinner('group-main-navigation-container', 'loading...');
        const interval = setInterval(function() {
            if (_active_tab !== "chatroom") {
                clearInterval(interval);
            }
            loadNewerMsgs(query_last_chatroom_id);
        }, 4000);
    }




    $(document).ready(function() {
        startIntervalLoadNewestMsg(); //deafault
    });
</script>

<script>
    // add  scroll event listener to cahnge the bhavior of loading the ethier newest or oldest messages
    document.getElementById('direct-chat-messages-container').addEventListener('scroll', function() {
        const scrollableDiv = this;

        // Check if the user has scrolled to the top
        if (scrollableDiv.scrollTop === 0) {
            // Set offset loading mode to older
            loadOlderMsgs();


        }
    });
</script>