<?php
get_header();

// Prepare breadcrumbs
$title  = get_the_title();
$crumbs = [
  [ 'url' => home_url(), 'label' => '紐大房產資訊' ],
  [ 'url' => '',         'label' => $title ],
];
?>

<main class="neighborhood-intro-page">

  <!-- Breadcrumbs -->
  <nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
      <ul class="breadcrumbs">
        <?php foreach ( $crumbs as $i => $crumb ): ?>
          <li<?php if ( $i === count($crumbs) - 1 ) echo ' class="current"'; ?>>
            <?php if ( $crumb['url'] && $i < count($crumbs) - 1 ): ?>
              <a href="<?php echo esc_url( $crumb['url'] ); ?>">
                <?php echo esc_html( $crumb['label'] ); ?>
              </a>
            <?php else: ?>
              <?php echo esc_html( $crumb['label'] ); ?>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </nav>

  <!-- Intro Section -->
  <section class="intro-layout">
    <div class="intro-image">
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
      <h1>歡迎來到 <?php echo esc_html( $title ); ?></h1>

      <?php
      // Excerpt or trimmed content
      $excerpt = get_the_excerpt();
      if ( $excerpt ) {
        echo '<p class="intro-snippet">' . esc_html( $excerpt ) . '</p>';
      } else {
        $content = wp_strip_all_tags( get_the_content() );
        $trimmed = wp_trim_words( $content, 30, '…' );
        echo '<p class="intro-snippet">' . esc_html( $trimmed ) . '</p>';
      }
      ?>

      <div class="content">
        <?php
        while ( have_posts() ) {
          the_post();
          the_content();
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Map Section -->
  <section class="map-section">
    <h2>位於 紐約市 <?php echo esc_html( $title ); ?></h2>
    <iframe
      width="100%" height="400" frameborder="0" style="border:0"
      src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY
           &q=<?php echo urlencode( "{$title}, New York, NY" ); ?>"
      allowfullscreen>
    </iframe>
  </section>

</main>

<?php
get_footer();
