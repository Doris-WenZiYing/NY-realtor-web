<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header class="site-header">
    <div class="container">
      <a class="logo" href="<?php echo esc_url( home_url() ); ?>">
        紐大房產資訊
      </a>
      <div class="nav-group">
        <nav>
          <ul>
            <li class="has-dropdown">
              <a href="#">買賣・租房 <span class="nav-arrow">▾</span></a>
              <ul class="dropdown">
                <li><a href="#">買房</a></li>
                <li><a href="#">賣房</a></li>
                <li><a href="#">租房</a></li>
              </ul>
            </li>
            <li class="has-dropdown">
              <a href="#">室內設計 <span class="nav-arrow">▾</span></a>
              <ul class="dropdown">
                <li><a href="#">軟裝</a></li>
                <li><a href="#">硬裝</a></li>
                <li><a href="#">傢俱選物</a></li>
              </ul>
            </li>
            <li><a href="#">美國房產資訊</a></li>
            <li><a href="<?php echo esc_url( get_permalink( get_page_by_path('neighborhoods') ) ); ?>">社區介紹</a></li>
            <li><a href="#">提供的服務及流程</a></li>
            <li><a href="<?php echo esc_url( get_permalink( get_page_by_path('about') ) ); ?>">關於我們</a></li>
          </ul>
        </nav>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path('contact') ) ); ?>" class="contact-btn">聯絡我們</a>
      </div>
    </div>
  </header>
