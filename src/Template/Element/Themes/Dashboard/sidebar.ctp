<?= @$sidebar['prepend'] ? $sidebar['prepend'] : null; ?>
<?php if (@$sidebar['reset'] === true) : else : ?>
    <a href="#collapseOne" data-toggle="collapse" class="list-group-item">
        <span class="glyphicon glyphicon-home"></span> Dashboard <span class="caret"></span></a>
        <ul id="collapseOne" class="collapse list-unstyled">
            <li><a href="#">something</a></li>
            <li><a href="#">something</a></li>
            <li><a href="#">something</a></li>
        </ul>
    </a>
    <a href="#collapseTwo" data-toggle="collapse" class="list-group-item">Orders</a>
    <a href="#collapseThree" data-toggle="collapse" class="list-group-item">Customers</a>
<?php endif; ?>
<?= @$sidebar['append'] ? $sidebar['append'] : null; ?>