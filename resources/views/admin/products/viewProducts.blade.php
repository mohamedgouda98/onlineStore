@include('admin.assets.navbar')
<div id="content" class="main-content">
    <div class="container">

        <div class="container">


            <div class="row layout-top-spacing">

                <div id="basic" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Add Product</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                <div class="col-12 mx-auto">
                                    <form method="post" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6 my-1">
                                                    <input id="t-text" type="text" name="name" placeholder="Some Text..." class="form-control" required>
                                                </div>
                                                <div class="col-6 my-1">
                                                    <input id="t-text" type="text" name="slug" placeholder="Some Slug..." class="form-control" required>
                                                </div>
                                                <div class="col-6 my-1">
                                                    <input id="t-text" type="number" name="price" placeholder="Some price..." class="form-control" required>

                                                </div>
                                                <div class="col-6 my-1">
                                                    <input id="t-text" type="file" name="main_image" placeholder="Select Image" class="form-control" required>
                                                </div>
                                                <div class="col-6 my-1">
                                                    <textarea name="description" placeholder="Some Message..." id="" class="form-control" cols="30" rows="10"></textarea>
                                                </div>
                                                <div class="col-6">
                                                    <input class="form-check-input" name="status" value='1' type="checkbox" id="flexCheckDefault">
                                                    <label for="">Is the product available?</label>

                                                </div>
                                                <div class="col-6 my-1">
                                                    <select class="form-control" name="category_id" id="">
                                                        @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <input type="submit" class="mt-4 btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div id="tableProgress" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Progress Table</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>slug</th>
                                            <th>price</th>
                                            <td>image</td>
                                            <td>description</td>
                                            <td>Category</td>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td class="text-center">{{$product->id}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->slug}}</td>
                                            <td>{{$product->price}}</td>
                                            <th>
                                                <img src="/images/products/{{$product->main_image}}" width="45px" alt="">
                                            </th>
                                            <td>{{$product->description}}</td>
                                            <td>{{$product->category->name}}</td>
                                            <td class="text-center">
                                                <ul class="table-controls d-flex justify-content-around">
                                                    <li class="list-unstyled"><a href="{{route('admin.product.edite',[$product->id])}}" data-toggle="tooltip" data-placement="top" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                            </svg></a></li>
                                                    <li class="list-unstyled"><a href="{{route('admin.product.delete',[$product->id])}}" data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            </svg></a></li>
                                                </ul>
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
        </div>
    </div>
</div>
@include('admin.assets.footer')
