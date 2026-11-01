{{-- Komponen upload foto peralatan: kamera, galeri, atau file --}}
@php
    $currentImageUrl = $currentImageUrl ?? null;
    $currentImageName = $currentImageName ?? null;
@endphp

<div class="image-uploader">
    <div class="image-uploader-preview">
        <img
            id="equipmentImagePreview"
            src="{{ $currentImageUrl }}"
            data-current-src="{{ $currentImageUrl }}"
            alt="Equipment photo preview"
            style="{{ $currentImageUrl ? '' : 'display:none;' }}"
            onerror="this.style.display='none'; var ph=document.getElementById('equipmentImagePlaceholder'); if (ph) ph.style.display='';"
        >

        <div class="image-placeholder" id="equipmentImagePlaceholder" style="{{ $currentImageUrl ? 'display:none;' : '' }}">
            <span class="image-placeholder-icon">📷</span>
            <p><strong>No photo yet</strong></p>
            <p>Take a photo, pick from gallery, or choose a file.</p>
        </div>
    </div>

    <div class="image-uploader-body">
        <div class="image-uploader-options">
            <button type="button" class="image-option" data-target="imageInputCamera">
                <span class="image-option-icon">📷</span>
                Take Photo
            </button>

            <button type="button" class="image-option" data-target="imageInputGallery">
                <span class="image-option-icon">🖼️</span>
                From Gallery
            </button>

            <button type="button" class="image-option" data-target="imageInputFile">
                <span class="image-option-icon">📁</span>
                From File
            </button>
        </div>

        <p class="image-selected" id="equipmentImageName">
            @if ($currentImageName)
                Current: {{ $currentImageName }}
            @else
                No file selected.
            @endif
        </p>

        <div class="image-uploader-hint">
            JPG, JPEG, PNG, WEBP or GIF · Max. 2 MB · Optional
        </div>

        @error('image')
            <p class="field-error">{{ $message }}</p>
        @enderror

        @if ($currentImageUrl)
            <label class="image-remove-toggle">
                <input type="checkbox" name="remove_image" value="1" id="removeImageCheckbox">
                Remove current photo
            </label>
        @endif
    </div>

    {{-- Input utama yang dikirim ke server --}}
    <input type="file" name="image" id="imageInput" accept="image/*" class="image-input-hidden">

    {{-- Input pemilih: kamera, galeri, dan file --}}
    <input type="file" id="imageInputCamera" accept="image/*" capture="environment" class="image-input-hidden" tabindex="-1" aria-hidden="true">
    <input type="file" id="imageInputGallery" accept="image/*" class="image-input-hidden" tabindex="-1" aria-hidden="true">
    <input type="file" id="imageInputFile" accept="image/*" class="image-input-hidden" tabindex="-1" aria-hidden="true">
</div>

<script>
    (function () {
        var imageInput = document.getElementById('imageInput');
        var preview = document.getElementById('equipmentImagePreview');
        var placeholder = document.getElementById('equipmentImagePlaceholder');
        var nameEl = document.getElementById('equipmentImageName');
        var removeCheckbox = document.getElementById('removeImageCheckbox');

        var MAX_SIZE = 2 * 1024 * 1024; // 2 MB
        var ALLOWED = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'];
        var previewUrl = null;

        function showPreview(src) {
            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = null;
            }

            if (src) {
                preview.src = src;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            } else {
                preview.removeAttribute('src');
                preview.style.display = 'none';
                placeholder.style.display = '';
            }
        }

        function resetInput() {
            imageInput.value = '';
            showPreview(preview.getAttribute('data-current-src'));
            nameEl.textContent = 'No file selected.';
            if (removeCheckbox) removeCheckbox.checked = false;
        }

        function applyFile(file) {
            if (!file) return;

            if (ALLOWED.indexOf(file.type) === -1) {
                alert('Please choose an image file (JPG, JPEG, PNG, WEBP, or GIF).');
                resetInput();
                return;
            }

            if (file.size > MAX_SIZE) {
                alert('The image is too large. Maximum size is 2 MB.');
                resetInput();
                return;
            }

            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            imageInput.files = dataTransfer.files;

            previewUrl = URL.createObjectURL(file);
            showPreview(previewUrl);

            nameEl.textContent = 'Selected: ' + file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
            if (removeCheckbox) removeCheckbox.checked = false;
        }

        document.querySelectorAll('.image-option').forEach(function (button) {
            button.addEventListener('click', function () {
                var target = document.getElementById(button.getAttribute('data-target'));
                if (target) target.click();
            });
        });

        ['imageInputCamera', 'imageInputGallery', 'imageInputFile'].forEach(function (id) {
            var picker = document.getElementById(id);

            picker.addEventListener('change', function () {
                if (picker.files && picker.files.length) {
                    applyFile(picker.files[0]);
                }
                picker.value = '';
            });
        });

        imageInput.addEventListener('change', function () {
            if (imageInput.files && imageInput.files.length) {
                applyFile(imageInput.files[0]);
            }
        });

        if (removeCheckbox) {
            removeCheckbox.addEventListener('change', function () {
                if (removeCheckbox.checked) {
                    imageInput.value = '';
                    showPreview(null);
                    nameEl.textContent = 'This photo will be removed.';
                } else {
                    resetInput();
                }
            });
        }
    })();
</script>
