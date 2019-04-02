@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Single Category</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <div>
                            <h1>Your Category</h1>
                            <h3>{{$category->name}}</h3>
                        </div>
                        <hr>
                       
                            <a href="/category/{{$category->id}}/edit" class="btn btn-info">Edit</a>
                            {!!Form::open(['action'=>['CategoriesController@destroy',$category->id],'class'=>'float-sm-right'])!!}
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
