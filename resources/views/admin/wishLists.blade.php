@include('admin.assets.navbar')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">


    <div class="container">


        <div class="row layout-top-spacing">

            <div id="tableProgress" class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>WishLists Table</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
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
                            @if (count($wishLists) != 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">User Name</th>
                                            <th class="text-center">Product Name</th>
                                            <th class="text-center">Product Color</th>
                                            <th class="text-center">Product Price</th>
                                            <th class="text-center">Product Image</th>
                                            <th class="text-center">Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wishLists as $wishList)
                                            <tr>
                                                <td class="text-center">{{ $wishList->id }}</td>
                                                <td class="text-center">{{ $wishList->user->name }}</td>
                                                <td class="text-center">{{ $wishList->productColor->product->name }}</td>
                                                <td style="background-color:{{ $wishList->productColor->color->name }}" class="text-center">{{ $wishList->productColor->color->name }}</td>
                                                <td class="text-center">{{ $wishList->productColor->product->price }}</td>
                                                <td class="text-center"><img
                                                    src="{{ asset('images/productColorImages/' . $wishList->productColor->image) }}"
                                                    style="max-height:50px" alt=""></td>
                                                <td style="direction:ltr" class="text-center">{{ $wishList->created_at->diffForHumans() }}</td>
                                            </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <h2>There is no Wishlists Yet !</h2>
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
