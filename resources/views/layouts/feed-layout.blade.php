<div class="col-md-7 insta-lay-rgt">
    @if(isset($feeds))
    <h4>Preview</h4> 
   
  
    <div class="col-md-12 img-combo">
      @foreach($firstFour as $ar)
      <img src="{{asset('assets/'.$ar)}}" style="{{'border-radius:'.$post->border.'px'.';'.'padding:'.$post->spacing.'px' }}" alt="">
              
      @endforeach
    </div>
    @else
    <div class="col-md-12 img-pwr">
        <img src="{{asset('image/powered-by-instafeed.png')}}" alt="">
      </div>
      @endif
  </div>