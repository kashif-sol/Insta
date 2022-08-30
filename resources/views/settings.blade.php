@include('layouts.header')
<section class="dash-setting">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h5>Settings</h5>
          </div>
          <form action="{{route('save-settings')}}" method="POST">
            @sessionToken

            <input type="hidden" id="id" value="{{ $settings->id ?? '' }}"  name="id">
          <div class="col-md-12">
            <p>Display Settings</p>
          </div>
          <div class="col-md-12">
            <div class="row dash-page">
          <div class="col-md-2">
            <label for="home">
                <input type="checkbox" name="display_device[]" id="home" value="M" @if(isset($settings)) @if (str_contains($settings->display_device, 'M')) checked @endif @endif> Mobile
            </label>
          </div>
          <div class="col-md-2">
            <label for="collection">
                <input type="checkbox" name="display_device[]" id="collection" value="T" @if(isset($settings)) @if (str_contains($settings->display_device, 'T')) checked @endif @endif>Tablet
            </label>
          </div>
          <div class="col-md-8">
            <label for="product">
                <input type="checkbox" name="display_device[]" id="product" value="D" @if(isset($settings)) @if (str_contains($settings->display_device, 'D')) checked @endif @endif> Desktop
            </label>
          </div>
          <div class="col-md-12">
            <p>Custom CSS</p>
          </div>
          <div class="col-md-12">
            <input type="text" name="custom_css" value="{{ $settings->custom_css ?? '' }}">
          </div>
          <div class="col-md-12">
            <p>Custom JS</p>
          </div>
          <div class="col-md-12">
            <input type="text" name="custom_js" value="{{ $settings->custom_js ?? '' }}">
          </div>
          <div class="col-md-12">
            <input type="submit" value="Save">
          </div>
        </form>
        </div>
        </div>
    </section>
 <style>
    .dash-setting {
    padding: 50px;
}

.dash-setting .dash-page {
    padding: 0px 0px 30px 0px;
}

.dash-setting form .dash-page input[type="text"] {
    width: 40%;
    height: 45px;
    border: 2px solid rgb(192, 190, 190);
    margin-right: 10px;
}

.dash-setting form .dash-page input[type="checkbox"] {
    width: 20px;
    height: 20px;
    border: 2px solid rgb(192, 190, 190);
    margin-right: 10px;
}

.dash-setting form .dash-page label {
    display: flex;
    align-items: center;
}

.dash-setting form p {
    font-weight: 500;
    font-size: 17px;
    margin-bottom: 10px;
    margin-top: 20px;
}

.dash-setting form input[type=submit] {
    background-color: #048161;
    border: none;
    margin-top: 50px;
    color: #fff;
    border-radius: 10px;
    width: 8%;
    height: 35px;
}

.dash-setting h5 {
    font-size: 1.5rem;
}

</style>