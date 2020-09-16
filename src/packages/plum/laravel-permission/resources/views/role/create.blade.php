@extends('plum::layouts.app')
@section('content')
    @php
        $prefixName = config('laravel-permission.prefix.name');
    @endphp
    <div class="my-3">
        <a href="{{route($prefixName . 'role.index')}}" class="btn btn-secondary">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg> {{__('Back')}}
        </a>
    </div>
    <div>
        {!! Pform::open(['url' => route($prefixName . 'role.store'), 'id' => 'form-demo'], \Plum\LaravelPermission\Requests\RoleRequest::class) !!}
        {!! Pform::text('name', __('Your name')) !!}
        {!! Pform::submit(__('Submit')) !!}
        {!! Pform::close() !!}
    </div>
@endsection
