
# Bus Booking System

It's a bus booking system (fleet system) that addresses the problem of finding reservations for trips between different stations. The system allows for the creation of stations and trips, with itineraries defining the routes. Users can then book seat(s) on any trip, traveling between stations within the range of that specific trip.

## Requirements

- Local server, e.g., XAMPP, WAMP, Laragon. I prefer Laragon.

- PHP 8.1 (Required for Laravel 10).


## Installation

Clone the project:

```bash
  git clone https://github.com/ameer-ahmed/bus-booking.git
```

Install composer packages:

```bash
  composer install
```

Generate new JWT secret:

```bash
  php artisan jwt:secret
```

Migrate and seed database (or import it directly from attached file `bus_booking.sql`)

```bash
  php artisan migrate --seed
```

## API Reference

**Note: You can import postman-collection of the APIs from attached file `Bus Booking.postman_collection.json` to make test.**

#### Auth/Login

```http
  POST /api/v1/auth/login
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Required**. Your email |
| `password` | `string` | **Required**. Your password |


#### Auth/Register

```http
  POST /api/v1/auth/register
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**. Your name |
| `email`      | `string` | **Required**. Your email |
| `password`      | `string` | **Required**. Your password |
| `phone`      | `string` | **Required**. Your phone |

#### Auth/Refresh Token

```http
  POST /api/v1/auth/refresh
```

#### Auth/Logout
```http
  POST /api/v1/auth/logout
```

#### Booking/Search For a Trip

```http
  POST /api/v1/booking/search
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `seats`      | `int` | **Required**. Number of seats |
| `pickup_station_id`      | `int` | **Required**. Id of pickup-station |
| `dropoff_station_id`      | `int` | **Required**. Id of dropoff-station |

#### Booking/Reserve Trip

```http
  POST /api/v1/booking/reserve
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `trip_id`      | `int` | **Required**. Id of trip |
| `seats`      | `int` | **Required**. Number of seats |
| `pickup_station_trip_id`      | `int` | **Required**. Id of pickup-station_trip |
| `dropoff_station_trip_id`      | `int` | **Required**. Id of dropoff-station_trip |



