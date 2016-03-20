<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Plugin;

/**
 * Class DashboardController
 * @package App\Controller
 *
 * @todo Should this be moved into a plugin?
 */
class DashboardController extends AppController
{

    /**
     * Index action
     */
    public function index()
    {
        $this->set('plugins', Plugin::loaded());
    }
}
