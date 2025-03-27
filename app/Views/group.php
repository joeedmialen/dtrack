<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>
<script>
    // declare module level variable
    var _active_group_id = 0;
    var _active_group_profile_pic = '';

    var _active_tab = "";
</script>

<!-- Content Header (Page header) -->
<div class="content-header d-none">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="nav-icon fas fa-users"></i> Group</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Group</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content m-0 p-0">
    <div class="container-fluid  m-0 p-0 rounded-0">
        <div class="row m-0 bg-default">
            <div class="col-md-3  m-0 p-0 rounded-0">
                <!-- Profile Image -->
                <div id="group-profile-card" class="pb-2 card card-primary  m-0 p-0 rounded-0 elevation-1 ">
                    <div class="card-body box-profile ">

                        <div class="text-center">
                            <img id="active-group-profile-picture" class="bg-light profile-user-img img-fluid img-circle" style="object-fit: cover; height: 110px; width:110px" src="" alt="">
                            <h3 id="active-group-profile-name" class="widget-user-username">--</h3>
                        </div>

                        <h3 class="profile-username text-center"></h3>

                        <p class="text-muted text-center"></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item d-flex flex-row">

                                <b>Members</b>
                                <div id="members-profile-heads-wrapper" class="d-flex nowrap justify-content-end float-right" style="margin-right:5px;max-height:40px; width:100%">
                                    <!--load profile heads here  -->
                                </div>
                                <span>
                                    <a id="active-group-members-count" class="float-right">0</a>
                                </span>


                            </li>
                            <li class="list-group-item d-flex flex-row">
                                <b>Admin</b>
                                <div id="admin-profile-heads-wrapper" class="d-flex  nowrap justify-content-end float-right" style="margin-right:5px;max-height:40px; width:100%">
                                    <!--load profile heads here  -->
                                </div>
                                <a id="active-group-admin-count" class="float-right">0</a>
                            </li>
                        </ul>

                        <div class="p-1">
                            <a onclick="leaveGroup(event)" class="btn btn-default btn-block btn-sm text-muted"><i class="fa fa-door-open"></i> Leave Group</a>
                        </div>

                        <div id="group-navigation-on-mobile" class="p-0">
                            <!-- relocate the navigation here on mobile -->

                        </div>
                    </div>
                    <!-- /.card-body -->


                </div>
                <!-- /.card -->

                <!-- About Me Box -->

                <div id="card-my-group" class="card-body box-profile m-0 p-0 ">
                    <div id="accordion">
                        <div class="card card-default rounded-0 elevation-1 m-0">
                            <div class="card-header rounded-0 elevation-0 mb5">
                                <h4 class="card-title w-100">
                                    <div class="d-flex">

                                        <a class="d-block w-100" data-toggle="collapse" href="#my-group-body" aria-expanded="true">
                                            <h5>My Group</h5>
                                        </a>


                                        <span>
                                            <a id="search-mygroup-name-search-btn" class="" data-widget="navbar-search" role="button">
                                                <i class="fas fa-search"></i>
                                            </a>
                                            <span class="navbar-search-block bg-primary" style="display:none;">
                                                <form class="form-inline ">
                                                    <div class="input-group input-group-sm shadow-lg">
                                                        <input id="search-mygroup-name" class="form-control form-control-navbar" type="search" placeholder="🔍️ Search my group" aria-label="Search">
                                                        <div class="input-group-append">
                                                            <!-- <span class="text-muted p-1" type="">
                                                                <i class="fas fa-search"></i>
                                                            </span> -->
                                                            <button id="search-mygroup-name-close-search-btn" class="btn btn-navbar text-light" type="button" data-widget="navbar-search">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </span>
                                        </span>


                                    </div>


                                </h4>
                            </div>
                            <div id="my-group-body" class="collapse p-1" data-parent="#accordion" style="overflow-y:auto; max-height:500px;">
                                <nav>
                                    <ul id="group-list-container" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                        <!-- Add icons to the links using the .nav-icon class
                                                with font-awesome or any other icon font library -->
                                        <li class="nav-item">
                                            <a href="http://localhost/project-root/public/" class="nav-link ">
                                                <i class="nav-icon fas fa-users"></i>
                                                <p>
                                                    LC1 AOs

                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="http://localhost/project-root/public/dashboard" class="nav-link ">
                                                <i class="nav-icon fas fa-users"></i>
                                                <p>
                                                    Grupo Progresso

                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="http://localhost/project-root/public/group" class="nav-link">
                                                <i class="nav-icon fas fa-users"></i>
                                                <p>
                                                    Group

                                                </p>
                                            </a>
                                        </li>



                                    </ul>
                                </nav>
                            </div>
                            <a href="<?= base_url('group/create'); ?>" class="m-1 btn btn-default btn-sm text-muted mb-5">Create Group</a>
                        </div>

                    </div>

                </div>
                <!-- /.card -->




            </div>
            <!-- /.col -->
            <div id="" class="col-md-9  m-0 p-0 rounded-0 elevation-0 ">

                <div class="card rounded-0 elevation-0 m-0 elevation-1">
                    <div id="group-navigation" class="card-header p-0 ">
                        <nav class="navbar navbar-expand" style="width: 100%;">
                            <div class="navbar-nav d-flex flex-column flex-md-row justify-content-around justify-content-md-start " style="width: 100%;">
                                <span class="nav-item">
                                    <a class="nav-link" onclick="loadGroupChatroom()" href="#"><i class="fas fa-comments"></i> <span class="">Chatroom</span> </a>
                                </span>
                                <span class="nav-item">
                                    <a class="nav-link" onclick="loadGroupDocuments()" href="#"><i class="fas  fa-folder "></i> <span class="">Document</span> </a>
                                </span>
                                <span class="nav-item">
                                    <a class="nav-link" onclick="loadMembers()" href="#"><i class="fas  fa-users"></i> <span class="">Member</span> </a>
                                </span>
                                <span class="nav-item">
                                    <a class="nav-link" onclick="loadSettings()" href="#"><i class="fas  fa-tools "></i> <span class="">Setting</span> </a>
                                </span>
                            </div>

                        </nav>

                    </div><!-- /.card-header -->

                    <div id="group-main-navigation-container" class="d-none  h-100 col-12 m-0  my-position-sticky mobile-fixed-full p-0" style="background-color: inherit;">

                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<style>
    .bg-gradient {
        /* background: rgb(238, 174, 202); */
        /* box-shadow: inset 0px 0px 50px rgba(10, 10, 10, 0.1); */
    }

    * {
        transition: transform 0.3s ease;
    }

    .zoom {
        transform: scale(1.2);
    }

    .img-head:hover {
        transform: scale(1.5);
        z-index: 10000;
        position: fixed;
        cursor: pointer;
    }

    #active-group-profile-picture:hover {
        transform: scale(1.5);
    }

    .verifier-badge::after {
        content: 'DV';
        width: 20px;
        height: 20px;

        position: absolute;
        margin-bottom: -40px;
        margin-left: -25px;

        background-color: #ffc107;
        color: black;
        border-radius: 50%;
        font-size: x-small;
        padding: 5px;
        min-width: max-content;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border: 1px solid white;
        box-shadow: 1px 0px 1px black;
    }
