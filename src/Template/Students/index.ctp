<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student[]|\Cake\Collection\CollectionInterface $students
 */
?>
<div>
    <div class="form-group">
        <div class="col-sm-12">
<<<<<<< HEAD
            <h1 class="text-center"><?= __('All Students') ?></h1>
=======
            <h1 class="text-center" style="margin-top: 6%"><?= __('All Students') ?></h1>
>>>>>>> 720261b35fa25bee8d31385bd79a2e12f27e901f
        </div>        
        <div class="col-sm-2">
            <?= $this->Html->link(__('NEW STUDENT'), ['action' => 'add'], ['class' => 'btn btn-info']); ?>
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
                <!-- <th scope="col"><?= $this->Paginator->sort('REMARK') ?></th> -->
                <th scope="col"><?= $this->Paginator->sort('IMAGE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('UPDATE_TIME') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $this->Number->format($student->idSTUDENT) ?></td>
                <?php if($student->idGENDER == 1){ ?>
                    <td>Male</td>
                <?php } else { ?>
                    <td>Female</td>
                <?php } ?>
                <td><?= h($student->NAME) ?></td>
                <td><?= h(date("d/m/Y", strtotime($student->BIRTHDAY))) ?></td>
                <td><?= h($student->PHONE) ?></td>
                <td><?= h($student->ADDRESS) ?></td>
                <!-- <td><?= h($student->REMARK) ?></td> -->
                <!-- <td><?= h($student->IMAGE) ?></td> -->
                <td><?= $this->Html->image($student->image) ?></td>
                <td><?= h(date("d/m/Y", strtotime($student->UPDATE_TIME))) ?></td>
                <td class="actions btn-group">
                    <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'view', $student->idSTUDENT], ['class' => 'btn btn-success', 'escape' => false]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-eye"></i>'), ['action' => 'edit', $student->idSTUDENT], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $student->idSTUDENT], ['confirm' => __('Are you sure you want to delete student name: {0}?', $student->NAME), 'class' => 'btn btn-danger', 'escape' => false]) ?>
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