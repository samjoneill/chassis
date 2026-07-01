(() => {
  // Handle overflowing reel components.
  const className = 'reel';
  const reels = Array.from(document.querySelectorAll(`.${className}`));
  const toggleOverflowClass = elem => {
    elem.classList.toggle('overflowing', elem.scrollWidth > elem.clientWidth);
  };

  for (let reel of reels) {
    if ('ResizeObserver' in window) {
      new ResizeObserver(entries => {
        toggleOverflowClass(entries[0].target);
      }).observe(reel);
    }

    if ('MutationObserver' in window) {
      new MutationObserver(entries => {
        toggleOverflowClass(entries[0].target);
      }).observe(reel, {childList: true});
    }
  }
})();

(() => {
  const tabEls = document.querySelectorAll('.u-tabs');
  if (!tabEls.length) return;

  tabEls.forEach((el) => {
    const tablist = el.querySelector('[role="tablist"]');
    const panelsEl = el.querySelector('.u-tabs__panels');

    if (!tablist || !panelsEl) return;

    const activateTab = (tabEl) => {
      tablist.querySelectorAll('[role="tab"]').forEach((t) => {
        const active = t === tabEl;
        t.setAttribute('aria-selected', String(active));
        t.setAttribute('tabindex', active ? '0' : '-1');
      });
      panelsEl.querySelectorAll('[role="tabpanel"]').forEach((p) => {
        p.hidden = p.id !== tabEl.getAttribute('aria-controls');
      });
      tabEl.focus();
    };

    tablist.addEventListener('click', (e) => {
      const clicked = e.target.closest('[role="tab"]');
      if (!clicked) return;
      activateTab(clicked);
    });

    tablist.addEventListener('keydown', (e) => {
      const all = [...tablist.querySelectorAll('[role="tab"]')];
      const idx = all.indexOf(document.activeElement);
      let next;

      switch (e.key) {
        case 'ArrowRight': next = all[(idx + 1) % all.length]; break;
        case 'ArrowLeft': next = all[(idx - 1 + all.length) % all.length]; break;
        case 'Home': next = all[0]; break;
        case 'End': next = all[all.length - 1]; break;
        default: return;
      }

      e.preventDefault();
      activateTab(next);
    });
  });
})();
