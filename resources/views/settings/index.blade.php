@extends('layouts.admin')
@php
    // $logo=asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $logo_img = \App\Models\Utility::getValByName('company_logo');
    $logo_light = \App\Models\Utility::getValByName('company_light_logo');
    // $logo_store = \App\Models\Utility::getValByName('logo');

    $invoice_store = \App\Models\Utility::getValByName('invoice_logo');
    // dd($invoice_store)
    $s_logo = \App\Models\Utility::get_file('uploads/store_logo/');
    $lang = \App\Models\Utility::getValByName('default_language');
    if (\Auth::user()->type == 'Super Admin') {
        $company_logo = Utility::get_superadmin_logo();
    } else {
        $company_logo = Utility::get_company_logo();
    }
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $store_logo = \App\Models\Utility::getValByName('logo');
    $lang = \App\Models\Utility::getValByName('default_language');
    if (Auth::user()->type == 'Owner') {
        $store_lang = $store_settings->lang;
    }
    $setting = App\Models\Utility::settings();
    $SITE_RTL = $setting['SITE_RTL'];

    $file_type = config('files_types');
    $setting = App\Models\Utility::settings();

    $local_storage_validation = $setting['local_storage_validation'];
    $local_storage_validations = explode(',', $local_storage_validation);

    $s3_storage_validation = $setting['s3_storage_validation'];
    $s3_storage_validations = explode(',', $s3_storage_validation);

    $wasabi_storage_validation = $setting['wasabi_storage_validation'];
    $wasabi_storage_validations = explode(',', $wasabi_storage_validation);

@endphp
@php
    $setting = App\Models\Utility::colorset();

    $color = 'theme-3';
    if (!empty($setting['color'])) {
        $color = $setting['color'];
    }
@endphp
@if ($color == 'theme-3')
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #6fd943 !important;
            border-color: #6fd943 !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff;
            background-color: #6fd943 !important;
            border-color: #6fd943 !important;
        }

        .btn.btn-outline-primary {
            color: #6fd943;
            border-color: #6fd943 !important;
        }
    </style>
@endif
@if ($color == 'theme-2')
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
            border-color: #1F3996 !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
            border-color: #1F3996 !important;
        }

        .btn.btn-outline-primary {
            color: #1F3996;
            border-color: #1F3996 !important;
        }
    </style>
@endif
@if ($color == 'theme-4')
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #584ed2 !important;
            border-color: #584ed2 !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff;
            background-color: #584ed2 !important;
            border-color: #584ed2 !important;
        }

        .btn.btn-outline-primary {
            color: #584ed2;
            border-color: #584ed2 !important;
        }
    </style>
@endif
@if ($color == 'theme-1')
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
            border-color: #51459d !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
            border-color: #51459d !important;
        }

        .btn.btn-outline-primary {
            color: #51459d;
            border-color: #51459d !important;
        }
    </style>
@endif
@section('page-title')
    @if (Auth::user()->type == 'super admin')
        {{ __('Setting') }}
    @else
        {{ __('Store Setting') }}
    @endif
@endsection
@section('title')

    @if (Auth::user()->type == 'super admin')
        {{ __('Setting') }}
    @else
        {{ __('Store Setting') }}
    @endif

@endsection
@section('breadcrumb')
    @if (Auth::user()->type == 'super admin')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Setting') }}</li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Store Setting') }}</li>
    @endif


@endsection
@section('action-btn')
@endsection
@section('filter')
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{ asset('custom/libs/summernote/summernote-bs4.css') }}">
    <style>
        hr {
            margin: 8px;
        }
    </style>
@endpush
@push('script-page')
    <script src="{{ asset('custom/libs/summernote/summernote-bs4.js') }}"></script>
    <script type="text/javascript">
        $(document).on("click", '.send_email', function(e) {
            e.preventDefault();
            var title = $(this).attr('data-title');
            var size = 'md';
            var url = $(this).attr('data-url');
            console.log(url);
            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');

                $.post(url, {
                    _token: '{{ csrf_token() }}',
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_encryption: $("#mail_encryption").val(),
                    mail_from_address: $("#mail_from_address").val(),
                    mail_from_name: $("#mail_from_name").val(),

                }, function(data) {
                    $('#commonModal .body').html(data);
                });
            }
        });
        $(document).on('submit', '#test_email', function(e) {
            e.preventDefault();
            $("#email_sending").show();
            var post = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: post,
                cache: false,
                beforeSend: function() {
                    $('#test_email .btn-create').attr('disabled', 'disabled');
                },
                success: function(data) {

                    if (data.is_success) {
                        show_toastr('Success', data.message, 'success');
                    } else {
                        show_toastr('Error', data.message, 'error');
                    }
                    $("#email_sending").hide();
                    $('#commonModal').modal('hide');

                },
                complete: function() {
                    $('#test_email .btn-create').removeAttr('disabled');
                },
            });
        });
    </script>
    <!--  <script>
        // start for tab selection
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            // save current clicked tab in local storage does not work in Stacksnippets
            localStorage.setItem('lastActiveTab', $(this).attr('href'));
        });
        //get last active tab from local storage
        var lastTab = localStorage.getItem('lastActiveTab');
        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }
        //end for tab selection
    </script> -->
    <script type="text/javascript">
        @can('On-Off Email Template')
            $(document).on("click", ".email-template-checkbox", function() {
                var chbox = $(this);
                $.ajax({
                    url: chbox.attr('data-url'),
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        status: chbox.val()
                    },
                    type: 'PUT',
                    success: function(response) {
                        if (response.is_success) {
                            show_toastr('Success', response.success, 'success');
                            if (chbox.val() == 1) {
                                $('#' + chbox.attr('id')).val(0);
                            } else {
                                $('#' + chbox.attr('id')).val(1);
                            }
                        } else {
                            show_toastr('Error', response.error, 'error');
                        }
                    },
                    error: function(response) {
                        response = response.responseJSON;
                        if (response.is_success) {
                            show_toastr('Error', response.error, 'error');
                        } else {
                            show_toastr('Error', response, 'error');
                        }
                    }
                })
            });
        @endcan
    </script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,

        })
        $(".list-group-item").click(function() {
            $('.list-group-item').filter(function() {
                return this.href == id;
            }).parent().removeClass('text-primary');
        });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }
    </script>
    <script>
        $(document).ready(function() {
            if ($('.gdpr_fulltime').is(':checked')) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }

            $('#gdpr_cookie').on('change', function() {
                if ($('.gdpr_fulltime').is(':checked')) {

                    $('.fulltime').show();
                } else {

                    $('.fulltime').hide();
                }
            });
        });
    </script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        $(".list-group-item").click(function() {
            $('.list-group-item').filter(function() {
                return this.href == id;
            }).parent().removeClass('text-primary');
        });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }

        $(document).on('change', '[name=storage_setting]', function() {
            if ($(this).val() == 's3') {
                $('.s3-setting').removeClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').addClass('d-none');
            } else if ($(this).val() == 'wasabi') {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').removeClass('d-none');
                $('.local-setting').addClass('d-none');
            } else {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').removeClass('d-none');
            }
        });
    </script>
    <script>
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button', {
                removeItemButton: true,
            }
        );
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button1', {
                removeItemButton: true,
            }
        );
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button2', {
                removeItemButton: true,
            }
        );
    </script>
