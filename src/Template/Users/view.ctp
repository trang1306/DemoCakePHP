<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->idUSER]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->idUSER], ['confirm' => __('Are you sure you want to delete # {0}?', $user->idUSER)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->idUSER) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('USERNAME') ?></th>
            <td><?= h($user->USERNAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PASSWORD') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ROLE') ?></th>
            <td><?= h($user->ROLE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CREATED') ?></th>
            <td><?= h($user->CREATED) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('MODIFIED') ?></th>
            <td><?= h($user->MODIFIED) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdUSER') ?></th>
            <td><?= $this->Number->format($user->idUSER) ?></td>
        </tr>
    </table>
</div>
