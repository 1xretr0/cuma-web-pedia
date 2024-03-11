// CAROUSEL ANIMATION
(function(window, document, undefined){
	window.onload = init;

	function init() {
		const prev = document.getElementById("prev-btn");
        const next = document.getElementById("next-btn");
        const list = document.getElementById("item-list");

        const itemWidth = 305;
        const padding = 10;

        prev.addEventListener("click", () => {
            list.scrollLeft -= itemWidth + padding;
        });

        next.addEventListener("click", () => {
            list.scrollLeft += itemWidth + padding;
        });
	}
})(window, document, undefined);