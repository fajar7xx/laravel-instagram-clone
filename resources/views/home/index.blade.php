@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $item)
    <div class="row">
        <div class="col-6 offset-3">
            <a href="{{ route('p.show', $item->id) }}">
                <img src="/storage/{{ $item->image }}" class="img-fluid w-100">
            </a>
        </div>
    </div>
    <div class="row pt-2 pb-4">
        <div class="col-6 offset-3">
            {{-- <a href="{{ route('profile.show', $item->user->id) }}" class="text-decoration-none text-body">{{ $item->user->username }}</a> --}}
            <p class="text-justify"> 
                <a href="{{ route('profile.show', $item->user->id) }}" class="font-weight-bolder text-decoration-none text-body">{{ $item->user->username }}</a> 
                {{ $item->caption }}
            </p>
        </div>
    </div>
    @endforeach
    <div class="row col-12 d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
