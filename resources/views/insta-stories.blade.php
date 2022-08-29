@include('layouts.header')

@php
$openPost = "GI";
if(isset($data->click))
  $openPost = $data->click;

@endphp
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
<section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 insta-layout">
          <div class="col-md-12">
            <img src="{{asset('image/instafeed-story.png')}}" alt="" />
            <h4>Instagram Stories</h4>
            <form  method="post" action="{{url('insta-story')}}">
              @sessionToken

              <div class="fd-ttl">
                <input type="hidden" name="id" value="@if(isset($data)){{$data->id}}@endif">

                <label for="">Feed Title</label><br />
                <input
                  type="text"
                  name="title"
                  id=""
                  placeholder="Leave empty if you don't want a title" @if(isset($data))
                  value="{{$data->title}}"
                 @endif
                />
              </div>
              <div class="row">
              <div class="col-md-6">
                <label for="">On Click</label><br />
                <select name="click" id="">
                  <option @if(isset($data)) @if($data->click == "GI") selected @endif  @endif value="GI">Go to Instagram</option>
                  <option value="NO" @if(isset($data)) @if($data->click == "NO") selected @endif  @endif >Do Nothing</option>
                </select>
              </div>
              <div class="col-md-6">
                  <label for="">Stroy Selection</label><br />
                  <select name="story" id="">
                    <option value="all" @if(isset($data)) @if($data->story == "all") selected @endif  @endif >All</option>
                    <option value="manual" @if(isset($data)) @if($data->story == "manual") selected @endif  @endif >Manual</option>
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
          @if(isset($data))
          
          <div class="col-md-12 img-combo">
            @foreach($story as $ar)
              <img src="{{asset('assets/'.$ar)}}" alt="">
              @endforeach
          </div>
          
          @endif
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container-fluid">
        <div class="row stry-slt">
            <div class="col-md-12 p-0">
                <h6>Story Selection</h6>
            </div>
            <div class="col">
                <img src="image/instafeed-story.png" alt="">
                <br>
                <input type="checkbox" name="" id="">
            </div>
            <div class="col">
                <img src="image/instafeed-story.png" alt="">
                <br>
                <input type="checkbox" name="" id="">
            </div>
            <div class="col">
                <img src="image/instafeed-story.png" alt="">
                <br>
                <input type="checkbox" name="" id="">
            </div>
            <div class="col">
                <img src="image/instafeed-story.png" alt="">
                <br>
                <input type="checkbox" name="" id="">
            </div>
            <div class="col">
                <img src="image/instafeed-story.png" alt="">
                <br>
                <input type="checkbox" name="" id="">
            </div>
        </div>
    </div>
</section>