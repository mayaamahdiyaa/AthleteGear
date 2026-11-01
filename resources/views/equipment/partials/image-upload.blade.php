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
            <span class="image-placeholder-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 8.5A1.5 1.5 0 0 1 5.5 7h2L9 5h6l1.5 2h2A1.5 1.5 0 0 1 20 8.5v9A1.5 1.5 0 0 1 18.5 19h-13A1.5 1.5 0 0 1 4 17.5z"/>
                    <circle cx="12" cy="12.5" r="3.2"/>
                </svg>
            </span>
            <p><strong>No photo yet</strong></p>
            <p>Take a photo, pick from gallery, or choose a file.</p>
        </div>
    </div>

    <div class="image-uploader-body">
        <div class="image-uploader-options">
            <button type="button" class="image-option" data-target="imageInputCamera">
                <svg class="image-option-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 8.5A1.5 1.5 0 0 1 5.5 7h2L9 5h6l1.5 2h2A1.5 1.5 0 0 1 20 8.5v9A1.5 1.5 0 0 1 18.5 19h-13A1.5 1.5 0 0 1 4 17.5z"/>
                    <circle cx="12" cy="12.5" r="3.2"/>
                </svg>
                Take Photo
            </button>

            <button type="button" class="image-option" data-target="imageInputGallery">
                <svg class="image-option-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="4" y="5" width="16" height="14" rx="2"/>
                    <circle cx="9" cy="10" r="1.5"/>
                    <path d="M5 17l4.5-4.5 3 3L16 12l3.5 3.5"/>
                </svg>
                From Gallery
            </button>

            <button type="button" class="image-option" data-target="imageInputFile">
                <svg class="image-option-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 7a2 2 0 0 1 2-2h3.6l2 2H18a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/>
                </svg>
                From File
            </button>
        </div>

        <p class="image-selected" id="equipmentImageName"
           data-current-name="{{ $currentImageName ? 'Current: ' . $currentImageName : '' }}">
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
            // Kembalikan label sesuai kondisi awal: nama foto lama bila ada.
            nameEl.textContent = nameEl.getAttribute('data-current-name') || 'No file selected.';
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
