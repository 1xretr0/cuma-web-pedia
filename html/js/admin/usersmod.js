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

		// DELETE USER TABLE RECORD
		const deleteButtons = document.querySelectorAll(".delete-button");
		deleteButtons.forEach((button) => {
			button.addEventListener("click", deleteRecord);
		});

		// EDIT RECORD
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
                input.value = currentValue;
				input.required = "";

				switch (cell.id) {
                    case "firstnames":
                        input.type = "text";
                        input.style.maxWidth = "90%";
                        input.maxLength = "40";
						break;
                    case "lastnames":
                        input.type = "text";
                        input.style.maxWidth = "90%";
                        input.maxLength = "50";
						break;
                    case "email":
                        input.type = "email";
                        input.style.maxWidth = "90%";
                        input.maxLength = "40";
						break;
                    case "password":
                        input.type = "password";
                        input.style.maxWidth = "90%";
                        input.minLength = "8";
                        input.maxLength = "8";
						break;
                    case "admin":
                        input.type = "number";
                        input.style.width = "30%";
                        input.min = "0";
                        input.max = "1";
						break;
					default:
						input.type = "text";
                        input.style.maxWidth = "90%";
                        input.maxLength = "50";
						break;
                }

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

		function deleteRecord() {
            if (!confirm("¿Desea eliminar el registro?")) {
                return;
            }

            // Extract user id from the id attribute of the clicked button
            const userId = this.id.split("_")[2];

			deleteData("https://proydweb.com/2024/cuma/php/admin.php", {
                userId: userId,
            }).then((response) => {
                console.log("delete response", response);

                if (!response || response["error"] == true) {
                    window.alert("Error al eliminar registro!");
                    return;
                }

                // delete record tr element
                this.closest("tr").remove();
                return;
            });
        }

		function saveChanges() {
            if (!confirm("¿Desea guardar los cambios realizados?")) {
                location.reload();
                return;
            }

            // Extract user id from the id attribute of the clicked button
            const userId = this.id.split("_")[2];

            let params = {};
            params["userId"] = userId;
            // Get the row containing the save button
            const row = this.closest("tr");
            // Loop through each cell in the row
            row.querySelectorAll("td").forEach((cell) => {
                if (cell.id == "options_td") return;

                // Get the value of the input field
				const input = cell.querySelector("input");
                const newValue = input.value.trim();

				if (!newValue || newValue.length === 0) {
                    console.log("value error: ", cell.id);
                    input.style.borderColor = "red";
                    return;
                }

				if (cell.id == 'email') {
					const pattern = "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?";
					if (!newValue.match(pattern)) {
                        console.log("email pattern error");
                        input.style.borderColor = "red";
                        return;
                    }
                }

                params[cell.id] = newValue;
            });
            console.log("params", params);

			// validate for all keys in params
			if (
				!("firstnames" in params) ||
				!("lastnames" in params) ||
				!("email" in params) ||
				// !("password" in params) ||
				!("admin" in params)
			) {
				return;
			}

			// replace inputs for final values
			row.querySelectorAll("td").forEach((cell) => {
				if (cell.id == "options_td") return;
                // Replace the input field with the new text content
                cell.innerHTML = params[cell.id];
            });

            postData(
                "https://proydweb.com/2024/cuma/php/admin.php",
                params
            ).then((response) => {
                console.log("update response", response);
                if (!response || response["error"] == true) location.reload();
            });
            // Change the save button back to an edit button
            this.classList.remove("fa-solid");
            this.classList.remove("fa-floppy-disk");
            this.classList.remove("save-button");

            this.classList.add("fa-solid");
            this.classList.add("fa-pen-to-square");
            this.classList.add("edit-button");

            this.removeEventListener("click", arguments.callee);
            this.addEventListener("click", editRecord);
        }

		async function postData(url = '', data ={}, json = true) {
			const type = json ? 'application/json' : 'application/x-www-form-urlencoded';
			const body = json ? JSON.stringify(data) : new URLSearchParams(data);

			const response = await fetch(url, {
				method: 'POST',
				headers: {
					'Content-Type': type
				},
				body: body,
			});
			return response.json();
		}

		async function deleteData(url = '', data = {}) {
			const response = await fetch(
				url + '?' + new URLSearchParams(data),
				{method: 'DELETE'}
			);
			return response.json();
		}
    }
})(window, document, undefined);
