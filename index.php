<?php 

session_start();
if (isset($_SESSION["nickName"])) // 判斷登入與否
  $nickName = $_SESSION["nickName"];
else 
  $nickName = "Guest"; // session中沒有使用者名稱即為Guest

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>plain-B 首頁</title>
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/bootstrap.min.js"></script>

</head>

<body>

    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">

            <nav class="classy-navbar" id="essenceNav">
                <a class="nav-brand" href="index.php"><img src="img/core-img/logo_plainB.png" alt=""></a>
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"></span>
                </div>
                <div class="classy-menu">
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <div class="classynav">
                        <ul>
                            <li><a href="index.php">首頁</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="header-meta d-flex clearfix justify-content-end">
                <div class="search-area">
                    <div style="float: right;">
                        <div class="user-login-info">
                            <a href="register.php">註冊</a>
                        </div>
                    </div>
                    <div style="float: right;">
                        <div class="user-login-info">
                            <?php if ($nickName == "Guest") { ?>
                            <a href="login.php">登入</a>
                            <?php } else { ?>
                            <a href="login.php?logout=1">登出</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div style="margin: 30px 8px 20px 6px;border-top:1px dotted #C0C0C0;"></div>

    <h2 style="margin-left: 70px">Hi! <?= $nickName ?> , 祝您有美好的一天</h2>

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Catagories</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">
                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#clothing">
                                        <a href="#">clothing</a>
                                        <ul class="sub-menu collapse show" id="clothing">
                                            <li><a href="#">全部</a></li>
                                            <li><a href="#">上衣</a></li>
                                            <li><a href="#">褲子</a></li>
                                        </ul>
                                    </li>
                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#shoes" class="collapsed">
                                        <a href="#">shoes</a>
                                        <ul class="sub-menu collapse" id="shoes">
                                            <li><a href="#">全部</a></li>
                                            <li><a href="#">運動鞋</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget brands mb-50">
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Brands</p>
                            <div class="widget-desc">
                                <ul>
                                    <li><a href="#">Plain-Me</a></li>
                                    <li><a href="#">New Balance</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span>?</span> products found</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="img/productImage/cop1181_1_00001.jpg" alt="">

                                        <!-- Product Badge -->
                                        <div class="product-badge offer-badge">
                                            <span>-30%</span>
                                        </div>
                                        <!-- Favourite -->
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price"><span class="old-price">$75.00</span> $55.00</p>

                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                            <!-- Add to Cart -->
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="img/productImage/96AC2327C3-SP-7897674.jpg" alt="">
                                        

                                        <!-- Favourite -->
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>

                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                            <!-- Add to Cart -->
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="img/productImage/1616_LOKA.jpg" alt="">
                                        <!-- Hover Thumb -->
                                        <img class="hover-img" src="img/product-img/product-4.jpg" alt="">

                                        <!-- Product Badge -->
                                        <div class="product-badge new-badge">
                                            <span>New</span>
                                        </div>

                                        <!-- Favourite -->
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>

                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                            <!-- Add to Cart -->
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="img/productImage/p0254186413127-item-f6daxf4x0800x0800-m.jpg" alt="">
                                        

                                        <!-- Favourite -->
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>

                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                            <!-- Add to Cart -->
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->


    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/classy-nav.min.js"></script>
    <script src="js/active.js"></script>

</body>

</html>