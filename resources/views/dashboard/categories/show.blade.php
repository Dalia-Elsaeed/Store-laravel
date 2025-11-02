@extends('layouts.dashboard')

@section('title', $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

@section('content')
    @php
        $products = $category->products()->with('store')->paginate(5);
    @endphp

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Store</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" height="75">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $product->name ?? 'None' }}</td>
                    <td>{{ $product->status ?? 'None' }}</td>
                    <td>{{ $product->created_at->format('Y-m-d') ?? 'None' }}</td>
                    <td>{{ $product->store->name ?? 'No Store' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Products Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
