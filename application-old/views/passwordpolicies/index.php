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
							<a href="<?php echo base_url() ?>passwordpolicies">passwordpolicies</a>
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
						<a href="<?php echo base_url() ?>index.php/passwordpolicies/add" class="btn btn-primary btn--icon"><i class="fa fa-plus"></i>Add</a>
					</p>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						passwordpolicies
					</h3>
				</div>
				<div class="box-content nopadding">
<table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="" data-column_filter_dateformat="yyyy-mm-dd"  data-nosort="0" data-checkall="all">
<thead>
<tr>
<th class='with-checkbox'>
<input type="checkbox" name="check_all" class="dataTable-checkall">
</th>
<th>Id</th>
<th>Max login attempts</th>
<th>Login attempts counted within</th>
<th>Lock account after attempts</th>
<th>Blacklist ip after attempts</th>
<th>Password life</th>
<th>Notification period</th>
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
<td><?php echo $row->max_login_attempts; ?></td>
<td><?php echo $row->login_attempts_counted_within; ?></td>
<td><?php echo $row->lock_account_after_attempts; ?></td>
<td><?php echo $row->blacklist_ip_after_attempts; ?></td>
<td><?php echo $row->password_life; ?></td>
<td><?php echo $row->notification_period; ?></td>
<td><a href="<?php echo base_url() ?>passwordpolicies/edit/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Edit">

			<i class="fa fa-edit"></i>
</a>
<a href="<?php echo base_url() ?>passwordpolicies/delete/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Delete">

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
