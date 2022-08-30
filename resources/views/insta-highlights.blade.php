@include('layouts.header')
<style>
  .insta-lay-rgt .img-combo img {
    width: 150px;
    height: 160px;
    margin-right: -5px;
    border-radius: 50%;
    border: 1px solid gold;
    padding: 5px;
}
</style>
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
          <div class="col-md-12 in-hg"> 
            <img src="{{asset('image/instafeed-highlights.png')}}" alt="" />
            <h4>Instagram Highlights</h4>
         
            <form class="flex flex-col w-full" method="POST" action="{{ url('insta-highlight') }}">
              @sessionToken
              <div class="fd-ttl">
                <input type="hidden" name="id" value="@if(isset($tab)){{$tab->id}}@endif">

                <label for="">Feed Title</label><br />
                <input
                  type="text"
                  name="title"
                  id=""
                  placeholder="Leave empty if you don't want a title" @if(isset($tab))
                  value="{{$tab->title}}"
                 @endif
                />
              </div>
              <div class="row">
              <div class="col-md-6">
                <label for="">Onclick</label><br />
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
          @if(isset($tab))
          <div class="col-md-12 img-combo">
            @foreach($highlight as $ar)
            @php
            $link = "#"; 
              if($openPost == "GI")
                   $link = $ar["link"]; 
            @endphp
             <a href="{{$link}}">
              <img src="{{asset('highlights/'.$ar["file"])}}" alt="">
             </a>
              @endforeach
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>