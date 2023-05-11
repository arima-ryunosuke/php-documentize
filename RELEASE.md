# RELEASE

バージョニングはセマンティックバージョニングでは**ありません**。

| バージョン   | 説明
|:--           |:--
| メジャー     | 大規模な仕様変更の際にアップします（クラス構造・メソッド体系などの根本的な変更）。<br>メジャーバージョンアップ対応は多大なコストを伴います。
| マイナー     | 小規模な仕様変更の際にアップします（中機能追加・メソッドの追加など）。<br>マイナーバージョンアップ対応は1日程度の修正で終わるようにします。
| パッチ       | バグフィックス・小機能追加の際にアップします（基本的には互換性を維持するバグフィックス）。<br>パッチバージョンアップは特殊なことをしてない限り何も行う必要はありません。

なお、下記の一覧のプレフィックスは下記のような意味合いです。

- change: 仕様変更
- feature: 新機能
- fixbug: バグ修正
- refactor: 内部動作の変更
- `*` 付きは互換性破壊

## x.y.z

- 軽くベンチを取ったら nikic/parser を使用したほうが格段に速かったのでもはやリフレクションを使ってるメリットが皆無。ので書き換える
- 「オーバーライドされてない」を virtual と呼んだのは大失敗だった。メジャーアップで変更する
- Document が何をしてるかさっぱりわからないのでリファクタする

## 1.2.0

- [feature] 生成テンプレートに markdown を追加
- [feature] サブディレクトリを複数指定できる機能
- [feature] phar の状態で組み込みテンプレートの指定が煩雑だったので簡易化
- [feature] 全オプションを php ファイルで指定できる config オプションを追加
- [feature] description の1行目のプレーンテキストである summary を追加
- [feature] package タグを有効化
- [feature] iterable キーを追加
- [feature] 主要となるエントリに id を追加
- [feature] returns を追加
- [feature] 内部型に list を追加
- [*change] 途中経過の名前空間が結果に含まれないように修正
- [fixbug] inheritdoc したときに自身の型が無くなる不具合を修正
- [fixbug] タグが完全上書きされていたのでマージにする
- [fixbug] 記法によっては class_exists で notice が出る不具合を修正
- [fixbug] ファイルをまたがる関数群がバラバラになる不具合を修正
- [fixbug] コードブロックにアノテーションが含まれている場合に誤作動する不具合を修正
- [fixbug] 型付プロパティのデフォルト値が null になっている不具合を修正
- [fixbug] 参照渡し可変引数の宣言が誤っていたので修正
- [fixbug] 実際の型なのに integer, boolean などエイリアス名で取得される不具合を修正
- [fixbug] ドキュメント由来ではないエラーが出ていたので修正

## 1.1.6

- [feature] generic/shape でエラーが出ないように修正
- [change] php8.0 に対応
- [change] 依存関係をアップデート

## 1.1.5

- [change] 依存関係をアップデート

## 1.1.4

- [feature] 型付きプロパティ対応
- [feature] nullable 対応

## 1.1.3

- [fixbug] 名前空間の際にバックスラッシュが正規化されていない不具合を修正

## 1.1.2

- [template] All FQSEN に型がなかったので追加
- [template] 設定メニューを用意
  - 凡例の表示
  - 折りたたみの展開
  - アクセスレベルでのフィルタリング

## 1.1.1

- [fixbug] 空白を含む行のインラインタグが変換されない不具合を修正

## 1.1.0

- [*fixbug] 定数とメソッドの誤認が多かったのでロジックを変更
- [*change] リフレクション周りの変更
- [*change] グローバル定数とクラス定数が曖昧だったので厳密に分ける
- [*feature] マークダウンの読み込みに対応
- [feature] <@tagname> もインラインタグとして解釈するように変更
- [fixbug] ドキュメント継承が無限ループする不具合を修正

## 1.0.6

- [feature] メニューに要素数を表示

## 1.0.5

- [fixbug] source-map のコールバックが想定と異なっていたので修正
- [fixbug] noframe 時に viewport の指定がなかったので修正

## 1.0.4

- [change] キャッシュバージョンを連番ではなくハッシュに変更
- [change] markdown パーサを変更
- [change] 出力ファイル出力を -vv レベルに変更
- [feature] @source タグを追加
- [feature] @see などでグローバル関数を参照可能に変更
- [feature] 存在しないプロパティやメソッドが参照されたときに警告を表示
- [fixbug] --force を付けないと読み込まれないファイルがある不具合を修正

## 1.0.3

- [feature] no-virtual, no-private などのアノテーション指定を可能にした
- [feature] no-constant/no-function を実装
- [feature] マジックメソッドの並び順の制御

## 1.0.2

- [fixbug] getDeclaringClass が大本の親まで引っ張っていた不具合を修正
- [fixbug] return $this が検出できない不具合を修正
- [fixbug] 引数の無いマジックメソッドがパースできない不具合を修正
- [fixbug] インラインタグが連続する場合に一つのタグとみなされていた不具合を修正
- [fixbug] inheritdoc の型指定が型省略に対応していない不具合を修正
- [fixbug] マジック系インラインでdoccommentがおかしくなる不具合を修正
- [feature] 名前空間と定数の doccomment に対応
- [feature] uri 系タグのホスト対応
- [feature] inheritdoc で埋め込み文言に対応
- [feature] inheritdoc の部分継承に対応
- [feature] ignoreinherit タグを追加
- [feature] 拡張マジック phpdoc 実装
- [feature] クラスが見つからない場合に警告を出すように修正
- [feature] link で description がない場合に FQSEN を使うように修正
- [change] インラインタグの扱いを変更

## 1.0.1

- [change] マジック系メンバーの順番を後ろに変更
- [refactor] 未定義クラスの自動定義を廃止
- [fixbug] 名前空間とクラスの区別のために名前空間に \ を付与
- [feature] @ignore タグを追加
- [feature] doccomment の自動継承
- [fixbug] use+定義の prototypes の誤りを修正

## 1.0.0

- 公開
