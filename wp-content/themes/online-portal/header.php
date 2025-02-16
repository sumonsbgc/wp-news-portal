<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>

<body class="">
  <header>
    <nav class="container">
      <div>
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <?php
          if (has_custom_logo()) {
            echo get_custom_logo();
          } else {
            printf("<img class=\"img-fluid\" src=\"%s\">", esc_url(get_theme_file_uri('assets/images/logo.png')));
          }
          ?>
        </a>
      </div>
    </nav>
  </header>