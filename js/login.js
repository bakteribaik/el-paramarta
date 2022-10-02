function showPassword(){
    x = document.getElementById("showPass")
    z = document.getElementById("forminputPassword")

    if (z.type === 'password') {
        z.type = "text"
    }else{
        z.type = "password"
    }
}

function loginCheck(){
    console.log('login check')
    x = document.getElementById("forminput")
    y = document.getElementById("forminputPassword")

    if (isFinite(x.value) == false) {
        alert('NISN/NIP hanya nomor!')
        return false;
    }
    if (x.value.length == 0) {
        alert('NISN/NIP tidak boleh kosong!')
        return false;
    }
    if (y.value.length == 0) {
        alert('Password tidak boleh kosong!')
        return false;
    }
}