
(function($){
"use strict";
var methods={
init:function(options){
var form=this;
if(!form.data('jqv')||form.data('jqv')==null){
options=methods._saveOptions(form,options);
$(".formError").live("click",function(){
$(this).fadeOut(150,function(){
$(this).parent('.formErrorOuter').remove();
$(this).remove();
});
});
}
return this;
},
attach:function(userOptions){
if(!$(this).is("form")){
alert("Sorry, jqv.attach() only applies to a form");
return this;
}
var form=this;
var options;
if(userOptions)
options=methods._saveOptions(form,userOptions);
else
options=form.data('jqv');
options.validateAttribute=(form.find("[data-validation-engine*=validate]").length)?"data-validation-engine":"class";
if(options.binded){
form.find("["+options.validateAttribute+"*=validate]").not("[type=checkbox]").not("[type=radio]").not(".datepicker").bind(options.validationEventTrigger,methods._onFieldEvent);
form.find("["+options.validateAttribute+"*=validate][type=checkbox],["+options.validateAttribute+"*=validate][type=radio]").bind("click",methods._onFieldEvent);
form.find("["+options.validateAttribute+"*=validate][class*=datepicker]").bind(options.validationEventTrigger,{"delay":300},methods._onFieldEvent);
}
if(options.autoPositionUpdate){
$(window).bind("resize",{
"noAnimation":true,
"formElem":form
},methods.updatePromptsPosition);
}
form.bind("submit",methods._onSubmitEvent);
return this;
},
detach:function(){
if(!$(this).is("form")){
alert("Sorry, jqv.detach() only applies to a form");
return this;
}
var form=this;
var options=form.data('jqv');
form.find("["+options.validateAttribute+"*=validate]").not("[type=checkbox]").unbind(options.validationEventTrigger,methods._onFieldEvent);
form.find("["+options.validateAttribute+"*=validate][type=checkbox],[class*=validate][type=radio]").unbind("click",methods._onFieldEvent);
form.unbind("submit",methods.onAjaxFormComplete);
form.find("["+options.validateAttribute+"*=validate]").not("[type=checkbox]").die(options.validationEventTrigger,methods._onFieldEvent);
form.find("["+options.validateAttribute+"*=validate][type=checkbox]").die("click",methods._onFieldEvent);
form.die("submit",methods.onAjaxFormComplete);
form.removeData('jqv');
if(options.autoPositionUpdate)
$(window).unbind("resize",methods.updatePromptsPosition);
return this;
},
validate:function(){
if($(this).is("form"))
return methods._validateFields(this);
else{
var form=$(this).closest('form');
var options=form.data('jqv');
var r=methods._validateField($(this),options);
if(options.onSuccess&&options.InvalidFields.length==0)
options.onSuccess();
else if(options.onFailure&&options.InvalidFields.length>0)
options.onFailure();
return r;
}
},
updatePromptsPosition:function(event){
if(event&&this==window){
var form=event.data.formElem;
var noAnimation=event.data.noAnimation;
}
else
var form=$(this.closest('form'));
var options=form.data('jqv');
form.find('['+options.validateAttribute+'*=validate]').not(':hidden').not(":disabled").each(function(){
var field=$(this);
var prompt=methods._getPrompt(field);
var promptText=$(prompt).find(".formErrorContent").html();
if(prompt)
methods._updatePrompt(field,$(prompt),promptText,undefined,false,options,noAnimation);
});
return this;
},
showPrompt:function(promptText,type,promptPosition,showArrow){
var form=this.closest('form');
var options=form.data('jqv');
if(!options)
options=methods._saveOptions(this,options);
if(promptPosition)
options.promptPosition=promptPosition;
options.showArrow=showArrow==true;
methods._showPrompt(this,promptText,type,false,options);
return this;
},
hide:function(){
var form=$(this).closest('form');
if(form.length==0)
return this;
var options=form.data('jqv');
var closingtag;
if($(this).is("form")){
closingtag="parentForm"+methods._getClassName($(this).attr("id"));
}else{
closingtag=methods._getClassName($(this).attr("id"))+"formError";
}
$('.'+closingtag).fadeTo(options.fadeDuration,0.3,function(){
$(this).parent('.formErrorOuter').remove();
$(this).remove();
});
return this;
},
hideAll:function(){
var form=this;
var options=form.data('jqv');
var duration=options?options.fadeDuration:0.3;
$('.formError').fadeTo(duration,0.3,function(){
$(this).parent('.formErrorOuter').remove();
$(this).remove();
});
return this;
},
_onFieldEvent:function(event){
var field=$(this);
var form=field.closest('form');
var options=form.data('jqv');
window.setTimeout(function(){
methods._validateField(field,options);
if(options.InvalidFields.length==0&&options.onSuccess){
options.onSuccess();
}else if(options.InvalidFields.length>0&&options.onFailure){
options.onFailure();
}
},(event.data)?event.data.delay:0);
},
_onSubmitEvent:function(){
var form=$(this);
var options=form.data('jqv');
var r=methods._validateFields(form,options.ajaxFormValidation);
if(r&&options.ajaxFormValidation){
methods._validateFormWithAjax(form,options);
return false;
}
if(options.onValidationComplete){
options.onValidationComplete(form,r);
return false;
}
return r;
},
_checkAjaxStatus:function(options){
var status=true;
$.each(options.ajaxValidCache,function(key,value){
if(!value){
status=false;
return false;
}
});
return status;
},
_validateFields:function(form,skipAjaxValidation){
var options=form.data('jqv');
var errorFound=false;
form.trigger("jqv.form.validating");
var first_err=null;
form.find('['+options.validateAttribute+'*=validate]').not(':hidden').not(":disabled").each(function(){
var field=$(this);
var names=[];
if($.inArray(field.attr('name'),names)<0){
errorFound|=methods._validateField(field,options,skipAjaxValidation);
if(options.doNotShowAllErrosOnSubmit)
return false;
if(errorFound&&first_err==null)
first_err=field;
names.push(field.attr('name'));
}
});
form.trigger("jqv.form.result",[errorFound]);
if(errorFound){
if(options.scroll){
var destination=first_err.offset().top;
var fixleft=first_err.offset().left;
var positionType=options.promptPosition;
if(typeof(positionType)=='string'&&positionType.indexOf(":")!=-1)
positionType=positionType.substring(0,positionType.indexOf(":"));
if(positionType!="bottomRight"&&positionType!="bottomLeft"){
var prompt_err=methods._getPrompt(first_err);
destination=prompt_err.offset().top;
}
if(options.isOverflown){
var overflowDIV=$(options.overflownDIV);
if(!overflowDIV.length)return false;
var scrollContainerScroll=overflowDIV.scrollTop();
var scrollContainerPos=-parseInt(overflowDIV.offset().top);
destination+=scrollContainerScroll+scrollContainerPos-5;
var scrollContainer=$(options.overflownDIV+":not(:animated)");
scrollContainer.animate({scrollTop:destination},1100,function(){
if(options.focusFirstField)first_err.focus();
});
}else{
$("html:not(:animated),body:not(:animated)").animate({
scrollTop:destination,
scrollLeft:fixleft
},1100,function(){
if(options.focusFirstField)first_err.focus();
});
}
}else if(options.focusFirstField)
first_err.focus();
return false;
}
return true;
},
_validateFormWithAjax:function(form,options){
var data=form.serialize();
var url=(options.ajaxFormValidationURL)?options.ajaxFormValidationURL:form.attr("action");
$.ajax({
type:"GET",
url:url,
cache:false,
dataType:"json",
data:data,
form:form,
methods:methods,
options:options,
beforeSend:function(){
return options.onBeforeAjaxFormValidation(form,options);
},
error:function(data,transport){
methods._ajaxError(data,transport);
},
success:function(json){
if(json!==true){
var errorInForm=false;
for(var i=0;i<json.length;i++){
var value=json[i];
var errorFieldId=value[0];
var errorField=$($("#"+errorFieldId)[0]);
if(errorField.length==1){
var msg=value[2];
if(value[1]==true){
if(msg==""||!msg){
methods._closePrompt(errorField);
}else{
if(options.allrules[msg]){
var txt=options.allrules[msg].alertTextOk;
if(txt)
msg=txt;
}
methods._showPrompt(errorField,msg,"pass",false,options,true);
}
}else{
errorInForm|=true;
if(options.allrules[msg]){
var txt=options.allrules[msg].alertText;
if(txt)
msg=txt;
}
methods._showPrompt(errorField,msg,"",false,options,true);
}
}
}
options.onAjaxFormComplete(!errorInForm,form,json,options);
}else
options.onAjaxFormComplete(true,form,"",options);
}
});
},
_validateField:function(field,options,skipAjaxValidation){
if(!field.attr("id")){
field.attr("id","form-validation-field-"+$.validationEngine.fieldIdCounter);
++$.validationEngine.fieldIdCounter;
}
var rulesParsing=field.attr(options.validateAttribute);
var getRules=/validate\[(.*)\]/.exec(rulesParsing);
if(!getRules)
return false;
var str=getRules[1];
var rules=str.split(/\[|,|\]/);
var isAjaxValidator=false;
var fieldName=field.attr("name");
var promptText="";
var required=false;
options.isError=false;
options.showArrow=true;
var form=$(field.closest("form"));
for(var i=0;i<rules.length;i++){
rules[i]=rules[i].replace(" ","")
var errorMsg=undefined;
switch(rules[i]){
case"required":
required=true;
errorMsg=methods._required(field,rules,i,options);
break;
case"custom":
errorMsg=methods._customRegex(field,rules,i,options);
break;
case"groupRequired":
var classGroup="["+options.validateAttribute+"*="+rules[i+1]+"]";
var firstOfGroup=form.find(classGroup).eq(0);
if(firstOfGroup[0]!=field[0]){
methods._validateField(firstOfGroup,options,skipAjaxValidation)
options.showArrow=true;
continue;
};
errorMsg=methods._groupRequired(field,rules,i,options);
if(errorMsg)required=true;
options.showArrow=false;
break;
case"ajax":
if(!skipAjaxValidation){
methods._ajax(field,rules,i,options);
isAjaxValidator=true;
}
break;
case"minSize":
errorMsg=methods._minSize(field,rules,i,options);
break;
case"maxSize":
errorMsg=methods._maxSize(field,rules,i,options);
break;
case"min":
errorMsg=methods._min(field,rules,i,options);
break;
case"max":
errorMsg=methods._max(field,rules,i,options);
break;
case"past":
errorMsg=methods._past(field,rules,i,options);
break;
case"future":
errorMsg=methods._future(field,rules,i,options);
break;
case"dateRange":
var classGroup="["+options.validateAttribute+"*="+rules[i+1]+"]";
var firstOfGroup=form.find(classGroup).eq(0);
var secondOfGroup=form.find(classGroup).eq(1);
if(firstOfGroup[0].value||secondOfGroup[0].value){
errorMsg=methods._dateRange(firstOfGroup,secondOfGroup,rules,i,options);
}
if(errorMsg)required=true;
options.showArrow=false;
break;
case"dateTimeRange":
var classGroup="["+options.validateAttribute+"*="+rules[i+1]+"]";
var firstOfGroup=form.find(classGroup).eq(0);
var secondOfGroup=form.find(classGroup).eq(1);
if(firstOfGroup[0].value||secondOfGroup[0].value){
errorMsg=methods._dateTimeRange(firstOfGroup,secondOfGroup,rules,i,options);
}
if(errorMsg)required=true;
options.showArrow=false;
break;
case"maxCheckbox":
errorMsg=methods._maxCheckbox(form,field,rules,i,options);
field=$(form.find("input[name='"+fieldName+"']"));
break;
case"minCheckbox":
errorMsg=methods._minCheckbox(form,field,rules,i,options);
field=$(form.find("input[name='"+fieldName+"']"));
break;
case"equals":
errorMsg=methods._equals(field,rules,i,options);
break;
case"funcCall":
errorMsg=methods._funcCall(field,rules,i,options);
break;
case"creditCard":
errorMsg=methods._creditCard(field,rules,i,options);
break;
default:
}
if(errorMsg!==undefined){
promptText+=errorMsg+"<br/>";
options.isError=true;
}
}
if(!required&&field.val()=="")options.isError=false;
var fieldType=field.prop("type");
if((fieldType=="radio"||fieldType=="checkbox")&&form.find("input[name='"+fieldName+"']").size()>1){
field=$(form.find("input[name='"+fieldName+"'][type!=hidden]:first"));
options.showArrow=false;
}
if(fieldType=="text"&&form.find("input[name='"+fieldName+"']").size()>1){
field=$(form.find("input[name='"+fieldName+"'][type!=hidden]:first"));
options.showArrow=false;
}
if(options.isError){
methods._showPrompt(field,promptText,"",false,options);
}else{
if(!isAjaxValidator)methods._closePrompt(field);
}
if(!isAjaxValidator){
field.trigger("jqv.field.result",[field,options.isError,promptText]);
}
var errindex=$.inArray(field[0],options.InvalidFields);
if(errindex==-1){
if(options.isError)
options.InvalidFields.push(field[0]);
}else if(!options.isError){
options.InvalidFields.splice(errindex,1);
}
return options.isError;
},
_required:function(field,rules,i,options){
switch(field.prop("type")){
case"text":
case"password":
case"textarea":
case"file":
default:
if(!$.trim(field.val())||field.val()==field.attr("data-validation-placeholder"))
return options.allrules[rules[i]].alertText;
break;
case"radio":
case"checkbox":
var form=field.closest("form");
var name=field.attr("name");
if(form.find("input[name='"+name+"']:checked").size()==0){
if(form.find("input[name='"+name+"']").size()==1)
return options.allrules[rules[i]].alertTextCheckboxe;
else
return options.allrules[rules[i]].alertTextCheckboxMultiple;
}
break;
case"select-one":
if(!field.val())
return options.allrules[rules[i]].alertText;
break;
case"select-multiple":
if(!field.find("option:selected").val())
return options.allrules[rules[i]].alertText;
}
},
_groupRequired:function(field,rules,i,options){
var classGroup="["+options.validateAttribute+"*="+rules[i+1]+"]";
var isValid=false;
field.closest("form").find(classGroup).each(function(){
if(!methods._required($(this),rules,i,options)){
isValid=true;
return false;
}
})
if(!isValid)return options.allrules[rules[i]].alertText;
},
_customRegex:function(field,rules,i,options){
var customRule=rules[i+1];
var rule=options.allrules[customRule];
if(!rule){
alert("jqv:custom rule not found "+customRule);
return;
}
var ex=rule.regex;
if(!ex){
alert("jqv:custom regex not found "+customRule);
return;
}
var pattern=new RegExp(ex);
if(!pattern.test(field.val()))
return options.allrules[customRule].alertText;
},
_funcCall:function(field,rules,i,options){
var functionName=rules[i+1];
var fn;
if(functionName.indexOf('.')>-1)
{
var namespaces=functionName.split('.');
var scope=window;
while(namespaces.length)
{
scope=scope[namespaces.shift()];
}
fn=scope;
}
else
fn=window[functionName]||options.customFunctions[functionName];
if(typeof(fn)=='function')
return fn(field,rules,i,options);
},
_equals:function(field,rules,i,options){
var equalsField=rules[i+1];
if(field.val()!=$("#"+equalsField).val())
return options.allrules.equals.alertText;
},
_maxSize:function(field,rules,i,options){
var max=rules[i+1];
var len=field.val().length;
if(len>max){
var rule=options.allrules.maxSize;
return rule.alertText+max+rule.alertText2;
}
},
_minSize:function(field,rules,i,options){
var min=rules[i+1];
var len=field.val().length;
if(len<min){
var rule=options.allrules.minSize;
return rule.alertText+min+rule.alertText2;
}
},
_min:function(field,rules,i,options){
var min=parseFloat(rules[i+1]);
var len=parseFloat(field.val());
if(len<min){
var rule=options.allrules.min;
if(rule.alertText2)return rule.alertText+min+rule.alertText2;
return rule.alertText+min;
}
},
_max:function(field,rules,i,options){
var max=parseFloat(rules[i+1]);
var len=parseFloat(field.val());
if(len>max){
var rule=options.allrules.max;
if(rule.alertText2)return rule.alertText+max+rule.alertText2;
return rule.alertText+max;
}
},
_past:function(field,rules,i,options){
var p=rules[i+1];
var pdate=(p.toLowerCase()=="now")?new Date():methods._parseDate(p);
var vdate=methods._parseDate(field.val());
if(vdate>pdate){
var rule=options.allrules.past;
if(rule.alertText2)return rule.alertText+methods._dateToString(pdate)+rule.alertText2;
return rule.alertText+methods._dateToString(pdate);
}
},
_future:function(field,rules,i,options){
var p=rules[i+1];
var pdate=(p.toLowerCase()=="now")?new Date():methods._parseDate(p);
var vdate=methods._parseDate(field.val());
if(vdate<pdate){
var rule=options.allrules.future;
if(rule.alertText2)
return rule.alertText+methods._dateToString(pdate)+rule.alertText2;
return rule.alertText+methods._dateToString(pdate);
}
},
_isDate:function(value){
var dateRegEx=new RegExp(/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:0?[1-9]|1[0-2])(\/|-)(?:0?[1-9]|1\d|2[0-8]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(0?2(\/|-)29)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/);
return dateRegEx.test(value);
},
_isDateTime:function(value){
var dateTimeRegEx=new RegExp(/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1}$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^((1[012]|0?[1-9]){1}\/(0?[1-9]|[12][0-9]|3[01]){1}\/\d{2,4}\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1})$/);
return dateTimeRegEx.test(value);
},
_dateCompare:function(start,end){
return(new Date(start.toString())<new Date(end.toString()));
},
_dateRange:function(first,second,rules,i,options){
if((!first[0].value&&second[0].value)||(first[0].value&&!second[0].value)){
return options.allrules[rules[i]].alertText+options.allrules[rules[i]].alertText2;
}
if(!methods._isDate(first[0].value)||!methods._isDate(second[0].value)){
return options.allrules[rules[i]].alertText+options.allrules[rules[i]].alertText2;
}
if(!methods._dateCompare(first[0].value,second[0].value)){
return options.allrules[rules[i]].alertText+options.allrules[rules[i]].alertText2;
}
},
_dateTimeRange:function(first,second,rules,i,options){
if((!first[0].value&&second[0].value)||(first[0].value&&!second[0].value)){
return options.allrules[rules[i]].alertText+options.allrules[rules[i]].alertText2;
}
if(!methods._isDateTime(first[0].value)||!methods._isDateTime(second[0].value)){
return options.allrules[rules[i]].alertText+options.allrules[rules[i]].alertText2;
}
if(!methods._dateCompare(first[0].value,second[0].value)){
return options.allrules[rules[i]].alertText+options.allrules[rules[i]].alertText2;
}
},
_maxCheckbox:function(form,field,rules,i,options){
var nbCheck=rules[i+1];
var groupname=field.attr("name");
var groupSize=form.find("input[name='"+groupname+"']:checked").size();
if(groupSize>nbCheck){
options.showArrow=false;
if(options.allrules.maxCheckbox.alertText2)
return options.allrules.maxCheckbox.alertText+" "+nbCheck+" "+options.allrules.maxCheckbox.alertText2;
return options.allrules.maxCheckbox.alertText;
}
},
_minCheckbox:function(form,field,rules,i,options){
var nbCheck=rules[i+1];
var groupname=field.attr("name");
var groupSize=form.find("input[name='"+groupname+"']:checked").size();
if(groupSize<nbCheck){
options.showArrow=false;
return options.allrules.minCheckbox.alertText+" "+nbCheck+" "+options.allrules.minCheckbox.alertText2;
}
},
_creditCard:function(field,rules,i,options){
var valid=false,cardNumber=field.val().replace(/ +/g,'').replace(/-+/g,'');
var numDigits=cardNumber.length;
if(numDigits>=14&&numDigits<=16&&parseInt(cardNumber)>0){
var sum=0,i=numDigits-1,pos=1,digit,luhn=new String();
do{
digit=parseInt(cardNumber.charAt(i));
luhn+=(pos++%2==0)?digit*2:digit;
}while(--i>=0)
for(i=0;i<luhn.length;i++){
sum+=parseInt(luhn.charAt(i));
}
valid=sum%10==0;
}
if(!valid)return options.allrules.creditCard.alertText;
},
_ajax:function(field,rules,i,options){
var errorSelector=rules[i+1];
var rule=options.allrules[errorSelector];
var extraData=rule.extraData;
var extraDataDynamic=rule.extraDataDynamic;
if(!extraData)
extraData="";
if(extraDataDynamic){
var tmpData=[];
var domIds=String(extraDataDynamic).split(",");
for(var i=0;i<domIds.length;i++){
var id=domIds[i];
if($(id).length){
var inputValue=field.closest("form").find(id).val();
var keyValue=id.replace('#','')+'='+escape(inputValue);
tmpData.push(keyValue);
}
}
extraDataDynamic=tmpData.join("&");
}else{
extraDataDynamic="";
}
if(!options.isError){
$.ajax({
type:"GET",
url:rule.url,
cache:false,
dataType:"json",
data:"fieldId="+field.attr("id")+"&fieldValue="+field.val()+"&extraData="+extraData+"&"+extraDataDynamic,
field:field,
rule:rule,
methods:methods,
options:options,
beforeSend:function(){
var loadingText=rule.alertTextLoad;
if(loadingText)
methods._showPrompt(field,loadingText,"load",true,options);
},
error:function(data,transport){
methods._ajaxError(data,transport);
},
success:function(json){
var errorFieldId=json[0];
var errorField=$($("input[id='"+errorFieldId+"']")[0]);
if(errorField.length==1){
var status=json[1];
var msg=json[2];
if(!status){
options.ajaxValidCache[errorFieldId]=false;
options.isError=true;
if(msg){
if(options.allrules[msg]){
var txt=options.allrules[msg].alertText;
if(txt)
msg=txt;
}
}
else
msg=rule.alertText;
methods._showPrompt(errorField,msg,"",true,options);
}else{
if(options.ajaxValidCache[errorFieldId]!==undefined)
options.ajaxValidCache[errorFieldId]=true;
if(msg){
if(options.allrules[msg]){
var txt=options.allrules[msg].alertTextOk;
if(txt)
msg=txt;
}
}
else
msg=rule.alertTextOk;
if(msg)
methods._showPrompt(errorField,msg,"pass",true,options);
else
methods._closePrompt(errorField);
}
}
errorField.trigger("jqv.field.result",[errorField,options.isError,msg]);
}
});
}
},
_ajaxError:function(data,transport){
if(data.status==0&&transport==null)
alert("The page is not served from a server! ajax call failed");
else if(typeof console!="undefined")
console.log("Ajax error: "+data.status+" "+transport);
},
_dateToString:function(date){
return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
},
_parseDate:function(d){
var dateParts=d.split("-");
if(dateParts==d)
dateParts=d.split("/");
return new Date(dateParts[0],(dateParts[1]-1),dateParts[2]);
},
_showPrompt:function(field,promptText,type,ajaxed,options,ajaxform){
var prompt=methods._getPrompt(field);
if(ajaxform)prompt=false;
if(prompt)
methods._updatePrompt(field,prompt,promptText,type,ajaxed,options);
else
methods._buildPrompt(field,promptText,type,ajaxed,options);
},
_buildPrompt:function(field,promptText,type,ajaxed,options){
var prompt=$('<div>');
prompt.addClass(methods._getClassName(field.attr("id"))+"formError");
if(field.is(":input"))
prompt.addClass("parentForm"+methods._getClassName(field.parents('form').attr("id")));
prompt.addClass("formError");
switch(type){
case"pass":
prompt.addClass("greenPopup");
break;
case"load":
prompt.addClass("blackPopup");
break;
default:
}
if(ajaxed)
prompt.addClass("ajaxed");
var promptContent=$('<div>').addClass("formErrorContent").html(promptText).appendTo(prompt);
if(options.showArrow){
var arrow=$('<div>').addClass("formErrorArrow");
var positionType=field.data("promptPosition")||options.promptPosition;
if(typeof(positionType)=='string')
{
var pos=positionType.indexOf(":");
if(pos!=-1)
positionType=positionType.substring(0,pos);
}
switch(positionType){
case"bottomLeft":
case"bottomRight":
prompt.find(".formErrorContent").before(arrow);
arrow.addClass("formErrorArrowBottom").html('<div class="line1"><!-- --></div><div class="line2"><!-- --></div><div class="line3"><!-- --></div><div class="line4"><!-- --></div><div class="line5"><!-- --></div><div class="line6"><!-- --></div><div class="line7"><!-- --></div><div class="line8"><!-- --></div><div class="line9"><!-- --></div><div class="line10"><!-- --></div>');
break;
case"topLeft":
case"topRight":
arrow.html('<div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div>');
prompt.append(arrow);
break;
}
}
if(field.closest('.ui-dialog').length)
prompt.addClass('formErrorInsideDialog');
prompt.css({
"opacity":0,
'position':'absolute'
});
field.before(prompt);
var pos=methods._calculatePosition(field,prompt,options);
prompt.css({
"top":pos.callerTopPosition,
"left":pos.callerleftPosition,
"marginTop":pos.marginTopSize,
"opacity":0
}).data("callerField",field);
if(options.autoHidePrompt){
setTimeout(function(){
prompt.animate({
"opacity":0
},function(){
prompt.closest('.formErrorOuter').remove();
prompt.remove();
});
},options.autoHideDelay);
}
return prompt.animate({
"opacity":0.87
});
},
_updatePrompt:function(field,prompt,promptText,type,ajaxed,options,noAnimation){
if(prompt){
if(typeof type!=="undefined"){
if(type=="pass")
prompt.addClass("greenPopup");
else
prompt.removeClass("greenPopup");
if(type=="load")
prompt.addClass("blackPopup");
else
prompt.removeClass("blackPopup");
}
if(ajaxed)
prompt.addClass("ajaxed");
else
prompt.removeClass("ajaxed");
prompt.find(".formErrorContent").html(promptText);
var pos=methods._calculatePosition(field,prompt,options);
var css={"top":pos.callerTopPosition,
"left":pos.callerleftPosition,
"marginTop":pos.marginTopSize};
if(noAnimation)
prompt.css(css);
else
prompt.animate(css);
}
},
_closePrompt:function(field){
var prompt=methods._getPrompt(field);
if(prompt)
prompt.fadeTo("fast",0,function(){
prompt.parent('.formErrorOuter').remove();
prompt.remove();
});
},
closePrompt:function(field){
return methods._closePrompt(field);
},
_getPrompt:function(field){
var formId=$(field).closest('form').attr('id');
var className=methods._getClassName(field.attr("id"))+"formError";
var match=$("."+methods._escapeExpression(className)+'.parentForm'+formId)[0];
if(match)
return $(match);
},
_escapeExpression:function(selector){
return selector.replace(/([#;&,\.\+\*\~':"\!\^$\[\]\(\)=>\|])/g,"\\$1");
},
isRTL:function(field)
{
var $document=$(document);
var $body=$('body');
var rtl=
(field&&field.hasClass('rtl'))||
(field&&(field.attr('dir')||'').toLowerCase()==='rtl')||
$document.hasClass('rtl')||
($document.attr('dir')||'').toLowerCase()==='rtl'||
$body.hasClass('rtl')||
($body.attr('dir')||'').toLowerCase()==='rtl';
return Boolean(rtl);
},
_calculatePosition:function(field,promptElmt,options){
var promptTopPosition,promptleftPosition,marginTopSize;
var fieldWidth=field.width();
var fieldLeft=field.position().left
var fieldTop=field.position().top;
var fieldHeight=field.height();
var promptHeight=promptElmt.height();
promptTopPosition=promptleftPosition=0;
marginTopSize=-promptHeight;
var positionType=field.data("promptPosition")||options.promptPosition;
var shift1="";
var shift2="";
var shiftX=0;
var shiftY=0;
if(typeof(positionType)=='string'){
if(positionType.indexOf(":")!=-1){
shift1=positionType.substring(positionType.indexOf(":")+1);
positionType=positionType.substring(0,positionType.indexOf(":"));
if(shift1.indexOf(",")!=-1){
shift2=shift1.substring(shift1.indexOf(",")+1);
shift1=shift1.substring(0,shift1.indexOf(","));
shiftY=parseInt(shift2);
if(isNaN(shiftY))shiftY=0;
};
shiftX=parseInt(shift1);
if(isNaN(shift1))shift1=0;
};
};
switch(positionType){
default:
case"topRight":
promptleftPosition+=fieldLeft+fieldWidth-30;
promptTopPosition+=fieldTop;
break;
case"topLeft":
promptTopPosition+=fieldTop;
promptleftPosition+=fieldLeft
break;
case"centerRight":
promptTopPosition=fieldTop+4;
marginTopSize=0;
promptleftPosition=fieldLeft+field.outerWidth(1)+5;
break;
case"centerLeft":
promptleftPosition=fieldLeft-(promptElmt.width()+2);
promptTopPosition=fieldTop+4;
marginTopSize=0;
break;
case"bottomLeft":
promptTopPosition=fieldTop+field.height()+5;
marginTopSize=0;
promptleftPosition=fieldLeft;
break;
case"bottomRight":
promptleftPosition=fieldLeft+fieldWidth-30;
promptTopPosition=fieldTop+field.height()+5;
marginTopSize=0;
}
promptleftPosition+=shiftX;
promptTopPosition+=shiftY;
return{
"callerTopPosition":promptTopPosition+"px",
"callerleftPosition":promptleftPosition+"px",
"marginTopSize":marginTopSize+"px"
};
},
_saveOptions:function(form,options){
if($.validationEngineLanguage)
var allRules=$.validationEngineLanguage.allRules;
else
$.error("jQuery.validationEngine rules are not loaded, plz add localization files to the page");
$.validationEngine.defaults.allrules=allRules;
var userOptions=$.extend(true,{},$.validationEngine.defaults,options);
form.data('jqv',userOptions);
return userOptions;
},
_getClassName:function(className){
if(className)
return className.replace(/:/g,"_").replace(/\./g,"_");
}
};
$.fn.validationEngine=function(method){
var form=$(this);
if(!form[0])return false;
if(typeof(method)=='string'&&method.charAt(0)!='_'&&methods[method]){
if(method!="showPrompt"&&method!="hide"&&method!="hideAll")
methods.init.apply(form);
return methods[method].apply(form,Array.prototype.slice.call(arguments,1));
}else if(typeof method=='object'||!method){
methods.init.apply(form,arguments);
return methods.attach.apply(form);
}else{
$.error('Method '+method+' does not exist in jQuery.validationEngine');
}
};
$.validationEngine={fieldIdCounter:0,defaults:{
validationEventTrigger:"blur",
scroll:true,
focusFirstField:true,
promptPosition:"topRight",
bindMethod:"bind",
inlineAjax:false,
ajaxFormValidation:false,
ajaxFormValidationURL:false,
onAjaxFormComplete:$.noop,
onBeforeAjaxFormValidation:$.noop,
onValidationComplete:false,
doNotShowAllErrosOnSubmit:false,
binded:true,
showArrow:true,
isError:false,
ajaxValidCache:{},
autoPositionUpdate:false,
InvalidFields:[],
onSuccess:false,
onFailure:false,
autoHidePrompt:false,
autoHideDelay:10000,
fadeDuration:0.3
}};
$(function(){$.validationEngine.defaults.promptPosition=methods.isRTL()?'topLeft':"topRight"});
})(jQuery);