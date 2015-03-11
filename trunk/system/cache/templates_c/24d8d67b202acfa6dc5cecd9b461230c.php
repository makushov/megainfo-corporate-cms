<?php include ('Z:\home\imgcms\www\application\libraries\mabilis/functions/func.truncate.php');  ?><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n"><?php echo lang ("Field constructor", 'cfcm'); ?></span>
        </div>
    </div>
    <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
        <a href="#additional_fields" class="btn btn-small active" onclick="$('#allM').html('<?php echo lang ("All modules", 'cfcm'); ?>')"><?php echo lang ("Additional fields", 'cfcm'); ?></a>
        <a href="#fields_groups" class="btn btn-small" onclick="$('#allM').html('<?php echo lang ("Install modules", 'cfcm'); ?>')"><?php echo lang ('Fields groups', 'cfcm'); ?></a>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="additional_fields">
            <div class="row-fluid">
                <div>
                    <div class="pull-right frame_zH_frame_title">
                        <span class="help-inline"></span>
                        <div class="d-i_b">
                            <a href="/admin/components/cp/cfcm/create_field" class="btn btn-small btn-success pjax" ><i class=" icon-plus-sign icon-white m-r_5"></i><?php echo lang ('Add field', 'cfcm'); ?></a>
                        </div>
                    </div>
                    <?php /*?>
                    <h4><?php echo lang ("Additional fields", 'cfcm'); ?></h4>
                    <?php */?>
                    <?php if(!empty($fields)): ?>
                    <table class="table  table-bordered table-hover table-condensed pages-table">
                        <thead>
                            <tr>
                                <th><?php echo lang ("Label", 'cfcm'); ?></th>
                                <th><?php echo lang ("Name", 'cfcm'); ?></th>
                                <th><?php echo lang ("Type", 'cfcm'); ?></th>
                                <th><?php echo lang ("Categories", 'cfcm'); ?></th>
                                <th class="span1"><?php echo lang ("Delete", 'cfcm'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_true_array($fields)){ foreach ($fields as $f){ ?>
                            <tr>
                                <td>
                                    <a href="/admin/components/cp/cfcm/edit_field/<?php echo $f['field_name']; ?>" class="pjax" data-rel="tooltip" data-title="<?php echo lang ("Edit custom field", 'cfcm'); ?>"><?php echo $f['label']; ?></a>
                                </td>
                                <td><?php echo $f['field_name']; ?></td>
                                <td><?php echo $f['type']; ?></td>
                                <td>
                                    <?php $i=0?>
                                    <?php $arr = array()?>
                                    <?php if(is_true_array($groupRels)){ foreach ($groupRels as $gr){ ?>
                                    <?php if($gr['field_name'] ==  $f['field_name']): ?>
                                    <?php if($gr['group_id']  == -1): ?><?php $arr[] =lang('Without catagory',"cfcm")?><?php endif; ?>
                                    <?php if($arr[] = $gr['name']): ?>
                                    <?php $i++?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php }} ?>
                                    <?php if(!$i): ?>
                                    0
                                    <?php else:?>
                                    <?php echo implode(', ', array_unique($arr))?>
                                    <?php endif; ?>
                                </td>
                                <td class="t-a_c">
                                    <button onclick="CFAdmin.deleteOne('<?php echo $f['field_name']; ?>');
                                    return false;" class="btn btn-small my_btn_s" data-rel="tooltip" data-title="<?php echo lang ("Delete", 'cfcm'); ?>"> <i class="icon-trash"></i></button>
                                </td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                    <?php else:?>
                    <div class="alert alert-info">
                        <?php echo lang ('List of additional fields is empty', 'cfcm'); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="fields_groups">
            <div class="row-fluid">
                <div>
                    <div class="pull-right frame_zH_frame_title">
                        <span class="help-inline"></span>
                        <div class="d-i_b">
                            <a href="/admin/components/cp/cfcm/create_group" class="btn btn-small btn-success pjax" ><i class=" icon-plus-sign icon-white m-r_5"></i><?php echo lang ('Create group', 'cfcm'); ?></a>
                        </div>

                    </div>
                    <?php /*?>
                    <h4><?php echo lang ('Field groups', 'cfcm'); ?></h4>
                    <?php */?>
                    <?php if(!$groups): ?>
                    <div class="alert alert-info">
                        <?php echo lang ("No groups", "cfcm"); ?>
                    </div>
                    <?php else:?>
                    <table class="table  table-bordered table-hover table-condensed pages-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th><?php echo lang ("Name", 'cfcm'); ?></th>
                                <th><?php echo lang ("Description", 'cfcm'); ?></th>
                                <th><?php echo lang ('Fields', 'cfcm'); ?></th>
                                <th class="span1"><?php echo lang ("Delete", 'cfcm'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_true_array($groups)){ foreach ($groups as $g){ ?>
                            <tr>
                                <td><?php echo $g['id']; ?></td>
                                <td>
                                    <a data-rel="tooltip" data-title="<?php echo lang ("Edit custom group", 'cfcm'); ?>" href="/admin/components/cp/cfcm/edit_group/<?php echo $g['id']; ?>" class="pjax"><?php echo $g['name']; ?></a>
                                </td>
                                <td><?php echo func_truncate ( $g['description'] , 35); ?></td>
                                <td>
                                    <?php echo $this->CI->db->get_where('content_fields_groups_relations', array('group_id' =>  $g['id'] ))->num_rows() ?>
                                </td>
                                <td class="t-a_c">
                                    <button onclick="CFAdmin.deleteOneGroup(<?php echo $g['id']; ?>);
                                    return false;" class="btn btn-small my_btn_s" data-rel="tooltip" data-title="<?php echo lang ("Delete", 'cfcm'); ?>"> <i class="icon-trash"></i></button>
                                </td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section><?php $mabilis_ttl=1426166248; $mabilis_last_modified=1425968242; //Z:\home\imgcms\www\application\modules\cfcm/templates/admin/index.tpl ?>