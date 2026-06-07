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
  'midtown'              => [ 'en' => 'Midtown',              'zh' => '中城'     ],
  'greenwich-village'    => [ 'en' => 'Greenwich Village',    'zh' => '格林威治村'],
];

// 新社區暫用現有圖片
$img_map = [
  'midtown'           => 'financial-district',
  'greenwich-village' => 'west-village',
];
$img_slug = $img_map[$slug] ?? $slug;

$info  = $neighborhoods[$slug] ?? [ 'en' => $title, 'zh' => '' ];
$map_q = urlencode( $info['en'] . ', New York, NY' );
?>

<style>
/* 這頁專用 */
body { padding-top: 0 !important; background: #fff; }

/* Hero：fixed，z-index 1，JS 控制淡出後完全消失 */
.nb3-hero {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100vh;
  z-index: 1;
  overflow: hidden;
  transition: opacity 0.2s ease;
}
.nb3-hero img { width: 100%; height: 100%; object-fit: cover; display: block; }
.nb3-scroll-hint {
  position: absolute;
  bottom: 2rem; left: 50%;
  transform: translateX(-50%);
  color: #fff; font-size: 2rem;
  animation: nb3-bounce 1.8s infinite;
  text-shadow: 0 2px 8px rgba(0,0,0,0.5);
}
@keyframes nb3-bounce {
  0%,100% { transform: translateX(-50%) translateY(0); }
  50%      { transform: translateX(-50%) translateY(10px); }
}

/* Spacer：height = 100vh，撐開讓內容在滾完 hero 後才出現 */
.nb3-spacer { height: 100vh; }

/* 內容：z-index 2，白底，蓋住 hero */
/* 內容：z-index 2，白底，蓋住 hero */
.nb3-content {
  position: relative;
  z-index: 2;
  background: #fff;
  padding: 0;
  min-height: 100vh;
}

/* 加在這裡 ↓ */
.nb3-full-content ul {
  margin: 0.5rem 0 1rem 0;
  padding-left: 1.2rem;
  color: #444;
  line-height: 1.9;
}
.nb3-full-content li { margin-bottom: 0.4rem; }

</style>

<!-- Hero（fixed，JS 淡出）-->
<div class="nb3-hero" id="nbHero">
  <img src="<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'full') : get_template_directory_uri() . '/assets/images/pic.jpg'; ?>"
       alt="<?php echo esc_attr($info['en']); ?>">
  <div class="nb3-scroll-hint" id="nbArrow">↓</div>
</div>

<!-- Spacer -->
<div class="nb3-spacer"></div>

<!-- 白底內容，z-index 2 蓋住 hero -->
<div class="nb3-content">
  <div class="nb3-grid">

    <aside class="nb3-aside">
      <nav class="nb3-breadcrumb">
        <a href="<?php echo esc_url(home_url()); ?>">紐大房產資訊</a>
        <span class="nb3-bc-sep">›</span>
        <span class="nb3-bc-current"><?php echo esc_html($info['en']); ?></span>
      </nav>

      <div class="nb3-selector">
        <button class="nb3-selector-btn" id="nb3Btn">
          查看更多社區 <span class="nb3-arrow">▾</span>
        </button>
        <ul class="nb3-selector-list">
          <?php foreach ( $neighborhoods as $s => $n ) :
            $pg  = get_page_by_path($s);
            $url = $pg ? get_permalink($pg->ID) : '#';
          ?>
            <li>
              <a href="<?php echo esc_url($url); ?>"
                 class="<?php echo $s === $slug ? 'nb3-list-current' : ''; ?>">
                <span class="nb3-list-en"><?php echo esc_html($n['en']); ?></span>
                <span class="nb3-list-zh"><?php echo esc_html($n['zh']); ?></span>
                <?php if ($s === $slug) echo '<span class="nb3-list-dot">●</span>'; ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </aside>

    <main class="nb3-main">
      <div class="nb3-body nb3-full-content">
        <?php
          while ( have_posts() ) { the_post(); }
          $c = get_the_content();
          echo $c ? apply_filters('the_content', $c)
                  : '<p>這個社區的詳細介紹即將推出，歡迎聯絡我們了解更多資訊。</p>';
        ?>
      </div>
    </main>

    <aside class="nb3-map-col">
      <div class="nb3-map-sticky">
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
(function(){
  var hero  = document.getElementById('nbHero');
  var arrow = document.getElementById('nbArrow');
  var vh    = window.innerHeight;

  function onScroll(){
    var y = window.scrollY;
    // 80%~100% 的 vh 範圍內淡出，超過 100vh 完全消失
    if (y >= vh) {
      hero.style.opacity  = '0';
      hero.style.pointerEvents = 'none';
    } else if (y >= vh * 0.8) {
      var op = 1 - (y - vh * 0.8) / (vh * 0.2);
      hero.style.opacity  = op;
      arrow.style.opacity = op;
      hero.style.pointerEvents = 'none';
    } else {
      hero.style.opacity  = '1';
      arrow.style.opacity = '1';
      hero.style.pointerEvents = '';
    }
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
})();

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