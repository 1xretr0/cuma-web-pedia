(function (window, document, undefined) {
    window.onload = init;

    function init() {
        // IMPLEMENT BUTTON LISTENERS AND DYNAMIC CONTENT CHANGES

		// CREATE NEW USER
		createUserBtn = document.getElementById('create_user_li');
		createUserBtn.addEventListener('click', () => {
			console.log('click on create user li');

			document.querySelector('.slogan').style.display = 'none';

			document.getElementById('create_user_h2').style.display = 'block';
			document.getElementById('create_user_form').style.display = 'block';
		});
    }
})(window, document, undefined);
