<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Insta</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/custom.css" />
    <script src="{{asset('js/bootstrap.min.js')}}" ></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
  </head>
  <body>
    <header>
      <div class="container-fluid">
        <div class="row mt-3">
       
          <div class="col-md-12 links">
            <a href="dashboard"
              ><i class="fa-solid fa-house"></i> Dashboard</a
            >
            <a href="/settings"
              ><i class="fa-solid fa-gear"></i> Settings</a
            >
            <a href="/test"
              ><i class="fa-solid fa-gear"></i> Test</a
            >
          </div>
          <div class="col-md-12">
            <div class="row top-set">
              <div class="col-md-4 inst-sty">
                <form action="{{url('getdata')}}" method="get">
                  @sessionToken
                  <input
                    type="text"
                    name="profile"
                    id=""
                    class="inst-use"
                    placeholder="Enter instagram username "
                  />
                  <input type="submit" value="Connect" />
                </form>
               
              </div>
              <div class="col-md-8 inst-sty-rgt">
                <a target="_blank" href="https://apps.shopify.com/insta-story-style-header">⭐ Rate us</a>
                <a href="/installation-guide">Read installation guide</a>
                <a href="/faq">FAQs</a>
                <a target="_blank"  href="mailto:info@instastores.co.uk" class="inst-rgt-bg">💬 Contact support</a>
              </div>
              <div class="col-md-12 dis-set">
                <form action="{{url('delete-insta')}}" method="get">
                  @sessionToken
                <p>
                  @if(isset($user))
                  Connected to:<span>{{$user->username}}</span>
                  <button type="submit">Disconnect</button>
                  @endif
                </p>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>


    @if(\Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_enabled'))
    <script src="https://unpkg.com/@shopify/app-bridge{{ \Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
    <script src="https://unpkg.com/@shopify/app-bridge-utils{{ \Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
    <script @if(\Osiset\ShopifyApp\Util::getShopifyConfig('turbo_enabled')) data-turbolinks-eval="false" @endif>
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var utils = window['app-bridge-utils'];
        var createApp = AppBridge.default;
        var app = createApp({
            apiKey: "{{ \Osiset\ShopifyApp\Util::getShopifyConfig('api_key', $shopDomain ?? Auth::user()->name ) }}"
            , shopOrigin: "{{ $shopDomain ?? Auth::user()->name }}"
            , host: "{{ \Request::get('host') }}"
            , forceRedirect: true
        , });
    </script>
    @include('shopify-app::partials.token_handler')
    @include('shopify-app::partials.flash_messages')
    @endif

   

  </body>
</html>

