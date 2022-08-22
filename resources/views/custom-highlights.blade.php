@include('layouts.header')
<section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 insta-layout">
          <div class="col-md-12 in-hg">
            <img src="{{asset('image/instafeed-custom-highlights.png')}}" alt="" />
            <h4>Custom Highlights</h4>
            @if(isset($post))
            <form class="flex flex-col w-full" method="POST" action="{{ route('custom.update',$post->id) }}" enctype="multipart/form-data">
                @method('post')
        @else
            <form  method="post" action="{{url('custom')}}" enctype="multipart/form-data">
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
                <label for="">Color</label><br />
                <select name="color" id="">
                  <option value="Default">Default</option>
                </select>
              </div>
              <div class="row para-set">
                  <div class="col-md-6">
                    <p>Image</p>
                  </div>
                  <div class="col-md-6">
                    <p>Link</p>
                  </div>
                </div>
              <div class="row cus-hg">
                  <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="row data-cnt">
                            <div class="col-md-4">
                                <div class="dash-img">
                        <img @if(isset($post)) src="{{asset('storage/app/'.$post->path)}}" @else src="{{asset('image/instafeed-story.png')}}" @endif alt="">
                    </div>
                    </div>
                    <div class="col-md-8 upload-img">
                        <label for="img-up">upload image
                        <input type="file" name="image" id="img-up">
                    </label>
                    </div>
                    </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="col-md-12">
                    <input type="text" name="link" id="" placeholder="search or paste a link....">
                </div>
                  </div>
                  <div class="col-md-1">
                        <button class="remove" type="button">
                        <i class="fa-solid fa-trash-can"></i>
                      </button>
                  </div>
                </div>
                <div class="col-md-12">
                  <button class="add-more" type="button">Add more</button>
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
          <div class="col-md-12 img-sty-1">
              <img src="{{asset('image/instafeed-story.png')}}" alt="">
              <img src="{{asset('image/instafeed-story.png')}}" alt="">
              <img src="{{asset('image/instafeed-story.png')}}" alt="">
              <img src="{{asset('image/instafeed-story.png')}}" alt="">
              <img src="{{asset('image/instafeed-story.png')}}" alt="">
          
          </div>
        </div>
      </div>
    </div>
  </section>