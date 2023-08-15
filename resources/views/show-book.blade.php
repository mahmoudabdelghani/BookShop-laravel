@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title pt-2">{{ $book->title }}</h2>
                </div>
                <div class="card-body text-center">
                    <ul class="list-group">
                        <li class="list-group-item">
                            @if($book->pic)
                            <img src="{{ asset('storage/books/') ."/". $book->pic}}" alt="Book Image"
                                class="mx-auto d-block img">
                            @else
                            No image available
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Price:</strong> ${{ $book->price }}</li>
                        <li class="list-group-item"><strong>Description:</strong> {{ $book->description }}</li>
                        <li class="list-group-item"><strong>Category:</strong> {{ $book->category->name }}</li>
                        <li class="list-group-item"><strong>Tags:</strong>
                            @forelse ($book->tags as $tag)
                            <span class="badge bg-secondary">{{ $tag->name }}</span>
                            @empty
                            No tags available
                            @endforelse
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="{{ route('books.index') }}" class="btn btn-primary">Back to Books</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
