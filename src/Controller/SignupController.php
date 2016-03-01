<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class SignupController extends AppController
{
    /**
     * Index (signup)
     *
     * This will create a new site
     * Add the user info to this database
     * The username and password will be stored (but not used on this site)
     * This user info is mainly to know whether the user is active (eg. subscribed) and contain meta data.
     */
    public function index() {

        $this->viewBuilder()
            ->layout('signup')
            ->templatePath('Pages')
            ->template('signup');

        if ($this->request->is('post')) {
            debug($this->request->data);
            exit;
        }
    }
}