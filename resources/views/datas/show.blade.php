@extends('layouts.app')

@section('title', __('outlet.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('outlet.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('outlet.name') }}</td><td>{{ $data->name }}</td></tr>
                        <tr><td>{{ __('outlet.address') }}</td><td>{{ $data->address }}</td></tr>
                        <tr><td>{{ __('outlet.asn') }}</td><td>{{ $data->asn }}</td></tr>
                        <tr><td>{{ __('outlet.latitude') }}</td><td>{{ $data->latitude }}</td></tr>
                        <tr><td>{{ __('outlet.longitude') }}</td><td>{{ $data->longitude }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $data)
                    <a href="{{ route('datas.edit', $data) }}" id="edit-outlet-{{ $data->id }}" class="btn btn-warning">{{ __('outlet.edit') }}</a>
                @endcan
                @if(auth()->check())
                    <a href="{{ route('datas.index') }}" class="btn btn-link">{{ __('outlet.back_to_index') }}</a>
                @else
                    <a href="{{ route('data_map.index') }}" class="btn btn-link">{{ __('outlet.back_to_index') }}</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ trans('outlet.location') }}</div>
            @if ($data->coordinate)
            <div class="card-body" id="mapid"></div>
            @else
            <div class="card-body">{{ __('outlet.no_coordinate') }}</div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { height: 400px; }
</style>
@endsection
@push('scripts')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

<script>
    var map = L.map('mapid').setView([{{ $data->latitude }}, {{ $data->longitude }}], {{ config('leaflet.detail_zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $data->latitude }}, {{ $data->longitude }}]).addTo(map)
        .bindPopup('{!! $data->map_popup_content !!}');
</script>
@endpush
