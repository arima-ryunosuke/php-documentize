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

## <a id='Illuminate-Redis-Limiters' class='anchor'></a>[N] Illuminate\\Redis\\Limiters\\ <small><span class="summary"></span></small>




### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter' class='anchor'></a>[C] ConcurrencyLimiter <small><span class="summary"></span></small>

///right
[ConcurrencyLimiter.php#9~166](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L9-L166 target=_blank)
///








#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::$redis' class='anchor'></a>[p] $redis <small><span class="summary">The Redis factory implementation.</span></small>

///right
[ConcurrencyLimiter.php#11~16](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L11-L16 target=_blank)
///

...The Redis factory implementation.
```php:Definitation
protected Illuminate\Redis\Connections\Connection $redis = null
```


**Type**: [Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")



...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::$name' class='anchor'></a>[p] $name <small><span class="summary">The name of the limiter.</span></small>

///right
[ConcurrencyLimiter.php#18~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L18-L23 target=_blank)
///

...The name of the limiter.
```php:Definitation
protected string $name = null
```


**Type**: string



...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::$maxLocks' class='anchor'></a>[p] $maxLocks <small><span class="summary">The allowed number of concurrent tasks.</span></small>

///right
[ConcurrencyLimiter.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L25-L30 target=_blank)
///

...The allowed number of concurrent tasks.
```php:Definitation
protected int $maxLocks = null
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::$releaseAfter' class='anchor'></a>[p] $releaseAfter <small><span class="summary">The number of seconds a slot should be maintained.</span></small>

///right
[ConcurrencyLimiter.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L32-L37 target=_blank)
///

...The number of seconds a slot should be maintained.
```php:Definitation
protected int $releaseAfter = null
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new concurrency limiter instance.</span></small>

///right
[ConcurrencyLimiter.php#39~54](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L39-L54 target=_blank)
///

...Create a new concurrency limiter instance.
```php:Definitation
public function __construct(
    Illuminate\Redis\Connections\Connection $redis,
    string $name,
    int $maxLocks,
    int $releaseAfter
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$redis` | ​<span class="summary"></span>
​string | ​`$name` | ​<span class="summary"></span>
​int | ​`$maxLocks` | ​<span class="summary"></span>
​int | ​`$releaseAfter` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::block()' class='anchor'></a>[m] block <small><span class="summary">Attempt to acquire the lock for the given number of seconds.</span></small>

///right
[ConcurrencyLimiter.php#56~93](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L56-L93 target=_blank)
///

...Attempt to acquire the lock for the given number of seconds.
```php:Definitation
public function block(
    int $timeout,
    callable|null $callback = null
): bool
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​int | ​`$timeout` | ​<span class="summary"></span>
​callable\|​null | ​`$callback = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[LimiterTimeoutException](#--Illuminate-Contracts-Redis-LimiterTimeoutException) | ​<span class="summary"></span>
​[Throwable](https://php.net/manual/class.throwable.php target=_blank) | ​<span class="summary"></span>



...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::acquire()' class='anchor'></a>[m] acquire <small><span class="summary">Attempt to acquire the lock.</span></small>

///right
[ConcurrencyLimiter.php#95~111](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L95-L111 target=_blank)
///

...Attempt to acquire the lock.
```php:Definitation
protected function acquire(string $id): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$id` | ​<span class="summary">A unique identifier for this lock</span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::lockScript()' class='anchor'></a>[m] lockScript <small><span class="summary">Get the Lua script for acquiring a lock.</span></small>

///right
[ConcurrencyLimiter.php#113~133](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L113-L133 target=_blank)
///

...Get the Lua script for acquiring a lock.
```php:Definitation
protected function lockScript(): string
```

<div class="description">


KEYS    - The keys that represent available slots
ARGV[1] - The limiter name
ARGV[2] - The number of seconds the slot should be reserved
ARGV[3] - The unique identifier for this lock

</div>


:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::release()' class='anchor'></a>[m] release <small><span class="summary">Release the lock.</span></small>

///right
[ConcurrencyLimiter.php#135~145](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L135-L145 target=_blank)
///

...Release the lock.
```php:Definitation
protected function release(
    string $key,
    string $id
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$key` | ​<span class="summary"></span>
​string | ​`$id` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::releaseScript()' class='anchor'></a>[m] releaseScript <small><span class="summary">Get the Lua script to atomically release a lock.</span></small>

///right
[ConcurrencyLimiter.php#147~165](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L147-L165 target=_blank)
///

...Get the Lua script to atomically release a lock.
```php:Definitation
protected function releaseScript(): string
```

<div class="description">


KEYS[1] - The name of the lock
ARGV[1] - The unique identifier for this lock

</div>


:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary"></span>




...


### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder' class='anchor'></a>[C] ConcurrencyLimiterBuilder <small><span class="summary"></span></small>

///right
[ConcurrencyLimiterBuilder.php#8~122](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L8-L122 target=_blank)
///






:Uses
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[InteractsWithTime](#--Illuminate-Support-InteractsWithTime) | ​<span class="summary"></span>


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::$connection' class='anchor'></a>[p] $connection <small><span class="summary">The Redis connection.</span></small>

///right
[ConcurrencyLimiterBuilder.php#12~17](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L12-L17 target=_blank)
///

...The Redis connection.
```php:Definitation
public Illuminate\Redis\Connections\Connection $connection = null
```


**Type**: [Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")



...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::$name' class='anchor'></a>[p] $name <small><span class="summary">The name of the lock.</span></small>

///right
[ConcurrencyLimiterBuilder.php#19~24](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L19-L24 target=_blank)
///

...The name of the lock.
```php:Definitation
public string $name = null
```


**Type**: string



...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::$maxLocks' class='anchor'></a>[p] $maxLocks <small><span class="summary">The maximum number of entities that can hold the lock at the same time.</span></small>

///right
[ConcurrencyLimiterBuilder.php#26~31](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L26-L31 target=_blank)
///

...The maximum number of entities that can hold the lock at the same time.
```php:Definitation
public int $maxLocks = null
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::$releaseAfter' class='anchor'></a>[p] $releaseAfter <small><span class="summary">The number of seconds to maintain the lock until it is automatically released.</span></small>

///right
[ConcurrencyLimiterBuilder.php#33~38](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L33-L38 target=_blank)
///

...The number of seconds to maintain the lock until it is automatically released.
```php:Definitation
public int $releaseAfter = 60
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::$timeout' class='anchor'></a>[p] $timeout <small><span class="summary">The amount of time to block until a lock is available.</span></small>

///right
[ConcurrencyLimiterBuilder.php#40~45](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L40-L45 target=_blank)
///

...The amount of time to block until a lock is available.
```php:Definitation
public int $timeout = 3
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new builder instance.</span></small>

///right
[ConcurrencyLimiterBuilder.php#47~58](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L47-L58 target=_blank)
///

...Create a new builder instance.
```php:Definitation
public function __construct(
    Illuminate\Redis\Connections\Connection $connection,
    string $name
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$connection` | ​<span class="summary"></span>
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::limit()' class='anchor'></a>[m] limit <small><span class="summary">Set the maximum number of locks that can be obtained per time window.</span></small>

///right
[ConcurrencyLimiterBuilder.php#60~71](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L60-L71 target=_blank)
///

...Set the maximum number of locks that can be obtained per time window.
```php:Definitation
public function limit(int $maxLocks): Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​int | ​`$maxLocks` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ConcurrencyLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::releaseAfter()' class='anchor'></a>[m] releaseAfter <small><span class="summary">Set the number of seconds until the lock will be released.</span></small>

///right
[ConcurrencyLimiterBuilder.php#73~84](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L73-L84 target=_blank)
///

...Set the number of seconds until the lock will be released.
```php:Definitation
public function releaseAfter(int $releaseAfter): Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​int | ​`$releaseAfter` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ConcurrencyLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::block()' class='anchor'></a>[m] block <small><span class="summary">Set the amount of time to block until a lock is available.</span></small>

///right
[ConcurrencyLimiterBuilder.php#86~97](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L86-L97 target=_blank)
///

...Set the amount of time to block until a lock is available.
```php:Definitation
public function block(int $timeout): Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​int | ​`$timeout` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ConcurrencyLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::then()' class='anchor'></a>[m] then <small><span class="summary">Execute the given callback if a lock is obtained, otherwise call the failure callback.</span></small>

///right
[ConcurrencyLimiterBuilder.php#99~121](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L99-L121 target=_blank)
///

...Execute the given callback if a lock is obtained, otherwise call the failure callback.
```php:Definitation
public function then(
    callable $callback,
    ?callable|callable|null $failure = null
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​callable | ​`$callback` | ​<span class="summary"></span>
​?callable\|​callable\|​null | ​`$failure = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[LimiterTimeoutException](#--Illuminate-Contracts-Redis-LimiterTimeoutException) | ​<span class="summary"></span>



...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::secondsUntil()' class='anchor'></a>[m] secondsUntil <small><span class="summary">Get the number of seconds until the given DateTime.</span></small>

///right
[InteractsWithTime.php#10~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/InteractsWithTime.php#L10-L23 target=_blank)
///

...Get the number of seconds until the given DateTime.
```php:Definitation
protected function secondsUntil(\DateTimeInterface|\DateInterval|int $delay): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[DateTimeInterface](https://php.net/manual/class.datetimeinterface.php target=_blank)\|​[DateInterval](https://php.net/manual/class.dateinterval.php target=_blank)\|​int | ​`$delay` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[InteractsWithTime::secondsUntil()](#--Illuminate-Support-InteractsWithTime%3A%3AsecondsUntil%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::availableAt()' class='anchor'></a>[m] availableAt <small><span class="summary">Get the &quot;available at&quot; UNIX timestamp.</span></small>

///right
[InteractsWithTime.php#25~38](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/InteractsWithTime.php#L25-L38 target=_blank)
///

...Get the "available at" UNIX timestamp.
```php:Definitation
protected function availableAt(\DateTimeInterface|\DateInterval|int $delay = 0): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[DateTimeInterface](https://php.net/manual/class.datetimeinterface.php target=_blank)\|​[DateInterval](https://php.net/manual/class.dateinterval.php target=_blank)\|​int | ​`$delay = 0` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[InteractsWithTime::availableAt()](#--Illuminate-Support-InteractsWithTime%3A%3AavailableAt%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::parseDateInterval()' class='anchor'></a>[m] parseDateInterval <small><span class="summary">If the given value is an interval, convert it to a DateTime instance.</span></small>

///right
[InteractsWithTime.php#40~53](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/InteractsWithTime.php#L40-L53 target=_blank)
///

...If the given value is an interval, convert it to a DateTime instance.
```php:Definitation
protected function parseDateInterval(\DateTimeInterface|\DateInterval|int $delay): \DateTimeInterface|int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[DateTimeInterface](https://php.net/manual/class.datetimeinterface.php target=_blank)\|​[DateInterval](https://php.net/manual/class.dateinterval.php target=_blank)\|​int | ​`$delay` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[DateTimeInterface](https://php.net/manual/class.datetimeinterface.php target=_blank)\|​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[InteractsWithTime::parseDateInterval()](#--Illuminate-Support-InteractsWithTime%3A%3AparseDateInterval%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::currentTime()' class='anchor'></a>[m] currentTime <small><span class="summary">Get the current system time as a UNIX timestamp.</span></small>

///right
[InteractsWithTime.php#55~63](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/InteractsWithTime.php#L55-L63 target=_blank)
///

...Get the current system time as a UNIX timestamp.
```php:Definitation
protected function currentTime(): int
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[InteractsWithTime::currentTime()](#--Illuminate-Support-InteractsWithTime%3A%3AcurrentTime%28%29) | ​<span class="summary"></span>


...


### <a id='Illuminate-Redis-Limiters-DurationLimiter' class='anchor'></a>[C] DurationLimiter <small><span class="summary"></span></small>

///right
[DurationLimiter.php#7~202](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L7-L202 target=_blank)
///








#### <a id='Illuminate-Redis-Limiters-DurationLimiter::$redis' class='anchor'></a>[p] $redis <small><span class="summary">The Redis factory implementation.</span></small>

///right
[DurationLimiter.php#9~14](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L9-L14 target=_blank)
///

...The Redis factory implementation.
```php:Definitation
private Illuminate\Redis\Connections\Connection $redis = null
```


**Type**: [Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::$name' class='anchor'></a>[p] $name <small><span class="summary">The unique name of the lock.</span></small>

///right
[DurationLimiter.php#16~21](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L16-L21 target=_blank)
///

...The unique name of the lock.
```php:Definitation
private string $name = null
```


**Type**: string



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::$maxLocks' class='anchor'></a>[p] $maxLocks <small><span class="summary">The allowed number of concurrent tasks.</span></small>

///right
[DurationLimiter.php#23~28](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L23-L28 target=_blank)
///

...The allowed number of concurrent tasks.
```php:Definitation
private int $maxLocks = null
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::$decay' class='anchor'></a>[p] $decay <small><span class="summary">The number of seconds a slot should be maintained.</span></small>

///right
[DurationLimiter.php#30~35](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L30-L35 target=_blank)
///

...The number of seconds a slot should be maintained.
```php:Definitation
private int $decay = null
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::$decaysAt' class='anchor'></a>[p] $decaysAt <small><span class="summary">The timestamp of the end of the current duration.</span></small>

///right
[DurationLimiter.php#37~42](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L37-L42 target=_blank)
///

...The timestamp of the end of the current duration.
```php:Definitation
public int $decaysAt = null
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::$remaining' class='anchor'></a>[p] $remaining <small><span class="summary">The number of remaining slots.</span></small>

///right
[DurationLimiter.php#44~49](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L44-L49 target=_blank)
///

...The number of remaining slots.
```php:Definitation
public int $remaining = null
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new duration limiter instance.</span></small>

///right
[DurationLimiter.php#51~66](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L51-L66 target=_blank)
///

...Create a new duration limiter instance.
```php:Definitation
public function __construct(
    Illuminate\Redis\Connections\Connection $redis,
    string $name,
    int $maxLocks,
    int $decay
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$redis` | ​<span class="summary"></span>
​string | ​`$name` | ​<span class="summary"></span>
​int | ​`$maxLocks` | ​<span class="summary"></span>
​int | ​`$decay` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::block()' class='anchor'></a>[m] block <small><span class="summary">Attempt to acquire the lock for the given number of seconds.</span></small>

///right
[DurationLimiter.php#68~94](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L68-L94 target=_blank)
///

...Attempt to acquire the lock for the given number of seconds.
```php:Definitation
public function block(
    int $timeout,
    callable|null $callback = null
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​int | ​`$timeout` | ​<span class="summary"></span>
​callable\|​null | ​`$callback = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[LimiterTimeoutException](#--Illuminate-Contracts-Redis-LimiterTimeoutException) | ​<span class="summary"></span>



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::acquire()' class='anchor'></a>[m] acquire <small><span class="summary">Attempt to acquire the lock.</span></small>

///right
[DurationLimiter.php#96~112](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L96-L112 target=_blank)
///

...Attempt to acquire the lock.
```php:Definitation
public function acquire(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::tooManyAttempts()' class='anchor'></a>[m] tooManyAttempts <small><span class="summary">Determine if the key has been &quot;accessed&quot; too many times.</span></small>

///right
[DurationLimiter.php#114~126](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L114-L126 target=_blank)
///

...Determine if the key has been "accessed" too many times.
```php:Definitation
public function tooManyAttempts(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::clear()' class='anchor'></a>[m] clear <small><span class="summary">Clear the limiter.</span></small>

///right
[DurationLimiter.php#128~136](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L128-L136 target=_blank)
///

...Clear the limiter.
```php:Definitation
public function clear(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::luaScript()' class='anchor'></a>[m] luaScript <small><span class="summary">Get the Lua script for acquiring a lock.</span></small>

///right
[DurationLimiter.php#138~171](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L138-L171 target=_blank)
///

...Get the Lua script for acquiring a lock.
```php:Definitation
protected function luaScript(): string
```

<div class="description">


KEYS[1] - The limiter name
ARGV[1] - Current time in microseconds
ARGV[2] - Current time in seconds
ARGV[3] - Duration of the bucket
ARGV[4] - Allowed number of tasks

</div>


:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::tooManyAttemptsLuaScript()' class='anchor'></a>[m] tooManyAttemptsLuaScript <small><span class="summary">Get the Lua script to determine if the key has been &quot;accessed&quot; too many times.</span></small>

///right
[DurationLimiter.php#173~201](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L173-L201 target=_blank)
///

...Get the Lua script to determine if the key has been "accessed" too many times.
```php:Definitation
protected function tooManyAttemptsLuaScript(): string
```

<div class="description">


KEYS[1] - The limiter name
ARGV[1] - Current time in microseconds
ARGV[2] - Current time in seconds
ARGV[3] - Duration of the bucket
ARGV[4] - Allowed number of tasks

</div>


:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary"></span>




...


### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder' class='anchor'></a>[C] DurationLimiterBuilder <small><span class="summary"></span></small>

///right
[DurationLimiterBuilder.php#8~122](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L8-L122 target=_blank)
///






:Uses
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[InteractsWithTime](#--Illuminate-Support-InteractsWithTime) | ​<span class="summary"></span>


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::$connection' class='anchor'></a>[p] $connection <small><span class="summary">The Redis connection.</span></small>

///right
[DurationLimiterBuilder.php#12~17](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L12-L17 target=_blank)
///

...The Redis connection.
```php:Definitation
public Illuminate\Redis\Connections\Connection $connection = null
```


**Type**: [Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::$name' class='anchor'></a>[p] $name <small><span class="summary">The name of the lock.</span></small>

///right
[DurationLimiterBuilder.php#19~24](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L19-L24 target=_blank)
///

...The name of the lock.
```php:Definitation
public string $name = null
```


**Type**: string



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::$maxLocks' class='anchor'></a>[p] $maxLocks <small><span class="summary">The maximum number of locks that can be obtained per time window.</span></small>

///right
[DurationLimiterBuilder.php#26~31](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L26-L31 target=_blank)
///

...The maximum number of locks that can be obtained per time window.
```php:Definitation
public int $maxLocks = null
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::$decay' class='anchor'></a>[p] $decay <small><span class="summary">The amount of time the lock window is maintained.</span></small>

///right
[DurationLimiterBuilder.php#33~38](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L33-L38 target=_blank)
///

...The amount of time the lock window is maintained.
```php:Definitation
public int $decay = null
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::$timeout' class='anchor'></a>[p] $timeout <small><span class="summary">The amount of time to block until a lock is available.</span></small>

///right
[DurationLimiterBuilder.php#40~45](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L40-L45 target=_blank)
///

...The amount of time to block until a lock is available.
```php:Definitation
public int $timeout = 3
```


**Type**: int



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new builder instance.</span></small>

///right
[DurationLimiterBuilder.php#47~58](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L47-L58 target=_blank)
///

...Create a new builder instance.
```php:Definitation
public function __construct(
    Illuminate\Redis\Connections\Connection $connection,
    string $name
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$connection` | ​<span class="summary"></span>
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::allow()' class='anchor'></a>[m] allow <small><span class="summary">Set the maximum number of locks that can be obtained per time window.</span></small>

///right
[DurationLimiterBuilder.php#60~71](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L60-L71 target=_blank)
///

...Set the maximum number of locks that can be obtained per time window.
```php:Definitation
public function allow(int $maxLocks): Illuminate\Redis\Limiters\DurationLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​int | ​`$maxLocks` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[DurationLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::every()' class='anchor'></a>[m] every <small><span class="summary">Set the amount of time the lock window is maintained.</span></small>

///right
[DurationLimiterBuilder.php#73~84](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L73-L84 target=_blank)
///

...Set the amount of time the lock window is maintained.
```php:Definitation
public function every(\DateTimeInterface|\DateInterval|int $decay): Illuminate\Redis\Limiters\DurationLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[DateTimeInterface](https://php.net/manual/class.datetimeinterface.php target=_blank)\|​[DateInterval](https://php.net/manual/class.dateinterval.php target=_blank)\|​int | ​`$decay` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[DurationLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::block()' class='anchor'></a>[m] block <small><span class="summary">Set the amount of time to block until a lock is available.</span></small>

///right
[DurationLimiterBuilder.php#86~97](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L86-L97 target=_blank)
///

...Set the amount of time to block until a lock is available.
```php:Definitation
public function block(int $timeout): Illuminate\Redis\Limiters\DurationLimiterBuilder
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​int | ​`$timeout` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[DurationLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::then()' class='anchor'></a>[m] then <small><span class="summary">Execute the given callback if a lock is obtained, otherwise call the failure callback.</span></small>

///right
[DurationLimiterBuilder.php#99~121](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L99-L121 target=_blank)
///

...Execute the given callback if a lock is obtained, otherwise call the failure callback.
```php:Definitation
public function then(
    callable $callback,
    ?callable|callable|null $failure = null
): mixed
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​callable | ​`$callback` | ​<span class="summary"></span>
​?callable\|​callable\|​null | ​`$failure = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​mixed | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[LimiterTimeoutException](#--Illuminate-Contracts-Redis-LimiterTimeoutException) | ​<span class="summary"></span>



...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::secondsUntil()' class='anchor'></a>[m] secondsUntil <small><span class="summary">Get the number of seconds until the given DateTime.</span></small>

///right
[InteractsWithTime.php#10~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/InteractsWithTime.php#L10-L23 target=_blank)
///

...Get the number of seconds until the given DateTime.
```php:Definitation
protected function secondsUntil(\DateTimeInterface|\DateInterval|int $delay): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[DateTimeInterface](https://php.net/manual/class.datetimeinterface.php target=_blank)\|​[DateInterval](https://php.net/manual/class.dateinterval.php target=_blank)\|​int | ​`$delay` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[InteractsWithTime::secondsUntil()](#--Illuminate-Support-InteractsWithTime%3A%3AsecondsUntil%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::availableAt()' class='anchor'></a>[m] availableAt <small><span class="summary">Get the &quot;available at&quot; UNIX timestamp.</span></small>

///right
[InteractsWithTime.php#25~38](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/InteractsWithTime.php#L25-L38 target=_blank)
///

...Get the "available at" UNIX timestamp.
```php:Definitation
protected function availableAt(\DateTimeInterface|\DateInterval|int $delay = 0): int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[DateTimeInterface](https://php.net/manual/class.datetimeinterface.php target=_blank)\|​[DateInterval](https://php.net/manual/class.dateinterval.php target=_blank)\|​int | ​`$delay = 0` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[InteractsWithTime::availableAt()](#--Illuminate-Support-InteractsWithTime%3A%3AavailableAt%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::parseDateInterval()' class='anchor'></a>[m] parseDateInterval <small><span class="summary">If the given value is an interval, convert it to a DateTime instance.</span></small>

///right
[InteractsWithTime.php#40~53](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/InteractsWithTime.php#L40-L53 target=_blank)
///

...If the given value is an interval, convert it to a DateTime instance.
```php:Definitation
protected function parseDateInterval(\DateTimeInterface|\DateInterval|int $delay): \DateTimeInterface|int
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[DateTimeInterface](https://php.net/manual/class.datetimeinterface.php target=_blank)\|​[DateInterval](https://php.net/manual/class.dateinterval.php target=_blank)\|​int | ​`$delay` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[DateTimeInterface](https://php.net/manual/class.datetimeinterface.php target=_blank)\|​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[InteractsWithTime::parseDateInterval()](#--Illuminate-Support-InteractsWithTime%3A%3AparseDateInterval%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::currentTime()' class='anchor'></a>[m] currentTime <small><span class="summary">Get the current system time as a UNIX timestamp.</span></small>

///right
[InteractsWithTime.php#55~63](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/InteractsWithTime.php#L55-L63 target=_blank)
///

...Get the current system time as a UNIX timestamp.
```php:Definitation
protected function currentTime(): int
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​int | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[InteractsWithTime::currentTime()](#--Illuminate-Support-InteractsWithTime%3A%3AcurrentTime%28%29) | ​<span class="summary"></span>


...






