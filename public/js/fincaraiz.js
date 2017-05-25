
var MapCounters=new Array();
$(document).ready(function(){
$('body').append('<div id="tooltipMap" style="display:none;border:1px solid black;background:#fff;position:absolute;width:140px;height:auto;padding:5px"></div>');});
(function($){
var has_VML,has_canvas,create_canvas_for,add_shape_to,clear_canvas,shape_from_area,
canvas_style,hex_to_decimal,css3color,is_image_loaded,options_from_area,imageDefault;
has_VML=document.namespaces;
has_canvas=!!document.createElement('canvas').getContext;
if(!(has_canvas||has_VML)){
$.fn.maphighlight=function(){return this;};
return;}
if(has_canvas){
hex_to_decimal=function(hex){
return Math.max(0,Math.min(parseInt(hex,16),255));};
css3color=function(color,opacity){
return'rgba('+hex_to_decimal(color.substr(0,2))+','+hex_to_decimal(color.substr(2,2))+','+hex_to_decimal(color.substr(4,2))+','+opacity+')';};
create_canvas_for=function(img){
var c=$('<canvas style="width:'+img.width+'px;height:'+img.height+'px;"></canvas>').get(0);
c.getContext("2d").clearRect(0,0,c.width,c.height);
return c;};
var draw_shape=function(context,shape,coords,x_shift,y_shift){
x_shift=x_shift||0;
y_shift=y_shift||0;
context.beginPath();
if(shape=='rect'){
context.rect(coords[0]+x_shift,coords[1]+y_shift,coords[2]-coords[0],coords[3]-coords[1]);}else if(shape=='poly'){
context.moveTo(coords[0]+x_shift,coords[1]+y_shift);
for(i=2;i<coords.length;i+=2){
context.lineTo(coords[i]+x_shift,coords[i+1]+y_shift);}}else if(shape=='circ'){
context.arc(coords[0]+x_shift,coords[1]+y_shift,coords[2],0,Math.PI*2,false);}
context.closePath();}
add_shape_to=function(canvas,shape,coords,options,name){
var i,context=canvas.getContext('2d');
if(options.shadow){
context.save();
if(options.shadowPosition=="inside"){
draw_shape(context,shape,coords);
context.clip();}
var x_shift=canvas.width*100;
var y_shift=canvas.height*100;
draw_shape(context,shape,coords,x_shift,y_shift);
context.shadowOffsetX=options.shadowX-x_shift;
context.shadowOffsetY=options.shadowY-y_shift;
context.shadowBlur=options.shadowRadius;
context.shadowColor=css3color(options.shadowColor,options.shadowOpacity);
var shadowFrom=options.shadowFrom;
if(!shadowFrom){
if(options.shadowPosition=='outside'){
shadowFrom='fill';}else{
shadowFrom='stroke';}}
if(shadowFrom=='stroke'){
context.strokeStyle="rgba(0,0,0,1)";
context.stroke();}else if(shadowFrom=='fill'){
context.fillStyle="rgba(0,0,0,1)";
context.fill();}
context.restore();
if(options.shadowPosition=="outside"){
context.save();
draw_shape(context,shape,coords);
context.globalCompositeOperation="destination-out";
context.fillStyle="rgba(0,0,0,1);";
context.fill();
context.restore();}}
context.save();
draw_shape(context,shape,coords);
if(options.fill){
context.fillStyle=css3color(options.fillColor,options.fillOpacity);
context.fill();}
if(options.stroke){
context.strokeStyle=css3color(options.strokeColor,options.strokeOpacity);
context.lineWidth=options.strokeWidth;
context.stroke();}
context.restore();
if(options.fade){
$(canvas).css('opacity',0).animate({opacity:1},100);}};
clear_canvas=function(canvas){
canvas.getContext('2d').clearRect(0,0,canvas.width,canvas.height);};}else{
create_canvas_for=function(img){
return $('<var style="zoom:1;overflow:hidden;display:block;width:'+img.width+'px;height:'+img.height+'px;"></var>').get(0);};
add_shape_to=function(canvas,shape,coords,options,name){
var fill,stroke,opacity,e;
fill='<v:fill color="#'+options.fillColor+'" opacity="'+(options.fill?options.fillOpacity:0)+'" />';
stroke=(options.stroke?'strokeweight="'+options.strokeWidth+'" stroked="t" strokecolor="#'+options.strokeColor+'"':'stroked="f"');
opacity='<v:stroke opacity="'+options.strokeOpacity+'"/>';
if(shape=='rect'){
e=$('<v:rect name="'+name+'" filled="t" '+stroke+' style="zoom:1;margin:0;padding:0;display:block;position:absolute;left:'+coords[0]+'px;top:'+coords[1]+'px;width:'+(coords[2]-coords[0])+'px;height:'+(coords[3]-coords[1])+'px;"></v:rect>');}else if(shape=='poly'){
e=$('<v:shape name="'+name+'" filled="t" '+stroke+' coordorigin="0,0" coordsize="'+canvas.width+','+canvas.height+'" path="m '+coords[0]+','+coords[1]+' l '+coords.join(',')+' x e" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:0px;left:0px;width:'+canvas.width+'px;height:'+canvas.height+'px;"></v:shape>');}else if(shape=='circ'){
e=$('<v:oval name="'+name+'" filled="t" '+stroke+' style="zoom:1;margin:0;padding:0;display:block;position:absolute;left:'+(coords[0]-coords[2])+'px;top:'+(coords[1]-coords[2])+'px;width:'+(coords[2]*2)+'px;height:'+(coords[2]*2)+'px;"></v:oval>');}
e.get(0).innerHTML=fill+opacity;
$(canvas).append(e);};
clear_canvas=function(canvas){
$(canvas).find('[name=highlighted]').remove();};}
shape_from_area=function(area){
var i,coords=area.getAttribute('coords').split(',');
for(i=0;i<coords.length;i++){coords[i]=parseFloat(coords[i]);}
return[area.getAttribute('shape').toLowerCase().substr(0,4),coords];};
options_from_area=function(area,options){
var obj=eval('('+$(area).attr("data")+')')
var optionsShape=clone(options);
for(var property in obj){
if(obj.hasOwnProperty(property)){
optionsShape[property]=obj[property];}}
return optionsShape;};
is_image_loaded=function(img){
if(!img.complete){return false;}
if(typeof img.naturalWidth!="undefined"&&img.naturalWidth==0){return false;}
return true;};
canvas_style={
position:'absolute',
left:0,
top:0,
padding:0,
border:0};
var ie_hax_done=false;
$.fn.maphighlight=function(opts){
imageDefault=$("#imgMap").attr("src");
opts=$.extend({},$.fn.maphighlight.defaults,opts);
if(!has_canvas&&$.browser.msie&&!ie_hax_done){
document.namespaces.add("v","urn:schemas-microsoft-com:vml");
var style=document.createStyleSheet();
var shapes=['shape','rect','oval','circ','fill','stroke','imagedata','group','textbox'];
$.each(shapes,
function(){
style.addRule('v\\:'+this,"behavior: url(#default#VML); antialias:true");});
ie_hax_done=true;}
return this.each(function(){
var img,wrap,options,map,canvas,canvas_always,mouseover,highlighted_shape,usemap;
img=$(this);
if(!is_image_loaded(this)){
return window.setTimeout(function(){
img.maphighlight(opts);},200);}
options=$.extend({},opts,$.metadata?img.metadata():false,img.data('maphighlight'));
usemap=img.get(0).getAttribute('usemap');
map=$('map[name="'+usemap.substr(1)+'"]');
if(!(img.is('img')&&usemap&&map.size()>0)){
return;}
if(img.hasClass('maphighlighted')){
var wrapper=img.parent();
img.insertBefore(wrapper);
wrapper.remove();
$(map).unbind('.maphighlight').find('area[coords]').unbind('.maphighlight');}
wrap=$('<div id="backCanvas"></div>').css({
display:'block',
background:'url("'+this.src+'")',
position:'relative',
padding:0,
width:this.width,
height:this.height});
if(options.wrapClass){
if(options.wrapClass===true){
wrap.addClass($(this).attr('class'));}else{
wrap.addClass(options.wrapClass);}}
img.before(wrap).css('opacity',0).css(canvas_style).remove();
if($.browser.msie){img.css('filter','Alpha(opacity=0)');}
wrap.append(img);
canvas=create_canvas_for(this);
$(canvas).css(canvas_style);
canvas.height=this.height;
canvas.width=this.width;
mouseover=function(e){
var imageAux=$(this).attr("image");
if(imageAux!=undefined&&imageAux!=''){
if(document.getElementById("backCanvas").style.backgroundImage!=imageAux)
document.getElementById("backCanvas").style.backgroundImage="url('"+imageAux+"')";}
var showAux=$(this).attr("show");
if(showAux!='false'){
var shape,area_options;
area_options=options_from_area(this,$.fn.maphighlight.defaults);
if(!area_options.neverOn&&!area_options.alwaysOn){
shape=shape_from_area(this);
add_shape_to(canvas,shape[0],shape[1],area_options,"highlighted");
if(area_options.groupBy){
var areas;
if(/^[a-zA-Z][-a-zA-Z]+$/.test(area_options.groupBy)){
areas=map.find('area['+area_options.groupBy+'="'+$(this).attr(area_options.groupBy)+'"]')}else{
areas=map.find(area_options.groupBy);}
var first=this;
areas.each(function(){
if(this!=first){
var subarea_options=options_from_area(this,options);
if(!subarea_options.neverOn&&!subarea_options.alwaysOn){
var shape=shape_from_area(this);
add_shape_to(canvas,shape[0],shape[1],subarea_options,"highlighted");}}});}
if(!has_canvas){
$(canvas).append('<v:rect></v:rect>');}}
var textShape=$(this).attr("text");
if(typeof MapDynamicCounters!=='undefined'&&MapDynamicCounters==='true')
{
textShape=GetAreaTooltipText($(this).attr("value"),$(this).attr("name"));}
if(textShape!=undefined&&textShape!=""){
var tooltipMap=$("#tooltipMap");
tooltipMap.html(textShape);
tooltipMap.show();}}}
mousemove=function(e){
var enableTooltip=$.fn.maphighlight.defaults;
var tooltipMap=$("#tooltipMap");
var posX=e.pageX-tooltipMap.outerWidth()-30;
var posY=e.pageY+20;
if(posX<0)
posX=0;
if(posY<0)
posY=0;
tooltipMap.css("left",posX);
tooltipMap.css("top",posY);}
$(map).bind('alwaysOn.maphighlight',function(){
if(canvas_always){
clear_canvas(canvas_always)}
if(!has_canvas){
$(canvas).empty();}
$(map).find('area[coords]').each(function(){
var shape,area_options;
area_options=options_from_area(this,options);
if(area_options.alwaysOn){
if(!canvas_always&&has_canvas){
canvas_always=create_canvas_for(img.get());
$(canvas_always).css(canvas_style);
canvas_always.width=img.width();
canvas_always.height=img.height();
img.before(canvas_always);}
area_options.fade=area_options.alwaysOnFade;
shape=shape_from_area(this);
if(has_canvas){
add_shape_to(canvas_always,shape[0],shape[1],area_options,"");}else{
add_shape_to(canvas,shape[0],shape[1],area_options,"");}}});});
$(map).trigger('alwaysOn.maphighlight').find('area[coords]').bind('mouseover.maphighlight',mouseover).bind('mousemove.maphighlight',mousemove).bind('mouseout.maphighlight',function(e){
clear_canvas(canvas);
$("#tooltipMap").hide();
if(document.getElementById("backCanvas").style.backgroundImage!=imageDefault)
document.getElementById("backCanvas").style.backgroundImage="url('"+imageDefault+"')";});;
img.before(canvas);
img.addClass('maphighlighted');});};
$.fn.maphighlight.defaults={
fill:true,fillColor:'EFF308',fillOpacity:0.6,
stroke:true,strokeColor:'EFF308',strokeOpacity:1,
strokeWidth:1,fade:true,alwaysOn:false,
neverOn:false,groupBy:false,wrapClass:true,
shadow:true,shadowX:0,shadowY:0,
shadowRadius:20,shadowColor:'FFCE3A',shadowOpacity:0.8,
shadowPosition:'outside',shadowFrom:false};})(jQuery);
function GetFilters(){
var MapFilters={Category:"",CategoryId:0,Transaction:"",TransactionId:0,UniqueId:""};
var TransOpt=($("#ddlTransactionType li[li-selected='True']").length>0)?$("#ddlTransactionType li[li-selected='True']").val():$("#ddlTransactionType li[value='1']").val();
var TransOptTex=($("#ddlTransactionType li[li-selected='True']").length>0)?$("#ddlTransactionType li[li-selected='True']").text():$("#ddlTransactionType li[value='1']").text();
var ProyectosNuevos=(TransOpt!=3)?$('#chkProyectosNuevos').prop("checked"):false;
var CategroyOpt;
var CategroyOptTex;
if($("li[li-selected='True']","#ddlCategories").length>0&&$("li[li-selected='True']","#ddlCategories").length<15){
$("li[li-selected='True']","#ddlCategories").each(function(){
CategroyOpt=((CategroyOpt!=undefined&&CategroyOpt!=null)?CategroyOpt+','+$('input[type = checkbox]',this).attr('value'):$('input[type = checkbox]',this).attr('value'));
CategroyOptTex=((CategroyOptTex!=undefined&&CategroyOptTex!=null)?CategroyOptTex+'-'+$('label',this).text():$('label',this).text());});}
else{
var CategroyOpt="0";
var CategroyOptTex="Todos";}
if(ProyectosNuevos){
if(typeof TransOpt!=='undefined'&&typeof CategroyOpt!=='undefined'){
MapFilters.Category="Proyecto Nuevo";
MapFilters.CategoryId=(CategroyOpt!="0")?"1,"+CategroyOpt:"1";
MapFilters.Transaction=(TransOptTex=="Venta (Nuevo y Usado)")?"Venta":TransOptTex;
MapFilters.TransactionId=TransOpt;
MapFilters.UniqueId="c"+MapFilters.CategoryId.replace(",","-")+"t"+MapFilters.TransactionId;
MapFilters.Processed=true;}}
else{
if(typeof TransOpt!=='undefined'&&typeof CategroyOpt!=='undefined'){
MapFilters.Category=CategroyOptTex;
MapFilters.CategoryId=CategroyOpt;
MapFilters.Transaction=TransOptTex
MapFilters.TransactionId=TransOpt;
MapFilters.UniqueId="c"+MapFilters.CategoryId.replace(",","-")+"t"+MapFilters.TransactionId;
MapFilters.Processed=true;}}
return MapFilters;}
function GetAreaTooltipText(LocationId,Location){
var FormatCategory=function(category){
var ResCategory='';
var spCategory=category.split('-');
var lastIndex=(((spCategory.length-1)>0)?spCategory.length-1:0);
for(i=0;i<spCategory.length;i++){
var CategoryName='';
var spCategoryWord=spCategory[i].split(' ');
for(isub=0;isub<spCategoryWord.length;isub++){
var txtCategory=spCategoryWord[isub];
var last=txtCategory[txtCategory.length-1];
if(last!="s"){
var re=new RegExp(/[aeiou]/g);
if(re.test(last)){
CategoryName=CategoryName+txtCategory+"s ";}
else{
CategoryName=CategoryName+txtCategory+"es ";}}}
ResCategory=(i==lastIndex&&lastIndex>0)?ResCategory.trim()+" y "+CategoryName.trim():(ResCategory!='')?ResCategory.trim()+", "+CategoryName.trim():CategoryName.trim();}
if(ResCategory=="")ResCategory="Inmuebles";
return ResCategory;}
var text="";
var filters=GetFilters();
if(filters.UniqueId!=""){
DownloadCounters();
var elem=MapCounters[filters.UniqueId];
if(typeof elem!=='undefined'){
var cntr=FindCounter(LocationId,elem);
text="<b>"+cntr+"</b>"+" "+FormatCategory(filters.Category)+" en "+filters.Transaction+" en "+Location;}}
return text;}
function FindCounter(LocationId,counters){
for(var i=0;i<counters.length;i++){
if(counters[i].LocationId==LocationId)
return counters[i].Counter;}
return 0;}
function DownloadCounters(){
var filters=GetFilters();
if(filters.UniqueId!="")
{
var elem=MapCounters[filters.UniqueId];
if(typeof elem==='undefined'){
jQuery.ajax({
type:"GET",
url:"/webservices/MapCountersV2.ashx?l=1&lvl=0&c1="+filters.CategoryId+"&t="+filters.TransactionId,
dataType:"text",
success:function(response){
MapCounters[filters.UniqueId]=eval("("+response+")").data;}});}}}
function preloader(imgs){
imagesArray=imgs.split(',');
for(var x=0;x<imagesArray.length;x++){
var LoadedImage=new Image();
LoadedImage.src=imagesArray[x];}}
var preloadImages='';
function addPreload(imageSrc){
preloadImages+=imageSrc;}
$(document).ready(function(){
preloader(preloadImages);});
var autoRunGallery=false;
var lengthBox=0;
var widthBox=0;
var widthParent=0;
var numBox=0;
var widthBoxMore=8;
var boolImg=false;
var IdImg=0;
var IdImgMin=0;
var PrjIdImg=0;
var PrjAutoRunGallery=false;
var PrjLengthBox=0;
var PrjWidthBox=0;
var PrjNumBox=0;
var PrjWidthBoxMore=4;
var PrjBoolImg=true;
var PrjIdImgMin=1;
var PrjImgPas=1;
var PrjWidthParent=0;
function SetGallery(leftSelector,rightSelector,parentGallery,contentSelector,itemSelector){
lengthBox=$(contentSelector+" "+itemSelector).length;
widthBox=$(itemSelector).width()+widthBoxMore;
$(contentSelector).width(lengthBox*widthBox);
widthParent=$(parentGallery).width();
numBox=widthParent/widthBox;
$(leftSelector).mousedown(function(){
autoRunGallery=false;
$(contentSelector).stop(true,true);
var margin_left=parseInt($(contentSelector).css("margin-left").replace("px",""));
var newMargin=margin_left+widthBox;
if(newMargin>0)
newMargin=0;
$(contentSelector).animate({"margin-left":newMargin+"px"},{duration:500})
if(boolImg==true&&IdImg>IdImgMin){
IdImg--;}})
$(rightSelector).mousedown(function(){
autoRunGallery=false;
$(contentSelector).stop(true,true);
var margin_left=parseInt($(contentSelector).css("margin-left").replace("px",""));
if(margin_left>-((lengthBox-numBox)*widthBox)){
$(contentSelector).animate({"margin-left":"-="+widthBox+"px"},{duration:500})}
if(boolImg==true){
var urlLogo=$('#imgGallery'+IdImg).attr("data-original");
$('#imgGallery'+IdImg).attr("src",urlLogo);
IdImg++;}})
AutoRunGallery(contentSelector);}
function SetGalleryHome(leftSelector,rightSelector,parentGallery,contentSelector,itemSelector){
widthBoxMore=4;
IdImg=7;
IdImgMin=7;
boolImg=true;
ImgPas=6;
lengthBox=$(contentSelector+" "+itemSelector).length;
widthBox=$(itemSelector).width()+widthBoxMore;
$(contentSelector).width(lengthBox*widthBox);
widthParent=$(parentGallery).width();
numBox=widthParent/widthBox;
$(leftSelector).mousedown(function(){
autoRunGallery=false;
$(contentSelector).stop(true,true);
var margin_left=parseInt($(contentSelector).css("margin-left").replace("px",""));
var newMargin=margin_left+(widthBox*ImgPas);
if(newMargin>0)
newMargin=0;
$(contentSelector).animate({"margin-left":newMargin+"px"},{duration:500})
if(boolImg==true&&IdImg>IdImgMin){
IdImg--;}})
$(rightSelector).mousedown(function(){
autoRunGallery=false;
$(contentSelector).stop(true,true);
var margin_left=parseInt($(contentSelector).css("margin-left").replace("px",""));
if(margin_left>-((lengthBox-numBox)*widthBox)){
$(contentSelector).animate({"margin-left":"-="+(widthBox*ImgPas)+"px"},{duration:500})}
if(boolImg==true){
for(var i=0;i<ImgPas;i++)
{
var urlLogo=$('#imgGallery'+IdImg).attr("data-original");
$('#imgGallery'+IdImg).attr("src",urlLogo);
IdImg++;}}})
AutoRunGallery(contentSelector);}
function SetProjectsGalleryHome(leftSelector,rightSelector,parentGallery,contentSelector,itemSelector){
PrjAutoRunGallery=true;
PrjLengthBox=0;
PrjWidthBox=0;
PrjWidthParent=0;
PrjNumBox=0;
PrjWidthBoxMore=4;
PrjBoolImg=true;
PrjIdImgMin=1;
PrjImgPas=1;
PrjIdImg=1;
PrjLengthBox=$(contentSelector+" "+itemSelector).length;
PrjWidthBox=$(itemSelector).width()+PrjWidthBoxMore;
$(contentSelector).width(PrjLengthBox*PrjWidthBox);
PrjWidthParent=$(parentGallery).width();
PrjNumBox=(PrjWidthParent+PrjWidthBoxMore)/PrjWidthBox;
$(leftSelector).mousedown(function(){
PrjAutoRunGallery=false;
$(contentSelector).stop(true,true);
var margin_left=parseInt($(contentSelector).css("margin-left").replace("px",""));
var newMargin=margin_left+(PrjWidthBox*PrjImgPas);
if(newMargin>0)
newMargin=0;
$(contentSelector).animate({"margin-left":newMargin+"px"},{duration:500})
if(PrjBoolImg==true&&PrjIdImg>PrjIdImgMin){
IdImg--;}})
$(rightSelector).mousedown(function(){
PrjAutoRunGallery=false;
$(contentSelector).stop(true,true);
var margin_left=parseInt($(contentSelector).css("margin-left").replace("px",""));
if(margin_left>-((PrjLengthBox-PrjNumBox)*PrjWidthBox)){
$(contentSelector).animate({"margin-left":"-="+(PrjWidthBox*PrjImgPas)+"px"},{duration:500})}
if(PrjBoolImg==true){
for(var i=0;i<PrjImgPas;i++){
var urlLogo=$('#imProjetgGallery'+PrjIdImg).attr("data-original");
$('#imProjetgGallery'+PrjIdImg).attr("src",urlLogo);
PrjIdImg++;}}})
AutoRunProjetsGallery(contentSelector);}
function AutoRunGallery(contentSelector){
if(autoRunGallery){
setTimeout(function(){
var margin_left=parseInt($(contentSelector).css("margin-left").replace("px",""));
if(margin_left>-((lengthBox-numBox)*widthBox)){
$(contentSelector).animate({"margin-left":"-="+widthBox+"px"},{duration:500},AutoRunGallery(contentSelector,widthBox))}
else{
$(contentSelector).animate({"margin-left":"0px"},{duration:700},AutoRunGallery(contentSelector,widthBox))}},2000);}}
function AutoRunProjetsGallery(contentSelector){
if(PrjBoolImg==true){
for(var i=0;i<PrjImgPas;i++){
var urlLogo=$('#imProjetgGallery'+PrjIdImg).attr("data-original");
$('#imProjetgGallery'+PrjIdImg).attr("src",urlLogo);
PrjIdImg++;}}
if(PrjAutoRunGallery){
setTimeout(function(){
var margin_left=parseInt($(contentSelector).css("margin-left").replace("px",""));
if(margin_left>-((PrjLengthBox-PrjNumBox)*PrjWidthBox)){
$(contentSelector).animate({"margin-left":"-="+PrjWidthBox+"px"},{duration:500},AutoRunProjetsGallery(contentSelector))}
else{
$(contentSelector).animate({"margin-left":"0px"},{duration:700},AutoRunProjetsGallery(contentSelector))}},6000);}}
var json={"Locations":[{"Id":"1","ParentId":"0","Name":"Uno"}]};
var locations;
var locationsIndex=[];
var txtWord;
var HidLocationIds;
var HidLocationName;
var HidLocationNameFull;
var HidLocationNameTex;
var divResultsLocation;
var LocationItem="";
var bKey40=false;
var bKey38=false;
$(document).ready(function(){
fillJSON();
txtWord=$("#txtWord");
HidLocationIds=$("#HidLocationIds");
HidLocationName=$("#HidLocationName");
HidLocationNameFull=$("#HidLocationNameFull");
HidLocationNameTex=$("#HidLocationNameTex");
divResultsLocation=$("#divResultsLocation");});
function fKeyPress(iKey){
if(iKey==40){
bKey40=true;
if(bKey38==true){
iListSuggest++;
bKey38=false;}
if(iListSuggest<listSuggest.length){
var sDatos=listSuggest[iListSuggest].split('|');
HidLocationIds.val(sDatos[1]);
HidLocationName.val(sDatos[2]);
HidLocationNameFull.val(sDatos[0]);
HidLocationNameTex.val(FormatTextV2(sDatos[0]));
$("[id*=idSuggest]").css("background","");
var suggestControl=$("#idSuggest"+sDatos[0].replaceAll(" ","")+"");
suggestControl.css("background","#E7EBF5");
if(iListSuggest>1){
divResultsLocation.scrollTop(85+(29*(iListSuggest-2)));}else{
divResultsLocation.scrollTop(0);}
bkey=true;
iListSuggest++;
if(iListSuggest==listSuggest.length)iListSuggest=0;}}
else if(iKey==38){
bKey38=true;
if(bKey40==true){
if(iListSuggest==0){
iListSuggest=listSuggest.length-1;}else{
iListSuggest--;}
bKey40=false;}
if(iListSuggest<listSuggest.length){
iListSuggest--;
if(iListSuggest<0){
iListSuggest=listSuggest.length-1;}
var sDatos=listSuggest[iListSuggest].split('|');
HidLocationIds.val(sDatos[1]);
HidLocationName.val(sDatos[2]);
HidLocationNameFull.val(sDatos[0]);
HidLocationNameTex.val(FormatTextV2(sDatos[0]));
$("[id*=idSuggest]").css("background","");
var suggestControl=$("#idSuggest"+sDatos[0].replaceAll(" ","")+"");
suggestControl.css("background","#E7EBF5");
if(iListSuggest>1){
divResultsLocation.scrollTop(85+(29*(iListSuggest-2)));}else{
divResultsLocation.scrollTop(0);}
bkey=true;}}}
function Test(){
var eve=window.event;
if(eve!=undefined)fKeyPress(eve.keyCode);
if(bkey==false){
listSuggest=[];
iListSuggest=0;
$("#divContainerTxtWord").removeClass("input-highlightfixed");
$("#dvdBtnSearchAdvert").removeClass("divbuttonhome");
var name=txtWord.val();
var lname=name.split(' ');
if(lname.length==1)
{
var r=SearchByName(name);
if(name.length<3){
divResultsLocation.hide();
HidLocationIds.val("");
HidLocationName.val("");
HidLocationNameFull.val("");
HidLocationNameTex.val("");}}else{
var r=SearchByNames(lname);}
var rs=$("#divResultsLocationCity");
var rsNeighborhood=$("#divResultsLocationNeighborhood");
var rsSector=$("#divResultsLocationsector");
var rsDepartment=$("#divResultsLocationDepartment");
var listDepartment=[];
rs.html("<div class='titulos_zona'>Ciudad</div>");
var listCity=[];
rsNeighborhood.html("<div class='titulos_zona'>Barrio</div>");
var listNeighbor=[];
rsSector.html("<div class='titulos_zona'>Zona</div>");
var listZone=[];
rsDepartment.html("<div class='titulos_zona'>Departamento</div>");
rs.hide();
rsNeighborhood.hide();
rsSector.hide();
rsDepartment.hide();
if(r!=""&&HidLocationNameTex.val()!=txtWord.val()){
divResultsLocation.show('slow');
var nNivel=7;
for(var x=0;x<r.length;x++){
var sDatos=r[x].split('|');
var lLocationIds=sDatos[1].split('-');
if(nNivel>lLocationIds.length){
HidLocationIds.val(sDatos[1]);
HidLocationName.val(sDatos[2]);
HidLocationNameFull.val(sDatos[0]);
HidLocationNameTex.val(FormatTextV2(sDatos[0]));
nNivel=lLocationIds.length;}
if(lLocationIds.length==1){
rsDepartment.show();
rsDepartment.append($(DivText(sDatos)));
listDepartment.push(r[x]);}else if(lLocationIds.length==2){
rs.show();
rs.append($(DivText(sDatos)));
listCity.push(r[x]);}else if(lLocationIds.length==3){
if(lLocationIds[0]=='0'){
rsNeighborhood.show();
rsNeighborhood.append($(DivText(sDatos)));
listNeighbor.push(r[x]);}else{
rsSector.show();
rsSector.append($(DivText(sDatos)));
listZone.push(r[x]);}}else if(lLocationIds.length==4){
rsNeighborhood.show();
rsNeighborhood.append($(DivText(sDatos)));
listNeighbor.push(r[x]);}}
if(listDepartment.length>0)listSuggest=listDepartment;
if(listSuggest.length>0){
for(var x=0;x<listCity.length;x++){
listSuggest.push(listCity[x]);}}
else{
listSuggest=listCity;}
if(listSuggest.length>0){
for(var x=0;x<listZone.length;x++){
listSuggest.push(listZone[x]);}}else{
listSuggest=listZone;}
if(listSuggest.length>0){
for(var x=0;x<listNeighbor.length;x++){
listSuggest.push(listNeighbor[x]);}}else{
listSuggest=listNeighbor;}}else{
if(name.length>3&&HidLocationNameTex.val()!=txtWord.val()){
divResultsLocation.show('slow');
rs.show();
rs.html("<div class=\"cont_coment_texto dark_blue\">Su búsqueda no coincide con la lista de ubicaciones</div>");
HidLocationIds.val("");
HidLocationName.val("");
HidLocationNameFull.val("");
HidLocationNameTex.val("");}}}else{
bkey=false;}}
function DivText(sDatos){
var rText="<div id = \"idSuggest"+sDatos[0].replaceAll(" ","")+"\" class=\"texto_selec_zona\" onclick=\"SelectLocation('"+sDatos[0]+"','"+FormatTextV2(sDatos[0])+"','"+sDatos[1]+"','"+sDatos[2]+"')\">"+FormatText(sDatos[0])+" </div>";
return rText;}
function FormatText(sText){
var lText=sText.split('-');
var rText="<div class=\"texto_selec_resaltado\">"+lText[0];
var rText=rText+"&nbsp; </div> <div class=\"texto_selec_regular\">";
if(lText.length>1)rText=rText+" (";
for(var x=1;x<lText.length;x++){
if(lText[x-1]!=lText[x]){
if(x==1){
rText=rText+lText[x];}else{
rText=rText+", "+lText[x];}}else{
if(lText.length==3){
rText=rText+lText[x];}}}
if(lText.length>1)rText=rText+") ";
rText=rText+"</div>";
return rText;}
function FormatTextV2(sText){
var lText=sText.split('-');
var rText=lText[0];
if(lText.length>1)rText=rText+" (";
for(var x=1;x<lText.length;x++){
if(lText[x-1]!=lText[x]){
if(x==1){
rText=rText+lText[x];}else{
rText=rText+", "+lText[x];}}else{
if(lText.length==3){
rText=rText+lText[x];}}}
if(lText.length>1)rText=rText+")";
rText=rText+"";
return rText;}
function SelectLocation(ValSelect,ValSelectV2,Location,Name){
txtWord.val(ValSelectV2);
HidLocationNameFull.val(ValSelect);
HidLocationIds.val(Location);
HidLocationName.val(Name);
divResultsLocation.hide();
setTimeout("SearchAdverthighlight()",500);}
function IndexItems(){
for(var x in locations){
var item=locations[x];
if(item.Id!="0"){
locationsIndex["I"+item.Id]=item;}}}
function SearchByNames(names){
var result=[];
var resultItems=[];
for(var x=0;x<names.length;x++){
resultItems=SearchByName(names[x]);
for(var y=0;y<resultItems.length;y++){
var bAgregar=true;
for(var z=0;z<names.length;z++){
var TxtA=til(resultItems[y].toLowerCase());
var TxtB=til(names[z].toLowerCase());
if(TxtA.indexOf(TxtB)==-1&&TxtB.length>2){
bAgregar=false;}}
if(bAgregar==true){
if(ValidByName(result,resultItems[y]))result.push(resultItems[y]);}}}
return result;}
function ValidByName(lnames,name){
var bResp=true;
for(var x=0;x<lnames.length;x++){
var TxtA=til(lnames[x].toLowerCase());
var TxtB=til(name.toLowerCase());
if(TxtA.indexOf(TxtB)!=-1){
bResp=false;}}
return bResp;}
function SearchByName(name){
name=$.trim(name);
if(name.length<3){
return"";}
var result=[];
var resultItems=[];
for(var x=0;x<locations.length;x++){
var item=locations[x];
var TxtA=til(item.Name.toLowerCase());
var TxtB=til(name.toLowerCase());
if(TxtA.indexOf(TxtB)!=-1){
resultItems.push(item);}}
for(var x=0;x<resultItems.length;x++){
var item=resultItems[x];
LocationItem=item.Id;
var sRespuesta=Build("",item);
result.push(sRespuesta+"|"+LocationItem+"|"+item.Name);}
return result;}
function SearchById(id){
return locationsIndex["I"+id];}
function Build(text,obj){
if(typeof obj==='undefined')
return"";
var result=text+obj.Name+"#";
if(obj.ParentId!=0){
var parent=SearchById(obj.ParentId);
if(parent!=undefined)
LocationItem=LocationItem+"-"+parent.Id;
return Build(result,parent);}
else{
result=result.replace(/#$/,"");
result=result.replace(/#/g,"-");
return result;}}
function fillJSON(){
jQuery.ajax({
type:'GET',
url:'/SuggestListAllLocations.ashx',
dataType:'text',
success:function(response){
if(response!=""){
locations=jQuery.parseJSON(response);
IndexItems();
bSuggestLoad=true;
txtWord.keyup(Test);}}});}
function til(t){
var r=t;
r=r.replace(new RegExp(/[àáâãäå]/g),"a");
r=r.replace(new RegExp(/[èéêë]/g),"e");
r=r.replace(new RegExp(/[ìíîï]/g),"i");
r=r.replace(new RegExp(/[òóôõö]/g),"o");
r=r.replace(new RegExp(/[ùúûü]/g),"u");
return r;};
var transaction="";
var category="";
var bkey=false;
var bSuggestLoad=false;
var listSuggest=[];
var iListSuggest=0;
var locationName="";
var hideIt=null;
function searchKeyPress(e){
if(typeof e=='undefined'&&window.event){e=window.event;}
if(e.keyCode==13){
if($('#HidLocationNameTex').val()!=""){
$("#txtWord").val($('#HidLocationNameTex').val());
$('#divResultsLocation').hide();}
FindAdvert();}else if(e.keyCode==40){
fKeyPress(e.keyCode);}
else if(e.keyCode==38){
fKeyPress(e.keyCode);}}
function TransaccionKeyPress(e){
if(typeof e=='undefined'&&window.event){e=window.event;}
e.stopPropagation();
if(e.keyCode==13){
setTimeout(function(){$('.dropdown-check-list.visible').removeClass('visible');},100);}
else if(e.keyCode==40){
e.preventDefault();
if($("#ddlTransactionType li[li-selected='True']").length>0&&$("#ddlTransactionType li:not(.liSelectedDisable)").length>1){
var NextControl=$("#ddlTransactionType li[li-selected='True']").next();
if($(NextControl).length>0&&!NextControl.hasClass("liSelectedDisable")){
SelectTransactionItem($(NextControl),false);}
else{
SelectTransactionItem($("#ddlTransactionType li[li-selected='False']:not('.liSelectedDisable'):first"),false);}}
else{
SelectTransactionItem($("#ddlTransactionType li[value='1']"),false);}}
else if(e.keyCode==38){
e.preventDefault();
if($("#ddlTransactionType li[li-selected='True']").length>0&&$("#ddlTransactionType li:not(.liSelectedDisable)").length>1){
var PrevControl=$("#ddlTransactionType li[li-selected='True']").prev();
if($(PrevControl).length>0&&!PrevControl.hasClass("liSelectedDisable")){
SelectTransactionItem($(PrevControl),false);}
else{
SelectTransactionItem($("#ddlTransactionType li[li-selected='False']:not('.liSelectedDisable'):last"),false);}}
else{
SelectTransactionItem($("#ddlTransactionType li[value='1']"),false);}}}
function SearchAdverthighlight(){}
function btnSearchAdvert_onClick(){
FindAdvert();}
function btnSearchAdvertCode_onClick(){
FindAdvertCode();}
function txtCode_onKeyUp(event){
if(event.keyCode==13){
FindAdvertCode();}}
function GetUrlResultsLocation(word,transactionId,categoryId,locationId,LocationIds,LocationName,NewProyects){
var vWord=word.split('-');
var vLocationIds=LocationIds.split('-');
if(vLocationIds.length==1){
if(parseInt(vLocationIds[0])>0){
sfFind.Location1Id=vLocationIds[0];}
locationName=vWord[0].toLowerCase();}
if(vLocationIds.length==2){
if(parseInt(vLocationIds[1])>0){
sfFind.Location1Id=vLocationIds[1];}
if(parseInt(vLocationIds[0])>0){
sfFind.Location2Id=vLocationIds[0];}
locationName=vWord[1].toLowerCase()+"/"+vWord[0].toLowerCase();}
if(vLocationIds.length==3){
if(parseInt(vLocationIds[2])>0){
sfFind.Location1Id=vLocationIds[2];
locationName=vWord[2].toLowerCase();}
if(parseInt(vLocationIds[1])>0){
sfFind.Location2Id=vLocationIds[1];
locationName=locationName+"/"+vWord[1].toLowerCase();}
if(parseInt(vLocationIds[0])>0){
sfFind.Location3Id=vLocationIds[0];
locationName=locationName+"/"+vWord[0].toLowerCase();}
else{
sfFind.Neighborhood=til(LocationName);}}
if(vLocationIds.length==4){
if(parseInt(vLocationIds[3])>0){
sfFind.Location1Id=vLocationIds[3];
locationName=vWord[3].toLowerCase();}
if(parseInt(vLocationIds[2])>0){
sfFind.Location2Id=vLocationIds[2];
locationName=locationName+"/"+vWord[2].toLowerCase();}
if(parseInt(vLocationIds[1])>0){
sfFind.Location3Id=vLocationIds[1];
locationName=locationName+"/"+vWord[1].toLowerCase();}
if(parseInt(vLocationIds[0])>0){
sfFind.Neighborhood=til(LocationName);
locationName=locationName+"/"+vWord[0].toLowerCase();}}
locationName=til(locationName).replaceAll(" ","-");
return GetUrlResults("",transactionId,categoryId,0,NewProyects);}
function GetUrlResults(word,transactionId,categoryId,locationId,NewProyects){
if(locationName=="")locationName="colombia";
sfFind.TransactionId=transactionId;
if(NewProyects==true){
sfFind.Category1Id="1,"+categoryId;
sfFind.GroupType=2;
sfFind.NotInCategory1Id=1;}
else{
sfFind.Category1Id=categoryId;}
if(sfFind.Neighborhood=="")sfFind.Word=til(word);
sfFind.Neighborhood=sfFind.Neighborhood.toLowerCase().replace(/ /g,"0");
if(parseInt(locationId)>0){
var area=$("#Map area[value="+locationId+"]");
var groupattr=area.attr('group');
if(typeof groupattr!=='undefined'&&groupattr!==false&&groupattr!=""){
locationName=area.attr("groupname");
sfFind.Location1Id=groupattr;}
else{
sfFind.Location1Id=locationId;}}
var urlRedirect=category.sanitize().replaceAll("-","")+"/"+transaction.sanitize().replaceAll("-","")+"/"+locationName+"/index.aspx?"+toSemantic(sfFind);
return urlRedirect.toLowerCase();}
function GetUrlCode(adwerdId){
var urlRedirect="Detail.aspx?a="+adwerdId;
if(parseInt(adwerdId,10)<750000){
if(parseInt(adwerdId,10)<10500)
urlRedirect+="&ver=1&type=2";
else
urlRedirect+="&ver=1&type=1"}
return urlRedirect.toLowerCase();}
function FindAdvert(){
if($("#ddlTransactionType li[li-selected='True']").length==0){
SelectTransactionItem($("#ddlTransactionType li[value='1']"),false);}
var transactionId=$("#ddlTransactionType li[li-selected='True']").val();
transaction=$("#ddlTransactionType li[li-selected='True']").text();
if(transaction=="Venta (Nuevo y Usado)")transaction="Venta";
var ProyectosNuevos=(transactionId!=3)?$('#chkProyectosNuevos').prop("checked"):false;
var categoryId;
if($("li[li-selected='True']","#ddlCategories").length>0&&$("li[li-selected='True']","#ddlCategories").length<15){
$("li[li-selected='True']","#ddlCategories").each(function(){
categoryId=((categoryId!=undefined&&categoryId!=null)?categoryId+','+$('input[type = checkbox]',this).attr('value'):$('input[type = checkbox]',this).attr('value'));
category=((category!=undefined&&category!=null)?category+'-'+$('label',this).text():$('label',this).text());});}
else{
var categoryId="0";
var category="Todos";}
var word=$('#HidLocationNameFull').val();
if(word.toLowerCase()==defaultSearchText.toLowerCase())
word='';
var sword="NOKeyword";
if(word!='')sword="Keyword";
trackingClick("HomeV2 - Boton Buscar - "+sword+" - "+transaction+" - "+category,"SpecificTracking");
var LocationIds=$('#HidLocationIds').val();
var LocationName=$('#HidLocationName').val();
if(ProyectosNuevos==true){}
if(bSuggestLoad==false){
word=$('#txtWord').val();
if(word==defaultSearchText)word="";
RedirectTo(GetUrlResults(word,transactionId,categoryId,0,ProyectosNuevos));}
else{
if(LocationIds==""&&LocationName==""){
word=$('#txtWord').val();
RedirectTo(GetUrlResults(word,transactionId,categoryId,0,ProyectosNuevos));}
else{
RedirectTo(GetUrlResultsLocation(word,transactionId,categoryId,0,LocationIds,LocationName,ProyectosNuevos));}}}
function FindAdvertCode(){
trackingClick("HomeV2 - Boton Buscar por Codigo","SpecificTracking");
var AdvertID=$("#txtCode").val();
if(AdvertID==''){
jAlert('Debe especificar un código');}else{
var re=/^(-)?[0-9]*$/;
if(!re.test(AdvertID)){
AdvertID=0;
jAlert('Debe especificar un código valido');}else{
RedirectTo(GetUrlCode(AdvertID));}}}
function handleHomeLB(){
var currDate=new Date();
var deadLine=new Date(2013,3,7);
if(currDate<=deadLine&&typeof ReadCookie!=='undefined'){
var homeLBCookieName="showHomeLB";
CreateCookie("fincaraizcookie","true");
var testcookie=ReadCookie("fincaraizcookie");
var showHomeLB=ReadCookie(homeLBCookieName);
if(showHomeLB===''&&testcookie!==''){
jPopup("/HomeInfo.htm","Información importante",600,380,"");
CreateCookie(homeLBCookieName,"false");}}}
function initHomePageActions(){
handleHomeLB();
if(typeof DownloadCounters!=='undefined'){DownloadCounters();};
jQuery.ajax({
type:"GET",
url:"/projectsGallery.ashx",
dataType:"html",
success:function(response){
$('#projectsGallery').append(response);}});}
function SelectTransactionItem(CtrlOption,AutoClose){
if(CtrlOption!=null&&CtrlOption!=undefined){
if(!$(CtrlOption).hasClass("liSelectedDisable")){
$("#ddlTransactionType li").removeClass("liSelected");
$("#ddlTransactionType li").attr("li-selected","False")
$(CtrlOption).addClass("liSelected");
$(CtrlOption).attr("li-selected","True")
if(typeof DownloadCounters!=='undefined'){DownloadCounters();};
ListTransaction_Categories($(CtrlOption).attr('value'),$('#ddlCategories'));
if(AutoClose){setTimeout(function(){$('.dropdown-check-list.visible',"#divContainerTransaction").removeClass('visible');},100);}}}}
function SelectCategoryItem(CtrlOption){
if(!$(CtrlOption).hasClass("liSelectedDisable")){
if($(CtrlOption).hasClass('liSelected')){
$(CtrlOption).removeClass("liSelected");
$(CtrlOption).attr("li-selected","False");
$('input[type = checkbox]',CtrlOption).prop("checked",false);}
else{
$(CtrlOption).addClass("liSelected");
$(CtrlOption).attr("li-selected","True")
$('input[type = checkbox]',CtrlOption).prop("checked",true);}
if(typeof DownloadCounters!=='undefined'){DownloadCounters();};
var selectedCategories=[];
$("li[li-selected='True']","#ddlCategories").each(function(){
selectedCategories.push(parseInt($('input[type = checkbox]',this).attr('value')));});
ListCategories_Transaction(selectedCategories,$('#ddlTransactionType'));}}
function initMapArea(){
$("#Map area").click(function(){
if($("#ddlTransactionType li[li-selected='True']").length==0){
SelectTransactionItem($("#ddlTransactionType li[value='1']"),false);}
sfFind=GetForm(sfFind,".DivHomeSearch");
transaction=$("#ddlTransactionType li[li-selected='True']").text();
if(transaction=="Venta (Nuevo y Usado)")transaction="Venta";
var ProyectosNuevos=(sfFind.TransactionId!=3)?$('#chkProyectosNuevos').prop("checked"):false;
if($("li[li-selected='True']","#ddlCategories").length>0&&$("li[li-selected='True']","#ddlCategories").length<15){
$("li[li-selected='True']","#ddlCategories").each(function(){
category=((category!=undefined&&category!=null)?category+'-'+$('label',this).text():$('label',this).text());});}
else{
category="Todos";}
trackingClick("HomeV2 - Mapa - "+transaction+" - "+category,"SpecificTracking");
if($(this).attr("level")=="0")
sfFind.Location1Id=$(this).attr("value");
else
sfFind.Location2Id=$(this).attr("value");
if($(this).attr("target")=="Map"){
RedirectTo("/MapV2.aspx?"+"t="+sfFind.TransactionId+"&l1="+sfFind.Location1Id+"&l2="+sfFind.Location2Id+"&c1="+((ProyectosNuevos)?"1,"+sfFind.Category1Id:sfFind.Category1Id));
return false;}
else{
RedirectTo(GetUrlResults(sfFind.Word,sfFind.TransactionId,sfFind.Category1Id,sfFind.Location1Id,ProyectosNuevos));
return false;}});}
function disabledListSelect(control,atrTrancat,BoolSelect){
control.find('option').attr("disabled","true");
var rets=atrTrancat.split('|');
if(BoolSelect==true){
control.find('option[value="'+rets[0]+'"]').attr("selected",true);}
for(var i=0;i<rets.length;i++){
control.find('option[value="'+rets[i]+'"]').removeAttr('disabled');}}
function disabledRadioSelect(control,atrTrancat,BoolSelect){
control.attr("disabled","true");
var rets=atrTrancat.split('|');
if(BoolSelect==true){
for(var k=0;k<$(control).length;k++){
if($(control).get(k).value==rets[0])$(control).get(k).Attribute("selected",true);}}
for(var i=0;i<rets.length;i++){
for(var j=0;j<$(control).length;j++){
if($(control).get(j).value==rets[i])$(control).get(j).removeAttribute("disabled");}}}
function onblurTxtWord(){
var eve=window.event;
var verOffset;
if(navigator.appName!="Microsoft Internet Explorer"&&navigator.userAgent.indexOf('Safari')==-1&&$("#divResultsLocationCity").html()!="<div class=\"cont_coment_texto dark_blue\">Su búsqueda no coincide con la lista de ubicaciones</div>")$('#divResultsLocation').hide('slow');
if($("#txtWord").val()==""){}else{
$("#txtWord").css("color","#000000");}}
function ListTransaction_Categories(origin,destination){
var lIdsNotSale=[-1];
var lIdsNotRent=[20];
var lIdsNotvacation=[19,18,2,5,3,4,23,24];
var rets=destination.find('li');
rets.removeClass("liSelectedDisable");
rets.addClass("li");
$('input[type = checkbox]:disabled',rets).removeProp('disabled');
if(origin==3){
for(var i=0;i<rets.length;i++){
if($.inArray(parseInt($('input[type = checkbox]',rets[i]).attr('value')),lIdsNotvacation)>-1){
if($(rets[i]).hasClass("liSelected")){
$(rets[i]).removeClass("liSelected");
$(rets[i]).attr("li-selected","False");
$('input[type=checkbox]',rets[i]).prop("checked",false);};
if(!$(rets[i]).hasClass("liSelectedDisable")){
$(rets[i]).addClass("liSelectedDisable");
$('input[type = checkbox]',rets[i]).prop('disabled','disabled');};}}
$('#chkProyectosNuevos:checked').prop("checked",false);}
else if(origin==2){
for(var i=0;i<rets.length;i++){
if($.inArray(parseInt($('input[type = checkbox]',rets[i]).attr('value')),lIdsNotRent)>-1){
if($(rets[i]).hasClass("liSelected")){
$(rets[i]).removeClass("liSelected");
$(rets[i]).attr("li-selected","False");
$('input[type=checkbox]',rets[i]).prop("checked",false);};
if(!$(rets[i]).hasClass("liSelectedDisable")){
$(rets[i]).addClass("liSelectedDisable");
$('input[type = checkbox]',rets[i]).prop('disabled','disabled');};}}}
else if(origin==1){
for(var i=0;i<rets.length;i++){
if($.inArray(parseInt($('input[type = checkbox]',rets[i]).attr('value')),lIdsNotSale)>-1){
if($(rets[i]).hasClass("liSelected")){
$(rets[i]).removeClass("liSelected");
$(rets[i]).attr("li-selected","False");
$('input[type=checkbox]',rets[i]).prop("checked",false);};
if(!$(rets[i]).hasClass("liSelectedDisable")){
$(rets[i]).addClass("liSelectedDisable");
$('input[type = checkbox]',rets[i]).prop('disabled','disabled');};}}}
ListCategoryChangeText();
ListTransactionChangeText();}
function ListCategories_Transaction(origin,destination){
var rets=destination.find('li');
var ChoseItem=$("#ddlTransactionType li[li-selected='True']");
rets.removeClass("liSelected");
rets.removeClass("liSelectedDisable");
rets.attr("li-selected","False");
for(var idx=0;idx<origin.length;idx++){
var lIdsNotRent=[20];
var lIdsNotvacation=[19,18,2,5,3,4,23];
if($.inArray(origin[idx],lIdsNotRent)>-1){
for(var i=0;i<rets.length;i++){
if(rets[i].value==2){
$(rets[i]).addClass("liSelectedDisable");}}}
if($.inArray(origin[idx],lIdsNotvacation)>-1){
for(var i=0;i<rets.length;i++){
if(rets[i].value==3){
$(rets[i]).addClass("liSelectedDisable");}}}}
if($.inArray(24,origin)>-1){
for(var i=0;i<rets.length;i++){
if(rets[i].value==2){
if(!$(rets[i]).hasClass("liSelectedDisable")){
$(rets[i]).addClass("liSelected");
$(rets[i]).attr("li-selected","True");
ListTransaction_Categories(2,$('#ddlCategories'));}
else{
$(rets[i]).removeClass("liSelectedDisable")
$(rets[i]).addClass("liSelected");
$(rets[i]).attr("li-selected","True");
ListTransaction_Categories(2,$('#ddlCategories'));}}
else
{
$(rets[i]).removeClass("liSelected");
$(rets[i]).addClass("liSelectedDisable");
$(rets[i]).attr("li-selected","False");}}}
if(ChoseItem!=null&&ChoseItem!=undefined&&$("#ddlTransactionType li[li-selected='True']").length==0){
$(ChoseItem).addClass("liSelected");
$(ChoseItem).attr("li-selected","True");}
ListCategoryChangeText();
ListTransactionChangeText();}
function ShowContactData(){
var d=$('#contactData').clone();
d.css('display','');
var h=$('<div>').append(d).html();
jPopup('','Contáctenos',470,410,false,h);}
function ProyectosNuevos_Click(){
if($("#ddlTransactionType li[li-selected='True']").length==0){
SelectTransactionItem($("#ddlTransactionType li[value='1']"),false);}
var transactionId=$("#ddlTransactionType li[li-selected='True']").val();
if(transactionId==3){
$("#ddlTransactionType li").removeClass("liSelected");
$("#ddlTransactionType li").attr("li-selected","False");
if(!$("#ddlTransactionType li[value='2']").hasClass("liSelectedDisable")){
$("#ddlTransactionType li[value='2']").addClass("liSelected");
$("#ddlTransactionType li[value='2']").attr("li-selected","True")
if(typeof DownloadCounters!=='undefined'){DownloadCounters();};
ListTransaction_Categories(2,$('#ddlCategories'));}}
else{
if(typeof DownloadCounters!=='undefined'){DownloadCounters();};
ListTransaction_Categories(transactionId,$('#ddlCategories'));}}
function ListTransactionChangeText(){
if($("#ddlTransactionType li[li-selected='True']").length==0){
$("span.anchor","#divContainerTransaction").text("¿En venta o arriendo?");}
else{
$("span.anchor","#divContainerTransaction").text($("#ddlTransactionType li[li-selected='True']").text());}}
function ListCategoryChangeText(){
var SelectedItemsCount=$("#ddlCategories li[li-selected='True']").length;
if(SelectedItemsCount==0){
$("span.anchor","#divContainerCategories").text("¿Qué buscas?");}
else{
if(SelectedItemsCount==1){
$("span.anchor","#divContainerCategories").text($("#ddlCategories li[li-selected='True']").text());}
else{
$("span.anchor","#divContainerCategories").text($("#ddlCategories li[li-selected='True']:first").text().trim()+"...");}}}
$(function initMenuActions(){
$('.main_menu_item').parent().mouseover(function(){
$('.submenu').hide();
hideIt=null;
$(this).find('.submenu').show();});
$('.main_menu_item').parent().mouseout(function(){
hideIt=$(this).find('.submenu');
setTimeout(function(){if(hideIt!=null)hideIt.hide();},100);});});
function ProyectosNuevosCheck(Ctrl){
if($(Ctrl).prop("checked")==true){
ProyectosNuevos_Click();}}
function DisplayOptions(Ctrl){
var element=$(Ctrl).parent();
if(element.hasClass('visible')){
element.removeClass('visible');}
else{
$('.dropdown-check-list.visible').removeClass('visible');
element.addClass('visible');}}
$(document).ready(function(){
SetAsIntegerInput("#txtCode");
initMapArea();
setTimeout("$('#txtWord').attr('placeholder', defaultSearchText);",400);
$('#divResultsLocation').hide();
initHomePageActions();
$("#divContainerTransaction").bind('mouseleave',function(){
setTimeout(function(){$('.dropdown-check-list.visible').removeClass('visible');},100);});
$("body").bind('keydown',function(event){
if($('.dropdown-check-list.visible',"#divContainerTransaction").hasClass('visible')){
TransaccionKeyPress(event);}});
$("#divContainerCategories").bind('mouseleave',function(){
setTimeout(function(){$('.dropdown-check-list.visible').removeClass('visible');},100);});
$('#txtWord').bind('focus',function(){
$('.dropdown-check-list.visible').removeClass('visible');});
$('input[type = checkbox]:checked',"#ddlCategories").each(function(){
if(!$(this).parent("li").hasClass("liSelected")){
$(this).parent("li").addClass("liSelected");
$(this).parent("li").attr("li-selected","True");
ListCategoryChangeText();}});
$('#chkProyectosNuevos:checked').prop("checked",false);});