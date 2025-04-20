@extends('layouts.app')
@section('content')
    <div class="container">
        {{ alertbs_form($errors) }}
        <div class="row">
            <div class="col-sm-4">
                <div class="card card-rounded">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title pt-2"> 
                            @if(!empty($request->get('id')))
                                <i class="fas fa-edit me-1"></i>
                            @else 
                                <i class="fas fa-plus me-1"></i> 
                            @endif
                            Category
                        </h5>
                    </div>
                    <div class="card-body">
                        @if(!empty($request->get('id')))
                            <form method="post" action="{{ route('admin.update_category') }}">
                        @else 
                            <form method="post" action="{{ route('admin.create_category') }}">  
                        @endif
                            @csrf
                            <div class="form-group">
                                <label for="">Category Name</label>
                                @if(!empty($request->get('id')))
                                    <input type="text" 
                                        class="form-control mt-2 @error("category_name") is-invalid @enderror" 
                                        value="{{ $edit->category_name }}" 
                                        name="category_name" id="category_name" placeholder="">
                                    @error("category_name")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="hidden" value="{{ $request->get('id') }}" name="id">
                                @else 
                                    <input type="text" 
                                        class="form-control mt-2 @error("category_name") is-invalid @enderror" 
                                        value="{{ old("category_name") }}" 
                                        name="category_name" id="category_name" placeholder="">
                                    @error("category_name")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 btn-md">Save</button>
                            @if(!empty($request->get('id')))
                                <a href="{{ route('admin.category') }}" class="btn btn-danger mt-3">Back</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card card-rounded">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title pt-2"> 
                            <i class="fas fa-database me-1"></i> Category Data
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @forelse($categories as $category)
                                        <tr>
                                            <td>{{ $no }}</td>      
                                            <td>{{ $category->category_name }}</td> 
                                            <td>
                                                <a href="{{ url("admin/category?id=$category->id") }}" 
                                                    class="btn btn-success btn-sm" title="Edit">
                                                    <i class="fa fa-edit"></i>  
                                                </a>   
                                                <a href="{{ url("admin/category/delete/$category->id") }}" 
                                                    class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Are you sure you want to delete this data?');" 
                                                    title="Delete">
                                                    <i class="fa fa-times"></i> 
                                                </a>
                                            </td>
                                        </tr>
                                        @php $no++; @endphp
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                No Data Available
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <br>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection