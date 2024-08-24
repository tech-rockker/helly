@extends('vendors.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('All Equipment') }}</h4>
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
        <a href="#">{{ __('Equipment') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('All Equipment') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block">{{ __('All Equipment') }}</div>
            </div>

            <div class="col-lg-3">
              @includeIf('vendors.partials.languages')
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="{{ route('vendor.equipment_management.create_equipment') }}"
                class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> {{ __('Add Equipment') }}</a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
                data-href="{{ route('vendor.equipment_management.bulk_delete_equipment') }}">
                <i class="flaticon-interface-5"></i> {{ __('Delete') }}
              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($allEquipment) == 0)
                <h3 class="text-center mt-2">{{ __('NO EQUIPMENT FOUND') . '!' }}</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col">{{ __('Thumbnail Image') }}</th>
                        <th scope="col">{{ __('Title') }}</th>
                        <th scope="col">{{ __('Category') }}</th>
                        <th scope="col">{{ __('Quantity') }}</th>
                        <th scope="col">{{ __('Featured') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($allEquipment as $equipment)
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="{{ $equipment->id }}">
                          </td>
                          <td>
                            <img
                              src="{{ asset('assets/img/equipments/thumbnail-images/' . $equipment->thumbnail_image) }}"
                              alt="equipment image" width="40">
                          </td>
                          <td>
                            <a target="_blank"
                              href="{{ route('equipment_details', $equipment->slug) }}">{{ strlen($equipment->title) > 20 ? mb_substr($equipment->title, 0, 20, 'UTF-8') . '...' : $equipment->title }}</a>
                          </td>
                          <td>{{ $equipment->categoryName }}</td>
                          <td>{{ $equipment->quantity }}</td>
                          <td>
                            <span
                              class="badge badge-{{ $equipment->is_featured == 'yes' ? 'success' : 'danger' }}">{{ Str::ucfirst($equipment->is_featured) }}</span>
                          </td>
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1"
                              href="{{ route('vendor.equipment_management.edit_equipment', ['id' => $equipment->id]) }}">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                            </a>

                            <form class="deleteForm d-inline-block"
                              action="{{ route('vendor.equipment_management.delete_equipment', ['id' => $equipment->id]) }}"
                              method="post">
                              @csrf
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                              </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="card-footer"></div>
      </div>
    </div>
  </div>
@endsection
