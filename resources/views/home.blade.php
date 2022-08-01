@extends('layouts.master')
@section('title','Donation')
@section('content')
<?php
$total_donated = getSum($data->student != null ? $data->student : $data->fundraiser);
if($data->student == null)
{
  $percent = $total_donated/$data->total_goal * 100;
} else {
  $percent = $total_donated/$data->student_goal * 100;
}
?>


<style>
   .section-top{
   padding:3% 0% 5%;
   background-image: linear-gradient(45deg,
   {{$data->color}},
   rgba(15,45,107,0.84)), url('http://localhost/k12_fp/assets/images/bg.png');
   background-position: center center;
   background-size: cover
   }
   .profile-page .profile-header .cover .cover-body {
   position: absolute;
   bottom: -50px !important;
   left: 0;
   z-index: 2;
   width: 100%;
   padding: 0 20px;
   }
   .fundraiser_section{
   padding:3%;
   }

   .lh-1{
    line-height:1.7em;
   }

   .leader span{
    color:#1F76CD;
   }

   .colored{
    color:#1F76CD;
   }

   .testimonials{
    padding:5% 0%;
    background:#f7f7f7;
   }

   .meta{
    font-size:15px;
   }

   .overlap{
    box-shadow:0 4px 6px -1px rgb(0 0 0 / 10%);
   }

   .share i{
    padding:15px;
   }


   .donation_sec{
    padding:5%;
    background:#f5dadaf2;
   }

   .inputGroup {
    background-color: #ffffff;
    display: block;
    margin: 10px 0;
    position: relative;
    box-shadow: 1px 1px 1px 1px #00000036;
}

.inputGroup label {
    padding: 12px 30px;
    width: 100%;
    display: block;
    text-align: left;
    color: #3c454c;
    cursor: pointer;
    position: relative;
    z-index: 2;
    transition: color 200ms ease-in;
    overflow: hidden;
}

.inputGroup label:before {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    content: '';
    background-color: #5562eb;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%) scale3d(1, 1, 1);
    transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
    z-index: -1;
}

.inputGroup label:after {
    width: 32px;
    height: 32px;
    content: '';
    border: 2px solid #d1d7dc;
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
    background-repeat: no-repeat;
    background-position: 2px 3px;
    border-radius: 50%;
    z-index: 2;
    position: absolute;
    right: 30px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    transition: all 200ms ease-in;
}

.inputGroup input:checked~label {
    color: #fff;
}

.inputGroup input:checked~label:before {
    transform: translate(-50%, -50%) scale3d(56, 56, 1);
    opacity: 1;
}

.inputGroup input:checked~label:after {
    background-color: #54e0c7;
    border-color: #54e0c7;
}

.inputGroup input {
    width: 32px;
    height: 32px;
    order: 1;
    z-index: 2;
    position: absolute;
    right: 30px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    visibility: hidden;
}



#countdown-wrap {
  width: 100%;
  height: auto;
  //border: 1px solid black;
  /* padding: 20px; */
  font-family: arial;
  max-width: 650px;
  /* margin: 150px auto 300px; */
}

#goal {
  font-size: 48px;
  text-align: right;
  color: #FFF;
  @media only screen and (max-width : 640px) {
    text-align: center;  
  }
  
}

#glass {
  width: 100%;
  height: 20px;
  background: #c7c7c7;
  border-radius: 10px;
  float: left;
  overflow: hidden;
}

#progress {
  float: left;
  width: {{number_format($percent)}}%;
  height: 20px;
  background: #FF5D50;
  z-index: 333;
  //border-radius: 5px;
}

.goal-stat {
  width: 25%;
  //height: 30px;
  padding: 10px;
  float: left;
  margin: 0;
  color: #FFF;
  
  @media only screen and (max-width : 640px) {
    width: 50%;
    text-align: center;
  }
}

.goal-number, .goal-label {
  display: block;
}

