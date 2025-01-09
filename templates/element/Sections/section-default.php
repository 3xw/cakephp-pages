<section ref="section-<?= $section->id ?>" class="section section--defaul">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-11 col-lg-10 col-lg-8 mx-auto">
        <?php foreach($section->articles as $block): ?>
          <?= $this->element('Blocks/block-'.$block->article_type->slug, ['block' => $block, 'lng' => $lng]) ?>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</section>
