<?php $session = session() ?>

<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Register Document</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Register Document</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content p-0">
    <div class="container p-0">
        <div class="row p-0">

            <div class="col-12">
                <div class="card  shadow mobile-fixed-full ">
                    <div class="card-header mobile-sticky-header px-1 d-md-none d-lg-none">

                        <h2 class="card-title d-sm-inline d-md-none px-0">
                            <a class="btn btn-danger rounded-circle" href="<?= base_url('') ?>"><i class="fas fa-arrow-left"></i> </a>
                            Register Document</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <!-- <form> -->
                    <?= form_open('/submit_register_doc') ?>
                    <div class="card-body row text-gray ">
                        <div class="col-lg-6 col-md-6 col-12 ">
                            <div class="  rounded p-2 ">
                                <div>Documents Details</div>
                                <hr>
                                <div class="form-group m-1 ">
                                    <label for="name">Document Name/Particulars</label>
                                    <input required type="text" class="form-control " id="name" name="name" placeholder="..." value="">
                                </div>
                                <div class="form-group">
                                    <label>Document Type</label>
                                    <select name="document_type" class="custom-select">
                                        <option>MOOE</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="form-group m-1 ">

                                    <label for="name">Remarks</label>
                                    <textarea hidden id="remark" name="remark" required maxlength="200" type="text" class="form-control"  placeholder="..." value=""> </textarea>
                                    <input hidden type="text" class="form-control" id="name" name="mentioned_users" placeholder="..." value="">

                                    <div id="editable-div" contenteditable="true" class="form-control "></div>
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-6 col-md-6 col-12  ">
                            <div class=" rounded  p-2 ">
                                <div>Other Documents Details (Auto-Generated - Read only)</div>
                                <hr>

                                <div class="form-group m-1">
                                    <label for="input_owner">Document Owner</label>
                                    <input type="text" class="form-control " disabled placeholder="" value="<?= $session->get('userData')['user_username'] ?>">
                                    <input type="text" hidden id="input_owner" value="<?= $session->get('userData')['user_username'] ?>">
                                </div>
                                <div class="form-group m-1 ">
                                    <label for="name">Office Name</label>
                                    <input required type="text" class="form-control" disabled placeholder="..." value="<?= $session->get('userData')['user_office'] ?>"> <!--for dispaly only -->
                                    <input hidden required type="text" class="form-control d-none" id="office-name" name="office_name" placeholder="..." value="<?= $session->get('userData')['user_office'] ?>"> <!-- hidden actuol data bearer -->
                                </div>
                                <div class="form-group m-1">
                                    <label for="input_date">Date of Registration</label>
                                    <input type="text" class="form-control" disabled id="date" placeholder="" value="<?= $date ?>">
                                    <input type="text" hidden name="date" id="date" placeholder="" value="<?= $date ?>">
                                </div>
                                <div class="form-group m-1">
                                    <label for="input_date">Document Tracking Code</label>
                                    <input type="text" class="form-control " disabled id="tracking_code" placeholder="" value="<?= $tracking_code ?>">
                                    <input type="text" hidden name="tracking_code" id="tracking_code" placeholder="" value="<?= $tracking_code ?>">
                                </div>
                                <div class="form-group m-1 d-none">
                                    <label for="input_date">Document Tracking QRCode</label>
                                    <div>
                                        <p id="qrcode" class="p-1 bg-white" style="width:fit-content"></p>
                                    </div>
                                    <input type="text" class="form-control d-none " disabled id="qrcode" placeholder="" value="">
                                    <input type="text" class="form-control d-none " hidden name="qrcode" id="qrcode" placeholder="" value="">


                                </div>



                            </div>


                        </div>




                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <a class="btn btn-danger float-right" href="<?= base_url('') ?>"><i class="fas fa-times"></i> Cancel</a>

                    </div>

                    <?= form_close() ?>

                    <!-- </form> -->
                </div>

            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">

            </div>
            <!-- /.col -->


        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div id="floating-element" class="bg-dark ">
    <ul class="contacts-list small">
        <?php foreach ($group_mates as $key => $value) : ?>
            <li class="p-1 small contacts-list-item" data-user_id="<?= $value['user_id']; ?>" data-name="<?= $value['user_firstname']; ?> <?= $value['user_lastname']; ?>">
                <!-- <a href="#"> -->
                <?php if ($value['user_pic_filename'] !== "") : ?>
                    <img style="object-fit: cover; height: 20px; width:20px; overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="contacts-list-img" alt="">
                <?php else : ?>
                    <span class="bg-dark overflow-hidden font-weight-bold d-flex border border-light justify-content-center  align-items-center contacts-list-img" style="height:20px;width:20px;"><?= strtoupper(substr($value['user_firstname'], 0, 1)); ?><?= strtoupper(substr($value['user_lastname'], 0, 1)); ?></span>
                <?php endif; ?>
                <div class="contacts-list-info  mx-1">
                    <span class="contacts-list-name ">
                        &nbsp; <?= $value['user_firstname']; ?> <?= $value['user_lastname']; ?>
                    </span>
                    <span class="contacts-list-msg small">&nbsp; <?= $value['user_office']; ?></span>
                </div>
                <!-- /.contacts-list-info -->
                <!-- </a> -->
            </li>

            <!-- End Contact Item -->

        <?php endforeach; ?>
    </ul>

