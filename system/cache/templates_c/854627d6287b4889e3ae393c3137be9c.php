<?php include ('Z:\home\newimgcms\www\application\libraries\mabilis/functions/func.truncate.php');  ?><?php /* ?>lang('Your search did not found', 'admin')<?php */ ?>
<div class="modal hide fade" id="pages_action_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="mvMv"><?php echo lang ("Move page", 'admin'); ?></h3>
    </div>
    <div class="modal-body">
        <?php echo lang ("Category","admin"); ?>:
        <select id="CopyMoveCategorySelect" url="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/GetPagesByCategory/">
            <option value="0"><?php echo lang ("Without a category","admin"); ?></option>
            <?php $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'] ));?>
        </select>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"><?php echo lang ("Cancel","admin"); ?></a>
        <a href="#" id="confirmMove" class="btn btn-primary" onclick="pagesAdmin.confirmListAction('<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/move_pages/copy')" ><?php echo lang ('Approve','admin'); ?></a>
    </div>
</div>

<div class="modal hide fade" id="pages_action_dialog_copy">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="mvMv"><?php echo lang ("Copy page", 'admin'); ?></h3>
    </div>
    <div class="modal-body">
        <?php echo lang ("Category","admin"); ?>:
        <select id="CopyMoveCategorySelect2" name="CopyMoveCategorySelect" url="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/GetPagesByCategory/">
            <option value="0"><?php echo lang ("Without a category","admin"); ?></option>
            <?php $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'] ));?>
        </select>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"><?php echo lang ("Cancel","admin"); ?></a>
        <a href="#" id="confirmMove" class="btn btn-primary" onclick="pagesAdmin.confirmListAction('<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/move_pages/copy')" ><?php echo lang ('Approve','admin'); ?></a>
    </div>
</div>

<div class="modal hide fade" id="pages_delete_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php echo lang ('Delete pages','admin'); ?></h3>
    </div>
    <div class="modal-body">
        <?php echo lang ('Delete selected pages?', 'admin'); ?>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"><?php echo lang ("Cancel",'admin'); ?></a>
        <a href="#" class="btn btn-primary" onclick="pagesAdmin.confirmListAction('<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/delete_pages/')" ><?php echo lang ("Delete","admin"); ?></a>
    </div>
</div>

