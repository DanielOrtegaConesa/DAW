function showDescarga(datos) {
    datos = JSON.parse(datos);

    for (let c in datos["resultados"]) {
        let dfactura = datos["resultados"][c];
        let doc = new jsPDF('p', 'mm', [297, 210]);

        doc.setProperties({
            title: 'Facturas',
            subject: 'Listado Facturas',
            author: 'Gestor',
            creator: 'Gestor'
        });

        let logo = new Image();
        logo.src = 'data:image/png;base64,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';

        doc.addImage(logo, 'JPEG', 20, 20, 30, 10);
        doc.setFontSize(8);
        doc.text(150, 20, "DaniPhone S.L.");
        doc.text(150, 24, "CIF: 11111111H");
        doc.text(150, 28, "EMAIL: admin@danielortegaconesa.com");
        doc.text(150, 32, "TELF: 666666666");
        doc.text(150, 36, "C/ Calle de la piruleta, Elche Alicante");


        let columns = ["Articulo", "Precio", "Cantidad", "Descuento", "Iva", "Total"];
        let data = [];
        doc.setFontSize(15);
        doc.text(20, 40, "CLIENTE");
        doc.setFontSize(8);
        doc.text(20, 45, dfactura[0]["nick"]);
        doc.text(20, 49, 'CIF / DNI : ' + dfactura[0]["dni"]);
        doc.text(20, 53, 'Razon social: ' + dfactura[0]["razonSocial"]);
        doc.text(20, 57, 'Domicilio social: ' + dfactura[0]["domicilioSocial"]);
        doc.text(20, 61, 'Ciudad: ' + dfactura[0]["ciudad"]);

        doc.setFontSize(15);
        doc.text(150, 45, "Factura");
        doc.setFontSize(8);
        doc.text(150, 50, 'Codigo factura: ' + dfactura[0]["codFactura"]);
        doc.text(150, 54, 'Fecha: ' + dfactura[0]["fecha"]);

        let totalFactura = 0;
        totalFactura *= 1;

        for (let i in dfactura) {
            let codArticulo = dfactura[i]["codArticulo"];
            let articulo = dfactura[i]["nombre"];
            let precio = dfactura[i]["precio"];
            let cantidad = dfactura[i]["cantidad"];
            let descuento = dfactura[i]["descuento"];
            let iva = dfactura[i]["iva"];

            let totalLinea = precio * cantidad;
            totalLinea *= ((100 - descuento) / 100);
            totalLinea *= iva;

            totalFactura += totalLinea;
            let ivaReducido = iva.substring(2);

            let linea = [
                codArticulo + " - " + articulo,
                precio + "€",
                cantidad,
                descuento + "%",
                ivaReducido + "%",
                (Math.round(totalLinea * 100) / 100)+"€"
            ];
            data.push(linea);
        }
        doc.autoTable(columns, data, {styles: {fontSize: 8, overflow: 'linebreak'}, margin: {top: 81}});

        let descuentoFactura = dfactura[0]["descuentoFactura"];
        let totalFacturaDescuento = totalFactura * ((100 - descuentoFactura) / 100);

        doc.text(20, 70, 'Total: ' + Math.round(totalFactura * 100) / 100 + " €   /   Total con descuento: " + Math.round(totalFacturaDescuento * 100) / 100 + " €");
        doc.output('dataurlnewwindow');
        doc.save("factura.pdf");
    }
}