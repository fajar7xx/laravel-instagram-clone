@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle img-thumbnail img-fluid border-info rounded-lg" style="max-height: 150px;">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <span class="h3">{{ $user->username }}</span>
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
                @can('update', $user->profile)
                    <a href="{{ route('p.create') }}" class="btn btn-sm btn-outline-primary">Add New Post</a>
                @endcan
                
            </div>
            @can('update', $user->profile)
            <a href="{{ route('profile.edit', $user->id) }}" class="badge badge-primary mb-3">Edit Profile</a>
            @endcan
            
            <div class="d-flex">
                <div class="pr-5"><span class="font-weight-bolder">{{ $postCount }}</span> Posts</div>
                <div class="pr-5"><span class="font-weight-bolder">100k</span> Followers</div>
                <div class="pr-5"><span class="font-weight-bolder">1001</span> Following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div class="text-justify">{{ $user->profile->description }}</div>
            <div>
                <a href="{{ 'http://' . $user->profile->url }}">{{ $user->profile->url ?? 'N/A'}}</a>
            </div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach ($user->posts as $item)
        <div class="col-4 pb-4">
            <a href="{{ route('p.show', $item->id) }}">
                <img src="/storage/{{ $item->image }}" class="img-fluid w-100">
            </a>
        </div>
        @endforeach
</div>
@endsection
