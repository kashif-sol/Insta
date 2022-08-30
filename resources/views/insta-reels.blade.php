@include('layouts.header')

@php

$clicks = array(
  array("title" => "Go to Instagram" , "value" => "GI"),
  array("title" => "Do nothing" , "value" => "DN"),
);

$selections = array(
  array("title" => "All" , "value" => "A"),
  array("title" => "Manual" , "value" => "M"),
);



$openPost = "GI";
  if(isset($tab->click))
    $openPost = $tab->click;

@endphp
<section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 insta-layout">
          <div class="col-md-12">
            <img src="{{asset('image/instafeed-instagram-reels-icon.png')}}" alt="" />
            <h4>Instagram Reels</h4>
            <form  method="post" action="{{url('insta-reel')}}">
              @sessionToken
              <div class="fd-ttl">
                <input type="hidden" name="id" value="@if(isset($tab)){{$tab->id}}@endif">

                <label for="">Feed Title</label><br />
                <input
                  type="text"
                  name="title"
                  id=""
                  placeholder="Leave empty if you don't want a title"  @if(isset($tab))
                  value="{{$tab->title}}"
                 @endif
                />
              </div>
              <div class="row">
              <div class="col-md-6">
                <label for="">On Click</label><br />
                <select name="click" id="">
                  @foreach ( $clicks as  $click)
                  <option @if(isset($tab)) @if($tab->click == $click['value']) selected @endif @endif value="{{$click['value']}}">{{$click['title']}}</option>
                @endforeach
                </select>
              </div>
             
              <div class="col-md-12">
                  <input type="submit" value="Save">
              </div>
          </div>
            </form>
          </div> 
        </div>
        <div class="col-md-7 insta-lay-rgt"> 
          <h4>Preview</h4>
          @if(!isset($tab))
          <div class="col-md-12 img-sty">
              <video src="{{asset('video/Kenady Fundings - Tony Carson Another Fix and Flip mortgage project. in progress project. Ludlow KY.mp4')}}" controls></video>
              <video src="{{asset('video/Tony Carson Finding real estate to fix and flip.mp4')}}" controls></video>
              <video src="{{asset('video/Tony Carson in Naples Florida talks about buying an investment home.mp4')}}" controls></video>
          </div>
          @else 
          <div class="col-md-12 img-sty">
            @foreach($reel_data as $ar)
            @php
            $link = "#"; 
              if($openPost == "GI")
                   $link = $ar["link"];
            @endphp
              <a href="{{$link}}">
                <video src="{{asset('reels/'.$ar["file"])}}" controls></video>
              </a>
            @endforeach
          </div>
            @endif
        </div>
      </div>
    </div>
  </section>