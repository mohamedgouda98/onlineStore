@include('admin.assets.navbar')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">


    <div class="container">


        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Edit Product Item</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        <div class="row">
                            <div class="col-lg-6 col-12 mx-auto">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger text-center" role="alert">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                                <form method="post" action="{{ route('admin.product.edit', $productItem->id) }}"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-group mb-4">
                                        <label for="Pname">Name :</label>
                                        <input class="form-control" type="text" name="name" id="Pname"
                                            value="{{ $productItem->name }}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Pslug">Slug :</label>
                                        <input class="form-control" type="text" name="slug" id="Pslug"
                                            value="{{ $productItem->slug }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="t-text">Category :</label>
                                        <select data-live-search="true" class="selectpicker form-control"
                                            name="category_id" value="
                                            {{ $productItem->category->id }}" id="t-text">
                                            @foreach ($categories as $category)
                                                <option @if ($productItem->category->id == $category->id) selected
                                            @endif
                                            value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                aria-label="Amount (to the nearest dollar)"
                                                value="{{ $productItem->price }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="exampleFormControlTextarea1">Description :</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{$productItem->description}}</textarea>
                                    </div>

                                    <div class="form-group mb-4  mt-3">
                                        <label for="formFile" class="form-label">Image :</label>
                                        <input type="hidden" name="main_image" value="{{ $productItem->main_image }}">
                                        <input id="formFile" name="newImage" type="file" class="form-control"
                                            accept="image/*">
                                        <div class="w-50 m-auto my-3"><img class="w-100 mt-3"
                                                src="{{ asset('images/ProductsImages/' . $productItem->main_image) }}"
                                                alt="nice"></div>
                                    </div>
                                    <button class="btn btn-warning mt-3" type="submit">Update</button>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="widget-header mt-3">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>ProductColors of {{$productItem->name}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            @if (count($productItem->productColors) != 0)
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
                                        @foreach ($productItem->productColors as $productColor)
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
                                <h2>There is no Product Color for {{$productItem->name}} Yet !</h2>
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
