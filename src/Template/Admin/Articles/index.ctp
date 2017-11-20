<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('Articles') ?> <span class="badge badge-info"><?= $this->Paginator->counter('{{count}}')?></span>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">add</i> '.__('Add'),['action'=>'add'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
    <?= $this->Flash->render() ?>
    <?= $this->Flash->render('auth') ?>
    <!-- LIST ELEMENT -->
    <div class="card">
      <!-- START CONTEMT -->
      <div class="card-body">
        <?= $this->Form->create('Search', ['novalidate', 'class'=>'', 'role'=>'search']) ?>
        <?= $this->Form->input('q', ['class'=>'form-control', 'placeholder'=>__('Search...'), 'label'=>false]) ?>
        <?= $this->Form->end() ?>
        <figure class="figure figure--table">

        <table id="datatables" class="table table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
          <thead class="thead-default">
            <tr>
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('title') ?></th>
                            <th><?= $this->Paginator->sort('slug') ?></th>
                            <th><?= $this->Paginator->sort('meta') ?></th>
                            <th><?= $this->Paginator->sort('classes') ?></th>
                            <th><?= $this->Paginator->sort('order') ?></th>
                            <th><?= $this->Paginator->sort('section_id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($articles as $article): ?>
              <tr>
                                      <td data-title="id"><?= $this->Number->format($article->id) ?></td>
                                            <td data-title="title"><?= h($article->title) ?></td>
                                            <td data-title="slug"><?= h($article->slug) ?></td>
                                            <td data-title="meta"><?= h($article->meta) ?></td>
                                            <td data-title="classes"><?= h($article->classes) ?></td>
                                            <td data-title="order"><?= $this->Number->format($article->order) ?></td>
                                              <td data-title="Section Id"><?= $article->has('section') ? $this->Html->link($article->section->id, ['controller' => 'Sections', 'action' => 'view', $article->section->id]) : '' ?></td>
                                        <td data-title="actions" class="actions" class="text-right">
                  <div class="btn-group">
                    <?= $this->Html->link('<i class="material-icons">visibility</i>', ['action' => 'view', $article->id],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
                    <?= $this->Html->link('<i class="material-icons">mode_edit</i>', ['action' => 'edit', $article->id], ['class' => 'btn btn-xs btn-simple btn-warning btn-icon edit','escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="material-icons">delete</i>', ['action' => 'delete', $article->id], ['class' => 'btn btn-xs btn-simple btn-danger btn-icon remove','escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </figure>
      </div>
      <!-- END CONTEMT -->
      <!-- START FOOTER -->
      <div class="card-footer">
        <div class="row no-gutters">
          <div class="col-6">
            <?=
            $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')])
            ?>
          </div>
          <div class="col-6">
            <nav aria-label="pagination">
              <ul class="pagination justify-content-end">
                <?= $this->Paginator->prev(__('Prev')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('Next')) ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <!-- END FOOTER -->
    </div><!-- end content-->
  </div><!-- end card-->
</div><!-- end col-xs-12-->
