<?php $view->extend('::base.html.php') ?>
<?php $view['slots'] -> set('title', 'Guess game')?>
<?php 
$view['slots']->start('menu');
echo $view->render('::header.html.php', array('page' => $page));
$view['slots']->stop();
?>
<div id="play">
<form action="<?php echo $view['router']->generate('_play1d') ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
	<p><strong>Hi <font color='red'><?php echo $view['session']->get('name')?></font>! you are guessing in 1 dimension</strong><br>
	Enter your numbers in specified textboxes for each dimension, and press Guess now button, and you can see
	your entered number in right side table</p>
	<div id='message'>
	<?php if($view['session']->get('points') == 0):?>
	<font color="red">
	<?php echo $view['session']->getFlash('message');?>
	</font> <br>
	<?php endif; if($view['session']->get('points') > 0):?>
	<font color="green">
	<?php echo $view['session']->getFlash('message');?>
	</font> <br>
	<?php endif;?>
	</div>
	<div id="divgame">
    <table id="tblgame">
		<tr>
			<td><?php echo $view['form']->label($form['guess1']) ?></td>
			<td><?php echo $view['form']->widget($form['guess1']) ?></td>
			<td style="color: red"><?php echo $view['session']->getFlash('hint');?></td>
		</tr>
		<tr>
			<td></td>
			<td> <input id="btnguess" type="submit" value="Guess now!" /> </td>
			<td></td>
		</tr>
	</table>	 
    </div>
    <div id="divguess">
    <table class="tblguess" cellspacing="0">
    <tr><td colspan='2' style="color: green;">
    Points: <?php echo " ".$view['session']->get('points');?>
	</td>
	</tr>
    <tr><td><strong>Low guesses</strong></td><td><strong>High guesses</strong></td></tr>
     <tr><td valign="top">
	    <?php $guess = $view['session']->get('guesses');
	    	$low = $guess['low'];
	    	foreach ($low as $l):
	    ?>
	    <span style="display: block;"><?php echo $l; ?></span>
	    <?php endforeach;?>
   		</td>
     	<td valign="top">
	    <?php $guess = $view['session']->get('guesses');
	    	$high = $guess['high'];
	    	foreach ($high as $h):
	    ?>
	    <span style="display: block;"><?php echo $h; ?></span>
	    <?php endforeach;?>
   		</td>
     </tr>
    </table>
    </div>
    <?php if($view['session']->get('points') == 0 || $view['session']->get('turn') < 1) :?>
    <div id="playagain">
    <p align="center"><a href="<?php echo $view['router']->generate('_play') ?>">Click Here to play again</a></p>
    </div>
    <?php endif;?>
    <?php if($view['session']->get('points') > 0 || $view['session']->get('turn') > 0) :?>
    <div id="playagain">
    <p align="center"><?php echo $view['session']->get('turn')?> turn left</p>
    </div>
    <?php endif;?>
</form>
<br>
</div>