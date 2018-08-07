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
							<a href="<?php echo base_url() ?>index.php/documents">Documents</a>
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
						<a href="<?php echo base_url() ?>index.php/documents/add" class="btn btn-primary btn--icon"><i class="fa fa-plus"></i>Add</a>
					</p>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						Documents
					</h3>
				</div>
				<div class="box-content nopadding">
<table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="text,select,daterange,null" data-column_filter_dateformat="yy-mm-dd"  data-nosort="0" data-checkall="all">
<thead>
<tr>
<th>Document title</th>
<th>Document category</th>
<th>Date added</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($rows as $key=>$row): ?>
<tr>
<td><?php echo $row->document_title; ?></td>
<td><?php echo $row->category; ?></td>
<td><?php echo $row->date_added; ?></td>
<td><a href="<?php echo base_url() ?>documents/view/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="View">

			<i class="fa fa-search"></i>
</a>
<a href="<?php echo base_url();?>documents/<?php echo $row->file_name?>" target="_blank" class="btn" rel="tooltip" title="Download">

			<i class="fa fa-arrow-circle-down"></i>
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
