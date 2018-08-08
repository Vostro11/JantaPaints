@extends('frontend.layouts.app')
@section('title')
    image processing
@endsection
@section('meta')
    Image Processing
@endsection
@section('content')
    @include('frontend.layouts.header')
    <style type="text/css">
    </style>
      <div class="row">
        <div class="col-md-3">
          <div class="colot-options">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#interior">INTERIOR</a></li>
                <li><a data-toggle="tab" href="#exterior">EXTERIOR</a></li>
            </ul>
            <div class="tab-content">
              <div id="interior" class="tab-pane fade in active">
                <div class="color-palet-wrapper">
                  <?php $chunkI = $colors->chunk(15); ?>
                  @foreach($chunkI as $csI)
                  <div class="abc">
                    @foreach($csI as $colorI)
                     <div class="col-sm-3 color-palet" style="background-color: {{$colorI->rgb}}" >
                      <span class="shade-name" data-shade-name="{{$colorI->shade_name}}"></span>
                      <span class="shade-code" data-shade-code="{{$colorI->shade_code}}"></span>
                        </div>
                    @endforeach
                  </div>
                  @endforeach
                </div>
              </div>
              <div id="exterior" class="tab-pane fade">
                <div class="color-palet-wrapper">
                    <?php $chunkE = $colors->chunk(15); ?>
                    @foreach($chunkE as $csE)
                    <div class="abc">
                      @foreach($csE as $colorE)
                       <div class="col-sm-3 color-palet" style="background-color: {{$colorE->rgb}}">
                          </div>
                      @endforeach
                    </div>
                    @endforeach
                  </div>
                </div>
            </div> 
          </div> 
          <div class="panel panel-default">
            <div class="panel-heading">Selected Color</div>
            <div class="panel-body">
              <div class="selected-colors">
                <ul>
             
                </ul>
              </div>
            </div>
          </div>   
        </div>
        <div class="col-md-9">
          <canvas id="canvas" width="900" height="450" style="background: url({{asset($image->image)}}); background-repeat: no-repeat;background-position: center center;background-size: cover;">     
          </canvas>
          <img id="background" src="{{asset($image->image)}}" class="hidden">
          <div class="image-processing-menu">
            <div class="image-menu">
              <ul>
                <li><button class="btn btn-primary" type="button" id="print">Print</button></li>
                <!-- <li><button class="btn btn-primary" type="button" id="edit">Edit</button></li> -->
              </ul>
            </div>
          </div>
        </div>
        
      </div>
      
    </div>

    <div id="myModal" style="display: none">
        
              <div class="row">
                <div class="col-md-9">
                   <canvas id="imageCanvas" width="900" height="450" style="background-repeat: no-repeat;background-position: center center;background-size: cover;"></canvas>
                </div>
                <div class="col-md-3">
                  <div class="panel panel-default">
                    <div class="panel-heading">Selected Color</div>
                    <div class="panel-body">
                      <div class="selected-colors">
                        <ul>
                     
                        </ul>
                      </div>
                    </div>
                  </div> 
                </div>
              </div>
            
      </div>

      @foreach($coordinates as $coordinate)
      <script type="text/javascript">
        $(document).ready(function(){
         var coordinates2=[ {{$coordinate->coordinate}}];
         setCoordinates(coordinates2);
        });
       
      </script>
      @endforeach
@endsection
