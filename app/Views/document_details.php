<div class="m-1 d-print-block my-printable-form bg-white overflow-auto" style="width: 100%;">
    <div class="col-12 bg-white p-1  ">
        <div class="rounded p-2 position-relative">
            <h1>Document Details</h1>
            <div class="form-group row">
                <label for="inputName" class="col-sm-3 col-form-label">Document Name/Particulars</label>
                <div class="col-sm-9">
                    <span class="form-control bg-white"><?= $document['document_name']; ?> </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-3 col-form-label">Document Type:</label>
                <div class="col-sm-9">
                    <span class="form-control bg-white"><?= $document['document_type']; ?> </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-3 col-form-label">Owner</label>
                <div class="col-sm-9">
                    <span class="form-control bg-white"><?= $user['user_firstname']; ?> <?= $user['user_lastname']; ?> </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-3 col-form-label">Origin Office</label>
                <div class="col-sm-9">
                    <span class="form-control bg-white"><?= $document['document_office_name']; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-3 col-form-label">Owner's Remarks:</label>
                <div class="col-sm-9">
                    <div class="form-control bg-white" style="overflow-y: auto; height:fit-content"><?= $document['document_remark']; ?></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-3 col-form-label">Date of Registration:</label>
                <div class="col-sm-9">
                    <span class="form-control bg-white"><?= $document['document_timestamp']; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-3 col-form-label">Tracking Code:</label>
                <div class="col-sm-9">
                    <span class="form-control bg-white"><?= $document['document_code']; ?></span>
                </div>
            </div>
            <?php if ($document['document_type'] == 'MOOE') : ?>
                <div class="form-group row">
                    <label for="inputName" class="col-sm-3 col-form-label">CA Date:</label>
                    <div class="col-sm-9">
                        <input style="background-color: white; color:black" data-input_for="ca" onmouseenter="applyInputMask(event)" onkeyup="onkeyupInputCaDate(event)" <?= $logged_user_enrolledgroup_as_doc_verifier ? '1' : 'disabled'; ?> type="text" class="form-control datemask border border-primary" value="<?= $document['document_date_ca']; ?>" data-saved_value="<?= $document['document_date_ca']; ?>" data-doc_id="<?= $document['document_id']; ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" inputmode="numeric">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputName" class="col-sm-3 col-form-label">ADA Date:</label>
                    <div class="col-sm-9">
                        <input style="background-color: white;color:black" data-input_for="ada" onmouseenter="applyInputMask(event)" onkeyup="onkeyupInputAdaDate(event)" <?= $logged_user_enrolledgroup_as_doc_verifier ? '1' : 'disabled'; ?> type="text" class="form-control datemask border border-primary" value="<?= $document['document_date_ada']; ?>" data-saved_value="<?= $document['document_date_ada']; ?>" data-doc_id="<?= $document['document_id']; ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" inputmode="numeric">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputName" class="col-sm-3 col-form-label">Liquidation Date:</label>
                    <div class="col-sm-9">
                        <input style="background-color: white;" data-input_for="liquidation" onmouseenter="applyInputMask(event)" onkeyup="onkeyupInputLiquidationDate(event)" <?= $logged_user_enrolledgroup_as_doc_verifier ? '1' : 'disabled'; ?> type="text" class="form-control datemask border border-primary" value="<?= $document['document_date_liquidation']; ?>" data-saved_value="<?= $document['document_date_liquidation']; ?>" data-doc_id="<?= $document['document_id']; ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" inputmode="numeric">
                    </div>
                </div>

            <?php endif; ?>



        </div>


    </div>
</div>
<style>
    .table td {
        word-wrap: break-word;
    }

    .max-width-135 {
        width: 250px;

    }

    <?php if ($logged_user_enrolledgroup_as_doc_verifier !== '1') : ?>
        input {
            cursor: no-drop;
        }
    <?php endif; ?>
</style>
<script>
    $(document).ready(function() {
        $('.datemask').inputmask('yyyy-mm-dd');
    });
</script>

