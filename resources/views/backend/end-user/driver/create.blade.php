@extends('backend.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Add Driver') }}</h4>
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
        <a href="#">{{ __('Vendor Management') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Add Driver') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title">{{ __('Add Driver') }}</div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <form id="ajaxEditForm" action="{{ route('admin.vendor_management.save-driver') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">{{ __('Photo') }}</label>
                      <br>
                      <div class="thumb-preview">
                        <img src="{{ asset('assets/img/noimage.jpg') }}" alt="..." class="uploaded-img">
                      </div>
                      <div class="mt-3">
                        <div role="button" class="btn btn-primary btn-sm upload-btn">
                          {{ __('Choose Photo') }}
                          <input type="file" class="img-input" name="photo">
                        </div>
                        <p id="editErr_photo" class="mt-1 mb-0 text-danger em"></p>
                      </div>
                    </div>
                  </div>
                
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('First Name*') }}</label>
                      <input type="text" value="" class="form-control" name="first_name"
                        placeholder="{{ __('Enter First Name') }}">
                      <p id="editErr_first_name" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Last Name*') }}</label>
                      <input type="text" value="" class="form-control" name="last_name"
                        placeholder="{{ __('Enter Last Name') }}">
                      <p id="editErr_last_name" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Username*') }}</label>
                      <input type="text" value="" class="form-control" name="username"
                        placeholder="{{ __('Enter Username') }}">
                      <p id="editErr_username" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Password *') }}</label>
                      <input type="password" value="" class="form-control" name="password"
                        placeholder="{{ __('Enter Password') }} ">
                      <p id="editErr_password" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Email*') }}</label>
                      <input type="text" value="" class="form-control" name="email"
                        placeholder="{{ __('Enter Email') }}">
                      <p id="editErr_email" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Phone') }}</label>
                      <input type="tel" value="" class="form-control" name="contact_number">
                      <p id="editErr_phone" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Vendor') }}</label>
                      <select class="form-control" name="vendor_id">
                        <option value="">Select Vendor</option>
                        <?php if( !empty($vendors)){ ?>
                            <?php foreach($vendors as $vendor){ ?>
                                <option value="<?php echo $vendor['id']; ?>"><?php echo $vendor['username']; ?></option>
                            <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                </div>
                <div id="accordion" class="mt-5">
                  @foreach ($languages as $language)
                    <div class="version">
                      <div class="version-header" id="heading{{ $language->id }}">
                        <h5 class="mb-0">
                          <button type="button"
                            class="btn btn-link {{ $language->direction == 1 ? 'rtl text-right' : '' }}"
                            data-toggle="collapse" data-target="#collapse{{ $language->id }}"
                            aria-expanded="{{ $language->is_default == 1 ? 'true' : 'false' }}"
                            aria-controls="collapse{{ $language->id }}">
                            {{ $language->name . __(' Language') }} {{ $language->is_default == 1 ? '(Default)' : '' }}
                          </button>
                        </h5>
                      </div>

                      <div id="collapse{{ $language->id }}"
                        class="collapse {{ $language->is_default == 1 ? 'show' : '' }}"
                        aria-labelledby="heading{{ $language->id }}" data-parent="#accordion">
                        <div class="version-body">
                          <div class="row">
                            
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label>{{ __('Country') }}</label>
                                <input type="text" value="" class="form-control"
                                  name="{{ $language->code }}_country" placeholder="{{ __('Enter Country') }}">
                                <p id="editErr_{{ $language->code }}_country" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label>{{ __('City') }}</label>
                                <input type="text" value="" class="form-control"
                                  name="{{ $language->code }}_city" placeholder="{{ __('Enter City') }}">
                                <p id="editErr_{{ $language->code }}_city" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label>{{ __('State') }}</label>
                                <input type="text" value="" class="form-control" name="{{ $language->code }}_state"
                                  placeholder="{{ __('Enter State') }}">
                                <p id="editErr_{{ $language->code }}_state" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label>{{ __('Zip Code') }}</label>
                                <input type="text" value="" class="form-control"
                                  name="{{ $language->code }}_zipcode" placeholder="{{ __('Enter Zip Code') }}">
                                <p id="editErr_{{ $language->code }}_zipcode" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label>{{ __('Address') }}</label>
                                <textarea name="{{ $language->code }}_address" class="form-control" placeholder="{{ __('Enter Address') }}"></textarea>
                                <p id="editErr_{{ $language->code }}_email" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              @php $currLang = $language; @endphp

                              @foreach ($languages as $language)
                                @continue($language->id == $currLang->id)

                                <div class="form-check py-0">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"
                                      onchange="cloneInput('collapse{{ $currLang->id }}', 'collapse{{ $language->id }}', event)">
                                    <span class="form-check-sign">{{ __('Clone for') }} <strong
                                        class="text-capitalize text-secondary">{{ $language->name }}</strong>
                                      {{ __('language') }}</span>
                                  </label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="updateBtn" class="btn btn-success">
                {{ __('Update') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
     $(document).ready(function(){
        
        $('input[name="contact_number"]').attr('id','phone_helper')
        var input__ = document.querySelector("#phone_helper");
        $("#phone_helper").after('<input type="hidden" name="contact_number" id="phone">');
        $("#phone_helper").attr('name','');
        var iti = window.intlTelInput(input__, {
            separateDialCode: true,
        });
        var fullNumber = iti.getNumber();
        $("#phone").val(fullNumber);
        $("#phone_helper").on('change countrychange', function() {
            var fullNumber = iti.getNumber();
            $("#phone").val(fullNumber);
        });
        
    });
</script>
@endsection
