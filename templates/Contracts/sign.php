<?= $this->Form->create(null) ?>
<canvas id="sig" width="400" height="200" style="border:1px solid #ccc"></canvas>
<?= $this->Form->hidden('signature', ['id' => 'signature-input']) ?>
<button type="button" id="clear">Clear</button>
<?= $this->Form->button('Submit') ?>
<?= $this->Form->end() ?>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script>
const pad = new SignaturePad(document.getElementById('sig'));
document.getElementById('clear').onclick = () => pad.clear();
document.querySelector('form').addEventListener('submit', () => {
  document.getElementById('signature-input').value = pad.isEmpty() ? '' : pad.toDataURL('image/png');
});
</script>