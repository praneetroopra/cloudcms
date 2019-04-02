@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!--main section-->
                <div class="container-fluid bg-success">
                  <div class="row">
                      <div class="col-md-4">
                      </div>
                      <div class="col-md-4">
                      <h2 class="text-white alternate-font text-center mt-5"><strong>Create Category</strong></h2>
                  <div class="p-4"></div>  
                  </div>
                  <div class="col-md-4"></div>
                  </div>
                </div>
                @if (session('status'))
                  <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                  </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <h1>Create category</h1>
    {!! Form::open(['action' => 'CategoriesController@store','id'=>'categoryForm']) !!}
        <div class="form-group">
            {{Form::label('name','Category Name')}}
            {{Form::text('name','',['class'=>'form-control'])}}
        </div>
        {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
    {!! Form::close() !!}
</div>



@endsection
