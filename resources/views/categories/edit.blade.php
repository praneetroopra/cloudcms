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
                      <h2 class="text-white alternate-font text-center mt-5"><strong>Edit Blog Post</strong></h2>
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
{{-- array('route' => array('blogs.update', $blog->id), --}}
<div class="container mt-4">
    {{-- {!! Form::open(['method' => 'PUT','files'=>'true','id'=>'blogForm']) !!} --}}
    {{ Form::model($category, array('route' => array('categories.update', $category->id),'method' => 'PUT')) }}
        <div class="form-group">
            {{Form::label('name','Category Name')}}
            {{Form::text('name',$category->name,['class'=>'form-control'])}}
        </div>
        {{-- {{Form::hidden('_method','PUT')}} --}}
        {!!Form::submit('Update',['class'=>'btn btn-primary'])!!}
    {!! Form::close() !!} 
</div>



@endsection
