(function (window, document, undefined) {
    window.onload = init;

	function init() {
		// BACK BUTTON LISTENER
		const backLabel = document.getElementById("back_label");
		backLabel.addEventListener("click", () => {
			history.back();
		});


	}
})(window, document, undefined);
