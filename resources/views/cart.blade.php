  @include('assets.navbar')


        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Cart Start -->
        <div class="cart-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-page-inner">
                            <div class="table-responsive">
                                @if(session('done'))
                                    <div class="alert alert-success" role="alert">
                                        {{session('done')}}
                                    </div>
                                @endif
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                            {{$error}}
                                        </div>
                                    @endforeach
                                @endif
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                    @foreach($data['carts'] as $cart)
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="img/product-1.jpg" alt="Image"></a>
                                                    <p>{{$cart->productColor->product->name}}</p>
                                                </div>
                                            </td>
                                            <td>{{$cart->productColor->product->price}}</td>
                                            <td>
                                                <div>
                                                    <form method="post" action="{{route('cart.update')}}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="cart_id" value="{{$cart->id}}">
                                                        <input type="hidden" name="count" value="{{$cart->quantity - 1}}">
                                                        <button class="btn-minus" type="submit"><i class="fa fa-minus"></i></button>
                                                    </form>
                                                    <input type="text" value="{{$cart->quantity}}">
                                                    <form method="post" action="{{route('cart.update')}}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="cart_id" value="{{$cart->id}}">
                                                        <input type="hidden" name="count" value="{{$cart->quantity + 1}}">
                                                        <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>{{$cart->total_price}}</td>
                                            <td>
                                                <form method="post" action="{{route('cart.delete')}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="cart_id" value="{{$cart->id}}">
                                                    <button><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart-page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="coupon">
                                        <input type="text" placeholder="Coupon Code">
                                        <button>Apply Code</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="cart-summary">
                                        <div class="cart-content">
                                            <h1>Cart Summary</h1>
                                            <p>Sub Total<span>{{$data['total']}} EGP</span></p>
                                            <p>Shipping Cost<span>{{$data['shipping']}} EGP</span></p>
                                            <h2>Grand Total<span>{{$data['total_after_shipping']}}EGP</span></h2>
                                            <form method="post" action="{{route('cart.checkout')}}">
                                                @csrf
                                                <input type="text" name="phone" placeholder="Phone Number">
                                                <input type="text" name="city" placeholder="City">
                                                <input type="text" name="details" placeholder="Details">
                                                <div class="cart-btn">
                                                    <button>Checkout</button>
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
        <!-- Cart End -->
  @include('assets.footer')
