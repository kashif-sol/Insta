@include('layouts.header')
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-5 insta-layout">
        <div class="col-md-12 in-hg">
          <img src="image/instafeed-custom-highlights.png" alt="" />
          <h4>Custom Highlights</h4>
          @if(isset($data))
         
          <form class="flex flex-col w-full" method="POST" action="{{ route('customhighlight.update',$data->id) }}" enctype="multipart/form-data">
            @sessionToken
            @else
            <form action="{{route('save-story')}}" method="POST" enctype="multipart/form-data"> 
              @sessionToken
              @endif
            <div class="fd-ttl">
              <input type="hidden" class="session-token" name="@if(isset($data)){{$data->id}}@endif" value="" />
              <label for="">Feed Title</label><br />
              <input
                type="text"
                name="title"
                id=""
                placeholder="Leave empty if you don't want a title"
                @if(isset($data)) value="{{$data->title}}"@endif
              />
            </div>
            <div class="row">
            <div class="col-md-3">
              <label for="">Color</label><br />
              <select name="color_type" id="color_type" @if(isset($data)) value="{{$data->color_type}}" @endif>
              <option value="D"   >Default</option>
                        <option value="S"   selected  >Solid</option>
                        <option value="G"   >Gradient</option>
              </select>
            </div>
            <div class="col-md-2 color_type1 ">
              <input type="color" name="first_color" id="first_color"  @if(isset($data)) value="{{$data->first_color}}"@endif>
            </div>
          
          <div class="col-md-1 color_grad  hideFirstColor ">
            <input type="color" name="second_color" id="second_color" @if(isset($data)) value="{{$data->second_color}}"@endif>
          </div>
          <div class="col-md-3 color_grad  hideFirstColor " >
             
            <select name="angle" id="angle">
            <option @if(isset($data)) value="{{$data->angle}}"  >{{$data->angle}}</option>@endif
                                  <option value="to top left"   >to top left</option>
                                    <option value="to top right"   >to top right</option>
                                    <option value="to bottom left"   >to bottom left</option>
                                    <option value="to bottom right"   >to bottom right</option>
                                    <option value=" to left top"   > to left top</option>
                                    <option value=" to right top"   > to right top</option>
                                    <option value=" to left bottom"   > to left bottom</option>
                                    <option value=" to right bottom"   > to right bottom</option>
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
                      <img src="image/instafeed-story.png" alt="">
                  </div>
                  </div>
                  <div class="col-md-8 upload-img">
                      <label for="img-up">upload image
                      <input type="file" name="photos[]" id="img-up">
                  </label>
                  </div>
                  </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="col-md-12">
                  <input type="search" name="story_link[]" id="" placeholder="search or paste a link....">
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
             
       
       
       @if(isset($data))
       @foreach($images as $images)
       <img src="{{asset($images->image_path)}}" style="background: linear-gradient({{$data->angle.','.$data->first_color .','. $data->second_color}});width: 150px;" alt="no pic">

       @endforeach
       @else
            <img src="image/instafeed-story.png" alt="">
            <img src="image/instafeed-story.png" alt="">
            <img src="image/instafeed-story.png" alt="">
            <img src="image/instafeed-story.png" alt="">
            <img src="image/instafeed-story.png" alt="">
        </div>
        @endif
      </div>
    </div>
  </div>
</section>