// lazyload the gpt tbraag
{/* <script async src="//www.googletagservices.com/tag/js/gpt.js"></script> */}

  window.googletag = window.googletag || {cmd: []};

  // GPT ad slots
  var rvp_mobile_1, rvp_mobile_2, rvp_mobile_3, rvp_mobile_4, rvp_mobile_5, rvp_mobile_halfpage;

  googletag.cmd.push(function() {


    // if its mobile
    rvp_mobile_1 = googletag.defineSlot('/31989200/rvp-mobile-1', [[300, 50], [300, 250]], 'div-gpt-ad-1652282720550-0').addService(googletag.pubads());
    rvp_mobile_2 = googletag.defineSlot('/31989200/rvp-mobile-2', [[300, 50], [300, 100], [300, 250]], 'div-gpt-ad-1652282798096-0').addService(googletag.pubads());
    rvp_mobile_3 = googletag.defineSlot('/31989200/rvp-mobile-3', [[300, 100], [300, 250], [300, 50]], 'div-gpt-ad-1652282869388-0').addService(googletag.pubads());
    rvp_mobile_4 = googletag.defineSlot('/31989200/rvp-mobile-4', [[300, 100], [300, 250], [300, 50]], 'div-gpt-ad-1652282927453-0').addService(googletag.pubads());
    rvp_mobile_5 = googletag.defineSlot('/31989200/rvp-mobile-5', [[300, 50], [300, 100], [300, 250]], 'div-gpt-ad-1652283037699-0').addService(googletag.pubads());
    rvp_mobile_halfpage = googletag.defineSlot('/31989200/rvp-mobile-halfpage', [300, 600], 'div-gpt-ad-1652283086935-0').addService(googletag.pubads());

    // if its desktop
    rvp_desktop_1 = googletag.defineSlot('/31989200/rvp-desktop-1', [[300, 250], [789, 90]], 'div-gpt-ad-1652278950647-0').addService(googletag.pubads());
    rvp_desktop_2 = googletag.defineSlot('/31989200/rvp-desktop-2', [[300, 250], [728, 90]], 'div-gpt-ad-1652281233069-0').addService(googletag.pubads());
    rvp_desktop_3 = googletag.defineSlot('/31989200/rvp-desktop-3', [[728, 90], [300, 250]], 'div-gpt-ad-1652281318990-0').addService(googletag.pubads());
    rvp_desktop_4 = googletag.defineSlot('/31989200/rvp-desktop-4', [[300, 250], [728, 90]], 'div-gpt-ad-1652281437867-0').addService(googletag.pubads());
    rvp_desktop_5 = googletag.defineSlot('/31989200/rvp-desktop-5', [[300, 250], [728, 90]], 'div-gpt-ad-1652281667269-0').addService(googletag.pubads());
    rvp_sidebar_1 = googletag.defineSlot('/31989200/rvp-desktop-sidebar-1', [[300, 250], [300, 600]], 'div-gpt-ad-1652282076413-0').addService(googletag.pubads());
    rvp_desktop_leaderboard = googletag.defineSlot('/31989200/rvp-desktop-leaderboard', [[728, 90], [970, 90]], 'div-gpt-ad-1652282034867-0').addService(googletag.pubads());

	// googletag.pubads().enableSingleRequest();
	// googletag.pubads().setTargeting('category', [..........enter category name here or set as undefined.......]);
    // googletag.enableServices();

	// googletag.pubads().setTargeting('category', 'undefined');
    // googletag.pubads().enableLazyLoad();

        // B) Enable without lazy fetching. Additional calls override previous
        // ones.
        // googletag.pubads().enableLazyLoad({fetchMarginPercent: -1});
        // googletag.pubads().enableLazyLoad();
        // C) Enable lazy loading with...
        // googletag.pubads().enableLazyLoad({
          // Fetch slots within 5 viewports.
          // fetchMarginPercent: 500,
          // Render slots within 2 viewports.
          // renderMarginPercent: 200,
          // Double the above values on mobile, where viewports are smaller
          // and users tend to scroll faster.
        //   mobileScaling: 2.0
        // });

        // Register event handlers to observe lazy loading behavior.
        // googletag.pubads().addEventListener('slotRequested', function(event) {
        //   updateSlotStatus(event.slot.getSlotElementId(), 'fetched');
        // });

        // googletag.pubads().addEventListener('slotOnload', function(event) {
        //   updateSlotStatus(event.slot.getSlotElementId(), 'rendered');
        // });
      googletag.pubads().setTargeting('category', 'undefined');
      googletag.enableServices();


  });


  document.addEventListener("DOMContentLoaded", function() {
    // Get our lazy-loaded images
    var lazyGamTags = [].slice.call(document.querySelectorAll("div.punch-admanager"));
    // console.log(lazyGamTags.length);
  
    if ("IntersectionObserver" in window) {
      // console.log(lazyGamTags);
        // Create new observer object
        let lazyGamTagObserver = new IntersectionObserver(function(entries, observer) {
          // Loop through IntersectionObserverEntry objects
            entries.forEach(function(entry) {
                // Do these if the target intersects with the root
                if (entry.isIntersecting) {
                    let lazyGamTag = entry.target;
                    // lazyGamTag.src = lazyGamTag.dataset.src;
                    googletag.cmd.push(function() { googletag.display(lazyGamTag.id); });
                    console.log('intersecting'+lazyGamTag.id);
                    lazyGamTag.classList.remove("punch-admanager");
                    lazyGamTagObserver.unobserve(lazyGamTag);
                }
            });
        });
        
        // Loop through and observe each image
        lazyGamTags.forEach(function(lazyGamTag) {
        lazyGamTagObserver.observe(lazyGamTag);
        });
    }
      
  });