<nav>
    <div class="nav-center">
        <div class="nav-header">
            <img class="nav-img me-3" src="/uploads/Capture.PNG" width="250px" height="120px">
            <button class="search-btn-sm">
                <i class="fa fa-search"></i>
            </button>
            <button class="nav-toggle">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <div>
            <form action="/" method="get">
                <div class="searchbar">
                    <input type="text" class="search" name="searchKey" placeholder="Tìm kiếm" value="<?= htmlspecialchars($_GET['searchKey'] ?? '') ?>">
                    <button type="submit" class="search-btn-lg show-searchBtn">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <ul class="social-icons">
            <li>
                <a href="/">
                    <i class="fa fa-home"></i>
                    Trang chủ
                </a>
            </li>
            <li>
                <?php if (isset($_SESSION['logged_in'])) : ?>
                    <a href="/customer/profile">
                        <i class="fas fa-user"></i>
                        Thông tin tài khoản
                    </a>
                <?php else : ?>
                    <a href="/login">
                        <i class="fas fa-user"></i>
                        Tài khoản
                    </a>
                <?php endif ?>
            </li>
            <li>
                <a href="/checkout/cart">
                    <i class="fas fa-shopping-cart"></i>
                    Giỏ hàng
                </a>
            </li>
            <?php if (isset($_SESSION['logged_in'])) : ?>
                <li>
                    <a href="/customer/logout" class="text-danger sign-out">
                        <i class='fas fa-sign-out-alt'></i>
                    </a>
                </li>
            <?php
            endif
            ?>
        </ul>
    </div>
</nav>