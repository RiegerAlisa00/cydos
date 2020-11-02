function submitEntryForm(event)
{
	var updater = new Ajax.Updater
	(
		{
			succes: 'breakfast_history', 
			failure:'error_log'
		},
		'breakfast.php',
		{
			parameters: 
			{
				food_type: $('food_type').value, 
				taste:  $('taste').value
			}
		}
	);
	event.preventDefault();
}
function addObservers(){
$('entry').observe('submit',submitEntryForm);
}
Event.observe(window,'load',addObservers);