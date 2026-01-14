function goOrder() {

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

//contact sec

document.getElementById("contactForm").addEventListener("submit", function(e){
  e.preventDefault();
  alert("Message Sent Successfully! ✅");
  this.reset();
});
//rate sec
document.getElementById("starBtn").onclick = ()=>{
  fetch("admin/rate.php")
  .then(res=>res.text())
  .then(total=>{
     document.getElementById("count").innerHTML = total;
  })
}
fetch("admin/get_count.php")
.then(r=>r.text())
.then(t=> document.getElementById("count").innerHTML=t);