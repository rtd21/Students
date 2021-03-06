@extends('layouts.app')
@section('content')
    @can('create', \App\Models\Group::class)
        <div>
            <form action="{{route('groups.create')}}" method="get">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-success">
                        Add group
                    </button>
                </div>
            </form>
        </div>
    @endcan
    @if(session('message'))
        <div class="alert alert-danger">
            {{session('message')}}
        </div>
    @endif
    Groups:
    <table class="table table-bordered table-sm">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Average Rating</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($avgs as $avg)
            <tr>
                <td class="table-text">
                    <div><a href="{{route('groups.show', $avg)}}">{{$avg->name}}</a></div>
                </td>
                <td class="table-text">
                    <div>{{$avg->description}}</div>
                </td>
                <td>
                    <table class="table table-bordered table-sm">
                        @foreach($subjects as $subject)
                            <tr>
                                <th scope="row">{{$subject->name}}:</th>
                                <td>
                                    @php
                                        echo $avg->{$subject->id}
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <th scope="row">General Average:</th>
                                <td>{{$avg->avg}}</td>
                            </tr>
                    </table>
                </td>
                <td>
                    @can('delete', $avg)
                        <form action="{{route('groups.destroy', $avg)}}" method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger">Delete current Group</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {{$avgs->links()}}

@endsection

