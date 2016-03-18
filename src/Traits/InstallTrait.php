<?php
namespace App\Traits;

use Cake\Datasource\ConnectionManager;
use Cake\Database\Exception\MissingConnectionException;
use Cake\Core\Exception\Exception;
use Cake\Network\Exception\MethodNotAllowedException;

/**
 * Class InstallTrait
 * @package App\Traits
 * @todo Should I move this trait to a plugin?
 */
trait InstallTrait
{


    /**
     * Install method
     * Installs a new domain, new database and website.
     *
     * @throws Exception
     */
    public function install()
    {
        $this->_copyTemplateDatabase();
        // copy sites/example.com folder
        // $this->_copySiteTemplate();
        // update bootstrap
        // $this->_updateSitesBootstrap();
        // update config/app.php with db info
        // $this->_updateSiteConfig();



        // s3 for all static files
        // database for everything else
        // is that possible????
        // probably not css files, they're just too hard to edit there

    }

    /**
     * Create database method
     *
     * @return bool
     * @throws Exception
     * @throws MissingConnectionException
     *
     * @todo make the str_replace() to find the dbType some better regex or something
     */
    protected function _copyTemplateDatabase()
    {
        $conn = ConnectionManager::get('install');
        $config = $conn->config();

        $dbType = str_replace('Cake\Database\Driver\\', '', $config['driver']);
        $createMethod = '_copy' . $dbType . 'Database';
        if (method_exists($this, $createMethod)) {
            $this->$createMethod($config);
        } else {
            throw new MethodNotAllowedException();
        }
    }

    /**
     * Copy a Postgresql Database
     *
     * @param array $config
     * @return bool
     */
    protected function _copyPostgresDatabase(array $config)
    {
        if (!empty($this->request->data)) {
            $dbName = $config['prefix'] . preg_replace("/[^A-Za-z]/", '', str_replace($config['postfix'], '', $this->request->data['data']['subdomain']));
            $connection = pg_connect('host=' . $config['host'] . ' port=' . $config['port'] . ' user=' . $config['username'] . ' password=' . $config['password']);

            if ($connection) {
                $sql = 'CREATE DATABASE ' . $dbName . ' WITH TEMPLATE=' . $config['dbtemplate'] . ' ENCODING=UTF8';
                $query = @pg_query($connection, $sql);
                $error = pg_last_error($connection);
                pg_close($connection);
                if ($query) {
                    return true;
                } else {
                    throw new Exception($error);
                }
            } else {
                throw new MissingConnectionException('Database connection to template failed, please contact an administrator.');
            }
        } else {
            throw new Exception('Post data missing');
        }
    }
}