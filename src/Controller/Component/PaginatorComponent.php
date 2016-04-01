<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Component;

use Cake\Controller\Component\PaginatorComponent;
use Cake\Utility\Hash;
//use Cake\Datasource\QueryInterface;
//use Cake\Datasource\RepositoryInterface;
//use Cake\Network\Exception\NotFoundException;


class PaginatorComponent extends PaginatorComponent
{
    public $finder = ['filter', 'range'];

    /**
     * Overwriting so you can specify finder from the url.
     *
     * See tests and comments on protected methods for examples
     *
     * @param $object
     * @param array $settings
     * @return \Cake\Datasource\ResultSetInterface
     */
    public function paginate($object, array $settings = [])
    {
        $settings = $this->_filter($object, $settings);
        //$settings['finder'] = ['all' => ['conditions' => ['role' => 'creators']]];
//        $settings['conditions'] = ['email' => 'admin@example.com'];
        return parent::paginate($object, $settings);
    }

    /**
     *
     * Not sure $object will be needed so I set it to null for the time being
     *
     * @param null $object
     * @param array $settings
     * @return array
     */
    protected function _filter($object = null, array $settings = [])
    {
        //$request = $this->_registry->getController()->request;
        if (!empty($this->request->query['filter'])) {
            if (is_array($this->request->query['filter'])) {
                $filters = $this->request->query['filter'];
            } else {
                $filters[] = $this->request->query['filter'];
            }
        }

        if (!empty($filters)) {
            foreach ($filters as $filter) {
                $methodName = '_' . $filter;
                if(method_exists($this, $methodName)) {
                    $settings = Hash::merge($settings, $this->$methodName($object));
                }
            }
        }
//        debug($settings);
//        exit;
        return $settings;
    }

    /**
     * ###Usage Example
     * http://some-request/...?filter=begins&begins[first_name][]=tes
     *
     * @param $object
     * @return array
     */
    protected function _begins($object)
    {
        $settings = [];
        if (!empty($this->request->query['begins']) && is_array($this->request->query['begins'])) {
            foreach ($this->request->query['begins'] as $field => $value) {
                if (is_array($value)) {
                    // if begins has multiple values it has to be an OR statement
                    foreach ($value as $val) {
                        $settings['conditions']['OR'][][$field . ' LIKE'] = $val . '%';
                    }
                } else {
                    $settings['conditions'][$field . ' LIKE'] = $value . '%';
                }
            }
        }
        return $settings;
    }

    /**
     * ###Usage Example
     * http://some-request/...?filter=equals&equals[first_name][]=test&equals[first_name][]=Jane&equals[role]=user
     *
     * @param $object
     * @return array
     */
    protected function _equals($object)
    {
        $settings = [];
        if (!empty($this->request->query['equals']) && is_array($this->request->query['equals'])) {
            foreach ($this->request->query['equals'] as $field => $value) {
                $settings['conditions'][$field . ' IN'] = $value;
            }
        }
        return $settings;
    }

}
