<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>php-id-w10</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="bootstrap/js/html5shiv.min.js"></script>
            <script src="bootstrap/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>        
        <div class="container">
            <div class="row"> 
                <div class="jumbotron" style="background-color: cornflowerblue;">
                    <?php include 'topbanner.php';?>
                </div>
            </div>
            <div class="row">
                <?php include 'menu.php';?>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <p>Login Area</p>
                </div>  
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <h4>แก้ไขข้อมูลนักศึกษา</h4>
                    <?php
                        $std_id = $_REQUEST['std_id'];
                        if(isset($_GET['submit'])){
                            $std_id = $_GET['std_id'];
                            $std_ttl_id = $_GET['std_ttl_id'];
                            $std_fname = $_GET['std_fname'];
                            $std_lname = $_GET['std_lname'];
                            $sql = "update student set ";
                            $sql .= "std_fname='$std_fname',std_lname='$std_lname',std_ttl_id='$std_ttl_id' ";
                            $sql .="where std_id='$std_id' ";
                            include 'connectdb.php';
                            mysqli_query($conn,$sql);
                            mysqli_close($conn);
                            echo "แก้ไขข้อมูลนักศึกษา $std_fname $std_lname เรียบร้อยแล้ว<br>";
                            echo '<a href="project_student.php">แสดงรายชื่อนักศึกษาทั้งหมด</a>';
                        }else{
                            include 'connectdb.php';
                            $sql2 = "select * from student where std_id='$std_id'";
                            $result2 = mysqli_query($conn,$sql2);
                            $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
                            $fstd_fname = $row2['std_fname'];
                            $fstd_lname = $row2['std_lname'];
                            $fstd_ttl_id = $row2['std_ttl_id'];
                    ?>
                    <form class="form-horizontal" role="form" name="student_edit" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="form-group">
                            <input type="hidden" name="std_id" id="std_id" value="<?php echo "$std_id";?>">
                            <div class="col-md-10 col-lg-10">
                            <label for="std_ttl_id" class="col-md-2 col-lg-2 control-label">คำนำหน้าชื่อ</label>
                                <select name="std_ttl_id" id="std_ttl_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql =  "SELECT * FROM title order by ttl_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['ttl_id'].'"';
                                        if($row['ttl_id']==$fstd_ttl_id){
                                            echo ' selected="selected" ';
                                        }
                                        echo ">";
                                        echo $row['ttl_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>    
                        </div>
                        <div class="form-group">
                            <label for="std_fname" class="col-md-2 col-lg-2 control-label">ชื่อ</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="std_fname" id="std_fname" class="form-control" 
                                       value="<?php echo $fstd_fname;?>">
                            </div>    
                        </div>    
                        <div class="form-group">
                            <label for="std_lname" class="col-md-2 col-lg-2 control-label">นามสกุล</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="std_lname" id="std_lname" class="form-control" 
                                       value="<?php echo $fstd_lname;?>">
                            </div>    
                        </div> 
                        <div class="form-group">
                            <div class="col-md-10 col-lg-10">
                                <input type="submit" name="submit" value="ตกลง" class="btn btn-default">
                            </div>    
                        </div> 
                    </form>
                    <?php
                        }
                    ?>
                </div>    
            </div>
            <div class="row">
                <address>คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ</address>
            </div>
        </div>    
    </body>
</html>