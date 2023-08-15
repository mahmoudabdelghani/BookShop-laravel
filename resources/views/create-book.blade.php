@extends('layouts.app')

@section('content')
    <div class="container p-4" >
        <h1 class="mb-4">Add New Book</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="mt-2">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Price</label>
                <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price') }}">
            </div>
            <div class="form-group">
            <label for="exampleInputSelect">Category</label>
                <select name="category" class="form-select" aria-label="Default select example" value="{{ old('category') }}">
                    <option disabled selected>Choose a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <select name="tags[]" id="tags" class="form-control" multiple>
                    <option disabled selected>Choose tags</option>
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="formFile">Image</label>
                <input class="form-control" name="pic" type="file" id="formFile">
            </div>
            <div class="form-group">
                <label for="exampleInputText">Description</label>
                <textarea class="form-control" name="description" name="description" cols="30" rows="5" >{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </form>
    </div>
    @endsection
