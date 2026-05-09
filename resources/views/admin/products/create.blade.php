@extends('admin.layouts.app')

@section('title', 'Thêm sản phẩm | Admin ATELIER')
@section('page-title', 'Thêm sản phẩm mới')
@section('breadcrumb', 'Admin / Sản phẩm / Thêm mới')

@section('actions')
    <a href="{{ route('admin.products.index') }}" class="admin-btn admin-btn-ghost">
        <span class="material-symbols-outlined">arrow_back</span>
        Quay lại
    </a>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.products.store') }}" class="admin-form-grid">
        @csrf

        {{-- Left Column: Main Info --}}
        <div class="admin-form-main">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Thông tin sản phẩm</h2>
                </div>
                <div class="admin-card-body">
                    <div class="admin-form-group">
                        <label class="admin-label" for="name">Tên sản phẩm <span class="required">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="admin-input @error('name') admin-input-error @enderror" placeholder="Ví dụ: Silk Wrap Blazer" required/>
                        @error('name')
                            <span class="admin-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label" for="description">Mô tả</label>
                        <textarea name="description" id="description" rows="5" class="admin-textarea @error('description') admin-input-error @enderror" placeholder="Mô tả chi tiết về sản phẩm...">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="admin-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-row">
                        <div class="admin-form-group">
                            <label class="admin-label" for="price">Giá (USD) <span class="required">*</span></label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" class="admin-input @error('price') admin-input-error @enderror" placeholder="0.00" required/>
                            @error('price')
                                <span class="admin-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-label" for="stock">Số lượng tồn kho <span class="required">*</span></label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0" class="admin-input @error('stock') admin-input-error @enderror" required/>
                            @error('stock')
                                <span class="admin-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Images --}}
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Hình ảnh</h2>
                </div>
                <div class="admin-card-body">
                    <div class="admin-form-group">
                        <label class="admin-label" for="image">URL Ảnh chính <span class="required">*</span></label>
                        <input type="url" name="image" id="image" value="{{ old('image') }}" class="admin-input @error('image') admin-input-error @enderror" placeholder="https://example.com/image.jpg" required/>
                        @error('image')
                            <span class="admin-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-row">
                        <div class="admin-form-group">
                            <label class="admin-label" for="image2">URL Ảnh phụ 1</label>
                            <input type="url" name="image2" id="image2" value="{{ old('image2') }}" class="admin-input" placeholder="https://..."/>
                        </div>
                        <div class="admin-form-group">
                            <label class="admin-label" for="image3">URL Ảnh phụ 2</label>
                            <input type="url" name="image3" id="image3" value="{{ old('image3') }}" class="admin-input" placeholder="https://..."/>
                        </div>
                    </div>

                    {{-- Preview --}}
                    <div class="admin-image-preview" id="image-preview-area">
                        <p class="admin-preview-placeholder">
                            <span class="material-symbols-outlined">image</span>
                            Nhập URL để xem trước ảnh
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Side Info --}}
        <div class="admin-form-side">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Phân loại</h2>
                </div>
                <div class="admin-card-body">
                    <div class="admin-form-group">
                        <label class="admin-label" for="category_id">Danh mục <span class="required">*</span></label>
                        <select name="category_id" id="category_id" class="admin-select-full @error('category_id') admin-input-error @enderror" required>
                            <option value="">— Chọn danh mục —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="admin-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label" for="color">Màu sắc</label>
                        <input type="text" name="color" id="color" value="{{ old('color') }}" class="admin-input" placeholder="Ví dụ: Đen, Trắng"/>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label" for="size_options">Kích cỡ</label>
                        <input type="text" name="size_options" id="size_options" value="{{ old('size_options') }}" class="admin-input" placeholder="S, M, L, XL (phân cách bằng dấu phẩy)"/>
                        <span class="admin-hint">Nhập các size cách nhau bằng dấu phẩy</span>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-toggle-label">
                            <input type="hidden" name="is_featured" value="0"/>
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="admin-toggle-input"/>
                            <span class="admin-toggle-switch"></span>
                            <span>Sản phẩm nổi bật</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="admin-card">
                <div class="admin-card-body">
                    <button type="submit" class="admin-btn admin-btn-primary admin-btn-full">
                        <span class="material-symbols-outlined">add_circle</span>
                        Tạo sản phẩm
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    // Image preview
    const imageInput = document.getElementById('image');
    const previewArea = document.getElementById('image-preview-area');
    if (imageInput && previewArea) {
        imageInput.addEventListener('input', function() {
            const url = this.value;
            if (url) {
                previewArea.innerHTML = `<img src="${url}" alt="Preview" onerror="this.parentElement.innerHTML='<p class=admin-preview-placeholder><span class=material-symbols-outlined>broken_image</span> URL ảnh không hợp lệ</p>'"/>`;
            } else {
                previewArea.innerHTML = '<p class="admin-preview-placeholder"><span class="material-symbols-outlined">image</span> Nhập URL để xem trước ảnh</p>';
            }
        });
        // Trigger on load if old value
        if (imageInput.value) imageInput.dispatchEvent(new Event('input'));
    }
</script>
@endpush
