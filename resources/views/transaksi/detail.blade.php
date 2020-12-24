@extends('layouts.admin')

@section('title', __('Detail'))

@section('admin.content')
    <div class="col-md-8">
        <div class="card"> 
            <div class="card-body"> 
                @dump($pesanan)
            </div>
        </div> 
    </div>
@endsection
 