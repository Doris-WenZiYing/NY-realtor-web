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
      <!-- 左側 Logo，無左內邊距 -->
      <div class="logo" href="<?php echo esc_url( home_url() ); ?>">
        紐大房產資訊
      </div>

      <!-- 導航+按鈕 包在同一彈性容器右側 -->
      <div class="nav-group">
        <nav>
          <ul>
            <li><a href="#">租屋</a></li>
            <li><a href="#">賣屋</a></li>
            <li><a href="#">美國房產資訊</a></li>
            <li><a href="#">提供的服務及流程</a></li>
            <li><a href="#">關於我們</a></li>
          </ul>
        </nav>
        <a href="#" class="contact-btn">聯絡我們</a>
      </div>
    </div>
  </header>
