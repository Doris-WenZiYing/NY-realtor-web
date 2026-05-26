<?php
/*
 * Template Name: 社區內頁
 */
get_header();

// 從 slug 取得社區資料
// 正確取得頁面 slug（basename 碰到結尾 / 會出錯）
$slug = get_post_field( 'post_name', get_post() );
$neighborhoods = [
  'kips-bay'             => [ 'name' => 'Kips Bay',           'zh' => '基普斯灣',   'img' => 'kips-bay' ],
  'lic'                  => [ 'name' => 'Long Island City',   'zh' => '長島市',     'img' => 'lic' ],
  'soho'                 => [ 'name' => 'SoHo',               'zh' => '蘇活區',     'img' => 'soho' ],
  'financial-district'   => [ 'name' => 'Financial District', 'zh' => '金融區',     'img' => 'financial-district' ],
  'meatpacking-district' => [ 'name' => 'Meatpacking District','zh' => '屠宰場區',  'img' => 'meatpacking-district' ],
  'noho'                 => [ 'name' => 'NoHo',               'zh' => '諾霍區',     'img' => 'noho' ],
  'little-italy'         => [ 'name' => 'Little Italy',       'zh' => '小意大利',   'img' => 'little-italy' ],
  'chelsea'              => [ 'name' => 'Chelsea',            'zh' => '切爾西',     'img' => 'chelsea' ],
  'east-village'         => [ 'name' => 'East Village',       'zh' => '東村',       'img' => 'east-village' ],
  'clinton'              => [ 'name' => 'Clinton',            'zh' => '克林頓',     'img' => 'clinton' ],
  'hells-kitchen'        => [ 'name' => "Hell's Kitchen",     'zh' => '地獄廚房',   'img' => 'hells-kitchen' ],
  'west-village'         => [ 'name' => 'West Village',       'zh' => '西村',       'img' => 'west-village' ],
  'lower-east-side'      => [ 'name' => 'Lower East Side',   'zh' => '下東城區',   'img' => 'lower-east-side' ],
  'murray-hill'          => [ 'name' => 'Murray Hill',        'zh' => '莫瑞山',     'img' => 'murray-hill' ],
  'turtle-bay'           => [ 'name' => 'Turtle Bay',         'zh' => '龜灣',       'img' => 'turtle-bay' ],
  'bowery'               => [ 'name' => 'Bowery',             'zh' => '包厘街',     'img' => 'bowery' ],
];
$info = $neighborhoods[$slug] ?? [ 'name' => get_the_title(), 'zh' => '', 'img' => $slug ];
$img  = get_template_directory_uri() . '/assets/images/' . $info['img'] . '.jpg';
?>

<!-- ① Hero 全寬圖片（不用動畫，直接顯示）-->
<div class="nb-hero">
  <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($info['name']); ?>">
  <div class="nb-hero-overlay">
    <p class="nb-hero-en"><?php echo esc_html($info['name']); ?></p>
    <h1 class="nb-hero-zh"><?php echo esc_html($info['zh']); ?></h1>
  </div>
</div>

<!-- ② 社區介紹文字（從下淡入）-->
<section class="nb-intro">
  <div class="nb-intro-inner">
    <div class="nb-text sa">
      <h2 class="sa sa-delay-1">關於 <?php echo esc_html($info['name']); ?></h2>
      <div class="sa sa-delay-2">
        <?php
          // 如果 WP 頁面有寫內容就顯示，否則顯示預設說明
          the_content();
          if ( ! get_the_content() ) :
        ?>
          <p>這個社區的詳細介紹即將推出，歡迎聯絡我們了解更多資訊。</p>
        <?php endif; ?>
      </div>
      <a href="<?php echo esc_url( get_permalink( get_page_by_path('contact') ) ); ?>"
         class="nb-cta sa sa-delay-3">預約諮詢 →</a>
    </div>

    <div class="nb-feature-img sa sa-right">
      <img src="<?php echo esc_url($img); ?>"
           alt="<?php echo esc_attr($info['name']); ?>"
           loading="lazy">
    </div>
  </div>
</section>

<!-- ③ 數據區塊（stagger 依序出現）-->
<section class="nb-stats">
  <div class="nb-stats-inner">
    <div class="nb-stat sa sa-delay-1">
      <span class="nb-stat-num">—</span>
      <span class="nb-stat-label">平均房價</span>
    </div>
    <div class="nb-stat sa sa-delay-2">
      <span class="nb-stat-num">—</span>
      <span class="nb-stat-label">出租空置率</span>
    </div>
    <div class="nb-stat sa sa-delay-3">
      <span class="nb-stat-num">—</span>
      <span class="nb-stat-label">步行評分</span>
    </div>
    <div class="nb-stat sa sa-delay-4">
      <span class="nb-stat-num">—</span>
      <span class="nb-stat-label">交通評分</span>
    </div>
  </div>
</section>

<!-- ④ 地圖（淡入）-->
<section class="nb-map sa">
  <div class="nb-map-inner">
    <h2 class="sa">地圖位置</h2>
    <div class="nb-map-frame sa sa-delay-1">
      <iframe
        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD-dummy&q=<?php echo urlencode($info['name'] . ', New York'); ?>"
        allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</section>

<!-- ⑤ 聯絡 CTA（大底部 Banner）-->
<section class="nb-bottom-cta sa sa-fade">
  <div class="nb-bottom-cta-inner">
    <h2 class="sa">對 <?php echo esc_html($info['zh'] ?: $info['name']); ?> 有興趣？</h2>
    <p class="sa sa-delay-1">讓我們的專業顧問為您提供最新的市場資訊與投資建議。</p>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('contact') ) ); ?>"
       class="nb-bottom-btn sa sa-delay-2">立即聯絡我們</a>
  </div>
</section>

<?php get_footer(); ?>