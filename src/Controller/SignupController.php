<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
//use Cake\Network\Exception\NotFoundException;



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

        $users = TableRegistry::get('CodeBlastr/Users.Users');

        if ($this->request->is('post')) {
            $users = TableRegistry::get('CodeBlastr/Users.Users');
            $user = $users->newEntity($this->request->data);
            if ($users->save($user)) {


                $this->Flash->success("Yeah");
            } else {
                $this->Flash->error('Nope');
                $this->set('user', $user);
            }
        }

        $this->set('user', $user = $users->newEntity());
        $this->viewBuilder()
            ->layout(false)
            ->templatePath('Pages')
            ->template('signup');
    }
}