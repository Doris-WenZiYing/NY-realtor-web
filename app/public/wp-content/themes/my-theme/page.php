<?php
get_header();

$title  = get_the_title();
$crumbs = [
  [ 'url' => home_url(), 'label' => '紐大房產資訊' ],
  [ 'url' => '',         'label' => $title ],
];
?>

<!-- 動畫 CSS + JS 直接內嵌，100% 確保載入 -->
<style>
.sa{opacity:0;transition:opacity .8s ease,transform .8s ease}
.sa:not(.sa-left):not(.sa-right){transform:translateY(35px)}
.sa.sa-left{transform:translateX(-50px)}
.sa.sa-right{transform:translateX(50px)}
.sa.sa-visible{opacity:1!important;transform:none!important}
.sa-d1{transition-delay:.15s}
.sa-d2{transition-delay:.3s}
.sa-d3{transition-delay:.45s}
</style>

<main class="neighborhood-intro-page">

  <nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
      <ul class="breadcrumbs">
        <?php foreach ( $crumbs as $i => $crumb ): ?>
          <li<?php if ( $i === count($crumbs) - 1 ) echo ' class="current"'; ?>>
            <?php if ( $crumb['url'] && $i < count($crumbs) - 1 ): ?>
              <a href="<?php echo esc_url( $crumb['url'] ); ?>"><?php echo esc_html( $crumb['label'] ); ?></a>
            <?php else: ?>
              <?php echo esc_html( $crumb['label'] ); ?>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </nav>

  <section class="intro-layout">
    <div class="intro-image sa sa-left">
      <?php
      $slug    = sanitize_title( $title );
      $img_url = get_template_directory_uri() . "/assets/images/{$slug}.jpg";
      ?>
      <img
        src="<?php echo esc_url( $img_url ); ?>"
        alt="<?php echo esc_attr( $title ); ?>"
        onerror="this.src='/wp-content/themes/<?php echo esc_attr( get_template() ); ?>/assets/images/placeholder.jpg';"
        class="responsive-img"
      >
    </div>
    <div class="intro-text">
      <h1 class="sa sa-d1">歡迎來到 <?php echo esc_html( $title ); ?></h1>
      <?php
      $excerpt = get_the_excerpt();
      if ( $excerpt ) {
        echo '<p class="intro-snippet sa sa-d2">' . esc_html( $excerpt ) . '</p>';
      } else {
        $content = wp_strip_all_tags( get_the_content() );
        $trimmed = wp_trim_words( $content, 30, '…' );
        if ( $trimmed ) echo '<p class="intro-snippet sa sa-d2">' . esc_html( $trimmed ) . '</p>';
      }
      ?>
      <div class="content sa sa-d3">
        <?php while ( have_posts() ) { the_post(); the_content(); } ?>
      </div>
    </div>
  </section>

  <section class="map-section">
    <h2 class="sa">位於 紐約市 <?php echo esc_html( $title ); ?></h2>
    <iframe
      class="sa sa-d1"
      width="100%" height="400" frameborder="0" style="border:0"
      src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q=<?php echo urlencode( "{$title}, New York, NY" ); ?>"
      allowfullscreen>
    </iframe>
  </section>

</main>

<script>
(function(){
  // 稍微延遲確保 DOM 完全就緒
  setTimeout(function(){
    var obs = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if(e.isIntersecting){
          e.target.classList.add('sa-visible');
          obs.unobserve(e.target);
        }
      });
    },{threshold:0.08,rootMargin:'0px 0px -30px 0px'});

    document.querySelectorAll('.sa').forEach(function(el){
      obs.observe(el);
    });
  }, 100);
})();
</script>

<?php get_footer(); ?>