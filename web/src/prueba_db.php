<?php
// Página de PRUEBA DE COMUNICACIÓN entre contenedores.
// El contenedor "web" (PHP) se conecta al contenedor "db" (MySQL) usando el
// NOMBRE DEL SERVICIO (DB_HOST=db) dentro de la red de Docker: guarda un dato (INSERT)
// y lo vuelve a leer (SELECT) = operación real de ida y vuelta.
require_once(__DIR__ . '/modelo/Conexion.php');

$h = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
$error = null;
$guardado = null;
$filas = [];
$infoDb = [];
$totales = [];
$pedidos = [];

try {
    $pdo = Conexion::Conectar();

    // IDA: guardar un dato
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mensaje = trim($_POST['mensaje'] ?? '');
        if ($mensaje === '') {
            $mensaje = 'Mensaje de prueba desde el contenedor web';
        }
        $stmt = $pdo->prepare('INSERT INTO prueba_comunicacion (mensaje, origen) VALUES (:mensaje, :origen)');
        $stmt->execute([':mensaje' => $mensaje, ':origen' => gethostname()]);
        // Post/Redirect/Get: al recargar la página (F5) NO se vuelve a enviar el formulario
        header('Location: prueba_db.php?guardado=' . (int)$pdo->lastInsertId());
        exit;
    }
    if (isset($_GET['guardado'])) {
        $guardado = (int)$_GET['guardado'];
    }

    // VUELTA: leer los datos guardados
    $filas = $pdo->query('SELECT id, mensaje, origen, creado_en FROM prueba_comunicacion ORDER BY id DESC LIMIT 10')->fetchAll();

    // Información que demuestra que son contenedores distintos
    $infoDb = $pdo->query('SELECT @@hostname AS contenedor_db, VERSION() AS version_mysql')->fetch();

    // Datos reales de la tienda (tablas que llena la aplicación)
    $totales = $pdo->query('SELECT (SELECT COUNT(*) FROM usuario) AS usuarios,
                                   (SELECT COUNT(*) FROM pedidos) AS pedidos,
                                   (SELECT COUNT(*) FROM productos_pedidos) AS productos_pedidos')->fetch();
    $pedidos = $pdo->query('SELECT p.idPedido, p.TotalCompra, p.FechaPedido, COUNT(pp.idProductoPedido) AS productos
                            FROM pedidos p LEFT JOIN productos_pedidos pp ON pp.idPedido = p.idPedido
                            GROUP BY p.idPedido, p.TotalCompra, p.FechaPedido
                            ORDER BY p.idPedido DESC LIMIT 5')->fetchAll();
} catch (Throwable $e) {
    http_response_code(500);
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba de comunicación web ↔ db</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 820px; margin: 30px auto; padding: 0 15px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px 10px; text-align: left; }
        th { background: #f0f0f0; }
        .ok { color: #1a7f37; } .err { color: #b00020; }
        code { background: #f4f4f4; padding: 2px 5px; }
    </style>
</head>
<body>
    <h1>Prueba de comunicación entre contenedores</h1>

    <?php if ($error): ?>
        <p class="err"><strong>Error de conexión:</strong> <?= $h($error) ?></p>
    <?php else: ?>
        <p class="ok"><strong>Conexión exitosa.</strong></p>
        <ul>
            <li>Host de la base de datos (nombre del servicio): <code><?= $h(getenv('DB_HOST')) ?></code></li>
            <li>Contenedor web (PHP): <code><?= $h(gethostname()) ?></code></li>
            <li>Contenedor db (MySQL): <code><?= $h($infoDb['contenedor_db'] ?? '') ?></code></li>
            <li>Versión de MySQL: <code><?= $h($infoDb['version_mysql'] ?? '') ?></code></li>
        </ul>

        <form method="POST">
            <input type="text" name="mensaje" placeholder="Escribe un mensaje" size="40">
            <button type="submit">Guardar y leer</button>
        </form>

        <?php if ($guardado): ?>
            <p class="ok">Dato guardado en la base de datos con id <strong><?= $guardado ?></strong>. Abajo aparece leído de vuelta.</p>
        <?php endif; ?>

        <h2>Últimos registros leídos desde MySQL</h2>
        <table>
            <tr><th>ID</th><th>Mensaje</th><th>Enviado desde (contenedor web)</th><th>Fecha</th></tr>
            <?php foreach ($filas as $f): ?>
                <tr>
                    <td><?= $h($f['id']) ?></td>
                    <td><?= $h($f['mensaje']) ?></td>
                    <td><?= $h($f['origen']) ?></td>
                    <td><?= $h($f['creado_en']) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$filas): ?><tr><td colspan="4">Aún no hay registros. Usa el botón para guardar uno.</td></tr><?php endif; ?>
        </table>

        <h2>Datos guardados por la tienda (usuarios y pedidos)</h2>
        <p>
            Usuarios registrados: <strong><?= $h($totales['usuarios'] ?? 0) ?></strong> |
            Pedidos: <strong><?= $h($totales['pedidos'] ?? 0) ?></strong> |
            Productos en pedidos: <strong><?= $h($totales['productos_pedidos'] ?? 0) ?></strong>
        </p>
        <table>
            <tr><th>ID pedido</th><th>Total</th><th>Productos</th><th>Fecha</th></tr>
            <?php foreach ($pedidos as $p): ?>
                <tr>
                    <td><?= $h($p['idPedido']) ?></td>
                    <td>$<?= $h(number_format((float)$p['TotalCompra'], 0, ',', '.')) ?></td>
                    <td><?= $h($p['productos']) ?></td>
                    <td><?= $h($p['FechaPedido']) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$pedidos): ?><tr><td colspan="4">Aún no hay pedidos. Registra uno desde la tienda.</td></tr><?php endif; ?>
        </table>
    <?php endif; ?>
</body>
</html>
