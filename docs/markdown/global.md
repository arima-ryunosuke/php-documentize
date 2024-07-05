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

## [N] global\\ <small><span class="summary">サンプルドキュメント生成用の叩き台です（グローバル）</span></small>

<div class="description">

サンプルドキュメント生成用の叩き台です（グローバル）

</div>

### <a id='--constants' class='anchor'></a>[G] constants

#### <a id='MYSQLI_REFRESH_REPLICA' class='anchor'></a>[C] MYSQLI\_REFRESH\_REPLICA <small><span class="summary"></span></small>


...
```php:Definitation
const int MYSQLI_REFRESH_REPLICA = 64
```



...


#### <a id='GLOBAL_CONSTANT' class='anchor'></a>[C] GLOBAL\_CONSTANT <small><span class="summary">グローバルの定数です</span></small>

///right
[all.php#11~11](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L11-L11 target=_blank)
///

...グローバルの定数です
```php:Definitation
const array GLOBAL_CONSTANT = [
    0   => 1,
    1   => 2,
    2   => 3,
    3   => 4,
    4   => 5,
    "x" => "X",
]
```



...


### <a id='--functions' class='anchor'></a>[F] functions

#### <a id='global_function()' class='anchor'></a>[F] global\_function <small><span class="summary">グローバルに定義された関数です</span></small>

///right
[all.php#13~25](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L13-L25 target=_blank)
///

...グローバルに定義された関数です
```php:Definitation
function global_function(
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
​array | ​`...$args` | ​<span class="summary">可変引数です。</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary">返り値です</span>


:See
type | summary
--------------------------------- | -------------------------------------------------------------------------
​[implode()](https://php.net/manual/function.implode.php target=_blank) | ​<span class="summary"></span>

...


### <a id='Gclass' class='anchor'></a>[C] Gclass <small><span class="summary">グローバルに定義されたクラスです</span></small>

///right
[all.php#67~87](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L67-L87 target=_blank)
///

<div class="description">

グローバルに定義されたクラスです

これはクラスの説明です。

</div>






#### <a id='Gclass::CLASS_CONSTANT' class='anchor'></a>[C] CLASS\_CONSTANT <small><span class="summary">インターフェースの定数です</span></small>

///right
[all.php#74~75](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L74-L75 target=_blank)
///

...インターフェースの定数です
```php:Definitation
public const string CLASS_CONSTANT = "class constant"
```




...


#### <a id='Gclass::$class_property' class='anchor'></a>[p] $class\_property <small><span class="summary">クラスのプロパティです</span></small>

///right
[all.php#77~78](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L77-L78 target=_blank)
///

...クラスのプロパティです
```php:Definitation
protected string $class_property = "class property"
```


**Type**: string



...


#### <a id='Gclass::classMethod()' class='anchor'></a>[m] classMethod <small><span class="summary">クラスのメソッドです</span></small>

///right
[all.php#80~86](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L80-L86 target=_blank)
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


### <a id='Gtrait' class='anchor'></a>[T] Gtrait <small><span class="summary">グローバルに定義されたトレイトです</span></small>

///right
[all.php#48~65](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L48-L65 target=_blank)
///

<div class="description">

グローバルに定義されたトレイトです

これはトレイトの説明です。

</div>







#### <a id='Gtrait::$trait_property' class='anchor'></a>[p] $trait\_property <small><span class="summary">トレイトのプロパティです</span></small>

///right
[all.php#55~56](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L55-L56 target=_blank)
///

...トレイトのプロパティです
```php:Definitation
private string $trait_property = "trait property"
```


**Type**: string



...


#### <a id='Gtrait::traitMethod()' class='anchor'></a>[m] traitMethod <small><span class="summary">トレイトのメソッドです</span></small>

///right
[all.php#58~64](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L58-L64 target=_blank)
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


### <a id='Ginterface' class='anchor'></a>[I] Ginterface <small><span class="summary">グローバルに定義されたインターフェースです</span></small>

///right
{abstract}[all.php#27~46](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L27-L46 target=_blank)
///

<div class="description">

グローバルに定義されたインターフェースです

これはインターフェースの説明です。

</div>






#### <a id='Ginterface::INTERFACE_CONSTANT' class='anchor'></a>[C] INTERFACE\_CONSTANT <small><span class="summary">インターフェースの定数です</span></small>

///right
[all.php#34~35](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L34-L35 target=_blank)
///

...インターフェースの定数です
```php:Definitation
public const string INTERFACE_CONSTANT = "interface constant"
```




...



#### <a id='Ginterface::interfaceMethod()' class='anchor'></a>[m] interfaceMethod <small><span class="summary">インターフェースのメソッドです</span></small>

///right
{abstract}[all.php#37~45](https://github.com/arima-ryunosuke/php-documentize/blob/master/example/user/all.php#L37-L45 target=_blank)
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




