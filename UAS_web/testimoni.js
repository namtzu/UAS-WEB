document.getElementById('testimoni-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const nama = document.getElementById('nama').value;
    const pesan = document.getElementById('pesan').value;
    const rating = document.querySelector('input[name="bintang"]:checked');

    if (!rating) {
        alert("Silakan pilih rating bintang!");
        return;
    }

    const bintang = rating.value;

    const container = document.getElementById('testimoni-container');
    const newTestimoni = document.createElement('div');
    newTestimoni.classList.add('testimoni');

    const stars = '★'.repeat(bintang);

    newTestimoni.innerHTML = `
        <h4>${nama}</h4>
        <h3>${stars}</h3>
        <p>"${pesan}"</p>
    `;

    container.prepend(newTestimoni); 

    alert("Terima kasih atas testimoni Anda!");

    this.reset();
});