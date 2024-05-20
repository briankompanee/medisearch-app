MediSearch is a Symfony-based application designed to search doctors, patients and their corresponding appointments. This application allows users to search for doctors, appointments, and check doctor availability.
#### Setting Up the Development Environment

1. **Clone the Repository**
    ```sh
    git clone https://github.com/briankompanee/medisearch-app.git
    cd medisearch
    ```

2. **Install PHP Dependencies**
    Ensure you have Composer installed, then run:
    ```sh
    composer install
    ```

3. **Install Node.js Dependencies**
    Ensure you have Node.js and npm installed, then run:
    ```sh
    npm install
    ```

4. **Configure Environment Variables**
	I will send a copy of my `.env.local` for you to use so the Mockaroo API that I created will work.
	Also the database connection parameters are in `.env.local`:

5. **Set Up the Database**
    Create the database and run migrations:
```sh
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

6. Run the JSON Importer tool to populate the `medisearch` db with the `patient`, `doctor`, and `appointment` tables 
```shell
   php bin/console app:import-json`
```

7. **Run the Development Server**
    Start the Symfony local server:
    ```sh
    symfony server:start
    ```

    The application will be accessible at `http://localhost:8000`.

#### Key Functionalities

1. **Doctor Management API**
    - View all doctors
    - Add, update, and delete doctor records through API request

2. **Appointment Management API**
    - View all appointments
    - Add, update, and delete appointments through API request

3. **Patient Management API**
	 - View all patients
	 - Add, update, and delete appointments through API request

5. Patient Appointments
	- Search patient appointments by name or email
	- Returns a list of all doctor appointments for the patient
	
6. **Doctor Availability**
    - Check the availability of doctors
    - Integration with Mockaroo API for mock data

####  Mockaroo Schema

2. **Availability Schema**
    - I created a schema in Mockaroo with fields: `id`, `doctor_id`, `date`, `time_slots`
    - Uses the API Endpoint: `https://my.api.mockaroo.com/doctor/availability/{doctor_id}?key=YOUR_MOCKAROO_API_KEY`

## API Endpoints

### Doctors

- **Get all doctors:** `GET /api/doctors`
- **Get a single doctor:** `GET /api/doctors/{id}`
- **Create a new doctor:** `POST /api/doctors`
- **Update a doctor:** `PUT /api/doctors/{id}`
- **Delete a doctor:** `DELETE /api/doctors/{id}`
- **Patch a doctor:** `PATCH /api/doctors/{id}`
### Appointments

- **Get all appointments:** `GET /api/appointments`
- **Get a single appointment:** `GET /api/appointments/{id}`
- **Create a new appointment:** `POST /api/appointments`
- **Update an appointment:** `PUT /api/appointments/{id}`
- **Delete an appointment:** `DELETE /api/appointments/{id}`
- - **Patch a appointment:** `PATCH /api/appointments/{id}`
### Appointments

- **Get all patient:** `GET /api/patients`
- **Get a single patient:** `GET /api/patients/{id}`
- **Create a new patient:** `POST /api/patients`
- **Update an patient:** `PUT /api/patients/{id}`
- **Delete an patient:** `DELETE /api/patients/{id}`
- **Patch a patient:** `PATCH /api/patients/{id}`

#### Running Tests

To ensure that your application works correctly, you can run the provided test cases using PHPUnit:

```sh
php bin/phpunit
```

Make sure to configure your test environment in `.env.test` if necessary.

#### Additional Resources

- [Symfony Documentation](https://symfony.com/doc/current/index.html)
- [API Platform Documentation](https://api-platform.com/docs/)
- [Mockaroo Documentation](https://mockaroo.com/docs)