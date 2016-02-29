<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cocktail'), ['action' => 'edit', $cocktail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cocktail'), ['action' => 'delete', $cocktail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cocktail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cocktails'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cocktail'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cocktails view large-9 medium-8 columns content">
    <h3><?= h($cocktail->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($cocktail->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($cocktail->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($cocktail->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($cocktail->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($cocktail->modified) ?></td>
        </tr>
    </table>
</div>
