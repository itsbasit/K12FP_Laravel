@extends('layouts.master')

@section('title','Home')


@section('content')
<section class="hero-barishal welcome-area" id="home">
    <!-- Big Circle-->
    <!-- <div class="big-circle"></div> -->
    <!-- Circle Shape Animation-->
    <!-- <div class="circle-shape-animation">
        <div class="circle1"></div>
        <div class="circle2"></div>
        <div class="circle3"></div>
        <div class="circle4"></div>
    </div> -->
    <div class="container" style="padding-top:13%;">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-md-6 mb-5">
                <div class="welcome-text-area">

                    <h2 class="wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">K-12FP Smart Funding Platform
          </h2>
                    <h5 class="wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">It's So Easy!</h5>

                    <a class="btn btn-primary mt-30 wow fadeInUp" href="#next" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        Learn More</a>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <!-- Welcome Thumb-->
                <div class="welcome-area-thumb text-center">
                    <img src="https://k12fp.com//assets/images/demoVideo.jpg" alt="" style="border: 6px solid #7030a0" class="img-fluid">
                    <div class="video-area-text">
                        <a class="video-btn mt-5 ms-5" href="">
                            <i class="fa fa-play-circle"></i>
                            <span class="video-sonar"></span>
                        </a>
                    </div>
                    <!-- Thumb Shape-->
                    <!-- <div class="thumb-shape1"><img
                            src="https://stg.basitnawaz.com/assets/images/core-img/line-shape.png" alt=""></div>
                    <div class="thumb-shape2"></div>
                    <div class="thumb-shape3"></div> -->
                </div>

            </div>
        </div>
    </div>
    
</section>
@endsection