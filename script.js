document.addEventListener("DOMContentLoaded", function () {

  const select = document.getElementById("userselect");
  const container = document.getElementById("inputcontainer");

  if (!select || !container) {
    return; // EXIT silently if elements don't exist
  }

  const inputMap = {
    admin: ["Role", "Department", "Email"],
    landlord: ["Is Verified"],
    renter: ["Occupation", "Is Student","Current Rent Status","Rental_History"]
  };

  select.addEventListener("change", function () {
    container.innerHTML = "";

    if (!inputMap[this.value]) return;

    inputMap[this.value].forEach((label, index) => {
        if (this.value == "admin"){
            const input = document.createElement("input");
            const l = document.createElement("label");
            l.textContent = `${label}: `;
            container.appendChild(l);
            input.type = "text";
            input.placeholder = label;
            input.name = `${this.value}_${label}`;
            input.required = true;
            container.appendChild(input);
            container.appendChild(document.createElement("br"));
            container.appendChild(document.createElement("br"));
        }
        else if (this.value == "landlord"){
            const input = document.createElement("input");
            const l = document.createElement("label");
            l.textContent = `Verified`;
            container.appendChild(l);
            input.type = "checkbox";
            input.placeholder = label;
            const safeName = label.replace(/\s+/g, '_').toLowerCase();
            input.name = `${this.value}_${safeName}`;
            container.appendChild(input);
            container.appendChild(document.createElement("br"));
            container.appendChild(document.createElement("br"));
        }
        else{
            const input = document.createElement("input");
            if (label == "Is Student"){
                const l = document.createElement("label");
                l.textContent = `Student`;
                container.appendChild(l);
                input.type = "checkbox";
                input.placeholder = label;
                const safeName = label.replace(/\s+/g, '_').toLowerCase();
                input.name = `${this.value}_${safeName}`;
                container.appendChild(input);
                container.appendChild(document.createElement("br"));
                container.appendChild(document.createElement("br"));
            }
            else if(label == "Current Rent Status"){
                const l = document.createElement("label");
                l.textContent = `Currently Renting`;
                container.appendChild(l);
                input.type = "checkbox";
                input.placeholder = label;
                const safeName = label.replace(/\s+/g, '_').toLowerCase();
                input.name = `${this.value}_${safeName}`;
                container.appendChild(input);
                container.appendChild(document.createElement("br"));
                container.appendChild(document.createElement("br"));
            }
            else if(label == "Rental_History"){
                input.type = "number";
                const l = document.createElement("label");
                l.textContent = `${label}: `;
                container.appendChild(l);
                input.placeholder = `How many times you rented`;
                input.name = `${this.value}_${label}`;
                input.required = true;
                input.style = `width: 180px`;
                container.appendChild(input);
                container.appendChild(document.createElement("br"));container.appendChild(document.createElement("br"));
            }
            else{
                input.type = "text";
                input.placeholder = label;
                const l = document.createElement("label");
                l.textContent = `${label}: `;
                container.appendChild(l);
                input.name = `${this.value}_${label}`;
                input.required = true;
                container.appendChild(input);
                container.appendChild(document.createElement("br"));container.appendChild(document.createElement("br"));
            }
        }
    });
  });

});

document.addEventListener('DOMContentLoaded', function() {
    // Add smooth transitions for interactive elements
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.style.transition = 'all 0.2s ease';
    });

    // Add subtle hover effects to table rows
    const tableRows = document.querySelectorAll('tr');
    tableRows.forEach(row => {
        row.style.transition = 'background-color 0.2s ease';
    });

    // Add focus styles to form elements
    const formElements = document.querySelectorAll('input, select, button');
    formElements.forEach(el => {
        el.addEventListener('focus', () => {
            el.style.boxShadow = '0 0 0 2px rgba(79, 70, 229, 0.5)';
        });
        el.addEventListener('blur', () => {
            el.style.boxShadow = 'none';
        });
    });
});
