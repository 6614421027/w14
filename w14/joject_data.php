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
                <h2>โครงงาน</h2>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อโครงงาน(ภาษาไทย)</th>
                            <th>ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                            <th>สถานะโครงงาน</th>
                            <th>ประเภท</th>
                            <th>อาจารย์ที่ปรึกษา</th>
                            <th>เครื่องมือ</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'connectdb.php';
                        $prj_id = $_REQUEST['prj_id'];
                        $sql = 'SELECT DISTINCT
                        project.prj_id,
                        project.prj_name_th,
                        project.prj_name_en,
                        project_status.pst_name AS prj_stt_id,
                        project_type.ptt_name AS prj_ptt_id,
                        lecturer.lct_fname,
                        lecturer.lct_lname,
                        title.ttl_name,
                        tools.tls_name
                    FROM
                        project
                    LEFT JOIN project_status ON project.prj_stt_id = project_status.pst_id
                    LEFT JOIN project_type ON project.prj_ppt_id = project_type.ptt_id
                    LEFT JOIN lecturer ON project.prj_lct_id = lecturer.lct_id
                    LEFT JOIN title ON lecturer.lct_ttl_id = title.ttl_id
                    LEFT JOIN project_tools ON project.prj_id = project_tools.pjt_prj_id
                    LEFT JOIN tools ON project_tools.pjt_tls_id = tools.tls_id
                    WHERE
                        project.prj_id =
                    
            ' . $prj_id;
                        $result = mysqli_query($conn, $sql);
                        while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                            echo '<tr>';
                            echo '<td>' . $row['prj_id'] . '</td>';
                            echo '<td>' . $row['prj_name_th'] . '</td>';
                            echo '<td>' . $row['prj_name_en'] . '</td>';
                            echo '<td>' . $row['prj_stt_id'] . '</td>';
                            echo '<td>' . $row['prj_ptt_id'] . '</td>';
                            echo '<td>' . $row['ttl_name'] . ' ' . $row['lct_fname'] . ' ' . $row['lct_lname'] . '</td>';
                            echo '<td>' . $row['tls_name'] . '</td>';
                            echo '</tr>';
                        }
                        mysqli_free_result($result);
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <address>คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ</address>
        </div>
    </div>
</body>

</html>