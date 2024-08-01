@extends('admin.layout.master')

@section('page-title')
    All Tags
@endsection

@section('main-content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-md-6">
            <a href="{{ route('tag.create') }}" class="btn btn-primary" data-toggle="tooltip" title="Create"><i class="fa fa-plus"></i>&nbsp;Add Tag</a>
        </div>
      </div>
      <h4 class="py-3 mb-0">
        Tag List
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
          @if($tags) 
          <table class="datatables-products table border-top table table-bordered">
            <thead style="background-color: #979af4;font-style:italic;">
              <tr>
                <th style="width: 3%;">#</th>
                <th class ="text-center">Name</th>
                <th class ="text-center">Action</th>
              </tr>
            </thead>
            <tbody class = "table-group-divider">
              @foreach($tags as $index=>$tag)
              <tr>
                <td>{{$index + 1}}</td>
                <td class="text-center">{{$tag->tag_name}}</td>
                <td class="text-center">
                  <a href="{{ route('tag.edit' , $tag->id) }}" class="btn btn-info btn-flat btn-sm"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('tag.delete' , $tag->id) }}" class="btn btn-danger btn-flat btn-sm singleDelete" onclick ="return confirm('Are You Sure..??')"><i class="fa fa-trash"></i></a>
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
