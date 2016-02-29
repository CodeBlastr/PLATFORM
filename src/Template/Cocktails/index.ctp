<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cocktail'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cocktails index large-9 medium-8 columns content">
    <h3><?= __('Cocktails') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cocktails as $cocktail): ?>
            <tr>
                <td><?= $this->Number->format($cocktail->id) ?></td>
                <td><?= h($cocktail->name) ?></td>
                <td><?= h($cocktail->description) ?></td>
                <td><?= h($cocktail->created) ?></td>
                <td><?= h($cocktail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cocktail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cocktail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cocktail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cocktail->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
