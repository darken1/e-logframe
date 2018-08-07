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
							<a href="<?php echo base_url() ?>beneficiaryregistration">beneficiaryregistration</a>
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
						<a href="<?php echo base_url() ?>index.php/beneficiaryregistration/add" class="btn btn-primary btn--icon"><i class="fa fa-plus"></i>Add</a>
					</p>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-12">
				<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>
						beneficiaryregistration
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
<th>Id no</th>
<th>Name of beneficiary</th>
<th>Mothers name</th>
<th>Next of kin</th>
<th>Sex</th>
<th>District</th>
<th>Settlement</th>
<th>Telephone number</th>
<th>Zero to four female</th>
<th>Zero to four male</th>
<th>Five to seventeen female</th>
<th>Five to seventeen male</th>
<th>Eighteen to fifty nine female</th>
<th>Eighteen to fifty nine male</th>
<th>Sixty above female</th>
<th>Sixty above male</th>
<th>Total family size</th>
<th>Programme area</th>
<th>Donor</th>
<th>Registration month</th>
<th>Registration date</th>
<th>Project number</th>
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
<td><?php echo $row->id_no; ?></td>
<td><?php echo $row->name_of_beneficiary; ?></td>
<td><?php echo $row->mothers_name; ?></td>
<td><?php echo $row->next_of_kin; ?></td>
<td><?php echo $row->sex; ?></td>
<td><?php echo $row->district; ?></td>
<td><?php echo $row->settlement; ?></td>
<td><?php echo $row->telephone_number; ?></td>
<td><?php echo $row->zero_to_four_female; ?></td>
<td><?php echo $row->zero_to_four_male; ?></td>
<td><?php echo $row->five_to_seventeen_female; ?></td>
<td><?php echo $row->five_to_seventeen_male; ?></td>
<td><?php echo $row->eighteen_to_fifty_nine_female; ?></td>
<td><?php echo $row->eighteen_to_fifty_nine_male; ?></td>
<td><?php echo $row->sixty_above_female; ?></td>
<td><?php echo $row->sixty_above_male; ?></td>
<td><?php echo $row->total_family_size; ?></td>
<td><?php echo $row->programme_area; ?></td>
<td><?php echo $row->donor; ?></td>
<td><?php echo $row->registration_month; ?></td>
<td><?php echo $row->registration_date; ?></td>
<td><?php echo $row->project_number; ?></td>
<td><a href="<?php echo base_url() ?>beneficiaryregistration/edit/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Edit">

			<i class="fa fa-edit"></i>
</a>
<a href="<?php echo base_url() ?>beneficiaryregistration/delete/<?php echo $row->id; ?>" class="btn" rel="tooltip" title="Delete" onClick="return confirm('Are you sure you want to delete? This action is not reversable')">

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
