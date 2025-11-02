@if ($errors->any())
    <div class="array alert-danger">
        <h1>ERROR!</h1>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group mb-3">
    <x-form.input label="Category Name" class="form-control-lg" role="input" name="name" :value="$category->name" />
</div>
    <label for="">Category Parent</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Description</label>
    <textarea name="description" class="form-control form-select">{{ old('description', $category->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />
    @if ($category->image)
        <td><img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" height="75"></td>
    @endif
</div>

<div class="form-group">
    <label for="Status"></label>
    <div>
        <x-form.radio name="status" :checked="$category->status" :options="['Active','inactive'=>'InActive']" />

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
</div>
