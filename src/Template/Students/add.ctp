<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 */
?>
<link href="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
<div>
    <div class="form-group row">
        <h3 style="color: #003300; margin-top: 3%;">Add Student</h3>
    </div>
    <?= $this->Form->create($student, ['enctype' => 'multipart/form-data']); ?>
    <div class="form-group row">
        <div class="form-group col-sm-6">
            <label><?= __('Student Name')?></label>
            <?= $this->Form->control('NAME', ['label' => false]); ?>     
        </div> 
        <div class="form-group col-sm-6">
            <label><?= __('Phone Number')?></label>
            <?= $this->Form->control('PHONE', ['label' => false]); ?>     
        </div> 
    </div>
    <div class="form-group row">
        <div class="form-group col-sm-6">
            <label><?= __('Birthday')?></label>
            <?= $this->Form->control('BIRTHDAY', ['empty' => true, 'label' => false]); ?>  
        </div> 
        <div class="form-group col-sm-6">
            <!-- $this->Form->control('UPDATE_TIME', ['empty' => true]);  -->
            <label><?= __('Gender')?></label> 
            <?= 
                $this->Form->radio(
                    'idGENDER',
                    [
                        ['value' => '1', 'text' => 'Male', 'label' => ['class' => 'red']],
                        ['value' => '2', 'text' => 'Female', 'label' => ['class' => 'red']],
                    ]
                );
            ?>  
        </div> 
    </div>
    <div class="form-group row">
        <div class="form-group col-sm-12">
            <label><?= __('Address')?></label>
            <?= $this->Form->control('ADDRESS', ['label' => false]); ?>     
        </div> 
    </div>
    <div class="form-group row"> 
        <div class="form-group col-sm-12"> 
            <label><?= __('Remark')?></label>
            <?= $this->Form->textarea('REMARK'); ?>   
        </div> 
    </div>
    <div class="form-group row"> 
        <div class="form-group col-sm-12"> 
            <label><?= __('Image')?></label>
            <?= $this->Form->file('IMAGE',['label' => false, 'id' => 'imgInp']); ?>  
            <?= $this->Html->image(['id' => 'blah']); ?>
        </div> 
    </div>
    <div class="form-group row clearfix ">
            <?= $this->Form->button('Submit', ['type' => 'submit', 'class' => 'btn btn-info' ]); ?>&nbsp;
            <?= $this->Html->link('Cancel', ['action' => 'index'],
                [ 'style' => 'display: inline-table;', 'class' => 'btn btn-info float-right ']); ?>  
    </div>
    <?= $this->Form->end() ?>
</div>
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
    }

    $("#imgInp").change(function() {
    readURL(this);
    });
</script>
