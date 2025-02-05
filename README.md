# Gestión de Órdenes de Servicio para Centros de Atención Automotriz

Este proyecto es una aplicación web desarrollada con FilamentPHP, diseñada para gestionar órdenes de servicio en centros de atención automotriz. Permite a los usuarios administrar clientes, vehículos, técnicos, productos y servicios, facilitando la creación y seguimiento de órdenes de servicio.

## Tabla de Contenidos

- [Instalación](#instalación)
- [Uso](#uso)
- [Características](#características)
- [Contribución](#contribución)
- [Licencia](#licencia)

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/tu_usuario/tu_proyecto.git
   ```

2. Navega al directorio del proyecto:
   ```bash
   cd tu_proyecto
   ```

3. Instala las dependencias:
   ```bash
   composer install
   npm install
   ```

4. Configura el archivo `.env`:
   - Copia el archivo `.env.example` a `.env` y ajusta las configuraciones necesarias, como la base de datos.

5. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```

6. Ejecuta las migraciones de la base de datos:
   ```bash
   php artisan migrate
   ```

## Uso

Para iniciar la aplicación, ejecuta el siguiente comando:
```bash
php artisan serve
```
Luego, abre tu navegador y visita `http://localhost:8000` para acceder a la aplicación.

## Características

- **Gestión de Clientes**: Registra y administra la información de los clientes.
- **Gestión de Vehículos**: Asocia vehículos a los clientes y gestiona sus detalles.
- **Gestión de Técnicos**: Administra los técnicos disponibles para realizar servicios.
- **Gestión de Productos y Servicios**: Administra los productos y servicios ofrecidos.
- **Órdenes de Servicio**: Crea, edita y visualiza órdenes de servicio, incluyendo detalles como fallas reportadas, procedimientos autorizados, y más.
- **Notificaciones**: Envía notificaciones a los clientes a través de WhatsApp con enlaces a sus órdenes de servicio.

## Contribución

Si deseas contribuir, por favor sigue los siguientes pasos:

1. Haz un fork del proyecto.
2. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y haz commit (`git commit -m 'Añadir nueva funcionalidad'`).
4. Sube tus cambios a la rama (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request.

## Licencia

Este proyecto está bajo la Licencia MIT - mira el archivo [LICENSE](LICENSE) para más detalles.
