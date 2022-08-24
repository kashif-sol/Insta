<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/bootstraps.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/customs.css?v=3')}}" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  </head>
  <body>
   
    @yield('content')

   
    
    <script src="{{asset('js/bootstrap.min.js')}}" ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>

      var story_html = '<div class="row dash-data"> <div class="col-md-4"> <div class="col-md-12"> <div class="row data-cnt"> <div class="col-md-1">–</div><div class="col-md-3"> <div class="dash-img"> </div></div><div class="col-md-8 upload-img"> <label for="img-up-2">upload image <input type="file" name="photos[]" id="img-up-2" class="story-file"> </label> </div></div></div></div><div class="col-md-3"> <div class="col-md-12"> <input type="search" value="" name="story_link[]" id="" placeholder="search or paste a link...."> </div></div><div class="col-md-5"> <div class="row data-cnt"> <div class="col-md-3"> <div class="dash-img"> </div></div><div class="col-md-9"> <button class="remove" type="button" data-id=""> <i class="fa-solid fa-trash-can"></i> </button> </div></div></div></div>';

      $(document).ready(()=>{

        $('.add-setup').on('click', '.add-more', function() {
          var size_childs = $(".add-setup div").length;
          
          var html = $('.add-more').closest('.add-setup').find('.dash-data').first().html();///.insertBefore('.before_btn');
          html = "<div class='row dash-data'>"+html+"</div>";
          $(html).insertBefore('.before_btn');
          $(this).parent().prev().find(".upload-img .story-file").attr("id","img-up-" + size_childs);
          $(this).parent().prev().find(".upload-img label").attr("for","img-up-" + size_childs);
          $(this).parent().prev().find(".remove").attr('data-id' , '');
          $(this).parent().prev().find(".dash-img").empty();
          
        });

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
                  $('.remove').closest('.add-setup').find('.dash-data').not(':first').last().remove();
                }

              });
            }
            else{
              $('.remove').closest('.add-setup').find('.dash-data').not(':first').last().remove();
            }
            
        });

        $(document).on('click', '#delete-story', function() {
          var id = $("#story_id").val();
          if(id > 0)
          {
            $.ajax({
              method: 'get',
              url:'/delete-story/' + id,
              success:function(response)
              {
                window.location.href = "/all-stories";
              }

            });
          }
          else{
            
          }
          
        });

    </script>
  </body>
</html>