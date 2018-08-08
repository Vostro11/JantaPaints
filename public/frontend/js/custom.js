$(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
var coordinatesL = [];
var color = null;
var edit = false;
var selectedColors = [];
var selectedColor = [];
var canvas=document.getElementById('canvas');
/*var coordinates2=[ 5,5, 100,50, 50,100, 10,90 ];
drawPolygone('canvas','#f00',coordinates2);

var coordinates=[ 14,84, 105,84, 106,165, 19,164 ];
drawPolygone('canvas','#000',coordinates);

var coordinates3 = [232,61,194,96,169,140,148,190,141,208,137,238,151,265,180,298,218,332,251,343,287,373,333,381,372,388,411,379,450,361,487,330,522,242,541,194,534,154,523,126,487,76,469,55,387,55,332,40,309,38,293,43,268,47,48,30];
drawPolygone('canvas','#000',coordinates3);*/
function selectedColors(){
  
 
  
  
}
function setCoordinates(coordinates){
  coordinatesL.push(coordinates);
  drawPolygone('canvas',coordinatesL)
}
function drawPolygone2(id,color2,coordinates){
  
  // console.log(coordinatesL);
  canvas=document.getElementById(id);
  var ctx = canvas.getContext('2d');
  ctx.fillStyle = color//.replace(')',',2');
  ctx.strokeStyle = color.replace(')',',0.9)');
  ctx.beginPath();
  ctx.moveTo(coordinates[0], coordinates[1]);
  for( item=2 ; item < coordinates.length-1 ; item+=2 )
    {
      ctx.lineTo( coordinates[item] , coordinates[item+1] )
    }
  ctx.closePath();
  ctx.fill();
 
}
function drawPolygone(id,coordinates){
  // console.log(coordinatesL);
  var canvas=document.getElementById(id);
  var ctx = canvas.getContext('2d');
  ctx.fillStyle = 'rgb(255,255,255,0.1)';
  ctx.strokeStyle = 'rgb(255,255,255,0.501960784313726)';

  // ctx.beginPath();
  ctx.moveTo(coordinatesL[0], coordinatesL[1]);
  // for( item=2 ; item < coordinatesL.length-1 ; item+=2 )
  //   {
  //     ctx.lineTo( coordinatesL[item] , coordinatesL[item+1] )
  //   }
    for(var t =0; t < coordinatesL.length;t++){
               ctx.moveTo(coordinatesL[t][0], coordinatesL[t][1]);
                for (var i = 0; i < coordinatesL[t].length; i += 2) {//connect points and fill
                    //ctx.fillRect(coordinatesL[t][i] - 2, coordinatesL[t][i + 1] - 2, 4, 4);
                    //ctx.strokeRect(coordinatesL[t][i] - 2, coordinatesL[t][i + 1] - 2, 4, 4);
                    if (coordinatesL[t].length > 2 && i > 1) {
                        ctx.lineTo(coordinatesL[t][i], coordinatesL[t][i + 1]);
                        // console.log(coordinatesL[t][i]+','+ coordinatesL[t][i + 1]);
                    }
                }
            }

  ctx.closePath();
  ctx.fill();
   ctx.stroke();
  return false;
}

checkcheck = function ( nvert, vertx, verty, testx, testy ) {
    var i, j, c = false;
    for( i = 0, j = nvert-1; i < nvert; j = i++ ) {
        if( ( ( verty[i] > testy ) != ( verty[j] > testy ) ) &&
            ( testx < ( vertx[j] - vertx[i] ) * ( testy - verty[i] ) / ( verty[j] - verty[i] ) + vertx[i] ) ) {
                c = !c;
        }
    }
    return c;
}

var openGallery,uploadImage,uplodeFile;
openGallery = function(){
  $('.our-gallery').removeClass('hidden');
}
uploadImage = function(){
  console.log('test');
  $('#imgupload').trigger('click');
}
uplodeFile = function(){
  $('form#upload_file').submit();
}
$(document).find('.open_gallery').click(openGallery);
$(document).find('.upload_image').click(uploadImage);
$(document).find('#imgupload').change(uplodeFile);

// function hexToRgb(hex) {
//     // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
//     var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
//     hex = hex.replace(shorthandRegex, function(m, r, g, b) {
//         return r + r + g + g + b + b;
//     });
//     var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
//     console.log(result)
//     return result ? {
//         r: parseInt(result[1], 16),
//         g: parseInt(result[2], 16),
//         b: parseInt(result[3], 16)
//     } : null;
// }
// function trim (str) {
//   return str.replace(/^\s+|\s+$/gm,'');
// }
// function rgba2rgb(bg, RGBA)
// {
//     var RGB = {r:0,g:0,b:0};
//     var a = 1 - RGBA.a;
//     RGB.r = Math.round((RGBA.a * (RGBA.r / 255) + (a * (bg.r / 255))) * 255);
//     RGB.g = Math.round((RGBA.a * (RGBA.g / 255) + (a * (bg.g / 255))) * 255);
//     RGB.b = Math.round((RGBA.a * (RGBA.b / 255) + (a * (bg.b / 255))) * 255);
//     return RGB;
// }
// function rgbaToHex (rgba) {
//     var parts = rgba.substring(rgba.indexOf("(")).split(","),
//         r = parseInt(trim(parts[0].substring(1)), 10),
//         g = parseInt(trim(parts[1]), 10),
//         b = parseInt(trim(parts[2]), 10),
//         a = parseFloat(trim(parts[3].substring(0, parts[3].length - 1))).toFixed(2);

//     return ('#' + r.toString(16) + g.toString(16) + b.toString(16) + (a * 255).toString(16).substring(0,2));
// }
function saveColor(e){
    x = e.pageX - $('canvas').offset().left;
    y = e.pageY - $('canvas').offset().top;
    var c = canvas.getContext('2d');
    var p = c.getImageData(x, y, 1, 1).data; 
    // console.log(selectedColor.rgb);
    var rgba = 'rgb(' + p[0] + ', ' + p[1] + ', ' + p[2]+')';
    if(rgba == "rgb(255, 255, 255)"){
      selectedColors.push(selectedColor);// color is new, save color.
    }else{
      console.log(selectedColors);
      var found = selectedColors.some(function (el) {
           if(el.rgb === rgba){//color already exist, replace
              var index = selectedColors.indexOf(el)
              if (index > -1) {
                selectedColors.splice(index, 1,selectedColor);
              }
            }
      });
    }
    return true;
}
function displaySelected(){
  var colorPalet;
  $('.selected-colors ul').html('')
  var colors;
  $.each(selectedColors,function(key,value){
    colorPalet = `
                    <li>
                        <div class="color-palet" style="background-color:`+value.rgb+`;height:0;width: 55px!important;border: 18px solid `+value.rgb+` "></div>
                        <div class="slected-color-info"><span class="selected-shade-name" data-shade-name="">`+value.shade_name+`</span><br>
                        <span class="selected-shade-code" data-shade-code="">`+value.shade_code+`</span>
                        </div></div>
                    </li>`;
      
    $('.selected-colors ul').append(colorPalet);
  })
}

$(document).ready(function(){


  $('.color-palet').click(function(e){
    color = $(e.target).css('background-color');
    selectedColor = [];
    selectedColor['shade_name'] = $(e.target).find('.shade-name').data('shade-name');
    selectedColor['shade_code'] = $(e.target).find('.shade-code').data('shade-code');
    selectedColor['rgb'] = color;
  });

  $('#edit').click(function(e){
    e.preventDefault();
    if(edit){
      edit = false;
    }else{
      edit = true;
    }
    return false;
  });
});


// function removeDuplicates(myArr, prop) {
//     return myArr.filter((obj, pos, arr) => {
//         return arr.map(mapObj => mapObj[prop]).indexOf(obj[prop]) === pos;
//     });
// }
$(document).ready(function(){
canvas=document.getElementById('canvas');
canvas.addEventListener('click', (e) => {
      
      var nvert;
      var vertx = [];
      var verty = [];
      for(var m = 0; m<coordinatesL.length; m++){
        nvert = coordinatesL[m].length/2;
        for(var l = 0; l<coordinatesL[m].length; l+=2){
          vertx.push(coordinatesL[m][l]); 
          verty.push(coordinatesL[m][l+1]);
          }
        // alert(checkcheck(nvert, vertx, verty, e.offsetX, e.offsetY));
        if(checkcheck(nvert, vertx, verty, e.offsetX, e.offsetY)){
          if(color !=null){
              saveColor(e);
              displaySelected();
              drawPolygone2('canvas',color,coordinatesL[m]);
          }
        }
        vertx = [];
        verty = [];

      }
    });
});


//click
$('#print').click(function(){
      $('#myModal').show();
      var brushCanvas =document.getElementById('canvas');
      var img = $('#background').attr('src');

      var ctx = canvas.getContext('2d');
      var can1 = document.getElementById('imageCanvas');
      var ctx1 = can1.getContext('2d');
      var background = new Image();
      var myurl = $('#background').attr('src');
      background.src = myurl;
      ctx1.drawImage(background, 0, 0,900,450);
      ctx1.drawImage(brushCanvas, 0, 0);
      // Make sure the image is loaded first otherwise nothing will draw.
      // background.onload = function(){
      // console.log(canvas)
      //     ctx.drawImage(background,0,0); 
      // }
      var printContents = document.getElementById('myModal').innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      var can1 = document.getElementById('imageCanvas');
      var ctx1 = can1.getContext('2d');
      ctx1.drawImage(background, 0, 0,900,450);
      ctx1.drawImage(brushCanvas, 0, 0);
      displaySelected();
      // PrintDiv();
      window.print()
      document.body.innerHTML = originalContents;
      $('#myModal').hide();
    });
/***************************PreviewImage***********/
function previewImage () {
  $('.overlayImage').show();
  //fit();
  var can1 = document.getElementById('imageCanvas');
  var can2 = document.getElementById('myCanvas');
  //var can3 = document.getElementById('myCanvas2');
  var can4 = document.getElementById('brushCanvas');
  var ctx1 = can1.getContext('2d');
  ctx1.drawImage(can2, 0, 0);
  //ctx1.drawImage(can3, 0, 0);
  ctx1.drawImage(can4, 0, 0, 900, 450);
  var x = new Image();
  x = can1.toDataURL();
  document.getElementById('preview_image').src = x;
  $('.preview_image_div').show();
  var get_list = $('.used_color_div .used_color').clone();
  $('.preview_image .used_color').remove();
  $('.preview_image').append(get_list);
}

function closeOverlay () {
  $('.overlayImage').hide();
  $('.preview_image_div').hide();
  $('.noShapeAlert').hide();
}

/****************************************************************Print Function*/
$(function() {
    $("#print1").click(function() {
    previewImage ();    
  //fit();
  /*var can1 = document.getElementById('imageCanvas');
  var can2 = document.getElementById('myCanvas');
  var can4 = document.getElementById('brushCanvas');
  var ctx1 = can1.getContext('2d');
  ctx1.drawImage(can2, 0, 0);
  ctx1.drawImage(can4, 0, 0);
  var x = new Image();
  x = can1.toDataURL();
  document.getElementById('preview_image').src = x;*/
    //$(".preview_image").append("<div class='printable'>this is demo text to test the printing of the element in html.</div>");
    // Print the DIV.
    //$(".preview_image").print();
        PrintDiv();
    return (false);
  });
});
function PrintDiv() {    
           var divToPrint = document.getElementById('myModal');
           var popupWin = window.open('', '_blank');

           // $("#print_div li").each(function(){
           //  var color = $(this).css("background-color");
           //  $(this).css({
           //      "height":"0px",
           //      "width":"0px",
           //      "border":"25px solid "+color,
           //  });
           // });
      console.log("print Div was clicked");
           popupWin.document.open();
           // popupWin.document.write('<html><head><link href="style.css" type="text/css" rel="stylesheet" /><link href="print.css" type="text/css" rel="stylesheet" media="print" /></head><body onload="window.print()"><div class="header"><img style="margin-top:0;" src="images/header_logo_print.jpg"></div>' + divToPrint.innerHTML + '<div class="footer_text"><p><strong>Note:-</strong> The shades shown are for indicative purpose only. Please refer to Asian Paints Color Palette for actual shade reference.</p><h3>www.asianpaintsnepal.com</h3></div></html>');
            popupWin.document.close();
                }
