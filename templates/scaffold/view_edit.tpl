<?php
/**
 * @var \App\Http\View\ApplicationView $this
 */
?>
<div class="page-header">
    <div class="float-right">
        <a href="/%controllerUnderscored%" class="btn btn-secondary" role="button"><?= __('Back') ?></a>
    </div>
    <h2><?= __('Edit %singularHuman%') ?></h2>
</div>
<div class="%singularName% form">
    <?= $this->Form->create($%singularName%); ?>
    <?php
        <RECORDBLOCK>
        echo $this->Form->control('%field%');
        </RECORDBLOCK>
        echo $this->Form->button(__('Save'), ['type'=>'submit','class' => 'btn btn-primary']);
        echo $this->Form->end();
    ?>
</div>