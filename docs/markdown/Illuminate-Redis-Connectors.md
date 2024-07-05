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
​[PhpRedisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection") | ​<span class="summary"></span>


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
​[PhpRedisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection") | ​<span class="summary"></span>


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
protected function createClient(array $config): Redis
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$config` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[Redis](#--Redis) | ​<span class="summary"></span>

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
    Redis $client,
    array $config
): void
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​[Redis](#--Redis) | ​`$client` | ​<span class="summary"></span>
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
): RedisCluster
```


:Parameter
type | name | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​array | ​`$servers` | ​<span class="summary"></span>
​array | ​`$options` | ​<span class="summary"></span>

:Return
type | summary
----------------------- | -----------------------------------------------------------------------------------
​[RedisCluster](#--RedisCluster) | ​<span class="summary"></span>




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
​[PredisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection") | ​<span class="summary"></span>


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
​[PredisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection") | ​<span class="summary"></span>


:Prototype
kind | source | summary
----------------------- | --------------------------------- | -----------------------------------------------------
​implement | ​[Connector::connectToCluster()](#--Illuminate-Contracts-Redis-Connector%3A%3AconnectToCluster%28%29) | ​<span class="summary"></span>


...






