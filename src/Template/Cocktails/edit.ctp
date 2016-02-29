<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cocktail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cocktail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cocktails'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cocktails form large-9 medium-8 columns content">
    <?= $this->Form->create($cocktail) ?>
    <fieldset>
        <legend><?= __('Edit Cocktail') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
