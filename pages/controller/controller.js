function updateStatus(id) {
  var checkbox = document.getElementById("toggleButton" + id);
  console.log("toggleButton" + id);
  var status = checkbox.checked ? "online" : "offline";

  // Mengirim permintaan ke server menggunakan AJAX
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./pages/controller/update_status.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Tindakan yang ingin Anda lakukan setelah berhasil mengirim status
      console.log("Status berhasil diperbarui.");
    } else if (xhr.readyState === 4 && xhr.status !== 200) {
      // Tindakan yang ingin Anda lakukan jika terjadi kesalahan
      console.log("Terjadi kesalahan saat mengirim status.");
    }
  };
  xhr.send("id=" + id + "&status=" + status);
}

window.addEventListener('load', function() {
  // Mengambil data status dari tabel 'controller' menggunakan AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('GET', "./pages/controller/get_status.php", true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var statusData = JSON.parse(xhr.responseText);

      // Memeriksa nilai status dan memperbarui toggle button sesuai dengan data yang diterima
      for (var i = 1; i <= statusData.length; i++) {
        var checkbox = document.getElementById('toggleButton' + i);
        var status = statusData[i - 1].status;

        if (status === 'online') {
          checkbox.checked = true;
        }
      }
    }
  };
  xhr.send();
});