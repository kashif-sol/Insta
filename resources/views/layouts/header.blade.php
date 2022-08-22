<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Insta</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
  </head>
  
    <header>
      <div class="container-fluid">
        <div class="row mt-3">
          <div class="col-md-12 links">
            <a href="/dashboard"
              ><i class="fa-solid fa-house"></i> Dashboard</a
            >
            <a href="/settings.html"
              ><i class="fa-solid fa-gear"></i> Settings</a
            >
          </div>
          <div class="col-md-12">
            <div class="row top-set">
              <div class="col-md-4 inst-sty">
                <form action="{{url('getdata')}}" method="GET">
                  <input type="text" name="profile" id="" class="inst-use"placeholder="Enter instagram username "/>
                  <input type="submit" value="Connect" />
                </form>
              </div>
              <div class="col-md-8 inst-sty-rgt">
                <a href="">Rate us</a>
                <a href="">Read installation guide</a>
                <a href="">FAQs</a>
                <a href="" class="inst-rgt-bg">Contact support</a>
              </div>
              <div class="col-md-12 dis-set">
                @if(isset($store))
               <p>Connected to:<span> {{$store->user_fullname}}</span> <a href="dashboard">Disconnect</a></p>
               @endif 
            </div>
            </div>
          </div>
        </div>
      </div>
    </header>