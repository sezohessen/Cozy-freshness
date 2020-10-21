@extends('layouts.app', ['title' => __('User Management')])
@section('content')
    @include('layouts.headers.cards')
    @if ($comments->count())
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">
                                    @if (isset($product_info))
                                        {{ $product_info->name . __("'s Comments") }}
                                    @else
                                        {{ __('Comments') }}
                                    @endif
                                </h3>
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
                                    <th scope="col">{{ __('User Name') }}</th>
                                    <th scope="col">{{ __('Comment') }}</th>
                                    <th scope="col">{{ __('Product Name') }}</th>
                                    <th scope="col">{{ __('Created At') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td>
                                            <p>{{ $comment->user->name }}</p>
                                        </td>
                                        <td style="max-width: 150px;">
                                            <p style="overflow:hidden;text-overflow:ellipsis;">{{$comment->comment}}</p>
                                        </td>
                                        <td>
                                            <p> <a href="{{ route('products.show',['id'=>$comment->product_id]) }}">{{ $comment->product->name }}</a></p>
                                        </td>
                                        <td>
                                            <p>{{$comment->created_at->format('F j,y')}}</p>
                                        </td>
                                      <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('comment.destroy', $comment->id) }}" method="GET">
                                                    @csrf
                                                    <a class="dropdown-item" href="{{ route('comment.destroy', $comment->id) }}" onclick="return confirm('Are you sure?')">{{ __('Delete') }}</a>
                                                </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
    @else
    <div class="text-center" style="margin: 50px 0 ">
        <h1>There is no Comments to be showen </h1>
    </div>

    @endif
@endsection
