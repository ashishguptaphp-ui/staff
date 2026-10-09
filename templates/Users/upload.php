<?= $this->Form->create(null, ['type' => 'file']) ?>
<?= $this->Form->control('document', ['type' => 'file', 'required' => true]) ?>
<?= $this->Form->button('Upload') ?>
<?= $this->Form->end() ?>
