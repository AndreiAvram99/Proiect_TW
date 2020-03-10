function showStateStatistics(id) {
            const NUMBER_OF_FIELDS = 5;
            let firstFieldId = "textBoxObj_";
            let lastFieldsIdArray = [];
            let index;

            firstFieldId = firstFieldId + id;
            for(index = 0; index < NUMBER_OF_FIELDS - 1; index++){
                lastFieldsIdArray.push("textBoxText_" + index.toString() + "_" + id);
            }

            let field = document.getElementById(firstFieldId);
            field.style.display = "block";

            for(index = 0; index < NUMBER_OF_FIELDS - 1; index++){
                field  = document.getElementById(lastFieldsIdArray[index]);
                field.style.display = "block";
            }

        }

function hideStateStatistics(id) {

	const NUMBER_OF_FIELDS = 5;
	let firstFieldId = "textBoxObj_";
	let lastFieldsIdArray = [];
	let index;

	firstFieldId = firstFieldId + id;
	for(index = 0; index < NUMBER_OF_FIELDS - 1; index++){
		lastFieldsIdArray.push("textBoxText_" + index.toString() + "_" + id);
	}

	let field = document.getElementById(firstFieldId);
	field.style.display = "none";

	for(index = 0; index < NUMBER_OF_FIELDS - 1; index++){
		field  = document.getElementById(lastFieldsIdArray[index]);
		field.style.display = "none";
	}
}