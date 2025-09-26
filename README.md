# クリエット (Crietto)

クリエットは小中学生向けプログラミングスクールの学習管理プラットフォームです。Laravel 10 と Blade をベースに、保護者・生徒・管理者の 3 ロールをサポートし、学習記録や作品管理、出席記録、通知、統計ダッシュボードなどを提供します。

## 主な機能

- **生徒**: My Page でのプロフィール表示、成長記録と作品の投稿・編集・削除、バッジ機能、出席履歴の確認。
- **保護者**: 子どもの成長記録・作品・出席状況の閲覧、通知設定の切り替え。
- **管理者**: 生徒・保護者アカウントの管理、出席記録の管理、学校全体の統計ダッシュボード。

## 技術スタック

- Laravel 10 / PHP 8.1+
- Laravel Breeze 風の認証実装 (Blade)
- MySQL (想定)
- Tailwind CSS (CDN + Vite 設定)
- Laravel Notifications / Storage

## セットアップ

```bash
cp .env.example .env
# 必要に応じて .env を編集し、APP_KEY を生成
php artisan key:generate

# 依存関係のインストール
composer install
npm install
npm run build # or npm run dev

# データベースのマイグレーション・シーディング
php artisan migrate --seed

# 開発サーバーの起動
php artisan serve
```

## テスト

```bash
php artisan test
```

## ライセンス

MIT
