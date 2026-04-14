$(document).ready(function() {
            
            //VALIDACIONES DE ENTRADA EN TIEMPO REAL            
            $('#nombre').on('input', function() {
            
                this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
            });
  
            $('#edad').on('keydown', function(e) {
                if (['e', 'E', '+', '-', '.'].includes(e.key)) {
                    e.preventDefault(); 
                }
            });
           
            $('#edad').on('input', function() {
                
                let valor = this.value.replace(/[^0-9]/g, '');
                
               
                this.value = valor.replace(/^0+/, '');
            });
   
            $('#sueldo').on('keydown', function(e) {
                if (['e', 'E', '+', '-'].includes(e.key)) {
                    e.preventDefault();
                }
            });
           
            $('#sueldo').on('input', function() {
             
                let valor = this.value.replace(/[^0-9.]/g, '');
                    valor = valor.replace(/^0+(?=\d)/, '');
                              
                let partes = valor.split('.');
                if (partes.length > 2) {
                   
                    valor = partes[0] + '.' + partes[1];
                }
                             
                if (valor.includes('.')) {
                    let decimales = valor.split('.')[1];
                    if (decimales.length > 2) {
                       
                        valor = valor.substring(0, valor.indexOf('.') + 3);
                    }
                }
                
                this.value = valor;
            });
                        

            
        });