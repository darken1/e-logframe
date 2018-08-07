<?php include(APPPATH . 'views/common/head.php'); ?>
		<body>
			<?php include(APPPATH . 'views/common/navigation.php'); ?>
				<div class="container-fluid" id="content">
				<?php include(APPPATH . 'views/common/left.php'); ?>
				<div id="main">
				<div class="container-fluid">
				<?php include(APPPATH . 'views/common/pageheader.php'); ?>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo site_url('home')?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url() ?>index.php/formelements">formelements</a>
						</li>
					</ul>
				<div class="close-bread">
					<a href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-3">
					<p>&nbsp;</p>
					<p>
						<a href="<?php echo base_url() ?>index.php/formelements/add" class="btn btn-primary btn--icon"><i class="fa fa-plus"></i>Add</a>
					</p>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						formelements
					</h3>
				</div>
				<div class="box-content nopadding">
<table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="" data-column_filter_dateformat="yy-mm-dd"  data-nosort="0" data-checkall="all">
<thead>
<tr>
<th class='with-checkbox'>
<input type="checkbox" name="check_all" class="dataTable-checkall">
</th>
<th>Id</th>
<th>Form id</th>
<th>Type</th>
<th>Label</th>
<th>Default value</th>
<th>Tool tip</th>
<th>Size</th>
<th>Max length</th>
<th>Rows</th>
<th>Cols</th>
<th>Custom display format</th>
<th>Folder path</th>
<th>Folder url</th>
<th>Permitted file types</th>
<th>Max file size</th>
<th>Options</th>
<th>Input type</th>
<th>Required</th>
<th>Date time created</th>
<th>Date time modified</th>
<th>Listorder</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($rows->result() as $row): ?>
<tr>
<td class="with-checkbox">
<input type="checkbox" name="check" value="id">
</td>
<td><?php echo $row->id; ?></td>
<td><?php echo $row->form_id; ?></td>
<td><?php echo $row->type; ?></td>
<td><?php echo $row->label; ?></td>
<td><?php echo $row->default_value; ?></td>
<td><?php echo $row->tool_tip; ?></td>
<td><?php echo $row->size; ?></td>
<td><?php echo $row->max_length; ?></td>
<td><?php echo $row->rows; ?></td>
<td><?php echo $row->cols; ?></td>
<td><?php echo $row->custom_display_format; ?></td>
<td><?php echo $row->folder_path; ?></td>
<td><?php echo $row->folder_url; ?></td>
<td><?php echo $row->permitted_file_types; ?></td>
<td><?php echo $row->max_file_size; ?></td>
<td><?php echo $row->options; ?></td>
<td><?php echo $row->input_type; ?></td>
<td><?php echo $row->required; ?></td>
<td><?php echo $row->date_time_created; ?></td>
<td><?php echo $row->date_time_modified; ?></td>
<td><?php echo $row->listorder; ?></td>
<td><a href="<?php echo base_url() ?>index.php/formelements/edit/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Edit">

			<i class="fa fa-edit"></i>
</a>
<a href="<?php echo base_url() ?>index.php/formelements/delete/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Delete" onClick="return confirm('Are you sure you want to delete? This action is not reversable')">

			<i class="fa fa-times"></i>
</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
	</body>
</html>
