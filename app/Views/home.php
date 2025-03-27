<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="nav-icon fas fa-home"></i> Home</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                    <!-- <li class="breadcrumb-item active">Starter Page</li> -->
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content" style="min-height: 100%;">

    <div class="container">
        <div class="pt-5">
            <div class=" text-center">
                <!-- <p>Document Actions</p> -->
            </div>
            <div class=" d-flex flex-row flex-wrap justify-content-center ">

                <a href="<?= base_url('register_doc') ?>" class="btn btn-app bg-primary" title="Register document to track.">
                    <!-- <span class="badge bg-success">300</span> -->
                    <i class="fas fa-tag"></i> Register
                </a>
                <span class="d-none">
                    <a href="<?= base_url('receive_doc') ?>" class="btn btn-app bg-success" title="Receive document to track.">
                        <!-- <span class="badge bg-success">300</span> -->
                        <i class="fas  fa-clipboard-check"></i> Receive
                    </a>
                    <a href="<?= base_url('release_doc') ?>" class="btn btn-app bg-danger" title="Send out document to track.">
                        <!-- <span class="badge bg-success">300</span> -->
                        <i class="fas  fa-paper-plane"></i>Release
                    </a>
                </span>
                <a href="<?= base_url('onhand') ?>" class="btn btn-app bg-info " title="Documents on hand.">
                    <!-- <span class="badge bg-success">300</span> -->
                    <div style="font-size: 30px; margin-top:-25px"><i class="fas  fa-hand-holding"></i></div> OnHand
                    <span class="badge badge-danger navbar-badge user-num-pending-docs"></span>
                </a>
                <a href="<?= base_url('my_docs') ?>" class="btn btn-app bg-info " title="Search.">
                    <!-- <span class="badge bg-success">300</span> -->
                    <i class="fas  fa-folder"></i>My Docs
                    <span class="badge badge-warning navbar-badge user-num-docs"></span>

                </a>
                <a href="<?= base_url('search') ?>" class="btn btn-app bg-orange " title="Search.">
                    <!-- <span class="badge bg-success">300</span> -->
                    <i class="fas  fa-search"></i>Search
                </a>
            </div>

           
            <div class="d-flex flex-row flex-wrap justify-content-center">
                <a href="<?= base_url('receive_doc_by_qrcode') ?>" class="btn btn-app bg-success" title="Receive document to track.">
                    <!-- <span class="badge bg-success">300</span> -->
                     <div style="font-size: 20px; margin-top:-5px"><i class="fas  fa-arrow-down"></i> <i class="fas  fa-qrcode"></i> </div>Receive Scan
                </a>
                <a href="<?= base_url('release_doc_by_qrcode') ?>" class="btn btn-app bg-danger" title="Send out document to track.">
                    <!-- <span class="badge bg-success">300</span> -->
                    <div style="font-size: 20px; margin-top:-5px"><i class="fas  fa-arrow-up"></i> <i class="fas  fa-qrcode"></i> </div>Release Scan

                </a>
    
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            type: "get",
            url: "<?= base_url('get_loggeduser_pending_doc_count'); ?>",
            success: function(response) {
                var data = JSON.parse(response);
                if (data.pending_doc_count != 0) {
                    $('.user-num-pending-docs').text(data.pending_doc_count);

                }

            }

        });

        $.ajax({
            type: "get",
            url: "<?= base_url('get_loggeduser_doc_count'); ?>",
            success: function(response) {
                var data = JSON.parse(response);
                if (data.doc_count != 0) {
                    var finalTextCount = 0;
                    if (parseInt(data.doc_count) >= 100) {
                        finalTextCount = '99+';
                    } else {
                        finalTextCount = data.doc_count;
                    }
                    $('.user-num-docs').text(data.doc_count);


                }

            }
        });


    });
</script>
<!-- /.content -->




<?= $this->endSection(); ?>