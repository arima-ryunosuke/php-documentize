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

## <a id='Illuminate-Redis-Events' class='anchor'></a>[N] Illuminate\\Redis\\Events\\ <small><span class="summary"></span></small>




### <a id='Illuminate-Redis-Events-CommandExecuted' class='anchor'></a>[C] CommandExecuted <small><span class="summary"></span></small>

///right
[CommandExecuted.php#5~59](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Events/CommandExecuted.php#L5-L59 target=_blank)
///








#### <a id='Illuminate-Redis-Events-CommandExecuted::$command' class='anchor'></a>[p] $command <small><span class="summary">The Redis command that was executed.</span></small>

///right
[CommandExecuted.php#7~12](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Events/CommandExecuted.php#L7-L12 target=_blank)
///

...The Redis command that was executed.
```php:Definitation
public string $command = null
```


**Type**: string



...


#### <a id='Illuminate-Redis-Events-CommandExecuted::$parameters' class='anchor'></a>[p] $parameters <small><span class="summary">The array of command parameters.</span></small>

///right
[CommandExecuted.php#14~19](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Events/CommandExecuted.php#L14-L19 target=_blank)
///

...The array of command parameters.
```php:Definitation
public array $parameters = null
```


**Type**: array



...


#### <a id='Illuminate-Redis-Events-CommandExecuted::$time' class='anchor'></a>[p] $time <small><span class="summary">The number of milliseconds it took to execute the command.</span></small>

///right
[CommandExecuted.php#21~26](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Events/CommandExecuted.php#L21-L26 target=_blank)
///

...The number of milliseconds it took to execute the command.
```php:Definitation
public float $time = null
```


**Type**: float



...


#### <a id='Illuminate-Redis-Events-CommandExecuted::$connection' class='anchor'></a>[p] $connection <small><span class="summary">The Redis connection instance.</span></small>

///right
[CommandExecuted.php#28~33](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Events/CommandExecuted.php#L28-L33 target=_blank)
///

...The Redis connection instance.
```php:Definitation
public Illuminate\Redis\Connections\Connection $connection = null
```


**Type**: [Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")



...


#### <a id='Illuminate-Redis-Events-CommandExecuted::$connectionName' class='anchor'></a>[p] $connectionName <small><span class="summary">The Redis connection name.</span></small>

///right
[CommandExecuted.php#35~40](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Events/CommandExecuted.php#L35-L40 target=_blank)
///

...The Redis connection name.
```php:Definitation
public string $connectionName = null
```


**Type**: string



...


#### <a id='Illuminate-Redis-Events-CommandExecuted::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new event instance.</span></small>

///right
[CommandExecuted.php#42~58](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Events/CommandExecuted.php#L42-L58 target=_blank)
///

...Create a new event instance.
```php:Definitation
public function __construct(
    string $command,
    array $parameters,
    float|null $time,
    Illuminate\Redis\Connections\Connection $connection
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$command` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>
​float\|​null | ​`$time` | ​<span class="summary"></span>
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$connection` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...






