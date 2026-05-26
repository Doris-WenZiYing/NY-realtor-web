<?php
/*
 * Template Name: 聯絡我們
 */

// ── 註冊 Custom Post Type（只跑一次，掛在 init）──
add_action( 'init', function() {
  register_post_type( 'inquiry', [
    'labels' => [
      'name'               => '詢問表單',
      'singular_name'      => '詢問紀錄',
      'menu_name'          => '詢問表單',
      'all_items'          => '所有詢問',
      'view_item'          => '查看詢問',
      'search_items'       => '搜尋詢問',
      'not_found'          => '找不到詢問紀錄',
    ],
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_icon'           => 'dashicons-email-alt',
    'supports'            => [ 'title' ],
    'capability_type'     => 'post',
    'map_meta_cap'        => true,
  ]);
});

get_header();

// ── 表單送出處理 ──
$sent  = false;
$error = '';

if ( isset($_POST['contact_nonce']) && wp_verify_nonce($_POST['contact_nonce'], 'contact_form') ) {
  $fields = [
    'name'     => sanitize_text_field(     $_POST['contact_name']     ?? '' ),
    'phone_cc' => sanitize_text_field(     $_POST['contact_phone_cc'] ?? '' ),
    'phone'    => sanitize_text_field(     $_POST['contact_phone']    ?? '' ),
    'email'    => sanitize_email(          $_POST['contact_email']    ?? '' ),
    'industry' => sanitize_text_field(     $_POST['contact_industry'] ?? '' ),
    'channel'  => sanitize_text_field(     $_POST['contact_channel']  ?? '' ),
    'session'  => sanitize_text_field(     $_POST['contact_session']  ?? '' ),
    'city'     => sanitize_text_field(     $_POST['contact_city']     ?? '' ),
    'budget'   => sanitize_text_field(     $_POST['contact_budget']   ?? '' ),
    'timeline' => sanitize_text_field(     $_POST['contact_timeline'] ?? '' ),
    'message'  => sanitize_textarea_field( $_POST['contact_message']  ?? '' ),
    'agreed'   => isset( $_POST['contact_agree'] ),
  ];

  if ( $fields['name'] && $fields['email'] && $fields['budget'] && $fields['timeline'] && $fields['agreed'] ) {

    // 存進資料庫
    $post_id = wp_insert_post([
      'post_type'   => 'inquiry',
      'post_title'  => $fields['name'] . ' — ' . current_time('Y/m/d H:i'),
      'post_status' => 'publish',
    ]);

    if ( $post_id ) {
      $meta = [
        '姓名'         => $fields['name'],
        '手機'         => '+' . $fields['phone_cc'] . ' ' . $fields['phone'],
        'Email'        => $fields['email'],
        '產業'         => $fields['industry'],
        '得知管道'     => $fields['channel'],
        '預約場次'     => $fields['session'],
        '有興趣社區'   => $fields['city'],
        '預算（美金）' => $fields['budget'],
        '購買時程'     => $fields['timeline'],
        '置產需求'     => $fields['message'],
        '送出時間'     => current_time('Y-m-d H:i:s'),
        '來源IP'       => $_SERVER['REMOTE_ADDR'] ?? '',
      ];
      foreach ( $meta as $key => $val ) {
        update_post_meta( $post_id, $key, $val );
      }

      // 同時寄通知信到管理員 email
      $to      = get_option('admin_email');
      $subject = '【紐大房產】新詢問 — ' . $fields['name'];
      $body    = '';
      foreach ( $meta as $key => $val ) {
        $body .= "{$key}：{$val}\n";
      }
      wp_mail( $to, $subject, $body, [ 'Reply-To: ' . $fields['name'] . ' <' . $fields['email'] . '>' ] );

      $sent = true;
    } else {
      $error = '儲存失敗，請稍後再試。';
    }

  } else {
    $error = '請填寫所有必填欄位，並勾選同意聲明。';
  }
}
?>

