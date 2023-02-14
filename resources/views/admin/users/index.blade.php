@extends('layout.master')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($data as $val)
                            <tr>
                                <td>{{$val->id}}</td>
                                <td>{{$val->name}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination pagination-rounded mb-0">
                            {{$data->links()}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
