<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use WyriHaximus\TwigView\View\TwigView;

/**
 * Application View
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
//        $this->loadHelper('Form', [
//            'templates' => 'bootstrap-forms'
//        ]);

        $this->loadHelper('Less', ['className' => 'Less.Less']);
        $this->loadHelper('Html', ['className' => 'BootstrapUI.Html']);
        $this->loadHelper('Form', ['className' => 'BootstrapUI.Form', 'templates' => 'bootstrap-forms']);
        $this->loadHelper('Flash', ['className' => 'BootstrapUI.Flash']);
        $this->loadHelper('Paginator', ['className' => 'BootstrapUI.Paginator']);

        $this->theme = 'Bootstrap';
        $this->layout = 'Bootstrap.default';

        $this->assign('navbar.top', $this->_defaultNavbar());
    }

    protected function _defaultNavbar() {
        return
<<<HTML
        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Pricing</a></li>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Login</a></li>
        <li>
            <form class="navbar-form navbar-right" role="search" type="get" action="/signup">
                <button type="submit" class="btn btn-default">Sign Up!</button>
            </form>
        </li>
HTML;

    }
}
