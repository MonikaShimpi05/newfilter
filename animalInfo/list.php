<?php 
include "config/db.php";

//write the query to get data from users table

$sql = "SELECT * FROM animallist";

//execute the query

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>List</title>
    <link rel="stylesheet" type="text/css" href="css//bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        
    </style>
</head>
<body>
<section class="py-5">
   <div class="container">
       <div class="row-justify-content-center">
           <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                            <h3 style="text-align:left; font-weight:bold; ">Filter List</h3>
                    </div>
                    <div class="card-body">
                       <form action="" method="POST"  enctype = "multipart/form-data">
                           <div class="row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Catagory:</label>
                                        <div class="col-lg-5">
                                            <input type="radio" name="catagory" value="herbivores">&nbsp;herbivores &nbsp;&nbsp;
                                            <input type="radio" name="catagory" value="omnivores">&nbsp;omnivores &nbsp;&nbsp;
                                            <input type="radio" name="catagory" value="carnivores">&nbsp;carnivores 
                                        </div>
                                </div>
                        
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Life Expectancy</label>
                                        <div class="col-lg-4">
                                            <select name="lifeexpectancy" class="form-control">
                                                <option>--Select Life Expectancy--</option>
                                                    
                                                    <option value="0-1 year">0-1 year</option>
                                                    <option value="1-5 year">1-2 year</option>
                                                    <option value="5-10 year">5-10 year</option>
                                                    
                                            </select>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>
                                            <div class="col-lg-4">
                                                <input type="submit" name="filter" value="FILTER"class="btn btn-primary">   
                                            </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>
                                            <div class="col-lg-4">
                                                <a href="submition.php"> <h4><- Add animal name</h4>
                                                </a>
                                             </div>
                                    </div>  
                                
                                </div>
                            </div>
                        </form >
                    </div>
                </div>
                <?php
                include "config/db.php";

                //write the query to get data from users table
                
                $sql = "SELECT * FROM animallist";
                
                //execute the query
                
                $result = $conn->query($sql);
                
                if(isset($_POST['filter']))
                {
                    
                    @$catagory=$_POST['catagory'];
                    $lifeexpectancy=$_POST['lifeexpectancy'];
                

                    if($catagory!="" || $lifeexpectancy!=""|| $destinationfile!=""){
                        $query="SELECT * FROM animallist where catagory='$catagory' and lifeexpectancy='$lifeexpectancy'";
                        $result=mysqli_query($conn,$query)or die('error');

                    }
                }
                ?>
                <div class="card-mt-3">
                    <div class="card-body">
                        <h3> Animal List</h3>
                        <hr>
                        <table class="table table-striped table-hover" >
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Animal Name</th>
                                <th>Catagory</th>
                                <th>Life Expectancy</th>
                                <th>Description</th>
                                <th>Image</th>
                                </tr>
                            </thead>
                            <?php
                                if($result->num_rows > 0) {
                                    //output data of each row
                                    while ($row = $result->fetch_assoc()) {
                            ?>

                                        <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['catagory']; ?></td>
                                        <td><?php echo $row['lifeexpectancy']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td><img src="<?php echo $row['file'];?>"></td>
                                        </tr>	
                                        
                            <?php		}
                                }
                                else{
                        
                            ?>
                            <tr>
                                <td> Record not found</td>
                            </tr>
                            <?php
                                }
                            ?>
                            </tbody>

                            <tbody>	

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
</body>
</html>