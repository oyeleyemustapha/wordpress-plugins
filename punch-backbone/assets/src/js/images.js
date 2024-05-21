document.addEventListener("DOMContentLoaded", function() {
	// Get our lazy-loaded images
	var lazyImages = [].slice.call(document.querySelectorAll("img.img-lazy-load"));
  
	if ("IntersectionObserver" in window) {
		// Create new observer object
		let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
		  // Loop through IntersectionObserverEntry objects
			entries.forEach(function(entry) {
				// Do these if the target intersects with the root
				if (entry.isIntersecting) {
					console.log('intersecting')
					let lazyImage = entry.target;
					lazyImage.src = lazyImage.dataset.src;
					lazyImage.classList.remove("img-lazy-load");
					lazyImageObserver.unobserve(lazyImage);
				}
			});
		});
		
		// Loop through and observe each image
		lazyImages.forEach(function(lazyImage) {
		lazyImageObserver.observe(lazyImage);
		});
	}
	  
});