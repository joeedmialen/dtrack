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
                    <?php if (count($result) >= 50) : ?>
                        <script>
                            Swal.fire(
                                '',
                                'Be more specific of your keyword. Search return too many results.',
                                'info'
                            )
                        </script>

                    <?php endif; ?>

                    <div>
                        <?= count($result); ?> Result/s


                    </div>

                </div>
            </div>
            <?php
            // print_r($result);
            // echo "<br>"
            ?>
            <?php

            foreach ($result as $key => $value) : ?>
                <?php
                // print_r($value);
                // echo "<br>"
                ?>
                <div class="border-bottom py-4">
                    <div class="row">
                        <div class="col px-4">
                            <div>
                                <span id="search-item-action-container-<?= $value['user_id']; ?>" class="float-right text-muted font-weight-light small">
                                    <?php if ($active_groupid !== $value['dtgroup_id']) : ?>
                                        <button data-userid="<?= $value['user_id']; ?>" onclick="onClickAddUserToGroup(event)" type="button" class="btn btn-success btn-sm"><i class="nav-icon fa fa-user-plus"></i> Add </button>
                                    <?php else : ?>
                                        <span class="text-muted font-weight-light">Already a member</span>
                                    <?php endif; ?>
                                </span>
                                <div class="float-left text-left">
                                    <span>
                                        <?php if ($value['user_pic_filename'] !== "") : ?>
                                            <img style="object-fit: cover; height: 40px; width:40px; overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="img-circle" alt="">
                                        <?php else : ?>
                                            <img style="object-fit: cover; height: 40px; width:40px; overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="img-circle" alt="">
                                        <?php endif; ?>
                                        <span class="higlightable text-bold"> <?= $value['user_username']; ?></span><br>
                                        <span class="higlightable text-uppercase"> <?= $value['user_firstname']; ?></span>
                                        <span class="higlightable text-uppercase"> <?= $value['user_lastname']; ?> </span>
                                        <span class="text-muted text-uppercase"> <?= $value['user_office']; ?> </span>
                                    </span>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>

<script>
    function onClickAddUserToGroup(e) {
        var user_id = e.currentTarget.dataset.userid;
        $("#search-item-action-container-" + user_id).html('');
        var spinner = new Spinner("search-item-action-container-" + user_id, 'loading...');
        $.ajax({
            url: '<?= base_url('group/group_add_member_get_search_result_add') ?>',
            type: 'post',
            data: {
                groupid: _active_group_id, //
                user_id: user_id

            },
            success: function(response) {
                var data = JSON.parse(response);
                var msg = response.message;
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 5500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                if (data.result >= 1) {

                    Toast.fire({
                        icon: 'success',
                        title: 'Successfully added.'
                    });
                    spinner.destroy();
                    $("#search-item-action-container-" + user_id).html(`<i class="fa fa-user-check"></i> Just added.`);
                } else {

                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong'
                    });
                    spinner.destroy();
                }


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
                $("#search-item-action-container-" + user_id).html(`<span class="text-red"><i class="fa fa-exclamation-triangle"></i> Error</span>`);



            }
        });
    }
</script>