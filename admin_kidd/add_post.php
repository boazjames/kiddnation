<?php session_start(); ?>
<?php if (isset($_SESSION['ua_id'])) : ?>
    <?php
    include '../config/config.php';
    include '../libraries/Database.php';
    include '../helpers/format_helper.php';
    $db = new Database();
    date_default_timezone_set("Africa/Nairobi");
    if (isset($_POST['submit'])) {
        $check = getimagesize($_FILES["post_image"]["tmp_name"]);
        $target_file = basename($_FILES["post_image"]["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if ($_FILES["post_image"]["size"] > 2000000) {
            header("Location: ./add_post.php?large");
        } elseif ($check == false) {
            header("Location: ./add_post.php?notImg");
        } elseif ($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG") {
            header("Location: ./add_post.php?notExt");
        } else {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            $category = mysqli_real_escape_string($db->link, $_POST['category']);
            $author = mysqli_real_escape_string($db->link, $_POST['author']);
            $author_id = mysqli_real_escape_string($db->link, $_POST['author_id']);
            //$tags= mysqli_real_escape_string($db->link,$_POST['tags']);

            $date = date('Y-m-d H:i:s');
            $v1 = rand(1111, 9999);
            $v2 = rand(1111, 9999);
            $v3 = $v1 . $v2;
            $fnm = $_FILES['post_image']['name'];
            $ds_t = "../post_images/KiddNation254_" . $v3 . $fnm;
            $fnm = "KiddNation254_" . $v3 . $fnm;

            if (empty($title) || empty($body) || empty($body)) {
                header("Location: ./add_post.php?err");
                exit();
            } elseif(move_uploaded_file($_FILES['post_image']['tmp_name'], $ds_t)) {
                $query = "INSERT INTO posts(category, title, body, author, time, post_image, author_id) VALUES ('$category','$title','$body','$author','$date','$fnm','$author_id')";
                $insert_row = $db->insert($query);
                header("Location: ./posts.php?added");
            }

        }
    }
    ?>
    <?php

    $query = "SELECT * FROM categories";
    $categories = $db->select($query);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Area | Add Post</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><strong>KiddNation254</strong></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Dashboard</a></li>
                    <li class="active"><a href="add_post.php">Add Post</a></li>
                    <li><a href="add_category.php">Add Category</a></li>
                    <li><a href="add_video.php">Add Video</a></li>
                    <li><a href="../blog.php">Visit Blog</a></li>
                    <li><a href="../index.php">Visit Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a>Welcome, <?php echo $_SESSION['ua_uid']; ?></a></li>
                    <li>
                        <form method="post" action="logout.php">
                            <button class="btn btn-danger" name="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Add Post</h1>
                </div>

            </div>
        </div>
    </header>
    <div class="container" id="add">
        <form role="form" method="post" action="add_post.php" enctype="multipart/form-data">
            <div class="form-group">
                <label>Post Title</label>
                <input name="title" type="text" class="form-control" placeholder="Enter Title" required>
            </div>
            <div class="form-group">
                <label>Post Body</label>
                <textarea name="body" class="form-control" placeholder="Enter Post Body" required></textarea>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category" class="form-control">
                    <?php while ($row = $categories->fetch_assoc()) : ?>
                        <?php if ($row['id'] == $post['category']) {
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }
                        ?>
                        <option <?php echo $selected; ?>
                                value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="hidden">
                <input name="author" type="text" value="<?php echo $_SESSION['ua_uid'] ?>">
            </div>
            <div class="hidden">
                <input name="author_id" type="text" value="<?php echo $_SESSION['ua_id'] ?>">
            </div>
            <div class="form-group">
                <label>Post Image</label>
                <input type="file" class="hidden" name="post_image" id="image" required>
                <br>
                <label for="image" id="label-for-image" class="label"><i class="fa fa-upload"></i> <span>Choose an image file...</span>
                </label>
                <br>
                <img src="#" alt="" id="preview" class="preview">
            </div>
            <div class="alert alert-danger"></div>
            <div>
                <input type="submit" name="submit" class="btn btn-success" value="submit">
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
            <br>
        </form>
    </div>

    <footer id="footer">
        <p>Copyright KiddNation254, &COPY; <?php echo date('Y'); ?></p>
    </footer>

    <!-- Modals -->


    <?php if (isset($_GET['large'])) : ?>
        <script>
            alert('Sorry, image size must be less than 2mb')
        </script>
    <?php endif; ?>
    <?php if (isset($_GET['notImg'])) : ?>
        <script>
            alert('File is not an image.')
        </script>
    <?php endif; ?>
    <?php if (isset($_GET['notExt'])) : ?>
        <script>
            alert('Sorry, only JPG, JPEG or PNG files are allowed.')
        </script>
    <?php endif; ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>
    </html>
<?php else : ?>
    <?php
    header("Location: http://localhost/kiddnation/admin_kidd/login.php");
    ?>
<?php endif; ?>
