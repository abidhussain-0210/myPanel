@extends('admin.layout.master')

@section('page-title')
    Edit Blog
@endsection

@section('main-content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<style>
  .hover-effect {
    transition: transform 0.2s ease, box-shadow 0.3s ease;
}

.hover-effect:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgb(150, 153, 242); 
}

</style>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h3>Edit Blog</h3>

      <form name="editBlog" id="editBlog" method="POST" action="{{ route('blog.update' , $blog->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="col-md-12">
          <div class="row" @error('blog_name') has-error @enderror>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label for="" class="mb-2">Blog Name</label>
                  <input name="blog_name" id="blog_name" type="text" value="{{ old('blog_name' , $blog->blog_name) }}" class="form-control" placeholder="Blog Name">
                  @error('blog_name')
                <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                @enderror
                </div>
              </div>
            </div>
          </div>
  
          <div class="row" @error('category_id') has-error @enderror>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label for="" class="mt-2 mb-2">Blog Category</label>
                  <select name="category_id" id="category_id" class="form-control">
                    <option value="none" {{ old('category_id' , $category->id ?? '') == 'none' ? 'selected' : '' }}>-- Select Category --</option>
                    @foreach( $categories as $category )
                    <option value="{{ $category->id }}" {{ old('category_id' , $category->id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                  </select>
                  @error('category_id')
                  <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>

          <div class="row" @error('tag_id') has-error @enderror>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label for="" class="mb-2 mt-2">Blog Tags</label><br>
                  <select name="tag_id" id="tag_id" class="form-control">
                     <option value="none" {{ old('tag_id', $blog->tag_id ?? '') == 'none' ? 'selected' : '' }}>-- Select Tags --</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ old('tag_id', $blog->tag_id ?? '') == $tag->id ? 'selected' : '' }}>{{ $tag->tag_name }}</option>
                    @endforeach
                    {{-- <option value="none" {{ old('tag_id') == 'none' ? 'selected' : '' }}>-- Select Tags --</option>
                    @foreach( $tags as $tag )
                    <option value="{{ $tag->id }}" {{ old('tag_id') == $tag->id ? 'selected' : '' }}>{{ $tag->tag_name }}</option>
                    @endforeach --}}
                  </select>
                  @error('tag_id')
                  <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>

          <div class="row" @error('description') has-error @enderror>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label for="" class="mb-2 mt-2">Description</label><br>
                  <textarea name="description" id="description" rows="8" class="form-control" placeholder="Descriptions">{{ old('description', $blog->description) }}</textarea>
                  @error('description')
                  <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <br>

          @if(isset($blog->image))
          <div class="mb-2">
              <img src="/uploads/{{ $blog->image }}" alt="Image" class ="img-thumbnail rounded hover-effect" id="showImage" width="100" style="border: 1px solid #343a40; padding:5px;">
          </div>
         @endif

          <div class="row" @error('image') has-error @enderror>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label for="" class="mb-2 mt-2">Upload Image</label><br>
                  <input type="file" name="image" id="user_image">
                  @error('image')
                  <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>

          <br>
            <div class="form-actions">
              <button id="submit" class="btn btn-primary" style="background-color: #979af4;" type="submit"><i class="fa fa-save">&nbsp;&nbsp;</i> Update </button>
              &nbsp;&nbsp;<a href="{{ route('blog.index') }}" style="background-color: #979af4;" class="btn btn-primary" type="button"><i class="fa fa-times">&nbsp;&nbsp;</i> Cancel </a>
            </div>
        </div>

      </form>
    </div>
    <script>
      document.getElementById('user_image').addEventListener('change', function(event) {
          const file = event.target.files[0]; // Get the selected file
          if (file) {
              const reader = new FileReader();
              
              // When the file is read, set the image source to the file's data URL
              reader.onload = function(e) {
                  document.getElementById('showImage').src = e.target.result;
                  //document.getElementById('showImage2').src = e.target.result;
              }
              
              // Read the file as a data URL
              reader.readAsDataURL(file);
          } else {
              // If no file is selected, revert to default image
              document.getElementById('showImage').src = '{{ url('uploads/no-img.jpg') }}';
              //document.getElementById('showImage2').src = '{{ url('uploads/no-img.jpg') }}';
          }
      });
  </script>
  </div>
@endsection