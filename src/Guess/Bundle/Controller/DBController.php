<?php 
namespace Guess\Bundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DBController extends Controller {
	
	/**
	 * Static variable for game type
	 */
	private static $ONED = 1;
	private static $TOWD = 2;
	private static $THREED = 3;
	
	/**
	 * Static variable for game level
	 */
	private static $EASY = 1;
	private static $MEDIUM = 2;
	private static $HARD = 3;

	/**
	 * Get already registerd user
	 */
	public function getUserAction() {
		
	}
	
	/**
	 * set new user
	 */
	public function setUserAction() {
		
	}
	
	/**
	 * save user score
	 */
	public function saveScoreAction() {
		
	}
	
	/**
	 * get user record
	 */
	public function getUserScoreAction() {
		
	}
	
	/**
	 * get top 10 player and their score
	 */
	public function getTop10Action() {
		
	}
	
	/**
	 * helper function to get different game, level top 10
	 * @param int $game
	 * @param int $level
	 */
	public function getTop10($game, $level) {
		
	}

	
}

?>