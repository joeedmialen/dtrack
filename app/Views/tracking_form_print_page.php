<?php $session = session() ?>

<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<style>
    @media print {}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tracking Form</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item ">Register Document</li>
                    <li class="breadcrumb-item active">Tracking Form</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content pb-4">
    <div class="container-fluid container-lg  ">
        <div class="row p-sm-0">

            <div class="col-12 p-sm-0">
                <div class="alert alert-info d-print-none rounded-0">
                    <i class="icon fas fa-info"></i>
                    Print this form and attach to your document for tracking.
                </div>
                <div class="card card-primary bg-white d-print-block  mt-2 m-sm-0 ">
                    <div class=" d-print-none p-3 shadow">
                        <span id="form-zoom-tool" class="border border-secondary  p-1" style="border-radius: 25px ;">
                            <button style="z-index: 1;min-height: 40px;min-width: 40px;" id="zoom-in-btn" class="btn btn-sm bg-gradient-dark rounded mx-1 rounded-circle" value="Submit"><i class="fa fa-search-plus"></i></button>
                            <span class="p-1"><span id="zoom-label">100</span>%</span>
                            <button style="min-height: 40px;min-width: 40px;" id="zoom-out-btn" class="btn btn-sm bg-gradient-dark rounded-circle mx-1" value="Submit"><i class="fa fa-search-minus"></i></button>
                        </span>

                        <button id="print-button" type="submit" class="btn btn-primary blob" onclick="printForm()" style="z-index: 2;"><i class="fas fa-print"></i> Print</button>

                        <a id="finish-button" class="btn btn-success float-right disabled" onclick="onclickFinish()" style="z-index: 2;"><i class="fas fa-check"></i> Finish</a>
                        
                    </div>


                    <div id="printable-form-parent" class="t text-gray bg-secondary p-3">
                        <div id="printable-form" class="m-1 d-print-block my-printable-form">
                            <div class="bg-white p-1">
                                <div class="rounded p-2 position-relative" style="border: 1px solid black;">
                                    <div class="ribbon-wrapper ribbon-xl">
                                        <div class="ribbon bg-success text-sm">
                                            <img src="<?= base_url(); ?>dist/img/AdminLTELogo.png" alt="DTrack Logo" width="30px" class="brand-image img-circle elevation-3" style="opacity: .8">

                                            DTrack Tracking Tag
                                        </div>
                                    </div>
                                    <style>
                                        .water-mark {
                                            position: absolute;
                                            opacity: 0.2;
                                            top: 150px;
                                        }
                                    </style>
                                    <div class="bg-gradient-gray p-1">
                                        <img src="<?= base_url(); ?>dist/img/AdminLTELogo.png" alt="DTrack Logo" width="50px" class="brand-image img-circle elevation-3" style="opacity: .8">
                                        <span> <span class="font-weight-bolder">DTrack </span> <span class="text-dark">An online Document Tracking System</span> </span>
                                    </div>
                                    <hr>
                                    <img class="water-mark" src="<?= base_url(); ?>dist/img/AdminLTELogo.png" alt="DTrack Logo" width="250px">

                                    <table class="table table-bordered border-dark table-odd">
                                        <tr>
                                            <td class=" text-right ">Document Name:</td>
                                            <td class=" font-weight-bold "><?= $name ?></td>
                                        </tr>
                                        <tr>
                                            <td class=" text-right ">Document Type:</td>
                                            <td class=" font-weight-bold "><?= $document_type ?></td>
                                        </tr>


                                        <tr>
                                            <td class=" text-right">Document owner:</td>
                                            <td class="font-weight-bold "><?= $session->get('userData')['user_username'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Origin Office Name:</td>
                                            <td class="font-weight-bold "><?= $office_name ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Remarks:</td>
                                            <td class="font-weight-bold "> <?= $remark ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Date of Registration:</td>
                                            <td class="font-weight-bold "><?= $date ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Document Tracking Code:</td>
                                            <td class="font-weight-bold "><?= $tracking_code ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Document Tracking QRCode:</td>
                                            <td>
                                                <div class="d-flex flex-nowrap">
                                                    <div>
                                                        <p id="qrcode" class="p-1 bg-white" style="width:300px"></p>
                                                    </div>
                                                    <div class=" alert alert-default-info align-content-center justify-content-center p-3 text-center border">
                                                        <i class="fas fa-info-circle text-warning"></i>
                                                        Scan the QRcode to <br>
                                                        log and track the <br>
                                                        receiving and <br>
                                                        releasing of this document.

                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <!-- <div class="card-footer d-print-none">

                    </div> -->


                    <!-- </form> -->
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<script>
    var scale = 1;
    const formToZoom = document.getElementById("printable-form");
    const zoomInBtn = document.getElementById('zoom-in-btn');
    const zoomOutBtn = document.getElementById('zoom-out-btn');
    var width = formToZoom.getAttribute('transform');
    $("#zoom-label").text(scale * 100);
    zoomInBtn.addEventListener('click', function() {
        if (width <= 200) {
            scale = scale + 0.05;

            formToZoom.setAttribute('style', 'transform: scale(' + scale + ');transform-origin:top');
            $("#zoom-label").text(Math.round(scale * 100));



        }

    });
    zoomOutBtn.addEventListener('click', function() {
        if (width <= 200) {
            scale = scale - 0.05;

            formToZoom.setAttribute('style', 'transform: scale(' + scale + ');transform-origin:top ');
            $("#zoom-label").text(Math.round(scale * 100));




        }

    });

    function printForm() {
        window.print();
        console.log("print");


    }
    window.onafterprint = function() {
        $("#finish-button").removeClass('disabled');
        $("#print-button").removeClass('blob');
    };

    function onclickFinish() {
        Swal.fire({
            title: 'Printing done?',
            text: 'Have you finished printing the form?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',

        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href = "<?= base_url('') ?>";
            } else {

                $("#finish-button").addClass('disabled');
                $("#print-button").addClass('blob');


            }
        })

    }


