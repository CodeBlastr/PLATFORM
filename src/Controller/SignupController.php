<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Exception\MissingConnectionException;
use Cake\Core\Exception\Exception;
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
     *
     * @todo not for this function, but need to check test that logins work for superusers but not users
     * @todo validate the subdomain that it is formatted properly
     * @todo setup notification of when a new site is created
     */
    public function index()
    {
        $users = TableRegistry::get('CodeBlastr/Users.Users');

        if ($this->request->is('post')) {
            $users = TableRegistry::get('CodeBlastr/Users.Users');
            $user = $users->newEntity($this->request->data);

            // time to create and redirect to a new site
            // delete this because it is supposed to be after the save happens
            $this->install();
            exit;

            if ($users->save($user)) {
                // time to create and redirect to a new site
                $this->install();
            } else {
                $this->Flash->error('Error, please try again.');
                $this->set('user', $user);
            }
        }

        $this->set('user', $user = $users->newEntity());
        $this->viewBuilder()
            ->layout(false)
            ->templatePath('Pages')
            ->template('signup');
    }

    /**
     * Install method
     * Installs a new domain, new database and website.
     *
     * @throws Exception
     */
    public function install()
    {
        $conn = ConnectionManager::get('install');
        $this->_createDatabase($conn);
        // update conf file??? or do we have a sites/bootstrap file again???
        // conf doesn't work because the server would have to be restarted

        // multiple sites a single install ( it has to be that way )

        // s3 for all static files
        // database for everything else
        // is that possible????

        // domain -> 

        exit;
    }

    /**
     * Create database method
     *
     * @param $conn
     * @return bool
     * @throws Exception
     * @throws MissingConnectionException
     */
    protected function _createDatabase($conn)
    {
        $config = $conn->config();
        $dbName = $config['prefix'] . preg_replace("/[^A-Za-z]/", '', str_replace($config['postfix'], '', $this->request->data['data']['subdomain']));
        $connection = pg_connect('host=' . $config['host'] . ' port=' . $config['port'] . ' user=' . $config['username'] . ' password=' . $config['password']);

        if($connection){
            $sql = 'CREATE DATABASE ' . $dbName . ' WITH TEMPLATE=' . $config['dbtemplate'] . ' ENCODING=UTF8';
            $query = pg_query($connection, $sql);
            pg_close($connection);
            if($query){
                return true;
            } else {
                throw new Exception(pg_last_error($connection));
            }
        } else {
            throw new MissingConnectionException('Database connection to template failed, please contact an administrator.');
        }
    }
}