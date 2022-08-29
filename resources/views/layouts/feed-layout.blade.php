<div class="col-md-7 insta-lay-rgt">
    @if(isset($pictures))
    <h4>Preview</h4> 
   
  
    <div class="col-md-12 img-combo">
      @foreach($pictures as $ar)
      <img src="{{asset('assets/'.$ar)}}" style="border: 1px solid transparent; {{'border-radius:'.$data->border.'px'.';'.'margin:'.$data->spacing.'px' }}" alt="">
              
      @endforeach
    </div>
    @else
    <div class="col-md-12 img-pwr">
        <img src="{{asset('image/powered-by-instafeed.png')}}" alt="">
      </div>
      @endif
  </div>