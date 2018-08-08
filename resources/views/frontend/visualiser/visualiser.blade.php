@extends('frontend.layouts.app')
@section('title')
    Home
@endsection
@section('meta')
    Home
@endsection
@section('content')

   
    @include('frontend.layouts.header')
      <div class="row">
        @if($image)
        <div class="col-md-3 color-palet-wrapper">
           <!-- @for($i=0 ; $i < 40 ; $i++)
            
              <div class="abc">
                
                @for($j = 0 ; $j < 15 ; $j++)

                  <div class="col-sm-3 color-palet" style="background-color: ">
                  </div>
                  <?php $i++; ?>
                @endfor
                
              </div>
          @endfor -->
          sss
        </div>
        <div class="col-md-9 draw-image">
          <form id="myform" action="{{route('store.coordinates')}}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="image_id" value="{{$image->id}}">
            <input type="text" name="coords2" class="canvas-area hidden" id="mycanvas"
          data-image-url="{{asset($image->image)}}" >
          <button class="btn btn-xs upload_image" type="button"><i class="icon-cloud-upload"></i> upload another</button>
          <a href="{{url('/')}}" ><button class="btn btn-xs upload_image"><i class="icon-remove"></i> remove image</button></a>
          <!-- <button class="btn btn-primary pull-right open_gallery">CHOOSE FROM OUR GALLERY</button> -->
          <!-- <input type="submit" name="Submit"> -->
          </form>
        </div>
        @else
          <div class="col-md-12 menu-wrapper">
          <div class="col-md-4 col-md-offset-4 menus">
              <div class="upload upload_image" id="upload_image">
                <div class="ap_upload"><u>UPLOAD</u></div>

              </div>
              
              <div class="from-gallery">
                <div class="or">OR</div>
                <button class="btn btn-primary open_gallery" id="open_gallery"><i class="far fa-hand-point-right"></i> CHOOSE FROM OUR GALLERY <i class="far fa-hand-point-left"></i> </button>
              </div>
          </div>
        </div>
        @endif
        
        <!-- row / end -->
        <!-- <div class="col-md-8 col-lg-offset-4">
          <canvas id="canvas" width="650" height="425" style="background: url({{asset('frontend/images/7.jpg')}})">
      
          </canvas>
        </div> -->
        
        
      </div>
    </div>
  <form id="upload_file" action="{{route('image.store')}}" class="hidden" method="post" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <input type="file" id="imgupload" name="image"/> 
    <input type="hidden" name="user_id" value="1"/> 
  </form>
  <script type="text/javascript">
    $('.color-palet').click(function(e){
      e.preventDefault();
    })
  </script>
@endsection
