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

<div class="container mt-4">
    {{-- {!! Form::open(['method' => 'PUT','files'=>'true','id'=>'blogForm']) !!} --}}
    {{ Form::model($blog, array('route' => array('blogs.update', $blog->id),'files'=>'true' ,'method' => 'PUT')) }}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',$blog->title,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
                @foreach ($categories as $category)
    
                <label class="checkbox-inline">
            
                    <input type="checkbox" name="category[]" id="category_id_{{ $category->id }}" value="{{ $category->id }}"
            
                        @if ($ids = $blog->categories->pluck('id')->toArray())
            
                            @foreach ($ids as $category_id)
                                    
                                {{ $category->id == $category_id ? 'checked' : '' }}
                                
                            @endforeach
            
                        @endif
                    />
                        
                   {{ $category->name }}
            
                </label>
                
            @endforeach
        </div>
        <div class="form-group">
            {{Form::label('slug','Slug')}}
            {{Form::text('slug',$blog->slug,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {!!Form::label('headerImage','Header Image')!!}
           
            <input type="file" name="headerImage">
        </div>
        <div class="form-group">
            {{Form::label('body','Post Body')}}
            {{Form::textarea('body',$blog->body,['id'=>'article-ckeditor','class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {!!Form::label('galleryImages','Gallery Images')!!}
            <input type="file" name="galleryImages[]" multiple>
            
        </div>
        {{-- {{Form::hidden('_method','PUT')}} --}}
        {!!Form::submit('Update',['class'=>'btn btn-primary'])!!}
    {!! Form::close() !!}
</div>



@endsection
