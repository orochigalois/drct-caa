function isDel(tagName) {
	var x = window.confirm(tagName);
	if (x)
	{
		return true;
	}
	else
	{
		return false;
	}
} 
 //全选
function CheckAll(oForm)  {
	var isCheck = oForm.chkall.checked;
	for (var i=0;i<oForm.elements.length-3;i++) {
		oForm.elements[i].checked = isCheck; 
	}
}

//确认删除
function checkSubmit(oForm){  
	var flag=false;
	for (var i=0;i<oForm.elements.length-1;i++) {
		if(oForm.elements[i].checked){flag=true;break;} 
	}
	if(!flag){alert('请选择操作对象！');return false;}  
	if(oForm.action.value==''){alert('请选择操作！');return false;}  
	else{
	  if(oForm.action.value=='-2'){
		return confirm('此操作不可恢复！\n确定删除？');
	  }
    }  
}



//轮播图
function addImg(obj)
{
	var src  = obj.parentNode.parentNode;
	var idx  = rowindex(src);
	var tbl  = document.getElementById('gallery-table');
	var row  = tbl.insertRow(idx + 1);
	var cell = row.insertCell(-1);
	cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
}

function removeImg(obj)
{
	var row = rowindex(obj.parentNode.parentNode);
	var tbl = document.getElementById('gallery-table');
	tbl.deleteRow(row);
}