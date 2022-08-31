
        @if(isset($stories))
        @foreach ($stories as $story)
        @php
            $first_color = "#3f729b";
            $bg = $first_color;
            if($story['color_type'] == "S"){
                $bg = $story['first_color'];
            }
            else if($story['color_type'] == "G") 
            {
                $bg = 'linear-gradient('.$story['angle'].'deg, '.$story['first_color'].', '.$story['second_color'].')';
            }


        @endphp
        <div class="mobile-collection-nav" aria-label="Collections navigation">
            <div class="cstm-navflex">
            @foreach ($story['images'] as $image)
                <div class="main-inneritem">
                    <a href="{{$image['image_link']}}">
                        <div class="iconnav">
                            <div class="collImgcm" style="background: {{$bg}};">
                                <img src="{{env("APP_URL")}}{{$image['image_path']}}" alt="{{$image['image_title']}}">
                            </div>
                            
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
        @endforeach
    @endif


<style>

.iconnav .collImgcm {
    width: 200px;
    height: 200px;
    border: 2px solid transparent;
    background: #3f729b;
    background-size: 100%;
    padding: 3px;
    background-repeat: no-repeat;
    border-radius: 100%;
}

@if(isset($settings)) 
    @if (str_contains($settings->display_device, 'M') && str_contains($settings->display_device, 'T') && str_contains($settings->display_device, 'D'))
        {{$settings['custom_css']}}
    @endif 
    
    @if (str_contains($settings->display_device, 'D') )
        @media only screen and (min-width: 768px) {
            {{$settings['custom_css']}}
        }
    @endif 
    @if (str_contains($settings->display_device, 'T') )
        @media only screen and (min-width: 600px) {
            {{$settings['custom_css']}}
        }
    @endif 

    @if (str_contains($settings->display_device, 'M') )
        @media only screen and (max-width: 600px) {
            {{$settings['custom_css']}}
        }
    @endif 
    
@endif
</style>

@if(isset($settings))
@if(isset($settings['custom_js']))
<script>
    {{$settings['custom_js']}}
</script>
@endif
@endif