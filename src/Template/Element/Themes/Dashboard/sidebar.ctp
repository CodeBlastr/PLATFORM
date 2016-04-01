<?= @$contextMenu['prepend'] ? $contextMenu['prepend'] : null; ?>
<?php if (@$contextMenu['reset'] === true) : else : ?>
    <div class="list-group-item">
        <a href="#collapseOne" data-toggle="collapse"><span class="glyphicon glyphicon-home"></span> Dashboard <span class="caret"></span></a>
        <ul id="collapseOne" class="collapse list-unstyled">
            <li><a href="#">something</a></li>
            <li><a href="#">something</a></li>
            <li><a href="#">something</a></li>
        </ul>
    </div>
    <a href="#collapseTwo" data-toggle="collapse" class="list-group-item">Orders</a>

    <div class="list-group-item">
        <a href="#collapseThree" data-toggle="collapse"> <span class="glyphicon glyphicon-user"></span> Customers <span class="caret"></span></a>
        <ul id="collapseThree" class="collapse list-unstyled">
            <li><?= $this->Html->link(__('Customer List'), ['plugin' => 'CodeBlastr/Users', 'controller' => 'users', 'action' => 'index', '?' => ['role' => 'customer']]); ?></li>
            <li><?= $this->Html->link(__('Add Customer'), ['plugin' => 'CodeBlastr/Users', 'controller' => 'users', 'action' => 'add', '?' => ['role' => 'customer']]); ?></li>
        </ul>
    </div>
<?php endif; ?>
<?= @$contextMenu['append'] ? $contextMenu['append'] : null; ?>