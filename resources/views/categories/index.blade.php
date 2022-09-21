@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            @if (session('success'))
                <h6 class="alert alert-success">{{session('success')}}</h6>
            @endif
            @error('name')
                <h6 class="alert alert-danger">{{$message}}</h6>
            @enderror
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" > 
            </div> 
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="color" class="form-control" name="color" id="color" > 
            </div> 
            <button type="submit" class="btn btn-primary">Create</button>
        </form> 

        <div>
            @foreach ($categories as $category)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('categories.show',[$category->id])}}">
                            <span class="color-container" style="background-color: {{ $category->color }};"></span> {{ $category->name }}
                        </a>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $category->id }}">Delete</button>
                        
                    </div>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="modal-{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        You are going to delete the category {{ $category->name }} and all their tasks.
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form action="{{ route('categories.destroy', [$category->id]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>    
                        </div>
                    </div>
                    </div>
                </div>
                
            @endforeach
        </div>

    </div>
@endsection