<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');

        $this->loadComponent('Flash');

        Configure::write('Users.publicAcl', true);
        $this->loadComponent('CodeBlastr/Users.UsersAuth');
        //$this->loadComponent('CakeDC/Users.UsersAuth');

// going to have to have some kind of auth going on site wide I would imagine


//        $this->loadComponent('Auth', [
//            'storage' => 'Memory',
//            'authenticate' => [
//                'Form' => [
//                    'scope' => ['Users.active' => 1]
//                ],
//                'ADmad/JwtAuth.Jwt' => [
//                    'parameter' => 'token',
//                    'userModel' => 'Users',
//                    'scope' => ['Users.active' => 1],
//                    'fields' => [
//                        'username' => 'id'
//                    ],
//                    'queryDatasource' => true // your JWT token (and thus the user information) will NOT contain an id field if you choose to disable the queryDataSource option. This might might break code depending on the presence of an id field but is easily solved by manually adding the id field to the JWT token (below exp in the code above).  http://www.bravo-kernel.com/2015/04/how-to-add-jwt-authentication-to-a-cakephp-3-rest-api/
//                ]
//            ],
//            'unauthorizedRedirect' => false,
//            'checkAuthIn' => 'Controller.initialize'
//        ]);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
