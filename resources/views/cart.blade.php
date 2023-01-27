<x-layout>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Shopping Cart</span>
                            @if (session()->has('success_message'))
                                <div class="alert alert-success">
                                    {{ session()->get('success_message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        @if (Cart::count() > 0)
            <div class="container">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="shopping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <h3 style="margin-bottom:3%">{{ Cart::count() }} item(s) in the Shopping cart</h3>
                                    @foreach (Cart::content() as $item)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="img/shopping-cart/cart-1.jpg" alt="">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <a>
                                                        <h6>{{ $item->name }}</h6>
                                                    </a>
                                                    <h5>${{ $item->price }}</h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input type="text" value="1">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">$ 30.00</td>

                                            <td class="cart__close"><i class="fa fa-close"></i>
                                                <form method="POST" action="{{ route('cart.destroy', $item->rowId) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-outline-primary">remove</button>
                                                </form>
                                            </td>
                                            <td class="cart__close"><i class="fa fa-save"></i>
                                                <form method="POST"
                                                    action="{{ route('cart.switchToSaveForLater', $item->rowId) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">Save for
                                                        Later</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                        {{-- <div class="row">
                    <div  class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                        </div>
                    </div>
                </div> --}}
                    </div>
                    <div class="col-lg-4">
                        @if (!session()->has('coupon'))
                        <div class="cart__discount">
                            <h6>Discount codes</h6>
                            <form action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                <input type="text" name="coupon_code" id="coupon_code" placeholder="Coupon code">
                                <button type="submit">Apply</button>
                            </form>
                        </div>
                        @endif
                        <div class="cart__total">
                            <h6>Cart total</h6>
                            <ul>
                                <li>Subtotal <span>{{presentPrice(Cart::subtotal())}}</span></li>
                                @if (session()->has('coupon'))
                                    <li>Discount ({{ session()->get('coupon')['name'] }}) :
                                        <form action="{{ route('coupon.destroy') }}" method="POST"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="font-size: 14px">Delete</button>
                                        </form>
                                        <span>-${{ session()->get('coupon')['discount'] }}</span>
                                    </li>
                                @endif
                                @if (session()->has('coupon'))
                                <li>New Subtotal <span>{{presentPrice($newSubtotal)}}</span></li>
                                <li>Tax(13%) <span>{{presentPrice($newTax)}}</span></li>
                                <li>New Total <span>{{presentPrice($newTotal)}}</span></li>
                                @else
                                <li>Tax(13%) <span>{{ presentPrice(Cart::tax()) }}</span></li>
                                <li>Total <span>{{ presentPrice(Cart::total()) }}</span></li>
                                @endif
                            </ul>
                            <a href="{{ route('checkout.index') }}" class="primary-btn">Proceed to checkout</a>

                        </div>
                    </div>

                </div>

            </div>
        @else
            <h3 style="text-align:center">No items in the Shopping Cart</h3>
            <div style="text-align:center; margin-top: 5%">
                <div class="continue__btn">
                    <a href="{{ route('shop') }}">Continue Shopping</a>
                </div>
            </div>


        @endif
    </section>

    <!-- Shopping Cart Save for Later Begin -->
    <section class="shopping-cart spad">
        @if (Cart::instance('saveForLater')->count() > 0)
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shopping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <h3 style="margin-bottom:3%">{{ Cart::instance('saveForLater')->count() }} item(s)
                                        saved for Later</h3>
                                    @foreach (Cart::instance('saveForLater')->content() as $item)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="img/shopping-cart/cart-1.jpg" alt="">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <a href="">
                                                        <h6>{{ $item->name }}</h6>
                                                    </a>
                                                    <h5>${{ $item->price }}</h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input type="text" value="1">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">$ 30.00</td>

                                            <td class="cart__close"><i class="fa fa-close"></i>
                                                <form method="POST"
                                                    action="{{ route('cart.saveForLater.destroy', $item->rowId) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-outline-primary">remove</button>
                                                </form>
                                            </td>
                                            <td class="cart__close"><i class="fa fa-open"></i>
                                                <form method="POST"
                                                    action="{{ route('cart.SaveForLater.switchToCart', $item->rowId) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">Move to
                                                        Cart</button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>


                </div>

            </div>
        @else
            <h3 style="text-align:center">You have no items in the Saved for Later</h3>

        @endif
    </section>
    <script type="module" src="{{asset('js/bootstrap.js')}}"></script>
    <script>
        (function() {
            const classname = document.querySelectorAll('.quantity')
            Array.from(classname).forEach(function(elemment) {
                elemment.addEventListener('change', function() {
                    axios.patch('/cart/5', {
                            quantity: 3
                        })
                        .then(function(response) {
                            console.log(response);
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                })
            })
        })();
    </script>
    <!-- Shopping Cart Section End -->
</x-layout>
