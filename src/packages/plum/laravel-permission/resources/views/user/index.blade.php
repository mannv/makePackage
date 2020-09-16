@extends('plum::layouts.app')
@section('content')
    <div class="my-3">
        <form class="form-inline" method="GET">
            <div class="form-group">
                <input value="{{request('q')}}" name="q" type="text" class="form-control mr-3"
                       placeholder="{{__('Name or email')}}">
                <button type="submit" class="btn btn-primary">{{__('Search')}}</button>
            </div>
        </form>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('Name')}}</th>
                <th scope="col">{{__('Email')}}</th>
                <th scope="col">{{__('Role')}}</th>
                <th scope="col" class="text-right">{{__('Created at')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @foreach($user->role as $role)
                            {{$role->name}}
                        @endforeach
                    </td>
                    <td class="text-right">{{$user->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="float-right">
            {{ $users->links() }}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
