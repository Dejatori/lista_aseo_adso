<?php
class Conexion {
	// Datos de conexión
	private string $host;
	private string $db;
	private string $usuario;
	private string $clave;
	private int $puerto;
	private string $charset;

	// Instancia de la conexión
	private static ?PDO $instance = null;

	/**
	 * Método constructor
	 *
	 * Se inicializan los datos de conexión y se establece el charset por defecto
	 *
	 * @param string $host
	 * @param string $db
	 * @param string $usuario
	 * @param string $clave
	 * @param int $puerto
	 * @param string $charset
	 */
	public function __construct(string $host, string $db, string $usuario, string $clave, int $puerto = 3306, string $charset = 'utf8mb4')
	{
		$this->host = $host;
		$this->db = $db;
		$this->usuario = $usuario;
		$this->clave = $clave;
		$this->puerto = $puerto;
		$this->charset = $charset;
	}

	/**
	 * Método para obtener la instancia de la conexión
	 *
	 * Si no existe una instancia, se crea una nueva
	 *
	 * @throws Exception
	 * @return PDO
	 */
	public function connect(): PDO
	{
		if (self::$instance === null) {
			$dsn = "mysql:host=$this->host;port=$this->puerto;dbname=$this->db;charset=$this->charset";
			try {
				self::$instance = new PDO($dsn, $this->usuario, $this->clave);
				// Configurar PDO para lanzar excepciones cuando ocurra un error
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// Configurar PDO para devolver arrays asociativos por defecto
				self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				// Configurar PDO para desactivar la emulación de consultas preparadas
				self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			} catch (PDOException $e) {
				// Si ocurre un error, lanzar una excepción con el mensaje de error
				// Una excepción es un objeto que representa un error
				// El mensaje de error se obtiene con el método getMessage()
				throw new Exception('Error de conexión a la base de datos: ' . $e->getMessage());
			}
		}

		// Devolver la instancia
		return self::$instance;
	}
}