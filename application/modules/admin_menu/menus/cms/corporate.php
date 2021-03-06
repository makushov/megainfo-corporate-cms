<?php return array( 
  array(
     'identifier' => 'content',
     'text' =>  lang("Content", "admin_menu"),
     'link' => '',
     'class' => '',
     'id' => '',
     'pjax' => '',
     'icon' => 'icon-align-justify',
     'divider' => false,
     'callback' => '',
     'subMenu' => 
    array( 
      array(
         'identifier' => 'create_page',
         'text' =>  lang("Create page", "admin_menu"),
         'link' => '/admin/pages',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ), 
      array(
         'identifier' => 'articles_list',
         'text' =>  lang("Articles list", "admin_menu"),
         'link' => '/admin/pages/GetPagesByCategory',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => true,
         'callback' => '',
      ), 
      array(
         'identifier' => '',
         'text' =>  lang("Custom fields constructor", "admin_menu"),
         'link' => '',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ), 
      array(
         'identifier' => 'fields_list',
         'text' =>  lang("Fields list", "admin_menu"),
         'link' => '/admin/components/cp/cfcm/index#additional_fields',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ), 
      array(
         'identifier' => 'groups_list',
         'text' =>  lang("Groups list ", "admin_menu"),
         'link' => '/admin/components/cp/cfcm/index#fields_groups',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ),
    ),
  ), 
  array(
     'identifier' => 'categories',
     'text' =>  lang("Categories", "admin_menu"),
     'link' => '',
     'class' => '',
     'id' => '',
     'pjax' => '',
     'icon' => 'icon-list',
     'divider' => false,
     'callback' => '',
     'subMenu' => 
    array( 
      array(
         'identifier' => 'new_category',
         'text' =>  lang("Create new", "admin_menu"),
         'link' => '/admin/categories/create_form',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ), 
      array(
         'identifier' => 'categories_list',
         'text' =>  lang("Categories list", "admin_menu"),
         'link' => '/admin/categories/cat_list',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ),
    ),
  ), 
  array(
     'identifier' => 'modules',
     'text' =>  lang("Modules", "admin_menu"),
     'link' => '',
     'class' => '',
     'id' => '',
     'pjax' => '',
     'icon' => 'icon-circle-arrow-down',
     'divider' => false,
     'callback' => '',
     'subMenu' => 
    array( 
      array(
         'identifier' => 'all_modules',
         'text' =>  lang("All modules", "admin_menu"),
         'link' => '/admin/components/modules_table',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ),
    ),
  ), 
  array(
     'identifier' => 'widgets',
     'text' =>  lang("Widgets", "admin_menu"),
     'link' => '',
     'class' => '',
     'id' => '',
     'pjax' => '',
     'icon' => 'icon-th',
     'divider' => false,
     'callback' => '',
     'subMenu' => 
    array( 
      array(
         'identifier' => 'create_widget',
         'text' =>  lang("Create widget", "admin_menu"),
         'link' => '/admin/widgets_manager/create_tpl',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ), 
      array(
         'identifier' => 'widgets_list',
         'text' =>  lang("Widgets list", "admin_menu"),
         'link' => '/admin/widgets_manager',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ),
    ),
  ), 
  array(
     'identifier' => 'system',
     'text' =>  lang("System", "admin_menu"),
     'link' => '',
     'class' => '',
     'id' => '',
     'pjax' => '',
     'icon' => 'icon-hdd',
     'divider' => false,
     'callback' => '',
     'subMenu' => 
    array( 
      array(
         'identifier' => 'global_settings',
         'text' =>  lang("Global settings", "admin_menu"),
         'link' => '/admin/settings',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ), 
      array(
         'identifier' => 'template_editor',
         'text' =>  lang("Template editor", "admin_menu"),
         'link' => '/admin/components/cp/template_editor',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ), 
      array(
         'identifier' => 'languages',
         'text' =>  lang("Languages", "admin_menu"),
         'link' => '/admin/languages',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => true,
         'callback' => '',
      ), 
      array(
         'identifier' => 'events_journal',
         'text' =>  lang("Events journal", "admin_menu"),
         'link' => '/admin/admin_logs',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ), 
      array(
         'identifier' => 'backup',
         'text' =>  lang("Backup", "admin_menu"),
         'link' => '/admin/backup',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ), 
      array(
         'identifier' => 'role_list',
         'text' =>  lang("Roles list", "admin_menu"),
         'link' => '/admin/rbac/roleList',
         'class' => '',
         'id' => '',
         'pjax' => '',
         'icon' => '',
         'divider' => true,
         'callback' => '',
      ), 
      array(
         'identifier' => 'custom_fields',
         'text' =>  lang("Clear cache", "admin_menu"),
         'link' => '',
         'class' => '',
         'id' => 'clearAllCache',
         'pjax' => '',
         'icon' => '',
         'divider' => false,
         'callback' => '',
      ),
    ),
  ),
);