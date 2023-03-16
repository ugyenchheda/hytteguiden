<?php
  $page_banner_image = get_theme_mod( 'page_banner_image', get_template_directory_uri(). '/images/bannerbg.jpg');

  $page_titles =  hytteguiden_page_titles();
?>

<section class="section">
  <div class="page-title" style="background-image: url(<?php echo $page_banner_image; ?>);">
    <div class="container">
      <div class="page-title-color">
        <?php
        if(isset($page_titles) && array_key_exists('title', $page_titles ) ){
          echo '<h1>'. $page_titles['title'] .'</h1>';
        }

        if(isset($page_titles) && array_key_exists('sub_title', $page_titles ) ){
          echo '<h2>'. $page_titles['sub_title'] .'</h2>';
        }

        ?>

      <nav class="breadcrumbs">
        <?php echo hytteguiden_custom_breadcrumbs(); ?>
      </nav>
    </div>
    </div>
  </div>
</section>
