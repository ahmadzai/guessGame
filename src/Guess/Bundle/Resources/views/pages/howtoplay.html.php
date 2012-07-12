<?php $view->extend('::base.html.php') ?>
<?php $view['slots'] -> set('title', 'Guess game')?>
<?php 
$view['slots']->start('menu');
echo $view->render('::header.html.php', array('page' => $page));
$view['slots']->stop();
?>
<div id="content-home">
<h2>Instruction for playing this game</h2>
<p>Number guess game, have three levels, easy level, intermediate level and advance 
level this game provides a function that you will be able to think of a number from 
all the level that you tend to play.the number guess game will test your number. 
The game will ask you several time the number if your number was wrong. If you win your top score will store in our database. 
</p>
<p><strong>How to play?</strong></p>
<ul style="margin: 10px; margin-left:20px; padding: 4px; font-size:14px; color:#0B2161">
<li>Select the game (form home page or click play button in menu)</li>
<li>Enter your name, we will check your name if you were already registered with us</li>
<li>Select the turn (how many turn you like to play)</li>
<li>Guess your numbers, you will also see some hints while playing</li>

</ul>
</div>