</style>
<style>
    @media (min-width: 768px) {}

    @media (max-width: 767.98px) {
        .fixed-bottom-mobile {
            display: flex;
            flex-direction: row;
            align-items: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            z-index: 1049;
            background: inherit;
        }
    }
 
</style>
<!-- /.content -->
<script>
    $(document).ready(function() {
        $('.nav-link').on('click', function() {
            $('.nav-item').removeClass('active');
            $(this).parent().addClass('active');
        });
    });
</script>



<script>
    $("#search-mygroup-name-close-search-btn").click(function(e) {

        var ele = document.querySelectorAll(".my-group-item");
        $(".my-group-item").removeClass('d-none');
        // add display none class to all
    });
    $("#search-mygroup-name-search-btn").click(function(e) {
        var ele = document.querySelectorAll(".my-group-item");
        $("#my-group-body").addClass('show');
        // add display none class to all
    });

    $("#search-mygroup-name").keyup(function(e) {
        var keyword = String($("#search-mygroup-name").val()).toLocaleLowerCase();
        if (String(keyword).length >= 1) {

            var ele = document.querySelectorAll(".my-group-item");
            // add display none class to all

            ele.forEach(element => {
                var textOfEle = String($(element).text()).trim().toLocaleLowerCase();

                if (textOfEle.includes(keyword)) {
                    $(element).removeClass('d-none');
                } else {
                    $(element).addClass('d-none');

                }
            });
        } else {
            $(".my-group-item").removeClass('d-none');
        }
    });
