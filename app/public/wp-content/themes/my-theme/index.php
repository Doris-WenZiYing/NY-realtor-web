<?php get_header(); ?>

<section class="banner">
  <img
    src="<?php echo get_template_directory_uri(); ?>/assets/images/banner.jpg"
    alt="Banner"
    loading="eager"
  >
</section>

<section class="grid-container">
  <?php
    $neighborhoods = [
      'kips-bay'             => 'Kips Bay / 基普斯灣',
      'lic'                  => 'LIC / 長島市',
      'soho'                 => 'SoHo / 蘇活區',
      'financial-district'   => 'Financial District / 金融區',
      'meatpacking-district' => 'Meatpacking District / 屠宰場區',
      'noho'                 => 'NoHo / 諾霍區',
      'little-italy'         => 'Little Italy / 小意大利',
      'chelsea'              => 'Chelsea / 切爾西',
      'east-village'         => 'East Village / 東村',
      'clinton'              => 'Clinton / 克林頓',
      'hells-kitchen'        => "Hell's Kitchen / 地獄廚房",
      'west-village'         => 'West Village / 西村',
      'lower-east-side'      => 'Lower East Side / 下東城區',
      'murray-hill'          => 'Murray Hill / 莫瑞山',
      'turtle-bay'           => 'Turtle Bay / 龜灣',
      'bowery'               => 'Bowery / 包厘街',
    ];

    foreach ( $neighborhoods as $slug => $label ) :
      $img_url = get_template_directory_uri() . "/assets/images/{$slug}.jpg";
      $page    = get_page_by_path( $slug );
      $url     = $page ? get_permalink( $page->ID ) : '#';
  ?>
    <a href="<?php echo esc_url( $url ); ?>" class="grid-item">
      <img
        src="<?php echo esc_url( $img_url ); ?>"
        alt="<?php echo esc_attr( $label ); ?>"
        loading="lazy"
        width="400"
        height="140"
        onerror="this.src='/wp-content/themes/<?php echo esc_attr( get_template() ); ?>/assets/images/placeholder.jpg';"
      >
      <h3><?php echo esc_html( $label ); ?></h3>
    </a>
  <?php endforeach; ?>
</section>

<?php get_footer(); ?>