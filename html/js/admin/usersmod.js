(function (window, document, undefined) {
	window.onload = init;

    function init() {
        // CREATE NEW USER
        const createUserBtn = document.getElementById("create_user_li");
        createUserBtn.addEventListener("click", () => {
            console.log("click on create user li");

            document.location.href = "./";
        });

        // EDIT USER TABLE RECORD
        // Get all elements with class 'edit-button'
        const editButtons = document.querySelectorAll(".edit-button");
        // Add click event listener to each edit button
        editButtons.forEach((button) => {
            button.addEventListener("click", editRecord);
		});

		function editRecord() {
            // Get the row containing the edit button
            const row = this.closest("tr");

            // Loop through each cell in the row
            row.querySelectorAll("td").forEach((cell) => {
                if (cell.id == "options_td") return;

                // Get the current text content of the cell
                const currentValue = cell.textContent.trim();

                // Create an input field
                const input = document.createElement("input");
                input.type = "text";
                input.value = currentValue;

                // style input
                if (cell.id == "admin")
					input.style.width = "20%";
				else
					input.style.maxWidth = "90%";


                input.style.fontSize = "15px";
                input.style.backgroundColor = "#F0F0F0";
                input.classList.add("open-sans-regular");

                // Replace the cell content with the input field
                cell.innerHTML = "";
                cell.appendChild(input);
            });

            // Change the edit button to a save button
            this.classList.remove("fa-pen-to-square");
            this.classList.add("fa-solid");
            this.classList.add("fa-floppy-disk");
            this.classList.add("save-button");

            this.removeEventListener("click", arguments.callee);
            this.addEventListener("click", saveChanges);
        }

		function saveChanges() {
            if (!confirm("¿Desea guardar los cambios realizados?")) {
                location.reload();
                return;
            }

			// Extract user id from the id attribute of the clicked button
            const userId = this.id.split("_")[2];

            let params = {};
			params['userId'] = userId;
            // Get the row containing the save button
            const row = this.closest("tr");
            // Loop through each cell in the row
            row.querySelectorAll("td").forEach((cell) => {
                if (cell.id == "options_td") return;

                // Get the value of the input field
                const newValue = cell.querySelector("input").value;

                params[cell.id] = newValue;
            });
            console.log("params", params);

            postData("../../php/admin.php", params).then((response) => {
                console.log(response);
            });
        }

		async function postData(url = '', data ={}) {
			const response = await fetch(url, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(data),
			});
			return response.json();
		}
    }
})(window, document, undefined);
