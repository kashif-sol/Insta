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
          <div class="col-md-12 in-hg"> 
            <img src="{{asset('image/instafeed-highlights.png')}}" alt="" />
            <h4>Instagram Highlights</h4>
            @if(isset($post))
            <form class="flex flex-col w-full" method="POST" action="{{ route('highlight.update',$post->id) }}">
                @method('post')
        @else
            <form  method="post" action="{{url('insta-highlight')}}">
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
                <label for="">Onclick</label><br />
                <select name="click" id="">
                  <option value="Go to Instagram">Go to Instagram</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="">Highlights Selection</label><br />
                <select name="highlight" id="">
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
          @if(isset($post))
          <div class="col-md-12 img-combo">
            @foreach($highlight as $ar)
              <img src="{{asset('highlights/'.$ar)}}" alt="">
              @endforeach
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>