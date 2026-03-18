(async function(){
    var imgs = [
        '/upload/Banner/2026\ud574\uc548\uac74\ucd95.jpg',
        '/upload/Banner/HEERIM25.jpg',
        '/upload/Banner/SHINHWA25.jpg',
        '/upload/Banner/A3_JUNGLIM.png',
        '/upload/Banner/POSCO25.jpg',
        '/upload/Banner/250922_theM.jpg',
        '/upload/Banner/2026\ubb34\uc601\uc528\uc5e0.jpg',
        '/upload/Banner/2026\uc0bc\uc6b0\uc528\uc5e0.jpg',
        '/upload/Banner/2026\uc804\uc778\uc528\uc5e0.jpg',
        '/upload/Banner/B5 TOMOON.jpg',
        '/upload/Banner/B6 TOPEC.jpg',
        '/upload/Banner/B1 KUNWON.jpg',
        '/upload/Banner/CMAK01_3003.jpg',
        '/upload/Banner/CMAK02.jpg',
        '/upload/Banner/CMAK03.jpg'
    ];
    for (var i = 0; i < imgs.length; i++) {
        try {
            var r = await fetch(imgs[i]);
            if (!r.ok) { console.log('SKIP', imgs[i], r.status); continue; }
            var b = await r.blob();
            var reader = new FileReader();
            var url = await new Promise(function(ok) {
                reader.onload = function() { ok(reader.result); };
                reader.readAsDataURL(b);
            });
            var name = decodeURIComponent(imgs[i].split('/').pop());
            var a = document.createElement('a');
            a.href = url;
            a.download = name;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            console.log('OK', name);
        } catch(e) {
            console.log('ERR', imgs[i], e.message);
        }
        await new Promise(function(r) { setTimeout(r, 500); });
    }
    console.log('done!');
})();
