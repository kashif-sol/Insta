@include('layouts.header')
<section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 insta-layout">
          <div class="col-md-12">
            <img src="{{asset('image/instafeed-instagram-reels-icon.png')}}" alt="" />
            <h4>Instagram Reels</h4>
            @if(isset($post))
            <form class="flex flex-col w-full" method="POST" action="{{ route('reel.update',$post->id) }}">
                @method('post')
        @else
            <form  method="post" action="{{url('insta-reel')}}">
              @endif
              @csrf
              <div class="fd-ttl">
                <input type="hidden" name="@if(isset($post)){{$post->id}}@endif">

                <label for="">Feed Title</label><br />
                <input
                  type="text"
                  name="title"
                  id=""
                  placeholder="Leave empty if you don't want a title"  @if(isset($post))
                  value="{{$post->title}}"
                 @endif
                />
              </div>
              <div class="row">
              <div class="col-md-6">
                <label for="">On Click</label><br />
                <select name="click" id="">
                  <option value="Go to Instagram">Go to Instagram</option>
                </select>
              </div>
              <div class="col-md-6">
                  <label for="">Reel Selection</label><br />
                  <select name="reel" id="">
                    <option value="All">All</option>
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
          <div class="col-md-12 img-sty">
              <video src="{{asset('video/Kenady Fundings - Tony Carson Another Fix and Flip mortgage project. in progress project. Ludlow KY.mp4')}}" controls></video>
              <video src="{{asset('video/Tony Carson Finding real estate to fix and flip.mp4')}}" controls></video>
              <video src="{{asset('video/Tony Carson in Naples Florida talks about buying an investment home.mp4')}}" controls></video>
          </div>
        </div>
      </div>
    </div>
  </section>