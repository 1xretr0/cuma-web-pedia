(function (window, document, undefined) {
    window.onload = init;

    function init() {
        // BACK BUTTON LISTENER
        const backLabel = document.getElementById("back_label");
        backLabel.addEventListener("click", () => {
            history.back();
        });

        // Get all elements with class 'edit-button'
        const editButtons = document.querySelectorAll(".edit-button");
        // Add click event listener to each edit button
        editButtons.forEach((button) => {
            button.addEventListener("click", editDetailField);
        });

		// EDIT DETAIL FIELD
		function editDetailField() {
			console.log('click');
			console.log(this.id);

			if (this.id == 'area_name') {
				const pElement = document.getElementById("p-" + this.id);
				const currentValue = pElement.innerHTML;

				const input = document.createElement("input");
				input.id = 'i-' + this.id;
				input.type = "text";
				input.value = currentValue;
				input.style.minWidth = '60%';
				input.style.maxWidth = '80%';
				input.style.padding = "5px";

				const saveButton = document.createElement("i");
				saveButton.id = 's-' + this.id;
				saveButton.classList.add("fa-solid");
				saveButton.classList.add("fa-floppy-disk");
				// saveButton.style.color = "red";
				saveButton.style.cursor = "pointer";
				saveButton.addEventListener("click", saveDetailField);

				// replace
				this.remove();

				pElement.innerHTML = "";
				pElement.appendChild(input);
				pElement.appendChild(saveButton);
			}
		}

		function saveDetailField() {
            console.log("click save");
            console.log(this.id);

            if (!confirm("¿Desea guardar los cambios realizados?")) {
                location.reload();
                return;
            }

			const queryString = window.location.search;
			const urlParams = new URLSearchParams(queryString);

			const entryId = urlParams.get('id');
			const entryType = urlParams.get('ty');

			const fieldName = this.id.split("-")[1];

            // const newValue = this.closest("input").value.trim();
			const newValue = document.getElementById('i-' + fieldName).value.trim();
			// this.querySelectorAll()

			const params = {
				entryType: entryType,
				fieldName: fieldName,
				entryId: entryId,
				newValue: newValue
			};
			console.log(params);

			postData("../php/entry.php", params).then((response) => {
				console.log("update response", response);
				if (!response || response["error"] == true) location.reload();
			});

			// change elements back
			const pElement = document.getElementById("p-" + fieldName);
			pElement.innerHTML = newValue;
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
    }
})(window, document, undefined);