.goal-number {
  font-weight: bold;
}
</style>

<section class="section-top">
   <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="card" style="background: {{$data->color}}">
          @if($data->student != null)
          <img class="img-fluid" src="/uploads/fundraiser/{{$data->logo}}" alt="Main Photo">
          @else
          <img class="img-fluid" src="/uploads/fundraiser/{{$data->main_photo}}" alt="Main Photo">
          @endif
          </div>
        </div>

         <div class="col-md-8">
          @if($data->status == 'Ended')
            <div class="card p-1 text-center">
               <div class="card-body">
                  <img src="https://img.icons8.com/bubbles/200/000000/trophy.png" alt="">
                  <h4>Thanks for Supporting {{$data->student != null ? 'Me' : 'Us'}}!</h4>
                  <h2 class="text-success ">${{getSum($data->fundraiser,$data->student)}}</h2>
                  <h4>RAISED</h4>
                  <h6>Towards {{$data->student != null ? 'My' : 'Our'}} Initial Goal of ${{$data->student != null ? $data->student_goal : $data->total_goal}}</h6>
               </div>
            </div>
          @else
          <div class="card bg-dark">
              <div class="card-body">
              <div id=countdown-wrap>
                <div id="goal">${{$data->student != null ? $data->student_goal : $data->total_goal}}</div>
                <div id="glass">
                  <div id="progress">
                  </div>
                </div>
                <div class="goal-stat">
                  <span class="goal-number">{{number_format($percent,2,".",",")}}%</span>
                  <span class="goal-label">Funded</span>
                </div>
                <div class="goal-stat">
                  <span class="goal-number">${{$total_donated}}</span>
                  <span class="goal-label">Raised</span>
                </div>
                <div class="goal-stat">
                  <span class="goal-number"><div id="countdown">345</div></span>
                  <span class="goal-label">Days to Go</span>
                </div>
                
              </div>
              </div>
            </div>
          @endif
           
           </div> 
      </div>
   </div>
</section>


<section class="overlap">
  <div class="container">
    <div class="row ">
      <div class="col">
        <div class="card">
          <div class="row">
            <div class="col-md-3 mt-n5">
              @if($data->student != null)
                <img class="img-fluid img-thumbnail" src="/uploads/pages/{{$data->cover_url}}" alt="fundraiser_logo">
              @else
                <img class="img-fluid img-thumbnail" src="/uploads/fundraiser/{{$data->logo}}" alt="fundraiser_logo">
              @endif
            </div>

            <div class="col-md-4 pt-3">
            
              <h3>{{$data->student != null ? $data->studentName : $data->name}}</h3>
    
              <p class="h4 pt-1 text-muted">{{$data->student != null ? $data->name : ""}}</p>
            </div>

            <div class="col-md-5 pt-3 share">
              <p class="h6">Share:</p>
              <i class="fa fa-2x fa-user"></i>
              <i class="fa fa-2x fa-user"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<section class="fundraiser_section">
   <div class="container">
      <div class="row py-lg-5 text-left">
         <div class="col-md-6">
            <h5 class="colored pb-3 text-uppercase">About Our Fundraiser</h5>
            <h3 class="h2">{{$data->name}}</h3>
         </div>
      </div>
      <div class="row g-5">
         <div class="col-12 col-md-6">
            <!-- <div class="embed-responsive embed-responsive-16by9">
               <iframe width="560" height="315" id="videoifram" src="#" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            </div> -->
            @if($data->student != null)
            <img src="/uploads/fundraiser/{{$data->main_photo}}" class="img-fluid" alt="">
            @else
            <img src="/uploads/pages/{{$data->cover_url}}" class="img-fluid" alt="">
            @endif
            
         </div>
         <div class="col-12 col-md-6">
            
            <h3>Raising Money For: {{$data->money_raising_for}}</h3>
            <h3 class="pb-3">Our Goal Is To Raise:
               <strong>${{$data->total_goal}}</strong>
            </h3>
            <p class="h5 lead lh-1 text-wrap">
              {!!$data->content!!}
            </p>
            <h4 class="py-3">Thanks Again</h4>
            <p class="leader pt-1 h4">
                <strong>  Fundraiser Dates :  <span>{{date_format($data->created_at,'d-M-Y ').' - '. $data->ended_at}}</span></strong>
            </p>

         </div>
      </div>
   </div>
