<?php

namespace App\View;

use WyriHaximus\TwigView\View\TwigView;
use CodeBlastrMultiSite\View\MultiSiteView;

/**
 * Application View
 * Extends TwigView which extends Cake/View
 *
 * @link http://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends TwigView
{

    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize()
    {
        $this->loadHelper('Less', ['className' => 'Less.Less']);
        $this->loadHelper('Html', ['className' => 'BootstrapUI.Html']);
        $this->loadHelper('Form', ['className' => 'BootstrapUI.Form', 'templates' => 'CodeBlastrBootstrap.form.templates']);

        $this->loadHelper('Flash', ['className' => 'BootstrapUI.Flash']);
        //$this->loadHelper('Flash');  // BootstrapUI.Flash doesn't support magic flash (eg. $this->Flash->error()
        $this->loadHelper('Paginator', ['className' => 'BootstrapUI.Paginator']);

        $this->theme = 'CodeBlastrBootstrap';
        if ($this->request->prefix === 'dashboard' && $this->layout === 'default') {
            $this->layout = 'CodeBlastrBootstrap.dashboard';
        }
    }

    /**
     * Overwrites Cake/View::_paths()
     *
     * @param null $plugin
     * @param bool $cached
     * @return mixed
     */
    protected function _paths($plugin = null, $cached = true)
    {
        $multisite = new MultiSiteView();
        $multisite->theme = $this->theme;
        return $multisite->_paths($plugin, $cached);
    }
}
