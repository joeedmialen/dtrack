<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Scan QRCode</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item">Receive Document</li>
                    <li class="breadcrumb-item active">Scan QRCode</li>

                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

    <div class="container">

        <div class="card bg-light shadow  mobile-fixed-full">
            <!-- <div class="card-header">
              

            </div> -->
            <div class="card-body bg-black  rounded " style="overflow: hidden !important">

                <div class="row  d-flex flex-row justify-content-center align-content-center">

                    <div class="col-12  d-flex flex-row justify-content-center align-content-center">
                        <!-- <video id="video" width="400" height="300" autoplay></video> -->
                        <!-- <canvas id="canvas" width="100" height="100"></canvas> -->
                        <div class="shadow-none   d-sm-block d-md-block d-lg-none">
                            <?php if (session()->get('user_pic') !== "") : ?>
                                <img style="object-fit: cover; height: 45px; width:45px; overflow:hidden;" src="<?= base_url('uploads/' . session()->get('user_pic')); ?>" class="logged-user-profile-pic-img img-circle elevation-2 border-light border" alt="">
                            <?php else : ?>
                                <span class="bg-dark overflow-hidden font-weight-bold d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle border-light border" style=" height: 40px; width:40px;">
                                    <?= substr(session()->get('userData')['user_firstname'], 0, 1); ?><?= substr(session()->get('userData')['user_lastname'], 0, 1); ?>
                                </span>

                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12  d-flex flex-row justify-content-center align-content-center ">
                        <div class="form-group d-flex flex-column p-1 px-2 text-success" style="position: absolute;top:0px; background-color: rgba(0,0,0,1);border-radius:0 0 10px 10px;">
                            Receive Scan
                        </div>
                        <div class="form-group d-flex flex-column p-3" style="position: absolute;bottom:0px; background-color: rgba(0,0,0,0.5);border-radius:10px;">

                            <span class="d-flex flex-row align-content-center justify-content-center">
                                <span class="spinner-grow text-danger" role="status">
                                </span>
                                <span class="text-white">Scanning...</span>
                            </span>
                            <a class="btn  btn-primary shadow text-light mt-3" href="<?= base_url('') ?>"><i class="fas fa-square-full"></i> Stop</a>
                        </div>
                        <!-- <video id="video" width="400" height="300" autoplay></video> -->
                        <canvas id="canvas" width="200" height="100" style="min-height:500px ;"></canvas>
                        <div class="scan">
                        </div>
                        <div class="scan2">
                        </div>
                    </div>
                    <div id="output">
                        <div id="outputMessage" class="p-2">No QR code detected.</div>
                        <div hidden=""><b>Data:</b> <span id="outputData"></span></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- /.content -->
<script>
    // Create an AudioContext instance
    const audioContext = new(window.AudioContext || window.webkitAudioContext)();

    // Function to generate a sine wave with a specified frequency and duration
    function generateTone(frequency, duration) {
        // Create an oscillator node
        const oscillator = audioContext.createOscillator();
        oscillator.type = 'sine'; // sine wave oscillator

        // Set frequency
        oscillator.frequency.setValueAtTime(frequency, audioContext.currentTime);

        // Connect the oscillator to the audio context's destination (speakers)
        oscillator.connect(audioContext.destination);

        // Start the oscillator
        oscillator.start();

        // Stop the oscillator after the specified duration
        setTimeout(() => {
            oscillator.stop();
        }, duration);
    }
</script>
<script>
    var hasSounded = false;
    var stopScanning = false;

    function extractDocumentCode(url) {
        var urlParts = String(url).split('/');
        var code = urlParts.slice(-1); //expected code
        if (String(code).trim().length !== 0) {

            if (!hasSounded) {
                generateTone(440, 200); // frequency in Hz, duration in milliseconds
            }
            hasSounded = true;
            stopScanning = true;
            window.location.href = "<?= base_url() ?>confirm_receive_qrcode_data/" + code;

        }


    }
    $(document).ready(function() {
        var video = document.createElement("video");
        var canvasElement = document.getElementById("canvas");
        var canvas = canvasElement.getContext("2d");
        var loadingMessage = document.getElementById("loadingMessage");
        var outputContainer = document.getElementById("output");
        var outputMessage = document.getElementById("outputMessage");
        var outputData = document.getElementById("outputData");

        function drawLine(begin, end, color) {
            canvas.beginPath();
            canvas.moveTo(begin.x, begin.y);
            canvas.lineTo(end.x, end.y);
            canvas.lineWidth = 4;
            canvas.strokeStyle = color;
            canvas.stroke();
        }

        // Use facingMode: environment to attemt to get the front camera on phones
        navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: "environment"
            }
        }).then(function(stream) {
            video.srcObject = stream;
            video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
            video.play();
            requestAnimationFrame(tick);
        });

        function tick() {
            if (stopScanning) {
                return;  // Stop scanning once the QR code is found and extracted
            }
            //loadingMessage.innerText = "⌛ Scanning..."
            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                canvasElement.hidden = false;
                outputContainer.hidden = false;

                canvasElement.height = video.videoHeight;
                canvasElement.width = video.videoWidth;
                canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
                var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                var code = jsQR(imageData.data, imageData.width, imageData.height, {
                    inversionAttempts: "dontInvert",
                });
                if (code) {
                    drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                    drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                    drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                    drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
                    outputMessage.hidden = true;
                    outputData.parentElement.hidden = false;
                    outputData.innerText = code.data;
                    extractDocumentCode(code.data);
                } else {
                    outputMessage.hidden = false;
                    outputData.parentElement.hidden = true;
                }
            }
            requestAnimationFrame(tick);
        }
    });
</script>
<style>
    .scan {
        position: absolute;
        top: 0;
        width: 640px !important;
        height: 0 !important;
        border: red solid 1px;
        z-index: 1;

        /* background: linear-gradient(transparent,transparent,red,transparent, transparent, transparent); */
        animation: scanning 1.5s linear alternate infinite;
    }

    .scan2 {
        position: absolute;
        top: 0;
        width: 640px !important;
        height: 0 !important;
        border: red solid 1px;
        z-index: 1;

        /* background: linear-gradient(transparent,transparent,red,transparent, transparent, transparent); */
        animation: scanning2 1.5s linear alternate infinite;
    }

    @keyframes scanning {
        0% {
            transform: translatey(0px);
        }

        100% {
            transform: translatey(480px);
        }
    }

    @keyframes scanning2 {
        0% {
            transform: translatey(480px);

        }

        100% {
            transform: translatey(0px);
        }
    }
</style>
<?= $this->endSection(); ?>