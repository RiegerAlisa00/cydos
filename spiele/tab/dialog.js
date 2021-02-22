/**
 * Creates a modal window and dialog
 * 
 * @param string title
 * 	plain text
 * @param string content
 * 	HTML or plain text
 * @param string id
 * 	id for modal window; if no id is set, a random string will be used
 * @param string style
 * 	style to use for background
 * @param string className
 * 	class to use for background
 * @param string dialogStyle
 * 	style to use for dialog
 * @param string dialogClassName
 * 	class to use for dialog
 * 
 * @deprecated
 */
function createModalWindow(title, content, id, style, className, dialogStyle, dialogClassName) {
	dialog.modal(title, content, id, style, className, dialogStyle, dialogClassName);
}

/**
 * Creates a dialog
 * 
 * @param string title
 * 	plain text
 * @param string content
 * 	HTML or plain text
 * @param string id
 * 	id for dialog; if no id is set, a random string will be used
 * @param string style
 * 	style to use for dialog
 * @param string className
 * 	class to use for dialog
 * @param string isModal
 * 	set 1 to use dialog as modal window
 * 
 * @deprecated
 */
function createDialog(title, content, id, style, className, isModal) {
	dialog.dialog(title, content, id, style, className, isModal)
}


/**
 * Dialog class
 */
var dialog = {
	/**
	 * Creates and shows a dialog
	 * 
	 * @param string title
	 * 	plain text
	 * @param string content
	 * 	HTML or plain text
	 * @param string id
	 * 	id for dialog; if no id is set, a random string will be used
	 * @param string style
	 * 	style to use for dialog
	 * @param string className
	 * 	class to use for dialog
	 * @param string isModal
	 * 	set 1 to use dialog as modal window 
	 */
	dialog: function(title, content, id, style, className, isModal) {
		// remove duplicated dialogs
		if (id && $(id)) {
			$(id).remove()
		}
		
		// dialog
		var zIndex = findHighestZIndex();
		var a = new Element('a', {'title': 'schließen'}).observe('click', function() { $(id).remove() });
		if (isModal) {
			document.observe('keyup', function(ev){
				if (ev.keyCode == 27) {
					document.stopObserving('keyup');
					$(id).remove();
				}
			});
		}
		a.insert(Element('i',{'xbtn': 'close', 'class': 'fal fa-times-circle fa-lg close'}));
		var dialog = new Element('div', { 'class': 'dialog ' + className, 'style': (zIndex ? 'z-index: ' + zIndex + '; ' : '' ) + style }).insert(a);
		
		// check if we need an id
		if (typeof id === 'undefined') {
			id = 'dialog_' + Math.floor(Math.random() * 1000000);
		}
		// check if we have a modal window as parent
		if (typeof isModal === 'undefined' || isModal == false) {
			dialog.setAttribute('id', id);
		}
		// dialog heading
		var dialog_heading = new Element('div', { 'class': 'dialog_heading'}).insert(new Element('h2').insert(title));
		dialog.insert(dialog_heading);
		// dialog body
		var dialog_body = new Element('div', { 'class': 'dialog_body'}).insert(content).insert(new Element('div', { 'class': 'clearfix' } ));
		dialog.insert(dialog_body);
		
		if (isModal == true) {
			// return to modal window
			return dialog;
		}
		else {
			// insert dialog
			$(document.body).insert(dialog);
			// return true
			return true;
		}
	},
	
	/**
	 * Creates a modal window/dialog
	 * 
	 * @param string title
	 * 	plain text
	 * @param string content
	 * 	HTML or plain text
	 * @param string id
	 * 	id for modal window; if no id is set, a random string will be used
	 * @param string style
	 * 	style to use for background
	 * @param string className
	 * 	class to use for background
	 * @param string dialogStyle
	 * 	style to use for dialog
	 * @param string dialogClassName
	 * 	class to use for dialog
	 */
	modal: function(title, content, id, style, className, dialogStyle, dialogClassName) {
		if (typeof id === 'undefined') {
			id = 'dialog_' + Math.floor(Math.random() * 1000000);
		}
		
		// remove duplicated modal windows/dialogs
		if (id && $(id)) {
			$(id).remove()
		}

		// background
		var zIndex = findHighestZIndex();
		var modalWindow = new Element('div', { 'id': id, 'style': (zIndex ? 'z-index: ' + zIndex : '' ) + '; ' + style, 'class': 'modal ' + className });
		
		// create dialog
		modalWindow.insert(this.dialog(title, content, id, dialogStyle, dialogClassName, true));
			
		// insert modal window/dialog
		$(document.body).insert(modalWindow);
	},
	
	/**
	 * Creates and shows an alert dialog
	 * 
	 * @param string message
	 */
	alert: function(message) {
		// dialog id
		var id = 'alert_' + Math.floor(Math.random() * 1000000);
		// content
		var content = new Element('div', { 'class': 'text_center' }).insert(new Element('p').insert(message));
		// button
		var button = new Element('button', { 'class': 'blue', 'style': 'float: none !important' }).observe('click', function() { $(id).remove(); }).insert('OK');
		content.insert(button);
		// create dialog
		this.modal('<i class="fas fa-exclamation-triangle fa-2x" style="color: Yellow"> </i> WARNUNG', content, id, 'background-color: transparent;', '', '', 'alert');
		button.focus();
	},
	
	/**
	 * Creates and shows a notification dialog
	 * 
	 * @param string message
	 */
	notification: function(message, p_style='') {
		// dialog id
		var id = 'alert_' + Math.floor(Math.random() * 1000000);
		// content
		var content = new Element('div', { 'class': 'text_center' }).insert(new Element('p', {'style': p_style }).insert(message));
		// button
		var button = new Element('button', { 'class': 'blue', 'style': 'float: none !important' }).observe('click', function() { $(id).remove(); }).insert('OK');
		content.insert(button);
		// create dialog
		this.modal('<i class="fas fa-exclamation-square fa-2x"> </i> HINWEIS', content, id, 'background-color: transparent; ', '', '', 'notification');
	},

	/**
	 * Creates and shows a notification dialog
	 * 
	 * @param string message
	 */
	yes_no: function(message, f_yes, f_no) {
		// dialog id
		var id = 'alert_' + Math.floor(Math.random() * 1000000);
		// content
		var content = new Element('div', { 'class': 'text_center' }).insert(new Element('p').insert(message));
		// button
		var button = new Element('button', { 'class': 'green', 'style': 'float: none !important' }).observe('click', function() { $(id).remove(); eval(f_yes)}).insert('Ja');
		content.insert(button);
		content.insert(' ');
		var button = new Element('button', { 'class': 'red', 'style': 'float: none !important' }).observe('click', function() { $(id).remove(); eval(f_no)}).insert('Nein');
		content.insert(button);
		// create dialog
		this.modal('<i class="fas fa-question-circle fa-2x"> </i> FRAGE', content, id, 'background-color: transparent;', '', '', 'notification');
	}
}


/**
 * 
 * @returns {Number}
 */
function findHighestZIndex() {
	var zIndexMax = 0;
	
	$$('div', 'table', 'nav').each(function(element) {
		if (element.getStyle('z-index') * 1 > zIndexMax) {
			zIndexMax = element.getStyle('z-index') * 1;
		}
	});
	
	return zIndexMax;
}