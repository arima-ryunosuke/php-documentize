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






:classes
name | summary
--------------------------------- | -------------------------------------------------------------------------
​[RedisManager](Illuminate-Redis.html#Illuminate-Redis-RedisManager "Illuminate\Redis\RedisManager") | ​<span class="summary"></span>
​[RedisServiceProvider](Illuminate-Redis.html#Illuminate-Redis-RedisServiceProvider "Illuminate\Redis\RedisServiceProvider") | ​<span class="summary"></span>







## <a id='Illuminate-Redis-Connections' class='anchor'></a>[N] Illuminate\\Redis\\Connections\\ <small><span class="summary"></span></small>






:classes
name | summary
--------------------------------- | -------------------------------------------------------------------------
​[Connection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-Connection "Illuminate\Redis\Connections\Connection") | ​<span class="summary"></span>
​[PhpRedisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisClusterConnection "Illuminate\Redis\Connections\PhpRedisClusterConnection") | ​<span class="summary"></span>
​[PhpRedisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PhpRedisConnection "Illuminate\Redis\Connections\PhpRedisConnection") | ​<span class="summary"></span>
​[PredisClusterConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisClusterConnection "Illuminate\Redis\Connections\PredisClusterConnection") | ​<span class="summary"></span>
​[PredisConnection](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PredisConnection "Illuminate\Redis\Connections\PredisConnection") | ​<span class="summary"></span>

:traits
name | summary
--------------------------------- | -------------------------------------------------------------------------
​[PacksPhpRedisValues](Illuminate-Redis-Connections.html#Illuminate-Redis-Connections-PacksPhpRedisValues "Illuminate\Redis\Connections\PacksPhpRedisValues") | ​<span class="summary"></span>





## <a id='Illuminate-Redis-Connectors' class='anchor'></a>[N] Illuminate\\Redis\\Connectors\\ <small><span class="summary"></span></small>






:classes
name | summary
--------------------------------- | -------------------------------------------------------------------------
​[PhpRedisConnector](Illuminate-Redis-Connectors.html#Illuminate-Redis-Connectors-PhpRedisConnector "Illuminate\Redis\Connectors\PhpRedisConnector") | ​<span class="summary"></span>
​[PredisConnector](Illuminate-Redis-Connectors.html#Illuminate-Redis-Connectors-PredisConnector "Illuminate\Redis\Connectors\PredisConnector") | ​<span class="summary"></span>







## <a id='Illuminate-Redis-Events' class='anchor'></a>[N] Illuminate\\Redis\\Events\\ <small><span class="summary"></span></small>






:classes
name | summary
--------------------------------- | -------------------------------------------------------------------------
​[CommandExecuted](Illuminate-Redis-Events.html#Illuminate-Redis-Events-CommandExecuted "Illuminate\Redis\Events\CommandExecuted") | ​<span class="summary"></span>







## <a id='Illuminate-Redis-Limiters' class='anchor'></a>[N] Illuminate\\Redis\\Limiters\\ <small><span class="summary"></span></small>






:classes
name | summary
--------------------------------- | -------------------------------------------------------------------------
​[ConcurrencyLimiter](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-ConcurrencyLimiter "Illuminate\Redis\Limiters\ConcurrencyLimiter") | ​<span class="summary"></span>
​[ConcurrencyLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-ConcurrencyLimiterBuilder "Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder") | ​<span class="summary"></span>
​[DurationLimiter](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-DurationLimiter "Illuminate\Redis\Limiters\DurationLimiter") | ​<span class="summary"></span>
​[DurationLimiterBuilder](Illuminate-Redis-Limiters.html#Illuminate-Redis-Limiters-DurationLimiterBuilder "Illuminate\Redis\Limiters\DurationLimiterBuilder") | ​<span class="summary"></span>







