
<?php
    include("config/db.php");
    
    $no1=rand(1,100); 
    $no2=rand(1,100);
            
        if(isset($_POST['submit']))
            {
                $name=$_POST['name'];
                @$catagory=$_POST['catagory'];
                $lifeexpectancy=$_POST['lifeexpectancy'];
                $description=$_POST['description'];
                $files=$_FILES['file'];
                
                $filename=$files['name'];
                $fileerror=$files['error'];
                $filetmp=$files['tmp_name'];

                $fileext=explode('.',$filename);
                $filecheck=strtolower(end($fileext));


                $fileextstored=array('png','jpg','jpeng');
                if(in_array($filecheck,$fileextstored)){

                    
                    $destinationfile='upload/'.$filename;
                    move_uploaded_file($filetmp,$destinationfile);
                    $sql = "INSERT INTO `animallist`(`name`, `catagory`, `lifeexpectancy`, `description`,`file`) VALUES ('$name','$catagory','$lifeexpectancy','$description','$destinationfile')";
            
                
                $result = $conn->query($sql);

                if ($result == TRUE) {
                    //echo "New record created successfully.";
                    header('location:list.php');
                }else{
                    echo "Error:". $sql . "<br>". $conn->error;
                }

                $conn->close();

            }
        }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="stylesheet" type="text/css" href="css//bootstrap.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     
    <style>
        body{
            background-image: url("image.jpg");
        }
        label{
            color:white;
        }
    </style>
    <title>Animal Information submition</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<h3 style="text-align:center; font-weight:bold; color:white;">Animal Information</h3>
</nav> 
<div class="navbar-collapse collapse">
</div>   

<div class="container">
    <div class="row">
        <div class="col-lg-3"></div>
           <div class="col-lg-8">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name :</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" class="form-control" placeholder="Name"required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="catagory" >Catagory:</label>
                        <div class="col-lg-7" style="color:white;">
                            <input type="radio" name="catagory" value="herbivores">herbivores &nbsp;&nbsp;
                            <input type="radio" name="catagory" value="omnivores">omnivores &nbsp;&nbsp;
                            <input type="radio" name="catagory" value="carnivores">carnivores
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="expectancy">Life Expectancy</label>
                        <div class="col-lg-6">
                            <select name="lifeexpectancy" class="form-control">
                                <option>--Select Life Expectancy--</option>
                                
                                <option value="0-1 year">0-1 year</option>
                                <option value="1-5 year">1-2 year</option>
                                <option value="5-10 year">5-10 year</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="description">Description</label>
                            <div class="col-lg-7">
                                <textarea name="description" id="description" rows="2" cols="15" value="description" class="form-control"> 
                                </textarea>
                            </div>
                    </div>
           
           
                    <div class="form-group">
                
                        <label  for="file">Upload Image</label>
                        <div class="col-lg-6">
                            <input type="file" name="file" id="file" class="btn btn-primary" class="form-control">   
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="captcha">Captcha:<?php echo $no1."+".$no2;?></label>
                            <div class="col-lg-5">
                                <input type="hidden" name="no1" value="<?php echo $no1?>">
                                <input type="hidden" name="no2" value="<?php echo $no2?>">
                                <input type="text" name="userans" class="form-control" placeholder="Captcha"required>
                               
                            </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-5">
                            <input type="submit" name="submit" class="btn btn-primary">   
                        </div>
                    </div>
                
                </form> 
       </div>
       <div class="col-lg-3"></div>
</div>
</div>
    

<script type="text/javascript" src="css/js/bootstrap.js"></script>
</body>
</html> 
<?php
    if(isset($_REQUEST["submit"]))
    {
        $userans=$_REQUEST["userans"];
        $number1=$_REQUEST["no1"];
        $number2=$_REQUEST["no2"];
        $total=$number1+$number2;
        if($total==$userans)
        {
            echo "you are human";
        }
        else
        {
            echo "you are robot";
        }
    }

?>
                    