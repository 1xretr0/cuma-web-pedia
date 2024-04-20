/**
 * Makes the item with given id bold and switches the others to regular weight
 * @param {string} itemId
 */
function makeNavbarItemBold(itemId) {
	const navBarItems = document.getElementsByClassName('nav-item');
	for (item of navBarItems) {
		if (item.dataset.itemId == itemId) {
			item.style.fontWeight = "700";
			continue;
		}

		item.style.fontWeight = "400";
	}
}

(function(window, document, undefined){
	window.onload = init;

	function init() {
		const logoAnchor = document.getElementById("navbar-logo");

        logoAnchor.addEventListener("click", () => {
            window.location.href = "../";
        });
	}
})(window, document, undefined);