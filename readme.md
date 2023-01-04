# ポートフォリオ概要

Inspiration(インスピレーション)は、アイディアはあるのに実装するスキルがない人が、実装するスキルがある人にアイディアを売ることができるサービス。</br>
ユーザー登録することで、アイディアを売ることも買うこともできる。</br>
また、アイディア購入者は、そのアイディアについて口コミや評価をつけられる。

# 機能一覧

- メールアドレス、パスワードでユーザー登録ができる。</br>
- ログイン</br>
- ログアウト</br>
- 退会機能(論理削除)</br>
- パスワードリマインダーにより、パスワード忘れの際に変更ができる。</br>
- パスワードリセット</br>
- ユーザーのプロフィール編集(メールアドレス、パスワード、自己紹介、アイコン画像の変更)</br>
- ユーザーはアイディアの投稿・購入ができる。</br>
- アイディアの編集・削除ができるが、すでに購入されたアイディアの編集・削除はできない。</br>
- アイディア一覧画面の表示(投稿されたアイディアの詳細ではなく、大まかな概要を表示)また、アイディアのタイトル、概要に書かれた内容で検索をかけることができ、投稿日の新しい順・古い順、価格の   安い順・高い順でソートをかけられる。</br>
- アイディア詳細画面に「気になる」ボタンがあり、それをクリックすると「気になるリスト」に追加される。また、「気になる」ボタンはクリックすると「気になるを解除する」ボタンに表示が切り替わ 　　　  　　　　　　　　  　　   る。</br>
- アイディア詳細画面は購入していれば内容を表示。購入していなければ、口コミ・評価のみ表示される。</br>
- 「購入」ボタンを押すと、アイディアの売り手には自分のアイディアが購入された事、アイディアの買い手にはアイディアを購入したことを伝える内容のメールを送信。</br>
- アイディア購入者のみ口コミと５段階評価を投稿することができ、投稿後に編集もできる。</br>
- 口コミ・５段階評価が投稿されると、アイディアの売り手にメールが送信される。</br>
- 各アイディアには５段階評価の平均点数を表示。</br>
- 自分のアイディアは購入不可。</br>
- Twitterでアイディアを不特定多数の人がシェアできる。</br>

# 画面
- SCSSを使い、FLOCSS設計で記述。</br>
- レスポンシブデザイン・スマホ対応</br>
- アイディア一覧・購入したアイディア一覧・投稿したアイディア一覧・気になるリスト一覧・レビュー一覧はコンポーネントとして設計し、サーバー側からjson形式で受け取ったデータを元にフロント側で   画面表示。


# 使用技術

## フロントエンド

- HTML
- CSS(SCSS使用・FLOCSS設計)
- JavaScript
- jQuery
- Vue.js

## バックエンド

- PHP 7.4.12
- Laravel 5.8.38
- MySQL 8.0.23


