<style>.rst-content .right.sidebar {
    margin: -3.2em 4px 4px 0px;
}
.toc-h span:nth-of-type(n + 3) {
    font-size: 80%;
    color: #aaaaaa;
}
.toc-h span:nth-of-type(3):before {
    content: " - ";
}
.section-header small {
    display: none;
}
a[href^="http://"],
a[href^="https://"] {
    font-style: italic;
    text-decoration: underline;
}
a[href^="#--"] {
    color: #404040;
    cursor: not-allowed;
    text-decoration: underline dotted;
}
table.no-border code {
    font-size: 1em;
    padding: 0;
    background-color: transparent;
    border: none;
    white-space: nowrap;
}
.rst-content h1:has([data-attribute]),
.rst-content h2:has([data-attribute]),
.rst-content h3:has([data-attribute]),
.rst-content h4:has([data-attribute]),
.rst-content h5:has([data-attribute]),
.rst-content h6:has([data-attribute]),
.rst-content td:has([data-attribute]),
.rst-content tr:has([data-attribute]) td {
    padding-top: 1.5em;
}
[data-attribute] {
    position: absolute;
}
[data-attribute]:after {
    content: attr(data-attribute);
    position: absolute;
    top: -3em;
    white-space: nowrap;
    font-size: 80%;
    color: #8a8a8a;
}
span.summary:not(:first-child) {
    display: block;
    margin-top: 0.5em;
}
div.description {
    margin-bottom: 24px;
}
div.description h1,
div.description h2,
div.description h3,
div.description h4,
div.description h5,
div.description h6 {
    background: transparent;
}
</style>
<script>window.addEventListener('hashchange', function (e) {
    const url = new URL(e.newURL);
    const target = document.querySelector('#' + CSS.escape(decodeURIComponent(url.hash.substring(1))));
    const section = target?.closest('.section');
    const details = Array.from(section?.children ?? []).find(e => e.tagName === 'DETAILS');
    if (details) {
        details.open = true;
    }
});
</script>

## <a id='NS' class='anchor'></a>[N] NS\\ <small><span class="summary">サンプルドキュメント生成用の叩き台です（名前空間）</span></small>

<div class="description">

サンプルドキュメント生成用の叩き台です（名前空間）

</div>

### <a id='NS--constants' class='anchor'></a>[G] constants

#### <a id='NS-NAMESPACE_CONSTANT' class='anchor'></a>[C] NAMESPACE\_CONSTANT <small><span class="summary">名前空間の定数です</span></small>

