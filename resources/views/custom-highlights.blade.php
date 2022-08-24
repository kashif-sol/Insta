@include('layouts.header')
@extends('website')
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-5 insta-layout">
        <div class="col-md-12 in-hg">
          <img src="image/instafeed-custom-highlights.png" alt="" />
          <h4>Custom Highlights</h4>
          <form action="{{route('save-story')}}" method="POST" enctype="multipart/form-data"> 
            @csrf
                        <div class="fd-ttl">
                          <input type="hidden" class="session-token" name="token" value="" />
                          <input type="hidden" name="id" value="27" id="story_id" >
      
              <label for="">Feed Title</label><br />
              <input
                type="text"
                name="title"
                id=""
                placeholder="Leave empty if you don't want a title"
              />
            </div>
            <div class="row">
              <div class="col-md-12">
                <p>Colors</p>
            </div>
              <div class="col-md-12">
                <div class="row">
                <div class="col-md-4">
                    <select name="color_type" id="color_type">
                        <option value="D"   >Default</option>
                        <option value="S"   selected  >Solid</option>
                        <option value="G"   >Gradient</option>
                    </select>
                </label>
              </div>
             
                <div class="col-md-2 color_type1 ">
                  <input type="color" name="first_color" id="first_color"  value="#800080">
                </div>
              
              <div class="col-md-2 color_grad  hideFirstColor ">
                <input type="color" name="second_color" id="second_color" value="#000000">
              </div>
              <div class="col-md-4 color_grad  hideFirstColor " >
                 
                <select name="angle" id="angle">
                <option value="">Choose angle</option>
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
            </div>
              </div>
            <div class="row para-set">
                <div class="col-md-6">
                  <p>Image</p>
                </div>
                <div class="col-md-6">
                  <p>Link</p>
                </div>
              </div>
              <div class="add-setup">
                <div class="row dash-data" id="duplicater">
                               <div class="col-md-5">
                                 <div class="col-md-12">
                                     <div class="row data-cnt">
                                         
                                         <div class="col-md-4">
                                             <div class="dash-img-1">
                                     <img src="{{asset('photos/icons8-loading-96_1658843155.png')}}" alt="Instagram Story Header" >
                                 </div>
                                 </div>
                                 <div class="col-md-8 upload-img">
                                     <label for="img-up-44">Upload Image
                                     <input type="file" name="photos[]" id="img-up-44" class="story-file">
                                 </label>
                                 </div>
                                 </div>
                                 </div>
                               </div>
                              
                               <div class="col-md-2">
                                 <div class="col-md-12">
                                   <input type="text"  name="story_link[]" id="" placeholder="Enter link">
                                 </div>
                               </div>
                               <div class="col-md-5">
                                 <div class="row data-cnt">
                                 <div class="col-md-9">
                                     <div class="dash-img">
                                       <img src="{{asset('photos/111.png')}}" alt="Instagram Story Header">
                                 </div>
                                 </div>
                                 <div class="col-md-3">
                                     <button class="remove" type="button" data-id="44">
                                       <i class="fa fa-trash" aria-hidden="true"></i>                                </button>
                                 </div>
                               </div>
                             </div>
                           </div>
                                                                     
                           
           
                   
                   <div class="col-md-12 before_btn">
                     <button class="add-more" type="button">Add more</button>
                   </div>
                 </div>
            {{-- <div class="row cus-hg">
                <div class="col-md-6">
                  <div class="col-md-12">
                      <div class="row data-cnt">
                        <div class="col-md-4">
                          <div class="dash-img-1">
                  <img src="{{asset('photos/icons8-loading-96_1658843155.png')}}" alt="Instagram Story Header" >
              </div>
              </div>
              <div class="col-md-8 upload-img">
                <label for="img-up-44">Upload Image
                <input type="file" name="photos[]" id="img-up-44" class="story-file">
            </label>
            </div>
                  </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="col-md-12">
                    <input type="text"  name="story_link[]" id="" placeholder="Enter link">
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="row data-cnt">
                  <div class="col-md-9">
                      <div class="dash-img">
                        <img src="{{asset('photos/111.png')}}" alt="Instagram Story Header">
                  </div>
                  </div>
                  <div class="col-md-3">
                      <button class="remove" type="button" data-id="44">
                        <i class="fa fa-trash" aria-hidden="true"></i>                                </button>
                  </div>
                </div>
              </div>
                
              </div> --}}
              {{-- <div class="col-md-12 before_btn">
                  <button class="add-more" type="button">Add more</button>
                </div> --}}
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
            <img src="image/instafeed-story.png" alt="">
            <img src="image/instafeed-story.png" alt="">
            <img src="image/instafeed-story.png" alt="">
            <img src="image/instafeed-story.png" alt="">
            <img src="image/instafeed-story.png" alt="">
        </div>
      </div>
    </div>
  </div>
</section>