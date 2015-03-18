<section class="mini-layout adminSitemap">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"><?php echo lang ("Site Map", 'sitemap'); ?></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/sitemap/priorities" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"><?php echo lang ("Back", 'admin'); ?></span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#sitemap_settings_form" data-submit><i class="icon-ok icon-white"></i><?php echo lang ("Save", 'sitemap'); ?></button>
                <div class="p_r d-i_b v-a_m">
                    <button type="button" class="btn btn-small btn-info dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-list"></i>
                        <?php echo lang ('Others', 'sitemap'); ?><span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu sds" role="menu" style="right:0;left:auto;">
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/priorities"><?php echo lang ('Priorities', 'sitemap'); ?></a></li>
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/changefreq"><?php echo lang ('Change frequency', 'sitemap'); ?></a></li>
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/blockedUrls"><?php echo lang ('Block urls', 'sitemap'); ?></a></li>
                        <li class="divider"></li>
                        <li><a style="text-decoration: none" href="<?php echo site_url ('sitemap.xml'); ?>" target="_blank"><?php echo lang ("View Site Map", 'sitemap'); ?></a></li>
                        <li class="divider"></li>
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/settings"><?php echo lang ('Settings', 'sitemap'); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form action="/admin/components/cp/sitemap/settings" id="sitemap_settings_form" method="post" class="form-horizontal m-t_10">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
                <th><?php echo lang ("Settings", 'sitemap'); ?></th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="inside_padd">

                            <div class="control-group">
                                <label class="control-label" for="comcount"><?php echo lang ("Return sitemap parameter", 'sitemap'); ?>:</label>
                                <div class="controls number">
                                    <select style="width: 350px" name="settings[generateXML]" onchange="SiteMap.showHideSavedInformation($(this))">
                                        <option value="1" <?php if($settings['generateXML']): ?>selected="selected"<?php endif; ?>><?php echo lang ('Generate an updated map at the entrance to the robot', 'sitemap'); ?></option>
                                        <option value="0" <?php if(! $settings['generateXML']): ?>selected="checked"<?php endif; ?>><?php echo lang ('Give robots a saved version of the map', 'sitemap'); ?></option>
                                    </select>
                                    <div class="savedSitemap m-t_5" style="<?php if($settings['generateXML']): ?>display: none<?php endif; ?>">
                                        <?php if($fileSiteMapData): ?>
                                        <div>
                                            <a href="<?php echo site_url('admin/components/init_window/sitemap/sitemapDownload')?>"><?php echo lang ('Saved Site Map', 'sitemap'); ?></a>
                                            <b>&nbsp;&nbsp;&nbsp;<?php echo lang ('Created at', 'sitemap'); ?>:</b> <?php echo date('Y-m-d  H:i', $fileSiteMapData['time'])?>, <b><?php echo lang ('Size', 'sitemap'); ?>:</b> <?php echo number_format($fileSiteMapData['size']/1024, 2)?> <?php echo lang ('Kb', 'sitemap'); ?>
                                        </div>
                                        <?php else:?>
                                        <div>
                                            <span class="help-block"><?php echo lang ('There is no saved Site Map.', 'sitemap'); ?></span>
                                        </div>
                                        <?php endif; ?>
                                        <button type="button" onclick="SiteMap.saveSiteMap()" class="btn btn-small btn-default m-t_15">
                                            <?php if($fileSiteMapData): ?>
                                            <i class="icon-refresh"></i>
                                            <?php echo lang ("Update", 'sitemap'); ?>
                                            <?php else:?>
                                            <i class="icon-ok"></i>
                                            <?php echo lang ("Save", 'sitemap'); ?>
                                            <?php endif; ?>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!--div class="control-group">
                                <label class="control-label" for="comcount"><?php echo lang ("Turn ON/OFF robots", 'sitemap'); ?>:</label>
                                <div class="controls">
                                    <div class="frame_prod-on_off">
                                        <span class="prod-on_off<?php if(! $settings['robotsStatus']): ?> disable_tovar<?php endif; ?>"></span>
                                        <input type="hidden" name="settings[robotsStatus]" value="<?php if($settings['robotsStatus']): ?>1<?php else:?>0<?php endif; ?>" data-val-on="1" data-val-off="0">
                                    </div>
                                </div>
                            </div-->

                            <div class="control-group">
                                <label class="control-label" for="comcount"><?php echo lang ("Report changes in the site map to search engines", 'sitemap'); ?>:</label>
                                <div class="controls">
                                    <div class="frame_prod-on_off">
                                        <span class="prod-on_off<?php if(! $settings['sendSiteMap']): ?> disable_tovar<?php endif; ?>"></span>
                                        <input type="hidden" name="settings[sendSiteMap]" value="<?php if($settings['sendSiteMap']): ?>1<?php else:?>0<?php endif; ?>" data-val-on="1" data-val-off="0">
                                    </div>
                                </div>
                            </div>

                            <!--div class="control-group">
                                <label class="control-label" for="comcount"><?php echo lang ("Send Site Map only when page url is changed", 'sitemap'); ?>:</label>
                                <div class="controls">
                                    <div class="frame_prod-on_off">
                                        <span class="prod-on_off<?php if(! $settings['sendWhenUrlChanged']): ?> disable_tovar<?php endif; ?>"></span>
                                        <input type="hidden" name="settings[sendWhenUrlChanged]" value="<?php if($settings['sendWhenUrlChanged']): ?>1<?php else:?>0<?php endif; ?>" data-val-on="1" data-val-off="0">
                                    </div>
                                </div>
                            </div-->

                            <?php if($settings['lastSend']): ?>
                            <div class="control-group">
                                <label class="control-label" for="comcount"><?php echo lang ("Last send Site Map time", 'sitemap'); ?>:</label>
                                <div class="controls number">
                                    <input type="text" readonly="readonly" value="<?php echo date('Y-m-d  H:i:s',  $settings['lastSend'] ) ?>">
                                    <input type="hidden" name="settings[lastSend]" value="<?php echo  $settings['lastSend']  ?>">
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="control-group">
                                <span class="control-label">&nbsp;</span>
                                <div class="controls">
                                    <a class="btn btn-default" href="<?php echo site_url ('sitemap.xml'); ?>" target="_blank"><?php echo lang ("View code", 'sitemap'); ?></a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php echo form_csrf (); ?>
    </form>
</section><?php $mabilis_ttl=1426769686; $mabilis_last_modified=1425968236; //application/modules/sitemap/assets/admin/settings.tpl ?>