</script>



<script>
    function refreshActiveTab() {
        if (_active_tab == 'chatroom') {
            loadGroupChatroom();
        } else if (_active_tab == 'document') {
            loadGroupDocuments();
        } else if (_active_tab == 'member') {
            loadMembers();
        } else if (_active_tab == 'setting') {
            loadSettings();
        } else {
            loadGroupChatroom();
        }
    }

    function loadGroupProfileSection(groupid) {


        $('#group-profile-card').removeClass('d-none'); //show the profile box-card
        var spinner = new Spinner('group-profile-card', 'loading...');
        $.ajax({
            url: '<?= base_url('group/get_group_profile_data') ?>',
            type: 'post',
            data: {
                groupid: groupid
            },
            success: function(response) {
                // update _active_group_id
                _active_group_id = groupid;
                var jsonData = JSON.parse(response);

                function loadProfile() {
                    $('#active-group-profile-name').html(jsonData.group_data.dtgroup_name);
                    $('#active-group-members-count').html(jsonData.members.length);

                    $("#members-profile-heads-wrapper").html('');
                    $("#admin-profile-heads-wrapper").html('');

                    const bgColor = ['danger', 'primary', 'warning'];

                    var verifier_badge_class = 'verifier-badge' // add a verfier class badge
                    var adminCount = 0;
                    var loopcounter = 0;
                    var heads_parent_width = $("#members-profile-heads-wrapper").width() - 40; //40 is width of a img-head
                    var total_heads = jsonData.members.length;
                    var margin = 40 - (heads_parent_width / total_heads);

                    jsonData.members.forEach((item) => {
                        var member_role = item.enrolledgroup_role;
                        if (member_role == 'admin') {
                            adminCount++;
                        }

                        var user_file = item.user_pic_filename;
                        var user_img = '';

                        var add_verifier_badge_class = verifier_badge_class
                        if ((item.enrolledgroup_as_doc_verifier * 1) !== 1) {
                            add_verifier_badge_class = ''; //remove badge class if not 1 or not a verifier
                        }

                        if (user_file == '') {
                            var user_initials = String(item.user_firstname)[0] + String(item.user_lastname)[0];

                            user_img = `<div title="` + item.user_firstname + ` ` + item.user_lastname + `" class="` + add_verifier_badge_class + ` text-uppercase bg-secondary  font-weight-bold d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle img-head" style=" height: 40px; width:40px;position:relative;margin-left:-` + (loopcounter) + `px;">` + user_initials + `</div>`;

                        } else {
                            user_img = `<div class="` + add_verifier_badge_class + ` img-head d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle" style="object-fit: cover;position:relative;margin-left:-` + (loopcounter) + `px"><img title="` + item.user_firstname + ` ` + item.user_lastname + `" class=" bg-light  img-circle " style="object-fit: cover; height: 40px; width:40px;position:relative;" src="<?= base_url('uploads/'); ?>` + item.user_pic_filename + `" alt="` + String(item.user_firstname)[1] + String(item.user_lasttname)[1] + `"></div>`;
                        }
                        $("#members-profile-heads-wrapper").append(user_img);
                        if (item.enrolledgroup_role == 'admin') {
                            $("#admin-profile-heads-wrapper").append(user_img);

                        }

                        loopcounter = margin;
                        $('#active-group-admin-count').html(adminCount);
                    });
                }

                loadProfile();
                $(window).resize(function() {
                    loadProfile();
                });



                if (jsonData.group_data.dtgroup_pic == '') {
                    $('#active-group-profile-picture').attr('src', '<?= base_url('img/default_group_pic.png'); ?>');
                    _active_group_profile_pic = '';
                } else {
                    $('#active-group-profile-picture').attr('src', '<?= base_url('uploads/'); ?>' + jsonData.group_data.dtgroup_pic);
                    _active_group_profile_pic = jsonData.group_data.dtgroup_pic;

                }

                //add zoom effect
                $('#active-group-profile-picture').addClass('zoom');
                $('#active-group-profile-name').addClass('zoom');

                setTimeout(function() {
                    $('#active-group-profile-picture').removeClass('zoom');
                }, 200);
                setTimeout(function() {
                    $('#active-group-profile-name').removeClass('zoom');
                }, 400);

                refreshActiveTab() // refresh the active tab of the group
                spinner.destroy();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching search results:', error);

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
                    title: 'Error'
                })

                $('#searchResults').html('<i class="text-danger">' + error + '</i>');


            }
        });


    }

    function loadUserGroupList() {


        //    empty the group-list-container
        $('#group-list-container').empty();
        var spinner = new Spinner('card-my-group', 'loading...');
        $.ajax({
            url: '<?= base_url('group/user_group_list') ?>',
            type: 'post',
            data: '',
            success: function(response) {

                var jsonData = JSON.parse(response);


                if (jsonData.user_groups_data.length >= 1) {

                    if (jsonData.user_groups_data.length <= 10) {
                        $("#my-group-body").addClass('show');
                    }

                    $.each(jsonData.user_groups_data, function(indexInArray, valueOfElement) {
                        var group_pic = valueOfElement.dtgroup_pic;
                        var final_pic = `<img class="img-fluid img-circle" style="object-fit: cover; height: 50px; width:50px" src="` + "<?= base_url('img/default_group_pic.png'); ?>" + `" alt="">`;


                        if (String(group_pic).length >= 1) {
                            final_pic = `<img class=" img-fluid img-circle" style="object-fit: cover; height: 50px; width:50px" src="` + "<?= base_url('uploads/'); ?>" + valueOfElement.dtgroup_pic + `" alt="">`;
                        }

                        var groupListItem = `<a data-groupid="` + valueOfElement.dtgroup_id + `" href="<?= base_url(); ?>" class="nav-link border-0 text-justify my-group-item btn-block font-weight-bolder mt-0 pt-1 pb-1">
                                                ` + final_pic + `
                                                <p>
                                                ` + valueOfElement.dtgroup_name + `
                                                </p>
                                            </a>`;
                        $("#group-list-container").append(groupListItem);
                    });

                    onClickMyGroupItem();
                } else {
                    $('#group-list-container').html('<span class="text-muted">No group available</span>');
                    $("#my-group-body").addClass('show');
                }




                spinner.destroy();


                $('#group-main-navigation-container').html('');
                $('#active-group-profile-name').html('');
                $('#active-group-members-count').html('');
                $('#active-group-admin-count').html('');
                $('#group-profile-card').addClass('d-none'); //hide the profile box-card


            },
            error: function(xhr, status, error) {
                console.error('Error fetching search results:', error);

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

                $('#searchResults').html('<i class="text-danger">' + error + '</i>');


            }
        });


    }

    function loadGroupChatroom() {

        if (_active_group_id == 0) {
            Swal.fire(
                '',
                'You need to select a group before you can proceed.',
                'error'
            )
            return
        }
        _active_tab = "chatroom";
        $('#group-main-navigation-container').html('');
        var spinner = new Spinner('group-main-navigation-container', 'loading...');

        $.ajax({
            url: '<?= base_url('group/group_chatroom') ?>',
            type: 'post',
            data: {
                groupid: _active_group_id
            },
            success: function(response) {

                $("#group-main-navigation-container").html(response);
                if (isMobileScreen()) {
                    document.getElementById('chatroom-sticky').classList.add('full-height-width');
                }
                document.getElementById('group-main-navigation-container').classList.remove('d-none');
                spinner.destroy();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching search results:', error);

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
                    title: "Something went wrong!"
                })
                spinner.destroy();



            }
        });

    }

    function loadGroupDocuments() {
        if (_active_group_id == 0) {
            Swal.fire(
                '',
                'You need to select a group before you can proceed.',
                'error'
            )
            return
        }
        _active_tab = "document";
        $('#group-main-navigation-container').html('');
        var spinner = new Spinner('group-main-navigation-container', 'loading...');

        $.ajax({
            url: '<?= base_url('group/group_documents') ?>',
            type: 'post',
            data: {
                groupid: _active_group_id
            },
            success: function(response) {

                $("#group-main-navigation-container").html(response);
                if (isMobileScreen()) {
                    document.getElementById('group-main-navigation-container').classList.remove('d-none');
                }
                document.getElementById('group-main-navigation-container').classList.remove('d-none');
                spinner.destroy();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching search results:', error);

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
                    title: 'error'
                })
                spinner.destroy();



            }
        });

    }

    function loadMembers() {
        if (_active_group_id == 0) {
            Swal.fire(
                '',
                'You need to select a group before you can proceed.',
                'error'
            )
            return
        }
        _active_tab = "member";
        $('#group-main-navigation-container').html('');
        var spinner = new Spinner('group-main-navigation-container', 'loading...');

        $.ajax({
            url: '<?= base_url('group/group_members') ?>',
            type: 'post',
            data: {
                groupid: _active_group_id
            },
            success: function(response) {
                $("#group-main-navigation-container").html(response);
                if (isMobileScreen()) {
                    document.getElementById('group-main-navigation-container').classList.remove('d-none');
                }
                document.getElementById('group-main-navigation-container').classList.remove('d-none');
                spinner.destroy();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching search results:', error);

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
                    title: 'error'
                })
                spinner.destroy();



            }
        });

    }

    function loadSettings() {
        if (_active_group_id == 0) {
            Swal.fire(
                '',
                'You need to select a group before you can proceed.',
                'error'
            )
            return
        }
        _active_tab = "setting";
        $('#group-main-navigation-container').html('');
        var spinner = new Spinner('group-main-navigation-container', 'loading...');

        $.ajax({
            url: '<?= base_url('group/group_settings') ?>',
            type: 'post',
            data: {
                groupid: _active_group_id
            },
            success: function(response) {

                $("#group-main-navigation-container").html(response);
                if (isMobileScreen()) {
                    document.getElementById('group-main-navigation-container').classList.remove('d-none');
                }
                document.getElementById('group-main-navigation-container').classList.remove('d-none');
                spinner.destroy();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching search results:', error);

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
                    title: 'error'
                })
                spinner.destroy();



            }
        });

    }

    function onClickMyGroupItem() {
        var items = document.querySelectorAll(".my-group-item");

        items.forEach((item) => {
            $(item).click(function(e) {
                e.preventDefault();
                var group_id = e.currentTarget.dataset.groupid;
                // load data on profile card
                $('#group-main-navigation-container').html('');
                loadGroupProfileSection(group_id);

            });
        });

    }
