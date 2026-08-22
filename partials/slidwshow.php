<?php if ($gallery = $args['fields']['gallery']): ?>
  <div class="wp-block-slideshow" style="--aspect-ratio: <?php echo !empty(
    $args['fields']['aspect_ratio']
  )
    ? $args['fields']['aspect_ratio']
    : '0'; ?>">
    <div class="slideshow" data-slideshow>
      <div class="slideshow__container">
        <?php $gallery_id = rand(); ?>
        <?php foreach ($gallery as $image): ?>
          <div class="slideshow__slide">
            <a href="<?php echo esc_attr(
              wp_get_attachment_url($image, 'full'),
            ); ?>" data-fslightbox="gallery-<?php echo $gallery_id; ?>">
              <?php echo wp_get_attachment_image($image, 'full'); ?>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="slideshow__nav" data-slideshow-nav>
        <button class="slideshow__prev embla-nav-button" type="button" data-slideshow-prev>
          <span class="icon icon-arrow-left"></span>
        </button>
        <button class="slideshow__next embla-nav-button" type="button" data-slideshow-next>
          <span class="icon icon-arrow-right"></span>
        </button>
      </div>
    </div>
  </div>
<?php endif; ?>
