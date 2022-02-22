@extends('layouts.app')

@section('title', __('outlet.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Outlet)
            <a href="{{ route('datas.create') }}" class="btn btn-success">{{ __('outlet.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('outlet.list') }} <small>{{ __('app.total') }} : {{ $datas->total() }} {{ __('outlet.outlet') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="control-label">{{ __('outlet.search') }}</label>
                        <input placeholder="{{ __('outlet.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('outlet.search') }}" class="btn btn-secondary">
                    <a href="{{ route('datas.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('outlet.name') }}</th>
                        <!-- <th>{{ __('outlet.address') }}</th> -->
                        <th>{{ __('outlet.asn') }}</th>
                        <th>{{ __('outlet.latitude') }}</th>
                        <th>{{ __('outlet.longitude') }}</th>
                        <!-- <th class="text-center">{{ __('app.action') }}</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $key => $data)
                    <tr>
                        <td class="text-center">{{ $datas->firstItem() + $key }}</td>
                        <td><u style="color: blue;">{!! $data->name_link !!}</u></td>
                        <!-- <td>{{ $data->address }}</td> -->
                        <td>{{ $data->asn }}</td>
                        <td>{{ $data->latitude }}</td>
                        <td>{{ $data->longitude }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $datas->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
