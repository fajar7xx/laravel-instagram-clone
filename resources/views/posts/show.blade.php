@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="img-fluid w-100">
        </div>
        <div class="col-4">
            <div class="d-flex align-items-center">
                <div class="pr-3">
                    <img src="{{ $post->user->profile->profileImage() }}" class="img-fluid w-100 rounded-circle" style="max-width: 36px;">
                </div>
                <div class="d-flex align-items-center">
                    <h3>
                        <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-body">{{ $post->user->username }}</a>
                    </h3>
                    <a href="#" class="pl-3">Follow</a>
                </div>
            </div>
            <hr>
            <p class="text-justify"> 
                <a href="{{ route('profile.show', $post->user->id) }}" class="font-weight-bolder text-decoration-none text-body">{{ $post->user->username }}</a> 
                {{ $post->caption }}
            </p>
        </div>
    </div>
</div>
@endsection
