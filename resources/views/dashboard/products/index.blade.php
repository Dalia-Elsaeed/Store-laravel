@extends('layouts.dashboard')

@section('title', 'product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-outline-primary mr-2">Create</a>
    </div>
    <x-alert type="success" />
    <x-alert type="info" />
    <x-alert type="error" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4 ">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
         <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
        </select>

        <button type="submit" class="btn btn-dark mx-2">Filter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>category</th>
                <th>store</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="product Image" height="75"></td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name ?? 'None' }}</td>
                    <td>{{ $product->category->name?? 'None' }}</td>
                    <td>{{ $product->store->name?? 'None' }}</td>
                    <td>{{ $product->status ?? 'None' }}</td>
                    <td>{{ $product->created_at ? $product->created_at->format('Y-m-d') : 'None' }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>

                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No product Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $products->withQueryString()->links() }}
@endsection

