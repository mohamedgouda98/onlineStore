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
                                <h4>Add Product Colors</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        <div class="row">
                            <div class="col-lg-6 col-12 mx-auto">
                                <form method="post" action="{{ route('admin.productcolor.add') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="t-text">Product :</label>
                                        <select data-live-search="true" class="selectpicker form-control"
                                            name="product_id" id="t-text">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="t-text">Color :</label>
                                        <select data-live-search="true" class="selectpicker form-control"
                                            name="color_id" id="t-text">

                                            @foreach ($colors as $color)
                                                <option value="{{ $color->id }}">
                                                    {{ $color->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="t-text">Quantity :</label>
                                        <div class="mb-4">
                                            <input id="demo6" type="number" name="quantity" class="input-sm">
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file-container" data-upload-id="myFirstImage">
                                            <label>Upload (Single File) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input" name="image" accept="image/*">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary mt-3" type="submit">Add</button>
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
                                <h4>Product Colors Table</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            @if (count($productColors) != 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Color</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productColors as $productColor)
                                            <tr>
                                                <td class="text-center">{{ $productColor->id }}</td>
                                                <td class="text-center">{{ $productColor->product->name }}</td>
                                                <td style="background-color:{{ $productColor->color->name }}"
                                                    class="text-center">{{ $productColor->color->name }}</td>
                                                <td class="text-center">{{ $productColor->quantity }}</td>
                                                <td class="text-center"><img
                                                        src="{{ asset('images/productColorImages/' . $productColor->image) }}"
                                                        style="max-height:50px" alt=""></td>

                                                <td class="text-center">
                                                    <ul class="table-controls">
                                                        <li>
                                                            <form method="get"
                                                                action="{{ route('admin.productColor.editPage', $productColor->id) }}">
                                                                @csrf
                                                                <button class="btn btn-dark" type="submit"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-edit-2">
                                                                        <path
                                                                            d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                                        </path>
                                                                    </svg></button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form method="post"
                                                                action="{{ route('admin.productcolor.delete', $productColor->id) }}">
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
