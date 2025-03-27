<!-- load by Post -->
<div id="document-timeline" class="container overflow-auto">
   
    <ul id="profile-tabs" class="nav nav-pills">
        <li class="nav-item" title="linear view"><a class="rounded-pill nav-link active" href="#timeline-linear" data-toggle="tab"><i class="fa fa-long-arrow-alt-up"></i><i class="fa fa-bars"></i> </a></li>
        <li class="nav-item" title="tabular view"><a class="rounded-pill nav-link" href="#timeline-tabular" data-toggle="tab"><i class="fa fa-table"></i> </a></li>
    </ul>
    <br>
    <div class=" border-0 container-md p-0 m-0" style="border: none !important;">
        <div class="card-body p-0 border-0">

            <div class="tab-content">
                <div class="card card-widget border-0 widget-user-2 shadow-sm p-0">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class=" widget-user-header bg-info">
                        <h3 class="my-1 p-1"><?= $document['document_name']; ?>  
                        </h3>

                        <div class="widget-user-image">
                            <?php if ($user['user_pic_filename'] !== "") : ?>
                                <img style="object-fit: cover; height: 70px; width:70px; overflow:hidden" src="<?= base_url('uploads/'); ?><?= $user['user_pic_filename']; ?>" class="img-circle" alt="">
                            <?php else : ?>
                                <img style="object-fit: cover; height: 70px; width:70px; overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="img-circle" alt="">
                            <?php endif; ?>
                        </div>

                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username"><?= $user['user_firstname']; ?> <?= $user['user_lastname']; ?></h3>
                        <h5 class="widget-user-desc"><?= $user['user_position']; ?></h5>
                    </div>

                </div>


                <div id="timeline-linear" class="tab-pane active  p-2">
                    <div class="timeline  border-0">

                        <?php
                        helper(['my_helper']);
                        $releases_count = count($releases);
                        $receive_count = count($receives);

                        $max_forloop = max($releases_count, $receive_count);
                        $last_loop_releases_date = '';
                        // print_r($document);

                        // create an key-value pair array
                        $data_table = [];
                        // add releases to data_table
                        foreach ($receives as $key => $value) {
                            $arr_key = $value['receivelog_timestamp'];
                            $arr_val =  $value;
                            $data_table[$arr_key] = $arr_val;
                        }
                        foreach ($releases as $key => $value) {
                            $arr_key = $value['releaselog_timestamp'];
                            $arr_val =  $value;
                            $data_table[$arr_key] = $arr_val;
                        }
                        //sork array by key in descending order
                        krsort($data_table);

                        foreach ($data_table as $key => $value) {
                            // print_r( $value);

                        }


                        $last_date = "";
                        ?>



                        <?php foreach ($data_table as $key => $value) : ?>

                            <?php if (isset($value['releaselog_id'])) : ?>
                                <!-- handling tiemline lable date -->
                                <?php $event_date = timeStampDateFormat($value['releaselog_timestamp']); ?>
                                <?php if ($event_date !== $last_date) : ?>
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-purple"> <?= substr(timeStampDateFormat($value['releaselog_timestamp']), 0, 16); ?></span>
                                    </div>
                                    <!-- /.timeline-label -->
                                <?php endif; ?>

                                <?php if ($event_date !== $last_date) : ?>
                                    <?php $last_date = $event_date; ?>
                                <?php endif; ?>



                                <!-- timeline item -->
                                <div>
                                    <i class="fas  fa-paper-plane bg-red"></i>
                                    <div class="timeline-item">
                                        <div class="p-2">
                                            <span class="time small float-right"><i class="fas fa-clock"></i> <?= timeStampDateFormat($value['releaselog_timestamp']); ?></span>
                                        </div>
                                        <h3 class="timeline-header  d-sm-block p-3"><a href="#">
                                                <?php if ($value['user_pic_filename'] !== "") : ?>
                                                    <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="img-circle direct-chat-img" alt="Message User Image">
                                                <?php else : ?>
                                                    <!-- <span class="bg-dark overflow-hidden font-weight-bold d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle direct-chat-img" style=" height: 40px; width:40px;">
                                                    </span> -->
                                                    <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="img-circle direct-chat-img" alt="Message User Image">
                                                <?php endif; ?>
                                                <?= $value['user_username']; ?>
                                                <?= $value['user_office']; ?>

                                            </a> released the document </h3>
                                        <div class="timeline-body">
                                            <span>Remarks: </span> <?= $value['releaselog_remark']; ?>
                                            <?php if ($value['releaselog_remark'] !== '') : ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="timeline-footer">
                                        </div>


                                    </div>
                                </div>
                                <!-- END timeline item -->

                            <?php elseif (isset($value['receivelog_id'])) : ?>

                                <!-- handling tiemline lable date -->
                                <?php $event_date = timeStampDateFormat($value['receivelog_timestamp']); ?>
                                <?php if ($event_date != $last_date) : ?>
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-purple"><?= substr(timeStampDateFormat($value['receivelog_timestamp']), 0, 16); ?></span>
                                    </div>
                                    <!-- /.timeline-label -->
                                <?php endif; ?>

                                <?php if ($event_date != $last_date) : ?>
                                    <?php $last_date = $event_date; ?>
                                <?php endif; ?>


                                <!-- timeline item -->
                                <div>
                                    <i class="fas  fa-clipboard-check bg-blue"></i>
                                    <div class="timeline-item">
                                        <div class="p-2">
                                            <span class="time small float-right"><i class="fas fa-clock"></i> <?= timeStampDateFormat($value['receivelog_timestamp']); ?></span>
                                        </div>
                                        <h3 class="timeline-header p-3"><a href="#">
                                                <?php if ($value['user_pic_filename'] !== "") : ?>
                                                    <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="img-circle direct-chat-img" alt="Message User Image">
                                                <?php else : ?>
                                                    <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="img-circle direct-chat-img" alt="Message User Image">
                                                <?php endif; ?>
                                                <?= $value['user_username']; ?>

                                                <?= $value['user_office']; ?>
                                            </a> received the document </h3>
                                        <?php if ($value['receivelog_remark'] !== '') : ?>
                                            <div class="timeline-body">
                                                <span>Remarks: </span> <?= $value['receivelog_remark']; ?>
                                            </div>
                                            <div class="timeline-footer">
                                            </div>
                                        <?php endif; ?>


                                    </div>
                                </div>
                                <!-- END timeline item -->
                            <?php endif; ?>



                        <?php endforeach; ?>



                        <!-- handling tiemline lable date -->
                        <?php $event_date = timeStampDateFormat($document['document_timestamp']); ?>
                        <?php if ($event_date != $last_date) : ?>
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-purple"><?= substr(timeStampDateFormat($document['document_timestamp']), 0, 16); ?></span>
                            </div>
                            <!-- /.timeline-label -->
                        <?php endif; ?>

                        <?php if ($event_date != $last_date) : ?>
                            <?php $last_date = $event_date; ?>
                        <?php endif; ?>

                        <!-- timeline item -->
                        <div>

                            <i class="fas fa-tag bg-green"></i>
                            <div class="timeline-item">
                                <div class="p-2">
                                    <span class="time small float-right"><i class="fas fa-clock"></i> <?= timeStampDateFormat($document['document_timestamp']); ?> </span>
                                </div>
                                <h3 class="timeline-header p-3"><a href="#">
                                        <?php if ($value['user_pic_filename'] !== "") : ?>
                                            <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="img-circle direct-chat-img" alt="Message User Image">
                                        <?php else : ?>
                                            <span class="bg-dark overflow-hidden font-weight-bold d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle direct-chat-img" style=" height: 40px; width:40px;">
                                                <?= substr($value['user_firstname'], 0, 1); ?><?= substr($value['user_lastname'], 0, 1); ?>
                                            </span>
                                            <!-- <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="img-circle direct-chat-img" alt="Message User Image"> -->
                                        <?php endif; ?>
                                        <?= $user['user_username']; ?> <span class="text-muted">(Owner)</span>
                                        <?= $value['user_office']; ?>

                                    </a> registered the document named <?= $document['document_name']; ?> </h3>

                                <div class="timeline-body">
                                    <span>Remarks: </span> <?= $document['document_remark']; ?>
                                </div>
                                <div class="timeline-footer">
                                </div>



                            </div>
                        </div>
                        <!-- END timeline item -->


                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>

                <div id="timeline-tabular" class="tab-pane">
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Event</th>
                            <th>Account</th>
                            <th>Remarks</th>
                        </thead>
                        <tbody>


                            <?php foreach ($data_table as $key => $value) : ?>
                                <tr>
                                    <?php if (isset($value['releaselog_id'])) : ?>
                                        <!-- handling tiemline lable date -->
                                        <?php if ($event_date !== $last_date) : ?>
                                            <?php $event_date = timeStampDateFormat($value['releaselog_timestamp']); ?>
                                            <?php $last_date = $event_date; ?>
                                        <?php endif; ?>
                                        <td>
                                            <?= timeStampDateFormat($value['releaselog_timestamp']); ?>
                                        </td>
                                        <td>
                                            </a> Released the document </h3>
                                        </td>
                                        <td>
                                            <?php if ($value['user_pic_filename'] !== "") : ?>
                                                <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="img-circle direct-chat-img" alt="Message User Image">
                                            <?php else : ?>
                                                <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="img-circle direct-chat-img" alt="Message User Image">
                                            <?php endif; ?>
                                            <?= $value['user_username']; ?>
                                            <?= $value['user_office']; ?>

                                        </td>
                                        <td>
                                            <?php if ($value['releaselog_remark'] !== '') : ?>
                                                <?= $value['releaselog_remark']; ?>
                                            <?php endif; ?>
                                        </td>


                                        <!-- END timeline item -->

                                    <?php elseif (isset($value['receivelog_id'])) : ?>

                                        <!-- handling tiemline lable date -->
                                        <?php $event_date = timeStampDateFormat($value['receivelog_timestamp']); ?>
                                        <?php if ($event_date != $last_date) : ?>
                                            <?= timeStampDateFormat($value['receivelog_timestamp']); ?>
                                        <?php endif; ?>

                                        <?php if ($event_date != $last_date) : ?>
                                            <?php $last_date = $event_date; ?>
                                        <?php endif; ?>
                                        <td>
                                            <?= timeStampDateFormat($value['receivelog_timestamp']); ?>
                                        </td>
                                        <td>
                                            Received the document
                                        </td>
                                        <td>

                                            <?php if ($value['user_pic_filename'] !== "") : ?>
                                                <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="img-circle direct-chat-img" alt="Message User Image">
                                            <?php else : ?>
                                                <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="img-circle direct-chat-img" alt="Message User Image">
                                            <?php endif; ?>
                                            <?= $value['user_username']; ?>
                                            <?= $value['user_office']; ?>

                                        </td>
                                        <td>
                                            <?php if ($value['receivelog_remark'] !== '') : ?>
                                                <?= $value['receivelog_remark']; ?>
                                            <?php endif; ?>
                                        </td>


                                    <?php endif; ?>


                                </tr>
                            <?php endforeach; ?>


                            <!-- handling tiemline lable date -->
                            <?php $event_date = timeStampDateFormat($document['document_timestamp']); ?>
                            <?php if ($event_date != $last_date) : ?>
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-purple"><?= substr(timeStampDateFormat($document['document_timestamp']), 0, 10); ?></span>
                                </div>
                                <!-- /.timeline-label -->
                            <?php endif; ?>

                            <?php if ($event_date != $last_date) : ?>
                                <?php $last_date = $event_date; ?>
                            <?php endif; ?>

                            <tr>
                                <td>
                                    <?= timeStampDateFormat($document['document_timestamp']); ?>
                                </td>
                                <td>
                                    </a> registered the document named <?= $document['document_name']; ?>
                                </td>
                                <td>
                                    <?php if ($value['user_pic_filename'] !== "") : ?>
                                        <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('uploads/'); ?><?= $value['user_pic_filename']; ?>" class="img-circle direct-chat-img" alt="Message User Image">
                                    <?php else : ?>
                                        <span class="bg-dark overflow-hidden font-weight-bold d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle direct-chat-img" style=" height: 40px; width:40px;">
                                            <?= substr($value['user_firstname'], 0, 1); ?><?= substr($value['user_lastname'], 0, 1); ?>
                                        </span>
                                        <!-- <img style="object-fit: cover; height: 30px; width:30px;overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="img-circle direct-chat-img" alt="Message User Image"> -->
                                    <?php endif; ?>
                                    <?= $user['user_username']; ?> <span class="text-muted">(Owner)</span>
                                    <?= $value['user_office']; ?>


                                </td>
                                <td>
                                    <?= $document['document_remark']; ?>
                                </td>







                            </tr>





                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

</div>