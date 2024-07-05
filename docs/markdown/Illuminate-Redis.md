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

## <a id='Illuminate-Redis' class='anchor'></a>[N] Illuminate\\Redis\\ <small><span class="summary"></span></small>




### <a id='Illuminate-Redis-RedisManager' class='anchor'></a>[C] RedisManager <small><span class="summary"></span></small>

///right
[RedisManager.php#14~279](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L14-L279 target=_blank)
///





:Implements
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Factory](#--Illuminate-Contracts-Redis-Factory) | ​<span class="summary"></span>



#### <a id='Illuminate-Redis-RedisManager::$app' class='anchor'></a>[p] $app <small><span class="summary">The application instance.</span></small>

///right
[RedisManager.php#19~24](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L19-L24 target=_blank)
///

...The application instance.
```php:Definitation
protected Illuminate\Contracts\Foundation\Application $app = null
```


**Type**: [Application](#--Illuminate-Contracts-Foundation-Application)



...


#### <a id='Illuminate-Redis-RedisManager::$driver' class='anchor'></a>[p] $driver <small><span class="summary">The name of the default driver.</span></small>

///right
[RedisManager.php#26~31](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L26-L31 target=_blank)
///

...The name of the default driver.
```php:Definitation
protected string $driver = null
```


**Type**: string



...


#### <a id='Illuminate-Redis-RedisManager::$customCreators' class='anchor'></a>[p] $customCreators <small><span class="summary">The registered custom driver creators.</span></small>

///right
[RedisManager.php#33~38](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L33-L38 target=_blank)
///

...The registered custom driver creators.
```php:Definitation
protected array $customCreators = []
```


**Type**: array



...


#### <a id='Illuminate-Redis-RedisManager::$config' class='anchor'></a>[p] $config <small><span class="summary">The Redis server configurations.</span></small>

///right
[RedisManager.php#40~45](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L40-L45 target=_blank)
///

...The Redis server configurations.
```php:Definitation
protected array $config = null
```


**Type**: array



...


#### <a id='Illuminate-Redis-RedisManager::$connections' class='anchor'></a>[p] $connections <small><span class="summary">The Redis connections.</span></small>

///right
[RedisManager.php#47~52](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L47-L52 target=_blank)
///

...The Redis connections.
```php:Definitation
protected mixed $connections = null
```


**Type**: mixed



...


#### <a id='Illuminate-Redis-RedisManager::$events' class='anchor'></a>[p] $events <small><span class="summary">Indicates whether event dispatcher is set on connections.</span></small>

///right
[RedisManager.php#54~59](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L54-L59 target=_blank)
///

...Indicates whether event dispatcher is set on connections.
```php:Definitation
protected bool $events = false
```


**Type**: bool



...


#### <a id='Illuminate-Redis-RedisManager::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new Redis manager instance.</span></small>

///right
[RedisManager.php#61~74](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L61-L74 target=_blank)
///

...Create a new Redis manager instance.
```php:Definitation
public function __construct(
    Illuminate\Contracts\Foundation\Application $app,
    string $driver,
    array $config
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Application](#--Illuminate-Contracts-Foundation-Application) | ​`$app` | ​<span class="summary"></span>
​string | ​`$driver` | ​<span class="summary"></span>
​array | ​`$config` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-RedisManager::connection()' class='anchor'></a>[m] connection <small><span class="summary">Get a Redis connection by name.</span></small>

///right
[RedisManager.php#76~93](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L76-L93 target=_blank)
///

...Get a Redis connection by name.
```php:Definitation
public function connection(string|null $name = null): Illuminate\Redis\Connections\Connection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string\|​null | ​`$name = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​implement | ​[Factory::connection()](#--Illuminate-Contracts-Redis-Factory%3A%3Aconnection%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisManager::resolve()' class='anchor'></a>[m] resolve <small><span class="summary">Resolve the given connection by name.</span></small>

///right
[RedisManager.php#95~121](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L95-L121 target=_blank)
///

...Resolve the given connection by name.
```php:Definitation
public function resolve(string|null $name = null): Illuminate\Redis\Connections\Connection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string\|​null | ​`$name = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[InvalidArgumentException](https://php.net/manual/class.invalidargumentexception.php target=_blank) | ​<span class="summary"></span>



...


#### <a id='Illuminate-Redis-RedisManager::resolveCluster()' class='anchor'></a>[m] resolveCluster <small><span class="summary">Resolve the given cluster connection by name.</span></small>

///right
[RedisManager.php#123~138](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L123-L138 target=_blank)
///

...Resolve the given cluster connection by name.
```php:Definitation
protected function resolveCluster(string $name): Illuminate\Redis\Connections\Connection
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


#### <a id='Illuminate-Redis-RedisManager::configure()' class='anchor'></a>[m] configure <small><span class="summary">Configure the given connection to prepare it for commands.</span></small>

///right
[RedisManager.php#140~156](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L140-L156 target=_blank)
///

...Configure the given connection to prepare it for commands.
```php:Definitation
protected function configure(
    Illuminate\Redis\Connections\Connection $connection,
    string $name
): Illuminate\Redis\Connections\Connection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$connection` | ​<span class="summary"></span>
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-RedisManager::connector()' class='anchor'></a>[m] connector <small><span class="summary">Get the connector instance for the current driver.</span></small>

///right
[RedisManager.php#158~177](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L158-L177 target=_blank)
///

...Get the connector instance for the current driver.
```php:Definitation
protected function connector(): Illuminate\Contracts\Redis\Connector
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connector](#--Illuminate-Contracts-Redis-Connector) | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-RedisManager::parseConnectionConfiguration()' class='anchor'></a>[m] parseConnectionConfiguration <small><span class="summary">Parse the Redis connection configuration.</span></small>

///right
[RedisManager.php#179~198](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L179-L198 target=_blank)
///

...Parse the Redis connection configuration.
```php:Definitation
protected function parseConnectionConfiguration(mixed $config): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​mixed | ​`$config` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-RedisManager::connections()' class='anchor'></a>[m] connections <small><span class="summary">Return all of the created connections.</span></small>

///right
[RedisManager.php#200~208](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L200-L208 target=_blank)
///

...Return all of the created connections.
```php:Definitation
public function connections(): array
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-RedisManager::enableEvents()' class='anchor'></a>[m] enableEvents <small><span class="summary">Enable the firing of Redis command events.</span></small>

///right
[RedisManager.php#210~218](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L210-L218 target=_blank)
///

...Enable the firing of Redis command events.
```php:Definitation
public function enableEvents(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-RedisManager::disableEvents()' class='anchor'></a>[m] disableEvents <small><span class="summary">Disable the firing of Redis command events.</span></small>

///right
[RedisManager.php#220~228](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L220-L228 target=_blank)
///

...Disable the firing of Redis command events.
```php:Definitation
public function disableEvents(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-RedisManager::setDriver()' class='anchor'></a>[m] setDriver <small><span class="summary">Set the default driver.</span></small>

///right
[RedisManager.php#230~239](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L230-L239 target=_blank)
///

...Set the default driver.
```php:Definitation
public function setDriver(string $driver): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$driver` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-RedisManager::purge()' class='anchor'></a>[m] purge <small><span class="summary">Disconnect the given connection and remove from local cache.</span></small>

///right
[RedisManager.php#241~252](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L241-L252 target=_blank)
///

...Disconnect the given connection and remove from local cache.
```php:Definitation
public function purge(string|null $name = null): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string\|​null | ​`$name = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-RedisManager::extend()' class='anchor'></a>[m] extend <small><span class="summary">Register a custom driver creator Closure.</span></small>

///right
[RedisManager.php#254~266](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L254-L266 target=_blank)
///

...Register a custom driver creator Closure.
```php:Definitation
public function extend(
    string $driver,
    \Closure $callback
): Illuminate\Redis\RedisManager
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$driver` | ​<span class="summary"></span>
​[Closure](https://php.net/manual/class.closure.php target=_blank) | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[RedisManager](Illuminate-Redis.html#Illuminate-Redis-RedisManager "Illuminate\Redis\RedisManager") | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-RedisManager::__call()' class='anchor'></a>[m] \_\_call <small><span class="summary">Pass methods onto the default Redis connection.</span></small>

///right
[RedisManager.php#268~278](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L268-L278 target=_blank)
///

...Pass methods onto the default Redis connection.
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




...


### <a id='Illuminate-Redis-RedisServiceProvider' class='anchor'></a>[C] RedisServiceProvider <small><span class="summary"></span></small>

///right
[RedisServiceProvider.php#9~38](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisServiceProvider.php#L9-L38 target=_blank)
///



**Hierarchy**

+ [Illuminate\Support\ServiceProvider](#--Illuminate-Support-ServiceProvider)
    + **[Illuminate\Redis\RedisServiceProvider](Illuminate-Redis.html#Illuminate-Redis-RedisServiceProvider "Illuminate\Redis\RedisServiceProvider")**


:Parents
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[ServiceProvider](#--Illuminate-Support-ServiceProvider) | ​<span class="summary"></span>

:Implements
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[DeferrableProvider](#--Illuminate-Contracts-Support-DeferrableProvider) | ​<span class="summary"></span>



#### <a id='Illuminate-Redis-RedisServiceProvider::$app' class='anchor'></a>[p] $app <small><span class="summary">The application instance.</span></small>

///right
[ServiceProvider.php#15~20](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L15-L20 target=_blank)
///

...The application instance.
```php:Definitation
protected Illuminate\Contracts\Foundation\Application $app = null
```


**Type**: [Application](#--Illuminate-Contracts-Foundation-Application)

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::$app](#--Illuminate-Support-ServiceProvider%3A%3A%24app) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::$bootingCallbacks' class='anchor'></a>[p] $bootingCallbacks <small><span class="summary">All of the registered booting callbacks.</span></small>

///right
[ServiceProvider.php#22~27](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L22-L27 target=_blank)
///

...All of the registered booting callbacks.
```php:Definitation
protected array $bootingCallbacks = []
```


**Type**: array

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::$bootingCallbacks](#--Illuminate-Support-ServiceProvider%3A%3A%24bootingCallbacks) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::$bootedCallbacks' class='anchor'></a>[p] $bootedCallbacks <small><span class="summary">All of the registered booted callbacks.</span></small>

///right
[ServiceProvider.php#29~34](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L29-L34 target=_blank)
///

...All of the registered booted callbacks.
```php:Definitation
protected array $bootedCallbacks = []
```


**Type**: array

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::$bootedCallbacks](#--Illuminate-Support-ServiceProvider%3A%3A%24bootedCallbacks) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::$publishes' class='anchor'></a>[P] $publishes <small><span class="summary">The paths that should be published.</span></small>

///right
[ServiceProvider.php#36~41](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L36-L41 target=_blank)
///

...The paths that should be published.
```php:Definitation
public static array $publishes = []
```


**Type**: array

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::$publishes](#--Illuminate-Support-ServiceProvider%3A%3A%24publishes) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::$publishGroups' class='anchor'></a>[P] $publishGroups <small><span class="summary">The paths that should be published by group.</span></small>

///right
[ServiceProvider.php#43~48](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L43-L48 target=_blank)
///

...The paths that should be published by group.
```php:Definitation
public static array $publishGroups = []
```


**Type**: array

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::$publishGroups](#--Illuminate-Support-ServiceProvider%3A%3A%24publishGroups) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::register()' class='anchor'></a>[m] register <small><span class="summary">Register the service provider.</span></small>

///right
[RedisServiceProvider.php#11~27](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisServiceProvider.php#L11-L27 target=_blank)
///

...Register the service provider.
```php:Definitation
public function register(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​override | ​[ServiceProvider::register()](#--Illuminate-Support-ServiceProvider%3A%3Aregister%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::provides()' class='anchor'></a>[m] provides <small><span class="summary">Get the services provided by the provider.</span></small>

///right
[RedisServiceProvider.php#29~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisServiceProvider.php#L29-L37 target=_blank)
///

...Get the services provided by the provider.
```php:Definitation
public function provides(): array
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​implement | ​[DeferrableProvider::provides()](#--Illuminate-Contracts-Support-DeferrableProvider%3A%3Aprovides%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new service provider instance.</span></small>

///right
[ServiceProvider.php#50~59](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L50-L59 target=_blank)
///

...Create a new service provider instance.
```php:Definitation
public function __construct(Illuminate\Contracts\Foundation\Application $app): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Application](#--Illuminate-Contracts-Foundation-Application) | ​`$app` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::__construct()](#--Illuminate-Support-ServiceProvider%3A%3A__construct%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::booting()' class='anchor'></a>[m] booting <small><span class="summary">Register a booting callback to be run before the &quot;boot&quot; method is called.</span></small>

///right
[ServiceProvider.php#71~80](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L71-L80 target=_blank)
///

...Register a booting callback to be run before the "boot" method is called.
```php:Definitation
public function booting(\Closure $callback): void
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
​inherit | ​[ServiceProvider::booting()](#--Illuminate-Support-ServiceProvider%3A%3Abooting%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::booted()' class='anchor'></a>[m] booted <small><span class="summary">Register a booted callback to be run after the &quot;boot&quot; method is called.</span></small>

///right
[ServiceProvider.php#82~91](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L82-L91 target=_blank)
///

...Register a booted callback to be run after the "boot" method is called.
```php:Definitation
public function booted(\Closure $callback): void
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
​inherit | ​[ServiceProvider::booted()](#--Illuminate-Support-ServiceProvider%3A%3Abooted%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::callBootingCallbacks()' class='anchor'></a>[m] callBootingCallbacks <small><span class="summary">Call the registered booting callbacks.</span></small>

///right
[ServiceProvider.php#93~107](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L93-L107 target=_blank)
///

...Call the registered booting callbacks.
```php:Definitation
public function callBootingCallbacks(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::callBootingCallbacks()](#--Illuminate-Support-ServiceProvider%3A%3AcallBootingCallbacks%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::callBootedCallbacks()' class='anchor'></a>[m] callBootedCallbacks <small><span class="summary">Call the registered booted callbacks.</span></small>

///right
[ServiceProvider.php#109~123](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L109-L123 target=_blank)
///

...Call the registered booted callbacks.
```php:Definitation
public function callBootedCallbacks(): void
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::callBootedCallbacks()](#--Illuminate-Support-ServiceProvider%3A%3AcallBootedCallbacks%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::mergeConfigFrom()' class='anchor'></a>[m] mergeConfigFrom <small><span class="summary">Merge the given configuration with the existing configuration.</span></small>

///right
[ServiceProvider.php#125~141](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L125-L141 target=_blank)
///

...Merge the given configuration with the existing configuration.
```php:Definitation
protected function mergeConfigFrom(
    string $path,
    string $key
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$path` | ​<span class="summary"></span>
​string | ​`$key` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::mergeConfigFrom()](#--Illuminate-Support-ServiceProvider%3A%3AmergeConfigFrom%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::loadRoutesFrom()' class='anchor'></a>[m] loadRoutesFrom <small><span class="summary">Load the given routes file if routes are not already cached.</span></small>

///right
[ServiceProvider.php#143~154](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L143-L154 target=_blank)
///

...Load the given routes file if routes are not already cached.
```php:Definitation
protected function loadRoutesFrom(string $path): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$path` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::loadRoutesFrom()](#--Illuminate-Support-ServiceProvider%3A%3AloadRoutesFrom%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::loadViewsFrom()' class='anchor'></a>[m] loadViewsFrom <small><span class="summary">Register a view file namespace.</span></small>

///right
[ServiceProvider.php#156~177](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L156-L177 target=_blank)
///

...Register a view file namespace.
```php:Definitation
protected function loadViewsFrom(
    string|array $path,
    string $namespace
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string\|​array | ​`$path` | ​<span class="summary"></span>
​string | ​`$namespace` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::loadViewsFrom()](#--Illuminate-Support-ServiceProvider%3A%3AloadViewsFrom%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::loadViewComponentsAs()' class='anchor'></a>[m] loadViewComponentsAs <small><span class="summary">Register the given view components with a custom prefix.</span></small>

///right
[ServiceProvider.php#179~193](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L179-L193 target=_blank)
///

...Register the given view components with a custom prefix.
```php:Definitation
protected function loadViewComponentsAs(
    string $prefix,
    array $components
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$prefix` | ​<span class="summary"></span>
​array | ​`$components` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::loadViewComponentsAs()](#--Illuminate-Support-ServiceProvider%3A%3AloadViewComponentsAs%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::loadTranslationsFrom()' class='anchor'></a>[m] loadTranslationsFrom <small><span class="summary">Register a translation file namespace.</span></small>

///right
[ServiceProvider.php#195~207](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L195-L207 target=_blank)
///

...Register a translation file namespace.
```php:Definitation
protected function loadTranslationsFrom(
    string $path,
    string $namespace
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$path` | ​<span class="summary"></span>
​string | ​`$namespace` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::loadTranslationsFrom()](#--Illuminate-Support-ServiceProvider%3A%3AloadTranslationsFrom%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::loadJsonTranslationsFrom()' class='anchor'></a>[m] loadJsonTranslationsFrom <small><span class="summary">Register a JSON translation file path.</span></small>

///right
[ServiceProvider.php#209~220](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L209-L220 target=_blank)
///

...Register a JSON translation file path.
```php:Definitation
protected function loadJsonTranslationsFrom(string $path): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$path` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::loadJsonTranslationsFrom()](#--Illuminate-Support-ServiceProvider%3A%3AloadJsonTranslationsFrom%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::loadMigrationsFrom()' class='anchor'></a>[m] loadMigrationsFrom <small><span class="summary">Register database migration paths.</span></small>

///right
[ServiceProvider.php#222~235](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L222-L235 target=_blank)
///

...Register database migration paths.
```php:Definitation
protected function loadMigrationsFrom(array|string $paths): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$paths` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::loadMigrationsFrom()](#--Illuminate-Support-ServiceProvider%3A%3AloadMigrationsFrom%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::loadFactoriesFrom()' class='anchor'></a>[m] loadFactoriesFrom <small><span class="summary">Register Eloquent model factory paths.</span></small>

///right
{alert:deprecated }[ServiceProvider.php#237~252](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L237-L252 target=_blank)
///

...Register Eloquent model factory paths.
```php:Definitation
protected function loadFactoriesFrom(array|string $paths): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​string | ​`$paths` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::loadFactoriesFrom()](#--Illuminate-Support-ServiceProvider%3A%3AloadFactoriesFrom%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::callAfterResolving()' class='anchor'></a>[m] callAfterResolving <small><span class="summary">Setup an after resolving listener, or fire immediately if already resolved.</span></small>

///right
[ServiceProvider.php#254~268](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L254-L268 target=_blank)
///

...Setup an after resolving listener, or fire immediately if already resolved.
```php:Definitation
protected function callAfterResolving(
    string $name,
    callable $callback
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$name` | ​<span class="summary"></span>
​callable | ​`$callback` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::callAfterResolving()](#--Illuminate-Support-ServiceProvider%3A%3AcallAfterResolving%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::publishes()' class='anchor'></a>[m] publishes <small><span class="summary">Register paths to be published by the publish command.</span></small>

///right
[ServiceProvider.php#270~286](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L270-L286 target=_blank)
///

...Register paths to be published by the publish command.
```php:Definitation
protected function publishes(
    array $paths,
    mixed $groups = null
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$paths` | ​<span class="summary"></span>
​mixed | ​`$groups = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::publishes()](#--Illuminate-Support-ServiceProvider%3A%3Apublishes%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::ensurePublishArrayInitialized()' class='anchor'></a>[m] ensurePublishArrayInitialized <small><span class="summary">Ensure the publish array for the service provider is initialized.</span></small>

///right
[ServiceProvider.php#288~299](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L288-L299 target=_blank)
///

...Ensure the publish array for the service provider is initialized.
```php:Definitation
protected function ensurePublishArrayInitialized(string $class): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$class` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::ensurePublishArrayInitialized()](#--Illuminate-Support-ServiceProvider%3A%3AensurePublishArrayInitialized%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::addPublishGroup()' class='anchor'></a>[m] addPublishGroup <small><span class="summary">Add a publish group / tag to the service provider.</span></small>

///right
[ServiceProvider.php#301~317](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L301-L317 target=_blank)
///

...Add a publish group / tag to the service provider.
```php:Definitation
protected function addPublishGroup(
    string $group,
    array $paths
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$group` | ​<span class="summary"></span>
​array | ​`$paths` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::addPublishGroup()](#--Illuminate-Support-ServiceProvider%3A%3AaddPublishGroup%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::pathsToPublish()' class='anchor'></a>[M] pathsToPublish <small><span class="summary">Get the paths to publish.</span></small>

///right
[ServiceProvider.php#319~335](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L319-L335 target=_blank)
///

...Get the paths to publish.
```php:Definitation
public static function pathsToPublish(
    string|null $provider = null,
    string|null $group = null
): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string\|​null | ​`$provider = null` | ​<span class="summary"></span>
​string\|​null | ​`$group = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::pathsToPublish()](#--Illuminate-Support-ServiceProvider%3A%3ApathsToPublish%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::pathsForProviderOrGroup()' class='anchor'></a>[M] pathsForProviderOrGroup <small><span class="summary">Get the paths for the provider or group (or both).</span></small>

///right
[ServiceProvider.php#337~355](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L337-L355 target=_blank)
///

...Get the paths for the provider or group (or both).
```php:Definitation
protected static function pathsForProviderOrGroup(
    string|null $provider,
    string|null $group
): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string\|​null | ​`$provider` | ​<span class="summary"></span>
​string\|​null | ​`$group` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::pathsForProviderOrGroup()](#--Illuminate-Support-ServiceProvider%3A%3ApathsForProviderOrGroup%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::pathsForProviderAndGroup()' class='anchor'></a>[M] pathsForProviderAndGroup <small><span class="summary">Get the paths for the provider and group.</span></small>

///right
[ServiceProvider.php#357~371](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L357-L371 target=_blank)
///

...Get the paths for the provider and group.
```php:Definitation
protected static function pathsForProviderAndGroup(
    string $provider,
    string $group
): array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​string | ​`$provider` | ​<span class="summary"></span>
​string | ​`$group` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::pathsForProviderAndGroup()](#--Illuminate-Support-ServiceProvider%3A%3ApathsForProviderAndGroup%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::publishableProviders()' class='anchor'></a>[M] publishableProviders <small><span class="summary">Get the service providers available for publishing.</span></small>

///right
[ServiceProvider.php#373~381](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L373-L381 target=_blank)
///

...Get the service providers available for publishing.
```php:Definitation
public static function publishableProviders(): array
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::publishableProviders()](#--Illuminate-Support-ServiceProvider%3A%3ApublishableProviders%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::publishableGroups()' class='anchor'></a>[M] publishableGroups <small><span class="summary">Get the groups available for publishing.</span></small>

///right
[ServiceProvider.php#383~391](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L383-L391 target=_blank)
///

...Get the groups available for publishing.
```php:Definitation
public static function publishableGroups(): array
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::publishableGroups()](#--Illuminate-Support-ServiceProvider%3A%3ApublishableGroups%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::commands()' class='anchor'></a>[m] commands <small><span class="summary">Register the package&apos;s custom Artisan commands.</span></small>

///right
[ServiceProvider.php#393~406](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L393-L406 target=_blank)
///

...Register the package's custom Artisan commands.
```php:Definitation
public function commands(array|mixed $commands): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array\|​mixed | ​`$commands` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::commands()](#--Illuminate-Support-ServiceProvider%3A%3Acommands%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::when()' class='anchor'></a>[m] when <small><span class="summary">Get the events that trigger this service provider to register.</span></small>

///right
[ServiceProvider.php#418~426](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L418-L426 target=_blank)
///

...Get the events that trigger this service provider to register.
```php:Definitation
public function when(): array
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::when()](#--Illuminate-Support-ServiceProvider%3A%3Awhen%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-RedisServiceProvider::isDeferred()' class='anchor'></a>[m] isDeferred <small><span class="summary">Determine if the provider is deferred.</span></small>

///right
[ServiceProvider.php#428~436](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Support/ServiceProvider.php#L428-L436 target=_blank)
///

...Determine if the provider is deferred.
```php:Definitation
public function isDeferred(): bool
```



:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​bool | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[ServiceProvider::isDeferred()](#--Illuminate-Support-ServiceProvider%3A%3AisDeferred%28%29) | ​<span class="summary"></span>


...






