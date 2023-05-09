<style>.rst-content .right.sidebar {
    margin: -3.2em 4px 4px 0px;
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




...


#### <a id='Illuminate-Redis-RedisManager::$driver' class='anchor'></a>[p] $driver <small><span class="summary">The name of the default driver.</span></small>

///right
[RedisManager.php#26~31](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L26-L31 target=_blank)
///

...The name of the default driver.
```php:Definitation
protected string $driver = null
```




...


#### <a id='Illuminate-Redis-RedisManager::$customCreators' class='anchor'></a>[p] $customCreators <small><span class="summary">The registered custom driver creators.</span></small>

///right
[RedisManager.php#33~38](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L33-L38 target=_blank)
///

...The registered custom driver creators.
```php:Definitation
protected array $customCreators = []
```




...


#### <a id='Illuminate-Redis-RedisManager::$config' class='anchor'></a>[p] $config <small><span class="summary">The Redis server configurations.</span></small>

///right
[RedisManager.php#40~45](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L40-L45 target=_blank)
///

...The Redis server configurations.
```php:Definitation
protected array $config = null
```




...


#### <a id='Illuminate-Redis-RedisManager::$connections' class='anchor'></a>[p] $connections <small><span class="summary">The Redis connections.</span></small>

///right
[RedisManager.php#47~52](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L47-L52 target=_blank)
///

...The Redis connections.
```php:Definitation
protected mixed $connections = null
```




...


#### <a id='Illuminate-Redis-RedisManager::$events' class='anchor'></a>[p] $events <small><span class="summary">Indicates whether event dispatcher is set on connections.</span></small>

///right
[RedisManager.php#54~59](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/RedisManager.php#L54-L59 target=_blank)
///

...Indicates whether event dispatcher is set on connections.
```php:Definitation
protected bool $events = false
```




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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>


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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>

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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>




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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$connection` | ​<span class="summary"></span>
​string | ​`$name` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>




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
​[RedisManager](Illuminate-Redis.md#Illuminate-Redis-RedisManager "Illuminate\Redis\RedisManager") | ​<span class="summary"></span>




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
    + **[Illuminate\Redis\RedisServiceProvider](Illuminate-Redis.md#Illuminate-Redis-RedisServiceProvider "Illuminate\Redis\RedisServiceProvider")**


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




## <a id='Illuminate-Redis-Connections' class='anchor'></a>[N] Illuminate\\Redis\\Connections\\ <small><span class="summary"></span></small>




### <a id='Illuminate-Redis-Connections-Connection' class='anchor'></a>[C] Connection <small><span class="summary"></span></small>

///right
{abstract}[Connection.php#12~222](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L12-L222 target=_blank)
///



**Hierarchy**

+ **[Illuminate\Redis\Connections\Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")**
    + [Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")
        + [Illuminate\Redis\Connections\PhpRedisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection")
    + [Illuminate\Redis\Connections\PredisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection")
        + [Illuminate\Redis\Connections\PredisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection")




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
protected \Redis $client = null
```




...


#### <a id='Illuminate-Redis-Connections-Connection::$name' class='anchor'></a>[p] $name <small><span class="summary">The Redis connection name.</span></small>

///right
[Connection.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L25-L30 target=_blank)
///

...The Redis connection name.
```php:Definitation
protected string|null $name = null
```




...


#### <a id='Illuminate-Redis-Connections-Connection::$events' class='anchor'></a>[p] $events <small><span class="summary">The event dispatcher instance.</span></small>

///right
[Connection.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L32-L37 target=_blank)
///

...The event dispatcher instance.
```php:Definitation
protected Illuminate\Contracts\Events\Dispatcher $events = null
```




...


#### <a id='Illuminate-Redis-Connections-Connection::$macros' class='anchor'></a>[P] $macros <small><span class="summary">The registered string macros.</span></small>

///right
[Macroable.php#12~17](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Macroable/Traits/Macroable.php#L12-L17 target=_blank)
///

...The registered string macros.
```php:Definitation
protected static array $macros = []
```


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
​[ConcurrencyLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>




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
​[DurationLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>




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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>




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

+ [Illuminate\Redis\Connections\Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")
    + [Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")
        + **[Illuminate\Redis\Connections\PhpRedisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection")**
    + [Illuminate\Redis\Connections\PredisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection")
        + [Illuminate\Redis\Connections\PredisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection")


:Parents
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[PhpRedisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection") | ​<span class="summary"></span>
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>

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


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::$connector](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A%24connector "Illuminate\Redis\Connections\PhpRedisConnection::$connector") | ​<span class="summary">The connection creation callback.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$config' class='anchor'></a>[p] $config <small><span class="summary">The connection configuration array.</span></small>

///right
[PhpRedisConnection.php#26~31](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L26-L31 target=_blank)
///

...The connection configuration array.
```php:Definitation
protected array $config = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::$config](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A%24config "Illuminate\Redis\Connections\PhpRedisConnection::$config") | ​<span class="summary">The connection configuration array.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$client' class='anchor'></a>[p] $client <small><span class="summary">The Redis client.</span></small>

///right
[Connection.php#18~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L18-L23 target=_blank)
///

...The Redis client.
```php:Definitation
protected \Redis $client = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$client](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24client "Illuminate\Redis\Connections\Connection::$client") | ​<span class="summary">The Redis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$name' class='anchor'></a>[p] $name <small><span class="summary">The Redis connection name.</span></small>

///right
[Connection.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L25-L30 target=_blank)
///

...The Redis connection name.
```php:Definitation
protected string|null $name = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$name](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24name "Illuminate\Redis\Connections\Connection::$name") | ​<span class="summary">The Redis connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$events' class='anchor'></a>[p] $events <small><span class="summary">The event dispatcher instance.</span></small>

///right
[Connection.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L32-L37 target=_blank)
///

...The event dispatcher instance.
```php:Definitation
protected Illuminate\Contracts\Events\Dispatcher $events = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$events](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24events "Illuminate\Redis\Connections\Connection::$events") | ​<span class="summary">The event dispatcher instance.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$macros' class='anchor'></a>[P] $macros <small><span class="summary">The registered string macros.</span></small>

///right
[Connection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L-L target=_blank)
///

...The registered string macros.
```php:Definitation
protected static array $macros = []
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$macros](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24macros "Illuminate\Redis\Connections\Connection::$macros") | ​<span class="summary">The registered string macros.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$supportsPacking' class='anchor'></a>[p] $supportsPacking <small><span class="summary">Indicates if Redis supports packing.</span></small>

///right
[PhpRedisConnection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L-L target=_blank)
///

...Indicates if Redis supports packing.
```php:Definitation
protected bool|null $supportsPacking = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::$supportsPacking](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A%24supportsPacking "Illuminate\Redis\Connections\PhpRedisConnection::$supportsPacking") | ​<span class="summary">Indicates if Redis supports packing.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$supportsLzf' class='anchor'></a>[p] $supportsLzf <small><span class="summary">Indicates if Redis supports LZF compression.</span></small>

///right
[PhpRedisConnection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L-L target=_blank)
///

...Indicates if Redis supports LZF compression.
```php:Definitation
protected bool|null $supportsLzf = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::$supportsLzf](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A%24supportsLzf "Illuminate\Redis\Connections\PhpRedisConnection::$supportsLzf") | ​<span class="summary">Indicates if Redis supports LZF compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::$supportsZstd' class='anchor'></a>[p] $supportsZstd <small><span class="summary">Indicates if Redis supports Zstd compression.</span></small>

///right
[PhpRedisConnection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L-L target=_blank)
///

...Indicates if Redis supports Zstd compression.
```php:Definitation
protected bool|null $supportsZstd = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::$supportsZstd](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A%24supportsZstd "Illuminate\Redis\Connections\PhpRedisConnection::$supportsZstd") | ​<span class="summary">Indicates if Redis supports Zstd compression.</span>


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
​override | ​[PhpRedisConnection::flushdb()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aflushdb%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::flushdb()") | ​<span class="summary">Flush the selected Redis database.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new PhpRedis connection.</span></small>

///right
[PhpRedisConnection.php#33~46](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L33-L46 target=_blank)
///

...Create a new PhpRedis connection.
```php:Definitation
public function __construct(
    \Redis $client,
    ?callable|callable|null $connector = null,
    array $config = []
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Redis](https://php.net/manual/class.redis.php target=_blank) | ​`$client` | ​<span class="summary"></span>
​?callable\|​callable\|​null | ​`$connector = null` | ​<span class="summary"></span>
​array | ​`$config = []` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::__construct()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A__construct%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::__construct()") | ​<span class="summary">Create a new PhpRedis connection.</span>


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
​inherit | ​[PhpRedisConnection::get()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aget%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::get()") | ​<span class="summary">Returns the value of the given key.</span>


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
​inherit | ​[PhpRedisConnection::mget()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Amget%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::mget()") | ​<span class="summary">Get the values of all the given keys.</span>


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
​inherit | ​[PhpRedisConnection::set()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aset%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::set()") | ​<span class="summary">Set the string value in the argument as the value of the key.</span>


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
​inherit | ​[PhpRedisConnection::setnx()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Asetnx%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::setnx()") | ​<span class="summary">Set the given key if it doesn&apos;t exist.</span>


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
​inherit | ​[PhpRedisConnection::hmget()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ahmget%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::hmget()") | ​<span class="summary">Get the value of the given hash fields.</span>


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
​inherit | ​[PhpRedisConnection::hmset()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ahmset%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::hmset()") | ​<span class="summary">Set the given hash fields to their respective values.</span>


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
​inherit | ​[PhpRedisConnection::hsetnx()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ahsetnx%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::hsetnx()") | ​<span class="summary">Set the given hash field if it doesn&apos;t exist.</span>


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
​inherit | ​[PhpRedisConnection::lrem()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Alrem%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::lrem()") | ​<span class="summary">Removes the first count occurrences of the value element from the list.</span>


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
​inherit | ​[PhpRedisConnection::blpop()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ablpop%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::blpop()") | ​<span class="summary">Removes and returns the first element of the list stored at key.</span>


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
​inherit | ​[PhpRedisConnection::brpop()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Abrpop%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::brpop()") | ​<span class="summary">Removes and returns the last element of the list stored at key.</span>


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
​inherit | ​[PhpRedisConnection::spop()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aspop%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::spop()") | ​<span class="summary">Removes and returns a random element from the set value at key.</span>


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
​inherit | ​[PhpRedisConnection::zadd()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azadd%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zadd()") | ​<span class="summary">Add one or more members to a sorted set or update its score if it already exists.</span>


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
​inherit | ​[PhpRedisConnection::zrangebyscore()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azrangebyscore%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zrangebyscore()") | ​<span class="summary">Return elements with score between $min and $max.</span>


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
​inherit | ​[PhpRedisConnection::zrevrangebyscore()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azrevrangebyscore%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zrevrangebyscore()") | ​<span class="summary">Return elements with score between $min and $max.</span>


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
​inherit | ​[PhpRedisConnection::zinterstore()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azinterstore%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zinterstore()") | ​<span class="summary">Find the intersection between sets and store in a new set.</span>


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
​inherit | ​[PhpRedisConnection::zunionstore()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azunionstore%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zunionstore()") | ​<span class="summary">Find the union between sets and store in a new set.</span>


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
​inherit | ​[PhpRedisConnection::scan()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ascan%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::scan()") | ​<span class="summary">Scans all keys based on options.</span>


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
​inherit | ​[PhpRedisConnection::zscan()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Azscan%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zscan()") | ​<span class="summary">Scans the given set for all values based on options.</span>


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
​inherit | ​[PhpRedisConnection::hscan()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Ahscan%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::hscan()") | ​<span class="summary">Scans the given hash for all values based on options.</span>


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
​inherit | ​[PhpRedisConnection::sscan()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Asscan%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::sscan()") | ​<span class="summary">Scans the given set for all values based on options.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::pipeline()' class='anchor'></a>[m] pipeline <small><span class="summary">Execute commands in a pipeline.</span></small>

///right
[PhpRedisConnection.php#395~408](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L395-L408 target=_blank)
///

...Execute commands in a pipeline.
```php:Definitation
public function pipeline(?callable|callable|null $callback = null): \Redis|array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​?callable\|​callable\|​null | ​`$callback = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Redis](https://php.net/manual/class.redis.php target=_blank)\|​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::pipeline()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Apipeline%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::pipeline()") | ​<span class="summary">Execute commands in a pipeline.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisClusterConnection::transaction()' class='anchor'></a>[m] transaction <small><span class="summary">Execute commands in a transaction.</span></small>

///right
[PhpRedisConnection.php#410~423](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L410-L423 target=_blank)
///

...Execute commands in a transaction.
```php:Definitation
public function transaction(?callable|callable|null $callback = null): \Redis|array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​?callable\|​callable\|​null | ​`$callback = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Redis](https://php.net/manual/class.redis.php target=_blank)\|​array | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::transaction()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Atransaction%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::transaction()") | ​<span class="summary">Execute commands in a transaction.</span>


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
​inherit | ​[PhpRedisConnection::evalsha()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aevalsha%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::evalsha()") | ​<span class="summary">Evaluate a LUA script serverside, from the SHA1 hash of the script instead of the script itself.</span>


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
​inherit | ​[PhpRedisConnection::eval()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Aeval%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::eval()") | ​<span class="summary">Evaluate a script and return its result.</span>


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
​inherit | ​[PhpRedisConnection::subscribe()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Asubscribe%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::subscribe()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


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
​inherit | ​[PhpRedisConnection::psubscribe()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Apsubscribe%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::psubscribe()") | ​<span class="summary">Subscribe to a set of given channels with wildcards.</span>


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
​inherit | ​[PhpRedisConnection::createSubscription()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AcreateSubscription%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::createSubscription()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


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
​inherit | ​[PhpRedisConnection::executeRaw()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AexecuteRaw%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::executeRaw()") | ​<span class="summary">Execute a raw command.</span>


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
​[RedisException](https://php.net/manual/class.redisexception.php target=_blank) | ​<span class="summary"></span>

:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PhpRedisConnection::command()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Acommand%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::command()") | ​<span class="summary">Run a command against the Redis database.</span>


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
​inherit | ​[PhpRedisConnection::disconnect()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Adisconnect%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::disconnect()") | ​<span class="summary">Disconnects from the Redis instance.</span>


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
​inherit | ​[PhpRedisConnection::__call()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3A__call%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::__call()") | ​<span class="summary">Pass other method calls down to the underlying client.</span>


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
​[ConcurrencyLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::funnel()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Afunnel%28%29 "Illuminate\Redis\Connections\Connection::funnel()") | ​<span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span>


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
​[DurationLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::throttle()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Athrottle%28%29 "Illuminate\Redis\Connections\Connection::throttle()") | ​<span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span>


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
​inherit | ​[Connection::client()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Aclient%28%29 "Illuminate\Redis\Connections\Connection::client()") | ​<span class="summary">Get the underlying Redis client.</span>


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
​inherit | ​[Connection::event()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Aevent%28%29 "Illuminate\Redis\Connections\Connection::event()") | ​<span class="summary">Fire the given event if possible.</span>


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
​inherit | ​[Connection::listen()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Alisten%28%29 "Illuminate\Redis\Connections\Connection::listen()") | ​<span class="summary">Register a Redis command listener with the connection.</span>


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
​inherit | ​[Connection::getName()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AgetName%28%29 "Illuminate\Redis\Connections\Connection::getName()") | ​<span class="summary">Get the connection name.</span>


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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setName()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AsetName%28%29 "Illuminate\Redis\Connections\Connection::setName()") | ​<span class="summary">Set the connections name.</span>


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
​inherit | ​[Connection::getEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AgetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::getEventDispatcher()") | ​<span class="summary">Get the event dispatcher used by the connection.</span>


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
​inherit | ​[Connection::setEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::setEventDispatcher()") | ​<span class="summary">Set the event dispatcher instance on the connection.</span>


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
​inherit | ​[Connection::unsetEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AunsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::unsetEventDispatcher()") | ​<span class="summary">Unset the event dispatcher instance on the connection.</span>


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
​inherit | ​[Connection::macro()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Amacro%28%29 "Illuminate\Redis\Connections\Connection::macro()") | ​<span class="summary">Register a custom macro.</span>


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
​inherit | ​[Connection::mixin()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Amixin%28%29 "Illuminate\Redis\Connections\Connection::mixin()") | ​<span class="summary">Mix another object into the class.</span>


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
​inherit | ​[Connection::hasMacro()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AhasMacro%28%29 "Illuminate\Redis\Connections\Connection::hasMacro()") | ​<span class="summary">Checks if macro is registered.</span>


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
​inherit | ​[Connection::flushMacros()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AflushMacros%28%29 "Illuminate\Redis\Connections\Connection::flushMacros()") | ​<span class="summary">Flush the existing macros.</span>


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
​inherit | ​[Connection::__callStatic()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A__callStatic%28%29 "Illuminate\Redis\Connections\Connection::__callStatic()") | ​<span class="summary">Dynamically handle calls to the class.</span>


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
​inherit | ​[Connection::macroCall()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AmacroCall%28%29 "Illuminate\Redis\Connections\Connection::macroCall()") | ​<span class="summary">Dynamically handle calls to the class.</span>


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
​inherit | ​[PhpRedisConnection::pack()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Apack%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::pack()") | ​<span class="summary">Prepares the given values to be used with the `eval` command, including serialization and compression.</span>


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
​inherit | ​[PhpRedisConnection::compressed()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Acompressed%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::compressed()") | ​<span class="summary">Determine if compression is enabled.</span>


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
​inherit | ​[PhpRedisConnection::lzfCompressed()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AlzfCompressed%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::lzfCompressed()") | ​<span class="summary">Determine if LZF compression is enabled.</span>


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
​inherit | ​[PhpRedisConnection::zstdCompressed()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AzstdCompressed%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::zstdCompressed()") | ​<span class="summary">Determine if ZSTD compression is enabled.</span>


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
​inherit | ​[PhpRedisConnection::lz4Compressed()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3Alz4Compressed%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::lz4Compressed()") | ​<span class="summary">Determine if LZ4 compression is enabled.</span>


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
​inherit | ​[PhpRedisConnection::supportsPacking()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AsupportsPacking%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::supportsPacking()") | ​<span class="summary">Determine if the current PhpRedis extension version supports packing.</span>


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
​inherit | ​[PhpRedisConnection::supportsLzf()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AsupportsLzf%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::supportsLzf()") | ​<span class="summary">Determine if the current PhpRedis extension version supports LZF compression.</span>


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
​inherit | ​[PhpRedisConnection::supportsZstd()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AsupportsZstd%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::supportsZstd()") | ​<span class="summary">Determine if the current PhpRedis extension version supports Zstd compression.</span>


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
​inherit | ​[PhpRedisConnection::phpRedisVersionAtLeast()](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection%3A%3AphpRedisVersionAtLeast%28%29 "Illuminate\Redis\Connections\PhpRedisConnection::phpRedisVersionAtLeast()") | ​<span class="summary">Determine if the PhpRedis extension version is at least the given version.</span>


...


### <a id='Illuminate-Redis-Connections-PhpRedisConnection' class='anchor'></a>[C] PhpRedisConnection <small><span class="summary"></span></small>

///right
[PhpRedisConnection.php#12~577](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L12-L577 target=_blank)
///



**Hierarchy**

+ [Illuminate\Redis\Connections\Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")
    + **[Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")**
        + [Illuminate\Redis\Connections\PhpRedisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection")
    + [Illuminate\Redis\Connections\PredisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection")
        + [Illuminate\Redis\Connections\PredisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection")


:Parents
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>

:Implements
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](#--Illuminate-Contracts-Redis-Connection) | ​<span class="summary"></span>

:Uses
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[PacksPhpRedisValues](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues "Illuminate\Redis\Connections\PacksPhpRedisValues") | ​<span class="summary"></span>


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$connector' class='anchor'></a>[p] $connector <small><span class="summary">The connection creation callback.</span></small>

///right
[PhpRedisConnection.php#19~24](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L19-L24 target=_blank)
///

...The connection creation callback.
```php:Definitation
protected callable $connector = null
```




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$config' class='anchor'></a>[p] $config <small><span class="summary">The connection configuration array.</span></small>

///right
[PhpRedisConnection.php#26~31](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L26-L31 target=_blank)
///

...The connection configuration array.
```php:Definitation
protected array $config = null
```




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$client' class='anchor'></a>[p] $client <small><span class="summary">The Redis client.</span></small>

///right
[Connection.php#18~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L18-L23 target=_blank)
///

...The Redis client.
```php:Definitation
protected \Redis $client = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$client](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24client "Illuminate\Redis\Connections\Connection::$client") | ​<span class="summary">The Redis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$name' class='anchor'></a>[p] $name <small><span class="summary">The Redis connection name.</span></small>

///right
[Connection.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L25-L30 target=_blank)
///

...The Redis connection name.
```php:Definitation
protected string|null $name = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$name](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24name "Illuminate\Redis\Connections\Connection::$name") | ​<span class="summary">The Redis connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$events' class='anchor'></a>[p] $events <small><span class="summary">The event dispatcher instance.</span></small>

///right
[Connection.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L32-L37 target=_blank)
///

...The event dispatcher instance.
```php:Definitation
protected Illuminate\Contracts\Events\Dispatcher $events = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$events](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24events "Illuminate\Redis\Connections\Connection::$events") | ​<span class="summary">The event dispatcher instance.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$macros' class='anchor'></a>[P] $macros <small><span class="summary">The registered string macros.</span></small>

///right
[Connection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L-L target=_blank)
///

...The registered string macros.
```php:Definitation
protected static array $macros = []
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$macros](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24macros "Illuminate\Redis\Connections\Connection::$macros") | ​<span class="summary">The registered string macros.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$supportsPacking' class='anchor'></a>[p] $supportsPacking <small><span class="summary">Indicates if Redis supports packing.</span></small>

///right
[PacksPhpRedisValues.php#11~16](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L11-L16 target=_blank)
///

...Indicates if Redis supports packing.
```php:Definitation
protected bool|null $supportsPacking = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::$supportsPacking](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3A%24supportsPacking "Illuminate\Redis\Connections\PacksPhpRedisValues::$supportsPacking") | ​<span class="summary">Indicates if Redis supports packing.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$supportsLzf' class='anchor'></a>[p] $supportsLzf <small><span class="summary">Indicates if Redis supports LZF compression.</span></small>

///right
[PacksPhpRedisValues.php#18~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L18-L23 target=_blank)
///

...Indicates if Redis supports LZF compression.
```php:Definitation
protected bool|null $supportsLzf = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::$supportsLzf](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3A%24supportsLzf "Illuminate\Redis\Connections\PacksPhpRedisValues::$supportsLzf") | ​<span class="summary">Indicates if Redis supports LZF compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::$supportsZstd' class='anchor'></a>[p] $supportsZstd <small><span class="summary">Indicates if Redis supports Zstd compression.</span></small>

///right
[PacksPhpRedisValues.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L25-L30 target=_blank)
///

...Indicates if Redis supports Zstd compression.
```php:Definitation
protected bool|null $supportsZstd = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​instead | ​[PacksPhpRedisValues::$supportsZstd](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3A%24supportsZstd "Illuminate\Redis\Connections\PacksPhpRedisValues::$supportsZstd") | ​<span class="summary">Indicates if Redis supports Zstd compression.</span>


...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::__construct()' class='anchor'></a>[m] \_\_construct <small><span class="summary">Create a new PhpRedis connection.</span></small>

///right
[PhpRedisConnection.php#33~46](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L33-L46 target=_blank)
///

...Create a new PhpRedis connection.
```php:Definitation
public function __construct(
    \Redis $client,
    ?callable|callable|null $connector = null,
    array $config = []
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Redis](https://php.net/manual/class.redis.php target=_blank) | ​`$client` | ​<span class="summary"></span>
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
public function pipeline(?callable|callable|null $callback = null): \Redis|array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​?callable\|​callable\|​null | ​`$callback = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Redis](https://php.net/manual/class.redis.php target=_blank)\|​array | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connections-PhpRedisConnection::transaction()' class='anchor'></a>[m] transaction <small><span class="summary">Execute commands in a transaction.</span></small>

///right
[PhpRedisConnection.php#410~423](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PhpRedisConnection.php#L410-L423 target=_blank)
///

...Execute commands in a transaction.
```php:Definitation
public function transaction(?callable|callable|null $callback = null): \Redis|array
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​?callable\|​callable\|​null | ​`$callback = null` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Redis](https://php.net/manual/class.redis.php target=_blank)\|​array | ​<span class="summary"></span>




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
​override | ​[Connection::createSubscription()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AcreateSubscription%28%29 "Illuminate\Redis\Connections\Connection::createSubscription()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


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
​[RedisException](https://php.net/manual/class.redisexception.php target=_blank) | ​<span class="summary"></span>

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
​override | ​[Connection::__call()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A__call%28%29 "Illuminate\Redis\Connections\Connection::__call()") | ​<span class="summary">Pass other method calls down to the underlying client.</span>


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
​[ConcurrencyLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::funnel()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Afunnel%28%29 "Illuminate\Redis\Connections\Connection::funnel()") | ​<span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span>


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
​[DurationLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::throttle()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Athrottle%28%29 "Illuminate\Redis\Connections\Connection::throttle()") | ​<span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span>


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
​inherit | ​[Connection::client()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Aclient%28%29 "Illuminate\Redis\Connections\Connection::client()") | ​<span class="summary">Get the underlying Redis client.</span>


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
​inherit | ​[Connection::event()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Aevent%28%29 "Illuminate\Redis\Connections\Connection::event()") | ​<span class="summary">Fire the given event if possible.</span>


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
​inherit | ​[Connection::listen()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Alisten%28%29 "Illuminate\Redis\Connections\Connection::listen()") | ​<span class="summary">Register a Redis command listener with the connection.</span>


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
​inherit | ​[Connection::getName()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AgetName%28%29 "Illuminate\Redis\Connections\Connection::getName()") | ​<span class="summary">Get the connection name.</span>


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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setName()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AsetName%28%29 "Illuminate\Redis\Connections\Connection::setName()") | ​<span class="summary">Set the connections name.</span>


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
​inherit | ​[Connection::getEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AgetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::getEventDispatcher()") | ​<span class="summary">Get the event dispatcher used by the connection.</span>


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
​inherit | ​[Connection::setEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::setEventDispatcher()") | ​<span class="summary">Set the event dispatcher instance on the connection.</span>


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
​inherit | ​[Connection::unsetEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AunsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::unsetEventDispatcher()") | ​<span class="summary">Unset the event dispatcher instance on the connection.</span>


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
​inherit | ​[Connection::macro()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Amacro%28%29 "Illuminate\Redis\Connections\Connection::macro()") | ​<span class="summary">Register a custom macro.</span>


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
​inherit | ​[Connection::mixin()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Amixin%28%29 "Illuminate\Redis\Connections\Connection::mixin()") | ​<span class="summary">Mix another object into the class.</span>


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
​inherit | ​[Connection::hasMacro()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AhasMacro%28%29 "Illuminate\Redis\Connections\Connection::hasMacro()") | ​<span class="summary">Checks if macro is registered.</span>


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
​inherit | ​[Connection::flushMacros()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AflushMacros%28%29 "Illuminate\Redis\Connections\Connection::flushMacros()") | ​<span class="summary">Flush the existing macros.</span>


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
​inherit | ​[Connection::__callStatic()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A__callStatic%28%29 "Illuminate\Redis\Connections\Connection::__callStatic()") | ​<span class="summary">Dynamically handle calls to the class.</span>


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
​inherit | ​[Connection::macroCall()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AmacroCall%28%29 "Illuminate\Redis\Connections\Connection::macroCall()") | ​<span class="summary">Dynamically handle calls to the class.</span>


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
​instead | ​[PacksPhpRedisValues::pack()](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3Apack%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::pack()") | ​<span class="summary">Prepares the given values to be used with the `eval` command, including serialization and compression.</span>


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
​instead | ​[PacksPhpRedisValues::compressed()](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3Acompressed%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::compressed()") | ​<span class="summary">Determine if compression is enabled.</span>


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
​instead | ​[PacksPhpRedisValues::lzfCompressed()](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AlzfCompressed%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::lzfCompressed()") | ​<span class="summary">Determine if LZF compression is enabled.</span>


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
​instead | ​[PacksPhpRedisValues::zstdCompressed()](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AzstdCompressed%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::zstdCompressed()") | ​<span class="summary">Determine if ZSTD compression is enabled.</span>


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
​instead | ​[PacksPhpRedisValues::lz4Compressed()](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3Alz4Compressed%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::lz4Compressed()") | ​<span class="summary">Determine if LZ4 compression is enabled.</span>


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
​instead | ​[PacksPhpRedisValues::supportsPacking()](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AsupportsPacking%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::supportsPacking()") | ​<span class="summary">Determine if the current PhpRedis extension version supports packing.</span>


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
​instead | ​[PacksPhpRedisValues::supportsLzf()](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AsupportsLzf%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::supportsLzf()") | ​<span class="summary">Determine if the current PhpRedis extension version supports LZF compression.</span>


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
​instead | ​[PacksPhpRedisValues::supportsZstd()](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AsupportsZstd%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::supportsZstd()") | ​<span class="summary">Determine if the current PhpRedis extension version supports Zstd compression.</span>


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
​instead | ​[PacksPhpRedisValues::phpRedisVersionAtLeast()](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues%3A%3AphpRedisVersionAtLeast%28%29 "Illuminate\Redis\Connections\PacksPhpRedisValues::phpRedisVersionAtLeast()") | ​<span class="summary">Determine if the PhpRedis extension version is at least the given version.</span>


...


### <a id='Illuminate-Redis-Connections-PredisClusterConnection' class='anchor'></a>[C] PredisClusterConnection <small><span class="summary"></span></small>

///right
[PredisClusterConnection.php#7~20](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PredisClusterConnection.php#L7-L20 target=_blank)
///



**Hierarchy**

+ [Illuminate\Redis\Connections\Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")
    + [Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")
        + [Illuminate\Redis\Connections\PhpRedisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection")
    + [Illuminate\Redis\Connections\PredisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection")
        + **[Illuminate\Redis\Connections\PredisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection")**


:Parents
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[PredisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection") | ​<span class="summary"></span>
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>

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


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[PredisConnection::$client](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisConnection%3A%3A%24client "Illuminate\Redis\Connections\PredisConnection::$client") | ​<span class="summary">The Predis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::$name' class='anchor'></a>[p] $name <small><span class="summary">The Redis connection name.</span></small>

///right
[Connection.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L25-L30 target=_blank)
///

...The Redis connection name.
```php:Definitation
protected string|null $name = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$name](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24name "Illuminate\Redis\Connections\Connection::$name") | ​<span class="summary">The Redis connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::$events' class='anchor'></a>[p] $events <small><span class="summary">The event dispatcher instance.</span></small>

///right
[Connection.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L32-L37 target=_blank)
///

...The event dispatcher instance.
```php:Definitation
protected Illuminate\Contracts\Events\Dispatcher $events = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$events](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24events "Illuminate\Redis\Connections\Connection::$events") | ​<span class="summary">The event dispatcher instance.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisClusterConnection::$macros' class='anchor'></a>[P] $macros <small><span class="summary">The registered string macros.</span></small>

///right
[Connection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L-L target=_blank)
///

...The registered string macros.
```php:Definitation
protected static array $macros = []
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$macros](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24macros "Illuminate\Redis\Connections\Connection::$macros") | ​<span class="summary">The registered string macros.</span>


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
​inherit | ​[PredisConnection::__construct()](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisConnection%3A%3A__construct%28%29 "Illuminate\Redis\Connections\PredisConnection::__construct()") | ​<span class="summary">Create a new Predis connection.</span>


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
​inherit | ​[PredisConnection::createSubscription()](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisConnection%3A%3AcreateSubscription%28%29 "Illuminate\Redis\Connections\PredisConnection::createSubscription()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


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
​[ConcurrencyLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::funnel()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Afunnel%28%29 "Illuminate\Redis\Connections\Connection::funnel()") | ​<span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span>


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
​[DurationLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::throttle()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Athrottle%28%29 "Illuminate\Redis\Connections\Connection::throttle()") | ​<span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span>


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
​inherit | ​[Connection::client()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Aclient%28%29 "Illuminate\Redis\Connections\Connection::client()") | ​<span class="summary">Get the underlying Redis client.</span>


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
​inherit | ​[Connection::subscribe()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Asubscribe%28%29 "Illuminate\Redis\Connections\Connection::subscribe()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


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
​inherit | ​[Connection::psubscribe()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Apsubscribe%28%29 "Illuminate\Redis\Connections\Connection::psubscribe()") | ​<span class="summary">Subscribe to a set of given channels with wildcards.</span>


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
​inherit | ​[Connection::command()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Acommand%28%29 "Illuminate\Redis\Connections\Connection::command()") | ​<span class="summary">Run a command against the Redis database.</span>


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
​inherit | ​[Connection::event()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Aevent%28%29 "Illuminate\Redis\Connections\Connection::event()") | ​<span class="summary">Fire the given event if possible.</span>


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
​inherit | ​[Connection::listen()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Alisten%28%29 "Illuminate\Redis\Connections\Connection::listen()") | ​<span class="summary">Register a Redis command listener with the connection.</span>


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
​inherit | ​[Connection::getName()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AgetName%28%29 "Illuminate\Redis\Connections\Connection::getName()") | ​<span class="summary">Get the connection name.</span>


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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setName()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AsetName%28%29 "Illuminate\Redis\Connections\Connection::setName()") | ​<span class="summary">Set the connections name.</span>


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
​inherit | ​[Connection::getEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AgetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::getEventDispatcher()") | ​<span class="summary">Get the event dispatcher used by the connection.</span>


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
​inherit | ​[Connection::setEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::setEventDispatcher()") | ​<span class="summary">Set the event dispatcher instance on the connection.</span>


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
​inherit | ​[Connection::unsetEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AunsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::unsetEventDispatcher()") | ​<span class="summary">Unset the event dispatcher instance on the connection.</span>


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
​inherit | ​[Connection::__call()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A__call%28%29 "Illuminate\Redis\Connections\Connection::__call()") | ​<span class="summary">Pass other method calls down to the underlying client.</span>


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
​inherit | ​[Connection::macro()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Amacro%28%29 "Illuminate\Redis\Connections\Connection::macro()") | ​<span class="summary">Register a custom macro.</span>


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
​inherit | ​[Connection::mixin()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Amixin%28%29 "Illuminate\Redis\Connections\Connection::mixin()") | ​<span class="summary">Mix another object into the class.</span>


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
​inherit | ​[Connection::hasMacro()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AhasMacro%28%29 "Illuminate\Redis\Connections\Connection::hasMacro()") | ​<span class="summary">Checks if macro is registered.</span>


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
​inherit | ​[Connection::flushMacros()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AflushMacros%28%29 "Illuminate\Redis\Connections\Connection::flushMacros()") | ​<span class="summary">Flush the existing macros.</span>


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
​inherit | ​[Connection::__callStatic()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A__callStatic%28%29 "Illuminate\Redis\Connections\Connection::__callStatic()") | ​<span class="summary">Dynamically handle calls to the class.</span>


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
​inherit | ​[Connection::macroCall()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AmacroCall%28%29 "Illuminate\Redis\Connections\Connection::macroCall()") | ​<span class="summary">Dynamically handle calls to the class.</span>


...


### <a id='Illuminate-Redis-Connections-PredisConnection' class='anchor'></a>[C] PredisConnection <small><span class="summary"></span></small>

///right
[PredisConnection.php#8~53](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PredisConnection.php#L8-L53 target=_blank)
///



**Hierarchy**

+ [Illuminate\Redis\Connections\Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection")
    + [Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")
        + [Illuminate\Redis\Connections\PhpRedisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection")
    + **[Illuminate\Redis\Connections\PredisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection")**
        + [Illuminate\Redis\Connections\PredisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection")


:Parents
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>

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


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​override | ​[Connection::$client](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24client "Illuminate\Redis\Connections\Connection::$client") | ​<span class="summary">The Redis client.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::$name' class='anchor'></a>[p] $name <small><span class="summary">The Redis connection name.</span></small>

///right
[Connection.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L25-L30 target=_blank)
///

...The Redis connection name.
```php:Definitation
protected string|null $name = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$name](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24name "Illuminate\Redis\Connections\Connection::$name") | ​<span class="summary">The Redis connection name.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::$events' class='anchor'></a>[p] $events <small><span class="summary">The event dispatcher instance.</span></small>

///right
[Connection.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L32-L37 target=_blank)
///

...The event dispatcher instance.
```php:Definitation
protected Illuminate\Contracts\Events\Dispatcher $events = null
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$events](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24events "Illuminate\Redis\Connections\Connection::$events") | ​<span class="summary">The event dispatcher instance.</span>


...


#### <a id='Illuminate-Redis-Connections-PredisConnection::$macros' class='anchor'></a>[P] $macros <small><span class="summary">The registered string macros.</span></small>

///right
[Connection.php#~](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/Connection.php#L-L target=_blank)
///

...The registered string macros.
```php:Definitation
protected static array $macros = []
```


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::$macros](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A%24macros "Illuminate\Redis\Connections\Connection::$macros") | ​<span class="summary">The registered string macros.</span>


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
​override | ​[Connection::createSubscription()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AcreateSubscription%28%29 "Illuminate\Redis\Connections\Connection::createSubscription()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


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
​[ConcurrencyLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::funnel()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Afunnel%28%29 "Illuminate\Redis\Connections\Connection::funnel()") | ​<span class="summary">Funnel a callback for a maximum number of simultaneous executions.</span>


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
​[DurationLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::throttle()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Athrottle%28%29 "Illuminate\Redis\Connections\Connection::throttle()") | ​<span class="summary">Throttle a callback for a maximum number of executions over a given duration.</span>


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
​inherit | ​[Connection::client()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Aclient%28%29 "Illuminate\Redis\Connections\Connection::client()") | ​<span class="summary">Get the underlying Redis client.</span>


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
​inherit | ​[Connection::subscribe()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Asubscribe%28%29 "Illuminate\Redis\Connections\Connection::subscribe()") | ​<span class="summary">Subscribe to a set of given channels for messages.</span>


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
​inherit | ​[Connection::psubscribe()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Apsubscribe%28%29 "Illuminate\Redis\Connections\Connection::psubscribe()") | ​<span class="summary">Subscribe to a set of given channels with wildcards.</span>


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
​inherit | ​[Connection::command()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Acommand%28%29 "Illuminate\Redis\Connections\Connection::command()") | ​<span class="summary">Run a command against the Redis database.</span>


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
​inherit | ​[Connection::event()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Aevent%28%29 "Illuminate\Redis\Connections\Connection::event()") | ​<span class="summary">Fire the given event if possible.</span>


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
​inherit | ​[Connection::listen()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Alisten%28%29 "Illuminate\Redis\Connections\Connection::listen()") | ​<span class="summary">Register a Redis command listener with the connection.</span>


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
​inherit | ​[Connection::getName()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AgetName%28%29 "Illuminate\Redis\Connections\Connection::getName()") | ​<span class="summary">Get the connection name.</span>


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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​inherit | ​[Connection::setName()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AsetName%28%29 "Illuminate\Redis\Connections\Connection::setName()") | ​<span class="summary">Set the connections name.</span>


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
​inherit | ​[Connection::getEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AgetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::getEventDispatcher()") | ​<span class="summary">Get the event dispatcher used by the connection.</span>


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
​inherit | ​[Connection::setEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::setEventDispatcher()") | ​<span class="summary">Set the event dispatcher instance on the connection.</span>


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
​inherit | ​[Connection::unsetEventDispatcher()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AunsetEventDispatcher%28%29 "Illuminate\Redis\Connections\Connection::unsetEventDispatcher()") | ​<span class="summary">Unset the event dispatcher instance on the connection.</span>


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
​inherit | ​[Connection::__call()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A__call%28%29 "Illuminate\Redis\Connections\Connection::__call()") | ​<span class="summary">Pass other method calls down to the underlying client.</span>


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
​inherit | ​[Connection::macro()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Amacro%28%29 "Illuminate\Redis\Connections\Connection::macro()") | ​<span class="summary">Register a custom macro.</span>


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
​inherit | ​[Connection::mixin()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3Amixin%28%29 "Illuminate\Redis\Connections\Connection::mixin()") | ​<span class="summary">Mix another object into the class.</span>


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
​inherit | ​[Connection::hasMacro()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AhasMacro%28%29 "Illuminate\Redis\Connections\Connection::hasMacro()") | ​<span class="summary">Checks if macro is registered.</span>


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
​inherit | ​[Connection::flushMacros()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AflushMacros%28%29 "Illuminate\Redis\Connections\Connection::flushMacros()") | ​<span class="summary">Flush the existing macros.</span>


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
​inherit | ​[Connection::__callStatic()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3A__callStatic%28%29 "Illuminate\Redis\Connections\Connection::__callStatic()") | ​<span class="summary">Dynamically handle calls to the class.</span>


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
​inherit | ​[Connection::macroCall()](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection%3A%3AmacroCall%28%29 "Illuminate\Redis\Connections\Connection::macroCall()") | ​<span class="summary">Dynamically handle calls to the class.</span>


...


### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues' class='anchor'></a>[T] PacksPhpRedisValues <small><span class="summary"></span></small>

///right
[PacksPhpRedisValues.php#9~183](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L9-L183 target=_blank)
///



**Hierarchy**

+ **[Illuminate\Redis\Connections\PacksPhpRedisValues](Illuminate-Redis.md#Illuminate-Redis-Connections-PacksPhpRedisValues "Illuminate\Redis\Connections\PacksPhpRedisValues")**
    + [Illuminate\Redis\Connections\PhpRedisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection")






#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::$supportsPacking' class='anchor'></a>[p] $supportsPacking <small><span class="summary">Indicates if Redis supports packing.</span></small>

///right
[PacksPhpRedisValues.php#11~16](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L11-L16 target=_blank)
///

...Indicates if Redis supports packing.
```php:Definitation
protected bool|null $supportsPacking = null
```




...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::$supportsLzf' class='anchor'></a>[p] $supportsLzf <small><span class="summary">Indicates if Redis supports LZF compression.</span></small>

///right
[PacksPhpRedisValues.php#18~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L18-L23 target=_blank)
///

...Indicates if Redis supports LZF compression.
```php:Definitation
protected bool|null $supportsLzf = null
```




...


#### <a id='Illuminate-Redis-Connections-PacksPhpRedisValues::$supportsZstd' class='anchor'></a>[p] $supportsZstd <small><span class="summary">Indicates if Redis supports Zstd compression.</span></small>

///right
[PacksPhpRedisValues.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connections/PacksPhpRedisValues.php#L25-L30 target=_blank)
///

...Indicates if Redis supports Zstd compression.
```php:Definitation
protected bool|null $supportsZstd = null
```




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





## <a id='Illuminate-Redis-Connectors' class='anchor'></a>[N] Illuminate\\Redis\\Connectors\\ <small><span class="summary"></span></small>




### <a id='Illuminate-Redis-Connectors-PhpRedisConnector' class='anchor'></a>[C] PhpRedisConnector <small><span class="summary"></span></small>

///right
[PhpRedisConnector.php#15~228](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connectors/PhpRedisConnector.php#L15-L228 target=_blank)
///





:Implements
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connector](#--Illuminate-Contracts-Redis-Connector) | ​<span class="summary"></span>




#### <a id='Illuminate-Redis-Connectors-PhpRedisConnector::connect()' class='anchor'></a>[m] connect <small><span class="summary">Create a new clustered PhpRedis connection.</span></small>

///right
[PhpRedisConnector.php#17~33](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connectors/PhpRedisConnector.php#L17-L33 target=_blank)
///

...Create a new clustered PhpRedis connection.
```php:Definitation
public function connect(
    array $config,
    array $options
): Illuminate\Redis\Connections\PhpRedisConnection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$config` | ​<span class="summary"></span>
​array | ​`$options` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[PhpRedisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​implement | ​[Connector::connect()](#--Illuminate-Contracts-Redis-Connector%3A%3Aconnect%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connectors-PhpRedisConnector::connectToCluster()' class='anchor'></a>[m] connectToCluster <small><span class="summary">Create a new clustered PhpRedis connection.</span></small>

///right
[PhpRedisConnector.php#35~50](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connectors/PhpRedisConnector.php#L35-L50 target=_blank)
///

...Create a new clustered PhpRedis connection.
```php:Definitation
public function connectToCluster(
    array $config,
    array $clusterOptions,
    array $options
): Illuminate\Redis\Connections\PhpRedisClusterConnection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$config` | ​<span class="summary"></span>
​array | ​`$clusterOptions` | ​<span class="summary"></span>
​array | ​`$options` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[PhpRedisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​implement | ​[Connector::connectToCluster()](#--Illuminate-Contracts-Redis-Connector%3A%3AconnectToCluster%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connectors-PhpRedisConnector::buildClusterConnectionString()' class='anchor'></a>[m] buildClusterConnectionString <small><span class="summary">Build a single cluster seed string from an array.</span></small>

///right
[PhpRedisConnector.php#52~63](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connectors/PhpRedisConnector.php#L52-L63 target=_blank)
///

...Build a single cluster seed string from an array.
```php:Definitation
protected function buildClusterConnectionString(array $server): string
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$server` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connectors-PhpRedisConnector::createClient()' class='anchor'></a>[m] createClient <small><span class="summary">Create the Redis client instance.</span></small>

///right
[PhpRedisConnector.php#65~122](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connectors/PhpRedisConnector.php#L65-L122 target=_blank)
///

...Create the Redis client instance.
```php:Definitation
protected function createClient(array $config): \Redis
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$config` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Redis](https://php.net/manual/class.redis.php target=_blank) | ​<span class="summary"></span>

:Throws
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[LogicException](https://php.net/manual/class.logicexception.php target=_blank) | ​<span class="summary"></span>



...


#### <a id='Illuminate-Redis-Connectors-PhpRedisConnector::establishConnection()' class='anchor'></a>[m] establishConnection <small><span class="summary">Establish a connection with the Redis host.</span></small>

///right
[PhpRedisConnector.php#124~154](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connectors/PhpRedisConnector.php#L124-L154 target=_blank)
///

...Establish a connection with the Redis host.
```php:Definitation
protected function establishConnection(
    \Redis $client,
    array $config
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Redis](https://php.net/manual/class.redis.php target=_blank) | ​`$client` | ​<span class="summary"></span>
​array | ​`$config` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connectors-PhpRedisConnector::createRedisClusterInstance()' class='anchor'></a>[m] createRedisClusterInstance <small><span class="summary">Create a new redis cluster instance.</span></small>

///right
[PhpRedisConnector.php#156~212](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connectors/PhpRedisConnector.php#L156-L212 target=_blank)
///

...Create a new redis cluster instance.
```php:Definitation
protected function createRedisClusterInstance(
    array $servers,
    array $options
): \RedisCluster
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$servers` | ​<span class="summary"></span>
​array | ​`$options` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[RedisCluster](https://php.net/manual/class.rediscluster.php target=_blank) | ​<span class="summary"></span>




...


#### <a id='Illuminate-Redis-Connectors-PhpRedisConnector::formatHost()' class='anchor'></a>[m] formatHost <small><span class="summary">Format the host using the scheme if available.</span></small>

///right
[PhpRedisConnector.php#214~227](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connectors/PhpRedisConnector.php#L214-L227 target=_blank)
///

...Format the host using the scheme if available.
```php:Definitation
protected function formatHost(array $options): string
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$options` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​string | ​<span class="summary"></span>




...


### <a id='Illuminate-Redis-Connectors-PredisConnector' class='anchor'></a>[C] PredisConnector <small><span class="summary"></span></small>

///right
[PredisConnector.php#11~53](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connectors/PredisConnector.php#L11-L53 target=_blank)
///





:Implements
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Connector](#--Illuminate-Contracts-Redis-Connector) | ​<span class="summary"></span>




#### <a id='Illuminate-Redis-Connectors-PredisConnector::connect()' class='anchor'></a>[m] connect <small><span class="summary">Create a new clustered Predis connection.</span></small>

///right
[PredisConnector.php#13~31](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connectors/PredisConnector.php#L13-L31 target=_blank)
///

...Create a new clustered Predis connection.
```php:Definitation
public function connect(
    array $config,
    array $options
): Illuminate\Redis\Connections\PredisConnection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$config` | ​<span class="summary"></span>
​array | ​`$options` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[PredisConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​implement | ​[Connector::connect()](#--Illuminate-Contracts-Redis-Connector%3A%3Aconnect%28%29) | ​<span class="summary"></span>


...


#### <a id='Illuminate-Redis-Connectors-PredisConnector::connectToCluster()' class='anchor'></a>[m] connectToCluster <small><span class="summary">Create a new clustered Predis connection.</span></small>

///right
[PredisConnector.php#33~52](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Connectors/PredisConnector.php#L33-L52 target=_blank)
///

...Create a new clustered Predis connection.
```php:Definitation
public function connectToCluster(
    array $config,
    array $clusterOptions,
    array $options
): Illuminate\Redis\Connections\PredisClusterConnection
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$config` | ​<span class="summary"></span>
​array | ​`$clusterOptions` | ​<span class="summary"></span>
​array | ​`$options` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[PredisClusterConnection](Illuminate-Redis.md#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​implement | ​[Connector::connectToCluster()](#--Illuminate-Contracts-Redis-Connector%3A%3AconnectToCluster%28%29) | ​<span class="summary"></span>


...






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




...


#### <a id='Illuminate-Redis-Events-CommandExecuted::$parameters' class='anchor'></a>[p] $parameters <small><span class="summary">The array of command parameters.</span></small>

///right
[CommandExecuted.php#14~19](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Events/CommandExecuted.php#L14-L19 target=_blank)
///

...The array of command parameters.
```php:Definitation
public array $parameters = null
```




...


#### <a id='Illuminate-Redis-Events-CommandExecuted::$time' class='anchor'></a>[p] $time <small><span class="summary">The number of milliseconds it took to execute the command.</span></small>

///right
[CommandExecuted.php#21~26](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Events/CommandExecuted.php#L21-L26 target=_blank)
///

...The number of milliseconds it took to execute the command.
```php:Definitation
public float $time = null
```




...


#### <a id='Illuminate-Redis-Events-CommandExecuted::$connection' class='anchor'></a>[p] $connection <small><span class="summary">The Redis connection instance.</span></small>

///right
[CommandExecuted.php#28~33](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Events/CommandExecuted.php#L28-L33 target=_blank)
///

...The Redis connection instance.
```php:Definitation
public Illuminate\Redis\Connections\Connection $connection = null
```




...


#### <a id='Illuminate-Redis-Events-CommandExecuted::$connectionName' class='anchor'></a>[p] $connectionName <small><span class="summary">The Redis connection name.</span></small>

///right
[CommandExecuted.php#35~40](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Events/CommandExecuted.php#L35-L40 target=_blank)
///

...The Redis connection name.
```php:Definitation
public string $connectionName = null
```




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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$connection` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​void | ​<span class="summary"></span>




...






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




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::$name' class='anchor'></a>[p] $name <small><span class="summary">The name of the limiter.</span></small>

///right
[ConcurrencyLimiter.php#18~23](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L18-L23 target=_blank)
///

...The name of the limiter.
```php:Definitation
protected string $name = null
```




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::$maxLocks' class='anchor'></a>[p] $maxLocks <small><span class="summary">The allowed number of concurrent tasks.</span></small>

///right
[ConcurrencyLimiter.php#25~30](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L25-L30 target=_blank)
///

...The allowed number of concurrent tasks.
```php:Definitation
protected int $maxLocks = null
```




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiter::$releaseAfter' class='anchor'></a>[p] $releaseAfter <small><span class="summary">The number of seconds a slot should be maintained.</span></small>

///right
[ConcurrencyLimiter.php#32~37](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiter.php#L32-L37 target=_blank)
///

...The number of seconds a slot should be maintained.
```php:Definitation
protected int $releaseAfter = null
```




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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$redis` | ​<span class="summary"></span>
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




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::$name' class='anchor'></a>[p] $name <small><span class="summary">The name of the lock.</span></small>

///right
[ConcurrencyLimiterBuilder.php#19~24](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L19-L24 target=_blank)
///

...The name of the lock.
```php:Definitation
public string $name = null
```




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::$maxLocks' class='anchor'></a>[p] $maxLocks <small><span class="summary">The maximum number of entities that can hold the lock at the same time.</span></small>

///right
[ConcurrencyLimiterBuilder.php#26~31](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L26-L31 target=_blank)
///

...The maximum number of entities that can hold the lock at the same time.
```php:Definitation
public int $maxLocks = null
```




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::$releaseAfter' class='anchor'></a>[p] $releaseAfter <small><span class="summary">The number of seconds to maintain the lock until it is automatically released.</span></small>

///right
[ConcurrencyLimiterBuilder.php#33~38](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L33-L38 target=_blank)
///

...The number of seconds to maintain the lock until it is automatically released.
```php:Definitation
public int $releaseAfter = 60
```




...


#### <a id='Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder::$timeout' class='anchor'></a>[p] $timeout <small><span class="summary">The amount of time to block until a lock is available.</span></small>

///right
[ConcurrencyLimiterBuilder.php#40~45](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/ConcurrencyLimiterBuilder.php#L40-L45 target=_blank)
///

...The amount of time to block until a lock is available.
```php:Definitation
public int $timeout = 3
```




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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$connection` | ​<span class="summary"></span>
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
​[ConcurrencyLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>




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
​[ConcurrencyLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>




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
​[ConcurrencyLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>




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




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::$name' class='anchor'></a>[p] $name <small><span class="summary">The unique name of the lock.</span></small>

///right
[DurationLimiter.php#16~21](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L16-L21 target=_blank)
///

...The unique name of the lock.
```php:Definitation
private string $name = null
```




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::$maxLocks' class='anchor'></a>[p] $maxLocks <small><span class="summary">The allowed number of concurrent tasks.</span></small>

///right
[DurationLimiter.php#23~28](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L23-L28 target=_blank)
///

...The allowed number of concurrent tasks.
```php:Definitation
private int $maxLocks = null
```




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::$decay' class='anchor'></a>[p] $decay <small><span class="summary">The number of seconds a slot should be maintained.</span></small>

///right
[DurationLimiter.php#30~35](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L30-L35 target=_blank)
///

...The number of seconds a slot should be maintained.
```php:Definitation
private int $decay = null
```




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::$decaysAt' class='anchor'></a>[p] $decaysAt <small><span class="summary">The timestamp of the end of the current duration.</span></small>

///right
[DurationLimiter.php#37~42](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L37-L42 target=_blank)
///

...The timestamp of the end of the current duration.
```php:Definitation
public int $decaysAt = null
```




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiter::$remaining' class='anchor'></a>[p] $remaining <small><span class="summary">The number of remaining slots.</span></small>

///right
[DurationLimiter.php#44~49](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiter.php#L44-L49 target=_blank)
///

...The number of remaining slots.
```php:Definitation
public int $remaining = null
```




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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$redis` | ​<span class="summary"></span>
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




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::$name' class='anchor'></a>[p] $name <small><span class="summary">The name of the lock.</span></small>

///right
[DurationLimiterBuilder.php#19~24](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L19-L24 target=_blank)
///

...The name of the lock.
```php:Definitation
public string $name = null
```




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::$maxLocks' class='anchor'></a>[p] $maxLocks <small><span class="summary">The maximum number of locks that can be obtained per time window.</span></small>

///right
[DurationLimiterBuilder.php#26~31](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L26-L31 target=_blank)
///

...The maximum number of locks that can be obtained per time window.
```php:Definitation
public int $maxLocks = null
```




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::$decay' class='anchor'></a>[p] $decay <small><span class="summary">The amount of time the lock window is maintained.</span></small>

///right
[DurationLimiterBuilder.php#33~38](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L33-L38 target=_blank)
///

...The amount of time the lock window is maintained.
```php:Definitation
public int $decay = null
```




...


#### <a id='Illuminate-Redis-Limiters-DurationLimiterBuilder::$timeout' class='anchor'></a>[p] $timeout <small><span class="summary">The amount of time to block until a lock is available.</span></small>

///right
[DurationLimiterBuilder.php#40~45](https://github.com/laravel/framework/blob/v8.83.23/src/Illuminate/Redis/Limiters/DurationLimiterBuilder.php#L40-L45 target=_blank)
///

...The amount of time to block until a lock is available.
```php:Definitation
public int $timeout = 3
```




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
​[Connection](Illuminate-Redis.md#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​`$connection` | ​<span class="summary"></span>
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
​[DurationLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>




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
​[DurationLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>




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
​[DurationLimiterBuilder](Illuminate-Redis.md#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>




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







