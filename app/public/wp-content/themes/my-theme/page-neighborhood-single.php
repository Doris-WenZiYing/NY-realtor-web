<?php
/*
 * Template Name: 社區內頁
 */
get_header();

$slug  = get_post_field( 'post_name', get_post() );
$title = get_the_title();

$neighborhoods = [
  'kips-bay'             => [ 'en' => 'Kips Bay',             'zh' => '基普斯灣' ],
  'lic'                  => [ 'en' => 'Long Island City',     'zh' => '長島市'   ],
  'soho'                 => [ 'en' => 'SoHo',                 'zh' => '蘇活區'   ],
  'financial-district'   => [ 'en' => 'Financial District',   'zh' => '金融區'   ],
  'meatpacking-district' => [ 'en' => 'Meatpacking District', 'zh' => '屠宰場區' ],
  'noho'                 => [ 'en' => 'NoHo',                 'zh' => '諾霍區'   ],
  'little-italy'         => [ 'en' => 'Little Italy',         'zh' => '小意大利' ],
  'chelsea'              => [ 'en' => 'Chelsea',              'zh' => '切爾西'   ],
  'east-village'         => [ 'en' => 'East Village',         'zh' => '東村'     ],
  'clinton'              => [ 'en' => 'Clinton',              'zh' => '克林頓'   ],
  'hells-kitchen'        => [ 'en' => "Hell's Kitchen",       'zh' => '地獄廚房' ],
  'west-village'         => [ 'en' => 'West Village',         'zh' => '西村'     ],
  'lower-east-side'      => [ 'en' => 'Lower East Side',      'zh' => '下東城區' ],
  'murray-hill'          => [ 'en' => 'Murray Hill',          'zh' => '莫瑞山'   ],
  'turtle-bay'           => [ 'en' => 'Turtle Bay',           'zh' => '龜灣'     ],
  'bowery'               => [ 'en' => 'Bowery',               'zh' => '包厘街'   ],
];

$info  = $neighborhoods[$slug] ?? [ 'en' => $title, 'zh' => '' ];
$img   = get_template_directory_uri() . '/assets/images/pic.jpg';
$map_q = urlencode( $info['en'] . ', New York, NY' );
?>

<!-- Hero：正常在頁面流裡，高度 = 視窗高度 - header 高度 -->
<div class="nb3-hero">
  <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($info['en']); ?>">
  <div class="nb3-scroll-hint">↓</div>
</div>

<!-- 內容：白底，跟在 hero 下面，往下滑自然蓋住 hero -->
<div class="nb3-content">
  <div class="nb3-grid">

    <!-- 左欄：breadcrumb + 社區選單 -->
    <aside class="nb3-aside">
      <nav class="nb3-breadcrumb sa">
        <a href="<?php echo esc_url(home_url()); ?>">紐大房產資訊</a>
        <span>›</span>
        <span class="nb3-bc-current"><?php echo esc_html($info['en']); ?></span>
      </nav>

      <div class="nb3-selector sa sa-delay-1">
        <button class="nb3-selector-btn" id="nb3Btn">
          查看更多社區 <span class="nb3-arrow">▾</span>
        </button>
        <ul class="nb3-selector-list" id="nb3List">
          <?php foreach ( $neighborhoods as $s => $n ) :
            $pg  = get_page_by_path($s);
            $url = $pg ? get_permalink($pg->ID) : '#';
          ?>
            <li class="<?php echo $s === $slug ? 'nb3-active' : ''; ?>">
              <a href="<?php echo esc_url($url); ?>">
                <?php if ($s === $slug) echo '<span class="nb3-dot">●</span> '; ?>
                <?php echo esc_html($n['en'] . ' / ' . $n['zh']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </aside>

    <!-- 中欄：主內容 -->
    <main class="nb3-main">
      <div class="nb3-section sa">
        <h2><?php echo esc_html($info['en']); ?> 社區介紹</h2>
        <div class="nb3-divider"></div>
        <div class="nb3-body sa sa-delay-1">
          <?php
            while ( have_posts() ) { the_post(); }
            $c = get_the_content();
            echo $c ? apply_filters('the_content', $c) : '<p>這個社區的詳細介紹即將推出，歡迎聯絡我們了解更多資訊。</p>';
          ?>
        </div>
      </div>

      <div class="nb3-section sa">
        <h2><?php echo esc_html($info['en']); ?> 社區前景</h2>
        <div class="nb3-divider"></div>
        <div class="nb3-body sa sa-delay-1">
          <p>市場分析與未來發展潛力即將更新，請持續關注。</p>
        </div>
      </div>
    </main>

    <!-- 右欄：黏性地圖 -->
    <aside class="nb3-map-col">
      <div class="nb3-map-sticky sa">
        <p class="nb3-map-label">在地圖上查看</p>
        <iframe
          src="https://maps.google.com/maps?q=<?php echo $map_q; ?>&output=embed&z=15"
          allowfullscreen loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </aside>

  </div>
</div>

<script>
document.getElementById('nb3Btn').addEventListener('click', function(e){
  e.stopPropagation();
  document.querySelector('.nb3-selector').classList.toggle('open');
});
document.addEventListener('click', function(){
  var s = document.querySelector('.nb3-selector');
  if (s) s.classList.remove('open');
});
</script>

<?php get_footer(); ?>