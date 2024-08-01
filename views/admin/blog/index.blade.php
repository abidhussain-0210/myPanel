@extends('admin.layout.master')

@section('page-title')
    All Blogs
@endsection

@section('main-content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      
      <div class="row">
        <div class="col-md-6">
            <a href="{{ route('blog.create') }}" class="btn btn-primary" data-toggle="tooltip" title="Create"><i class="fa fa-plus"></i>&nbsp;Add Blog</a>
        </div>
      </div>
      <h4 class="py-3 mb-0">
        Blogs List
      </h4>

      <div class="row">
        <div class="col-md-6">
          @if(session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
        </div>
      </div>

      <!--Start Table-->
        <div class="card">
          <div class="card-datatable table-responsive">
            @if($blogs)
            <table class="datatables-products table border-top table table-bordered">
              <thead style="background-color: #979af4;font-style:italic;">
                <tr>
                  <th style="width: 3%;">#</th>
                  <th class ="text-center">Blog Title</th>
                  <th class ="text-center">Category</th>
                  <th class ="text-center">Tags</th>
                  <th class ="text-center">Description</th>
                  <th class ="text-center">Image</th>
                  <th class ="text-center">status</th>
                  <th class ="text-center">actions</th>
                </tr>
              </thead>
              <tbody class = "table-group-divider">
                @foreach($blogs as $index => $blog)
                <tr>
                  <td>{{$index + 1}}</td>
                  <td>{{$blog->blog_name}}</td>
                  <td>{{$blog->category_id}}</td>
                  <td>{{$blog->tag_id}}</td>
                  <td>{{$blog->description}}</td>
                  <td> 
                    @if($blog->image == "No Image Found")
                    <img src="/uploads/no-img.jpg" class="img-thumbnail rounded" style="border: 1px solid #343a40; padding:3px;" alt="Image">
                    @else
                    <img src="/uploads/{{ $blog->image }}" class="img-thumbnail rounded" style="border: 1px solid #343a40; padding:3px;" alt="Image">
                    @endif
                  </td>
                  <td class="text-center">
                     @if($blog->status == 1)
                      <a href="{{ route('blog.status' , $blog->id) }}"><i class="fa-regular fa-thumbs-up"></i></a>
                      @else
                      <a href="{{ route('blog.status' , $blog->id) }}"><i class="fa-regular fa-thumbs-down"></i></a>
                      @endif
                  </td>
                  <td>
                    <a href="{{ route('blog.edit' , $blog->id) }}" class="btn btn-info btn-flat btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('blog.delete' , $blog->id) }}" class="btn btn-danger btn-flat btn-sm singleDelete" onclick ="return confirm('Are You Sure..??')"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="text-center mt-4">
          {{ $blogs->links() }}
        </div>
      <!--End Table-->
      @else
      <div class="alert alert-danger">No Record Found</div>
      @endif
    </div>
  </div>
@endsection