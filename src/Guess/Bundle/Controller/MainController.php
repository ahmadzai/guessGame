<?php 
namespace Guess\Bundle\Controller;

use Guess\Bundle\Entity\Top10score;

use Guess\Bundle\Entity\Player;

use Symfony\Component\HttpFoundation\Session;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller {
	private $session;
	public function indexAction() {
		
		$ses = $this->getRequest()->getSession();
		$ses->set('turn', 0); // when user come to the home page empty turn
		return $this->render('GuessBundle:templates:layout.html.php', array('page' => 'homepage'));
	
	}
	
	public function playAction($game, $level) {
		
		//$session->set('user', 'foawziah');
		$this->session = $this->get('session');
		$this->session->start();
		//$this->session->remove('user');
		if(!$this->session -> get('user') && $game != 0) {
		
			$form = $this -> createUserForm();
			$request = $this->getRequest();
			if($request->getMethod() == 'POST') {
				$form->bindRequest($request);
				$data = $form -> getData();
				$this->session->set('user', true);
				$this->session->set('userid', $this->saveGetUser($data['username']));
				$this->session->set('name', $data['username']);
				$this->session->set('turn', $data['turns']);
				$this->session->set('points', 100);
				$this->session->set('level', $level);
				return  $this->playAction($game, $level);
			}
			return $this->render('GuessBundle:pages:select_turn.html.php', array('page' => 'play', 'g' => $game, 'l' => $level,
					'form'=>$form->createView()));
		
		}
		if($this->session->get('user') && $game != 0) {
			// select turn for your game
			$this->session->set('level', $level);
			if($this->session->get('turn')==0) {
				$form = $this -> createUserForm();
				$request = $this->getRequest();
				if($request->getMethod() == 'POST') {
					$form->bindRequest($request);
					$data = $form -> getData();
					$this->session->set('turn', $data['turns']);
					$this->session->set('points', 100);
					return  $this->playAction($game, $level);
				}
				return $this->render('GuessBundle:pages:select_turn.html.php', array('page' => 'play', 'g' => $game, 'l' => $level,
						'form'=>$form->createView()));
			}
			$this->session->set('random', $this->generateRandom($game, $level));
			if($game == 1) { // redirect to play1d route
				$this->session->set('guesses', $this->storeGuess(1));
				return $this->redirect($this->generateUrl("_play1d"));
			}
			else if($game == 2) { // redirect to play2d route
				$this->session->set('guesses', $this->storeGuess(2));
				return $this->redirect($this->generateUrl("_play2d"));	
			}
			else if($game == 3) { // redirect to play3d route
				$this->session->set('guesses', $this->storeGuess(3));
				return $this->redirect($this->generateUrl("_play3d"));
			}
		}
		if($game == 0) { // if some one don't select a game from the homepage and direct click play button from the menue
			
			$form = $this -> selectGame(); // create a form to give user name and select game type
			$request = $this->getRequest();
			if($request->getMethod() == 'POST') {
				$form->bindRequest($request);
				$data = $form -> getData();
				// if user session wasn't set
				if(!$this->session->get('user')) {
					$this->session->set('userid', $this->saveGetUser($data['username']));
					$this->session->set('user', true);
					$this->session->set('name', $data['username']);
				}
				$this->session->set('turn', $data['turns']);
				$this->session->set('points', 100);
				$this->session->set('guesses', array());
				$gametype = $data['gamelevel'];
				switch ($gametype) {
					case "d12": // game 1 D, level = 2 (intermediate level)
						$this->session->set('guesses', $this->storeGuess(1));
						$this->session->set('level', 2);
						$this->session->set('random', $this->generateRandom(1, 2)); // generate random value for each level and game
						return $this->redirect($this->generateUrl("_play1d"));      // and redirect to the game page
						break;
					case "d13": // game 1 D, level = 3 (advance level)
						$this->session->set('random', $this->generateRandom(1, 3));
						$this->session->set('level', 3);
						$this->session->set('guesses', $this->storeGuess(1));
						return $this->redirect($this->generateUrl("_play1d"));
						break;
					case "d21":
						$this->session->set('level', 1);
						$this->session->set('random', $this->generateRandom(2, 1));
						$this->session->set('guesses', $this->storeGuess(2));
						return $this->redirect($this->generateUrl("_play2d"));
					case "d22":
						$this->session->set('level', 2);
						$this->session->set('random', $this->generateRandom(2, 2));
						$this->session->set('guesses', $this->storeGuess(2));
						return $this->redirect($this->generateUrl("_play2d"));
					case "d23":
						$this->session->set('level', 3);
						$this->session->set('random', $this->generateRandom(2, 3));
						$this->session->set('guesses', $this->storeGuess(2));
						return $this->redirect($this->generateUrl("_play2d"));
						break;
					case "d31":
						$this->session->set('level', 1);
						$this->session->set('random', $this->generateRandom(3, 1));
						$this->session->set('guesses', $this->storeGuess(3));
						return $this->redirect($this->generateUrl("_play3d"));
					case "d32":
						$this->session->set('level', 2);
						$this->session->set('guesses', $this->storeGuess(3));
						$this->session->set('random', $this->generateRandom(3, 2));
						return $this->redirect($this->generateUrl("_play3d"));
					case "d33":
						$this->session->set('level', 3);
						$this->session->set('guesses', $this->storeGuess(3));
						$this->session->set('random', $this->generateRandom(3, 3));
						return $this->redirect($this->generateUrl("_play3d"));
						break;
					default:
						$this->session->set('level', 1);
						$this->session->set('guesses', $this->storeGuess(1));
						$this->session->set('random', $this->generateRandom(1, 1));
						return $this->redirect($this->generateUrl("_play1d"));
						break;
				   
				}
			}
			return $this->render('GuessBundle:pages:selectgame.html.php', array('page' => 'play', 'form' => $form->createView()));
			
		}
		
	}
	
	public function howtoAction() {
		
		return $this->render('GuessBundle:pages:howtoplay.html.php', array('page' => 'howto'));
		
	}
	
	
	
	public function play1dAction() {
		$ses = $this->getRequest()->getSession();
		if(!$ses->get('user'))
			return $this->redirect($this->generateUrl("_play"));
		$form = $this->createGuessForm(1);
		$request = $this->getRequest();
	
		if($request->getMethod() == 'POST') {
			$form->bindRequest($request);
			$data = $form -> getData();
			$guess = $data['guess1'];
			$turn = $ses->get('turn');
			$points = $ses -> get('points');
			$diff = 0;
			if($turn > 0) // if turn become zore it will generate an exception
				$diff = (int) ($points / $turn);
			$points = $points - $diff;
			$ses->set('points', $points);
			$ses->removeFlash('hint');
			if($turn > 0) {
				$guesses = $ses->get('guesses');
				$high = $guesses['high'];
				$low = $guesses['low'];
				if($guess == $ses->get('random')) { 
					
					$ses->set('points', $points + $diff);
					$this->saveScore(1, $ses->get('level'), $ses->get('userid'), $ses->get('points'));
					$ses->setFlash('message', 'wow Congratulation '.$ses->get('name').'! you are the winer, you got '.$ses->get('points').' points');
					
				} else if($turn == 1) {
					$ses->set('points', $points);
					if($guess > $ses->get('random'))
						$high[count($high)+1]= $guess;
					else if($guess < $ses->get('random'))
						$low[count($low)+1]= $guess;
					$ses->setFlash('message', 'Ooooops! your turn has finished, my number was '.$ses->get('random'));
				}
				else if($guess < $ses->get('random')) {
					
					$low[count($low)+1]= $guess;
					$ses->setFlash('hint', 'Your number is too low!');
				} else {
					
					$high[count($high)+1]= $guess;
					$ses->setFlash('hint', 'Your number is too high!');
				}
				$guesses['low'] = $low;
				$guesses['high'] = $high;
				$ses->set('guesses', $guesses);
			}	
			$turn = --$turn;
			$ses->set('turn', $turn);
		}
		
		return $this->render('GuessBundle:pages:play1d.html.php', array('page' => 'play', 'form'=>$form->createView()));
		
	}
	
	public function play2dAction() {
		
		$ses = $this->getRequest()->getSession();
		if(!$ses->get('user'))
			return $this->redirect($this->generateUrl("_play"));
		$form = $this->createGuessForm(2);
		$request = $this->getRequest();
		
		if($request->getMethod() == 'POST') {
			$form->bindRequest($request);
			$data = $form -> getData();
			$xAxis = $data['guess1'];
			$yAxis = $data['guess2'];
			$turn = $ses->get('turn');
			$points = $ses -> get('points');
			$diff = 0;
			if($turn > 0) // if turn become zore it will generate an exception
				$diff = (int) ($points / $turn);
			$points = $points - $diff;
			$ses->set('points', $points);
			$ses->removeFlash('hintx');
			$ses->removeFlash('hinty');
			if($turn > 0) {
				$x = ''; $y = '';
				$xy = $ses -> get('random');
				$guesses = $ses->get('guesses');
				$lowx = $guesses['lowX'];
				$highx = $guesses['highX'];
				$lowy = $guesses['lowY'];
				$highy = $guesses['highY'];
				if($xAxis == $xy['randX'] && $yAxis == $xy['randY']) {
					
					$ses->set('points', $points + $diff);
					$this->saveScore(2, $ses->get('level'), $ses->get('userid'), $ses->get('points'));
					$ses->setFlash('message', 'wow Congratulation '.$ses->get('name').'! you are the winer, you got '.$ses->get('points').' points');
					
				} 
				else if($turn == 1) {
					$ses->set('points', 0);
					if($xAxis > $xy['randX'])
						$highx[count($highx)+1] = $xAxis;
					else if($xAxis < $xy['randX'])
						$lowx[count($lowx)+1] = $xAxis;
					if($yAxis > $xy['randY'])
						$highy[count($highy)+1] = $yAxis;
					else if($yAxis < $xy['randY'])
						$lowy[count($lowy)+1] = $yAxis;
					$ses->setFlash('message', 'Ooooops! your turn has finished, my numbers were x = '.$xy['randX'].', y = '.$xy['randY']);
				} else {
					$msg = 'You found X';
					$x = $xAxis;
					if($xAxis > $xy['randX']) {
						$x = '';
						$msg = 'Your number is too high';
						$highx[count($highx)+1] = $xAxis;
					}
					else if($xAxis < $xy['randX']) {
						$x = '';
						$msg = 'Your number is too low';
						$lowx[count($lowx)+1] = $xAxis;
					}
					$ses->setFlash('hintx', $msg);
					// now checking y
					$msg = 'You found Y';
					$y = $yAxis;
					if($yAxis > $xy['randY']) {
						$y = '';
						$highy[count($highy)+1] = $yAxis;
						$msg = 'Your number is too high';
					}
					else if($yAxis < $xy['randY']) {
						$y = '';
						$lowy[count($lowy)+1] = $yAxis;
						$msg = 'Your number is too low';
					}
					$ses->setFlash('hinty', $msg);
				}
				$form->setData(array('guess1'=>$x, 'guess2'=>$y));
				$guesses['lowX'] = $lowx;
				$guesses['highX'] = $highx;
				$guesses['lowY'] = $lowy;
				$guesses['highY'] = $highy;
				$ses->set('guesses', $guesses);
			}//
			$turn = --$turn;
			$ses->set('turn', $turn);
		}
		return $this->render('GuessBundle:pages:play2d.html.php', array('page' => 'play', 'form'=>$form->createView()));
		
	}
	
	public function play3dAction() {
		
		$ses = $this->getRequest()->getSession();
		if(!$ses->get('user'))
			return $this->redirect($this->generateUrl("_play"));
		$form = $this->createGuessForm(3);
		$request = $this->getRequest();
		
		if($request->getMethod() == 'POST') {
			$form->bindRequest($request);
			$data = $form -> getData();
			$xAxis = $data['guess1'];
			$yAxis = $data['guess2'];
			$zAxis = $data['guess3'];
			$turn = $ses->get('turn');
			$points = $ses -> get('points');
			$diff = 0;
			if($turn > 0) // if turn become zore it will generate an exception
				$diff = (int) ($points / $turn);
			$points = $points - $diff;
			$ses->set('points', $points);
			$ses->removeFlash('hintx');
			$ses->removeFlash('hinty');
			$ses->removeFlash('hintz');
			if($turn > 0) {
				$x = ''; $y = ''; $z = '';
				$guesses = $ses->get('guesses');
				$lowx = $guesses['lowX'];
				$highx = $guesses['highX'];
				$lowy = $guesses['lowY'];
				$highy = $guesses['highY'];
				$lowz = $guesses['lowZ'];
				$highz = $guesses['highZ'];
				$xyz = $ses -> get('random//');
				// if all number was equal to the computer numbers
				if($xAxis == $xyz['randX'] && $yAxis == $xyz['randY'] && $zAxis == $xyz['randZ']) {
					
					$ses->set('points', $points + $diff);
					$this->saveScore(2, $ses->get('level'), $ses->get('userid'), $ses->get('points')); // save player score
					$ses->setFlash('message', 'wow Congratulation '.$ses->get('name').'! you are the winer, you got '.$ses->get('points').' points');
					
				}
				// if this is the last turn
				else if($turn == 1) {
					if($xAxis > $xyz['randX'])
						$highx[count($highx)+1] = $xAxis;
					else if($xAxis < $xyz['randX'])
						$lowx[count($lowx)+1] = $xAxis;
					if($yAxis > $xyz['randY'])
						$highy[count($highy)+1] = $yAxis;
					else if($yAxis < $xyz['randY'])
						$lowy[count($lowy)+1] = $yAxis;
					if($zAxis > $xyz['randZ'])
						$highz[count($highz)+1] = $zAxis;
					else if($zAxis < $xyz['randZ'])
						$lowz[count($lowz)+1] = $zAxis;
					$ses->set('points', 0);
					$ses->setFlash('message', 'Ooooops! your turn has finished, my numbers were x: '.$xyz['randX'].' ,y: '.
							$xyz['randY'].' ,z: '.$xyz['randZ']);
				} else {
					// checking X
					$msg = 'You found X';
					$x = $xAxis;
					if($xAxis > $xyz['randX']) {
						$x = '';
						$highx[count($highx)+1] = $xAxis;
						$msg = 'Your number is too high';
					}
					else if($xAxis < $xyz['randX']) {
						$x = '';
						$lowx[count($lowx)+1] = $xAxis;
						$msg = 'Your number is too low';
					}
					$ses->setFlash('hintx', $msg);
					// now checking y
					$msg = 'You found Y';
					$y = $yAxis;
					if($yAxis > $xyz['randY']) {
						$y = '';
						$highy[count($highy)+1] = $yAxis;
						$msg = 'Your number is too high';
					}
					else if($yAxis < $xyz['randY']) {
						$y = '';
						$lowy[count($lowy)+1] = $yAxis;
						$msg = 'Your number is too low';
					}
					$ses->setFlash('hinty', $msg);
					// now checking for Z
					$msg = 'You found Z';
					$z = $zAxis;
					if($zAxis > $xyz['randZ']) {
						$z = '';
						$highz[count($highz)+1] = $zAxis;
						$msg = 'Your number is too high';
					}
					else if($zAxis < $xyz['randZ']) {
						$z = '';
						$lowz[count($lowz)+1] = $zAxis;
						$msg = 'Your number is too low';
					}
					$ses->setFlash('hintz', $msg);
				}
				$form->setData(array('guess1' => $x, 'guess2'=>$y, 'guess3'=>$z));
				// here again set the array to the orignal 
				$guesses['lowX'] = $lowx;
				$guesses['highX'] = $highx;
				$guesses['lowY'] = $lowy;
				$guesses['highY'] = $highy;
				$guesses['lowZ'] = $lowz;
				$guesses['highZ'] = $highz;
				$ses->set('guesses', $guesses);
			}
			$turn = --$turn;
			$ses->set('turn', $turn);
		}
		return $this->render('GuessBundle:pages:play3d.html.php', array('page' => 'play', 'form'=>$form->createView()));
		
	}
	
	public function aboutAction() {
		
		return $this->render('GuessBundle:pages:about.html.php', array('page' => 'about'));
		
	}
	/**
	 * Create form for guessing
	 * @param int $game
	 * @return Form accordding to the game type
	 */
	public function createGuessForm($game) {
		if($game == 1) {
			$form = $this -> createFormBuilder()
			-> add('guess1', 'text', array('label' => 'Your number:'))
			->getForm();
			return $form;
		} else if($game == 2) {//
			$form = $this -> createFormBuilder()
			-> add('guess1', 'text', array('label' => 'Number on X axis:'))
			-> add('guess2', 'text', array('label' => 'Number on Y axis:'))
			->getForm();
			return $form;
		} else {
			$form = $this -> createFormBuilder()
			-> add('guess1', 'text', array('label' => 'Number on X axis:'))
			-> add('guess2', 'text', array('label' => 'Number on Y axis:'))
			-> add('guess3', 'text', array('label' => 'Number on Z axis:'))
			->getForm();
			return $form;
		}
	}
	
	/**
	 * Create a form
	 * 
	 * create a form to enter user his name and select turns 
	 * 
	 * @return \Symfony\Component\Form\Form
	 */
	private function createUserForm() {
		$form = $this -> createFormBuilder()
		-> add('username', 'text', array('label' => 'User name:'))
		-> add('turns', 'choice', array('choices' => array('1'=>1,
				'2'=>2,
				'3'=>3,
				'4'=>4,
				'5'=>5, '6'=>6, '7'=>7, '8'=>8, '9'=>9, '10'=>10),
				'required'  => FALSE, 'label' => 'Choose turns:',
				'empty_value' => 5, 'empty_data' => 5
		))
		-> getForm();
		return $form;
	}
	
	/**
	 * Creating form for first time
	 *
	 * This function is creating form when user click
	 * play button without selecting game in the homepage
	 * here the user can select game type and can enter his name
	 *
	 */
	private function selectGame() {
	
		$form = $this -> createFormBuilder()
		-> add('username', 'text', array('label' => 'User name:'))
		-> add('gamelevel', 'choice', array('choices' => array('d11' => 'First Level 1D (1 - 20)',
				'd12' => 'Intermediate Level 1D (1 - 100)',
				'd13' => 'Advance Level 1D (1 - 500)',
				'd21' => 'First Level 2D (1 - 20)',
				'd22' => 'Intermediate Level 2D (1 - 100)',
				'd23' => 'Advance Level 2D (1 - 20)',
				'd31' => 'First Level 3D (1 - 20)',
				'd32' => 'Intermediate Level 3D (1 - 100)',
				'd33' => 'Advance Level 3D (1 - 500)',),
				'required'=>true, 'label'=>'Choose Game:',
				'empty_value' => 'please select a game', 'empty_data'=> null))
				-> add('turns', 'choice', array('choices' => array('1'=>1,
						'2'=>2,
						'3'=>3,
						'4'=>4,
						'5'=>5, '6'=>6, '7'=>7, '8'=>8, '9'=>9, '10'=>10),
						'required'  => FALSE, 'label' => 'Choose turns:',
						'empty_value' => 5, 'empty_data' => 5
				))
				-> getForm();
		return $form;
	
	}
	
	/**
	 * This function generate random
	 * 
	 * it generate random according to game level and game type
	 * 
	 * @param int $game
	 * @param int $level
	 * 
	 * @return int|array
	 * 
	 */
	private function generateRandom($game, $level) {
		
		if($game == 1) {
			$rand = 0;
			switch ($level) {
				case 2:
					$rand = rand(1, 100);
					break;
				case 3:
					$rand = rand(1, 500);
					break;
				default:
					$rand = rand(1, 20);
					break;
			}
			return $rand;
		} else if($game == 2) {
			$rand = array();
			switch ($level) {
				case 2:
					$rand['randX'] = rand(1, 100);
					$rand['randY'] = rand(1, 100);
					break;
				case 3:
					$rand['randX'] = rand(1, 500);
					$rand['randY'] = rand(1, 500);
					break;
				default:
					$rand['randX'] = rand(1, 20);
					$rand['randY'] = rand(1, 20);
					break;
			}
			return $rand;	
		} else if($game == 3) {
			$rand = array();
			switch ($level) {
				case 2:
					$rand['randX'] = rand(1, 100);
					$rand['randY'] = rand(1, 100);
					$rand['randZ'] = rand(1, 100);
					break;
				case 3:
					$rand['randX'] = rand(1, 500);
					$rand['randY'] = rand(1, 500);
					$rand['randZ'] = rand(1, 500);
					break;
				default:
					$rand['randX'] = rand(1, 20);
					$rand['randY'] = rand(1, 20);
					$rand['randZ'] = rand(1, 20);
					break;
			}
			return $rand;
		}
	}
	
	/**
	 * Helper function to create array for storing guesses
	 * @param int $game
	 * @return multitype:multitype:
	 */
	private function storeGuess($game) {
		if($game == 1) {
			return  array('low'=>array(), 'high'=>array());
		} else if($game == 2) {
			return  array('lowX'=>array(), 'highX'=>array(), 'lowY'=>array(), 'highY'=>array());
		} else {
			return array('lowX'=>array(),
					'highX'=>array(),
					'lowY'=>array(),
					'highY'=>array(),
					'lowZ'=>array(),
					'highZ'=>array());
		}
	}
	
	private function saveGetUser($name) {
		
		$em = $this->get('doctrine')->getEntityManager();
        $query = $em->createQuery('SELECT p FROM GuessBundle:Player p WHERE p.name = :pname');
        $query->setParameter('pname', $name);
        $users = $query->getResult();
        if(count($users) > 0)
			return $users[0]->getId();
		else { 
			$p = new Player();
			$p->setName($name);
			$p->setDate(date('Y-m-d h:i:s'));
			$em->persist($p);
			$em->flush();
			return $p->getId();
		}
	}
	
	private function saveScore($game, $level, $playerid, $score) {
		// we are storing only top10 score of each level
		// so we checking before insertion for 10 records, if it was 10 then we removing one, that is smaller then new one
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery('SELECT s FROM GuessBundle:Top10score s WHERE s.gametype = :g AND s.gamelevel = :l ORDER BY s.score ASC');
		$query->setParameter('g', $game);
		$query->setParameter('l', $level);
		$result = $query->getResult();
		
		$player = $this->get('doctrine')
		->getEntityManager()
		->getRepository('GuessBundle:Player')
		->find($playerid);
		
		if(count($result) < 10) {
			
			$top = new Top10score();
			$top->setPlayer($player);
			$top->setGamelevel($level);
			$top->setGametype($game);
			$top->setDate(date('Y-m-d h:i:s'));
			$top->setScore($score);
			$em->persist($top);
			$em->flush();
			
		} else {
			$bigger = false;
			for($i = 0; $i < count($result); $i++) {
				if($result[$i]->getScore() <= $score) {
					$bigger = true;
					break;
				}
			}
			if($bigger) {
				// to delete a record
				$delscore = $result[count($result)-1];
				$em->remove($delscore);
				// inserting new
				$top = new Top10score();
				$top->setPlayer($player);
				$top->setGamelevel($level);
				$top->setGametype($game);
				$top->setDate(date('Y-m-d h:i:s'));
				$top->setScore($score);
				$em->persist($top);
				$em->flush();
			}
		}
		
		
	}
	
	public function logoutAction() {
		$ses = $this->getRequest()->getSession();
		$ses->clear();
		return $this->redirect($this->generateUrl('_homepage'));
	}
}


?>