<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"><?php echo lang ("Edit menu item", 'menu'); ?></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/menu/menu_item/<?php echo $menu['name']; ?>" class="t-d_n m-r_15 pjax"><span class="f-s_14"></span>←<span class="t-d_u"><?php echo lang ("Go back", 'menu'); ?></span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit submit_link" data-form="#<?php echo $item['item_type']; ?>_form" data-submit><i class="icon-ok"></i><?php echo lang ("Save", "menu"); ?></button>
                <button type="button" class="btn btn-small formSubmit submit_link" data-form="#<?php echo $item['item_type']; ?>_form" data-action="tomain"><i class="icon-check"></i><?php echo lang ("Save and exit", "menu"); ?></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span5">
            <ul class="btn-group myTab m-t_10 nav-tabs horiz link_type">
                <li class="btn btn-small <?php if($item['item_type']  == 'page'): ?> active<?php endif; ?>"><a href="#page"><?php echo lang ("Page", "menu"); ?></a></li>
                <li class="btn btn-small <?php if($item['item_type']  == 'category'): ?>active<?php endif; ?>"><a href="#category"><?php echo lang ("Categories", "menu"); ?></a></li>
                <li class="btn btn-small <?php if($item['item_type']  == 'module'): ?>active<?php endif; ?>"><a href="#module"><?php echo lang ("Module", "menu"); ?></a></li>
                <li class="btn btn-small <?php if($item['item_type']  == 'url'): ?>active<?php endif; ?>"><a href="#url"><?php echo lang ("Link", "menu"); ?></a></li>
            </ul>
        </div>
    </div>
    <div class="tab-content form-horizontal">
        <div id="page" class="tab-pane <?php if($item['item_type']  == 'page'): ?>active<?php endif; ?>">
            <form method="post" action="/admin/components/cp/menu/edit_item/<?php echo $item['id']; ?>" id="page_form">
                <?php $data = unserialize( $item['add_data'] ) ?>
                <input type="hidden" name="menu_id" value="<?php echo $menu['id']; ?>"/>
                <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>" id="item_page_id"/>
                <input type="hidden" value="<?php echo $item['item_image']; ?>" id="item_url_image"/>
                <input type="hidden" name="page_item_type" value="page"/>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <?php echo lang ("Pages", "menu"); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Categories", "menu"); ?>:</label>
                                            <div class="controls">
                                                <select id="category_sel">
                                                    <option value="0"><?php echo lang ("Root", "menu"); ?></option>
                                                    <?php $sel = array()?>
                                                    <?php echo build_cats_tree($cats, $sel)?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ('On page', 'menu'); ?>:</label>
                                            <div class="controls">
                                                <select id="per_page">
                                                    <option value="10" selected="selected">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                    <option value="40">40</option>
                                                    <option value="50">50</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ('Pages list', 'menu'); ?>:</label>
                                            <div class="controls">
                                                <div id="pages_list_holder" class="span3">
                                                    <ul class="nav myTab nav-tabs nav-stacked">
                                                        <?php if(is_true_array($pages['pages_list'])){ foreach ($pages['pages_list'] as $p){ ?>
                                                            <li <?php if($item['item_id']  ==  $p['id']): ?>class="active"<?php endif; ?>>
                                                                <a class="page_title" data-url="<?php echo $p['cat_url']; ?>/<?php echo $p['url']; ?>" data-title="<?php echo $p['title']; ?>" data-id="<?php echo $p['id']; ?>"><?php echo  $p['title']  ?></a>
                                                            </li>
                                                        <?php }} ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="owner_id" value="<?php if(isset($insert_id)){ echo $insert_id; } ?>" />
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <?php echo lang ('Parameters', 'menu'); ?>:
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Type", "menu"); ?>:</label>
                                            <div class="controls ctext">
                                                <span class="help-block"><?php echo lang ("Page", "menu"); ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("ID", "menu"); ?>: <span class="must">*</span></label>
                                            <div class="controls ctext">
                                                <span id="page_id_holder" class="help-block"><?php echo $item['id']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Title", "menu"); ?>: <span class="must">*</span></label>
                                            <div class="controls">
                                                <input type="text" value="<?php echo $item['title']; ?>" name="title"  id="item_title" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Parent", "menu"); ?>:</label>
                                            <div class="controls">
                                                <select name="page_parent_id" id="item_parent_id">
                                                    <option value="0"><?php echo lang ("No", "menu"); ?></option>
                                                    <?php if(is_true_array($parents)){ foreach ($parents as $par){ ?>
                                                        <option value="<?php echo $par['id']; ?>" <?php if($item['parent_id']  != 0 AND  $item['parent_id']  ==  $par['id']): ?>selected="selected"<?php endif; ?>> - <?php echo $par['title']; ?></option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Img0">
                                                <?php echo lang ("Image", "menu"); ?>:
                                            </label>
                                            <div class="controls">
                                                <div class="group_icon pull-right">
                                                    <a href="<?php echo site_url('application/third_party/filemanager/dialog.php?type=1&field_id=Img0');?>" class="btn  iframe-btn" type="button">
                                                        <i class="icon-picture"></i>
                                                        <?php echo lang ('Choose an image ', "menu"); ?>
                                                    </a>
                                                </div>
                                                <div class="o_h">
                                                    <input type="text" name="page_item_image" id="Img0" value="<?php echo $item['item_image']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Access level", "menu"); ?>:</label>
                                            <div class="controls">
                                                <?php $r  = unserialize( $item['roles'] ) ?>
                                                <?php if(!is_array($r)): ?>
                                                    <?php $r = array()?>
                                                <?php endif; ?>
                                                <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                    <option value="0"><?php echo lang ("All", "menu"); ?></option>
                                                    <?php if(is_true_array($roles)){ foreach ($roles as $role){ ?>
                                                        <option value ="<?php echo $role['id']; ?>" <?php if(in_array( $role['id'] , $r)): ?>selected="selected"<?php endif; ?>><?php echo $role['alt_name']; ?></option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Hide", "menu"); ?>:</label>
                                            <div class="controls">
                                                <span class="frame_label no_connection m-r_15">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="page_hidden" value="1" <?php if($item['hidden']  == 1): ?>checked="checked"<?php endif; ?>/>
                                                    </span> <?php echo lang ("Yes", "menu"); ?>
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="page_hidden" value="0" <?php if($item['hidden']  == 0): ?>checked="checked"<?php endif; ?>/>
                                                    </span>
                                                    <?php echo lang ("No", "menu"); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Open in the new window", "menu"); ?>:</label>
                                            <div class="controls">
                                                <span class="m-r_15 frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="page_newpage" value="1" <?php if($data['newpage']  == 1): ?>checked="checked"<?php endif; ?>/>
                                                    </span> <?php echo lang ("Yes", "menu"); ?>
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="page_newpage" value="0" <?php if($data['newpage']  == 0): ?>checked="checked"<?php endif; ?>/>
                                                    </span> <?php echo lang ("No", "menu"); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div id="category" class="tab-pane <?php if($item['item_type']  == 'category'): ?>active<?php endif; ?>">
            <form method="post" action="/admin/components/cp/menu/edit_item/<?php echo $item['id']; ?>" id="category_form" >
                <?php $data = unserialize( $item['add_data'] ) ?>
                <input type="hidden" name="menu_id" value="<?php echo $menu['id']; ?>"/>
                <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>" id="cat_input"/>
                <input type="hidden" name="cat_item_type" value="category"/>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <?php echo lang ("Pages", "menu"); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Choose a category", "menu"); ?>:</label>
                                            <div class="controls">
                                                <ul>
                                                    <?php echo build_cats_tree_ul_li ($cats,  $item['item_id'] ); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <?php echo lang ('Parameters', 'menu'); ?>:
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Type", "menu"); ?>:</label>
                                            <div class="controls ctext">
                                                <span class="help-block"><?php echo lang ("Categories", "menu"); ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("ID", "menu"); ?>: <span class="must">*</span></label>
                                            <div class="controls ctext">
                                                <span id="cat_id_holder" class="help-block"><?php echo $item['item_id']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Title", "menu"); ?>: <span class="must">*</span></label>
                                            <div class="controls">
                                                <input type="text" value="<?php echo $item['title']; ?>" name="title"  id="item_cat_title" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Parent", "menu"); ?>:</label>
                                            <div class="controls">
                                                <select name="cat_parent_id" id="item_parent_id">
                                                    <option value="0"><?php echo lang ("No", "menu"); ?></option>
                                                    <?php if(is_true_array($parents)){ foreach ($parents as $p){ ?>
                                                        <option value="<?php echo $p['id']; ?>" <?php if($item['parent_id']  != 0 AND  $item['parent_id']  ==  $p['id']): ?>selected="selected"<?php endif; ?>> - <?php echo $p['title']; ?></option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Img1">
                                                <?php echo lang ("Image", "menu"); ?>:
                                            </label>
                                            <div class="controls">
                                                <div class="group_icon pull-right">
                                                    <a href="<?php echo site_url('application/third_party/filemanager/dialog.php?type=1&field_id=Img1');?>" class="btn  iframe-btn" type="button">
                                                        <i class="icon-picture"></i>
                                                        <?php echo lang ('Choose an image ', "menu"); ?>
                                                    </a>
                                                </div>
                                                <div class="o_h">
                                                    <input type="text" name="cat_item_image" id="Img1" value="<?php echo $item['item_image']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Access level", "menu"); ?>:</label>
                                            <div class="controls">
                                                <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                    <option value="0"><?php echo lang ("All", "menu"); ?></option>
                                                    <?php if(is_true_array($roles)){ foreach ($roles as $role){ ?>
                                                        <option value ="<?php echo $role['id']; ?>" <?php if(in_array( $role['id'] , $r)): ?>selected="selected"<?php endif; ?>><?php echo $role['alt_name']; ?></option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Hide", "menu"); ?>:</label>
                                            <div class="controls">
                                                <span class="m-r_15 frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="cat_hidden" value="1" <?php if($item['hidden']  == 1): ?>checked="checked"<?php endif; ?>/>
                                                    </span>
                                                    <?php echo lang ("Yes", "menu"); ?>
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="cat_hidden" value="0" <?php if($item['hidden']  == 0): ?>checked="checked"<?php endif; ?>/>
                                                    </span>
                                                    <?php echo lang ("No", "menu"); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Open in the new window", "menu"); ?>:</label>
                                            <div class="controls">
                                                <span class="m-r_15">
                                                    <span class="frame_label no_connection">
                                                        <span class="niceRadio">
                                                            <input type="radio" name="cat_newpage" value="1" <?php if($data['newpage']  == 1): ?>checked="checked"<?php endif; ?>/>
                                                        </span>
                                                        <?php echo lang ("Yes", "menu"); ?>
                                                    </span>
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="cat_newpage" value="0" <?php if($data['newpage']  == 0): ?>checked="checked"<?php endif; ?>/>
                                                    </span>
                                                    <?php echo lang ("No", "menu"); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div id="module" class="tab-pane <?php if($item['item_type']  == 'module'): ?>active<?php endif; ?>">
            <form method="post" action="/admin/components/cp/menu/edit_item/<?php echo $item['id']; ?>" id="module_form">
                                <div class="row-fluid">
                    <div class="span3">
                        <input type="hidden" name="menu_id" value="<?php echo $menu['id']; ?>"/>
                        <input type="hidden" name="item_id" value="0" />
                        <input type="hidden" name="module_item_type" value="module"/>
                        <input type="hidden" name="mod_name" value="<?php echo $data['mod_name']; ?>"/>
                        <ul class="nav myTab nav-tabs nav-stacked">
                            <?php if(is_true_array($modules)){ foreach ($modules as $module){ ?>
                                <li><a href="#" class="module_item"  onclick="loadPathImg('<?php echo $module['name']; ?>')" data-mname="<?php echo $module['name']; ?>" data-murl="<?php echo $module['url_image']; ?>" id="module_<?php echo $module['name']; ?>" title="<?php echo $module['description']; ?>"><?php echo $module['menu_name']; ?></a></li>
                                <?php }} ?>
                        </ul>
                    </div>
                    <div class="span9">
                        <table class="table  table-bordered table-hover table-condensed content_big_td">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        <?php echo lang ('Parameters', 'menu'); ?>:
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo lang ("Type", "menu"); ?>:</label>
                                                    <div class="controls ctext">
                                                        <span class="help-block">
                                                            <?php echo lang ("Module", "menu"); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo lang ("Name", "menu"); ?>: <span class="must">*</span></label>
                                                    <div class="controls ctext">
                                                        <span id="module_name_holder" class="help-block"><?php echo $data['mod_name']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo lang ("Title", "menu"); ?>: <span class="must">*</span></label>
                                                    <div class="controls">
                                                        <input type="text" value="<?php echo $item['title']; ?>" name="title"  id="module_item_title" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo lang ('Method', 'menu'); ?>:</label>
                                                    <div class="controls">
                                                        <input type="text" value="<?php echo $data['method']; ?>" name="mod_method"/>
                                                        <span class="help-block"><?php echo lang ('Example', 'menu'); ?>: func_name/param1/param2</span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo lang ("Parent", "menu"); ?>:</label>
                                                    <div class="controls">
                                                        <select name="module_parent_id" id="item_parent_id">
                                                            <option value="0"><?php echo lang ("No", "menu"); ?></option>
                                                            <?php if(is_true_array($parents)){ foreach ($parents as $p){ ?>
                                                                <option value="<?php echo $p['id']; ?>" <?php if($item['parent_id']  != 0 AND  $item['parent_id']  ==  $p['id']): ?>selected="selected"<?php endif; ?>> - <?php echo $p['title']; ?></option>
                                                            <?php }} ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="Img2">
                                                        <?php echo lang ("Image", "menu"); ?>:
                                                    </label>
                                                    <div class="controls">
                                                        <div class="group_icon pull-right">
                                                    <a href="<?php echo site_url('application/third_party/filemanager/dialog.php?type=1&field_id=Img2');?>" class="btn  iframe-btn" type="button">
                                                        <i class="icon-picture"></i>
                                                        <?php echo lang ('Choose an image ', "menu"); ?>
                                                    </a>
                                                </div>
                                                        <div class="o_h">
                                                            <input type="text" name="module_item_image" id="Img2" value="<?php echo $item['item_image']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo lang ("Access level", "menu"); ?>:</label>
                                                    <div class="controls">
                                                        <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                            <option value="0"><?php echo lang ("All", "menu"); ?></option>
                                                            <?php if(is_true_array($roles)){ foreach ($roles as $role){ ?>
                                                                <option value ="<?php echo $role['id']; ?>" <?php if(in_array( $role['id'] , $r)): ?>selected="selected"le<?php endif; ?>><?php echo $role['alt_name']; ?></option>
                                                            <?php }} ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo lang ("Hide", "menu"); ?>:</label>
                                                    <div class="controls">
                                                        <span class="m-r_15">
                                                            <span class="frame_label no_connection">
                                                                <span class="niceRadio">
                                                                    <input type="radio" name="module_hidden" value="1" <?php if($item['hidden']  == 1): ?>checked="checked"<?php endif; ?>/>
                                                                </span>
                                                            </span>
                                                            <?php echo lang ("Yes", "menu"); ?>
                                                        </span>
                                                        <span class="frame_label no_connection">
                                                            <span class="niceRadio">
                                                                <input type="radio" name="module_hidden" value="0" <?php if($item['hidden']  == 0): ?>checked="checked"<?php endif; ?>/>
                                                            </span>
                                                            <?php echo lang ("No", "menu"); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo lang ("Open in the new window", "menu"); ?>:</label>
                                                    <div class="controls">
                                                        <span class="m-r_15">
                                                            <span class="frame_label no_connection">
                                                                <span class="niceRadio">
                                                                    <input type="radio" name="module_newpage" value="1" <?php if($data['newpage']  == 1): ?>checked="checked"<?php endif; ?>/>
                                                                </span>
                                                                <?php echo lang ("Yes", "menu"); ?>
                                                            </span>
                                                        </span>
                                                        <span class="frame_label no_connection">
                                                            <span class="niceRadio">
                                                                <input type="radio" name="module_newpage" value="0" <?php if($data['newpage']  == 0): ?>checked="checked"<?php endif; ?>/>
                                                            </span>
                                                            <?php echo lang ("No", "menu"); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <div id="url" class="tab-pane <?php if($item['item_type']  == 'url'): ?>active<?php endif; ?>">
            <form method="post" action="/admin/components/cp/menu/edit_item/<?php echo $item['id']; ?>" id="url_form" >
                <input type="hidden" name="menu_id" value="<?php echo $menu['id']; ?>">
                <input type="hidden" name="item_id" value="0"/>
                <input type="hidden" name="url_item_type" value="url"/>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <?php echo lang ("URL", "menu"); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Specify or select a link to the page", "menu"); ?>: <span class="must">*</span></label>
                                            <div class="controls">
                                                <input type="text" id="url_to_page" value="<?php echo  $data['url']  ?>" name="item_url"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <?php echo lang ("Settings", "menu"); ?>:
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <?php $r = unserialize( $item['roles'] ) ?>
                                <div class="inside_padd">
                                    <div class="span12">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Title", "menu"); ?>: <span class="must">*</span></label>
                                            <div class="controls">
                                                <input type="text" value="<?php echo $item['title']; ?>" name="title"  id="item_title" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Parent", "menu"); ?>:</label>
                                            <div class="controls">
                                                <select name="url_parent_id" id="item_parent_id">
                                                    <option value="0"><?php echo lang ("No", "menu"); ?></option>
                                                    <?php if(is_true_array($parents)){ foreach ($parents as $p){ ?>
                                                        <option value="<?php echo $p['id']; ?>" <?php if($item['parent_id']  != 0 AND  $item['parent_id']  ==  $p['id']): ?>selected="selected"<?php endif; ?>> - <?php echo $p['title']; ?></option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Img3">
                                                <?php echo lang ("Image", "menu"); ?>:
                                            </label>
                                            <div class="controls">
                                                <div class="group_icon pull-right">
                                                    <a href="<?php echo site_url('application/third_party/filemanager/dialog.php?type=1&field_id=Img3');?>" class="btn  iframe-btn" type="button">
                                                        <i class="icon-picture"></i>
                                                        <?php echo lang ('Choose an image ', "menu"); ?>
                                                    </a>
                                                </div>
                                                <div class="o_h">
                                                    <input type="text" name="url_item_image" id="Img3" value="<?php echo $item['item_image']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Access level", "menu"); ?>:</label>
                                            <div class="controls">
                                                <select id="item_roles" name="item_roles[]" multiple="multiple">
                                                    <option value="0"><?php echo lang ("All", "menu"); ?></option>
                                                    <?php if(is_true_array($roles)){ foreach ($roles as $role){ ?>
                                                        <option value ="<?php echo $role['id']; ?>" <?php if(@in_array( $role['id'] , $r)): ?>selected="selected"<?php endif; ?>><?php echo $role['alt_name']; ?></option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Hide", "menu"); ?>:</label>
                                            <div class="controls">
                                                <span class="m-r_15">
                                                    <span class="frame_label no_connection">
                                                        <span class="niceRadio">
                                                            <input type="radio" name="url_hidden" value="1" <?php if($item['hidden']  == 1): ?>checked="checked"<?php endif; ?>/>
                                                        </span>
                                                        <?php echo lang ("Yes", "menu"); ?>
                                                    </span>
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="url_hidden" value="0" <?php if($item['hidden']  == 0): ?>checked="checked"<?php endif; ?>/>
                                                    </span>
                                                    <?php echo lang ("No", "menu"); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang ("Open in the new window", "menu"); ?>:</label>
                                            <div class="controls">
                                                <span class="m-r_15">
                                                    <span class="frame_label no_connection">
                                                        <span class="niceRadio">
                                                            <input type="radio" name="url_newpage" value="1" <?php if($data['newpage']  == 1): ?>checked="checked"<?php endif; ?>/>
                                                        </span>
                                                        <?php echo lang ("Yes", "menu"); ?>
                                                    </span>
                                                </span>
                                                <span class="frame_label no_connection">
                                                    <span class="niceRadio">
                                                        <input type="radio" name="url_newpage" value="0" <?php if($data['newpage']  == 0): ?>checked="checked"<?php endif; ?>/>
                                                    </span>
                                                    <?php echo lang ("No", "menu"); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</section>
<div id="elFinder"></div>
    <script type="text/javascript">
    function loadPathImg(title){
        $.post('/admin/components/cp/menu/loadPathImg/',{
            'title':title
        },function(data){
                $('#Img2').val(data);
            });
        }
    </script>
<?php $mabilis_ttl=1426330371; $mabilis_last_modified=1426235906; //Z:\home\newimgcms\www\application\modules\menu/templates/edit_item.tpl ?>