@include('layouts.header')
@php
  $color_type = "D";
  $color_is = "#fff";
  if(isset($data->color_type))
  {
    $color_type = $data->color_type;
    if( $color_type == "S") 
    {
      $color_is = $data->first_color;
    }
    if( $color_type == "G")
    {
      $color_is = "linear-gradient(".$data->angle.", ".$data->first_color.", ".$data->second_color.")";
    }
  }

  $angles = ["to top left" , "to top right" , "to bottom left" , "to bottom right" , " to left top", " to right top"," to left bottom" , " to right bottom"];
@endphp
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-5 insta-layout">
        <div class="col-md-12 in-hg">
          <img src="image/instafeed-custom-highlights.png" alt="" />
          <h4>Custom Highlights</h4>
          
         
          <form action="{{route('save-story')}}" method="POST" enctype="multipart/form-data"> 
            @sessionToken
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
                <label for="">Color</label>
                <select name="color_type" id="color_type">
                  <option value="D" @if(isset($data)) @if ($data->color_type == "D") selected @endif @endif>Default</option>
                  <option value="S" @if(isset($data)) @if ($data->color_type == "S") selected @endif @endif>Solid</option>
                  <option value="G" @if(isset($data)) @if ($data->color_type == "G") selected @endif @endif>Gradient</option>
                </select>
              </div>
              <div class="col-md-2 color_type1 @if($color_type == 'D') hideFirstColor @endif">
                <label for="">Color</label>
                <input type="color" name="first_color" id="first_color"  @if(isset($data)) value="{{$data->first_color}}"@endif>
              </div>
          
              <div class="col-md-2 color_grad  @if($color_type != 'G') hideFirstColor @endif ">
                <label for="">Color</label>
                <input type="color" name="second_color" id="second_color" @if(isset($data)) value="{{$data->second_color}}"@endif>
              </div>
              <div class="col-md-3 color_grad   @if($color_type != 'G') hideFirstColor @endif" " >
                <label for="">Angle</label>
                <select name="angle" id="angle">
                  @foreach ($angles as $angle)
                    <option @if(isset($data))  @if($data->angle == $angle) selected @endif  @endif value="{{$angle}}">{{$angle}}</option>
                  @endforeach
                
              </select>
              </div>
            </div>
            <div class="row">
            <div class="row para-set">
                <div class="col-md-6">
                  <p>Image</p>
                </div>
                <div class="col-md-6">
                  <p>Link</p>
                </div>
              </div>
              <div class="image-cont">
                @if(isset($data) && !empty($images))
                  @foreach($images as $key => $image)
                  <div class="row cus-hg">
                    <div class="col-md-6">
                      <div class="col-md-12">
                          <div class="row data-cnt">
                              <div class="col-md-4">
                                  <div class="dash-img">
                                    <img src="{{asset($images['image_path'])}}" alt="myfeed">
                      </div>
                      </div>
                      <div class="col-md-8 upload-img">
                          <label for="img-up-{{$key}}">upload image
                          <input type="file" class="story-file" name="photos[]" id="img-up-{{$key}}" required>
                      </label>
                      </div>
                      </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="col-md-12">
                      <input type="search"  required value="{{$image['image_link']}}" name="story_link[]" id="" placeholder="search or paste a link....">
                  </div>
                    </div>
                    <div class="col-md-1">
                          <button class="remove" type="button"  data-id="{{$image['id']}}">
                          <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                  </div>
                  @endforeach
                @else

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
                        <input type="file" class="story-file" name="photos[]" id="img-up">
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
                        <button class="remove" type="button"  data-id="">
                        <i class="fa-solid fa-trash-can"></i>
                      </button>
                  </div>
                </div>
             
              @endif
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
             
       
       
       @if(!empty($images))
       @foreach($images as $images)
        <img src="{{asset($images['image_path'])}}" alt="no pic">
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
<style>
  .hideFirstColor{
    display: none;
  }

  .img-sty-1 img {
    background: {{ $color_is}};
    width: 92px !important;
    height: 92px;
    border: 0px solid transparent;
    background-size: 100%;
    padding: 3px;
    background-repeat: no-repeat;
    border-radius: 100%;
}
  
  </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(function(){
    

    $("#color_type").change(function(){
          $(".color_type1,.color_grad").addClass("hideFirstColor");
          var color = $(this).val();
          
          if(color == "G")
          {
            $(".color_type1,.color_grad").removeClass("hideFirstColor");
          }else if(color == "S"){
            $(".color_type1").removeClass("hideFirstColor");
          }else{
            $(".color_type1,.color_grad").addClass("hideFirstColor");
          }
        });

        $(document).on('click', '.add-more', function() {
          var size_childs = $(".image-cont .cus-hg").length;
          var html = $(this).parent().parent().find('.image-cont .cus-hg').first().html();
          html = "<div class='row cus-hg'>"+html+"</div>";
          $(".image-cont").append(html);
          $(".image-cont .cus-hg:last-child").find(".upload-img input").attr("id","img-up-" + size_childs);
          $(".image-cont .cus-hg:last-child").find(".upload-img label").attr("for","img-up-" + size_childs);
          $(".image-cont .cus-hg:last-child").find(".remove").attr('data-id' , '');
    
          
        });

        $(document).on("change" , ".story-file" , function(){
          var $this = $(this);
           const file = this.files[0];
        
           if (file){
           let reader = new FileReader();
           reader.onload = function(event){
             var image_sec = "<img src='"+event.target.result+"'>";
             $this.parentsUntil(".dash-data").parent().find(".dash-img").empty().append(image_sec);
           }
           reader.readAsDataURL(file);
           }
         });
       });

        $(document).on('click', '.remove', function() {
            var id = $(this).data("id");
            if(id > 0)
            {
              $.ajax({
                method: 'get',
                url:'/delete-image/' + id,
                success:function(response)
                {
                  location.reload();
                  $(this).parent().parent().remove();
                }

              });
            }
            else{
              $(this).parent().parent().remove();
            }
            
        });

  })
</script>