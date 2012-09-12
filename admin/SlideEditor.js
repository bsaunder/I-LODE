function selOn(ctrl)
{
	ctrl.style.backgroundColor = '#B5BED6';
	ctrl.style.cursor = 'hand';	
}
  
function selOff(ctrl)
{ 
	ctrl.style.backgroundColor = '#D6D3CE';
}
  
function selDown(ctrl)
{
	ctrl.style.backgroundColor = '#8492B5';
}
  
function selUp(ctrl)
{
	ctrl.style.backgroundColor = '#B5BED6';
}

function storeCaret(textEl) {
	if (textEl.createTextRange){
		textEl.caretPos = document.selection.createRange().duplicate();
	}
}

function doFormat(tagName)
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		slide.newtext.focus();
		var newSelection = document.selection.createRange();
		newSelection.text = "<"+tagName+">"+selection+"</"+tagName+">";
		return;
	} else {
		var text = prompt("What Text do you want to Format?","");
		if(text != null){
			link = "<"+tagName+">"+text+"</"+tagName+">";
			if (slide.newtext.createTextRange && slide.newtext.caretPos) {
				var caretPos = slide.newtext.caretPos;
				caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? link + ' ' : link;
			} else {
				currentstuff = slide.newtext.value;
				slide.newtext.value = currentstuff + link;
			}
		}
	}
}

function doAlign(align)
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		slide.newtext.focus();
		var newSelection = document.selection.createRange();
		newSelection.text = "<p align="+align+">"+selection+"</p>";
		return;
	} else {
		var text = prompt("What Text do you want to Format?","");
		if(text != null){
			link = "<p align="+align+">"+text+"</p>";
			if (slide.newtext.createTextRange && slide.newtext.caretPos) {
				var caretPos = slide.newtext.caretPos;
				caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? link + ' ' : link;
			} else {
				currentstuff = slide.newtext.value;
				slide.newtext.value = currentstuff + link;
			}
		}
	}
}

function doForeground()
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		var color = prompt("What Color?","#000000");
		if(color != null){
			var newSelection = document.selection.createRange();
			newSelection.text = "<font color="+color+">"+selection+"</font>";
			return;
		}
	} else {
		var color = prompt("What Color?","#000000");
		if(color != null){
			var text = prompt("What is the Text?","");
			if(text != null){
				tag = "<font color="+color+">"+text+"</font>";
				if (slide.newtext.createTextRange && slide.newtext.caretPos) {
					var caretPos = slide.newtext.caretPos;
					caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? tag + ' ' : tag;
				} else {
					currentstuff = slide.newtext.value;
					slide.newtext.value = currentstuff + tag;
				}
			}
		}
	}
}

function doBackground()
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		slide.newtext.focus();
		var color = prompt("What Color?","#000000");
		if(color != null){
			var newSelection = document.selection.createRange();
			newSelection.text = "<span style=\"background-color: "+color+"\">"+selection+"</span>";
			return;
		}
	} else {
		var color = prompt("What Color?","#000000");
		if(color != null){
			var text = prompt("What is the Text?","");
			if(text != null){
				tag = "<span style=\"background-color: "+color+"\">"+text+"</span>";
				if (slide.newtext.createTextRange && slide.newtext.caretPos) {
					var caretPos = slide.newtext.caretPos;
					caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? tag + ' ' : tag;
				} else {
					currentstuff = slide.newtext.value;
					slide.newtext.value = currentstuff + tag;
				}
			}
		}
	}
}


function doLink()
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		var url = prompt("What is the URL?","");
		if(url != null){
			var newSelection = document.selection.createRange();
			newSelection.text = "<a href="+url+">"+selection+"</a>";
			return;
		}
	} else {
		var url = prompt("What is the URL?","");
		if(url != null){
			var text = prompt("What is the Text?","");
			if(text != null){
				link = "<a href="+url+">"+text+"</a>";
				if (slide.newtext.createTextRange && slide.newtext.caretPos) {
					var caretPos = slide.newtext.caretPos;
					caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? link + ' ' : link;
				} else {
					currentstuff = slide.newtext.value;
					slide.newtext.value = currentstuff + link;
				}
			}
		}
	}
}

function doFontSize()
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		slide.newtext.focus();
		var newSelection = document.selection.createRange();
		newSelection.text = "<font size="+slide.fontSize.value+">"+selection+"</font>";
		return;
	} else {
		var text = prompt("What is the Text?","");
		if(text != null){
			tag = "<font size="+slide.fontSize.value+">"+text+"</font>";
			if (slide.newtext.createTextRange && slide.newtext.caretPos) {
				var caretPos = slide.newtext.caretPos;
				caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? tag + ' ' : tag;
			} else {
				currentstuff = slide.newtext.value;
				slide.newtext.value = currentstuff + tag;
			}
		}
	}
}

function doRule()
{
	if (slide.newtext.createTextRange && slide.newtext.caretPos) {
		var caretPos = slide.newtext.caretPos;
		caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? "<hr>" + ' ' : "<hr>";
	} else {
		currentstuff = slide.newtext.value;
		slide.newtext.value = currentstuff + "<hr>";
	}
}

function doImage()
{
	var img = "<img src=\""+slide.mainImg.value+"\" border=0 />";
	if (slide.newtext.createTextRange && slide.newtext.caretPos) {
		var caretPos = slide.newtext.caretPos;
		caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? img + ' ' : img;
	} else {
		currentstuff = slide.newtext.value;
		slide.newtext.value = currentstuff + img;
	}
}

