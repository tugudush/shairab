<?php
/*
** Template to Render contact info in topbar
*/
?>

<ul class="top_contact_info">
  <?php if( '' !== get_theme_mod('head_email')){ ?>
  <li class="top_header_mail"><a href="mailto:<?php echo sanitize_email(get_theme_mod('head_email','info@blogera.com')); ?>"><span class="genericon genericon-mail"></span> &nbsp; <?php echo esc_attr(get_theme_mod('head_email','info@blogera.com')); ?></a></li>
  <?php } ?>
  <?php if( '' !== get_theme_mod('head_number')){ ?>
  <li class="top_header_phone"><span class="genericon genericon-handset"></span> &nbsp; <?php echo esc_attr( get_theme_mod('head_number', '0978 456 321', 'blogera' )); ?></li>
  <?php } ?>
  <li class="blogera_date">
    <?php blogera_date_display(); ?>
  </li>
</ul>
