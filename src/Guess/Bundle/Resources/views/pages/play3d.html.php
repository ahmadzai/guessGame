<?php $view->extend('::base.html.php') ?>
<?php $view['slots'] -> set('title', 'Guess game')?>
<?php 
$view['slots']->start('menu');
echo $view->render('::header.html.php', array('page' => $page));
$view['slots']->stop();
?>
<div id="play">
<form action="<?php echo $view['router']->generate('_play3d') ?>" method="post" <?php echo $view['form']->enctype($form) ?> >
	<p><strong>Hi <font color='red'><?php echo $view['session']->get('name')?></font>! you are guessing in 3 dimension</strong><br>
	Enter your numbers in specified textboxes for each dimension, and press Guess now button, and you can see
	your entered number in right side table</p>
	<div id='message'>
	<?php if($view['session']->get('points') == 0):?>
	<font color="red">
	<?php echo $view['session']->getFlash('message');?>
	</font>
	<?php endif; if($view['session']->get('points') > 0):?>
	<font color="green">
	<?php echo $view['session']->getFlash('message');?>
	</font>
	<?php endif;?>
	</div>
	<div id="divgame">
	<table id="tblgame">
		<tr>
			<td><?php echo $view['form']->label($form['guess1']) ?></td>
			<td><?php echo $view['form']->widget($form['guess1']) ?></td>
			<td style="color: red"><?php echo $view['session']->getFlash('hintx')?></td>
		</tr>
		<tr>
			<td><?php echo $view['form']->label($form['guess2']) ?></td>
			<td><?php echo $view['form']->widget($form['guess2']) ?></td>
			<td style="color: red"><?php echo $view['session']->getFlash('hinty')?></td>
		</tr>
		<tr>
			<td><?php echo $view['form']->label($form['guess3']) ?></td>
			<td><?php echo $view['form']->widget($form['guess3']) ?></td>
			<td style="color: red"><?php echo $view['session']->getFlash('hintz')?></td>
		</tr>
		<tr>
			<td></td>
			<td> <input id=btnguess type="submit" value="Guess now!" /> </td>
			<td></td>
		</tr>
	</table>
    </div>
    <div id="divguess">
    <table class="tblguess" cellspacing="0">
    <tr><td colspan='6' style="color: green;">
    Points: <?php echo " ".$view['session']->get('points');?>
	</td>
	</tr>
    <tr><td><strong>Low X</strong></td><td><strong>High X</strong></td>
    <td><strong>Low Y</strong></td><td><strong>High Y</strong></td><td><strong>Low Z</strong></td>
    <td><strong>High Z</strong></td></tr>
     <tr><td valign="top" id="left">
	    <?php $guess = $view['session']->get('guesses');
	    	$lowx = $guess['lowX'];
	    	foreach ($lowx as $lx):
	    ?>
	    <span style="display: block;"><?php echo $lx; ?></span>
	    <?php endforeach;?>
   		</td>
     	<td valign="top" id="center">
	    <?php $highx = $guess['highX'];
	    	foreach ($highx as $hx):
	    ?>
	    <span style="display: block;"><?php echo $hx; ?></span>
	    <?php endforeach;?>
   		</td>
   		<td valign="top" id="center">
	    <?php $lowy = $guess['lowY'];
	    	foreach ($lowy as $ly):
	    ?>
	    <span style="display: block;"><?php echo $ly; ?></span>
	    <?php endforeach;?>
   		</td>
   		<td valign="top" id="center">
	    <?php $highy = $guess['highY'];
	    	foreach ($highy as $hy):
	    ?>
	    <span style="display: block;"><?php echo $hy; ?></span>
	    <?php endforeach;?>
   		</td>
   		<td valign="top" id="center">
	    <?php $lowz = $guess['lowZ'];
	    	foreach ($lowz as $lz):
	    ?>
	    <span style="display: block;"><?php echo $lz; ?></span>
	    <?php endforeach;?>
   		</td>
   		<td valign="top" id="center">
	    <?php $highz = $guess['highZ'];
	    	foreach ($highz as $hz):
	    ?>
	    <span style="display: block;"><?php echo $hz; ?></span>
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