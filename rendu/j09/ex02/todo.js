
/*   todo.js   */

var new_btn = document.getElementById("new-btn");
var todo_list = document.getElementById("ft_list");


new_btn.addEventListener('click', function(){

    var todo_item_content = prompt("Enter your next todo");
    var div = document.createElement('div');

	if (todo_item_content)
	{
		todo_list.insertBefore(div, todo_list.firstChild);
		div.innerHTML = todo_item_content;
		div.id = 'todo';
		
		div.addEventListener('click', function(){
			if (confirm("Delete this todo ?"))	
				this.remove();

		}, false);
	}

}, false);

