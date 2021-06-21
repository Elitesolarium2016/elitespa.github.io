<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$loop_style     = zuka_get_theme_loop_prop('loop_style', 1);
$title_tag      = zuka_get_theme_loop_prop('title_tag', 'h3');

$role           = Zuka()->settings()->get_post_meta(get_the_ID(),'role');
$content        = Zuka()->settings()->get_post_meta(get_the_ID(),'content');
$avatar         = Zuka()->settings()->get_post_meta(get_the_ID(),'avatar');
$rating         = Zuka()->settings()->get_post_meta(get_the_ID(),'rating');
$post_class     = array('loop__item', 'grid-item', 'testimonial_item');

?>
<div <?php post_class($post_class)?>>
    <div class="loop__item__inner">
        <div class="loop__item__inner2">
            <div class="loop__item__thumbnail"><?php if($avatar){
                    $avatar_url = wp_get_attachment_image_url($avatar, 'full');
                    ?><div class="loop__item__thumbnail--bkg" style="background-image: url(<?php echo esc_url( $avatar_url ); ?>)" data-background-image="<?php echo esc_url( $avatar_url ); ?>"></div><?php
                } ?></div>
            <div class="loop__item__info">
                <div class="loop__item__info2">
                    <div class="loop__item__desc"><?php echo esc_html($content);?></div>
                    <div class="loop__item__title">
                        <?php printf(
                            '<%1$s class="%4$s">%3$s</%1$s>',
                            esc_attr($title_tag),
                            'javascript:;',
                            get_the_title(),
                            'entry-title'
                        ); ?>
                    </div>
                    <div class="loop__item__meta">
                        <?php
                        if(!empty($role)){
                            printf(
                                '<p class="testimonial_item--role">%s</p>',
                                esc_html($role)
                            );
                        }
                        if(!empty($rating)){
                            printf(
                                '<p class="item--rating"><span class="star-rating"><span style="width: %s"></span></span></p>',
                                esc_attr(absint($rating) * 10) . '%'
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>