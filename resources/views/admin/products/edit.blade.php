@extends('admin.layouts.app')

@section('title', 'Sửa: ' . $product->name . ' | Admin ATELIER')
@section('page-title', 'Chỉnh sửa sản phẩm')
@section('breadcrumb', 'Admin / Sản phẩm / Chỉnh sửa')

@section('actions')
    <a href="{{ route('admin.products.index') }}" class="admin-btn admin-btn-ghost">
        <span class="material-symbols-outlined">arrow_back</span>
        Quay lại
    </a>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.products.update', $product) }}" class="admin-form-grid">
        @csrf
        @method('PUT')

        {{-- Left Column: Main Info --}}
        <div class="admin-form-main">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Thông tin sản phẩm</h2>
                    <span class="admin-card-id">ID: #{{ $product->id }}</span>
                </div>
                <div class="admin-card-body">
                    <div class="admin-form-group">
                        <label class="admin-label" for="name">Tên sản phẩm <span class="required">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="admin-input @error('name') admin-input-error @enderror" required/>
                        @error('name')
                            <span class="admin-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label" for="description">Mô tả</label>
                        <textarea name="description" id="description" rows="5" class="admin-textarea @error('description') admin-input-error @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <span class="admin-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-row">
                        <div class="admin-form-group">
                            <label class="admin-label" for="price">Giá (USD) <span class="required">*</span></label>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" class="admin-input @error('price') admin-input-error @enderror" required/>
                            @error('price')
                                <span class="admin-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="admin-form-group">
                            <label class="admin-label" for="stock">Số lượng tồn kho <span class="required">*</span></label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0" class="admin-input @error('stock') admin-input-error @enderror" required/>
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
                        <input type="url" name="image" id="image" value="{{ old('image', $product->image) }}" class="admin-input @error('image') admin-input-error @enderror" required/>
                        @error('image')
                            <span class="admin-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-row">
                        <div class="admin-form-group">
                            <label class="admin-label" for="image2">URL Ảnh phụ 1</label>
                            <input type="url" name="image2" id="image2" value="{{ old('image2', $product->image2) }}" class="admin-input"/>
                        </div>
                        <div class="admin-form-group">
                            <label class="admin-label" for="image3">URL Ảnh phụ 2</label>
                            <input type="url" name="image3" id="image3" value="{{ old('image3', $product->image3) }}" class="admin-input"/>
                        </div>
                    </div>

                    {{-- Current Image Preview --}}
                    <div class="admin-image-preview" id="image-preview-area">
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}"/>
                        @endif
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
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="admin-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label" for="color">Màu sắc</label>
                        <input type="text" name="color" id="color" value="{{ old('color', $product->color) }}" class="admin-input"/>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label" for="size_options">Kích cỡ</label>
                        <input type="text" name="size_options" id="size_options" value="{{ old('size_options', is_array($product->size_options) ? implode(', ', $product->size_options) : $product->size_options) }}" class="admin-input" placeholder="S, M, L, XL"/>
                        <span class="admin-hint">Nhập các size cách nhau bằng dấu phẩy</span>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-toggle-label">
                            <input type="hidden" name="is_featured" value="0"/>
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="admin-toggle-input"/>
                            <span class="admin-toggle-switch"></span>
                            <span>Sản phẩm nổi bật</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Info --}}
            <div class="admin-card">
                <div class="admin-card-body admin-meta-info">
                    <div class="admin-meta-row">
                        <span>Slug:</span>
                        <span class="admin-meta-value">{{ $product->slug }}</span>
                    </div>
                    <div class="admin-meta-row">
                        <span>Tạo lúc:</span>
                        <span class="admin-meta-value">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="admin-meta-row">
                        <span>Cập nhật:</span>
                        <span class="admin-meta-value">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="admin-card">
                <div class="admin-card-body" style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <button type="submit" class="admin-btn admin-btn-primary admin-btn-full">
                        <span class="material-symbols-outlined">save</span>
                        Lưu thay đổi
                    </button>
                </div>
            </div>

            {{-- Delete --}}
            <div class="admin-card admin-card-danger">
                <div class="admin-card-body">
                    <h3 class="admin-danger-title">Xóa sản phẩm</h3>
                    <p class="admin-danger-text">Hành động này không thể hoàn tác.</p>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin-btn admin-btn-danger admin-btn-full">
                            <span class="material-symbols-outlined">delete_forever</span>
                            Xóa sản phẩm
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    const imageInput = document.getElementById('image');
    const previewArea = document.getElementById('image-preview-area');
    if (imageInput && previewArea) {
        imageInput.addEventListener('input', function() {
            const url = this.value;
            if (url) {
                previewArea.innerHTML = `<img src="${url}" alt="Preview" onerror="this.parentElement.innerHTML='<p class=admin-preview-placeholder><span class=material-symbols-outlined>broken_image</span> URL ảnh không hợp lệ</p>'"/>`;
            }
        });
    }
</script>
@endpush
