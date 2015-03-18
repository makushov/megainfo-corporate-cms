
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php echo lang ("Widget delete","admin"); ?></h3>
    </div>
    <div class="modal-body">
        <p><?php echo lang ("Delete selected widget(s)?","admin"); ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/widgets_manager/delete')" ><?php echo lang ("Delete","admin"); ?></a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');"><?php echo lang ("Cancel","admin"); ?></a>
    </div>
</div>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"><?php echo lang ("Widgets list","admin"); ?></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="del_sel_wid"><i class="icon-trash"></i><?php echo lang ("Delete","admin"); ?></button>
                <a href="/admin/widgets_manager/create_tpl" type="button" class="btn btn-small btn-success pjax"><i class="icon-plus-sign icon-white"></i><?php echo lang ("Create a widget","admin"); ?></a>
            </div>
        </div>  
    </div>
    <?php if($error): ?>
        <br>
        <div class="alert alert-error">
            <?php if(isset($error)){ echo $error; } ?>
        </div>
    <?php else:?>   
        <?php if(count($widgets)>0): ?>
            <form method="post" action="#" class="form-horizontal">
                <table class="table  table-bordered table-hover table-condensed t-l_a">
                    <thead>
                        <tr>
                            <th class="t-a_c span1">
                                <span class="frame_label no_connection">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox"/>
                                    </span>
                                </span>
                            </th>
                            <th><?php echo lang ("ID","admin"); ?></th>
                            <th><?php echo lang ("Identifier","admin"); ?></th>
                            <th><?php echo lang ("Type","admin"); ?></th>
                            <th><?php echo lang ("Description","admin"); ?></th>
                            <th class="t-a_c"><?php echo lang ("Settings","admin"); ?></th>
                        </tr>    
                    </thead>
                    <tbody>
                        <?php if(is_true_array($widgets)){ foreach ($widgets as $widget){ ?>
                            <tr class="simple_tr">
                                <td class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" name="ids" value="<?php echo $widget['name']; ?>"/>
                                        </span>
                                    </span>
                                </td>
                                <td><?php echo $widget['id']; ?></td>
                                <td> 
                                    <?php if($widget['config']  == TRUE ||  $widget['type']  == 'html'): ?>
                                        <a 
                                            <?php if($widget['config']  == TRUE): ?> 
                                                class="pjax" href="/admin/widgets_manager/edit_module_widget/<?php echo $widget['id']; ?>/info" 
                                                data-rel="tooltip" data-title="<?php echo lang ("Editing","admin"); ?>"
                                            <?php endif; ?>  
                                            <?php if($widget['type']  == 'html'): ?> 
                                                class="pjax" href="/admin/widgets_manager/edit_html_widget/<?php echo $widget['id']; ?>/info"
                                            <?php endif; ?>
                                            >
                                        <?php endif; ?>
                                        <?php echo $widget['name']; ?>
                                        <?php if($widget['config']  == TRUE ||   $widget['type']  == 'html'): ?>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php switch(  $widget['type']  ){ default: break; ?>
                                    <?php case 'module':?>
                                    <?php echo lang ("Module","admin"); ?> <?php echo $widget['data']; ?>
                                    <?php break?>
                                    <?php case 'html':?>
                                    <?php echo lang ("HTML","admin"); ?>
                                    <?php break?>
                                    <?php } ?>
                                </td>
                                <td><?php echo $widget['description']; ?></td>
                                <td class="span2 t-a_c">
                                    <?php if($widget['config']  == TRUE): ?>
                                        <a class="btn-small btn pjax" href="/admin/widgets_manager/edit/<?php echo $widget['id']; ?>" data-rel="tooltip" data-title="<?php echo lang ("Settings","admin"); ?>"><i class="icon-wrench"></i></a>
                                        <?php endif; ?>
                                </td>
                            </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            </form>
        <?php else:?>
            </br>
            <div class="alert alert-info">
                <?php echo lang ("No widgets created","admin"); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>        
</section><?php $mabilis_ttl=1426340951; $mabilis_last_modified=1426235918; //Z:\home\newimgcms\www\templates/administrator/widgets_list.tpl ?>