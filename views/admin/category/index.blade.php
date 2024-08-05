@extends('admin.layout.master')

@section('page-title')
    All Categories
@endsection

@section('main-content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-md-6">
          @can('isAdmin')
            <a href="{{ route('tag.create') }}" class="btn btn-primary" data-toggle="tooltip" title="Create"><i class="fa fa-plus"></i>&nbsp;Add Category</a>
            @else
            <a href="{{ route('tag.create') }}" class="btn btn-primary disabled" data-toggle="tooltip" title="Create"><i class="fa fa-plus"></i>&nbsp;Add Category</a>
          @endcan
        </div>
      </div>
      <h4 class="py-3 mb-0">
        Category List
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

      <div class="card">
        <div class="card-datatable table-responsive">
          @if($categories)    
          <table class="datatables-products table border-top table table-bordered">
            <thead style="background-color: #979af4;font-style:italic;">
              <tr>
                <th style="width: 3%;">#</th>
                <th class ="text-center">Name</th>
                <th class ="text-center">Action</th>
              </tr>
            </thead>
            <tbody class = "table-group-divider">
              @foreach($categories as $index => $category)
              <tr>
                <td>{{$index + 1}}</td>
                <td class="text-center">{{$category->name}}</td>
                <td class="text-center">
                  @can('isAdmin')
                  <a href="{{ route('category.edit' , $category->id) }}" class="btn btn-info btn-flat btn-sm"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('category.delete' , $category->id) }}" class="btn btn-danger btn-flat btn-sm singleDelete" onclick ="return confirm('Are You Sure..??')"><i class="fa fa-trash"></i></a>
                  @else
                  <a href="{{ route('category.edit' , $category->id) }}" class="btn btn-info btn-flat btn-sm disabled"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('category.delete' , $category->id) }}" class="btn btn-danger btn-flat btn-sm disabled singleDelete" onclick ="return confirm('Are You Sure..??')"><i class="fa fa-trash"></i></a>
                  @endcan
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @else
      <div class="alert alert-danger">No Record Found</div>
      @endif
    </div>
  </div>
@endsection