<section class="contact-section">
  <div class="contact-inner">

    <div class="contact-info">
      <h2>聯絡我們</h2>
      <p>歡迎透過表單與我們聯繫，我們將盡快回覆您的詢問。</p>
      <ul class="contact-details">
        <li>📧 <a href="mailto:info@lvrealty168.com">info@lvrealty168.com</a></li>
        <li>📞 +1 (212) 000-0000</li>
        <li>📍 New York, NY, USA</li>
      </ul>
    </div>

    <div class="contact-form-wrap">
      <?php if ( $sent ) : ?>
        <div class="form-success">✅ 已收到您的資料，我們將盡快與您聯繫！</div>
      <?php else : ?>
        <?php if ( $error ) : ?>
          <div class="form-error">⚠️ <?php echo esc_html( $error ); ?></div>
        <?php endif; ?>

        <form class="contact-form" method="post" action="">
          <?php wp_nonce_field('contact_form', 'contact_nonce'); ?>

          <div class="form-row full">
            <label>姓名 * <span class="form-hint">（請填寫出席者的中文全名，採實名制預約）</span></label>
            <input type="text" name="contact_name" required>
          </div>

          <div class="form-grid-2">
            <div class="form-row">
              <label>手機 *</label>
              <div class="phone-wrap">
                <input type="text" name="contact_phone_cc" value="886" class="phone-cc">
                <span class="phone-divider"></span>
                <input type="tel" name="contact_phone" placeholder="0912 345 678" class="phone-num" required>
              </div>
            </div>
            <div class="form-row">
              <label>電子郵件 *</label>
              <input type="email" name="contact_email" required>
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-row">
              <label>產業 *</label>
              <select name="contact_industry" required>
                <option value="" disabled selected>請選擇</option>
                <option>科技業</option><option>金融業</option><option>醫療業</option>
                <option>房地產</option><option>製造業</option><option>教育業</option>
                <option>自由業</option><option>其他</option>
              </select>
            </div>
            <div class="form-row">
              <label>您從哪個管道得知我們？*</label>
              <select name="contact_channel" required>
                <option value="" disabled selected>請選擇</option>
                <option>Facebook</option><option>Instagram</option><option>YouTube</option>
                <option>Line</option><option>Google 搜尋</option>
                <option>朋友介紹</option><option>講座活動</option><option>其他</option>
              </select>
            </div>
          </div>

          <div class="form-section-title">置產需求</div>

          <div class="form-grid-2">
            <div class="form-row">
              <label>方便聯絡時間 *</label>
              <select name="contact_session" required>
                <option value="" disabled selected>請選擇時段</option>
                <option>09:00 – 10:00</option>
                <option>10:00 – 11:00</option>
                <option>11:00 – 12:00</option>
                <option>12:00 – 13:00</option>
                <option>13:00 – 14:00</option>
                <option>14:00 – 15:00</option>
                <option>15:00 – 16:00</option>
                <option>16:00 – 17:00</option>
                <option>17:00 – 18:00</option>
                <option>18:00 – 19:00</option>
                <option>19:00 – 20:00</option>
                <option>20:00 – 21:00</option>
                <option>21:00 – 22:00</option>
              </select>
            </div>
            <div class="form-row">
              <label>有興趣的社區 *</label>
              <select name="contact_city" required>
                <option value="" disabled selected>請選擇社區</option>
                <option>Kips Bay / 基普斯灣</option>
                <option>LIC / 長島市</option>
                <option>SoHo / 蘇活區</option>
                <option>Financial District / 金融區</option>
                <option>Meatpacking District / 屠宰場區</option>
                <option>NoHo / 諾霍區</option>
                <option>Little Italy / 小意大利</option>
                <option>Chelsea / 切爾西</option>
                <option>East Village / 東村</option>
                <option>Clinton / 克林頓</option>
                <option>Hell's Kitchen / 地獄廚房</option>
                <option>West Village / 西村</option>
                <option>Lower East Side / 下東城區</option>
                <option>Murray Hill / 莫瑞山</option>
                <option>Turtle Bay / 龜灣</option>
                <option>Bowery / 包厘街</option>
              </select>
            </div>
          </div>

          <div class="form-row full">
            <label>預算（美金）*</label>
            <div class="radio-group">
              <?php foreach ( ['70萬','150萬','200萬','250萬','300萬','300萬以上'] as $b ) : ?>
                <label class="radio-label">
                  <input type="radio" name="contact_budget" value="<?php echo esc_attr($b); ?>" required>
                  <?php echo esc_html($b); ?>
                </label>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="form-row full">
            <label>計劃購買時程 *</label>
            <div class="radio-group">
              <?php foreach ( ['3個月內','1年內','1年以上','尚未決定'] as $t ) : ?>
                <label class="radio-label">
                  <input type="radio" name="contact_timeline" value="<?php echo esc_attr($t); ?>" required>
                  <?php echo esc_html($t); ?>
                </label>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="form-row full">
            <label>置產需求或問題</label>
            <textarea name="contact_message" rows="4" placeholder="請說明您的需求..."></textarea>
          </div>

          <div class="form-row full form-agree">
            <label class="checkbox-label">
              <input type="checkbox" name="contact_agree" required>
              我已閱讀並同意本公司依隱私政策使用我的相關資訊。*
            </label>
          </div>

          <button type="submit" class="form-submit">送出資料</button>
        </form>
      <?php endif; ?>
    </div>

  </div>
</section>

<?php get_footer(); ?>