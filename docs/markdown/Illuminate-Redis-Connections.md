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

## <a id='Illuminate-Redis-Connections' class='anchor'></a>[N] Illuminate\\Redis\\Connections\\ <small><span class="summary"></span></small>




### <a id='Illuminate-Redis-Connections-Connection' class='anchor'></a>[C] Connection <small><span class="summary"></span></small>

///right
{abstract}[Connection.php#12~222](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L12-L222 target=_blank)
///



**Hierarchy**

+ **[Illuminate\Redis\Connections\Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")**
    + [Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")
        + [Illuminate\Redis\Connections\PhpRedisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection")
    + [Illuminate\Redis\Connections\PredisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection")
        + [Illuminate\Redis\Connections\PredisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection")




:Uses
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Macroable](#--Illuminate-Support-Traits-Macroable) | ​<span class="summary"></span>


#### <a id='Illuminate-Redis-Connections-Connection::$client' class='anchor'></a>[p] $client <small><span class="summary">The Redis client.</span></small>

///right
[Connection.php#18~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L18-L23 target=_blank)
///

...The Redis client.
```php:Definitation
protected Redis $client = null
```


**Type**: [Redis](#--Redis)



...


#### <a id='Illuminate-Redis-Connections-Connection::$name' class='anchor'></a>[p] $name <small><span class="summary">The Redis connection name.</span></small>

///right
[Connection.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L25-L30 target=_blank)
///

...The Redis connection name.
```php:Definitation
protected string|null $name = null
```


**Type**: string\|​null



...


#### <a id='Illuminate-Redis-Connections-Connection::$events' class='anchor'></a>[p] $events <small><span class="summary">The event dispatcher instance.</span></small>

///right
[Connection.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L32-L37 target=_blank)
///

...The event dispatcher instance.
```php:Definitation
protected Illuminate\Contracts\Events\Dispatcher $events = null
```


**Type**: [Dispatcher](#--Illuminate-Contracts-Events-Dispatcher)



...


#### <a id='Illuminate-Redis-Connections-Connection::$macros' class='anchor'></a>[P] $macros <small><span class="summary">The registered string macros.</span></small>

///right
[Macroable.php#12~17](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L12-L17 target=_blank)
///

...The registered string macros.
```php:Definitation
protected static array $macros = []
```


**Type**: array

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[Macroable::$macros](#--Illuminate-Support-Traits-Macroable%3A%3A%24macros) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connections-Connection::createSubscription()' class='anchor'></a>[m] createSubscription <small><span class="summary">Subscribe to a set of given channels for messages.</span></small>

///right
{abstract}[Connection.php#39~47](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L39-L47 target=_blank)
///

...Subscribe to a set of given channels for messages.
```php:Definitation
abstract public function createSubscription(
    array|string $channels,
    \Closure $callback,
    string $method = "subscribe"
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>
​string | ​`$method = "subscribe"` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::funnel()' class='anchor'></a>[m] funnel <small><span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span></small>

///right
[Connection.php#49~58](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L49-L58 target=_blank)
///

...Funnel a callback for a maximum number of simultaneous executions.
```php:Definitation
public function funnel(string $name): Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ConcurrencyLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::throttle()' class='anchor'></a>[m] throttle <small><span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span></small>

///right
[Connection.php#60~69](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L60-L69 target=_blank)
///

...Throttle a callback for a maximum number of executions over a given duration.
```php:Definitation
public function throttle(string $name): Illuminate\Redis\Limiters\DurationLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[DurationLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::client()' class='anchor'></a>[m] client <small><span class="summary">Get the underlying Redis client.</span></small>

///right
[Connection.php#71~79](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L71-L79 target=_blank)
///

...Get the underlying Redis client.
```php:Definitation
public function client(): mixed
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::subscribe()' class='anchor'></a>[m] subscribe <small><span class="summary">Subscribe to a set of given channels for messages.</span></small>

///right
[Connection.php#81~91](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L81-L91 target=_blank)
///

...Subscribe to a set of given channels for messages.
```php:Definitation
public function subscribe(
    array|string $channels,
    \Closure $callback
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::psubscribe()' class='anchor'></a>[m] psubscribe <small><span class="summary">Subscribe to a set of given channels with wildcards.</span></small>

///right
[Connection.php#93~103](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L93-L103 target=_blank)
///

...Subscribe to a set of given channels with wildcards.
```php:Definitation
public function psubscribe(
    array|string $channels,
    \Closure $callback
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::command()' class='anchor'></a>[m] command <small><span class="summary">Run a command against the Redis database.</span></small>

///right
[Connection.php#105~125](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L105-L125 target=_blank)
///

...Run a command against the Redis database.
```php:Definitation
public function command(
    string $method,
    array $parameters = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::event()' class='anchor'></a>[m] event <small><span class="summary">Fire the given event if possible.</span></small>

///right
[Connection.php#127~138](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L127-L138 target=_blank)
///

...Fire the given event if possible.
```php:Definitation
protected function event(mixed $event): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`$event` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::listen()' class='anchor'></a>[m] listen <small><span class="summary">Register a Redis command listener with the connection.</span></small>

///right
[Connection.php#140~151](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L140-L151 target=_blank)
///

...Register a Redis command listener with the connection.
```php:Definitation
public function listen(\Closure $callback): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::getName()' class='anchor'></a>[m] getName <small><span class="summary">Get the connection name.</span></small>

///right
[Connection.php#153~161](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L153-L161 target=_blank)
///

...Get the connection name.
```php:Definitation
public function getName(): string|null
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string\|​null | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::setName()' class='anchor'></a>[m] setName <small><span class="summary">Set the connections name.</span></small>

///right
[Connection.php#163~174](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L163-L174 target=_blank)
///

...Set the connections name.
```php:Definitation
public function setName(string $name): Illuminate\Redis\Connections\Connection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::getEventDispatcher()' class='anchor'></a>[m] getEventDispatcher <small><span class="summary">Get the event dispatcher used by the connection.</span></small>

///right
[Connection.php#176~184](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L176-L184 target=_blank)
///

...Get the event dispatcher used by the connection.
```php:Definitation
public function getEventDispatcher(): Illuminate\Contracts\Events\Dispatcher
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Dispatcher](#--Illuminate-Contracts-Events-Dispatcher) | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::setEventDispatcher()' class='anchor'></a>[m] setEventDispatcher <small><span class="summary">Set the event dispatcher instance on the connection.</span></small>

///right
[Connection.php#186~195](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L186-L195 target=_blank)
///

...Set the event dispatcher instance on the connection.
```php:Definitation
public function setEventDispatcher(Illuminate\Contracts\Events\Dispatcher $events): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Dispatcher](#--Illuminate-Contracts-Events-Dispatcher) | ​`$events` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::unsetEventDispatcher()' class='anchor'></a>[m] unsetEventDispatcher <small><span class="summary">Unset the event dispatcher instance on the connection.</span></small>

///right
[Connection.php#197~205](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L197-L205 target=_blank)
///

...Unset the event dispatcher instance on the connection.
```php:Definitation
public function unsetEventDispatcher(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-Connection::__call()' class='anchor'></a>[m] \_\_call <small><span class="summary">Pass other method calls down to the underlying client.</span></small>

///right
[Connection.php#207~221](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L207-L221 target=_blank)
///

...Pass other method calls down to the underlying client.
```php:Definitation
public function __call(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​override | ​[Macroable::__call()](#--Illuminate-Support-Traits-Macroable%3A%3A__call%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connections-Connection::macro()' class='anchor'></a>[M] macro <small><span class="summary">Register a custom macro.</span></small>

///right
[Macroable.php#19~29](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L19-L29 target=_blank)
///

...Register a custom macro.
```php:Definitation
public static function macro(
    string $name,
    object|callable $macro
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>
​object\|​callable | ​`$macro` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[Macroable::macro()](#--Illuminate-Support-Traits-Macroable%3A%3Amacro%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connections-Connection::mixin()' class='anchor'></a>[M] mixin <small><span class="summary">Mix another object into the class.</span></small>

///right
[Macroable.php#31~52](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L31-L52 target=_blank)
///

...Mix another object into the class.
```php:Definitation
public static function mixin(
    object $mixin,
    bool $replace = true
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​object | ​`$mixin` | ​<span class="summary"></span>
​bool | ​`$replace = true` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ReflectionException](https://php.net/manual/class.reflectionexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[Macroable::mixin()](#--Illuminate-Support-Traits-Macroable%3A%3Amixin%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connections-Connection::hasMacro()' class='anchor'></a>[M] hasMacro <small><span class="summary">Checks if macro is registered.</span></small>

///right
[Macroable.php#54~63](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L54-L63 target=_blank)
///

...Checks if macro is registered.
```php:Definitation
public static function hasMacro(string $name): bool
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[Macroable::hasMacro()](#--Illuminate-Support-Traits-Macroable%3A%3AhasMacro%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connections-Connection::flushMacros()' class='anchor'></a>[M] flushMacros <small><span class="summary">Flush the existing macros.</span></small>

///right
[Macroable.php#65~73](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L65-L73 target=_blank)
///

...Flush the existing macros.
```php:Definitation
public static function flushMacros(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[Macroable::flushMacros()](#--Illuminate-Support-Traits-Macroable%3A%3AflushMacros%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connections-Connection::__callStatic()' class='anchor'></a>[M] \_\_callStatic <small><span class="summary">Dynamically handle calls to the class.</span></small>

///right
[Macroable.php#75~99](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L75-L99 target=_blank)
///

...Dynamically handle calls to the class.
```php:Definitation
public static function __callStatic(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[BadMethodCallException](https://php.net/manual/class.badmethodcallexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[Macroable::__callStatic()](#--Illuminate-Support-Traits-Macroable%3A%3A__callStatic%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connections-Connection::macroCall()' class='anchor'></a>[m] macroCall <small><span class="summary">Dynamically handle calls to the class.</span></small>

///right
[Macroable.php#101~125](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L101-L125 target=_blank)
///

...Dynamically handle calls to the class.
```php:Definitation
public function macroCall(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[BadMethodCallException](https://php.net/manual/class.badmethodcallexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[Macroable::__call()](#--Illuminate-Support-Traits-Macroable%3A%3A__call%28%29) | ​<span class="summary"></span>


...


### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection' class='anchor'></a>[C] PhpRedisClusterConnection <small><span class="summary"></span></small>

///right
[PhpRedisClusterConnection.php#5~24](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisClusterConnection.php#L5-L24 target=_blank)
///



**Hierarchy**

+ [Illuminate\Redis\Connections\Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")
    + [Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")
        + **[Illuminate\Redis\Connections\PhpRedisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection")**
    + [Illuminate\Redis\Connections\PredisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection")
        + [Illuminate\Redis\Connections\PredisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection")


:Parents
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[PhpRedisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection") | ​<span class="summary"></span>
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>

:Implements
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](#--Illuminate-Contracts-Redis-Connection) | ​<span class="summary"></span>



#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$connector' class='anchor'></a>[p] $connector <small><span class="summary">The connection creation callback.</span></small>

///right
[PhpRedisConnection.php#19~24](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L19-L24 target=_blank)
///

...The connection creation callback.
```php:Definitation
protected callable $connector = null
```


**Type**: callable

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::$connector](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A%24connector "Illuminate\Redis\Connections\PhpRedisConnection::$connector") | ​<span class="summary">The connection creation callback.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$config' class='anchor'></a>[p] $config <small><span class="summary">The connection configuration array.</span></small>

///right
[PhpRedisConnection.php#26~31](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L26-L31 target=_blank)
///

...The connection configuration array.
```php:Definitation
protected array $config = null
```


**Type**: array

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::$config](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A%24config "Illuminate\Redis\Connections\PhpRedisConnection::$config") | ​<span class="summary">The connection configuration array.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$client' class='anchor'></a>[p] $client <small><span class="summary">The Redis client.</span></small>

///right
[Connection.php#18~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L18-L23 target=_blank)
///

...The Redis client.
```php:Definitation
protected Redis $client = null
```


**Type**: [Redis](#--Redis)

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$client](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24client "Illuminate\Redis\Connections\Connection::$client") | ​<span class="summary">The Redis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$name' class='anchor'></a>[p] $name <small><span class="summary">The Redis connection name.</span></small>

///right
[Connection.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L25-L30 target=_blank)
///

...The Redis connection name.
```php:Definitation
protected string|null $name = null
```


**Type**: string\|​null

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$name](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24name "Illuminate\Redis\Connections\Connection::$name") | ​<span class="summary">The Redis connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$events' class='anchor'></a>[p] $events <small><span class="summary">The event dispatcher instance.</span></small>

///right
[Connection.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L32-L37 target=_blank)
///

...The event dispatcher instance.
```php:Definitation
protected Illuminate\Contracts\Events\Dispatcher $events = null
```


**Type**: [Dispatcher](#--Illuminate-Contracts-Events-Dispatcher)

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$events](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24events "Illuminate\Redis\Connections\Connection::$events") | ​<span class="summary">The event dispatcher instance.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$macros' class='anchor'></a>[P] $macros <small><span class="summary">The registered string macros.</span></small>

///right
[Connection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L-L target=_blank)
///

...The registered string macros.
```php:Definitation
protected static array $macros = []
```


**Type**: array

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$macros](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24macros "Illuminate\Redis\Connections\Connection::$macros") | ​<span class="summary">The registered string macros.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$supportsPacking' class='anchor'></a>[p] $supportsPacking <small><span class="summary">Indicates if Redis supports packing.</span></small>

///right
[PhpRedisConnection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L-L target=_blank)
///

...Indicates if Redis supports packing.
```php:Definitation
protected bool|null $supportsPacking = null
```


**Type**: bool\|​null

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::$supportsPacking](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A%24supportsPacking "Illuminate\Redis\Connections\PhpRedisConnection::$supportsPacking") | ​<span class="summary">Indicates if Redis supports packing.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$supportsLzf' class='anchor'></a>[p] $supportsLzf <small><span class="summary">Indicates if Redis supports LZF compression.</span></small>

///right
[PhpRedisConnection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L-L target=_blank)
///

...Indicates if Redis supports LZF compression.
```php:Definitation
protected bool|null $supportsLzf = null
```


**Type**: bool\|​null

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::$supportsLzf](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A%24supportsLzf "Illuminate\Redis\Connections\PhpRedisConnection::$supportsLzf") | ​<span class="summary">Indicates if Redis supports LZF compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$supportsZstd' class='anchor'></a>[p] $supportsZstd <small><span class="summary">Indicates if Redis supports Zstd compression.</span></small>

///right
[PhpRedisConnection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L-L target=_blank)
///

...Indicates if Redis supports Zstd compression.
```php:Definitation
protected bool|null $supportsZstd = null
```


**Type**: bool\|​null

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::$supportsZstd](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A%24supportsZstd "Illuminate\Redis\Connections\PhpRedisConnection::$supportsZstd") | ​<span class="summary">Indicates if Redis supports Zstd compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::flushdb()' class='anchor'></a>[m] flushdb <small><span class="summary">Flush the selected Redis database on all master nodes.</span></small>

///right
[PhpRedisClusterConnection.php#7~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisClusterConnection.php#L7-L23 target=_blank)
///

...Flush the selected Redis database on all master nodes.
```php:Definitation
public function flushdb(): mixed
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​override | ​[PhpRedisConnection::flushdb()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aflushdb%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::flushdb()") | ​<span class="summary">Flush the selected Redis database.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new PhpRedis connection.</span></small>

///right
[PhpRedisConnection.php#33~46](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L33-L46 target=_blank)
///

...Create a new PhpRedis connection.
```php:Definitation
public function __construct(
    Redis $client,
    ?callable|callable|null $connector = null,
    array $config = []
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Redis](#--Redis) | ​`$client` | ​<span class="summary"></span>
​?callable\|​callable\|​null | ​`$connector = null` | ​<span class="summary"></span>
​array | ​`$config = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::__construct()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A__construct%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::__construct()") | ​<span class="summary">Create a new PhpRedis connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::get()' class='anchor'></a>[m] get <small><span class="summary">Returns the value of the given key.</span></small>

///right
[PhpRedisConnection.php#48~59](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L48-L59 target=_blank)
///

...Returns the value of the given key.
```php:Definitation
public function get(string $key): string|null
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string\|​null | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::get()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aget%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::get()") | ​<span class="summary">Returns the value of the given key.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::mget()' class='anchor'></a>[m] mget <small><span class="summary">Get the values of all the given keys.</span></small>

///right
[PhpRedisConnection.php#61~72](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L61-L72 target=_blank)
///

...Get the values of all the given keys.
```php:Definitation
public function mget(array $keys): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$keys` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::mget()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Amget%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::mget()") | ​<span class="summary">Get the values of all the given keys.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::set()' class='anchor'></a>[m] set <small><span class="summary">Set the string value in the argument as the value of the key.</span></small>

///right
[PhpRedisConnection.php#74~91](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L74-L91 target=_blank)
///

...Set the string value in the argument as the value of the key.
```php:Definitation
public function set(
    string $key,
    mixed $value,
    string|null $expireResolution = null,
    int|null $expireTTL = null,
    string|null $flag = null
): bool
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$value` | ​<span class="summary"></span>
​string\|​null | ​`$expireResolution = null` | ​<span class="summary"></span>
​int\|​null | ​`$expireTTL = null` | ​<span class="summary"></span>
​string\|​null | ​`$flag = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::set()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aset%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::set()") | ​<span class="summary">Set the string value in the argument as the value of the key.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::setnx()' class='anchor'></a>[m] setnx <small><span class="summary">Set the given key if it doesn&apos;t exist.</span></small>

///right
[PhpRedisConnection.php#93~103](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L93-L103 target=_blank)
///

...Set the given key if it doesn't exist.
```php:Definitation
public function setnx(
    string $key,
    string $value
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​string | ​`$value` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::setnx()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Asetnx%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::setnx()") | ​<span class="summary">Set the given key if it doesn&apos;t exist.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::hmget()' class='anchor'></a>[m] hmget <small><span class="summary">Get the value of the given hash fields.</span></small>

///right
[PhpRedisConnection.php#105~119](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L105-L119 target=_blank)
///

...Get the value of the given hash fields.
```php:Definitation
public function hmget(
    string $key,
    mixed ...$dictionary
): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`...$dictionary` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::hmget()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ahmget%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::hmget()") | ​<span class="summary">Get the value of the given hash fields.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::hmset()' class='anchor'></a>[m] hmset <small><span class="summary">Set the given hash fields to their respective values.</span></small>

///right
[PhpRedisConnection.php#121~139](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L121-L139 target=_blank)
///

...Set the given hash fields to their respective values.
```php:Definitation
public function hmset(
    string $key,
    mixed ...$dictionary
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`...$dictionary` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::hmset()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ahmset%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::hmset()") | ​<span class="summary">Set the given hash fields to their respective values.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::hsetnx()' class='anchor'></a>[m] hsetnx <small><span class="summary">Set the given hash field if it doesn&apos;t exist.</span></small>

///right
[PhpRedisConnection.php#141~152](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L141-L152 target=_blank)
///

...Set the given hash field if it doesn't exist.
```php:Definitation
public function hsetnx(
    string $hash,
    string $key,
    string $value
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$hash` | ​<span class="summary"></span>
​string | ​`$key` | ​<span class="summary"></span>
​string | ​`$value` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::hsetnx()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ahsetnx%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::hsetnx()") | ​<span class="summary">Set the given hash field if it doesn&apos;t exist.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::lrem()' class='anchor'></a>[m] lrem <small><span class="summary">Removes the first count occurrences of the value element from the list.</span></small>

///right
[PhpRedisConnection.php#154~165](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L154-L165 target=_blank)
///

...Removes the first count occurrences of the value element from the list.
```php:Definitation
public function lrem(
    string $key,
    int $count,
    mixed $value
): int|false
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​int | ​`$count` | ​<span class="summary"></span>
​mixed | ​`$value` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int\|​false | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::lrem()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Alrem%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::lrem()") | ​<span class="summary">Removes the first count occurrences of the value element from the list.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::blpop()' class='anchor'></a>[m] blpop <small><span class="summary">Removes and returns the first element of the list stored at key.</span></small>

///right
[PhpRedisConnection.php#167~178](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L167-L178 target=_blank)
///

...Removes and returns the first element of the list stored at key.
```php:Definitation
public function blpop(mixed ...$arguments): array|null
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`...$arguments` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array\|​null | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::blpop()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ablpop%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::blpop()") | ​<span class="summary">Removes and returns the first element of the list stored at key.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::brpop()' class='anchor'></a>[m] brpop <small><span class="summary">Removes and returns the last element of the list stored at key.</span></small>

///right
[PhpRedisConnection.php#180~191](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L180-L191 target=_blank)
///

...Removes and returns the last element of the list stored at key.
```php:Definitation
public function brpop(mixed ...$arguments): array|null
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`...$arguments` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array\|​null | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::brpop()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Abrpop%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::brpop()") | ​<span class="summary">Removes and returns the last element of the list stored at key.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::spop()' class='anchor'></a>[m] spop <small><span class="summary">Removes and returns a random element from the set value at key.</span></small>

///right
[PhpRedisConnection.php#193~203](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L193-L203 target=_blank)
///

...Removes and returns a random element from the set value at key.
```php:Definitation
public function spop(
    string $key,
    int|null $count = 1
): mixed|false
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​int\|​null | ​`$count = 1` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed\|​false | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::spop()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aspop%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::spop()") | ​<span class="summary">Removes and returns a random element from the set value at key.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::zadd()' class='anchor'></a>[m] zadd <small><span class="summary">Add one or more members to a sorted set or update its score if it already exists.</span></small>

///right
[PhpRedisConnection.php#205~232](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L205-L232 target=_blank)
///

...Add one or more members to a sorted set or update its score if it already exists.
```php:Definitation
public function zadd(
    string $key,
    mixed ...$dictionary
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`...$dictionary` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::zadd()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azadd%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zadd()") | ​<span class="summary">Add one or more members to a sorted set or update its score if it already exists.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::zrangebyscore()' class='anchor'></a>[m] zrangebyscore <small><span class="summary">Return elements with score between $min and $max.</span></small>

///right
[PhpRedisConnection.php#234~253](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L234-L253 target=_blank)
///

...Return elements with score between $min and $max.
```php:Definitation
public function zrangebyscore(
    string $key,
    mixed $min,
    mixed $max,
    array $options = []
): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$min` | ​<span class="summary"></span>
​mixed | ​`$max` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::zrangebyscore()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azrangebyscore%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zrangebyscore()") | ​<span class="summary">Return elements with score between $min and $max.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::zrevrangebyscore()' class='anchor'></a>[m] zrevrangebyscore <small><span class="summary">Return elements with score between $min and $max.</span></small>

///right
[PhpRedisConnection.php#255~274](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L255-L274 target=_blank)
///

...Return elements with score between $min and $max.
```php:Definitation
public function zrevrangebyscore(
    string $key,
    mixed $min,
    mixed $max,
    array $options = []
): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$min` | ​<span class="summary"></span>
​mixed | ​`$max` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::zrevrangebyscore()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azrevrangebyscore%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zrevrangebyscore()") | ​<span class="summary">Return elements with score between $min and $max.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::zinterstore()' class='anchor'></a>[m] zinterstore <small><span class="summary">Find the intersection between sets and store in a new set.</span></small>

///right
[PhpRedisConnection.php#276~290](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L276-L290 target=_blank)
///

...Find the intersection between sets and store in a new set.
```php:Definitation
public function zinterstore(
    string $output,
    array $keys,
    array $options = []
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$output` | ​<span class="summary"></span>
​array | ​`$keys` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::zinterstore()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azinterstore%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zinterstore()") | ​<span class="summary">Find the intersection between sets and store in a new set.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::zunionstore()' class='anchor'></a>[m] zunionstore <small><span class="summary">Find the union between sets and store in a new set.</span></small>

///right
[PhpRedisConnection.php#292~306](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L292-L306 target=_blank)
///

...Find the union between sets and store in a new set.
```php:Definitation
public function zunionstore(
    string $output,
    array $keys,
    array $options = []
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$output` | ​<span class="summary"></span>
​array | ​`$keys` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::zunionstore()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azunionstore%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zunionstore()") | ​<span class="summary">Find the union between sets and store in a new set.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::scan()' class='anchor'></a>[m] scan <small><span class="summary">Scans all keys based on options.</span></small>

///right
[PhpRedisConnection.php#308~327](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L308-L327 target=_blank)
///

...Scans all keys based on options.
```php:Definitation
public function scan(
    mixed $cursor,
    array $options = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`$cursor` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::scan()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ascan%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::scan()") | ​<span class="summary">Scans all keys based on options.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::zscan()' class='anchor'></a>[m] zscan <small><span class="summary">Scans the given set for all values based on options.</span></small>

///right
[PhpRedisConnection.php#329~349](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L329-L349 target=_blank)
///

...Scans the given set for all values based on options.
```php:Definitation
public function zscan(
    string $key,
    mixed $cursor,
    array $options = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$cursor` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::zscan()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azscan%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zscan()") | ​<span class="summary">Scans the given set for all values based on options.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::hscan()' class='anchor'></a>[m] hscan <small><span class="summary">Scans the given hash for all values based on options.</span></small>

///right
[PhpRedisConnection.php#351~371](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L351-L371 target=_blank)
///

...Scans the given hash for all values based on options.
```php:Definitation
public function hscan(
    string $key,
    mixed $cursor,
    array $options = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$cursor` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::hscan()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ahscan%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::hscan()") | ​<span class="summary">Scans the given hash for all values based on options.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::sscan()' class='anchor'></a>[m] sscan <small><span class="summary">Scans the given set for all values based on options.</span></small>

///right
[PhpRedisConnection.php#373~393](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L373-L393 target=_blank)
///

...Scans the given set for all values based on options.
```php:Definitation
public function sscan(
    string $key,
    mixed $cursor,
    array $options = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$cursor` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::sscan()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Asscan%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::sscan()") | ​<span class="summary">Scans the given set for all values based on options.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::pipeline()' class='anchor'></a>[m] pipeline <small><span class="summary">Execute commands in a pipeline.</span></small>

///right
[PhpRedisConnection.php#395~408](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L395-L408 target=_blank)
///

...Execute commands in a pipeline.
```php:Definitation
public function pipeline(?callable|callable|null $callback = null): Redis|array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​?callable\|​callable\|​null | ​`$callback = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Redis](#--Redis)\|​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::pipeline()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Apipeline%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::pipeline()") | ​<span class="summary">Execute commands in a pipeline.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::transaction()' class='anchor'></a>[m] transaction <small><span class="summary">Execute commands in a transaction.</span></small>

///right
[PhpRedisConnection.php#410~423](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L410-L423 target=_blank)
///

...Execute commands in a transaction.
```php:Definitation
public function transaction(?callable|callable|null $callback = null): Redis|array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​?callable\|​callable\|​null | ​`$callback = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Redis](#--Redis)\|​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::transaction()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Atransaction%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::transaction()") | ​<span class="summary">Execute commands in a transaction.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::evalsha()' class='anchor'></a>[m] evalsha <small><span class="summary">Evaluate a LUA script serverside, from the SHA1 hash of the script instead of the script itself.</span></small>

///right
[PhpRedisConnection.php#425~438](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L425-L438 target=_blank)
///

...Evaluate a LUA script serverside, from the SHA1 hash of the script instead of the script itself.
```php:Definitation
public function evalsha(
    string $script,
    int $numkeys,
    mixed ...$arguments
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$script` | ​<span class="summary"></span>
​int | ​`$numkeys` | ​<span class="summary"></span>
​mixed | ​`...$arguments` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::evalsha()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aevalsha%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::evalsha()") | ​<span class="summary">Evaluate a LUA script serverside, from the SHA1 hash of the script instead of the script itself.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::eval()' class='anchor'></a>[m] eval <small><span class="summary">Evaluate a script and return its result.</span></small>

///right
[PhpRedisConnection.php#440~451](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L440-L451 target=_blank)
///

...Evaluate a script and return its result.
```php:Definitation
public function eval(
    string $script,
    int $numberOfKeys,
    dynamic ...$arguments
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$script` | ​<span class="summary"></span>
​int | ​`$numberOfKeys` | ​<span class="summary"></span>
​[dynamic](#--dynamic) | ​`...$arguments` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::eval()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aeval%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::eval()") | ​<span class="summary">Evaluate a script and return its result.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::subscribe()' class='anchor'></a>[m] subscribe <small><span class="summary">Subscribe to a set of given channels for messages.</span></small>

///right
[PhpRedisConnection.php#453~465](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L453-L465 target=_blank)
///

...Subscribe to a set of given channels for messages.
```php:Definitation
public function subscribe(
    array|string $channels,
    \Closure $callback
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::subscribe()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Asubscribe%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::subscribe()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::psubscribe()' class='anchor'></a>[m] psubscribe <small><span class="summary">Subscribe to a set of given channels with wildcards.</span></small>

///right
[PhpRedisConnection.php#467~479](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L467-L479 target=_blank)
///

...Subscribe to a set of given channels with wildcards.
```php:Definitation
public function psubscribe(
    array|string $channels,
    \Closure $callback
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::psubscribe()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Apsubscribe%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::psubscribe()") | ​<span class="summary">Subscribe to a set of given channels with wildcards.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::createSubscription()' class='anchor'></a>[m] createSubscription <small><span class="summary">Subscribe to a set of given channels for messages.</span></small>

///right
[PhpRedisConnection.php#481~492](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L481-L492 target=_blank)
///

...Subscribe to a set of given channels for messages.
```php:Definitation
public function createSubscription(
    array|string $channels,
    \Closure $callback,
    string $method = "subscribe"
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>
​string | ​`$method = "subscribe"` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::createSubscription()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AcreateSubscription%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::createSubscription()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::executeRaw()' class='anchor'></a>[m] executeRaw <small><span class="summary">Execute a raw command.</span></small>

///right
[PhpRedisConnection.php#510~519](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L510-L519 target=_blank)
///

...Execute a raw command.
```php:Definitation
public function executeRaw(array $parameters): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::executeRaw()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AexecuteRaw%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::executeRaw()") | ​<span class="summary">Execute a raw command.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::command()' class='anchor'></a>[m] command <small><span class="summary">Run a command against the Redis database.</span></small>

///right
[PhpRedisConnection.php#521~541](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L521-L541 target=_blank)
///

...Run a command against the Redis database.
```php:Definitation
public function command(
    string $method,
    array $parameters = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[RedisException](#--RedisException) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::command()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Acommand%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::command()") | ​<span class="summary">Run a command against the Redis database.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::disconnect()' class='anchor'></a>[m] disconnect <small><span class="summary">Disconnects from the Redis instance.</span></small>

///right
[PhpRedisConnection.php#543~551](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L543-L551 target=_blank)
///

...Disconnects from the Redis instance.
```php:Definitation
public function disconnect(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::disconnect()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Adisconnect%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::disconnect()") | ​<span class="summary">Disconnects from the Redis instance.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::__call()' class='anchor'></a>[m] \_\_call <small><span class="summary">Pass other method calls down to the underlying client.</span></small>

///right
[PhpRedisConnection.php#566~576](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L566-L576 target=_blank)
///

...Pass other method calls down to the underlying client.
```php:Definitation
public function __call(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::__call()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A__call%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::__call()") | ​<span class="summary">Pass other method calls down to the underlying client.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::funnel()' class='anchor'></a>[m] funnel <small><span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span></small>

///right
[Connection.php#49~58](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L49-L58 target=_blank)
///

...Funnel a callback for a maximum number of simultaneous executions.
```php:Definitation
public function funnel(string $name): Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ConcurrencyLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::funnel()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Afunnel%28%29 "Illuminate\Redis\Connections\Connection::funnel()") | ​<span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::throttle()' class='anchor'></a>[m] throttle <small><span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span></small>

///right
[Connection.php#60~69](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L60-L69 target=_blank)
///

...Throttle a callback for a maximum number of executions over a given duration.
```php:Definitation
public function throttle(string $name): Illuminate\Redis\Limiters\DurationLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[DurationLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::throttle()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Athrottle%28%29 "Illuminate\Redis\Connections\Connection::throttle()") | ​<span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::client()' class='anchor'></a>[m] client <small><span class="summary">Get the underlying Redis client.</span></small>

///right
[Connection.php#71~79](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L71-L79 target=_blank)
///

...Get the underlying Redis client.
```php:Definitation
public function client(): mixed
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::client()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Aclient%28%29 "Illuminate\Redis\Connections\Connection::client()") | ​<span class="summary">Get the underlying Redis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::event()' class='anchor'></a>[m] event <small><span class="summary">Fire the given event if possible.</span></small>

///right
[Connection.php#127~138](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L127-L138 target=_blank)
///

...Fire the given event if possible.
```php:Definitation
protected function event(mixed $event): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`$event` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::event()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Aevent%28%29 "Illuminate\Redis\Connections\Connection::event()") | ​<span class="summary">Fire the given event if possible.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::listen()' class='anchor'></a>[m] listen <small><span class="summary">Register a Redis command listener with the connection.</span></small>

///right
[Connection.php#140~151](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L140-L151 target=_blank)
///

...Register a Redis command listener with the connection.
```php:Definitation
public function listen(\Closure $callback): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::listen()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Alisten%28%29 "Illuminate\Redis\Connections\Connection::listen()") | ​<span class="summary">Register a Redis command listener with the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::getName()' class='anchor'></a>[m] getName <small><span class="summary">Get the connection name.</span></small>

///right
[Connection.php#153~161](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L153-L161 target=_blank)
///

...Get the connection name.
```php:Definitation
public function getName(): string|null
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string\|​null | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::getName()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AgetName%28%29 "Illuminate\Redis\Connections\Connection::getName()") | ​<span class="summary">Get the connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::setName()' class='anchor'></a>[m] setName <small><span class="summary">Set the connections name.</span></small>

///right
[Connection.php#163~174](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L163-L174 target=_blank)
///

...Set the connections name.
```php:Definitation
public function setName(string $name): Illuminate\Redis\Connections\Connection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setName()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AsetName%28%29 "Illuminate\Redis\Connections\Connection::setName()") | ​<span class="summary">Set the connections name.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::getEventDispatcher()' class='anchor'></a>[m] getEventDispatcher <small><span class="summary">Get the event dispatcher used by the connection.</span></small>

///right
[Connection.php#176~184](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L176-L184 target=_blank)
///

...Get the event dispatcher used by the connection.
```php:Definitation
public function getEventDispatcher(): Illuminate\Contracts\Events\Dispatcher
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Dispatcher](#--Illuminate-Contracts-Events-Dispatcher) | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::getEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AgetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::getEventDispatcher()") | ​<span class="summary">Get the event dispatcher used by the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::setEventDispatcher()' class='anchor'></a>[m] setEventDispatcher <small><span class="summary">Set the event dispatcher instance on the connection.</span></small>

///right
[Connection.php#186~195](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L186-L195 target=_blank)
///

...Set the event dispatcher instance on the connection.
```php:Definitation
public function setEventDispatcher(Illuminate\Contracts\Events\Dispatcher $events): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Dispatcher](#--Illuminate-Contracts-Events-Dispatcher) | ​`$events` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::setEventDispatcher()") | ​<span class="summary">Set the event dispatcher instance on the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::unsetEventDispatcher()' class='anchor'></a>[m] unsetEventDispatcher <small><span class="summary">Unset the event dispatcher instance on the connection.</span></small>

///right
[Connection.php#197~205](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L197-L205 target=_blank)
///

...Unset the event dispatcher instance on the connection.
```php:Definitation
public function unsetEventDispatcher(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::unsetEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AunsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::unsetEventDispatcher()") | ​<span class="summary">Unset the event dispatcher instance on the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::macro()' class='anchor'></a>[M] macro <small><span class="summary">Register a custom macro.</span></small>

///right
[Macroable.php#19~29](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L19-L29 target=_blank)
///

...Register a custom macro.
```php:Definitation
public static function macro(
    string $name,
    object|callable $macro
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>
​object\|​callable | ​`$macro` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::macro()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Amacro%28%29 "Illuminate\Redis\Connections\Connection::macro()") | ​<span class="summary">Register a custom macro.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::mixin()' class='anchor'></a>[M] mixin <small><span class="summary">Mix another object into the class.</span></small>

///right
[Macroable.php#31~52](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L31-L52 target=_blank)
///

...Mix another object into the class.
```php:Definitation
public static function mixin(
    object $mixin,
    bool $replace = true
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​object | ​`$mixin` | ​<span class="summary"></span>
​bool | ​`$replace = true` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ReflectionException](https://php.net/manual/class.reflectionexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::mixin()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Amixin%28%29 "Illuminate\Redis\Connections\Connection::mixin()") | ​<span class="summary">Mix another object into the class.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::hasMacro()' class='anchor'></a>[M] hasMacro <small><span class="summary">Checks if macro is registered.</span></small>

///right
[Macroable.php#54~63](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L54-L63 target=_blank)
///

...Checks if macro is registered.
```php:Definitation
public static function hasMacro(string $name): bool
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::hasMacro()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AhasMacro%28%29 "Illuminate\Redis\Connections\Connection::hasMacro()") | ​<span class="summary">Checks if macro is registered.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::flushMacros()' class='anchor'></a>[M] flushMacros <small><span class="summary">Flush the existing macros.</span></small>

///right
[Macroable.php#65~73](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L65-L73 target=_blank)
///

...Flush the existing macros.
```php:Definitation
public static function flushMacros(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::flushMacros()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AflushMacros%28%29 "Illuminate\Redis\Connections\Connection::flushMacros()") | ​<span class="summary">Flush the existing macros.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::__callStatic()' class='anchor'></a>[M] \_\_callStatic <small><span class="summary">Dynamically handle calls to the class.</span></small>

///right
[Macroable.php#75~99](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L75-L99 target=_blank)
///

...Dynamically handle calls to the class.
```php:Definitation
public static function __callStatic(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[BadMethodCallException](https://php.net/manual/class.badmethodcallexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::__callStatic()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A__callStatic%28%29 "Illuminate\Redis\Connections\Connection::__callStatic()") | ​<span class="summary">Dynamically handle calls to the class.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::macroCall()' class='anchor'></a>[m] macroCall <small><span class="summary">Dynamically handle calls to the class.</span></small>

///right
[Macroable.php#101~125](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L101-L125 target=_blank)
///

...Dynamically handle calls to the class.
```php:Definitation
public function macroCall(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[BadMethodCallException](https://php.net/manual/class.badmethodcallexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::macroCall()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AmacroCall%28%29 "Illuminate\Redis\Connections\Connection::macroCall()") | ​<span class="summary">Dynamically handle calls to the class.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::pack()' class='anchor'></a>[m] pack <small><span class="summary">Prepares the given values to be used with the `eval` command, including serialization and compression.</span></small>

///right
[PacksPhpRedisValues.php#32~83](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L32-L83 target=_blank)
///

...Prepares the given values to be used with the `eval` command, including serialization and compression.
```php:Definitation
public function pack(array $values): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$values` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::pack()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Apack%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::pack()") | ​<span class="summary">Prepares the given values to be used with the `eval` command, including serialization and compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::compressed()' class='anchor'></a>[m] compressed <small><span class="summary">Determine if compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#85~94](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L85-L94 target=_blank)
///

...Determine if compression is enabled.
```php:Definitation
public function compressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::compressed()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Acompressed%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::compressed()") | ​<span class="summary">Determine if compression is enabled.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::lzfCompressed()' class='anchor'></a>[m] lzfCompressed <small><span class="summary">Determine if LZF compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#96~105](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L96-L105 target=_blank)
///

...Determine if LZF compression is enabled.
```php:Definitation
public function lzfCompressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::lzfCompressed()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AlzfCompressed%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::lzfCompressed()") | ​<span class="summary">Determine if LZF compression is enabled.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::zstdCompressed()' class='anchor'></a>[m] zstdCompressed <small><span class="summary">Determine if ZSTD compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#107~116](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L107-L116 target=_blank)
///

...Determine if ZSTD compression is enabled.
```php:Definitation
public function zstdCompressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::zstdCompressed()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AzstdCompressed%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zstdCompressed()") | ​<span class="summary">Determine if ZSTD compression is enabled.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::lz4Compressed()' class='anchor'></a>[m] lz4Compressed <small><span class="summary">Determine if LZ4 compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#118~127](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L118-L127 target=_blank)
///

...Determine if LZ4 compression is enabled.
```php:Definitation
public function lz4Compressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::lz4Compressed()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Alz4Compressed%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::lz4Compressed()") | ​<span class="summary">Determine if LZ4 compression is enabled.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::supportsPacking()' class='anchor'></a>[m] supportsPacking <small><span class="summary">Determine if the current PhpRedis extension version supports packing.</span></small>

///right
[PacksPhpRedisValues.php#129~141](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L129-L141 target=_blank)
///

...Determine if the current PhpRedis extension version supports packing.
```php:Definitation
protected function supportsPacking(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::supportsPacking()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AsupportsPacking%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::supportsPacking()") | ​<span class="summary">Determine if the current PhpRedis extension version supports packing.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::supportsLzf()' class='anchor'></a>[m] supportsLzf <small><span class="summary">Determine if the current PhpRedis extension version supports LZF compression.</span></small>

///right
[PacksPhpRedisValues.php#143~155](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L143-L155 target=_blank)
///

...Determine if the current PhpRedis extension version supports LZF compression.
```php:Definitation
protected function supportsLzf(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::supportsLzf()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AsupportsLzf%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::supportsLzf()") | ​<span class="summary">Determine if the current PhpRedis extension version supports LZF compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::supportsZstd()' class='anchor'></a>[m] supportsZstd <small><span class="summary">Determine if the current PhpRedis extension version supports Zstd compression.</span></small>

///right
[PacksPhpRedisValues.php#157~169](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L157-L169 target=_blank)
///

...Determine if the current PhpRedis extension version supports Zstd compression.
```php:Definitation
protected function supportsZstd(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::supportsZstd()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AsupportsZstd%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::supportsZstd()") | ​<span class="summary">Determine if the current PhpRedis extension version supports Zstd compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::phpRedisVersionAtLeast()' class='anchor'></a>[m] phpRedisVersionAtLeast <small><span class="summary">Determine if the PhpRedis extension version is at least the given version.</span></small>

///right
[PacksPhpRedisValues.php#171~182](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L171-L182 target=_blank)
///

...Determine if the PhpRedis extension version is at least the given version.
```php:Definitation
protected function phpRedisVersionAtLeast(string $version): bool
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$version` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::phpRedisVersionAtLeast()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AphpRedisVersionAtLeast%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::phpRedisVersionAtLeast()") | ​<span class="summary">Determine if the PhpRedis extension version is at least the given version.</span>


...


### <a id='Illuminate-Redis-Connections-PhpRedisConnection' class='anchor'></a>[C] PhpRedisConnection <small><span class="summary"></span></small>

///right
[PhpRedisConnection.php#12~577](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L12-L577 target=_blank)
///



**Hierarchy**

+ [Illuminate\Redis\Connections\Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")
    + **[Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")**
        + [Illuminate\Redis\Connections\PhpRedisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection")
    + [Illuminate\Redis\Connections\PredisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection")
        + [Illuminate\Redis\Connections\PredisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection")


:Parents
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>

:Implements
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](#--Illuminate-Contracts-Redis-Connection) | ​<span class="summary"></span>

:Uses
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[PacksPhpRedisValues](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues "Illuminate\Redis\Connections\PacksPhpRedisValues") | ​<span class="summary"></span>


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$connector' class='anchor'></a>[p] $connector <small><span class="summary">The connection creation callback.</span></small>

///right
[PhpRedisConnection.php#19~24](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L19-L24 target=_blank)
///

...The connection creation callback.
```php:Definitation
protected callable $connector = null
```


**Type**: callable



...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$config' class='anchor'></a>[p] $config <small><span class="summary">The connection configuration array.</span></small>

///right
[PhpRedisConnection.php#26~31](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L26-L31 target=_blank)
///

...The connection configuration array.
```php:Definitation
protected array $config = null
```


**Type**: array



...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$client' class='anchor'></a>[p] $client <small><span class="summary">The Redis client.</span></small>

///right
[Connection.php#18~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L18-L23 target=_blank)
///

...The Redis client.
```php:Definitation
protected Redis $client = null
```


**Type**: [Redis](#--Redis)

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$client](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24client "Illuminate\Redis\Connections\Connection::$client") | ​<span class="summary">The Redis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$name' class='anchor'></a>[p] $name <small><span class="summary">The Redis connection name.</span></small>

///right
[Connection.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L25-L30 target=_blank)
///

...The Redis connection name.
```php:Definitation
protected string|null $name = null
```


**Type**: string\|​null

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$name](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24name "Illuminate\Redis\Connections\Connection::$name") | ​<span class="summary">The Redis connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$events' class='anchor'></a>[p] $events <small><span class="summary">The event dispatcher instance.</span></small>

///right
[Connection.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L32-L37 target=_blank)
///

...The event dispatcher instance.
```php:Definitation
protected Illuminate\Contracts\Events\Dispatcher $events = null
```


**Type**: [Dispatcher](#--Illuminate-Contracts-Events-Dispatcher)

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$events](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24events "Illuminate\Redis\Connections\Connection::$events") | ​<span class="summary">The event dispatcher instance.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$macros' class='anchor'></a>[P] $macros <small><span class="summary">The registered string macros.</span></small>

///right
[Connection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L-L target=_blank)
///

...The registered string macros.
```php:Definitation
protected static array $macros = []
```


**Type**: array

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$macros](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24macros "Illuminate\Redis\Connections\Connection::$macros") | ​<span class="summary">The registered string macros.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$supportsPacking' class='anchor'></a>[p] $supportsPacking <small><span class="summary">Indicates if Redis supports packing.</span></small>

///right
[PacksPhpRedisValues.php#11~16](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L11-L16 target=_blank)
///

...Indicates if Redis supports packing.
```php:Definitation
protected bool|null $supportsPacking = null
```


**Type**: bool\|​null

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::$supportsPacking](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3A%24supportsPacking "Illuminate\Redis\Connections\PacksPhpRedisValues::$supportsPacking") | ​<span class="summary">Indicates if Redis supports packing.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$supportsLzf' class='anchor'></a>[p] $supportsLzf <small><span class="summary">Indicates if Redis supports LZF compression.</span></small>

///right
[PacksPhpRedisValues.php#18~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L18-L23 target=_blank)
///

...Indicates if Redis supports LZF compression.
```php:Definitation
protected bool|null $supportsLzf = null
```


**Type**: bool\|​null

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::$supportsLzf](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3A%24supportsLzf "Illuminate\Redis\Connections\PacksPhpRedisValues::$supportsLzf") | ​<span class="summary">Indicates if Redis supports LZF compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$supportsZstd' class='anchor'></a>[p] $supportsZstd <small><span class="summary">Indicates if Redis supports Zstd compression.</span></small>

///right
[PacksPhpRedisValues.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L25-L30 target=_blank)
///

...Indicates if Redis supports Zstd compression.
```php:Definitation
protected bool|null $supportsZstd = null
```


**Type**: bool\|​null

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::$supportsZstd](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3A%24supportsZstd "Illuminate\Redis\Connections\PacksPhpRedisValues::$supportsZstd") | ​<span class="summary">Indicates if Redis supports Zstd compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new PhpRedis connection.</span></small>

///right
[PhpRedisConnection.php#33~46](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L33-L46 target=_blank)
///

...Create a new PhpRedis connection.
```php:Definitation
public function __construct(
    Redis $client,
    ?callable|callable|null $connector = null,
    array $config = []
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Redis](#--Redis) | ​`$client` | ​<span class="summary"></span>
​?callable\|​callable\|​null | ​`$connector = null` | ​<span class="summary"></span>
​array | ​`$config = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::get()' class='anchor'></a>[m] get <small><span class="summary">Returns the value of the given key.</span></small>

///right
[PhpRedisConnection.php#48~59](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L48-L59 target=_blank)
///

...Returns the value of the given key.
```php:Definitation
public function get(string $key): string|null
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string\|​null | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::mget()' class='anchor'></a>[m] mget <small><span class="summary">Get the values of all the given keys.</span></small>

///right
[PhpRedisConnection.php#61~72](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L61-L72 target=_blank)
///

...Get the values of all the given keys.
```php:Definitation
public function mget(array $keys): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$keys` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::set()' class='anchor'></a>[m] set <small><span class="summary">Set the string value in the argument as the value of the key.</span></small>

///right
[PhpRedisConnection.php#74~91](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L74-L91 target=_blank)
///

...Set the string value in the argument as the value of the key.
```php:Definitation
public function set(
    string $key,
    mixed $value,
    string|null $expireResolution = null,
    int|null $expireTTL = null,
    string|null $flag = null
): bool
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$value` | ​<span class="summary"></span>
​string\|​null | ​`$expireResolution = null` | ​<span class="summary"></span>
​int\|​null | ​`$expireTTL = null` | ​<span class="summary"></span>
​string\|​null | ​`$flag = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::setnx()' class='anchor'></a>[m] setnx <small><span class="summary">Set the given key if it doesn&apos;t exist.</span></small>

///right
[PhpRedisConnection.php#93~103](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L93-L103 target=_blank)
///

...Set the given key if it doesn't exist.
```php:Definitation
public function setnx(
    string $key,
    string $value
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​string | ​`$value` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::hmget()' class='anchor'></a>[m] hmget <small><span class="summary">Get the value of the given hash fields.</span></small>

///right
[PhpRedisConnection.php#105~119](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L105-L119 target=_blank)
///

...Get the value of the given hash fields.
```php:Definitation
public function hmget(
    string $key,
    mixed ...$dictionary
): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`...$dictionary` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::hmset()' class='anchor'></a>[m] hmset <small><span class="summary">Set the given hash fields to their respective values.</span></small>

///right
[PhpRedisConnection.php#121~139](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L121-L139 target=_blank)
///

...Set the given hash fields to their respective values.
```php:Definitation
public function hmset(
    string $key,
    mixed ...$dictionary
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`...$dictionary` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::hsetnx()' class='anchor'></a>[m] hsetnx <small><span class="summary">Set the given hash field if it doesn&apos;t exist.</span></small>

///right
[PhpRedisConnection.php#141~152](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L141-L152 target=_blank)
///

...Set the given hash field if it doesn't exist.
```php:Definitation
public function hsetnx(
    string $hash,
    string $key,
    string $value
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$hash` | ​<span class="summary"></span>
​string | ​`$key` | ​<span class="summary"></span>
​string | ​`$value` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::lrem()' class='anchor'></a>[m] lrem <small><span class="summary">Removes the first count occurrences of the value element from the list.</span></small>

///right
[PhpRedisConnection.php#154~165](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L154-L165 target=_blank)
///

...Removes the first count occurrences of the value element from the list.
```php:Definitation
public function lrem(
    string $key,
    int $count,
    mixed $value
): int|false
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​int | ​`$count` | ​<span class="summary"></span>
​mixed | ​`$value` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int\|​false | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::blpop()' class='anchor'></a>[m] blpop <small><span class="summary">Removes and returns the first element of the list stored at key.</span></small>

///right
[PhpRedisConnection.php#167~178](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L167-L178 target=_blank)
///

...Removes and returns the first element of the list stored at key.
```php:Definitation
public function blpop(mixed ...$arguments): array|null
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`...$arguments` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array\|​null | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::brpop()' class='anchor'></a>[m] brpop <small><span class="summary">Removes and returns the last element of the list stored at key.</span></small>

///right
[PhpRedisConnection.php#180~191](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L180-L191 target=_blank)
///

...Removes and returns the last element of the list stored at key.
```php:Definitation
public function brpop(mixed ...$arguments): array|null
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`...$arguments` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array\|​null | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::spop()' class='anchor'></a>[m] spop <small><span class="summary">Removes and returns a random element from the set value at key.</span></small>

///right
[PhpRedisConnection.php#193~203](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L193-L203 target=_blank)
///

...Removes and returns a random element from the set value at key.
```php:Definitation
public function spop(
    string $key,
    int|null $count = 1
): mixed|false
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​int\|​null | ​`$count = 1` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed\|​false | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::zadd()' class='anchor'></a>[m] zadd <small><span class="summary">Add one or more members to a sorted set or update its score if it already exists.</span></small>

///right
[PhpRedisConnection.php#205~232](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L205-L232 target=_blank)
///

...Add one or more members to a sorted set or update its score if it already exists.
```php:Definitation
public function zadd(
    string $key,
    mixed ...$dictionary
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`...$dictionary` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::zrangebyscore()' class='anchor'></a>[m] zrangebyscore <small><span class="summary">Return elements with score between $min and $max.</span></small>

///right
[PhpRedisConnection.php#234~253](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L234-L253 target=_blank)
///

...Return elements with score between $min and $max.
```php:Definitation
public function zrangebyscore(
    string $key,
    mixed $min,
    mixed $max,
    array $options = []
): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$min` | ​<span class="summary"></span>
​mixed | ​`$max` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::zrevrangebyscore()' class='anchor'></a>[m] zrevrangebyscore <small><span class="summary">Return elements with score between $min and $max.</span></small>

///right
[PhpRedisConnection.php#255~274](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L255-L274 target=_blank)
///

...Return elements with score between $min and $max.
```php:Definitation
public function zrevrangebyscore(
    string $key,
    mixed $min,
    mixed $max,
    array $options = []
): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$min` | ​<span class="summary"></span>
​mixed | ​`$max` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::zinterstore()' class='anchor'></a>[m] zinterstore <small><span class="summary">Find the intersection between sets and store in a new set.</span></small>

///right
[PhpRedisConnection.php#276~290](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L276-L290 target=_blank)
///

...Find the intersection between sets and store in a new set.
```php:Definitation
public function zinterstore(
    string $output,
    array $keys,
    array $options = []
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$output` | ​<span class="summary"></span>
​array | ​`$keys` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::zunionstore()' class='anchor'></a>[m] zunionstore <small><span class="summary">Find the union between sets and store in a new set.</span></small>

///right
[PhpRedisConnection.php#292~306](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L292-L306 target=_blank)
///

...Find the union between sets and store in a new set.
```php:Definitation
public function zunionstore(
    string $output,
    array $keys,
    array $options = []
): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$output` | ​<span class="summary"></span>
​array | ​`$keys` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::scan()' class='anchor'></a>[m] scan <small><span class="summary">Scans all keys based on options.</span></small>

///right
[PhpRedisConnection.php#308~327](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L308-L327 target=_blank)
///

...Scans all keys based on options.
```php:Definitation
public function scan(
    mixed $cursor,
    array $options = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`$cursor` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::zscan()' class='anchor'></a>[m] zscan <small><span class="summary">Scans the given set for all values based on options.</span></small>

///right
[PhpRedisConnection.php#329~349](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L329-L349 target=_blank)
///

...Scans the given set for all values based on options.
```php:Definitation
public function zscan(
    string $key,
    mixed $cursor,
    array $options = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$cursor` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::hscan()' class='anchor'></a>[m] hscan <small><span class="summary">Scans the given hash for all values based on options.</span></small>

///right
[PhpRedisConnection.php#351~371](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L351-L371 target=_blank)
///

...Scans the given hash for all values based on options.
```php:Definitation
public function hscan(
    string $key,
    mixed $cursor,
    array $options = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$cursor` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::sscan()' class='anchor'></a>[m] sscan <small><span class="summary">Scans the given set for all values based on options.</span></small>

///right
[PhpRedisConnection.php#373~393](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L373-L393 target=_blank)
///

...Scans the given set for all values based on options.
```php:Definitation
public function sscan(
    string $key,
    mixed $cursor,
    array $options = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​mixed | ​`$cursor` | ​<span class="summary"></span>
​array | ​`$options = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::pipeline()' class='anchor'></a>[m] pipeline <small><span class="summary">Execute commands in a pipeline.</span></small>

///right
[PhpRedisConnection.php#395~408](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L395-L408 target=_blank)
///

...Execute commands in a pipeline.
```php:Definitation
public function pipeline(?callable|callable|null $callback = null): Redis|array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​?callable\|​callable\|​null | ​`$callback = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Redis](#--Redis)\|​array | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::transaction()' class='anchor'></a>[m] transaction <small><span class="summary">Execute commands in a transaction.</span></small>

///right
[PhpRedisConnection.php#410~423](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L410-L423 target=_blank)
///

...Execute commands in a transaction.
```php:Definitation
public function transaction(?callable|callable|null $callback = null): Redis|array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​?callable\|​callable\|​null | ​`$callback = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Redis](#--Redis)\|​array | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::evalsha()' class='anchor'></a>[m] evalsha <small><span class="summary">Evaluate a LUA script serverside, from the SHA1 hash of the script instead of the script itself.</span></small>

///right
[PhpRedisConnection.php#425~438](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L425-L438 target=_blank)
///

...Evaluate a LUA script serverside, from the SHA1 hash of the script instead of the script itself.
```php:Definitation
public function evalsha(
    string $script,
    int $numkeys,
    mixed ...$arguments
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$script` | ​<span class="summary"></span>
​int | ​`$numkeys` | ​<span class="summary"></span>
​mixed | ​`...$arguments` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::eval()' class='anchor'></a>[m] eval <small><span class="summary">Evaluate a script and return its result.</span></small>

///right
[PhpRedisConnection.php#440~451](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L440-L451 target=_blank)
///

...Evaluate a script and return its result.
```php:Definitation
public function eval(
    string $script,
    int $numberOfKeys,
    dynamic ...$arguments
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$script` | ​<span class="summary"></span>
​int | ​`$numberOfKeys` | ​<span class="summary"></span>
​[dynamic](#--dynamic) | ​`...$arguments` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::subscribe()' class='anchor'></a>[m] subscribe <small><span class="summary">Subscribe to a set of given channels for messages.</span></small>

///right
[PhpRedisConnection.php#453~465](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L453-L465 target=_blank)
///

...Subscribe to a set of given channels for messages.
```php:Definitation
public function subscribe(
    array|string $channels,
    \Closure $callback
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​implement | ​[Connection::subscribe()](#--Illuminate-Contracts-Redis-Connection%3A%3Asubscribe%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::psubscribe()' class='anchor'></a>[m] psubscribe <small><span class="summary">Subscribe to a set of given channels with wildcards.</span></small>

///right
[PhpRedisConnection.php#467~479](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L467-L479 target=_blank)
///

...Subscribe to a set of given channels with wildcards.
```php:Definitation
public function psubscribe(
    array|string $channels,
    \Closure $callback
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​implement | ​[Connection::psubscribe()](#--Illuminate-Contracts-Redis-Connection%3A%3Apsubscribe%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::createSubscription()' class='anchor'></a>[m] createSubscription <small><span class="summary">Subscribe to a set of given channels for messages.</span></small>

///right
[PhpRedisConnection.php#481~492](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L481-L492 target=_blank)
///

...Subscribe to a set of given channels for messages.
```php:Definitation
public function createSubscription(
    array|string $channels,
    \Closure $callback,
    string $method = "subscribe"
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>
​string | ​`$method = "subscribe"` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​override | ​[Connection::createSubscription()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AcreateSubscription%28%29 "Illuminate\Redis\Connections\Connection::createSubscription()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::flushdb()' class='anchor'></a>[m] flushdb <small><span class="summary">Flush the selected Redis database.</span></small>

///right
[PhpRedisConnection.php#494~508](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L494-L508 target=_blank)
///

...Flush the selected Redis database.
```php:Definitation
public function flushdb(): mixed
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::executeRaw()' class='anchor'></a>[m] executeRaw <small><span class="summary">Execute a raw command.</span></small>

///right
[PhpRedisConnection.php#510~519](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L510-L519 target=_blank)
///

...Execute a raw command.
```php:Definitation
public function executeRaw(array $parameters): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::command()' class='anchor'></a>[m] command <small><span class="summary">Run a command against the Redis database.</span></small>

///right
[PhpRedisConnection.php#521~541](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L521-L541 target=_blank)
///

...Run a command against the Redis database.
```php:Definitation
public function command(
    string $method,
    array $parameters = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[RedisException](#--RedisException) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​implement | ​[Connection::command()](#--Illuminate-Contracts-Redis-Connection%3A%3Acommand%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::disconnect()' class='anchor'></a>[m] disconnect <small><span class="summary">Disconnects from the Redis instance.</span></small>

///right
[PhpRedisConnection.php#543~551](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L543-L551 target=_blank)
///

...Disconnects from the Redis instance.
```php:Definitation
public function disconnect(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::applyPrefix()' class='anchor'></a>[m] applyPrefix <small><span class="summary">Apply a prefix to the given key if necessary.</span></small>

///right
[PhpRedisConnection.php#553~564](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L553-L564 target=_blank)
///

...Apply a prefix to the given key if necessary.
```php:Definitation
private function applyPrefix(string $key): string
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::__call()' class='anchor'></a>[m] \_\_call <small><span class="summary">Pass other method calls down to the underlying client.</span></small>

///right
[PhpRedisConnection.php#566~576](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L566-L576 target=_blank)
///

...Pass other method calls down to the underlying client.
```php:Definitation
public function __call(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​override | ​[Connection::__call()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A__call%28%29 "Illuminate\Redis\Connections\Connection::__call()") | ​<span class="summary">Pass other method calls down to the underlying client.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::funnel()' class='anchor'></a>[m] funnel <small><span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span></small>

///right
[Connection.php#49~58](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L49-L58 target=_blank)
///

...Funnel a callback for a maximum number of simultaneous executions.
```php:Definitation
public function funnel(string $name): Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ConcurrencyLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::funnel()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Afunnel%28%29 "Illuminate\Redis\Connections\Connection::funnel()") | ​<span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::throttle()' class='anchor'></a>[m] throttle <small><span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span></small>

///right
[Connection.php#60~69](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L60-L69 target=_blank)
///

...Throttle a callback for a maximum number of executions over a given duration.
```php:Definitation
public function throttle(string $name): Illuminate\Redis\Limiters\DurationLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[DurationLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::throttle()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Athrottle%28%29 "Illuminate\Redis\Connections\Connection::throttle()") | ​<span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::client()' class='anchor'></a>[m] client <small><span class="summary">Get the underlying Redis client.</span></small>

///right
[Connection.php#71~79](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L71-L79 target=_blank)
///

...Get the underlying Redis client.
```php:Definitation
public function client(): mixed
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::client()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Aclient%28%29 "Illuminate\Redis\Connections\Connection::client()") | ​<span class="summary">Get the underlying Redis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::event()' class='anchor'></a>[m] event <small><span class="summary">Fire the given event if possible.</span></small>

///right
[Connection.php#127~138](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L127-L138 target=_blank)
///

...Fire the given event if possible.
```php:Definitation
protected function event(mixed $event): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`$event` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::event()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Aevent%28%29 "Illuminate\Redis\Connections\Connection::event()") | ​<span class="summary">Fire the given event if possible.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::listen()' class='anchor'></a>[m] listen <small><span class="summary">Register a Redis command listener with the connection.</span></small>

///right
[Connection.php#140~151](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L140-L151 target=_blank)
///

...Register a Redis command listener with the connection.
```php:Definitation
public function listen(\Closure $callback): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::listen()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Alisten%28%29 "Illuminate\Redis\Connections\Connection::listen()") | ​<span class="summary">Register a Redis command listener with the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::getName()' class='anchor'></a>[m] getName <small><span class="summary">Get the connection name.</span></small>

///right
[Connection.php#153~161](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L153-L161 target=_blank)
///

...Get the connection name.
```php:Definitation
public function getName(): string|null
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string\|​null | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::getName()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AgetName%28%29 "Illuminate\Redis\Connections\Connection::getName()") | ​<span class="summary">Get the connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::setName()' class='anchor'></a>[m] setName <small><span class="summary">Set the connections name.</span></small>

///right
[Connection.php#163~174](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L163-L174 target=_blank)
///

...Set the connections name.
```php:Definitation
public function setName(string $name): Illuminate\Redis\Connections\Connection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setName()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AsetName%28%29 "Illuminate\Redis\Connections\Connection::setName()") | ​<span class="summary">Set the connections name.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::getEventDispatcher()' class='anchor'></a>[m] getEventDispatcher <small><span class="summary">Get the event dispatcher used by the connection.</span></small>

///right
[Connection.php#176~184](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L176-L184 target=_blank)
///

...Get the event dispatcher used by the connection.
```php:Definitation
public function getEventDispatcher(): Illuminate\Contracts\Events\Dispatcher
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Dispatcher](#--Illuminate-Contracts-Events-Dispatcher) | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::getEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AgetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::getEventDispatcher()") | ​<span class="summary">Get the event dispatcher used by the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::setEventDispatcher()' class='anchor'></a>[m] setEventDispatcher <small><span class="summary">Set the event dispatcher instance on the connection.</span></small>

///right
[Connection.php#186~195](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L186-L195 target=_blank)
///

...Set the event dispatcher instance on the connection.
```php:Definitation
public function setEventDispatcher(Illuminate\Contracts\Events\Dispatcher $events): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Dispatcher](#--Illuminate-Contracts-Events-Dispatcher) | ​`$events` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::setEventDispatcher()") | ​<span class="summary">Set the event dispatcher instance on the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::unsetEventDispatcher()' class='anchor'></a>[m] unsetEventDispatcher <small><span class="summary">Unset the event dispatcher instance on the connection.</span></small>

///right
[Connection.php#197~205](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L197-L205 target=_blank)
///

...Unset the event dispatcher instance on the connection.
```php:Definitation
public function unsetEventDispatcher(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::unsetEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AunsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::unsetEventDispatcher()") | ​<span class="summary">Unset the event dispatcher instance on the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::macro()' class='anchor'></a>[M] macro <small><span class="summary">Register a custom macro.</span></small>

///right
[Macroable.php#19~29](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L19-L29 target=_blank)
///

...Register a custom macro.
```php:Definitation
public static function macro(
    string $name,
    object|callable $macro
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>
​object\|​callable | ​`$macro` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::macro()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Amacro%28%29 "Illuminate\Redis\Connections\Connection::macro()") | ​<span class="summary">Register a custom macro.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::mixin()' class='anchor'></a>[M] mixin <small><span class="summary">Mix another object into the class.</span></small>

///right
[Macroable.php#31~52](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L31-L52 target=_blank)
///

...Mix another object into the class.
```php:Definitation
public static function mixin(
    object $mixin,
    bool $replace = true
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​object | ​`$mixin` | ​<span class="summary"></span>
​bool | ​`$replace = true` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ReflectionException](https://php.net/manual/class.reflectionexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::mixin()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Amixin%28%29 "Illuminate\Redis\Connections\Connection::mixin()") | ​<span class="summary">Mix another object into the class.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::hasMacro()' class='anchor'></a>[M] hasMacro <small><span class="summary">Checks if macro is registered.</span></small>

///right
[Macroable.php#54~63](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L54-L63 target=_blank)
///

...Checks if macro is registered.
```php:Definitation
public static function hasMacro(string $name): bool
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::hasMacro()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AhasMacro%28%29 "Illuminate\Redis\Connections\Connection::hasMacro()") | ​<span class="summary">Checks if macro is registered.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::flushMacros()' class='anchor'></a>[M] flushMacros <small><span class="summary">Flush the existing macros.</span></small>

///right
[Macroable.php#65~73](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L65-L73 target=_blank)
///

...Flush the existing macros.
```php:Definitation
public static function flushMacros(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::flushMacros()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AflushMacros%28%29 "Illuminate\Redis\Connections\Connection::flushMacros()") | ​<span class="summary">Flush the existing macros.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::__callStatic()' class='anchor'></a>[M] \_\_callStatic <small><span class="summary">Dynamically handle calls to the class.</span></small>

///right
[Macroable.php#75~99](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L75-L99 target=_blank)
///

...Dynamically handle calls to the class.
```php:Definitation
public static function __callStatic(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[BadMethodCallException](https://php.net/manual/class.badmethodcallexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::__callStatic()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A__callStatic%28%29 "Illuminate\Redis\Connections\Connection::__callStatic()") | ​<span class="summary">Dynamically handle calls to the class.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::macroCall()' class='anchor'></a>[m] macroCall <small><span class="summary">Dynamically handle calls to the class.</span></small>

///right
[Macroable.php#101~125](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L101-L125 target=_blank)
///

...Dynamically handle calls to the class.
```php:Definitation
public function macroCall(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[BadMethodCallException](https://php.net/manual/class.badmethodcallexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::macroCall()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AmacroCall%28%29 "Illuminate\Redis\Connections\Connection::macroCall()") | ​<span class="summary">Dynamically handle calls to the class.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::pack()' class='anchor'></a>[m] pack <small><span class="summary">Prepares the given values to be used with the `eval` command, including serialization and compression.</span></small>

///right
[PacksPhpRedisValues.php#32~83](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L32-L83 target=_blank)
///

...Prepares the given values to be used with the `eval` command, including serialization and compression.
```php:Definitation
public function pack(array $values): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$values` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::pack()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3Apack%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::pack()") | ​<span class="summary">Prepares the given values to be used with the `eval` command, including serialization and compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::compressed()' class='anchor'></a>[m] compressed <small><span class="summary">Determine if compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#85~94](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L85-L94 target=_blank)
///

...Determine if compression is enabled.
```php:Definitation
public function compressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::compressed()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3Acompressed%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::compressed()") | ​<span class="summary">Determine if compression is enabled.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::lzfCompressed()' class='anchor'></a>[m] lzfCompressed <small><span class="summary">Determine if LZF compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#96~105](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L96-L105 target=_blank)
///

...Determine if LZF compression is enabled.
```php:Definitation
public function lzfCompressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::lzfCompressed()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AlzfCompressed%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::lzfCompressed()") | ​<span class="summary">Determine if LZF compression is enabled.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::zstdCompressed()' class='anchor'></a>[m] zstdCompressed <small><span class="summary">Determine if ZSTD compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#107~116](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L107-L116 target=_blank)
///

...Determine if ZSTD compression is enabled.
```php:Definitation
public function zstdCompressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::zstdCompressed()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AzstdCompressed%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::zstdCompressed()") | ​<span class="summary">Determine if ZSTD compression is enabled.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::lz4Compressed()' class='anchor'></a>[m] lz4Compressed <small><span class="summary">Determine if LZ4 compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#118~127](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L118-L127 target=_blank)
///

...Determine if LZ4 compression is enabled.
```php:Definitation
public function lz4Compressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::lz4Compressed()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3Alz4Compressed%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::lz4Compressed()") | ​<span class="summary">Determine if LZ4 compression is enabled.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::supportsPacking()' class='anchor'></a>[m] supportsPacking <small><span class="summary">Determine if the current PhpRedis extension version supports packing.</span></small>

///right
[PacksPhpRedisValues.php#129~141](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L129-L141 target=_blank)
///

...Determine if the current PhpRedis extension version supports packing.
```php:Definitation
protected function supportsPacking(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::supportsPacking()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AsupportsPacking%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::supportsPacking()") | ​<span class="summary">Determine if the current PhpRedis extension version supports packing.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::supportsLzf()' class='anchor'></a>[m] supportsLzf <small><span class="summary">Determine if the current PhpRedis extension version supports LZF compression.</span></small>

///right
[PacksPhpRedisValues.php#143~155](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L143-L155 target=_blank)
///

...Determine if the current PhpRedis extension version supports LZF compression.
```php:Definitation
protected function supportsLzf(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::supportsLzf()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AsupportsLzf%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::supportsLzf()") | ​<span class="summary">Determine if the current PhpRedis extension version supports LZF compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::supportsZstd()' class='anchor'></a>[m] supportsZstd <small><span class="summary">Determine if the current PhpRedis extension version supports Zstd compression.</span></small>

///right
[PacksPhpRedisValues.php#157~169](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L157-L169 target=_blank)
///

...Determine if the current PhpRedis extension version supports Zstd compression.
```php:Definitation
protected function supportsZstd(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::supportsZstd()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AsupportsZstd%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::supportsZstd()") | ​<span class="summary">Determine if the current PhpRedis extension version supports Zstd compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::phpRedisVersionAtLeast()' class='anchor'></a>[m] phpRedisVersionAtLeast <small><span class="summary">Determine if the PhpRedis extension version is at least the given version.</span></small>

///right
[PacksPhpRedisValues.php#171~182](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L171-L182 target=_blank)
///

...Determine if the PhpRedis extension version is at least the given version.
```php:Definitation
protected function phpRedisVersionAtLeast(string $version): bool
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$version` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::phpRedisVersionAtLeast()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AphpRedisVersionAtLeast%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::phpRedisVersionAtLeast()") | ​<span class="summary">Determine if the PhpRedis extension version is at least the given version.</span>


...


### <a id='Illuminate-Redis-Connections-PredisClusterConnection' class='anchor'></a>[C] PredisClusterConnection <small><span class="summary"></span></small>

///right
[PredisClusterConnection.php#7~20](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PredisClusterConnection.php#L7-L20 target=_blank)
///



**Hierarchy**

+ [Illuminate\Redis\Connections\Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")
    + [Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")
        + [Illuminate\Redis\Connections\PhpRedisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection")
    + [Illuminate\Redis\Connections\PredisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection")
        + **[Illuminate\Redis\Connections\PredisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection")**


:Parents
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[PredisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection") | ​<span class="summary"></span>
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>

:Implements
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](#--Illuminate-Contracts-Redis-Connection) | ​<span class="summary"></span>



#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::$client' class='anchor'></a>[p] $client <small><span class="summary">The Predis client.</span></small>

///right
[PredisConnection.php#13~18](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PredisConnection.php#L13-L18 target=_blank)
///

...The Predis client.
```php:Definitation
protected Predis\Client $client = null
```


**Type**: [Client](#--Predis-Client)

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PredisConnection::$client](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisConnection%3A%3A%24client "Illuminate\Redis\Connections\PredisConnection::$client") | ​<span class="summary">The Predis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::$name' class='anchor'></a>[p] $name <small><span class="summary">The Redis connection name.</span></small>

///right
[Connection.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L25-L30 target=_blank)
///

...The Redis connection name.
```php:Definitation
protected string|null $name = null
```


**Type**: string\|​null

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$name](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24name "Illuminate\Redis\Connections\Connection::$name") | ​<span class="summary">The Redis connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::$events' class='anchor'></a>[p] $events <small><span class="summary">The event dispatcher instance.</span></small>

///right
[Connection.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L32-L37 target=_blank)
///

...The event dispatcher instance.
```php:Definitation
protected Illuminate\Contracts\Events\Dispatcher $events = null
```


**Type**: [Dispatcher](#--Illuminate-Contracts-Events-Dispatcher)

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$events](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24events "Illuminate\Redis\Connections\Connection::$events") | ​<span class="summary">The event dispatcher instance.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::$macros' class='anchor'></a>[P] $macros <small><span class="summary">The registered string macros.</span></small>

///right
[Connection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L-L target=_blank)
///

...The registered string macros.
```php:Definitation
protected static array $macros = []
```


**Type**: array

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$macros](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24macros "Illuminate\Redis\Connections\Connection::$macros") | ​<span class="summary">The registered string macros.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::flushdb()' class='anchor'></a>[m] flushdb <small><span class="summary">Flush the selected Redis database on all cluster nodes.</span></small>

///right
[PredisClusterConnection.php#9~19](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PredisClusterConnection.php#L9-L19 target=_blank)
///

...Flush the selected Redis database on all cluster nodes.
```php:Definitation
public function flushdb(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new Predis connection.</span></small>

///right
[PredisConnection.php#20~29](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PredisConnection.php#L20-L29 target=_blank)
///

...Create a new Predis connection.
```php:Definitation
public function __construct(Predis\Client $client): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Client](#--Predis-Client) | ​`$client` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PredisConnection::__construct()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisConnection%3A%3A__construct%28%29 "Illuminate\Redis\Connections\PredisConnection::__construct()") | ​<span class="summary">Create a new Predis connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::createSubscription()' class='anchor'></a>[m] createSubscription <small><span class="summary">Subscribe to a set of given channels for messages.</span></small>

///right
[PredisConnection.php#31~52](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PredisConnection.php#L31-L52 target=_blank)
///

...Subscribe to a set of given channels for messages.
```php:Definitation
public function createSubscription(
    array|string $channels,
    \Closure $callback,
    string $method = "subscribe"
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>
​string | ​`$method = "subscribe"` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PredisConnection::createSubscription()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisConnection%3A%3AcreateSubscription%28%29 "Illuminate\Redis\Connections\PredisConnection::createSubscription()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::funnel()' class='anchor'></a>[m] funnel <small><span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span></small>

///right
[Connection.php#49~58](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L49-L58 target=_blank)
///

...Funnel a callback for a maximum number of simultaneous executions.
```php:Definitation
public function funnel(string $name): Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ConcurrencyLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::funnel()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Afunnel%28%29 "Illuminate\Redis\Connections\Connection::funnel()") | ​<span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::throttle()' class='anchor'></a>[m] throttle <small><span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span></small>

///right
[Connection.php#60~69](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L60-L69 target=_blank)
///

...Throttle a callback for a maximum number of executions over a given duration.
```php:Definitation
public function throttle(string $name): Illuminate\Redis\Limiters\DurationLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[DurationLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::throttle()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Athrottle%28%29 "Illuminate\Redis\Connections\Connection::throttle()") | ​<span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::client()' class='anchor'></a>[m] client <small><span class="summary">Get the underlying Redis client.</span></small>

///right
[Connection.php#71~79](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L71-L79 target=_blank)
///

...Get the underlying Redis client.
```php:Definitation
public function client(): mixed
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::client()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Aclient%28%29 "Illuminate\Redis\Connections\Connection::client()") | ​<span class="summary">Get the underlying Redis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::subscribe()' class='anchor'></a>[m] subscribe <small><span class="summary">Subscribe to a set of given channels for messages.</span></small>

///right
[Connection.php#81~91](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L81-L91 target=_blank)
///

...Subscribe to a set of given channels for messages.
```php:Definitation
public function subscribe(
    array|string $channels,
    \Closure $callback
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::subscribe()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Asubscribe%28%29 "Illuminate\Redis\Connections\Connection::subscribe()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::psubscribe()' class='anchor'></a>[m] psubscribe <small><span class="summary">Subscribe to a set of given channels with wildcards.</span></small>

///right
[Connection.php#93~103](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L93-L103 target=_blank)
///

...Subscribe to a set of given channels with wildcards.
```php:Definitation
public function psubscribe(
    array|string $channels,
    \Closure $callback
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::psubscribe()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Apsubscribe%28%29 "Illuminate\Redis\Connections\Connection::psubscribe()") | ​<span class="summary">Subscribe to a set of given channels with wildcards.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::command()' class='anchor'></a>[m] command <small><span class="summary">Run a command against the Redis database.</span></small>

///right
[Connection.php#105~125](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L105-L125 target=_blank)
///

...Run a command against the Redis database.
```php:Definitation
public function command(
    string $method,
    array $parameters = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::command()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Acommand%28%29 "Illuminate\Redis\Connections\Connection::command()") | ​<span class="summary">Run a command against the Redis database.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::event()' class='anchor'></a>[m] event <small><span class="summary">Fire the given event if possible.</span></small>

///right
[Connection.php#127~138](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L127-L138 target=_blank)
///

...Fire the given event if possible.
```php:Definitation
protected function event(mixed $event): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`$event` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::event()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Aevent%28%29 "Illuminate\Redis\Connections\Connection::event()") | ​<span class="summary">Fire the given event if possible.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::listen()' class='anchor'></a>[m] listen <small><span class="summary">Register a Redis command listener with the connection.</span></small>

///right
[Connection.php#140~151](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L140-L151 target=_blank)
///

...Register a Redis command listener with the connection.
```php:Definitation
public function listen(\Closure $callback): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::listen()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Alisten%28%29 "Illuminate\Redis\Connections\Connection::listen()") | ​<span class="summary">Register a Redis command listener with the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::getName()' class='anchor'></a>[m] getName <small><span class="summary">Get the connection name.</span></small>

///right
[Connection.php#153~161](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L153-L161 target=_blank)
///

...Get the connection name.
```php:Definitation
public function getName(): string|null
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string\|​null | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::getName()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AgetName%28%29 "Illuminate\Redis\Connections\Connection::getName()") | ​<span class="summary">Get the connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::setName()' class='anchor'></a>[m] setName <small><span class="summary">Set the connections name.</span></small>

///right
[Connection.php#163~174](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L163-L174 target=_blank)
///

...Set the connections name.
```php:Definitation
public function setName(string $name): Illuminate\Redis\Connections\Connection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setName()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AsetName%28%29 "Illuminate\Redis\Connections\Connection::setName()") | ​<span class="summary">Set the connections name.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::getEventDispatcher()' class='anchor'></a>[m] getEventDispatcher <small><span class="summary">Get the event dispatcher used by the connection.</span></small>

///right
[Connection.php#176~184](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L176-L184 target=_blank)
///

...Get the event dispatcher used by the connection.
```php:Definitation
public function getEventDispatcher(): Illuminate\Contracts\Events\Dispatcher
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Dispatcher](#--Illuminate-Contracts-Events-Dispatcher) | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::getEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AgetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::getEventDispatcher()") | ​<span class="summary">Get the event dispatcher used by the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::setEventDispatcher()' class='anchor'></a>[m] setEventDispatcher <small><span class="summary">Set the event dispatcher instance on the connection.</span></small>

///right
[Connection.php#186~195](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L186-L195 target=_blank)
///

...Set the event dispatcher instance on the connection.
```php:Definitation
public function setEventDispatcher(Illuminate\Contracts\Events\Dispatcher $events): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Dispatcher](#--Illuminate-Contracts-Events-Dispatcher) | ​`$events` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::setEventDispatcher()") | ​<span class="summary">Set the event dispatcher instance on the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::unsetEventDispatcher()' class='anchor'></a>[m] unsetEventDispatcher <small><span class="summary">Unset the event dispatcher instance on the connection.</span></small>

///right
[Connection.php#197~205](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L197-L205 target=_blank)
///

...Unset the event dispatcher instance on the connection.
```php:Definitation
public function unsetEventDispatcher(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::unsetEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AunsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::unsetEventDispatcher()") | ​<span class="summary">Unset the event dispatcher instance on the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::__call()' class='anchor'></a>[m] \_\_call <small><span class="summary">Pass other method calls down to the underlying client.</span></small>

///right
[Connection.php#207~221](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L207-L221 target=_blank)
///

...Pass other method calls down to the underlying client.
```php:Definitation
public function __call(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::__call()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A__call%28%29 "Illuminate\Redis\Connections\Connection::__call()") | ​<span class="summary">Pass other method calls down to the underlying client.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::macro()' class='anchor'></a>[M] macro <small><span class="summary">Register a custom macro.</span></small>

///right
[Macroable.php#19~29](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L19-L29 target=_blank)
///

...Register a custom macro.
```php:Definitation
public static function macro(
    string $name,
    object|callable $macro
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>
​object\|​callable | ​`$macro` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::macro()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Amacro%28%29 "Illuminate\Redis\Connections\Connection::macro()") | ​<span class="summary">Register a custom macro.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::mixin()' class='anchor'></a>[M] mixin <small><span class="summary">Mix another object into the class.</span></small>

///right
[Macroable.php#31~52](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L31-L52 target=_blank)
///

...Mix another object into the class.
```php:Definitation
public static function mixin(
    object $mixin,
    bool $replace = true
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​object | ​`$mixin` | ​<span class="summary"></span>
​bool | ​`$replace = true` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ReflectionException](https://php.net/manual/class.reflectionexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::mixin()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Amixin%28%29 "Illuminate\Redis\Connections\Connection::mixin()") | ​<span class="summary">Mix another object into the class.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::hasMacro()' class='anchor'></a>[M] hasMacro <small><span class="summary">Checks if macro is registered.</span></small>

///right
[Macroable.php#54~63](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L54-L63 target=_blank)
///

...Checks if macro is registered.
```php:Definitation
public static function hasMacro(string $name): bool
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::hasMacro()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AhasMacro%28%29 "Illuminate\Redis\Connections\Connection::hasMacro()") | ​<span class="summary">Checks if macro is registered.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::flushMacros()' class='anchor'></a>[M] flushMacros <small><span class="summary">Flush the existing macros.</span></small>

///right
[Macroable.php#65~73](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L65-L73 target=_blank)
///

...Flush the existing macros.
```php:Definitation
public static function flushMacros(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::flushMacros()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AflushMacros%28%29 "Illuminate\Redis\Connections\Connection::flushMacros()") | ​<span class="summary">Flush the existing macros.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::__callStatic()' class='anchor'></a>[M] \_\_callStatic <small><span class="summary">Dynamically handle calls to the class.</span></small>

///right
[Macroable.php#75~99](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L75-L99 target=_blank)
///

...Dynamically handle calls to the class.
```php:Definitation
public static function __callStatic(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[BadMethodCallException](https://php.net/manual/class.badmethodcallexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::__callStatic()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A__callStatic%28%29 "Illuminate\Redis\Connections\Connection::__callStatic()") | ​<span class="summary">Dynamically handle calls to the class.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::macroCall()' class='anchor'></a>[m] macroCall <small><span class="summary">Dynamically handle calls to the class.</span></small>

///right
[Macroable.php#101~125](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L101-L125 target=_blank)
///

...Dynamically handle calls to the class.
```php:Definitation
public function macroCall(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[BadMethodCallException](https://php.net/manual/class.badmethodcallexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::macroCall()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AmacroCall%28%29 "Illuminate\Redis\Connections\Connection::macroCall()") | ​<span class="summary">Dynamically handle calls to the class.</span>


...


### <a id='Illuminate-Redis-Connections-PredisConnection' class='anchor'></a>[C] PredisConnection <small><span class="summary"></span></small>

///right
[PredisConnection.php#8~53](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PredisConnection.php#L8-L53 target=_blank)
///



**Hierarchy**

+ [Illuminate\Redis\Connections\Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")
    + [Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")
        + [Illuminate\Redis\Connections\PhpRedisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection")
    + **[Illuminate\Redis\Connections\PredisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection")**
        + [Illuminate\Redis\Connections\PredisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection")


:Parents
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>

:Implements
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](#--Illuminate-Contracts-Redis-Connection) | ​<span class="summary"></span>



#### <a id='Illuminate-Redis-Connections-PredisConnection::$client' class='anchor'></a>[p] $client <small><span class="summary">The Predis client.</span></small>

///right
[PredisConnection.php#13~18](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PredisConnection.php#L13-L18 target=_blank)
///

...The Predis client.
```php:Definitation
protected Predis\Client $client = null
```


**Type**: [Client](#--Predis-Client)

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​override | ​[Connection::$client](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24client "Illuminate\Redis\Connections\Connection::$client") | ​<span class="summary">The Redis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::$name' class='anchor'></a>[p] $name <small><span class="summary">The Redis connection name.</span></small>

///right
[Connection.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L25-L30 target=_blank)
///

...The Redis connection name.
```php:Definitation
protected string|null $name = null
```


**Type**: string\|​null

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$name](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24name "Illuminate\Redis\Connections\Connection::$name") | ​<span class="summary">The Redis connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::$events' class='anchor'></a>[p] $events <small><span class="summary">The event dispatcher instance.</span></small>

///right
[Connection.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L32-L37 target=_blank)
///

...The event dispatcher instance.
```php:Definitation
protected Illuminate\Contracts\Events\Dispatcher $events = null
```


**Type**: [Dispatcher](#--Illuminate-Contracts-Events-Dispatcher)

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$events](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24events "Illuminate\Redis\Connections\Connection::$events") | ​<span class="summary">The event dispatcher instance.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::$macros' class='anchor'></a>[P] $macros <small><span class="summary">The registered string macros.</span></small>

///right
[Connection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L-L target=_blank)
///

...The registered string macros.
```php:Definitation
protected static array $macros = []
```


**Type**: array

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$macros](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A%24macros "Illuminate\Redis\Connections\Connection::$macros") | ​<span class="summary">The registered string macros.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new Predis connection.</span></small>

///right
[PredisConnection.php#20~29](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PredisConnection.php#L20-L29 target=_blank)
///

...Create a new Predis connection.
```php:Definitation
public function __construct(Predis\Client $client): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Client](#--Predis-Client) | ​`$client` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PredisConnection::createSubscription()' class='anchor'></a>[m] createSubscription <small><span class="summary">Subscribe to a set of given channels for messages.</span></small>

///right
[PredisConnection.php#31~52](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PredisConnection.php#L31-L52 target=_blank)
///

...Subscribe to a set of given channels for messages.
```php:Definitation
public function createSubscription(
    array|string $channels,
    \Closure $callback,
    string $method = "subscribe"
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>
​string | ​`$method = "subscribe"` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​override | ​[Connection::createSubscription()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AcreateSubscription%28%29 "Illuminate\Redis\Connections\Connection::createSubscription()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::funnel()' class='anchor'></a>[m] funnel <small><span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span></small>

///right
[Connection.php#49~58](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L49-L58 target=_blank)
///

...Funnel a callback for a maximum number of simultaneous executions.
```php:Definitation
public function funnel(string $name): Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ConcurrencyLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::funnel()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Afunnel%28%29 "Illuminate\Redis\Connections\Connection::funnel()") | ​<span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::throttle()' class='anchor'></a>[m] throttle <small><span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span></small>

///right
[Connection.php#60~69](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L60-L69 target=_blank)
///

...Throttle a callback for a maximum number of executions over a given duration.
```php:Definitation
public function throttle(string $name): Illuminate\Redis\Limiters\DurationLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[DurationLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::throttle()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Athrottle%28%29 "Illuminate\Redis\Connections\Connection::throttle()") | ​<span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::client()' class='anchor'></a>[m] client <small><span class="summary">Get the underlying Redis client.</span></small>

///right
[Connection.php#71~79](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L71-L79 target=_blank)
///

...Get the underlying Redis client.
```php:Definitation
public function client(): mixed
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::client()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Aclient%28%29 "Illuminate\Redis\Connections\Connection::client()") | ​<span class="summary">Get the underlying Redis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::subscribe()' class='anchor'></a>[m] subscribe <small><span class="summary">Subscribe to a set of given channels for messages.</span></small>

///right
[Connection.php#81~91](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L81-L91 target=_blank)
///

...Subscribe to a set of given channels for messages.
```php:Definitation
public function subscribe(
    array|string $channels,
    \Closure $callback
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::subscribe()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Asubscribe%28%29 "Illuminate\Redis\Connections\Connection::subscribe()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::psubscribe()' class='anchor'></a>[m] psubscribe <small><span class="summary">Subscribe to a set of given channels with wildcards.</span></small>

///right
[Connection.php#93~103](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L93-L103 target=_blank)
///

...Subscribe to a set of given channels with wildcards.
```php:Definitation
public function psubscribe(
    array|string $channels,
    \Closure $callback
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$channels` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::psubscribe()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Apsubscribe%28%29 "Illuminate\Redis\Connections\Connection::psubscribe()") | ​<span class="summary">Subscribe to a set of given channels with wildcards.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::command()' class='anchor'></a>[m] command <small><span class="summary">Run a command against the Redis database.</span></small>

///right
[Connection.php#105~125](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L105-L125 target=_blank)
///

...Run a command against the Redis database.
```php:Definitation
public function command(
    string $method,
    array $parameters = []
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::command()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Acommand%28%29 "Illuminate\Redis\Connections\Connection::command()") | ​<span class="summary">Run a command against the Redis database.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::event()' class='anchor'></a>[m] event <small><span class="summary">Fire the given event if possible.</span></small>

///right
[Connection.php#127~138](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L127-L138 target=_blank)
///

...Fire the given event if possible.
```php:Definitation
protected function event(mixed $event): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`$event` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::event()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Aevent%28%29 "Illuminate\Redis\Connections\Connection::event()") | ​<span class="summary">Fire the given event if possible.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::listen()' class='anchor'></a>[m] listen <small><span class="summary">Register a Redis command listener with the connection.</span></small>

///right
[Connection.php#140~151](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L140-L151 target=_blank)
///

...Register a Redis command listener with the connection.
```php:Definitation
public function listen(\Closure $callback): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::listen()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Alisten%28%29 "Illuminate\Redis\Connections\Connection::listen()") | ​<span class="summary">Register a Redis command listener with the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::getName()' class='anchor'></a>[m] getName <small><span class="summary">Get the connection name.</span></small>

///right
[Connection.php#153~161](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L153-L161 target=_blank)
///

...Get the connection name.
```php:Definitation
public function getName(): string|null
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string\|​null | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::getName()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AgetName%28%29 "Illuminate\Redis\Connections\Connection::getName()") | ​<span class="summary">Get the connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::setName()' class='anchor'></a>[m] setName <small><span class="summary">Set the connections name.</span></small>

///right
[Connection.php#163~174](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L163-L174 target=_blank)
///

...Set the connections name.
```php:Definitation
public function setName(string $name): Illuminate\Redis\Connections\Connection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setName()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AsetName%28%29 "Illuminate\Redis\Connections\Connection::setName()") | ​<span class="summary">Set the connections name.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::getEventDispatcher()' class='anchor'></a>[m] getEventDispatcher <small><span class="summary">Get the event dispatcher used by the connection.</span></small>

///right
[Connection.php#176~184](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L176-L184 target=_blank)
///

...Get the event dispatcher used by the connection.
```php:Definitation
public function getEventDispatcher(): Illuminate\Contracts\Events\Dispatcher
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Dispatcher](#--Illuminate-Contracts-Events-Dispatcher) | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::getEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AgetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::getEventDispatcher()") | ​<span class="summary">Get the event dispatcher used by the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::setEventDispatcher()' class='anchor'></a>[m] setEventDispatcher <small><span class="summary">Set the event dispatcher instance on the connection.</span></small>

///right
[Connection.php#186~195](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L186-L195 target=_blank)
///

...Set the event dispatcher instance on the connection.
```php:Definitation
public function setEventDispatcher(Illuminate\Contracts\Events\Dispatcher $events): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Dispatcher](#--Illuminate-Contracts-Events-Dispatcher) | ​`$events` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::setEventDispatcher()") | ​<span class="summary">Set the event dispatcher instance on the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::unsetEventDispatcher()' class='anchor'></a>[m] unsetEventDispatcher <small><span class="summary">Unset the event dispatcher instance on the connection.</span></small>

///right
[Connection.php#197~205](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L197-L205 target=_blank)
///

...Unset the event dispatcher instance on the connection.
```php:Definitation
public function unsetEventDispatcher(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::unsetEventDispatcher()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AunsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::unsetEventDispatcher()") | ​<span class="summary">Unset the event dispatcher instance on the connection.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::__call()' class='anchor'></a>[m] \_\_call <small><span class="summary">Pass other method calls down to the underlying client.</span></small>

///right
[Connection.php#207~221](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L207-L221 target=_blank)
///

...Pass other method calls down to the underlying client.
```php:Definitation
public function __call(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::__call()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A__call%28%29 "Illuminate\Redis\Connections\Connection::__call()") | ​<span class="summary">Pass other method calls down to the underlying client.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::macro()' class='anchor'></a>[M] macro <small><span class="summary">Register a custom macro.</span></small>

///right
[Macroable.php#19~29](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L19-L29 target=_blank)
///

...Register a custom macro.
```php:Definitation
public static function macro(
    string $name,
    object|callable $macro
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>
​object\|​callable | ​`$macro` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::macro()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Amacro%28%29 "Illuminate\Redis\Connections\Connection::macro()") | ​<span class="summary">Register a custom macro.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::mixin()' class='anchor'></a>[M] mixin <small><span class="summary">Mix another object into the class.</span></small>

///right
[Macroable.php#31~52](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L31-L52 target=_blank)
///

...Mix another object into the class.
```php:Definitation
public static function mixin(
    object $mixin,
    bool $replace = true
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​object | ​`$mixin` | ​<span class="summary"></span>
​bool | ​`$replace = true` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ReflectionException](https://php.net/manual/class.reflectionexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::mixin()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3Amixin%28%29 "Illuminate\Redis\Connections\Connection::mixin()") | ​<span class="summary">Mix another object into the class.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::hasMacro()' class='anchor'></a>[M] hasMacro <small><span class="summary">Checks if macro is registered.</span></small>

///right
[Macroable.php#54~63](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L54-L63 target=_blank)
///

...Checks if macro is registered.
```php:Definitation
public static function hasMacro(string $name): bool
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::hasMacro()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AhasMacro%28%29 "Illuminate\Redis\Connections\Connection::hasMacro()") | ​<span class="summary">Checks if macro is registered.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::flushMacros()' class='anchor'></a>[M] flushMacros <small><span class="summary">Flush the existing macros.</span></small>

///right
[Macroable.php#65~73](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L65-L73 target=_blank)
///

...Flush the existing macros.
```php:Definitation
public static function flushMacros(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::flushMacros()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AflushMacros%28%29 "Illuminate\Redis\Connections\Connection::flushMacros()") | ​<span class="summary">Flush the existing macros.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::__callStatic()' class='anchor'></a>[M] \_\_callStatic <small><span class="summary">Dynamically handle calls to the class.</span></small>

///right
[Macroable.php#75~99](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L75-L99 target=_blank)
///

...Dynamically handle calls to the class.
```php:Definitation
public static function __callStatic(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[BadMethodCallException](https://php.net/manual/class.badmethodcallexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::__callStatic()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3A__callStatic%28%29 "Illuminate\Redis\Connections\Connection::__callStatic()") | ​<span class="summary">Dynamically handle calls to the class.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::macroCall()' class='anchor'></a>[m] macroCall <small><span class="summary">Dynamically handle calls to the class.</span></small>

///right
[Macroable.php#101~125](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L101-L125 target=_blank)
///

...Dynamically handle calls to the class.
```php:Definitation
public function macroCall(
    string $method,
    array $parameters
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$method` | ​<span class="summary"></span>
​array | ​`$parameters` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[BadMethodCallException](https://php.net/manual/class.badmethodcallexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::macroCall()](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection%3A%3AmacroCall%28%29 "Illuminate\Redis\Connections\Connection::macroCall()") | ​<span class="summary">Dynamically handle calls to the class.</span>


...


### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues' class='anchor'></a>[T] PacksPhpRedisValues <small><span class="summary"></span></small>

///right
[PacksPhpRedisValues.php#9~183](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L9-L183 target=_blank)
///



**Hierarchy**

+ **[Illuminate\Redis\Connections\PacksPhpRedisValues](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues "Illuminate\Redis\Connections\PacksPhpRedisValues")**
    + [Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")






#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::$supportsPacking' class='anchor'></a>[p] $supportsPacking <small><span class="summary">Indicates if Redis supports packing.</span></small>

///right
[PacksPhpRedisValues.php#11~16](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L11-L16 target=_blank)
///

...Indicates if Redis supports packing.
```php:Definitation
protected bool|null $supportsPacking = null
```


**Type**: bool\|​null



...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::$supportsLzf' class='anchor'></a>[p] $supportsLzf <small><span class="summary">Indicates if Redis supports LZF compression.</span></small>

///right
[PacksPhpRedisValues.php#18~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L18-L23 target=_blank)
///

...Indicates if Redis supports LZF compression.
```php:Definitation
protected bool|null $supportsLzf = null
```


**Type**: bool\|​null



...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::$supportsZstd' class='anchor'></a>[p] $supportsZstd <small><span class="summary">Indicates if Redis supports Zstd compression.</span></small>

///right
[PacksPhpRedisValues.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L25-L30 target=_blank)
///

...Indicates if Redis supports Zstd compression.
```php:Definitation
protected bool|null $supportsZstd = null
```


**Type**: bool\|​null



...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::pack()' class='anchor'></a>[m] pack <small><span class="summary">Prepares the given values to be used with the `eval` command, including serialization and compression.</span></small>

///right
[PacksPhpRedisValues.php#32~83](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L32-L83 target=_blank)
///

...Prepares the given values to be used with the `eval` command, including serialization and compression.
```php:Definitation
public function pack(array $values): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$values` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::compressed()' class='anchor'></a>[m] compressed <small><span class="summary">Determine if compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#85~94](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L85-L94 target=_blank)
///

...Determine if compression is enabled.
```php:Definitation
public function compressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::lzfCompressed()' class='anchor'></a>[m] lzfCompressed <small><span class="summary">Determine if LZF compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#96~105](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L96-L105 target=_blank)
///

...Determine if LZF compression is enabled.
```php:Definitation
public function lzfCompressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::zstdCompressed()' class='anchor'></a>[m] zstdCompressed <small><span class="summary">Determine if ZSTD compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#107~116](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L107-L116 target=_blank)
///

...Determine if ZSTD compression is enabled.
```php:Definitation
public function zstdCompressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::lz4Compressed()' class='anchor'></a>[m] lz4Compressed <small><span class="summary">Determine if LZ4 compression is enabled.</span></small>

///right
[PacksPhpRedisValues.php#118~127](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L118-L127 target=_blank)
///

...Determine if LZ4 compression is enabled.
```php:Definitation
public function lz4Compressed(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::supportsPacking()' class='anchor'></a>[m] supportsPacking <small><span class="summary">Determine if the current PhpRedis extension version supports packing.</span></small>

///right
[PacksPhpRedisValues.php#129~141](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L129-L141 target=_blank)
///

...Determine if the current PhpRedis extension version supports packing.
```php:Definitation
protected function supportsPacking(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::supportsLzf()' class='anchor'></a>[m] supportsLzf <small><span class="summary">Determine if the current PhpRedis extension version supports LZF compression.</span></small>

///right
[PacksPhpRedisValues.php#143~155](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L143-L155 target=_blank)
///

...Determine if the current PhpRedis extension version supports LZF compression.
```php:Definitation
protected function supportsLzf(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::supportsZstd()' class='anchor'></a>[m] supportsZstd <small><span class="summary">Determine if the current PhpRedis extension version supports Zstd compression.</span></small>

///right
[PacksPhpRedisValues.php#157~169](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L157-L169 target=_blank)
///

...Determine if the current PhpRedis extension version supports Zstd compression.
```php:Definitation
protected function supportsZstd(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::phpRedisVersionAtLeast()' class='anchor'></a>[m] phpRedisVersionAtLeast <small><span class="summary">Determine if the PhpRedis extension version is at least the given version.</span></small>

///right
[PacksPhpRedisValues.php#171~182](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L171-L182 target=_blank)
///

...Determine if the PhpRedis extension version is at least the given version.
```php:Definitation
protected function phpRedisVersionAtLeast(string $version): bool
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$version` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>




...





