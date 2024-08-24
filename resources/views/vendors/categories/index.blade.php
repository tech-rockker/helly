{{-- @dd(auth('vendor')->user()->toArray()) --}}

@extends('vendors.layout')

@section('content')
<div class="page-header">
    <h4 class="page-title">{{ __('All Categories') }}</h4>
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
            <a href="#">{{ __('Invoice System') }}</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">{{ __('Categories') }}</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card-title d-inline-block">{{ __('All Categories') }}</div>
                    </div>

                    <div class="col-lg-3">

                    </div>

                    <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                        <a href="{{ route('vendor.invoice-system.categories.create') }}"
                            class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> 
                            {{ __('Add Category') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if (count($categories) == 0)
                        <h3 class="text-center mt-2">{{ __('NO CATEGORIES FOUND') . '!' }}</h3>
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped mt-3" id="basic-datatables">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('Name') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>

                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            <a class="btn btn-secondary btn-sm mr-1"
                                                href="{{ route('vendor.invoice-system.categories.edit', $category) }}">
                                                <span class="btn-label">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </a>

                                            <form class="deleteForm d-inline-block"
                                                action="{{ route('vendor.invoice-system.categories.destroy', $category) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
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