<!DOCTYPE html>
<html>
    <head>
        <title>Mega CMS</title>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <meta name="description" content="Mega CMS" />
        <meta name="generator" content="megacms">

        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" type="text/css" href="{$THEME}css/font-awesome-4.3.0/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap_complete.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-responsive.css">
        <!--
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-notify.css">
        -->

        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery-ui-1.8.16.custom.css">
        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery.ui.1.8.16.ie.css">

        <link rel="stylesheet" type="text/css" href="{$JS_URL}/elfinder-2.0/css/Aristo/css/Aristo/Aristo.css" media="screen" charset="utf-8">

        <link rel="stylesheet" type="text/css" href="{$JS_URL}/elfinder-2.0/css/elfinder.min.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{$JS_URL}/elfinder-2.0/css/theme.css" media="screen" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{$THEME}js/colorpicker/css/colorpicker.css" media="screen" charset="utf-8">
        <script src="{$THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>

        <link rel="icon" type="image/x-icon" href="{$THEME}images/favicon.png"/>

        <link rel="stylesheet" type="text/css" href="{echo site_url('/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css')}" media="screen" charset="utf-8">
    </head>
    <body>
        {literal}
            <style>
                .megacms-close{cursor: pointer;position: absolute;right: -100px;top: 0;height: 31px;background-color: #4e5a68;width: 95px;display: none;z-index: 3;}
                .megacms-top-fixed-header.megacms-active{height: 31px;background-color: #37414d;}
                .megacms-toggle-close-text{color: #fff;}
                .megacms-top-fixed-header.megacms-active + .main_body header{padding-top: 31px;}
                .megacms-top-fixed-header{height: 0;position: fixed;top: 0;left: 0;width: 100%;font-family: Arial, sans-serif;font-size: 12px;color: #223340;vertical-align: baseline;z-index: 1000}
                .megacms-top-fixed-header .container{position: relative;}
                .megacms-logo{float: left;}
                .megacms-ref-skype, .megacms-phone{font-size: 0;}
                .megacms-phone{margin-right: 32px;}
                .megacms-phone .megacms-text-el{font-size: 12px;color: #fff;}
                .megacms-ref-skype .megacms-text-el{font-size: 12px;color: #fff;}
                .megacms-ref-skype{color: #223340;text-decoration: none;}
                .megacms-ref-skype:hover{color: #223340;text-decoration: none;}
                .megacms-list{list-style: none;margin: 0;float: left;display: none;}
                .megacms-list > li{height: 31px;vertical-align: top;padding: 0 23px;text-align: left;border-right: 1px solid #525f6f;display: inline-block;}
                .megacms-list > li > a{line-height: 31px;}
                .megacms-list > li:first-child{border-left: 1px solid #525f6f;}
                .megacms-ref{color: #fff;text-decoration: none;text-transform: uppercase;font-size: 11px;}
                .megacms-ref:hover{color: #fff;text-decoration: none;}
                .megacms-ico-phone, .megacms-ico-skype{width: auto !important;height: auto !important;position: relative !important;vertical-align: baseline;}
                .megacms-ico-skype{position: relative;top: 3px;margin-right: 10px;}
                .megacms-ico-phone{position: relative;top: 2px;margin-right: 6px;}

                .megacms-contacts{text-align: center;padding-top: 6px;display: none;}


                .megacms-active .megacms-buy-license, .megacms-active .megacms-list, .megacms-active .megacms-contacts{display: block;}
            </style>
        {/literal}
        {include_tpl('inc/javascriptVars')}
        {include_tpl('inc/jsLangs.tpl')}
        {$langDomain = $CI->land->gettext_domain}
        {$CI->lang->load('admin')}
        <div class="main_body">
            <div id="fixPage"></div>
            <!-- Here be notifications -->
            <div class="notifications top-right"></div>
            <header>
                <section class="container">
                    <div class="row-fluid">
                        <div class="span3 left-header">

                            <a href="{if SHOP_INSTALLED}{base_url('admin/components/run/shop/dashboard')}{else:}/admin/dashboard{/if}" class="logo pull-left pjax">
                                <span class="helper"></span>
                                {if MAINSITE}
                                    <img src="{$THEME}img/logo.png"/>
                                {else:}
                                    <img src="{$THEME}img/logo.png"/>
                                {/if}
                            </a>

                        </div>

                        <div class="span6 center-header">
                            <span class="frame-prem frame-prem-header">
                                <span class="helper"></span>
                                <div class="">
                            <div class="frame-prem-site"><a href="{echo rtrim(site_url(),'/')}" target="_blank">{echo rtrim(site_url(),'/')}</a></div>
                                    {if MAINSITE}
                                        <div class="frame-prem-right">
                                            <span class="title d-i_b v-a_m">{echo lang('Balance:', 'admin')}</span>
                                            <span class="f-s_0 d-i_b v-a_m">
                                                <span class="text-el text-c-day">{echo $CI->load->module('mainsaas')->getDaysLeft()}</span>
                                                <span class="text-el text-days">{echo lang('days', 'admin')}</span>
                                            </span>
                                            <a href="{echo $CI->load->module('mainsaas')->getDomainBiling()}/saas/orders/payments" class="icon-plus-tarif-money my_icon"></a>
                                        </div>
                                    {/if}
                                </div>
                            </span>
                        </div>

                        {if $CI->dx_auth->is_logged_in()}
                            <div class="pull-right span3 f-s_0 right-header">
                                <span class="helper"></span>
                                <ul class="d_i-b f-s_0">
                                    {//if MAINSITE}
                                    {if SHOP_INSTALLED}

                                        {if $support_answers_count}
                                            <li>
                                                <a href="#" class="header-badge-count">
                                                    <span class="helper"></span>
                                                    <span class="">
                                                        <span class="icon-badge-count my_icon"></span>
                                                        <span class="text-el">{echo $support_answers_count}</span>
                                                    </span>
                                                </a>
                                            </li>
                                        {/if}
                                        <li class="">
                                            <a href="#" data-drop=".frame-add-info-header">
                                                <span class="helper"></span>
                                                <span class="icon-help"></span>
                                            </a>
                                        </li>
                                    {/if}
                                    {///if}

                                    <li class="dropdown d-i_b v-a_m">
                                        <a data-toggle="dropdown" class="btn-personal-area">
                                            <span class="helper"></span>
                                            <span class="my_icon icon-personal-area"></span>
                                        </a>
                                        {if MAINSITE}
                                            {echo $CI->load->module('mainsaas')->getSaasDropMenu()}
                                        {else:}
                                            <ul class="frame-dropdown dropdown-menu drop_menu_black">
                                                {/*}
                                                <li class="head">
                                                    {if $CI->dx_auth->get_username()}
                                                        {echo $CI->dx_auth->get_username()}
                                                    {else:}
                                                        {echo lang("Guest","admin")}
                                                    {/if}
                                                </li>
                                                { */}
                                                {if $CI->dx_auth->get_username()}
                                                    <li>
                                                        <a href="
                                                           {if SHOP_INSTALLED}/admin/components/run/shop/users/edit/{echo $CI->dx_auth->get_user_id()}
                                                           {else:}/admin/components/cp/user_manager/edit_user/{echo $CI->dx_auth->get_user_id()}
                                                           {/if}"
                                                           id="user_name">
                                                            {lang("Personal data", "admin")}
                                                        </a>
                                                    </li>
                                                {/if}
                                                <li>
                                                    <a href="/auth/logout">
                                                        {lang("Exit", "admin")}
                                                    </a>
                                                </li>
                                            </ul>
                                        {/if}
                                    </li>
                                    <li class="">
                                        <a href="{$BASE_URL}" target="_blank">
                                            <span class="helper"></span>
                                            <span class="my_icon icon-to-the-site"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        {/if}
                    </div>
                </section>
            </header>
            {if MAINSITE}
                <div class="frame-add-info-header" style="display: none;">
                    <div class="container">
                        <button type="button" class="icon-close2" data-closed=".frame-add-info-header"></button>
                        <ul class="items items-add-info">
                            {$contacts = $CI->load->module('mainsaas')->getContacts()}
                            <li class="item-manager">
                                <div class="frame-title f-s_0">
                                    <span class="icon-manager"></span>
                                    <span class="title">{lang('Менеджер', 'admin')}</span>
                                </div>
                                <ul class="items-menu-col">
                                    {if $contacts['addphone2']}
                                        <li>
                                            {echo $contacts['addphone2']}
                                        </li>
                                    {/if}

                                    {if $contacts['addphone1']}
                                        <li>
                                            {echo $contacts['addphone1']}
                                        </li>
                                    {/if}

                                    {if $contacts['addphone3']}
                                        <li>
                                            {echo $contacts['addphone3']}
                                        </li>
                                    {/if}

                                    {if $contacts['siteinfo_mainphone'] && !$contacts['addphone2']}
                                        <li>
                                            {echo $contacts['siteinfo_mainphone']}
                                        </li>
                                    {/if}

                                    {if $contacts['Email']}
                                        <li>
                                            {echo $contacts['Email']}
                                        </li>
                                    {/if}
                                </ul>
                            </li>
                            <li class="item-support">
                                <div class="frame-title f-s_0">
                                    <span class="icon-maintain"></span>
                                    <span class="title">{lang('Служба поддержки', 'admin')}</span>
                                </div>
                                <ul class="items-menu-col">
                                    <li class="f-s_0">
                                        <a href="{echo $CI->load->module('mainsaas')->getDomainBiling()}/saas/support" class="text-el">{lang('Ваши вопросы', 'admin')}</a>
                                        {if $support_answers_count}
                                            <span class="badge-new">
                                                {echo $support_answers_count}
                                            </span>
                                        {/if}
                                    </li>
                                    <li>
                                        <a href="{echo $CI->load->module('mainsaas')->getDomainBiling()}/saas/support/#create-ticket">{lang('Задать вопрос', 'admin')}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="item-instruction">
                                {echo $CI->load->module('mainsaas')->getInstruction()}
                            </li>
                        </ul>
                    </div>
                </div>
            {else: }
                {if SHOP_INSTALLED}
                    <div class="frame-add-info-header full-width" style="{if true == $d_b}display: block{else:}display: none{/if};">
                        <div class="container">
                            <button type="button" class="icon-close2" data-closed=".frame-add-info-header"></button>
                            <ul class="items items-add-info">
                                <li class="item-instruction">
                                    <div class="frame-title f-s_0">
                                        <span class="icon-instr"></span>
                                        <span class="title">{lang('Instructions for filling', 'admin')}</span>
                                    </div>

                                    <ul class="items items-menu-row">
                                        {foreach $CI->load->module('admin/docs')->getPages() as $page}
                                            {if stripos($page->full_url, $active_docs_page)}
                                                <li><span>{truncate($page->title, 25)}</span></li>
                                                    {else:}
                                                <li><a href="{echo $page->full_url}">{truncate($page->title, 25)}</a></li>
                                                {/if}
                                            {/foreach}
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                {/if}
            {/if}

            <!-- Admin Menu  -->
            {echo $CI->load->module('admin_menu')->show()}

            <div id="loading"></div>
            {$CI->lang->load($langDomain)}
            <div class="container" id="mainContent">
                {literal}<script>setTimeout(function () {
                        $('.mini-layout').css('padding-top', $('.frame_title:not(.no_fixed)').outerHeight());
                    }, 0);</script>{/literal}
                        {$content}
                </div>
                {$CI->lang->load('admin')}
                <div class="hfooter"></div>
            </div>
            <footer>
                <div class="container">
                    <div class="row-fluid">
                        <div class="span4">
                            {lang('Interface','admin')}:
                            {echo create_admin_language_select()}
                        </div>
                    </div>
                </div>
            </footer>
            <div id="elfinder"></div>
            <div class="standart_form frame_rep_bug">

            </div>


            <div class="addNotificationMessage modal hide fade">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3>{lang("Report an error","admin")}</h3>
                </div>
                <form class="form-vetical">
                    <div class="modal-body">

                        <div class="control-group">
                            <label class="control-label">
                                {lang('Your Name','admin')}:
                            </label>
                            <div class="controls">
                                <input type=text name="name"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                {lang('Your Email','admin')}:
                            </label>
                            <div class="controls">
                                <input type=text name="email"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                {lang('Your remark', "admin")}:
                            </label>
                            <div class="controls">
                                <textarea name='text'></textarea>
                            </div>
                        </div>
                        <input type="hidden" name='ip' value="{$_SERVER['REMOTE_ADDR']}" id="ip_address"/>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin')}</a>
                        <button type="submit" class="btn btn-primary">{lang("Send","admin")}</button>
                    </div>
                </form>
            </div>


            <script>
                {$settings = $CI->cms_admin->get_settings();}
                var textEditor = '{$settings.text_editor}';
                {if $CI->dx_auth->is_logged_in()}
                var userLogined = true;
                {else:}
                var userLogined = false;
                {/if}
                var locale = '{echo $this->CI->config->item('language')}';
                var base_url = "{site_url()}";
            </script>

            <script src="{$THEME}js/pjax/jquery.pjax.min.js" type="text/javascript"></script>
            <script src="{$THEME}js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
            <script src="{$THEME}js/bootstrap.min.js" type="text/javascript"></script>
            <script async="async" src="{$THEME}js/bootstrap-notify.js" type="text/javascript"></script>
            <script src="{$THEME}js/jquery.form.js" type="text/javascript"></script>

            <script async="async" src="{$THEME}js/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>
            <script async="async" src="{$THEME}js/jquery-validate/jquery.validate.i18n.js" type="text/javascript"></script>

            <script src="{$THEME}js/chosen.js" type="text/javascript"></script>
            <script src="{$THEME}js/jquery.synctranslit.min.js" type="text/javascript"></script>

            <script type="text/javascript" src="{echo site_url('application/third_party/tinymce/tinymce/tinymce.min.js')}"></script>
            <script src="{$THEME}js/functions.js" type="text/javascript"></script>
            <script src="{$THEME}js/scripts.js" type="text/javascript"></script>

            <script type="text/javascript" src="{$JS_URL}/elfinder-2.0/js/elfinder.min.js"></script>

            <script type="text/javascript" src="{echo site_url('/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js')}"></script>

            {if $this->CI->config->item('language') == 'russian'}
                <script async="async" src="{$THEME}js/jquery-validate/messages_ru.js" type="text/javascript"></script>
                <script type="text/javascript" src="{$JS_URL}/elfinder-2.0/js/i18n/elfinder.ru.js"></script>
            {/if}

            <script src="{$THEME}js/admin_base_i.js" type="text/javascript"></script>
            <script src="{$THEME}js/admin_base_m.js" type="text/javascript"></script>
            <script src="{$THEME}js/admin_base_r.js" type="text/javascript"></script>
            <script src="{$THEME}js/admin_base_v.js" type="text/javascript"></script>
            <script src="{$THEME}js/admin_base_y.js" type="text/javascript"></script>

            <script src="{$THEME}js/autosearch.js" type="text/javascript"></script>
            {if MAINSITE}
                <script src="/application/modules/mainsaas/assets/js/mainsaas.js" type="text/javascript"></script>
            {/if}

            <script>
                {if $CI->uri->segment('4') == 'shop'}
                var isShop = true;
                {else:}
                var isShop = false;
                {/if}
                var lang_only_number = "{lang("numbers only","admin")}";
                var show_tovar_text = "{lang("show","admin")}";
                var hide_tovar_text = "{lang("don't show", 'admin')}";
                {literal}

                    $(document).ready(function () {

                        if (!isShop)
                        {
                            $('#shopAdminMenu').hide();
                            //$('#topPanelNotifications').hide();
                        }
                        else
                            $('#baseAdminMenu').hide();
                    })

                    function number_tooltip_live() {
                        $('.number input').each(function () {
                            $(this).attr({
                                'data-placement': 'top',
                                'data-title': lang_only_number
                            });
                        });
                    }
                    function prod_on_off() {
                        $('.prod-on_off').die('click').live('click', function () {
                            var $this = $(this);
                            if (!$this.hasClass('disabled')) {
                                if ($this.hasClass('disable_tovar')) {
                                    $this.animate({
                                        'left': '0'
                                    }, 200).removeClass('disable_tovar');
                                    if ($this.parent().data('only-original-title') == undefined) {
                                        $this.parent().attr('data-original-title', show_tovar_text)
                                        $('.tooltip-inner').text(show_tovar_text);
                                    }
                                    $this.next().attr('checked', true).end().closest('td').next().children().removeClass('disabled').removeAttr('disabled');
                                    if ($this.attr('data-page') != undefined)
                                        $('.setHit, .setHot, .setAction').removeClass('disabled').removeAttr('disabled');
                                }
                                else {
                                    $this.animate({
                                        'left': '-28px'
                                    }, 200).addClass('disable_tovar');
                                    if ($this.parent().data('only-original-title') == undefined) {
                                        $this.parent().attr('data-original-title', hide_tovar_text)
                                        $('.tooltip-inner').text(hide_tovar_text);
                                    }
                                    $this.next().attr('checked', false).end().closest('td').next().children().addClass('disabled').attr('disabled', 'disabled');
                                    if ($this.attr('data-page') != undefined)
                                        $('.setHit, .setHot, .setAction').addClass('disabled').attr('disabled', 'disabled')
                                }
                            }
                        });
                    }
                    $(window).load(function () {
                        number_tooltip_live();
                        prod_on_off();
                    })
                    base_url = '{/literal}{$BASE_URL}';
                        theme_url = '{$THEME}';

                        var elfToken = '{echo $CI->lib_csrf->get_token()}';
                </script>
                {if MAINSITE}
                    <script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" src="https://web.redhelper.ru/service/main.js?c=megacms"/>
                {/if}
                <div id="jsOutput" style="display: none;"></div>
            </body>
        </html>
