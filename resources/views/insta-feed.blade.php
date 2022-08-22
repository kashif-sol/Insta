@include('layouts.header')
<section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 insta-layout">
          <div class="col-md-12">
            <img src="{{asset('image/instafeed-instagram-icon.png')}}" alt="" />
           
            <h4>Instagram Feed</h4>
            @if(isset($post))
        <form class="flex flex-col w-full" method="POST" action="{{ route('store.update',$post->id) }}">
            @method('post')
    @else
            <form  method="post" action="{{url('store-form')}}">
              @endif
              @csrf
              <div class="fd-ttl">
                <label for="">Feed Title</label><br />
                <input type="hidden" name="@if(isset($post)){{$post->id}}@endif">
                <input
                  type="text"
                  name="title"
                  id=""
                  placeholder="Leave empty if you don't want a title"  @if(isset($post))
                   value="{{$post->title}}"
                  @endif
                />
              </div>
              <div class="lay-set">
                <label for="">Layout</label><br />
                <select name="layout" id="">
                  <option value="slider">Slider</option>
                </select>
              </div>
              <div class="row">
              <div class="col-md-6">
                <label for="">Post Spacing</label><br />
                <select name="spacing" id="">
                  <option value="no spacing">No spacing</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="">On Click</label><br />
                <select name="click" id="">
                  <option value="Go to Instagram">Go to Instagram</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="">Border Radius</label><br />
                <select name="border" id="">
                  <option value="10px">10px</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="">Columns</label><br />
                <select name="column" id="">
                  <option value="4">4</option>
                </select>
              </div>
              <div class="col-md-1">
                  <input type="checkbox" name="load_more" value="checked" id="">
              </div>
              <div class="col-md-11">
                  <h6>Allow visitors to load more posts</h6>
                  <p>Show a <a href="">Load more posts</a> button below the feed.</p>
              </div>
              <div class="col-md-12">
                  <input type="submit" value="Save">
              </div>
          </div>
            </form>
          </div>
        </div>
        <div class="col-md-7 insta-lay-rgt">
          @if(isset($feeds))
          <h4>Preview</h4> 
         @foreach($pictures as $ar)
  <img src="{{asset('assets/'.$ar)}}" alt="" style="width: 20px">
          
          @endforeach
        
          <div class="col-md-12 img-combo">
            <div class="data">
             
            
          </div>
          
          @else
          <div class="col-md-12 img-pwr">
              <img src="{{asset('image/powered-by-instafeed.png')}}" alt="">
            </div>
            @endif
        </div>
      </div>
    </div>
  </section>