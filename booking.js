/* ------------------------------------------
   ZEIRO Booking JS - final premium v1
-------------------------------------------*/
console.log("booking.js loaded");

if (!document.getElementById("panel-1")) {
    console.error("booking.js: booking.php DOM missing!");
    alert("ERROR: booking.php structure incorrect. Check console.");
}

// State
let selectedExperience = null;
let cameraType = "basic";
let totalPrice = 0;

// price configuration
const basePrices = { wildlife:5000, prewedding:8000, baby:4000, fashion:7000, event:6000 };
const cameraMultiplier = { basic:1.0, pro:1.4, ultra:2.0 };
const addonPrices = { drone:1500, makeup:2000, jeep:1200, travel_per_km:20, extra_hour:800, per_photo:50, premium_lighting:2500, premium_edit:1500 };
const addonsPerCamera = {
    basic: ["drone","travel","photos"],
    pro: ["drone","makeup","jeep","travel","hours","photos"],
    ultra: ["drone","makeup","jeep","travel","hours","photos","premium_lighting","premium_edit"]
};
const addonLabels = {
    drone:"Drone Add-on", makeup:"Makeup Artist", jeep:"Jeep / Safari Guide",
    travel:"Travel (km)", hours:"Extra Hours", photos:"Edited Photos",
    premium_lighting:"Premium Lighting", premium_edit:"Premium Edit"
};

// Render addons area
function renderAddons(){
    let container = document.getElementById("dynamicAddons");
    container.innerHTML = "";
    addonsPerCamera[cameraType].forEach(a=>{
        if (["travel","hours","photos"].includes(a)){
            let el = document.createElement("label");
            el.className = "addon-card";
            el.innerHTML = `${addonLabels[a]} <input id="${a}" type="number" value="${a==="photos"?20:0}" min="0" style="width:110px">`;
            container.appendChild(el);
        } else {
            let el = document.createElement("label");
            el.className = "addon-card";
            el.innerHTML = `<span>${addonLabels[a]}</span><span><input id="${a}" type="checkbox"> <strong style="color:var(--gold)">₹${addonPrices[a]||0}</strong></span>`;
            container.appendChild(el);
        }
    });
    attachAddonEvents();
    calculatePrice();
}

function attachAddonEvents(){
    addonsPerCamera[cameraType].forEach(a=>{
        let el = document.getElementById(a);
        if (!el) return;
        el.removeEventListener("input", calculatePrice);
        el.removeEventListener("change", calculatePrice);
        el.addEventListener("input", calculatePrice);
        el.addEventListener("change", calculatePrice);
    });
}

// Experience selection
document.querySelectorAll(".icon-card").forEach(card=>{
    card.addEventListener("click", ()=>{
        document.querySelectorAll(".icon-card").forEach(c=>c.classList.remove("selected"));
        card.classList.add("selected");
        selectedExperience = card.dataset.exp;
        calculatePrice();
    });
});

// Steps nav handlers
document.getElementById("next1").onclick = ()=>{
    if (!selectedExperience) { alert("Please select an experience."); return; }
    document.getElementById("panel-1").style.display="none";
    document.getElementById("panel-2").style.display="block";
    document.querySelector(".step[data-step='1']").classList.remove("active");
    document.querySelector(".step[data-step='2']").classList.add("active");
    renderAddons();
};

document.getElementById("back1").onclick = ()=>{
    document.getElementById("panel-2").style.display="none";
    document.getElementById("panel-1").style.display="block";
    document.querySelector(".step[data-step='2']").classList.remove("active");
    document.querySelector(".step[data-step='1']").classList.add("active");
};

document.getElementById("next2").onclick = ()=>{
    // ensure user filled contact later in panel3
    document.getElementById("panel-2").style.display="none";
    document.getElementById("panel-3").style.display="block";
    document.querySelector(".step[data-step='2']").classList.remove("active");
    document.querySelector(".step[data-step='3']").classList.add("active");
    document.getElementById("reviewBox").innerHTML = `<strong>Experience:</strong> ${selectedExperience}<br><strong>Camera:</strong> ${cameraType}<br><strong>Total:</strong> ₹${totalPrice}`;
};

