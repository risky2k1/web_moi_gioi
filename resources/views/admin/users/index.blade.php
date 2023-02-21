@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form class="form-inline" id="form-filter">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <div class="col-3">
                                <select class="form-control select-filter" name="role" id="role">
                                    <option selected>All</option>
                                    @foreach($roles as $role=>$key)
                                        <option value="{{$key}}"
                                                @if((string)$key==$selectedRole) selected @endif>
                                            {{$role}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Company</label>
                            <div class="col-3">
                                <select class="form-control select-filter" name="company" id="company">
                                    <option selected>All</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}"
                                                @if((string)$company->id===$selectedCompany) selected @endif>
                                            {{$company->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </form>
            </div>
            <div class="card-body">
                <table class="table table-hover table-centered mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Avatar</th>
                        <th>Info</th>
                        <th>Role</th>
                        <th>Company</th>
                        <th>Action</th>
                    </tr>

                    </thead>
                    <tbody>
                    @foreach($data as $val)
                        <tr>
                            <td>
                                <a href="{{route("admin.$table.show",$val)}}">
                                    {{$val->id}}
                                </a></td>
                            <td><img src="{{$val->avatar}} style=" height=64px;"></td>
                            <td>
                                {{$val->name}} -
                                <a>
                                    {{$val->gender_name}}
                                </a>
                                <br>
                                <a href="mailTo:{{$val->email}}">
                                    {{$val->email}}
                                </a>
                                <br>
                                <a href="tel:{{$val->phone}}">
                                    {{$val->phone}}
                                </a>
                                <br>

                            </td>
                            <td>
                                {{$val->role_name}}
                            </td>
                            <td>
                                {{optional($val->company)->name}}
                            </td>
                            <td>
                                <form action="{{route("admin.$table.destroy",$val)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Delete</button>
                                </form>

                            </td>

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
@push('js')
    <script>
        $(document).ready(function () {
            $(".select-filter").change(function () {
                $("#form-filter").submit();
            });
        });
    </script>
@endpush
