function tmod(){
    window.open("/tmod/"+document.getElementById('nevek').value);
}

function tmodconf(){
    document.getElementById('tmodositas').action = window.location.href;
}

        document.getElementById('searchbox').style.visibility = "hidden";
        document.getElementById('szoveg').style.maxHeight = "1px";
        document.getElementById('szoveg').style.maxWidth = "1px";
        let lista = ['Intel Core i9-13900K','Intel Core i7-13700K','AMD Ryzen 9 7950X','AMD Ryzen 7 7700X','Intel Core i5-13600K','AMD Ryzen 5 7600X','Intel Core i9-12900K','AMD Ryzen 9 5900X','Intel Core i7-12700K','AMD Ryzen 7 5800X','Intel Core i5-12600K','AMD Ryzen 5 5600X','ASUS ROG Strix RTX 4090', 'MSI GeForceRTX 4080 Gaming X Trio','Gigabyte GeForce RTX 4070 Ti Eagle','ZOTAC Gaming GeForce RTX 4060','EVGA GeForce RTX 4080 FTW3','ASUS TUF Gaming GeForce RTX 4070', 'MSI GeForce RTX 4090 SUPRIM X','Gigabyte AORUS GeForce RTX 4080','ZOTAC Gaming GeForce RTX 4070 Ti','EVGA GeForce RTX 4070 XC','ASUS ROG Strix RTX 4070 Ti','MSI Ventus GeForce RTX 4060','ASUS ROG Maximus Z790 Hero','MSI MPG B650 Carbon WiFi','Gigabyte X670 Aorus Master','ASRock B550 Taichi','ASUS TUF Gaming B660-Plus','MSI MEG Z690 Unify','Gigabyte B550 Aorus Pro','ASRock X570 Phantom Gaming', 'ASUS Prime X670E-Pro','MSI PRO B660M-A', 'Gigabyte Z690 Aorus Elite','ASRock B550M Steel Legend','Kingston Fury Beast 32GB DDR5-6000', 'Corsair Vengeance LPX 16GB DDR4-3200', 'G.Skill Trident Z5 RGB 32GB DDR5-6400','Crucial Ballistix 16GB DDR4-3000','Kingston HyperX Fury 16GB DDR4-2666', 'Corsair Dominator Platinum RGB 32GB DDR4-3200','G.Skill Ripjaws V 16GB DDR4-3600', 'Crucial Ballistix 32GB DDR4-3200','Kingston Fury Renegade 16GB DDR5-6000','Corsair Vengeance RGB Pro 16GB DDR4-3200', 'G.Skill Trident Z Neo 16GB DDR4-3600','Crucial Ballistix 16GB DDR5-5200','Samsung 990 Pro 2TB NVMe SSD','WD Black SN850X 1TB NVMe SSD','Crucial P5 Plus 1TB NVMe SSD','Samsung 980 Pro 1TB NVMe SSD','Seagate FireCuda 530 2TB NVMe SSD','WD Blue SN570 1TB NVMe SSD','Crucial MX500 1TB SATA SSD', 'Samsung 870 QVO 2TB SATA SSD','Seagate Barracuda 510 1TB NVMe SSD','WD Black SN750 1TB NVMe SSD','Crucial P2 1TB NVMe SSD','Samsung 980 EVO Plus 1TB NVMe SSD','Corsair RM850x 850W 80+ Gold', 'Seasonic Focus GX-750, 750W 80+ Gold', 'EVGA SuperNOVA 850 G5, 850W 80+ Gold', 'Cooler Master MWE Gold 750W','Be Quiet! Straight Power 11 850W', 'Corsair CX650M 650W 80+ Bronze', 'Seasonic Prime TX-850, 850W 80+ Titanium','EVGA 600 W1, 600W 80+ White', 'Cooler Master MWE 550W 80+ Bronze','Be Quiet! Pure Power 11 600W','Lian Li PC-O11 Dynamic EVO','NZXT H510','Fractal Design Meshify C','Corsair 4000D Airflow','Phanteks Eclipse P400A', 'Cooler Master MasterBox NR600', 'Be Quiet! Pure Base 500DX','Thermaltake Versa H21','SilverStone SUGO 14','Corsair iCUE 220T','Noctua NH-D15 Chromax Black','Corsair iCUE H150i Elite Capellix', 'be quiet! Dark Rock Pro 4','NZXT Kraken Z73','Arctic Freezer i35', 'Logitech G Pro X Superlight', 'Razer DeathAdder V2','Corsair K70 RGB MK.2', 'SteelSeries Apex Pro', 'Logitech G915 TKL','Razer BlackWidow V3','Corsair HS70 Pro','HyperX Cloud II','Logitech G560','Razer Kraken Tournament Edition', 'Corsair Dark Core RGB/SE','SteelSeries Rival 600', 'Logitech MX Master 3', 'Razer Cynosa V2','Corsair Virtuoso RGB Wireless',];
        lista.sort();
        function betolt(){
            if (document.getElementById('search').value != "") {
                document.getElementById('searchbox').style.visibility = "visible";
                document.getElementById('szoveg').style.maxHeight = "none";
                document.getElementById('szoveg').style.maxWidth = "none";
                document.getElementById('szoveg').innerHTML = "";
                db = 0;
                ossz = 0;
                vane = false;
                termek = document.getElementById('search').value;
                for(i = 0; i < lista.length; i++){
                    if (lista[i].toUpperCase().includes(termek.toUpperCase())) {
                        document.getElementById('szoveg').innerHTML += "<div class='my-2 py-1 row' style='border:1px solid black;border-radius:0px;'><div class='col-md'><img class='img-fluid' style='max-width: 100px;max-height: 100px;border-radius: 10px;' src='blue windows 11.jpg' alt='proba'></div><div class='col-md'><h5><a href='/termek/id'>"+lista[i]+"</a></h5></div></div>";
                        vane = true;
                        db++;
                    }
                    else{
                        vane = false;
                    }
                    if (db == 5) {
                        i = lista.length;
                    }
                }
                if (vane == false) {
                    document.getElementById('szoveg').innerHTML = "<h6 class='my-2' style='font-style:italic;'>Nincs a keresésnek megfelelő termék!</h6>";
                }
                else{
                    for(i = 0; i < lista.length; i++){
                        if (lista[i].toUpperCase().includes(termek.toUpperCase())) {
                            ossz++;
                        }
                    }
                    document.getElementById('szoveg').innerHTML += "<p>Tálálatok száma: "+ossz+" db</p>";
                }
            }
            else if (document.getElementById('search').value == "") {
                document.getElementById('searchbox').style.visibility = "hidden";
                document.getElementById('szoveg').style.maxHeight = "1px";
                document.getElementById('szoveg').style.maxWidth = "1px";
                document.getElementById('szoveg').innerHTML = "";
            }
        }