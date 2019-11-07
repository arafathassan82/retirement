function appendExtra() {
    var form = document.getElementById("registerform");
    var familyCode = document.createElement("input");
    var emergencyContact = document.createElement("input");
    var relation = document.createElement("input");

    familyCode.type = "text";
    emergencyContact.type = "text";
    relation.type = "text";
    familyCode.name = "familycode";
    emergencyContact.name = "emergency";
    relation.name = "relation";
    familyCode.id = "familycode";
    emergencyContact.id = "emergency";
    relation.id = "relation";

    form.appendChild(familyCode);
    form.appendChild(emergencyContact);
    form.appendChild(relation);
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