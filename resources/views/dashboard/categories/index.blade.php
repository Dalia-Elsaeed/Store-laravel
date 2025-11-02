@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-outline-primary mr-2">Create</a>
        <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-outline-dark">Trash</a>
    </div>
    <x-alert type="success" />
    <x-alert type="info" />
    <x-alert type="error" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4 ">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <select name="status"  value="request('status')" class="form-control mx-2" >
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="inactive"@selected(request('status') == 'inactive')>Inactive</option>
        </select>
        <button type="submit" class="btn btn-dark mx-2">Filter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Parent Name</th>
                <th>Num Products</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td><img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" height="75"></td>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('dashboard.categories.show',$category->id) }}">{{ $category->name ?? 'None' }}</a></td>
                    <td>{{ $category->parent->name ?? 'None' }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->status ?? 'None' }}</td>
                    <td>{{ $category->created_at ? $category->created_at->format('Y-m-d') : 'None' }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>

                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No Categories Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $categories->withQueryString()->appends(['Search' => 1 ])->links() }}
@endsection

