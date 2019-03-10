<?php require_once '../Include/Sessions.php';?>
<?php require_once '../Include/commonFuncs.php'?>
<?php require_once '../Include/dbFunctions.php'?>

<?php adminRequired();?>
<?php require_once '../utils/admin_c.php'?>

<!DOCTYPE html>
<html>

<head>
  <title>Manage Admin</title>
  <script src="../js-scripts/jquery-3.2.1.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../js-scripts/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../js-scripts/Assets/style.css">
  <script type="text/javascript" src="../js-scripts/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="heading">
    <a href="">
      <p>Visit Blog</p>
    </a>
  </div>
  <div class="container-fluid">
    <div class="main">
      <div class="row">
        <div class="col-sm-2">
          <ul id="side-menu" class="nav nav-pills nav-stacked">
            <li class=""><a href="Dashboard.php">
                <span class="glyphicon glyphicon-th"></span>
                &nbsp;Dashboard</a></li>
            <li><a href="NewPost.php">
                <span class="glyphicon glyphicon-list"></span>
                &nbsp;New Post</a></li>
            <li class="active"><a href="Admin.php">
                <span class="glyphicon glyphicon-user"></span>
                &nbsp;Manage Admin</a></li>
            <li><a href="Blog.php">
                <span class="glyphicon glyphicon-equalizer"></span>
                &nbsp;Live Blog</a></li>
            <li><a href="Lagout.php">
                <span class="glyphicon glyphicon-log-out"></span>
                &nbsp;Lagout</a></li>
          </ul>
        </div>
        <div class="col-xs-10" style="min-height: -webkit-fill-available;">
          <div class="page-title">
            <h1>Manage Admin</h1>
          </div>
          <?php echo Message(); ?>
          <?php echo SuccessMessage(); ?>
          <div>
            <div class="row">
              <div class="col-md-12 ">
                <form method="POST" action="Admin.php">
                  <fieldset>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input class="form-control input-md" type="text" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input class="form-control input-md" type="Password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="confirm_password">Re-type Same Password</label>
                      <input class="form-control input-md" type="Password" name="confirm_password"
                        placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                      <input class="form-control btn btn-primary" type="submit" name="submit"
                        value="Register New Admin">
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
            <div id="cat_table">
              <?php
							// TODO: refactor deleteCategory
							echo deleteCategory(); ?>
              <h3>Registered Admins</h3>
              <table class="table table-striped table-hover">
                <tr>
                  <th>Number</th>
                  <th>Date Added</th>
                  <th>Username</th>
                  <th>Added By</th>
                  <th>Action</th>
                </tr>
                <?php
// TODO: add delete

// $num = 1;
// $viewSql = "SELECT * FROM cms_admin ORDER BY date_time DESC";
// $exec = Query($viewSql);
// while($data = mysqli_fetch_assoc($exec)) {
//   $id = $data['id'];
//   $dateAdded = $data['date_time'];
//   $username = $data['username'];
//   $creator = $data['added_by'];
//   echo "<tr>
//     <td>$num</td>
//       <td>$dateAdded</td>
//       <td>$username</td>
//       <td>$creator</td>
//       <td><a href='Admin.php?del_admin=$id'><button class='btn btn-danger'>Delete</button></a></td>
//     </tr>
//   ";
//   $num++;
// }
// mysqli_close($con);
?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="footer">
      <div class="col-sm-12">
        <hr>
        <p>Все права защищены 2019 | Designed by: Dmitry Ermakovich</p>
        <hr>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="../js-scripts/jquery.js"></script>
</body>

</html>