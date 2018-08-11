<head>
  <title>システムエラー</title>
</head>
<h1><?php echo $this->translate('エラーが発生しました') ?></h1>
<h2><?php echo $this->translate('お手数をおかけいたしますが、こちらの詳細をWeb管理者にお伝え下さい。'); ?></h2>
<?php if (isset($this->display_exceptions) && $this->display_exceptions): ?>

<?php if(isset($this->exception) && $this->exception instanceof Exception): ?>
<hr/>
<h2><?php echo $this->translate('Additional information') ?>:</h2>
<h3><?php echo get_class($this->exception); ?></h3>
<dl>
    <dt><?php echo $this->translate('File') ?>:</dt>
    <dd>
        <pre class="prettyprint linenums"><?php echo $this->exception->getFile() ?>:<?php echo $this->exception->getLine() ?></pre>
    </dd>
    <dt><?php echo $this->translate('Message') ?>:</dt>
    <dd>
        <pre class="prettyprint linenums"><?php echo $this->escapeHtml($this->exception->getMessage()) ?></pre>
    </dd>
    <dt><?php echo $this->translate('Stack trace') ?>:</dt>
    <dd>
        <pre class="prettyprint linenums"><?php echo $this->escapeHtml($this->exception->getTraceAsString()) ?></pre>
    </dd>
</dl>
<?php
    $e = $this->exception->getPrevious();
    $icount = 0;
    if ($e) :
?>
<hr/>
<h2><?php echo $this->translate('Previous exceptions') ?>:</h2>
<ul class="unstyled">
    <?php while($e) : ?>
    <li>
        <h3><?php echo get_class($e); ?></h3>
        <dl>
            <dt><?php echo $this->translate('File') ?>:</dt>
            <dd>
                <pre class="prettyprint linenums"><?php echo $e->getFile() ?>:<?php echo $e->getLine() ?></pre>
            </dd>
            <dt><?php echo $this->translate('Message') ?>:</dt>
            <dd>
                <pre class="prettyprint linenums"><?php echo $this->escapeHtml($e->getMessage()) ?></pre>
            </dd>
            <dt><?php echo $this->translate('Stack trace') ?>:</dt>
            <dd>
                <pre class="prettyprint linenums"><?php echo $this->escapeHtml($e->getTraceAsString()) ?></pre>
            </dd>
        </dl>
    </li>
    <?php
        $e = $e->getPrevious();
        $icount += 1;
        if ($icount >= 50) {
            echo "<li>There may be more exceptions, but we have no enough memory to proccess it.</li>";
            break;
        }
        endwhile;
    ?>
</ul>
<?php endif; ?>

<?php else: ?>

<h3><?php echo $this->translate('No Exception available') ?></h3>

<?php endif ?>

<?php endif ?>
