@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            
            <h1>Add New Post</h1>

            <form action="{{ route('p.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="caption">Caption</label>
                    <textarea name="caption" id="caption" 
                        cols="30" rows="10" 
                        class="form-control @error('caption') is-invalid @enderror"
                        autocomplete="off" autofocus>{{ old('caption') }}</textarea>
                    @error('caption')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Post Image</label>
                    <input type="file" 
                        name="image" id="image"
                        class="form-control-file @error('image') is-invalid @enderror" 
                        aria-describedby="image"
                        autocomplete="off" autofocus>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group pt-2">
                    <button type="submit" class="btn btn-primary btn-block">Add New Post</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
