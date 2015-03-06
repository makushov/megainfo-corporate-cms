<div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang("Role remove","admin")}</h3>
        </div>
        <div class="modal-body">
            <p>{lang("Remove selected roles?","admin")}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$ADMIN_URL}roleDelete')" >{lang("Delete","admin")}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin')}</a>
        </div>
    </div>


    <div id="delete_dialog" style="display: none">
        {lang("Remove roles?","admin")}
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <form method="post" action="#">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">{lang("Roles list","admin")}</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="del_sel_role"><i class="icon-trash"></i>{lang("Delete","admin")}</button>
                        <a class="btn btn-small pjax btn-success" href="/admin/rbac/roleCreate" ><i class="icon-plus-sign icon-white"></i>{lang("New Role","admin")}</a>
                    </div>
                </div>  
            </div>
            {if count($model)>0}
                <div class="row-fluid">
                    <table class="table  table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="span1 t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"/>
                                        </span>
                                    </span>
                                </th>
                                <th class="span1">{lang("ID","admin")}</th>
                                <th>{lang("Title","admin")}</th>
                                <th>{lang("Description","admin")}</th>                                   
                            </tr>    
                        </thead>
                        <tbody>
                            {foreach $model as $item}
                                <tr data-id="{echo $item->id}" data-imp={echo $item->importance}>
                                    <td class="span1 t-a_c">
                                        {if $item->id != 1}
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" value="{echo $item->id}" name="ids"/>
                                                </span>
                                            </span>
                                        {/if}
                                    </td>
                                    <td>{echo $item->id}</td>
                                    <td>
                                        <a class="pjax" data-rel="tooltip" data-placement="top" data-original-title="{lang('Edit role','admin')}" href="/admin/rbac/roleEdit/{echo $item->id}">{echo $item->alt_name}</a>
                                    </td>
                                    <td>
                                        {echo $item->description}
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            {else:}
                </br>
                <div class="alert alert-info">
                    {lang("Roles list is empty.","admin")}
                </div>
            {/if}
        </section>
    </form>
</div>