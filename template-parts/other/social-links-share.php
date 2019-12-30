<?php
/**
 * The template part for sharing links on social networks
 *
 * To show social share links in your theme, you can use from this template part.
 *
 * @package    Theme_Name_Name_Space
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */
?>
<!-- search for share link generator in google to have the last versions-->
<div class="msn-social-share">
    <div>
        <strong>Social sharing box</strong>
    </div>
    <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink();?>">facebook</a>
    <a class="twitter" href="https://twitter.com/home?status=<?php echo get_the_permalink();?>">twitter</a>
    <a class="linkdin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_the_permalink();?>&<?php echo get_the_title(); ?>=&summary=&source=">linkdin</a>
    <a class="gmail" href="mailto:info@example.com?&subject=<?php echo get_the_title(); ?>&body=<?php echo get_the_permalink();?>">Gmail</a>
    <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink();?>"><i class="fa fa-facebook"></i></a>
</div>
<hr>
