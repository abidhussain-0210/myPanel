@extends('admin.layout.master')

@section('page-title')
    Create Tag
@endsection

@section('main-content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h3>Create Tag</h3>
      <form name ="createTag" id="createTag" method ="POST" action="{{ route('tag.store') }}">
        @csrf
        <div class="col-md-12">
          <div class="row" @error('tag_name') has-error @enderror>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label for="" class="mb-2">Tag Name</label>
                  <input name="tag_name" id="tag_name" type="text" class="form-control" placeholder="Tag Name">
                  @error('tag_name')
                <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                @enderror
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="form-actions">
          @can('isAdmin')
          <button id="submit" class="btn btn-primary" style="background-color: #979af4;" type="submit"><i class="fa fa-save">&nbsp;&nbsp;</i> Save </button>
          @else
          <button id="submit" class="btn btn-primary disabled" style="background-color: #979af4;" type="submit"><i class="fa fa-save">&nbsp;&nbsp;</i> Save </button>
          @endcan
          &nbsp;&nbsp;<a href="{{ route('tag.index') }}" style="background-color: #979af4;" class="btn btn-primary" type="button"><i class="fa fa-times">&nbsp;&nbsp;</i> Cancel </a>
        </div>
      </form>
    </div>
  </div>
@endsection
