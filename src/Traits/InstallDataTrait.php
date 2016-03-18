<?php
namespace App\Traits;

use Cake\Datasource\ConnectionManager;
use Cake\Database\Exception\MissingConnectionException;
use Cake\Core\Exception\Exception;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Class InstallDataTrait
 * @package App\Traits
 * @todo Should I move these install traits into a plugin?
 */
trait InstallDataTrait
{

    public $config;

    /**
     * Handle config variables
     *
     * Already considered whether to add data to the dbTemplate
     * before it is copied, and decided to leave the dbTemplate alone
     * as not to mess it up.
     *
     * @todo make the str_replace() to find the dbType some better regex or something
     */
    protected function config(array $config = [])
    {

        debug($config);
        exit;

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
     * Create data method
     * Creates data on a
     *
     * @param array $config
     * @throws Exception
     * @return array the HTTP_HOST of the site that was created, and the database created
     */
    public function createData(array $config = [])
    {
        try {
            self::config($config);

        } catch (Exception $e) {
            // should probably have a roll back here in case there is an error and need to try again
            throw new Exception($e->getMessage());
        }
    }
    }
}