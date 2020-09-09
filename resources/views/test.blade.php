@extends('layouts.master')


@section('content')
    <div class="section-header">
        <h1>Advanced Forms</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Forms</a></div>
            <div class="breadcrumb-item">Advanced Forms</div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form method="POST" action="{{ url('apps/'.$app->id) }}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="PUT">

                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Add A New App')}}</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('App Name')}}</label>
                                    <input type="text" class="form-control" name="app_name" value="{{ old('app_name') ?: $app->app_name }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('app_name') }}</p>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('App Status')}}</label>
                                    <select class="form-control" name="status">
                                        <option value="active" {{ $app->status == 'active' ? 'selected' : '' }}>{{__('Active')}}</option>
                                        <option value="inactive" {{ $app->status == 'inactive' ? 'selected' : '' }}>{{__('Inactive')}}</option>
                                    </select>
                                </div>
                                <p class="text-danger">{{ $errors->first('status') }}</p>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('Country Deny List')}}</label>
                                    <select class="form-control select2" multiple="" name="blocked_countries[]">
                                        @foreach( $countries as $country)
                                            <option value="{{$country->id}}"
                                                {{$app->getBlockedCountries()->find($country->id) ? 'selected' : ''}}>
                                                {{$country->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="features">

                                    @foreach( $app->app_features as $item)
                                        <div id="feature-id-{{$loop->iteration}}" class="row feature">
                                            <div class="col-md-5">
                                                <label>Feature Name</label>
                                                <input type="text" class="form-control" name="feature[{{$loop->iteration}}][name]" value="{{$item['name']}}">
                                            </div>
                                            <div class="col-md-5">
                                                <label>Feature Details</label>
                                                <input type="text" class="form-control" name="feature[{{$loop->iteration}}][details]" value="{{$item['details']}}">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger remove-feature-btn form-control" data-id="{{$loop->iteration}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                                <button type="button" class="btn btn-primary btn-lg add-feature-btn float-right">{{__('Add Feature')}}</button>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection


@push('styles')
    <link rel="stylesheet" href="{{asset('stisla/assets/modules/select2/dist/css/select2.min.css')}}"/>
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #e4e4e4;
            border: 1px solid #aaa;
            border-radius: 4px;
            cursor: default;
            float: left;
            margin-right: 5px;
            margin-top: 5px;
            padding: 0 5px;
            color: black;
        }

        .remove-feature-btn{
            margin-top: 29px;
        }

        .feature{
            margin-top: 9px;
        }

        .add-feature-btn{
            margin-top: 10px;
        }

    </style>
@endpush

@push('scripts')
    <script src="{{asset('stisla/assets/modules/select2/dist/js/select2.min.js')}}"></script>

    <script>
        let i = {{count($app->app_features)}};

        $(document).on('click', '.add-feature-btn', function (){
            i++;
            let feature = '<div id="feature-id-'+i+'" class="row feature">' +
                '<div class="col-md-5"><label>Feature Name</label>' +
                '<input type="text" class="form-control" name="feature['+i+'][name]"></div>' +
                '<div class="col-md-5"><label>Feature Details</label>' +
                '<input type="text" class="form-control" name="feature['+i+'][details]"></div>' +
                '<div class="col-md-2">' +
                '   <button type="button" class="btn btn-danger remove-feature-btn form-control" data-id="'+i+'">Remove</button></div>' +
                '</div>'

            $('.features').append(feature);
        });

        $(document).on('click', '.remove-feature-btn', function (){
            let button_id = $(this).data('id');
            console.log(button_id)
            $('#feature-id-'+button_id).remove();
        })
    </script>
@endpush
