$('toggle_1').observe('click',function(){$('summary_1').toggle();});
function highlight(element){
	element.addClassName('highlighted');
}
function unhighlight(element){
	element.removeClassName('highlighted');
}