<?php $view->extend('::base.html.php') ?>
<?php $view['slots'] -> set('title', 'Guess game')?>
<?php 
$view['slots']->start('menu');
echo $view->render('::header.html.php', array('page' => $page));
$view['slots']->stop();
$view['slots'] -> start('sidebar');
echo $view->render('GuessBundle:templates:sidebar.html.php');
$view['slots']->stop();
?>
<div id="content-home">
<h2>Guess The Number</h2>
<p>Play the game right now, select a game type you want, Sample one, 2D and 3D.
You can select different level in each type. choose the number of turns you think you will
find the number, and test your guessing</p>
</div>
<div id="play-1d">
<h2>Guess in 1 Dimention</h2>
<p> <strong>Pick a level to play</strong> </p>
<a href="">Easy level: 1 - 20 </a>
<a href="">Medium level: 1 - 100 </a>
<a href="">Hard level: 1 - 500 </a>
</div>
<div id="play-2d">
<h2>Guess in 2 Dimention</h2>
<p> <strong>Pick a level to play</strong> </p>
<a href="">Easy level: 1 - 20 </a>
<a href="">Medium level: 1 - 100 </a>
<a href="">Hard level: 1 - 500 </a>
</div>
<div id="play-3d">
<h2>Guess in 3 Dimention</h2>
<p> <strong>Pick a level to play</strong> </p>
<a href="">Easy level: 1 - 20 </a>
<a href="">Medium level: 1 - 100 </a>
<a href="">Hard level: 1 - 500 </a>
</div>
<div id="content-pic"></div>
