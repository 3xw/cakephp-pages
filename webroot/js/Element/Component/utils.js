
window.mainEventHub = {
  emit: function(hub,event, ...args)
  {
    if(window.mainEventHub[hub] == undefined) window.mainEventHub[hub] = new Vue();
    return window.mainEventHub[hub].$emit(event, args);
  },
  on: function(hub,event, callback)
  {
    if(window.mainEventHub[hub] == undefined) window.mainEventHub[hub] = new Vue();
    return window.mainEventHub[hub].$on(event, callback);
  },
  off: function(hub,event, callback)
  {
    if(window.mainEventHub[hub] == undefined) window.mainEventHub[hub] = new Vue();
    return window.mainEventHub[hub].$off(event, callback);
  }
};

Vue.prototype.$hubEmit = function(hub,event, ...args)
{
  return window.mainEventHub.emit(hub,event, args);
}

Vue.prototype.$hubOn = function(hub,event, callback)
{
  return window.mainEventHub.on(hub,event, callback);
}

Vue.prototype.$hubOff = function(hub,event, callback)
{
  return window.mainEventHub.off(hub,event, callback);
}
