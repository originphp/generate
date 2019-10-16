<div class="%pluralName% related">
    <div>
        <div class="float-right">
            <?= $this->Html->link(__('Add'), ['controller' => '%controller%','action' => 'add'],['class'=>'btn btn-secondary']); ?>
        </div>
        <h4><?= __('%pluralHuman%') ?></h4>
    </div>
    
    <?php if (!empty($%currentModel%->%pluralName%)): ?>
    <table class="table">
        <tr>
           
            <RECORDBLOCK>
            <th><?= __('%field%') ?></th>
            </RECORDBLOCK>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($%currentModel%->%pluralName% as $%singularName%): ?>
        <tr>

             <RECORDBLOCK>
            <td><?= h($%singularName%->%field%) ?></td>
            </RECORDBLOCK>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => '%controller%', 'action' => 'view', $%singularName%->id]) ?>
                |
                <?= $this->Html->link(__('Edit'), ['controller' => '%controller%', 'action' => 'edit', $%singularName%->id]) ?>
                |
                <?= $this->Form->postLink(__('Del'), ['controller' => '%controller%', 'action' => 'delete', $%singularName%->id], ['confirm' => __('Are you sure you want to delete # {id}?', ['id'=>$%singularName%->%primaryKey%])]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>