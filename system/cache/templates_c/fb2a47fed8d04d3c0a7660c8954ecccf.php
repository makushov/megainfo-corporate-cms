<div class="frame-inside">
    <div class="container">
        <div class="frame-crumbs">
            <?php echo widget ('path'); ?>
        </div>
        <div class="clearfix">
            <div class="text left">
                <h1><?php echo $page['title']; ?></h1>
                <!-- Start. Show banner. -->
                <?php $CI->load->module('banners')->render()?>
                <!-- End. Show banner. -->
                <div class="description">
                    <?php echo $page['full_text']; ?>
                </div>
                <?php $Comments = $CI->load->module('comments')->init($page)?>

                <script type="text/javascript">
                        $(function() {
                            renderPosts($('.for_comments'));
                        })
                    
                </script>
                <div id="comment">
                    <div class="for_comments"></div>
                </div>
            </div>
            <div class="right">
                <?php echo widget ('news'); ?>
            </div>
        </div>
    </div>
</div><?php $mabilis_ttl=1425720900; $mabilis_last_modified=1425473714; ///Applications/MAMP/htdocs/imagecms/templates/corporate/page_full.tpl ?>