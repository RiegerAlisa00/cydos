Array.prototype.fun = function()
{
	var newArray = []; 
	for (var i = 0, length = this.length; i < length; i++)
	{
		newArray.push(this[i]);
		newArray.push(this[i]);
	}
	return newArray
};
var exampleArray = new Array(1,2,3); 
exampleArray.fun();

var zahl1 = 1;
var zahl2 = 2;
console.log(zahl1+zahl2);

var object = new Object();
object.foo = "foo";
object.bar = "bar";
object.hallo = "hi";
for(var i in object) console.log(i);
print(object);

each: function (iterator){
	for (var i = 0, length = this.length; i < length;i++)
	iterator(this[i]);
}