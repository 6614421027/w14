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
                    <h4>แก้ไขข้อมูลผู้สอน</h4>
                    <?php
                        $lct_id = $_REQUEST['lct_id'];
                        if(isset($_GET['submit'])){
                            $lct_id = $_GET['lct_id'];
                            $lct_ttl_id = $_GET['lct_ttl_id'];
                            $lct_fname = $_GET['lct_fname'];
                            $lct_lname = $_GET['lct_lname'];
                            $sql = "update lecturer set ";
                            $sql .= "lct_fname='$lct_fname',lct_lname='$lct_lname',lct_ttl_id='$lct_ttl_id' ";
                            $sql .="where lct_id='$lct_id' ";
                            include 'connectdb.php';
                            mysqli_query($conn,$sql);
                            mysqli_close($conn);
                            echo "แก้ไขข้อมูลอาจารย์ $lct_fname $lct_lname เรียบร้อยแล้ว<br>";
                            echo '<a href="lecturer_list.php">แสดงรายชื่ออาจารย์ทั้งหมด</a>';
                        }else{
                            include 'connectdb.php';
                            $sql2 = "select * from lecturer where lct_id='$lct_id'";
                            $result2 = mysqli_query($conn,$sql2);
                            $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
                            $flct_fname = $row2['lct_fname'];
                            $flct_lname = $row2['lct_lname'];
                            $flct_ttl_id = $row2['lct_ttl_id'];
                    ?>
                    <form class="form-horizontal" role="form" name="lecturer_edit" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="form-group">
                            <input type="hidden" name="lct_id" id="lct_id" value="<?php echo "$lct_id";?>">
                            <div class="col-md-10 col-lg-10">
                            <label for="lct_ttl_id" class="col-md-2 col-lg-2 control-label">คำนำหน้าชื่อ</label>
                                <select name="lct_ttl_id" id="lct_ttl_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql =  "SELECT * FROM title order by ttl_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['ttl_id'].'"';
                                        if($row['ttl_id']==$flct_ttl_id){
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
                            <label for="lct_fname" class="col-md-2 col-lg-2 control-label">ชื่อ</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="lct_fname" id="lct_fname" class="form-control" 
                                       value="<?php echo $flct_fname;?>">
                            </div>    
                        </div>    
                        <div class="form-group">
                            <label for="lct_lname" class="col-md-2 col-lg-2 control-label">นามสกุล</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="lct_lname" id="lct_lname" class="form-control" 
                                       value="<?php echo $flct_lname;?>">
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