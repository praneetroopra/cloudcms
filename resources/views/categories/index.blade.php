@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h1>Your Categories</h1>
                   @foreach($categories as $category)
                      <h1><a href="/category/{{$category->id}}">{{$category->name}}</a></h1>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
