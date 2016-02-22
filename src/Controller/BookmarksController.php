<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class BookmarksController extends AppController
{

    /**
     * @return void
     */
    public function hello() {

		$query = TableRegistry::get('Bookmarks')->find();

		foreach ($query as $article) {
		    debug($article);
		}
		debug('hello');
    	exit;
    }
}