</div>
<!-- /.content -->
<?php if (isset($is_success)) : ?>
    <script>
        $(function() {
            Swal.fire({
                title: 'Saved',
                text: '<?= $message; ?>',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                setTimeout(function() {
                    window.location.href = '<?= base_url(); ?>';
                }, 500);
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
    $(function() {
        $('#editable-div').on('input', function() {
            var textareaText = $(this).text().trim();
            var words = textareaText.split(' ');
            var lastWord = String(words[words.length - 1]).trim(' ');
            $('#remark').text($('#editable-div').html());

            if (lastWord.startsWith('@')) {
                var sel = window.getSelection();
                var lastword = lastWord.substring(1); // without @
                if (sel.rangeCount > 0) {
                    var range = sel.getRangeAt(0);
                    var rect = range.getBoundingClientRect();

                    var cursorX = rect.left + (rect.width / 2); // Calculate X position
                    var cursorY = rect.top - 5; // Adjust Y position as needed
                    populateFloatingElement(lastword);
                    positionFloatingElement(cursorX, cursorY, "editable-div");
                }
            } else {
                hideFloatingElement();
            }
        });

        // Function to show the floating element and position it
        function positionFloatingElement(cursorX, cursorY, inputParentId) {
            var inputParentId = $('html');
            var floatingElement = $('#floating-element');
            var rightSpace = inputParentId.width() - (cursorX + 5);
            var leftSpace = inputParentId.width() - (cursorX + 5 + floatingElement.width());

            var floatingElementWidth = floatingElement.width();

            if (rightSpace < floatingElementWidth) {
                floatingElement.css({
                    'top': (cursorY - floatingElement.height()) + 'px',
                    'right': 5 + 'px'
                });
            } else {
                floatingElement.css({
                    'top': (cursorY - floatingElement.height()) + 'px',
                    'left': (cursorX + 5) + 'px'
                });
            }
        }

        // Function to populate the floating element with content (example)
        function populateFloatingElement(keyword) {
            var contactsList = $('#contacts-list');


            // Simulated list of contacts
            //var contacts = [ <?php foreach ($group_mates as $key => $value) : ?>'<?= $value['user_firstname']; ?> <?= $value['user_lastname']; ?>', <?php endforeach; ?>];
            var list = document.querySelectorAll('.contacts-list-name');
            var lcaseKeyword = String(keyword).toLowerCase();
            var hasMatch = false;
            list.forEach(function(contact) {
                var contactname = String(contact.textContent).trim().toLowerCase();
                if (contactname.includes(lcaseKeyword)) {
                    $(contact.parentElement.parentElement).removeClass("d-none");
                    hasMatch = true;

                } else {
                    $(contact.parentElement.parentElement).addClass("d-none");
                }

            });

            if (hasMatch == false) {
                hideFloatingElement();
            }else{
                showFloatingElement();
            }

        }

        // Function to hide the floating element
        function hideFloatingElement() {
            $('#floating-element').css('display', 'none');
           

        }
        function showFloatingElement() {
            $('#floating-element').css('display', 'block');
           

        }

        $('.contacts-list-item').click(function(e) {
            e.preventDefault();
            var user_name = e.currentTarget.dataset.name;
            var user_id = e.currentTarget.dataset.user_id;
            var editable_div_html_content = $('#editable-div').html();
            var lastIndexAtSymbol = String(editable_div_html_content).lastIndexOf("@")//
            var cleanedString =  String(editable_div_html_content).substring(0,lastIndexAtSymbol);
            var new_element = '&nbsp<b contenteditable="false" data-user_id="' + user_id + '" class="name-callout bg-primary px-1 rounded font-weight-light" >@' + user_name + '</b> &nbsp ';

            $('#editable-div').html(cleanedString + " " + new_element);
            hideFloatingElement();
            $('#remark').text($('#editable-div').html());

        });

    });
</script>
<script>
    document.getElementById('editable-div').addEventListener('input', function() {
        this.style.height = 'auto'; // Reset height to auto to calculate actual content height
        this.style.height = this.scrollHeight + 'px'; // Set height to scroll height
    });
</script>
<style>
    #editable-div {
        border: 1px solid #ccc;
        padding: 10px;
        min-height: 50px;
        /* Set a minimum height */
        overflow-y: auto;
        /* Add scrollbar when content overflows */
    }

    #floating-element {
        /* height: fit-content; */
        max-height: 200px;
        width: 300px;
        position: fixed;
        overflow-y: auto;
        box-shadow: 2px 2px 3px black;
        display: none;
        z-index: 1050;

    }
</style>
<?= $this->endSection(); ?>