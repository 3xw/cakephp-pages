<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= __('Pages') ?>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">mode_edit</i> '.__('Edit'),['action'=>'edit', $page->id], ['class' => '','escape'=>false]) ?>
        <?= $this->Html->link('<i class="material-icons">delete</i> '.__('Delete'),['action'=>'delete', $page->id], ['class' => '','escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $page->id)]) ?>
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
              <th scope="row"><?= __('Title') ?></th>
              <td><?= h($page->title) ?></td>
            </tr>
                                                <tr>
              <th scope="row"><?= __('Slug') ?></th>
              <td><?= h($page->slug) ?></td>
            </tr>
                                                <tr>
              <th scope="row"><?= __('Meta') ?></th>
              <td><?= h($page->meta) ?></td>
            </tr>
                                                <tr>
              <th scope="row"><?= __('Page Type') ?></th>
              <td><?= h($page->page_type) ?></td>
            </tr>
                                                <tr>
              <th scope="row"><?= __('Parent Page') ?></th>
              <td><?= $page->has('parent_page') ? $this->Html->link($page->parent_page->title, ['controller' => 'Pages', 'action' => 'view', $page->parent_page->id]) : '' ?></td>
            </tr>
                                                                                    <tr>
              <th scope="row"><?= __('Id') ?></th>
              <td><?= $this->Number->format($page->id) ?></td>
            </tr>
                        <tr>
              <th scope="row"><?= __('Lft') ?></th>
              <td><?= $this->Number->format($page->lft) ?></td>
            </tr>
                        <tr>
              <th scope="row"><?= __('Rght') ?></th>
              <td><?= $this->Number->format($page->rght) ?></td>
            </tr>
                                                          </tbody>
        </table>
      </figure>

                        <div class="row">
          <div class="col-sm-12">
            <h4><?= __('Header') ?></h4>
            <?= $this->Text->autoParagraph(h($page->header)); ?>
          </div>
        </div>
                      </div>
    </div>
  </div>
</div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
        <?php if (!empty($page->child_pages)): ?>
      <div class="card  mt-4">
        <div class="card-body">
          <h4 class="card-title"><?= __('Related Pages') ?></h4>
          <figure class="figure figure--table">
            <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead>
                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Title') ?></th>
                                    <th><?= __('Slug') ?></th>
                                    <th><?= __('Meta') ?></th>
                                    <th><?= __('Header') ?></th>
                                    <th><?= __('Page Type') ?></th>
                                    <th><?= __('Parent Id') ?></th>
                                    <th><?= __('Lft') ?></th>
                                    <th><?= __('Rght') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($page->child_pages as $childPages): ?>
                    <tr>
                      <td data-title="Id"><?= h($childPages->id) ?></td>
                      <td data-title="Title"><?= h($childPages->title) ?></td>
                      <td data-title="Slug"><?= h($childPages->slug) ?></td>
                      <td data-title="Meta"><?= h($childPages->meta) ?></td>
                      <td data-title="Header"><?= h($childPages->header) ?></td>
                      <td data-title="Page Type"><?= h($childPages->page_type) ?></td>
                      <td data-title="Parent Id"><?= h($childPages->parent_id) ?></td>
                      <td data-title="Lft"><?= h($childPages->lft) ?></td>
                      <td data-title="Rght"><?= h($childPages->rght) ?></td>
                    <td data-title="actions" class="actions" class="text-right">
                      <div class="btn-group">
                        <?= $this->Html->link('<i class="material-icons">visibility</i>', ['controller' => 'Pages', 'action' => 'view', $childPages->id],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
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
        <?php if (!empty($page->sections)): ?>
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
                  <?php foreach ($page->sections as $sections): ?>
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
        <?php if (!empty($page->attachments)): ?>
      <div class="card  mt-4">
        <div class="card-body">
          <h4 class="card-title"><?= __('Related Attachments') ?></h4>
          <figure class="figure figure--table">
            <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead>
                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Name') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                    <th><?= __('Type') ?></th>
                                    <th><?= __('Subtype') ?></th>
                                    <th><?= __('Size') ?></th>
                                    <th><?= __('Md5') ?></th>
                                    <th><?= __('Date') ?></th>
                                    <th><?= __('Title') ?></th>
                                    <th><?= __('Description') ?></th>
                                    <th><?= __('Author') ?></th>
                                    <th><?= __('Copyright') ?></th>
                                    <th><?= __('Path') ?></th>
                                    <th><?= __('Embed') ?></th>
                                    <th><?= __('Profile') ?></th>
                                    <th><?= __('Width') ?></th>
                                    <th><?= __('Height') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($page->attachments as $attachments): ?>
                    <tr>
                      <td data-title="Id"><?= h($attachments->id) ?></td>
                      <td data-title="Name"><?= h($attachments->name) ?></td>
                      <td data-title="Created"><?= h($attachments->created) ?></td>
                      <td data-title="Modified"><?= h($attachments->modified) ?></td>
                      <td data-title="Type"><?= h($attachments->type) ?></td>
                      <td data-title="Subtype"><?= h($attachments->subtype) ?></td>
                      <td data-title="Size"><?= h($attachments->size) ?></td>
                      <td data-title="Md5"><?= h($attachments->md5) ?></td>
                      <td data-title="Date"><?= h($attachments->date) ?></td>
                      <td data-title="Title"><?= h($attachments->title) ?></td>
                      <td data-title="Description"><?= h($attachments->description) ?></td>
                      <td data-title="Author"><?= h($attachments->author) ?></td>
                      <td data-title="Copyright"><?= h($attachments->copyright) ?></td>
                      <td data-title="Path"><?= h($attachments->path) ?></td>
                      <td data-title="Embed"><?= h($attachments->embed) ?></td>
                      <td data-title="Profile"><?= h($attachments->profile) ?></td>
                      <td data-title="Width"><?= h($attachments->width) ?></td>
                      <td data-title="Height"><?= h($attachments->height) ?></td>
                    <td data-title="actions" class="actions" class="text-right">
                      <div class="btn-group">
                        <?= $this->Html->link('<i class="material-icons">visibility</i>', ['controller' => 'Attachments', 'action' => 'view', $attachments->id],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
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
