# ポートフォリオ概要

Inspiration(インスピレーション)は、アイディアはあるのに実装するスキルがない人が、実装するスキルがある人にアイディアを売ることができるサービス。</br>
ユーザー登録することで、アイディアを売ることも買うこともできる。</br>
また、アイディア購入者は、そのアイディアについて口コミや評価をつけられる。

# 機能一覧

- メールアドレス、パスワードでユーザー登録ができる。
- ログイン
- ログアウト
- 退会機能
- パスワードリマインダーにより、パスワード忘れの際に変更ができる。
- パスワードリセット
- ユーザーのプロフィール編集(メールアドレス、パスワード、自己紹介、アイコン画像の変更)
- ユーザーはアイディアの投稿・購入ができる。
<img width="1281" alt="スクリーンショット 2023-01-05 22 01 33" src="https://user-images.githubusercontent.com/82641385/210786201-896fbee7-f3e9-412a-b44d-21f673846638.png">

- アイディアの編集・削除ができるが、すでに購入されたアイディアの編集・削除はできない。
- アイディア一覧画面の表示(投稿されたアイディアの詳細ではなく、大まかな概要を表示)また、アイディアのタイトル、概要に書かれた内容で検索をかけることができ、投稿日の新しい順・古い順、価格の   安い順・高い順でソートをかけられる。
<img width="1277" alt="スクリーンショット 2023-01-05 22 04 41" src="https://user-images.githubusercontent.com/82641385/210786883-12bff843-d83d-4071-97a1-e386ccafec0e.png">

- アイディア詳細画面に「気になる」ボタンがあり、それをクリックすると「気になるリスト」に追加される。また、「気になる」ボタンはクリックすると「気になるを解除する」ボタンに表示が切り替わる。
<img width="1275" alt="スクリーンショット 2023-01-05 22 10 33" src="https://user-images.githubusercontent.com/82641385/210787883-11cf94d9-6ad2-447d-9c8a-be16b8b7b8c6.png">
<img width="1286" alt="スクリーンショット 2023-01-05 22 13 17" src="https://user-images.githubusercontent.com/82641385/210788274-d61d4f0d-5287-4b3f-a32e-4a98f699f70e.png">

- アイディア詳細画面は購入していれば内容を表示。購入していなければ、口コミ・評価のみ表示される。
- 「購入」ボタンを押すと、アイディアの売り手には自分のアイディアが購入された事、アイディアの買い手にはアイディアを購入したことを伝える内容のメールを送信。
- アイディア購入者のみ口コミと５段階評価を投稿することができ、投稿後に編集もできる。
<img width="1274" alt="スクリーンショット 2023-01-05 22 20 41" src="https://user-images.githubusercontent.com/82641385/210789656-b94de1bb-49a6-4e6a-8e3c-80f564688b3d.png">
<img width="1286" alt="スクリーンショット 2023-01-05 22 23 32" src="https://user-images.githubusercontent.com/82641385/210790109-99a83a06-85f9-45f5-8dd6-3c7c191eca1f.png">

- 口コミ・５段階評価が投稿されると、アイディアの売り手にメールが送信される。
- 各アイディアには５段階評価の平均点数を表示。
- 自分のアイディアは購入不可。
- Twitterでアイディアを不特定多数の人がシェアできる。

# 画面
- SCSSを使い、FLOCSS設計で記述。
- レスポンシブデザイン・スマホ対応
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


