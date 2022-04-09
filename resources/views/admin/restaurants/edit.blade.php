@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('global.restaurant.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.restaurants.update", [$restaurant->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                       <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('global.restaurant.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($restaurant) ? $restaurant->name : '') }}">
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.restaurant.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                            <label for="code">{{ trans('global.restaurant.fields.code') }}*</label>
                            <input type="text" id="code" name="code" class="form-control" value="{{ old('code', isset($restaurant) ? $restaurant->code : '') }}">
                            @if($errors->has('code'))
                                <p class="help-block">
                                    {{ $errors->first('code') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.restaurant.fields.code_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('global.restaurant.fields.description') }}*</label>
                            <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($restaurant) ? $restaurant->description : '') }}">
                            @if($errors->has('description'))
                                <p class="help-block">
                                    {{ $errors->first('description') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.restaurant.fields.description_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                            <label for="phone_number">{{ trans('global.restaurant.fields.phone_number') }}*</label>
                            <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', isset($restaurant) ? $restaurant->phone_number : '') }}">
                            @if($errors->has('phone_number'))
                                <p class="help-block">
                                    {{ $errors->first('phone_number') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.restaurant.fields.phone_number_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('global.restaurant.fields.email') }}*</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($restaurant) ? $restaurant->email : '') }}">
                            @if($errors->has('email'))
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.restaurant.fields.email_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('file_name') ? 'has-error' : '' }}">
                            <label for="file_name">{{ trans('global.restaurant.fields.image') }}*</label>
                            <input type="file" id="file_name" name="file_name" class="form-control" value="{{ old('file_name', isset($restaurant_images) ? $restaurant_images->file_name : '') }}">
                            <div class="{{isset($restaurant) ? 'show' : 'hide'}}">
                            <img src="{{url('storage/restaurant_images/').'/'.old('id',$restaurant->id).'/'.$restaurant_images->file_name}}" class="img-rounded" alt="restaurant_image" width="50" height="50">
                            </div>
                                        </td>
                            @if($errors->has('file_name'))
                                <p class="help-block">
                                    {{ $errors->first('file_name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.restaurant.fields.image_helper') }}
                            </p>
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection