@extends('layouts.master')
@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">

            @if ($message = Session::get('success'))
        <div class="w3-panel w3-green w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
    				class="w3-button w3-green w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('success');?>
        @endif

        @if ($message = Session::get('error'))
        <div class="w3-panel w3-red w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
    				class="w3-button w3-red w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('error');?>
        @endif


 <div id="paypal-button"></div>

                <form method="POST" id="payment-form"  action="/payment/add-funds/paypal">
                {{ csrf_field() }}
                <input type="hidden" name="slug" value="{{MD5($data->slug)}}">
                    <div class="form-group">
                        <input type="number" name="amount" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Pay">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('custom-scripts')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
      paypal.Button.render({
        env: 'sandbox', // Or 'production'
        style: {
          size: 'large',
          color: 'gold',
          shape: 'pill',
        },
        // Set up the payment:
        // 1. Add a payment callback
        payment: function(data, actions) {
          // 2. Make a request to your server
          return actions.request.post('/api/create-payment')
            .then(function(res) {
              // 3. Return res.id from the response
              // console.log(res);
              return res.id;
            });
        },
        // Execute the payment:
        // 1. Add an onAuthorize callback
        onAuthorize: function(data, actions) {
          // 2. Make a request to your server
          return actions.request.post('/api/execute-payment', {
            paymentID: data.paymentID,
            payerID:   data.payerID
          })
            .then(function(res) {
              console.log(res);
              alert('PAYMENT WENT THROUGH!!');
              // 3. Show the buyer a confirmation message.
            });
        }
      }, '#paypal-button');
    </script>
@endpush