<?php /* Template Name: 社區介紹 */ get_header(); ?>

<style>body { padding-top: 0 !important; }</style>

<div class="site-banner">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pic.jpg" alt="" loading="eager">
</div>

<div class="page-title-bar">
  <div class="container"><h1>社區介紹</h1></div>
</div>

<section class="grid-container">
<?php
  $neighborhoods = [
    'kips-bay'=>'Kips Bay / 基普斯灣','lic'=>'LIC / 長島市','soho'=>'SoHo / 蘇活區',
    'financial-district'=>'Financial District / 金融區','meatpacking-district'=>'Meatpacking District / 屠宰場區',
    'noho'=>'NoHo / 諾霍區','little-italy'=>'Little Italy / 小意大利','chelsea'=>'Chelsea / 切爾西',
    'east-village'=>'East Village / 東村','clinton'=>'Clinton / 克林頓',
    'hells-kitchen'=>"Hell's Kitchen / 地獄廚房",'west-village'=>'West Village / 西村',
    'lower-east-side'=>'Lower East Side / 下東城區','murray-hill'=>'Murray Hill / 莫瑞山',
    'turtle-bay'=>'Turtle Bay / 龜灣','bowery'=>'Bowery / 包厘街',
  ];
  foreach ($neighborhoods as $slug => $label):
    $img = get_template_directory_uri()."/assets/images/{$slug}.jpg";
    $pg  = get_page_by_path($slug);
    $url = $pg ? get_permalink($pg->ID) : '#';
?>
  <a href="<?php echo esc_url($url); ?>" class="grid-item">
    <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($label); ?>" loading="lazy" width="400" height="140"
         onerror="this.src='<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg';">
    <h3><?php echo esc_html($label); ?></h3>
  </a>
<?php endforeach; ?>
</section>

<?php get_footer(); ?>