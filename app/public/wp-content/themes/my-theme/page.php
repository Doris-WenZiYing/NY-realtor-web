<?php
get_header();
$title   = get_the_title();
$slug    = sanitize_title($title);
$img_url = get_template_directory_uri() . "/assets/images/{$slug}.jpg";
$fallback= get_template_directory_uri() . '/assets/images/pic.jpg';
?>

<style>
.sa{opacity:0;transition:opacity .8s ease,transform .8s ease}
.sa:not(.sa-left):not(.sa-right){transform:translateY(35px)}
.sa.sa-left{transform:translateX(-50px)}
.sa.sa-right{transform:translateX(50px)}
.sa.sa-visible{opacity:1!important;transform:none!important}
.sa-d1{transition-delay:.15s}.sa-d2{transition-delay:.3s}.sa-d3{transition-delay:.45s}
</style>

<div class="site-banner">
  <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>"
       onerror="this.src='<?php echo esc_url($fallback); ?>';" loading="eager">
</div>

<main>
  <nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
      <ul class="breadcrumbs">
        <li><a href="<?php echo esc_url(home_url()); ?>">紐大房產資訊</a></li>
        <li class="current"><?php echo esc_html($title); ?></li>
      </ul>
    </div>
  </nav>

  <section class="intro-layout">
    <div class="intro-image sa sa-left">
      <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>"
           onerror="this.src='<?php echo esc_url($fallback); ?>';" class="responsive-img">
    </div>
    <div class="intro-text">
      <h1 class="sa sa-d1">歡迎來到 <?php echo esc_html($title); ?></h1>
      <?php
      $excerpt = get_the_excerpt();
      if ($excerpt) echo '<p class="intro-snippet sa sa-d2">'.esc_html($excerpt).'</p>';
      ?>
      <div class="content sa sa-d3">
        <?php while (have_posts()) { the_post(); the_content(); } ?>
      </div>
    </div>
  </section>

  <section class="map-section">
    <h2 class="sa">位於 紐約市 <?php echo esc_html($title); ?></h2>
    <iframe class="sa sa-d1" width="100%" height="400" frameborder="0" style="border:0"
      src="https://maps.google.com/maps?q=<?php echo urlencode($title.', New York, NY'); ?>&output=embed&z=15"
      allowfullscreen loading="lazy"></iframe>
  </section>
</main>

<script>
(function(){
  setTimeout(function(){
    var obs=new IntersectionObserver(function(e){e.forEach(function(i){if(i.isIntersecting){i.target.classList.add('sa-visible');obs.unobserve(i.target);}});},{threshold:0.08});
    document.querySelectorAll('.sa').forEach(function(el){obs.observe(el);});
  },100);
})();
</script>

<?php get_footer(); ?>