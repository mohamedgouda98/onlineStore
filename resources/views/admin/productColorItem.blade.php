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
                                <h4>Edit Product Color Item</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        <div class="row">
                            <div class="col-lg-6 col-12 mx-auto">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger text-center" role="alert">
                                        {{$error}}
                                       </div>
                                    @endforeach
                                @endif
                                <form method="post"
                                    action="{{ route('admin.productcolor.edit', $productColorItem->id) }}"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-group">
                                        <label for="t-text">Product :</label>
                                        <select data-live-search="true" class="selectpicker form-control"
                                            name="product_id" value="
                                            {{ $productColorItem->product->id }}" id="t-text">
                                            @foreach ($products as $product)
                                                <option @if ($productColorItem->product->id == $product->id) selected
                                            @endif
                                            value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="t-text">Color :</label>
                                        <select data-live-search="true" class="selectpicker form-control"
                                            name="color_id" value="
                                            {{ $productColorItem->color->id }}" id="t-text">

                                            @foreach ($colors as $color)
                                                <option @if ($productColorItem->color->id == $color->id) selected @endif value="{{ $color->id }}">
                                                    {{ $color->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="t-text">Quantity :</label>
                                        <div class="mb-4">
                                            <input id="demo6" type="number" value="{{ $productColorItem->quantity }}"
                                                name="quantity" class="input-sm">
                                        </div>


                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Image :</label>
                                        <input type="hidden" name="image" value="{{ $productColorItem->image }}">
                                            <input id="formFile" name="newImage" type="file"
                                                class="form-control" accept="image/*">
                                        
                                    </div>
                                    <button class="btn btn-warning mt-3" type="submit">Update</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!--  END CONTENT AREA  -->
@include('admin.assets.footer')
