@extends('backend.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Create Bookings') }}</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{ route('vendor.dashboard') }}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Equipment Booking') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Create Bookings') }}</a>
      </li>
    </ul>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">{{ __('Create Bookings') }}</div>
          <a class="btn btn-info btn-sm float-right d-inline-block"
            href="{{ route('admin.equipment_booking.bookings', ['language' => $defaultLang->code]) }}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            {{ __('Back') }}
          </a>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="alert alert-danger pb-1 dis-none" id="equipmentErrors">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul></ul>
              </div>
              
              <form action="{{ route('admin.equipment_booking.store') }}" method="POST"  enctype="multipart/form-data" >
                @csrf
                <div class="row">
                
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Select Customer*') }}</label>
                      <select name="user_id" id="select2_cus" class="form-control select2" required>
                          <option selected disabled>Select Customer</option>
                          @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->username }}</option>
                          @endforeach
                      </select>
                      <p id="editErr_first_name" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
 
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Select Equipment*') }}</label>
                      
                       <select name="equipment_id" id="equipment_id" class="form-control select2" required>
                          <option selected disabled>Select Equipment</option>
                         @foreach($equipments as $equipment)
                            <option value="{{ $equipment->id }}">{{ $equipment->content[0]->title }}</option>
                          @endforeach
                      </select>
                      <p id="editErr_last_name" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  
                  <div id="company_details" class="d-none col-lg-12">
                      <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label>{{ __('Company Name*') }}</label>
                              <input type="text" class="form-control" id="company_name" 
                                placeholder="{{ __('Compamy Name') }}" readonly>
                              <input type="text" class="form-control" id="company_id" readonly hidden name="company_id">
                              <p id="editErr_username" class="mt-1 mb-0 text-danger em"></p>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label>{{ __('Branches*') }}</label>
                              <div id="branches_select">
                                  
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Location*') }}</label>
                      <input type="text" class="form-control" name="delivery_location" id="location_eq" required
                        placeholder="{{ __('Location') }}">
                        <input type="hidden" name="lat" id="location_eq_lat">
                        <input type="hidden" name="long" id="location_eq_long">
                      <p id="editErr_username" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Booking Date *') }}</label>
                    <input type="text" id="date-range-eq" placeholder="{{ __('Select Booking Date') }}"
                    name="dates" value="" readonly class="form-control" required>
                      <p id="editErr_password" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Full Name *') }}</label>
                      <input type="text" value="" class="form-control" name="name" required
                        placeholder="{{ __('Full Name') }} ">
                      <p id="editErr_password_confirmation" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Contact Number*') }}</label>
                      <input type="tel" value="" class="form-control" name="contact_number"
                        placeholder="{{ __('Contact Number') }}" required>
                      <p id="editErr_email" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ __('Email Address') }}</label>
                      <input type="email" placeholder="{{ __('Email Address') }}" value="" class="form-control" name="email" required>
                      <p id="editErr_phone" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                            <div class="input-wrap mb-3">
                                 <label>Live Load</label>
                                  <select id="live_load" name="live_load" class="form-control" required>
                                      <option selected disabled>Select Live load</option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                      
                                </select>
                            </div>
                        </div>
                        <br/>
                    <div class="form-group">
                       <input type="checkbox" value="Yes" name="is_emergency" class="form-checkbox" id="is_emergency">
                        <label for="is_emergency">Emergency</label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Placement Instructions</label>
                      <textarea id="placement_instructions" name="placement_instructions" class="form-control"></textarea>
                      <p id="editErr_phone" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                     <label>Type of waste</label>
                      <select id="customer_punchoutlist" name="customer_punchoutlist" class="form-control">
                          <option value="">Select</option>
                          <option value="House Hold Debris">House Hold Debris</option>
                          <option value="Construction Debris">Construction Debris</option>
                          <option value="Mattress">Mattress</option>
                          <option value="Furniture">Furniture</option>
                          <option value="Concrete">Concrete</option>
                          <option value="Appliances">Appliances</option>
                      </select>
                      <p id="editErr_phone" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div  class="col-lg-6">
                       @if ((count($onlineGateways) > 0 || count($offlineGateways) > 0))
                        <div class="form_group">
                          <select name="gateway" class="form-control" id="gateway">
                            <!--<option disabled>{{ __('Select Payment Gateway') }}</option>-->
    
                            @if (count($onlineGateways) > 0)
                              @foreach ($onlineGateways as $onlineGateway)
                                <option value="{{ $onlineGateway->keyword }}"
                                  {{ $onlineGateway->keyword == old('gateway') || $onlineGateway->keyword == 'stax' ? 'selected' : '' }}>
                                  {{ __($onlineGateway->name) }}
                                </option>
                              @endforeach
                            @endif
    
                            @if (count($offlineGateways) > 0)
                              @foreach ($offlineGateways as $offlineGateway)
                                <option value="{{ $offlineGateway->id }}"
                                  {{ $offlineGateway->id == old('gateway') ? 'selected' : '' }}>
                                  {{ __($offlineGateway->name) }}
                                </option>
                              @endforeach
                            @endif
                          </select>
    
                          @php
                            $stripeExist = false;
    
                            if (count($onlineGateways) > 0) {
                                foreach ($onlineGateways as $onlineGateway) {
                                    if ($onlineGateway->keyword == 'stripe') {
                                        $stripeExist = true;
                                        break;
                                    }
                                }
                            }
                          @endphp
    
                            <div class="d-none mt-3" id="stripe-card-input"
                              class="mt-4 @if (
                                  $errors->has('card_number') ||
                                      $errors->has('cvc_number') ||
                                      $errors->has('expiry_month') ||
                                      $errors->has('expiry_year')) d-block @else d-none @endif">
                              <div class="input-wrap">
                                <input type="text" name="card_number" placeholder="{{ __('Enter Your Card Number') }}"
                                  autocomplete="off" oninput="checkCard(this.value)" class="form-control">
                                <p class="mt-1 text-danger" id="card-error"></p>
    
                                @error('card_number')
                                  <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                              </div>
    
                              <div class="input-wrap mt-3">
                                <input type="text" name="cvc_number" placeholder="{{ __('Enter CVC Number') }}"
                                  autocomplete="off" oninput="checkCVC(this.value)" class="form-control">
                                <p class="mt-1 text-danger" id="cvc-error"></p>
    
                                @error('cvc_number')
                                  <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                              </div>
    
                              <div class="input-wrap mt-3">
                                <input type="text" name="expiry_month" placeholder="{{ __('Enter Expiry Month') }}"  class="form-control">
    
                                @error('expiry_month')
                                  <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                              </div>
    
                              <div class="input-wrap mt-3">
                                <input type="text" name="expiry_year" placeholder="{{ __('Enter Expiry Year') }}"  class="form-control">
    
                                @error('expiry_year')
                                  <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                              </div>
                            </div>
    
                          @foreach ($offlineGateways as $offlineGateway)
                            <div id="{{ 'offline-gateway-' . $offlineGateway->id }}"
                              class="offline-gateway-info @if (
                                  $errors->has('attachment') &&
                                      request()->session()->get('gatewayId') == $offlineGateway->id) d-block @else d-none @endif">
                              @if ($offlineGateway->has_attachment == 1)
                                <div class="input-wrap mt-3">
                                  <label>{{ __('Attachment') . '*' }}</label>
                                  <br>
                                  <input type="file" name="attachment" id="offline-gateway-attachment">
    
                                  @error('attachment')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                  @enderror
                                </div>
                              @endif
    
                              @if (!is_null($offlineGateway->short_description))
                                <div class="input-wrap mt-3">
                                  <label>{{ __('Description') }}</label>
                                  <p>{{ $offlineGateway->short_description }}</p>
                                </div>
                              @endif
    
                              @if (!is_null($offlineGateway->instructions))
                                <div class="input-wrap mt-3">
                                  <label>{{ __('Instructions') }}</label>
                                  <p>{!! replaceBaseUrl($offlineGateway->instructions, 'summernote') !!}</p>
                                </div>
                              @endif
                            </div>
                          @endforeach
                        </div>
                        <div class="input-wrap" style="display: inline-flex;">
                              <input type="checkbox" id="accept-terms-and-condition" name="accept_terms_conditions" value="1" required>
                                <!--data-toggle="modal" data-target="#helly-terms-popup" -->
                                <p class="ml-2 mb-0 mt-2">I accept <a target="_blank" href="{{ url('/terms-and-conditions') }}" class="text-primary" id="terms-and-condition-popup">Terms & Conditions</a></p>
                             
                              @error('accept_terms_conditions')
                                <p class="text-danger mt-1">{{ $message }}</p>
                              @enderror
                            </div>
                      @endif
                      <br><br>
                      <label><strong>Selected Card</strong></label>
                      <input class="form-control" id="card_name" readonly>
                  </div>
                  <div class="col-lg-6">
                      <div class="price-option-table mt-4">
                      <ul>
                        <li class="single-price-option ag-additional-next-item">
                          <span class="title">{{ __('Discount') }} <span class="text-success">(<i
                                class="fas fa-minus"></i>)</span> <span class="amount"
                              dir="ltr"><span id="discount-amount"
                                dir="ltr">0.00</span></span></span>
                        </li>

                        <li class="single-price-option">
                          <span class="title">{{ __('Subtotal') }} <span class="amount"
                              dir="ltr"><span id="subtotal-amount"
                                dir="ltr"></span></span></span>
                        </li>

                        <li class="single-price-option">
                          <span class="title">{{ __('Tax') }}
                            <span dir="ltr"></span>
                            <span class="text-danger">(<i class="fas fa-plus"></i>)</span> <span class="amount"
                              dir="ltr"><span id="tax-amount"
                                dir="ltr"></span></span></span>
                        </li>

                          <li class="single-price-option">
                            <span class="title">{{ __('Security Deposit Amount') }} <span class="text-danger">(<i
                                  class="fas fa-plus"></i>)</span>
                              <span class="amount" dir="ltr" id="security_deposit_amount"><span
                                  dir="ltr"></span></span></span><br>
                            <span class="text-warning lh-normal">
                              <small>{{ __('This amount will be refunded, once the equipment is returned to Vendor safely') }}</small>
                            </span>
                          </li>


                        <li class="single-price-option">
                          <span class="title">{{ __('Grand Total') }} <span class="amount"
                              dir="ltr"><span id="grand-total"
                                dir="ltr"></span></span></span>
                        </li>
                      </ul>
                    </div>
                  </div>
                
                </div>
                <input id="card_id" hidden name="card_id">
                <button type="submit" class="btn btn-success">
                {{ __('Save') }}
              </button>
                <button type="button" class="btn btn-success" id="get_cards" >
                {{ __('Make Payment by Customer Card') }}
              </button>
                </form>
             

            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="card_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customer Cards List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Card Number</th>
                        <th>CVV</th>
                        <th>Expiry Month</th>
                        <th>Expiry Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody id="card_list_body">
                    
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  
  @section('script')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  <script>
  $(document).ready(function(){
      $(document).on('change','#select2_cus',function(){
          const user_id = $(this).val();
          $.ajax({
              type:"GET",
              url:"{{ route('admin.equipment_booking.get_user_data') }}",
              data:{id:user_id},
              success:function(response){
                //   const data = JSON.parse(response);
                if(response.company)
                {
                    $('#company_details').removeClass('d-none');
                    $('#company_name').val(response.company.name);
                    $('#company_id').val(response.company.id);
                };
                if(response.branches)
                {
                    $('#company_details').removeClass('d-none');
                    var html = "";
                    html += "<select name='branch_id' class='form-control'>";
                    response.branches.forEach((item)=>{
                        html += "<option value='"+ item.id +"'>"+ item.name +"</option>";
                    });
                    html += "</select>";
                    $('#branches_select').html(html);
                }
                
              },
              
          });
      });
      
        $(document).on('click', '#get_cards', function() {
            const user_id = $('#select2_cus').val();
            if (user_id != null) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.equipment_booking.get_cards') }}",
                    data: { id: user_id },
                    success: function(response) {
                        var html = "";
                        response.forEach((item) => {
                            html +='<tr>' ;
                            html +='<td>'+ item.first_name +'</td>' ;
                            html +='<td>'+ item.last_name +'</td>' ;
                            html +='<td>'+ item.card_number +'</td>' ;
                            html +='<td>'+ item.cvv +'</td>' ;
                            html +='<td>'+ item.exp_month +'</td>' ;
                            html +='<td>'+ item.exp_year +'</td>' ;
                            html +='<td><input type="radio" name="card_data" data-name="'+item.first_name+' '+item.last_name +'" class="select_card" value="'+ item.id +'" id="card_'+ item.id +'" hidden> <label for="card_'+ item.id +'" class=" text-white btn btn-primary">Select</label></td>' ;
                            html +='</tr>' ;
                        });
                        
                        $('#card_list_body').html(html);
                        $('#card_list').modal('show');
                    }
                });
            } else {
                alert('Please select Customer');
            }
        });
        $(document).on('change','.select_card',function(){
            const id = $(this).val();
            if($(this).prop('checked',true))
            {
                $('#card_id').val(id);
                $('#card_name').val($(this).data('name'));
                $(this).parent().find('label').removeClass('btn-primary');
                $(this).parent().find('label').addClass('btn-success');
                $(this).parent().find('label').text('Selected');
                $('#card_list').modal('hide');
                
            }else{
                $('#card_id').val('');
                $(this).parent().find('label').removeClass('btn-success');
                $(this).parent().find('label').addClass('btn-primary');
                $(this).parent().find('label').text('Select');
            }
        });
  });
  

  
  $('#gateway').change(function(){
        let gateway = $(this).val();
        if(gateway == "stripe")
        {
            $('#stripe-card-input').removeClass('d-none');
        }
        else{
            $('#stripe-card-input').addClass('d-none');
        }
    });
    var searchInput = 'location_eq';
    let baseURL = "{{ url('/') }}";
    let tax = $('#tax-amount').text();
    let security_deposit_amount = $('#security_deposit_amount').text();
    let equipmentId = "";
    $('#equipment_id').change(function(){
        equipmentId = $(this).val();
        
      $.ajax({
            type: "GET",
            url: "{{ route('admin.equipment_booking.get_equipment') }}",
            contentType: "application/json",
            data:{id:equipmentId},
            success: function(response) {
                $('#tax-amount').text(response.symbol+ " "+response.tax);
                $('#security_deposit_amount').text(response.symbol+ " "+response.details.security_deposit_amount);
            }
        });


    });
    let options = { minimumFractionDigits: 2, maximumFractionDigits: 2 };


    $(document).ready(function () {
        var autocomplete;
        autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
            types: ['geocode'],
        });
        
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var near_place = autocomplete.getPlace();
            document.getElementById('location_eq_lat').value = near_place.geometry.location.lat();
            document.getElementById('location_eq_long').value = near_place.geometry.location.lng();
            
            $('#location_field').change();
        });
    });
    $(function() {
  $('#date-range-eq').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});


