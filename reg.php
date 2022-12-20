<style type="text/css">
	.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
</style>
<table class="styled-table">
	<thead>
	  <th>ID</th>
		<th>Name</th>
		<th>Email-ID</th>
		<th>Password</th>
		<th>Mobile</th>
		<th>Gender</th>
		<th>State</th>
		<th>City</th>
		<th>Address</th>
	</thead>
	<tbody>
	<?php
		include('conn.php');
		$query = mysqli_query($conn,"SELECT * FROM `reg`");
		$id=1;
		while($row=mysqli_fetch_array($query)){
			?>
			<tr >
	            <td><?php echo $id++; ?></td>
				<td><?php echo ucwords($row['name']); ?></td>
				<td><?php echo ucwords($row['email']); ?></td>
				<td><?php echo $row['password']; ?></td>
				<td><?php echo $row['mobile']; ?></td>
				<td><?php echo $row['gender']; ?></td>
				<td><?php echo $row['state']; ?></td>
				<td><?php echo $row['city']; ?></td>
				<td><?php echo $row['address']; ?></td>
			</tr>
			<?php
		}
	?>
	</tbody>
</table>