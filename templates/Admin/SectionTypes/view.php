<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('Section Types') ?>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">mode_edit</i> '.__('Edit'),['action'=>'edit', $sectionType->id], ['class' => '','escape'=>false]) ?>
        <?= $this->Html->link('<i class="material-icons">delete</i> '.__('Delete'),['action'=>'delete', $sectionType->id], ['class' => '','escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $sectionType->id)]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">

    <div class="card">

      <!-- CONTENT -->
      <div class="card-body">
        <figure class="figure figure--table">

        <table class="table">
          <tbody>
                                                <tr>
              <th scope="row"><?= __('Name') ?></th>
              <td><?= h($sectionType->name) ?></td>
            </tr>
                                                                                    <tr>
              <th scope="row"><?= __('Id') ?></th>
              <td><?= $this->Number->format($sectionType->id) ?></td>
            </tr>
                                                          </tbody>
        </table>
      </figure>

              </div>
    </div>
  </div>
</div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
        <?php if (!empty($sectionType->sections)): ?>
      <div class="card  mt-4">
        <div class="card-body">
          <h4 class="card-title"><?= __('Related Sections') ?></h4>
          <figure class="figure figure--table">
            <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead>
                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Section Type Id') ?></th>
                                    <th><?= __('Page Id') ?></th>
                                    <th><?= __('Order') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($sectionType->sections as $sections): ?>
                    <tr>
                      <td data-title="Id"><?= h($sections->id) ?></td>
                      <td data-title="Section Type Id"><?= h($sections->section_type_id) ?></td>
                      <td data-title="Page Id"><?= h($sections->page_id) ?></td>
                      <td data-title="Order"><?= h($sections->order) ?></td>
                    <td data-title="actions" class="actions" class="text-right">
                      <div class="btn-group">
                        <?= $this->Html->link('<i class="material-icons">visibility</i>', ['controller' => 'Sections', 'action' => 'view', $sections->id],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
                      </td>
                    </div>
                  </tr >

                <?php endforeach; ?>
              </tbody>
            </table>
          </figure>
        </div>
      </div>
    <?php endif; ?>
        <?php if (!empty($sectionType->article_types)): ?>
      <div class="card  mt-4">
        <div class="card-body">
          <h4 class="card-title"><?= __('Related ArticleTypes') ?></h4>
          <figure class="figure figure--table">
            <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead>
                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Name') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($sectionType->article_types as $articleTypes): ?>
                    <tr>
                      <td data-title="Id"><?= h($articleTypes->id) ?></td>
                      <td data-title="Name"><?= h($articleTypes->name) ?></td>
                    <td data-title="actions" class="actions" class="text-right">
                      <div class="btn-group">
                        <?= $this->Html->link('<i class="material-icons">visibility</i>', ['controller' => 'ArticleTypes', 'action' => 'view', $articleTypes->id],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
                      </td>
                    </div>
                  </tr >

                <?php endforeach; ?>
              </tbody>
            </table>
          </figure>
        </div>
      </div>
    <?php endif; ?>
      </div>
</div>
<div class="utils--spacer-default"></div>
