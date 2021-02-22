var sortieren = 'customerNumber';
var daten = null;
var alt_cn = null;


function zeigen() {
	new Ajax.Request('alisa.php', {
		parameters: {},
		on403: function() { },
		onComplete: function(req) {
			
			var erg = req.responseJSON;
			daten = erg;
			erstellen(erg);
		}
	})
}

function besser() {

	new Ajax.Request('alisa.php', {
		parameters: {'ablauf':'alles'},
		on403: function() { },
		onComplete: function(req) {
			var erg = req.responseJSON;
			daten = erg.detail;
			console.log(daten);
			baue_tabelle();
		}
	})
}

function erstellen(myarray) {


	table = new Element('table');
	thead = new Element('thead');
	tbody = new Element('tbody');
	trhead = new Element('tr');
	trbody = new Element('tr');
	var titel = [];
	count_titel = 0;
	function arraysort(event) {
		myarray.sort((a, b) => a[event.originalTarget.innerText] > b[event.originalTarget.innerText]);
		erstellen(myarray);
	}

	myarray.each(function(el) {

		titel = Object.keys(el);
		if (count_titel == 0) {
			titel.forEach(keystotitel);
			thead.insert(trhead);
			trhead = new Element('tr');
			count_titel = 1;

		}


		titel.forEach(itemtokey);
		tbody.insert(trbody);

		trbody = new Element('tr');

		function keystotitel(item) {
			th = new Element('th');
			th.update(item);
			trhead.insert(th);
			Event.observe(th, 'click', arraysort);

		}

		function itemtokey(item) {
			td = new Element('td');
			td.update(el[item]);
			trbody.insert(td);

		}

	});
	table.insert(thead);
	table.insert(tbody);

	$('taberreich').update(table);

}

function baue_tabelle() {
	var c1, c2, c3, c4;
	c1 = new Element('table', { 'id': 'kt' });
	c2 = new Element('thead');
	c3 = new Element('tr');
	Object.keys(daten[0]).each(function(el) {
		c4 = new Element('th').update(el);
		if (el == sortieren) {
			c4.addClassName('sortiere');
		}
		c4.observe('click', function(ev) {
			sortieren = ev.target.innerText;
			baue_tabelle();
		});
		c3.insert(c4);
	});
	Object.keys(daten[0]);
	c4 = new Element('th').update('<i class="fas fa-plus-circle"></i>');
	c4.observe('click', function(ev) {
		dialog.modal('Hinzufügen','<div id="mydialog"/>','mydlg');
		$('mydialog').update($('template_add').clone(true));
		$('mydialog').select('[id^=template_]').each(function(el){el.id = el.id.replace('template_','')});
		$('mydialog').select('[name^=template_]').each(function(el){el.id = el.id.replace('template_','')});
		$('mydialog').select('[lable^=template_]').each(function(el){el.id = el.id.replace('template_','')});
		$('speicherbutton').observe('click',function(ev2){datensatzneu();});
	});
		
	c3.insert(c4);
	c2.insert(c3);
	c1.insert(c2);
	key_array = []
	c2 = new Element('tbody');
	daten.sortBy(function(sl) { return sl[sortieren] }).each(function(el) {
		c3 = new Element('tr');
		Object.keys(el).each(function(zl) {
			c3.insert(Element('td', { 'class': (zl == 'creditLimit' ? 'rechts' : '') }).update(el[zl]));
			key_array[el] = el[zl]
		});
		
		c4 = new Element('td').update('<a href=#><i class="far fa-trash-alt"></i></a>');
		c4.observe('click', function(ev) {
			dialog.yes_no('Willst du wirklich diesen Eintrag mit der customerNumber '+el['customerNumber']+' löschen?','dele('+el['customerNumber']+')',null);

		});

		c3.insert(c4);
		c4 = new Element('td').update('<a href=#><i class="fas fa-pencil-alt"></i></a>');
		c4.observe('click', function(ev) {
			dialog.modal('Bearbeiten','<div id="mydialog"/>','mydlg');
		$('mydialog').update($('template_edit').clone(true));
		$('mydialog').select('[id^=template_]').each(function(el){el.id = el.id.replace('template_','')});
		$('mydialog').select('[name^=template_]').each(function(el){el.id = el.id.replace('template_','')});
		$('mydialog').select('[lable^=template_]').each(function(el){el.id = el.id.replace('template_','')});
		$('speicherbutton').observe('click',function(ev3){bearbeitendatensatz();}
		);
		new Ajax.Request('alisa.php', {
		parameters: {'ablauf':'bearbeiten1','customerNumber':el['customerNumber']},
		on403: function() { },
		onComplete: function(req) {
			erg = req.responseJSON;
			bearbeitenfelder(erg.detail);

		}
	})
		});
		c3.insert(c4);
		c2.insert(c3);
		
	});
	c1.insert(c2);
	c2 = new Element('tfoot');
	c3 = new Element('tr');
	c3.insert(Element('td', { 'colspan': Object.keys(daten[0]).length - 1 }));
	var summe = c1.select('tbody .rechts').inject(0, function(summe, el) {
		return summe + el.innerText * 1
	});
	c3.insert(Element('td',{'class':'summe'}).update(summe));
	c2.insert(c3);
	c1.insert(c2);



	$('taberreich').update(c1);
}

