<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
  
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $edad = isset($_POST['edad']) ? (int)$_POST['edad'] : 0;
    $sueldo_pretendido = isset($_POST['sueldo']) ? (float)$_POST['sueldo'] : 0.0;

   
    $descuento_renta = $sueldo_pretendido * 0.10;
    $sueldo_con_descuento = $sueldo_pretendido - $descuento_renta;
    
  
    $sueldo_formateado = number_format($sueldo_con_descuento, 2);

    if ($edad >= 18 && $sueldo_con_descuento > 450.00) {
        
     
        $respuesta = [
            'status' => true,
            'mensaje' => "Felicidades {$nombre}, su perfil es apto. Su sueldo neto tras impuestos será de \${$sueldo_formateado}."
        ];
        
    } else {
        
    
        $respuesta = [
            'status' => false,
            'mensaje' => "Solicitud rechazada. El perfil no cumple con los criterios mínimos de edad o ingresos (Ingreso calculado: \${$sueldo_formateado})."
        ];
        
    }

  
    echo json_encode($respuesta);

} else {
    
    echo json_encode([
        'status' => false,
        'mensaje' => 'Método no permitido. Utilice el formulario de la aplicación.'
    ]);
}
?>