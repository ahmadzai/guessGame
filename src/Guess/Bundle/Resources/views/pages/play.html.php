<?php $view->extend('::base.html.php') ?>
<?php $view['slots'] -> set('title', 'Guess game')?>
<?php 
$view['slots']->start('menu');
echo $view->render('::header.html.php', array('page' => $page));
$view['slots']->stop();
?>
<h2>playing the game</h2>
<?php echo "game:".$g." and level: ".$l; ?>
<form action="<?php echo $view['router']->generate('_play') ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
   <div>
   <?php echo $view['form']->label($form['guess']); ?>
   </div>
   <div>
   <?php echo $view['form']->widget($form['guess']); ?>
   &nbsp;  <input type="submit" value="Guess it!" />
   </div>
   <div>
   <?php 
   	echo $data."<br>";
   	echo $app -> getSession() -> get('name');
   ?>
   </div>
</form>