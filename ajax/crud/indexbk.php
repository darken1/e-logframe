<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>Build CRUD DataGrid with jQuery EasyUI - jQuery EasyUI Demo</title>
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.edatagrid.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#dg').edatagrid({
				url: 'get_users.php',
				saveUrl: 'save_user.php',
				updateUrl: 'update_user.php',
				destroyUrl: 'destroy_user.php'
			});
		});
		
		function doSearch(){
    $('#dg').edatagrid('load',{
        id_no: $('#id_no').val(),
        name_of_beneficiary: $('#name_of_beneficiary').val(),
		project_number: $('#project_number').val()
    });
}
		
	</script>
</head>
<body>
	<h2>CRUD DataGrid</h2>
	<div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Double click the row to begin editing.</div>
	</div>
	<table id="dg" title="My Users" style="width:100%;height:500px"
			toolbar="#toolbar" pagination="true" idField="id"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
            
            <th field="project_number" width="50" , data-options="align: 'center', 
				editor:{
					type:'combobox',
					options:{
						valueField:'ProjectCode',
						textField:'ProjectCode',
						panelHeight:'auto',
						data: <?php include('get_projects.php');?>,
                        required:true
					}
				}
				" >Project No.</th>
            
				<th field="id_no" width="50" editor="{type:'validatebox',options:{required:true}}">ID No.</th>
				<th field="name_of_beneficiary" width="50" editor="{type:'validatebox',options:{required:true}}">Name of Beneficiary</th>
				<th field="mothers_name" width="50" editor="{type:'validatebox',options:{required:true}}">Mother's Name</th>
				<th field="next_of_kin" width="50" editor="{type:'validatebox',options:{required:true}}">Next of Kin</th>
               <th field="sex" width="50" , data-options="align: 'center', 
				editor:{
					type:'combobox',
					options:{
						valueField:'SexID',
						textField:'Sex',
						panelHeight:'auto',
						data: [{
							SexID: '',
							Sex: '- Choose -'
						},{
							SexID: 'Male',
							Sex: 'Male'
						},{
							SexID: 'Female',
							Sex: 'Female'
						}],
                        required:true
					}
				}
				" >Sex</th>
                    <th field="district" width="50" , data-options="align: 'center', 
				editor:{
					type:'combobox',
					options:{
						valueField:'County',
						textField:'County',
						panelHeight:'auto',
						data: <?php include('get_districts.php');?>,
                        required:true
					}
				}
				" >District</th>
                <th field="settlement" width="50" editor="{type:'validatebox',options:{required:true}}">Settlement</th>
                <th field="telephone_number" width="50" editor="{type:'validatebox',options:{required:true}}">Telehpone</th>
                <th field="zero_to_four_female" width="50" editor="{type:'validatebox',options:{required:true}}">0-4 F</th>
                <th field="zero_to_four_male" width="50" editor="{type:'validatebox',options:{required:true}}">0-4 M</th>
                <th field="five_to_seventeen_female" width="50" editor="{type:'validatebox',options:{required:true}}">5-17 F</th>
                <th field="five_to_seventeen_male" width="50" editor="{type:'validatebox',options:{required:true}}">5-17 M</th>
                <th field="eighteen_to_fifty_nine_female" width="50" editor="{type:'validatebox',options:{required:true}}">18-59 F</th>
                <th field="eighteen_to_fifty_nine_male" width="50" editor="{type:'validatebox',options:{required:true}}">18-59 M</th>
                <th field="sixty_above_female" width="50" editor="{type:'validatebox',options:{required:true}}">60&gt; F</th>
                <th field="sixty_above_male" width="50" editor="{type:'validatebox',options:{required:true}}">60&gt; M</th>
                <th field="total_family_size" width="50" editor="{type:'validatebox',options:{required:true}}">Family Size</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Destroy</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
        <span>ID:</span>
    <input id="id_no" style="line-height:26px;border:1px solid #ccc">
    <span>Name of Beneficiary:</span>
		<input id="name_of_beneficiary" style="line-height:26px;border:1px solid #ccc">
        <span>Project No.:</span>
		<input id="project_number" style="line-height:26px;border:1px solid #ccc">
    <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>
	</div>
	
</body>
</html>