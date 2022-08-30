@include('layouts.header')

@php
  $clicks = array(
    array("title" => "Go to Instagram" , "value" => "GI"),
    array("title" => "Do nothing" , "value" => "DN"),
  );

  $spaces = array(
    array("title" => "No spacing" , "value" => "0"),
    array("title" => "Small" , "value" => "10"),
    array("title" => "Medium" , "value" => "20"),
    array("title" => "Large" , "value" => "30"),
  );

  $layouts = array(
    array("title" => "Grid" , "value" => "G"),
    array("title" => "Slider" , "value" => "S"),
  );

  $columns = array(
    array("title" => "4" , "value" => "4"),
    array("title" => "1" , "value" => "1"),
    array("title" => "2" , "value" => "2"),
    array("title" => "3" , "value" => "3"),
  );


  $radiuses = array(
    array("value" => "5" , "title" => "5px"),
    array("value" => "10" , "title" => "10px"),
    array("value" => "20" , "title" => "20px"),
    array("value" => "30" , "title" => "30px"),
  );
  $openPost = "GI";
  if(isset($data->click))
    $openPost = $data->click;

  $border = 0;
  if(isset($data->border))
    $border = $data->border;

  $spacing = 0;
  if(isset($data->spacing))
    $spacing = $data->spacing;

  $postColumns = "col-md-3";
  if(isset($data->column))
    {
      switch($data->column){
          case 1:
            $postColumns = "col-md-12";
              break;
          case 2:
          $postColumns = "col-md-6";
              break;
              case 3:
          $postColumns = "col-md-4";
              break;
              case 4:
          $postColumns = "col-md-3";
              break;
            case 5:
          $postColumns = "col-md-6";
              break;
          default:
          $postColumns = "col-md-3";
      }
      
    }
@endphp
<section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 insta-layout">
          <div class="col-md-12">
            <img src="{{asset('image/instafeed-instagram-icon.png')}}" alt="" />
           
            <h4>Instagram Feed</h4>
            <form  method="post" action="{{url('store-form')}}">
              @sessionToken
              <div class="fd-ttl">
                <label for="">Feed Title</label><br />
                <input type="hidden" name="id" value="@if(isset($data)){{$data->id}}@endif">
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
                  @foreach ( $layouts as  $layout)
                    <option @if(isset($data)) @if($data->layout == $layout['value']) selected @endif @endif value="{{$layout['value']}}">{{$layout['title']}}</option>
                  @endforeach
                </select>
              </div>
              <div class="row">
              <div class="col-md-6">
                <label for="">Post Spacing</label><br />
                <select name="spacing" id="">
                  @foreach ( $spaces as  $space)
                    <option @if(isset($data)) @if($data->spacing == $space['value']) selected @endif @endif value="{{$space['value']}}">{{$space['title']}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label for="">On Click</label><br />
                <select name="click" id="">
                  @foreach ( $clicks as  $click)
                  <option @if(isset($data)) @if($data->click == $click['value']) selected @endif @endif value="{{$click['value']}}">{{$click['title']}}</option>
                @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label for="">Border Radius</label><br />
                <select name="border" id="">
                  @foreach ( $radiuses as  $radius)
                  <option @if(isset($data)) @if($data->border == $radius['value']) selected @endif @endif value="{{$radius['value']}}">{{$radius['title']}}</option>
                @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label for="">Columns</label><br />
                <select name="column" id="">
                  @foreach ( $columns as  $column)
                  <option @if(isset($data)) @if($data->column == $column['value']) selected @endif @endif value="{{$column['value']}}">{{$column['title']}}</option>
                @endforeach
                </select>
              </div>
              <div class="col-md-1">
                  <input @if(isset($data)) @if($data->load_more) checked @endif @endif type="checkbox" name="load_more" value="1" id="">
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
          <h4>Preview</h4> 
          @if(isset($pictures))
          <div class="row img-combo">
            @foreach($pictures as $ar)

            @php
            $link = "#"; 
              if($openPost == "GI") 
                   $link = $ar["link"]; 
            @endphp
                  
            <div class="instafeeds {{$postColumns }}" style="margin:{{$spacing}}px">
              <a href="{{$link}}">
                  <img src="/feeds/{{$ar["file"]}}" style="border: 1px solid transparent; {{'border-radius:'.$border.'px'.';' }}" alt="">
              </a>
            </div>    
            @endforeach
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