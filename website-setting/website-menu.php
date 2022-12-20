 
<br><br>
<div class="content-box">
<?php


if($_GET['subcat']=='add-website-menu'){
?>
<?php
if(!empty($_GET['edit'])){

   $editId= $_GET['edit'];
   $query="SELECT * FROM categories WHERE id=$editId";
   $res= $conn->query($query);
   $catD=$res->fetch_assoc();
   $catName=$catD['category_name'];
   $catDesc=$catD['description'];
   $menuLink=$catD['menu_link'];
   $upId=$catD['id'];
   $idAttr="updateForm";
   
}else{
  $menuLink='';
  $catName='';
   $catDesc='';
   $upId='';
   $editId='';
    $idAttr="adminForm";
}

?>



 <!----================form section start===============-->
  <div class="row">
    <div class="col">
      <h4>Website Menu</h4>
    </div>
    <div class="col text-right">
      <a href="dashboard.php?cat=website-setting&subcat=website-menu" class="btn btn-secondary content-link"> View</a>
    </div>
  </div>
  <br>
<form method="post" id="<?php echo $idAttr; ?>" name="categories" rel="<?php echo $upId; ?>">

<div class="row">
  <div class="col">
    <div class="form-group">
      <input type="checkbox" checked value="1" name="header_menu"> Header Menu 
    </div>
  </div>
  <div class="col">
    <div class="form-group">
      <input type="checkbox" value="1" name="footer_menu"> Footer Menu 
    </div>
  </div>
</div>

  <div class="row">
     <div class="col">
        <div class="form-group">
<label> category</label>
<select name="parent_id" class="form-control">
  <option value="0">No Parent Category</option>
 <?php 
  foreach ($catData as $cat) {
 ?>
<option value="<?php echo $cat['id']; ?>"><?php echo $cat['category_name']; ?></option>    
 <?php 
 if( ! empty($cat['nested_categories'])){
     echo display_option($cat['nested_categories'], '__');
 } 
}
 ?>    
</select>
</div>
     </div>
        <div class="col">
      <div class="form-group">
<label>Menu Link</label>
<input type="text" placeholder="Enter Menu Link" name="menu_link" value="<?php echo $menuLink; ?>" required class="form-control"> 
</div>
     </div>
     <div class="col">
      <div class="form-group">
<label>Subcategory Category</label>
<input type="text" placeholder="Enter Full Name" name="category_name" value="<?php echo $catName; ?>" required class="form-control"> 
</div>
     </div>
  </div>

   <div class="row">
    <div class="col">

<div class="form-group">
<label>Description</label>
<textarea placeholder="Description" name="description" required class="form-control"> 
  <?php 
   echo $catDesc;
  ?>
</textarea>
</div>

<div class="form-group">
<button type="submit" class="btn btn-secondary">Save</button>
</div>

   
  
</div>


</div>
</form>
 <!----================form section end===============-->
<?php
// =========view===========//
}else if(!empty($_GET['view'])){?>


 <!-----=================table content start=================-->
 <div class="row">
  <div class="col">
    <?php
   $id= $_GET['view'];
   $query="SELECT parent_id, menu_link, id, category_name FROM categories WHERE id=$id AND header_menu=1";
   $res= $conn->query($query);
   $catName=$res->fetch_assoc();
   $backId=$catName['parent_id'];
   if(!isset($backId))
   {
  $view='';
   }else{
    $view="&view=".$backId;
   }
   echo "<h4>Menu - ".$catName['category_name']."</h4>";
   echo "<p>Menu Link- ".$catName['menu_link']."</p>";


 ?>
  </div>
  <div class="col text-right">
     <a href="dashboard.php?cat=website-setting&subcat=website-menu<?php echo $view; ?>" class="btn btn-secondary content-link"> Main Menu</a>
  </div>
 
 </div>
  
  
  <br>
  <div class="row">
    <div class="col">
  <div class="table-responsive">
    <table class="table">
      <tr>
        <th>S.N</th>
        <th>Submenu</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      <?php
      $sql1="SELECT id, category_name FROM categories WHERE parent_id=".$catName['id']." AND header_menu=1";
      $res1= $conn->query($sql1);
      if($res1->num_rows>0)
      {
        $i=1;
       while($arr1=$res1->fetch_assoc())
       {


      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $arr1['category_name']; ?></td>
        <td><a  href="dashboard.php?cat=website-setting&subcat=website-menu&view=<?php echo $arr1['id']; ?>" class="text-secondary content-link"><i class='far fa-eye'></i></a></td>
        <td><a href="dashboard.php?cat=website-setting&subcat=add-website-menu&edit=<?php echo $arr1['id']; ?>" class="text-success content-link"><i class=' far fa-edit'></i></a></td>
        <td><a href="javascript:void(0)" class="text-danger delete" menu="header_menu" name="categories" id="<?php echo $arr1['id']; ?>"><i class='far fa-trash-alt'></i></a></td>
      </tr>
      <?php $i++;}}else{?>
        <tr><td colspan="5" class="text-center">No Submenu Found</td></tr>
      <?php }?>
    </table>
  </div>
</div>
</div>

  <!-----==================table content end===================-->
<?php
// =========view===========//
}else{
  ?>
  <!-----=================table content start=================-->
  
 <style type="text/css">
  .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 700px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #4d4dff;
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
    border-bottom: 15px solid #fff;
}.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
</style>
<div class="row">
    <div class="col">
      <h4>Sing_Up Menu</h4>
    </div>
    <div class="col text-right">
      
    </div>
  </div>
 <br>
 <table class="styled-table" style="">
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
<br>
<br>
<hr>  

  <!-----==================table content end===================-->
  <?php
  
}
?>

</div>
