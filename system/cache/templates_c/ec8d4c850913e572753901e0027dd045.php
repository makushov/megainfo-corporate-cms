<section class="mini-layout adminSitemap" id="sitemapPriorities">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"><?php echo lang ("Site Map", 'sitemap'); ?></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"><?php echo lang ("Go back", 'admin'); ?></span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#sitemap_priorities_form" data-submit><i class="icon-ok icon-white"></i><?php echo lang ("Save", 'sitemap'); ?></button>
                <div class="p_r d-i_b v-a_m">
                    <button type="button" class="btn btn-small btn-info dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-list"></i>
                        <?php echo lang ('Others', 'sitemap'); ?><span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="right:0;left:auto;">
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
    <form action="/admin/components/cp/sitemap/priorities" id="sitemap_priorities_form" method="post" class="form-horizontal m-t_10">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th><?php echo lang ("Priorities", 'sitemap'); ?></th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="inside_padd">
                            <div class="control-group control-frame-group">
                                <label class="control-label"><?php echo lang ("Main page", 'sitemap'); ?>:</label>
                                <div class="controls">
                                    <div class="star">
                                        <div class="frameRate star-big">
                                            <div class="for_comment" style="width: <?php echo $main_page_priority * 100?>%">
                                                <i><?php echo $main_page_priority?></i>
                                            </div>
                                            <input name="main_page_priority" type="hidden" value="<?php echo $main_page_priority?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group control-frame-group">
                                <label class="control-label"><?php echo lang ("Regular or usual pages", 'sitemap'); ?>:</label>
                                <div class="controls">
                                    <div class="star">
                                        <div class="frameRate star-big">
                                            <div class="for_comment" style="width: <?php echo $pages_priority * 100?>%">
                                                <i><?php echo $pages_priority?></i>
                                            </div>
                                            <input name="pages_priority" type="hidden" value="<?php echo $pages_priority?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang ("Categories pages", 'sitemap'); ?>:</label>
                                <div class="controls">
                                    <div class="star">
                                        <div class="frameRate star-big">
                                            <div class="for_comment" style="width: <?php echo $cats_priority * 100?>%">
                                                <i><?php echo $cats_priority?></i>
                                            </div>
                                            <input name="cats_priority" type="hidden" value="<?php echo $cats_priority?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group control-frame-group">
                                <label class="control-label"><?php echo lang ("Subcategories pages", 'sitemap'); ?>:</label>
                                <div class="controls">
                                    <div class="star">
                                        <div class="frameRate star-big">
                                            <div class="for_comment" style="width: <?php echo $sub_cats_priority * 100?>%">
                                                <i><?php echo $sub_cats_priority?></i>
                                            </div>
                                            <input name="sub_cats_priority" type="hidden" value="<?php echo $sub_cats_priority?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if(SHOP_INSTALLED): ?>
                                <div class="control-group">
                                    <label class="control-label"><?php echo lang ("Products categories pages", 'sitemap'); ?>:</label>
                                    <div class="controls">
                                        <div class="star">
                                            <div class="frameRate star-big">
                                                <div class="for_comment" style="width: <?php echo $products_categories_priority * 100?>%">
                                                    <i><?php echo $products_categories_priority?></i>
                                                </div>
                                                <input name="products_categories_priority" type="hidden" value="<?php echo $products_categories_priority?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group control-frame-group">
                                    <label class="control-label"><?php echo lang ("Products subcategories pages", 'sitemap'); ?>:</label>
                                    <div class="controls">
                                        <div class="star">
                                            <div class="frameRate star-big">
                                                <div class="for_comment" style="width: <?php echo $products_sub_categories_priority * 100?>%">
                                                    <i><?php echo $products_sub_categories_priority?></i>
                                                </div>
                                                <input name="products_sub_categories_priority" type="hidden" value="<?php echo $products_sub_categories_priority?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group control-frame-group">
                                    <label class="control-label"><?php echo lang ("Products pages", 'sitemap'); ?>:</label>
                                    <div class="controls">
                                        <div class="star">
                                            <div class="frameRate star-big">
                                                <div class="for_comment" style="width: <?php echo $products_priority * 100?>%">
                                                    <i><?php echo $products_priority?></i>
                                                </div>
                                                <input name="products_priority" type="hidden" value="<?php echo $products_priority?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group control-frame-group">
                                    <label class="control-label"><?php echo lang ("Brands pages", 'sitemap'); ?>:</label>
                                    <div class="controls">
                                        <div class="star">
                                            <div class="frameRate star-big">
                                                <div class="for_comment" style="width: <?php echo $brands_priority * 100?>%">
                                                    <i><?php echo $brands_priority?></i>
                                                </div>
                                                <input name="brands_priority" type="hidden" value="<?php echo $brands_priority?>"/>
                                            </div>
                                        </div>
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
</section><?php $mabilis_ttl=1426769674; $mabilis_last_modified=1425968236; //application/modules/sitemap/assets/admin/priorities.tpl ?>