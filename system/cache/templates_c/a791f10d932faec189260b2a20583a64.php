<?php if($can_comment == 1 AND !$is_logged_in): ?>
    <label>
        <span class="title__icsi-css"><?php echo lang ('Only authorized users can leave comments.', 'comments'); ?></span>
        <a href="<?php echo site_url ('auth'); ?>" class="loginAjax"><?php echo lang ("log in", "comments"); ?></a>
    </label>
<?php endif; ?>
<div id="comment__icsi-css" class="comment__icsi-css">
    <?php if($comments_arr): ?>
        <div class="title_h2__icsi-css"><?php echo lang ('Customer comments', 'comments'); ?></div>
        <ul class="frame-list-comment__icsi-css">
            <?php if(is_true_array($comments_arr)){ foreach ($comments_arr as $key => $comment){ ?>
                <input type="hidden" id="comment_item_id" name="comment_item_id" value="<?php echo $comment['id']; ?>"/>
                <li id="comment_<?php echo $comment['id']; ?>">
                    <div class="author-data-comment__icsi-css">
                        <span class="author-comment__icsi-css"><?php echo $comment['user_name']; ?></span>&nbsp;&nbsp;
                        <?php if($comment['rate']  != 0): ?>
                            <div class="star-small d_i-b">
                                <div class="productRate star-small">
                                    <div style="width: <?php echo (int) $comment['rate']  *20 ?>%"></div>
                                </div>
                            </div>&nbsp;&nbsp;
                        <?php endif; ?>
                        <span class="date-comment__icsi-css"> <?php echo date ('d-m-Y H:i',  $comment['date'] ); ?></span>
                    </div>
                    <div class="frame-comment__icsi-css">
                        <p><?php echo $comment['text']; ?></p>
                        <?php if($comment['text_plus']  != Null): ?>
                            <p>
                                <b><?php echo lang ('Pluses', 'comments'); ?></b><br>
                                <?php echo $comment['text_plus']; ?>
                            </p>
                        <?php endif; ?>
                        <?php if($comment['text_minus']  != Null): ?>
                            <p>
                                <b><?php echo lang ('Minuses', 'comments'); ?></b><br>
                                <?php echo $comment['text_minus']; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="func-button-comment__icsi-css">
                        <?php if($can_comment == 0 OR $is_logged_in): ?>
                            <div class="btn__icsi-css f_l__icsi-css">
                                <button type="button"  data-rel="cloneAddPaste" data-parid="<?php echo $comment['id']; ?>">
                                    <span class="icon-comment__icsi-css" style="width: 90px;">
                                        <div style="margin-left: 20px; margin-top: 5px;">
                                            <?php echo lang ('Answer', 'comments'); ?>
                                        </div>
                                    </span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <div class="f_r__icsi-css" style="margin-right: 10px">
                            <span class="helper__icsi-css" style="height: 35px;"></span>
                            <span>
                                <span class="btn__icsi-css like__icsi-css">
                                    <button type="button" class="usefullyes" data-comid="<?php echo  $comment['id']  ?>">
                                        <?php echo lang ('Like review', 'comments'); ?>
                                    </button>
                                    <span id="yesholder<?php echo $comment['id']; ?>">(<?php echo  $comment['like']  ?>)</span>
                                </span>
                                <span class="divider_l_dl__icsi-css">|</span>
                                <span class="btn__icsi-css dis-like__icsi-css">
                                    <button type="button" class="usefullno" data-comid="<?php echo  $comment['id']  ?>">
                                        <?php echo lang ('Do not like it', 'comments'); ?>
                                    </button>
                                    <span id="noholder<?php echo $comment['id']; ?>">(<?php echo  $comment['disslike']  ?>)</span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <ul class="frame-list-comment__icsi-css">
                        <?php if(is_true_array($comment_ch)){ foreach ($comment_ch as $com_ch){ ?>
                            <?php if($com_ch['parent']  ==  $comment['id']): ?>
                                <li>
                                    <div class="author-data-comment__icsi-css">
                                        <span class="author-comment__icsi-css"><?php echo $com_ch['user_name']; ?></span>
                                        <span class="date-comment__icsi-css"><?php echo date ('d-m-Y H:i',  $com_ch['date'] ); ?></span>
                                    </div>
                                    <div class="frame-comment__icsi-css">
                                        <p>
                                            <?php echo $com_ch['text']; ?>
                                        </p>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php }} ?>
                    </ul>
                </li>
            <?php }} ?>
        </ul>
    <?php endif; ?>
    <?php if($can_comment == 0 OR $is_logged_in): ?>

        <div class="main-form-comments__icsi-css">
            <div class="frame-comments__icsi-css">
                <div class="inside-padd">
                    <div class="title_h2__icsi-css"><?php echo lang ('Write your comment', 'comments'); ?></div>
                    <!-- Start of new comment fild -->
                    <div class="form-comment__icsi-css form__icsi-css horizontal-form">
                        <div class="inside-padd">
                            <form method="post">
                                <label>
                                    <span class="frame_form_field__icsi-css">
                                        <div class="frameLabel__icsi-css error_text" name="error_text"></div>
                                    </span>
                                </label>
                                <!-- Start star reiting -->
                                <div class="frameLabel__icsi-css">
                                    <span class="title__icsi-css"><?php echo lang ('Your rating', 'comments'); ?></span>
                                    <div class="frame_form_field__icsi-css">
                                        <div class="star">
                                            <div class="productRate star-big clicktemprate">
                                                <div class="for_comment"style="width: 0%"></div>
                                                <input id="ratec" name="ratec" type="hidden" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End star reiting -->
                                <?php if(!$is_logged_in): ?>
                                    <?php if($use_moderation): ?>
                                        <label>
                                            <span class="frame_form_field__icsi-css">
                                                <div class="msg">
                                                    <div class="success">
                                                        <?php echo lang ('The comment will be sent for moderation', 'comments'); ?>
                                                    </div>
                                                </div>
                                            </span>
                                        </label>
                                    <?php endif; ?>
                                    <label>
                                        <span class="title__icsi-css"><?php echo lang ('Your name', 'comments'); ?></span>
                                        <span class="frame_form_field__icsi-css">
                                            <input type="text" name="comment_author" id="comment_author" value="<?php echo get_cookie ('comment_author'); ?>"/>
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title__icsi-css"><?php echo lang ('Email', 'comments'); ?></span>
                                        <span class="frame_form_field__icsi-css">
                                            <input type="text" name="comment_email" id="comment_email" value="<?php echo get_cookie ('comment_email'); ?>"/>
                                        </span>
                                    </label>
                                    <!--
                                <label>
                                    <span class="title__icsi-css"><?php echo lang ('Site', 'comments'); ?></span>
                                    <span class="frame_form_field__icsi-css">
                                        <input type="text" name="comment_site" id="comment_site" value="<?php echo get_cookie ('comment_site'); ?>"/>
                                    </span>
                                </label>
                                    -->
                                <?php endif; ?>

                                <label>
                                    <span class="title__icsi-css"><?php echo lang ('Comment', 'comments'); ?></span>
                                    <span class="frame_form_field__icsi-css">
                                        <textarea name="comment_text" class="comment_text"><?php echo $_POST['comment_text']; ?></textarea>
                                    </span>
                                </label>
                                <!-- If you want get plus and minus for products - uncoment it
                            <label>
                                <span class="title__icsi-css"><?php echo lang ('Pluses', 'comments'); ?></span>
                                <span class="frame_form_field__icsi-css">
                                    <textarea name="comment_text_plus" id="comment_text_plus"><?php echo $_POST['comment_text']; ?></textarea>
                                </span>
                            </label>
                            <label>
                                <span class="title__icsi-css"><?php echo lang ('Minuses', 'comments'); ?></span>
                                <span class="frame_form_field__icsi-css">
                                    <textarea name="comment_text_minus" id="comment_text_minus" ><?php echo $_POST['comment_text']; ?></textarea>
                                </span>
                            </label>
                                -->
                                <?php if($use_captcha): ?>
                                    <label>
                                        <span class="title__icsi-css"><?php echo lang ('Code protection', 'comments'); ?></span>
                                        <?php if(isset($cap_image)){ echo $cap_image; } ?>
                                        <span class="frame_form_field__icsi-css">
                                            <input type="text" name="captcha" id="captcha"/>
                                        </span>
                                    </label>
                                <?php endif; ?>

                                <div class="frameLabel__icsi-css">
                                    <span class="title__icsi-css">&nbsp;</span>
                                    <span class="frame_form_field__icsi-css">
                                        <input type="submit" value="<?php echo lang ('Leave comment', 'comments'); ?>" class="btn__icsi-css" onclick="post(this)"/>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End of new comment fild -->
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="frame-drop-comment__icsi-css" data-rel="whoCloneAddPaste">
        <div class="form-comment__icsi-css form__icsi-css">
            <form>
                <label>
                    <span class="frame_form_field__icsi-css">
                        <div class="frameLabel__icsi-css error_text" name="error_text"></div>
                    </span>
                </label>

                <?php if(!$is_logged_in): ?>
                    <label>
                        <span class="title__icsi-css"><?php echo lang ('Your name', 'comments'); ?></span>
                        <span class="frame_form_field__icsi-css">
                            <input type="text" name="comment_author" id="comment_author" value="<?php echo get_cookie ('comment_author'); ?>"/>
                        </span>
                    </label>
                    <label>
                        <span class="title__icsi-css"><?php echo lang ('Email', 'comments'); ?> </span>
                        <span class="frame_form_field__icsi-css">
                            <input type="text" name="comment_email" id="comment_email" value="<?php echo get_cookie ('comment_email'); ?>"/>
                        </span>
                    </label>
                    <?php if($use_moderation): ?>
                        <label>
                            <span class="frame_form_field__icsi-css">
                                <div class="msg">
                                    <div class="success">
                                        <?php echo lang ('The comment will be sent for moderation', 'comments'); ?>
                                    </div>
                                </div>
                            </span>
                        </label>
                    <?php endif; ?>
                <?php endif; ?>
                <label>
                    <span class="title__icsi-css"><?php echo lang ('Comment', 'comments'); ?></span>
                    <span class="frame_form_field__icsi-css">
                        <textarea class="comment_text" name="comment_text"></textarea>
                    </span>
                </label>
                <div class="frameLabel__icsi-css">
                    <span class="title__icsi-css">&nbsp;</span>
                    <span class="frame_form_field__icsi-css">
                        <input type="hidden" id="parent" name="comment_parent" value="">
                        <input type="submit" value="<?php echo lang ('Leave comment', 'comments'); ?>" class="btn__icsi-css" onclick="post(this)"/>
                    </span>
                </div>
            </form>
        </div>
    </div>

</div><?php $mabilis_ttl=1425720903; $mabilis_last_modified=1425473714; //templates/corporate/comments/comments_api.tpl ?>