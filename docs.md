# MÉTODOS HTTP

Los métodos HTTP son los encargados de interactuar con recursos en un servidor web y cada uno tiene un propósito específico:

### GET

El método HTTP GET se utiliza para solicitar y obtener recursos específicos de un servidor web. Al enviar una solicitud GET, el cliente solicita al servidor que devuelva la representación del recurso solicitado. Este método es seguro, ya que no debe tener ningún efecto secundario en el servidor.

### POST

El método HTTP POST se utiliza para enviar datos al servidor y crear un nuevo recurso. Al enviar una solicitud POST, el cliente envía los datos en el cuerpo de la solicitud al servidor, que luego los procesa y crea un nuevo recurso en función de esos datos. A diferencia del método GET, el método POST puede tener efectos secundarios en el servidor, como la creación de un nuevo registro en una base de datos.

### PUT

El método HTTP PUT se utiliza para actualizar o reemplazar un recurso existente en un servidor web. Al enviar una solicitud PUT, el cliente envía los datos en el cuerpo de la solicitud al servidor, que luego los utiliza para actualizar el recurso especificado. Si el recurso no existe, el servidor puede crearlo. Este método es idempotente, lo que significa que realizar múltiples solicitudes PUT con los mismos datos no tendrá efectos secundarios adicionales más allá de la actualización del recurso.

### DELETE

El método HTTP DELETE se utiliza para eliminar un recurso existente en un servidor web. Al enviar una solicitud DELETE, el cliente solicita al servidor que elimine el recurso especificado. Este método es idempotente, lo que significa que realizar múltiples solicitudes DELETE con el mismo recurso no tendrá efectos secundarios adicionales más allá de eliminar el recurso.

### PATCH

Similar a PUT, se utiliza para modificar parcialmente un recurso en el servidor. Se envían solo los datos que deben ser actualizados, lo que lo hace útil para actualizar partes específicas de un recurso sin necesidad de enviar todos los datos.

### HEAD

El método HTTP HEAD se utiliza para solicitar los encabezados que se devolverían si la misma solicitud fuera una solicitud GET. Por lo tanto, HEAD es idéntico a GET, excepto que el servidor no devuelve un cuerpo de respuesta en la respuesta. Este método es idempotente, lo que significa que realizar múltiples solicitudes HEAD con los mismos datos no tendrá efectos secundarios adicionales más allá de obtener los encabezados de la respuesta.

### OPTIONS

Se utiliza para obtener la información sobre los métodos HTTP permitidos en un recurso determinado. Esto es útil para verificar qué métodos son compatibles con un recurso en particular.

### PROPFIND

Este método se usa en el protocolo WebDAV para recuperar propiedades de un recurso web. Se utiliza para obtener información sobre colecciones de recursos, como archivos y directorios.

### CUSTOM

No es un método HTTP estándar, pero se refiere a métodos personalizados definidos por el desarrollador para su aplicación específica. Pueden ser métodos específicos de una API o aplicación que no están definidos por HTTP.


## Conclusión

Los métodos HTTP son los encargados de interactuar con recursos en un servidor web y cada uno tiene un propósito específico.