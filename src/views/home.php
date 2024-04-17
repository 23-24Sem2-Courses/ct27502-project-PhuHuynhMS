<?php

define('TITLE', 'GreenBooks');

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
          <?php if (isset($genres)) foreach ($genres as $genre) : ?>
            <li>
              <a href="/?<?= 'searchKey=' . $genre[0] ?? '' ?>"><?= $genre[0] ?? '' ?></a>
            </li>
          <?php endforeach ?>
        </ul>
      </article>
      <!-- Products -->
      <div class="items-container col d-flex flex-wrap  align-content-start">
        <?= $not_found ?? '' ?>
        <?php if (isset($books))
          foreach ($books as $book) :
        ?>
          <a href="/product/detail/id=<?= $book->book_id ?? $book['id_book'] ?>">
            <div class="item card" style="width: 18rem;">
              <img src="<?= './uploads/' . ($book->image ?? $book['image']) ?>" class="card-img-top" alt="...">
              <div class="card-body pb-0" style="height: 188px;">
                <p class="price"><?= number_format($book->price ?? $book['price'], thousands_separator: ',') ?? '' ?> <sup>₫</sup></p>
                <p class="card-text"><?= htmlspecialchars($book->author ?? $book['author']) ?? '' ?></p>
                <p class="book_name"><?= htmlspecialchars($book->book_name ?? $book['book_name']) ?? '' ?></p>
                <p class="quantity-sold">Đã bán
                  <?= thousandsCurrencyFormat($book->quantity_sold ?? $book['quantity_sold']) ?></p>
              </div>
            </div>
          </a>
        <?php endforeach ?>
      </div>
    </div>
  </div>
  <!-- Pagination -->
  <nav class="d-flex justify-content-center mt-2" style="background: transparent;">
    <ul class="pagination">
      <li class="page-item<?= $paginator->getPrevPage() ? '' : ' disabled' ?>">
        <a role="button" class="page-link" href="/?page=<?= $paginator->getPrevPage() ?>&limit=5">
          <span>&laquo;</span>
        </a>
      </li>
      <?php if (isset($pages)) foreach ($pages as $page) : ?>
        <li class="page-item<?= $paginator->currentPage === $page ? ' active' : '' ?>">
          <a href="/?page=<?= $page ?>&limit=12" class="page-link"><?= $page ?></a>
        </li>
      <?php endforeach ?>
      <li class="page-item<?= $paginator->getNextpage() ? '' : ' disabled' ?>">
        <a href="/?page=<?= $paginator->getNextpage() ?>&limit=12" role="button" class="page-link"><span>&raquo;</span></a>
      </li>
    </ul>
  </nav>
  <?php
  include_once __DIR__ . '/../partials/footer.php';
  include_once __DIR__ . '/../partials/foot.php';
  ?>