function A_doFormat(tagName)
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		slide.a_newtext.focus();
		var newSelection = document.selection.createRange();
		newSelection.text = "<"+tagName+">"+selection+"</"+tagName+">";
		return;
	} else {
		var text = prompt("What Text do you want to Format?","");
		if(text != null){
			link = "<"+tagName+">"+text+"</"+tagName+">";
			if (slide.a_newtext.createTextRange && slide.a_newtext.caretPos) {
				var caretPos = slide.a_newtext.caretPos;
				caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? link + ' ' : link;
			} else {
				currentstuff = slide.a_newtext.value;
				slide.a_newtext.value = currentstuff + link;
			}
		}
	}
}

function A_doAlign(align)
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		slide.a_newtext.focus();
		var newSelection = document.selection.createRange();
		newSelection.text = "<p align="+align+">"+selection+"</p>";
		return;
	} else {
		var text = prompt("What Text do you want to Format?","");
		if(text != null){
			link = "<p align="+align+">"+text+"</p>";
			if (slide.a_newtext.createTextRange && slide.a_newtext.caretPos) {
				var caretPos = slide.a_newtext.caretPos;
				caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? link + ' ' : link;
			} else {
				currentstuff = slide.a_newtext.value;
				slide.a_newtext.value = currentstuff + link;
			}
		}
	}
}

function A_doForeground()
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		var color = prompt("What Color?","#000000");
		if(color != null){
			var newSelection = document.selection.createRange();
			newSelection.text = "<font color="+color+">"+selection+"</font>";
			return;
		}
	} else {
		var color = prompt("What Color?","#000000");
		if(color != null){
			var text = prompt("What is the Text?","");
			if(text != null){
				tag = "<font color="+color+">"+text+"</font>";
				if (slide.a_newtext.createTextRange && slide.a_newtext.caretPos) {
					var caretPos = slide.a_newtext.caretPos;
					caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? tag + ' ' : tag;
				} else {
					currentstuff = slide.a_newtext.value;
					slide.a_newtext.value = currentstuff + tag;
				}
			}
		}
	}
}

function A_doBackground()
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		slide.a_newtext.focus();
		var color = prompt("What Color?","#000000");
		if(color != null){
			var newSelection = document.selection.createRange();
			newSelection.text = "<span style=\"background-color: "+color+"\">"+selection+"</span>";
			return;
		}
	} else {
		var color = prompt("What Color?","#000000");
		if(color != null){
			var text = prompt("What is the Text?","");
			if(text != null){
				tag = "<span style=\"background-color: "+color+"\">"+text+"</span>";
				if (slide.a_newtext.createTextRange && slide.a_newtext.caretPos) {
					var caretPos = slide.a_newtext.caretPos;
					caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? tag + ' ' : tag;
				} else {
					currentstuff = slide.a_newtext.value;
					slide.a_newtext.value = currentstuff + tag;
				}
			}
		}
	}
}


function A_doLink()
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		var url = prompt("What is the URL?","");
		if(url != null){
			var newSelection = document.selection.createRange();
			newSelection.text = "<a href="+url+">"+selection+"</a>";
			return;
		}
	} else {
		var url = prompt("What is the URL?","");
		if(url != null){
			var text = prompt("What is the Text?","");
			if(text != null){
				link = "<a href="+url+">"+text+"</a>";
				if (slide.a_newtext.createTextRange && slide.a_newtext.caretPos) {
					var caretPos = slide.a_newtext.caretPos;
					caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? link + ' ' : link;
				} else {
					currentstuff = slide.a_newtext.value;
					slide.a_newtext.value = currentstuff + link;
				}
			}
		}
	}
}

function A_doFontSize()
{
	var selection = document.selection.createRange().text;
	if(selection != "")
	{
		slide.a_newtext.focus();
		var newSelection = document.selection.createRange();
		newSelection.text = "<font size="+slide.fontSize.value+">"+selection+"</font>";
		return;
	} else {
		var text = prompt("What is the Text?","");
		if(text != null){
			tag = "<font size="+slide.fontSize.value+">"+text+"</font>";
			if (slide.a_newtext.createTextRange && slide.a_newtext.caretPos) {
				var caretPos = slide.a_newtext.caretPos;
				caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? tag + ' ' : tag;
			} else {
				currentstuff = slide.a_newtext.value;
				slide.a_newtext.value = currentstuff + tag;
			}
		}
	}
}

function A_doRule()
{
	if (slide.a_newtext.createTextRange && slide.a_newtext.caretPos) {
		var caretPos = slide.a_newtext.caretPos;
		caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? "<hr>" + ' ' : "<hr>";
	} else {
		currentstuff = slide.a_newtext.value;
		slide.a_newtext.value = currentstuff + "<hr>";
	}
}

function A_doImage()
{
	var img = "<img src=\""+slide.altImg.value+"\" border=0 />";
	if (slide.a_newtext.createTextRange && slide.a_newtext.caretPos) {
		var caretPos = slide.a_newtext.caretPos;
		caretPos.text = (caretPos.text.charAt(caretPos.text.length - 1) == ' ') ? img + ' ' : img;
	} else {
		currentstuff = slide.a_newtext.value;
		slide.a_newtext.value = currentstuff + img;
	}
}