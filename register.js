function appendExtra() {
    var form = document.getElementById("registerform");
    var submit = document.getElementById("submit");
    var registerlinkog = document.getElementById("tologin");

    var familyCodeLabel = document.createElement("label");
    var emergencyContactLabel = document.createElement("label");
    var relationLabel = document.createElement("label");

    var familyCode = document.createElement("input");
    var emergencyContact = document.createElement("input");
    var relation = document.createElement("input");

    form.removeChild(submit);
    form.removeChild(registerlinkog);

    var submit2 = document.createElement("input");

    submit2.type = "submit";
    submit2.name = "register";
    submit2.id = "submit";

    var registerlinknew = document.createElement("a");

    registerlinknew.href = "login.php";
    registerlinknew.id = "tologin";
    registerlinknew.innerHTML = "Already Registered? Login";

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

    form.appendChild(submit2);
    form.appendChild(registerlinknew);
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