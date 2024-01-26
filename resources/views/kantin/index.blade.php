@extends('template.temp_navbar')

@section('content')
@if(session('status'))
    <div class="toast toast-top toast-start">
        <div class="alert alert-success">
          <span>{{ session('status') }}</span>
        </div>
      </div>
    @endif

    <div class="modal" role="dialog" id="my_modal_crt">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Create Product</h3>
            <form method="post" enctype="multipart/form-data" action="/post-product" class="flex flex-col">
                @csrf
                <input class="input file-input-bordered" type="file" name="photo" required>
                <div class="flex gap-2">
                    <div class="flex flex-col gap-2">
                        <span>name</span>
                        <input class="input input-bordered" type="text" name="name" id="">
                    </div>
                    <div class="flex flex-col gap-2">
                        <span>stand</span>
                        <input class="input input-bordered" type="text" name="stand" id="">
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="flex flex-col gap-2">
                        <span>stock</span>
                        <input class="input input-bordered" type="number" name="stock" id="">
                    </div>
                    <div class="flex flex-col gap-2">
                        <span>price</span>
                        <input class="input input-bordered" type="number" name="price" id="">
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col gap-2">
                        <span>category</span>
                        <select name="categories_id" class="select select-bordered">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <span>description</span>
                        <textarea class="textarea textarea-bordered" name="description"></textarea>
                    </div>
                </div>
                <div class="flex justify-between">
                    <button type="submit" class="btn mt-2">Submit</button>
                    <a href="#" type="submit" class="btn mt-2">close</a>                                    </form>
                </div>
            </form>
        </div>
    </div>
    <div class="container mx-auto">
        <div class="flex flex-col p-3">
            <div class="border p-6">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-black">halo {{ Auth::user()->name }} ({{ Auth::user()->roles->name }})</span>
                    <a href="#my_modal_crt" class="btn btn-success">Create</a>
                </div>
            </div>

            <div class="overflow-x-auto border">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-lg">Name & Photo</th>
                            <th class="text-lg">Stand & Description</th>
                            <th class="text-lg">Stock</th>
                            <th class="text-center text-lg">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <div class="modal" role="dialog" id="my_modal_edt_{{ $product->id }}">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Edit Product</h3>
                                    <form method="post" enctype="multipart/form-data" action="/put-product/{{$product->id}}"
                                        class="flex flex-col">
                                        @csrf
                                        @method('PUT')
                                        <input class="input file-input-bordered" type="file" name="photo">
                                        <div class="flex gap-2">
                                            <div class="flex flex-col gap-2">
                                                <span>name</span>
                                                <input class="input input-bordered" type="text" name="name"
                                                    value="{{ $product->name }}">
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <span>stand</span>
                                                <input class="input input-bordered" type="text" name="stand"
                                                    value="{{ $product->stand }}">
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <div class="flex flex-col gap-2">
                                                <span>stock</span>
                                                <input class="input input-bordered" type="number" name="stock"
                                                    value="{{ $product->stock }}">
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <span>price</span>
                                                <input class="input input-bordered" type="number" name="price"
                                                    value="{{ $product->price }}">
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <div class="flex flex-col gap-2">
                                                <span>category</span>
                                                <select name="categories_id" class="select select-bordered">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @if ($category->id == $product->category->id) selected @endif>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <span>description</span>
                                                <textarea class="textarea textarea-bordered" name="description">{{ $product->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="flex justify-between">
                                            <button type="submit" class="btn mt-2">Submit</button>
                                            <a href="#" type="submit" class="btn mt-2">close</a>                                    </form>
                                        </div>
                                </div>
                            </div>

                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-20 h-w-20">
                                                <img src="{{ $product->photo }}" alt="none" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">{{ $product->name }} ({{ $product->category->name }})
                                            </div>
                                            <div class="text-sm opacity-50">Rp.{{ number_format($product->price) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $product->description }}
                                    <br />
                                    <span class="badge badge-ghost badge-sm">{{ $product->stand }}</span>
                                </td>
                                <td>{{ $product->stock }}</td>
                                <th>
                                    <div class="flex w-full justify-center gap-2">
                                        <a href="#my_modal_edt_{{ $product->id }}" class="btn btn-warning">Edit</a>
                                        <form action="/destroy-product/{{ $product->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error">Delete</button>
                                        </form>
                                    </div>

                                </th>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
