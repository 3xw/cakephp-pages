<? if($this->request->session()->read('Auth.User.id')): ?>
  <div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-secondary" onclick="window.mainEventHub.emit('page','section-refresh', <?= $id ?>)" >Section Left</button>
    <button type="button" class="btn btn-secondary" onclick="window.mainEventHub.emit('page','section-add', <?= $id ?>)">Section Middle</button>
    <button type="button" class="btn btn-secondary" onclick="window.mainEventHub.emit('page','section-add', <?= $id ?>)">Section Right</button>
  </div>
<? endif; ?>
