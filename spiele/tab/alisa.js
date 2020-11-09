var sortieren = 'customerNumber';
var daten = null;

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
		parameters: {},
		on403: function() { },
		onComplete: function(req) {
			var erg = req.responseJSON;
			daten = erg;
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
	var c1, c2, c3, c4, c5;
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
	c2.insert(c3);
	c1.insert(c2);
	c2 = new Element('tbody');
	daten.sortBy(function(sl) { return sl[sortieren] }).each(function(el) {
		c3 = new Element('tr');
		Object.keys(el).each(function(zl) {
			c3.insert(Element('td', { 'class': (zl == 'creditLimit' ? 'rechts' : '') }).update(el[zl]));
		});
		c2.insert(c3);
	});
	c1.insert(c2);
	c2 = new Element('tfoot');
	c3 = new Element('tr');
	c3.insert(Element('td', { 'colspan': Object.keys(daten[0]).length - 1 }));
	var summe = c1.select('tbody .rechts').inject(0, function(summe, el) {
		return summe + el.innerText * 1
	});
	c3.insert(Element('td',{'class':'rechts'}).update(summe));
	c2.insert(c3);
	c1.insert(c2);



	$('taberreich').update(c1);
}

