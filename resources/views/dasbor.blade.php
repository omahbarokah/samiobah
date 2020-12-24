@extends('layouts.admin')

@section('title', __('Dasbor'))

@section('admin.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
