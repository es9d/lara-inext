@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.tax_types'))
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.tax_types') }}</li>
            </ol>
        </nav>
        <h1 class="m-0">{{ __('messages.tax_types') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'tax_types'])
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">

                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h4 mb-0">
                                    <strong class="headings-color">{{ __('messages.tax_types') }}</strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('settings.tax_types.create') }}" class="btn btn-primary text-white">
                                    {{ __('messages.add_tax') }}
                                </a>
                            </div>
                        </div>

                        @if($tax_types->count() > 0)
                            <div class="table-responsive" data-toggle="lists">
                                <table class="table table-xl mb-0 thead-border-top-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('messages.name') }}</th> 
                                            <th>{{ __('messages.percent') }}</th> 
                                            <th class="w-30">{{ __('messages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="tax_types">
                                        @foreach($tax_types as $tax_type)
                                            <tr>
                                                <td class="h6">
                                                    <a href="{{ route('settings.tax_types.edit', $tax_type->id) }}">
                                                        <strong class="h6">
                                                            {{ $tax_type->name }}
                                                        </strong>
                                                    </a>
                                                </td>
                                                <td class="h6">
                                                    {{ $tax_type->percent }}
                                                </td>
                                                <td class="h6">
                                                    <a href="{{ route('settings.tax_types.edit', $tax_type->id) }}" class="btn text-primary">
                                                        <i class="material-icons icon-16pt">edit</i>
                                                        {{ __('messages.edit') }}
                                                    </a>
                                                    <a href="{{ route('settings.tax_types.delete', $tax_type->id) }}" class="btn text-danger delete-confirm">
                                                        <i class="material-icons icon-16pt">delete</i>
                                                        {{ __('messages.delete') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row card-body pagination-light justify-content-center text-center">
                                {{ $tax_types->links() }}
                            </div>
                        @else
                            <div class="row justify-content-center card-body pb-0 pt-5">
                                <i class="material-icons fs-64px">pages</i>
                            </div>
                            <div class="row justify-content-center card-body pb-5">
                                <p class="h4">{{ __('messages.no_tax_types_yet') }}</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

