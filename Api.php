<?php

require_once 'Conexion.php';

final readonly class Api {
	// Instancia de la conexión
    private PDO $db;

	/**
	 * Método constructor
	 *
	 * Se inicializa la conexión a la base de datos y se captura cualquier excepción
	 *
	 * @param Conexion $conexion
	 *
	 * @throws Exception Si ocurre un error en la conexión a la base de datos
	 * @return void
	 */
	public function __construct(Conexion $conexion)
	{
		try {
			$this->db = $conexion->connect();
		} catch (PDOException|Exception $e) {
			$this->manejarError($e->getMessage());
		}
	}

	/**
	 * Método para manejar los errores de conexión a la base de datos
	 *
	 * Este método se ejecuta cuando ocurre un error al conectarse a la base de datos
	 *
	 * @param $mensaje
	 *
	 * @return never
	 */
	private function manejarError($mensaje): never
	{
		echo json_encode([
			'titulo' => 'Error al conectar a la base de datos',
			'mensaje' => $mensaje
		]);
		exit;
	}

	/**
	 * Método para procesar la solicitud
	 *
	 * Este método se ejecuta cuando se recibe una solicitud
	 * Se obtiene el método de la solicitud y se ejecuta el método correspondiente
	 *
	 * @return void
	 */
    public function procesarSolicitud(): void
    {
        // Obtener el método de la solicitud
	    $metodo = $_SERVER['REQUEST_METHOD'];

	    // Obtener el id de la solicitud
	    $id = null;
	    if ($metodo === 'GET' || $metodo === 'PUT' || $metodo === 'PATCH') {
		    // Para los métodos GET, PUT y PATCH, obtener el id de la URL
		    $id = $_GET['id'] ?? null;
	    } else if ($metodo === 'POST') {
		    // Para el método POST, obtener el id del cuerpo de la solicitud
		    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
		    if (str_contains($contentType, 'application/json')) {
			    $input = json_decode(file_get_contents('php://input'), true);
			    $id = $input['id'] ?? null;
		    } else {
			    $id = $_POST['id'] ?? null;
		    }
	    }

        // Ejecutar el método correspondiente
        match ($metodo) {
            'GET' => $this->get($id),
            'POST' => $this->post($id),
            'PUT' => $this->put($id),
            'PATCH' => $this->patch($id),
            default => json_encode(['error' => 'Método no soportado'])
        };
    }

	/**
	 * Método para ejecutar la consulta
	 *
	 * Este método se ejecuta cuando se recibe una solicitud
	 *
	 * @param $metodo
	 * @param $id
	 *
	 * @return void
	 */
	private function ejecutarConsulta($metodo, $id): void
	{
		try {
			// Actualizar el registro de la solicitud por su id
			$sql = 'UPDATE lista SET puntos = puntos + 1 WHERE id = ?';
			$stmt = $this->db->prepare($sql);
			$stmt->execute([$id]);

			// Obtener los valores actualizados de 'aprendiz' y 'puntos'
			$sql = 'SELECT aprendiz, puntos FROM lista WHERE id = ?';
			$stmt = $this->db->prepare($sql);
			$stmt->execute([$id]);
			$row = $stmt->fetch();

			if (!$row) {
				echo json_encode(['error' => 'No se encontró un registro con el ID proporcionado']);
				exit;
			}

			$aprendiz = $row['aprendiz'];
			$puntos = $row['puntos'];

			// Respuesta de la API en formato JSON
			echo json_encode([
				'titulo' => '¡Registro actualizado por método ' . $metodo . '!',
				'mensaje' => 'Que tengas un buen día ' . $aprendiz,
				'puntos' => 'Tu puntuación actual es: ' . $puntos
			]);
		} catch (PDOException $e) {
			echo json_encode(['Error dentro de la base de datos' => $e->getMessage()]);
		}
	}

	// Métodos para ejecutar la consulta según el método de la solicitud
    public function get($id): void
    {
	    $this->ejecutarConsulta('GET', $id);
    }

    public function post($id): void
    {
		$this->ejecutarConsulta('POST', $id);
    }

    public function put($id): void
    {
		$this->ejecutarConsulta('PUT', $id);
    }

    public function patch($id): void
    {
        $this->ejecutarConsulta('PATCH', $id);
    }
}

// Crear una instancia de la conexión - cambiar los valores según la configuración de tu servidor
// Por defecto, el puerto es 3306 y el charset es utf8mb4 si no se proporcionan
try {
	$conexion = new Conexion('localhost', 'lista_aseo', 'root', '');
} catch (ArgumentCountError $e) {
	echo json_encode([
		'titulo' => 'Error en la conexión',
		'mensaje' => 'No se proporcionaron suficientes argumentos al constructor de Conexion',
		'error' => $e->getMessage()
	]);
	exit;
}
// Crear una instancia de la API y procesar la solicitud
try {
	$api = new Api($conexion);
	$api->procesarSolicitud();
} catch (Exception $e) {
	echo json_encode([
		'titulo' => 'Error en la API',
		'mensaje' => $e->getMessage()
	]);
}