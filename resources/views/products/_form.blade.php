<div class="mb-3">
    <label class="form-label font-semibold text-gray-700">Nama Product</label>
    <input type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $product->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label font-semibold text-gray-700">Kategori</label>
    <input type="text"
        name="category"
        class="form-control @error('category') is-invalid @enderror"
        value="{{ old('category', $product->category ?? '') }}">
    @error('category')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label font-semibold text-gray-700">Deskripsi</label>
    <textarea name="description"
        class="form-control @error('description') is-invalid @enderror"
        rows="4">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label font-semibold text-gray-700">Harga</label>
            <input type="number"
                step="0.01"
                name="price"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $product->price ?? '') }}">
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label font-semibold text-gray-700">Stock</label>
            <input type="number"
                name="stock"
                class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock', $product->stock ?? 0) }}">
            @error('stock')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label font-semibold text-gray-700">Image</label>
    <input type="text"
        name="image"
        class="form-control @error('image') is-invalid @enderror"
        value="{{ old('image', $product->image ?? '') }}"
        placeholder="nama-file.jpg">
    @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-check mb-3">
    <input type="checkbox"
        name="is_active"
        value="1"
        class="form-check-input"
        id="is_active"
        {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label font-semibold text-gray-700" for="is_active">
        Product Aktif
    </label>
</div>
