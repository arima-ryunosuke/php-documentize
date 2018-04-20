PHP Documentize
====

## Description

（見捨てられた）[PSR-5](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md) にある程度準拠したドキュメント生成ツールです。
一部の「非推奨のもの」「（個人的に）不要だと思われるもの」は実装していません。また仕様の一部を拡大・縮小しています。

php を外からパースする手法ではなく、「実際に読み込んでリフレクションを使う」というアプローチを取っています。
ので他の生成ツールに比べて比較的高速に動作しますし、外部依存が少ないので最新追従もそれなりに容易です。
ただし、それゆえに弊害もあり、 例えば php 7.1 のドキュメントを生成したいときは動かす環境として実際に php 7.1 が必要です。

また、動的読み込みのオートローダは完全に外部に依存するので、composer 管理のライブラリ・パッケージでないとほぼ生成不可能ですし、変な依存があるとクラスが読み込めずエラーになります。

さらに、副作用のあるファイルすら読み込んでしまうので場合によっては変な処理が実行されることもあります。
基本的には**信頼できないパッケージ・ライブラリに対して生成しない**でください。

## Install

```json
{
    "require": {
        "ryunosuke/documentize": "dev-master"
    }
}
```

## Specification

基本的には [PSR-5](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md) に準拠です。
組み込みテンプレートのサンプルは [こちら](https://arima-ryunosuke.github.io/php-documentize/example/) とか [こちら](https://arima-ryunosuke.github.io/php-documentize/symfony-console/) です。

```php
/**
 * summary
 * 
 * description
 * 
 * @tag1 tag arg
 * @tag2 tag arg
 */
```

これが基本フォーマットです。
ゆるく雑にやっているので適当に書いても動きますし、逆に変な記法があるとエラーになるかもしれません。

`@property` `@method` タグのみ、 [インライン PHPDoc](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc) に対応しています。

```php
/**
 * @property int MyMagicProperty {
 *     ここにマジックプロパティの概要が書けます
 *
 *     ここにマジックプロパティの説明が書けます。
 *
 *     @see FQSEN その他のタグも使えます
 * }
 * @method int MyMagicMethod(string $argument1) {
 *     ここにマジックメソッドの概要が書けます
 *
 *     ここにマジックメソッドの説明が書けます。
 *
 *     @param string $argument1 戻り値の説明も書けます
 *     @return int 返り値の説明も書けます
 * }
 */
class MyMagicClass
{
}
```

これ、対応してるツールは少ないですが、実際のところ非常に便利です。
マジックメソッドは一言程度の説明を書くのが関の山ですが、このインライン PHPDocを使うと詳細な説明・引数・返り値が書けてドキュメントが非常に充実します。
さらに後述の `@inheritdoc FQSEN` 書式を使うとシグネチャのドキュメントだけ継承ができたりするので「マジックメソッド用に一言添える」と言ったことも可能です。

なおマジックメソッドの方を重視して実装しています。
マジックプロパティは「一言程度の説明」で結構実用的なので、そこまで使う機会がないからです。

### Tags

基本的には [PSR-5#Tags](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#7-tags) に準拠です。
以下に変更点のみ記載します。

#### インラインタグ

- @example
- @internal

は仕様的には `{@internal [description]}` のような埋込み式インライン表記が可能ですが、本ツールでは未対応です（実装がややこしくなる上必要だとは思えない）。

インラインタグはすべて `<tag-name data-tag-attr="" />` 形式で埋め込まれます。これをどう活用するかは生成側に委ねられています。
`{@link}` を組み込みテンプレートで使用してるので参考にしてください。

#### @category

非推奨とのことで実装していません。

#### @global

今日日グローバル変数なんて使わないと思うので実装していません。
グローバル変数のリフレクションがない、という実装上の都合もあります。

#### @inheritdoc

元仕様的にはタグ引数を取ることは出来ませんが、 `@inheritdoc \vendor\Type::method` のような引数を受けられます。
この引数を指定すると php の言語構造的な継承ではなく、ドキュメントレベルの継承が可能になります。ドキュメントの継承元を直接指定するイメージです（継承というより「参照」に近いです）。
「マジックメソッドで引数体系は同じなんだけど継承関係がない」ときに指定すると便利です。

特定のコンテキストにおいて、説明だけではなく他の情報も無理やり継承します。
具体的にはメソッドの引数・返り値です。

#### @internal

前述の通り、 `{@internal Description}}` 形式は実装がややこしい上、閉じタグが揃っておらず非常に気持ち悪いので未実装です。
普通に `@internal Description` で説明は記述できます。

#### @method

仕様的には「返り値の型は省略可能」ですが、省略可能にするメリットを感じないため「返り値の型は必須」です。

#### @package

参照・被参照の扱いがかなりややこしくなる上に、名前空間があれば個人的に不要だと思うので未実装です。

#### @subpackage

非推奨だし、名前空間があれば個人的に不要だと思うので未実装です。

#### @todo, @uses, @used-by

対応しておりタグとして認識されますが、組み込みテンプレートには反映されません（単に使っていないだけです）。
どちらかと言えば IDE 向けのタグでドキュメント化が目的のタグではないような気がするからです。

#### @ignore

元仕様的にはありませんが、便利なので実装しています。
`@ignore` があるとその要素はドキュメントに出力されないようになります。

-----

未実装と言えど、 `@tagname` 形式であればタグとしては取得できます。単に属性値が配列的に取得できないだけです。
`tags` として結果配列に含まれるので、生成側でパースしなおせばそれらしく表示することは可能です。

また、 PSR-5 には「タグで指定された属性は継承される」という仕様があるんですが、個人的に必要ないので実装していません。
具体的には例えば「class で指定された `@since` とか `@version` とかはメソッドにも暗黙的に継承される」という仕様です（実際の仕様では since, version に限らずすべてのタグを継承？）。
実装できなくもないですが、 `@author` とか `@version` は継承されても邪魔なだけな気がするし、あまりメリットを感じないのです（必要ならそもそも生成側で親を見れば良い）。

## Usage

コマンドラインツールが付属しています。また、 phar もあります。下記の記述例は phar が前提です。

```sh
$ ./documentize.phar generate --help
Usage:
  generate [options] [--] <source> <destination>

Arguments:
  source                                 Specify Source path
  destination                            Specify Destination path

Options:
  -a, --autoload[=AUTOLOAD]              Specify Autoload file
      --cachedir=CACHEDIR                Specify cache directory [default: "/tmp/rdz-1.0.0"]
      --force                            Specify cache recreation
  -r, --recursive                        Specify Recursive flag
  -i, --include=INCLUDE                  Specify Include pattern [default: ["*.php"]] (multiple values allowed)
  -e, --exclude=EXCLUDE                  Specify Exclude pattern (multiple values allowed)
      --contain=CONTAIN                  Specify Contain fqsen [default: ["*"]] (multiple values allowed)
      --except=EXCEPT                    Specify Except fqsen (multiple values allowed)
  -t, --template=TEMPLATE                Specify Template script
  -c, --template-config=TEMPLATE-CONFIG  Specify Template config script
      --stats                            Display statistic
      --no-internal                      
      --no-internal-constant             
      --no-internal-function             
      --no-internal-type                 
      --no-internal-property             
      --no-internal-method               
      --no-deprecated                    
      --no-deprecated-constant           
      --no-deprecated-function           
      --no-deprecated-type               
      --no-deprecated-property           
      --no-deprecated-method             
      --no-magic                         
      --no-magic-property                
      --no-magic-method                  
      --no-virtual                       
      --no-virtual-constant              
      --no-virtual-property              
      --no-virtual-method                
      --no-private                       
      --no-private-constant              
      --no-private-property              
      --no-private-method                
      --no-protected                     
      --no-protected-constant            
      --no-protected-property            
      --no-protected-method              
      --no-public                        
      --no-public-constant               
      --no-public-property               
      --no-public-method                 
  -h, --help                             Display this help message
  -q, --quiet                            Do not output any message
  -V, --version                          Display this application version
      --ansi                             Force ANSI output
      --no-ansi                          Disable ANSI output
  -n, --no-interaction                   Do not ask any interactive question
  -v|vv|vvv, --verbose                   Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Help:
  generate document from phpdoc.
```

`source` `destination` 引数はそのまんまなので説明は省きます。

### --autoload(-a)

前述の通り、リフレクションに頼っているので、単にディレクトリを指定するだけではクラスファイルが読み込めません。
これはそのオートロードスクリプトを指定するオプションです。

composer 管理されていれば大抵の場合は「ドキュメントを生成したいライブラリ・パッケージの `vendor/autoload.php`」を指定すればOKです。
このオプションを省略すると `vendor/autoload.php` を** source 引数から推測して**自動で読み込みます。
ので基本的には指定する必要はありません。

### --cachedir

メタ情報を出力するキャッシュディレクトリを指定します。
未指定時はシステムの一時ディレクトリを使用します。

### --force

キャッシュを使用せず強制的に再生成します。

### --recursive(-r)

クラスファイルの読み込みは「関連があったクラス」を自動で読み込みますが、「`source` 外は対象外」になっています。
このオプションを指定すると `source` 外でも、関連のあったファイルの関連のあったファイルの関連のあったファイルの・・・という形で再帰的に読み込みます。

生成対象自体はこじんまりしていても、依存しているライブラリが超巨大な場合などは、このオプションを指定するとかなり時間がかかります。
また、指定しないとリンク先が 404 になることがあります。

例えば laravel は一部 symfony/http-foundation に依存していますが、このオプションを指定しないと symfony 側は生成されません。

このオプションを指定するとかなり余計なものも出力されるので後述の `--contain` `--except` オプションがほぼ必須になります。
例えば PHPUnit を使用しているとそれも含まれてしまいます。

### --include(-i)

読み込み対象パターンを指定します。デフォルトは `.php` です。

動作は fnmatch によるワイルドカードマッチです。パターンの先頭には `*` が自動で付与されます。
つまり、 `/FileName.php` を指定すると `hoge/FileName.php` や `fuga/FileName.php` なども対象になります。

### --exclude(-e)

除外対象パターンを指定します。
仕様的には `--include` と全く同じです。

### --contain

名前空間を指定して結果を指定します

`--include` は「ファイル」が対象ですが、 `--contain` は「FQSEN」が対象です。

簡単に言えば「指定した FQSEN のみを結果配列に含めるオプション」です。パース自体は行われます。

動作は fnmatch によるワイルドカードマッチです。パターンの後ろには `*` が自動で付与されます。
つまり、 `vendor\NameSpace` を指定すると `vendor\NameSpace\Package1` や `vendor\NameSpace\Package2` なども結果に含まれるようになります。

### --except

FQSEN を指定して結果を除外します。

`--exclude` は「ファイル」が対象ですが、 `--except` は「FQSEN」が対象です。

簡単に言えば「指定した FQSEN を結果配列から伏せるオプション」です。パース自体は行われます。

動作は fnmatch によるワイルドカードマッチです。パターンの後ろには `*` が自動で付与されます。
つまり、 `vendor\NameSpace` を指定すると `vendor\NameSpace\Package1` や `vendor\NameSpace\Package2` なども結果に含まれなくなります。

### --template(-t)

後述の通り、本ツールのコンセプトは「メタ情報を掻き集めること」です。生成は基本的に利用者任せです。
これはその生成処理スクリプトを渡すオプションです。

テンプレートスクリプトは `$namespaces` （掻き集めた名前空間配列） `$destination` （出力ディレクトリ）  `$config` （--template-config オプションの値）を受け取るクロージャを返す必要があります。
つまり、生成結果とディレクトリが渡されるので、この2つの変数を利用して何とかしてドキュメントを生成します。

一応組み込みで簡単なテンプレートは用意しておきました。
このオプションを省略すると組み込みテンプレートを使用します。

テンプレートスクリプトは実はジェネレータを返すことができますが、ほとんどの人には関係ありません。
組み込みテンプレートでは出力に使っています。

### --template-config(-c)

上記のテンプレートスクリプトへ渡す config ファイルを指定します。
例えばドキュメントの html>head>title とか、画面サイズとかそういう出力的なオプションを渡して出力側で分岐したいときに指定するオプションです。

テンプレートの実処理と強く依存するため、「こういう値を指定すべき」とかそういった制約はありません。
一応組み込みテンプレートでは使っているので参考にしてください。

### --stats

指定すると生成ファイル数や実行時間・メモリ使用量などが出力されます。

### --no-*

指定するとそのカテゴリに属するものが結果配列に含まれなくなります。
例えば `--no-private-method` を指定すると private メソッドが含まれなくなります。

一部の `--no-*` 指定は従属関係があります。
例えば `--no-private` 指定は `--no-private-constant --no-private-property --no-private-method` 指定と同義です。
基本的に `--no-private-*` の第3オクテットが無いオプションはその下位オプションをすべて指定した状態になります。

`--no-virtual` について補足しておくと、「自身が宣言・実装を持っていない」ものが virtual とみなされます。

いくつか例を挙げると、「親メソッドを override していない」場合は virtual ですが、 override すると virtual ではなくなります。自身が実装を持つからです。

「trait を use している」場合は trait のメソッドは全て virtual です。

「interface を implement して実装した」場合は virtual ではありません。自身が実装を持っているからです。

「interface を implement して実装した class を extends した」場合は virtual です。実装してるのは自身ではなく親だからです。

メソッドが一番複雑ですが、定数・プロパティも考え方は基本的に同じです。
端的に言えば「ソースを見たときその要素が見当たらない」場合が virtual です。多分それなりの規模のパッケージで実際に `--no-virtual` してみるのが一番わかり易いです。

-----

生成処理に手を加えたい場合は template 辺りを変更してください。
一応、出力結果に軽く説明を加えると下記のような形です。

```php
[
    // 名前空間配列です（グローバルは空文字になります）
    'NS' => [
        // 名前空間の名前空間属性です
        'category'   => 'namespace',
        'fqsen'      => 'NS',
        'namespace'  => '',
        'name'       => 'NS',
        // 所属するサブ名前空間です
        'namespaces' => [
            'subns' => [
                // 全く同じ構造の再帰構造です
                ...
            ],
        ],
        // 名前空間に直接定義されている定数配列です
        'constants'  => [
            // 定数名がキーになります。定数分繰り返されます
            'NAMESPACE_CONSTANT' => [
                // 定数の名前空間属性です
                'category'    => 'constant',
                'fqsen'       => 'NS\\NAMESPACE_CONSTANT',
                'namespace'   => 'NS',
                'name'        => 'NAMESPACE_CONSTANT',
                // 定数の定義場所です
                'location'    => [
                    'path'  => '/source.example.php',
                    'start' => 1,
                    'end'   => 99,
                ],
                // 定数の説明です
                'description' => '',
                // 定数の値です
                'value'       => '1',
                // 定数のアクセスレベルです
                'accessible'  => 'public',
                // 定数の型です
                'types'       => [
                    // 下記が可能性のある型分繰り返されます
                    [
                        // カテゴリです。大抵の場合 type ですが、 php 組み込みの疑似型（array, mixed など） は pseudo になります
                        'category' => 'type',
                        // FQSEN（Fully Qualified Structural Element Name）です
                        'fqsen'    => 'string',
                        // 配列の階層数を表す整数値です（`Type[][]` などで 2 になります）
                        'array'    => 0,
                    ],
                ],
                // 定数のタグです
                'tags'       => [
                    // [タグ名][連番][タグごとに異なる属性] で格納されます
                    ...
                ],
            ],
        ],
        // 名前空間に直接定義されている関数配列です
        'functions'  => [
            // 関数名がキーになります。関数分繰り返されます
            'namespace_function' => [
                // 関数の名前空間属性です
                'category'    => 'function',
                'fqsen'       => 'NS\\namespace_function',
                'namespace'   => 'NS',
                'name'        => 'namespace_function',
                // 関数の定義場所です
                'location'    => [
                    'path'  => '/source.example.php',
                    'start' => 1,
                    'end'   => 99,
                ],
                // 関数の説明です
                'description' => '名前空間に定義された関数です\n\nこれは関数の説明です。',
                // 関数の引数配列です
                'parameters'  => [
                    // 下記が引数分繰り返されます
                    [
                        // 引数の型を表す配列です
                        'types'       => [
                            // 下記が可能性のある型分繰り返されます
                            [
                                // カテゴリです。大抵の場合 type ですが、 php 組み込みの疑似型（array, mixed など） は pseudo になります
                                'category' => 'type',
                                // FQSEN（Fully Qualified Structural Element Name）です
                                'fqsen'    => 'string',
                                // 配列の階層数を表す整数値です（`Type[][]` などで 2 になります）
                                'array'    => 0,
                            ],
                        ],
                        // 引数の名前です
                        'name'        => 'ref',
                        // 引数の定義です（参照渡しの & や可変引数の ... といった記号がそのまま格納されます）
                        'declaration' => '&$ref',
                        // 引数の説明です
                        'description' => '引数1です',
                    ],
                ],
                // 関数の返り値です
                'return'      => [
                    // 返り値の型を表す配列です
                    'types'       => [
                        // 下記が可能性のある型分繰り返されます
                        [
                            // カテゴリです。大抵の場合 type ですが、 php 組み込みの疑似型（array, mixed など） は pseudo になります
                            'category' => 'type',
                            // FQSEN（Fully Qualified Structural Element Name）です
                            'fqsen'    => 'string',
                            // 配列の階層数を表す整数値です（`Type[][]` などで 2 になります）
                            'array'    => 0,
                        ],
                    ],
                    // 返り値の説明です
                    'description' => '返り値です',
                ],
                // 関数のタグです
                'tags'        => [
                    // [タグ名][連番][タグごとに異なる属性] で格納されます
                    ...
                ],
            ],
        ],
        // 名前空間に定義されているクラスです
        'classes'    => [
            // クラス名がキーになります。クラス分繰り返されます
            'ClassName'   => [
                // クラスの名前空間属性です
                'category'    => 'class',
                'fqsen'       => 'NS\\ClassName',
                'namespace'   => 'NS',
                'name'        => 'ClassName',
                // クラスの定義場所です
                'location'    => [
                    'path'  => '/source.example.php',
                    'start' => 1,
                    'end'   => 99,
                ],
                // クラスの説明です
                'description' => '名前空間に定義されたクラスです
                // クラスの属性を表す真偽値です
                'final'       => false,
                'abstract'    => false,
                'cloneable'   => true,
                'iterateable' => false,
                // このクラスが属する階層構造です
                'hierarchy'   => [
                    // このクラスが属するクラスツリー配列です。属するツリー分繰り返されます
                    'NS\\Ninterface' => [
                        'NS\\Rclass' => [/* ツリー構造です */],
                        'NS\\Tclass' => [/* ツリー構造です */],
                    ],
                ],
                // このクラスが継承しているクラスです
                'parents'     => [
                    // 下記が継承ツリーを辿れる分繰り返されます
                    [
                        // FQSEN（Fully Qualified Structural Element Name）です
                        'fqsen'        => 'vendor\\package\\Parents',
                        // FQSEN の C を表します（[namespace|constant|function|type|class|trait|interface|method|property]）
                        'category'     => 'class',
                        // クラスの説明です
                        'description'  => 'クラスの説明です',
                    ],
                ],
                // このクラスが実装しているインターフェースです
                'implements'  => [
                    // 実装・使用・継承の違いで構造は parents と同じです
                    ...
                ],
                // このクラスが使用しているトレイトです
                'uses'        => [
                    // 実装・使用・継承の違いで構造は parents と同じです
                    ...
                ],
                // クラスに定義されている定数配列です
                'constants'   => [
                    // 定数名がキーになります。定数分繰り返されます
                    'CONSTNAME' => [
                        // 名前空間に属する定数と同じなので省略します
                        ...
                    ],
                ],
                // クラスに定義されているプロパティ配列です
                'properties'  => [
                    // プロパティ名がキーになります。プロパティ分繰り返されます
                    'propertname' => [
                        // プロパティの名前空間属性です
                        'category'    => 'property',
                        'fqsen'       => 'NS\\ClassName::$propertname',
                        'namespace'   => 'NS\\ClassName',
                        'name'        => 'propertname',
                        // プロパティの定義場所です
                        'location'    => [
                            'path'  => '/source.example.php',
                            'start' => 1,
                            'end'   => 99,
                        ],
                        // プロパティの説明です
                        'description' => 'クラスのプロパティです',
                        // プロパティの値です
                        'value'       => 'null',
                        // プロパティの属性を表す真偽値です
                        'virtuall'    => false,
                        'magic'       => false,
                        'static'      => false,
                        // プロパティのアクセスレベルです
                        'accessible'  => 'private',
                        // プロパティのプロトタイプを表す配列です
                        'prototypes'  => [
                            // プロトタイプ種別を表す文字列です（[instead|inherit|override]）
                            'kind'        => 'override',
                            // FQSEN（Fully Qualified Structural Element Name）です
                            'fqsen'       => 'vendor\\package\\Parents::methodname',
                            // FQSEN の説明です
                            'description' => '...',
                        ],
                        // プロパティの型配列です
                        'types'       => [
                            // 下記が可能性のある型分繰り返されます
                            [
                                'category  => 'type',
                                'fqsen'    => 'string',
                                'array'    => 0,
                            ],
                        ],
                        // プロパティのタグです
                        'tags'        => [
                            // [タグ名][連番][タグごとに異なる属性] で格納されます
                            ...
                        ],
                    ],
                ],
                // クラスに定義されているメソッド配列です
                'methods'     => [
                    // メソッド名がキーになります。メソッド分繰り返されます
                    'methodname' => [
                        'category'    => 'method',
                        'fqsen'       => 'NS\\ClassName::methodname()',
                        'namespace'   => 'NS\\ClassName',
                        'name'        => 'methodname',
                        // メソッドの定義場所です
                        'location'    => [
                            'path'  => '/source.example.php',
                            'start' => 1,
                            'end'   => 99,
                        ],
                        // メソッドの説明です
                        'description' => 'クラスのメソッドです\n\nこれはクラスメソッドの説明です。',
                        // メソッドの属性を表す真偽値です
                        'virtuall'    => false,
                        'magic'       => false,
                        'abstract'    => false,
                        'final'       => false,
                        'static'      => false,
                        // メソッドのアクセスレベルです
                        'accessible'  => 'public',
                        // メソッドのプロトタイプを表す配列です
                        'prototype'   => [
                            // プロトタイプ種別を表す文字列です（[implement|instead|inherit|override]）
                            'kind'        => 'override',
                            // FQSEN（Fully Qualified Structural Element Name）です
                            'fqsen'       => 'vendor\\package\\Parents::methodname',
                            // FQSEN の説明です
                            'description' => '...',
                        ],
                        // メソッドの引数配列です
                        'parameters'  => [
                            // 関数と同じなので省略します
                            ...
                        ],
                        // メソッドの返り値です
                        'return'      => [
                            // 関数と同じなので省略します
                            ...
                        ],
                        'tags'        => [
                            // [タグ名][連番][タグごとに異なる属性] で格納されます
                            ...
                        ],
                    ],
                ],
                // クラスのタグです
                'tags'        => [
                    // [タグ名][連番][タグごとに異なる属性] で格納されます
                    ...
                ],
            ],
        ],
        // 名前空間に定義されているインターフェースです
        'interfaces' => [
            // 一部の属性が必ず false だったりしますが項目自体は classes とまったく同じです
            ...
        ],
        // 名前空間に定義されているトレイトです
        'traits'     => [
            // 一部の属性が必ず false だったりしますが項目自体は classes とまったく同じです
            ...
        ],
    ],
]
```

繰り返し構造が多いためかなり省略していますが、雰囲気は伝わると思います。
タグだけは説明のしようがないため var_dump で覗き見るなどしてください。
ただ、 `@param` `@return` `@method` などに代表されるややこしいタグは全て結果配列に反映されています。
`@method` `@property` によるマジックメソッド・プロパティも反映済みです。
また、 `@see` `@uses` などの型名を持つタグの型は全て解決済みです。

つまり、上記の結果配列を何らかの方法で見やすくすればそれらしいドキュメントに仕上がるはずです。

なお、項目名を変えるときはマイナーバージョンを上げますが、キーが文字列である項目の順番は不定です。
原則として順番に依存した処理は書くべきではありません。

本ツールの本懐は「連想配列で掻き集めること」です。
`template` 以下にサンプルがありますが、オマケのようなものです。

「見やすく生成するのは利用側」というスタンスです。
これがめんどくさいなら phpDocumentor や sami や PHPDoctor などを使えばいいと思います。
（個人的に PHPDoctor が生成するドキュメントはものすごく見やすくて好きです（javadoc は見やすいと思う）。全くメンテされてないですが…）

## License

MIT
