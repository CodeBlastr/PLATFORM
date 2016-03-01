<?php
namespace App\Controller;

//use CodeBlastr\Users\Model\Entity\User;
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

        $this->viewBuilder()
            ->layout(false)
            ->templatePath('Pages')
            ->template('signup');

        if ($this->request->is('post')) {

            STOPPED AT...
            MAKE SURE IT VALIDATES,
            GET THIS DATA WORKING EASIER ( I DO NOT WANT TO MAP DATA LIKE THIS EVERYTIME )


            $users = TableRegistry::get('Users');
            $user = $users->newEntity();

            $user->username = $this->request->data['email'];
            $user->email = $this->request->data['email'];
            $user->password = $this->request->data['password'];
            $user->first_name = $this->request->data['name'];
            $user->last_name = $this->request->data['name'];
            $user->active = 1;
            $user->role = 'user';

            $entity = $users->newEntity($this->request->data);

            if ($users->save($user)) {
                // The $article entity contains the id now
                $id = $user->id;
            }
            debug($id);
            debug($user);
            exit;
        }
    }
}