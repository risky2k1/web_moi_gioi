@extends('layout.master')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="carad-header">
                    <a href="{{route('admin.posts.create')}}" class="btn btn-success ">
                        Add Post
                    </a>
                    <label for="csv" class="btn btn-success mb-0">Import CSV</label>
                    <input type="file" name="csv" id="csv" class="d-none" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table-data">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Title</th>
                            <th>Location</th>
                            <th>Remoteable</th>
                            <th>Is Partime</th>
                            <th>Range Salary</th>
                            <th>Date Range</th>
                            <th>Status</th>
                            <th>Is Pinned</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        {{--$(document).ready(function () {--}}
        {{--    $.ajax({--}}
        {{--        url: "{{route('api.posts')}}",--}}
        {{--        data: "data",--}}
        {{--        dataType: "json",--}}
        {{--        success: function (response) {--}}
        {{--            // $('#table-data')--}}
        {{--        },--}}
        {{--        error: function (response) {--}}

        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        $("#csv").change(function(event){
            const formData = new FormData();
            formData.append('file',$(this)[0].files[0])
            $.ajax({
                url:'{{route('admin.posts.import_csv')}}',
                type:'POST',
                dataType:'json',
                enctype:'multipart/form-data',
                data:formData,
                async:false,
                cache:false,
                contentType:false,
                processData:false,
                success: function (response){
                    $.toast({
                        heading: 'Import Sucees',
                        text: 'Your file has been imported',
                        icon: 'success',
                        loader: true,        // Change it to false to disable loader
                        loaderBg: '#9EC600',
                        position:'bottom-right',// To change the background
                    })
                },
                error: function (response){

                },
            });
        });
    </script>
@endpush
