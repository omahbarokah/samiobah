@extends('layouts.app')

@section('content')
    <x-navigation-bar></x-navigation-bar>
    <main class="content-wrapper">
        
        <div class="content-header">
        </div>
        <div class="content container">
            @if(session('notice'))
                <x-alert :type="session('notice')['type']" :text="session('notice')['text']" :dismissible="session('notice')['dismissible']"></x-alert>
            @endif

            <div class="row">
                @yield('admin.content')
            </div>
        </div>
    </main>
@endsection
