<? if($this->request->session()->read('Auth.User.id')): ?>
  <div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-secondary" onclick="window.mainEventHub.emit('page','article-add', <?= $id ?>)" >Article Left</button>
    <button type="button" class="btn btn-secondary" onclick="window.mainEventHub.emit('page','article-add', <?= $id ?>)">Article Middle</button>
    <button type="button" class="btn btn-secondary" onclick="window.mainEventHub.emit('page','article-add', <?= $id ?>)">Article Right</button>
  </div>
<? endif; ?>
