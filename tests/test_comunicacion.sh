set -uo pipefail

COMPOSE="${COMPOSE:-docker compose -p licorera_ci -f docker-compose.yml -f docker-compose.ci.yml}"
MENSAJE="jenkins-build-${BUILD_NUMBER:-local}-$(date +%s)"

fallar() { echo "ERROR: $1"; exit 1; }

echo "== 1/4 El contenedor web debe resolver el nombre del servicio 'db' =="
$COMPOSE exec -T web getent hosts db || fallar "el contenedor web no resuelve el nombre 'db'"

echo "== 2/4 DB_HOST debe ser el nombre del servicio (no localhost ni una IP) =="
DB_HOST_VALOR="$($COMPOSE exec -T web printenv DB_HOST | tr -d '\r\n')"
echo "DB_HOST=${DB_HOST_VALOR}"
[ "$DB_HOST_VALOR" = "db" ] || fallar "DB_HOST vale '${DB_HOST_VALOR}' y debería ser 'db'"

echo "== 3/4 Guardar un dato (POST) y leerlo de vuelta (GET) =="
RESPUESTA=""
for intento in $(seq 1 30); do
  if RESPUESTA="$($COMPOSE exec -T web curl -fsS -L --max-redirs 3 -d "mensaje=${MENSAJE}" http://localhost/prueba_db.php 2>/dev/null)"; then
    break
  fi
  RESPUESTA=""
  echo "  intento ${intento}/30: la aplicación aún no responde..."
  sleep 2
done
[ -n "$RESPUESTA" ] || fallar "prueba_db.php no respondió correctamente"

echo "== 4/4 Verificar la respuesta =="
echo "$RESPUESTA" | grep -q "Conexión exitosa" || fallar "la página no reporta 'Conexión exitosa'"
echo "$RESPUESTA" | grep -q "${MENSAJE}" || fallar "el dato guardado no se leyó de vuelta desde MySQL"

echo "OK: el dato '${MENSAJE}' se guardó y se leyó de vuelta; web y db se comunican por el nombre 'db'."
