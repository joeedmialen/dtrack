<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas  fa-clipboard-check"></i> Receive Document</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Receive Document</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

    <div class="container-lg container-fluid">

        <div class="card bg-light  mobile-absolute-full">
            <div class="card-header">
                <a class="btn btn-primary float-right" href="<?= base_url('') ?>"><i class="fas fa-times"></i> </a>
            </div>
            <div class="card-body  d-flex flex-row justify-content-center align-content-center ">
                <div class="row" style="max-width: 300px;">
                    <div class="col-12 text-center pt-4 pb-4 h5">
                        Track receiving of Document with:
                    </div>
                    <div class="col-12">
                        <a href="<?= base_url('receive_doc_by_qrcode') ?>" class="info-box btn-app">
                            
                                <span class="info-box-icon bg-success"><i class="fas fa-qrcode"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text h5">Scan QRcode</span>
                                    <!-- <span class="info-box-number">1,410</span> -->
                                </div>
                                <!-- /.info-box-content -->
                            
                            <!-- /.info-box-content -->
                        </a>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 text-center p-5 h5">
                        or
                    </div>
                    <div class=" col-12">
                        <a href="<?= base_url('receive_doc_by_tracking_code') ?>" class="info-box btn-app">
                            <span class="info-box-icon bg-info"><i class="fas  fa-keyboard"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text h5">Enter Tracking Code</span>
                                <!-- <span class="info-box-number"></span> -->
                            </div>
                            <!-- /.info-box-content -->
                        </a>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->


                </div>
            </div>
        </div>




        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- /.content -->

<?= $this->endSection(); ?>