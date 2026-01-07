function goOrder() {
  alert("Order page coming soon 🚀");
}


//button order 

const rate = 3.45; // سعر الدولار

function calc() {
  const usd = document.getElementById("usd").value;
  document.getElementById("total").innerText =
    usd ? (usd * rate).toFixed(2) : 0;
}

document.getElementById("orderForm")?.addEventListener("submit", function(e) {
  e.preventDefault();

  const name = document.getElementById("name").value;
  const phone = document.getElementById("phone").value;
  const service = document.getElementById("service").value;
  const usd = document.getElementById("usd").value;
  const total = (usd * rate).toFixed(2);

  const msg =
`New Order - DST
Name: ${name}
Phone: ${phone}
Service: ${service}
Amount: ${usd} USD
Total: ${total} DT`;

  const url = `https://wa.me/216XXXXXXXX?text=${encodeURIComponent(msg)}`;
  window.open(url, "_blank");
});
