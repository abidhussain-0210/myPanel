@extends('admin.layout.master')

@section('page-title')
  Account Setting
@endsection

@section('main-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
      <span class="fw-bold">Account Settings</span>
    </h4>
    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
          <li class="nav-item"><a class="nav-link" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
        </ul>
        <div class="card mb-4">
          @can('isAdmin')
          <h5 class="card-header">Admin Profile Details</h5>
          @else
          <h5 class="card-header">User Profile Details</h5>
          @endcan
          <!-- Account -->
          
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              <img src="/uploads/{{ Auth::user()->image }}" alt="user-avatar" id="showImage1" class="d-block rounded" height="100" width="100" style="border:1px solid #000;padding:3px"/>
              <div class="button-wrapper ms-0">
                <label for="image" class="me-2 mb-0 text-muted fs-2" tabindex="0">
                  @can('isAdmin')
                  <span class="d-none d-sm-block">Admin Image</span>
                  @else
                  <span class="d-none d-sm-block">User Image</span>
                  @endcan
                   <i class="bx bx-upload d-block d-sm-none"></i>
                </label>
                <p class="text-muted mb-1">Allowed JPG, GIF or PNG. Max size of 800K</p>
              </div>
            </div>
          </div>
        
          <hr class="my-0">
          <div class="card-body">
    
    
            <form id="UserProfileForm" name="UserProfileForm" method = "POST" action = "{{ route('profile.update') }}" enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="row">
                <div class="mb-3 col-md-6" @error('first_name') has-error @enderror>
                  <label for="first_name" class="form-label">First Name</label>
                  <input class="form-control" type="text" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name' , Auth::user()->first_name) }}"/>
                  @error('first_name')
                   <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
    
                <div class="mb-3 col-md-6" @error('last_name') has-error @enderror>
                  <label for="last_name" class="form-label">Last Name</label>
                  <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name' , Auth::user()->last_name) }}"/>
                  @error('last_name')
                   <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
    
                <div class="mb-3 col-md-6" @error('email') has-error @enderror>
                  <label for="email" class="form-label">E-mail</label>
                  <input class="form-control" type="text" id="email" name="email" placeholder="example@gmail.com" value="{{ old('email' , Auth::user()->email) }}"/>
                  @error('email')
                   <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
    
                <div class="mb-3 col-md-6" @error('phone_number') has-error @enderror>
                  <label class="form-label" for="phone_number">Phone Number</label>
                  <div class="input-group input-group-merge">
                    <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="1111 1234567" value="{{ old('phone_number' , Auth::user()->phone_number) }}"/>
                  </div>
                  @error('phone_number')
                   <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
    
                <div class="mb-3 col-md-6" @error('address') has-error @enderror>
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address' , Auth::user()->address) }}" />
                  @error('address')
                   <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
    
                <div class="mb-3 col-md-6" @error('state') has-error @enderror>
                  <label for="state" class="form-label">State</label>
                  <input class="form-control" type="text" id="state" name="state" placeholder="State" value="{{ old('state' ,Auth::user()->state) }}"/>
                  @error('state')
                   <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
    
                <div class="mb-3 col-md-6" @error('country') has-error @enderror>
                  <label class="form-label" for="country">Country</label>
                  <select id="country" name="country" class="select2 form-select">
                    <option value="none" {{ (old('country', Auth::user()->country) == 'none') ? 'selected' : '' }}>Select</option>
                    <option value="Australia" {{ (old('country', Auth::user()->country) == 'Australia') ? 'selected' : '' }}>Australia</option>
                    <option value="India" {{ (old('country', Auth::user()->country) == 'India') ? 'selected' : '' }}>India</option>
                    <option value="Pakistan" {{ (old('country', Auth::user()->country) == 'Pakistan') ? 'selected' : '' }}>Pakistan</option>
                    <option value="America" {{ (old('country', Auth::user()->country) == 'America') ? 'selected' : '' }}>America</option>
                  </select>
                  @error('country')
                   <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
    
                <div class="mb-3 col-md-6" @error('language') has-error @enderror>
                  <label for="language" class="form-label">Language</label>
                  <select id="language" name="language" class="select2 form-select">
                    <option value="none" {{ old('language' , Auth::user()->language) == 'none' ? 'selected' : '' }}>Select Language</option>
                    <option value="English" {{ old('language' , Auth::user()->language) == 'English' ? 'selected' : '' }}>English</option>
                    <option value="Urdu" {{ old('language' , Auth::user()->language) == 'Urdu' ? 'selected' : '' }}>Urdu</option>
                    <option value="French" {{ old('language' , Auth::user()->language) == 'French' ? 'selected' : '' }}>French</option>
                    <option value="German" {{ old('language' , Auth::user()->language) == 'German' ? 'selected' : '' }}>German</option>
                    <option value="Portuguese" {{ old('language' , Auth::user()->language) == 'Portuguese' ? 'selected' : '' }}>Portuguese</option>
                  </select>
                  @error('language')
                   <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>
    
                <div class="mb-3 col-md-6" @error('image') has-error @enderror>
                  <label for="image" class="form-label">Upload Image</label>
                  <input class="form-control" type="file" id="user_image" name="image" value="{{ old('image' , Auth::user()->image) }}"/>
                  @error('image')
                   <div style="color:red;text-transform: capitalize;font-size: 10px;">{{ $message }}</div>
                  @enderror
                </div>

                {{-- <div class="form-group">
                  <img src="{{ url('uploads/no-img.jpg') }}" id="showImage2" width="100" height="100" class="rounded" alt="No Image Found">  
                </div> --}}
              </div>
              <br>
              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                <button type="reset" class="btn btn-label-secondary">Cancel</button>
              </div>
            </form>
          </div>
          <!-- /Account -->
        </div>
      </div>
    </div>
        
    </div>
    <script>
      document.getElementById('user_image').addEventListener('change', function(event) {
          const file = event.target.files[0]; // Get the selected file
          if (file) {
              const reader = new FileReader();
              
              // When the file is read, set the image source to the file's data URL
              reader.onload = function(e) {
                  document.getElementById('showImage1').src = e.target.result;
                  document.getElementById('showImage2').src = e.target.result;
              }
              
              // Read the file as a data URL
              reader.readAsDataURL(file);
          } else {
              // If no file is selected, revert to default image
              document.getElementById('showImage1').src = '{{ url('uploads/no-img.jpg') }}';
              document.getElementById('showImage2').src = '{{ url('uploads/no-img.jpg') }}';
          }
      });
  </script>
  </div>

@endsection
