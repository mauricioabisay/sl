function showSubmenu(id)
{
	 document.all("submenu"+id).style.display="BLOCK";
}

function hideSubmenu(id)
{
	 document.all("submenu"+id).style.display="NONE";
}

function configureMenu(max)
{
	 for(i=1; i<=max;  i++)
	 {
		 document.all("submenu"+i).style.display="NONE";
	 }
}