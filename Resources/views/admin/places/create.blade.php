@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('iplaces::places.title.create place') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.iplaces.place.index') }}">{{ trans('iplaces::places.title.places') }}</a></li>
        <li class="active">{{ trans('iplaces::places.title.create place') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.iplaces.place.store'], 'method' => 'post']) !!}
    <div class="row ">
        <div class="col-xs-12 col-md-8 ">
            <div class="box box-primary">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('iplaces::admin.places.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach
                        <div class="box-body ">
                            <div class='form-group{{ $errors->has("status") ? ' has-error' : '' }}'>
                                <div>
                                    <label>{{trans('iplaces::status.title')}}</label>
                                </div>
                                <label class="radio-inline" for="{{trans('iplaces::status.inactive')}}">
                                    <input type="radio" id="status" name="status" value="0" checked>
                                    {{trans('iplaces::status.inactive')}}
                                </label>
                                <label class="radio-inline" for="{{trans('iplaces::status.active')}}">
                                    <input type="radio" id="status" name="status" value="1">
                                    {{trans('iplaces::status.active')}}
                                </label>
                            </div>
                           {{-- <div class="form-group">
                                <label for="exampleInputEmail1 ">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>--}}
                        </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.iplaces.place.index')}}">
                            <i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
            </div> {{-- end nav-tabs-custom --}}
            </div>
        </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
            <div class="form-group">
                <label>Category</label>
            </div>
                </div>
                    <div class="box-body">
                <select class="form-control" name="category_id">
                    @if(count($categories))
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}"> {{$category->title}}
                    </option>
                        @endforeach
                    @endif
                </select><br>
                    </div>
                <div class="box-header">
                <label>User</label>
                </div>
              {{--  <select class="form-control" name="user_id">
                    <option value="0">
                        -
                    </option>
                    @if(count($users))
                        @foreach ($users as $user)
                            <option value="{{$user->id}}"> {{$user->title}}
                            </option>
                        @endforeach
                    @endif
                </select>--}}
                <div class="box-body">
                <select name="user_id" id="user" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{$user->id }}" {{$user->id == $currentUser->id ? 'selected' : ''}}>{{$user->present()->fullname()}}
                            - ({{$user->email}})
                        </option>
                    @endforeach
                </select><br>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                    </div>
                    <div class="box-body">
                        @include('iplaces::admin.places.partials.image')
                    </div>
                </div>
            </div>
        </div>
        </div>

        {{--
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{trans('iplaces::places.form.Place Image')}}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <div class="tab-content">
                                @mediaSingle('thumbnail')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        --}}
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.iplaces.place.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'

            });
        });
    </script>
@endpush
<style>

    .nav-tabs-custom > .nav-tabs > li.active {
        border-top-color:white !important;
        border-bottom-color: #3c8dbc !important;
    }
    .nav-tabs-custom > .nav-tabs > li.active > a, .nav-tabs-custom > .nav-tabs > li.active:hover > a {
        background-color: aliceblue !important;

    }


</style>
