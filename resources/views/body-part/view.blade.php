@extends('layout.master')

@section('main-content')


    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div>
    @endif


    <div class="breadcrumb">
        <h1>{{$bodypart->name}}</h1>
        <ul>
            <li><a href="">Body Part</a></li>
            <li>View</li>
        </ul>
        <a type="button" class="btn  btn-primary m-1" href="{{url('create-body-part')}}" style="position: absolute; right: 45px;"><i class="nav-icon mr-2 i-Add"></i>Create</a>

        <a type="button" class="btn  btn-primary m-1" href="{{url('list-parts')}}" style="position: absolute;right: 45px;"><i class="nav-icon mr-2 i-File-Horizontal-Text"></i>Back to List</a>

    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">

        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Body Part</div>
                    <form >
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control form-control-rounded" disabled value="{{$bodypart->name}}" >
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <a type="button" class="btn btn-success" href="{{url('edit-body-part/'.$bodypart->id)}}">
                                    <i class="nav-icon mr-2 i-Pen-2"></i>
                                    Edit
                                </a>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection
