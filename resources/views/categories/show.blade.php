@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('categories.update', [$categories->id]) }}" method="POST">
            @method('PATCH')
            @csrf

            @if (session('success'))
                <h6 class="alert alert-success">{{session('success')}}</h6>
            @endif
            @error('name')
                <h6 class="alert alert-danger">{{$message}}</h6>
            @enderror
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $categories->name }}"> 
            </div> 
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="color" class="form-control" name="color" id="color" value="#{{ $categories->color }}"> 
            </div> 
            <button type="submit" class="btn btn-primary">Update</button>
        </form> 

        <div>
            @if ($categories->todos->count() > 0)
                @foreach ($categories->todos as $todo)
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
            @else 

            No tasks yet.
            @endif
        </div>

    </div>
@endsection