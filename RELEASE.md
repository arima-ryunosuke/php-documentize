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

- no-virtual, no-private とかをアノテーションベースにしたい
- Reflection がとても冗長なのでいろいろキャッシュすればかなり高速化されるはず

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
