<?php
function h($value)
{
    return htmlspecialchars($value, ENT_QUOTES);
}

function md($text)
{
    static $parser = null;
    if ($parser === null) {
        $parser = new \Parsedown();
        $parser->setBreaksEnabled(true);
        $parser->setMarkupEscaped(false);
        $parser->setUrlsLinked(false);
    }
    return $parser->parse($text);
}

function source($location)
{
    foreach ($GLOBALS['config']['source-map'] as $regex => $url) {
        if ($url instanceof \Closure) {
            $path = $url($location);
            $replaced = !!$path;
        }
        else {
            $path = preg_replace("#$regex#", $url, str_replace('\\', '/', $location['path']), 1, $replaced);
        }
        if ($replaced) {
            ?>
			<a href="<?= h("{$path}#L{$location['start']}-L{$location['end']}") ?>" class="source-link glyphicon glyphicon-new-window" target="_blank"></a>
            <?php
            return;
        }
    }
}

function ref($value, $suffix)
{
    list($file) = explode('::', $value, 2);
    if ($suffix === 'constfunc') {
        $suffix = 'namespace';
        $parts = explode('\\', $value);
        array_pop($parts);
        $file = implode('\\', $parts) . '\\';
    }
    return h(str_replace('\\', '-', $file) . "\$$suffix.html" . ($value ? "#$value" : ""));
}

function summary($description)
{
    return strip_tags(preg_split('#\\R#u', $description, 2)[0]);
}

function render_head()
{
    ?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/styles/zenburn.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.min.css">
	<link rel="stylesheet" type="text/css" href="common.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/3.1.1/bootstrap3-typeahead.min.js"></script>
	<script src="common.js"></script>
    <?php
}

function render_hierarchy($hierarchys, $self, $nest = 0)
{
    if (empty($hierarchys)) {
        return;
    }
    ?>

	<ul class="<?= $nest ? 'has-indent' : '' ?>">
        <?php foreach ($hierarchys as $name => $hi): ?>
			<li class="<?= $nest ? 'indent' : '' ?>">
                <?= render_link($name, $self) ?>
                <?= render_hierarchy($hi, $self, $nest + 1) ?>
			</li>
        <?php endforeach ?>
	</ul>
    <?php
}

function render_using($usings, $category)
{
    if (empty($usings)) {
        return;
    }
    ?>
	<table class="table">
		<caption><?= h($category) ?></caption>
		<tbody>
        <?php foreach ($usings as $using): ?>
			<tr>
				<td class="type"><?= render_link($using['fqsen']) ?></td>
				<td class="desc"><?= h(summary($using['description'])) ?></td>
			</tr>
        <?php endforeach ?>
		</tbody>
	</table>
    <?php
}

function render_parameter($params)
{
    ?>
	<table class="table">
		<caption>Parameters</caption>
		<tbody>
        <?php foreach ($params as $param): ?>
			<tr>
				<td class="type"><?= render_type($param['types']) ?></td>
				<td class="rest"><?= h($param['declaration']) ?></td>
				<td class="desc"><?= md($param['description']) ?></td>
			</tr>
        <?php endforeach ?>
		</tbody>
	</table>
    <?php
}

function render_return($return)
{
    ?>
	<table class="table">
		<caption>Return</caption>
		<tbody>
		<tr>
			<td class="type"><?= $return['types'] ? render_type($return['types']) : 'void' ?></td>
			<td class="desc"><?= md($return['description']) ?></td>
			<td class="rest"></td>
		</tr>
		</tbody>
	</table>
    <?php
}

function render_prototype($prototypes)
{
    if (empty($prototypes)) {
        return;
    }
    ?>
	<table class="table">
		<caption>Prototype</caption>
		<tbody>
        <?php foreach ($prototypes as $prototype): ?>
			<tr>
				<td class="type"><?= render_link($prototype['fqsen']) ?></td>
				<td class="desc"><?= h(summary($prototype['description'])) ?></td>
				<td class="rest"><?= $prototype['kind'] ?></td>
			</tr>
        <?php endforeach ?>
		</tbody>
	</table>
    <?php
}

