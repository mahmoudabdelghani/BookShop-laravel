@extends('layouts.app')

@section('content')
<div class="container mt-4 p-4">
    <h1 class="mb-4">Edit Book</h1>

    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $book->title }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Price</label>
            <input type="number" class="form-control" name="price" value="{{ $book->price }}">
        </div>
        <div class="form-group">
            <label for="exampleInputSelect">Category</label>
            <select name="category" class="form-select" aria-label="Default select example">
                <option disabled selected>Choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $book->category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <select name="tags[]" id="tags" class="form-control" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $book->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="formFile">Image</label>
            <input class="form-control" name="pic" type="file" id="formFile">
        </div>
        <div class="form-group">
            <label for="exampleInputText">Description</label>
            <textarea class="form-control" name="description" cols="30" rows="5">{{ $book->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </form>
</div>
@endsection
