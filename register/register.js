function appendExtra() {
    var form = document.getElementById("registerform");
    var submit = document.getElementById("submit");

    var familyCodeLabel = document.createElement("label");
    var emergencyContactLabel = document.createElement("label");
    var relationLabel = document.createElement("label");

    var familyCode = document.createElement("input");
    var emergencyContact = document.createElement("input");
    var relation = document.createElement("input");

    familyCodeLabel.id = "familycode";
    emergencyContactLabel.id = "emergency";
    relationLabel.id = "relation";

    familyCodeLabel.innerText = "Family Code: ";
    emergencyContactLabel.innerText = "Emergency Contact: ";
    relationLabel.innerText = "Emergency Contact Relation: ";

    familyCode.type = "text";
    emergencyContact.type = "text";
    relation.type = "text";
    familyCode.name = "familycode";
    emergencyContact.name = "emergency";
    relation.name = "relation";

    form.appendChild(familyCodeLabel);
    form.appendChild(emergencyContactLabel);
    form.appendChild(relationLabel);

    familyCodeLabel.appendChild(familyCode);
    emergencyContactLabel.appendChild(emergencyContact);
    relationLabel.appendChild(relation);
}

function removeExtra() {
    var form = document.getElementById("registerform");

    var familyCode = document.getElementById("familycode");
    var emergencyContact = document.getElementById("emergency");
    var relation = document.getElementById("relation");
    
    if(familyCode != null){
        form.removeChild(familyCode);
        form.removeChild(emergencyContact);
        form.removeChild(relation);
    }
}

function displayExtras() {
    var option = document.getElementById("role");
    if(option.value == "6"){
        appendExtra();
    }
    else {
        removeExtra();
    }
}