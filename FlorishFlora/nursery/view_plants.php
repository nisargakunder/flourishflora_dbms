<h1 class="text-center text-success">All Plants</h1>
<table class="table table-bordered-mt-5">
<thead class="bg-success">
<tr>
    <th>ID</th> 
    <th>Plant Name</th> 
    <th>Image</th>
    <th>Description</th>
    <th>Nursery</th>
    <th>Price</th> 
    <th>Stocks</th> 
    <th>Sold</th>
    <th>Edit</th> 
    <th>Delete</th>   
</tr>
</thead>
<tbody class="bg-transparent text-dark">
<?php 

$nursery=$_SESSION['name'];
$get_plants="select * from plants where n_name='$nursery'";
$results=mysqli_query($con,$get_plants);
while($row=mysqli_fetch_assoc($results))
{
    $plant_id=$row['plant_id'];
    $plant_name=$row['plant_name'];
    $plant_image=$row['image'];
    $price=$row['price'];
    $nursery=$row['n_name'];
    $stocks=$row['stocks'];
    $desc=$row['plant_desc'];

?>
    <tr class='text-center'>
    <td><?php echo $plant_id;?></td>
    <td><?php echo $plant_name;?></td>
    <td><img src='img/<?php echo $plant_image;?>' class='product_img'></td>
    <td><?php echo $desc; ?></td>
    <td><?php echo $nursery;?></td>
    <td><?php echo $price;?></td>
    <td><?php echo $stocks;?></td>
    <td><?php 
    $get_count="select * from orders where plant_id=$plant_id ";
    $result_count=mysqli_query($con,$get_count);
    $sold=mysqli_num_rows($result_count);
    echo $sold;
    ?>
    </td>
    <td><a href='index.php?edit_plants=<?php echo $plant_id ?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
    <td><a href='index.php?remove_plants=<?php echo $plant_id ?>' class='text-dark'><i class='fa-solid fa-trash'></i></a></td></tr>
   <?php 
}
?>
</tr>
</tbody>
</table>

