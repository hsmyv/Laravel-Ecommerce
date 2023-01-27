
<x-layout>
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">

                <form action="{{route('checkout.store')}}" method="POST" id="payment-form"/>
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a
                                    href="#">Click
                                    here</a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="name" value="{{old('name')}}">
                                        <x-form.error name="name"/>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="lastname"  value="{{old('lastname')}}">
                                        <x-form.error name="lastname"/>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country"  value="{{old('country')}}">
                                <x-form.error name="country"/>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address"  value="{{old('address')}}" placeholder="Street Address" class="checkout__input__add">
                                <x-form.error name="address"/>
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city"  value="{{old('city')}}">
                                <x-form.error name="city"/>
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="postcode"  value="{{old('postcode')}}">
                                <x-form.error name="postcode"/>
                            </div>

                            <!-- Display a payment form -->

                            <div class="form-group">
                                <label for="card-element">
                                    Credit or debit card
                                </label>
                                <div id="card-element">


                                </div>
                                <div id="card-errors" role="alert"></div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                @foreach (Cart::content() as $item)
                                    <ul class="checkout__total__products">
                                        <li>({{ $item->qty }}){{ $item->name }} <span>${{ $item->price }}</span>
                                        </li>
                                    </ul>
                                @endforeach
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>${{ Cart::subtotal() }}</span></li>
                                        @if (session()->has('coupon'))
                                    <li>Discount ({{ session()->get('coupon')['name'] }}) :
                                        
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
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" id="complete-order" class="site-btn">PLACE ORDER</button>
                                 @if (session()->has('success_message'))
                            <div class="alert alert-success">
                                {{session()->get('success_message')}}
                            </div>

                        @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
</x-layout>
