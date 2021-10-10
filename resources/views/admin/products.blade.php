@include('admin.assets.navbar')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">


    <div class="container">


        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        @if (Session::has('done'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ Session::get('done') }}
                            </div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger text-center" role="alert">
                                {{ Session::get('error') }}
                            </div>

                        @elseif ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Add Product </h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        <div class="row">
                            <div class="col-lg-6 col-12 mx-auto">
                                <form method="post" action="{{ route('admin.product.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-4">
                                        <label for="Pname">Name :</label>
                                        <input class="form-control" type="text" name="name" id="Pname">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Pslug">Slug :</label>
                                        <input class="form-control" type="text" name="slug" id="Pslug">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="t-text">Category :</label>
                                        <select data-live-search="true" class="selectpicker form-control"
                                            name="category_id" id="t-text">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="price">Price :</label>
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" name="price" id="price"
                                                aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="exampleFormControlTextarea1">Description :</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                            name="description" rows="3"></textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <span> Status :</span>
                                        <label class="switch s-icons s-outline  s-outline-success  mb-4 mr-2">
                                            <input name="status" type="checkbox" checked="">
                                            <span class="slider round"></span>
                                        </label>
                                        
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file-container" data-upload-id="myFirstImage">
                                            <label>Upload (Single File) <a href="javascript:void(0)"
                                                    class="custom-file-container__image-clear"
                                                    title="Clear Image">x</a></label>
                                            <label class="custom-file-container__custom-file">
                                                <input type="file"
                                                    class="custom-file-container__custom-file__custom-file-input"
                                                    name="main_image" accept="image/*">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span
                                                    class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                    </div>
                                    <button class="btn btn-warning mt-3" type="submit">Add</button>
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
                                <h4>Products Table</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            @if (count($products) != 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Slug</th>
                                            <th class="text-center">price</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Colors</th>
                                            <th class="text-center">Main-Image</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="text-center">{{ $product->id }}</td>
                                                <td class="text-center">{{ $product->name }}</td>
                                                <td class="text-center">{{ $product->slug }}</td>
                                                <td class="text-center">{{ $product->price }}</td>
                                                <td class="text-center">{{ $product->description }}</td>
                                                <td class="text-center">{{ $product->quantity }}</td>
                                                <td class="text-center">
                                                    <ul class="table-controls">
                                                        @foreach ($product->colors as $color)
                                                            <li class="p-2 rounded my-2"
                                                                style="background-color:{{ $color->name }}">
                                                                {{ $color->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                <td class="text-center"><img
                                                        src="{{ asset('images/ProductsImages/' . $product->main_image) }}"
                                                        style="max-height:50px" alt=""></td>

                                                <td class="text-center">
                                                    <ul class="table-controls">
                                                        <li>
                                                            <form method="get"
                                                                action="{{ route('admin.product.editPage', $product->id) }}">
                                                                <button class="btn btn-dark" type="submit"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-alert-circle">
                                                                        <circle cx="12" cy="12" r="10"></circle>
                                                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                                                    </svg></button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form method="post"
                                                                action="{{ route('admin.product.delete', $product->id) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-dark" type="submit"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-trash-2">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                    </svg></button>
                                                            </form>
                                                        </li>


                                                    </ul>


                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <h2>There is no Product Color Yet !</h2>
                            @endif
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!--  END CONTENT AREA  -->
@include('admin.assets.footer')
