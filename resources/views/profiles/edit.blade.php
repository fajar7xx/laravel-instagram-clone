@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">
            <h1>Edit Profile</h1>
            <hr>
    
            <form action="{{ route('profile.update', $user->profile->id) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
    
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" 
                        name="title" id="title" 
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ $user->profile->title }}"
                        >
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" @error('description') is-invalid @enderror>{{ $user->profile->description }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">url</label>
                    <input type="text" 
                        name="url" id="url" 
                        class="form-control @error('url') is-invalid @enderror"
                        value="{{ $user->profile->url }}"
                        >
                    @error('url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">image</label>
                    <input type="file" 
                        name="image" id="image" 
                        class="form-control-file @error('image') is-invalid @enderror"
                        value="{{ $user->image }}"
                        >
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
