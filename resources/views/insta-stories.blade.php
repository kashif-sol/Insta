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
<section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 insta-layout">
          <div class="col-md-12">
            <img src="{{asset('image/instafeed-story.png')}}" alt="" />
            <h4>Instagram Stories</h4>
            @if(isset($post))
            <form class="flex flex-col w-full" method="POST" action="{{ route('story.update',$post->id) }}">
                @method('post')
        @else
            <form  method="post" action="{{url('insta-story')}}">
              @endif
              @csrf

              <div class="fd-ttl">
                <input type="hidden" name="@if(isset($post)){{$post->id}}@endif">

                <label for="">Feed Title</label><br />
                <input
                  type="text"
                  name="title"
                  id=""
                  placeholder="Leave empty if you don't want a title" @if(isset($post))
                  value="{{$post->title}}"
                 @endif
                />
              </div>
              <div class="row">
              <div class="col-md-6">
                <label for="">On Click</label><br />
                <select name="click" id="">
                  <option value="Go To Instagram">Go to Instagram</option>
                </select>
              </div>
              <div class="col-md-6">
                  <label for="">Stroy Selection</label><br />
                  <select name="story" id="">
                    <option value="all">All</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
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
          @if(isset($post))
          
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