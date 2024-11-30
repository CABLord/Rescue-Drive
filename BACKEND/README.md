# Rescue Drive Backend

This directory contains the backend code for the Rescue Drive project, a self-driving rescue vehicle.

## Project Overview

Rescue Drive is an autonomous vehicle designed for rescue operations. The backend handles data processing, vehicle control, and API endpoints for the frontend.

## Features

- Vehicle control systems
- Sensor data processing
- API endpoints for frontend communication
- Database management for mission logs and vehicle status

## Team Members

- Florian Firler: Backend & Web Services
- Alex Guarino: Hardware Integration & Sensors
- Ivan Federspieler: Vehicle Mechanics & Actuators
- Lorik Bajgora: Quality Assurance & Documentation

## Technology Stack

- Python 3.x
- Flask for API development
- SQLAlchemy for database ORM
- ROS (Robot Operating System) for vehicle control
- OpenCV for image processing

## Getting Started

1. Set up a virtual environment: `python -m venv venv`
2. Activate the virtual environment: `source venv/bin/activate` (Linux/Mac) or `venv\Scripts\activate` (Windows)
3. Install dependencies: `pip install -r requirements.txt`
4. Start the server: `python app.py`

## Project Structure

- `/api`: API endpoints and routes
- `/models`: Database models
- `/services`: Business logic and services
- `/utils`: Utility functions and helpers
- `/tests`: Unit and integration tests

## Hardware Integration

- Raspberry Pi 4 (2GB RAM) for main processing
- Various sensors: Ultrasonic, Color, Gyro, Laser distance
- DC Motors and Servo motors for movement and actuation

## Contributing

Please refer to the main project README for contribution guidelines.

## License

This project is part of Rescue Drive and is subject to the same license as the main project.
