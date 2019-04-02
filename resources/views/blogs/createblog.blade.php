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
                      <h2 class="text-white alternate-font text-center mt-5"><strong>Create Blog Post</strong></h2>
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
    {!! Form::open(['action' => 'BlogsController@store','files'=>'true','id'=>'blogForm']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            @if(count($categories) > 1)
                @foreach($categories as $category)
                <div class="checkbox-inline">
              {{ Form::checkbox('category[]',$category->id) }}
                  <label>
                     {{ $category->name }}
                  </label>
                </div>
              @endforeach
            @else
              <h1 style="color:red;">Please Create a category</h1>
            @endif 
        </div>
        <div class="form-group">
            {!!Form::label('headerImage','Header Image')!!}
            <input type="file" name="headerImage">
        </div>
        <div class="form-group">
            {{Form::label('body','Post Body')}}
            {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {!!Form::label('galleryImages','Gallery Images')!!}
            <input type="file" name="galleryImages[]" multiple>
        </div>
        {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
    {!! Form::close() !!}
</div>



@endsection
