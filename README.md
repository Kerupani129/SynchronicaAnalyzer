# シンクロニカ分析ツール

シンクロニカを分析するためのツール群です。
中には通信をするものもあるので、WEB 上で公開するときには、データをキャッシュして一定時間ごとにしか通信をしないようにするか、cron で実行するなどの変更をした方が良いです。

## 一覧

- rating.php
	- 公式サイトのランキングの情報から、レーティングと☆の対応を算出します。
	- ※ランキングに古い情報が残っていることがあり、必ずしも正しい値になるとは限りません。
- emblem.php
- CrownList-genre1.html (シンクロニカラウンジのクラウン (Song) ページの HTML)
- png/
	- シンクロニカラウンジのクラウン (Song) ページの情報を解析し、各曲で取得できるエンブレム・ベース・フロントの画像を一括ダウンロードします。
	- ※ログイン処理を書くのが面倒だったので、人力で HTML を落とし、それを解析する形にしました。
	- ※画像はログインしなくてもアクセスできるようです (仕様変更される可能性あり) 。
	- ※サヨナラ曲や解禁曲の状況によって、ソースコードを改変する必要がでてきます。
	- ※曲数 * 9 つの画像ファイルにアクセスすることになるので、必要に応じてソースコードを改変し、最低限のファイルだけ落とすようにしてください。

## ライセンス & コピーライト

Copyright (c) 2017 Kerupani129 and licensed under The MIT License.
