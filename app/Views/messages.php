<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<?php helper(['my_helper']); ?>



<link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">

<!-- Content Header (Page header) -->
<section class="content">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><i class="far fa-comments"></i>Messages</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="http://localhost/project-root/public/">Home</a></li>
            <li class="breadcrumb-item active">Messages</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
</section>
<!-- /.content-header -->

<!-- Main content -->
<section class="content pb-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <form action="simple-results.html">
          <div class="input-group">
            <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here">
            <div class="input-group-append">
              <button type="submit" class="btn btn-lg btn-default">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </form>


        <div class="card collapsed-card rounded-0 elevation-0">

          <div class="card-body p-0 rounded-0 elevation-0" style="display: none;">
            <ul class="nav nav-pills flex-column">
              <li class="nav-item active">
                <a href="#" class="nav-link">
                  <i class="fas fa-inbox"></i> Inbox
                  <span class="badge bg-primary float-right">12</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-envelope"></i> Sent
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-file-alt"></i> Drafts
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-filter"></i> Junk
                  <span class="badge bg-warning float-right">65</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-trash-alt"></i> Trash
                </a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card rounded-0 elevation-0">
          <div class="card-header">
            <h3 class="card-title">Contacts</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0 overflow-auto" style="display: block;">
            <ul class="contacts-list">
              <li>
                <a href="#">
                  <img class="contacts-list-img" style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="http://localhost/project-root/public/uploads/1716585373_a605717909f1e2352ee6.png" alt="User Avatar">

                  <div class="contacts-list-info">
                    <span class="text-primary
    ">
                      Count Dracula
                      <small class="contacts-list-date float-right">2/28/2015</small>
                    </span>
                    <span class="contacts-list-msg">How have you been? I was...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <li>
                <a href="#">
                  <img class="contacts-list-img" style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="http://localhost/project-root/public/uploads/1716585373_a605717909f1e2352ee6.png" alt="User Avatar">

                  <div class="contacts-list-info">
                    <span class="text-primary
    ">
                      Count Dracula
                      <small class="contacts-list-date float-right">2/28/2015</small>
                    </span>
                    <span class="contacts-list-msg">How have you been? I was...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <li>
                <a href="#">
                  <img class="contacts-list-img" style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="http://localhost/project-root/public/uploads/1716585373_a605717909f1e2352ee6.png" alt="User Avatar">

                  <div class="contacts-list-info">
                    <span class="text-primary
    ">
                      Count Dracula
                      <small class="contacts-list-date float-right">2/28/2015</small>
                    </span>
                    <span class="contacts-list-msg">How have you been? I was...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <li>
                <a href="#">
                  <img class="contacts-list-img" style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="http://localhost/project-root/public/uploads/1716585373_a605717909f1e2352ee6.png" alt="User Avatar">

                  <div class="contacts-list-info">
                    <span class="text-primary
    ">
                      Count Dracula
                      <small class="contacts-list-date float-right">2/28/2015</small>
                    </span>
                    <span class="contacts-list-msg">How have you been? I was...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <li>
                <a href="#">
                  <img class="contacts-list-img" style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="http://localhost/project-root/public/uploads/1716585373_a605717909f1e2352ee6.png" alt="User Avatar">

                  <div class="contacts-list-info">
                    <span class="text-primary
    ">
                      Count Dracula
                      <small class="contacts-list-date float-right">2/28/2015</small>
                    </span>
                    <span class="contacts-list-msg">How have you been? I was...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li><!-- End Contact Item -->
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9" style="min-height:90% !important
    ">
        <div class="rounded-0 elevation-0 h-100 floating-chat card card-primary card-outline direct-chat direct-chat-primary m-1">
          <div class="card-header">
            <h3 class="card-title">Direct Chat</h3>

            <div class="card-tools">
              <span title="3 New Messages" class="badge bg-primary">3</span>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                <i class="fas fa-comments"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
              <!-- Message. Default to the left -->
              <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-left">Alexander Pierce</span>
                  <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  Is this template really for free? That's unbelievable!
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->

              <!-- Message to the right -->
              <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-right">Sarah Bullock</span>
                  <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  You better believe it!
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->
            </div>
            <!--/.direct-chat-messages-->

            <!-- Contacts are loaded here -->
            <div class="direct-chat-contacts">
              <ul class="contacts-list">
                <li>
                  <a href="#">
                    <img class="contacts-list-img" style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="http://localhost/project-root/public/uploads/1716585373_a605717909f1e2352ee6.png" alt="User Avatar">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Count Dracula
                        <small class="contacts-list-date float-right">2/28/2015</small>
                      </span>
                      <span class="contacts-list-msg">How have you been? I was...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img class="contacts-list-img" style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="http://localhost/project-root/public/uploads/1716585373_a605717909f1e2352ee6.png" alt="User Avatar">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Count Dracula
                        <small class="contacts-list-date float-right">2/28/2015</small>
                      </span>
                      <span class="contacts-list-msg">How have you been? I was...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img class="contacts-list-img" style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="http://localhost/project-root/public/uploads/1716585373_a605717909f1e2352ee6.png" alt="User Avatar">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Count Dracula
                        <small class="contacts-list-date float-right">2/28/2015</small>
                      </span>
                      <span class="contacts-list-msg">How have you been? I was...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img class="contacts-list-img" style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="http://localhost/project-root/public/uploads/1716585373_a605717909f1e2352ee6.png" alt="User Avatar">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Count Dracula
                        <small class="contacts-list-date float-right">2/28/2015</small>
                      </span>
                      <span class="contacts-list-msg">How have you been? I was...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li><!-- End Contact Item -->
              </ul>
              <!-- /.contatcts-list -->
            </div>
            <!-- /.direct-chat-pane -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer message-input-form">
            <form action="#" method="post">
              <div class="input-group">
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                <span class="input-group-append">
                  <button type="submit" class="btn btn-primary">Send</button>
                </span>
              </div>
            </form>
          </div>
          <!-- /.card-footer-->
        </div>

      </div>

    </div>
    <!-- /.card-body -->

    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->

<style>
  .message-input-form{
    position: sticky;
    bottom: 0px;
  }
</style>



<?= $this->endSection(); ?>