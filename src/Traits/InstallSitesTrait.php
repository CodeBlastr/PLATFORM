<?php
namespace App\Traits;

use Cake\Datasource\ConnectionManager;
use Cake\Database\Exception\MissingConnectionException;
use Cake\Core\Exception\Exception;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Class InstallTrait
 * @package App\Traits
 * @todo Should I move this trait into a plugin?
 */
trait InstallSitesTrait
{

    public $config;

    /**
     * Handle config variables
     *
     * @todo make the str_replace() to find the dbType some better regex or something
     */
    protected function config(array $config = [])
    {
        // defaults
        $config = array_merge([
            'folderName' => $_SERVER['HTTP_HOST'],
            'connection' => 'install' // having this as variable will allow easier custom config settings for multiple install types
        ], $config);

        $conn = ConnectionManager::get($config['connection']);
        // some more defaults
        $install = $conn->config();

        $install['siteName'] = !empty($install['siteName']) ? $install['siteName'] : $config['folderName'];
        $install['domain'] = !empty($install['domain']) ? $install['domain'] : $_SERVER['HTTP_HOST'];
        $install['dbType'] = str_replace('Cake\Database\Driver\\', '', $install['driver']);
        $install['dbName'] = $install['dbPrefix'] . preg_replace("/[^A-Za-z]/", '', str_replace($install['dbPostfix'], '', $config['folderName']));

        // putting here allows runtime overwriting of config files
        $this->config = array_merge($install, $config);
    }

    /**
     * Install method
     * Installs a new domain, new database and website.
     *
     * @throws Exception
     */
    public function install(array $config = [])
    {
        try {
            self::config($config);
            self::_copyTemplateDatabase();
            self::_copySiteTemplate();
            self::_updateSitesBootstrap();
            self::_updateSiteConfig();
        } catch (Exception $e) {
            // should probably have a roll back here in case there is an error and need to try again
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Create a copy of the template database
     *
     * @return bool
     * @throws Exception
     * @throws MissingConnectionException
     *
     * @todo make the str_replace() to find the dbType some better regex or something
     */
    protected function _copyTemplateDatabase()
    {
        $createMethod = '_copy' . $this->config['dbType'] . 'Database';
        if (method_exists($this, $createMethod)) {
            $this->$createMethod();
        } else {
            throw new MethodNotAllowedException();
        }
    }

    /**
     * Copy a Postgresql Database
     *
     * @return bool
     */
    protected function _copyPostgresDatabase()
    {
        if (!empty($this->request->data)) {

            $connection = pg_connect('host=' . $this->config['host'] . ' port=' . $this->config['port'] . ' user=' . $this->config['username'] . ' password=' . $this->config['password']);

            if ($connection) {
                $sql = 'CREATE DATABASE ' . $this->config['dbName'] . ' WITH TEMPLATE=' . $this->config['dbTemplate'] . ' ENCODING=UTF8';
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

    /**
     * copy sites/example.com folder to sites/[domain]
     *
     * @return boole
     * @throws Exception
     */
    protected function _copySiteTemplate()
    {
        $template = ROOT . DS . 'sites' . DS . $this->config['folderTemplate'];
        $newSite = ROOT . DS . 'sites' . DS . $this->config['folderName'];
        if (file_exists($template)) {
            if (file_exists($newSite)) {
                throw new Exception('New site already exists');
            } else {
                $folder = new Folder($template);
                if ($folder->copy($newSite)) {
                    return true;
                } else {
                    throw new Exception('Site files creation failed');
                }
            }
        } else {
            throw new Exception('Folder template does not exist');
        }
    }

    /**
     * Update sites/bootstrap.php file with new domain settings
     *
     * @return bool
     */
    protected function _updateSitesBootstrap()
    {
        $filename = ROOT . DS . 'sites' . DS . 'bootstrap.php';
        $file = new File($filename);

        if ($file->writable()) {
            $contents = $file->read();
            $replace = "\$domains['" . $this->config['subdomain'] . $this->config['domain'] . "'] = '" . $this->config['folderName'] . "';" . PHP_EOL;
            $contents = str_replace('/** end **/', $replace . PHP_EOL . '/** end **/', $contents);
            if ($file->write($contents)) {
                return true;
            } else {
                throw new Exception('bootstrap write failed');
            }
        } else {
            throw new Exception('bootstrap not writable');
        }
    }

    /**
     * Update sites/[domain]/config/app.php with database settings
     *
     * @return bool
     */
    protected function _updateSiteConfig()
    {
        $filename = ROOT . DS . 'sites' . DS . $this->config['folderName'] . DS . 'config' . DS . 'app.php';
        $file = new File($filename);

        if ($file->writable()) {
            $contents = $file->read();
            $search = [
                'REPLACE.Datasources.default.username',
                'REPLACE.Datasources.default.password',
                'REPLACE.Datasources.default.database',
                'REPLACE.App.name'
            ];
            $replace = [
                $this->config['username'],
                $this->config['password'],
                $this->config['dbName'],
                $this->config['siteName'],
            ];
            $contents = str_replace($search, $replace, $contents);
            if ($file->write($contents)) {
                return true;
            } else {
                throw new Exception('site config write failed');
            }
        } else {
            // might not need to update the app.php file
            return false;
        }
    }
}