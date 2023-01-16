<section class="content-wrapper px-4 text-left py-5">
  <?php if (!empty($addresses) && is_array($addresses)) : ?>
    <ul>
      <?php foreach ($addresses as $address) : ?>

        <li><?= esc($address['address']) ?></li>
      <?php endforeach ?>
    </ul>
  <?php else : ?>
    <h3>No Addresses</h3>
    <p>Go to <a href="/">home</a> to save a new address.</p>
  <?php endif ?>
</section>