</section>


<section class="donation_sec">
  <div class="container">
  <form action="{{url('/payment/add-funds/paypal')}}" method="POST">
  {{ csrf_field() }}
  <input type="hidden" name="slug" value="{{ $data->slug }}">
    <div class="row">
      <div class="col-md-3">
        <div class="inputGroup mb-lg-5">
            <input id="radio1" name="amount" class="check-am" value="50" type="radio">
            <label for="radio1">$50</label>
        </div>

        <div class="inputGroup mb-lg-5">
            <input id="radio11" name="amount" checked class="check-am" value="100" type="radio">
            <label for="radio11">$100</label>
        </div>

        <div class="inputGroup mb-lg-5">
            <input id="radio2" name="amount" class="check-am" value="150" type="radio">
            <label for="radio2">$150</label>
        </div>
        
      </div>

      <div class="col-md-6">
       
            <div class="card">
              <div class="card-body">
              <div class="form-group">
              <label class="form-label">Enter your Name:</label>
              <input type="text" name="name" placeholder="Name" class="form-control">
            </div>

            <div class="form-group">
              <label class="form-label">Comment (Optional):</label>
              <textarea name="description" class="form-control" cols="30" rows="5" placeholder="Comment...."></textarea>
            </div>

            <div class="form-group">
              <input type="submit" class="btn w-100 btn-lg btn-primary" value="Donate Now">
            </div>
              </div>
            </div>
         
      </div>


      <div class="col-md-3">
      <div class="inputGroup mb-lg-5">
            <input id="radio3" name="amount" class="check-am" value="200" type="radio">
            <label for="radio3">$200</label>
        </div>

        <div class="inputGroup mb-lg-5">
            <input id="radio4" name="amount" class="check-am" value="250" type="radio">
            <label for="radio4">$250</label>
        </div>

        <div class="inputGroup mb-lg-5">
            <input id="other" name="amount" class="check-am" value="other" type="radio">
            <label for="other">Custom amount</label>
        </div>

        <div class="form-group mb-lg-5" id="otherAnswer" style="display:none">
            <label class="form-label">Custom amount:</label>
            <input  type="number" id="otheramount" name="otheramount" class="form-control" placeholder="Custom amount">
        </div>
      </div>
    </div>
    </form>

  </div>
</section>


<section class="testimonials">
  <div class="container">

  <div class="row pb-5 text-center">
    <div class="col">
    <h2 class="pb-3 colored">Cheer Wall</h2>
      <p class="h6">Thanks to our supporters!</p>
    </div>
  </div>
  <?php
  
  function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
  
  ?>
    <div class="row">
      @foreach($testimonials as $_data)
      <div class="col-md-4 pb-3">
      <div class="card">
        <div class="card-header">
          <h4 class="colored h4 pb-1">{{$_data->payerName.' $'. $_data->amount_donated}} </h4>
          <p class="meta">Supporting {{$data->student != null ? $data->studentName : $data->name}} - {{time_elapsed_string($_data->created_at)}}</p>
        </div>
        <div class="card-body">
          <p>{{$_data->description}}</p>
        </div>
      </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection

@push('custom-scripts')
<script>
     $(document).ready(function()
     {
      $("input[type='radio']").change(function() {

console.log($('input[name="amount"]:checked').val());
  if ($(this).val() == "other") {
      $("#otherAnswer").show();
  } else {
      $('#otheramount').val('');
      $("#otherAnswer").hide();

  }
});
     })
</script>
@endpush