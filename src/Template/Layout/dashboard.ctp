<?php
use Cake\Core\Configure;

if (!$this->fetch('html')) {
    $this->start('html');
    printf('<html lang="%s">', Configure::read('App.language'));
    $this->end();
}

if (!$this->fetch('title') && Configure::read('App.title')) {
    $this->start('title');
    echo Configure::read('App.title');
    $this->end();
}
// Always append App.title to current page title
elseif ($this->fetch('title') && Configure::read('App.title')) {
    $this->append('title', sprintf(' | %s', Configure::read('App.title')));
}

// Prepend some meta tags
$this->prepend('meta', $this->Html->meta('icon'));
$this->prepend('meta', $this->Html->meta('viewport', 'width=device-width, initial-scale=1'));
if (Configure::read('App.author')) {
    $this->prepend('meta', $this->Html->meta('author', null, [
        'name'    => 'author',
        'content' => Configure::read('App.author')
    ]));
}

// Prepend scripts required by the navbar
$this->prepend('script', $this->Html->script([
    '//code.jquery.com/jquery-2.1.1.min.js',
    '/bootstrap/js/transition',
    '/bootstrap/js/collapse',
    '/bootstrap/js/dropdown',
    '/bootstrap/js/alert'
]));

?>
<!DOCTYPE html>
<?= $this->fetch('html'); ?>
<head>
    <?= $this->Html->charset(); ?>
    <title>
        <?= $this->fetch('title'); ?>
    </title>
    <?php
        // Meta
        echo $this->fetch('meta');

        // Styles
        echo $this->Less->less([
            'Bootstrap.less/bootstrap.less'
            // 'Bootstrap.less/cakephp/styles.less'
        ]);
        echo $this->fetch('css');
        echo $this->Html->css('/themes/dashboard/css/dashboard.css');

        // Sometimes we'll want to send scripts to the top (rarely..)
        echo $this->fetch('script.top');
    ?>
</head>
<body>
    <div class="navbar navbar-default navbar-static-top navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="../" class="navbar-brand"><?= Configure::read('App.name'); ?></a>
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse" id="navbar-main">
                <form class="navbar-form navbar-left visible-xs" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form action="" class="search-form hidden-xs">
                            <div class="form-group has-feedback">
                                <label for="search" class="sr-only">Search</label>
                                <input type="text" class="form-control" name="search" id="search" placeholder="search">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </form>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Username <span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="themes">
                            <li><a href="#">link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">link 2</a></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Help</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-9 col-md-push-2 col-sm-push-3 content">
                <div class="page-header">
                    <h1><?= $this->fetch('title'); ?></h1>
                    <p class="lead"><?= $this->fetch('description'); ?></p>
                </div>
                <?= $this->Flash->render(); ?>
                <?= $this->fetch('content'); ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-md-pull-10 col-sm-pull-9 sidebar-nav">
                <div class="list-group">
                    <?php echo $this->element('Themes/Dashboard/sidebar'); ?>
                </div>
            </div>
        </div>
        <footer>
            <div class="row">
                <div class="col-lg-12">

                    <ul class="list-unstyled">
                        <li class="pull-right"><a href="#top">Back to top</a></li>
                        <li>&copy; <?= date('Y'); ?> <?= $this->Html->link(Configure::read('App.name'), '/'); ?></li>
                    </ul>

                </div>
            </div>
        </footer>
    </div>
    <?= $this->fetch('script'); ?>
</body>
</html>