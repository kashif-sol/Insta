@include('layouts.header')

<body>
<section>
  

  
    <div class="container-fluid">
      <div class="row insta-info">
        <div class="col-md-8">
          <h3>Welcome to Instafeed</h3>
          <h5>Instagram Feed, Story, Highlights & Reels</h5>
          <p>
            Installing Instafeed is super simple! Just follow these steps:
          </p>
          <ul>
            <li>
              <b>1)</b> Link your instagram account above by connecting
              through instagram or manually typing the username.
            </li>
            <li>
              <b>2)</b> Once connected you can add an Instagram Feed, Stories
              & Highlights.
            </li>
            <li>
              <b>3)</b> Alternatively you can create your own custom
              highlights and link to products or collections.
            </li>
          </ul>
        </div>
       
         
         
        
        <div class="col-md-4">
          <iframe
            src="https://www.youtube.com/embed/Xpu93lsoVsI"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
          ></iframe>
        </div>
      </div>
    </div>
  </section>
  <section>
      <div class="container-fluid">
          <div class="row text-center insta-reel">
            <a href="/insta-feed"><div class="col">
                <img src="{{asset('image/instafeed-instagram-icon.png')}}" alt="">
                  <h6>Instagram Feed</h6>
              </div></a>
              <a href="/insta-stories" ><div class="col hglg-img">
                  
                      <img src="{{asset('image/instafeed-story.png')}}" alt="">
                  <h6>Instagram Stories</h6>
              </div></a>
              <a href="/insta-highlights" ><div class="col">
                      <div class="dash-img">
                      <img src="{{asset('image/instafeed-highlights.png')}}" alt="">
                  </div>
              <h6>Instagram Hightlights</h6>
              </div></a>
              <a href="/custom-highlights"><div class="col">
                      <div class="dash-img">
                          <img src="{{asset('image/instafeed-custom-highlights.png')}}" alt="">
                      </div>
                  <h6>Custom Hightlights</h6>
                  <p>No instagram connection required</p>
              </div></a>
              <a href="/insta-reels"><div class="col">
                  <img src="{{asset('image/instafeed-instagram-reels-icon.png')}}" alt="">
                  <h6>Instagram Reels</h6>
              </div></a>
          </div>
      </div>
  </section>
 
</body>
