var config = {
    development_ando: false,
    baseurl: function() {
        if (this.development_ando) {
            return "http://lidearsipan.test/"
        } else {
            return "http://localhost/LideArsipan/"
        }
    }

}