<script>
    function onkeyupInputCaDate(e) {
        //
        var inputValue = $(e.target).val();
        var doc_id = $(e.target).data('doc_id');
        
        if (inputValue == "") {
            
            updateCaDate(doc_id, '', e.target)
        } else {
            $(e.target).addClass('text-danger')
        }
    }

    function onkeyupInputAdaDate(e) {
        //
        var inputValue = $(e.target).val();
        var doc_id = $(e.target).data('doc_id');
     
        if (inputValue == "") {
            
            updateAdaDate(doc_id, '', e.target)
        } else {
            $(e.target).addClass('text-danger')
        }
    }

    function onkeyupInputLiquidationDate(e) {
        //
        var inputValue = $(e.target).val();
        var doc_id = $(e.target).data('doc_id');
     
        if (inputValue == "") {
      
            updateLiquidationDate(doc_id, '', e.target)
        } else {
            $(e.target).addClass('text-danger')
        }
    }

    function applyInputMask(e) {
        inputMask(e.currentTarget);
    }

    function inputMask(element) {
        var lastSavedValue = element.dataset.saved_value;
        $('.datemask').inputmask('yyyy-mm-dd', {
            placeholder: 'yyyy-mm-dd',
            oncomplete: function() {
                var dateValue = $(element).val();
                var doc_id = element.dataset.doc_id;
                var input_for = element.dataset.input_for; //expecetd values: ada,ca

                if (!isValidDate(dateValue)) {
                    alert('Please enter a valid date in yyyy-mm-dd format.');
                    $(element).val(lastSavedValue).focus();
                    $('.datemask').removeClass('text-danger');

                    //$(this).val('').focus(); // Clear invalid input and focus on the field
                } else {
                    // Check if the entered date is in the future
                    var enteredDate = moment(dateValue, 'YYYY-MM-DD');
                    var currentDate = moment(); // Get current date

                    if (enteredDate.isAfter(currentDate, 'day')) {
                        alert('Please enter a date that is not in the future.');

                        $(element).val(lastSavedValue).focus();
                        $('.datemask').removeClass('text-danger');


                        //$(this).val('').focus(); // Clear invalid input and focus on the field
                    } else {
                        // Date is valid and not in the future, proceed with updating
                        if (input_for == 'ca') {
                            updateCaDate(doc_id, dateValue, element);
                            $('.datemask').removeClass('text-danger');

                        } else if (input_for == 'ada') {
                            updateAdaDate(doc_id, dateValue, element);
                            $('.datemask').removeClass('text-danger');

                        } else if (input_for == 'liquidation') {
                            updateLiquidationDate(doc_id, dateValue, element);
                            $('.datemask').removeClass('text-danger');

                        }

                    }
                }
            },
            onincomplete: function() {

                // This function will be called when the input is incomplete (not fully filled)
                $(element).val(lastSavedValue).focus();
                //alert('Please complete the date in yyyy-mm-dd format.'+lastSavedValue);

                //$(this).val('').focus(); // Clear incomplete input and focus on the field
            }
        });
    }


    function isValidDate(dateString) {
        // Validate date string using a regular expression or date parsing
        var regexDate = /^\d{4}-\d{2}-\d{2}$/;
        return regexDate.test(dateString) && moment(dateString, 'YYYY-MM-DD', true).isValid();
    }

    function updateCaDate(doc_id, ca_date, input_element) {
        var url = "<?= base_url('group/group_update_document_ca_date'); ?>";
        var saved_value = $(input_element).data('saved_value'); // backup the saved value to be retreived when fail
        $.ajax({
            type: "post",
            url: url,
            data: {
                doc_id: doc_id,
                ca_date: ca_date
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status == true) {
                    $(input_element).attr('data-saved_value', ca_date);
                    $(input_element).removeClass('text-danger');

                   

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Saved!'
                    });
                } else {
                    $(input_element).data('saved_value', saved_value);
                }

            },
            error: function(xhr, status, error) {
                $(input_element).data('saved_value', saved_value);
                Swal.fire(
                    'Error',
                    error,
                    'error'
                )

            }
        });

    }

    function updateAdaDate(doc_id, ada_date, input_element) {
        var url = "<?= base_url('group/group_update_document_ada_date'); ?>";
        var saved_value = $(input_element).data('saved_value'); // backup the saved value to be retreived when fail
        $.ajax({
            type: "post",
            url: url,
            data: {
                doc_id: doc_id,
                ada_date: ada_date
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status == true) {
                    $(input_element).attr('data-saved_value', ada_date);
                    $(input_element).removeClass('text-danger');

                 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Saved!'
                    });
                } else {
                    $(input_element).data('saved_value', saved_value);
                }

            },
            error: function(xhr, status, error) {
                $(input_element).data('saved_value', saved_value);
                Swal.fire(
                    'Error',
                    error,
                    'error'
                )

            }
        });

    }

    function updateLiquidationDate(doc_id, liquidation_date, input_element) {
        var url = "<?= base_url('group/group_update_document_liquidation_date'); ?>";
        var saved_value = $(input_element).data('saved_value'); // backup the saved value to be retreived when fail
        $.ajax({
            type: "post",
            url: url,
            data: {
                doc_id: doc_id,
                liquidation_date: liquidation_date
            },
            success: function(response) {
                var data = JSON.parse(response);
                
                if (data.status == true) {
                    $(input_element).attr('data-saved_value', liquidation_date);
                    $(input_element).removeClass('text-danger');

                 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Saved!'
                    });
                } else {
                    $(input_element).data('saved_value', saved_value);
                }

            },
            error: function(xhr, status, error) {
                $(input_element).data('saved_value', saved_value);
                Swal.fire(
                    'Error',
                    error,
                    'error'
                )

            }
        });

    }
</script>