(function (window, document, undefined) {
    window.onload = init;

    function init() {

        // EDIT RESOURCE TABLE RECORD
        // Get all elements with class 'edit-button'
        const editButtons = document.querySelectorAll(".edit-button");
        // Add click event listener to each edit button
        editButtons.forEach((button) => {
            button.addEventListener("click", editRecord);
        });

        // DELETE RESOURCE TABLE RECORD
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
				let input;
				if (cell.id == "lang") {
					input = document.createElement("select");

					const selectedOption = document.createElement("option");
					selectedOption.value = currentValue;
					selectedOption.text = currentValue;
					selectedOption.selected;

					const otherOption = document.createElement("option");
					const lang =
                        currentValue === "ESPAÑOL" ? "INGLÉS" : "ESPAÑOL";
					otherOption.value = lang;
					otherOption.text = lang;

					input.appendChild(selectedOption);
					input.appendChild(otherOption);
				}
				else if (cell.id == "type") {
                    input = document.createElement("select");

                    const selectedOption = document.createElement("option");
                    selectedOption.value = currentValue;
                    selectedOption.text = currentValue;
                    selectedOption.selected;

                    const otherOption = document.createElement("option");
                    const lang = currentValue === "1" ? "2" : "1";
                    otherOption.value = lang;
                    otherOption.text = lang;

                    input.appendChild(selectedOption);
                    input.appendChild(otherOption);
                }
				else if (cell.id == "title") {
                    input = document.createElement("textarea");
					input.value = currentValue;
					input.rows = "3";
                } else {
                    input = document.createElement("input");
                    input.value = currentValue;
                    input.required = "";
                }

				// STYLE INPUT ACCORDING TO CELL ID
                switch (cell.id) {
                    case "title":
                        input.type = "text";
                        // input.style.maxWidth = "%";
						input.style.width = "90%";
                        input.maxLength = "100";
                        break;
                    case "image":
                        input.type = "text";
                        // input.style.maxWidth = "90%";
						input.style.width = "90%";
                        input.maxLength = "30";
                        break;
                    case "url":
                        input.type = "text";
                        // input.style.maxWidth = "90%";
						input.style.width = "90%";
                        input.maxLength = "50";
                        break;
                }

                input.style.fontSize = "12px";
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
            const resourceId = this.id.split("_")[2];

            deleteData("../../php/admin.php", { resourceId: resourceId }).then(
                (response) => {
                    console.log("delete response", response);

                    if (!response || response["error"] == true) {
                        window.alert("Error al eliminar registro!");
                        return;
                    }

                    // delete record tr element
                    this.closest("tr").remove();
                    return;
                }
            );
        }

        function saveChanges() {
            if (!confirm("¿Desea guardar los cambios realizados?")) {
                location.reload();
                return;
            }

            // Extract user id from the id attribute of the clicked button
            const resourceId = this.id.split("_")[2];

            let params = {};
            params["resourceId"] = resourceId;
            // Get the row containing the save button
            const row = this.closest("tr");
            // Loop through each cell in the row
            row.querySelectorAll("td").forEach((cell) => {
                if (cell.id == "options_td") return;

                // Get the value of the input field
                const input = cell.querySelector("input")
					?? cell.querySelector("select")
					?? cell.querySelector("textarea")
				;

				const newValue = input.value.trim();

                if (cell.id == "title" && (!newValue || newValue.length === 0)) {
                    console.log("value error: ", cell.id);
                    input.style.borderColor = "red";
                    return;
                }

                params[cell.id] = newValue;
            });
            console.log("params", params);

            // validate for all keys in params
            if (
                !("title" in params) ||
                !("image" in params) ||
                !("url" in params) ||
                !("type" in params) ||
                !("lang" in params)
            ) {
                return;
            }

            // replace inputs for final values
            row.querySelectorAll("td").forEach((cell) => {
                if (cell.id == "options_td") return;
                // Replace the input field with the new text content
                cell.innerHTML = params[cell.id];
            });

            postData("../../php/admin.php", params).then((response) => {
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

        async function postData(url = "", data = {}, json = true) {
            const type = json
                ? "application/json"
                : "application/x-www-form-urlencoded";
            const body = json
                ? JSON.stringify(data)
                : new URLSearchParams(data);

            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": type,
                },
                body: body,
            });
            return response.json();
        }

        async function deleteData(url = "", data = {}) {
            const response = await fetch(
                url + "?" + new URLSearchParams(data),
                { method: "DELETE" }
            );
            return response.json();
        }
    }
})(window, document, undefined);
