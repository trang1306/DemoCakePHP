<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student[]|\Cake\Collection\CollectionInterface $students
 */
$datepicker =  $this->Html->css('datepicker');
$bootstrap_datepicker = $this->Html->script('bootstrap-datepicker');
$angular =  $this->Html->script('angular.min');
$this->assign('js_head', $angular);
$this->assign('js_head2', $bootstrap_datepicker);
$this->assign('css2', $datepicker);
$this->assign('js_head3', $this->Html->script('select2.min'));
$this->assign('css3', $this->Html->css('select2'));
echo $this->Html->script('select2.custom');
echo $this->Html->css('select2-bootstrap');
echo $this->Html->css('select2-as');
echo $this->Html->css('select2-bootstrap-full');
echo $this->HTML->css('bootstrap.min.css');
echo $this->Html->script('bootstrap.min.js');
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Student'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="students index large-9 medium-8 columns content">
    <h3><?= __('All Students') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('idSTUDENT') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idGENDER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('BIRTHDAY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PHONE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ADDRESS') ?></th>
                <th scope="col"><?= $this->Paginator->sort('REMARK') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IMAGE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('UPDATE_TIME') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $this->Number->format($student->idSTUDENT) ?></td>
                <td><?= $this->Number->format($student->idGENDER) ?></td>
                <td><?= h($student->NAME) ?></td>
                <td><?= h($student->BIRTHDAY) ?></td>
                <td><?= h($student->PHONE) ?></td>
                <td><?= h($student->ADDRESS) ?></td>
                <td><?= h($student->REMARK) ?></td>
                <td><?= h($student->IMAGE) ?></td>
                <td><?= h($student->UPDATE_TIME) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $student->idSTUDENT]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->idSTUDENT]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->idSTUDENT], ['confirm' => __('Are you sure you want to delete # {0}?', $student->idSTUDENT)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div> -->
<div>
    <div class="form-group">
        <div class="col-sm-12">
            <h1 class="text-center"><?= __('All Students') ?></h1>
        </div>        
        <div class="col-sm-2">
            <?= $this->Html->link(__('NEW STUDENT'), ['action' => 'add'], ['class' => 'btn btn-info']) ?>
        </div>
    </div>
    <div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('GENDER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('BIRTHDAY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PHONE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ADDRESS') ?></th>
                <th scope="col"><?= $this->Paginator->sort('REMARK') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('IMAGE') ?></th> -->
                <th scope="col"><?= $this->Paginator->sort('UPDATE_TIME') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $this->Number->format($student->idSTUDENT) ?></td>
                <td><?= $this->Number->format($student->idGENDER) ?></td>
                <td><?= h($student->NAME) ?></td>
                <td><?= h(date("d/m/Y", strtotime($student->BIRTHDAY))) ?></td>
                <td><?= h($student->PHONE) ?></td>
                <td><?= h($student->ADDRESS) ?></td>
                <td><?= h($student->REMARK) ?></td>
                <!-- <td><?= h($student->IMAGE) ?></td> -->
                <td><?= h(date("d/m/Y", strtotime($student->UPDATE_TIME))) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $student->idSTUDENT]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->idSTUDENT]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->idSTUDENT], ['confirm' => __('Are you sure you want to delete # {0}?', $student->idSTUDENT)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>