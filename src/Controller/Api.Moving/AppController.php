<?php
namespace App\Controller\Api;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    use \Crud\Controller\ControllerTrait;

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Crud.Crud', [
            'actions' => [
                'Crud.Index',
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete'
            ],
            'listeners' => [
                'Crud.Api',
                'Crud.ApiPagination',
                'Crud.ApiQueryLog'
            ]
        ]);
        $this->loadComponent('Auth', [
            'storage' => 'Memory',
            'authenticate' => [
                'Form' => [
                    'scope' => ['Users.active' => 1]
                ],
                'ADmad/JwtAuth.Jwt' => [
                    'parameter' => 'token',
                    'userModel' => 'Users',
                    'scope' => ['Users.active' => 1],
                    'fields' => [
                        'username' => 'id'
                    ],
                    'queryDatasource' => true // your JWT token (and thus the user information) will NOT contain an id field if you choose to disable the queryDataSource option. This might might break code depending on the presence of an id field but is easily solved by manually adding the id field to the JWT token (below exp in the code above).  http://www.bravo-kernel.com/2015/04/how-to-add-jwt-authentication-to-a-cakephp-3-rest-api/
                ]
            ],
            'unauthorizedRedirect' => false,
            'checkAuthIn' => 'Controller.initialize'
        ]);
    }
}