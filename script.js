function updateJam() {
const waktu = new Date();
document.getElementById('jam').innerText = waktu.toLocaleTimeString('id-ID');
}
setInterval(updateJam, 1000);


function absenMasuk() {
const t = document.getElementById('tabelAbsensi');
const row = t.insertRow(-1);
const tanggal = new Date().toLocaleDateString('id-ID');
const jam = new Date().toLocaleTimeString('id-ID');
const status = new Date().getHours() <= 8 ? 'Tepat Waktu' : 'Terlambat';
const warna = status === 'Terlambat' ? 'red' : 'green';
row.insertCell(0).innerText = t.rows.length - 1;
row.insertCell(1).innerText = tanggal;
row.insertCell(2).innerText = jam;
row.insertCell(3).innerText = '-';
row.insertCell(4).innerHTML = `<span style='color:${warna}'>${status}</span>`;
}


function absenPulang() {
const t = document.getElementById('tabelAbsensi');
if (t.rows.length > 1) {
const row = t.rows[t.rows.length - 1];
row.cells[3].innerText = new Date().toLocaleTimeString('id-ID');
alert('Absen pulang berhasil!');
}
}