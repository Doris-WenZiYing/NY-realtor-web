<?php get_header(); ?>

<style>body { padding-top: 0 !important; }</style>

<div class="site-banner">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Banner.jpg"
       alt="" loading="eager">
</div>

<section class="about-home">
  <div class="about-home-inner">
    <div class="about-home-text">
      <h2>關於紐大房產資訊</h2>
      <p class="about-lead">我們是專注於美國紐約房地產市場的專業顧問團隊，提供買房、賣屋、租賃及室內設計一站式服務。</p>
      <p>憑藉多年在紐約各社區的深耕經驗，我們協助台灣及海外客戶在複雜的美國不動產市場中找到最適合的投資與居住方案。</p>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('about') ) ); ?>" class="about-more-btn">了解更多 →</a>
    </div>
    <div class="about-home-image">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/financial-district.jpg"
           alt="紐約" loading="lazy">
    </div>
  </div>
</section>

<?php get_footer(); ?>