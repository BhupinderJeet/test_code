<div class="card-title">
    <h3 class="heading heading-6 strong-500">
    <b><?php echo translate('sent_interests')?></b></h3>
</div>

<div class="card-body"><sup class="badge bg-base-1 noti_badge noti_counter" style="display: none;"> <!-- Counts Notification with JavaScript  --> </sup>
<div class="dropdown-menu dropdown-menu-right dropdown-scale" style="max-height: 300px;overflow: auto;">
    <h6 class="dropdown-header"><?php echo translate('notifications')?></h6>
    <?php 
        foreach ($notification as $row) {
            if($this->db->get_where("member", array("member_id" => $row['by']))->row()->is_closed == 'no'){
                if ($this->db->get_where('member', array('member_id' => $row['by']))->row()->member_id){
                    if ($row['is_seen'] == 'no') {
                        $noti_counter++;
                    }
                    if($row['type'] == 'interest_expressed') {
                        $noti_profile_image = $this->Crud_model->get_type_name_by_id('member', $row['by'], 'profile_image');
                        $noti_images = json_decode($noti_profile_image, true);
                        ?>
                        <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%">
                            
                        </div>
                        <span class="dropdown-item" id="noti_item">
                            <small class="pull-right" style="margin-top: -2px;"><i class="c-base-1 fa fa-clock-o"></i> <?=date('d M,y - h:i A', $row['time'])?></small>
                            <small class="sml_txt">
                                <?php
                                    if (file_exists('uploads/profile_image/'.$noti_images[0]['thumb'])) {
                                    ?>
                                        <img src="<?=base_url()?>uploads/profile_image/<?=$noti_images[0]['thumb']?>" class="dropdown-image rounded-circle">
                                    <?php
                                    }
                                    else {
                                    ?>
                                        <img src="<?=base_url()?>uploads/profile_image/default_image.png" class="dropdown-image rounded-circle">
                                    <?php
                                    }
                                ?>
                                <a class="c-base-1" href="<?=base_url()?>home/member_profile/<?= $row['by']; ?>">
                                    <?= $this->Crud_model->get_type_name_by_id('member', $row['by'], 'first_name'); ?>
                                </a> 
                                <?php echo translate('has_expressed_an_interest_on_you')?>
                            </small>
                            <?php 
                                if($row['status'] == 'pending') {
                                ?>
                                    <div class="text-center pt-1 text_<?=$row['by']?>">
                                        <button type="button" class="btn btn-sm btn-primary pt-0 pb-0" id="accept_<?=$row['by']?>" onclick="confirm_accept(<?=$row['by']?>)"><?php echo translate('accept')?></button>
                                        <button type="button" class="btn btn-sm btn-danger pt-0 pb-0" id="reject_<?=$row['by']?>" onclick="confirm_reject(<?=$row['by']?>)"><?php echo translate('reject')?></button>
                                    </div>
                                <?php
                                } else if($row['status'] == 'accepted') {
                                ?>
                                    <div class="text-center text-success text_<?=$row['by']?>">
                                        <small class="sml_txt">
                                            <i class="fa fa-check-circle"></i><?php echo translate('you_have_accepted_the_interest')?>
                                        </small>
                                    </div>
                                <?php
                                } else if($row['status'] == 'rejected') {
                                ?>
                                    <div class="text-center text-danger text_<?=$row['by']?>">
                                        <small class="sml_txt">
                                            <i class="fa fa-times-circle"></i><?php echo translate('you_have_rejected_the_interest')?>
                                        </small>
                                    </div>
                                <?php
                                }
                            ?>
                        </span>
                        <div style="border-top: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>
                        <?php
                    }
                    elseif ($row['type'] == 'accepted_interest') {
                        //$noti_counter++;
                        $noti_profile_image = $this->Crud_model->get_type_name_by_id('member', $row['by'], 'profile_image');
                        $noti_images = json_decode($noti_profile_image, true);
                        ?>
                        <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>
                        <span class="dropdown-item" id="noti_item">
                            <small class="pull-right" style="margin-top: -2px;"><i class="c-base-1 fa fa-clock-o"></i> <?=date('d M,y - h:i A', $row['time'])?></small>
                            <small class="sml_txt">
                                <?php
                                    if (file_exists('uploads/profile_image/'.$noti_images[0]['thumb'])) {
                                    ?>
                                        <img src="<?=base_url()?>uploads/profile_image/<?=$noti_images[0]['thumb']?>" class="dropdown-image rounded-circle">
                                    <?php
                                    }
                                    else {
                                    ?>
                                        <img src="<?=base_url()?>uploads/profile_image/default_image.png" class="dropdown-image rounded-circle">
                                    <?php
                                    }
                                ?>
                                <a class="c-base-1" href="<?=base_url()?>home/member_profile/<?= $row['by']; ?>">
                                    <?= $this->Crud_model->get_type_name_by_id('member', $row['by'], 'first_name'); ?>
                                </a> 
                                <span class="text-success"><i class="fa fa-check-circle"></i><?php echo translate('accepted_your_interest')?></span>
                            </small>
                        </span>
                        <?php
                    }
                    elseif ($row['type'] == 'rejected_interest') {
                        //$noti_counter++;
                        $noti_profile_image = $this->Crud_model->get_type_name_by_id('member', $row['by'], 'profile_image');
                        $noti_images = json_decode($noti_profile_image, true);
                        ?>
                        <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>
                        <span class="dropdown-item" id="noti_item">
                            <small class="pull-right" style="margin-top: -2px;"><i class="c-base-1 fa fa-clock-o"></i> <?=date('d M,y - h:i A', $row['time'])?></small>
                            <small class="sml_txt">
                                <?php
                                    if (file_exists('uploads/profile_image/'.$noti_images[0]['thumb'])) {
                                    ?>
                                        <img src="<?=base_url()?>uploads/profile_image/<?=$noti_images[0]['thumb']?>" class="dropdown-image rounded-circle">
                                    <?php
                                    }
                                    else {
                                    ?>
                                        <img src="<?=base_url()?>uploads/profile_image/default_image.png" class="dropdown-image rounded-circle">
                                    <?php
                                    }
                                ?>
                                <a class="c-base-1" href="<?=base_url()?>home/member_profile/<?= $row['by']; ?>">
                                    <?= $this->Crud_model->get_type_name_by_id('member', $row['by'], 'first_name'); ?>
                                </a> 
                                <span class="text-danger"><i class="fa fa-times-circle"></i><?php echo translate('rejected_your_interest')?></span>
                            </small>
                        </span>
                        <?php
                    }
                }
            }
        }
        if (count($notification) <= 0) {
        ?>
            <div class="text-center">
                <small class="sml_txt">
                    <?php echo translate('no_notification_to_show'); ?>
                </small>
            </div>
        <?php
        }
    ?>

</div>
    <h6 class="dropdown-header"><?php echo translate('notifications')?></h6>
        <?php 
            foreach ($notification as $row) {
                if($this->db->get_where("member", array("member_id" => $row['by']))->row()->is_closed == 'no'){
                    if ($this->db->get_where('member', array('member_id' => $row['by']))->row()->member_id){
                        if ($row['is_seen'] == 'no') {
                            $noti_counter++;
                        }
                        if($row['type'] == 'interest_expressed') {
                            $noti_profile_image = $this->Crud_model->get_type_name_by_id('member', $row['by'], 'profile_image');
                            $noti_images = json_decode($noti_profile_image, true);
                            ?>
                            <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%">
                                
                            </div>
                            <span class="dropdown-item" id="noti_item">
                                <small class="pull-right" style="margin-top: -2px;"><i class="c-base-1 fa fa-clock-o"></i> <?=date('d M,y - h:i A', $row['time'])?></small>
                                <small class="sml_txt">
                                    <?php
                                        if (file_exists('uploads/profile_image/'.$noti_images[0]['thumb'])) {
                                        ?>
                                            <img src="<?=base_url()?>uploads/profile_image/<?=$noti_images[0]['thumb']?>" class="dropdown-image rounded-circle">
                                        <?php
                                        }
                                        else {
                                        ?>
                                            <img src="<?=base_url()?>uploads/profile_image/default_image.png" class="dropdown-image rounded-circle">
                                        <?php
                                        }
                                    ?>
                                    <a class="c-base-1" href="<?=base_url()?>home/member_profile/<?= $row['by']; ?>">
                                        <?= $this->Crud_model->get_type_name_by_id('member', $row['by'], 'first_name'); ?>
                                    </a> 
                                    <?php echo translate('has_expressed_an_interest_on_you')?>
                                </small>
                                <?php 
                                    if($row['status'] == 'pending') {
                                    ?>
                                        <div class="text-center pt-1 text_<?=$row['by']?>">
                                            <button type="button" class="btn btn-sm btn-primary pt-0 pb-0" id="accept_<?=$row['by']?>" onclick="confirm_accept(<?=$row['by']?>)"><?php echo translate('accept')?></button>
                                            <button type="button" class="btn btn-sm btn-danger pt-0 pb-0" id="reject_<?=$row['by']?>" onclick="confirm_reject(<?=$row['by']?>)"><?php echo translate('reject')?></button>
                                        </div>
                                    <?php
                                    } else if($row['status'] == 'accepted') {
                                    ?>
                                        <div class="text-center text-success text_<?=$row['by']?>">
                                            <small class="sml_txt">
                                                <i class="fa fa-check-circle"></i><?php echo translate('you_have_accepted_the_interest')?>
                                            </small>
                                        </div>
                                    <?php
                                    } else if($row['status'] == 'rejected') {
                                    ?>
                                        <div class="text-center text-danger text_<?=$row['by']?>">
                                            <small class="sml_txt">
                                                <i class="fa fa-times-circle"></i><?php echo translate('you_have_rejected_the_interest')?>
                                            </small>
                                        </div>
                                    <?php
                                    }
                                ?>
                            </span>
                            <div style="border-top: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>
                            <?php
                        }
                        elseif ($row['type'] == 'accepted_interest') {
                            //$noti_counter++;
                            $noti_profile_image = $this->Crud_model->get_type_name_by_id('member', $row['by'], 'profile_image');
                            $noti_images = json_decode($noti_profile_image, true);
                            ?>
                            <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>
                            <span class="dropdown-item" id="noti_item">
                                <small class="pull-right" style="margin-top: -2px;"><i class="c-base-1 fa fa-clock-o"></i> <?=date('d M,y - h:i A', $row['time'])?></small>
                                <small class="sml_txt">
                                    <?php
                                        if (file_exists('uploads/profile_image/'.$noti_images[0]['thumb'])) {
                                        ?>
                                            <img src="<?=base_url()?>uploads/profile_image/<?=$noti_images[0]['thumb']?>" class="dropdown-image rounded-circle">
                                        <?php
                                        }
                                        else {
                                        ?>
                                            <img src="<?=base_url()?>uploads/profile_image/default_image.png" class="dropdown-image rounded-circle">
                                        <?php
                                        }
                                    ?>
                                    <a class="c-base-1" href="<?=base_url()?>home/member_profile/<?= $row['by']; ?>">
                                        <?= $this->Crud_model->get_type_name_by_id('member', $row['by'], 'first_name'); ?>
                                    </a> 
                                    <span class="text-success"><i class="fa fa-check-circle"></i><?php echo translate('accepted_your_interest')?></span>
                                </small>
                            </span>
                            <?php
                        }
                        elseif ($row['type'] == 'rejected_interest') {
                            //$noti_counter++;
                            $noti_profile_image = $this->Crud_model->get_type_name_by_id('member', $row['by'], 'profile_image');
                            $noti_images = json_decode($noti_profile_image, true);
                            ?>
                            <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>
                            <span class="dropdown-item" id="noti_item">
                                <small class="pull-right" style="margin-top: -2px;"><i class="c-base-1 fa fa-clock-o"></i> <?=date('d M,y - h:i A', $row['time'])?></small>
                                <small class="sml_txt">
                                    <?php
                                        if (file_exists('uploads/profile_image/'.$noti_images[0]['thumb'])) {
                                        ?>
                                            <img src="<?=base_url()?>uploads/profile_image/<?=$noti_images[0]['thumb']?>" class="dropdown-image rounded-circle">
                                        <?php
                                        }
                                        else {
                                        ?>
                                            <img src="<?=base_url()?>uploads/profile_image/default_image.png" class="dropdown-image rounded-circle">
                                        <?php
                                        }
                                    ?>
                                    <a class="c-base-1" href="<?=base_url()?>home/member_profile/<?= $row['by']; ?>">
                                        <?= $this->Crud_model->get_type_name_by_id('member', $row['by'], 'first_name'); ?>
                                    </a> 
                                    <span class="text-danger"><i class="fa fa-times-circle"></i><?php echo translate('rejected_your_interest')?></span>
                                </small>
                            </span>
                            <?php
                        }
                    }
                }
            }
            if (count($notification) <= 0) {
            ?>
                <div class="text-center">
                    <small class="sml_txt">
                        <?php echo translate('no_notification_to_show'); ?>
                    </small>
                </div>
            <?php
            }
        ?>

    </div>

           
</section>
<script>
    $(document).ready(function(){
        if (isloggedin != "") {
            var noti_count = "<?php if (!empty($noti_counter)){echo $noti_counter;}?>";
            if (noti_count > 0) {
                $('.noti_counter').show();
                $('.noti_counter').html(noti_count);
            }
            var msg_count = "<?php if (!empty($msg_counter)){echo $msg_counter;}?>";
            if (msg_count > 0) {
                $('.msg_counter').show();
                $('.msg_counter').html(msg_count);
            }

            var member_id = "<?=$this->session->userdata('member_id')?>";
            if (member_id != "") {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/refresh_notification/"+member_id,
                    cache: false,
                    success: function(response) {
                        $('.noti_counter').hide();
                        console.log(response);
                    }
                });
            }
        }

    });
</script>