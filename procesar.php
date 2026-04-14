<?php
// Configurar el encabezado para devolver una respuesta JSON válida
header('Content-Type: application/json');

// Verificar que la solicitud sea por el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recolectar datos enviados por AJAX, asignando valores por defecto si están vacíos
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $edad = isset($_POST['edad']) ? (int)$_POST['edad'] : 0;
    $sueldo_pretendido = isset($_POST['sueldo']) ? (float)$_POST['sueldo'] : 0.0;

    // 1. Cálculo de Renta (10% de descuento)
    $descuento_renta = $sueldo_pretendido * 0.10;
    $sueldo_con_descuento = $sueldo_pretendido - $descuento_renta;
    
    // Formatear el sueldo neto a dos decimales para usar en los mensajes
    $sueldo_formateado = number_format($sueldo_con_descuento, 2);

    // 2. Evaluación de Perfil
    // Condición: Edad >= 18 Y Sueldo neto > $450.00
    if ($edad >= 18 && $sueldo_con_descuento > 450.00) {
        
        // 3a. Construcción de la Respuesta de Éxito
        $respuesta = [
            'status' => true,
            'mensaje' => "Felicidades {$nombre}, su perfil es apto. Su sueldo neto tras impuestos será de \${$sueldo_formateado}."
        ];
        
    } else {
        
        // 3b. Construcción de la Respuesta de Rechazo
        $respuesta = [
            'status' => false,
            'mensaje' => "Solicitud rechazada. El perfil no cumple con los criterios mínimos de edad o ingresos (Ingreso calculado: \${$sueldo_formateado})."
        ];
        
    }

    // Retornar la respuesta codificada en formato JSON
    echo json_encode($respuesta);

} else {
    // Si se intenta acceder directamente al archivo PHP desde la URL
    echo json_encode([
        'status' => false,
        'mensaje' => 'Método no permitido. Utilice el formulario de la aplicación.'
    ]);
}
?>