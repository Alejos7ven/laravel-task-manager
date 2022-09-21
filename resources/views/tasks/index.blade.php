@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('tasks') }}" method="POST">
            @csrf

            @if (session('success'))
                <h6 class="alert alert-success">{{session('success')}}</h6>
            @endif
            @error('title')
                <h6 class="alert alert-danger">{{$message}}</h6>
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" > 
            </div> 
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>

        <div>
            @foreach ($todos as $todo)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('tasks-show',[$todo->id])}}">{{ $todo->title }}</a>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{ route('tasks-destroy', [$todo->id]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>

                
            @endforeach
        </div>
    </div>
@endsection