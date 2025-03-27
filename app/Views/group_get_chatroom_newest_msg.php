<?php
helper(['my_helper']);
// print_r($first_record_chatroom_id);

function formatAsLinkable($string)
{
    //loop to all text check if string is linkable then insert it inside "a" tag
    $formatted_string = '';
    $arrayed_string = explode(" ", $string); //returns array 
    // loop item of exploded array
    foreach ($arrayed_string as $key => $value) {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            $link = "<br><a class='text-dark' href='" . $value . "' target='_blank'><u>" . $value . " </u></a>";
            $formatted_string =  $formatted_string . " " . $link;
        } else {
            $formatted_string =  $formatted_string . " " . $value;
        }
    }

    return $formatted_string;
}
?>

<?php foreach ($messages as $key => $value) : ?>
    <?php if ($first_record_chatroom_id == $value['chatroom_id']) : ?>
        <div class="alert text-center">

            <?php if ($group_data['dtgroup_pic'] !== "") : ?>
                <img id="active-group-profile-picture" class=" profile-user-img img-fluid img-circle" style="object-fit: cover; height: 110px; width:110px" src="<?= base_url('uploads/' . $group_data['dtgroup_pic']); ?>" alt="">
            <?php else : ?>
                <img id="active-group-profile-picture" class=" profile-user-img img-fluid img-circle" style="object-fit: cover; height: 110px; width:110px" src="http://localhost/project-root/public/img/default_group_pic.png" alt="">
            <?php endif; ?>
            <h5></i><?= $group_data['dtgroup_name']; ?></h5>

        </div>


    <?php endif; ?>
    <!-- set js last -->
    <?php if ($value['user_id'] == $logged_user_id) : ?>
        <!-- Message to the right -->
        <div class="element direct-chat-msg offset-md-4 col-md-8 right border-0">
            <div class="direct-chat-infos  clearfix">
                <span class="direct-chat-name text-dark float-right"><?= $value['user_firstname'] . " " . $value['user_lastname']; ?></span>
                <span class="direct-chat-timestamp text-secondary float-left"><?= timeStampDateFormat($value['chatroom_timestamp']); ?></span>
            </div>
            <!-- /.direct-chat-infos -->
            <?php if ($value['user_pic_filename'] !== "") : ?>
                <img style="object-fit: cover; height: 40px; width:40px; overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="img-circle direct-chat-img" alt="Message User Image">
            <?php else : ?>
                <span class="bg-dark overflow-hidden font-weight-bold d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle direct-chat-img" style=" height: 40px; width:40px;">
                    <?= substr($value['user_firstname'], 0, 1); ?><?= substr($value['user_lastname'], 0, 1); ?>
                </span>
                <!-- <img style="object-fit: cover; height: 40px; width:40px; overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="img-circle direct-chat-img" alt="Message User Image"> -->
            <?php endif; ?>
            <!-- <img class="direct-chat-img" src="" alt="Message User Image"> -->
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                <?= formatAsLinkable($value['chatroom_text']); ?>
            </div>
            <!-- /.direct-chat-text -->
        </div>

    <?php else : ?>
        <!-- Message. Default to the left -->
        <div class="element direct-chat-msg   col-md-8 inset-md-4 border-0">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name text-dark float-left"><?= $value['user_firstname'] . " " . $value['user_lastname']; ?></span>
                <span class="direct-chat-timestamp text-secondary float-right"><?= timeStampDateFormat($value['chatroom_timestamp']); ?></span>
            </div>
            <!-- /.direct-chat-infos -->
            <?php if ($value['user_pic_filename'] !== "") : ?>
                <img style="object-fit: cover; height: 40px; width:40px; overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="img-circle direct-chat-img" alt="Message User Image">
            <?php else : ?>
                <span class="bg-dark overflow-hidden font-weight-bold d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle direct-chat-img" style=" height: 40px; width:40px;">
                    <?= substr($value['user_firstname'], 0, 1); ?><?= substr($value['user_lastname'], 0, 1); ?>
                </span>
            <?php endif; ?>
            <!-- <img class="direct-chat-img" src="" alt="Message User Image"> -->
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                <?= formatAsLinkable($value['chatroom_text']); ?>
            </div>
            <!-- /.direct-chat-text -->
        </div>
        <!-- /.direct-chat-msg -->

    <?php endif; ?>



<?php endforeach; ?>