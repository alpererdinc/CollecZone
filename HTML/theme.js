// Tema geçişi fonksiyonu
const toggleSwitch = document.getElementById('theme-toggle');


// Tercih edilen temayı localStorage'dan al
const currentTheme = localStorage.getItem('theme');

// Eğer bir tema belirlenmişse, sayfaya uygula
if (currentTheme) {
    document.body.classList.add(currentTheme);

    // Switch butonunun durumunu güncelle
    if (currentTheme === 'colored-theme') {
        toggleSwitch.checked = true;
    }
}

// Tema değişikliğini kontrol et
toggleSwitch.addEventListener('change', () => {
    document.body.classList.toggle('colored-theme');

    // Ana metin renklerini değiştir
    const mainTextElements = document.querySelectorAll('.mainText, .mainText2');
    mainTextElements.forEach((element) => {
        if (document.body.classList.contains('colored-theme')) {
            // Koyu temaya geçiş
            element.style.color = '#ffffff'; // Koyu metin rengi
        } else {
            // Aydınlık temaya geçiş
            if (element.classList.contains('mainText')) {
                element.style.color = '#FF5B5B'; // Aydınlık tema için ana metin rengi
            } else if (element.classList.contains('mainText2')) {
                element.style.color = '#000'; // Aydınlık tema için ana metin 2 rengi
            }
        }
    });
});


// Tema değiştirildiğinde tetiklenen fonksiyon
toggleSwitch.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('colored-theme');
        localStorage.setItem('theme', 'colored-theme');
    } else {
        document.body.classList.remove('colored-theme');
        localStorage.setItem('theme', '');
    }
});

