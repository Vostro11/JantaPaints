

// $(document).find('body').click(function(e){
//               if(edit === true){
//                 console.log('edit- mode')
//                 mousedown(e);
//                 return false;
//               }
//               var nvert;
              
//               var vertx = [];
//               var verty = [];
//               for(var m = 0; m<coordinatesL.length; m++){
//                 nvert = coordinatesL[m].length/2;
//                 for(var l = 0; l<coordinatesL[m].length; l+=2){

//                   vertx.push(coordinatesL[m][l]); 
//                   verty.push(coordinatesL[m][l+1]);

//                   }
//                 //console.log(coordinatesL);
//                 if(checkcheck(nvert, vertx, verty, e.offsetX, e.offsetY)){
//                   // alert('wow')
//                   if(color !=null){
//                       drawPolygone2('canvas',"rgba(255,255,255,0.1)",coordinatesL[m]);//reset
//                       drawPolygone2('canvas',color,coordinatesL[m]);
//                   }
//                 }
//                 vertx = [];
//                 verty = [];

//               }

//         });


// var dimention = 0;
// // 
// // 
// // var draw1;

// // multiplePoints[dimention] = points;
// var multiplePoints = [];
// var points = [];
// // var multiplePoints = [];

// var activePoint, settings,activePointT;
// var $reset,$addNew,$clearLast,$save, $canvas, ctx, image;
// var draw, mousedown, stopdrag, move, moveall, resize, reset,addNew,clearLast, save, rightclick, record;
// var dragpoint;
// var startpoint = false;
// multiplePoints[dimention] = []
// $canvas = $('<canvas>');
// ctx = $canvas[0].getContext('2d');


// function mousedown(e) {
//             var x, y, dis, lineDis, insertAt = multiplePoints[dimention].length;
//             var insertAtT = dimention;

//             if (e.which === 3) {
//                 return false;
//             }

//             e.preventDefault();
//             if (!e.offsetX) {
//                 e.offsetX = (e.pageX - $(e.target).offset().left);
//                 e.offsetY = (e.pageY - $(e.target).offset().top);
//             }
//             x = e.offsetX;
//             y = e.offsetY;
//             // console.log('x '+x);
//             console.log(multiplePoints);
//             // if (points.length >= 6) {//6 because we need at least 3 points to make any sape other than a line
//             //     var c = getCenter();//if clicked in center, dont create point however if mouse move, move all
//             //     ctx.fillRect(c.x - 4, c.y - 4, 8, 8);
//             //     dis = Math.sqrt(Math.pow(x - c.x, 2) + Math.pow(y - c.y, 2));//distance from center, but why. to move point
                
//             //     if (dis < 6) {//6 px fat center point
//             //         startpoint = false;//dont start point
//             //         $(this).on('mousemove', moveall);//if mouse move move all
//             //         return false;
//             //     }
//             // }
//             for(var t = 0; t < multiplePoints.length; t++){
//                 for (var i = 0; i < multiplePoints[t].length; i += 2) {//move previously created point if ckicked in 6 px around
//                     dis = Math.sqrt(Math.pow(x - multiplePoints[t][i], 2) + Math.pow(y - multiplePoints[t][i + 1], 2));
                    
//                     if (dis < 6) {
//                         activePoint = i;
//                         activePointT = t;
//                         $(this).on('mousemove', move);
//                         return false;
//                     }
//                 }
//             }
//             for(var t = 0; t < multiplePoints.length; t++){
//                 for (var i = 0; i < multiplePoints[t].length; i += 2) {
//                     if (i > 1) {
//                         lineDis = dotLineLength(
//                             x, y,
//                             multiplePoints[t][i], multiplePoints[t][i + 1],
//                             multiplePoints[t][i - 2], multiplePoints[t][i - 1],
//                             true
//                         );
//                         if (lineDis < 6) {
//                             insertAt = i;
//                             insertAtT = t;
//                         }
//                     }
//                 }
//             }

//             multiplePoints[insertAtT].splice(insertAt, 0, Math.round(x), Math.round(y));
//             // multiplePoints[dimention] = points;
//             // console.log(multiplePoints);
//             activePoint = insertAt;
//             activePointT = insertAtT;
//             $(this).on('mousemove', move);

//             draw();

//             return false;
//         };

//         function addNew(){
//             // console.log(dimention);
//             // console.log(multiplePoints);
//             if(multiplePoints[dimention].length>0){
//                 multiplePoints[dimention].push(multiplePoints[dimention][0]);
//                 multiplePoints[dimention].push(multiplePoints[dimention][1]);
//                 if(multiplePoints[dimention].length>0){
//                     dimention ++;
//                 }
//                 points = [];
//                 multiplePoints[dimention] = points;
//             }
//         }
//         function clearLast(){
//                 if(multiplePoints[dimention].length < 1 && dimention > 0){
//                     multiplePoints.pop();
//                     dimention--;                   
//                 }
//                 multiplePoints[dimention].pop();
//                 multiplePoints[dimention].pop();

