@extends('admin.layout.master')

@section('page-title')
    Edit Category
@endsection

@section('main-content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">
        <span>Add Category</span>
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
      
      <form name="updateCategory" id="updateCategory" method ="POST" action="{{ route('category.update' , $category->id) }}">
        @csrf
        @method('put')
        <div class="col-md-12">
          <div class="row" @error('name') has-error @enderror>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label for="" class="mb-2">Category Name</label>
                  <input name="name" id="name" type="text" value="{{ old('name' ,  $category->name) }}" class="form-control" placeholder="Category Name">
                  @error('name')
                <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                @enderror
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="form-actions">
          <button id="submit" class="btn btn-primary" style="background-color: #979af4;" type="submit"><i class="fa fa-save">&nbsp;&nbsp;</i> Update </button>
          &nbsp;&nbsp;<a href="{{ route('category.index') }}" style="background-color: #979af4;" class="btn btn-primary" type="button"><i class="fa fa-times">&nbsp;&nbsp;</i> Cancel </a>
        </div>
      </form>
    </div>
  </div>
@endsection
