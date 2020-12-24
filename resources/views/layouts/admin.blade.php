@extends('layouts.app')

@section('content')
    <x-navigation-bar></x-navigation-bar>
    <main class="py-4">
        <div class="container">
            @if(session('notice'))
                <x-alert :type="session('notice')['type']" :text="session('notice')['text']" :dismissible="session('notice')['dismissible']"></x-alert>
            @endif

            <div class="row justify-content-center">
                @yield('admin.content')
            </div>
        </div>
    </main>
@endsection