$(document).on('change', '#extra_services, #type_of_rental, #live_load, #is_emergency, #location_field', function(){
     // get the difference of two dates, date should be in 'YYYY-MM-DD' format
    let dates = $('#date-range-eq').val();
    $('.ag-eq-booking-addtional-lineitem').remove();
    // get the minimum price
      let url = `${baseURL}/equipment/${equipmentId}/min-price`;
      
      // code by AG start
        // location data
        var location__ = '';
        var lat__ = '';
        var long__ = '';
        
            location__ = $('#location_eq').val();
            lat__ = $('#location_eq_lat').val();
            long__ = $('#location_eq_long').val();
        
        
        // for temporary toilet
        var extra_services = 0;
        var type_of_rental = '';
        if($('#extra_services').length > 0){
            extra_services = $('#extra_services').val();
        }
        
        if($('#type_of_rental').length > 0){
            type_of_rental = $('#type_of_rental').val();
        }
        
        // for dumpster / multiple charges category
        var live_load = '';
        var is_emergency = '';
        if($('#live_load').length > 0){
            live_load = $('#live_load').val();
        }
        
        if($('#is_emergency').length > 0){
            
            if( $('#is_emergency').prop('checked') == true){
                is_emergency = $('#is_emergency').val();
            }
            
        }
        
    $('.ag-eq-booking-addtional-lineitem').remove();
      // code by AG end

      $.get(url, { dates: dates, extra_services:extra_services, type_of_rental:type_of_rental,live_load:live_load,is_emergency:is_emergency,location__:location__,lat__:lat__,long__:long__ }, function (response) {
        if ('minimumPrice' in response) {
          let minPrice = response.minimumPrice;

          // recalculate the tax
          let calculatedTax = minPrice * (tax / 100);

          $('#booking-price').text(minPrice.toLocaleString(undefined, options));
          $('#subtotal-amount').text(minPrice.toLocaleString(undefined, options));
          $('#tax-amount').text(calculatedTax.toLocaleString(undefined, options));

          let shippingCharge;

         
          
          shippingCharge = parseFloat(response.shipping_cost);
              $('#shipping-charge').text(shippingCharge);

          let grandTotal = minPrice + calculatedTax + shippingCharge + security_deposit_amount;

          $('#grand-total').text(grandTotal.toLocaleString(undefined, options));
          
          $('.ag-eq-booking-addtional-lineitem').remove();
          if(response.additional_charges_item_html != ''){
              $('.ag-additional-next-item').before(response.additional_charges_item_html);
          }
        } else if ('errorMessage' in response) {
          toastr['error'](response.errorMessage);
        }
      });
      
      
    
  });
   $('#select2_cus').select2();
    $('#equipment_id').select2();
    </script>
  @endsection

@endsection