</script>
<?php if (isset($is_success)) : ?>
    <script>
        $(function() {
            Swal.fire({
                title: 'Saved',
                text: '<?= $message; ?> Now print this tracking form and attach to your document.',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                setTimeout(function() {
                    window.print();
                }, 1000);
            })
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        var qrdata = "<?= base_url() ?>qrcode/<?= $tracking_code ?>";

        $("#qrcode").val(qrdata);
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: qrdata,
            width: 250,
            height: 250,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    });
</script>
<script>
    // run a function to add new notifications in the server
    var callOuts = document.querySelectorAll('.name-callout');
    callOuts.forEach((item) => {
        sender = "<?= $session->get('userData')['user_id'] ?>";
        receiver = item.dataset.user_id;
        type = 'alert',
            message = `<?= $session->get('userData')['user_firstname'] . " " . $session->get('userData')['user_lastname'] ?> mentioned you in his document <?= $remark ?>`;
        link_data = "<?= $tracking_code ?>";
        $.ajax({
            type: "post",
            url: "<?= base_url(); ?>/add_notification",
            data: {
                sender: sender,
                receiver: receiver,
                type: type,
                message: message,
                link_data: link_data
            },
            dataType: "dataType",
            success: function(response) {


            }
        });
    });
</script>
<style>
    @media only screen and (max-width:768px) {
        .content {
            padding-top: 2px !important;
            padding-bottom: 0px !important;
            padding-top: 2px !important;
            padding-right: 0px !important;
            padding-left: 0px !important;

            position: fixed !important;
            top: 0px;
            z-index: 2000;
            width: 100% !important;
            height: 100vh !important;
            background-color: white;
            padding: 0px;
        }

        /* on mobile */
        #form-zoom-tool {
            position: fixed !important;
            left: 50%;
            transform: translate(-50%, -50%);
            top: 90vh !important;
            bottom: 10px !important;
            height: 50px !important;
        }

    }

    @media print {

        body,
        .wrapper,
        .content-wrapper {
            overflow: visible;
            min-height: 0px !important;
            height: 0;
            /* display: none; */
            scroll-snap-stop: always;
            position: relative;


        }

        #printable-form-parent {
            overflow: visible !important;
            background-color: white !important;

        }


        .my-printable-form {
            position: fixed !important;
            scale: 1 !important;


        }

    }

    #printable-form-parent {
        overflow: auto !important;
        background-color: white !important;
        display: grid;
        place-items: center;
        height: 80vh;

    }

    .my-printable-form {
        box-shadow: 0 0 20px #313C3A;
        width: 750px;
        height: 900px;
        transform-origin: top;
        padding: 10px;
        background-color: white;

    }

    #form-zoom-tool {
        position: absolute;
        left: 50%;
        /* Position at 50% from the left edge */
        transform: translate(-50%, -50%);
        /* Translate back by -50% of its own width */
        top: 40px;
        height: 50px;
        z-index: 1000;
        background-color: rgba(200, 200, 200, 0.3);
        backdrop-filter: blur(5px);
        color: blue !important;

    }
</style>
<?= $this->endSection(); ?>