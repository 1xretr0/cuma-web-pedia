(function (window, document, undefined) {
    window.onload = init;

    function init() {
		const newButton = document.getElementById("new_button");
		if (!newButton)
			return;

        newButton.addEventListener("click", () => {
			console.log('clicked new');
            window.location.href = "./newentry.php";
        });
    }
})(window, document, undefined);
