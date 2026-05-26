(function(){
  var obs = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if(e.isIntersecting){
        e.target.classList.add('sa-visible');
        obs.unobserve(e.target);
      }
    });
  },{threshold:0.12});
  function init(){
    document.querySelectorAll('.sa').forEach(function(el){ obs.observe(el); });
  }
  if(document.readyState==='loading'){
    document.addEventListener('DOMContentLoaded',init);
  } else { init(); }
})();
