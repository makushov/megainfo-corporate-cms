<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left w-s_n">
            <span class="help-inline"></span>
            <span class="title w-s_n"><?php echo $form->title?></span>
        </div>
        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/components/cp/cfcm/index<?php if($form->type == "group"): ?>#fields_groups<?php else:?>#additional_fields<?php endif; ?>" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"><?php echo lang ("Back", 'admin'); ?></span></a>
                <button type="button" class="btn btn-small action_on formSubmit <?php if(strstr($CI->uri->segment(5), 'create')): ?>btn-success<?php else:?>btn-primary<?php endif; ?>"  data-action="edit" data-form="#<?php echo $f_id = uniqid()?>"><i class="icon-plus-sign icon-white"></i><?php if(strstr($CI->uri->segment(5), 'create')): ?><?php echo lang ("Create", 'admin'); ?><?php else:?><?php echo lang ("Save", 'cfcm'); ?><?php endif; ?></button>
                <button type="button" class="btn btn-small action_on formSubmit btn-default" data-action="close" data-form="#<?php echo $f_id?>"><i class="icon-check"></i><?php if(strstr($CI->uri->segment(5), 'create')): ?><?php echo lang ('Create and exit', 'admin'); ?><?php else:?><?php echo lang ("Save and exit", 'cfcm'); ?><?php endif; ?></button>
            </div>
        </div>
    </div>
    <table class="table  table-bordered table-hover table-condensed content_big_td m-t_10">
        <thead>
            <tr>
                <th colspan="6">
                    <?php echo lang ("Information", 'cfcm'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd">
                        <form action="<?php echo $form->action?>" method="post" id="<?php if(isset($f_id)){ echo $f_id; } ?>" class="form-horizontal additionals-one-fields">
                            <?php if(is_true_array($form->asArray())){ foreach ($form->asArray() as $f){ ?>
                                <div class="control-group">
                                    <label class="control-label">
                                        <?php echo $f['label']; ?>
                                    </label>
                                    <div class="controls">
                                        <?php echo $f['field']; ?>
                                        <?php echo $f['help_text']; ?>
                                    </div>
                                </div>
                            <?php }} ?>
                        </form>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</section>

<?php $mabilis_ttl=1426166261; $mabilis_last_modified=1425968242; //Z:\home\imgcms\www\application\modules\cfcm/templates/admin/_form.tpl ?>