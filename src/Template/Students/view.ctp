<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->idSTUDENT]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student'), ['action' => 'delete', $student->idSTUDENT], ['confirm' => __('Are you sure you want to delete # {0}?', $student->idSTUDENT)]) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="students view large-9 medium-8 columns content">
    <h3><?= h($student->idSTUDENT) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('NAME') ?></th>
            <td><?= h($student->NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PHONE') ?></th>
            <td><?= h($student->PHONE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ADDRESS') ?></th>
            <td><?= h($student->ADDRESS) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('REMARK') ?></th>
            <td><?= h($student->REMARK) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IMAGE') ?></th>
            <td><?= h($student->IMAGE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdSTUDENT') ?></th>
            <td><?= $this->Number->format($student->idSTUDENT) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdGENDER') ?></th>
            <td><?= $this->Number->format($student->idGENDER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('BIRTHDAY') ?></th>
            <td><?= h($student->BIRTHDAY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UPDATE TIME') ?></th>
            <td><?= h($student->UPDATE_TIME) ?></td>
        </tr>
    </table>
</div>