function render_throwsTag($throws)
{
    if (empty($throws)) {
        return;
    }
    ?>
	<table class="table">
		<caption>Throws</caption>
		<tbody>
        <?php foreach ($throws as $throw): ?>
			<tr>
				<td class="type"><?= render_type([$throw['type']]) ?></td>
				<td class="desc"><?= h(summary($throw['description'])) ?></td>
			</tr>
        <?php endforeach ?>
		</tbody>
	</table>
    <?php
}

function render_seeTag($sees)
{
    if (empty($sees)) {
        return;
    }
    ?>
	<table class="table">
		<caption>See</caption>
		<tbody>
        <?php foreach ($sees as $see): ?>
			<tr>
				<td class="type">
                    <?php if ($see['kind'] === 'uri'): ?>
						<a href="<?= h($see['type']) ?>" target="_blank"><?= h($see['type']) ?></a>
                    <?php else: ?>
                        <?= render_link($see['type']['fqsen']) ?>
                    <?php endif ?>
				</td>
				<td class="desc"><?= h(summary($see['description'])) ?></td>
			</tr>
        <?php endforeach ?>
		</tbody>
	</table>
    <?php
}

function render_type($types)
{
    $last = count($types) - 1;
    foreach ($types as $n => $type) {
        if ($type['category'] === 'pseudo') {
            echo h($type['fqsen']);
        }
        else {
            render_link($type['fqsen']);
        }
        echo h(str_repeat('[]', $type['array']));
        echo $n === $last ? '' : '<span class="type-separator"></span><wbr>';
    }
}

function render_link($fqsen, $self = null)
{
    static $lang;
    if ($lang === null) {
        $lang = explode('_', explode('.', getenv('LANG') ?: 'ja_JP.UTF-8')[0])[0];
    }

    if ($fqsen === false) {
        ?><a href="" class="fqsen"><?= h($fqsen) ?></a><?php
        return;
    }

    if ($fqsen[0] === '\\') {
        list($type, $member) = explode('::', ltrim(strtolower($fqsen), '\\'), 2) + [1 => ''];
        if ($member) {
            preg_match('#(\\$)?([0-9_a-z]+)(\\(\\))?#i', $member, $match);
            if (isset($match[3])) {
                ?><a href="http://php.net/manual/<?= $lang ?>/<?= h($type) ?>.<?= h(ltrim($match[2], '_')) ?>.php" class="fqsen" target="_blank"><?= h($fqsen) ?></a><?php
            }
			elseif (isset($match[1][0])) {
                ?><a href="http://php.net/manual/<?= $lang ?>/class.<?= h($type) ?>.php#<?= h($type) ?>.props.<?= h($match[2]) ?>" class="fqsen" target="_blank"><?= h($fqsen) ?></a><?php
            }
            else {
                ?><a href="http://php.net/manual/<?= $lang ?>/class.<?= h($type) ?>.php#<?= h($type) ?>.constants.<?= h($match[2]) ?>" class="fqsen" target="_blank"><?= h($fqsen) ?></a><?php
            }
        }
        else {
            ?><a href="http://php.net/manual/<?= $lang ?>/class.<?= h($type) ?>.php" class="fqsen" target="_blank"><?= h($fqsen) ?></a><?php
        }
    }
    else {
        $parts = explode('\\', $fqsen);
        $qsen = array_pop($parts);
        $nspace = implode('\\', $parts);
        if ($nspace) {
            $inline = "<small>" . h($nspace) . "\</small><wbr>" . h($qsen);
        }
        else {
            $inline = h($fqsen);
        }
        ?><a href="<?= ref($fqsen, 'typespace') ?>" class="fqsen <?= $fqsen === $self ? 'bold' : '' ?>"><?= $inline ?></a><?php
    }
}
