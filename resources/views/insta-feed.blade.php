@include('layouts.header')
<section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 insta-layout">
          <div class="col-md-12">
            <img src="{{asset('image/instafeed-instagram-icon.png')}}" alt="" />
           
            <h4>Instagram Feed</h4>
            @if(isset($data))
        <form class="flex flex-col w-full" method="POST" action="{{ route('store.update',$data->id) }}">
            @method('post')
    @else
            <form  method="post" action="{{url('store-form')}}">
              @endif
              @csrf
              <div class="fd-ttl">
                <label for="">Feed Title</label><br />
                <input type="hidden" name="@if(isset($data)){{$data->id}}@endif">
                <input
                  type="text"
                  name="title"
                  id=""
                  placeholder="Leave empty if you don't want a title"  @if(isset($data))
                   value="{{$data->title}}"
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
                  <option value="0">No spacing</option>
                  <option value="5">Small</option>
                  <option value="10">Medium</option>
                  <option value="15">Large</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="">On Click</label><br />
                <select name="click" id="">
                  <option value="go to instagram">Go to Instagram</option>
                  <option value="open popup">Open Popup</option>
                  <option value="do nothing">Do Nothing</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="">Border Radius</label><br />
                <select name="border" id="">
                  <option value="10">10px</option>
                  <option value="5">5px</option>
                  <option value="7">7px</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="">Columns</label><br />
                <select name="column" id="">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="5">6</option>
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
        @include('layouts.feed-layout')
      </div>
    </div>
  </section>