function datensatzneu(){
	new Ajax.Request('alisa.php', {
		parameters: {
			'ablauf':'neu',
		'customerNumber':$('customerNumber2').value,
			'customerName':$('customerName2').value,
			'contactLastName':$('contactLastName2').value,
			'contactFirstName':$('contactFirstName2').value,
			'phone':$('phone2').value,
			'addressLine1':$('addressLine12').value,
			'addressLine2':$('addressLine22').value,
			'city':$('city2').value,
			'state':$('state2').value,
			'postalCode':$('postalCode2').value,
			'country':$('country2').value,
			'salesRepEmployeeNumber':$('salesRepEmployeeNumber2').value,
			'creditLimit':$('creditLimit2').value
			
			},
		on403: function() { },
		onComplete: function(req) {
			
			var erg = req.responseJSON;
			if(erg.erg !='OK'){
				dialog.alert(erg.detail);
			}
			else{
				$('mydlg').remove();
				besser();
			}
			
			
					}
	})
	
}
function bearbeitendatensatz(){
	console.log('bearbeiten');
	new Ajax.Request('alisa.php', {
		parameters: {
			'ablauf':'bearbeiten2',
			'customerNumber':$('customerNumber').value,
			'customerName':$('customerName').value,
			'contactLastName':$('contactLastName').value,
			'contactFirstName':$('contactFirstName').value,
			'phone':$('phone').value,
			'addressLine1':$('addressLine1').value,
			'addressLine2':$('addressLine2').value,
			'city':$('city').value,
			'state':$('state').value,
			'postalCode':$('postalCode').value,
			'country':$('country').value,
			'salesRepEmployeeNumber':$('salesRepEmployeeNumber').value,
			'creditLimit':$('creditLimit').value,
			'cn':alt_cn			
			},
		on403: function() { },
		onComplete: function(req) {
			var erg = req.responseJSON;
			if(erg.erg !='OK'){
				dialog.alert(erg.detail);
			}
			else{
			$('mydlg').remove();
			besser();
			}
		}
	})
	
}

function bearbeitenfelder(arraybe){
	alt_cn = arraybe.customerNumber;
	$('customerNumber').innerText = arraybe.customerNumber;
	$('customerName').value = arraybe.customerName;
	$('contactLastName').value = arraybe.contactLastName;
	$('contactFirstName').value = arraybe.contactFirstName;
	$('phone').value = arraybe.phone;
	$('addressLine1').value = arraybe.addressLine1;
	$('addressLine2').value = arraybe.addressLine2;
	$('city').value = arraybe.city;
	$('state').value = arraybe.state;
	$('postalCode').value = arraybe.postalCode;
	$('country').value = arraybe.country;
	$('salesRepEmployeeNumber').value = arraybe.salesRepEmployeeNumber;
	$('creditLimit').value = arraybe.creditLimit;
	
}
function dele(customerNumber){
	new Ajax.Request('alisa.php', {
		parameters: {'ablauf':'del','customerNumber':customerNumber},
		on403: function() { },
		onComplete: function(req) {
			besser();
		}
	});
}

