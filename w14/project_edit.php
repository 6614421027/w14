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
                <?php include 'topbanner.php'; ?>
            </div>
        </div>
        <div class="row">
            <?php include 'menu.php'; ?>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <p>Login Area</p>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h4>แก้ไขข้อมูลโครงงาน</h4>
                <?php
                $prj_id = $_REQUEST['prj_id'];
                if (isset($_GET['submit'])) {
                    $prj_id = $_REQUEST['prj_id'];
                    $prj_name_th = $_GET['prj_name_th'];
                    $prj_name_en = $_GET['prj_name_en'];
                    $prj_stt_id = $_GET['prj_stt_id'];
                    $prj_ppt_id = $_GET['prj_ppt_id'];
                    $prj_lct_id = $_GET['prj_lct_id'];
                    $sql = "UPDATE project SET ";
                    $sql .= "prj_name_th='$prj_name_th', prj_name_en='$prj_name_en',prj_stt_id='$prj_stt_id', prj_ppt_id='$prj_ppt_id', prj_lct_id='$prj_lct_id'  ";
                    $sql .= "WHERE prj_id='$prj_id'";
                    include 'connectdb.php';
                    mysqli_query($conn, $sql);
                    mysqli_close($conn);
                    echo "แก้ไขข้อมูลโครงงานเรียบร้อยแล้ว<br>";
                    echo '<a href="project_list.php">แสดงโครงงานทั้งหมด</a>';
                } else {
                    include 'connectdb.php';
                    $sql2 = "select * from project where prj_id='$prj_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                    $prj_name_th = $row2['prj_name_th'];
                    $prj_name_en = $row2['prj_name_en'];
                    $prj_stt_id = $row2['prj_stt_id'];
                    $prj_ppt_id = $row2['prj_ppt_id'];
                    $prj_lct_id = $row2['prj_lct_id'];

                    ?>
                    <form class="form-horizontal" role="form" name="project_edit"
                        action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                        <input type="hidden" name="prj_id" id="prj_id" value="<?php echo "$prj_id";?>">
                            <label for="prj_name_th" class="col-md-2 col-lg-2 control-label">ชื่อภาษาไทย</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="prj_name_th" id="prj_name_th" class="form-control"
                                    value="<?php echo $prj_name_th;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="prj_name_en" class="col-md-2 col-lg-2 control-label">ชื่อภาษาอังฤษ</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="prj_name_en" id="prj_name_en" class="form-control"
                                    value="<?php echo $prj_name_en;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="prj_stt_id" class="col-md-2 col-lg-2 control-label">สถานะโครงงาน</label>
                            <div class="col-md-10 col-lg-10">
                                <select name="prj_stt_id" id="prj_stt_id" class="form-control">
                                    <?php
                                    include 'connectdb.php';
                                    $sql = "SELECT * FROM project_status order by pst_id";
                                    $result = mysqli_query($conn, $sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['pst_id'] . '"';
                                        if ($row['pst_id'] == $prj_stt_id) {
                                            echo 'selected=selected';
                                        }
                                        echo ">";
                                        echo $row['pst_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="prj_ptt_id" class="col-md-2 col-lg-2 control-label">ประเภท</label>
                            <div class="col-md-10 col-lg-10">
                                <select name="prj_ppt_id" id="prj_ppt_id" class="form-control">
                                    <?php
                                    include 'connectdb.php';
                                    $sql = 'SELECT * FROM project_type '
                                        . 'order by ptt_id';
                                    $result = mysqli_query($conn, $sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['ptt_id'] . '"';
                                        if ($row['ptt_id'] == $prj_ppt_id) {
                                            echo 'selected=selected';
                                        }
                                        echo ">";
                                        echo $row['ptt_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="prj_lct_id" class="col-md-2 col-lg-2 control-label">อาจารย์ที่ปรึกษา</label>
                            <div class="col-md-10 col-lg-10">
                                <select name="prj_lct_id" id="prj_lct_id" class="form-control">
                                    <?php
                                    include 'connectdb.php';
                                    $sql = 'SELECT * FROM lecturer_detail';

                                    $result = mysqli_query($conn, $sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['lct_id'] . '"';
                                        if ($row['lct_id'] == $prj_lct_id) {
                                            echo 'selected=selected';
                                        }
                                        echo ">";
                                        echo $row['lct_fname'] . $row['lct_lname'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                    ?>
                                </select>
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