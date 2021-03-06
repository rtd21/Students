@extends('layouts.app')
@section('content')
    @can('create', \App\Models\Subject::class)
        <div>
            <form action="{{route('subjects.create')}}" method="get">
                <button class="btn btn-success">Add Subject</button>
            </form>
        </div>
    @endcan
    @if(session('message'))
        <div class="alert alert-danger">
            {{session('message')}}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
        Subjects:
        </thead>

        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td class="table-text">
                    <div style="display: inline-block">{{$subject->name}}</div>
                    @can('delete', $subject)
                        <div style="display: inline-block">
                            <form action="{{route('subjects.destroy', $subject)}}" method="post">
                                @csrf
                                {{method_field('DELETE')}}
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
@endsection
