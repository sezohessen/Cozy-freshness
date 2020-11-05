@extends('layouts.app', ['title' => __('User Management')])

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
    @if ($categories->count())
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Categories') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">{{ __('Add Category') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Pic') }}</th>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Active') }}</th>
                                    <th scope="col">{{ __('Additional') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <img src="{{Storage::url($category->picture)}}" alt="{{$category->picture}}" class="img-fluid img-thumbnail" width="100px" height="100px">
                                        </td>
                                        <td>
                                            <p>{{$category->name}}</p>
                                        </td>
                                        <td>
                                            @if ($category->active==1)
                                                <a href="{{route('categories.activation',$category->id)}}" onclick="return confirm('Are you sure?')">
                                                    <button type="button" class="btn btn-danger" >
                                                        {{ __('Inactive') }}
                                                    </button>
                                                </a>
                                            @else
                                                <a href="{{route('categories.activation',$category->id)}}" onclick="return confirm('Are you sure?')">
                                                    <button type="button" class="btn btn-success">
                                                        {{ __('Active') }}
                                                    </button>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('categories.show',$category->id)}}">
                                                <button class="btn">See More</button>
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="GET">
                                                    @csrf
                                                    @method('delete')

                                                    <a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}">{{ __('Edit') }}</a>
                                                    <a class="dropdown-item" href="{{ route('categories.destroy', $category->id) }}" onclick="return confirm('Are you sure?')">{{ __('Delete') }}</a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    @else
    <div class="text-center" style="margin: 50px 0 ">
        <h1>There is no categories to be showen </h1>
        <a href="{{route('categories.create')}}"> <button type="button" class="btn btn-primary">Create Category</button></a>
    </div>

    @endif

            </div>
         </div>

    </div>

@include('layouts.footers.auth')
</div>
@endsection
