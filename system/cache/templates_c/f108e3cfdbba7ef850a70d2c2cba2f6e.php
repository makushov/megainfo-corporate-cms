<div class="frame-inside page-text">
    <div class="container">
        <div class="text">
            <div class="container">
                <div class="content center">
                    <div id="titleExt"><h1><?php echo widget ('path'); ?><span class="ext"><?php echo lang ('Contacts', 'feedback'); ?></span></h1></div>
                    <div id="contact">
                        <div class="left">
                            <?php if($form_errors): ?>
                                <div class="errors">
                                    <?php if(isset($form_errors)){ echo $form_errors; } ?>
                                </div>
                            <?php endif; ?>

                            <?php if($message_sent): ?>
                                <div style="color: green;">
                                    <?php echo lang ('Your message has been sent.', 'feedback'); ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?php echo site_url ('feedback'); ?>" method="post">
                                <div class="textbox" style="margin-top: 15px;">
                                    <label for="name"><b><?php echo lang ('Your name', 'feedback'); ?></b></label>
                                            <?php if($validation): ?>
                                        <div class="error" style="color: red">
                                            <?php echo $validation->error('name')?>
                                        </div>
                                    <?php endif; ?>
                                    <input type="text" id="name" name="name" class="text" value="<?php if($_POST['name']): ?><?php echo $_POST['name']; ?><?php endif; ?>"
                                           placeholder="<?php echo lang ('Your name', 'feedback'); ?>"/>
                                    <span class="must">*</span>
                                </div>

                                <div class="textbox" style="margin-top: 15px;">
                                    <label for="email"><b><?php echo lang ('Email'); ?></b></label>
                                            <?php if($validation): ?>
                                        <div class="error" style="color: red">
                                            <?php echo $validation->error('email')?>
                                        </div>
                                    <?php endif; ?>
                                    <input type="text" id="email" name="email" class="text" value="<?php if($_POST['email']): ?><?php echo $_POST['email']; ?><?php endif; ?>" placeholder="<?php echo lang ('Email'); ?>"/>
                                    <span class="must">*</span>
                                </div>

                                <div class="textbox" style="margin-top: 15px;">
                                    <label for="theme"><b><?php echo lang ('Subject', 'feedback'); ?></b></label>
                                            <?php if($validation): ?>
                                        <div class="error" style="color: red">
                                            <?php echo $validation->error('theme')?>
                                        </div>
                                    <?php endif; ?>
                                    <input type="text" id="theme" name="theme" class="text" value="<?php if($_POST['theme']): ?><?php echo $_POST['theme']; ?><?php endif; ?>" placeholder="<?php echo lang ('Subject', 'feedback'); ?>"/>
                                    <span class="must">*</span>
                                </div>

                                <div class="clearfix"></div>
                                <div class="textbox" style="margin-top: 15px;">
                                    <label for="message"><b><?php echo lang ('Message', 'feedback'); ?></b></label>
                                            <?php if($validation): ?>
                                        <div class="error" style="color: red">
                                            <?php echo $validation->error('message')?>
                                        </div>
                                    <?php endif; ?>
                                    <textarea cols="45" rows="10" name="message" id="message" placeholder="<?php echo lang ('Message text', 'feedback'); ?>"><?php if($_POST['message']): ?><?php echo $_POST['message']; ?><?php endif; ?></textarea>
                                    <span class="must_textarea">*</span>
                                </div>

                                <div class="comment_form_info">
                                    <?php if($captcha_type =='captcha'): ?>
                                        <div class="textbox captcha" style="margin-top: 15px;">
                                            <label for="captcha"><b><?php echo lang ('Protection code', 'feedback'); ?></b></label>
                                            <div><?php if(isset($cap_image)){ echo $cap_image; } ?></div>
                                            <?php if($validation): ?>
                                                <div class="error" style="color: red">
                                                    <?php echo $validation->error('captcha')?>
                                                </div>
                                            <?php endif; ?>
                                            <input type="text" name="captcha" style="width: 150px" id="recaptcha_response_field" value="" placeholder="<?php echo lang ('Enter protection code', 'feedback'); ?>"/>
                                            <span class="must_no_float">*</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div style="margin-top: 15px; margin-left: -5px; float: left;">
                                    <div class="btn s-p btn-form m-b_15">
                                        <input type="submit" id="submit" class="submit" value="<?php echo lang ('Send', 'feedback'); ?>" />
                                    </div>
                                </div>
                        </div>
                        <?php echo form_csrf (); ?>
                        </form>
                    </div>
                    <div class="right">
                        <div id="detail">
                            <?php //widget('contacts')?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php $mabilis_ttl=1426340979; $mabilis_last_modified=1426235921; //application/modules/feedback/assets/feedback.tpl ?>