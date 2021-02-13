<head>
</head>
<body>
    <div>
    <?php 
          $delete = 'delete' + $p['product_id'];
          echo $delete;
          foreach ($products as $p) { ?>
          <div class="book-wrap" data-id="<?= $p['product_id'] ?>">
            <div class="book-title"><?= $p['product_name'] ?></div>
            <div class="book-desc"><?= $p['product_description'] ?></div>
            <?php if(isset($_POST['deleteitem'])) {
              echo "deleting";
              $pdo->query("DELETE FROM products WHERE product_id = '$p[product_id]'") or die(mysqli_error($pdo));
              header('Refresh: 0');
            }
            ?>
            <form action="3-html-page.php" method = "post">
              <input type="submit" name="deleteitem" >
            </form>
          </div>
        <?php } ?>
    </div>
</body>
