<?php 
namespace Guess\Bundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DBController extends Controller {
	
	/**
	 * get top 10 player and their score
	 */
	public function top10Action() {
		$top10['d_1'] = $this->getTop10score(1);
		$top10['d_2'] = $this->getTop10score(2);
		$top10['d_3'] = $this->getTop10score(3);
		return $this->render('GuessBundle:pages:top10.html.php', array('page' => 'top10', 'top10'=>$top10));
	
	}
	public function getTop10Action() {
		
		$top10['d_1'] = $this->getTop10score(1);
		$top10['d_2'] = $this->getTop10score(2);
		$top10['d_3'] = $this->getTop10score(3);
		return $this->render('GuessBundle:templates:sidebar.html.php', array('top10' => $top10));
		
	}
	
	public function myScoreAction() {
		
		$ses = $this->getRequest()->getSession();
		if(!$ses->get('user')) {
			return $this->render('GuessBundle:pages:myscore.html.php', array('page' => 'score', 'top10' => '-1'));
		}
		else {
			$playerid = $ses->get('userid');
			$player = $this->get('doctrine')
			->getEntityManager()
			->getRepository('GuessBundle:Player')
			->find($playerid);
			$top10['d_1'] = $this->getMyTop10score(1, $player);
			$top10['d_2'] = $this->getMyTop10score(2, $player);
			$top10['d_3'] = $this->getMyTop10score(3, $player);
			return $this->render('GuessBundle:pages:myscore.html.php', array('page' => 'score', 'top10'=>$top10));
		}
	
	}
	
	
	/**
	 * helper function to get different game, level top 10
	 * @param int $game
	 * @param int $level
	 */
	public function getTop10score($game) {
		$em = $this->get('doctrine')->getEntityManager();
		$query = $em->createQuery('SELECT s FROM GuessBundle:Top10score s WHERE s.gametype = :g ORDER BY s.score DESC');
		$query->setParameter('g', $game);
		$query->setMaxResults(10);
		return $query->getResult();
	}
	
	public function getMyTop10score($game, $player) {
		$em = $this->get('doctrine')->getEntityManager();
		$query = $em->createQuery('SELECT s FROM GuessBundle:Top10score s WHERE s.gametype = :g AND s.player = :p ORDER BY s.score DESC');
		$query->setParameter('g', $game);
		$query->setParameter('p', $player);
		$query->setMaxResults(10);
		return $query->getResult();
	}
	
}

?>