///right
[all.php#98~98](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L98-L98 target=_blank)
///

...名前空間の定数です
```php:Definitation
const string NAMESPACE_CONSTANT = "namespace constant"
```



...


### <a id='NS--functions' class='anchor'></a>[F] functions

#### <a id='NS-namespace_function()' class='anchor'></a>[F] namespace\_function <small><span class="summary">名前空間に定義された関数です</span></small>

///right
[all.php#100~109](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L100-L109 target=_blank)
///

...名前空間に定義された関数です
```php:Definitation
function namespace_function(
    string $format,
    array ...$args
): string
```

<div class="description">


これは関数の説明です。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$format` | ​<span class="summary">引数1です</span>
​array | ​`...$args` | ​<span class="summary">可変引数です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary">返り値です</span>



...


#### <a id='NS-package_function()' class='anchor'></a>[F] package\_function <small><span class="summary">色々なタグを試すための名前空間関数です</span></small>

///right
{alert:deprecated 1.2.3}[all.php#389~399](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L389-L399 target=_blank)
///

...色々なタグを試すための名前空間関数です
```php:Definitation
function package_function()
```

<div class="description">


色々なタグを使っています。

</div>




:See
type | summary
--------------------------------- | -------------------------------------------------------------------------
​[Rclass](NS.md#NS-Rclass "NS\Rclass") | ​<span class="summary">これは see タグの説明です</span>

...


### <a id='NS-Nclass' class='anchor'></a>[C] Nclass <small><span class="summary">名前空間に定義されたクラスです</span></small>

///right
[all.php#151~171](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L151-L171 target=_blank)
///

<div class="description">

名前空間に定義されたクラスです

これはクラスの説明です。

</div>






#### <a id='NS-Nclass::CLASS_CONSTANT' class='anchor'></a>[C] CLASS\_CONSTANT <small><span class="summary">インターフェースの定数です</span></small>

///right
[all.php#158~159](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L158-L159 target=_blank)
///

...インターフェースの定数です
```php:Definitation
public const string CLASS_CONSTANT = "class constant"
```




...


#### <a id='NS-Nclass::$class_property' class='anchor'></a>[p] $class\_property <small><span class="summary">クラスのプロパティです</span></small>

///right
[all.php#161~162](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L161-L162 target=_blank)
///

...クラスのプロパティです
```php:Definitation
protected string $class_property = "class property"
```


**Type**: string



...


#### <a id='NS-Nclass::classMethod()' class='anchor'></a>[m] classMethod <small><span class="summary">クラスのメソッドです</span></small>

///right
[all.php#164~170](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L164-L170 target=_blank)
///

...クラスのメソッドです
```php:Definitation
public function classMethod(string $arg1): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数1です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>




...


### <a id='NS-Mclass' class='anchor'></a>[C] Mclass <small><span class="summary">マジック/プロパティメソッドのサンプル用クラスです</span></small>

///right
[all.php#175~273](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L175-L273 target=_blank)
///

<div class="description">

マジック/プロパティメソッドのサンプル用クラスです

</div>


**Hierarchy**

+ **[NS\Mclass](NS.md#NS-Mclass "NS\Mclass")**
    + [NS\Rclass](NS.md#NS-Rclass "NS\Rclass")
        + [NS\Tclass](NS.md#NS-Tclass "NS\Tclass")






#### <a id='NS-Mclass::$magicProperty1' class='anchor'></a>[p] $magicProperty1 <small><span class="summary">これはただのマジックプロパティです</span></small>

///right
{magic}[all.php#178~178](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L178-L178 target=_blank)
///

...これはただのマジックプロパティです
```php:Definitation
public string $magicProperty1
```


**Type**: string



...


#### <a id='NS-Mclass::$magicProperty2' class='anchor'></a>[p] $magicProperty2 <small><span class="summary">これはインライン phpdoc を使用したマジックプロパティです</span></small>

///right
{magic}{alert:deprecated }[all.php#179~179](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L179-L179 target=_blank)
///

...これはインライン phpdoc を使用したマジックプロパティです
```php:Definitation
public string $magicProperty2
```

<div class="description">


このように詳細な doccomment が記述できますが、 var タグで事足りることが多いためほとんど用途はありません。
ただ、下記のようにタグを貼る際は有用です。

</div>

**Type**: string


:See
type | summary
--------------------------------- | -------------------------------------------------------------------------
​[https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc target=_blank) | ​<span class="summary">URL も貼れます</span>

...


#### <a id='NS-Mclass::actualMethod()' class='anchor'></a>[m] actualMethod <small><span class="summary">これは実際に定義されているメソッドです</span></small>

///right
[all.php#243~249](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L243-L249 target=_blank)
///

...これは実際に定義されているメソッドです
```php:Definitation
public function actualMethod(string $arg1): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>




...


#### <a id='NS-Mclass::ignoreinheritMethod()' class='anchor'></a>[m] ignoreinheritMethod <small><span class="summary">ignoreinherit のメソッドです</span></small>

///right
[all.php#251~260](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L251-L260 target=_blank)
///

...ignoreinherit のメソッドです
```php:Definitation
public function ignoreinheritMethod(string $arg1): mixed
```

<div class="description">


ignoreinherit しているので、自身のメソッドとしてはドキュメント化されますが、 継承先である Rclass では出現しません。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数1です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>




...


#### <a id='NS-Mclass::usedByMethod()' class='anchor'></a>[m] usedByMethod <small><span class="summary">used-by でマジックメソッドを指定したメソッド</span></small>

///right
[all.php#262~272](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L262-L272 target=_blank)
///

...used-by でマジックメソッドを指定したメソッド
```php:Definitation
public function usedByMethod(string $arg1): mixed
```

<div class="description">


used-by するとドキュメント内の位置が変わります。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数1です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>




...


#### <a id='NS-Mclass::magicMethod4()' class='anchor'></a>[m] magicMethod4 <small><span class="summary">これは拡張構文を使用したマジックメソッドです</span></small>

///right
{magic}[all.php#226~226](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L226-L226 target=_blank)
///

...これは拡張構文を使用したマジックメソッドです
```php:Definitation
public function magicMethod4(array $arg): string
```

<div class="description">


関数・メソッドと同じ形式でマジックメソッドに @param や @return を書くことが出来ます。
同様に @see や @throws も書けます。

普通のメソッドと似たような感じで method タグの上部に記述できるので自然な形になります。
インラインのようなインデントの辛みもありません。
ただし、完全に独自構文です。psr-5 と互換性は全くありませんし、見た目が受け入れられない人もいると思います。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$arg` | ​<span class="summary">引数です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary">返り値です</span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[RuntimeException](https://php.net/manual/class.runtimeexception.php target=_blank) | ​<span class="summary"></span>


:See
type | summary
--------------------------------- | -------------------------------------------------------------------------
​[Mclass::actualMethod()](NS.md#NS-Mclass%3A%3AactualMethod%28%29 "NS\Mclass::actualMethod()") | ​<span class="summary">see を使うと参照が貼れます</span>
​[https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc target=_blank) | ​<span class="summary">URL も貼れます</span>

...


#### <a id='NS-Mclass::magicMethod1()' class='anchor'></a>[m] magicMethod1 <small><span class="summary">これはただのマジックメソッドです</span></small>

///right
{magic}[all.php#188~188](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L188-L188 target=_blank)
///

...これはただのマジックメソッドです
```php:Definitation
public function magicMethod1(mixed $arg): string
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`$arg` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary"></span>




...


#### <a id='NS-Mclass::magicMethod2()' class='anchor'></a>[m] magicMethod2 <small><span class="summary">これはマジックメソッドです。タイプヒントにパイプが使えます</span></small>

///right
{magic}[all.php#189~189](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L189-L189 target=_blank)
///

...これはマジックメソッドです。タイプヒントにパイプが使えます
```php:Definitation
public function magicMethod2(
    int|string &$arg1 = 123,
    \Exception|\Throwable $e = null
): string
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​int\|​string | ​`&$arg1 = 123` | ​<span class="summary"></span>
​[Exception](https://php.net/manual/class.exception.php target=_blank)\|​[Throwable](https://php.net/manual/class.throwable.php target=_blank) | ​`$e = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary"></span>




...


#### <a id='NS-Mclass::magicMethod3()' class='anchor'></a>[m] magicMethod3 <small><span class="summary">これはインライン phpdoc を使用したマジックメソッドです</span></small>

///right
{magic}[all.php#190~190](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L190-L190 target=_blank)
///

...これはインライン phpdoc を使用したマジックメソッドです
```php:Definitation
public function magicMethod3(array $arg): string
```

<div class="description">


関数・メソッドと同じ形式でマジックメソッドに @param や @return を書くことが出来ます。
同様に @see や @throws も書けます。

ただし、インデントが必要です。インデントがないと親の @ 指定と区別がつかないからです。
phpstorm などの IDE では doccomment 内のフォーマットもサポートしているので注意が必要です。
（実際、このコメントの上下に @formatter:off/on を入れています。でないとインデントが消されてしまうからです）

この機能は破棄された psr-5 を仮実装したものです。psr-5 の状況によっては形式などが変わるかもしれません。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$arg` | ​<span class="summary">引数です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary">返り値です</span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[RuntimeException](https://php.net/manual/class.runtimeexception.php target=_blank) | ​<span class="summary"></span>


:See
type | summary
--------------------------------- | -------------------------------------------------------------------------
​[Mclass::actualMethod()](NS.md#NS-Mclass%3A%3AactualMethod%28%29 "NS\Mclass::actualMethod()") | ​<span class="summary">see を使うと参照が貼れます</span>
​[https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#54-inline-phpdoc target=_blank) | ​<span class="summary">URL も貼れます</span>

...


#### <a id='NS-Mclass::magicMethod5()' class='anchor'></a>[m] magicMethod5 <small><span class="summary">これはインライン phpdoc を使用したマジックメソッドです</span></small>

///right
{magic}[all.php#227~227](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L227-L227 target=_blank)
///

...これはインライン phpdoc を使用したマジックメソッドです
```php:Definitation
public function magicMethod5(mixed|string $arg1): string
```

<div class="description">


[NS\Mclass::actualMethod()](NS.md#NS-Mclass%3A%3AactualMethod%28%29 "NS\Mclass::actualMethod()")を使用してインラインかつ link 的な挙動を示すことができます。
[actualMethod()](NS.md#NS-Mclass%3A%3AactualMethod%28%29 "NS\Mclass::actualMethod()")を使用してインラインかつ inheritdoc 的な挙動を示すことができます。

このメソッドは &#64;see しているにもかかわらず see 参照が出ていません。&lt;inline see&gt; では link に読み換えられるからです。
このメソッドは &#64;inheritdoc していないにも関わらず引数が継承されています。&lt;inline uses&gt; では自動で inheritdoc が付与されるからです。

これは phpstorm などの IDE ジャンプで特に有用です。
例えば &#123;&#64;see&#125; としても phpstorm が反応しません（インライン未対応？）。 link は標準ではないためそもそも反応しません。
&#64;uses に関しては個人的な用途です（link + inheritdoc を同時にしたいことが多々ある）。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed\|​string | ​`$arg1` | ​<span class="summary">引数です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary"></span>




...


### <a id='NS-Rclass' class='anchor'></a>[C] Rclass <small><span class="summary">これは継承関係を説明するためのクラスです</span></small>

///right
[all.php#275~351](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L275-L351 target=_blank)
///

<div class="description">

これは継承関係を説明するためのクラスです

基本的に継承されたメソッドは全て自身のものとしてドキュメント化されます。

inheritdoc タグを使うと親のドキュメントを継承することが出来ます。
継承関係がなくても inheritdoc FQSEN 形式を使用すると参照先を強制的に指定して継承することが出来ます。

</div>


**Hierarchy**

+ [NS\Mclass](NS.md#NS-Mclass "NS\Mclass")
    + **[NS\Rclass](NS.md#NS-Rclass "NS\Rclass")**
        + [NS\Tclass](NS.md#NS-Tclass "NS\Tclass")


:Parents
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Mclass](NS.md#NS-Mclass "NS\Mclass") | ​<span class="summary">マジック/プロパティメソッドのサンプル用クラスです</span>

:Implements
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Ninterface](NS.md#NS-Ninterface "NS\Ninterface") | ​<span class="summary">名前空間に定義されたインターフェースです</span>

:Uses
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Ntrait](NS.md#NS-Ntrait "NS\Ntrait") | ​<span class="summary">名前空間に定義されたトレイトです</span>

#### <a id='NS-Rclass::INTERFACE_CONSTANT' class='anchor'></a>[C] INTERFACE\_CONSTANT <small><span class="summary">インターフェースの定数です</span></small>

///right
[all.php#118~119](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L118-L119 target=_blank)
///

...インターフェースの定数です
```php:Definitation
public const string INTERFACE_CONSTANT = "interface constant"
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Ninterface::INTERFACE_CONSTANT](NS.md#NS-Ninterface%3A%3AINTERFACE_CONSTANT "NS\Ninterface::INTERFACE_CONSTANT") | ​<span class="summary">インターフェースの定数です</span>


...


#### <a id='NS-Rclass::$class_property' class='anchor'></a>[p] $class\_property <small><span class="summary">クラスのプロパティです</span></small>

///right
[all.php#287~288](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L287-L288 target=_blank)
///

...クラスのプロパティです
```php:Definitation
protected string $class_property = "Rclass property"
```


**Type**: string



...


#### <a id='NS-Rclass::$trait_property' class='anchor'></a>[p] $trait\_property <small><span class="summary">トレイトのプロパティです</span></small>

///right
[all.php#139~140](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L139-L140 target=_blank)
///

...トレイトのプロパティです
```php:Definitation
private string $trait_property = "trait property"
```


**Type**: string

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[Ntrait::$trait_property](NS.md#NS-Ntrait%3A%3A%24trait_property "NS\Ntrait::$trait_property") | ​<span class="summary">トレイトのプロパティです</span>


...


#### <a id='NS-Rclass::interfaceMethod()' class='anchor'></a>[m] interfaceMethod <small><span class="summary">インターフェースのメソッドです</span></small>

///right
[all.php#291~291](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L291-L291 target=_blank)
///

...インターフェースのメソッドです
```php:Definitation
public function interfaceMethod(string $arg1): mixed
```

<div class="description">


これはインターフェースメソッドの説明です。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数1です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​implement | ​[Ninterface::interfaceMethod()](NS.md#NS-Ninterface%3A%3AinterfaceMethod%28%29 "NS\Ninterface::interfaceMethod()") | ​<span class="summary">インターフェースのメソッドです</span>


...


#### <a id='NS-Rclass::actualMethod()' class='anchor'></a>[m] actualMethod <small><span class="summary">これはオーバーライドしたメソッドです</span></small>

///right
[all.php#293~301](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L293-L301 target=_blank)
///

...これはオーバーライドしたメソッドです
```php:Definitation
public function actualMethod(string $arg1): mixed
```

<div class="description">


概要・説明はこのように自身のものが記載され、引数・返り値は継承元のものがドキュメント化されます。
説明を記述しなかった場合は親の説明を完全に継承します。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​override | ​[Mclass::actualMethod()](NS.md#NS-Mclass%3A%3AactualMethod%28%29 "NS\Mclass::actualMethod()") | ​<span class="summary">これは実際に定義されているメソッドです</span>


...


#### <a id='NS-Rclass::inheritMethod()' class='anchor'></a>[m] inheritMethod <small><span class="summary">これはドキュメントの継承元を指定したメソッドです</span></small>

///right
[all.php#303~316](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L303-L316 target=_blank)
///

...これはドキュメントの継承元を指定したメソッドです
```php:Definitation
public function inheritMethod(string $arg1): mixed
```

<div class="description">


inheritdoc で参照先を指定しているので、

- 引数・返り値は参照先のもの
- php の言語構造の継承とは無関係

という動作になります。
結果としていま記述されているこのコメントは残り、 @param 指定などがないにも関わらず引数・返り値はドキュメント化されているはずです。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>




...


#### <a id='NS-Rclass::inheritMethod1()' class='anchor'></a>[m] inheritMethod1 <small><span class="summary">これは一部のみ継承するメソッドです</span></small>

///right
[all.php#318~330](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L318-L330 target=_blank)
///

...これは一部のみ継承するメソッドです
```php:Definitation
public function inheritMethod1(
    int $arg0,
    string $arg1,
    int $arg2
): string
```

<div class="description">


$arg0, $arg2 は親に無い引数ですが、自身に記述されているので、マージされて使用されます。
param type $arg1 hogehoge とすることで親の引数の一部のみを書き換えることも出来ます。
return はこのメソッド自身に記述されているので上書きされて使用されます。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​int | ​`$arg0` | ​<span class="summary">param 追加。親に $arg0 は無いが、ここに記述することで追加される</span>
​string | ​`$arg1` | ​<span class="summary">引数です</span>
​int | ​`$arg2` | ​<span class="summary">param 追加。親に $arg2 は無いが、ここに記述することで追加される</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary">return 上書き。親は mixed だが string と表記される</span>




...


#### <a id='NS-Rclass::inheritMethod2()' class='anchor'></a>[m] inheritMethod2 <small><span class="summary">これは inheritdoc しているメソッドへの inheritdoc です</span></small>

///right
[all.php#332~341](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L332-L341 target=_blank)
///

...これは inheritdoc しているメソッドへの inheritdoc です
```php:Definitation
public function inheritMethod2(string $arg1): mixed
```

<div class="description">


参照は再帰的に行われるので最終的に inheritdoc ではない実際に記述が為されているメソッドがドキュメント化されます。

以下に継承元ドキュメントが表示されます。
<blockquote>これはドキュメントの継承元を指定したメソッドです

inheritdoc で参照先を指定しているので、

- 引数・返り値は参照先のもの
- php の言語構造の継承とは無関係

という動作になります。
結果としていま記述されているこのコメントは残り、 @param 指定などがないにも関わらず引数・返り値はドキュメント化されているはずです。</blockquote>
継承元ドキュメントはここまでです。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>




...


#### <a id='NS-Rclass::inheritMethod3()' class='anchor'></a>[m] inheritMethod3 <small><span class="summary">これは {inheritdoc FQSEN 文言指定} かつ文言指定メソッドです</span></small>

///right
[all.php#343~350](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L343-L350 target=_blank)
///

...これは {inheritdoc FQSEN 文言指定} かつ文言指定メソッドです
```php:Definitation
public function inheritMethod3(string $arg1): mixed
```

<div class="description">


{inheritdoc FQSEN 文言指定} とすると元ドキュメントではなく文言指定で文字列を埋め込めます。

継承しつつ文言指定ができます

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>




...


#### <a id='NS-Rclass::usedByMethod()' class='anchor'></a>[m] usedByMethod <small><span class="summary">used-by でマジックメソッドを指定したメソッド</span></small>

///right
[all.php#262~272](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L262-L272 target=_blank)
///

...used-by でマジックメソッドを指定したメソッド
```php:Definitation
public function usedByMethod(string $arg1): mixed
```

<div class="description">


used-by するとドキュメント内の位置が変わります。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数1です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Mclass::usedByMethod()](NS.md#NS-Mclass%3A%3AusedByMethod%28%29 "NS\Mclass::usedByMethod()") | ​<span class="summary">used-by でマジックメソッドを指定したメソッド</span>


...


#### <a id='NS-Rclass::traitMethod()' class='anchor'></a>[m] traitMethod <small><span class="summary">トレイトのメソッドです</span></small>

///right
[all.php#142~148](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L142-L148 target=_blank)
///

...トレイトのメソッドです
```php:Definitation
public function traitMethod(string $arg1): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数1です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[Ntrait::traitMethod()](NS.md#NS-Ntrait%3A%3AtraitMethod%28%29 "NS\Ntrait::traitMethod()") | ​<span class="summary">トレイトのメソッドです</span>


...


### <a id='NS-Aclass' class='anchor'></a><div data-attribute='#[NS\Attribute, NS\Attribute(1, target: &quot;class&quot;)]'></div>[C] Aclass <small><span class="summary">属性とか引数・返り値の DocComment を試すためのクラスです</span></small>

///right
[all.php#355~387](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L355-L387 target=_blank)
///

<div class="description">

属性とか引数・返り値の DocComment を試すためのクラスです

</div>






#### <a id='NS-Aclass::CONSTANT' class='anchor'></a><div data-attribute='#[NS\Attribute, NS\Attribute(2, target: &quot;constant&quot;)]'></div>[C] CONSTANT <small><span class="summary"></span></small>

///right
[all.php#362~362](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L362-L362 target=_blank)
///

...
```php:Definitation
public const string CONSTANT = "constant"
```




...


#### <a id='NS-Aclass::$property' class='anchor'></a><div data-attribute='#[NS\Attribute, NS\Attribute(3, target: &quot;property&quot;)]'></div>[p] $property <small><span class="summary"></span></small>

///right
[all.php#366~366](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L366-L366 target=_blank)
///

...
```php:Definitation
private null $property = null
```


**Type**: null



...


#### <a id='NS-Aclass::method()' class='anchor'></a><div data-attribute='#[NS\Attribute, NS\Attribute(4, target: &quot;method&quot;)]'></div>[m] method <small><span class="summary"></span></small>

///right
[all.php#370~386](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L370-L386 target=_blank)
///

...
```php:Definitation
private function method(
    int|bool $arg1,
    int|float $arg2,
    int|string $arg3
): array|iterable
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​<div data-attribute='#[NS\Attribute, NS\Attribute(7, target: &quot;parameter&quot;)]'></div>int\|​bool | ​`$arg1` | ​<span class="summary">summary1</span>
​<div data-attribute='#[NS\Attribute, NS\Attribute(8, target: &quot;parameter&quot;)]'></div>int\|​float | ​`$arg2` | ​<span class="summary">summary2</span>
​<div data-attribute='#[NS\Attribute, NS\Attribute(9, target: &quot;parameter&quot;)]'></div>int\|​string | ​`$arg3` | ​<span class="summary">summary3</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array\|​iterable | ​<span class="summary">return</span>




...


### <a id='NS-Tclass' class='anchor'></a>[C] Tclass <small><span class="summary">色々なタグを試すためのクラスです</span></small>

///right
{final}{alert:deprecated 3.4.5}[all.php#401~553](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L401-L553 target=_blank)
///

<div class="description">

色々なタグを試すためのクラスです

色々なタグを使っています。
以下は markdown の確認用です。

# 見出し1

## 見出し2

### 見出し3

#### 見出し4

##### 見出し5

###### 見出し6

テキスト

~~打ち消し~~
**強調**
\*\*エスケープ\*\*

> 引用
>> 引用

###### 箇条書き

- list 1
    - list 1-1
    - list 1-2
- list 2
- list 3

1. list 1
    1. list 1-1
    2. list 1-2
2. list 2
3. list 3

###### コード

インライン `$hoge = 123;` コード

```php
// コードブロック
$hoge = 123;
echo $hoge;
```

###### テーブル

| No | col1(left) | col2(center)
| --:|:--         |:--:
|  1 | row1col1   | row1col2
|  2 | row2col1   | row2col2

</div>

:See
type | summary
--------------------------------- | -------------------------------------------------------------------------
​[Rclass](NS.md#NS-Rclass "NS\Rclass") | ​<span class="summary">これは see タグの説明です（内部リンク）</span>
​[https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md target=_blank) | ​<span class="summary">これは see タグの説明です（外部リンク）</span>

**Hierarchy**

+ [NS\Mclass](NS.md#NS-Mclass "NS\Mclass")
    + [NS\Rclass](NS.md#NS-Rclass "NS\Rclass")
        + **[NS\Tclass](NS.md#NS-Tclass "NS\Tclass")**


:Parents
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Rclass](NS.md#NS-Rclass "NS\Rclass") | ​<span class="summary">これは継承関係を説明するためのクラスです</span>
​[Mclass](NS.md#NS-Mclass "NS\Mclass") | ​<span class="summary">マジック/プロパティメソッドのサンプル用クラスです</span>

:Implements
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Ninterface](NS.md#NS-Ninterface "NS\Ninterface") | ​<span class="summary">名前空間に定義されたインターフェースです</span>


#### <a id='NS-Tclass::INTERFACE_CONSTANT' class='anchor'></a>[C] INTERFACE\_CONSTANT <small><span class="summary">インターフェースの定数です</span></small>

///right
[all.php#118~119](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L118-L119 target=_blank)
///

...インターフェースの定数です
```php:Definitation
public const string INTERFACE_CONSTANT = "interface constant"
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Ninterface::INTERFACE_CONSTANT](NS.md#NS-Ninterface%3A%3AINTERFACE_CONSTANT "NS\Ninterface::INTERFACE_CONSTANT") | ​<span class="summary">インターフェースの定数です</span>


...


#### <a id='NS-Tclass::$tagProperty' class='anchor'></a>[p] $tagProperty <small><span class="summary">これはプロパティ用のタグの例示用メソッドです</span></small>

///right
[all.php#468~475](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L468-L475 target=_blank)
///

...これはプロパティ用のタグの例示用メソッドです
```php:Definitation
protected array $tagProperty = null
```

<div class="description">


とは言えプロパティ専用のタグはほとんど無いため、 var のためだけに存在しています。

</div>

**Type**: array



...


#### <a id='NS-Tclass::$defaultTypeProperty' class='anchor'></a>[p] $defaultTypeProperty <small><span class="summary">デフォルトあり型付きプロパティです</span></small>

///right
[all.php#~](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L-L target=_blank)
///

...デフォルトあり型付きプロパティです
```php:Definitation
protected string $defaultTypeProperty = "default"
```


**Type**: string



...


#### <a id='NS-Tclass::$nodefaultTypeProperty' class='anchor'></a>[p] $nodefaultTypeProperty <small><span class="summary">デフォルトなし型付きプロパティです</span></small>

///right
[all.php#~](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L-L target=_blank)
///

...デフォルトなし型付きプロパティです
```php:Definitation
protected string $nodefaultTypeProperty
```


**Type**: string



...


#### <a id='NS-Tclass::$class_property' class='anchor'></a>[p] $class\_property <small><span class="summary">クラスのプロパティです</span></small>

///right
[all.php#287~288](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L287-L288 target=_blank)
///

...クラスのプロパティです
```php:Definitation
protected string $class_property = "Rclass property"
```


**Type**: string

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Rclass::$class_property](NS.md#NS-Rclass%3A%3A%24class_property "NS\Rclass::$class_property") | ​<span class="summary">クラスのプロパティです</span>


...


#### <a id='NS-Tclass::tagMethod()' class='anchor'></a>[m] tagMethod <small><span class="summary">これはメソッド用の[タグ](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#7-tags target=_blank)の例示用メソッドです</span></small>

///right
{final}{success:api}{success:version 3.4.5}{notice:internal}{alert:deprecated 2.3.4}[all.php#498~540](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L498-L540 target=_blank)
///

...これはメソッド用の[タグ](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md#7-tags target=_blank)の例示用メソッドです
```php:Definitation
final public function tagMethod(string $arg1): string
```

<div class="description">


右側に属性ラベルが表示されたり、メソッドに打ち消し線が引かれていたりするはずです。
また、 link/source タグを使うと

- [こんな感じに外部リンク](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md target=_blank)が貼れたり
- [こんな感じに要素リンク](NS.md#NS-Rclass%3A%3AactualMethod%28%29 "NS\Rclass::actualMethod()")が貼れたり
- [こんな感じにソースへリンク](NS.md#NS-Rclass%3A%3AactualMethod%28%29 "NS\Rclass::actualMethod()")が貼れたり

します。ただしこれは生成側との協力が必要です。

あとこれはタグではないですが、コメント中にコードブロックを埋め込むことが出来ます。

Example:
```php
// これは doccomment 内のコードブロックです
$sample1 = 123;
// ハイライト表示されます
$sample2 = [1, 2, 3];
$sample3 = [
    'a' => 'A',
    'b' => 'B',
    'c' => 'C',
];
```

ただこれは生成側の処理です。掻き集める側はそもそも markdown を認識しません（結果としてコードブロックも得られない）。
基本的に Description はただのテキストです。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">これは param タグの説明です。[インラインタグが使えます](NS.md#NS-Tclass &quot;NS\Tclass&quot;)</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary">これは return タグの説明です。[インラインタグが使えます](NS.md#NS-Tclass &quot;NS\Tclass&quot;)</span>
​false | ​<span class="summary">これは2つ目の return タグの説明です。[インラインタグが使えます](NS.md#NS-Tclass &quot;NS\Tclass&quot;)</span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[RuntimeException](https://php.net/manual/class.runtimeexception.php target=_blank) | ​<span class="summary">これは throws タグの説明です</span>


:See
type | summary
--------------------------------- | -------------------------------------------------------------------------
​[Rclass::actualMethod()](NS.md#NS-Rclass%3A%3AactualMethod%28%29 "NS\Rclass::actualMethod()") | ​<span class="summary">これは see タグの説明です</span>

...


#### <a id='NS-Tclass::typeMethod()' class='anchor'></a>[m] typeMethod <small><span class="summary"></span></small>

///right
[all.php#542~542](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L542-L542 target=_blank)
///

...
```php:Definitation
public function typeMethod(
    ?NS\Tclass $arg1,
    ?string $arg2
): ?NS\Tclass
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​?[Tclass](NS.md#NS-Tclass "NS\Tclass") | ​`$arg1` | ​<span class="summary"></span>
​?string | ​`$arg2` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​?[Tclass](NS.md#NS-Tclass "NS\Tclass") | ​<span class="summary"></span>




...


#### <a id='NS-Tclass::inheritMethod()' class='anchor'></a>[m] inheritMethod <small><span class="summary">これはドキュメントの継承元を指定したメソッドです</span></small>

///right
[all.php#552~552](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L552-L552 target=_blank)
///

...これはドキュメントの継承元を指定したメソッドです
```php:Definitation
public function inheritMethod(string $arg1): mixed
```

<div class="description">


inheritdoc で参照先を指定しているので、

- 引数・返り値は参照先のもの
- php の言語構造の継承とは無関係

という動作になります。
結果としていま記述されているこのコメントは残り、 @param 指定などがないにも関わらず引数・返り値はドキュメント化されているはずです。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​override | ​[Rclass::inheritMethod()](NS.md#NS-Rclass%3A%3AinheritMethod%28%29 "NS\Rclass::inheritMethod()") | ​<span class="summary">これはドキュメントの継承元を指定したメソッドです</span>


...


### <a id='NS-Ntrait' class='anchor'></a>[T] Ntrait <small><span class="summary">名前空間に定義されたトレイトです</span></small>

///right
[all.php#132~149](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L132-L149 target=_blank)
///

<div class="description">

名前空間に定義されたトレイトです

これはトレイトの説明です。

</div>


**Hierarchy**

+ **[NS\Ntrait](NS.md#NS-Ntrait "NS\Ntrait")**
    + [NS\Rclass](NS.md#NS-Rclass "NS\Rclass")






#### <a id='NS-Ntrait::$trait_property' class='anchor'></a>[p] $trait\_property <small><span class="summary">トレイトのプロパティです</span></small>

///right
[all.php#139~140](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L139-L140 target=_blank)
///

...トレイトのプロパティです
```php:Definitation
private string $trait_property = "trait property"
```


**Type**: string



...


#### <a id='NS-Ntrait::traitMethod()' class='anchor'></a>[m] traitMethod <small><span class="summary">トレイトのメソッドです</span></small>

///right
[all.php#142~148](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L142-L148 target=_blank)
///

...トレイトのメソッドです
```php:Definitation
public function traitMethod(string $arg1): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数1です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>




...


### <a id='NS-Ninterface' class='anchor'></a>[I] Ninterface <small><span class="summary">名前空間に定義されたインターフェースです</span></small>

///right
{abstract}[all.php#111~130](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L111-L130 target=_blank)
///

<div class="description">

名前空間に定義されたインターフェースです

これはインターフェースの説明です。

</div>


**Hierarchy**

+ **[NS\Ninterface](NS.md#NS-Ninterface "NS\Ninterface")**
    + [NS\Rclass](NS.md#NS-Rclass "NS\Rclass")
    + [NS\Tclass](NS.md#NS-Tclass "NS\Tclass")





#### <a id='NS-Ninterface::INTERFACE_CONSTANT' class='anchor'></a>[C] INTERFACE\_CONSTANT <small><span class="summary">インターフェースの定数です</span></small>

///right
[all.php#118~119](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L118-L119 target=_blank)
///

...インターフェースの定数です
```php:Definitation
public const string INTERFACE_CONSTANT = "interface constant"
```




...



#### <a id='NS-Ninterface::interfaceMethod()' class='anchor'></a>[m] interfaceMethod <small><span class="summary">インターフェースのメソッドです</span></small>

///right
{abstract}[all.php#121~129](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L121-L129 target=_blank)
///

...インターフェースのメソッドです
```php:Definitation
abstract public function interfaceMethod(string $arg1): mixed
```

<div class="description">


これはインターフェースメソッドの説明です。

</div>

:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$arg1` | ​<span class="summary">引数1です</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary">返り値です</span>




...


## <a id='NS-NSS' class='anchor'></a>[N] NS\\NSS\\ <small><span class="summary">サンプルドキュメント生成用の叩き台です（ネスト）</span></small>

<div class="description">

サンプルドキュメント生成用の叩き台です（ネスト）

</div>


### <a id='NS-NSS--functions' class='anchor'></a>[F] functions

#### <a id='NS-NSS-fff()' class='anchor'></a>[F] fff <small><span class="summary">これはネストされた名前空間用です。実質的な意味はありません</span></small>

///right
[all.php#563~566](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L563-L566 target=_blank)
///

...これはネストされた名前空間用です。実質的な意味はありません
```php:Definitation
function fff()
```






...


### <a id='NS-NSS-C' class='anchor'></a>[C] C <small><span class="summary">これはネストされた名前空間用です。実質的な意味はありません</span></small>

///right
[all.php#568~574](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L568-L574 target=_blank)
///

<div class="description">

これはネストされた名前空間用です。実質的な意味はありません

</div>








#### <a id='NS-NSS-C::m()' class='anchor'></a>[m] m <small><span class="summary"></span></small>

///right
[all.php#573~573](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L573-L573 target=_blank)
///

...
```php:Definitation
public function m()
```







...