@endpush
@section('content')
    <div class="row ">

        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            @if (Auth::user()->type == 'Owner')
                                <a href="#store_setting"
                                    class="list-group-item list-group-item-action border-0">{{ __('Store Settings') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <a href="#store_theme_setting"
                                    class="list-group-item list-group-item-action border-0">{{ __('Theme Settings') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <a href="#store_site_setting"
                                    class="list-group-item list-group-item-action border-0">{{ __('Site Settings') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <a href="#store_payment-setting"
                                    class="list-group-item list-group-item-action border-0">{{ __('Payment Setting') }}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <a href="#store_email_setting"
                                    class="list-group-item list-group-item-action border-0">{{ __('Mail Setting') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <a href="#whatsapp_custom_massage"
                                    class="list-group-item list-group-item-action border-0">{{ __('WhatsApp Mail Setting') }}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <a href="#twilio_setting"
                                    class="list-group-item list-group-item-action border-0">{{ __('Twilio Payment') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            @endif

                            @if (Auth::user()->type == 'super admin')
                                <a href="#site_setting"
                                    class="list-group-item list-group-item-action border-0">{{ __('Site Setting') }}<div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <a href="#payment-setting"
                                    class="list-group-item list-group-item-action border-0">{{ __('Payment Setting') }}<div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <a href="#email_setting"
                                    class="list-group-item list-group-item-action border-0">{{ __('Email Setting') }}<div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <a href="#recaptcha-settings"
                                    class="list-group-item list-group-item-action border-0">{{ __('ReCaptcha Setting') }}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <a href="#useradd-13"
                                    class="list-group-item list-group-item-action border-0">{{ __('Storage Setting') }}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    @if (Auth::user()->type == 'Owner')
                        <div class="active" id="store_setting">
                            {{-- @DD($store_settings) --}}
                            {{ Form::model($store_settings, ['route' => ['settings.store', $store_settings['id']], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>{{ __('Store Settings') }}</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class=" setting-card">
                                                <div class="row mt-2">
                                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5>{{ __('Store Logo') }}</h5>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class=" setting-card">
                                                                    <div class="logo-content mt-4">
                                                                        {{-- <a href="{{ $store_logo .'/' .(isset($store_settings['logo']) && !empty($store_settings['logo']) ? $store_settings['logo'] : 'logo.png') }}" target="_blank">
                                                                            <img src="{{ $store_logo .'/' .(isset($store_settings['logo']) && !empty($store_settings['logo']) ? $store_settings['logo'] : 'logo.png') }}"
                                                                                class="big-logo" id="StorelogoOwner">
                                                                            </a> --}}
                                                                        <a href="{{ $s_logo . (isset($store_settings['logo']) && !empty($store_settings['logo']) ? $store_settings['logo'] : 'logo.png') }}"
                                                                            target="_blank">
                                                                            <img id="StorelogoOwner" alt="your image"
                                                                                src="{{ $s_logo . (isset($store_settings['logo']) && !empty($store_settings['logo']) ? $store_settings['logo'] : 'logo.png') }}"
                                                                                width="150px" class="big-logo">
                                                                        </a>
                                                                    </div>
                                                                    <div class="choose-files mt-5">
                                                                        <label for="logo">
                                                                            <div class=" bg-primary m-auto"> <i
                                                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                                            </div>
                                                                            <input type="file" class="form-control file"
                                                                                name="logo" id="logo"
                                                                                data-filename="logo_update"
                                                                                onchange="document.getElementById('StorelogoOwner').src = window.URL.createObjectURL(this.files[0])">
                                                                        </label>
                                                                    </div>
                                                                    @error('logo')
                                                                        <div class="row">
                                                                            <span class="invalid-logo" role="alert">
                                                                                <strong
                                                                                    class="text-danger">{{ $message }}</strong>
                                                                            </span>
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5>{{ __('Invoice Logo') }}</h5>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class=" setting-card">
                                                                    <div class="logo-content mt-4">
                                                                        {{-- <a href="{{ $store_logo .'/' .(isset($store_settings['invoice_logo']) && !empty($store_settings['invoice_logo'])? $store_settings['invoice_logo']: 'invoice_logo.png') }}" target="_blank">
                                                                            <img src="{{ $store_logo .'/' .(isset($store_settings['invoice_logo']) && !empty($store_settings['invoice_logo'])? $store_settings['invoice_logo']: 'invoice_logo.png') }}"
                                                                                class="big-logo" id="invoiceOwner">
                                                                            </a> --}}
                                                                        <a href="{{ $s_logo . (isset($store_settings['invoice_logo']) && !empty($store_settings['invoice_logo']) ? $store_settings['invoice_logo'] : 'invoice_logo.png') }}"
                                                                            target="_blank">
                                                                            <img id="invoiceOwner" alt="your image"
                                                                                src="{{ $s_logo . (isset($store_settings['invoice_logo']) && !empty($store_settings['invoice_logo']) ? $store_settings['invoice_logo'] : 'invoice_logo.png') }}"
                                                                                width="150px" class="big-logo">
                                                                        </a>
                                                                    </div>
                                                                    <div class="choose-files mt-5">
                                                                        <label for="invoice_logo">
                                                                            <div class=" bg-primary  m-auto"> <i
                                                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                                            </div>
                                                                            <input type="file" name="invoice_logo"
                                                                                id="invoice_logo"
                                                                                class="form-control file"
                                                                                data-filename="invoice_logo_update"
                                                                                onchange="document.getElementById('invoiceOwner').src = window.URL.createObjectURL(this.files[0])">
                                                                        </label>
                                                                    </div>
                                                                    @error('invoice_logo')
                                                                        <div class="row">
                                                                            <span class="invalid-invoice_logo" role="alert">
                                                                                <strong
                                                                                    class="text-danger">{{ $message }}</strong>
                                                                            </span>
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        {{ Form::label('store_name', __('Store Name'), ['class' => 'col-col-form-label']) }}
                                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Store Name')]) !!}
                                                        @error('store_name')
                                                            <span class="invalid-store_name" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        {{ Form::label('email', __('Email'), ['class' => 'col-col-form-label']) }}
                                                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Email')]) }}
                                                        @error('email')
                                                            <span class="invalid-email" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    @if ($plan->enable_custdomain == 'on' || $plan->enable_custsubdomain == 'on')
                                                        <div class="col-md-6 py-4">
                                                            <div class="radio-button-group mts">
                                                                {{-- <div class="btn-group btn-group-toggle" data-toggle="buttons"> --}}
                                                                <div class="item">
                                                                    <label
                                                                        class="btn btn-primary {{ $store_settings['enable_storelink'] == 'on' ? 'active' : '' }}">
                                                                        <input type="radio"
                                                                            class="domain_click  radio-button"
                                                                            name="enable_domain" value="enable_storelink"
                                                                            id="enable_storelink"
                                                                            {{ $store_settings['enable_storelink'] == 'on' ? 'checked' : '' }}">
                                                                        {{ __('Store Link') }}
                                                                    </label>
                                                                </div>
                                                                @if ($plan->enable_custdomain == 'on')
                                                                    <div class="item">
                                                                        <label
                                                                            class="btn btn-primary {{ $store_settings['enable_domain'] == 'on' ? 'active' : '' }}">
                                                                            <input type="radio"
                                                                                class="domain_click radio-button"
                                                                                name="enable_domain" value="enable_domain"
                                                                                id="enable_domain"
                                                                                {{ $store_settings['enable_domain'] == 'on' ? 'checked' : '' }}>
                                                                            {{ __('Domain') }}
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                                @if ($plan->enable_custsubdomain == 'on')
                                                                    <div class="item">
                                                                        <label
                                                                            class="btn btn-primary {{ $store_settings['enable_subdomain'] == 'on' ? 'active' : '' }}">
                                                                            <input type="radio"
                                                                                class="domain_click radio-button"
                                                                                name="enable_domain"
                                                                                value="enable_subdomain"
                                                                                id="enable_subdomain"
                                                                                {{ $store_settings['enable_subdomain'] == 'on' ? 'checked' : '' }}>
                                                                            {{ __('Sub Domain') }}
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                                {{-- </div> --}}
                                                            </div>
                                                            <div class="text-sm mt-2" id="domainnote"
                                                                style="display: none">
                                                                {{ __('Note : Before add custom domain, your domain A record is pointing to our server IP :') }}{{ $serverIp }}
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6" id="StoreLink"
                                                            style="{{ $store_settings['enable_storelink'] == 'on' ? 'display: block' : 'display: none' }}">
                                                            {{ Form::label('store_link', __('Store Link'), ['class' => 'col-col-form-label']) }}
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    value="{{ $store_settings['store_url'] }}"
                                                                    id="myInput" class="form-control d-inline-block"
                                                                    aria-label="Recipient's username"
                                                                    aria-describedby="button-addon2" readonly>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-primary" type="button"
                                                                        onclick="myFunction()" id="button-addon2"><i
                                                                            class="far fa-copy"></i>
                                                                        {{ __('Copy Link') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6 domain"
                                                            style="{{ $store_settings['enable_domain'] == 'on' ? 'display:block' : 'display:none' }}">
                                                            {{ Form::label('store_domain', __('Custom Domain'), ['class' => 'col-col-form-label']) }}
                                                            {{ Form::text('domains', $store_settings['domains'], ['class' => 'form-control', 'placeholder' => __('xyz.com')]) }}
                                                        </div>
                                                        @if ($plan->enable_custsubdomain == 'on')
                                                            <div class="form-group col-md-6 sundomain"
                                                                style="{{ $store_settings['enable_subdomain'] == 'on' ? 'display:block' : 'display:none' }}">
                                                                {{ Form::label('store_subdomain', __('Sub Domain'), ['class' => 'col-col-form-label']) }}
                                                                <div class="input-group">
                                                                    {{ Form::text('subdomain', $store_settings['slug'], ['class' => 'form-control', 'placeholder' => __('Enter Domain'), 'readonly']) }}
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon2">.{{ $subdomain_name }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="form-group col-md-6" id="StoreLink">
                                                            {{ Form::label('store_link', __('Store Link'), ['class' => 'col-col-form-label']) }}
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    value="{{ $store_settings['store_url'] }}"
                                                                    id="myInput" class="form-control d-inline-block"
                                                                    aria-label="Recipient's username"
                                                                    aria-describedby="button-addon2" readonly>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-primary" type="button"
                                                                        onclick="myFunction()" id="button-addon2"><i
                                                                            class="far fa-copy"></i>
                                                                        {{ __('Copy Link') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="form-group col-md-4">
                                                        {{ Form::label('tagline', __('Tagline'), ['class' => 'col-form-label']) }}
                                                        {{ Form::text('tagline', null, ['class' => 'form-control', 'placeholder' => __('Tagline')]) }}
                                                        @error('tagline')
                                                            <span class="invalid-tagline" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        {{ Form::label('address', __('Address'), ['class' => 'col-form-label']) }}
                                                        {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => __('Address')]) }}
                                                        @error('address')
                                                            <span class="invalid-address" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        {{ Form::label('city', __('City'), ['class' => 'col-form-label']) }}
                                                        {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('City')]) }}
                                                        @error('city')
                                                            <span class="invalid-city" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        {{ Form::label('state', __('State'), ['class' => 'col-form-label']) }}
                                                        {{ Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('State')]) }}
                                                        @error('state')
                                                            <span class="invalid-state" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        {{ Form::label('zipcode', __('Zipcode'), ['class' => 'col-form-label']) }}
                                                        {{ Form::text('zipcode', null, ['class' => 'form-control', 'placeholder' => __('Zipcode')]) }}
                                                        @error('zipcode')
                                                            <span class="invalid-zipcode" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        {{ Form::label('country', __('Country'), ['class' => 'col-form-label']) }}
                                                        {{ Form::text('country', null, ['class' => 'form-control', 'placeholder' => __('Country')]) }}
                                                        @error('country')
                                                            <span class="invalid-country" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        {{ Form::label('store_default_language', __('Store Default Language'), ['class' => 'col-form-label']) }}
                                                        <div class="changeLanguage">
                                                            <select name="store_default_language"
                                                                id="store_default_language" class="form-control"
                                                                data-toggle="select">
                                                                @foreach (\App\Models\Utility::languages() as $language)
                                                                    <option
                                                                        @if ($store_lang == $language) selected @endif
                                                                        value="{{ $language }}">
                                                                        {{ Str::upper($language) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        {{ Form::label('decimal_number_format', __('Decimal Number Format'), ['class' => 'col-form-label']) }}
                                                        {{ Form::number('decimal_number', isset($store_settings['decimal_number']) ? $store_settings['decimal_number'] : 2, ['class' => 'form-control', 'placeholder' => __('decimal_number')]) }}
                                                        @error('decimal_number')
                                                            <span class="invalid-decimal_number" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    @if ($plan->shipping_method == 'on')
                                                        <div class="form-group col-md-3 mt-3">
                                                            <label class="form-check-label" for="enable_shipping"></label>
                                                            <div class="custom-control form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="enable_shipping" id="enable_shipping"
                                                                    {{ $store_settings['enable_shipping'] == 'on' ? 'checked=checked' : '' }}>
                                                                {{ Form::label('enable_shipping', __('Shipping Method Enable'), ['class' => 'form-check-label mb-3']) }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="form-group col-md-3 mt-3">
                                                        <label class="form-check-label"
                                                            for="is_checkout_login_required"></label>
                                                        <div class="custom-control form-switch">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="is_checkout_login_required"
                                                                id="is_checkout_login_required"
                                                                @if ($store_settings['is_checkout_login_required'] == null) @if ($settings['is_checkout_login_required'] == 'on')
                                                                            {{ 'checked=checked' }} @endif
                                                            @elseif($store_settings['is_checkout_login_required'] == 'on')
                                                            {{ 'checked=checked' }} @else {{ '' }}
                                                                @endif
                                                            {{-- {{ $store_settings['is_checkout_login_required'] == 'on' ? 'checked=checked' : '' }} --}}
                                                            >
                                                            {{ Form::label('is_checkout_login_required', __('Is Checkout Login Required'), ['class' => 'form-check-label mb-3']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <i class="fab fa-google" aria-hidden="true"></i>
                                                            {{ Form::label('google_analytic', __('Google Analytic'), ['class' => 'col-form-label']) }}
                                                            {{ Form::text('google_analytic', null, ['class' => 'form-control', 'placeholder' => 'UA-XXXXXXXXX-X']) }}
                                                            @error('google_analytic')
                                                                <span class="invalid-google_analytic" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                                            {{ Form::label('facebook_pixel_code', __('Facebook Pixel'), ['class' => 'col-form-label']) }}
                                                            {{ Form::text('fbpixel_code', null, ['class' => 'form-control', 'placeholder' => 'UA-0000000-0']) }}
                                                            @error('facebook_pixel_code')
                                                                <span class="invalid-google_analytic" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        {{ Form::label('storejs', __('Store Custom JS'), ['class' => 'col-form-label']) }}
                                                        {{ Form::textarea('storejs', null, ['class' => 'form-control', 'rows' => 3, 'placehold   er' => __('About')]) }}
                                                        @error('storejs')
                                                            <span class="invalid-about" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-6 col-lg-6">
                                                        {{ Form::label('metakeyword', __('Meta Keywords'), ['class' => 'col-form-label']) }}
                                                        {!! Form::textarea('metakeyword', $store_settings->meta_data, [
                                                            'class' => 'form-control',
                                                            'rows' => 3,
                                                            'placeholder' => __('Meta Keyword'),
                                                        ]) !!}
                                                        @error('meta_keywords')
                                                            <span class="invalid-about" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-6 col-lg-6">
                                                        {{ Form::label('metadesc', __('Meta Description'), ['class' => 'col-form-label']) }}
                                                        {!! Form::textarea('metadesc', $store_settings->meta_description, [
                                                            'class' => 'form-control',
                                                            'rows' => 3,
                                                            'placeholder' => __('Meta Description'),
                                                        ]) !!}

                                                        @error('meta_description')
                                                            <span class="invalid-about" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12 pt-4">
                                                        <h5 class="h6 mb-0">{{ __('Footer Note') }}</h5>
                                                        <small>{{ __('This detail will use for make explore social media.') }}</small>
                                                        <hr class="my-4">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <i class="fas fa-envelope"></i>
                                                            {{ Form::label('email', __('Email'), ['class' => 'col-form-label']) }}
                                                            {{ Form::text('email', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('Email')]) }}
                                                            @error('email')
                                                                <span class="invalid-email" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                                            {{ Form::label('whatsapp', __('WhatsApp'), ['class' => 'col-form-label']) }}
                                                            {{ Form::text('whatsapp', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'https://wa.me/1XXXXXXXXXX']) }}
                                                            @error('whatsapp')
                                                                <span class="invalid-whatsapp" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <i class="fab fa-facebook-square" aria-hidden="true"></i>
                                                            {{ Form::label('facebook', __('Facebook'), ['class' => 'col-form-label']) }}
                                                            {{ Form::text('facebook', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'https://www.facebook.com/']) }}
                                                            @error('facebook')
                                                                <span class="invalid-facebook" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <i class="fab fa-instagram" aria-hidden="true"></i>
                                                            {{ Form::label('instagram', __('Instagram'), ['class' => 'col-form-label']) }}
                                                            {{ Form::text('instagram', null, ['class' => 'form-control', 'placeholder' => 'https://www.instagram.com/']) }}
                                                            @error('instagram')
                                                                <span class="invalid-instagram" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                                            {{ Form::label('twitter', __('Twitter'), ['class' => 'col-form-label']) }}
                                                            {{ Form::text('twitter', null, ['class' => 'form-control', 'placeholder' => 'https://twitter.com/']) }}
                                                            @error('twitter')
                                                                <span class="invalid-twitter" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <i class="fab fa-youtube" aria-hidden="true"></i>
                                                            {{ Form::label('youtube', __('Youtube'), ['class' => 'col-form-label']) }}
                                                            {{ Form::text('youtube', null, ['class' => 'form-control', 'placeholder' => 'https://www.youtube.com/']) }}
                                                            @error('youtube')
                                                                <span class="invalid-youtube" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <i class="fas    fa-copyright" aria-hidden="true"></i>
                                                            {{ Form::label('footer_note', __('Footer Note'), ['class' => 'col-form-label']) }}
                                                            {{ Form::text('footer_note', null, ['class' => 'form-control', 'placeholder' => __('Footer Note')]) }}
                                                            @error('footer_note')
                                                                <span class="invalid-footer_note" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>
                                            <div class="form-group col-md-12 text-end">
                                                <div class="col-lg-12  text-end">
                                                    <input type="submit" value="{{ __('Save Changes') }}"
                                                        class="btn btn-xs btn-primary">
                                                </div>
                                                {{ Form::close() }}
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['ownerstore.destroy', $store_settings->id],
                                                    'id' => 'delete-form-' . $store_settings->id,
                                                ]) !!}

                                                <button type="button"
                                                    class="btn bs-pass-para btn-secondary btn-light show_confirm my-3 px-4">
                                                    <span class="text-black">{{ __('Delete Store') }}</span>
                                                </button>
                                                {!! Form::close() !!}


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="store_theme_setting" class="card">
                            <div class="card-header">
                                <h5>{{ __('Store Theme Setting') }}</h5>
                            </div>
                            {{ Form::open(['route' => ['store.changetheme', $store_settings->id], 'method' => 'POST']) }}
                            <div class="card-body">
                                <div class="row">
                                    @foreach (\App\Models\Utility::themeOne() as $key => $v)
                                        <div class="col-4 cc-selector mb-2">
                                            <div class="mb-3 screen image">
                                                <img src="{{ asset(Storage::url('uploads/store_theme/' . $key . '/Home.png')) }}"
                                                    class="img-center pro_max_width pro_max_height {{ $key }}_img">
                                                <div class="actions">
                                                    <a href="">
                                                        <button type="button"
                                                            class="btn btn-default delete-image-btn pull-right">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                    </a>
                                                    <a href="">
                                                        <button type="button"
                                                            class="btn btn-default edit-image-btn pull-right">
                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row gutters-xs" id="{{ $key }}">
                                                    @foreach ($v as $css => $val)
                                                        <div class="col-auto">
                                                            <label class="colorinput">
                                                                <input name="theme_color" type="radio"
                                                                    value="{{ $css }}"
                                                                    data-theme="{{ $key }}"
                                                                    data-imgpath="{{ $val['img_path'] }}"
                                                                    class="colorinput-input"
                                                                    {{ isset($store_settings['store_theme']) && $store_settings['store_theme'] == $css ? 'checked' : '' }}>
                                                                <span class="colorinput-color"
                                                                    style="background:#{{ $val['color'] }}"></span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    <div class="col">
                                                        @if (isset($store_settings['theme_dir']) && $store_settings['theme_dir'] == $key)
                                                            <a href="{{ route('store.editproducts', [$store_settings->slug, $key]) }}"
                                                                class="btn btn-outline-primary theme_btn" type="button"
                                                                id="button-addon2">{{ __('Edit') }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-sm-12 px-2">
                                    <div class="text-end">
                                        {{ Form::hidden('themefile', null, ['id' => 'themefile']) }}
                                        {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary']) }}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div id="store_site_setting" class="card">
                            {{ Form::model($settings, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            <div class="card-header">
                                <h5>{{ __('Site Setting') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>{{ __('Logo Dark') }}</h5>
                                            </div>
                                            <div class="card-body ">
                                                <div class=" setting-card">
                                                    <div class="logo-content mt-4">
                                                        {{-- <a href="{{asset(Storage::url($logo_img))}}" target="_blank">
                                                                    <img src="{{asset(Storage::url($logo_img))}}" class="big-logo" id="company_logo_update">
                                                                </a> --}}
                                                        {{-- <a href="{{$logo.'logodark.png'}}" target="_blank">
                                                                    <img id="blah" alt="your image" src="{{$logo.'logo_dark.png'}}" width="150px" class="big-logo">
                                                                </a> --}}
                                                        <a href="{{ $logo . (isset($logo_img) && !empty($logo_img) ? $logo_img : 'logo-dark.png') }}"
                                                            target="_blank">
                                                            <img id="blah" alt="your image"
                                                                src="{{ $logo . (isset($logo_img) && !empty($logo_img) ? $logo_img : 'logo-dark.png') }}"
                                                                width="150px" class="big-logo">
                                                        </a>
                                                    </div>
                                                    {{-- <div class="choose-files mt-5">
                                                                <label for="company_logo">
                                                                    <div class="mt-4 bg-primary company_logo_update"> <i
                                                                            class="ti ti-upload px-1"></i>{{ __('Select image') }}</div>
                                                                    <input type="file" class="form-control file" name="company_logo" id="company_logo"
                                                                        data-filename="edit-logo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" >
                                                                </label>
                                                            </div> --}}
                                                    <div class="choose-files mt-5">
                                                        <label for="company_logo">
                                                            <div class=" bg-primary m-auto company_logo_update"> <i
                                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                            </div>
                                                            <input type="file" class="form-control file"
                                                                name="company_logo" id="company_logo"
                                                                data-filename="edit-logo"
                                                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                        </label>
                                                    </div>
                                                    @error('logo')
                                                        <span class="invalid-company_logo text-xs text-danger"
                                                            role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>{{ __('Logo Light') }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class=" setting-card">
                                                    <div class="logo-content mt-4">
                                                        {{-- <img src="{{$logo.'/'.(isset($logo_light) && !empty($logo_light)?$logo_light:'logo-light.png')}}"
                                                                class="big-logo img_setting" id="storeLighlogo"> --}}

                                                        <a href="{{ $logo . (isset($logo_light) && !empty($logo_light) ? $logo_light : 'logo-light.png') }}"
                                                            target="_blank">
                                                            <img id="storeLighlogo" alt="your image"
                                                                src="{{ $logo . (isset($logo_light) && !empty($logo_light) ? $logo_light : 'logo-light.png') }}"
                                                                width="150px" class="big-logo img_setting">
                                                        </a>
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <label for="company_light_logo">
                                                            <div class=" bg-primary  m-auto"> <i
                                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                            </div>
                                                            <input type="file" class="form-control file"
                                                                name="company_light_logo" id="company_light_logo"
                                                                data-filename="company_light_logo_update"
                                                                onchange="document.getElementById('storeLighlogo').src = window.URL.createObjectURL(this.files[0])">
                                                        </label>
                                                    </div>
                                                    @error('light_logo')
                                                        <div class="row">
                                                            <span class="invalid-logo" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>{{ __('Favicon') }}</h5>
                                            </div>
                                            <div class="card-body company_favicon pt-2">
                                                <div class=" setting-card">
                                                    <div class="logo-content mt-4">
                                                        <img src="{{ $logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}"
                                                            width="50px" class="img_setting" id="logofaviCon">
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <label for="company_favicon">
                                                            <div class=" bg-primary  m-auto"> <i
                                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                            </div>
                                                            <input type="file" class="form-control file"
                                                                id="company_favicon" name="company_favicon"
                                                                data-filename="company_favicon_update"
                                                                onchange="document.getElementById('logofaviCon').src = window.URL.createObjectURL(this.files[0])">
                                                        </label>
                                                    </div>
                                                    @error('logo')
                                                        <div class="row">
                                                            <span class="invalid-logo" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('title_text', __('Title Text'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Title Text')]) }}
                                        @error('title_text')
                                            <span class="invalid-title_text" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('footer_text', __('Footer Text'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('footer_text', null, ['class' => 'form-control', 'placeholder' => __('Footer Text')]) }}
                                        @error('footer_text')
                                            <span class="invalid-footer_text" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="site_date_format"
                                            class="col-form-label">{{ __('Date Format') }}</label>
                                        <select type="text" name="site_date_format" class="form-control"
                                            data-toggle="select" id="site_date_format">
                                            <option value="M j, Y"
                                                @if (@$settings['site_date_format'] == 'M j, Y') selected="selected" @endif>Jan 1,2015
                                            </option>
                                            <option value="d-m-Y"
                                                @if (@$settings['site_date_format'] == 'd-m-Y') selected="selected" @endif>d-m-y</option>
                                            <option value="m-d-Y"
                                                @if (@$settings['site_date_format'] == 'm-d-Y') selected="selected" @endif>m-d-y</option>
                                            <option value="Y-m-d"
                                                @if (@$settings['site_date_format'] == 'Y-m-d') selected="selected" @endif>y-m-d</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="site_time_format"
                                            class="col-form-label">{{ __('Time Format') }}</label>
                                        <select type="text" name="site_time_format" class="form-control"
                                            data-toggle="select" id="site_time_format">
                                            <option value="g:i A"
                                                @if (@$settings['site_time_format'] == 'g:i A') selected="selected" @endif>10:30 PM
                                            </option>
                                            <option value="g:i a"
                                                @if (@$settings['site_time_format'] == 'g:i a') selected="selected" @endif>10:30 pm
                                            </option>
                                            <option value="H:i"
                                                @if (@$settings['site_time_format'] == 'H:i') selected="selected" @endif>22:30</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        {{ Form::label('SITE_RTL', __('RTL'), ['class' => 'col-form-label']) }}
                                        <div class="col-12 mt-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" data-toggle="switchbutton"
                                                    class="custom-control-input" name="SITE_RTL" id="SITE_RTL"
                                                    value="on" {{ $SITE_RTL == 'on' ? 'checked="checked"' : '' }}>
                                                <label class="form-check-labe" for="SITE_RTL"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="small-title">{{ __('Theme Customizer') }}</h4>
                                    <div class="setting-card setting-logo-box p-3">
                                        <div class="row">
                                            <div class="col-4 my-auto">
                                                <h6 class="mt-3">
                                                    <i data-feather="credit-card"
                                                        class="me-2"></i>{{ __('Primary color settings') }}
                                                </h6>
                                                <hr class="my-2" />
                                                <div class="theme-color themes-color">
                                                    <a href="#!"
                                                        class="{{ $settings['color'] == 'theme-1' ? 'active_color' : '' }}"
                                                        data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                    <input type="radio" class="theme_color" name="color"
                                                        value="theme-1" style="display: none;">
                                                    <a href="#!"
                                                        class="{{ $settings['color'] == 'theme-2' ? 'active_color' : '' }}"
                                                        data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                    <input type="radio" class="theme_color" name="color"
                                                        value="theme-2" style="display: none;">
                                                    <a href="#!"
                                                        class="{{ $settings['color'] == 'theme-3' ? 'active_color' : '' }}"
                                                        data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                    <input type="radio" class="theme_color" name="color"
                                                        value="theme-3" style="display: none;">
                                                    <a href="#!"
                                                        class="{{ $settings['color'] == 'theme-4' ? 'active_color' : '' }}"
                                                        data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                    <input type="radio" class="theme_color" name="color"
                                                        value="theme-4" style="display: none;">
                                                </div>
                                            </div>
                                            <div class="col-4 my-auto">
                                                <h6>
                                                    <i data-feather="layout"
                                                        class="me-2"></i>{{ __('Sidebar settings') }}
                                                </h6>
                                                <hr class="my-2" />
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" id="cust-theme-bg"
                                                        name="cust_theme_bg"
                                                        {{ Utility::getValByName('cust_theme_bg') == 'on' ? 'checked' : '' }} />
                                                    <label class="form-check-label f-w-600 pl-1"
                                                        for="cust-theme-bg">{{ __('Transparent layout') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-4 my-auto">
                                                <h6>
                                                    <i data-feather="sun" class="me-2"></i>{{ __('Layout settings') }}
                                                </h6>
                                                <hr class="my-2" />
                                                <div class="form-check form-switch mt-2">
                                                    <input type="checkbox" class="form-check-input" id="cust-darklayout"
                                                        name="cust_darklayout"{{ Utility::getValByName('cust_darklayout') == 'on' ? 'checked' : '' }} />
                                                    <label class="form-check-label f-w-600 pl-1"
                                                        for="cust-darklayout">{{ __('Dark Layout') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <div class="col-sm-12 px-2">
                                    <div class="text-end">
                                        {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary']) }}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div id="store_payment-setting" class="card">

                            <div class="card-header">
                                <h5>{{ __('Payment Setting') }}</h5>
                            </div>
                            <div class="card-body">
                                {{ Form::open(['route' => ['owner.payment.setting', $store_settings->slug], 'method' => 'post']) }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('currency', __('Currency *'), ['class' => '  col-form-label']) }}
                                            {{ Form::text('currency', $store_settings['currency_code'], ['class' => 'form-control font-style', 'required']) }}
                                            {{ __('Note: Add currency code as per three-letter ISO code.') }}
                                            <small>
                                                <a href="https://stripe.com/docs/currencies"
                                                    target="_blank">{{ __('you can find out here..') }}</a>
                                            </small>
                                            @error('currency')
                                                <span class="invalid-currency" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('currency_symbol', __('Currency Symbol *'), ['class' => 'col-form-label']) }}
                                            {{ Form::text('currency_symbol', $store_settings['currency'], ['class' => 'form-control', 'required']) }}
                                            @error('currency_symbol')
                                                <span class="invalid-currency_symbol" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"
                                                for="example3cols3Input">{{ __('Currency Symbol Position') }}</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check form-check-inline mb-3   ">
                                                        <input type="radio" id="customRadio5"
                                                            name="currency_symbol_position" value="pre"
                                                            class="form-check-input"
                                                            @if (@$store_settings['currency_symbol_position'] == 'pre') checked @endif>
                                                        <label class="form-check-label"
                                                            for="customRadio5">{{ __('Pre') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input type="radio" id="customRadio6"
                                                            name="currency_symbol_position" value="post"
                                                            class="form-check-input"
                                                            @if (@$store_settings['currency_symbol_position'] == 'post') checked @endif>
                                                        <label class="form-check-label"
                                                            for="customRadio6">{{ __('Post') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label"
                                                for="example3cols3Input">{{ __('Currency Symbol Space') }}</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input type="radio" id="customRadio7"
                                                            name="currency_symbol_space" value="with"
                                                            class="form-check-input"
                                                            @if (@$store_settings['currency_symbol_space'] == 'with') checked @endif>
                                                        <label class="form-check-label"
                                                            for="customRadio7">{{ __('With Space') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-check-inline mb-3">
                                                        <input type="radio" id="customRadio8"
                                                            name="currency_symbol_space" value="without"
                                                            class="form-check-input"
                                                            @if (@$store_settings['currency_symbol_space'] == 'without') checked @endif>
                                                        <label class="form-check-label"
                                                            for="customRadio8">{{ __('Without Space') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>{{ __('Custom Field For Checkout') }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('custom_field_title_1', __('Custom Field Title'), ['class' => 'col-form-label']) }}
                                            {{ Form::text('custom_field_title_1', !empty($store_settings['custom_field_title_1']) ? $store_settings['custom_field_title_1'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Custom Field Title')]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('custom_field_title_2', __('Custom Field Title'), ['class' => 'col-form-label']) }}
                                            {{ Form::text('custom_field_title_2', !empty($store_settings['custom_field_title_2']) ? $store_settings['custom_field_title_2'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Custom Field Title')]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('custom_field_title_3', __('Custom Field Title'), ['class' => 'col-form-label']) }}
                                            {{ Form::text('custom_field_title_3', !empty($store_settings['custom_field_title_3']) ? $store_settings['custom_field_title_3'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Custom Field Title')]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('custom_field_title_4', __('Custom Field Title'), ['class' => 'col-form-label']) }}
                                            {{ Form::text('custom_field_title_4', !empty($store_settings['custom_field_title_4']) ? $store_settings['custom_field_title_4'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Custom Field Title')]) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="faq justify-content-center">
                                    <div class="col-sm-12 col-md-10 col-xxl-12">
                                        <div class="accordion accordion-flush" id="accordionExample">

                                            <!-- Strip -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-2">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse1"
                                                        aria-expanded="true" aria-controls="collapse1">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Telegram') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse1"
                                                    class="accordion-collapse collapse"aria-labelledby="heading-2-2"data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Telegram') }}</h5>
                                                                <small>
                                                                    {{ __('Note: This detail will use for make checkout of shopping cart.') }}</small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="enable_telegram"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="enable_telegram" id="enable_telegram"
                                                                        {{ $store_settings['enable_telegram'] == 'on' ? 'checked="checked"' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="enable_telegram">{{ __('Enable Telegram') }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('telegrambot', __('Telegram Access Token'), ['class' => 'col-col-form-label']) }}
                                                                    {{ Form::text('telegrambot', $store_settings['telegrambot'], ['class' => 'form-control active telegrambot', 'placeholder' => '1234567890:AAbbbbccccddddxvGENZCi8Hd4B15M8xHV0']) }}
                                                                    <p>{{ __('Get Chat ID') }} :
                                                                        https://api.telegram.org/bot-TOKEN-/getUpdates</p>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('telegramchatid', __('Telegram Chat Id'), ['class' => 'col-col-form-label']) }}
                                                                    {{ Form::text('telegramchatid', $store_settings['telegramchatid'], ['class' => 'form-control active telegramchatid', 'placeholder' => '123456789']) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-3">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse2"
                                                        aria-expanded="true" aria-controls="collapse2">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Whatsapp') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse2"
                                                    class="accordion-collapse collapse"aria-labelledby="heading-2-3"data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Whatsapp') }}</h5>
                                                                <small>
                                                                    {{ __('Note: This detail will use for make checkout of shopping cart.') }}</small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="enable_whatsapp"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="enable_whatsapp" id="enable_whatsapp"
                                                                        {{ $store_settings['enable_whatsapp'] == 'on' ? 'checked="checked"' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="enable_whatsapp">{{ __('Enable WhatsApp') }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="text" name="whatsapp_number"
                                                                        id="whatsapp_number"
                                                                        class="form-control input-mask"
                                                                        value="{{ $store_settings['whatsapp_number'] }}"
                                                                        placeholder="+00 00000000000" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>




                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-6">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse5"
                                                        aria-expanded="true" aria-controls="collapse5">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Paystack') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse5"
                                                    class="accordion-collapse collapse"aria-labelledby="heading-2-6"data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Paystack') }}</h5>
                                                                <small>
                                                                    {{ __('Note: This detail will use for make checkout of shopping cart.') }}</small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_paystack_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_paystack_enabled"
                                                                        id="is_paystack_enabled"
                                                                        {{ isset($store_payment_setting['is_paystack_enabled']) && $store_payment_setting['is_paystack_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="is_paystack_enabled">{{ __('Enable Paystack') }}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id"
                                                                        class="col-form-label">{{ __('Public Key') }}</label>
                                                                    <input type="text" name="paystack_public_key"
                                                                        id="paystack_public_key" class="form-control"
                                                                        value="{{ isset($store_payment_setting['paystack_public_key']) ? $store_payment_setting['paystack_public_key'] : '' }}"
                                                                        placeholder="{{ __('Public Key') }}" />
                                                                    @if ($errors->has('paystack_public_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('paystack_public_key') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key"
                                                                        class="col-form-label">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="paystack_secret_key"
                                                                        id="paystack_secret_key" class="form-control"
                                                                        value="{{ isset($store_payment_setting['paystack_secret_key']) ? $store_payment_setting['paystack_secret_key'] : '' }}"
                                                                        placeholder="{{ __('Secret Key') }}" />
                                                                    @if ($errors->has('paystack_secret_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('paystack_secret_key') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>








                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer ">
                                    <div class="col-sm-12">
                                        <div class="text-end">
                                            {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary']) }}
                                        </div>
                                    </div>
                                </div>

                                {{ Form::close() }}
                            </div>

                        </div>

                        <div id="store_email_setting" class="card">

                            <div class="card-header">
                                <h5>{{ __('Mail Setting') }}</h5>
                            </div>
                            {{ Form::open(['route' => ['owner.email.setting', $store_settings->slug], 'method' => 'post']) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_driver', __('Mail Driver')) }}
                                        {{ Form::text('mail_driver', $store_settings->mail_driver, ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')]) }}
                                        @error('mail_driver')
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_host', __('Mail Host')) }}
                                        {{ Form::text('mail_host', $store_settings->mail_host, ['class' => 'form-control ', 'placeholder' => __('Enter Mail Host')]) }}
                                        @error('mail_host')
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_port', __('Mail Port')) }}
                                        {{ Form::text('mail_port', $store_settings->mail_port, ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')]) }}
                                        @error('mail_port')
                                            <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_username', __('Mail Username')) }}
                                        {{ Form::text('mail_username', $store_settings->mail_username, ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')]) }}
                                        @error('mail_username')
                                            <span class="invalid-mail_username" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_password', __('Mail Password')) }}
                                        {{ Form::text('mail_password', $store_settings->mail_password, ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')]) }}
                                        @error('mail_password')
                                            <span class="invalid-mail_password" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_encryption', __('Mail Encryption')) }}
                                        {{ Form::text('mail_encryption', $store_settings->mail_encryption, ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')]) }}
                                        @error('mail_encryption')
                                            <span class="invalid-mail_encryption" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_from_address', __('Mail From Address')) }}
                                        {{ Form::text('mail_from_address', $store_settings->mail_from_address, ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')]) }}
                                        @error('mail_from_address')
                                            <span class="invalid-mail_from_address" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_from_name', __('Mail From Name')) }}
                                        {{ Form::text('mail_from_name', $store_settings->mail_from_name, ['class' => 'form-control', 'placeholder' => __('Enter Mail From Name')]) }}
                                        @error('mail_from_name')
                                            <span class="invalid-mail_from_name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <a href="#" data-url="{{ route('test.mail') }}"
                                            data-ajax-popup="true" data-title="{{ __('Send Test Mail') }}"
                                            class="send_email btn btn-xs btn-primary">
                                            {{ __('Send Test Mail') }}
                                        </a>
                                    </div>
                                    <div class="form-group col-md-6 text-end">
                                        {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary']) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>

                        <div id="whatsapp_custom_massage" class="card">

                            <div class="card-header">
                                <h5>{{ __('WhatsApp Mail Setting') }}</h5>
                            </div>
                            {{ Form::model($store_settings, ['route' => ['customMassage', $store_settings->slug], 'method' => 'POST']) }}
                            <div class="card-body">
                                <div class="row text-xs">
                                    <div class="col-6">
                                        <h6 class="font-weight-bold">{{ __('Order Variable') }}</h6>
                                        <div class="col-6 float-left">
                                            <p class="mb-1">{{ __('Store Name') }} : <span
                                                    class="pull-right text-primary">{store_name}</span></p>
                                            <p class="mb-1">{{ __('Order No') }} : <span
                                                    class="pull-right text-primary">{order_no}</span></p>
                                            <p class="mb-1">{{ __('Customer Name') }} : <span
                                                    class="pull-right text-primary">{customer_name}</span></p>
                                            <p class="mb-1">{{ __('Phone') }} : <span
                                                    class="pull-right text-primary">{phone}</span></p>
                                            <p class="mb-1">{{ __('Billing Address') }} : <span
                                                    class="pull-right text-primary">{billing_address}</span></p>
                                            <p class="mb-1">{{ __('Shipping Address') }} : <span
                                                    class="pull-right text-primary">{shipping_address}</span></p>
                                            <p class="mb-1">{{ __('Special Instruct') }} : <span
                                                    class="pull-right text-primary">{special_instruct}</span></p>
                                        </div>
                                        <p class="mb-1">{{ __('Item Variable') }} : <span
                                                class="pull-right text-primary">{item_variable}</span></p>
                                        <p class="mb-1">{{ __('Qty Total') }} : <span
                                                class="pull-right text-primary">{qty_total}</span></p>
                                        <p class="mb-1">{{ __('Sub Total') }} : <span
                                                class="pull-right text-primary">{sub_total}</span></p>
                                        <p class="mb-1">{{ __('Discount Amount') }} : <span
                                                class="pull-right text-primary">{discount_amount}</span></p>
                                        <p class="mb-1">{{ __('Shipping Amount') }} : <span
                                                class="pull-right text-primary">{shipping_amount}</span></p>
                                        <p class="mb-1">{{ __('Total Tax') }} : <span
                                                class="pull-right text-primary">{total_tax}</span></p>
                                        <p class="mb-1">{{ __('Final Total') }} : <span
                                                class="pull-right text-primary">{final_total}</span></p>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="font-weight-bold">{{ __('Item Variable') }}</h6>
                                        <p class="mb-1">{{ __('Sku') }} : <span
                                                class="pull-right text-primary">{sku}</span></p>
                                        <p class="mb-1">{{ __('Quantity') }} : <span
                                                class="pull-right text-primary">{quantity}</span></p>
                                        <p class="mb-1">{{ __('Product Name') }} : <span
                                                class="pull-right text-primary">{product_name}</span></p>
                                        <p class="mb-1">{{ __('Variant Name') }} : <span
                                                class="pull-right text-primary">{variant_name}</span></p>
                                        <p class="mb-1">{{ __('Item Tax') }} : <span
                                                class="pull-right text-primary">{item_tax}</span></p>
                                        <p class="mb-1">{{ __('Item total') }} : <span
                                                class="pull-right text-primary">{item_total}</span></p>
                                        <div class="form-group">
                                            <label for="storejs" class="col-form-label">{item_variable}</label>
                                            {{ Form::text('item_variable', null, ['class' => 'form-control', 'placeholder' => '{quantity} x {product_name} - {variant_name} + {item_tax} = {item_total}']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 px-4 language-form-wrap">
                                <!-- <div class="card">
                                            <div class="card-body"> -->
                                <div class="row">
                                    <div class="form-group col-12">
                                        {{ Form::label('content', __('Whatsapp Message'), ['class' => 'col-form-label text-dark']) }}
                                        {{ Form::textarea('content', null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <div class="form-group col-md-12 text-end">
                                            {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary']) }}
                                        </div>
                                    </div>
                                </div>
                                <!-- </div>
                                        </div> -->
                            </div>
                            {{ Form::close() }}
                        </div>

                        <div id="twilio_setting" class="card">
                            <form method="POST" action="{{ route('owner.twilio.setting', $store_settings->slug) }}"
                                accept-charset="UTF-8">
                                @csrf
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>{{ __('Twilio Setting') }}</h5>
                                            <small>{{ __('This detail will use for enable twilio') }}</small>
                                        </div>
                                        <div class="col-6 text-end">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_twilio_enabled" id="twilio_module"
                                                    data-toggle="switchbutton"
                                                    {{ $store_settings['is_twilio_enabled'] == 'on' ? 'checked=checked' : '' }}
                                                    data-onstyle="primary">
                                                <label class="form-check-labe" for="twilio_module"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <label for="twilio_token"
                                                class="col-form-label">{{ __('Twilio SID') }}</label>
                                            <input class="form-control" name="twilio_sid" type="text"
                                                value="{{ $store_settings->twilio_sid }}" id="twilio_sid">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <label for="twilio_token"
                                                class="col-form-label">{{ __('Twilio Token') }}</label>
                                            <input class="form-control " name="twilio_token" type="text"
                                                value="{{ $store_settings->twilio_token }}" id="twilio_token">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <label for="twilio_from"
                                                class="col-form-label">{{ __('Twilio From') }}</label>
                                            <input class="form-control " name="twilio_from" type="text"
                                                value="{{ $store_settings->twilio_from }}" id="twilio_from">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <label for="notification_number"
                                                class="col-form-label">{{ __('Notification Number') }}</label>
                                            <input class="form-control " name="notification_number" type="text"
                                                value="{{ $store_settings->notification_number }}"
                                                id="notification_number">
                                            <small>{{ __('* Use country code with your number *') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12  text-end">
                                        <input type="submit" value="{{ __('Save Changes') }}"
                                            class="btn btn-xs btn-primary">
                                    </div>

                                </div>
                            </form>
                        </div>
                    @endif
                    @if (Auth::user()->type == 'super admin')
                        <div class="active card" id="site_setting">
                            <div class="card-header">
                                <h5>{{ __('Site Setting') }}</h5>
                            </div>
                            {{ Form::model($settings, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>{{ __('Logo dark') }}</h5>
                                            </div>
                                            <div class="card-body mt-3">
                                                <div class=" setting-card">
                                                    <div class="logo-content mt-4">
                                                        {{-- <a href="{{asset(Storage::url('uploads/logo/logo-dark.png'))}}" target="_blank">
                                                                <img src="{{asset(Storage::url('uploads/logo/logo-dark.png'))}}" width="170px"  class="big-logo" id="adminlogoDark">
                                                            </a> --}}
                                                        <a href="{{ $logo . 'logo-dark.png' }}" target="_blank">
                                                            <img id="adminlogoDark" alt="your image"
                                                                src="{{ $logo . 'logo-dark.png' }}" width="150px"
                                                                class="big-logo">
                                                        </a>
                                                    </div>
                                                    <div class="choose-files mt-5 ">
                                                        <label for="dark_logo">
                                                            <div class=" bg-primary  m-auto"> <i
                                                                    class="ti ti-upload px-1"></i>{{ __('Select image') }}
                                                            </div>
                                                            <input type="file" class="form-control file"
                                                                name="dark_logo" id="dark_logo"
                                                                data-filename="darklogo_update"
                                                                onchange="document.getElementById('adminlogoDark').src = window.URL.createObjectURL(this.files[0])">
                                                        </label>
                                                    </div>
                                                    @error('logo')
                                                        <div class="row">
                                                            <span class="invalid-logo" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>{{ __('Logo Light') }}</h5>
                                            </div>
                                            <div class="card-body mt-3">
                                                <div class=" setting-card">
                                                    <div class="logo-content mt-4">

                                                        {{-- <a href="{{asset(Storage::url('uploads/logo/logo-light.png'))}}" target="_blank">
                                                            <img src="{{asset(Storage::url('uploads/logo/logo-light.png'))}}" width="170px"  class="big-logo img_setting" id="adminLogoLight">
                                                            </a> --}}
                                                        <a href="{{ $logo . 'logo-light.png' }}" target="_blank">
                                                            <img id="adminLogoLight" alt="your image"
                                                                src="{{ $logo . 'logo-light.png' }}" width="150px"
                                                                class="big-logo img_setting">
                                                        </a>
                                                    </div>
                                                    <div class="choose-files mt-5 ">
                                                        <label for="light_logo">
                                                            <div class=" bg-primary  m-auto"> <i
                                                                    class="ti ti-upload px-1"></i>{{ __('Select image') }}
                                                            </div>
                                                            <input type="file" class="form-control file"
                                                                name="light_logo" id="light_logo"
                                                                data-filename="light_logo_update"
                                                                onchange="document.getElementById('adminLogoLight').src = window.URL.createObjectURL(this.files[0])">
                                                        </label>
                                                    </div>
                                                    @error('logo_light')
                                                        <div class="row">
                                                            <span class="invalid-logo" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>{{ __('Favicon') }}</h5>
                                            </div>
                                            <div class="card-body admin_favicon pt-6">
                                                <div class=" setting-card">
                                                    <div class="logo-content mt-4">
                                                        {{-- <a href="{{$logo.'/'.'favicon.png'}}" target="_blank">
                                                            <img src="{{$logo.'/'.'favicon.png'}}" width="50px"
                                                                class="img_setting" id="faviConLoGo">
                                                            </a> --}}
                                                        <a href="{{ $logo . (isset($logo) && !empty($logo) ? $logo : 'favicon.png') }}"
                                                            target="_blank">
                                                            <img id="faviConLoGo" alt="your image"
                                                                src="{{ $logo . 'favicon.png' }}" width="50px"
                                                                class="img_setting">
                                                        </a>
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <label for="favicon">
                                                            <div class=" bg-primary  m-auto"> <i
                                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                            </div>
                                                            <input type="file" class="form-control file"
                                                                id="favicon" name="favicon"
                                                                data-filename="favicon_update"
                                                                onchange="document.getElementById('faviConLoGo').src = window.URL.createObjectURL(this.files[0])">
                                                        </label>
                                                    </div>
                                                    @error('favicon')
                                                        <div class="row">
                                                            <span class="invalid-logo" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        {{ Form::label('title_text', __('Title Text'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Title Text')]) }}
                                        @error('title_text')
                                            <span class="invalid-title_text" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('footer_text', __('Footer Text'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('footer_text', null, ['class' => 'form-control', 'placeholder' => __('Footer Text')]) }}
                                        @error('footer_text')
                                            <span class="invalid-footer_text" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        {{ Form::label('default_language', __('Default Language'), ['class' => 'col-form-label']) }}
                                        <div class="changeLanguage">
                                            <select name="default_language" id="default_language"
                                                class="form-control custom-select" data-toggle="select">
                                                @foreach (\App\Models\Utility::languages() as $language)
                                                    <option @if ($lang == $language) selected @endif
                                                        value="{{ $language }}">{{ Str::upper($language) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('currency_symbol', __('Currency Symbol *'), ['class' => 'col-form-label']) }}
                                            {{ Form::text('currency_symbol', null, ['class' => 'form-control']) }}
                                            <small>{{ __('Note: This value will assign when any new store created by Store Owner.') }}</small>
                                            @error('currency_symbol')
                                                <span class="invalid-currency_symbol" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('currency', __('Currency *'), ['class' => 'col-form-label']) }}
                                            {{ Form::text('currency', null, ['class' => 'form-control font-style']) }}
                                            {{ __('Note: Add currency code as per three-letter ISO code.') }}
                                            <small>
                                                <a href="https://stripe.com/docs/currencies"
                                                    target="_blank">{{ __('you can find out here..') }}</a>
                                            </small>
                                            <br>
                                            <small>
                                                {{ __('This value will assign when any new store created by Store Owner.') }}
                                            </small>

                                            @error('currency')
                                                <span class="invalid-currency" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        {{ Form::label('gdpr_cookie', __('GDPR Cookie'), ['class' => 'col-form-label']) }}

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input gdpr_fulltime gdpr_type"
                                                name="gdpr_cookie" data-toggle="switchbutton" id="gdpr_cookie"
                                                {{ isset($settings['gdpr_cookie']) && $settings['gdpr_cookie'] == 'on' ? 'checked="checked"' : '' }}>
                                            <label class="form-check-labe" for="gdpr_cookie"></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        {{ Form::label('display_landing_page_', __('Landing Page Display'), ['class' => 'col-form-label']) }}
                                        <div class="col-12 mt-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    name="display_landing_page" data-toggle="switchbutton"
                                                    id="display_landing_page"
                                                    {{ $settings['display_landing_page'] == 'on' ? 'checked="checked"' : '' }}>
                                                <label class="form-check-labe" for="display_landing_page"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        {{ Form::label('SITE_RTL', __('RTL'), ['class' => 'col-form-label']) }}
                                        <div class="col-12 mt-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" data-toggle="switchbutton"
                                                    class="custom-control-input" name="SITE_RTL" id="SITE_RTL"
                                                    value="on" {{ $SITE_RTL == 'on' ? 'checked="checked"' : '' }}>
                                                <label class="form-check-labe" for="SITE_RTL"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        {{ Form::label('signup_button', __('Sign Up'), ['class' => 'col-form-label']) }}
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-toggle="switchbutton"
                                                class="custom-control-input" name="signup_button" id="signup_button"
                                                {{ isset($settings['signup_button']) && $settings['signup_button'] == 'on' ? 'checked="checked"' : '' }}>
                                            <label class="form-check-labe" for="signup_button"></label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group col-md-12">
                                    @if (App\Models\Utility::getValByName('gdpr_cookie') == 'on')

                                        {{ Form::label('cookie_text', __('GDPR Cookie Text'), ['class' => 'col-form-label fulltime']) }}

                                        {!! Form::textarea('cookie_text', $settings['cookie_text'], [
                                            'class' => 'form-control fulltime',
                                            'rows' => '2',
                                            'style' => 'display: hidden;height: auto !important;resize:none;',
                                        ]) !!}
                                    @endif
                                </div>

                                <h4 class="small-title">{{ __('Theme Customizer') }}</h4>
                                <div class="setting-card setting-logo-box p-3">
                                    <div class="row">
                                        <div class="col-4 my-auto">
                                            <h6 class="mt-3">
                                                <i data-feather="credit-card"
                                                    class="me-2"></i>{{ __('Primary color settings') }}
                                            </h6>
                                            <hr class="my-2" />
                                            <div class="theme-color themes-color">
                                                <a href="#!"
                                                    class="{{ $settings['color'] == 'theme-1' ? 'active_color' : '' }}"
                                                    data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                <input type="radio" class="theme_color" name="color"
                                                    value="theme-1" style="display: none;">
                                                <a href="#!"
                                                    class="{{ $settings['color'] == 'theme-2' ? 'active_color' : '' }}"
                                                    data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                <input type="radio" class="theme_color" name="color"
                                                    value="theme-2" style="display: none;">
                                                <a href="#!"
                                                    class="{{ $settings['color'] == 'theme-3' ? 'active_color' : '' }}"
                                                    data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                <input type="radio" class="theme_color" name="color"
                                                    value="theme-3" style="display: none;">
                                                <a href="#!"
                                                    class="{{ $settings['color'] == 'theme-4' ? 'active_color' : '' }}"
                                                    data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                <input type="radio" class="theme_color" name="color"
                                                    value="theme-4" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="col-4 my-auto">
                                            <h6>
                                                <i data-feather="layout"
                                                    class="me-2"></i>{{ __('Sidebar settings') }}
                                            </h6>
                                            <hr class="my-2" />
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="cust-theme-bg"
                                                    name="cust_theme_bg"
                                                    {{ Utility::getValByName('cust_theme_bg') == 'on' ? 'checked' : '' }} />
                                                <label class="form-check-label f-w-600 pl-1"
                                                    for="cust-theme-bg">{{ __('Transparent layout') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-4 my-auto">
                                            <h6>
                                                <i data-feather="sun" class="me-2"></i>{{ __('Layout settings') }}
                                            </h6>
                                            <hr class="my-2" />
                                            <div class="form-check form-switch mt-2">
                                                <input type="checkbox" class="form-check-input" id="cust-darklayout"
                                                    name="cust_darklayout"{{ Utility::getValByName('cust_darklayout') == 'on' ? 'checked' : '' }} />
                                                <label class="form-check-label f-w-600 pl-1"
                                                    for="cust-darklayout">{{ __('Dark Layout') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice  btn-primary m-r-10']) }}
                                </div>

                            </div>
                            {{ Form::close() }}
                        </div>

                        <div class="card" id="payment-setting">
                            <div class="card-header">
                                <h5>{{ __('Payment Setting') }}</h5>
                            </div>
                            <div class="card-body">
                                {{ Form::open(['route' => 'payment.setting', 'method' => 'post']) }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('currency', __('Currency *'), ['class' => 'col-form-label']) }}
                                            {{ Form::text('currency', env('CURRENCY'), ['class' => 'form-control font-style', 'required']) }}
                                            {{ __('Note: Add currency code as per three-letter ISO code.') }}
                                            <small>
                                                <a href="https://stripe.com/docs/currencies"
                                                    target="_blank">{{ __('you can find out here..') }}</a>
                                            </small>
                                            @error('currency')
                                                <span class="invalid-currency" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('currency_symbol', __('Currency Symbol *'), ['class' => 'col-form-label']) }}
                                            {{ Form::text('currency_symbol', env('CURRENCY_SYMBOL'), ['class' => 'form-control', 'required']) }}
                                            @error('currency_symbol')
                                                <span class="invalid-currency_symbol" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class=" pb-3">
                                    <hr>
                                </div>

                                <div class="faq justify-content-center">
                                    <div class="col-sm-12 col-md-10 col-xxl-12">
                                        <div class="accordion accordion-flush" id="accordionExample">

                                            <!-- Strip -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-2">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse1"
                                                        aria-expanded="true" aria-controls="collapse1">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Stripe') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse1"
                                                    class="accordion-collapse collapse"aria-labelledby="heading-2-2"data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Stripe') }}</h5>
                                                                <small>
                                                                    {{ __('Note: This detail will use for make checkout of shopping cart.') }}</small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_stripe_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="is_stripe_enabled" id="is_stripe_enabled"
                                                                        {{ isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                    <label class="custom-control-label form-control-label"
                                                                        for="is_stripe_enabled">{{ __('Enable Stripe') }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('stripe_key', __('Stripe Key'), ['class' => 'col-form-label']) }}
                                                                    {{ Form::text('stripe_key', isset($admin_payment_setting['stripe_key']) ? $admin_payment_setting['stripe_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Stripe Key')]) }}
                                                                    @error('stripe_key')
                                                                        <span class="invalid-stripe_key" role="alert">
                                                                            <strong
                                                                                class="text-danger">{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('stripe_secret', __('Stripe Secret'), ['class' => 'col-form-label']) }}
                                                                    {{ Form::text('stripe_secret', isset($admin_payment_setting['stripe_secret']) ? $admin_payment_setting['stripe_secret'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Stripe Secret')]) }}
                                                                    @error('stripe_secret')
                                                                        <span class="invalid-stripe_secret" role="alert">
                                                                            <strong
                                                                                class="text-danger">{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-4">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse3"
                                                        aria-expanded="true" aria-controls="collapse3">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Paystack') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse3"
                                                    class="accordion-collapse collapse"aria-labelledby="heading-2-4"data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Paystack') }}</h5>
                                                                <small>
                                                                    {{ __('Note: This detail will use for make checkout of shopping cart.') }}</small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_paystack_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="is_paystack_enabled"
                                                                        id="is_paystack_enabled"
                                                                        {{ isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                    <label class="custom-control-label form-control-label"
                                                                        for="is_paystack_enabled">{{ __('Enable Paystack') }}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id"
                                                                        class="col-form-label">{{ __('Public Key') }}</label>
                                                                    <input type="text" name="paystack_public_key"
                                                                        id="paystack_public_key" class="form-control"
                                                                        value="{{ isset($admin_payment_setting['paystack_public_key']) ? $admin_payment_setting['paystack_public_key'] : '' }}"
                                                                        placeholder="{{ __('Public Key') }}" />
                                                                    @if ($errors->has('paystack_public_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('paystack_public_key') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key"
                                                                        class="col-form-label">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="paystack_secret_key"
                                                                        id="paystack_secret_key" class="form-control"
                                                                        value="{{ isset($admin_payment_setting['paystack_secret_key']) ? $admin_payment_setting['paystack_secret_key'] : '' }}"
                                                                        placeholder="{{ __('Secret Key') }}" />
                                                                    @if ($errors->has('paystack_secret_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('paystack_secret_key') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-5">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse4"
                                                        aria-expanded="true" aria-controls="collapse4">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Flutterwave') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse4"
                                                    class="accordion-collapse collapse"aria-labelledby="heading-2-5"data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Flutterwave') }}</h5>
                                                                <small>
                                                                    {{ __('Note: This detail will use for make checkout of shopping cart.') }}</small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_flutterwave_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="is_flutterwave_enabled"
                                                                        id="is_flutterwave_enabled"
                                                                        {{ isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                    <label class="custom-control-label form-control-label"
                                                                        for="is_flutterwave_enabled">{{ __('Enable Flutterwave') }}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id"
                                                                        class="col-form-label">{{ __('Public Key') }}</label>
                                                                    <input type="text" name="flutterwave_public_key"
                                                                        id="flutterwave_public_key" class="form-control"
                                                                        value="{{ isset($admin_payment_setting['flutterwave_public_key']) ? $admin_payment_setting['flutterwave_public_key'] : '' }}"
                                                                        placeholder="{{ __('Public Key') }}" />
                                                                    @if ($errors->has('flutterwave_public_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('flutterwave_public_key') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key"
                                                                        class="col-form-label">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="flutterwave_secret_key"
                                                                        id="flutterwave_secret_key" class="form-control"
                                                                        value="{{ isset($admin_payment_setting['flutterwave_secret_key']) ? $admin_payment_setting['flutterwave_secret_key'] : '' }}"
                                                                        placeholder="{{ __('Secret Key') }}" />
                                                                    @if ($errors->has('flutterwave_secret_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('flutterwave_secret_key') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-6">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse5"
                                                        aria-expanded="true" aria-controls="collapse5">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Razorpay') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse5"
                                                    class="accordion-collapse collapse"aria-labelledby="heading-2-6"data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Razorpay') }}</h5>
                                                                <small>
                                                                    {{ __('Note: This detail will use for make checkout of shopping cart.') }}</small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_razorpay_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="is_razorpay_enabled"
                                                                        id="is_razorpay_enabled"
                                                                        {{ isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                    <label class="custom-control-label form-control-label"
                                                                        for="is_razorpay_enabled">{{ __('Enable Razorpay') }}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id"
                                                                        class="col-form-label">{{ __('Public Key') }}</label>

                                                                    <input type="text" name="razorpay_public_key"
                                                                        id="razorpay_public_key" class="form-control"
                                                                        value="{{ isset($admin_payment_setting['razorpay_public_key']) ? $admin_payment_setting['razorpay_public_key'] : '' }}"
                                                                        placeholder="{{ __('Public Key') }}" />
                                                                    @if ($errors->has('razorpay_public_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('razorpay_public_key') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key"
                                                                        class="col-form-label">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="razorpay_secret_key"
                                                                        id="razorpay_secret_key" class="form-control"
                                                                        value="{{ isset($admin_payment_setting['razorpay_secret_key']) ? $admin_payment_setting['razorpay_secret_key'] : '' }}"
                                                                        placeholder="{{ __('Secret Key') }}" />
                                                                    @if ($errors->has('razorpay_secret_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('razorpay_secret_key') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-9">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse8"
                                                        aria-expanded="true" aria-controls="collapse8">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Mollie') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse8"
                                                    class="accordion-collapse collapse"aria-labelledby="heading-2-9"data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Mollie') }}</h5>
                                                                <small>
                                                                    {{ __('Note: This detail will use for make checkout of shopping cart.') }}</small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_mollie_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="is_mollie_enabled" id="is_mollie_enabled"
                                                                        {{ isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                    <label class="custom-control-label form-control-label"
                                                                        for="is_mollie_enabled">{{ __('Enable Mollie') }}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_api_key"
                                                                        class="col-form-label">{{ __('Mollie Api Key') }}</label>
                                                                    <input type="text" name="mollie_api_key"
                                                                        id="mollie_api_key" class="form-control"
                                                                        value="{{ isset($admin_payment_setting['mollie_api_key']) ? $admin_payment_setting['mollie_api_key'] : '' }}"
                                                                        placeholder="{{ __('Mollie Api Key') }}" />
                                                                    @if ($errors->has('mollie_api_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('mollie_api_key') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_profile_id"
                                                                        class="col-form-label">{{ __('Mollie Profile Id') }}</label>
                                                                    <input type="text" name="mollie_profile_id"
                                                                        id="mollie_profile_id" class="form-control"
                                                                        value="{{ isset($admin_payment_setting['mollie_profile_id']) ? $admin_payment_setting['mollie_profile_id'] : '' }}"
                                                                        placeholder="{{ __('Mollie Profile Id') }}" />
                                                                    @if ($errors->has('mollie_profile_id'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('mollie_profile_id') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_partner_id"
                                                                        class="col-form-label">{{ __('Mollie Partner Id') }}</label>
                                                                    <input type="text" name="mollie_partner_id"
                                                                        id="mollie_partner_id" class="form-control"
                                                                        value="{{ isset($admin_payment_setting['mollie_partner_id']) ? $admin_payment_setting['mollie_partner_id'] : '' }}"
                                                                        placeholder="{{ __('Mollie Partner Id') }}" />
                                                                    @if ($errors->has('mollie_partner_id'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('mollie_partner_id') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-11">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse10"
                                                        aria-expanded="true" aria-controls="collapse10">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('CoinGate') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse10"
                                                    class="accordion-collapse collapse"aria-labelledby="heading-2-11"data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('CoinGate') }}</h5>
                                                                <small>
                                                                    {{ __('Note: This detail will use for make checkout of shopping cart.') }}</small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_coingate_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="is_coingate_enabled"
                                                                        id="is_coingate_enabled"
                                                                        {{ isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                    <label class="custom-control-label form-control-label"
                                                                        for="is_coingate_enabled">{{ __('Enable CoinGate') }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 pb-4">
                                                                <label class="coingate-label form-control-label"
                                                                    for="coingate_mode">{{ __('CoinGate Mode') }}</label>
                                                                <br>

                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio"
                                                                                        name="coingate_mode"
                                                                                        value="sandbox"
                                                                                        class="form-check-input"
                                                                                        {{ (isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == '') || (isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == 'sandbox') ? 'checked="checked"' : '' }}>
                                                                                    {{ __('Sandbox') }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio"
                                                                                        name="coingate_mode"
                                                                                        value="live"
                                                                                        class="form-check-input"
                                                                                        {{ isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                    {{ __('Live') }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="coingate_auth_token"
                                                                        class="col-form-label">{{ __('CoinGate Auth Token') }}</label>
                                                                    <input type="text" name="coingate_auth_token"
                                                                        id="coingate_auth_token" class="form-control"
                                                                        value="{{ isset($admin_payment_setting['coingate_auth_token']) ? $admin_payment_setting['coingate_auth_token'] : '' }}"
                                                                        placeholder="{{ __('CoinGate Auth Token') }}" />
                                                                    @if ($errors->has('coingate_auth_token'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('coingate_auth_token') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-12">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse11"
                                                        aria-expanded="true" aria-controls="collapse11">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Paymentwall') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse11"
                                                    class="accordion-collapse collapse"aria-labelledby="heading-2-12"data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Paymentwall') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_paymentwall_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="is_paymentwall_enabled"
                                                                        id="is_paymentwall_enabled"
                                                                        {{ isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                    <label class="custom-control-label form-control-label"
                                                                        for="is_paymentwall_enabled">{{ __('Enable PaymentWall') }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paymentwall_public_key"
                                                                        class="col-form-label">{{ __('Public Key') }}</label>
                                                                    <input type="text" name="paymentwall_public_key"
                                                                        id="paymentwall_public_key" class="form-control"
                                                                        value="{{ isset($admin_payment_setting['paymentwall_public_key']) ? $admin_payment_setting['paymentwall_public_key'] : '' }}"
                                                                        placeholder="{{ __('Public Key') }}" />
                                                                    @if ($errors->has('paymentwall_public_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('paymentwall_public_key') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paymentwall_private_key"
                                                                        class="col-form-label">{{ __('Private Key') }}</label>
                                                                    <input type="text" name="paymentwall_private_key"
                                                                        id="paymentwall_private_key"
                                                                        class="form-control form-control-label"
                                                                        value="{{ isset($admin_payment_setting['paymentwall_private_key']) ? $admin_payment_setting['paymentwall_private_key'] : '' }}"
                                                                        placeholder="{{ __('Private Key') }}" />
                                                                    @if ($errors->has('paymentwall_private_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('paymentwall_private_key') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice  btn-primary m-r-10']) }}
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>

                        <div class="card" id="email_setting">
                            {{ Form::open(['route' => 'email.setting', 'method' => 'post']) }}
                            <div class="card-header">
                                <h5>{{ __('Email Setting') }}</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_driver', __('Mail Driver'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('mail_driver', env('MAIL_DRIVER'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')]) }}
                                        @error('mail_driver')
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_host', __('Mail Host'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('mail_host', env('MAIL_HOST'), ['class' => 'form-control ', 'placeholder' => __('Enter Mail Host')]) }}
                                        @error('mail_host')
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_port', __('Mail Port'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('mail_port', env('MAIL_PORT'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')]) }}
                                        @error('mail_port')
                                            <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_username', __('Mail Username'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('mail_username', env('MAIL_USERNAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')]) }}
                                        @error('mail_username')
                                            <span class="invalid-mail_username" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_password', __('Mail Password'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('mail_password', env('MAIL_PASSWORD'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')]) }}
                                        @error('mail_password')
                                            <span class="invalid-mail_password" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('mail_encryption', env('MAIL_ENCRYPTION'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')]) }}
                                        @error('mail_encryption')
                                            <span class="invalid-mail_encryption" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_from_address', __('Mail From Address'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('mail_from_address', env('MAIL_FROM_ADDRESS'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')]) }}
                                        @error('mail_from_address')
                                            <span class="invalid-mail_from_address" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('mail_from_name', __('Mail From Name'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('mail_from_name', env('MAIL_FROM_NAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Name')]) }}
                                        @error('mail_from_name')
                                            <span class="invalid-mail_from_name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <a href="#" data-url="{{ route('test.mail') }}"
                                            data-ajax-popup="true" data-title="{{ __('Send Test Mail') }}"
                                            class="send_email btn btn-print-invoice  btn-primary m-r-10">
                                            {{ __('Send Test Mail') }}
                                        </a>
                                    </div>
                                    <div class="form-group col-md-6 text-end">
                                        {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice  btn-primary m-r-10']) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>

                        <div class="card" id="recaptcha-settings">
                            <form method="POST" action="{{ route('recaptcha.settings.store') }}"
                                accept-charset="UTF-8">
                                @csrf
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>{{ __('Recaptcha Setting') }}</h5>
                                            <label class="custom-control-label form-control-label"
                                                for="recaptcha_module">
                                                {{ __('Google Recaptcha') }}
                                                <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                                    target="_blank" class="text-blue">
                                                    <small>({{ __('How to Get Google reCaptcha Site and Secret key') }})</small>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-6 text-end">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" data-toggle="switchbutton"
                                                    class="custom-control-input" name="recaptcha_module"
                                                    id="recaptcha_module" value="yes"
                                                    {{ env('RECAPTCHA_MODULE') == 'yes' ? 'checked="checked"' : '' }}>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-body">

                                    <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="google_recaptcha_key"
                                                class="col-form-label">{{ __('Google Recaptcha Key') }}</label>
                                            <input class="form-control"
                                                placeholder="{{ __('Enter Google Recaptcha Key') }}"
                                                name="google_recaptcha_key" type="text"
                                                value="{{ env('NOCAPTCHA_SITEKEY') }}" id="google_recaptcha_key">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="google_recaptcha_secret"
                                                class="col-form-label">{{ __('Google Recaptcha Secret') }}</label>
                                            <input class="form-control "
                                                placeholder="{{ __('Enter Google Recaptcha Secret') }}"
                                                name="google_recaptcha_secret" type="text"
                                                value="{{ env('NOCAPTCHA_SECRET') }}" id="google_recaptcha_secret">
                                        </div>
                                    </div>
                                    <div class="col-lg-12  text-end mb-5">
                                        {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice  btn-primary m-r-10']) }}
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div id="useradd-13" class="card mb-3">
                            {{ Form::open(['route' => 'storage.setting.store', 'enctype' => 'multipart/form-data']) }}
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <h5 class="">{{ __('Storage Settings') }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="pe-2">
                                        <input type="radio" class="btn-check" name="storage_setting"
                                            id="local-outlined" autocomplete="off"
                                            {{ $settings['storage_setting'] == 'local' ? 'checked' : '' }} value="local"
                                            checked>
                                        <label class="btn btn-outline-primary"
                                            for="local-outlined">{{ __('Local') }}</label>
                                    </div>
                                    <div class="pe-2">
                                        <input type="radio" class="btn-check" name="storage_setting"
                                            id="s3-outlined" autocomplete="off"
                                            {{ $settings['storage_setting'] == 's3' ? 'checked' : '' }} value="s3">
                                        <label class="btn btn-outline-primary" for="s3-outlined">
                                            {{ __('AWS S3') }}</label>
                                    </div>

                                    <div class="pe-2">
                                        <input type="radio" class="btn-check" name="storage_setting"
                                            id="wasabi-outlined" autocomplete="off"
                                            {{ $settings['storage_setting'] == 'wasabi' ? 'checked' : '' }} value="wasabi">
                                        <label class="btn btn-outline-primary"
                                            for="wasabi-outlined">{{ __('Wasabi') }}</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div
                                        class="local-setting row {{ $settings['storage_setting'] == 'local' ? ' ' : 'd-none' }}">
                                        {{-- <h4 class="small-title">{{ __('Local Settings') }}</h4> --}}
                                        <div class="col-lg-6 col-md-11 col-sm-12">
                                            {{ Form::label('local_storage_validation', __('Only Upload Files'), ['class' => ' form-label']) }}
                                            <select name="local_storage_validation[]" class="form-control"
                                                name="choices-multiple-remove-button"
                                                id="choices-multiple-remove-button" placeholder="This is a placeholder"
                                                multiple>
                                                @foreach ($file_type as $f)
                                                    <option @if (in_array($f, $local_storage_validations)) selected @endif>
                                                        {{ $f }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="local_storage_max_upload_size">{{ __('Max upload size ( In KB)') }}</label>
                                                <input type="number" name="local_storage_max_upload_size"
                                                    class="form-control"
                                                    value="{{ !isset($settings['local_storage_max_upload_size']) || is_null($settings['local_storage_max_upload_size']) ? '' : $settings['local_storage_max_upload_size'] }}"
                                                    placeholder="{{ __('Max upload size') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="s3-setting row {{ $settings['storage_setting'] == 's3' ? ' ' : 'd-none' }}">

                                        <div class=" row ">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="s3_key">{{ __('S3 Key') }}</label>
                                                    <input type="text" name="s3_key" class="form-control"
                                                        value="{{ !isset($settings['s3_key']) || is_null($settings['s3_key']) ? '' : $settings['s3_key'] }}"
                                                        placeholder="{{ __('S3 Key') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="s3_secret">{{ __('S3 Secret') }}</label>
                                                    <input type="text" name="s3_secret" class="form-control"
                                                        value="{{ !isset($settings['s3_secret']) || is_null($settings['s3_secret']) ? '' : $settings['s3_secret'] }}"
                                                        placeholder="{{ __('S3 Secret') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="s3_region">{{ __('S3 Region') }}</label>
                                                    <input type="text" name="s3_region" class="form-control"
                                                        value="{{ !isset($settings['s3_region']) || is_null($settings['s3_region']) ? '' : $settings['s3_region'] }}"
                                                        placeholder="{{ __('S3 Region') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="s3_bucket">{{ __('S3 Bucket') }}</label>
                                                    <input type="text" name="s3_bucket" class="form-control"
                                                        value="{{ !isset($settings['s3_bucket']) || is_null($settings['s3_bucket']) ? '' : $settings['s3_bucket'] }}"
                                                        placeholder="{{ __('S3 Bucket') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="s3_url">{{ __('S3 URL') }}</label>
                                                    <input type="text" name="s3_url" class="form-control"
                                                        value="{{ !isset($settings['s3_url']) || is_null($settings['s3_url']) ? '' : $settings['s3_url'] }}"
                                                        placeholder="{{ __('S3 URL') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="s3_endpoint">{{ __('S3 Endpoint') }}</label>
                                                    <input type="text" name="s3_endpoint" class="form-control"
                                                        value="{{ !isset($settings['s3_endpoint']) || is_null($settings['s3_endpoint']) ? '' : $settings['s3_endpoint'] }}"
                                                        placeholder="{{ __('S3 Bucket') }}">
                                                </div>
                                            </div>
                                            <div class="form-group col-8 switch-width">
                                                {{ Form::label('s3_storage_validation', __('Only Upload Files'), ['class' => ' form-label']) }}
                                                <select name="s3_storage_validation[]" class="form-control"
                                                    name="choices-multiple-remove-button"
                                                    id="choices-multiple-remove-button1"
                                                    placeholder="This is a placeholder" multiple>
                                                    @foreach ($file_type as $f)
                                                        <option @if (in_array($f, $s3_storage_validations)) selected @endif>
                                                            {{ $f }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="s3_max_upload_size">{{ __('Max upload size (In KB)') }}</label>
                                                    <input type="number" name="s3_max_upload_size"
                                                        class="form-control"
                                                        value="{{ !isset($settings['s3_max_upload_size']) || is_null($settings['s3_max_upload_size']) ? '' : $settings['s3_max_upload_size'] }}"
                                                        placeholder="{{ __('Max upload size') }}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div
                                        class="wasabi-setting row {{ $settings['storage_setting'] == 'wasabi' ? ' ' : 'd-none' }}">
                                        <div class=" row ">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="s3_key">{{ __('Wasabi Key') }}</label>
                                                    <input type="text" name="wasabi_key" class="form-control"
                                                        value="{{ !isset($settings['wasabi_key']) || is_null($settings['wasabi_key']) ? '' : $settings['wasabi_key'] }}"
                                                        placeholder="{{ __('Wasabi Key') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="s3_secret">{{ __('Wasabi Secret') }}</label>
                                                    <input type="text" name="wasabi_secret" class="form-control"
                                                        value="{{ !isset($settings['wasabi_secret']) || is_null($settings['wasabi_secret']) ? '' : $settings['wasabi_secret'] }}"
                                                        placeholder="{{ __('Wasabi Secret') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="s3_region">{{ __('Wasabi Region') }}</label>
                                                    <input type="text" name="wasabi_region" class="form-control"
                                                        value="{{ !isset($settings['wasabi_region']) || is_null($settings['wasabi_region']) ? '' : $settings['wasabi_region'] }}"
                                                        placeholder="{{ __('Wasabi Region') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="wasabi_bucket">{{ __('Wasabi Bucket') }}</label>
                                                    <input type="text" name="wasabi_bucket" class="form-control"
                                                        value="{{ !isset($settings['wasabi_bucket']) || is_null($settings['wasabi_bucket']) ? '' : $settings['wasabi_bucket'] }}"
                                                        placeholder="{{ __('Wasabi Bucket') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="wasabi_url">{{ __('Wasabi URL') }}</label>
                                                    <input type="text" name="wasabi_url" class="form-control"
                                                        value="{{ !isset($settings['wasabi_url']) || is_null($settings['wasabi_url']) ? '' : $settings['wasabi_url'] }}"
                                                        placeholder="{{ __('Wasabi URL') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="wasabi_root">{{ __('Wasabi Root') }}</label>
                                                    <input type="text" name="wasabi_root" class="form-control"
                                                        value="{{ !isset($settings['wasabi_root']) || is_null($settings['wasabi_root']) ? '' : $settings['wasabi_root'] }}"
                                                        placeholder="{{ __('Wasabi Bucket') }}">
                                                </div>
                                            </div>
                                            <div class="form-group col-8 switch-width">
                                                {{ Form::label('wasabi_storage_validation', __('Only Upload Files'), ['class' => 'form-label']) }}

                                                <select name="wasabi_storage_validation[]" class="form-control"
                                                    name="choices-multiple-remove-button"
                                                    id="choices-multiple-remove-button2"
                                                    placeholder="This is a placeholder" multiple>
                                                    @foreach ($file_type as $f)
                                                        <option @if (in_array($f, $wasabi_storage_validations)) selected @endif>
                                                            {{ $f }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="wasabi_root">{{ __('Max upload size ( In KB)') }}</label>
                                                    <input type="number" name="wasabi_max_upload_size"
                                                        class="form-control"
                                                        value="{{ !isset($settings['wasabi_max_upload_size']) || is_null($settings['wasabi_max_upload_size']) ? '' : $settings['wasabi_max_upload_size'] }}"
                                                        placeholder="{{ __('Max upload size') }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit"
                                        value="{{ __('Save Changes') }}">
                                </div>
                                {{ Form::close() }}
                            </div>
                    @endif
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
    </div>
@endsection
@push('script-page')
    <script src="{{ asset('custom/libs/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>

    <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            show_toastr('Success', "{{ __('Link copied') }}", 'success');
        }

        $(document).on('click', 'input[name="theme_color"]', function() {
            var eleParent = $(this).attr('data-theme');
            var imgpath = $(this).attr('data-imgpath');
            $('.' + eleParent + '_img').attr('src', imgpath);
        });

        $(document).ready(function() {
            setTimeout(function(e) {
                var checked = $("input[type=radio][name='theme_color']:checked");
                $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
            }, 300);
        });
    </script>
@endpush
