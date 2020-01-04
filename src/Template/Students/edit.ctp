<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $student->idSTUDENT],
                ['confirm' => __('Are you sure you want to delete # {0}?', $student->idSTUDENT)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="students form large-9 medium-8 columns content">
    <?= $this->Form->create($student) ?>
    <fieldset>
        <legend><?= __('Edit Student') ?></legend>
        <?php
            echo $this->Form->control('idGENDER');
            echo $this->Form->control('NAME');
            echo $this->Form->control('BIRTHDAY', ['empty' => true]);
            echo $this->Form->control('PHONE');
            echo $this->Form->control('ADDRESS');
            echo $this->Form->control('REMARK');
            echo $this->Form->control('IMAGE');
            echo $this->Form->control('UPDATE_TIME', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
