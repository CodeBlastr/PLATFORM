<?php
namespace App\Controller\Component;

use Cake\Controller\Component\PaginatorComponent;
use Cake\Utility\Hash;

/**
 * Class PaginatorComponent
 *
 * Overwriting core PaginatorComponent to add automatic conditional
 * statements based on the get url parameters in the request.
 * See filter() or unit tests for more info.
 *
 * @package App\Controller\Component
 */
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
        $settings = $this->filter($settings);
        return parent::paginate($object, $settings);
    }

    /**
     * Filter, creates paginate conditions settings automatically
     * based on get url parameters
     *
     * Supports (or will support)
     *  - equals : field IN 'example', 'example2', multiple values on same field creates an AND filter
     *  - begins : field LIKE 'example%', multiple values on same field creates an OR filter
     *  - contains : field LIKE '%example%', multiple values on same field creates an OR filter
     *  - between : field > 'X' && field < 'X', multiple values on same field creates an AND filter
     *  - greater : field > 'X', multiple values on same field is unnecessary
     *  - lesser : field < 'X', multiple values on same field is unnecessary
     * > Multiple fields should always create an AND filter
     *
     * @param array $settings
     * @return array
     */
    public function filter(array $settings = [])
    {
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
                    $settings = Hash::merge($settings, $this->$methodName());
                }
            }
        }
        return $settings;
    }

    /**
     * ###Usage Example
     * http://some-request/...?filter=lesser&lesser[created]=2016-03-17
     *
     * @return array
     */
    protected function _lesser()
    {
        $settings = [];
        if (!empty($this->request->query['lesser']) && is_array($this->request->query['lesser'])) {
            foreach ($this->request->query['lesser'] as $field => $value) {
                $settings['conditions'][$field . ' <'] = $value;
            }
        }
        return $settings;
    }

    /**
     * ###Usage Example
     * http://some-request/...?filter=greater&greater[created]=2016-03-17
     *
     * @return array
     */
    protected function _greater()
    {
        $settings = [];
        if (!empty($this->request->query['greater']) && is_array($this->request->query['greater'])) {
            foreach ($this->request->query['greater'] as $field => $value) {
                $settings['conditions'][$field . ' >'] = $value;
            }
        }
        return $settings;
    }

    /**
     * ###Usage Example
     * http://some-request/...?filter=between&between[created][]=2016-03-01&between[created][]=2016-03-10
     *
     * @return array
     */
    protected function _between()
    {
        $settings = [];
        if (!empty($this->request->query['between']) && is_array($this->request->query['between'])) {
            foreach ($this->request->query['between'] as $field => $value) {
                if (is_array($value)) {
                    if (count($value) > 2) {
                        // if begins has multiple values it has to be an OR statement
                        $i = 0;
                        $n = -1;
                        foreach ($value as $val) {
                            $switch = $i % 2 == 0 ? ' >' : ' <';
                            if ($i % 2 == 0) {
                                $n++;
                            }
                            $settings['conditions']['OR'][$n]['AND'][] = [$field . $switch => $val];
                            $i++;
                        }
                    } else {
                        // if begins has multiple values it has to be an OR statement
                        $i = 1;
                        foreach ($value as $val) {
                            $switch = $i % 2 == 0 ? ' <' : ' >';
                            $settings['conditions']['AND'][] = [$field . $switch => $val];
                            $i++;
                        }
                    }
                }
            }
        }
        return $settings;
    }

    /**
     * ###Usage Example
     * http://some-request/...?filter=contains&contains[first_name][]=es
     *
     * @return array
     */
    protected function _contains()
    {
        $settings = [];
        if (!empty($this->request->query['contains']) && is_array($this->request->query['contains'])) {
            foreach ($this->request->query['contains'] as $field => $value) {
                if (is_array($value)) {
                    // if begins has multiple values it has to be an OR statement
                    foreach ($value as $val) {
                        $settings['conditions']['OR'][][$field . ' LIKE'] = '%' . $val . '%';
                    }
                } else {
                    $settings['conditions'][$field . ' LIKE'] = '%' . $value . '%';
                }
            }
        }
        return $settings;
    }

    /**
     * ###Usage Example
     * http://some-request/...?filter=begins&begins[first_name][]=tes
     *
     * @return array
     */
    protected function _begins()
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
     * @return array
     */
    protected function _equals()
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
