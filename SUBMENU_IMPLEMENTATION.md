# WordPress Theme1 - Horizontal Submenu Implementation

## 概要 (Overview)

Issue #17の要望に基づき、WordPressテーマ「Theme1」に横並びレイアウトのサブメニュー機能を実装しました。

This implementation adds horizontal multi-column submenu functionality to the WordPress Theme1, addressing the requirements specified in Issue #17.

## 🌟 主要機能 (Key Features)

### 1. マルチカラムレイアウト (Multi-Column Layout)
- **設定可能カラム数**: 2〜5カラムまで選択可能
- **レスポンシブ対応**: モバイルでは自動的に縦並びに切り替え
- **CSS Grid使用**: 柔軟で美しいレイアウト

### 2. インタラクション方式 (Interaction Methods)
- **ホバー**: マウスオーバーでサブメニュー展開
- **クリック**: クリックでサブメニュー展開
- **両方**: ホバーとクリック両方に対応
- **アクセシビリティ**: キーボードナビゲーション対応

### 3. アイコンサポート (Icon Support)
- **FontAwesome**: FontAwesome 6.4.0アイコン対応
- **画像アイコン**: カスタム画像アップロード対応
- **全メニュー項目**: メインメニューとサブメニュー両方で利用可能

### 4. WordPressカスタマイザー統合 (WordPress Customizer Integration)
- **サブメニュー設定セクション**: 専用設定パネル
- **既存設定との統合**: メニューアイコン設定の拡張
- **リアルタイムプレビュー**: 設定変更の即座反映

## 📁 実装ファイル (Implementation Files)

### 1. functions.php
- **Navigation Walker拡張**: Theme1_Walker_Nav_Menu クラスの強化
- **カスタマイザー設定**: submenu_settings_section の追加
- **サニタイゼーション関数**: 新しい設定値の検証

### 2. style.css
- **サブメニュースタイル**: .sub-menu, .submenu-horizontal クラス
- **カラムレイアウト**: .submenu-columns-{2-5} クラス
- **レスポンシブCSS**: モバイル対応スタイル
- **アニメーション**: ホバーエフェクトとトランジション

### 3. assets/js/theme.js
- **インタラクション制御**: initSubmenuInteractions() 関数
- **モバイル対応**: デバイス判定とイベント制御
- **設定連携**: PHPからの設定値取得

## 🎨 デザイン特徴 (Design Features)

### ビジュアル要素
- **カードベースデザイン**: 白背景のクリーンなカード
- **ホバーアニメーション**: スムーズなリフトエフェクト
- **カラー統一**: テーマ色（#8b4513）の一貫使用
- **タイポグラフィ**: 日本語対応の美しいフォント

### レスポンシブ対応
- **デスクトップ**: 設定されたカラム数での水平レイアウト
- **モバイル**: アコーディオンスタイルの縦積みレイアウト
- **タッチフレンドリー**: モバイルでの操作性を重視

## 🛠️ 使用方法 (Usage Instructions)

### WordPress管理画面での設定

1. **カスタマイザーアクセス**
   ```
   外観 > カスタマイズ > Submenu Settings
   ```

2. **基本設定**
   - **Submenu Columns**: カラム数選択（2-5）
   - **Submenu Trigger**: トリガー方式選択

3. **メニューアイコン設定**
   ```
   外観 > カスタマイズ > Menu Icons
   ```
   - 各メニュー項目にアイコンを設定
   - サブメニュー項目にもアイコンを設定可能

### メニュー構造の作成

1. **メニュー作成**
   ```
   外観 > メニュー > 新規メニュー作成
   ```

2. **階層構造**
   ```
   親メニュー項目
   ├── サブメニュー項目1
   ├── サブメニュー項目2
   └── サブメニュー項目3
   ```

3. **メニュー位置設定**
   ```
   Primary Menu に割り当て
   ```

## 📱 レスポンシブ動作 (Responsive Behavior)

### デスクトップ（>768px）
- 設定されたカラム数での水平表示
- ホバー/クリックでのサブメニュー展開
- 美しいドロップダウンアニメーション

### モバイル（≤768px）
- 縦積みアコーディオンレイアウト
- タップでサブメニュー展開/収納
- モバイルメニューとの統合

## 🔧 技術仕様 (Technical Specifications)

### CSS Grid Layout
```css
.submenu-horizontal {
    display: grid;
    grid-template-columns: repeat(var(--columns), 1fr);
    gap: 1rem;
}
```

### JavaScript Events
```javascript
// デスクトップ: ホバーイベント
$('.has-submenu').hover(showSubmenu, hideSubmenu);

// モバイル: クリックイベント
$('.has-submenu > a').click(toggleSubmenu);
```

### WordPress Integration
```php
// カスタマイザー設定
$wp_customize->add_setting('submenu_columns', array(
    'default' => '3',
    'sanitize_callback' => 'theme1_sanitize_submenu_columns'
));
```

## 🧪 テスト環境 (Testing)

### ブラウザ対応
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- モバイルブラウザ

### WordPress要件
- WordPress 5.0+
- PHP 7.4+
- jQuery（WordPress標準）

## 📝 今後の拡張予定 (Future Enhancements)

1. **アニメーション効果の追加**
   - フェードイン/アウト
   - スライドイン/アウト

2. **さらなるカスタマイズオプション**
   - サブメニュー幅の調整
   - カスタムカラーオプション

3. **パフォーマンス最適化**
   - CSS/JS の最適化
   - 画像の遅延読み込み

## 📞 サポート (Support)

実装に関する質問や問題がございましたら、GitHubのIssuesでお知らせください。

---

*WordPress Theme1 - Horizontal Submenu Implementation*  
*Version: 1.0.0*  
*Date: 2024*