</script>

<script>
    function moveElementSafely(elementId, newParentId) {
        const elementToMove = document.getElementById(elementId);
        const newParent = document.getElementById(newParentId);

        if (!elementToMove) {
            console.error(`Element with ID "${elementId}" not found.`);
            return;
        }

        if (!newParent) {
            console.error(`New parent with ID "${newParentId}" not found.`);
            return;
        }

        newParent.appendChild(elementToMove);
    }



    function isMobileScreen() {
        console.log(window.innerWidth);
        if (typeof window !== 'undefined') { // Check if window is defined (for browser context)

            return window.innerWidth <= 768; // Adjust 768 to  desired breakpoint that is medium size as per bootstrap
        }
        return false; // Return false if not in browser context (e.g., server-side)
    }

    function setFullHeight() {
        document.getElementById('group-main-navigation-container').classList.add('full-height');
    }
</script>

<script>
    function leaveGroup() {



        Swal.fire({
            title: 'Leave group?',
            html: 'Are you sure you want to leave the group? <h2 class="h3 text-primary"> <i class="fa fa-sad-tear"></i></h2>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                var spinner = new Spinner('group-profile-card', 'loading...');
                $.ajax({
                    url: '<?= base_url('group/group_leave_group') ?>',
                    type: 'post',
                    data: {
                        groupid: _active_group_id
                    },
                    success: function(response) {
                        var data = JSON.parse(response);

                        if (data.status == true) {
                            window.location.href = "<?= base_url('group'); ?>";
                        } else if (data.status == false) {
                            Swal.fire(
                                "Failed",
                                data.message,
                                'info'
                            )
                        }
                        spinner.destroy();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            showCancelButton: false,
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
                            title: "Something went wrong!"
                        })
                        spinner.destroy();



                    }
                });
            }
        })


    }
</script>


<script>
    $(document).ready(function() {
        // load the grouplist affailiated to user
        loadUserGroupList();

        //move the element navigation
        if(isMobileScreen()){
            moveElementSafely("group-navigation", "group-navigation-on-mobile");
        }

    });
</script>


<?= $this->endSection(); ?>