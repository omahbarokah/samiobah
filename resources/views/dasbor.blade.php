@extends('layouts.admin')

@section('title', __('Dasbor'))

@section('admin.content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Dasbor') }}</div>

                <div class="card-body">
                    @dump(auth()->user()->keranjang())
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
