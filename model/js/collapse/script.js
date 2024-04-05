
const Collapses = document.querySelectorAll('.collapse');

Collapses.forEach(collapse => {
  collapse.addEventListener('show.bs.collapse', () => {
    Collapses.forEach(function (otherCollapse) {
      if (otherCollapse !== collapse && otherCollapse.classList.contains('show')) {
        otherCollapse.classList.remove('show');
      }
    });
  });
});