<form method="post" action="" class="listFilterForm" id="pagesFilterForm">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"><?php echo lang ('Articles list', 'admin'); ?> (<?php echo $total_pages?>)</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <button type="submit" class="btn btn-small disabled action_on listFilterSubmitButton " disabled="disabled" ><i class="icon-filter"></i><?php echo lang ('Filter','admin'); ?></button>
                    <a href="<?php echo site_url ('/admin/pages/GetPagesByCategory'); ?>"   title="<?php echo lang ('Cancel filter','admin'); ?>" type="button" class="btn btn-small <?php if(!$_POST): ?>disabled <?php endif; ?>"><i class="icon-refresh"></i><?php echo lang ('Cancel filter','admin'); ?></a>
                    <button onclick="$('#pages_action_dialog_copy').modal();" type="button" class="btn btn-small disabled action_on pages_action" ><i class="icon-asterisk"></i> <?php echo lang ('Create copy','admin'); ?></button>
                    <button onclick="$('#pages_action_dialog').modal();
                    pagesAdmin.updDialogMove();" type="button" class="btn btn-small disabled action_on pages_action" ><i class="icon-move"></i><?php echo lang ('Move','admin'); ?></button>
                    <button onclick="$('#pages_delete_dialog').modal();
                    pagesAdmin.updDialogCopy();" type="button" class="btn btn-small btn-danger disabled action_on pages_action pages_delete" ><i class="icon-trash"></i><?php echo lang ('Delete','admin'); ?></button>
                    <!--<button type="button" class="btn btn-small btn-success" onclick="window.location.href='<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages'"><i class="icon-plus-sign icon-white"></i><?php echo lang ('Create page','admin'); ?></button>-->
                    <a class="btn btn-small btn-success" href='<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages'><i class="icon-plus-sign icon-white"></i><?php echo lang ('Create page','admin'); ?></a>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <?php if($show_cat_list == 'yes'): ?>
            <div class="span3">
                <div class="inside_padd">
                    <ul class="nav nav-tabs nav-stacked">
                        <li <?php if('0'==$cat_id): ?> class="active" <?php endif; ?> ><a href="/admin/pages/GetPagesByCategory/0" class="pjax"><?php echo lang ("Without a category","admin"); ?></a></li>
                        <li <?php if('all'==$cat_id): ?> class="active" <?php endif; ?>><a href="/admin/pages/GetPagesByCategory" class="pjax"><?php echo lang ('All categories','admin'); ?></a></li>


                        <?php if(is_true_array($tree)){ foreach ($tree as $cat){ ?>
                        <li class="<?php if($cat_id== $cat['id']): ?>active<?php endif; ?> <?php if($cat['subtree']): ?>is-sub<?php endif; ?>" >
                            <a  href="/admin/pages/GetPagesByCategory/<?php echo $cat['id']; ?>" class="pjax"><?php echo $cat['name']; ?></a>
                        </li>
                        <?php if($cat['subtree']): ?>
                        <?php if(is_true_array($cat['subtree'])){ foreach ($cat['subtree'] as $sc1){ ?>
                        <li <?php if($cat_id== $sc1['id']): ?> class="active" <?php endif; ?>>
                            <a  href="/admin/pages/GetPagesByCategory/<?php echo $sc1['id']; ?>" class="pjax">&nbsp;&nbsp;&nbsp;<?php echo $sc1['name']; ?> </a>
                        </li>
                        <?php if($sc1['subtree']): ?>
                        <?php if(is_true_array($sc1['subtree'])){ foreach ($sc1['subtree'] as $sc2){ ?>
                        <li <?php if($cat_id== $sc2['id']): ?> class="active" <?php endif; ?>>
                            <a  href="/admin/pages/GetPagesByCategory/<?php echo $sc2['id']; ?>" class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sc2['name']; ?> </a>
                        </li>
                        <?php if($sc2['subtree']): ?>
                        <?php if(is_true_array($sc2['subtree'])){ foreach ($sc2['subtree'] as $sc3){ ?>
                        <li <?php if($cat_id== $sc3['id']): ?> class="active" <?php endif; ?>>
                            <a  href="/admin/pages/GetPagesByCategory/<?php echo $sc3['id']; ?>" class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sc3['name']; ?> </a>
                        </li>
                        <?php if($sc3['subtree']): ?>
                        <?php if(is_true_array($sc3['subtree'])){ foreach ($sc3['subtree'] as $sc4){ ?>
                        <li <?php if($cat_id== $sc4['id']): ?> class="active" <?php endif; ?>>
                            <a  href="/admin/pages/GetPagesByCategory/<?php echo $sc4['id']; ?>" class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sc4['name']; ?> </a>
                        </li>
                        <?php }} ?>
                        <?php endif; ?>
                        <?php }} ?>
                        <?php endif; ?>
                        <?php }} ?>
                        <?php endif; ?>
                        <?php }} ?>
                        <?php endif; ?>
                        <?php }} ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
            <div class="span9">
                <div class="inside_padd">
                    <table class="table  table-bordered table-hover table-condensed pages-table t-l_a" <?php if($show_cat_list != 'yes'): ?> style="width:100%;"<?php endif; ?>>
                        <thead>
                            <tr>
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"/>
                                        </span>
                                    </span>
                                </th>
                                <th class="span1">ID</th>
                                <th class="span3"><?php echo lang ('Title','admin'); ?></th>
                                <th class="span2"><?php echo lang ('Url','admin'); ?></th>
                                <?php if($show_cat_list != 'yes'): ?>
                                <th><?php echo lang ('Category','admin'); ?></th>
                                <?php endif; ?>
                                <th class="span2"><?php echo lang ('Creation date','admin'); ?></th>
                                <th class="span1"><?php echo lang ('Status','admin'); ?></th>
                            </tr>
                            <tr class="head_body">
                                <td>
                                </td>
                                <td class="number">
                                    <input type="text" name="id" data-original-title="<?php echo lang ('Digits only','admin'); ?>" value="<?php echo $_POST['id']; ?>"/>
                                </td>
                                <td>
                                    <input type="text" name="title" value="<?php echo $_POST['title']; ?>"/>
                                </td>
                                <td>
                                    <input type="text" name="url" value="<?php echo $_POST['url']; ?>"/>
                                </td>
                                <?php if($show_cat_list != 'yes'): ?>
                                <td>
                                    <select id="categorySelect" url="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/GetPagesByCategory/">
                                        <option value=""><?php echo lang ('All categories','admin'); ?></option>
                                        <option value="0" <?php if($cat_id === "0"): ?>selected="selected"<?php endif; ?>><?php echo lang ('Without category','admin'); ?></option>
                                        <?php $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['cat_id']));?>
                                    </select>
                                </td>
                                <?php endif; ?>
                                <td>
                                </td>
                                <td>
                                </td>
                            </tr>
                        </thead>
                        <tbody data-url="" class="sortable ui-sortable">
                            <?php if(count($pages)): ?>
                            <?php if(is_true_array($pages)){ foreach ($pages as $page){ ?>
                            <tr data-id="<?php echo $page['id']; ?>">
                                <td class="t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" data-id="<?php echo $page['id']; ?>" name="ids" value="<?php echo $page['id']; ?>"/>
                                        </span>
                                    </span>
                                </td>
                                <td><?php echo $page['id']; ?></td>
                                <td class="share_alt">
                                    <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?><?php echo $page['cat_url']; ?><?php echo $page['url']; ?>" target="_blank" class="go_to_site pull-right btn btn-small" data-rel="tooltip" data-placement="top" data-original-title="<?php echo lang ("Show on site","admin"); ?>"><i class="icon-share-alt"></i></a>
                                    <div class="o_h">
                                        <a href="<?php if(isset($BASE_URL)){ echo $BASE_URL; } ?>admin/pages/edit/<?php echo $page['id']; ?>" class="title pjax" data-rel="tooltip" data-original-title="<?php echo lang ("Edit page","admin"); ?>"><?php echo $page['title']; ?></a>
                                    </div>
                                </td>
                                <td><span><?php echo func_truncate ( $page['url'] , 40, '...'); ?></span></td>
                                <?php if($show_cat_list != 'yes'): ?>
                                <td>
                                    <span><?php if($category): ?><?php echo $category['name']; ?><?php else:?>

                                        <?php if(0 ==  $page['category']): ?>
                                        <?php echo lang ("Without a category","admin"); ?>
                                        <?php else:?>

                                        <?php if(is_true_array($cats)){ foreach ($cats as $c){ ?>
                                        <?php if($c['id']  ==  $page['category']): ?>
                                        <?php echo $c['name']; ?>
                                        <?php endif; ?>
                                        <?php }} ?>

                                        <?php endif; ?>
                                        <?php endif; ?></span>
                                    </td><?php endif; ?>
                                    <td>
                                        <?php echo date ('d-m-Y, H:i',  $page['publish_date'] ); ?>
                                    </td>
                                    <td>
                                        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="<?php if($page['post_status'] == 'publish'): ?><?php echo lang ("show","admin"); ?><?php else:?><?php echo lang ("don't show", 'admin'); ?><?php endif; ?>" onclick="change_page_status('<?php echo $page['id']; ?>');">
                                            <span class="prod-on_off <?php if($page['post_status'] != 'publish'): ?>disable_tovar<?php endif; ?>" style="<?php if($page['post_status'] != 'publish'): ?>left: -28px;<?php endif; ?>"></span>
                                        </div>
                                    </td>
                                </tr>
                                <?php }} ?>
                                <?php else:?>
                                <tr>
                                    <td colspan="6">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="alert alert-info" style="margin: 18px;"><?php echo lang ('Your search did not found', 'admin'); ?></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($paginator > ''): ?>
                <div class="span9">
                    <?php if(isset($paginator)){ echo $paginator; } ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php echo form_csrf (); ?>
    </form><?php $mabilis_ttl=1426340933; $mabilis_last_modified=1426235922; //Z:\home\newimgcms\www\templates/administrator/pages_list.tpl ?>