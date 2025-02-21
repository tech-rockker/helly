@extends('backend.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Add Lead') }}</h4>
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
        <a href="#">{{ __('Add Lead') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title">{{ __('Add Lead') }}</div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <form id="ajaxEditForm" action="{{ route('admin.vendor_management.save-lead') }}" method="post">
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
                      <input type="tel" value="" class="form-control" name="phone">
                      <p id="editErr_phone" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="agcd-additional-contacts agcd-repeater">

                    </div>
                    <div class="agcd-repeater-dummy" style="display:none;">
                        <div class="agcd-repeater-item">
                            <span class="agcd-remove-item">Remove</span>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" data-group="additional_contacts" data-name="email" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" data-group="additional_contacts" data-name="phone" class="form-control">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fax No</label>
                                        <input type="text" data-group="additional_contacts" data-name="fax_no" class="form-control" placeholder="Enter Fax No">
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <label>{{ __('Name*') }}</label>
                                <input type="text" value="" class="form-control"
                                  name="{{ $language->code }}_name" placeholder="{{ __('Enter Name') }}">
                                <p id="editErr_{{ $language->code }}_name" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label>{{ __('Shop Name*') }}</label>
                                <input type="text" value="" class="form-control"
                                  name="{{ $language->code }}_shop_name" placeholder="{{ __('Enter Shop Name') }}">
                                <p id="editErr_{{ $language->code }}_shop_name" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
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
                                  name="{{ $language->code }}_zip_code" placeholder="{{ __('Enter Zip Code') }}">
                                <p id="editErr_{{ $language->code }}_zip_code" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label>{{ __('Address') }}</label>
                                <textarea name="{{ $language->code }}_address" class="form-control" placeholder="{{ __('Enter Address') }}"></textarea>
                                <p id="editErr_{{ $language->code }}_email" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label>{{ __('Details') }}</label>
                                <textarea name="{{ $language->code }}_details" class="form-control" rows="5"
                                  placeholder="{{ __('Enter Details') }}"></textarea>
                                <p id="editErr_{{ $language->code }}_details" class="mt-1 mb-0 text-danger em"></p>
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
        
        $('input[name="phone"]').attr('id','phone_helper')
        var input__ = document.querySelector("#phone_helper");
        $("#phone_helper").after('<input type="hidden" name="phone" id="phone">');
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
        refresh_repeater_c();
    });
    

    $(document).ready(function(){
        
        $('.agcd-repeater').after('<button type="button" class="btn btn-primary btn-sm agcd-add-repeater-item">Add More Contact</button>');
        
        $(document).on('click', '.agcd-add-repeater-item', function(){
            var repeater_item = $('.agcd-repeater-dummy').html();
            $('.agcd-repeater').append(repeater_item);
            agcd_reset_repeater_keys();

            refresh_repeater_c();
        });

        $(document).on('click','.agcd-remove-item', function(){
            $(this).parent().remove();
            agcd_reset_repeater_keys();
            refresh_repeater_c();
        });

        function agcd_reset_repeater_keys(){
            var i = 0;
            $('.agcd-additional-contacts .agcd-repeater-item').each(function(){
                $(this).find('input').each(function(){
                    $(this).attr('name',$(this).attr('data-group')+'['+i+']['+$(this).attr('data-name')+']');
                });

                i++;
            });
        }
    });
    
    function refresh_repeater_c(){
        $('input[data-name="phone_full"]').remove();
        $('.agcd-additional-contacts input[data-group="additional_contacts"][data-name="phone"]').each(function(index){
            
            $(this).attr('id','additional_contact_phone_'+index);
           
            $(this).after('<input id="additional_contact_phone_full_'+index+'" type="hidden" data-group="additional_contacts" data-name="phone_full" name="additional_contacts['+index+'][phone_full]" class="form-control">');
             var iti = window.intlTelInput(this, {
                separateDialCode: true,
            });
            var fullNumber = iti.getNumber();
            $("#additional_contact_phone_full_"+index).val(fullNumber);
            
            $("#additional_contact_phone_"+index).on('change countrychange', function() {
                console.log('dhhda');
                var fullNumber = iti.getNumber();
                $("#additional_contact_phone_full_"+index).val(fullNumber);
            });
        });
    }
</script>
@endsection
