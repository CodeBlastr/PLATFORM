<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Plugin;
use Cake\Event\Event;

/**
 * Class DashboardController
 * @package App\Controller
 *
 * @todo Should this be moved into a plugin?
 */
class DashboardController extends AppController
{

    public $permissions = true;

    public $listenerPath = '\%s\Event\DashboardListener';

    /**
     * Before filter event
     *
     * @param Event $event
     * @return \Cake\Network\Response|null
     */
    public function beforeFilter(Event $event)
    {
        $this->_listeners();
        return parent::beforeFilter($event);
    }

    /**
     * Index action
     */
    public function index()
    {
        //$this->eventManager()->dispatch(new Event('View.beforeRender', $this));
        //$this->set('dashboardAddon', 'waht the fuck');

        $this->viewBuilder()->layout('dashboard');
        $this->set('plugins', Plugin::loaded());
    }

    /**
     * Listener startup
     *
     * Runs through the installed plugins and checks for a namespace
     * \PluginName\Event\DashboardListener
     */
    protected function _listeners() {
        foreach (Plugin::loaded() as $plugin) {
            $listener = sprintf($this->listenerPath, $plugin);
            if (class_exists($listener)) {
                // Look for and attach listeners if they exist
                $this->eventManager()->on(new $listener());
            }
        }
    }
}