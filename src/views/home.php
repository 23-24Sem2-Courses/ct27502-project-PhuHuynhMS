<?php

define('TITLE', 'Jupiter');

include_once __DIR__ . '/../partials/header.php';

?>

<body>
  <?php include_once __DIR__ . '/../partials/navbar.php' ?>

  <div class="container-xxl">
    <div class="row">
      <!-- Danh mục -->
      <article class="col-2 categories">
        <h3 class="category-heading">Danh mục</h3>
        <ul class="category-links">
          <li>
            <a href="#">Sách văn học</a>
          </li>
          <li>
            <a href="#">Sách kinh tế</a>
          </li>
          <li>
            <a href="#">Sách thiếu nhi</a>
          </li>
          <li>
            <a href="#">Sách kỹ năng sống</a>
          </li>
          <li>
            <a href="#">Sách bà mẹ - em bé</a>
          </li>
          <li>
            <a href="#">Sách giáo khoa - giáo trình</a>
          </li>
          <li>
            <a href="#">Sách học ngoại ngữ</a>
          </li>
          <li>
            <a href="#">Từ điển </a>
          </li>
          <li>
            <a href="#">Sách đời sống - xã hội</a>
          </li>
          <li>
            <a href="#">Sách dạy nấu ăn</a>
          </li>
          <li>
            <a href="#">Sách tôn giáo - tâm linh</a>
          </li>
          <li>
            <a href="#">Sách về doanh nhân</a>
          </li>
          <li>
            <a href="#">Sách kiến thức tổng hợp</a>
          </li>
          <li>
            <a href="#">Sách lịch sử</a>
          </li>
          <li>
            <a href="#">Sách y học</a>
          </li>
          <li>
            <a href="#">Sách công nghệ thông tin</a>
          </li>
          <li>
            <a href="#">Sách pháp lý</a>
          </li>
          <li>
            <a href="#">Sách về điện ảnh</a>
          </li>
          <li>
            <a href="#">Truyện tranh, manga, comic</a>
          </li>
          <li>
            <a href="#">Sách tiểu thuyết</a>
          </li>
        </ul>
      </article>
      <!-- Products -->
      <div class="items-container col d-flex flex-wrap  align-content-start">
        <?= $not_found ?? '' ?>
        <?php if (isset($books))
          foreach ($books as $book) :
        ?>
          <a href="/product/detail/id=<?= $book['id_book'] ?>">
            <div class="item card" style="width: 18rem;">
              <img src="<?= './uploads/' . $book['image'] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <p class="price"><?= number_format($book['price'], thousands_separator: ',') ?? '' ?> <sup>₫</sup></p>
                <p class="card-text"><?= htmlspecialchars($book['author']) ?? '' ?></p>
                <p class="book_name"><?= htmlspecialchars($book['book_name']) ?? '' ?></p>
                <p class="quantity-sold">Đã bán
                  <?= thousandsCurrencyFormat($book['quantity_sold']) ?></p>
              </div>
            </div>
          </a>
        <?php endforeach ?>
      </div>
    </div>
  </div>

  <?php
  include_once __DIR__ . '/../partials/footer.php';
  include_once __DIR__ . '/../partials/foot.php';
  ?>