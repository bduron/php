
/*   todo.js   */

var new_btn = document.getElementById("new-btn");
var todo_list = document.getElementById("ft_list");
var i = 1;// = getIndex(document.cookie.split(';')) + 1;


var cookies = document.cookie.split(';');

for (j in cookies)
{
	if (cookies[j] != "")
	{
		var c = cookies[j].split('=')[1];
		var d = cookies[j].split('=')[0];
    	var cdiv = document.createElement('div');
		todo_list.insertBefore(cdiv, todo_list.firstChild);
		cdiv.innerHTML = c;
		cdiv.id = 'todo';

		cdiv.addEventListener('click', function(d){
			if (confirm("Delete this todo ?"))	
			{
				this.remove();
				delCookie(d);
			}	

		}, false);
		if (i <= parseInt(d))
			i = parseInt(d) + 1; 
	}	
}	


new_btn.addEventListener('click', function(){

    var todo_item_content = prompt("Enter your next todo");
    var div = document.createElement('div');

	if (todo_item_content)
	{
		todo_list.insertBefore(div, todo_list.firstChild);
		div.innerHTML = todo_item_content;
		div.id = 'todo';
		setCookie(i, todo_item_content, 1);
		
		div.addEventListener('click', function(i){
			if (confirm("Delete this todo ?"))	
			{
				this.remove();
				delCookie(toString(i));
			}

		}, false);
		i++;
	}

}, false);

console.log(document.cookie);

function setCookie(sName, sValue, sDays) 
{	
	console.log('In function');
    var today = new Date(), expires = new Date();
    expires.setTime(today.getTime() + (sDays*24*60*60*1000));
	var cookie_str = sName + "=" + sValue + ";expires=" + expires.toGMTString();
    document.cookie = cookie_str;
}

function delCookie(val)
{
	var cookies = document.cookie.split(';');
	var c;

	for (i in cookies)
	{
		c = cookies[i].split('=');
		console.log("id = " + c[0] + "val ); //
		if (c[0] == val)
			setCookie(c[0], "", -1);
	}
}

function getIndex(cookies)
{
	var arr = new Array();

	for (i in cookies)
	{
		if (cookies[i] != NaN)
			arr.push(cookies[i].split('=')[0]);		
	}	
	console.log(arr);	
	return 	Math.max(arr);	
}
