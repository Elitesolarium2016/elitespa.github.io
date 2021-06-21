<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


$header_layout = Zuka()->layout()->get_header_layout();

$mobile_footer_bar       = (Zuka()->settings()->get('enable_header_mb_footer_bar','no') == 'yes') ? true : false;
$mobile_footer_bar_items =  Zuka()->settings()->get('header_mb_footer_bar_component', array());

?>
<?php if( 'yes' == Zuka()->settings()->get('backtotop_btn', 'no') ): ?>
<div class="clearfix">
    <div class="backtotop-container">
        <a href="#page" class="btn-backtotop btn btn-secondary"><span class="fa fa-angle-up"></span></a>
    </div>
</div>
<?php endif; ?>
<?php

    if($header_layout == 6){
        echo '</div><!-- .site-inner -->';
        echo '</div><!-- #page-->';
    }

    Zuka()->layout()->render_footer_tpl();

    if($header_layout != 6){
        echo '</div><!-- .site-inner -->';
        echo '</div><!-- #page-->';
    }
?>
<?php  if($mobile_footer_bar && !empty($mobile_footer_bar_items)): ?>
    <div class="footer-handheld-footer-bar">
        <div class="footer-handheld__inner">
            <?php
            foreach($mobile_footer_bar_items as $component){
                if(isset($component['type'])){
                    echo Zuka_Helper::render_access_component($component['type'], $component, 'handheld_component');
                }
            }
            ?>
        </div>
    </div>
<?php endif; ?>

<?php
do_action('zuka/action/after_render_body');
do_action('zuka/action/footer');
wp_footer();

?>
</body>
</html>
