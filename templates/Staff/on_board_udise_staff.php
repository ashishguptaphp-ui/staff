<div class="form-group form-control" style="padding:30px;">


<div class="container mt-4">
     <h1 style="text-align:center; font-size:30px; font-weight:700; color:#34495e; letter-spacing:1px;">
            📸 Staff Profile Photo — Upload Required
            </h1>

    <div class="row">
        <div class="col-md-6">
           
            <?= $this->Form->create(null, [
                'type' => 'file',
                'url' => ['controller' => 'School', 'action' => 'onBoardUdiseStaff',$staffId]
            ]); ?>

            <div class="form-group">
                <?= $this->Form->control('photo', [
                    'type' => 'file',
                    'label' => 'Upload Staff Profile Photo (JPG/PNG only)',
                    'accept' => 'image/jpeg,image/png',
                    'required' => true,
                    'id' => 'photoInput',
                    'class' => 'form-control'
                ]); ?>
            </div>
         </div>
        <div class="col-md-6">

            <!-- Image Preview Container -->
            <div class="form-group mt-3" id="imagePreviewContainer" style="display: none;">
                <label class="form-label">Image Preview:</label>
                <div class="border rounded p-3 text-center">
                    <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                    <div class="mt-2">
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">Remove Image</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>

<br>

<?= $this->Form->button('Submit', ['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const photoInput = document.getElementById('photoInput');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');

    photoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            // Check if file is an image
            if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                alert('Please select a valid image file (JPG or PNG only).');
                photoInput.value = '';
                return;
            }

            // Check file size (max 5MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size must be less than 5MB.');
                photoInput.value = '';
                return;
            }

            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreviewContainer.style.display = 'block';
                
                // Add loading state to image
                imagePreview.onload = function() {
                    console.log('Image loaded successfully');
                };
                
                imagePreview.onerror = function() {
                    //alert('Error loading image preview.');
                    imagePreviewContainer.style.display = 'none';
                };
            };
            
            reader.readAsDataURL(file);
        } else {
            imagePreviewContainer.style.display = 'none';
        }
    });
});

function removeImage() {
    document.getElementById('photoInput').value = '';
    document.getElementById('imagePreviewContainer').style.display = 'none';
    document.getElementById('imagePreview').src = '#';
}
</script>