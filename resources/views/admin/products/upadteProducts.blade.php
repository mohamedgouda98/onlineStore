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
                                        @method('PUT')
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6 my-1">
                                                    <input id="t-text" type="text" value="{{$products->name}}" name="name" placeholder="Some Text..." class="form-control" required>
                                                </div>
                                                <div class="col-6 my-1">
                                                    <input id="t-text" type="text" value="{{$products->slug}}" name="slug" placeholder="Some Slug..." class="form-control" required>
                                                </div>
                                                <div class="col-6 my-1">
                                                    <input id="t-text" type="number" value="{{$products->price}}" name="price" placeholder="Some price..." class="form-control" required>

                                                </div>
                                                <div class="col-6 my-1">
                                                    <input id="t-text" type="file" name="main_image" placeholder="Select Image" class="form-control" required>
                                                </div>
                                                <div class="col-6 my-1">
                                                    <textarea name="description" placeholder="Some Message..." id="" class="form-control" cols="30" rows="10">{{$products->description}}</textarea>
                                                </div>
                                                <div class="col-6">
                                                    <input class="form-check-input" name="status" value='1' type="checkbox" id="flexCheckDefault">
                                                    <label for="">Is the product available?</label>

                                                </div>
                                                <div class="col-6 my-1">
                                                    <select class="form-control" name="category_id" id="">
                                                        <option selected value="{{$products->category->id}}">{{$products->category->name}}</option>
                                                        @foreach($categories as $category)
                                                        @if ($products->category->id != $category->id)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="old_image" value="{{$products->main_image}}">
                                            <input type="submit" class="mt-4 btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.assets.footer')
