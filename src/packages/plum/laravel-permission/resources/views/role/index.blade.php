@extends('plum::layouts.app')
@section('content')
    @php
        $prefixName = config('laravel-permission.prefix.name');
    @endphp
    <div class="my-3 text-right">
        <a href="{{route($prefixName . 'role.create')}}" class="btn btn-primary">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg> {{__('Add')}}
        </a>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('Display name')}}</th>
                <th scope="col">{{__('Name')}}</th>
                <th scope="col" class="text-right">{{__('Created at')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <th scope="row">{{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->iteration }}</th>
                    <td>{{$role->name_display}}</td>
                    <td>{{$role->name}}</td>
                    <td class="text-right">{{$role->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="float-right">
            {{ $roles->appends(request()->all())->links() }}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
