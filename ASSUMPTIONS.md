#Scootin Assumptions/Informations

1. A user can book only one scooter at the moment. User can book the second scooter after returning the previous scooter (I think it should support multiple well but we would need to palace some threshold for fair booking).
2. We are keeping the user ride history in track_ride table.
3. we can get the list of ‘ongoing and completed ride’ from ride table
4. scooter could be disable for further booking by marking it as ‘Out_of_service’ status
