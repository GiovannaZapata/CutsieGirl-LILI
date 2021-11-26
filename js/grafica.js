function verGrafica() {

    $.ajax({
        url: 'controllers/controller_getGrafica.php',
        success: function(data) {

            graphicData = JSON.parse(data)

            var datos = [{
                values: [],
                labels: [],
                marker: {'colors': [
                    'rgb(255, 179, 186)',
                    'rgb(255, 255, 186)',
                    'rgb(186, 255, 201)',
                    'rgb(186, 225, 255)'
                ]},
                type: 'pie'
            }];

            for(value of graphicData) {
                datos[0].labels.push(value['nombre'])
                datos[0].values.push(value['cantidad'])
            }

            var layout = {
                height: 400,
                width: 500
            };
              
            Plotly.newPlot('grafica', datos, layout);
        }
    })
}

