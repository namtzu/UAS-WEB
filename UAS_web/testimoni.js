document.addEventListener("DOMContentLoaded", function(){

    const testiCon = document.getElementById("testimoni-container");

    fetch("get_testimoni.php")
    .then(response => response.json())
    .then(data => {
        
        data.forEach(item => {
        const div = document.createElement('div');
        div.classList.add('testimoni');
        div.innerHTML = `
          <h4>${item.nama}</h4>
          <h3>${'★'.repeat(item.rating)}</h3>
          <p>"${item.ulasan}"</p>
        `;
        testiCon.appendChild(div);
      });
    })
    .catch(err => console.error('Gagal memuat testimoni:', err));
});

document.getElementById('testimoni-form').addEventListener('submit', function (e) {
  e.preventDefault();

  const nama = document.getElementById('nama').value;
  const pesan = document.getElementById('pesan').value;
  const ratingInput = document.querySelector('input[name="bintang"]:checked');

  if (!ratingInput) {
    alert('Silakan pilih rating bintang.');
    return;
  }

  const bintang = ratingInput.value;

  const body = new URLSearchParams();
  body.append('nama', nama);
  body.append('pesan', pesan);
  body.append('bintang', bintang);

  fetch('input_testimoni.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: body.toString(),
  })
    .then((res) => res.text())
    .then((data) => {
      alert(data);
      this.reset();
    })
    .catch((err) => {
      console.error('Error:', err);
      alert('Terjadi kesalahan saat mengirim data.');
    });
});
