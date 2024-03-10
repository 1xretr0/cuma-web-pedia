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