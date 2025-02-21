@extends('backend.layout')

@section('content')
 <div class="page-header">
    <h4 class="page-title">{{ __('Edit Plan') }}</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{ route('admin.dashboard') }}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Membership') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Edit Plan') }}</a>
      </li>
    </ul>
  </div>
  
 <section class="user-dashboard pt-130 pb-120">
    <div class="container">

       <div class="row">
        <div class="col-lg-12">
          <form  action="{{ route('admin.plans.update' , $id = $plan->id ) }}"
                enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Plan Name*') }}</label>
                      <input type="text"  class="form-control" name="name"
                        placeholder="{{ __('Enter Plan Name') }}" value="{{ $plan->name }}">
                        @error('name')
                            <p id="editErr_first_name" class="mt-1 mb-0 text-danger em">{{ $message  }}</p>
                        @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Validity*') }} (in days)</label>
                      <input type="number" class="form-control" name="validity"
                        placeholder="{{ __('Enter Plan Validity') }}" value="{{ $plan->validity }}">
                        @error('url')
                            <p id="editErr_last_name" class="mt-1 mb-0 text-danger em">{{ $message  }}</p>
                        @enderror
                    </div>
                  </div>
                   <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Price*') }}</label>
                      <input type="number" class="form-control" name="price"
                        placeholder="{{ __('Enter Plan Price') }}" value="{{ $plan->price }}">
                        @error('price')
                            <p id="editErr_last_name" class="mt-1 mb-0 text-danger em">{{ $message  }}</p>
                        @enderror
                    </div>
                  </div>
                  
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Level*') }}</label>
                      <input type="number" class="form-control" name="level"
                        value="{{ $plan->level }}">
                        @error('level')
                            <p id="editErr_last_name" class="mt-1 mb-0 text-danger em">{{ $message  }}</p>
                        @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Trial Days*') }}</label>
                      <input type="number" class="form-control" name="trial_days"
                        value="{{ $plan->trial_days }}">
                        @error('trial_days')
                            <p id="editErr_last_name" class="mt-1 mb-0 text-danger em">{{ $message  }}</p>
                        @enderror
                    </div>
                  </div>
                  
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Status*') }}</label>
                      <select class="form-control" name="status" required>
                          <option value="1" @if($plan->status == '1') selected @endif>Enable</option>
                          <option value="0" @if($plan->status == '0') selected @endif>Disable</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>{{ __('Description*') }}</label>
                       <textarea class="form-control" name="description"
                                  placeholder="{{ __('Enter Plan Description') }}" data-height="300">{{ $plan->description }}</textarea>
                        @error('description')
                            <p id="editErr_last_name" class="mt-1 mb-0 text-danger em">{{ $message  }}</p>
                        @enderror
                    </div>
                  </div>
                  
                </div>
                <br>
                <div class="d-flex justify-content-end w-100">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>

        </div>
      </div>
    </div>
  </section>

@endsection