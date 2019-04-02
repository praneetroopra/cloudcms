@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Single Blog</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <div>
                            {{-- header image --}}
                            <img src="{{asset('storage/headerImage/'.$blog->headerImage)}}"> 
                            <h1>Your Blog</h1>
                            <h3>{{$blog->title}}</h3>
                            <p>Categories:</p>
                            @foreach($blog->categories as $category)
                                <ul>
                                    <li>{{$category->name}}</li>
                                </ul>
                                
                            @endforeach
                            @foreach($blog->galleries as $gallery)
                                <img src="{{asset('storage/galleryImage/'.$gallery->name)}}"> 
                            @endforeach
                            <p>Created by <b>{{$blog->user->name}}</b> </p>
                        </div>
                        <hr>
                       
                            <a href="/post/{{$blog->id}}/edit" class="btn btn-info">Edit</a>
                            {!!Form::open(['action'=>['BlogsController@destroy',$blog->id],'class'=>'float-sm-right'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {!!Form::submit('Delete',['class'=>'btn btn-danger'])!!}
                            {!!Form::close()!!}
                        
                    </div>    
                  
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