document.getElementById("back2").onclick = ()=>{
    document.getElementById("panel-3").style.display="none";
    document.getElementById("panel-2").style.display="block";
    document.querySelector(".step[data-step='3']").classList.remove("active");
    document.querySelector(".step[data-step='2']").classList.add("active");
};

// Camera change
document.getElementById("camera").addEventListener("change", ()=>{
    cameraType = document.getElementById("camera").value.toLowerCase();
    renderAddons();
});

// Price calculation
function calculatePrice(){
    if (!selectedExperience) return;
    let base = basePrices[selectedExperience] || 0;
    let mult = cameraMultiplier[cameraType] || 1;
    totalPrice = Math.round(base * mult);

    // add-ons
    addonsPerCamera[cameraType].forEach(a=>{
        let el = document.getElementById(a);
        if (!el) return;
        if (el.type === "checkbox" && el.checked) totalPrice += addonPrices[a] || 0;
        if (el.type === "number") {
            let v = parseInt(el.value) || 0;
            if (a === "travel") totalPrice += v * addonPrices.travel_per_km;
            if (a === "hours") totalPrice += v * addonPrices.extra_hour;
            if (a === "photos") totalPrice += v * addonPrices.per_photo;
        }
    });

    updateSummary();
}

// Update summary UI
function updateSummary(){
    document.getElementById("s_exp").innerText = selectedExperience || "—";
    document.getElementById("s_cam").innerText = cameraType;
    document.getElementById("s_dr").innerText = (document.getElementById("drone") && document.getElementById("drone").checked) ? "Yes" : "No";
    document.getElementById("s_tr").innerText = document.getElementById("travel")?.value || 0;
    document.getElementById("s_hr").innerText = document.getElementById("hours")?.value || 0;
    document.getElementById("s_ph").innerText = document.getElementById("photos")?.value || 0;
    document.getElementById("totalPrice").innerText = totalPrice;
}

// Payment + save booking
document.getElementById("payBtn").onclick = ()=>{
    if (totalPrice <= 0) { alert("Invalid total."); return; }

    // Validate contact fields
    let client_name = document.getElementById("client_name").value.trim();
    let client_email = document.getElementById("client_email").value.trim();
    let client_phone = document.getElementById("client_phone").value.trim();
    if (!client_name || !client_email || !client_phone) { alert("Please enter name, email and phone."); return; }

    let options = {
        key: window.RAZORPAY_KEY || "",
        amount: totalPrice * 100,
        currency: "INR",
        name: "ZEIRO Photography",
        description: "Experience Booking",
        handler: function(response){
            // Build FormData and send to save_booking.php
            let data = new FormData();
            data.append("name", client_name);
            data.append("email", client_email);
            data.append("phone", client_phone);
            data.append("experience", selectedExperience);
            data.append("camera", cameraType);
            // add-ons
            addonsPerCamera[cameraType].forEach(a=>{
                let el = document.getElementById(a);
                if (!el) return;
                if (el.type === "checkbox") data.append(a, el.checked ? "1" : "0");
                if (el.type === "number") data.append(a, el.value);
            });
            data.append("payment_id", response.razorpay_payment_id);

            fetch("save_booking.php", { method:"POST", body: data })
            .then(r=>r.text())
            .then(txt=>{
                if (txt.trim() === "success") {
                    alert("Booking Confirmed! Payment ID: " + response.razorpay_payment_id);
                    window.location.href = "client/dashboard.php";
                } else {
                    alert("Server: " + txt);
                }
            })
            .catch(e=>{
                alert("Network error: " + e);
            });
        }
    };

    let rzp = new Razorpay(options);
    rzp.open();
};

// init
renderAddons();
calculatePrice();

