<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Blog;
use App\Category;
use App\PostGallery;
use App\Services\Slug;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blogs = Blog::orderBy('created_at','desc')->simplePaginate(10);
        return view('blogs.index')->with('blogs',$blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('blogs.createblog')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'category.*'=>'required',
            'body'=>'required',
            'headerImage'=>'image|max:8999',
            'galleryImages.*'=>'image|max:8999'
        ]);
        

        if($request->hasFile('headerImage')){
            //filename with extension
            $filenameWithExt = $request->file('headerImage')->getClientOriginalName();
            // filename
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // extension
            $extension = $request->file('headerImage')->getClientOriginalExtension();
            //storing file
            $fileNamesToStore = $filename.'_'.time().'.'.$extension;
            // uploading image
            $path = $request->file('headerImage')->storeAs('public/headerImage',$fileNamesToStore);
        }
        else{
            $fileNamesToStore='noimage.jpg';
        }
        //gallery images
      
        $slug = new Slug;
        $blog = new Blog();
        $blog->user_id = auth()->user()->id;
        $blog->title = $request->input('title');
        $blog->headerImage =  $fileNamesToStore;
        $blog->body = $request->input('body');
        // $blog->galleryImages = $fn;
        
        $blog->slug = $slug->createSlug($request->title);
        //return dd($blog);
        $blog->save();
        $blogId = $blog->id;
        // $user = auth()->user()->id;
       
        if($request->hasFile('galleryImages')){
            foreach($request->galleryImages as $galleryImage){ 
                //filename with extension
                $fileNameWithExt = $galleryImage->getClientOriginalName();
               
                // filename
                $fileName=pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // extension
                $extension = $galleryImage->getClientOriginalExtension();
                //storing file
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                // uploading image
                $path = $galleryImage->storeAs('public/galleryImage',$fileNameToStore);
                $gallery = new PostGallery();
                $gallery->blog_id = $blogId;
                $gallery->name = $fileNameToStore;
                $gallery->save();
           }

            
        }
        $categories = $request->category;
        // return dd($categories);
        
        $blog->categories()->attach($categories);
        return redirect('/post')->with('success','Post Created');
        //return 'Success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        
        // return dd($blog->galleries);
        
        return view('blogs.show')->with('blog',$blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
       // $blog = Blog::where('slug',$slug)->first();
        $blog = Blog::find($id);
        $categories = Category::all();
        // $categories = Category::with('blog')->get();
        
        // return view('blogs.edit')->with('blog',$blog);
        // return view('blogs.edit')->with(compact('blog','categories'));
        return view('blogs.edit', compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request,[
        //     'slug' => "min:5|max:255|unique:blogs,slug,$id",
            
        //     'headerImage'=>'image|max:8999',
        //     'galleryImages.*'=>'image|max:8999'
        // ]);
        

        $blog = Blog::findOrFail($id);
        $blogId = $blog->id;
        if($request->file('headerImage')){
            //filename with extension
            $filenameWithExt = $request->file('headerImage')->getClientOriginalName();
            // filename
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // extension
            $extension = $request->file('headerImage')->getClientOriginalExtension();
            //storing file
            $fileNamesToStore = $filename.'_'.time().'.'.$extension;
            // uploading image
            $path = $request->file('headerImage')->storeAs('public/headerImage',$fileNamesToStore);
            $oldImage = $blog->headerImage;
            Storage::disk('public')->delete('/headerImage//'.$oldImage);
            // Storage::delete($oldImage);
        }else{
            $fileNamesToStore=$blog->headerImage;
        }
        //galery image
        if($request->hasFile('galleryImages')){
            foreach($request->galleryImages as $galleryImage){ 
                //filename with extension
                $fileNameWithExt = $galleryImage->getClientOriginalName();
               
                // filename
                $fileName=pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // extension
                $extension = $galleryImage->getClientOriginalExtension();
                //storing file
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                // uploading image
                $path = $galleryImage->storeAs('public/galleryImage',$fileNameToStore);
                $gallery = new PostGallery();
                $gallery->blog_id = $blogId;
                $gallery->name = $fileNameToStore;
                $gallery->save();
           }

            
        }
        //end gallery image
        //$blog->user_id = $request->input('user_id');

        $blog->title = $request->input('title');
        
        $blog->headerImage =  $fileNamesToStore;
        $blog->body = $request->input('body');
        // // $blog->galleryImages = $newfn;
        // // return dd($blog->galleryImages);
        
        $blog->slug = $request->input('slug');
        // return dd($blog);
        $blog->save();

        $categories = $request->category;
       
        // if (! $blog->categories->contains($categories)) {
        //     $blog->categories()->attach($categories);
        // }
        $blog->categories()->sync($categories);
        // $blog->categories()->attach($categories);
        //return dd($request->all());
        return redirect('/post')->with('success','Post Updated');
        //return 'Success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        foreach($blog->galleries as $gallery)
        {
            //print_r($gallery->name);
           Storage::disk('public')->delete('/galleryImage//'.$gallery->name);
        }
        $oldImage = $blog->headerImage;
        Storage::disk('public')->delete('/headerImage//'.$oldImage);
        $blog->categories()->detach($blog->id);
        $blog->delete();
        return redirect('/post')->with('success','Post Deleted Successfully');
        // return dd($oldGalleryImage);
        // return 'deleted';
    }
}
