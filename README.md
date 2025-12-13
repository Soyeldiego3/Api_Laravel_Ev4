# API de Catálogo con CI/CD en AWS - EV4 Transformacion Digital

API RESTful desarrollada en Laravel como parte de un proyecto de implementación de un flujo de trabajo de Integración y Despliegue Continuo (CI/CD) con GitHub Actions.

## Arquitectura

La infraestructura del proyecto se compone de:

-   **Aplicación**: La API de Laravel se despliega en una instancia **EC2 de AWS**.
-   **Base de Datos**: Se utiliza un servidor **PostgreSQL** externo para alojar la base de datos.
-   **Automatización**: El despliegue y la configuración del servidor se gestionan a través de **Ansible**.

## Flujo de Trabajo CI/CD

El proyecto está configurado con un pipeline automatizado usando **GitHub Actions** que se activa con cada `push` a la rama `main`. Este flujo de trabajo se divide en dos `jobs` principales que se ejecutan de forma secuencial:

### 1. Job de Análisis de Código (`sonarqube`)

Este es el primer paso del pipeline y su objetivo es asegurar la calidad y seguridad del código fuente de la API antes de cualquier despliegue.

-   **Checkout del Código**: El workflow clona el repositorio de la API (`Api_Laravel_Ev4`) para tener acceso al código fuente que será analizado.
-   **Análisis Estático con SonarQube**: Se ejecuta la acción de SonarCloud/SonarQube que realiza un análisis estático del código. Este escaneo revisa múltiples aspectos, entre ellos:
-   **Bugs y Vulnerabilidades**: Detección de errores comunes y fallos de seguridad conocidos.
-   **"Code Smells"**: Identificación de malas prácticas y código confuso que dificultan el mantenimiento.
-   **Duplicación de código**: Búsqueda de lógica repetida que podría ser refactorizada.
-   **Quality Gate**: Los resultados se comparan contra un "Quality Gate" (umbral de calidad) predefinido en SonarQube. Si el código no cumple con los estándares mínimos, el job falla, el pipeline se detiene y se previene el despliegue.

### 2. Job de Despliegue (`deploy`)

Este job depende del éxito del job anterior y es el responsable de poner en producción la nueva versión de la aplicación.

-   **Condición de Ejecución**: Solo se inicia si el job `sonarqube` ha finalizado correctamente.
-   **Configuración del Entorno**:
-   Se instala **Ansible**, la herramienta de automatización que orquestará el despliegue.
-   Se configura la clave **SSH privada** (almacenada de forma segura en los Secrets de GitHub) para permitir la conexión con la instancia EC2 de AWS.
-   **Ejecución del Playbook de Ansible**: Se lanza el playbook de Ansible que ejecuta una serie de tareas automatizadas en el servidor remoto:
    1.  Actualiza el código de la aplicación en el servidor haciendo `git pull`.
    2.  Instala o actualiza las dependencias de PHP con `composer install`.
    3.  Aplica las migraciones de la base de datos con `php artisan migrate`.
    4.  Limpia y regenera las cachés de configuración y rutas para optimizar el rendimiento.
    5.  Asegura que los permisos de los directorios sean los correctos.
-   **Verificación**: Una vez finalizado el playbook, el workflow realiza una petición `curl` al endpoint de la aplicación para confirmar que el despliegue ha sido exitoso y la API responde correctamente.

## Tecnologías Utilizadas

-   Laravel
-   PostgreSQL
-   AWS (EC2)
-   Ansible
-   SonarQube
-   GitHub Actions.