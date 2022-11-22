# Scootin

This application is resposible for:
- Searching the available scooter nearby based on the status
- Starting a trip
- Keep track of user location during trip
- Ending a trip
- Creating a scooter

#### What do i bring to the table other than the expacted assignment requirments?
- Additional endpoint for adding the scooter
- Creating additional status to make the scooter out of service
- More detailed error messages
- Detailed validations for example user cannot add track detail for ended ride etc.

#### Steps to run the application

- clone the project
- enter into the root folder of the application
- please run any one of the below command to run the application
	1. php bin/console server:run 
	2. php -S localhost:8001 -t public

#### Step to setup the database
- **Option 1** run the below commands from project root folder to setup a new database
		1. php bin/console doctrine:database:create
		2. php bin/console doctrine:migration:migrate
- **Option 2** Import the PROJECT_ROOT/scooter_ride.sql file to database with some test data. 

#### Endpoints

**Possible Responses:**
   	1. **400** - for bad requests where user didn't pass the required parameters or pass with invalid values
   	2. **404** - when we don't find any entity such as scooter or ride
   	3. **409** - when there is some conflict let's say client send the track request after trip is ended.
   	4. **200** - success response
   	5. **201** - when entity is created successfully
   	6. **401** - when user is sending an invalid token
   	7. **500** - when something went wrong but i wish we never see it :)

1. To add a scooter:
	POST  http://localhost:8001/scooter-ride/addScooter

	**Header Parameters:**
   1. x-api-key: we would need to pass the authentication key (sample: c0a062b7-b225-c294-b8a0-06b98931a45b1123)

	**Request Parameters:**
   1. lat (mandatory): user's current location latitude (example: 52.5296115)
   2. lng (mandatory): user's current location longitude (example: 13.3378023)

   **Note: This should accept more parameters such as displyName, current status etc but to keep it simple it's taking lat and lng for now.**

2. To search scooters:
	GET  http://localhost:8001/scooter-ride/search

	**Header Parameters:**
   1. x-api-key: we would need to pass the authentication key (sample: c0a062b7-b225-c294-b8a0-06b98931a45b1123)

	**Qurey Parameters:**
   1. lat (mandatory): user's current location latitude (example: 52.5296115)
   2. lng (mandatory): user's current location longitude (example: 13.3378023)
   3. UserUuid (mandatory): user's uuid to search if user doesn't already have a active ride (example: c0a062b7-b225-c294-b8a0-06b98931a45b1)
   4. status (optional): status of the scooter (example: available)


3. To start a scooter ride:
	POST  http://localhost:8001/scooter-ride/start

	**Header Parameters:**
   1. x-api-key: we would need to pass the authentication key (sample: c0a062b7-b225-c294-b8a0-06b98931a45b1123)

	**Request Parameters (as json):**
   1. lat (mandatory): user's current location latitude (example: 52.5296115)
   2. lng (mandatory): user's current location longitude (example: 13.3378023)
   3. UserUuid (mandatory): user's uuid  (example: c0a062b7-b225-c294-b8a0-06b98931a45b1)
   4. ScooterUuid (mandatory): scooter's uuid  (example: ed3d2a90-677d-11ed-886c-47d2d32f279f)
   5. datetime (mandatory): ride start date & time (example: 19-11-2022 11:36:46)

4. To track a scooter ride:
	POST  http://localhost:8001/scooter-ride/track

	**Header Parameters:**
   1. x-api-key: we would need to pass the authentication key (sample: c0a062b7-b225-c294-b8a0-06b98931a45b1123)

	**Request Parameters (as json):**
   1. lat (mandatory): user's current location latitude (example: 52.5296115)
   2. lng (mandatory): user's current location longitude (example: 13.3378023)
   3. UserUuid (mandatory): user's uuid  (example: c0a062b7-b225-c294-b8a0-06b98931a45b1)
   4. ScooterUuid (mandatory): scooter's uuid  (example: ed3d2a90-677d-11ed-886c-47d2d32f279f)
   5. datetime (mandatory): ride start date & time (example: 19-11-2022 11:36:46)
   6. rideUuid (mandatory): ride's uuid (example: c0a062b7-b225-c294-b8a0-06b98931a45b1)

5. To end a scooter ride:
	POST  http://localhost:8001/scooter-ride/end

	**Header Parameters:**
   1. x-api-key: we would need to pass the authentication key (sample: c0a062b7-b225-c294-b8a0-06b98931a45b1123)

	**Request Parameters (as json):**
   1. lat (mandatory): user's current location latitude (example: 52.5296115)
   2. lng (mandatory): user's current location longitude (example: 13.3378023)
   3. UserUuid (mandatory): user's uuid  (example: c0a062b7-b225-c294-b8a0-06b98931a45b1)
   4. ScooterUuid (mandatory): scooter's uuid  (example: ed3d2a90-677d-11ed-886c-47d2d32f279f)
   5. datetime (mandatory): ride start date & time (example: 19-11-2022 11:36:46)
   6. rideUuid (mandatory): ride's uuid (example: c0a062b7-b225-c294-b8a0-06b98931a45b1)


#### What we can improve?

- We can return the translation keys rather than the message to support localization. 
- We can write more detailed unit and integration test cases which will cover all corner cases. I have written some but not all.
- I agree that there are still lots of opportunity to refector & clean the code along with custom exception handling etc.
