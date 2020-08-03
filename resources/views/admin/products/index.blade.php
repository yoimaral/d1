@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex float-right my-3">
        <a href="{{route('products.create')}}" type="button" class="btn btn-info">Crear un nuevo
            producto</a>
    </div>

    <table class="table table-dark">
        <thead>
            <tr>
                <td>
                    <form action="{{route('products.index')}}" method="GET" class="form-inline float-right"
                        pull="right">
                        <input name="product" type="search" class="form-control ds-input border-info" id="search-input"
                            placeholder="Search..." aria-label="Search for..." autocomplete="off"
                            data-docs-version="4.5" spellcheck="false" role="combobox" aria-autocomplete="list"
                            aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto"
                            style="position: relative; vertical-align: top;">
                    </form>
                </td>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Imagen</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>
                    <div class="product-image">
                        @if (substr($product->img, 0, 5) == 'https')
                        <img src="{{$product->img}}" alt="">
                        @else
                        <img src="/storage/{{$product->img}}" alt="">
                        @endif
                    </div>
                </td>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>${{$product->price}} USD</td>
                <td>
                    @if ($product->disabled_at)
                    Disabled {{$product->disabled_at->diffForHumans()}}
                    @else
                    Enabled
                    @endif
                </td>
                <td>
                    <form action="{{route('products.destroy' , $product)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        @if (Auth::user()->is_admin)
                        <button href="" value="Delete" class="btn btn-outline-secondary" type="submit"
                            id="button-addon2">Delete</button>
                        @endif
                    </form>
                </td>
            </tr>
            @empty
            No hay productos
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>

</div>

@endsection