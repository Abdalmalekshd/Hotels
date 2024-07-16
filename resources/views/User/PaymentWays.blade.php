@extends('user.layout.usermaster')


@section('content')




@include('Admin.Layout.successmesage')


@include('Admin.Layout.errormesage')

  <div class="container">
    <div class="wallets custom-bar">
        <div class="My_wallet_text">


            <div class="container" id="productList">
                <div class="row" >
                    <div class="col-lg-12 col-md-12">
                        <h3 class="text-center"><i class="fa  fa-shopping-cart"></i>{{ __('user.cart') }}</h3>
                    </div>

                </div>


                <div class="row product">
                    @foreach ($reserve as $reservation)

                  <div class="col-md-12 col-lg-12 col-sm-12">

                    <form action="{{ route('process.payment') }}" method="POST">
                        @csrf

                        <input type="hidden" name="reserid" value="{{ $reservation->id }}">

                        <input type="hidden" name="userid" value="{{ $reservation->user_id }}">

                    <div class="box">
                        @forelse ($reservation->room->rooms as $image)
                      <img src="{{ url('storage/rooms/'. $image->img ) }}" alt="">
                      @empty
                      <img class="card-img roomimg" style="margin-right: 0px;" src="https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg" alt="">
                        @endforelse


                      <div class="content">
                        <h3 class="Title"> <input type="hidden" value="{{ $reservation -> hotel -> name }}" name="hotelname"> {{ $reservation -> hotel -> name }}</h3>
                        <h5> <p>{{ __('hotel.roomid') }} : {{ $reservation->room->room_id}}</p></h5>
                        <h5>   {{ __('hotel.cost') }} :  <span class="price"> {{  $reservation -> room -> cost }}$</<span></h5>
                       <div> <p class="unit">{{ __('hotel.starttime') }}: <input   type="text"  readonly class="form-control quantity" value="{{ $reservation -> reservations_start_date }}"></p></div>
                       <div> <p class="unit">{{ __('hotel.endtime') }}: <input   type="text"  readonly class="form-control quantity" value="{{ $reservation -> reservations_end_date }}"></p></div>

                    <a href="{{ route('del.resrivation',$reservation->id) }}">   <span class="btn-area" style="cursor: pointer;
                       color: red;
                       position: absolute;
                       top: 27px;
                       @if (LaravelLocalization::getCurrentLocale() == 'en')
                        left: 800px;
                        @else
                        right: 800px;
                      @endif" ><i class="fa fa-trash"></i></span></a>

                      </div>
                    </div>
                  </div>

                </div>



                @endforeach

              </div>

              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="right-bar" {{ $overalltotal == 0 ? 'style=display:none':'' }}>


            <p><span>Subtotal</span><span id="overallTotal">${{ $totalcost }}</span></p>

            <hr>
            <p><span>Tax (5%)</span> <span id="tax">${{ $totalcostwithtax }}</span></p>
            <hr>

            <p><span>Total</span>
                <input type='hidden' name="total" value="{{ $overalltotal}}" readonly>
                <span id='total'>${{ $overalltotal }}</span>
            </p>



                <button class="btn btn-success form-control" type="submit" id="checkout-live-button" {{ $overalltotal == 0 ? 'disabled':'' }} ><i class="fa fa-money"></i> Checkout</button>

          </form>
          </div>
            </div>
              </div>


    </div>

</div>
@endsection
