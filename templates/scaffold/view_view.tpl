<?php
/**
 * @var \App\Http\View\ApplicationView $this
 */
?>
<div class="%pluralName% view">
    <div class="page-header">
        <div class="float-right">
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $%singularName%->id],['class'=>'btn btn-primary']); ?>
            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $%singularName%->id],['class'=>'btn btn-danger','confirm' => __('Are you sure you want to delete # {id}?', ['id' => $%singularName%->id])]); ?>
            <?= $this->Html->link(__('Back'), ['action' => 'index'],['class'=>'btn btn-secondary']); ?>
        </div>
        <h2><?= __('%singularHuman%') ?></h2>
    </div>
    <dl class="row">
    <RECORDBLOCK>
        <dt class="col-sm-3"><?= __('%fieldName%') ?></dt>
        <dd class="col-sm-9"><?= h($%singularName%->%field%) ?></dd>
    </RECORDBLOCK>
    </dl>  
   
</div>
%relatedLists%