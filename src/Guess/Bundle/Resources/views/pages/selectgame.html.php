<?php $view->extend('::base.html.php') ?>
<?php $view['slots'] -> set('title', 'Enter your name')?>
<?php 
$view['slots']->start('menu');
echo $view->render('::header.html.php', array('page' => $page));
$view['slots']->stop();
?>
<div id="loginInfo">
<form action="<?php echo $view['router']->generate('_play') ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
	<?php if(!$view['session']->get('user')):?>
	<p>Enter your name in textbox, and choose turns you want to guess</p>
	<div>
    <?php echo $view['form']->label($form['username']) ?> &nbsp;
    <?php echo $view['form']->widget($form['username']) ?>
    </div>
    <?php endif;?>
    <?php if($view['session']->get('user')):?>
    <p>Choose game you want to play</p>
    <?php endif;?>
    <div>
    <?php echo $view['form']->label($form['gamelevel']) ?> &nbsp;
    <?php echo $view['form']->widget($form['gamelevel']) ?>
    </div>
    <div>
    <?php echo $view['form']->label($form['turns']) ?> &nbsp;
    <?php echo $view['form']->widget($form['turns']) ?>
    &nbsp;  <input id="btnsubmit" type="submit" value="Play now!" />
    </div>
</form>
<br>
</div>