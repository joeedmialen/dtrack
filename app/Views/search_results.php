<!-- search result by name or by tracking code -->
<div class="col-md-10 offset-md-1">
    <div class="list-group">

        <?php if (count($result) == 0) : ?>
            <div class="text-center">
                Search returned none. Please try another keyword.
            </div>

        <?php else : ?>

            <div class="border-bottom py-4">
                <div class="row px-4 muted">

                    <div>
                        <?= count($result); ?> Result/s
                    </div>

                </div>
            </div>
            <?php
            foreach ($result as $key => $value) : ?>
                <div class="border-bottom py-4">
                    <div class="row">
                        <div class="col px-4">
                            <div>
                                <div class="float-right">Created: <?= $value['document_date']; ?> <span class="text-uppercase smaller" onclick="onclick_timeline(event)" data-toggle="modal" data-target="#my-modal"  data-doc_code="<?= $value['document_code']; ?>" href="#"><i class="fas fa-clock"></i>Timeline</span></div>
                                <h3 class="text-left higlightable"><?= $value['document_name']; ?></h3>
                                <p class="mb-0 text-left"><b>Owner:</b>
                                    <span class="higlightable"> <?= $value['user_username']; ?></span> <b>Code:</b>
                                    <span class="higlightable"> <?= $value['document_code']; ?> </span> <b>Office:</b>
                                    <span class="higlightable"> <?= $value['document_office_name']; ?></span> <b>Remarks:</b>
                                    <span class="higlightable"> <?= $value['document_remark']; ?></span>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>

<!--  -->
<div id="my-modal" class="modal fade" style="min-height: 500px; z-index:2000" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="false">
    <div class="modal-dialog  modal-lg " role="document">
        <div id="modal-content" class="modal-content overflow-auto ">

            <div class="modal-header">
                <span onclick="toggleFormViewExpansion(event,'modal-content')" class="btn btn-default m-1" title="Toggle expansion view"><i class="fa fa-expand"></i></span>

                <h5 class="modal-title" id="my-modal-title">
                    <!-- Title -->
                </h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body" class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <!-- Footer -->
            </div>
        </div>
    </div>
</div>

<!-- /.modal -->

<script>
    function onclick_timeline(e) {

        var doc_code = e.currentTarget.dataset.doc_code;
        var url = "<?= base_url('timeline'); ?>"
        $('#modal-body').html('');
        var spinner = new Spinner('modal-body', 'loading...');
      
        setTimeout(function() {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    code: doc_code,
                },
                success: function(response) {
                    var res_html = `<div class="small smaller-font">` + response + `<div>`;
                    $('#modal-body').html(res_html);

                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error',
                        error,
                        'error'
                    )

                }
            });
        }, 1000);
    }
</script>