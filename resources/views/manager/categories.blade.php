@extends('manager.layouts.manager')

@section('title', 'Categories || glossy.uz')

@section('content')
    <!-- Dynamic Table Full -->
    <div class="block block-rounded" style="margin:  4rem 0 0 0">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Categories table
            </h3>
            <button type="button" class="btn btn-alt-primary" data-bs-toggle="modal" data-bs-target="#modal-popout-store">
                <i class="fa fa-plus-circle"></i> Add Category
            </button>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>NAME</th>
                        <th class="d-none d-sm-table-cell" style="width: 25%;">IMAGE</th>
                        <th class="text-center" style="width: 15%;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($categories as $cat)
                        <tr>
                            <td class="text-center">{{ $cat->id }}</td>
                            <td class="fw-semibold">{{ $cat->name }}</td>
                            <td class="text-center">
                                <img class="img-fluid options-item" src="{{ asset('storage/'.$cat->image) }}" alt="">
                            </td>
                            <td class="d-none d-sm-table-cell">

                                <button type="button" class="btn btn-alt-primary mb-2 w-100" data-bs-toggle="modal"
                                    data-bs-target="#modal-popout-edit{{ $cat->id }}"> <i class="fa fa-pen"></i> Edit
                                </button>

                                <button type="button" class="btn btn-danger mb-2 w-100" data-bs-toggle="modal"
                                    data-bs-target="#modal-popout-delete{{ $cat->id }}"><i class="fa fa-trash"></i> Delete
                                </button>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {{$categories->links()}}
    </div>
    <!-- END Dynamic Table Full -->
@endsection

@section('modals')
@include('manager.modals.categories.store', ['categories' => $categories])

@foreach ($categories as $cat)
    @include('manager.modals.categories.edit',['cat' => $cat])
    @include('manager.modals.categories.delete',['cat' => $cat])
@endforeach
@endsection
