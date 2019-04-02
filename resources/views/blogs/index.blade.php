@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of your Posts</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   @foreach($blogs as $blog)
                      <h1><a href="/post/{{$blog->slug}}">{{$blog->title}}</a></h1>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