//                 console.log(multiplePoints);
//                 // console.log(dimention);
//                 draw();
//         }

//         function reset() {
//             points = [];
//             dimention = 0;
//             multiplePoints = [];
//             multiplePoints[dimention] = [];
//             draw();
//         };

//         function move(e) {
//             if (!e.offsetX) {
//                 e.offsetX = (e.pageX - $(e.target).offset().left);
//                 e.offsetY = (e.pageY - $(e.target).offset().top);
//             }
//             multiplePoints[activePointT][activePoint] = Math.round(e.offsetX);
//             multiplePoints[activePointT][activePoint + 1] = Math.round(e.offsetY);
//             draw();
//         };

//         function moveall(e) {
//             if (!e.offsetX) {
//                 e.offsetX = (e.pageX - $(e.target).offset().left);
//                 e.offsetY = (e.pageY - $(e.target).offset().top);
//             }
//             if (!startpoint) {
//                 startpoint = {x: Math.round(e.offsetX), y: Math.round(e.offsetY)};
//             }
//             var sdvpoint = {x: Math.round(e.offsetX), y: Math.round(e.offsetY)};
//             for (var i = 0; i < points.length; i++) {
//                 points[i] = (sdvpoint.x - startpoint.x) + points[i];
//                 points[++i] = (sdvpoint.y - startpoint.y) + points[i];
//             }
//             startpoint = sdvpoint;
//             draw();
//         };

//         function stopdrag() {
//             $(this).off('mousemove');
//             record();
//             activePoint = null;
//             activePointT = null;
//         };

//         function rightclick(e) {
//             e.preventDefault();
//             if (!e.offsetX) {
//                 e.offsetX = (e.pageX - $(e.target).offset().left);
//                 e.offsetY = (e.pageY - $(e.target).offset().top);
//             }
//             var x = e.offsetX, y = e.offsetY;
//             for (var i = 0; i < points.length; i += 2) {
//                 dis = Math.sqrt(Math.pow(x - points[i], 2) + Math.pow(y - points[i + 1], 2));
//                 if (dis < 6) {
//                     points.splice(i, 2);
//                     draw();
//                     record();
//                     return false;
//                 }
//             }
//             return false;
//         };

       

//             //=====================================================================================draw
//         function draw() {
//             ctx.canvas.width = ctx.canvas.width;
//             console.log(multiplePoints[0])
//             if (multiplePoints.length < 0) {
//                 return;
//             }
//             ctx.globalCompositeOperation = 'destination-over';
//             ctx.fillStyle = 'rgb(255,255,255)';
//             ctx.strokeStyle = 'rgb(255,20,20)';
//             ctx.lineWidth = 1;
//             if (points.length >= 6) {
//                 var c = getCenter();
//                 ctx.fillRect(c.x - 4, c.y - 4, 8, 8);
//             }
//             ctx.beginPath();//canvas function to draw line
            
//             for(var t =0; t < multiplePoints.length;t++){
//                ctx.moveTo(multiplePoints[t][0], multiplePoints[t][1]);
//                 for (var i = 0; i < multiplePoints[t].length; i += 2) {//connect points and fill
//                     ctx.fillRect(multiplePoints[t][i] - 2, multiplePoints[t][i + 1] - 2, 4, 4);
//                     ctx.strokeRect(multiplePoints[t][i] - 2, multiplePoints[t][i + 1] - 2, 4, 4);
//                     if (multiplePoints[t].length > 2 && i > 1) {
//                         ctx.lineTo(multiplePoints[t][i], multiplePoints[t][i + 1]);
//                         // console.log(multiplePoints[t][i]+','+ multiplePoints[t][i + 1]);
//                     }
//                 }
//             }
//             // console.log(multiplePoints);
//             ctx.closePath();
//             ctx.fillStyle = 'rgba(255,0,0,0.3)';
//             ctx.fill();
//             ctx.stroke();

//         };

        

//         function getCenter() {
//             var ptc = [];
//             for (i = 0; i < points.length; i++) {//create 2 dymantional aray of coordinate.. 0:{x:99,y:88}
//                 ptc.push({x: points[i], y: points[++i]});
//             }
        
            
//             var first = ptc[0], last = ptc[ptc.length - 1];
//             if (first.x != last.x || first.y != last.y) ptc.push(first);//make a loop add fist value of array to last
//             // console.log(ptc)
//             var twicearea = 0,
//                 x = 0, y = 0,
//                 nptc = ptc.length,
//                 p1, p2, f;
//             for (var i = 0, j = nptc - 1; i < nptc; j = i++) {
//                 p1 = ptc[i];
//                 p2 = ptc[j];
//                 f = p1.x * p2.y - p2.x * p1.y;
//                 twicearea += f;
//                 x += ( p1.x + p2.x ) * f;
//                 y += ( p1.y + p2.y ) * f;
//             }
//             f = twicearea * 3;
//             return {x: x / f, y: y / f};
//         };

//         