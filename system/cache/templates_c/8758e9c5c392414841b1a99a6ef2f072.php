<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n"><?php echo lang ('Edit page', "admin"); ?></span>
        </div>
        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/pages/GetPagesByCategory" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"><?php echo lang ("Back","admin"); ?></span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-action="edit" data-form="#edit_page_form" data-submit><i class="icon-ok icon-white"></i><?php echo lang ("Save","admin"); ?></button>
                <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#edit_page_form"><i class="icon-check"></i><?php echo lang ("Save and go back","admin"); ?></button>
                <?php if(count($langs) > 1): ?>
                <div class="dropdown d-i_b">
                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                        <?php if(is_true_array($langs)){ foreach ($langs as $l){ ?>
                        <?php if($page_lang ==  $l['id']): ?>
                        <?php $page_lang_identif =  $l['identif']  ?>
                        <?php echo $l['lang_name']; ?>
                        <?php endif; ?>
                        <?php }} ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <?php if(is_true_array($langs)){ foreach ($langs as $l){ ?>
                        <?php if($l['id']  != $page_lang): ?>
                        <li>
                            <a href="/admin/pages/edit/<?php if(isset($page_id)){ echo $page_id; } ?>/<?php echo $l['id']; ?>" class="pjax"><?php echo $l['lang_name']; ?></a>
                        </li>
                        <?php endif; ?>
                        <?php }} ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="m-t_20 pull-right">
            <?php if($CI->uri->total_segments()==5): ?>
            <a href="/<?php echo $page_lang_identif?>/<?php if(isset($cat_url)){ echo $cat_url; } ?><?php if(isset($url)){ echo $url; } ?>" class="t-d_n m-r_15" target="blank"><?php echo lang ('Show page','admin'); ?> <span class="f-s_14">&rarr;</span></a>
            <?php else:?>
            <a href="/<?php if(isset($cat_url)){ echo $cat_url; } ?><?php if(isset($url)){ echo $url; } ?>" class="t-d_n m-r_15" target="blank"><?php echo lang ('Show page','admin'); ?> <span class="f-s_14">&rarr;</span></a>
            <?php endif; ?>
        </div>
        <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
            <a href="#content_article" class="btn btn-small active"><?php echo lang ("Page","admin"); ?></a>
            <a href="#parameters_article" class="btn btn-small "><?php echo lang ("Properties","admin"); ?></a>
            <a href="#addfields_article" class="btn btn-small"><?php echo lang ("Additional fields","admin"); ?></a>
            <a href="#setings_article" class="btn btn-small"><?php echo lang ("Settings","admin"); ?></a>
            <?php if($moduleAdditions): ?>
            <a href="#modules_additions" class="btn btn-small"><?php echo lang ('Modules additions', 'admin'); ?></a>
            <?php endif; ?>
        </div>
    </div>
    <form method="post" action="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/update/<?php if(isset($update_page_id)){ echo $update_page_id; } ?>/<?php if(isset($page_lang)){ echo $page_lang; } ?>" id="edit_page_form" class="form-horizontal" data-pageid="<?php if(isset($update_page_id)){ echo $update_page_id; } ?>">
        <div class="tab-content">
            <div class="tab-pane active" id="content_article">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <?php echo lang ("Page","admin"); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group">
                                        <label class="control-label" for="category_selectbox">
                                            <?php echo lang ("Category","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <a onclick="$('.modal:not(.addNotificationMessage)').modal();
                                            return false;" class="btn m-l_10" style="float:right;" href="#"><i class="icon-plus-sign"></i> <?php echo lang ("Create a category","admin"); ?></a>
                                            <div> <!--class="o_h"-->
                                                <select style="width:700px" name="category"  id="category_selectbox"  onchange="pagesAdmin.loadCFEditPage()">
                                                    <option value="0" ><?php echo lang ('No','admin'); ?></option>
                                                    <?php $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['parent_id']));?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label" for="page_title_u">
                                            <?php echo lang ("Title","admin"); ?>: <span class="must">*</span>
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="page_title" value="<?php echo encode ($title); ?>" id="page_title_u" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">
                                            <?php echo lang ("Preliminary contents","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <textarea id="prev_text" class="elRTE" name="prev_text" rows="10" cols="180" ><?php echo encode ($prev_text); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">
                                            <?php echo lang ("Full contents","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <textarea id="full_text" class="elRTE" name="full_text" rows="10" cols="180" ><?php echo encode ($full_text); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="parameters_article">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <?php echo lang ("Properties","admin"); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">

                                <div class="inside_padd">
                                    <div class="control-group">
                                        <label class="control-label" for="page_url">
                                            <?php echo lang ("URL","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <?php if($defLang['id']  == $page_lang): ?>
                                            <button onclick="translite_title('#page_title_u', '#page_url');" type="button" class="btn btn-small pull-right" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp;<?php echo lang ('Autocomplete','admin'); ?></button>
                                            <div class="o_h">
                                                <input type="text" name="page_url" value="<?php if(isset($url)){ echo $url; } ?>" id="page_url" />
                                            </div>
                                            <?php else:?>
                                            <input type="text" name="page_url" value="<?php if(isset($url)){ echo $url; } ?>" id="page_url" />
                                            <?php endif; ?>
                                            <div class="help-block">(<?php echo lang ("Only Latin characters","admin"); ?>)</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="tags">
                                            <?php echo lang ("Tags","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="search_tags" value="<?php if(is_true_array($tags)){ foreach ($tags as $tag){ ?><?php echo $tag['value']; ?>,<?php }} ?>" id="tags" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="meta_title">
                                            <?php echo lang ("Meta Title","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <input type="text" name="meta_title" id="meta_title" value="<?php if(isset($meta_title)){ echo $meta_title; } ?>"  />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_description">
                                            <?php echo lang ("Meta Description","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_description" class="textarea" id="page_description" ><?php if(isset($description)){ echo $description; } ?></textarea>
                                            <button  onclick="create_description('#prev_text', '#page_description');" type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;<?php echo lang ('Autocomplete','admin'); ?></button>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="page_keywords">
                                            <?php echo lang ("Meta Keywords","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <textarea name="page_keywords" id="page_keywords"><?php if(isset($keywords)){ echo $keywords; } ?></textarea>
                                            <button  onclick="retrive_keywords('#prev_text', '#keywords_list');"  type="button" class="btn btn-small" ><i class="icon-refresh"></i>&nbsp;&nbsp;<?php echo lang ('Autocomplete words','admin'); ?></button>
                                            <div id="keywords_list">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="main_tpl">
                                            <?php echo lang ("Main template","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="main_tpl" id="main_tpl" value="<?php if(isset($main_tpl)){ echo $main_tpl; } ?>" />
                                            </div>
                                            <div class="help-block"><?php echo lang ("by default","admin"); ?>  main.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="full_tpl">
                                            <?php echo lang ("Page Template","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <div class="pull-right help-block">&nbsp;&nbsp;.tpl</div>
                                            <div class="o_h">
                                                <input type="text" name="full_tpl" id="full_tpl" value="<?php if(isset($full_tpl)){ echo $full_tpl; } ?>" />
                                            </div>
                                            <div class="help-block"><?php echo lang ("by default","admin"); ?>  page_full.tpl</div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="control-label"></div>
                                        <div class="controls">
                                            <span class="frame_label no_connection">
                                                <span class="niceCheck b_n">
                                                    <input name="comments_status"  value="1" <?php if($comments_status == 1): ?> checked="checked" <?php endif; ?>  type="checkbox" id="comments_status" />
                                                </span>
                                            </span>
                                            <?php echo lang ("Comment permission","admin"); ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="addfields_article">
                <div id="cfcm_fields_block"></div>
            </div>
            <div class="tab-pane" id="setings_article">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <?php echo lang ("Settings","admin"); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group">
                                        <label class="control-label" for="post_status">
                                            <?php echo lang ("Publication status","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <select name="post_status" id="post_status">
                                                <option value="publish" <?php if($post_status == "publish"): ?> selected="selected" <?php endif; ?> ><?php echo lang ("Published","admin"); ?></option>
                                                <option value="pending" <?php if($post_status == "pending"): ?> selected="selected" <?php endif; ?> ><?php echo lang ("Waiting approval ","admin"); ?></option>
                                                <option value="draft" <?php if($post_status == "draft"): ?> selected="selected" <?php endif; ?> ><?php echo lang ("Unpublished","admin"); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="control-group">
                                        <label class="control-label" for="create_date">
                                            <?php echo lang ("Time and date of creation","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <div class="pull-left p_r">
                                                <label>
                                                    <input id="create_date" name="create_date" tabindex="7" value="<?php if(isset($create_date)){ echo $create_date; } ?>" type="text" data-placement="top" data-original-title="<?php echo lang ('choose date','admin'); ?>" data-rel="tooltip" class="datepicker input-small" style="width:120px;"/>
                                                    <i class="icon-calendar"></i>
                                                </label>
                                            </div>
                                            <input id="create_time" name="create_time" tabindex="8" type="text" value="<?php if(isset($create_time)){ echo $create_time; } ?>" class="input-small" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="publish_date">
                                            <?php echo lang ("Time and date of publication","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <div class="pull-left p_r">
                                                <label>
                                                    <input id="publish_date" name="publish_date" tabindex="7" value="<?php if(isset($publish_date)){ echo $publish_date; } ?>" type="text" data-placement="top" data-original-title="<?php echo lang ('choose date','admin'); ?>" data-rel="tooltip" class="datepicker input-small" style="width:120px;"/>
                                                    <i class="icon-calendar"></i>
                                                </label>
                                            </div>
                                            <input id="publish_time" name="publish_time" tabindex="8" type="text" value="<?php if(isset($publish_time)){ echo $publish_time; } ?>" class="input-small" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="roles[]">
                                            <?php echo lang ("Access","admin"); ?>:
                                        </label>
                                        <div class="controls">
                                            <select multiple="multiple" name="roles[]" id="roles[]">
                                                <option value="0" <?php if(isset($all_selected)){ echo $all_selected; } ?> ><?php echo lang ("All","admin"); ?></option>
                                                <?php if(is_true_array($roles)){ foreach ($roles as $role){ ?>
                                                <option <?php echo $role['selected']; ?> value="<?php echo $role['id']; ?>"><?php echo $role['alt_name']; ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php $this->include_tpl('modules_additions', 'Z:\home\newimgcms\www\templates\administrator'); ?>
        </div>
        <?php echo form_csrf (); ?>
    </form>
</section>



<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3><?php echo lang ("Create a category","admin"); ?></h3>
    </div>
    <div class="modal-body">

        <form action="/admin/categories/fast_add/create" method="post" id="fast_add_form" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">
                    <?php echo lang ("Name","admin"); ?>
                </label>
                <div class="controls">
                    <input type="text" name="name" value="" class="required">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">
                    <?php echo lang ("Parent","admin"); ?>
                </label>
                <div class="controls">
                    <select name="parent_id">
                        <option value="0" selected="selected"><?php echo lang ("No","admin"); ?></option>
                        <?php $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat'])); ?>
                    </select>
                </div>
            </div>
        </form>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"><?php echo lang ('Cancel','admin'); ?></a>
        <a href="#" class="btn btn-success" onclick="pagesAdmin.quickAddCategory()"><?php echo lang ('Create','admin'); ?></a>
    </div>
</div>
<script>
if (window.hasOwnProperty('pagesAdmin'))
    pagesAdmin.initialize();
</script><?php $mabilis_ttl=1426340926; $mabilis_last_modified=1426235917; //Z:\home\newimgcms\www\templates/administrator/edit_page.tpl ?>